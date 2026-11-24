<?php

/**
 * Template Name: Services Page
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();

// Dynamic URL fetching for services to ensure navigation works securely
// Replace 'composite', 'implant', 'veneer', 'whitening' with the actual slugs of your landing pages.
$page_composite = get_page_by_path('composite');
$page_implant   = get_page_by_path('implant');
$page_veneer    = get_page_by_path('veneer');
$page_whitening = get_page_by_path('whitening');

$url_composite = $page_composite ? get_permalink($page_composite->ID) : '#';
$url_implant   = $page_implant ? get_permalink($page_implant->ID) : '#';
$url_veneer    = $page_veneer ? get_permalink($page_veneer->ID) : '#';
$url_whitening = $page_whitening ? get_permalink($page_whitening->ID) : '#';

// Array of services to keep the markup clean and maintainable
$services = [
    [
        'id'    => '01',
        'title' => 'کامپوزیت دندان',
        'desc'  => 'بازسازی زیبایی لبخند با کامپوزیت‌های نسل جدید، بدون آسیب به مینای دندان و با نتایجی طبیعی و ماندگار.',
        'url'   => $url_composite,
        'img'   => get_template_directory_uri() . '/src/images/services/composite.jpg',
    ],
    [
        'id'    => '02',
        'title' => 'ایمپلنت دندان',
        'desc'  => 'جایگزینی دائمی دندان‌های از دست رفته با تکنولوژی دیجیتال و متریال پیشرفته، برای استحکام و عملکردی مانند دندان طبیعی.',
        'url'   => $url_implant,
        'img'   => get_template_directory_uri() . '/src/images/services/implant.jpg',
    ],
    [
        'id'    => '03',
        'title' => 'لمینت دندان',
        'desc'  => 'طراحی اختصاصی لبخند (Smile Design) با لمینت‌های سرامیکی نازک، برای اصلاح فرم، رنگ و تقارن دندان‌ها.',
        'url'   => $url_veneer,
        'img'   => get_template_directory_uri() . '/src/images/services/veneer.jpg',
    ],
    [
        'id'    => '04',
        'title' => 'بلیچینگ دندان',
        'desc'  => 'روشن‌سازی ایمن و تخصصی رنگ دندان‌ها با استفاده از مواد استاندارد، برای داشتن لبخندی شفاف، درخشان و جوان‌تر.',
        'url'   => $url_whitening,
        'img'   => get_template_directory_uri() . '/src/images/services/whitening.jpg',
    ]
];
?>

<!-- ========================================== -->
<!-- Page Hero -->
<!-- ========================================== -->
<section class="pt-28 pb-20 md:pt-32 md:pb-28 bg-warm-ivory overflow-hidden relative">
    <!-- Abstract Decorative Elements -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-champagne-gold/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-deep-emerald/5 rounded-full blur-3xl translate-y-1/3 -translate-x-1/3"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-3 mb-6 reveal-up">
                <span class="w-8 h-px bg-champagne-gold"></span>
                <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">تخصص ما</span>
            </div>
            <h1 class="text-h1 md:text-hero font-black text-deep-emerald leading-tight mb-6 reveal-up delay-100">
                هنر خلق <br class="hidden md:block"> لبخندهای ماندگار
            </h1>
            <p class="text-body-range md:text-xl text-charcoal/70 leading-relaxed font-peyda max-w-2xl reveal-up delay-200">
                در کلینیک دندانپزشکی سرو، ما باور داریم که هر لبخند داستانی منحصر به فرد دارد. خدمات تخصصی ما با بالاترین استانداردهای زیبایی‌شناسی و تکنولوژی روز دنیا، در خدمت شماست.
            </p>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- Services Editorial Grid -->
<!-- ========================================== -->
<section class="pb-32 bg-warm-ivory relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 lg:gap-24 items-start">

            <!-- Left Column (Items 1 & 3) -->
            <div class="flex flex-col gap-16 md:gap-24 lg:gap-32">

                <!-- Service 1 -->
                <a href="<?php echo esc_url($services[0]['url']); ?>" class="group block relative reveal-up focus:outline-none focus-visible:ring-4 focus-visible:ring-champagne-gold rounded-brand-lg transition-all duration-500">
                    <div class="relative aspect-[4/5] w-full rounded-brand-lg overflow-hidden bg-forest-noir shadow-xl">
                        <img src="<?php echo esc_url($services[0]['img']); ?>" alt="<?php echo esc_attr($services[0]['title']); ?>" loading="lazy" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-noir via-forest-noir/40 to-transparent opacity-90 transition-opacity duration-500"></div>

                        <div class="absolute bottom-0 left-0 w-full p-8 md:p-10 flex flex-col items-start">
                            <span class="text-champagne-gold font-satoshi font-bold text-xl mb-3 block tracking-wider"><?php echo esc_html($services[0]['id']); ?></span>
                            <h2 class="text-warm-ivory text-h3 md:text-h2 font-black font-peyda mb-4 group-hover:text-champagne-gold transition-colors duration-300"><?php echo esc_html($services[0]['title']); ?></h2>
                            <p class="text-warm-ivory/80 font-peyda text-body mb-8 line-clamp-3"><?php echo esc_html($services[0]['desc']); ?></p>
                            <span class="inline-flex items-center gap-3 text-champagne-gold font-peyda text-body font-bold group-hover:gap-5 transition-all duration-300">
                                <span>مشاهده جزئیات</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Service 3 -->
                <a href="<?php echo esc_url($services[2]['url']); ?>" class="group block relative reveal-up delay-200 focus:outline-none focus-visible:ring-4 focus-visible:ring-champagne-gold rounded-brand-lg transition-all duration-500">
                    <div class="relative aspect-[4/5] w-full rounded-brand-lg overflow-hidden bg-forest-noir shadow-xl">
                        <img src="<?php echo esc_url($services[2]['img']); ?>" alt="<?php echo esc_attr($services[2]['title']); ?>" loading="lazy" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-noir via-forest-noir/40 to-transparent opacity-90 transition-opacity duration-500"></div>

                        <div class="absolute bottom-0 left-0 w-full p-8 md:p-10 flex flex-col items-start">
                            <span class="text-champagne-gold font-satoshi font-bold text-xl mb-3 block tracking-wider"><?php echo esc_html($services[2]['id']); ?></span>
                            <h2 class="text-warm-ivory text-h3 md:text-h2 font-black font-peyda mb-4 group-hover:text-champagne-gold transition-colors duration-300"><?php echo esc_html($services[2]['title']); ?></h2>
                            <p class="text-warm-ivory/80 font-peyda text-body mb-8 line-clamp-3"><?php echo esc_html($services[2]['desc']); ?></p>
                            <span class="inline-flex items-center gap-3 text-champagne-gold font-peyda text-body font-bold group-hover:gap-5 transition-all duration-300">
                                <span>مشاهده جزئیات</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Right Column (Items 2 & 4) with Staggered offset -->
            <div class="flex flex-col gap-16 md:gap-24 lg:gap-32 md:mt-32 lg:mt-48">

                <!-- Service 2 -->
                <a href="<?php echo esc_url($services[1]['url']); ?>" class="group block relative reveal-up delay-100 focus:outline-none focus-visible:ring-4 focus-visible:ring-champagne-gold rounded-brand-lg transition-all duration-500">
                    <div class="relative aspect-[4/5] w-full rounded-brand-lg overflow-hidden bg-forest-noir shadow-xl">
                        <img src="<?php echo esc_url($services[1]['img']); ?>" alt="<?php echo esc_attr($services[1]['title']); ?>" loading="lazy" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-noir via-forest-noir/40 to-transparent opacity-90 transition-opacity duration-500"></div>

                        <div class="absolute bottom-0 left-0 w-full p-8 md:p-10 flex flex-col items-start">
                            <span class="text-champagne-gold font-satoshi font-bold text-xl mb-3 block tracking-wider"><?php echo esc_html($services[1]['id']); ?></span>
                            <h2 class="text-warm-ivory text-h3 md:text-h2 font-black font-peyda mb-4 group-hover:text-champagne-gold transition-colors duration-300"><?php echo esc_html($services[1]['title']); ?></h2>
                            <p class="text-warm-ivory/80 font-peyda text-body mb-8 line-clamp-3"><?php echo esc_html($services[1]['desc']); ?></p>
                            <span class="inline-flex items-center gap-3 text-champagne-gold font-peyda text-body font-bold group-hover:gap-5 transition-all duration-300">
                                <span>مشاهده جزئیات</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Service 4 -->
                <a href="<?php echo esc_url($services[3]['url']); ?>" class="group block relative reveal-up delay-300 focus:outline-none focus-visible:ring-4 focus-visible:ring-champagne-gold rounded-brand-lg transition-all duration-500">
                    <div class="relative aspect-[4/5] w-full rounded-brand-lg overflow-hidden bg-forest-noir shadow-xl">
                        <img src="<?php echo esc_url($services[3]['img']); ?>" alt="<?php echo esc_attr($services[3]['title']); ?>" loading="lazy" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-noir via-forest-noir/40 to-transparent opacity-90 transition-opacity duration-500"></div>

                        <div class="absolute bottom-0 left-0 w-full p-8 md:p-10 flex flex-col items-start">
                            <span class="text-champagne-gold font-satoshi font-bold text-xl mb-3 block tracking-wider"><?php echo esc_html($services[3]['id']); ?></span>
                            <h2 class="text-warm-ivory text-h3 md:text-h2 font-black font-peyda mb-4 group-hover:text-champagne-gold transition-colors duration-300"><?php echo esc_html($services[3]['title']); ?></h2>
                            <p class="text-warm-ivory/80 font-peyda text-body mb-8 line-clamp-3"><?php echo esc_html($services[3]['desc']); ?></p>
                            <span class="inline-flex items-center gap-3 text-champagne-gold font-peyda text-body font-bold group-hover:gap-5 transition-all duration-300">
                                <span>مشاهده جزئیات</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- Elegant Closing CTA -->
<!-- ========================================== -->
<section class="pb-32 bg-warm-ivory relative">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-forest-noir rounded-[2.5rem] p-10 md:p-16 text-center relative overflow-hidden shadow-2xl reveal-up">
            <!-- Subtle decorative gold glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-champagne-gold/10 rounded-full blur-3xl pointer-events-none"></div>

            <h2 class="text-h2 md:text-h1 font-black text-warm-ivory mb-6 relative z-10 font-peyda">آماده‌اید لبخند رویایی‌تان را بسازید؟</h2>
            <p class="text-warm-ivory/70 text-body-range md:text-xl mb-10 max-w-2xl mx-auto relative z-10 font-peyda">تیم متخصصین ما آماده ارائه مشاوره تخصصی و طراحی اختصاصی لبخند شما هستند.</p>

            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="group inline-flex items-center gap-3 bg-champagne-gold text-deep-emerald ps-8 pe-2 py-2 rounded-brand font-peyda font-bold text-body shadow-lg hover:bg-warm-ivory transition-all duration-300 hover:-translate-y-0.5 relative z-10">
                <span>مشاوره رایگان</span>
                <span class="w-10 h-10 rounded-full bg-deep-emerald text-champagne-gold flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                    <svg class="w-5 h-5 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

<?php
get_footer();
