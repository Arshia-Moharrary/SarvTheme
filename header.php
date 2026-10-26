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

                                <!-- در اینجا کاربر تصویر لوگوی خود را با نسبت ۱:۱ قرار می‌دهد -->
                                <!-- Placeholder فعلی -->
                                <div class="w-full h-full bg-deep-emerald flex items-center justify-center group-hover:bg-forest-noir transition-colors duration-300">
                                    <span class="font-satoshi font-black text-h2 text-champagne-gold">S</span>
                                </div>

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

        <!-- منوی موبایل (Off-canvas) - در گام ۳ تکمیل می‌شود -->
        <div id="mobile-menu" class="fixed inset-0 bg-deep-emerald/95 z-40 hidden lg:hidden transition-opacity duration-300 opacity-0">
            <!-- محتوای منو در گام ۳ -->
        </div>

        <main id="primary" class="site-main flex-grow">