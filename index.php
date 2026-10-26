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
<section class="relative bg-deep-emerald text-warm-ivory pt-16 pb-48 lg:pt-22 lg:pb-56 rounded-t-[2.5rem] mx-4 md:mx-8 mt-4 overflow-hidden shadow-2xl z-10">

    <!-- پس‌زمینه تزئینی (پترن‌های صلیب) -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden select-none" aria-hidden="true">
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
                <h1 class="text-4xl md:text-5xl lg:text-hero font-black font-peyda leading-tight mb-6 reveal-up delay-100">
                    با <span class="text-champagne-gold">سرو</span> لبخندت رو زیبا کن
                </h1>

                <!-- زیرتیتر -->
                <p class="text-body-range text-warm-ivory/80 font-peyda leading-relaxed mb-10 max-w-xl mx-auto lg:mx-0 reveal-up delay-200">
                    در کلینیک سرو، ما لبخند شما را می‌سازیم! سال‌هاست چهره‌های شناخته‌شده، از فوتبالیست‌ها تا بازیگران، به ما اعتماد دارند. شما هم همین امروز وقت رزرو کنید و تجربه‌ای متفاوت داشته باشید.
                </p>

                <!-- دکمه‌ها (استفاده از کلاس‌های کامپوننت) -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 reveal-up delay-300">
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

            <!-- ستون تصویر و کارت‌های شناور -->
            <div class="relative w-full flex justify-center items-end mt-2 lg:mt-0">
                <div class="relative w-full max-w-md lg:max-w-full z-20 flex justify-center lg:justify-end reveal-up delay-400">
                    <!-- 
                        کاربر تصویر PNG خود را در مسیر قالب قرار می‌دهد.
                        فعلاً از یک تصویر Placeholder استفاده می‌کنیم تا ساختار مشخص باشد.
                    -->
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/src/images/doctors.png'); ?>"
                        alt="تیم پزشکان سرو"
                        class="w-full h-auto object-contain object-bottom drop-shadow-2xl"
                        onerror="this.src='https://placehold.co/600x600/transparent/0E3B32?text=Doctors+Image';">
                </div>

                <!-- کانتینر کارت‌های آماری -->
                <!-- در دسکتاپ absolute هستند، در موبایل به گرید تبدیل می‌شوند -->
                <div class="absolute top-0 -left-115 w-full h-full pointer-events-none hidden lg:block z-30">

                    <div class="absolute top-[10%] start-0 xl:start-10 pointer-events-auto reveal-fade delay-500">
                        <div class="animate-float-1">
                            <div class="stat-card">
                                <div class="w-12 h-12 rounded-full bg-warm-ivory flex items-center justify-center text-deep-emerald shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col text-start">
                                    <span class="text-h3 font-bold text-deep-emerald font-satoshi leading-none mb-1" dir="ltr">
                                        <?php echo esc_html(get_theme_mod('sarv_stat_1_number', '+۳۵۰')); ?>
                                    </span>
                                    <span class="text-caption text-charcoal/70 font-peyda">
                                        <?php echo esc_html(get_theme_mod('sarv_stat_1_label', 'پزشک فعال')); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-[40%] start-4 xl:start-16 pointer-events-auto reveal-fade delay-500">
                        <!-- کارت دوم -->
                        <div class="animate-float-2">
                            <div class="stat-card">
                                <div class="w-12 h-12 rounded-full bg-warm-ivory flex items-center justify-center text-champagne-gold shrink-0">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col text-start">
                                    <span class="text-h3 font-bold text-deep-emerald font-satoshi leading-none mb-1" dir="ltr">
                                        <?php echo esc_html(get_theme_mod('sarv_stat_2_number', '۹۸%')); ?>
                                    </span>
                                    <span class="text-caption text-charcoal/70 font-peyda">
                                        <?php echo esc_html(get_theme_mod('sarv_stat_2_label', 'رضایت کاربران')); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute top-[70%] start-0 xl:start-8 pointer-events-auto reveal-fade delay-500">
                        <!-- کارت سوم -->
                        <div class="animate-float-3">
                            <div class="stat-card">
                                <div class="w-12 h-12 rounded-full bg-warm-ivory flex items-center justify-center text-deep-emerald shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col text-start">
                                    <span class="text-h3 font-bold text-deep-emerald font-satoshi leading-none mb-1" dir="ltr">
                                        <?php echo esc_html(get_theme_mod('sarv_stat_3_number', '+100K')); ?>
                                    </span>
                                    <span class="text-caption text-charcoal/70 font-peyda">
                                        <?php echo esc_html(get_theme_mod('sarv_stat_3_label', 'نوبت رزرو شده')); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- کارت‌های موبایل (در صفحه‌های کوچک به صورت گرید در زیر تصویر نمایش داده می‌شوند) -->
                <div class="hidden lg:hidden w-full mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 reveal-up delay-400">
                    <!-- کارت اول موبایل -->
                    <div class="bg-white rounded-brand shadow-md p-4 flex items-center gap-3 border border-soft-stone/50">
                        <div class="w-10 h-10 rounded-full bg-warm-ivory flex items-center justify-center text-deep-emerald shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col text-start">
                            <span class="text-body font-bold text-deep-emerald font-satoshi leading-none mb-1" dir="ltr"><?php echo esc_html(get_theme_mod('sarv_stat_1_number', '+۳۵۰')); ?></span>
                            <span class="text-caption text-charcoal/70 font-peyda"><?php echo esc_html(get_theme_mod('sarv_stat_1_label', 'پزشک فعال')); ?></span>
                        </div>
                    </div>
                    <!-- کارت دوم موبایل -->
                    <div class="bg-white rounded-brand shadow-md p-4 flex items-center gap-3 border border-soft-stone/50">
                        <div class="w-10 h-10 rounded-full bg-warm-ivory flex items-center justify-center text-champagne-gold shrink-0">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col text-start">
                            <span class="text-body font-bold text-deep-emerald font-satoshi leading-none mb-1" dir="ltr"><?php echo esc_html(get_theme_mod('sarv_stat_2_number', '۹۸%')); ?></span>
                            <span class="text-caption text-charcoal/70 font-peyda"><?php echo esc_html(get_theme_mod('sarv_stat_2_label', 'رضایت کاربران')); ?></span>
                        </div>
                    </div>
                    <!-- کارت سوم موبایل -->
                    <div class="bg-white rounded-brand shadow-md p-4 flex items-center gap-3 border border-soft-stone/50">
                        <div class="w-10 h-10 rounded-full bg-warm-ivory flex items-center justify-center text-deep-emerald shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col text-start">
                            <span class="text-body font-bold text-deep-emerald font-satoshi leading-none mb-1" dir="ltr"><?php echo esc_html(get_theme_mod('sarv_stat_3_number', '+100K')); ?></span>
                            <span class="text-caption text-charcoal/70 font-peyda"><?php echo esc_html(get_theme_mod('sarv_stat_3_label', 'نوبت رزرو شده')); ?></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<?php
// فراخوانی کامپوننت نوار شناور پایینی
get_template_part('template-parts/hero/features');
?>

<!-- فراخوانی بخش نمونه‌کار لمینت -->
<?php
get_template_part('template-parts/sections/veneer-showcase');
?>

<!-- فراخوانی بخش درباره ما -->
<?php
get_template_part('template-parts/sections/about-section');
?>

<!-- فراخوانی بخش گارانتی و پالیش -->
<?php
get_template_part('template-parts/sections/guarantee-section');
?>

<?php
get_footer();
