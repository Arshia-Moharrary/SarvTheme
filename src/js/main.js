
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



    // ==========================================
    // Floating Contact Widget
    // ==========================================
    const floatingContact = document.getElementById('floating-contact');
    const fcToggle = document.getElementById('floating-contact-toggle');

    if (floatingContact && fcToggle) {
        fcToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = floatingContact.classList.toggle('is-open');
            fcToggle.setAttribute('aria-expanded', isOpen);
        });

        // Close when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (!floatingContact.contains(e.target) && floatingContact.classList.contains('is-open')) {
                floatingContact.classList.remove('is-open');
                fcToggle.setAttribute('aria-expanded', 'false');
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && floatingContact.classList.contains('is-open')) {
                floatingContact.classList.remove('is-open');
                fcToggle.setAttribute('aria-expanded', 'false');
                fcToggle.focus();
            }
        });
    }

    // ==========================================
    // Single Article — ToC Scroll-Spy
    // ==========================================
    const tocLinks = document.querySelectorAll('[data-sarv-toc-target]');
    const articleContent = document.querySelector('[data-sarv-article-content]');

    if (tocLinks.length && articleContent && 'IntersectionObserver' in window) {
        const linkMap = new Map();
        tocLinks.forEach(link => {
            const id = link.getAttribute('data-sarv-toc-target');
            if (id) linkMap.set(id, link);
        });

        const headings = Array.from(articleContent.querySelectorAll('h2[id], h3[id]'));

        if (headings.length) {
            let currentActive = null;
            const setActive = (id) => {
                if (currentActive) currentActive.classList.remove('is-active');
                const link = linkMap.get(id);
                if (link) {
                    link.classList.add('is-active');
                    currentActive = link;
                }
            };

            const spy = new IntersectionObserver((entries) => {
                const visible = entries
                    .filter(e => e.isIntersecting)
                    .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top);
                if (visible.length) setActive(visible[0].target.id);
            }, { rootMargin: '-100px 0px -60% 0px', threshold: 0 });

            headings.forEach(h => spy.observe(h));

            tocLinks.forEach(link => {
                link.addEventListener('click', () => {
                    setActive(link.getAttribute('data-sarv-toc-target'));
                });
            });
        }
    }

    // ==========================================
    // Single Article — Share
    // ==========================================
    document.querySelectorAll('[data-sarv-share]').forEach(shareRoot => {
        const copyBtn = shareRoot.querySelector('[data-sarv-share-copy]');
        const nativeBtn = shareRoot.querySelector('[data-sarv-share-native]');
        const toast = shareRoot.querySelector('[data-sarv-share-toast]');

        const showToast = (msg) => {
            if (!toast) return;
            toast.textContent = msg;
            toast.classList.add('is-visible');
            clearTimeout(showToast._t);
            showToast._t = setTimeout(() => toast.classList.remove('is-visible'), 2200);
        };

        const copyLink = async (url) => {
            try {
                if (navigator.clipboard && window.isSecureContext) {
                    await navigator.clipboard.writeText(url);
                } else {
                    const ta = document.createElement('textarea');
                    ta.value = url;
                    ta.setAttribute('readonly', '');
                    ta.style.cssText = 'position:fixed;opacity:0;';
                    document.body.appendChild(ta);
                    ta.select();
                    document.execCommand('copy');
                    document.body.removeChild(ta);
                }
                showToast('لینک کپی شد');
            } catch (e) {
                showToast('کپی ناموفق بود');
            }
        };

        if (copyBtn) {
            copyBtn.addEventListener('click', () => {
                copyLink(copyBtn.getAttribute('data-url') || window.location.href);
            });
        }

        if (nativeBtn && typeof navigator.share === 'function') {
            nativeBtn.hidden = false;
            nativeBtn.addEventListener('click', async () => {
                try {
                    await navigator.share({
                        title: nativeBtn.getAttribute('data-title') || document.title,
                        url: nativeBtn.getAttribute('data-url') || window.location.href,
                    });
                } catch (e) { /* user cancelled */ }
            });
        }
    });

    // ==========================================
    // Single Article — Reading Progress
    // ==========================================
    const readingProgress = document.querySelector('[data-sarv-reading-progress]');
    const readingProgressFill = readingProgress?.querySelector('.sarv-reading-progress__fill');
    const readingArticle = document.querySelector('[data-sarv-article-content]');

    if (readingProgress && readingProgressFill && readingArticle) {
        let progressTicking = false;

        const updateReadingProgress = () => {
            const rect = readingArticle.getBoundingClientRect();
            const articleHeight = rect.height;
            const viewportHeight = window.innerHeight;

            // Hide for very short articles — progress indicator is meaningless
            if (articleHeight < viewportHeight * 0.6) {
                readingProgress.hidden = true;
                progressTicking = false;
                return;
            }

            readingProgress.hidden = false;

            // Progress = 0 when article top reaches 80% of viewport,
            //            = 1 when article bottom reaches 20% of viewport.
            const startOffset = viewportHeight * 0.8;
            const endOffset = viewportHeight * 0.2;
            const readingDistance = articleHeight + startOffset - endOffset;
            const readSoFar = startOffset - rect.top;

            const progress = Math.max(0, Math.min(1, readSoFar / readingDistance));
            readingProgressFill.style.setProperty('--sarv-progress', progress.toFixed(3));
            progressTicking = false;
        };

        const onReadingScroll = () => {
            if (!progressTicking) {
                window.requestAnimationFrame(updateReadingProgress);
                progressTicking = true;
            }
        };

        window.addEventListener('scroll', onReadingScroll, { passive: true });
        window.addEventListener('resize', onReadingScroll, { passive: true });
        updateReadingProgress();
    }

    // ==========================================
    // Portfolio Lightbox
    // ==========================================
    const lbRoot = document.querySelector('[data-sarv-lightbox-root]');

    if (lbRoot && typeof lbRoot.showModal === 'function') {
        const dataEl = document.getElementById('sarv-portfolio-data');
        const lbImg = lbRoot.querySelector('[data-sarv-lightbox-img]');
        const lbPrev = lbRoot.querySelector('[data-sarv-lightbox-prev]');
        const lbNext = lbRoot.querySelector('[data-sarv-lightbox-next]');
        const lbClose = lbRoot.querySelector('[data-sarv-lightbox-close]');
        const lbCounter = lbRoot.querySelector('[data-sarv-lightbox-counter]');
        const lbStage = lbRoot.querySelector('[data-sarv-lightbox-stage]');

        let portfolioData = {};
        try {
            portfolioData = dataEl ? JSON.parse(dataEl.textContent.trim()) : {};
        } catch (e) {
            portfolioData = {};
        }

        let currentImages = [];
        let currentIndex = 0;
        let lastTrigger = null;
        let touchStartX = 0;
        let touchStartY = 0;

        const update = () => {
            const item = currentImages[currentIndex];
            if (!item) return;

            // Set srcset-friendly attributes. The `full` URL is used; WordPress
            // would normally add srcset, but since we're inside a JSON payload
            // (no HTML), we set the URL directly. Single high-quality source.
            lbImg.src = item.full;
            lbImg.alt = item.alt || '';
            lbCounter.textContent = (currentIndex + 1) + ' / ' + currentImages.length;

            lbPrev.disabled = currentIndex === 0;
            lbNext.disabled = currentIndex === currentImages.length - 1;

            // Preload adjacent
            [currentIndex - 1, currentIndex + 1].forEach(i => {
                const next = currentImages[i];
                if (next && next.full) {
                    const pre = new Image();
                    pre.src = next.full;
                }
            });
        };

        const open = (images, index, trigger) => {
            currentImages = images;
            currentIndex = index;
            lastTrigger = trigger;
            update();
            lbRoot.showModal();
            document.body.style.overflow = 'hidden';
        };

        const goNext = () => {
            if (currentIndex < currentImages.length - 1) {
                currentIndex++;
                update();
            }
        };

        const goPrev = () => {
            if (currentIndex > 0) {
                currentIndex--;
                update();
            }
        };

        // Wire triggers
        document.querySelectorAll('[data-sarv-lightbox]').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-post-id');
                const images = portfolioData[id];
                if (Array.isArray(images) && images.length) {
                    open(images, 0, btn);
                }
            });
        });

        // Controls
        lbClose.addEventListener('click', () => lbRoot.close());
        lbPrev.addEventListener('click', goPrev);
        lbNext.addEventListener('click', goNext);

        // Backdrop click — close when clicking on the dialog itself (not on children)
        lbRoot.addEventListener('click', (e) => {
            if (e.target === lbRoot) {
                lbRoot.close();
            }
        });

        // Keyboard — ArrowRight/Left
        lbRoot.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') { e.preventDefault(); goNext(); }
            if (e.key === 'ArrowLeft') { e.preventDefault(); goPrev(); }
        });

        // Touch swipe on stage
        lbStage.addEventListener('touchstart', (e) => {
            if (e.touches.length !== 1) return;
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }, { passive: true });

        lbStage.addEventListener('touchend', (e) => {
            if (!e.changedTouches.length) return;
            const dx = e.changedTouches[0].clientX - touchStartX;
            const dy = e.changedTouches[0].clientY - touchStartY;
            // Vertical swipe intent → ignore (don't hijack scrolling)
            if (Math.abs(dy) > Math.abs(dx) * 0.7) return;
            if (Math.abs(dx) < 50) return;
            if (dx < 0) goNext();
            else goPrev();
        }, { passive: true });

        // Restore scroll & focus on close
        lbRoot.addEventListener('close', () => {
            document.body.style.overflow = '';
            lbImg.src = '';
            lbImg.alt = '';
            currentImages = [];
            currentIndex = 0;
            if (lastTrigger && typeof lastTrigger.focus === 'function') {
                lastTrigger.focus();
            }
            lastTrigger = null;
        });
    }

    // ==========================================
    // Portfolio Load More
    // ==========================================
    const loadMoreBtn = document.querySelector('[data-sarv-load-more]');

    if (loadMoreBtn && typeof window.sarvPortfolio !== 'undefined') {
        let isLoading = false;
        const originalLabel = loadMoreBtn.querySelector('span').textContent;

        loadMoreBtn.addEventListener('click', async () => {
            if (isLoading) return;
            isLoading = true;

            const nextPage = parseInt(loadMoreBtn.dataset.page, 10) + 1;
            const totalPages = parseInt(loadMoreBtn.dataset.total, 10);
            const treatment = loadMoreBtn.dataset.treatment || '';

            loadMoreBtn.disabled = true;
            loadMoreBtn.classList.add('is-loading');
            loadMoreBtn.querySelector('span').textContent = 'در حال بارگذاری…';

            const form = new FormData();
            form.append('action', 'sarv_portfolio_load_more');
            form.append('nonce', window.sarvPortfolio.nonce);
            form.append('paged', nextPage);
            form.append('treatment', treatment);

            try {
                const res = await fetch(window.sarvPortfolio.ajaxUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: form,
                });
                const json = await res.json();

                if (!json.success) throw new Error('request_failed');

                appendPortfolioBatch(json.data.html);
                loadMoreBtn.dataset.page = nextPage;

                if (nextPage >= totalPages || !json.data.has_more) {
                    loadMoreBtn.closest('.sarv-load-more-wrap')?.remove();
                } else {
                    loadMoreBtn.disabled = false;
                    loadMoreBtn.classList.remove('is-loading');
                    loadMoreBtn.querySelector('span').textContent = originalLabel;
                }
            } catch (e) {
                loadMoreBtn.disabled = false;
                loadMoreBtn.classList.remove('is-loading');
                loadMoreBtn.querySelector('span').textContent = originalLabel;
            } finally {
                isLoading = false;
            }
        });

        function appendPortfolioBatch(html) {
            const container = document.querySelector('.sarv-portfolio-sections');
            if (!container) return;

            const temp = document.createElement('div');
            temp.innerHTML = html.trim();

            temp.querySelectorAll('[data-priority]').forEach(newSection => {
                const priority = newSection.dataset.priority;
                const existing = container.querySelector('[data-priority="' + priority + '"]');

                if (existing) {
                    const existingGrid = existing.querySelector('.sarv-portfolio-section__grid');
                    const newGrid = newSection.querySelector('.sarv-portfolio-section__grid');
                    if (existingGrid && newGrid) {
                        existingGrid.append(...newGrid.children);
                    }
                } else {
                    insertSectionInOrder(container, newSection);
                }
            });
        }

        function insertSectionInOrder(container, newSection) {
            const priority = parseInt(newSection.dataset.priority, 10);
            const sections = Array.from(container.querySelectorAll('[data-priority]'));
            const next = sections.find(s => parseInt(s.dataset.priority, 10) > priority);

            if (next) {
                container.insertBefore(newSection, next);
            } else {
                container.appendChild(newSection);
            }
        }
    }

    // ==========================================
    // Before / After Comparison Sliders
    // Scoped: [data-compare]. Multiple instances supported.
    // ==========================================
    (function initBeforeAfterComparison() {
        const frames = document.querySelectorAll('[data-compare]');
        if (!frames.length) return;

        const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
        const nf = new Intl.NumberFormat('fa-IR');

        frames.forEach((frame, idx) => {
            const handle = frame.querySelector('[data-handle]');
            if (!handle) return;

            const rtl = frame.classList.contains('veneer-compare--rtl');
            let x = 50;
            let raf = 0, nudgeRaf = 0, dragging = false, offset = 0, touched = false;

            function render() {
                raf = 0;
                frame.style.setProperty('--x', x.toFixed(2));
                const before = Math.round(rtl ? 100 - x : x);
                handle.setAttribute('aria-valuenow', before);
                handle.setAttribute('aria-valuetext', 'قبل ' + nf.format(before) + '٪ — بعد ' + nf.format(100 - before) + '٪');
            }
            function set(v) {
                x = Math.min(100, Math.max(0, v));
                if (!raf) raf = requestAnimationFrame(render);
            }
            function xFromEvent(e) {
                const r = frame.getBoundingClientRect();
                return ((e.clientX - r.left) / r.width) * 100;
            }
            function interacted() {
                touched = true;
                if (nudgeRaf) { cancelAnimationFrame(nudgeRaf); nudgeRaf = 0; }
            }

            frame.addEventListener('pointerdown', (e) => {
                if (e.pointerType === 'mouse' && e.button !== 0) return;
                const onHandle = !!e.target.closest('[data-handle]');
                if (e.pointerType !== 'mouse' && !onHandle) return;
                interacted();
                dragging = true;
                offset = onHandle ? xFromEvent(e) - x : 0;
                frame.setPointerCapture(e.pointerId);
                frame.classList.add('is-dragging');
                if (!onHandle) set(xFromEvent(e));
            });
            frame.addEventListener('pointermove', (e) => {
                if (dragging) set(xFromEvent(e) - offset);
            });
            function end(e) {
                if (!dragging) return;
                dragging = false;
                frame.classList.remove('is-dragging');
                try { frame.releasePointerCapture(e.pointerId); } catch (err) { }
            }
            frame.addEventListener('pointerup', end);
            frame.addEventListener('pointercancel', end);
            frame.addEventListener('dragstart', (e) => e.preventDefault());

            handle.addEventListener('keydown', (e) => {
                const step = e.shiftKey ? 10 : 2;
                let next = null;
                switch (e.key) {
                    case 'ArrowLeft': next = x - step; break;
                    case 'ArrowRight': next = x + step; break;
                    case 'ArrowUp': next = x + (rtl ? -step : step); break;
                    case 'ArrowDown': next = x - (rtl ? -step : step); break;
                    case 'PageUp': next = x + (rtl ? -10 : 10); break;
                    case 'PageDown': next = x - (rtl ? -10 : 10); break;
                    case 'Home': next = rtl ? 100 : 0; break;
                    case 'End': next = rtl ? 0 : 100; break;
                }
                if (next === null) return;
                e.preventDefault();
                interacted();
                set(next);
            });

            function nudge() {
                if (touched) return;
                const t0 = performance.now(), dur = 1400;
                (function tick(now) {
                    const t = Math.min(1, (now - t0) / dur);
                    set(50 + 12 * Math.sin(t * Math.PI * 2));
                    nudgeRaf = t < 1 ? requestAnimationFrame(tick) : 0;
                })(t0);
            }
            if (!reduce && 'IntersectionObserver' in window) {
                const io = new IntersectionObserver((entries) => {
                    if (!entries[0].isIntersecting) return;
                    io.disconnect();
                    setTimeout(nudge, 500 + idx * 250);
                }, { threshold: 0.7 });
                io.observe(frame);
            }

            render();
        });
    })();
});