<?php
/**
 * Portfolio filter navigation.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$terms        = $args['terms'] ?? [];
$current_slug = $args['current_slug'] ?? '';
$total_all    = (int) ($args['total_all'] ?? 0);
$base_url     = get_permalink((int) get_the_ID());

if (empty($terms) && $total_all === 0) return;
?>

<nav class="sarv-portfolio-filters mb-10 md:mb-14 reveal-up delay-300" aria-label="فیلتر دسته‌بندی نمونه‌کار">
    <ul class="flex flex-wrap items-center gap-2 md:gap-3">

        <li>
            <a href="<?php echo esc_url($base_url); ?>"
               class="sarv-portfolio-filter <?php echo empty($current_slug) ? 'is-active' : ''; ?>"
               <?php echo empty($current_slug) ? 'aria-current="page"' : ''; ?>>
                <span>همه</span>
                <span class="sarv-portfolio-filter__count"><?php echo esc_html(number_format_i18n($total_all)); ?></span>
            </a>
        </li>

        <?php foreach ($terms as $term) :
            $url       = add_query_arg('treatment', $term->slug, $base_url);
            $is_active = ($term->slug === $current_slug);
        ?>
            <li>
                <a href="<?php echo esc_url($url); ?>"
                   class="sarv-portfolio-filter <?php echo $is_active ? 'is-active' : ''; ?>"
                   <?php echo $is_active ? 'aria-current="page"' : ''; ?>>
                    <span><?php echo esc_html($term->name); ?></span>
                    <span class="sarv-portfolio-filter__count"><?php echo esc_html(number_format_i18n($term->count)); ?></span>
                </a>
            </li>
        <?php endforeach; ?>

    </ul>
</nav>