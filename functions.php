<?php
/**
 * Sarv Theme Functions
 *
 * @package Sarv
 * @since 1.0.0
 */

declare(strict_types=1);

// جلوگیری از دسترسی مستقیم به فایل (امنیت)
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * راه‌اندازی قالب و افزودن قابلیت‌های پایه وردپرس
 */
function sarv_theme_setup(): void {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
    ) );

    register_nav_menus( array(
        'primary' => __( 'منوی اصلی (هدر)', 'sarv' ),
        'footer'  => __( 'منوی فوتر', 'sarv' ),
    ) );
}
add_action( 'after_setup_theme', 'sarv_theme_setup' );

/**
 * بارگذاری فایل‌های CSS و JS با استفاده از Vite
 */
function sarv_enqueue_assets(): void {
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
    if ( ! file_exists( $manifest_path ) ) {
        $is_dev = true;
    }

    if ( $is_dev ) {
        // ۱. حالت Development (HMR)
        // بارگذاری کلاینت Vite
        wp_enqueue_script( 'vite-client', $vite_dev_server . '/@vite/client', array(), null, true );
        
        // بارگذاری فایل اصلی JS
        wp_enqueue_script( 'sarv-main-js', $vite_dev_server . '/src/js/main.js', array(), null, true );
        
        // در حالت dev، استایل‌ها توسط JS تزریق می‌شوند، اما برای جلوگیری از FOUC (پرش استایل)، CSS را هم لود می‌کنیم
        wp_enqueue_style( 'sarv-app-css', $vite_dev_server . '/src/css/app.css', array(), null );
        
        // افزودن تایپ ماژول به اسکریپت‌های Vite
        add_filter( 'script_loader_tag', 'sarv_add_module_type', 10, 3 );
    } else {
        // ۲. حالت Production (استفاده از فایل‌های Build شده)
        if ( file_exists( $manifest_path ) ) {
            $manifest = json_decode( file_get_contents( $manifest_path ), true );

            // بارگذاری CSS
            if ( isset( $manifest['src/css/app.css'] ) ) {
                $css_file = $manifest['src/css/app.css']['file'];
                wp_enqueue_style( 'sarv-app-css', $theme_uri . '/dist/' . $css_file, array(), null );
            }

            // بارگذاری JS
            if ( isset( $manifest['src/js/main.js'] ) ) {
                $js_file = $manifest['src/js/main.js']['file'];
                wp_enqueue_script( 'sarv-main-js', $theme_uri . '/dist/' . $js_file, array(), null, true );
                
                // افزودن تایپ ماژول
                add_filter( 'script_loader_tag', 'sarv_add_module_type', 10, 3 );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'sarv_enqueue_assets' );

/**
 * افزودن ویژگی type="module" به اسکریپت‌های Vite
 * (وردپرس به طور پیش‌فرض این ویژگی را برای ES Modules اضافه نمی‌کند)
 */
function sarv_add_module_type( string $tag, string $handle, string $src ): string {
    if ( 'vite-client' === $handle || 'sarv-main-js' === $handle ) {
        return '<script type="module" src="' . esc_url( $src ) . '"></script>' . "\n";
    }
    return $tag;
}

// حذف استایل پیش‌فرض قالب در صورت نیاز (چون از Tailwind استفاده می‌کنیم)
// در این مرحله نیازی نیست، اما در مراحل بعدی می‌توانیم style.css اصلی وردپرس را حذف کنیم.