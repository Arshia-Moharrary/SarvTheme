<?php

/**
 * About — Facility & technology
 *
 * Expected images: /src/images/about/facility-1.jpg … facility-4.jpg (600×600)
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$sarv_img = get_template_directory_uri() . '/src/images/about/';

$features = [
    ['title' => 'اسکنر داخل‌دهانی سه‌بعدی', 'desc' => 'بدون قالب‌گیری سنتی — تصویر دیجیتال دقیق در چند ثانیه.'],
    ['title' => 'سیستم CAD/CAM',              'desc' => 'طراحی و ساخت روکش و لمینت در همان جلسه، با دقت میکرونی.'],
    ['title' => 'تصویربرداری CBCT',           'desc' => 'تصاویر سه‌بعدی با کمترین دوز اشعه برای تشخیص دقیق.'],
    ['title' => 'استریلیزاسیون کلاس B',       'desc' => 'استاندارد اروپایی برای استریل کامل تمام ابزارها.'],
];
?>

<section id="our-facility" aria-labelledby="facility-title" class="relative bg-warm-ivory py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-14 lg:gap-x-12 xl:gap-x-20 items-center">

            <!-- Gallery (start) -->
            <div class="lg:col-span-6 xl:col-span-5 reveal-up">
                <div class="grid grid-cols-2 gap-3 sm:gap-4">
                    <figure class="relative aspect-square rounded-brand-lg overflow-hidden shadow-lg bg-soft-stone">
                        <img src="<?php echo esc_url($sarv_img . 'facility-1.jpg'); ?>" alt="فضای درمانی سرو"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                            loading="lazy" decoding="async">
                    </figure>
                    <figure class="relative aspect-square rounded-brand-lg overflow-hidden shadow-lg bg-soft-stone mt-6">
                        <img src="<?php echo esc_url($sarv_img . 'facility-2.jpg'); ?>" alt="تجهیزات پیشرفته"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                            loading="lazy" decoding="async">
                    </figure>
                    <figure class="relative aspect-square rounded-brand-lg overflow-hidden shadow-lg bg-soft-stone -mt-6">
                        <img src="<?php echo esc_url($sarv_img . 'facility-3.jpg'); ?>" alt="اتاق انتظار سرو"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                            loading="lazy" decoding="async">
                    </figure>
                    <figure class="relative aspect-square rounded-brand-lg overflow-hidden shadow-lg bg-soft-stone">
                        <img src="<?php echo esc_url($sarv_img . 'facility-4.jpg'); ?>" alt="تیم درمانی در حال کار"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700"
                            loading="lazy" decoding="async">
                    </figure>
                </div>
            </div>

            <!-- Content (end) -->
            <div class="lg:col-span-6 xl:col-span-7">
                <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                    <span class="w-10 h-px bg-champagne-gold"></span>
                    محیط و تجهیزات
                </span>
                <h2 id="facility-title"
                    class="text-h2 lg:text-h1 font-black font-peyda text-deep-emerald leading-[1.25] reveal-up delay-100">
                    فناوری پیشرفته، در <span class="text-champagne-gold">فضایی آرام</span>
                </h2>
                <p class="mt-6 text-body-range text-charcoal/70 font-peyda leading-relaxed max-w-2xl reveal-up delay-200">
                    ما باور داریم فناوری باید در خدمت راحتی بیمار باشد، نه برعکس. هر دستگاه در سرو، با هدف
                    کوتاه‌تر کردن مسیر درمان و آرامش بیشتر شما انتخاب شده است.
                </p>

                <dl class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 reveal-up delay-300">
                    <?php foreach ($features as $f) : ?>
                        <div class="flex items-start gap-4">
                            <span class="w-10 h-10 rounded-full bg-deep-emerald text-champagne-gold flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <div>
                                <dt class="text-body font-peyda font-bold text-deep-emerald leading-snug">
                                    <?php echo esc_html($f['title']); ?>
                                </dt>
                                <dd class="mt-1 text-caption font-peyda text-charcoal/60 leading-relaxed">
                                    <?php echo esc_html($f['desc']); ?>
                                </dd>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </dl>
            </div>
        </div>
    </div>
</section>