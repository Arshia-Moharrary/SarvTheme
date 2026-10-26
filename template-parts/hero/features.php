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
<section id="features" class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 lg:-mt-58 -mt-50">

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

            <!-- آیتم ۱: نمایش مراکز درمانی -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">نمایش مراکز درمانی</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">مشاهده‌ی مشخصات، ساعات کاری و موقعیت دقیق مراکز درمانی</p>
            </a>

            <!-- آیتم ۲: مشاوره آنلاین پزشکی -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">مشاوره آنلاین پزشکی</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">با پزشکان منتخب به صورت چت یا تماس تصویری مشورت کنید</p>
            </a>

            <!-- آیتم ۳: جستجوی تخصص و پزشک -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">جستجوی تخصص و پزشک</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">پزشک مناسب خود را بر اساس تخصص به‌سرعت پیدا کنید</p>
            </a>

            <!-- آیتم ۴: نوبت‌دهی آنلاین پزشکان -->
            <a href="#" class="group flex flex-col items-center justify-start hover:-translate-y-1 transition-transform duration-300">
                <div class="lg:w-18 lg:h-18 md:w-16 lg:h-16 w-12 h-12 rounded-full bg-deep-emerald/5 text-deep-emerald flex items-center justify-center mb-4 group-hover:bg-deep-emerald group-hover:text-warm-ivory transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-body font-bold text-deep-emerald font-peyda mb-2">نوبت‌دهی آنلاین پزشکان</h3>
                <p class="text-caption text-charcoal/60 font-peyda leading-relaxed px-2">رزرو سریع و آسان نوبت پزشک مورد نظرتان فقط با چند کلیک</p>
            </a>

        </div>
    </div>
</section>