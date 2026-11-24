<?php
    /**
 * Composite treatment process — 4 steps.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $process = $args['process'] ?? [];
    if (empty($process)) {
    return;
    }

?>

<section class="sarv-composite-process py-16 md:py-24 bg-warm-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="max-w-3xl mb-12 md:mb-16 reveal-up">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-px bg-champagne-gold"></span>
                <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">مراحل درمان</span>
            </div>
            <h2 class="text-h2 md:text-h1 font-black text-deep-emerald leading-tight font-peyda">
                روند انجام کار
            </h2>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            <?php foreach ($process as $i => $step):
                    $img_id  = (int) $step['image_id'];
                    $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'medium') : '';
            ?>
                <article class="relative sarv-composite-step reveal-up delay-<?php echo esc_attr(($i + 1) * 100); ?>">
                    <div class="bg-white border border-soft-stone/60 rounded-brand-lg p-6 md:p-8 h-full flex flex-col hover:border-champagne-gold/60 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-5">
                            <span class="text-caption font-bold font-satoshi text-champagne-gold" dir="ltr">
                                <?php echo esc_html(str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT)); ?>
                            </span>
                            <?php if ($img_url): ?>
                                <div class="w-12 h-12">
                                    <img src="<?php echo esc_url($img_url); ?>"
                                         alt="" class="w-full h-full object-contain"
                                         loading="lazy" decoding="async">
                                </div>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-h4 font-bold text-deep-emerald font-peyda leading-snug mb-3">
                            <?php echo esc_html($step['title']); ?>
                        </h3>
                        <p class="text-body text-charcoal/70 font-peyda leading-relaxed">
                            <?php echo esc_html($step['description']); ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>