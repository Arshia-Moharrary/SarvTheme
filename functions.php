<?php

/**
 * Sarv Theme Functions
 *
 * @package Sarv
 * @since 1.0.0
 */

declare(strict_types=1);

// جلوگیری از دسترسی مستقیم به فایل (امنیت)
if (! defined('ABSPATH')) {
    exit;
}

/**
 * راه‌اندازی قالب و افزودن قابلیت‌های پایه وردپرس
 */
function sarv_theme_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    register_nav_menus(array(
        'primary' => __('منوی اصلی (هدر)', 'sarv'),
        'footer'  => __('منوی فوتر', 'sarv'),
    ));
}
add_action('after_setup_theme', 'sarv_theme_setup');

/**
 * بارگذاری فایل‌های CSS و JS با استفاده از Vite
 */
function sarv_enqueue_assets(): void
{
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // بررسی اینکه آیا Vite در حالت Development (HMR) در حال اجراست یا خیر
    $vite_dev_server = 'http://localhost:5173';

    // بررسی وجود فایل manifest برای حالت Production
    $manifest_path = $theme_dir . '/dist/.vite/manifest.json';
    $is_dev = false;

    // استفاده از cURL یا فایل‌های سیستم برای تشخیص زنده بودن سرور Vite
    // روش ساده و مطمئن: بررسی فایل manifest. اگر وجود نداشت یعنی در حالت dev هستیم.
    // اما در محیط توسعه اگر هنوز بیلد نگرفته باشیم، باید به سرور متصل شویم.
    if (! file_exists($manifest_path)) {
        $is_dev = true;
    }

    if ($is_dev) {
        // ۱. حالت Development (HMR)
        // بارگذاری کلاینت Vite
        wp_enqueue_script('vite-client', $vite_dev_server . '/@vite/client', array(), null, true);

        // بارگذاری فایل اصلی JS
        wp_enqueue_script('sarv-main-js', $vite_dev_server . '/src/js/main.js', array(), null, true);

        // در حالت dev، استایل‌ها توسط JS تزریق می‌شوند، اما برای جلوگیری از FOUC (پرش استایل)، CSS را هم لود می‌کنیم
        wp_enqueue_style('sarv-app-css', $vite_dev_server . '/src/css/app.css', array(), null);

        // افزودن تایپ ماژول به اسکریپت‌های Vite
        add_filter('script_loader_tag', 'sarv_add_module_type', 10, 3);
    } else {
        // ۲. حالت Production (استفاده از فایل‌های Build شده)
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);

            // بارگذاری CSS
            if (isset($manifest['src/css/app.css'])) {
                $css_file = $manifest['src/css/app.css']['file'];
                wp_enqueue_style('sarv-app-css', $theme_uri . '/dist/' . $css_file, array(), null);
            }

            // بارگذاری JS
            if (isset($manifest['src/js/main.js'])) {
                $js_file = $manifest['src/js/main.js']['file'];
                wp_enqueue_script('sarv-main-js', $theme_uri . '/dist/' . $js_file, array(), null, true);

                // افزودن تایپ ماژول
                add_filter('script_loader_tag', 'sarv_add_module_type', 10, 3);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'sarv_enqueue_assets');

/**
 * افزودن ویژگی type="module" به اسکریپت‌های Vite
 * (وردپرس به طور پیش‌فرض این ویژگی را برای ES Modules اضافه نمی‌کند)
 */
function sarv_add_module_type(string $tag, string $handle, string $src): string
{
    if ('vite-client' === $handle || 'sarv-main-js' === $handle) {
        return '<script type="module" src="' . esc_url($src) . '"></script>' . "\n";
    }
    return $tag;
}

// حذف استایل پیش‌فرض قالب در صورت نیاز (چون از Tailwind استفاده می‌کنیم)
// در این مرحله نیازی نیست، اما در مراحل بعدی می‌توانیم style.css اصلی وردپرس را حذف کنیم.

/**
 * تحمیل ویژگی‌های زبان و جهت‌نویسی به تگ <html>
 * این تضمین می‌کند که سایت همیشه RTL باشد، حتی اگر زبان پیشخوان انگلیسی باشد.
 */
function sarv_force_rtl_language_attributes(string $output): string
{
    // در پیشخوان وردپرس دخالت نمی‌کنیم
    if (is_admin()) {
        return $output;
    }

    // تنظیم قطعی dir="rtl" و lang="fa-IR"
    return 'dir="rtl" lang="fa-IR"';
}
add_filter('language_attributes', 'sarv_force_rtl_language_attributes');

/**
 * افزودن تنظیمات هدر به سفارشی‌ساز وردپرس (Customizer)
 */
function sarv_customize_register(WP_Customize_Manager $wp_customize): void
{
    // افزودن یک بخش جدید برای تنظیمات هدر
    $wp_customize->add_section('sarv_header_settings', array(
        'title'    => __('تنظیمات هدر سرو', 'sarv'),
        'priority' => 30,
    ));

    // شماره تماس
    $wp_customize->add_setting('sarv_phone_number', array(
        'default'           => '۰۲۱-۱۲۳۴۵۶۷۸',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('sarv_phone_number', array(
        'label'       => __('شماره تماس (نوار بالا)', 'sarv'),
        'section'     => 'sarv_header_settings',
        'type'        => 'text',
        'description' => __('شماره تماس را وارد کنید. در صورت نیاز به لینک، از تگ‌های HTML استفاده نکنید، فقط شماره.', 'sarv'),
    ));
}
add_action('customize_register', 'sarv_customize_register');

/**
 * Fallback برای منو در صورت تنظیم نشدن در پیشخوان
 */
function sarv_nav_fallback(): void
{
?>
    <ul class="flex items-center gap-8">
        <li class="menu-item menu-item-has-children relative group">
            <a href="#" class="hover:text-champagne-gold transition-colors duration-300 flex items-center gap-1">
                خدمات
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </a>
            <!-- Submenu -->
            <ul class="absolute top-full start-0 mt-2 w-48 bg-warm-ivory border border-soft-stone rounded-brand shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0 z-50 p-2">
                <li><a href="#" class="block px-4 py-2 text-body hover:bg-soft-stone/50 rounded-md transition-colors">کامپوزیت</a></li>
                <li><a href="#" class="block px-4 py-2 text-body hover:bg-soft-stone/50 rounded-md transition-colors">لمینت</a></li>
                <li><a href="#" class="block px-4 py-2 text-body hover:bg-soft-stone/50 rounded-md transition-colors">ایمپلنت</a></li>
                <li><a href="#" class="block px-4 py-2 text-body hover:bg-soft-stone/50 rounded-md transition-colors">بلیچینگ</a></li>
            </ul>
        </li>
        <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">وبلاگ</a></li>
        <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">درباره ما</a></li>
    </ul>
<?php
}

/**
 * Fallback برای منوی موبایل
 */
function sarv_nav_fallback_mobile(): void
{
?>
    <ul class="flex flex-col gap-4">
        <li class="menu-item menu-item-has-children relative group">
            <div class="flex items-center justify-between cursor-pointer group">
                <a href="#" class="hover:text-champagne-gold transition-colors duration-300">خدمات</a>
                <!-- آیکون فلش برای موبایل -->
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
            <!-- Submenu موبایل -->
            <ul class="mt-3 ps-4 flex flex-col gap-2 border-s-2 border-soft-stone/50 text-charcoal/80">
                <li><a href="#" class="block py-1 hover:text-champagne-gold transition-colors">کامپوزیت</a></li>
                <li><a href="#" class="block py-1 hover:text-champagne-gold transition-colors">لمینت</a></li>
                <li><a href="#" class="block py-1 hover:text-champagne-gold transition-colors">ایمپلنت</a></li>
                <li><a href="#" class="block py-1 hover:text-champagne-gold transition-colors">بلیچینگ</a></li>
            </ul>
        </li>
        <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300 block py-2">وبلاگ</a></li>
        <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300 block py-2">درباره ما</a></li>
    </ul>
<?php
}
