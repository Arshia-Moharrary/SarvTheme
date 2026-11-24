<?php
/**
 * Archive pagination — built from paginate_links( type=array ).
 *
 * Respects the main query's max_num_pages. No hardcoded counts.
 * Works identically on home.php, category.php, and search.php.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$links = paginate_links([
    'current'   => max(1, (int) get_query_var('paged')),
    'total'     => (int) $GLOBALS['wp_query']->max_num_pages,
    'mid_size'  => 1,
    'end_size'  => 1,
    'type'      => 'array',
    'prev_text' => 'PREV',
    'next_text' => 'NEXT',
]);

if (empty($links)) {
    return;
}

$icon_prev = '<svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>';
$icon_next = '<svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>';

$base_pill = 'inline-flex items-center justify-center w-11 h-11 rounded-full font-peyda font-bold text-caption transition-all duration-300';
?>

<nav aria-label="صفحه‌بندی مقالات" class="mt-14 lg:mt-20 reveal-up">
    <ul class="flex items-center justify-center gap-2 flex-wrap">

        <?php foreach ($links as $link) :
            $is_current = strpos($link, 'current') !== false;
            $is_dots    = strpos($link, 'dots')    !== false;
            $is_prev    = strpos($link, 'PREV')    !== false;
            $is_next    = strpos($link, 'NEXT')    !== false;

            if ($is_dots) : ?>
                <li>
                    <span class="<?php echo esc_attr($base_pill); ?> text-charcoal/40">…</span>
                </li>
                <?php continue; ?>
            <?php endif;

            preg_match('/href=["\']([^"\']+)["\']/', $link, $href_match);
            $href = $href_match[1] ?? '#';

            preg_match('/>([^<]+)</', $link, $num_match);
            $num = trim($num_match[1] ?? '');
        ?>

            <li>
                <?php if ($is_current) : ?>
                    <span aria-current="page"
                          class="<?php echo esc_attr($base_pill); ?> bg-deep-emerald text-warm-ivory">
                        <?php echo esc_html($num); ?>
                    </span>
                <?php elseif ($is_prev) : ?>
                    <a href="<?php echo esc_url($href); ?>" rel="prev" aria-label="صفحه قبل"
                       class="<?php echo esc_attr($base_pill); ?> border border-soft-stone text-deep-emerald hover:border-champagne-gold hover:bg-champagne-gold/10">
                        <?php echo $icon_prev; // phpcs:ignore -- static SVG ?>
                    </a>
                <?php elseif ($is_next) : ?>
                    <a href="<?php echo esc_url($href); ?>" rel="next" aria-label="صفحه بعد"
                       class="<?php echo esc_attr($base_pill); ?> border border-soft-stone text-deep-emerald hover:border-champagne-gold hover:bg-champagne-gold/10">
                        <?php echo $icon_next; // phpcs:ignore -- static SVG ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url($href); ?>"
                       class="<?php echo esc_attr($base_pill); ?> border border-soft-stone text-deep-emerald hover:border-champagne-gold hover:bg-champagne-gold/10">
                        <?php echo esc_html($num); ?>
                    </a>
                <?php endif; ?>
            </li>

        <?php endforeach; ?>
    </ul>
</nav>