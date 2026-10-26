<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Sarv
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main min-h-screen bg-warm-ivory pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php
        if ( have_posts() ) :
            ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                // شروع حلقه (The Loop)
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-brand-lg shadow-sm border border-soft-stone overflow-hidden flex flex-col' ); ?>>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="aspect-w-16 aspect-h-9 bg-soft-stone">
                                <a href="<?php the_permalink(); ?>" class="block h-full w-full">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover transition-transform duration-500 hover:scale-105' ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="p-6 flex flex-col flex-grow">
                            <header class="entry-header mb-4">
                                <?php
                                the_title( sprintf( '<h2 class="entry-title text-h3 font-bold text-deep-emerald mb-2 leading-tight"><a href="%s" rel="bookmark" class="hover:text-champagne-gold transition-colors duration-300">', esc_url( get_permalink() ) ), '</a></h2>' );
                                ?>
                                <div class="text-caption text-charcoal/60 font-peyda">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </header>

                            <div class="entry-content text-body text-charcoal/80 font-peyda leading-relaxed mb-6 flex-grow">
                                <?php
                                // نمایش خلاصه متن برای جلوگیری از شلوغی کارت‌ها
                                the_excerpt();
                                ?>
                            </div>

                            <footer class="entry-footer mt-auto pt-4 border-t border-soft-stone/50">
                                <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-body font-medium text-deep-emerald hover:text-champagne-gold transition-colors duration-300 group">
                                    <span>مشاهده بیشتر</span>
                                    <svg class="w-5 h-5 ms-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                </a>
                            </footer>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>
            
            <?php
            // صفحه‌بندی (Pagination)
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( 'قبلی', 'sarv' ),
                'next_text' => __( 'بعدی', 'sarv' ),
                'class'     => 'mt-12 flex justify-center font-peyda',
            ) );
            ?>

        <?php
        else :
            ?>
            <div class="text-center py-20">
                <h2 class="text-h2 font-bold text-deep-emerald mb-4 font-peyda"><?php esc_html_e( 'محتوایی یافت نشد', 'sarv' ); ?></h2>
                <p class="text-body text-charcoal/70 font-peyda"><?php esc_html_e( 'متأسفانه در حال حاضر محتوایی برای نمایش وجود ندارد.', 'sarv' ); ?></p>
            </div>
            <?php
        endif;
        ?>

    </div>
</main>

<?php
get_footer();