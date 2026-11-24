<?php

/**
 * Search Results.
 *
 * Minimal wrapper that reuses all archive components. The search form
 * itself lives in archive-header.php (see Phase 2 for full UI).
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="bg-warm-ivory">
    <?php
    get_template_part('template-parts/blog/archive-header', null, [
        'context'    => 'search',
        'search_term' => get_search_query(),
    ]);
    ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 lg:pb-28">

        <?php if (have_posts()) : ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php
                while (have_posts()) : the_post();
                    get_template_part('template-parts/blog/article-card', null, [
                        'variant' => 'standard',
                    ]);
                endwhile;
                ?>
            </div>

            <?php get_template_part('template-parts/blog/pagination'); ?>

        <?php else : ?>
            <?php get_template_part('template-parts/blog/empty-state', null, ['context' => 'search']); ?>
        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>