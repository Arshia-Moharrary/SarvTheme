<?php

/**
 * The header for our theme
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-warm-ivory text-charcoal font-sans antialiased'); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site min-h-screen flex flex-col">
        <a class="skip-link screen-reader-text" href="#primary">
            <?php esc_html_e('پرش به محتوا', 'sarv'); ?>
        </a>

        <header id="masthead" class="site-header sticky top-0 z-50 w-full transition-all duration-300">

            <!-- ۱. نوار بالایی (Utility Bar) -->
            <div class="bg-warm-ivory border-b border-soft-stone hidden md:block">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-12">
                        <!-- سمت راست (شروع در RTL): شماره تماس -->
                        <div class="flex items-center text-caption font-peyda text-deep-emerald/80">
                            <?php
                            $phone = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
                            if (! empty($phone)) :
                            ?>
                                <svg class="w-4 h-4 me-2 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="me-2">پاسخگویی:</span>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="hover:text-champagne-gold transition-colors duration-300 font-medium" dir="ltr">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- سمت چپ (پایان در RTL): دکمه‌های ورود/ثبت‌نام -->
                        <div class="flex items-center gap-4 text-caption font-peyda">
                            <a href="<?php echo esc_url(wp_login_url()); ?>" class="text-deep-emerald hover:text-champagne-gold transition-colors duration-300">ورود</a>
                            <span class="text-soft-stone">|</span>
                            <a href="<?php echo esc_url(wp_registration_url()); ?>" class="text-deep-emerald hover:text-champagne-gold transition-colors duration-300">ثبت‌نام</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ۲. هدر اصلی (Main Nav) -->
            <div class="bg-warm-ivory/90 backdrop-blur-md shadow-sm border-b border-soft-stone/50 relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-20">

                        <!-- منوی سمت راست (در دسکتاپ) -->
                        <nav class="hidden lg:flex items-center gap-8 font-peyda text-body font-medium text-deep-emerald">
                            <?php
                            // منوی ناوبری اصلی
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container'      => false,
                                'menu_class'     => 'flex items-center gap-8',
                                'fallback_cb'    => 'sarv_nav_fallback',
                                'depth'          => 2,
                            ));
                            ?>
                        </nav>

                        <!-- دکمه منوی موبایل -->
                        <button id="mobile-menu-toggle" class="lg:hidden text-deep-emerald p-2" aria-label="باز کردن منو" aria-expanded="false" aria-controls="mobile-menu">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <!-- محل قرارگیری لوگو (Floating Overlap) -->
                        <div class="absolute left-1/2 -translate-x-1/2 bottom-0 translate-y-1/2 z-50">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="block w-20 h-20 md:w-28 md:h-28 rounded-full bg-white shadow-xl border-[6px] border-warm-ivory overflow-hidden flex items-center justify-center transition-transform duration-300 hover:scale-105 group">

                                <img class="w-full h-full object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/src/images/logo/logo.png'); ?>" alt="لوگوی کلینیک سرو">

                                <?php
                                // کد آماده برای زمانی که لوگوی واقعی در پیشخوان تنظیم شود:
                                // if ( has_custom_logo() ) {
                                //     the_custom_logo();
                                // }
                                ?>
                            </a>
                        </div>

                        <!-- منوی سمت چپ (دکمه CTA یا آیکون‌ها) -->
                        <div class="hidden lg:flex items-center gap-4 font-peyda">
                            <a href="#" class="bg-deep-emerald text-warm-ivory px-6 py-2.5 rounded-brand text-body font-medium hover:bg-forest-noir transition-colors duration-300 shadow-md">
                                رزرو نوبت
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </header>

        <!-- منوی موبایل (Off-canvas) -->
        <div id="mobile-menu" class="fixed inset-0 z-[60] hidden lg:hidden" aria-hidden="true">

            <!-- پس‌زمینه تاریک (Overlay) -->
            <div id="mobile-menu-overlay" class="absolute inset-0 bg-charcoal/60 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none"></div>

            <!-- پنل منو (از سمت راست باز می‌شود) -->
            <!-- در RTL، استارت (Start) معادل راست است -->
            <div id="mobile-menu-panel" class="absolute top-0 start-0 h-full w-[80%] max-w-sm bg-warm-ivory shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">

                <!-- هدر پنل موبایل -->
                <div class="flex items-center justify-between p-6 border-b border-soft-stone">
                    <span class="font-black text-h3 text-deep-emerald">کلینیک سرو</span>
                    <button id="mobile-menu-close" class="text-charcoal hover:text-champagne-gold p-2 transition-colors" aria-label="بستن منو">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- محتوای پنل موبایل -->
                <div class="flex-grow overflow-y-auto p-6 flex flex-col gap-8">

                    <!-- منوی ناوبری موبایل -->
                    <nav class="font-peyda text-body font-medium text-deep-emerald">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'flex flex-col gap-4',
                            'fallback_cb'    => 'sarv_nav_fallback_mobile', // تابع fallback اختصاصی موبایل
                            'depth'          => 2,
                        ));
                        ?>
                    </nav>

                    <!-- دکمه‌ها و شماره تماس در موبایل -->
                    <div class="mt-auto pt-6 border-t border-soft-stone flex flex-col gap-6">

                        <!-- شماره تماس در موبایل -->
                        <?php
                        $phone = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
                        if (! empty($phone)) :
                        ?>
                            <div class="flex items-center justify-center text-body font-peyda text-deep-emerald bg-soft-stone/30 py-3 rounded-brand">
                                <svg class="w-5 h-5 me-2 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="hover:text-champagne-gold transition-colors duration-300 font-bold" dir="ltr">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="flex items-center justify-between text-caption font-peyda">
                            <a href="<?php echo esc_url(wp_login_url()); ?>" class="text-deep-emerald hover:text-champagne-gold transition-colors">ورود</a>
                            <span class="text-soft-stone">|</span>
                            <a href="<?php echo esc_url(wp_registration_url()); ?>" class="text-deep-emerald hover:text-champagne-gold transition-colors">ثبت‌نام</a>
                        </div>

                        <a href="#" class="bg-deep-emerald text-warm-ivory text-center px-6 py-3 rounded-brand text-body font-bold hover:bg-forest-noir transition-colors duration-300 shadow-md w-full">
                            رزرو نوبت
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <main id="primary" class="site-main flex-grow">