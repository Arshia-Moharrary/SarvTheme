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

        <header id="masthead" class="site-header sticky top-0 z-50 w-full">

            <!-- ۰. خط طلایی بالای هدر (فقط دسکتاپ) -->
            <div class="hidden lg:block h-[2px] bg-champagne-gold" aria-hidden="true"></div>

            <!-- ۱. نوار بالایی (Utility Bar) — عمیق زمردی -->
            <div class="utility-bar hidden lg:block bg-deep-emerald text-warm-ivory/85">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-10 text-caption font-peyda">

                        <!-- سمت راست (شروع در RTL): تلفن + ساعات کاری -->
                        <div class="flex items-center gap-5">
                            <?php
                            $phone = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
                            if (! empty($phone)) :
                            ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="inline-flex items-center gap-2 hover:text-champagne-gold transition-colors duration-300">
                                    <svg class="w-3.5 h-3.5 text-champagne-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span dir="ltr" class="font-medium"><?php echo esc_html($phone); ?></span>
                                </a>
                            <?php endif; ?>

                            <span class="w-px h-3 bg-warm-ivory/20" aria-hidden="true"></span>

                            <span class="inline-flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-champagne-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>شنبه تا پنجشنبه، ۹ تا ۲۰</span>
                            </span>
                        </div>

                        <!-- سمت چپ (پایان در RTL): ورود / ثبت‌نام -->
                        <div class="flex items-center gap-4">
                            <a href="<?php echo esc_url(wp_login_url()); ?>" class="hover:text-champagne-gold transition-colors duration-300">ورود</a>
                            <span class="w-px h-3 bg-warm-ivory/20" aria-hidden="true"></span>
                            <a href="<?php echo esc_url(wp_registration_url()); ?>" class="hover:text-champagne-gold transition-colors duration-300">ثبت‌نام</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ۲. هدر اصلی (Main Nav) -->
            <div class="main-header-bar bg-warm-ivory/95 backdrop-blur-xl border-b border-soft-stone/60 relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="main-header-row flex items-center justify-between h-20 lg:h-24">

                        <!-- منوی ناوبری اصلی (دسکتاپ) -->
                        <nav class="desktop-nav hidden lg:flex items-center font-peyda text-body font-medium text-deep-emerald" aria-label="منوی اصلی">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container'      => false,
                                'menu_class'     => 'header-nav-menu flex items-center gap-7 xl:gap-9',
                                'fallback_cb'    => 'sarv_nav_fallback',
                                'depth'          => 2,
                            ));
                            ?>
                        </nav>

                        <!-- دکمه منوی موبایل (بدون تغییر در منطق) -->
                        <button id="mobile-menu-toggle" class="lg:hidden text-deep-emerald p-2" aria-label="باز کردن منو" aria-expanded="false" aria-controls="mobile-menu">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <!-- لوگو (شناور در مرکز، درز بین هدر و هیرو) -->
                        <div class="header-logo absolute left-1/2 -translate-x-1/2 bottom-0 translate-y-1/2 z-20">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="block" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                <div class="logo-badge w-20 h-20 lg:w-24 lg:h-24 xl:w-28 xl:h-28 rounded-full bg-white p-1 ring-1 ring-champagne-gold/40 shadow-[0_12px_32px_-8px_rgba(8,42,36,0.28)] hover:ring-champagne-gold hover:shadow-[0_16px_40px_-8px_rgba(8,42,36,0.36)] transition-all duration-500">
                                    <div class="w-full h-full rounded-full overflow-hidden bg-warm-ivory">
                                        <img class="w-full h-full object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/src/images/logo/logo3.jpg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                        <?php
                                        // when real logo is set in dashboard:
                                        // if ( has_custom_logo() ) { the_custom_logo(); }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- اکشن‌ها (دسکتاپ) -->
                        <div class="hidden lg:flex items-center gap-4 xl:gap-5">

                            <!-- شماره تماس (فقط xl) -->
                            <?php if (! empty($phone)) : ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="hidden xl:inline-flex items-center gap-2 text-deep-emerald hover:text-champagne-gold transition-colors duration-300 font-peyda text-caption font-semibold">
                                    <svg class="w-4 h-4 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span dir="ltr"><?php echo esc_html($phone); ?></span>
                                </a>
                            <?php endif; ?>

                            <!-- دکمه اصلی CTA -->
                            <a href="#" class="cta-btn group inline-flex items-center gap-3 bg-deep-emerald text-warm-ivory ps-5 pe-1.5 py-1.5 rounded-brand font-peyda font-bold text-body shadow-lg hover:bg-forest-noir hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                                <span>رزرو نوبت</span>
                                <span class="w-9 h-9 rounded-full bg-champagne-gold text-deep-emerald flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </header>

        <!-- ================================================================ -->
        <!-- منوی موبایل — کاملاً بدون تغییر (به‌عنوان کامپوننت تأییدشده) -->
        <!-- ================================================================ -->
        <div id="mobile-menu" class="fixed inset-0 z-[60] hidden lg:hidden" aria-hidden="true">

            <!-- پس‌زمینه تاریک (Overlay) -->
            <div id="mobile-menu-overlay" class="absolute inset-0 bg-charcoal/60 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none"></div>

            <!-- پنل منو (از سمت راست باز می‌شود) -->
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
                            'fallback_cb'    => 'sarv_nav_fallback_mobile',
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