<?php

/**
 * About — Hero
 *
 * Expected images: /src/images/about/hero-main.jpg (800×1000), hero-accent.jpg (600×600)
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$sarv_img = get_template_directory_uri() . '/src/images/about/';
?>

<section id="about-hero" aria-labelledby="about-hero-title"
    class="relative bg-warm-ivory pt-12 lg:pt-20 pb-20 lg:pb-28 overflow-hidden">

    <!-- Ambient light -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute -top-40 -end-40 w-96 h-96 rounded-full bg-champagne-gold/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -start-40 w-96 h-96 rounded-full bg-deep-emerald/5 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Breadcrumb -->
        <nav aria-label="مسیر صفحه" class="mb-10 lg:mb-14 reveal-fade">
            <ol class="flex items-center gap-2 text-caption font-peyda text-charcoal/60">
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                        class="hover:text-champagne-gold transition-colors duration-300">خانه</a>
                </li>
                <li aria-hidden="true" class="text-soft-stone">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </li>
                <li aria-current="page" class="text-deep-emerald font-bold">درباره ما</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-14 lg:gap-x-12 xl:gap-x-20 items-center">

            <!-- ── Text column ── -->
            <div class="lg:col-span-6 xl:col-span-7">
                <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                    <span class="w-10 h-px bg-champagne-gold"></span>
                    درباره کلینیک سرو
                </span>

                <h1 id="about-hero-title"
                    class="text-h2 sm:text-h1 lg:text-hero font-black font-peyda text-deep-emerald leading-[1.15] tracking-normal reveal-up delay-100">
                    ما لبخند را
                    <span class="relative inline-block text-champagne-gold">
                        هنر
                        <svg class="absolute -bottom-1 inset-x-0 w-full h-3 text-champagne-gold/40"
                            viewBox="0 0 100 8" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M2 6 Q 50 -2 98 6" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" />
                        </svg>
                    </span>
                    می‌دانیم
                </h1>

                <p class="mt-8 text-body-range text-charcoal/75 font-peyda leading-loose max-w-xl reveal-up delay-200">
                    از سال ۱۳۸۹، کلینیک تخصصی سرو در قلب تهران با تکیه بر دانش، دقت و درک عمیق از زیبایی،
                    لبخند هزاران بیمار را بازآفرینی کرده است. ما باور داریم هر لبخند، داستانی برای گفتن دارد.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-x-8 gap-y-4 reveal-up delay-300">
                    <a href="#our-story" class="btn btn-primary group">
                        داستان سرو را بخوانید
                        <svg class="w-4 h-4 ms-2 rtl:rotate-180 group-hover:-translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 7l5 5-5 5M6 12h12" />
                        </svg>
                    </a>
                    <!-- <a href="<?php echo esc_url(home_url('/contact')); ?>"
                        class="inline-flex items-center gap-3 text-body font-peyda font-bold text-deep-emerald hover:text-champagne-gold transition-colors duration-300 group">
                        <span>رزرو نوبت</span>
                        <span class="w-9 h-9 rounded-full border border-deep-emerald/20 group-hover:border-champagne-gold group-hover:bg-champagne-gold group-hover:text-deep-emerald flex items-center justify-center transition-all duration-300">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </a> -->
                </div>

                <!-- Inline trust stats -->
                <dl class="mt-12 grid grid-cols-3 gap-4 sm:gap-6 max-w-lg reveal-fade delay-400">
                    <div>
                        <dt class="text-h3 font-black text-deep-emerald font-peyda leading-none">
                            ۱۵<span class="text-champagne-gold">+</span>
                        </dt>
                        <dd class="mt-2 text-caption font-peyda text-charcoal/60 leading-tight">سال تجربه<br>تخصصی</dd>
                    </div>
                    <div class="border-s border-soft-stone/60 ps-4 sm:ps-6">
                        <dt class="text-h3 font-black text-deep-emerald font-peyda leading-none">
                            ۲۰,۰۰۰<span class="text-champagne-gold">+</span>
                        </dt>
                        <dd class="mt-2 text-caption font-peyda text-charcoal/60 leading-tight">بیمار<br>رضایتمند</dd>
                    </div>
                    <div class="border-s border-soft-stone/60 ps-4 sm:ps-6">
                        <dt class="text-h3 font-black text-deep-emerald font-peyda leading-none">۱۲</dt>
                        <dd class="mt-2 text-caption font-peyda text-charcoal/60 leading-tight">متخصص<br>برجسته</dd>
                    </div>
                </dl>
            </div>

            <!-- ── Image column ── -->
            <div class="lg:col-span-6 xl:col-span-5 relative reveal-up delay-200">
                <div class="relative max-w-md mx-auto lg:ms-auto lg:me-0">

                    <!-- Main portrait -->
                    <figure class="relative aspect-[4/5] rounded-brand-lg overflow-hidden shadow-2xl bg-deep-emerald">
                        <img src="<?php echo esc_url($sarv_img . 'hero-main.jpg'); ?>"
                            alt="فضای کلینیک تخصصی سرو"
                            class="w-full h-full object-contain"
                            width="800" height="1000"
                            loading="eager" decoding="async">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-noir/70 via-forest-noir/10 to-transparent"
                            aria-hidden="true"></div>

                        <figcaption class="absolute inset-x-5 bottom-5 flex items-center gap-3 text-warm-ivory">
                            <span class="w-10 h-10 rounded-full bg-champagne-gold text-deep-emerald flex items-center justify-center shrink-0 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                        d="M9 12l2 2 4-4m5.6-4.4A11.95 11.95 0 0112 2.944a11.95 11.95 0 01-8.6 3.656A12.02 12.02 0 003 12c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622a12.02 12.02 0 00-.4-3.4z" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-caption font-peyda text-warm-ivory/70 leading-tight">دارای پروانه رسمی</p>
                                <p class="text-body font-peyda font-bold leading-tight">وزارت بهداشت ایران</p>
                            </div>
                        </figcaption>
                    </figure>

                    <!-- Floating rating card -->
                    <div class="hidden sm:flex absolute -bottom-6 -end-4 lg:-end-8 stat-card animate-float-1">
                        <span class="w-10 h-10 rounded-full bg-champagne-gold/15 text-champagne-gold flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l2.9 6.9L22 9.6l-5.5 4.7 1.8 7.2L12 17.8 5.7 21.5l1.8-7.2L2 9.6l7.1-.7L12 2z" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-h4 font-black text-deep-emerald font-peyda leading-none">۴.۹</p>
                            <p class="text-caption font-peyda text-charcoal/60 mt-1">از ۱,۲۰۰ نظر</p>
                        </div>
                    </div>

                    <!-- Floating accent image -->
                    <div class="hidden lg:block absolute -top-6 -end-4 w-32 h-32 rounded-brand-lg overflow-hidden ring-4 ring-warm-ivory shadow-2xl bg-soft-stone animate-float-2">
                        <img src="<?php echo esc_url($sarv_img . 'hero-accent.png'); ?>"
                            alt="" class="w-full h-full object-cover"
                            width="600" height="600" loading="lazy" decoding="async">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>