<?php
/**
 * Composite Aparat videos — 2x2 responsive grid, lazy iframes.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$videos = $args['videos'] ?? [];
if (empty($videos)) return;
?>

<section class="sarv-composite-videos py-16 md:py-24 bg-charcoal/[0.02] border-y border-soft-stone/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="max-w-3xl mb-10 md:mb-14 reveal-up">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="w-8 h-px bg-champagne-gold"></span>
                <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">ویدیوها</span>
            </div>
            <h2 class="text-h2 md:text-h1 font-black text-deep-emerald leading-tight font-peyda">
                تجربه کامپوزیت در کلینیک سرو
            </h2>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8">
            <?php foreach ($videos as $hash) : ?>
                <div class="sarv-video-frame relative aspect-video rounded-brand-lg overflow-hidden bg-forest-noir shadow-lg reveal-up">
                    <iframe
                        src="https://www.aparat.com/video/video/embed/videohash/<?php echo esc_attr($hash); ?>/vt/frame"
                        title="ویدیوی کامپوزیت — آپارات"
                        loading="lazy"
                        allowfullscreen
                        class="absolute inset-0 w-full h-full border-0">
                    </iframe>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>