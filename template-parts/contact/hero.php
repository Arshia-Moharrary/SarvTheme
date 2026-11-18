<?php

/**
 * Contact — Hero + quick contact rail
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$phone = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
$wa_phone = str_starts_with($phone_clean, '0')
    ? '98' . substr($phone_clean, 1)
    : ltrim($phone_clean, '+');
?>

<section id="contact-hero" aria-labelledby="contact-hero-title"
    class="relative bg-warm-ivory pt-12 lg:pt-20 pb-20 lg:pb-28 overflow-hidden">

    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute -top-40 -end-40 w-96 h-96 rounded-full bg-champagne-gold/10 blur-3xl"></div>
        <div class="absolute -bottom-40 -start-40 w-96 h-96 rounded-full bg-deep-emerald/5 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Breadcrumb -->
        <nav aria-label="مسیر صفحه" class="mb-10 lg:mb-14 reveal-fade">
            <ol class="flex items-center gap-2 text-caption font-peyda text-charcoal/60">
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                        class="hover:text-champagne-gold transition-colors duration-300">خانه</a>
                </li>
                <li aria-hidden="true" class="text-soft-stone">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </li>
                <li aria-current="page" class="text-deep-emerald font-bold">تماس با ما</li>
            </ol>
        </nav>

        <!-- Heading block -->
        <header class="max-w-3xl mb-14 lg:mb-16">
            <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                <span class="w-10 h-px bg-champagne-gold"></span>
                با ما در ارتباط باشید
            </span>

            <h1 id="contact-hero-title"
                class="text-h2 sm:text-h1 lg:text-hero font-black font-peyda text-deep-emerald leading-[1.15] tracking-normal reveal-up delay-100">
                بیایید درباره
                <span class="relative inline-block text-champagne-gold">
                    لبخند شما
                    <svg class="absolute -bottom-1 inset-x-0 w-full h-3 text-champagne-gold/40"
                        viewBox="0 0 100 8" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M2 6 Q 50 -2 98 6" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" />
                    </svg>
                </span>
                صحبت کنیم
            </h1>

            <p class="mt-8 text-body-range text-charcoal/75 font-peyda leading-loose max-w-2xl reveal-up delay-200">
                برای رزرو نوبت، مشاوره تخصصی یا هر پرسشی درباره درمان‌ها، تیم سرو آماده پاسخگویی است.
                راه ارتباطی مناسب خود را انتخاب کنید — ما در اولین فرصت با شما همراه خواهیم بود.
            </p>
        </header>

        <!-- Quick-contact rail -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-5 reveal-up delay-300">

            <!-- Call -->
            <a href="tel:<?php echo esc_attr($phone_clean); ?>"
                class="group relative bg-white rounded-brand-lg border border-soft-stone/60 p-6 lg:p-7 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-champagne-gold/50 transition-all duration-500 flex flex-col gap-6">
                <div class="flex items-start justify-between">
                    <span class="w-12 h-12 rounded-brand bg-deep-emerald text-champagne-gold flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </span>
                    <span class="w-9 h-9 rounded-full bg-warm-ivory text-deep-emerald flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </div>
                <div>
                    <p class="text-caption font-peyda text-charcoal/60 font-bold tracking-wider">تماس تلفنی</p>
                    <p class="mt-1.5 text-h4 font-peyda font-black text-deep-emerald leading-snug">
                        <span dir="ltr"><?php echo esc_html($phone); ?></span>
                    </p>
                </div>
            </a>

            <!-- WhatsApp -->
            <a href="https://wa.me/<?php echo esc_attr($wa_phone); ?>" target="_blank" rel="noopener noreferrer"
                class="group relative bg-white rounded-brand-lg border border-soft-stone/60 p-6 lg:p-7 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-champagne-gold/50 transition-all duration-500 flex flex-col gap-6">
                <div class="flex items-start justify-between">
                    <span class="w-12 h-12 rounded-brand bg-deep-emerald text-champagne-gold flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                    </span>
                    <span class="w-9 h-9 rounded-full bg-warm-ivory text-deep-emerald flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </div>
                <div>
                    <p class="text-caption font-peyda text-charcoal/60 font-bold tracking-wider">واتساپ</p>
                    <p class="mt-1.5 text-h4 font-peyda font-black text-deep-emerald leading-snug">گفتگوی فوری</p>
                </div>
            </a>

            <!-- Instagram -->
            <a href="https://www.instagram.com/sarv_international/" target="_blank" rel="noopener noreferrer"
                class="group relative bg-white rounded-brand-lg border border-soft-stone/60 p-6 lg:p-7 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-champagne-gold/50 transition-all duration-500 flex flex-col gap-6">
                <div class="flex items-start justify-between">
                    <span class="w-12 h-12 rounded-brand bg-deep-emerald text-champagne-gold flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.88z" />
                        </svg>
                    </span>
                    <span class="w-9 h-9 rounded-full bg-warm-ivory text-deep-emerald flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </div>
                <div>
                    <p class="text-caption font-peyda text-charcoal/60 font-bold tracking-wider">اینستاگرام</p>
                    <p class="mt-1.5 text-h4 font-peyda font-black text-deep-emerald leading-snug">
                        <span dir="ltr">@sarv_international</span>
                    </p>
                </div>
            </a>
        </div>

        <!-- Hours note -->
        <p class="mt-8 inline-flex items-center gap-2 text-caption font-peyda text-charcoal/60 reveal-fade delay-400">
            <svg class="w-4 h-4 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            پاسخگویی: شنبه تا پنجشنبه، ۹ تا ۲۰
        </p>
    </div>
</section>