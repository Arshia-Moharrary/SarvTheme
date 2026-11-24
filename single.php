<?php
    /**
 * Single Article.
 *
 * Premium editorial reading experience for default WordPress posts.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    get_header();

    while (have_posts()):
    the_post();

    $post_id = (int) get_the_ID();
    $reading = sarv_reading_time($post_id);
    $cats    = get_the_category();
    $primary = ! empty($cats) ? $cats[0] : null;

    get_template_part('template-parts/single/hero', null, [
        'reading' => $reading,
        'primary' => $primary,
    ]);

    ob_start();
    the_content();
    $rendered = (string) ob_get_clean();
    $toc_data = sarv_build_toc($rendered);
    $body     = $toc_data['html'];
    $toc      = $toc_data['toc'];
    $body = sarv_wrap_tables($body);
    $has_toc  = count($toc) >= 2;
?>

    <div class="bg-warm-ivory sarv-single-body">

        <div class="sarv-reading-progress" data-sarv-reading-progress aria-hidden="true">
            <span class="sarv-reading-progress__fill"></span>
        </div>

        <section class="pt-10 pb-20 md:pt-14 md:pb-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="sarv-article-layout <?php echo $has_toc ? 'has-toc' : 'no-toc'; ?>">

                    <?php if ($has_toc): ?>
                        <aside class="sarv-article-toc-wrap" aria-label="فهرست مطالب">
                            <?php get_template_part('template-parts/single/toc', null, ['toc' => $toc]); ?>
                        </aside>
                    <?php endif; ?>

                    <article class="sarv-article-body">
                        <div class="sarv-article-content" data-sarv-article-content>
                            <?php echo $body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>

                        <?php get_template_part('template-parts/single/share'); ?>
                        <?php get_template_part('template-parts/single/prev-next'); ?>
                        <?php get_template_part('template-parts/single/cta', null, ['post_id' => $post_id]); ?>
                    </article>

                    <?php if ($has_toc): ?>
                        <aside class="sarv-article-share-wrap hidden lg:block" aria-label="اشتراک‌گذاری">
                            <div class="sarv-article-share-sticky">
                                <?php get_template_part('template-parts/single/share', null, ['variant' => 'floating']); ?>
                            </div>
                        </aside>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        <?php get_template_part('template-parts/single/related-posts', null, ['post_id' => $post_id]); ?>
    </div>

    <?php
        endwhile;

    get_footer();