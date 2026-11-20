<?php
    /**
 * Single article hero.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $reading = $args['reading'] ?? 1;
    $primary = $args['primary'] ?? null;

    $post_id  = get_the_ID();
    $title    = get_the_title();
    $show_mod = get_the_date('Y-m-d') !== get_the_modified_date('Y-m-d');

    $posts_page_id = (int) get_option('page_for_posts');
    $blog_url      = $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');
?>

<section class="sarv-article-hero bg-warm-ivory pt-24 pb-10 md:pt-28 md:pb-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="text-caption font-peyda text-charcoal/60 mb-6 md:mb-8" aria-label="مسیر صفحه">
            <ol class="flex flex-wrap items-center gap-2">
                <li><a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-deep-emerald transition-colors">خانه</a></li>
                <li aria-hidden="true" class="opacity-40">/</li>
                <li><a href="<?php echo esc_url($blog_url); ?>" class="hover:text-deep-emerald transition-colors">وبلاگ</a></li>
                <?php if ($primary): ?>
                    <li aria-hidden="true" class="opacity-40">/</li>
                    <li><a href="<?php echo esc_url(get_category_link($primary)); ?>" class="hover:text-deep-emerald transition-colors"><?php echo esc_html($primary->name); ?></a></li>
                <?php endif; ?>
            </ol>
        </nav>

        <?php if ($primary): ?>
            <a href="<?php echo esc_url(get_category_link($primary)); ?>" class="inline-flex items-center px-3 py-1 rounded-full bg-champagne-gold/15 border border-champagne-gold/40 text-champagne-gold hover:bg-champagne-gold hover:text-deep-emerald transition-colors duration-300 font-peyda font-bold text-caption mb-6">
                <?php echo esc_html($primary->name); ?>
            </a>
        <?php endif; ?>

        <h1 class="text-h1 md:text-hero font-black text-deep-emerald leading-tight mb-6 md:mb-8 max-w-4xl reveal-up break-words">
            <?php echo esc_html($title); ?>
        </h1>

        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-caption font-peyda text-charcoal/70 mb-8 md:mb-10 reveal-up delay-100">
            <span class="inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time>
            </span>

            <span class="w-px h-3 bg-charcoal/20" aria-hidden="true"></span>

            <span class="inline-flex items-center gap-2">
                <svg class="w-4 h-4 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                حدود <?php echo esc_html(number_format_i18n($reading)); ?> دقیقه مطالعه
            </span>

            <?php if ($show_mod): ?>
                <span class="w-px h-3 bg-charcoal/20" aria-hidden="true"></span>
                <span class="inline-flex items-center gap-2 text-charcoal/50">
                    آخرین به‌روزرسانی: <?php echo esc_html(get_the_modified_date()); ?>
                </span>
            <?php endif; ?>
        </div>

        <?php if (has_post_thumbnail()): ?>
            <figure class="relative rounded-brand-lg overflow-hidden bg-forest-noir aspect-[16/10] md:aspect-[21/9] shadow-xl reveal-up delay-200">
                <?php
                    echo get_the_post_thumbnail($post_id, 'full', [
                        'class'         => 'w-full h-full object-cover',
                        'fetchpriority' => 'high',
                        'loading'       => 'eager',
                        'decoding'      => 'async',
                    ]);
                ?>
            </figure>
        <?php endif; ?>

    </div>
</section>