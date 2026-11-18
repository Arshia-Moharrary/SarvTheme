/**
 * Contact form.
 *
 * Scope: form validation, submit state, honest preview status.
 * No backend. No network requests.
 *
 * Form contract (matches template-parts/contact/form.php):
 *   [data-contact-form]
 *     name     : input[type=text]     required, 2–60 chars
 *     phone    : input[type=tel]      required, Iranian mobile, 09XXXXXXXXX
 *     subject  : input[type=radio]    one of: consultation | appointment | other
 *     message  : textarea             required, 10–2000 chars
 *     website  : input[type=text]     honeypot, must stay empty
 */

(function () {
    'use strict';

    var form = document.querySelector('[data-contact-form]');
    if (!form) return;

    // ---------- Persian / Arabic digit normalization ----------
    var persianDigits = { '۰': '0', '۱': '1', '۲': '2', '۳': '3', '۴': '4', '۵': '5', '۶': '6', '۷': '7', '۸': '8', '۹': '9' };

    function normalizeDigits(s) {
        return String(s)
            .replace(/[۰-۹]/g, function (d) { return persianDigits[d] || d; })
            .replace(/[٠-٩]/g, function (d) { return String(d.charCodeAt(0) - 0x0660); });
    }

    function cleanPhone(v) {
        return normalizeDigits(v).replace(/[\s()\-]/g, '');
    }

    // ---------- Validators ----------
    function validateName(v) {
        var t = String(v).trim();
        if (t.length < 2) return 'نام خود را وارد کنید (حداقل ۲ حرف).';
        if (t.length > 60) return 'نام طولانی‌تر از حد مجاز است.';
        if (!/^[\p{L}\s'.-]+$/u.test(t)) return 'لطفاً فقط از حروف و فاصله استفاده کنید.';
        return '';
    }

    function validatePhone(v) {
        var t = cleanPhone(v);
        if (!t) return 'شماره موبایل خود را وارد کنید.';
        if (!/^09\d{9}$/.test(t)) return 'شماره موبایل معتبر نیست. مثال: ۰۹۱۲۱۲۳۴۵۶۷';
        return '';
    }

    function validateMessage(v) {
        var t = String(v).trim();
        if (t.length < 10) return 'پیام خود را کمی بیشتر توضیح دهید (حداقل ۱۰ کاراکتر).';
        if (t.length > 2000) return 'پیام بیش از حد طولانی است (حداکثر ۲۰۰۰ کاراکتر).';
        return '';
    }

    function validateEmail(v) {
        var t = String(v).trim();
        if (!t) return ''; // optional — empty is fine
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(t)) return 'ایمیل وارد شده معتبر نیست.';
        if (t.length > 120) return 'ایمیل طولانی‌تر از حد مجاز است.';
        return '';
    }

    var rules = [
        { name: 'name', validate: validateName },
        { name: 'phone', validate: validatePhone },
        { name: 'message', validate: validateMessage },
        { name: 'email', validate: validateEmail },
    ];

    // ---------- Field wiring ----------
    rules.forEach(function (rule) {
        var input = form.elements[rule.name];
        if (!input) return;
        var errorEl = document.getElementById('contact-' + rule.name + '-error');
        if (!errorEl) return;

        input.addEventListener('blur', function () {
            if (!input.value) return; // don't nag on empty blur
            setFieldState(input, errorEl, rule.validate(input.value));
        });

        input.addEventListener('input', function () {
            if (input.getAttribute('aria-invalid') === 'true') {
                var err = rule.validate(input.value);
                if (!err) setFieldState(input, errorEl, '');
            }
        });
    });

    function setFieldState(input, errorEl, message) {
        if (message) {
            input.setAttribute('aria-invalid', 'true');
            errorEl.textContent = message;
        } else {
            input.removeAttribute('aria-invalid');
            errorEl.textContent = '';
        }
    }

    // ---------- Submit ----------
    var submitBtn = form.querySelector('[type="submit"]');
    var labelEl = submitBtn.querySelector('[data-submit-label]');
    var loadingEl = submitBtn.querySelector('[data-submit-loading]');
    var iconEl = submitBtn.querySelector('[data-submit-icon]');
    var statusEl = form.querySelector('[data-form-status]');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Honeypot — silent no-op for bots
        var hp = form.querySelector('[data-honeypot]');
        if (hp && hp.value) return;

        // Validate all fields
        var firstInvalid = null;
        rules.forEach(function (rule) {
            var input = form.elements[rule.name];
            if (!input) return;
            var errorEl = document.getElementById('contact-' + rule.name + '-error');
            var err = rule.validate(input.value);
            if (errorEl) setFieldState(input, errorEl, err);
            if (err && !firstInvalid) firstInvalid = input;
        });

        if (firstInvalid) {
            firstInvalid.focus();
            return;
        }

        // Gather payload (respects Phase 2 contract)
        var subjectInput = form.querySelector('input[name="subject"]:checked');
        var payload = {
            name: form.elements.name.value.trim(),
            phone: cleanPhone(form.elements.phone.value),
            email: (form.elements.email ? form.elements.email.value.trim() : ''),
            subject: subjectInput ? subjectInput.value : 'consultation',
            message: form.elements.message.value.trim()
        };

        setLoading(true);
        clearStatus();

        submitToBackend(payload)
            .then(function (res) {
                setLoading(false);
                if (res && res.ok) {
                    showStatus(res.message || 'درخواست شما دریافت شد. به‌زودی با شما تماس می‌گیریم.', 'success');
                    form.reset();
                } else if (res && res.kind === 'preview') {
                    showStatus(res.message, 'preview');
                } else {
                    showStatus((res && res.message) || 'خطایی رخ داد. لطفاً دوباره تلاش کنید.', 'error');
                }
            })
            .catch(function () {
                setLoading(false);
                showStatus('ارتباط برقرار نشد. لطفاً دوباره تلاش کنید یا با شماره تماس مستقیم در ارتباط باشید.', 'error');
            });
    });

    function setLoading(loading) {
        if (!submitBtn) return;
        submitBtn.disabled = loading;
        submitBtn.setAttribute('aria-busy', loading ? 'true' : 'false');
        if (labelEl) labelEl.hidden = loading;
        if (loadingEl) loadingEl.hidden = !loading;
        if (iconEl) iconEl.classList.toggle('hidden', loading);
    }

    function clearStatus() {
        if (!statusEl) return;
        statusEl.textContent = '';
        statusEl.classList.add('hidden');
        statusEl.removeAttribute('data-state');
    }

    function showStatus(message, type) {
        if (!statusEl) return;
        statusEl.textContent = message;
        statusEl.setAttribute('data-state', type);
        statusEl.classList.remove('hidden');
        statusEl.className = statusEl.className.replace(/\b(mt-\d+|rounded-brand|p-\d+|text-\S+|bg-\S+|border\S*)\b/g, '').trim();
        statusEl.classList.add('mt-4', 'rounded-brand', 'p-4', 'text-body', 'font-peyda', 'leading-relaxed', 'border');

        if (type === 'preview') {
            statusEl.classList.add('bg-champagne-gold/10', 'border-champagne-gold/50', 'text-deep-emerald');
        } else if (type === 'success') {
            statusEl.classList.add('bg-deep-emerald/5', 'border-deep-emerald/30', 'text-deep-emerald');
        } else {
            statusEl.classList.add('bg-deep-emerald/5', 'border-deep-emerald/30', 'text-deep-emerald');
        }
    }

    // ================================================================
    // Backend submission. Sends the Phase 1 payload to admin-post.php.
    // Reads endpoint/action/nonce from the form's data-* attributes.
    // Response shape: { ok, kind, message, errors? }
    // ================================================================
    function submitToBackend(payload) {
        var endpoint = form.getAttribute('data-endpoint') || '';
        var action = form.getAttribute('data-action') || '';
        var nonce = form.getAttribute('data-nonce') || '';

        if (!endpoint || !action || !nonce) {
            return Promise.resolve({
                ok: false,
                kind: 'error',
                message: 'فرم به درستی پیکربندی نشده است. لطفاً با شماره تماس مستقیم در ارتباط باشید.'
            });
        }

        var fd = new FormData();
        fd.append('action', action);
        fd.append('_wpnonce', nonce);
        fd.append('name', payload.name);
        fd.append('phone', payload.phone);
        fd.append('subject', payload.subject);
        fd.append('message', payload.message);
        fd.append('email', payload.email);

        return fetch(endpoint, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: fd,
            credentials: 'same-origin'
        })
            .then(function (res) {
                return res.json().catch(function () {
                    // Non-JSON response (unexpected) — surface a generic failure.
                    return { ok: false, message: '' };
                });
            })
            .then(function (data) {
                if (data && data.ok) {
                    return {
                        ok: true,
                        kind: 'success',
                        message: data.message || 'درخواست شما دریافت شد.'
                    };
                }
                return {
                    ok: false,
                    kind: 'error',
                    message: (data && data.message) || 'خطایی رخ داد. لطفاً دوباره تلاش کنید.'
                };
            })
            .catch(function () {
                return {
                    ok: false,
                    kind: 'error',
                    message: 'ارتباط با سرور برقرار نشد. لطفاً اتصال خود را بررسی کنید یا با شماره تماس مستقیم در ارتباط باشید.'
                };
            });
    }
})();