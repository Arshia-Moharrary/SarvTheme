<?php

/**
 * The main template file (Temporary Design System Test)
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="p-10 bg-warm-ivory min-h-screen font-sans">
    <div class="max-w-4xl mx-auto space-y-8">

        <div class="p-6 bg-white rounded-brand shadow-sm border border-soft-stone">
            <h2 class="text-h3 font-bold text-deep-emerald mb-4">رنگ‌های برند (Colors)</h2>
            <div class="flex flex-wrap gap-4">
                <div class="w-24 h-24 bg-deep-emerald rounded-brand flex items-center justify-center text-white text-xs">Deep Emerald</div>
                <div class="w-24 h-24 bg-champagne-gold rounded-brand flex items-center justify-center text-white text-xs">Champagne Gold</div>
                <div class="w-24 h-24 bg-forest-noir rounded-brand flex items-center justify-center text-white text-xs">Forest Noir</div>
                <div class="w-24 h-24 bg-charcoal rounded-brand flex items-center justify-center text-white text-xs">Charcoal</div>
                <div class="w-24 h-24 bg-soft-stone rounded-brand flex items-center justify-center text-deep-emerald text-xs">Soft Stone</div>
                <div class="w-24 h-24 bg-warm-ivory border border-soft-stone rounded-brand flex items-center justify-center text-deep-emerald text-xs">Warm Ivory</div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-brand shadow-sm border border-soft-stone space-y-4">
            <h2 class="text-h3 font-bold text-deep-emerald mb-4">مقیاس تایپوگرافی (Typography Scale)</h2>

            <div class="border-b border-soft-stone pb-2">
                <span class="text-caption text-gray-500 block mb-1">Display / Hero (64px) - Weight: 900</span>
                <p class="text-hero font-black text-deep-emerald font-peyda">طراحی لبخند پرمیوم</p>
            </div>

            <div class="border-b border-soft-stone pb-2">
                <span class="text-caption text-gray-500 block mb-1">H1 (48px) - Weight: 700</span>
                <p class="text-h1 font-bold text-deep-emerald font-peyda">کلینیک تخصصی دندانپزشکی سرو</p>
            </div>

            <div class="border-b border-soft-stone pb-2">
                <span class="text-caption text-gray-500 block mb-1">H2 (36px) - Weight: 600</span>
                <p class="text-h2 font-semibold text-deep-emerald font-peyda">زیبایی و سلامت در یک نگاه</p>
            </div>

            <div class="border-b border-soft-stone pb-2">
                <span class="text-caption text-gray-500 block mb-1">H3 (26px) - Weight: 500</span>
                <p class="text-h3 font-medium text-deep-emerald font-peyda">خدمات تخصصی ایمپلنت</p>
            </div>

            <div class="border-b border-soft-stone pb-2">
                <span class="text-caption text-gray-500 block mb-1">Body Range (20px) - Weight: 400</span>
                <p class="text-body-range font-normal text-charcoal font-peyda">ما با بهره‌گیری از جدیدترین تکنولوژی‌های روز دنیا، لبخندی ماندگار را برای شما به ارمغان می‌آوریم.</p>
            </div>

            <div class="border-b border-soft-stone pb-2">
                <span class="text-caption text-gray-500 block mb-1">Body (16px) - Weight: 400</span>
                <p class="text-body font-normal text-charcoal font-peyda">تیم متخصص ما آماده ارائه مشاوره و انجام کلیه خدمات دندانپزشکی اعم از لمینت، کامپوزیت و ارتودنسی به شما عزیزان است.</p>
            </div>

            <div>
                <span class="text-caption text-gray-500 block mb-1">Caption / Label (12px) - Weight: 400</span>
                <p class="text-caption font-normal text-charcoal font-peyda">کلیه حقوق مادی و معنوی این وب‌سایت متعلق به کلینیک سرو می‌باشد.</p>
            </div>
        </div>

        <div class="p-6 bg-white rounded-brand shadow-sm border border-soft-stone">
            <h2 class="text-h3 font-bold text-deep-emerald mb-4">تست فونت لاتین (Satoshi)</h2>
            <p class="text-h1 font-bold text-deep-emerald font-satoshi">Premium Smile Design</p>
            <p class="text-body-range font-normal text-charcoal font-satoshi mt-2">Sarv Dental is dedicated to providing the highest quality of aesthetic dentistry.</p>
        </div>

    </div>
</section>

<?php
get_footer();
