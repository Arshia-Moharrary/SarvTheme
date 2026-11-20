<?php
/**
 * Category navigation — dynamic, WordPress-native.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$categories = get_categories([
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

if (empty($categories)) {
    return;
}

$current_cat_id = is_category() ? get_queried_object_id() : 0;
$posts_page_url = get_permalink(get_option('page_for_posts')) ?: home_url('/blog/');
$is_all_active  = is_home() || is_search();

$pill_base = 'inline-flex items-center justify-center shrink-0 h-11 px-5 rounded-full border font-peyda font-bold text-caption transition-all duration-300 snap-start';
?>

<nav aria-label="دسته‌بندی مقالات" class="mb-12 lg:mb-16 reveal-up">
    <div class="relative">
        <div class="flex gap-2 overflow-x-auto pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:flex-wrap sm:overflow-visible scrollbar-none snap-x"
             style="scrollbar-width: none; -ms-overflow-style: none;">

            <a href="<?php echo esc_url($posts_page_url); ?>"
               class="<?php echo esc_attr($pill_base); ?> <?php echo $is_all_active ? 'bg-deep-emerald border-deep-emerald text-warm-ivory' : 'bg-white border-soft-stone text-charcoal/70 hover:border-deep-emerald/40 hover:text-deep-emerald'; ?>"
               <?php echo $is_all_active ? 'aria-current="page"' : ''; ?>>
                همه مقالات
            </a>

            <?php foreach ($categories as $cat) :
                $is_active = ($current_cat_id === $cat->term_id);
                $cat_url   = get_category_link($cat->term_id);
            ?>
                <a href="<?php echo esc_url($cat_url); ?>"
                   class="<?php echo esc_attr($pill_base); ?> <?php echo $is_active ? 'bg-deep-emerald border-deep-emerald text-warm-ivory' : 'bg-white border-soft-stone text-charcoal/70 hover:border-deep-emerald/40 hover:text-deep-emerald'; ?>"
                   <?php echo $is_active ? 'aria-current="page"' : ''; ?>>
                    <?php echo esc_html($cat->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>

<style>
    .scrollbar-none::-webkit-scrollbar { display: none; }
</style>