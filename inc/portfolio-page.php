<?php
/**
 * Portfolio Page template override.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

if (! defined('SARV_PORTFOLIO_PER_PAGE')) {
    define('SARV_PORTFOLIO_PER_PAGE', 24);
}

add_filter('page_template', function (string $template): string {
    if (is_page('portfolio')) {
        $custom = get_template_directory() . '/page-portfolio.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }
    return $template;
});

/**
 * Disable canonical redirect for paginated portfolio queries.
 *
 * WordPress strips `?paged=N` on Pages, breaking pagination.
 */
add_filter('redirect_canonical', function ($redirect_url, $requested_url) {
    if (is_page('portfolio') && isset($_GET['paged'])) {
        return false;
    }
    return $redirect_url;
}, 10, 2);
