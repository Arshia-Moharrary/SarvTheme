<?php
    /**
 * Previous / next article navigation.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $prev = get_previous_post();
    $next = get_next_post();

    if (! $prev && ! $next) {
    return;
    }

    $has_both = ($prev && $next);
?>

<nav class="mt-16 pt-8 border-t border-soft-stone/60 <?php echo $has_both ? 'grid grid-cols-1 md:grid-cols-2 gap-6' : 'flex justify-center'; ?>"
     aria-label="پیمایش مقالات">

    <?php if ($prev): ?>
        <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="group block p-4 rounded-brand-lg border border-soft-stone/60 hover:border-champagne-gold/60 hover:bg-white transition-all duration-300">
            <span class="inline-flex items-center gap-2 text-caption font-bold font-peyda text-charcoal/50 mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                مقاله قبلی
            </span>
            <span class="block text-body font-bold font-peyda text-deep-emerald leading-snug group-hover:text-champagne-gold transition-colors line-clamp-2">
                <?php echo esc_html(get_the_title($prev)); ?>
            </span>
        </a>
    <?php endif; ?>

    <?php if ($next): ?>
        <a href="<?php echo esc_url(get_permalink($next)); ?>" class="group block p-4 rounded-brand-lg border border-soft-stone/60 hover:border-champagne-gold/60 hover:bg-white transition-all duration-300 md:text-end">
            <span class="inline-flex items-center gap-2 text-caption font-bold font-peyda text-charcoal/50 mb-2 md:flex-row-reverse">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                مقاله بعدی
            </span>
            <span class="block text-body font-bold font-peyda text-deep-emerald leading-snug group-hover:text-champagne-gold transition-colors line-clamp-2">
                <?php echo esc_html(get_the_title($next)); ?>
            </span>
        </a>
    <?php endif; ?>

</nav>