<?php

    /**
 * Article card — reusable standard variant.
 *
 * @param array $args {
 *     @type string $variant  'standard' (reserved for future variants)
 * }
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $variant     = $args['variant'] ?? 'standard';
    $post_id     = get_the_ID();
    $title       = get_the_title();
    $permalink   = get_permalink();
    $excerpt     = get_the_excerpt();
    $categories  = get_the_category();
    $primary_cat = ! empty($categories) ? $categories[0] : null;
    $thumb_id    = get_post_thumbnail_id();
?>

<article class="reveal-up">
    <a href="<?php echo esc_url($permalink); ?>"
        class="group flex flex-col h-full bg-white rounded-brand-lg border border-soft-stone/60 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-champagne-gold/40 transition-all duration-500">

        <!-- Image -->
        <div class="relative aspect-[16/10] overflow-hidden bg-soft-stone">
            <?php if ($thumb_id): ?>
                <?php
                    echo wp_get_attachment_image(
                        $thumb_id,
                        'medium_large',
                        false,
                        [
                            'class'   => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105',
                            'loading' => 'lazy',
                            'alt'     => esc_attr($title),
                        ]
                    );
                ?>
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center bg-deep-emerald">
                    <svg class="w-12 h-12 text-champagne-gold/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            <?php endif; ?>

            <?php if ($primary_cat): ?>
                <span class="absolute top-3 start-3 inline-flex items-center px-2.5 py-1 rounded-full bg-warm-ivory/95 backdrop-blur-sm text-deep-emerald font-peyda font-bold text-[0.7rem]">
                    <?php echo esc_html($primary_cat->name); ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Body -->
        <div class="flex flex-col flex-1 p-5 lg:p-6">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                  class="text-caption font-peyda text-charcoal/50 mb-2">
                <?php echo esc_html(sarv_archive_date()); ?>
            </time>

            <h3 class="text-h4 font-peyda font-black text-deep-emerald leading-snug group-hover:text-champagne-gold transition-colors duration-300">
                <?php echo esc_html($title); ?>
            </h3>

            <?php if ($excerpt) : ?>
                <p class="mt-3 text-body font-peyda text-charcoal/65 leading-relaxed line-clamp-2 flex-1">
                    <?php echo esc_html(wp_trim_words($excerpt, 18, '…')); ?>
                </p>
            <?php endif; ?>

            <span class="mt-4 inline-flex items-center gap-1.5 text-caption font-peyda font-bold text-deep-emerald group-hover:text-champagne-gold transition-colors duration-300">
                ادامه مطلب
                <svg class="w-3.5 h-3.5 rtl:rotate-180 transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        </div>
    </a>
</article>