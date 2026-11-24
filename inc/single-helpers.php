<?php
/**
 * Single Article helpers.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

if (! function_exists('sarv_reading_time')) {
    /**
     * Estimate reading time in minutes.
     * 200 words/min — reasonable rate for Persian long-form.
     */
    function sarv_reading_time(?int $post_id = null): int
    {
        $post_id = $post_id ?: (int) get_the_ID();
        if (! $post_id) {
            return 1;
        }

        $content = (string) get_post_field('post_content', $post_id);
        if ($content === '') {
            return 1;
        }

        $content = strip_shortcodes($content);
        $content = wp_strip_all_tags($content);
        $content = trim(preg_replace('/\s+/u', ' ', $content) ?? $content);
        if ($content === '') {
            return 1;
        }

        // Unicode letter/number sequences — works for mixed Persian + Latin
        $count = preg_match_all('/[\p{L}\p{N}]+/u', $content);
        if (! is_int($count) || $count === 0) {
            return 1;
        }

        return max(1, (int) ceil($count / 200));
    }
}

if (! function_exists('sarv_build_toc')) {
    /**
     * Extract H2/H3 from rendered HTML, ensure stable unique IDs.
     *
     * IMPORTANT: apply to the output of the_content(), never to post_content,
     * so all WP filters and shortcodes run exactly once.
     *
     * @param string $html
     * @return array{html: string, toc: array<int, array{id:string, level:int, text:string}>}
     */
    function sarv_build_toc(string $html): array
    {
        if (trim($html) === '') {
            return ['html' => $html, 'toc' => []];
        }

        $toc      = [];
        $used_ids = [];
        $fallback = 0;

        $result = preg_replace_callback(
            '/<h([23])([^>]*)>(.*?)<\/h\1>/isu',
            static function (array $m) use (&$toc, &$used_ids, &$fallback): string {
                $level = (int) $m[1];
                $attrs = (string) $m[2];
                $inner = (string) $m[3];
                $text  = trim(wp_strip_all_tags($inner));

                if ($text === '') {
                    return $m[0];
                }

                $id = '';
                if (preg_match('/\bid\s*=\s*["\']([^"\']+)["\']/i', $attrs, $idm)) {
                    $id = $idm[1];
                }

                if ($id === '') {
                    $id = sanitize_title($text);
                    if ($id === '' || ctype_digit($id)) {
                        $fallback++;
                        $id = 'section-' . $fallback;
                    }
                    $base = $id;
                    $i    = 2;
                    while (in_array($id, $used_ids, true)) {
                        $id = $base . '-' . $i++;
                    }
                    $used_ids[] = $id;
                    $out        = '<h' . $level . $attrs . ' id="' . esc_attr($id) . '">' . $inner . '</h' . $level . '>';
                } else {
                    $used_ids[] = $id;
                    $out        = $m[0];
                }

                $toc[] = ['id' => $id, 'level' => $level, 'text' => $text];
                return $out;
            },
            $html
        );

        if (! is_string($result)) {
            return ['html' => $html, 'toc' => []];
        }

        return ['html' => $result, 'toc' => $toc];
    }
}

if (! function_exists('sarv_get_related_posts')) {
    /**
     * Same-category posts first, then newest fill-up. Max 2 queries.
     */
    function sarv_get_related_posts(int $post_id, int $limit = 3): WP_Query
    {
        $categories = wp_get_post_categories($post_id);

        $args = [
            'post_type'              => 'post',
            'post_status'            => 'publish',
            'post__not_in'           => [$post_id],
            'posts_per_page'         => $limit,
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'ignore_sticky_posts'    => true,
            'no_found_rows'          => true,
            'update_post_term_cache' => true,
        ];

        if (! empty($categories)) {
            $args['category__in'] = $categories;
        }

        $query = new WP_Query($args);

        if ($query->post_count >= $limit || $query->post_count === 0) {
            return $query;
        }

        $exclude_ids = array_merge([$post_id], wp_list_pluck($query->posts, 'ID'));

        $fallback = new WP_Query([
            'post_type'              => 'post',
            'post_status'            => 'publish',
            'post__not_in'           => $exclude_ids,
            'posts_per_page'         => $limit - $query->post_count,
            'orderby'                => 'date',
            'order'                  => 'DESC',
            'ignore_sticky_posts'    => true,
            'no_found_rows'          => true,
            'update_post_term_cache' => true,
        ]);

        if ($fallback->have_posts()) {
            $query->posts      = array_merge($query->posts, $fallback->posts);
            $query->post_count = count($query->posts);
        }

        return $query;
    }
}

if (! function_exists('sarv_cta_for_post')) {
    /**
     * Contextual CTA copy by category — conservative invitation language only.
     */
    function sarv_cta_for_post(int $post_id): array
    {
        $slugs = wp_get_post_categories($post_id, ['fields' => 'slugs']);

        $title = 'لبخند رویایی خود را با سرو بسازید';
        $text  = 'تیم متخصصین ما آماده ارائه مشاوره تخصصی و طراحی اختصاصی لبخند شما هستند.';

        if (in_array('implant', $slugs, true)) {
            $title = 'درباره ایمپلنت دندان سؤالی دارید؟';
            $text  = 'برای دریافت مشاوره تخصصی و بررسی وضعیت شما، با کلینیک سرو در تماس باشید.';
        } elseif (in_array('bleaching', $slugs, true)) {
            $title = 'به فکر روشن‌کردن لبخند خود هستید؟';
            $text  = 'برای مشاوره تخصصی و انتخاب روش مناسب، با کلینیک سرو در تماس باشید.';
        } elseif (in_array('composite', $slugs, true)) {
            $title = 'کامپوزیت مناسب لبخند شما کدام است؟';
            $text  = 'برای مشاوره تخصصی و طراحی اختصاصی لبخند، با کلینیک سرو در تماس باشید.';
        } elseif (in_array('laminate', $slugs, true)) {
            $title = 'لمینت را با طراحی اختصاصی تجربه کنید';
            $text  = 'برای مشاوره تخصصی و طراحی لبخند، با کلینیک سرو در تماس باشید.';
        }

        $contact_page = get_page_by_path('contact');
        $contact_url  = $contact_page ? get_permalink($contact_page->ID) : null;

        $phone       = get_theme_mod('sarv_phone_number', '');
        $phone_clean = $phone ? preg_replace('/[^0-9+]/', '', $phone) : '';

        return [
            'title'       => $title,
            'text'        => $text,
            'contact_url' => $contact_url,
            'phone'       => $phone,
            'phone_clean' => $phone_clean,
            'label'       => 'رزرو مشاوره',
        ];
    }
}
