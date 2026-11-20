<?php
/**
 * Bleaching service page routing.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

add_filter('page_template', function (string $template): string {
    if (is_page('services/bleaching')) {
        $custom = get_template_directory() . '/page-bleaching.php';
        if (file_exists($custom)) return $custom;
    }
    return $template;
});