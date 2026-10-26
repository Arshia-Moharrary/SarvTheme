<?php

/**
 * About Us Section
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<section id="about" class="py-24 bg-warm-ivory relative overflow-hidden">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- هدر بخش (تیتر، خط و دکمه) -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-16 reveal-up">

            <!-- سمت راست (تیتر و زیرتیتر) در RTL -->
            <div class="flex flex-col items-start">
                <div class="flex items-center gap-3 mb-2">
                    <!-- آیکون تزئینی -->
                    <svg class="w-6 h-6 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    <h2 class="text-h2 font-black text-deep-emerald font-peyda">درباره ما بیشتر بدانید!</h2>
                </div>
                <p class="text-body text-charcoal/60 font-peyda ms-9">کیفیت، اعتماد، آرامش در درمان</p>
            </div>

            <!-- خط جداکننده (فقط در دسکتاپ نمایش داده می‌شود) -->
            <div class="hidden lg:block flex-grow h-px bg-soft-stone mx-8"></div>

            <!-- سمت چپ (دکمه) در RTL -->
            <div class="flex items-center">
                <a href="#" class="group flex items-center gap-3 bg-deep-emerald text-warm-ivory px-6 py-3 rounded-full text-body font-bold font-peyda hover:bg-champagne-gold hover:text-deep-emerald transition-all duration-300 shadow-md">
                    <span>درباره ما</span>
                    <!-- آیکون فلش که در حالت هاور به سمت چپ (استارت) حرکت می‌کند -->
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>

        </div>

        <!-- محتوای اصلی (در گام‌های بعدی تکمیل می‌شود) -->
        <!-- محتوای اصلی (دو ستونه) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

            <!-- ستون راست: متن، نقل‌قول و آمار (۷ ستون از ۱۲) -->
            <div class="lg:col-span-7 flex flex-col gap-8 reveal-up delay-100">

                <!-- پاراگراف اصلی -->
                <p class="lg:px-0 px-4 text-body-range text-charcoal/80 leading-relaxed font-peyda text-justify">
                    در دکتر سرو همه چیز حول محور سه اصل ساخته شده است: <strong class="text-deep-emerald font-bold">اعتماد، کیفیت و سهولت دسترسی</strong>. ما با همکاری پزشکان متخصص و معتبر، سیستم زمان‌بندی هوشمند، امکان ویزیت حضوری، آنلاین و حتی ویزیت در محل، سعی کرده‌ایم خدمات پزشکی را به سطحی جدید و واقعی از استانداردهای دیجیتال برسانیم.
                </p>

                <!-- نقل‌قول (Blockquote) -->
                <div class="relative ps-6 py-2 my-2">
                    <!-- خط عمودی سمت راست (در RTL) -->
                    <div class="absolute top-0 bottom-0 start-0 w-1 bg-champagne-gold rounded-full"></div>
                    <h3 class="text-h3 font-bold text-deep-emerald font-peyda mb-2">هدف اصلی ما</h3>
                    <p class="text-body text-charcoal/70 font-peyda leading-relaxed">
                        هدف ما ارائه تجربه‌ای راحت، سریع و مطمئن در دسترسی به خدمات پزشکی است.
                    </p>
                </div>

                <!-- گرید کارت‌های آماری -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">

                    <!-- کارت ۱ -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-brand p-5 flex flex-col items-center text-center border border-soft-stone/40 hover:bg-white transition-colors duration-300">
                        <div class="text-champagne-gold mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-h3 font-black text-deep-emerald font-satoshi mb-1" dir="ltr">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_1_number', '+۵K')); ?>
                        </span>
                        <span class="text-caption text-charcoal/60 font-peyda">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_1_label', 'رزرو موفق')); ?>
                        </span>
                    </div>

                    <!-- کارت ۲ -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-brand p-5 flex flex-col items-center text-center border border-soft-stone/40 hover:bg-white transition-colors duration-300">
                        <div class="text-champagne-gold mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <span class="text-h3 font-black text-deep-emerald font-satoshi mb-1" dir="ltr">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_2_number', '+۵۰K')); ?>
                        </span>
                        <span class="text-caption text-charcoal/60 font-peyda">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_2_label', 'رضایت کاربران')); ?>
                        </span>
                    </div>

                    <!-- کارت ۳ -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-brand p-5 flex flex-col items-center text-center border border-soft-stone/40 hover:bg-white transition-colors duration-300">
                        <div class="text-champagne-gold mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <span class="text-h3 font-black text-deep-emerald font-satoshi mb-1" dir="ltr">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_3_number', '+۱۵')); ?>
                        </span>
                        <span class="text-caption text-charcoal/60 font-peyda">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_3_label', 'سال سابقه پزشکی')); ?>
                        </span>
                    </div>

                    <!-- کارت ۴ -->
                    <div class="bg-white/60 backdrop-blur-sm rounded-brand p-5 flex flex-col items-center text-center border border-soft-stone/40 hover:bg-white transition-colors duration-300">
                        <div class="text-champagne-gold mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="text-h3 font-black text-deep-emerald font-satoshi mb-1" dir="ltr">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_4_number', '+۲۵۰')); ?>
                        </span>
                        <span class="text-caption text-charcoal/60 font-peyda">
                            <?php echo esc_html(get_theme_mod('sarv_about_stat_4_label', 'پزشک فعال')); ?>
                        </span>
                    </div>

                </div>

            </div>

            <!-- ستون چپ: تصویر (۵ ستون از ۱۲) -->
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end mt-16 lg:mt-0 reveal-up delay-300">

                <!-- کانتینر تصویر -->
                <div class="relative w-full max-w-md mx-auto lg:mx-0 group">

                    <!-- 
                        محل قرارگیری تصویر پزشکان. 
                        کاربر می‌تواند تصویر خود را با نام about-doctors.png در این مسیر قرار دهد.
                    -->
                    <div class="aspect-[4/5] w-full rounded-[2.5rem] overflow-hidden shadow-2xl relative z-10 bg-soft-stone/20">
                        <img
                            src="<?php echo esc_url(get_template_directory_uri() . '/src/images/about.png'); ?>"
                            alt="تیم پزشکان متخصص سرو"
                            class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105"
                            loading="lazy"
                            onerror="this.src='https://placehold.co/600x800/F6F3EC/0E3B32?text=Doctors+Image';">
                    </div>

                    <!-- باکس شناور شماره تماس (Phone Badge) -->
                    <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 z-20 bg-white rounded-full px-6 py-3 md:px-8 md:py-4 shadow-[0_15px_40px_-10px_rgba(14,59,50,0.2)] border border-soft-stone/50 flex flex-col items-center justify-center min-w-[280px]">

                        <?php
                        // خواندن شماره تماس از تنظیمات هدر (Customizer)
                        $phone = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
                        if (! empty($phone)) :
                        ?>
                            <div class="flex items-center gap-2 mb-1">
                                <!-- آیکون تلفن طلایی -->
                                <svg class="w-5 h-5 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>

                                <!-- لینک تماس (جهت اعداد ltr است تا خوانایی حفظ شود) -->
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="hover:text-champagne-gold transition-colors duration-300 font-bold" dir="ltr">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <!-- متن راهنما -->
                        <span class="text-caption text-charcoal/60 font-peyda tracking-wide">منتظر تماس شما هستیم</span>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>