<?php
/**
 * Composite service page helpers.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

/**
 * Split post_content into the 7 [section]...[/section] blocks.
 */
function sarv_composite_sections(int $page_id): array
{
    static $cache = [];
    if (isset($cache[$page_id])) return $cache[$page_id];

    $content = (string) get_post_field('post_content', $page_id);
    preg_match_all('/\[section\b[^\]]*\](.*?)\[\/section\]/is', $content, $m);
    return $cache[$page_id] = $m[1] ?? [];
}

/**
 * Parse shortcode attributes: key="value" or key='value'.
 */
function sarv_sc_attrs(string $attr_str): array
{
    $attrs = [];
    if (preg_match_all('/(\w+)\s*=\s*"([^"]*)"/i', $attr_str, $m, PREG_SET_ORDER)) {
        foreach ($m as $row) $attrs[$row[1]] = $row[2];
    }
    return $attrs;
}

/**
 * Hero data.
 */
function sarv_composite_hero(string $section): array
{
    $data = ['title' => '', 'subtitle' => '', 'intro' => '', 'button' => null, 'image_id' => 0];

    if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $section, $m)) {
        $title = wp_strip_all_tags($m[1]);
        $data['title'] = trim(preg_replace('/[\{\}]+/u', '', $title) ?? $title);
    }
    if (preg_match('/<span style="font-size:\s*110%;">(.*?)<\/span>/is', $section, $m)) {
        $data['subtitle'] = trim(wp_strip_all_tags($m[1]));
    }
    if (preg_match('/\[divider\b[^\]]*\]\s*(.*?)\s*\[button\b/i', $section, $m)) {
        $data['intro'] = trim(wp_strip_all_tags($m[1]));
    }
    if (preg_match('/\[button\s+([^\]]*)\]/i', $section, $m)) {
        $attrs = sarv_sc_attrs($m[1]);
        $data['button'] = [
            'text' => $attrs['text'] ?? 'مشاوره',
            'link' => $attrs['link'] ?? '#',
        ];
    }
    if (preg_match('/\[ux_image\s+[^\]]*id="(\d+)"/i', $section, $m)) {
        $data['image_id'] = (int) $m[1];
    }
    return $data;
}

/**
 * Stats: 4 numeric cards.
 */
function sarv_composite_stats(string $section): array
{
    preg_match_all('/\[ux_text\b[^\]]*\](.*?)\[\/ux_text\]/is', $section, $m, PREG_SET_ORDER);
    $out = [];
    foreach ($m as $match) {
        $html = $match[1];
        if (preg_match('/<span class="count-up">(\d+)<\/span>\s*([^\s<]+)<\/strong><\/span>\s*(.+?)$/us', trim($html), $v)) {
            $label = trim(preg_replace('/\s+/u', ' ', wp_strip_all_tags($v[3])) ?? '');
            $out[] = [
                'number' => $v[1],
                'suffix' => trim($v[2]),
                'label'  => $label,
            ];
        }
    }
    return $out;
}

/**
 * Process: 4 featured_box steps.
 */
function sarv_composite_process(string $section): array
{
    preg_match_all('/\[featured_box\s+([^\]]*)\](.*?)\[\/featured_box\]/is', $section, $m, PREG_SET_ORDER);
    $out = [];
    foreach ($m as $match) {
        $attrs = sarv_sc_attrs($match[1]);
        $inner = trim($match[2]);
        $title = '';
        $desc  = $inner;
        if (preg_match('/<h3[^>]*>(.*?)<\/h3>/is', $inner, $h3)) {
            $title = trim(wp_strip_all_tags($h3[1]));
            $desc  = trim(str_replace($h3[0], '', $inner));
        }
        $out[] = [
            'image_id'    => (int) ($attrs['img'] ?? 0),
            'title'       => $title,
            'description' => trim(wp_strip_all_tags($desc)),
        ];
    }
    return $out;
}

/**
 * Extract bafg shortcode IDs from a section.
 */
function sarv_composite_bafg_ids(string $section): array
{
    preg_match_all('/\[bafg\s+[^\]]*id="(\d+)"/i', $section, $m);
    return array_map('intval', $m[1] ?? []);
}

/**
 * Get before/after URLs from beaf_meta.
 */
function sarv_bafg_pair(int $bafg_id): ?array
{
    $raw = get_post_meta($bafg_id, 'beaf_meta', true);
    if (is_string($raw)) $raw = maybe_unserialize($raw);
    if (!is_array($raw)) return null;

    $before = (string) ($raw['bafg_before_image'] ?? '');
    $after  = (string) ($raw['bafg_after_image']  ?? '');
    if (!$before || !$after) return null;

    $localize = static function (string $url): string {
        return str_replace('https://sarvdental.clinic/', home_url('/'), $url);
    };

    return [
        'before'      => $localize($before),
        'after'       => $localize($after),
        'before_label'=> $raw['bafg_before_label'] ?? 'قبل',
        'after_label' => $raw['bafg_after_label']  ?? 'بعد',
    ];
}

/**
 * Extract unique Aparat hashes from script-based embeds in a section.
 */
function sarv_composite_videos(string $section): array
{
    preg_match_all('/aparat\.com\/embed\/([a-z0-9]+)/i', $section, $m);
    return array_values(array_unique($m[1] ?? []));
}

/**
 * Extract Gravity Forms ID.
 */
function sarv_composite_gravityform_id(string $section): int
{
    if (preg_match('/\[gravityform\s+[^\]]*id="(\d+)"/i', $section, $m)) {
        return (int) $m[1];
    }
    return 0;
}

/**
 * FAQ: parse accordion items.
 */
function sarv_composite_faq(string $section): array
{
    preg_match_all('/\[accordion-item\s+title="([^"]*)"\](.*?)\[\/accordion-item\]/is', $section, $m, PREG_SET_ORDER);
    $out = [];
    foreach ($m as $row) {
        $out[] = [
            'question' => html_entity_decode($row[1], ENT_QUOTES, 'UTF-8'),
            'answer'   => trim($row[2]),
        ];
    }
    return $out;
}

/**
 * Strip Flatsome wrapper shortcodes from a block of content.
 */
function sarv_composite_strip_wrappers(string $content): string
{
    $patterns = [
        '/\[section\b[^\]]*\]/i', '/\[\/section\]/i',
        '/\[row(?:_inner)?\b[^\]]*\]/i', '/\[\/row(?:_inner)?\]/i',
        '/\[col(?:_inner)?\b[^\]]*\]/i', '/\[\/col(?:_inner)?\]/i',
        '/\[ux_text\b[^\]]*\]/i', '/\[\/ux_text\]/i',
        '/\[gap\b[^\]]*\]/i',
        '/\[divider\b[^\]]*\]/i',
        '/\[ux_image\b[^\]]*\]/i',
        '/\[button\b[^\]]*\]/i',
        '/\[featured_box\b[^\]]*\]/i', '/\[\/featured_box\]/i',
        '/\[accordion\b[^\]]*\]/i', '/\[\/accordion\]/i',
        '/\[accordion-item\b[^\]]*\]/i', '/\[\/accordion-item\]/i',
        '/\[bafg\b[^\]]*\]/i',
    ];
    return preg_replace($patterns, '', $content);
}