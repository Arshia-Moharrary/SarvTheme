<?php
/**
 * Portfolio load-more button.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$paged     = (int) ($args['paged'] ?? 1);
$max_pages = (int) ($args['max_pages'] ?? 1);
$treatment = (string) ($args['treatment_slug'] ?? '');

if ($max_pages <= 1 || $paged >= $max_pages) return;
?>

<div class="sarv-load-more-wrap">
    <button type="button"
            class="sarv-load-more"
            data-sarv-load-more
            data-page="<?php echo esc_attr($paged); ?>"
            data-total="<?php echo esc_attr($max_pages); ?>"
            data-treatment="<?php echo esc_attr($treatment); ?>">
        <span>نمایش نمونه‌کارهای بیشتر</span>
        <svg class="sarv-load-more__icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </button>
</div>