<?php
/**
 * Blog helpers — date wrapper + search scope.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

/**
 * Archive date output.
 *
 * Wraps get_the_date() so that:
 *   1. Any active Persian-calendar plugin (WP-Parsidate, Persian Calendar, etc.)
 *      continues to filter get_the_date() and output Jalali dates.
 *   2. A theme-level filter (sarv_archive_date) can override if needed.
 *
 * Do not introduce a manual conversion — that would double-convert when a
 * plugin is already active.
 */
if (! function_exists('sarv_archive_date')) {
    function sarv_archive_date(string $format = ''): string {
        $date = (string) get_the_date($format);
        return (string) apply_filters('sarv_archive_date', $date, get_the_ID());
    }
}

/**
 * Restrict front-end search queries to posts only.
 *
 * The archive's search form submits to /?s=... which is handled by search.php.
 * Without this filter, WordPress would also return Pages, attachments, etc.
 */
add_action('pre_get_posts', static function ($query) {
    if (is_admin() || ! $query instanceof WP_Query || ! $query->is_main_query()) {
        return;
    }
    if (! $query->is_search()) {
        return;
    }
    $query->set('post_type', 'post');
});