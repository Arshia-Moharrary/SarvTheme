<?php

/**
 * About — Story (narrative on deep-emerald)
 *
 * Expected image: /src/images/about/story-main.jpg (800×1000)
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$sarv_img = get_template_directory_uri() . '/src/images/about/';
?>

<section id="our-story" aria-labelledby="story-title"
    class="relative bg-deep-emerald text-warm-ivory py-20 lg:py-28 overflow-hidden">

    <!-- Decorative -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-0 start-1/3 w-96 h-96 rounded-full bg-champagne-gold/5 blur-3xl"></div>
        <div class="absolute top-12 end-8 text-champagne-gold/15">
            <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
            </svg>
        </div>
        <div class="absolute bottom-16 start-12 text-warm-ivory/5">
            <svg class="w-24 h-24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
            </svg>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-14 lg:gap-x-12 xl:gap-x-20 items-center">

            <!-- Image (start) -->
            <div class="lg:col-span-5 reveal-up">
                <div class="relative max-w-sm mx-auto lg:mx-0">
                    <figure class="relative aspect-[4/5] rounded-brand-lg overflow-hidden shadow-2xl ring-1 ring-warm-ivory/10 bg-forest-noir">
                        <img src="<?php echo esc_url($sarv_img . 'story-main.png'); ?>"
                            alt="بنیان‌گذار کلینیک سرو"
                            class="w-full h-full object-contain"
                            width="800" height="1000" loading="lazy" decoding="async">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-noir/60 to-transparent"></div>
                    </figure>

                    <!-- Floating quote card -->
                    <div class="hidden md:block absolute -bottom-6 -end-4 lg:-end-8 max-w-[230px] bg-warm-ivory text-deep-emerald rounded-brand-lg p-5 shadow-2xl animate-float-1">
                        <svg class="w-6 h-6 text-champagne-gold mb-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z" />
                        </svg>
                        <p class="text-caption font-peyda leading-relaxed">
                            «هر لبخندی که می‌سازیم، بازتاب اعتماد شماست.»
                        </p>
                        <p class="mt-3 text-caption font-peyda font-bold text-champagne-gold">— تیم سرو</p>
                    </div>
                </div>
            </div>

            <!-- Text (end) -->
            <div class="lg:col-span-7">
                <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-champagne-gold tracking-widest mb-6 reveal-up">
                    <span class="w-10 h-px bg-champagne-gold"></span>
                    داستان ما
                </span>

                <h2 id="story-title"
                    class="text-h2 lg:text-h1 font-black font-peyda text-warm-ivory leading-[1.25] reveal-up delay-100">
                    از یک رویا تا <span class="text-champagne-gold">مرجع تخصصی</span> لبخند در ایران
                </h2>

                <div class="mt-8 space-y-5 text-body-range text-warm-ivory/80 font-peyda leading-loose max-w-2xl reveal-up delay-200">
                    <p>
                        کلینیک سرو در سال ۱۳۸۹ با یک باور ساده آغاز شد: دندانپزشکی تنها درمان نیست، هنر است.
                        هنری که در آن دانش علمی، حس زیبایی‌شناسی و آرامش بیمار در هم می‌آمیزند.
                    </p>
                    <p>
                        امروز پس از بیش از یک دهه، سرو به یکی از معتبرترین مراکز تخصصی زیبایی و ایمپلنت در ایران
                        تبدیل شده است؛ جایی که بیماران از سراسر کشور برای یافتن لبخندی که سال‌ها آرزویش را داشتند،
                        به آن اعتماد می‌کنند.
                    </p>
                </div>

                <!-- Pillars -->
                <ul class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-5 reveal-up delay-300">
                    <?php
                    $pillars = [
                        'تیم چندتخصصی با بیش از ۱۵ سال تجربه',
                        'پروتکل‌های درمانی مطابق استانداردهای بین‌المللی',
                        'تصویربرداری و طراحی دیجیتال لبخند (DSD)',
                        'فضایی آرام و خصوصی برای هر بیمار',
                    ];
                    foreach ($pillars as $p) : ?>
                        <li class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-champagne-gold/15 text-champagne-gold flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="text-body font-peyda text-warm-ivory/90 leading-snug">
                                <?php echo esc_html($p); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <a href="#our-team"
                    class="mt-10 inline-flex items-center gap-3 text-body font-peyda font-bold text-champagne-gold hover:text-warm-ivory transition-colors duration-300 group reveal-up delay-400">
                    <span>آشنایی با متخصصان سرو</span>
                    <span class="w-9 h-9 rounded-full bg-champagne-gold text-deep-emerald flex items-center justify-center group-hover:bg-warm-ivory transition-colors duration-300">
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>