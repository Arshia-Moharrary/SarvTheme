<?php

/**
 * About — Team
 *
 * Expected images: /src/images/about/doctor-1.jpg … doctor-4.jpg (600×800)
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$sarv_img = get_template_directory_uri() . '/src/images/about/';

$doctors = [
    [
        'img'         => 'doctor-1.jpg',
        'name'        => 'دکتر سارا احمدی',
        'specialty'   => 'بنیان‌گذار · متخصص ایمپلنت',
        'credentials' => 'بورد تخصصی جراحی فک و صورت',
    ],
    [
        'img'         => 'doctor-2.jpg',
        'name'        => 'دکتر رضا کریمی',
        'specialty'   => 'لمینت و زیبایی',
        'credentials' => 'فلوشیپ طراحی لبخند — ایتالیا',
    ],
    [
        'img'         => 'doctor-3.jpg',
        'name'        => 'دکتر مینا رضایی',
        'specialty'   => 'ارتودنسی',
        'credentials' => 'عضو انجمن ارتودنتیست‌های اروپا',
    ],
    [
        'img'         => 'doctor-4.jpg',
        'name'        => 'دکتر امیر حسینی',
        'specialty'   => 'درمان ریشه (اندودانتیکس)',
        'credentials' => 'بورد تخصصی اندودانتیکس',
    ],
];
?>

<section id="our-team" aria-labelledby="team-title" class="relative bg-soft-stone/20 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="grid grid-cols-1 lg:grid-cols-12 items-end gap-6 lg:gap-12 mb-14 lg:mb-16">
            <div class="lg:col-span-7">
                <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                    <span class="w-10 h-px bg-champagne-gold"></span>
                    تیم متخصصان
                </span>
                <h2 id="team-title"
                    class="text-h2 lg:text-h1 font-black font-peyda text-deep-emerald leading-[1.25] reveal-up delay-100">
                    دست‌اندرکاران <span class="text-champagne-gold">لبخند شما</span>
                </h2>
            </div>
            <div class="lg:col-span-5 reveal-up delay-200">
                <p class="text-body-range text-charcoal/70 font-peyda leading-relaxed max-w-xl">
                    تیمی از متخصصان برجسته که هر یک سال‌ها تجربه و تخصص در حوزه خود دارند — همه زیر یک سقف، برای لبخند شما.
                </p>
            </div>
        </header>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            <?php foreach ($doctors as $i => $doc) : ?>
                <article class="group relative aspect-[3/4] rounded-brand-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 reveal-up delay-<?php echo esc_attr(min(400, ($i + 1) * 100)); ?>">

                    <img src="<?php echo esc_url($sarv_img . $doc['img']); ?>"
                        alt="<?php echo esc_attr($doc['name'] . ' — ' . $doc['specialty']); ?>"
                        class="w-full h-full object-cover bg-soft-stone transition-transform duration-700 group-hover:scale-105"
                        width="600" height="800" loading="lazy" decoding="async">

                    <div class="absolute inset-0 bg-gradient-to-t from-forest-noir via-forest-noir/40 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="absolute inset-x-0 bottom-0 p-5 lg:p-6 text-warm-ivory">
                        <p class="text-caption font-peyda text-champagne-gold font-bold tracking-wider">
                            <?php echo esc_html($doc['specialty']); ?>
                        </p>
                        <h3 class="mt-1.5 lg:text-h4 text-body-range font-peyda font-black leading-snug">
                            <?php echo esc_html($doc['name']); ?>
                        </h3>
                        <p class="mt-1 text-caption font-peyda text-warm-ivory/70">
                            <?php echo esc_html($doc['credentials']); ?>
                        </p>
                    </div>

                    <span class="absolute top-4 end-4 w-9 h-9 rounded-full bg-champagne-gold text-deep-emerald flex items-center justify-center opacity-0 group-hover:opacity-100 -translate-y-2 group-hover:translate-y-0 transition-all duration-300" aria-hidden="true">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>