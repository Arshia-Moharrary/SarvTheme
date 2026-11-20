<?php
    /**
 * Composite hero.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $hero      = $args['hero'] ?? [];
    $title     = $hero['title'] ?? 'کامپوزیت دندان';
    $subtitle  = $hero['subtitle'] ?? '';
    $intro     = $hero['intro'] ?? '';
    $button    = $hero['button'] ?? null;
    $image_id  = (int) ($hero['image_id'] ?? 0);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';
?>

<section class="sarv-composite-hero relative overflow-hidden bg-warm-ivory pt-24 pb-16 md:pt-32 md:pb-24">
    <div class="absolute top-0 end-0 w-[500px] h-[500px] bg-champagne-gold/5 rounded-full blur-3xl -translate-y-1/3 translate-x-1/3 pointer-events-none" aria-hidden="true"></div>
    <div class="absolute bottom-0 start-0 w-[400px] h-[400px] bg-deep-emerald/5 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">

            <div class="lg:col-span-6">
                <div class="inline-flex items-center gap-3 mb-6 reveal-up">
                    <span class="w-8 h-px bg-champagne-gold"></span>
                    <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">خدمات تخصصی</span>
                </div>

                <h1 class="text-h1 md:text-hero font-black text-deep-emerald leading-tight mb-4 reveal-up delay-100">
                    <?php echo esc_html($title); ?>
                </h1>

                <?php if ($subtitle): ?>
                    <p class="text-h4 md:text-h3 font-bold text-deep-emerald/90 mb-6 font-peyda reveal-up delay-150">
                        <?php echo esc_html($subtitle); ?>
                    </p>
                <?php endif; ?>

                <?php if ($intro): ?>
                    <p class="text-body-range text-charcoal/75 leading-relaxed font-peyda max-w-xl mb-8 reveal-up delay-200">
                        <?php echo esc_html($intro); ?>
                    </p>
                <?php endif; ?>

                <?php if ($button): ?>
                    <a href="<?php echo esc_url($button['link']); ?>"
                       class="group inline-flex items-center gap-3 bg-deep-emerald text-warm-ivory ps-6 pe-2 py-2 rounded-brand font-peyda font-bold text-body shadow-lg hover:bg-forest-noir hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 reveal-up delay-300">
                        <span><?php echo esc_html($button['text']); ?></span>
                        <span class="w-10 h-10 rounded-full bg-champagne-gold text-deep-emerald flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </span>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($image_url): ?>
                <div class="lg:col-span-6 relative reveal-up delay-200">
                    <div class="relative rounded-brand-lg overflow-hidden aspect-square md:aspect-[5/4] bg-forest-noir shadow-2xl">
                        <img src="<?php echo esc_url($image_url); ?>"
                             alt="<?php echo esc_attr($title); ?>"
                             class="w-full h-full object-cover"
                             fetchpriority="high" loading="eager" decoding="async">
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>