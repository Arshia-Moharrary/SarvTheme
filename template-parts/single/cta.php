<?php
    /**
 * Contextual CTA.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $post_id = $args['post_id'] ?? get_the_ID();
    $cta     = sarv_cta_for_post($post_id);

    if (empty($cta['contact_url']) && empty($cta['phone'])) {
    return;
    }

?>

<section class="sarv-article-cta mt-16 md:mt-20">
    <div class="relative bg-forest-noir rounded-brand-lg overflow-hidden p-8 md:p-12">
        <div class="absolute top-0 end-0 w-80 h-80 bg-champagne-gold/10 rounded-full blur-3xl -translate-y-1/3 translate-x-1/3 pointer-events-none" aria-hidden="true"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-6 md:gap-10">
            <div class="flex-1 min-w-0">
                <h2 class="text-h3 md:text-h2 font-black text-warm-ivory mb-3 font-peyda leading-tight break-words">
                    <?php echo esc_html($cta['title']); ?>
                </h2>
                <p class="text-warm-ivory/70 font-peyda text-body md:text-body-range leading-relaxed">
                    <?php echo esc_html($cta['text']); ?>
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 shrink-0 w-full md:w-auto">
                <?php if (! empty($cta['contact_url'])): ?>
                    <a href="<?php echo esc_url($cta['contact_url']); ?>"
                       class="group inline-flex items-center justify-center gap-2 bg-champagne-gold text-deep-emerald px-6 py-3 rounded-brand font-peyda font-bold text-body hover:bg-warm-ivory transition-all duration-300 hover:-translate-y-0.5">
                        <span><?php echo esc_html($cta['label']); ?></span>
                        <svg class="w-4 h-4 rotate-180 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                <?php endif; ?>

                <?php if (! empty($cta['phone'])): ?>
                    <a href="tel:<?php echo esc_attr($cta['phone_clean']); ?>"
                       class="inline-flex items-center justify-center gap-2 border-2 border-warm-ivory/30 text-warm-ivory px-6 py-3 rounded-brand font-peyda font-bold text-body hover:bg-warm-ivory/10 hover:border-warm-ivory/60 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span dir="ltr"><?php echo esc_html($cta['phone']); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>