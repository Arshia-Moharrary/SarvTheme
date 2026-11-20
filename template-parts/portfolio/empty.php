<?php
/**
 * Portfolio empty state.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$has_filter = (bool) ($args['has_filter'] ?? false);
$base_url   = get_permalink((int) get_the_ID());
?>

<div class="sarv-portfolio-empty py-20 md:py-28 text-center">
    <div class="max-w-lg mx-auto">

        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-champagne-gold/10 flex items-center justify-center">
            <svg class="w-10 h-10 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>

        <h2 class="text-h3 font-black text-deep-emerald mb-3 font-peyda">
            <?php echo $has_filter ? 'به‌زودی' : 'در حال آماده‌سازی'; ?>
        </h2>
        <p class="text-body text-charcoal/70 font-peyda mb-6">
            <?php echo $has_filter
                ? 'نمونه‌کارهای این دسته به‌زودی اضافه می‌شوند. دسته‌های دیگر را ببینید.'
                : 'نمونه‌کارهای کلینیک سرو به‌زودی در این بخش نمایش داده می‌شوند.'; ?>
        </p>

        <?php if ($has_filter) : ?>
            <a href="<?php echo esc_url($base_url); ?>" class="inline-flex items-center gap-2 bg-deep-emerald text-warm-ivory px-6 py-3 rounded-brand font-peyda font-bold text-body hover:bg-forest-noir transition-colors duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                مشاهدهٔ همه
            </a>
        <?php endif; ?>
    </div>
</div>