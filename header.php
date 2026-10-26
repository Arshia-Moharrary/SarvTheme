<?php

/**
 * The header for our theme
 *
 * @package Sarv
 */

// جلوگیری از دسترسی مستقیم
if (! defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary">
            <?php esc_html_e('پرش به محتوا', 'sarv'); ?>
        </a>

        <header id="masthead" class="site-header">
            <!-- محتوای هدر در مرحله بعدی UI پیاده‌سازی می‌شود -->
            <div class="site-branding">
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
            </div>
        </header>

        <main id="primary" class="site-main">