<?php

/**
 * About — Patient testimonials
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$testimonials = [
    [
        'quote'  => 'سال‌ها از لبخندم خجالت می‌کشیدم. تیم سرو با صبر و دقت، لبخندی ساختند که حالا با افتخار نشانش می‌دهم.',
        'name'   => 'مریم ک.',
        'detail' => 'لمینت سرامیکی · تهران',
    ],
    [
        'quote'  => 'چیزی که بیش از همه برایم مهم بود، صداقتشان بود. همه گزینه‌ها را شفاف توضیح دادند و هیچ درمانی را بدون توضیح انجام ندادند.',
        'name'   => 'علی ر.',
        'detail' => 'ایمپلنت دیجیتال · کرج',
    ],
    [
        'quote'  => 'دخترم از دندانپزشکی می‌ترسید. برخورد آرام و حرفه‌ای دکتر رضایی باعث شد امروز با اشتیاق به مطب بیاید.',
        'name'   => 'سمیرا م.',
        'detail' => 'ارتودنسی کودکان · تهران',
    ],
];
?>

<section id="patient-voices" aria-labelledby="testimonials-title" class="relative bg-soft-stone/20 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="max-w-3xl mb-14 lg:mb-16">
            <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                <span class="w-10 h-px bg-champagne-gold"></span>
                روایت بیماران
            </span>
            <h2 id="testimonials-title"
                class="text-h2 lg:text-h1 font-black font-peyda text-deep-emerald leading-[1.25] reveal-up delay-100">
                لبخندهایی که <span class="text-champagne-gold">داستان شدند</span>
            </h2>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <?php foreach ($testimonials as $i => $t) : ?>
                <figure class="group relative bg-white rounded-brand-lg border border-soft-stone/60 p-7 lg:p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col reveal-up delay-<?php echo esc_attr(($i + 1) * 100); ?>">

                    <!-- Gold quote mark -->
                    <svg class="w-8 h-8 text-champagne-gold/60 mb-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                    </svg>

                    <blockquote class="text-body-range font-peyda text-charcoal/80 leading-relaxed flex-1">
                        «<?php echo esc_html($t['quote']); ?>»
                    </blockquote>

                    <figcaption class="mt-6 pt-5 border-t border-soft-stone/60 flex items-center gap-3">
                        <!-- Initials avatar -->
                        <span class="w-10 h-10 rounded-full bg-deep-emerald text-champagne-gold flex items-center justify-center font-peyda font-black text-body shrink-0" aria-hidden="true">
                            <?php echo esc_html(mb_substr($t['name'], 0, 1)); ?>
                        </span>
                        <div>
                            <p class="text-body font-peyda font-bold text-deep-emerald leading-tight">
                                <?php echo esc_html($t['name']); ?>
                            </p>
                            <p class="text-caption font-peyda text-charcoal/60 mt-0.5">
                                <?php echo esc_html($t['detail']); ?>
                            </p>
                        </div>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>