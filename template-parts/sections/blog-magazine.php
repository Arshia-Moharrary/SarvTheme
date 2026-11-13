<?php

/**
 * Blog Magazine Section (Latest Posts)
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<section id="magazine" class="py-24 relative overflow-hidden">

    <!-- المان تزئینی پس‌زمینه -->
    <div class="absolute top-0 start-0 w-64 h-64 bg-warm-ivory opacity-50 rounded-br-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- هدر بخش -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 reveal-up">
            <!-- سمت راست: تیتر -->
            <div class="text-center md:text-start">
                <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                    <svg class="w-6 h-6 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <h2 class="text-h3 font-black text-deep-emerald font-peyda">مجله آموزشی سرو</h2>
                </div>
                <p class="text-body text-charcoal/60 font-peyda ms-9">نکات طلایی برای حفظ سلامت و زیبایی دندان‌های شما</p>
            </div>

            <!-- سمت چپ: دکمه‌های ناوبری Swiper -->
            <div class="flex items-center justify-center md:justify-end gap-3 mt-6 md:mt-0">
                <!-- دکمه قبلی (اشاره به راست در RTL) -->
                <button class="swiper-button-prev sarv-swiper-btn group" aria-label="قبلی">
                    <svg class="transform group-hover:translate-x-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <!-- دکمه بعدی (اشاره به چپ در RTL) -->
                <button class="swiper-button-next sarv-swiper-btn group" aria-label="بعدی">
                    <svg class="transform group-hover:-translate-x-0.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- کانتینر Swiper -->
        <div class="swiper blog-swiper pb-16 reveal-up delay-200">
            <div class="swiper-wrapper">

                <!-- کارت ۱ -->
                <div class="swiper-slide h-auto">
                    <article class="bg-warm-ivory/30 rounded-brand-lg border border-soft-stone/50 overflow-hidden group hover:shadow-[0_20px_40px_-15px_rgba(14,59,50,0.1)] hover:bg-white transition-all duration-500 h-full flex flex-col">
                        <!-- تصویر -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-soft-stone">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/blog-1.jpg'); ?>" alt="مقاله دندانپزشکی" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.src='https://sarvdental.clinic/wp-content/uploads/2026/09/Dental-composite-for-women1-768x433.jpg';">
                            <!-- بج دسته‌بندی -->
                            <div class="absolute top-4 start-4 bg-deep-emerald/90 backdrop-blur-md text-warm-ivory px-3 py-1 rounded-full text-caption font-peyda">
                                سلامت دهان
                            </div>
                        </div>
                        <!-- محتوا -->
                        <div class="p-6 flex flex-col flex-grow">
                            <!-- متادیتا -->
                            <div class="flex items-center gap-4 text-caption text-charcoal/50 font-peyda mb-3">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span dir="ltr">۱۲ مهر ۱۴۰۳</span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>۵ دقیقه مطالعه</span>
                                </span>
                            </div>
                            <!-- تیتر -->
                            <h3 class="text-h4 font-bold text-deep-emerald font-peyda mb-4 leading-tight group-hover:text-champagne-gold transition-colors duration-300">
                                <a href="#" class="line-clamp-2">چگونه دندان‌های خود را سالم و درخشان نگه داریم؟</a>
                            </h3>
                            <!-- لینک مطالعه -->
                            <div class="mt-auto pt-4 border-t border-soft-stone/50 flex items-center justify-between">
                                <a href="#" class="text-body font-bold text-deep-emerald font-peyda flex items-center gap-2 group-hover:text-champagne-gold transition-colors">
                                    ادامه مطلب
                                </a>
                                <svg class="w-5 h-5 text-champagne-gold transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- کارت ۲ -->
                <div class="swiper-slide h-auto">
                    <article class="bg-warm-ivory/30 rounded-brand-lg border border-soft-stone/50 overflow-hidden group hover:shadow-[0_20px_40px_-15px_rgba(14,59,50,0.1)] hover:bg-white transition-all duration-500 h-full flex flex-col">
                        <div class="relative aspect-[16/10] overflow-hidden bg-soft-stone">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/blog-2.jpg'); ?>" alt="مقاله دندانپزشکی" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.src='https://sarvdental.clinic/wp-content/uploads/2026/08/germani-composit-768x433.jpg';">
                            <div class="absolute top-4 start-4 bg-deep-emerald/90 backdrop-blur-md text-warm-ivory px-3 py-1 rounded-full text-caption font-peyda">زیبایی و لمینت</div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-4 text-caption text-charcoal/50 font-peyda mb-3">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg><span dir="ltr">۱۰ مهر ۱۴۰۳</span></span>
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg><span>۳ دقیقه مطالعه</span></span>
                            </div>
                            <h3 class="text-h4 font-bold text-deep-emerald font-peyda mb-4 leading-tight group-hover:text-champagne-gold transition-colors duration-300"><a href="#" class="line-clamp-2">هر آنچه باید درباره لمینت دندان بدانید</a></h3>
                            <div class="mt-auto pt-4 border-t border-soft-stone/50 flex items-center justify-between">
                                <a href="#" class="text-body font-bold text-deep-emerald font-peyda flex items-center gap-2 group-hover:text-champagne-gold transition-colors">ادامه مطلب</a>
                                <svg class="w-5 h-5 text-champagne-gold transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- کارت ۳ -->
                <div class="swiper-slide h-auto">
                    <article class="bg-warm-ivory/30 rounded-brand-lg border border-soft-stone/50 overflow-hidden group hover:shadow-[0_20px_40px_-15px_rgba(14,59,50,0.1)] hover:bg-white transition-all duration-500 h-full flex flex-col">
                        <div class="relative aspect-[16/10] overflow-hidden bg-soft-stone">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/blog-3.jpg'); ?>" alt="مقاله دندانپزشکی" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.src='https://sarvdental.clinic/wp-content/uploads/2026/08/The-Best-Dental-Composite-Brand-768x433.jpg';">
                            <div class="absolute top-4 start-4 bg-deep-emerald/90 backdrop-blur-md text-warm-ivory px-3 py-1 rounded-full text-caption font-peyda">درمان‌های تخصصی</div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-4 text-caption text-charcoal/50 font-peyda mb-3">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg><span dir="ltr">۵ مهر ۱۴۰۳</span></span>
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg><span>۷ دقیقه مطالعه</span></span>
                            </div>
                            <h3 class="text-h4 font-bold text-deep-emerald font-peyda mb-4 leading-tight group-hover:text-champagne-gold transition-colors duration-300"><a href="#" class="line-clamp-2">مراقبت‌های بعد از ایمپلنت دندان</a></h3>
                            <div class="mt-auto pt-4 border-t border-soft-stone/50 flex items-center justify-between">
                                <a href="#" class="text-body font-bold text-deep-emerald font-peyda flex items-center gap-2 group-hover:text-champagne-gold transition-colors">ادامه مطلب</a>
                                <svg class="w-5 h-5 text-champagne-gold transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- کارت ۴ (برای تست اسلایدر) -->
                <div class="swiper-slide h-auto">
                    <article class="bg-warm-ivory/30 rounded-brand-lg border border-soft-stone/50 overflow-hidden group hover:shadow-[0_20px_40px_-15px_rgba(14,59,50,0.1)] hover:bg-white transition-all duration-500 h-full flex flex-col">
                        <div class="relative aspect-[16/10] overflow-hidden bg-soft-stone">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/src/images/blog-4.jpg'); ?>" alt="مقاله دندانپزشکی" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" onerror="this.src='https://sarvdental.clinic/wp-content/uploads/2026/09/Dental-composite-for-men2-768x433.jpg';">
                            <div class="absolute top-4 start-4 bg-deep-emerald/90 backdrop-blur-md text-warm-ivory px-3 py-1 rounded-full text-caption font-peyda">سلامت کودکان</div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-4 text-caption text-charcoal/50 font-peyda mb-3">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg><span dir="ltr">۱ مهر ۱۴۰۳</span></span>
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg><span>۴ دقیقه مطالعه</span></span>
                            </div>
                            <h3 class="text-h4 font-bold text-deep-emerald font-peyda mb-4 leading-tight group-hover:text-champagne-gold transition-colors duration-300"><a href="#" class="line-clamp-2">اولین دندان کودک من؛ چه زمانی باید به دندانپزشک مراجعه کرد؟</a></h3>
                            <div class="mt-auto pt-4 border-t border-soft-stone/50 flex items-center justify-between">
                                <a href="#" class="text-body font-bold text-deep-emerald font-peyda flex items-center gap-2 group-hover:text-champagne-gold transition-colors">ادامه مطلب</a>
                                <svg class="w-5 h-5 text-champagne-gold transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </div>
                        </div>
                    </article>
                </div>

            </div>
            <!-- نقطه‌های صفحه‌بندی (Pagination) در موبایل کاربرد دارد -->
            <div class="swiper-pagination !-bottom-8 flex justify-center gap-2"></div>
        </div>

    </div>
</section>