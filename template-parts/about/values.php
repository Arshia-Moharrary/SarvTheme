<?php

/**
 * About — Values (four principles)
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;
?>

<section id="our-values" aria-labelledby="values-title" class="relative bg-warm-ivory py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="max-w-3xl mb-14 lg:mb-16">
            <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                <span class="w-10 h-px bg-champagne-gold"></span>
                ارزش‌های ما
            </span>
            <h2 id="values-title"
                class="text-h2 lg:text-h1 font-black font-peyda text-deep-emerald leading-[1.25] reveal-up delay-100">
                چهار اصلی که هر <span class="text-champagne-gold">لبخند سرو</span> را می‌سازد
            </h2>
            <p class="mt-6 text-body-range text-charcoal/70 font-peyda leading-relaxed reveal-up delay-200">
                آنچه ما را از یک کلینیک معمولی متمایز می‌کند، پایبندی بی‌قید و شرط به این چهار اصل است.
            </p>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <?php
            $values = [
                [
                    'num' => '۰۱',
                    'title' => 'دقت علمی',
                    'desc' => 'هر طرح درمان بر پایه تشخیص دقیق، تصویربرداری دیجیتال و پروتکل‌های بین‌المللی طراحی می‌شود.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>',
                ],
                [
                    'num' => '۰۲',
                    'title' => 'زیبایی‌شناسی',
                    'desc' => 'لبخند سرو، نتیجه طراحی چهره‌محور است؛ هر لبخند متناسب با خطوط و ویژگی‌های منحصربه‌فرد صورت شما.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
                ],
                [
                    'num' => '۰۳',
                    'title' => 'راحتی بیمار',
                    'desc' => 'از اولین تماس تا پایان دوره بهبودی، آرامش و آسایش شما در اولویت هر تصمیم ما قرار دارد.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
                ],
                [
                    'num' => '۰۴',
                    'title' => 'صداقت و شفافیت',
                    'desc' => 'پیش از هر درمان، تمام گزینه‌ها، هزینه‌ها و نتایج ممکن را صادقانه با شما در میان می‌گذاریم.',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',
                ],
            ];

            foreach ($values as $i => $v) : ?>
                <article class="group relative bg-white rounded-brand-lg border border-soft-stone/60 p-7 lg:p-8 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-champagne-gold/50 transition-all duration-500 reveal-up delay-<?php echo esc_attr(($i + 1) * 100); ?>">

                    <!-- Watermark number -->
                    <span class="absolute top-5 end-6 text-h1 font-black text-soft-stone/50 font-peyda leading-none select-none"
                        aria-hidden="true"><?php echo esc_html($v['num']); ?></span>

                    <!-- Icon -->
                    <span class="relative w-12 h-12 rounded-brand bg-deep-emerald text-champagne-gold flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <?php echo $v['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG 
                            ?>
                        </svg>
                    </span>

                    <h3 class="text-h4 font-peyda font-black text-deep-emerald leading-snug">
                        <?php echo esc_html($v['title']); ?>
                    </h3>
                    <p class="mt-3 text-body font-peyda text-charcoal/70 leading-relaxed">
                        <?php echo esc_html($v['desc']); ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>