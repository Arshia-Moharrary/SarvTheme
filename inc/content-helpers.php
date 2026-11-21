<?php
/**
 * Content helpers shared across templates.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

/**
 * Wrap every <table> in a scroll container so it never overflows the viewport.
 *
 * Call once per rendered HTML string. Content from the_content() is regenerated
 * each request, so no double-wrap concern.
 */
function sarv_wrap_tables(string $html): string
{
    if (stripos($html, '<table') === false) {
        return $html;
    }

    $result = preg_replace_callback(
        '/<table\b([^>]*)>(.*?)<\/table>/isu',
        static fn(array $m): string =>
            '<div class="sarv-table-wrap"><table' . $m[1] . '>' . $m[2] . '</table></div>',
        $html
    );

    return is_string($result) ? $result : $html;
}