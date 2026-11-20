
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
});