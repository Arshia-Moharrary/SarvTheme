<?php

/**
 * Guarantee & Polish Section
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<section id="guarantee" class="py-20 bg-warm-ivory relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- گرید دو ستونه -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

            <!-- کارت ۱: گارانتی -->
            <article class="relative group bg-gradient-to-br from-deep-emerald to-forest-noir rounded-[2rem] p-8 md:p-10 shadow-xl border border-champagne-gold/20 hover:shadow-2xl transition-all duration-500 reveal-up">
                <!-- افکت درخشش پس‌زمینه در هاور -->
                <div class="absolute inset-0 bg-champagne-gold/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[2rem] pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">

                    <!-- مدال برداری (SVG) -->
                    <div class="shrink-0 relative w-32 h-32 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                        <!-- روبان‌های پایین (Ribbons) -->
                        <svg class="absolute -bottom-4 w-24 h-24 text-forest-noir drop-shadow-md" viewBox="0 0 100 100" fill="var(--color-deep-emerald)">
                            <path d="M30,70 L20,100 L40,90 Z" />
                            <path d="M70,70 L80,100 L60,90 Z" />
                        </svg>

                        <!-- دایره اصلی مدال -->
                        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100">
                            <!-- حاشیه طلایی خارجی -->
                            <circle cx="50" cy="50" r="48" fill="none" stroke="currentColor" stroke-width="2" class="text-champagne-gold" />
                            <!-- پس‌زمینه داخلی -->
                            <circle cx="50" cy="50" r="44" fill="currentColor" class="text-deep-emerald" />
                            <!-- حاشیه داخلی طلایی -->
                            <circle cx="50" cy="50" r="42" fill="none" stroke="currentColor" stroke-width="1" stroke-dasharray="4 2" class="text-champagne-gold/50" />
                        </svg>

                        <!-- متن داخل مدال -->
                        <div class="relative z-10 flex flex-col items-center justify-center text-center mt-2">
                            <!-- ستاره‌ها -->
                            <div class="flex gap-1 mb-1 text-champagne-gold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-black text-champagne-gold font-satoshi leading-none" dir="ltr">10</span>
                            <span class="text-xs font-bold text-warm-ivory font-satoshi tracking-widest mt-1" dir="ltr">YEAR</span>
                            <span class="text-[10px] font-medium text-warm-ivory/80 font-peyda mt-1">گارانتی و ضمانت</span>
                        </div>
                    </div>

                    <!-- محتوای متنی -->
                    <div class="text-center md:text-start mt-4 md:mt-0">
                        <h3 class="text-h3 font-bold text-warm-ivory font-peyda mb-3">گارانتی بی‌قید و شرط به مدت ۱۰ سال</h3>
                        <p class="text-body text-warm-ivory/70 font-peyda leading-relaxed">
                            رفع هرگونه مشکل یا آسیب به دندان‌ها، بدون محدودیت و هزینه. ما با ارائه این گارانتی، تضمینی کامل برای آرامش خاطر شما در بلندمدت هستیم.
                        </p>
                    </div>

                </div>
            </article>

            <!-- کارت ۲: پالیش -->
            <article class="relative group bg-gradient-to-br from-deep-emerald to-forest-noir rounded-[2rem] p-8 md:p-10 shadow-xl border border-champagne-gold/20 hover:shadow-2xl transition-all duration-500 reveal-up delay-200">
                <div class="absolute inset-0 bg-champagne-gold/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[2rem] pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">

                    <!-- مدال برداری (SVG) -->
                    <div class="shrink-0 relative w-32 h-32 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                        <svg class="absolute -bottom-4 w-24 h-24 text-forest-noir drop-shadow-md" viewBox="0 0 100 100" fill="var(--color-deep-emerald)">
                            <path d="M30,70 L20,100 L40,90 Z" />
                            <path d="M70,70 L80,100 L60,90 Z" />
                        </svg>

                        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="48" fill="none" stroke="currentColor" stroke-width="2" class="text-champagne-gold" />
                            <circle cx="50" cy="50" r="44" fill="currentColor" class="text-deep-emerald" />
                            <circle cx="50" cy="50" r="42" fill="none" stroke="currentColor" stroke-width="1" stroke-dasharray="4 2" class="text-champagne-gold/50" />
                        </svg>

                        <div class="relative z-10 flex flex-col items-center justify-center text-center mt-2">
                            <div class="flex gap-1 mb-1 text-champagne-gold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <span class="text-3xl font-black text-champagne-gold font-satoshi leading-none" dir="ltr">10</span>
                            <span class="text-xs font-bold text-warm-ivory font-satoshi tracking-widest mt-1" dir="ltr">YEAR</span>
                            <span class="text-[10px] font-medium text-warm-ivory/80 font-peyda mt-1">پالایش رایگان</span>
                        </div>
                    </div>

                    <!-- محتوای متنی -->
                    <div class="text-center md:text-start mt-4 md:mt-0">
                        <h3 class="text-h3 font-bold text-warm-ivory font-peyda mb-3">پالیش رایگان به مدت ۱۰ سال</h3>
                        <p class="text-body text-warm-ivory/70 font-peyda leading-relaxed">
                            براق و صاف کردن دندان‌ها پس از درمان، بدون دریافت هیچ‌گونه هزینه اضافی. لبخند شما همیشه درخشان و بی‌نقص خواهد ماند.
                        </p>
                    </div>

                </div>
            </article>

        </div>
    </div>
</section>