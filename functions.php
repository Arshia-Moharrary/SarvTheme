<?php

/**
 * Sarv Theme Functions
 *
 * @package Sarv
 * @since 1.0.0
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

/**
 * راه‌اندازی قالب و افزودن قابلیت‌های پایه وردپرس
 */
function sarv_theme_setup(): void
{
    // افزودن پشتیبانی از تگ Title داینامیک
    add_theme_support('title-tag');

    // افزودن پشتیبانی از تصویر شاخص (Thumbnails)
    add_theme_support('post-thumbnails');

    // خروجی HTML5 برای فرم‌ها و گالری‌ها
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // ثبت منوهای ناوبری (برای مراحل بعدی UI)
    register_nav_menus(array(
        'primary' => __('منوی اصلی (هدر)', 'sarv'),
        'footer'  => __('منوی فوتر', 'sarv'),
    ));
}
add_action('after_setup_theme', 'sarv_theme_setup');
