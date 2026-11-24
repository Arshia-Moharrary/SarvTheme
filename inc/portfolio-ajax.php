<?php
/**
 * Portfolio AJAX load-more handler.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

add_action('wp_ajax_sarv_portfolio_load_more', 'sarv_portfolio_ajax_load_more');
add_action('wp_ajax_nopriv_sarv_portfolio_load_more', 'sarv_portfolio_ajax_load_more');

function sarv_portfolio_ajax_load_more(): void
{
    check_ajax_referer('sarv_portfolio_load_more', 'nonce');

    $paged     = isset($_POST['paged']) ? max(2, (int) $_POST['paged']) : 2;
    $treatment = isset($_POST['treatment']) ? sanitize_title(wp_unslash($_POST['treatment'])) : '';

    if ($treatment !== '' && ! term_exists($treatment, 'sarv_treatment')) {
        $treatment = '';
    }

    $args = [
        'post_type'      => 'sarv_portfolio',
        'post_status'    => 'publish',
        'posts_per_page' => SARV_PORTFOLIO_PER_PAGE,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    if ($treatment !== '') {
        $args['tax_query'] = [[
            'taxonomy' => 'sarv_treatment',
            'field'    => 'slug',
            'terms'    => $treatment,
        ]];
    }

    $query = new WP_Query($args);

    if (! $query->have_posts()) {
        wp_send_json_success(['html' => '', 'has_more' => false]);
    }

    ob_start();
    get_template_part('template-parts/portfolio/grid', null, ['query' => $query]);
    $html = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success([
        'html'     => $html,
        'has_more' => $paged < (int) $query->max_num_pages,
    ]);
}
