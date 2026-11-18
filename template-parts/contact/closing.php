<?php

/**
 * Contact — Closing reassurance strip
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$phone = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
?>

<section id="contact-closing" aria-labelledby="contact-closing-title"
    class="relative bg-warm-ivory pb-20 lg:pb-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="border-t border-soft-stone/60 pt-10 lg:pt-12 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 reveal-up">

            <div class="max-w-xl">
                <h2 id="contact-closing-title"
                    class="text-h3 font-peyda font-black text-deep-emerald leading-tight">
                    سوال دیگری دارید؟
                </h2>
                <p class="mt-2 text-body font-peyda text-charcoal/70 leading-relaxed">
                    تیم سرو همیشه در دسترس است — تلفنی، در واتساپ یا از طریق فرم تماس.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="tel:<?php echo esc_attr($phone_clean); ?>"
                    class="btn btn-primary">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    تماس مستقیم
                </a>
                <a href="#contact-form-section"
                    class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-brand border-2 border-deep-emerald/15 text-deep-emerald font-peyda font-bold text-body">
                    پر کردن فرم
                </a>
            </div>
        </div>
    </div>
</section>