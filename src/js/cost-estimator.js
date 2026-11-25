/**
 * Cost estimator: treatment + quantity (quick or visual) → phone → consultation request.
 *
 * One state object is the single source of truth; render() derives every piece of UI from it.
 *   state.count  : quantity that will be submitted (0 = not chosen / invalid)
 *   state.teeth  : Set of FDI tooth numbers. Non-empty = "visual mode" and count === teeth.size.
 */
(function () {
    'use strict';

    var root = document.querySelector('[data-estimator]');
    if (!root) return;

    var cfg = {
        rest: root.dataset.rest || '',          // public REST base, e.g. https://site/wp-json/sarv-leads/v1/
        nonce: root.dataset.nonce || '',        // CSRF-style nonce (no secrets live in the browser)
        min: parseInt(root.dataset.min, 10) || 1,
        max: parseInt(root.dataset.max, 10) || 32
    };
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- helpers ---------- */

    var FA = '۰۱۲۳۴۵۶۷۸۹';
    function toLatin(s) {
        return String(s)
            .replace(/[۰-۹]/g, function (c) { return c.charCodeAt(0) - 1776; })
            .replace(/[٠-٩]/g, function (c) { return c.charCodeAt(0) - 1632; });
    }
    function toFa(s) { return String(s).replace(/\d/g, function (d) { return FA[d]; }); }
    function q(sel) { return root.querySelector(sel); }
    function qa(sel) { return Array.prototype.slice.call(root.querySelectorAll(sel)); }

    function normalizePhone(v) {
        var d = toLatin(v).replace(/\D/g, '');
        if (d.indexOf('0098') === 0) d = '0' + d.slice(4);
        else if (d.indexOf('98') === 0 && d.length === 12) d = '0' + d.slice(2);
        else if (d.charAt(0) === '9' && d.length === 10) d = '0' + d;
        return d;
    }
    function isValidPhone(d) { return /^09\d{9}$/.test(d); }

    /* ---------- elements ---------- */

    var el = {
        form: q('[data-form]'),
        radios: qa('input[name="treatment"]'),
        chips: qa('[data-count]'),
        countInput: q('[data-count-input]'),
        countMsg: q('[data-count-msg]'),
        arch: q('[data-arch]'),
        teeth: qa('.est-tooth'),
        archToggles: qa('[data-arch-toggle]'),
        clear: q('[data-clear]'),
        readout: q('[data-readout]'),
        notice: q('[data-notice]'),
        noticeText: q('[data-notice-text]'),
        undo: q('[data-undo]'),
        sumTreatment: q('[data-sum-treatment]'),
        sumCount: q('[data-sum-count]'),
        sumMode: q('[data-sum-mode]'),
        revealBtn: q('[data-reveal-btn]'),
        hint: q('[data-hint]'),
        lead: q('[data-lead]'),
        leadForm: q('[data-lead-form]'),
        leadSuccess: q('[data-lead-success]'),
        phone: q('[data-phone]'),
        consent: q('[data-consent]'),
        consentMsg: q('[data-consent-msg]'),
        phoneMsg: q('[data-phone-msg]'),
        honeypot: q('[data-honeypot]'),
        error: q('[data-error]'),
        submit: q('[data-submit]'),
        submitLabel: q('[data-submit-label]'),
        submitLoading: q('[data-submit-loading]'),
        successTitle: q('[data-success-title]'),
        doneTreatment: q('[data-done-treatment]'),
        doneCount: q('[data-done-count]'),
        donePhone: q('[data-done-phone]'),
        restart: q('[data-restart]')
    };

    /* ---------- state ---------- */

    var state = {
        treatment: 'composite',
        count: 0,
        teeth: new Set(),
        open: false,
        submitting: false,
        countRaw: ''        // what the visitor typed, so an invalid entry isn't overwritten
    };
    var snapshot = null;    // previous {count, teeth}, powers "undo" on mode changes

    function treatmentLabel() {
        var r = el.radios.filter(function (x) { return x.checked; })[0];
        return r ? r.dataset.label : '';
    }

    /* ---------- state transitions ---------- */

    /**
     * Single entry point for count/teeth changes. Switching between quick and visual mode
     * keeps a snapshot and tells the visitor, so a different quantity is never applied silently.
     */
    function commit(next, opts) {
        opts = opts || {};
        var prev = { count: state.count, teeth: new Set(state.teeth) };
        var wasVisual = prev.teeth.size > 0, willBeVisual = next.teeth.size > 0;
        var message = '';

        if (opts.notice !== false) {
            if (wasVisual && !willBeVisual) {
                message = 'انتخاب دقیق دندان‌ها حذف شد.';
            } else if (!wasVisual && willBeVisual && prev.count > 0) {
                message = 'از این پس تعداد از روی دندان‌های انتخابی محاسبه می‌شود (قبلاً ' + toFa(prev.count) + ' دندان).';
            }
        }

        state.count = next.count;
        state.teeth = next.teeth;
        if (message) { snapshot = prev; showNotice(message); } else { hideNotice(); }
        render(opts.source);
    }

    function showNotice(text) { el.noticeText.textContent = text; el.notice.hidden = false; }
    function hideNotice() { el.notice.hidden = true; snapshot = null; }

    function setQuickCount(n, source) {
        commit({ count: n, teeth: n === state.teeth.size ? state.teeth : new Set() }, { source: source });
    }

    function setTeeth(set, opts) {
        commit({ count: set.size, teeth: set }, opts);
    }

    function toggleTooth(node) {
        var id = parseInt(node.dataset.tooth, 10);
        var next = new Set(state.teeth);
        if (next.has(id)) next.delete(id); else next.add(id);
        state.countRaw = '';
        setTeeth(next, { notice: next.size > 0 }); // removing the last tooth is a deliberate act: no notice
        touch(1800);                                                       // one aggregated update after the clicking stops
        el.readout.textContent = node.dataset.name + (next.has(id) ? ' — انتخاب شد' : ' — برداشته شد');
    }

    /* ---------- render ---------- */

    function render(source) {
        var visual = state.teeth.size > 0;

        // chips
        el.chips.forEach(function (c) {
            c.setAttribute('aria-pressed', String(state.count === parseInt(c.dataset.count, 10)));
        });

        // count input mirrors the quantity (unless the visitor is typing in it)
        if (source !== 'input') {
            el.countInput.value = state.count ? toFa(state.count) : '';
            state.countRaw = '';
            setFieldMessage(el.countInput, el.countMsg, '');
        }

        // teeth
        el.teeth.forEach(function (t) {
            t.setAttribute('aria-checked', String(state.teeth.has(parseInt(t.dataset.tooth, 10))));
        });
        el.archToggles.forEach(function (b) {
            var ids = archTeeth(b.dataset.archToggle);
            b.setAttribute('aria-pressed', String(ids.every(function (id) { return state.teeth.has(id); })));
        });
        el.clear.disabled = !visual;
        setDefaultReadout();

        // summary
        el.sumTreatment.textContent = treatmentLabel();
        el.sumCount.textContent = state.count ? toFa(state.count) + ' دندان' : 'تعداد مشخص نشده';
        if (visual) {
            var ids = sortedTeeth();
            var shown = ids.slice(0, 10).map(toFa).join('، ');
            el.sumMode.textContent = 'موقعیت دقیق: ' + shown + (ids.length > 10 ? ' و ' + toFa(ids.length - 10) + ' مورد دیگر' : '');
        } else {
            el.sumMode.textContent = state.count ? 'بدون انتخاب موقعیت دقیق' : 'تعداد را انتخاب کنید یا روی نقشه دندان‌ها بزنید';
        }

        // CTA
        el.revealBtn.setAttribute('aria-disabled', String(!state.count));
        if (state.count) el.hint.textContent = '';
    }

    function sortedTeeth() { return Array.from(state.teeth).sort(function (a, b) { return a - b; }); }
    function archTeeth(name) {
        return el.teeth
            .filter(function (t) { return t.closest('[data-arch="' + name + '"]'); })
            .map(function (t) { return parseInt(t.dataset.tooth, 10); });
    }
    function setDefaultReadout() {
        el.readout.textContent = state.teeth.size
            ? toFa(state.teeth.size) + ' دندان انتخاب شده'
            : 'هنوز دندانی انتخاب نشده است';
    }
    function setFieldMessage(input, msgEl, text) {
        msgEl.textContent = text;
        input.setAttribute('aria-invalid', text ? 'true' : 'false');
    }


    /* =====================================================================
     * Incremental lead sync (REST)
     *
     * The first meaningful interaction creates a lead on the server; every later change updates
     * THE SAME lead. The browser only ever holds a server-issued UUID + token. Changes are
     * debounced and sent as a snapshot; the server works out what really changed, so unchanged
     * values never create records or Telegram messages.
     * ===================================================================== */

    var STORE_KEY = 'sarv_lead';
    var sync = { lead: readStore(), sent: '', timer: null, current: null, dirty: false, touched: false, failures: 0 };

    function readStore() {
        try {
            var v = JSON.parse(window.sessionStorage.getItem(STORE_KEY));
            return v && v.id && v.token ? v : null;
        } catch (e) { return null; }
    }
    function writeStore(v) {
        try { if (v) window.sessionStorage.setItem(STORE_KEY, JSON.stringify(v)); else window.sessionStorage.removeItem(STORE_KEY); } catch (e) { }
    }

    function getSnapshot() {
        var s = { treatment: state.treatment, teeth: sortedTeeth().join(',') };
        if (state.count) s.teeth_count = state.count;
        // The phone number is personal data: it is only transmitted after explicit consent.
        var p = normalizePhone(el.phone.value);
        if (isValidPhone(p) && el.consent.checked) { s.phone = p; s.consent = true; }
        return s;
    }

    function api(path, payload, retriedNonce) {
        var headers = { 'Content-Type': 'application/json', 'X-Sarv-Nonce': cfg.nonce };
        var body = JSON.stringify(Object.assign({ source_url: window.location.href, website: el.honeypot ? el.honeypot.value : '' }, payload));
        return fetch(cfg.rest + path, { method: 'POST', headers: headers, body: body, credentials: 'same-origin' })
            .then(function (res) {
                return res.json().catch(function () { return {}; }).then(function (json) { return { status: res.status, json: json }; });
            })
            .then(function (r) {
                // Cached pages can carry an expired nonce: fetch a fresh one once and retry.
                if (r.status === 403 && r.json && r.json.code === 'sarv_bad_nonce' && !retriedNonce) {
                    return fetch(cfg.rest + 'nonce', { credentials: 'same-origin', cache: 'no-store' })
                        .then(function (n) { return n.json(); })
                        .then(function (n) { if (n && n.nonce) cfg.nonce = n.nonce; return api(path, payload, true); });
                }
                return r;
            });
    }

    function scheduleSync(delay) {
        if (!sync.touched || !cfg.rest) return;
        window.clearTimeout(sync.timer);
        sync.timer = window.setTimeout(runSync, delay);
    }
    /** Called by every handler where the visitor completes/changes something meaningful. */
    function touch(delay) {
        sync.touched = true;
        scheduleSync(delay);
    }

    function runSync() {
        sync.timer = null;
        if (sync.current) { sync.dirty = true; return sync.current; }       // one request at a time
        var snap = getSnapshot();
        var key = JSON.stringify(snap);
        if (key === sync.sent) return Promise.resolve();                   // nothing new to say

        var creating = !sync.lead;
        var req = creating ? api('leads', snap) : api('leads/' + sync.lead.id, Object.assign({ token: sync.lead.token }, snap));

        sync.current = req.then(function (r) {
            if (r.status === 201 || r.status === 200) {
                if (creating) { sync.lead = { id: r.json.lead_id, token: r.json.token }; writeStore(sync.lead); }
                sync.sent = key;
                sync.failures = 0;
            } else if (r.status === 404 || r.status === 409) {             // unknown or already-submitted lead → start a fresh one
                sync.lead = null; sync.sent = ''; writeStore(null);
                sync.dirty = true;
            } else if (r.status === 422) {
                sync.sent = key;                                           // server rejected this snapshot; don't loop on it
            } else {
                throw new Error('retry');                                  // 429 / 5xx
            }
        }).catch(function () {
            sync.failures++;
            if (sync.failures <= 3) window.setTimeout(function () { scheduleSync(0); }, [2000, 5000, 15000][sync.failures - 1]);
        }).then(function () {
            sync.current = null;
            if (sync.dirty) { sync.dirty = false; scheduleSync(300); }
        });
        return sync.current;
    }

    /** Make sure everything the visitor has entered has reached the server before the final submit. */
    function flushSync() {
        window.clearTimeout(sync.timer);
        sync.timer = null;
        return (sync.current || Promise.resolve()).then(function () { return runSync(); }).then(function () { return sync.current; });
    }

    /* ---------- step 1: treatment ---------- */

    el.radios.forEach(function (r) {
        r.addEventListener('change', function () { state.treatment = r.value; render(); touch(500); });
        r.addEventListener('click', function () { touch(500); });          // also confirms the pre-selected treatment
    });

    /* ---------- step 3: arch expander (progressive disclosure) ---------- */
    var archExpander = q('[data-arch-expander]');
    var archBody = q('[data-arch-body]');
    if (archExpander && archBody) {
        archExpander.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var open = archExpander.getAttribute('aria-expanded') === 'true';
            archExpander.setAttribute('aria-expanded', String(!open));
            archBody.classList.toggle('is-open', !open);
        });
    }

    /* ---------- step 2: quantity ---------- */

    el.chips.forEach(function (c) {
        c.addEventListener('click', function () { setQuickCount(parseInt(c.dataset.count, 10)); touch(700); });
    });

    el.countInput.addEventListener('input', function () {
        var raw = toLatin(el.countInput.value).replace(/\D/g, '').slice(0, 2);
        var shown = toFa(raw);
        if (el.countInput.value !== shown) el.countInput.value = shown;
        state.countRaw = raw;

        if (raw === '') {
            setFieldMessage(el.countInput, el.countMsg, '');
            setQuickCount(0, 'input');
            return;
        }
        var n = parseInt(raw, 10);
        if (n < cfg.min || n > cfg.max) {
            setFieldMessage(el.countInput, el.countMsg, 'تعداد دندان باید بین ' + toFa(cfg.min) + ' تا ' + toFa(cfg.max) + ' باشد.');
            setQuickCount(0, 'input');
            return;
        }
        setFieldMessage(el.countInput, el.countMsg, '');
        setQuickCount(n, 'input');
        touch(1200);                                                       // valid number; wait for the visitor to finish typing
    });
    el.countInput.addEventListener('blur', function () {
        if (state.count) { el.countInput.value = toFa(state.count); }
    });

    /* ---------- step 3: visual selector ---------- */

    el.arch.addEventListener('click', function (e) {
        var t = e.target.closest('.est-tooth');
        if (t) toggleTooth(t);
    });

    el.arch.addEventListener('keydown', function (e) {
        var t = e.target.closest('.est-tooth');
        if (!t) return;
        var i = el.teeth.indexOf(t), n = i;
        switch (e.key) {
            case 'ArrowRight': case 'ArrowDown': n = i + 1; break;
            case 'ArrowLeft': case 'ArrowUp': n = i - 1; break;
            case 'Home': n = 0; break;
            case 'End': n = el.teeth.length - 1; break;
            case ' ': case 'Enter': e.preventDefault(); toggleTooth(t); return;
            default: return;
        }
        e.preventDefault();
        focusTooth(Math.max(0, Math.min(el.teeth.length - 1, n)));
    });

    // Roving tabindex: one tab stop for the whole map, arrows move within it.
    function focusTooth(i) {
        el.teeth.forEach(function (t, k) { t.setAttribute('tabindex', k === i ? '0' : '-1'); });
        el.teeth[i].focus();
    }
    el.arch.addEventListener('focusin', function (e) {
        var t = e.target.closest('.est-tooth');
        if (!t) return;
        var i = el.teeth.indexOf(t);
        el.teeth.forEach(function (x, k) { x.setAttribute('tabindex', k === i ? '0' : '-1'); });
        el.readout.textContent = t.dataset.name;
    });
    el.arch.addEventListener('pointerover', function (e) {
        var t = e.target.closest('.est-tooth');
        if (t) el.readout.textContent = t.dataset.name;
    });
    el.arch.addEventListener('pointerleave', setDefaultReadout);
    el.arch.addEventListener('focusout', setDefaultReadout);

    el.archToggles.forEach(function (b) {
        b.addEventListener('click', function () {
            var ids = archTeeth(b.dataset.archToggle);
            var next = new Set(state.teeth);
            var all = ids.every(function (id) { return next.has(id); });
            ids.forEach(function (id) { if (all) next.delete(id); else next.add(id); });
            state.countRaw = '';
            setTeeth(next, { notice: next.size > 0 });
            touch(1800);
        });
    });

    el.clear.addEventListener('click', function () { setTeeth(new Set()); touch(1800); });

    el.undo.addEventListener('click', function () {
        if (!snapshot) return;
        var s = snapshot;
        state.count = s.count;
        state.teeth = s.teeth;
        hideNotice();
        render();
        touch(1800);
    });

    /* ---------- step 4: reveal the consultation step ---------- */

    function reveal() {
        if (!state.count) {
            el.hint.textContent = 'برای ادامه، ابتدا تعداد دندان‌ها را مشخص کنید.';
            el.hint.classList.remove('is-shaking');
            void el.hint.offsetWidth;                      // restart animation
            el.hint.classList.add('is-shaking');
            el.chips[0].focus();
            return;
        }
        console.log('heelloo');
        state.open = true;
        el.lead.classList.add('is-open');
        el.lead.removeAttribute('inert');
        el.revealBtn.hidden = true;
        el.hint.textContent = '';

        el.phone.focus({ preventScroll: true });
        window.setTimeout(function () {
            el.lead.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'nearest' });
        }, reduceMotion ? 0 : 250);
    }
    el.revealBtn.addEventListener('click', reveal);

    /* ---------- phone ---------- */

    el.phone.addEventListener('input', function () {
        var cleaned = toFa(toLatin(el.phone.value).replace(/[^\d+]/g, ''));
        if (el.phone.value !== cleaned) el.phone.value = cleaned;
        var valid = isValidPhone(normalizePhone(el.phone.value));
        el.phone.parentNode.classList.toggle('is-valid', valid);
        if (valid || el.phone.value === '') setFieldMessage(el.phone, el.phoneMsg, '');
        el.error.hidden = true;
        if (valid) touch(900);                                             // only a complete, valid number is ever sent
    });
    el.phone.addEventListener('blur', function () {
        if (el.phone.value && !isValidPhone(normalizePhone(el.phone.value))) validatePhone();
        else touch(0);
    });
    el.consent.addEventListener('change', function () {
        if (el.consent.checked) el.consentMsg.textContent = '';
        touch(300);                                                        // a valid phone typed earlier can now be sent
    });

    function validatePhone() {
        var d = normalizePhone(el.phone.value);
        if (!d) { setFieldMessage(el.phone, el.phoneMsg, 'لطفاً شماره موبایل خود را وارد کنید.'); return false; }
        if (!isValidPhone(d)) { setFieldMessage(el.phone, el.phoneMsg, 'شماره موبایل معتبر نیست. نمونه: ۰۹۱۲۱۲۳۴۵۶۷'); return false; }
        setFieldMessage(el.phone, el.phoneMsg, '');
        return true;
    }

    /* ---------- submit ---------- */

    el.form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!state.open) { reveal(); return; }   // Enter inside the quantity field = "see price"
        submit();
    });

    function setLoading(on) {
        state.submitting = on;
        el.submit.disabled = on;
        el.submit.setAttribute('aria-busy', String(on));
        el.submitLabel.classList.toggle('hidden', on);
        el.submitLoading.classList.toggle('hidden', !on);
        el.submitLoading.classList.toggle('inline-flex', on);
    }
    function showError(text) { el.error.textContent = text; el.error.hidden = false; }

    function submit() {
        if (state.submitting) return;                       // no duplicate submissions
        el.error.hidden = true;

        if (!cfg.rest) { showError('سرویس ثبت درخواست در دسترس نیست. لطفاً بعداً تلاش کنید.'); return; }
        if (!state.count) { showError('تعداد دندان‌ها مشخص نیست. لطفاً یک تعداد معتبر انتخاب کنید.'); el.chips[0].focus(); return; }
        if (!validatePhone()) { el.phone.focus(); return; }
        if (!el.consent.checked) {
            el.consentMsg.textContent = 'برای ثبت درخواست، لطفاً با ذخیره اطلاعات و اطلاع‌رسانی به تیم مشاوره موافقت کنید.';
            el.consent.focus();
            return;
        }

        var phone = normalizePhone(el.phone.value);
        sync.touched = true;
        setLoading(true);

        // 1) everything entered so far reaches the server, 2) the same lead is marked as submitted.
        flushSync().then(function () {
            return finalSubmit(false);
        }).catch(function () {
            showError('ارتباط با سرور برقرار نشد. اتصال اینترنت را بررسی کنید و دوباره تلاش کنید.');   // selections are kept
        }).then(function () { setLoading(false); });

        function finalSubmit(already_retried) {
            var snap = Object.assign(getSnapshot(), { consent: true, phone: phone });
            var go = sync.lead ? Promise.resolve(sync.lead) : api('leads', snap).then(function (r) {
                if (r.status !== 201) throw r;
                sync.lead = { id: r.json.lead_id, token: r.json.token };
                writeStore(sync.lead);
                return sync.lead;
            });
            return go.then(function (lead) {
                return api('leads/' + lead.id + '/submit', Object.assign({ token: lead.token }, snap));
            }).then(function (r) {
                if (r.status === 200 && r.json && r.json.completion === 'submitted') { onSuccess(phone); return; }
                if ((r.status === 404 || r.status === 409) && !already_retried) {   // stale lead → start a fresh one and submit again
                    sync.lead = null; sync.sent = ''; writeStore(null);
                    return finalSubmit(true);
                }
                showError((r.json && r.json.message) || 'ثبت درخواست انجام نشد. لطفاً دوباره تلاش کنید.');
            }, function (r) {
                if (r && r.json) { showError(r.json.message || 'ثبت درخواست انجام نشد. لطفاً دوباره تلاش کنید.'); return; }
                throw r;
            });
        }
    }

    function onSuccess(phone) {
        sync.lead = null; sync.sent = ''; sync.touched = false; writeStore(null);
        el.doneTreatment.textContent = treatmentLabel();
        el.doneCount.textContent = toFa(state.count) + ' دندان';
        el.donePhone.textContent = toFa(phone);
        el.leadForm.hidden = true;
        el.leadSuccess.hidden = false;
        el.successTitle.focus({ preventScroll: true });
        el.lead.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'nearest' });
    }

    el.restart.addEventListener('click', function () {
        el.radios.forEach(function (r) { r.checked = r.value === 'composite'; });
        state.treatment = 'composite';
        el.phone.value = '';
        el.consent.checked = false;
        el.consentMsg.textContent = '';
        el.phone.parentNode.classList.remove('is-valid');
        setFieldMessage(el.phone, el.phoneMsg, '');
        el.error.hidden = true;
        el.leadSuccess.hidden = true;
        el.leadForm.hidden = false;
        el.lead.classList.remove('is-open');
        el.lead.setAttribute('inert', '');
        el.revealBtn.hidden = false;
        state.open = false;
        hideNotice();
        state.count = 0;
        state.teeth = new Set();
        render();
        el.form.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
    });

    render();
})();