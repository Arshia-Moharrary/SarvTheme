<?php
/**
 * Portfolio pagination (server-side, query-string based).
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$paged          = (int) ($args['paged'] ?? 1);
$max_pages      = (int) ($args['max_pages'] ?? 1);
$treatment_slug = (string) ($args['treatment_slug'] ?? '');
$page_id        = (int) ($args['page_id'] ?? 0);

if ($max_pages <= 1) return;

$base_url = get_permalink($page_id);
if ($treatment_slug) {
    $base_url = add_query_arg('treatment', $treatment_slug, $base_url);
}

$page_url = static function (int $n) use ($base_url): string {
    if ($n <= 1) return $base_url;
    return add_query_arg('paged', $n, $base_url);
};

/* Build visible page list: first, last, and a ±1 window around current. */
$pages = [];
for ($i = 1; $i <= $max_pages; $i++) {
    if ($i === 1 || $i === $max_pages || abs($i - $paged) <= 1) {
        $pages[] = $i;
    }
}
?>

<nav class="sarv-portfolio-pagination mt-16 md:mt-20" aria-label="صفحه‌بندی نمونه‌کارها">
    <ul class="flex flex-wrap items-center justify-center gap-2">

        <li>
            <?php if ($paged > 1) : ?>
                <a href="<?php echo esc_url($page_url($paged - 1)); ?>" class="sarv-portfolio-pagination__btn" aria-label="صفحهٔ قبل">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="hidden sm:inline">قبلی</span>
                </a>
            <?php else : ?>
                <span class="sarv-portfolio-pagination__btn is-disabled" aria-disabled="true">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="hidden sm:inline">قبلی</span>
                </span>
            <?php endif; ?>
        </li>

        <?php
        $prev = 0;
        foreach ($pages as $p) :
            if ($prev && $p - $prev > 1) : ?>
                <li><span class="sarv-portfolio-pagination__ellipsis">…</span></li>
            <?php endif; ?>
            <li>
                <?php if ($p === $paged) : ?>
                    <span class="sarv-portfolio-pagination__btn is-current" aria-current="page"><?php echo esc_html(number_format_i18n($p)); ?></span>
                <?php else : ?>
                    <a href="<?php echo esc_url($page_url($p)); ?>" class="sarv-portfolio-pagination__btn"><?php echo esc_html(number_format_i18n($p)); ?></a>
                <?php endif; ?>
            </li>
            <?php $prev = $p;
        endforeach;
        ?>

        <li>
            <?php if ($paged < $max_pages) : ?>
                <a href="<?php echo esc_url($page_url($paged + 1)); ?>" class="sarv-portfolio-pagination__btn" aria-label="صفحهٔ بعد">
                    <span class="hidden sm:inline">بعدی</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            <?php else : ?>
                <span class="sarv-portfolio-pagination__btn is-disabled" aria-disabled="true">
                    <span class="hidden sm:inline">بعدی</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            <?php endif; ?>
        </li>

    </ul>
</nav>