<?php

/**
 * About — Journey timeline (dark)
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$milestones = [
    ['year' => '۱۳۸۹', 'title' => 'تأسیس کلینیک سرو',      'desc' => 'با یک مطب کوچک دو یونیتی در سعادت‌آباد، سفر ما برای بازآفرینی لبخند آغاز شد.'],
    ['year' => '۱۳۹۳', 'title' => 'راه‌اندازی بخش ایمپلنت دیجیتال', 'desc' => 'اولین مرکز در منطقه با سیستم طراحی و جراحی دیجیتال ایمپلنت.'],
    ['year' => '۱۳۹۷', 'title' => 'دریافت مجوز مرکز تخصصی زیبایی',   'desc' => 'وزارت بهداشت، سرو را به‌عنوان یکی از مراکز مرجع زیبایی لبخند تأیید کرد.'],
    ['year' => '۱۴۰۰', 'title' => 'افتتاح بخش تصویربرداری سه‌بعدی',   'desc' => 'CBCT و اسکنر داخل‌دهانی نسل جدید برای تشخیص دقیق‌تر و درمان کم‌تهاجمی‌تر.'],
    ['year' => '۱۴۰۳', 'title' => 'پذیرش بیش از ۲۰,۰۰۰ بیمار',     'desc' => 'افتخار همراهی با هزاران لبخند در سراسر ایران — و این تازه آغاز راه است.'],
];

$total = count($milestones);
?>

<section id="our-journey" aria-labelledby="journey-title"
    class="relative bg-forest-noir text-warm-ivory py-20 lg:py-28 overflow-hidden">

    <!-- Ambient gold glow -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-1/2 start-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-champagne-gold/5 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-14 lg:gap-x-12 items-start">

            <!-- Left heading (sticky on desktop) -->
            <div class="lg:col-span-4 lg:sticky lg:top-24">
                <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-champagne-gold tracking-widest mb-6 reveal-up">
                    <span class="w-10 h-px bg-champagne-gold"></span>
                    مسیر ما
                </span>
                <h2 id="journey-title"
                    class="text-h2 lg:text-h1 font-black font-peyda text-warm-ivory leading-[1.25] reveal-up delay-100">
                    لحظه‌هایی که <span class="text-champagne-gold">سرو</span> را ساختند
                </h2>
                <p class="mt-6 text-body-range text-warm-ivory/70 font-peyda leading-relaxed reveal-up delay-200">
                    هر سال، یک قدم به هدفمان نزدیک‌تر شدیم — تبدیل شدن به مرجعی که لبخند را جدی می‌گیرد.
                </p>
            </div>

            <!-- Timeline (grid + flex column line) -->
            <ol class="lg:col-span-8 relative">
                <?php foreach ($milestones as $i => $m) : ?>
                    <li class="relative grid grid-cols-[auto_1fr] gap-x-6 lg:gap-x-8 reveal-up delay-<?php echo esc_attr(min(500, ($i + 1) * 100)); ?>">

                        <!-- Timeline column -->
                        <div class="relative flex flex-col items-center pt-2" aria-hidden="true">
                            <span class="w-4 h-4 rounded-full bg-champagne-gold ring-4 ring-forest-noir relative z-10 shrink-0"></span>
                            <?php if ($i < $total - 1) : ?>
                                <span class="flex-1 w-px bg-champagne-gold/30 mt-2"></span>
                            <?php endif; ?>
                        </div>

                        <!-- Content -->
                        <div class="pb-12 last:pb-0">
                            <span class="text-caption font-peyda text-champagne-gold font-bold tracking-widest">
                                <?php echo esc_html($m['year']); ?>
                            </span>
                            <h3 class="mt-2 text-h4 font-peyda font-black text-warm-ivory leading-snug">
                                <?php echo esc_html($m['title']); ?>
                            </h3>
                            <p class="mt-2 text-body font-peyda text-warm-ivory/70 leading-relaxed max-w-prose">
                                <?php echo esc_html($m['desc']); ?>
                            </p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</section>