<?php

/**
 * Contact — Branches + map
 *
 * Branch list and map coordinates are preserved verbatim from the
 * old Flatsome page. No per-branch street addresses are invented
 * (none were provided).
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$tehran_branches = [
    'نیاوران',
    'فرمانیه',
    'سعادت آباد',
    'فرشته',
    'جردن',
    'کامرانیه',
    'زعفرانیه',
];

// Coordinates from the old page's iframe (قیطریه).
$map_lat = '35.7659414';
$map_lng = '51.4144517';
$map_embed_url = add_query_arg(
    [
        'q'      => $map_lat . ',' . $map_lng,
        'hl'     => 'fa',
        'z'      => '16',
        'output' => 'embed',
    ],
    'https://www.google.com/maps'
);
$map_directions_url = 'https://www.google.com/maps/dir/?api=1&destination=' . $map_lat . ',' . $map_lng;
?>

<section id="our-locations" aria-labelledby="locations-title"
    class="relative bg-warm-ivory py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="max-w-3xl mb-14 lg:mb-16">
            <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                <span class="w-10 h-px bg-champagne-gold"></span>
                شعبه‌های سرو
            </span>
            <h2 id="locations-title"
                class="text-h2 lg:text-h1 font-black font-peyda text-deep-emerald leading-[1.25] reveal-up delay-100">
                از قلب تهران تا <span class="text-champagne-gold">جزیره کیش</span>
            </h2>
            <p class="mt-6 text-body-range text-charcoal/70 font-peyda leading-relaxed reveal-up delay-200">
                نزدیک‌ترین شعبه به شما، همیشه در دسترس است — با همان استاندارد و همان تیم تخصصی.
            </p>
        </header>

        <!-- Featured branch + map -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 mb-10 lg:mb-12">

            <!-- Main branch card -->
            <div class="lg:col-span-5 order-2 lg:order-1 reveal-up">
                <div class="bg-white rounded-brand-lg border border-soft-stone/60 p-7 lg:p-8 shadow-sm h-full flex flex-col">

                    <span class="inline-flex items-center gap-2 text-caption font-peyda font-bold text-champagne-gold tracking-wider mb-4">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        شعبه مرکزی
                    </span>

                    <h3 class="text-h3 font-peyda font-black text-deep-emerald leading-tight">
                        سرو — قیطریه
                    </h3>

                    <p class="mt-3 text-body font-peyda text-charcoal/70 leading-relaxed">
                        تهران، قیطریه — شعبه مرکزی سرو
                    </p>

                    <dl class="mt-6 pt-6 border-t border-soft-stone/60 space-y-4 flex-1">
                        <div class="flex items-start gap-3">
                            <span class="w-9 h-9 rounded-full bg-warm-ivory text-champagne-gold flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <div>
                                <dt class="text-caption font-peyda text-charcoal/60">ساعات کاری</dt>
                                <dd class="text-body font-peyda font-bold text-deep-emerald mt-0.5">
                                    شنبه تا پنجشنبه، ۹ تا ۲۰
                                </dd>
                            </div>
                        </div>
                    </dl>

                    <a href="<?php echo esc_url($map_directions_url); ?>"
                        target="_blank" rel="noopener noreferrer"
                        class="mt-6 inline-flex items-center justify-center gap-2 w-full px-6 py-3.5 rounded-brand border-2 border-deep-emerald/15 text-deep-emerald font-peyda font-bold text-body">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        مسیریابی
                    </a>
                </div>
            </div>

            <!-- Map -->
            <div class="lg:col-span-7 order-1 lg:order-2 reveal-up delay-100">
                <div class="relative rounded-brand-lg overflow-hidden shadow-2xl ring-1 ring-deep-emerald/10 bg-forest-noir aspect-[4/3] sm:aspect-[16/10] lg:aspect-auto lg:h-full lg:min-h-[420px]">

                    <iframe
                        src="<?php echo esc_url($map_embed_url); ?>"
                        title="نقشه شعبه مرکزی سرو — قیطریه"
                        class="absolute inset-0 w-full h-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>

                    <!-- Corner badge -->
                    <div class="absolute top-4 start-4 bg-white/95 backdrop-blur-sm rounded-brand px-3 py-2 shadow-lg pointer-events-none">
                        <p class="text-caption font-peyda font-bold text-deep-emerald flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-champagne-gold"></span>
                            شعبه مرکزی — قیطریه
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other branches -->
        <div class="reveal-up">

            <div class="flex items-baseline justify-between gap-4 mb-6">
                <h3 class="text-h4 font-peyda font-black text-deep-emerald">سایر شعبه‌های تهران</h3>
                <span class="text-caption font-peyda text-charcoal/60">
                    <?php echo esc_html(strtr((string) count($tehran_branches), ['0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹'])); ?>
                    شعبه
                </span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-3">
                <?php foreach ($tehran_branches as $branch) : ?>
                    <div class="bg-white rounded-brand border border-soft-stone/60 px-4 py-3 text-center hover:border-champagne-gold/60 hover:shadow-md transition-all duration-300">
                        <p class="text-body font-peyda font-bold text-deep-emerald">
                            <?php echo esc_html($branch); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Kish -->
            <div class="mt-8 bg-white rounded-brand-lg border border-champagne-gold/40 p-6 lg:p-7 flex flex-col sm:flex-row items-start sm:items-center gap-4 reveal-up delay-200">
                <span class="w-12 h-12 rounded-full bg-champagne-gold/15 text-champagne-gold flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </span>
                <div class="flex-1">
                    <p class="text-caption font-peyda text-charcoal/60 font-bold tracking-wider">شعبه جنوبی</p>
                    <h4 class="mt-0.5 text-h4 font-peyda font-black text-deep-emerald">جزیره کیش</h4>
                    <p class="mt-1 text-body font-peyda text-charcoal/70">
                        یکی دیگر از شعبه‌های سرو در جنوب ایران
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>