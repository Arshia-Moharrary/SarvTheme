<?php
/**
 * Composite final CTA.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$phone = get_theme_mod('sarv_phone_number', '');
$clean = $phone ? preg_replace('/[^0-9+]/', '', $phone) : '';
$contact_page = get_page_by_path('contact');
$contact_url  = $contact_page ? get_permalink($contact_page->ID) : null;
?>

<section class="sarv-composite-cta pb-20 md:pb-28 pt-8 bg-warm-ivory">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-forest-noir rounded-brand-lg overflow-hidden p-8 md:p-14 text-center reveal-up">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-champagne-gold/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

            <h2 class="text-h2 md:text-h1 font-black text-warm-ivory mb-5 relative z-10 font-peyda leading-tight">
                آماده‌اید لبخند دلخواهتان را بسازید؟
            </h2>
            <p class="text-warm-ivory/70 text-body-range md:text-xl mb-8 max-w-2xl mx-auto relative z-10 font-peyda leading-relaxed">
                تیم متخصصین ما آماده ارائه مشاوره تخصصی و طراحی اختصاصی لبخند شما هستند.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 justify-center relative z-10">
                <?php if ($contact_url) : ?>
                    <a href="<?php echo esc_url($contact_url); ?>"
                       class="group inline-flex items-center justify-center gap-2 bg-champagne-gold text-deep-emerald px-6 py-3 rounded-brand font-peyda font-bold text-body hover:bg-warm-ivory transition-all duration-300 hover:-translate-y-0.5">
                        <span>رزرو مشاوره</span>
                        <svg class="w-4 h-4 rotate-180 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                <?php endif; ?>

                <?php if ($phone) : ?>
                    <a href="tel:<?php echo esc_attr($clean); ?>"
                       class="inline-flex items-center justify-center gap-2 border-2 border-warm-ivory/30 text-warm-ivory px-6 py-3 rounded-brand font-peyda font-bold text-body hover:bg-warm-ivory/10 hover:border-warm-ivory/60 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span dir="ltr"><?php echo esc_html($phone); ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>