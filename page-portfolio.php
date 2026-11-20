<?php
/**
 * Portfolio Page template.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

get_header();

$page_id = (int) get_the_ID();

/* ---------- Filter ---------- */
$treatment_slug = '';
if (isset($_GET['treatment'])) {
    $candidate = sanitize_title(wp_unslash($_GET['treatment']));
    if ($candidate !== '' && term_exists($candidate, 'sarv_treatment')) {
        $treatment_slug = $candidate;
    }
}

/* ---------- Pagination ---------- */
$paged = isset($_GET['paged']) ? max(1, (int) $_GET['paged']) : 1;
$per_page = SARV_PORTFOLIO_PER_PAGE;

/* ---------- Query ---------- */
$args = [
    'post_type'      => 'sarv_portfolio',
    'post_status'    => 'publish',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
];

if ($treatment_slug) {
    $args['tax_query'] = [[
        'taxonomy' => 'sarv_treatment',
        'field'    => 'slug',
        'terms'    => $treatment_slug,
    ]];
}

$query = new WP_Query($args);

/* ---------- Terms ---------- */
$terms = get_terms([
    'taxonomy'   => 'sarv_treatment',
    'hide_empty' => true, // only show categories that have items
]);

$total_all = (int) wp_count_posts('sarv_portfolio')->publish;

/* ---------- Lightbox data (single JSON, no per-item duplication) ---------- */
$portfolio_data = [];
if ($query->have_posts()) {
    foreach ($query->posts as $post_obj) {
        $images = sarv_get_portfolio_images((int) $post_obj->ID);
        if (empty($images)) continue;

        $items = [];
        foreach ($images as $img) {
            $items[] = [
                'full'  => wp_get_attachment_image_url($img->ID, 'full') ?: '',
                'thumb' => wp_get_attachment_image_url($img->ID, 'large') ?: '',
                'alt'   => get_post_meta($img->ID, '_wp_attachment_image_alt', true) ?: get_the_title($post_obj),
                'type'  => sarv_get_image_type((int) $img->ID),
            ];
        }
        $portfolio_data[(string) $post_obj->ID] = $items;
    }
    wp_reset_postdata();
}
?>

<div class="bg-warm-ivory sarv-portfolio-page">

    <?php get_template_part('template-parts/portfolio/hero', null, [
        'total_all' => $total_all,
    ]); ?>

    <section class="pb-20 md:pb-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <?php get_template_part('template-parts/portfolio/filter-nav', null, [
                'terms'        => $terms,
                'current_slug' => $treatment_slug,
                'total_all'    => $total_all,
            ]); ?>

            <?php if ($query->have_posts()) : ?>

                <?php get_template_part('template-parts/portfolio/grid', null, [
                    'query' => $query,
                ]); ?>

                <?php get_template_part('template-parts/portfolio/load-more', null, [
                    'paged'          => $paged,
                    'max_pages'      => (int) $query->max_num_pages,
                    'treatment_slug' => $treatment_slug,
                ]); ?>

            <?php else : ?>

                <?php get_template_part('template-parts/portfolio/empty', null, [
                    'has_filter' => (bool) $treatment_slug,
                ]); ?>

            <?php endif; ?>

        </div>
    </section>

    <script type="application/json" id="sarv-portfolio-data"><?php
        echo wp_json_encode($portfolio_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    ?></script>

    <!-- ========================================== -->
    <!-- Lightbox -->
    <!-- ========================================== -->
    <dialog class="sarv-lightbox" data-sarv-lightbox-root aria-label="نمایش تصویر">
        <button type="button" class="sarv-lightbox__close" data-sarv-lightbox-close aria-label="بستن">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <button type="button" class="sarv-lightbox__nav sarv-lightbox__nav--prev" data-sarv-lightbox-prev aria-label="تصویر قبلی">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo is_rtl() ? 'M15 19l-7-7 7-7' : 'M9 5l7 7-7 7'; ?>"/>
            </svg>
        </button>

        <div class="sarv-lightbox__stage" data-sarv-lightbox-stage>
            <img class="sarv-lightbox__img" data-sarv-lightbox-img src="" alt="" decoding="async">
        </div>

        <button type="button" class="sarv-lightbox__nav sarv-lightbox__nav--next" data-sarv-lightbox-next aria-label="تصویر بعدی">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo is_rtl() ? 'M9 5l7 7-7 7' : 'M15 19l-7-7 7-7'; ?>"/>
            </svg>
        </button>

        <div class="sarv-lightbox__counter" aria-live="polite" aria-atomic="true">
            <span data-sarv-lightbox-counter dir="ltr">—</span>
        </div>
    </dialog>

</div>

<?php get_footer(); ?>