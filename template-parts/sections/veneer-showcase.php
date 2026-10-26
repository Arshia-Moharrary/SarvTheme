<?php

/**
 * Veneer Showcase Section
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<section class="py-24 bg-warm-ivory relative overflow-hidden">
    <!-- المان تزئینی پس‌زمینه -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-champagne-gold opacity-[0.03] rounded-bl-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- هدر بخش -->
        <div class="text-center max-w-2xl mx-auto mb-16 reveal-up">
            <span class="text-champagne-gold font-bold text-body font-peyda tracking-wider uppercase mb-2 block">ویترین شاهکارها</span>
            <h2 class="text-h2 font-black text-deep-emerald font-peyda mb-4">نمونه‌کارهای لمینت دندان</h2>
            <p class="text-body-range text-charcoal/70 font-peyda leading-relaxed">
                با کشیدن دستگیره طلایی روی تصاویر، تفاوت شگفت‌انگیز طراحی لبخند را با جدیدترین تکنیک‌های لمینت سرامیکی مشاهده کنید.
            </p>
            <div class="w-24 h-1 bg-champagne-gold mx-auto mt-8 rounded-full"></div>
        </div>

        <!-- گرید نمونه‌کارها -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- کارت نمونه‌کار ۱ -->
            <div class="bg-white rounded-brand-lg p-4 shadow-sm border border-soft-stone/50 hover:shadow-xl transition-shadow duration-300 reveal-up delay-100">
                <div class="comparison-container group">
                    <!-- تصویر بعد (پس‌زمینه) -->
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/after-1.jpg'); ?>" alt="بعد از لمینت" onerror="this.src='https://placehold.co/600x450/C8A56A/FFFFFF?text=After'">

                    <!-- تصویر قبل (لایه رویی) -->
                    <div class="comparison-before" style="width: 50%;">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/before-1.jpg'); ?>" alt="قبل از لمینت" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/600x450/0E3B32/FFFFFF?text=Before'">
                    </div>

                    <!-- برچسب‌ها -->
                    <span class="comparison-badge badge-before">قبل</span>
                    <span class="comparison-badge badge-after">بعد</span>

                    <!-- دستگیره -->
                    <div class="comparison-handle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18m-4-4l4 4 4-4"></path>
                        </svg>
                    </div>

                    <!-- Input مخفی برای دسترسی‌پذیری -->
                    <input type="range" min="0" max="100" value="50" class="comparison-input" aria-label="مقایسه قبل و بعد از لمینت">
                </div>
                <div class="pt-6 pb-2 px-2 text-center">
                    <h3 class="text-h3 font-bold text-deep-emerald font-peyda mb-1">طراحی لبخند با ۸ لمینت</h3>
                    <p class="text-caption text-charcoal/60 font-peyda">تغییر رنگ و اصلاح فرم دندان‌ها</p>
                </div>
            </div>

            <!-- کارت نمونه‌کار ۲ (برای نمایش چیدمان گرید) -->
            <div class="bg-white rounded-brand-lg p-4 shadow-sm border border-soft-stone/50 hover:shadow-xl transition-shadow duration-300 reveal-up delay-200">
                <div class="comparison-container group">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/after-2.jpg'); ?>" alt="بعد از لمینت" onerror="this.src='https://placehold.co/600x450/C8A56A/FFFFFF?text=After'">
                    <div class="comparison-before" style="width: 50%;">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/before-2.jpg'); ?>" alt="قبل از لمینت" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/600x450/0E3B32/FFFFFF?text=Before'">
                    </div>
                    <span class="comparison-badge badge-before">قبل</span>
                    <span class="comparison-badge badge-after">بعد</span>
                    <div class="comparison-handle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18m-4-4l4 4 4-4"></path>
                        </svg>
                    </div>
                    <input type="range" min="0" max="100" value="50" class="comparison-input" aria-label="مقایسه قبل و بعد از لمینت">
                </div>
                <div class="pt-6 pb-2 px-2 text-center">
                    <h3 class="text-h3 font-bold text-deep-emerald font-peyda mb-1">بستن فاصله دندان‌ها</h3>
                    <p class="text-caption text-charcoal/60 font-peyda">با لمینت‌های نازک بدون تراش</p>
                </div>
            </div>

            <!-- کارت نمونه‌کار ۳ -->
            <div class="bg-white rounded-brand-lg p-4 shadow-sm border border-soft-stone/50 hover:shadow-xl transition-shadow duration-300 reveal-up delay-300">
                <div class="comparison-container group">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/after-3.jpg'); ?>" alt="بعد از لمینت" onerror="this.src='https://placehold.co/600x450/C8A56A/FFFFFF?text=After'">
                    <div class="comparison-before" style="width: 50%;">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/before-3.jpg'); ?>" alt="قبل از لمینت" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/600x450/0E3B32/FFFFFF?text=Before'">
                    </div>
                    <span class="comparison-badge badge-before">قبل</span>
                    <span class="comparison-badge badge-after">بعد</span>
                    <div class="comparison-handle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18m-4-4l4 4 4-4"></path>
                        </svg>
                    </div>
                    <input type="range" min="0" max="100" value="50" class="comparison-input" aria-label="مقایسه قبل و بعد از لمینت">
                </div>
                <div class="pt-6 pb-2 px-2 text-center">
                    <h3 class="text-h3 font-bold text-deep-emerald font-peyda mb-1">اصلاح دندان‌های نامرتب</h3>
                    <p class="text-caption text-charcoal/60 font-peyda">طراحی دیجیتال لبخند (DSD)</p>
                </div>
            </div>

        </div>
    </div>
</section>