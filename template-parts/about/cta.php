<?php

/**
 * About — Closing CTA
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$phone      = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
?>

<section id="book-consult" aria-labelledby="cta-title" class="relative bg-warm-ivory py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-deep-emerald rounded-brand-lg overflow-hidden shadow-2xl reveal-up">

            <!-- Decorative -->
            <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
                <div class="absolute -top-24 -end-24 w-80 h-80 rounded-full bg-champagne-gold/10 blur-3xl"></div>
                <div class="absolute -bottom-24 -start-24 w-80 h-80 rounded-full bg-forest-noir/40 blur-3xl"></div>
                <div class="absolute top-10 start-10 text-champagne-gold/10">
                    <svg class="w-20 h-20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                </div>
            </div>

            <div class="relative z-10 p-8 sm:p-12 lg:p-16 grid grid-cols-1 lg:grid-cols-12 items-center gap-10 lg:gap-16">

                <!-- Text -->
                <div class="lg:col-span-7 text-warm-ivory">
                    <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-champagne-gold tracking-widest mb-6">
                        <span class="w-10 h-px bg-champagne-gold"></span>
                        قدم اول
                    </span>
                    <h2 id="cta-title"
                        class="text-h2 lg:text-h1 font-black font-peyda leading-[1.25]">
                        آماده‌اید <span class="text-champagne-gold">لبخند تازه‌تان</span> را آغاز کنید؟
                    </h2>
                    <p class="mt-5 text-body-range font-peyda text-warm-ivory/80 leading-relaxed max-w-xl">
                        یک جلسه مشاوره رایگان با متخصصان سرو رزرو کنید. ما با دقت به داستان شما گوش می‌دهیم
                        و بهترین مسیر را با هم پیدا می‌کنیم.
                    </p>
                </div>

                <!-- Actions -->
                <div class="lg:col-span-5 flex flex-col gap-4 lg:items-end">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>"
                        class="btn btn-primary w-full sm:w-auto justify-center group">
                        رزرو مشاوره رایگان
                        <svg class="w-4 h-4 ms-2 rtl:rotate-180 group-hover:-translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5-5 5M6 12h12" />
                        </svg>
                    </a>

                    <a href="tel:<?php echo esc_attr($phone_clean); ?>"
                        class="inline-flex items-center justify-center gap-3 w-full sm:w-auto px-8 py-3.5 rounded-brand border-2 border-warm-ivory/30 text-warm-ivory font-peyda font-bold text-body hover:bg-warm-ivory/10 hover:border-warm-ivory/60 transition-all duration-300"
                        dir="ltr">
                        <svg class="w-4 h-4 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span><?php echo esc_html($phone); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>