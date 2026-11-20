<?php
/**
 * Portfolio hero.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $total_all = $args['total_all'] ?? 0;
?>

<section class="sarv-portfolio-hero relative pt-24 pb-10 md:pt-32 md:pb-14 bg-warm-ivory overflow-hidden">
    <div class="absolute top-0 end-0 w-[500px] h-[500px] bg-champagne-gold/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none" aria-hidden="true"></div>
    <!-- <div class="absolute bottom-0 start-0 w-[400px] h-[400px] bg-deep-emerald/5 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3 pointer-events-none" aria-hidden="true"></div> -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl">

            <div class="inline-flex items-center gap-3 mb-6 reveal-up">
                <span class="w-8 h-px bg-champagne-gold"></span>
                <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">نتایج واقعی</span>
            </div>

            <h1 class="text-h1 md:text-hero font-black text-deep-emerald leading-tight mb-6 reveal-up delay-100">
                هنر خلق <br class="hidden md:block"> لبخندهای ماندگار
            </h1>

            <p class="text-body-range text-charcoal/70 leading-relaxed font-peyda max-w-2xl reveal-up delay-200">
                مجموعه‌ای از نمونه‌کارهای واقعی کلینیک دندانپزشکی سرو — لبخندهایی که با دقت، تخصص و توجه به جزئیات ساخته شده‌اند.
                <?php if ($total_all > 0): ?>
                    <span class="text-deep-emerald font-bold"><?php echo esc_html(number_format_i18n($total_all)); ?> نمونه‌کار ثبت‌شده.</span>
                <?php endif; ?>
            </p>

        </div>
    </div>
</section>