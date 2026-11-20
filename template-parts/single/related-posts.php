<?php
    /**
 * Related posts.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $post_id = $args['post_id'] ?? get_the_ID();
    $query   = sarv_get_related_posts($post_id, 3);

    if (! $query->have_posts()) {
    return;
    }

?>

<section class="bg-warm-ivory pt-8 pb-20 md:pb-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10 md:mb-12">
            <div class="inline-flex items-center gap-3 mb-3">
                <span class="w-8 h-px bg-champagne-gold"></span>
                <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">ادامه مطالعه</span>
            </div>
            <h2 class="text-h2 md:text-h1 font-black text-deep-emerald leading-tight font-peyda">
                مقالات مرتبط
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <?php
                    $rel_cats     = get_the_category();
                        $rel_primary = ! empty($rel_cats) ? $rel_cats[0] : null;
                ?>
                <article class="group relative">
                    <a href="<?php the_permalink(); ?>" class="block focus:outline-none focus-visible:ring-4 focus-visible:ring-champagne-gold rounded-brand-lg transition-all">
                        <div class="relative aspect-[4/3] rounded-brand-lg overflow-hidden bg-forest-noir mb-4 shadow-lg">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', [
                                            'class'   => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100',
                                            'loading' => 'lazy',
                                    ]); ?>
                            <?php else: ?>
                                <div class="w-full h-full bg-forest-noir flex items-center justify-center">
                                    <span class="w-12 h-12 rounded-full border border-champagne-gold/30"></span>
                                </div>
                            <?php endif; ?>

                            <?php if ($rel_primary): ?>
                                <span class="absolute top-3 start-3 bg-champagne-gold/95 text-deep-emerald px-2.5 py-1 rounded-full text-caption font-bold font-peyda">
                                    <?php echo esc_html($rel_primary->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="px-1">
                            <time class="text-caption font-peyda text-charcoal/50 block mb-2">
                                <?php echo esc_html(get_the_date()); ?>
                            </time>
                            <h3 class="text-h4 font-bold text-deep-emerald leading-snug font-peyda group-hover:text-champagne-gold transition-colors duration-300 line-clamp-2">
                                <?php the_title(); ?>
                            </h3>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php wp_reset_postdata(); ?>