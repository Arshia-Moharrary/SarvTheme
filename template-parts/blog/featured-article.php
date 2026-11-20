<?php
/**
 * Featured article — editorial hero composition.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$post_id     = get_the_ID();
$title       = get_the_title();
$permalink   = get_permalink();
$excerpt     = get_the_excerpt();
$categories  = get_the_category();
$primary_cat = ! empty($categories) ? $categories[0] : null;
$thumb_id    = get_post_thumbnail_id();
?>

<article class="mb-14 lg:mb-20 reveal-up">
    <a href="<?php echo esc_url($permalink); ?>"
       class="group grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-center">

        <!-- Image -->
        <div class="lg:col-span-7 relative">
            <div class="relative aspect-[16/10] rounded-brand-lg overflow-hidden bg-soft-stone shadow-xl">
                <?php if ($thumb_id) : ?>
                    <?php
                    echo wp_get_attachment_image(
                        $thumb_id,
                        'large',
                        false,
                        [
                            'class'   => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105',
                            'loading' => 'eager',
                            'fetchpriority' => 'high',
                            'alt'     => esc_attr($title),
                        ]
                    );
                    ?>
                <?php else : ?>
                    <div class="w-full h-full flex items-center justify-center bg-deep-emerald">
                        <svg class="w-20 h-20 text-champagne-gold/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                <?php endif; ?>

                <?php if ($primary_cat) : ?>
                    <span class="absolute top-4 start-4 inline-flex items-center px-3 py-1.5 rounded-full bg-champagne-gold text-deep-emerald font-peyda font-bold text-caption shadow-lg">
                        <?php echo esc_html($primary_cat->name); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Text -->
        <div class="lg:col-span-5">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                  class="inline-block text-caption font-peyda text-charcoal/60 mb-4">
                <?php echo esc_html(sarv_archive_date()); ?>
            </time>

            <h2 class="text-h2 lg:text-h3 font-black font-peyda text-deep-emerald leading-[1.3] group-hover:text-champagne-gold transition-colors duration-300">
                <?php echo esc_html($title); ?>
            </h2>

            <?php if ($excerpt) : ?>
                <p class="mt-4 text-body font-peyda text-charcoal/70 leading-relaxed line-clamp-3">
                    <?php echo esc_html(wp_trim_words($excerpt, 28, '…')); ?>
                </p>
            <?php endif; ?>

            <span class="mt-6 inline-flex items-center gap-2 text-caption font-peyda font-bold text-deep-emerald group-hover:text-champagne-gold transition-colors duration-300">
                خواندن مقاله
                <svg class="w-4 h-4 rtl:rotate-180 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5-5 5M6 12h12"/>
                </svg>
            </span>
        </div>
    </a>
</article>