<?php

/**
 * Hero Features Bar
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<!-- نوار شناور پایینی (Features Bar) -->
<section id="features" class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 lg:-mt-58 -mt-50 reveal-up delay-200">

    <!-- دکمه اسکرول مرکزی -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30">
        <a href="#next-section" class="w-12 h-12 bg-deep-emerald border-4 border-warm-ivory rounded-full flex items-center justify-center shadow-lg text-champagne-gold hover:bg-champagne-gold hover:text-deep-emerald transition-colors duration-300 group" aria-label="اسکرول به بخش بعدی">
            <svg class="w-6 h-6 transform group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </a>
    </div>

    <!-- کانتینر اصلی نوار -->
    <div class="bg-warm-ivory/95 backdrop-blur-md rounded-[2rem] shadow-2xl border border-soft-stone/50 px-6 py-8 md:py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-6 lg:gap-4 text-center">

            <!-- آیتم ۱: کامپوزیت -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7.2 3.8C5.1 3.8 3.8 5.5 3.8 8c0 2.1.8 4.1 1.5 6.2.7 2.2 1.1 5.8 2.7 5.8 1.2 0 1.4-2.8 2.1-4.4.4-.9 1.2-.9 1.6 0 .7 1.6.9 4.4 2.1 4.4 1.6 0 2-3.6 2.7-5.8C17.2 12.1 18 10.1 18 8c0-2.5-1.3-4.2-3.4-4.2-1.5 0-2 .8-3.4.8s-1.9-.8-4-.8Z" />
                        <path d="M11.5 5.1c1.3 0 2.1-.4 3.1-.7" />
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">کامپوزیت</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">روشی سریع و مقرون‌ به‌ صرفه برای زیباسازی و اصلاح ظاهر دندان‌ ها</p>
            </a>

            <!-- آیتم ۲: ایمپلنت -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7.5 3.5c-2.1 0-3.5 1.8-3.5 4.3 0 2.2.8 4.2 1.5 6.4.7 2.1 1.1 5.8 2.7 5.8 1.4 0 1.4-4.2 3.8-4.2s2.4 4.2 3.8 4.2c1.6 0 2-3.7 2.7-5.8C19.2 12 20 10 20 7.8c0-2.5-1.4-4.3-3.5-4.3-1.7 0-2.2.9-4.5.9s-2.8-.9-4.5-.9Z" />
                        <path d="M9.2 14.2h5.6" />
                        <path d="M10 14.2v5.2m4-5.2v5.2" />
                        <path d="M9.8 16.1h4.4m-4.4 1.7h4.4m-4.4 1.6h4.4" />
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">ایمپلنت</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">روش دائمی برای جایگزینی دندان با قرار دادن پین تیتانیومی در فک</p>
            </a>

            <!-- آیتم ۳: لمینت -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7.5 3.8C5.4 3.8 4 5.5 4 8c0 2.1.8 4.1 1.5 6.2.7 2.2 1.1 5.8 2.7 5.8 1.4 0 1.4-4.5 3.8-4.5s2.4 4.5 3.8 4.5c1.6 0 2-3.6 2.7-5.8C19.2 12.1 20 10.1 20 8c0-2.5-1.4-4.2-3.5-4.2-1.7 0-2.2.8-4.5.8s-2.8-.8-4.5-.8Z" />
                        <path d="M6.2 5.6c1.2-.4 2.4-.2 3.4.4" />
                        <path d="M6.2 5.6 8 11.2l2.2 2.1" />
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">لمینت</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">پوشش نازک سرامیکی برای اصلاح ظاهر دندان‌ ها با نتیجه‌ ای طبیعی و ماندگار</p>
            </a>

            <!-- آیتم ۴: بلیچینگ -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7.5 5C5.4 5 4 6.7 4 9.2c0 2.1.8 4.1 1.5 6.2.7 2.2 1.1 5.8 2.7 5.8 1.4 0 1.4-4.5 3.8-4.5s2.4 4.5 3.8 4.5c1.6 0 2-3.6 2.7-5.8.7-2.1 1.5-4.1 1.5-6.2C20 6.7 18.6 5 16.5 5c-1.7 0-2.2.8-4.5.8S9.2 5 7.5 5Z" />
                        <path d="M12 1.5v1.8m7-0.1-1 1m4 5h-1.8M5 3.2l1 1M2 8.2h1.8" />
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">بلیچینگ</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">روشی برای روشن‌ تر کردن رنگ دندان و داشتن لبخندی سفید و درخشان</p>
            </a>

        </div>
    </div>
</section>