<?php
    /**
 * Table of contents.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $toc = $args['toc'] ?? [];
    if (empty($toc) || count($toc) < 2) {
    return;
    }

?>

<nav class="sarv-article-toc" aria-label="فهرست مطالب مقاله" data-sarv-toc>

    <!-- Mobile: collapsible -->
    <details class="lg:hidden group" <?php echo count($toc) <= 8 ? 'open' : ''; ?>>
        <summary class="flex items-center justify-between gap-3 w-full px-4 py-3 rounded-brand border border-soft-stone bg-white cursor-pointer list-none">
            <span class="text-h4 font-bold text-deep-emerald font-peyda">فهرست مطالب</span>
            <svg class="w-5 h-5 text-champagne-gold transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </summary>
        <div class="pt-4" style="content-visibility:auto">
            <?php get_template_part('template-parts/single/toc-list', null, ['toc' => $toc]); ?>
        </div>
    </details>

    <!-- Desktop: always visible -->
    <div class="hidden lg:block">
        <p class="text-caption font-bold font-peyda text-charcoal/50 uppercase tracking-wider mb-4">در این مقاله می‌خوانید</p>
        <?php get_template_part('template-parts/single/toc-list', null, ['toc' => $toc]); ?>
    </div>
</nav>