<?php

/**
 * The main template file
 *
 * @package Sarv
 */

// جلوگیری از دسترسی مستقیم
if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="content-area py-10 px-4">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
    ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('mb-8 p-6 bg-[#F6F3EC] rounded-xl'); ?>>
                <header class="entry-header mb-4">
                    <?php the_title('<h2 class="entry-title text-2xl font-bold text-[#0E3B32]">', '</h2>'); ?>
                </header>

                <div class="entry-content prose">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php
        endwhile;
    else :
        ?>
        <p class="text-gray-600">
            <?php esc_html_e('محتوایی یافت نشد.', 'sarv'); ?>
        </p>
    <?php
    endif;
    ?>
</section>

<?php
get_footer();
