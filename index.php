<?php

/**
 * The front page template file
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- =========================================
     Hero Section
     ========================================= -->
<section class="relative bg-deep-emerald text-warm-ivory pt-32 pb-48 lg:pt-40 lg:pb-56 rounded-t-[3rem] mx-2 md:mx-4 -mt-4 overflow-hidden shadow-2xl z-10">

    <!-- پس‌زمینه تزئینی (پترن‌های صلیب) -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden select-none">
        <!-- صلیب بزرگ سمت چپ (پایین) -->
        <svg class="absolute -bottom-10 -left-10 w-64 h-64 text-warm-ivory opacity-[0.03]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
        </svg>

        <!-- صلیب متوسط سمت راست (بالا) -->
        <svg class="absolute top-20 right-10 w-40 h-40 text-warm-ivory opacity-[0.03]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
        </svg>

        <!-- صلیب کوچک وسط -->
        <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 text-warm-ivory opacity-[0.02]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
        </svg>

        <!-- صلیب کوچک سمت چپ (بالا) -->
        <svg class="absolute top-32 left-1/4 w-20 h-20 text-champagne-gold opacity-[0.05]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- گرید اصلی: در موبایل تک ستونه، در دسکتاپ دو ستونه -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">

            <!-- ستون متن (در RTL سمت راست قرار می‌گیرد) -->
            <div class="text-center lg:text-start mt-8 lg:mt-0">
                <!-- تیتر اصلی -->
                <h1 class="text-4xl md:text-5xl lg:text-hero font-black font-peyda leading-tight mb-6">
                    نوبت دکتر رو <br class="hidden lg:block">
                    <span class="text-champagne-gold">سریع و مطمئن</span> بگیر
                </h1>

                <!-- زیرتیتر -->
                <p class="text-body-range text-warm-ivory/80 font-peyda leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0">
                    با چند کلیک ساده و سریع، پزشک معتبر پیدا کن، نوبت رزرو کن و از خدمات پزشکی مطمئن و حرفه‌ای در هر زمان و هر مکان استفاده کن.
                </p>

                <!-- دکمه‌ها (استفاده از کلاس‌های کامپوننت) -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="#" class="btn btn-primary w-full sm:w-auto">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        رزرو نوبت
                    </a>
                    <a href="#" class="btn btn-outline w-full sm:w-auto">
                        درباره ما
                    </a>
                </div>
            </div>

            <!-- ستون تصویر و کارت‌ها (در گام ۲ تکمیل می‌شود) -->
            <div class="relative h-[400px] lg:h-[600px] w-full flex justify-center items-end">
                <!-- این بخش در گام ۲ تکمیل خواهد شد -->
                <div class="text-warm-ivory/20 font-satoshi text-xl border-2 border-dashed border-warm-ivory/20 rounded-xl p-8 w-full h-full flex items-center justify-center">
                    محل قرارگیری تصویر پزشک و کارت‌های شناور (گام ۲)
                </div>
            </div>

        </div>
    </div>

    <!-- المان اسکرول به پایین (دکمه وسط) -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 z-30">
        <a href="#features" class="w-12 h-12 bg-deep-emerald border-4 border-warm-ivory rounded-full flex items-center justify-center shadow-lg text-champagne-gold hover:bg-champagne-gold hover:text-deep-emerald transition-colors duration-300 group" aria-label="اسکرول به پایین">
            <svg class="w-6 h-6 transform group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </a>
    </div>
</section>

<!-- فاصله برای نوار شناور پایینی -->
<div id="features" class="h-24 bg-warm-ivory"></div>

<?php
get_footer();
