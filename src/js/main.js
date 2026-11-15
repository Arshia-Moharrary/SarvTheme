
/**
 * Sarv Theme - Main JavaScript
 * 
 * @package Sarv
 */

// Import Swiper CSS
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Import Swiper JS
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, A11y } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {
    // ==========================================
    // Mobile Menu Logic
    // ==========================================
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuPanel = document.getElementById('mobile-menu-panel');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    if (menuToggle && mobileMenu && mobileMenuPanel && mobileMenuClose && mobileMenuOverlay) {

        const openMenu = () => {
            // ۱. خارج کردن کانتینر از حالت display: none
            mobileMenu.classList.remove('hidden');
            mobileMenu.setAttribute('aria-hidden', 'false');

            // ۲. استفاده از requestAnimationFrame برای اعمال کلاس‌های انیمیشن در فریم بعدی
            // این کار تضمین می‌کند که مرورگر حالت اولیه (translate-x-full) را ثبت کرده باشد
            requestAnimationFrame(() => {
                // نمایش overlay
                mobileMenuOverlay.classList.remove('opacity-0', 'pointer-events-none');

                // اسلاید پنل به داخل صفحه
                mobileMenuPanel.classList.remove('translate-x-full');
                mobileMenuPanel.classList.add('translate-x-0');
            });

            // تنظیمات دسترسی‌پذیری
            menuToggle.setAttribute('aria-expanded', 'true');

            // جلوگیری از اسکرول صفحه
            document.body.style.overflow = 'hidden';

            // فوکوس روی اولین لینک داخل منو (با تاخیر برای هماهنگی با انیمیشن)
            setTimeout(() => {
                const firstFocusable = mobileMenuPanel.querySelector('a, button');
                if (firstFocusable) firstFocusable.focus();
            }, 300);
        };

        const closeMenu = () => {
            // انیمیشن اسلاید به سمت راست
            mobileMenuPanel.classList.remove('translate-x-0');
            mobileMenuPanel.classList.add('translate-x-full');

            // محو شدن overlay
            mobileMenuOverlay.classList.add('opacity-0', 'pointer-events-none');

            // تنظیمات دسترسی‌پذیری
            menuToggle.setAttribute('aria-expanded', 'false');
            mobileMenu.setAttribute('aria-hidden', 'true');

            // بازگرداندن اسکرول صفحه
            document.body.style.overflow = '';

            // بازگرداندن فوکوس به دکمه همبرگری
            menuToggle.focus();

            // مخفی کردن کل کانتینر بعد از اتمام انیمیشن
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        };

        // رویدادهای باز کردن
        menuToggle.addEventListener('click', openMenu);

        // رویدادهای بستن
        mobileMenuClose.addEventListener('click', closeMenu);
        mobileMenuOverlay.addEventListener('click', closeMenu);

        // بستن با کلید Escape (دسترسی‌پذیری)
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMenu();
            }
        });
    }

    // ==========================================
    // Desktop Header — Scroll State
    // (CSS effects are scoped to @media (min-width: 1024px))
    // ==========================================
    const siteHeader = document.getElementById('masthead');
    if (siteHeader) {
        const SCROLL_THRESHOLD = 0;
        let headerTicking = false;

        const updateHeaderState = () => {
            siteHeader.classList.toggle('is-scrolled', window.scrollY > SCROLL_THRESHOLD);
            headerTicking = false;
        };

        window.addEventListener('scroll', () => {
            if (!headerTicking) {
                window.requestAnimationFrame(updateHeaderState);
                headerTicking = true;
            }
        }, { passive: true });

        // Initial state (e.g., landing on an anchor deep-link)
        updateHeaderState();
    }

    // ==========================================
    // Smooth Scroll for Anchor Links
    // ==========================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');

            // اگر لینک فقط # بود، کاری نکن
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ==========================================
    // Scroll Reveal Animations (Intersection Observer)
    // ==========================================
    const revealElements = document.querySelectorAll('.reveal-up, .reveal-fade');

    if (revealElements.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px', // کمی زودتر از رسیدن به انتهای صفحه فعال شود
            threshold: 0.1 // وقتی ۱۰٪ از عنصر دیده شد
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    // پس از اجرای انیمیشن، observer از روی این عنصر برداشته می‌شود تا منابع هدر نرود
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        revealElements.forEach(el => observer.observe(el));
    }

    // ==========================================
    // Before / After Comparison Slider
    // ==========================================
    const comparisonContainers = document.querySelectorAll('.comparison-container');

    comparisonContainers.forEach(container => {
        const input = container.querySelector('.comparison-input');
        const beforeLayer = container.querySelector('.comparison-before');
        const handle = container.querySelector('.comparison-handle');

        if (input && beforeLayer && handle) {
            const updateSlider = (value) => {
                // اعمال درصد به لایه قبل و موقعیت دستگیره
                beforeLayer.style.width = `${value}%`;
                handle.style.left = `${value}%`;
            };

            // رویداد تغییر مقدار (با ماوس، لمس یا کیبورد)
            input.addEventListener('input', (e) => {
                updateSlider(e.target.value);
            });

            // در RTL، شاید بخواهیم جهت حرکت را برعکس کنیم؟ 
            // خیر، ما از left استفاده می‌کنیم چون input از 0 تا 100 حرکت می‌کند.
            // اگر در RTL حرکت برعکس بود، در CSS آن را اصلاح می‌کنیم.
            // برای سادگی و سازگاری با input type="range"، در RTL باید دقت کنیم.
            // در واقع، ما در CSS از left استفاده کردیم که فیزیکی است.
            // اگر راست‌چین هستیم، بهتر است لایه "قبل" از سمت راست شروع شود.
            // اما استاندارد اسلایدرها این است که از چپ به راست کار کنند.
            // بیایید با یک راه‌حل ساده این را مدیریت کنیم: 
            // اگر dir="rtl" بود، مقدار را معکوس می‌کنیم.

            if (document.documentElement.dir === 'rtl') {
                input.addEventListener('input', (e) => {
                    // در RTL، وقتی کاربر به سمت چپ می‌کشد، مقدار باید زیاد شود
                    // چون لایه قبل در سمت راست قرار دارد
                    const value = 100 - e.target.value;
                    beforeLayer.style.width = `${e.target.value}%`;
                    // در RTL، با استفاده از right موقعیت‌دهی می‌کنیم
                    handle.style.left = `${e.target.value}%`;
                    // (نکته: برای سازگاری کامل با RTL، از راست‌چین استفاده می‌کنیم)
                });
            }
        }
    });

    // ==========================================
    // Blog Magazine Swiper
    // ==========================================
    const blogSwiperEl = document.querySelector('.blog-swiper');

    if (blogSwiperEl) {
        const blogSwiper = new Swiper(blogSwiperEl, {
            modules: [Navigation, Pagination, Autoplay, A11y],
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            rtl: true, // فعال‌سازی RTL
            watchOverflow: true,
            grabCursor: true, // نشانگر دست برای کشیدن در دسکتاپ
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 32,
                },
            },
            a11y: {
                prevSlideMessage: 'اسلاید قبلی',
                nextSlideMessage: 'اسلاید بعدی',
            }
        });
    }

    // ==========================================
    // Footer Back to Top
    // ==========================================
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

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
            endpoint: root.dataset.endpoint,
            action: root.dataset.action,
            nonce: root.dataset.nonce,
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

        /* ---------- step 1: treatment ---------- */

        el.radios.forEach(function (r) {
            r.addEventListener('change', function () { state.treatment = r.value; render(); });
        });

        /* ---------- step 2: quantity ---------- */

        el.chips.forEach(function (c) {
            c.addEventListener('click', function () { setQuickCount(parseInt(c.dataset.count, 10)); });
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
            });
        });

        el.clear.addEventListener('click', function () { setTeeth(new Set()); });

        el.undo.addEventListener('click', function () {
            if (!snapshot) return;
            var s = snapshot;
            state.count = s.count;
            state.teeth = s.teeth;
            hideNotice();
            render();
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
        });
        el.phone.addEventListener('blur', function () {
            if (el.phone.value && !isValidPhone(normalizePhone(el.phone.value))) validatePhone();
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

            if (!state.count) { showError('تعداد دندان‌ها مشخص نیست. لطفاً یک تعداد معتبر انتخاب کنید.'); el.chips[0].focus(); return; }
            if (!validatePhone()) { el.phone.focus(); return; }

            var phone = normalizePhone(el.phone.value);
            var body = new FormData();
            body.append('action', cfg.action);
            body.append('nonce', cfg.nonce);
            body.append('treatment', state.treatment);
            body.append('count', String(state.count));
            body.append('teeth', sortedTeeth().join(','));
            body.append('phone', phone);
            body.append('website', el.honeypot.value);

            setLoading(true);
            var ctrl = 'AbortController' in window ? new AbortController() : null;
            var timer = window.setTimeout(function () { if (ctrl) ctrl.abort(); }, 20000);

            fetch(cfg.endpoint, { method: 'POST', body: body, credentials: 'same-origin', signal: ctrl ? ctrl.signal : undefined })
                .then(function (res) {
                    return res.json().catch(function () { return null; }).then(function (json) { return { ok: res.ok, json: json }; });
                })
                .then(function (r) {
                    if (r.ok && r.json && r.json.success === true) { onSuccess(phone); return; }
                    var msg = r.json && r.json.data && r.json.data.message;
                    showError(msg || 'ثبت درخواست انجام نشد. لطفاً دوباره تلاش کنید.');   // selections are kept
                })
                .catch(function () {
                    showError('ارتباط با سرور برقرار نشد. اتصال اینترنت را بررسی کنید و دوباره تلاش کنید.');
                })
                .then(function () { window.clearTimeout(timer); setLoading(false); });
        }

        function onSuccess(phone) {
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
});