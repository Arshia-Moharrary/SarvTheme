<?php
    /**
 * Portfolio item card.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $index   = (int) ($args['index'] ?? 0);
    $post_id = (int) get_the_ID();

    $images = sarv_get_portfolio_images($post_id);
    if (empty($images)) {
    return;
    }

    $primary = $images[0];
    $type    = sarv_get_image_type((int) $primary->ID);

    $cats    = get_the_terms($post_id, 'sarv_treatment');
    $cat     = (! empty($cats) && ! is_wp_error($cats)) ? $cats[0] : null;
    $img_cnt = count($images);

    $aspect_map = [
    'smile_portrait' => 'aspect-square',
    'dental_closeup' => 'aspect-[4/5]',
    'dental_square'  => 'aspect-square',
    'multi_tooth'    => 'aspect-[7/12]',
    'before_after'   => 'aspect-[197/350]',
    ];
    $aspect = $aspect_map[$type] ?? 'aspect-square';
?>

<article class="sarv-portfolio-item">
    <button type="button"
            class="sarv-portfolio-card group relative block w-full <?php echo esc_attr($aspect); ?> overflow-hidden rounded-brand-lg bg-forest-noir cursor-zoom-in focus:outline-none focus-visible:ring-4 focus-visible:ring-champagne-gold focus-visible:ring-offset-2 focus-visible:ring-offset-warm-ivory"
            data-sarv-lightbox
            data-post-id="<?php echo esc_attr($post_id); ?>"
            aria-label="<?php echo esc_attr(get_the_title() . ' — مشاهدهٔ ' . number_format_i18n($img_cnt) . ' تصویر'); ?>">

        <?php echo wp_get_attachment_image((int) $primary->ID, 'large', false, [
                'class'   => 'sarv-portfolio-card__img w-full h-full object-cover',
                'loading' => $index < 4 ? 'eager' : 'lazy',
                'sizes'   => '(max-width: 640px) 50vw, (max-width: 1024px) 33vw, 25vw',
                'alt'     => get_post_meta($primary->ID, '_wp_attachment_image_alt', true) ?: get_the_title(),
        ]); ?>

        <span class="sarv-portfolio-card__overlay" aria-hidden="true"></span>

        <?php if ($cat): ?>
            <span class="sarv-portfolio-card__cat"><?php echo esc_html($cat->name); ?></span>
        <?php endif; ?>

        <?php if ($img_cnt > 1): ?>
            <span class="sarv-portfolio-card__count" aria-hidden="true">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <?php echo esc_html(number_format_i18n($img_cnt)); ?>
            </span>
        <?php endif; ?>

        <span class="sarv-portfolio-card__zoom" aria-hidden="true">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16zm0-5v-6m-3 3h6"/>
            </svg>
        </span>
    </button>
</article>