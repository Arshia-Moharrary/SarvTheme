<?php
    /**
 * Composite stats strip.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $stats = $args['stats'] ?? [];
    if (empty($stats)) {
    return;
    }

?>

<section class="sarv-composite-stats relative pb-16 md:pb-20 bg-warm-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-forest-noir rounded-brand-lg p-8 md:p-12 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10 relative overflow-hidden reveal-up">
            <div class="absolute top-0 start-0 w-64 h-64 bg-champagne-gold/10 rounded-full blur-3xl -translate-x-1/3 -translate-y-1/3 pointer-events-none" aria-hidden="true"></div>

            <?php foreach ($stats as $stat): ?>
                <div class="relative z-10 text-center">
                    <div class="text-h2 md:text-h1 font-black text-champagne-gold font-satoshi leading-none mb-2" dir="ltr">
                        <?php echo esc_html($stat['number']); ?><span class="text-h4 md:text-h3 ms-1"><?php echo esc_html($stat['suffix']); ?></span>
                    </div>
                    <div class="text-caption md:text-body text-warm-ivory/70 font-peyda">
                        <?php echo esc_html($stat['label']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>