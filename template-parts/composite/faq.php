<?php
/**
 * Composite FAQ — native details/summary accordion.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$items = $args['items'] ?? [];
if (empty($items)) return;
?>

<section class="sarv-composite-faq py-16 md:py-24 bg-charcoal/[0.02] border-y border-soft-stone/40">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="text-center mb-10 md:mb-14 reveal-up">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-px bg-champagne-gold"></span>
                <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">سوالات متداول</span>
                <span class="w-8 h-px bg-champagne-gold"></span>
            </div>
            <h2 class="text-h2 md:text-h1 font-black text-deep-emerald leading-tight font-peyda">
                پاسخ به پرسش‌های شما
            </h2>
        </header>

        <div class="space-y-3">
            <?php foreach ($items as $item) : ?>
                <details class="sarv-faq group bg-white border border-soft-stone/60 rounded-brand-lg transition-colors hover:border-champagne-gold/60">
                    <summary class="flex items-center justify-between gap-4 p-5 md:p-6 cursor-pointer list-none">
                        <span class="text-body md:text-h4 font-bold font-peyda text-deep-emerald leading-snug">
                            <?php echo esc_html($item['question']); ?>
                        </span>
                        <span class="sarv-faq__icon flex-shrink-0 w-8 h-8 rounded-full bg-warm-ivory text-deep-emerald flex items-center justify-center transition-transform duration-300 group-open:rotate-180" aria-hidden="true">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="px-5 md:px-6 pb-5 md:pb-6 -mt-1 text-body text-charcoal/75 font-peyda leading-relaxed">
                        <?php echo wp_kses_post(wpautop($item['answer'])); ?>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>

    </div>
</section>