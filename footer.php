<?php

/**
 * The footer for our theme
 *
 * @package Sarv
 */

// جلوگیری از دسترسی مستقیم
if (! defined('ABSPATH')) {
    exit;
}
?></main><!-- #primary -->

<footer id="colophon" class="site-footer bg-warm-ivory pt-16 pb-12 relative font-peyda overflow-hidden">

    <!-- ========================================== -->
    <!-- ۱. نوار بالایی (Top Banner) -->
    <!-- ========================================== -->
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-deep-emerald rounded-[2.5rem] p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden shadow-2xl">
            <div class="flex md:flex-row flex-col gap-10">
                <!-- لوگو (سمت راست در RTL - شروع) -->
                <div class="w-full md:w-fit flex justify-center md:justify-start shrink-0 border-b md:border-l md:border-b-transparent border-white/15 md:pl-10 md:pb-0 pb-10">
                    <div class="flex flex-col items-center text-warm-ivory">
                        <!-- <svg class="w-12 h-12 mb-6 text-warm-ivory" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg> -->
                        <!-- <div class="w-15 h-15 mb-6 rounded-full">
                        <img class="w-full h-full rounded-full object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/src/images/logo/logo3.jpg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </div> -->
                        <div class="logo-badge mb-6 w-20 h-20 lg:w-24 lg:h-24 xl:w-20 xl:h-20 rounded-full bg-white p-1 ring-1 ring-champagne-gold/40 shadow-[0_12px_32px_-8px_rgba(8,42,36,0.28)] hover:ring-champagne-gold hover:shadow-[0_16px_40px_-8px_rgba(8,42,36,0.36)] transition-all duration-500">
                            <div class="w-full h-full rounded-full overflow-hidden bg-warm-ivory">
                                <img class="w-full h-full object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/src/images/logo/logo3.jpg'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                <?php
                                // when real logo is set in dashboard:
                                // if ( has_custom_logo() ) { the_custom_logo(); }
                                ?>
                            </div>
                        </div>
                        <span class="text-h3 font-black tracking-widest text-warm-ivory leading-none">کلینیک</span>
                        <span class="text-h3 font-black tracking-widest text-warm-ivory leading-none mt-1">سرو</span>
                    </div>
                </div>

                <!-- متن (مرکز) -->
                <div class="w-full md:w-[50%] text-right text-warm-ivory/90 text-body md:text-body-range leading-relaxed font-medium">
                    در کلینیک سرو، ما لبخند شما را می‌سازیم! سال‌هاست چهره‌های شناخته‌شده، از فوتبالیست‌ها تا بازیگران، به ما اعتماد دارند. شما هم همین امروز وقت رزرو کنید و تجربه‌ای متفاوت داشته باشید.
                </div>
            </div>

            <!-- تصویر نقشه (سمت چپ در RTL - انتها) -->
            <div class="w-full md:w-[25%] h-28 md:h-36 rounded-2xl overflow-hidden relative border border-warm-ivory/10 shrink-0">
                <div class="absolute inset-0 bg-forest-noir/40 mix-blend-overlay z-10"></div>
                <!-- Placeholder for Map Image -->
                <svg class="w-full h-full object-cover opacity-30" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" class="text-warm-ivory" />
                    </pattern>
                    <rect width="100" height="100" fill="url(#grid)" />
                    <!-- Abstract map lines -->
                    <path d="M10,50 Q30,20 50,50 T90,40" fill="none" stroke="currentColor" stroke-width="2" class="text-champagne-gold opacity-50" />
                    <path d="M20,80 Q40,60 60,90 T100,70" fill="none" stroke="currentColor" stroke-width="1.5" class="text-warm-ivory opacity-40" />
                    <circle cx="50" cy="50" r="3" fill="currentColor" class="text-champagne-gold" />
                </svg>
            </div>

            <!-- المان‌های تزئینی پس‌زمینه بنر -->
            <div class="absolute -bottom-8 start-[20%] text-warm-ivory/5 pointer-events-none">
                <svg class="w-32 h-32" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- ۲. بدنه اصلی فوتر (Main Dark Card) -->
    <!-- ========================================== -->
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 mt-6 relative z-10">
        <div class="bg-forest-noir rounded-[2.5rem] relative overflow-hidden pb-24">

            <!-- المان‌های تزئینی (صلیب‌های طلایی) -->
            <div class="absolute top-12 start-8 text-champagne-gold/20 pointer-events-none hidden lg:block">
                <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
            </div>
            <div class="absolute bottom-32 end-12 text-champagne-gold/20 pointer-events-none hidden lg:block">
                <svg class="w-14 h-14" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
            </div>
            <div class="absolute top-1/2 start-1/2 -translate-x-1/2 text-warm-ivory/5 pointer-events-none">
                <svg class="w-64 h-64" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
            </div>

            <!-- محتوای اصلی (گرید) -->
            <div class="p-8 md:p-12 lg:p-16 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 relative z-10">

                <!-- ستون‌های لینک (سمت راست در RTL - شروع) -->
                <div class="lg:col-span-7 order-2 lg:order-1 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

                    <!-- ستون ۱ -->
                    <div class="flex flex-col gap-8">
                        <!-- بخش اول -->
                        <div>
                            <h4 class="text-champagne-gold font-bold text-h4 mb-5 flex flex-col gap-2">
                                راهنمای خرید
                                <span class="w-8 h-0.5 bg-champagne-gold/50 rounded-full"></span>
                            </h4>
                            <ul class="flex flex-col gap-3 text-warm-ivory/70 text-body">
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">ثبت سفارش</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">نحوه ارسال سفارش</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">شیوه های پرداخت</a></li>
                            </ul>
                        </div>
                        <!-- بخش دوم -->
                        <div>
                            <h4 class="text-champagne-gold font-bold text-h4 mb-5 flex flex-col gap-2">
                                خدمات سایت
                                <span class="w-8 h-0.5 bg-champagne-gold/50 rounded-full"></span>
                            </h4>
                            <ul class="flex flex-col gap-3 text-warm-ivory/70 text-body">
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">برآورد قیمت</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">نوبت حضوری</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">مشاوره آنلاین</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- ستون ۲ -->
                    <div class="flex flex-col gap-8">
                        <!-- بخش اول -->
                        <div>
                            <h4 class="text-champagne-gold font-bold text-h4 mb-5 flex flex-col gap-2">
                                دسترسی سریع
                                <span class="w-8 h-0.5 bg-champagne-gold/50 rounded-full"></span>
                            </h4>
                            <ul class="flex flex-col gap-3 text-warm-ivory/70 text-body">
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">تماس با ما</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">متخصصان</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">وبلاگ</a></li>
                            </ul>
                        </div>
                        <!-- بخش دوم -->
                        <div>
                            <h4 class="text-champagne-gold font-bold text-h4 mb-5 flex flex-col gap-2">
                                تخصص های ما
                                <span class="w-8 h-0.5 bg-champagne-gold/50 rounded-full"></span>
                            </h4>
                            <ul class="flex flex-col gap-3 text-warm-ivory/70 text-body">
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">قلب و عروق</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">داخلی</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">زنان و زایمان</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- ستون ۳ -->
                    <div class="flex flex-col gap-8">
                        <!-- بخش اول -->
                        <div>
                            <h4 class="text-champagne-gold font-bold text-h4 mb-5 flex flex-col gap-2">
                                خدمات مشتریان
                                <span class="w-8 h-0.5 bg-champagne-gold/50 rounded-full"></span>
                            </h4>
                            <ul class="flex flex-col gap-3 text-warm-ivory/70 text-body">
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">سوالات متداول</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">حریم خصوصی</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">نحوه بازگشت وجه</a></li>
                            </ul>
                        </div>
                        <!-- بخش دوم -->
                        <div>
                            <h4 class="text-champagne-gold font-bold text-h4 mb-5 flex flex-col gap-2">
                                فروشگاه سایت
                                <span class="w-8 h-0.5 bg-champagne-gold/50 rounded-full"></span>
                            </h4>
                            <ul class="flex flex-col gap-3 text-warm-ivory/70 text-body">
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">محصولات سلامتی</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">تجهیزات پزشکی</a></li>
                                <li><a href="#" class="hover:text-champagne-gold transition-colors duration-300">مراقبت‌های پوستی</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- کارت سفید اطلاعات (سمت چپ در RTL - انتها) -->
                <div class="lg:col-span-5 order-1 lg:order-2 flex flex-col justify-center">
                    <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-2xl relative w-full max-w-md mx-auto lg:mx-0 lg:ms-auto">

                        <!-- آیتم: پشتیبانی -->
                        <div class="flex items-center justify-between border-b border-soft-stone/60 pb-5 mb-5">
                            <div class="flex flex-col items-center text-center w-full">
                                <div class="w-10 h-10 rounded-full bg-warm-ivory flex items-center justify-center text-champagne-gold mb-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <h5 class="text-deep-emerald font-bold text-body mb-1">واحد پشتیبانی</h5>
                                <p class="text-charcoal/60 text-caption font-medium" dir="ltr">021-66547867 | 021-6653567</p>
                            </div>
                        </div>

                        <!-- آیتم: آدرس -->
                        <div class="flex items-center justify-between border-b border-soft-stone/60 pb-5 mb-5">
                            <div class="flex flex-col items-center text-center w-full">
                                <div class="w-10 h-10 rounded-full bg-warm-ivory flex items-center justify-center text-champagne-gold mb-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="text-deep-emerald font-bold text-body mb-1">آدرس فروشگاه</h5>
                                <p class="text-charcoal/60 text-caption font-medium">تهران - خیابان سعادت آباد - کوچه ۵ - پلاک ۱۲</p>
                            </div>
                        </div>

                        <!-- آیتم: ایمیل -->
                        <div class="flex items-center justify-between pb-6">
                            <div class="flex flex-col items-center text-center w-full">
                                <div class="w-10 h-10 rounded-full bg-warm-ivory flex items-center justify-center text-champagne-gold mb-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h5 class="text-deep-emerald font-bold text-body mb-1">ایمیل پشتیبانی</h5>
                                <p class="text-charcoal/60 text-caption font-medium" dir="ltr">info@website.com | support@website.com</p>
                            </div>
                        </div>

                        <!-- نشان‌ها (Badges) -->
                        <div class="grid grid-cols-3 gap-3 border-t border-soft-stone/60 pt-6">
                            <!-- Badge 1 -->
                            <div class="bg-warm-ivory border border-soft-stone/50 rounded-xl p-2 flex flex-col items-center justify-center aspect-square hover:border-champagne-gold/50 transition-colors cursor-pointer">
                                <svg class="w-8 h-8 text-deep-emerald mb-1 opacity-70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-[8px] font-bold text-charcoal/60 text-center leading-tight">نماد اعتماد<br>الکترونیکی</span>
                            </div>
                            <!-- Badge 2 -->
                            <div class="bg-warm-ivory border border-soft-stone/50 rounded-xl p-2 flex flex-col items-center justify-center aspect-square hover:border-champagne-gold/50 transition-colors cursor-pointer">
                                <svg class="w-8 h-8 text-champagne-gold mb-1 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                <span class="text-[8px] font-bold text-charcoal/60 text-center leading-tight">ساماندهی<br>رسانه‌های دیجیتال</span>
                            </div>
                            <!-- Badge 3 -->
                            <div class="bg-warm-ivory border border-soft-stone/50 rounded-xl p-2 flex flex-col items-center justify-center aspect-square hover:border-champagne-gold/50 transition-colors cursor-pointer">
                                <svg class="w-8 h-8 text-deep-emerald mb-1 opacity-70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                </svg>
                                <span class="text-[8px] font-bold text-charcoal/60 text-center leading-tight">اتحادیه<br>کشوری صنفی</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- ========================================== -->
            <!-- ۳. نوار پایینی (کپی‌رایت و شبکه‌های اجتماعی) -->
            <!-- ========================================== -->
            <div class="absolute bottom-0 left-0 w-full z-20 px-8 md:px-16 pb-6 pt-10 border-t border-warm-ivory/10 flex flex-col md:flex-row items-center justify-between gap-4">

                <!-- شبکه‌های اجتماعی -->
                <div class="flex items-center gap-5">
                    <a href="#" aria-label="Facebook" class="text-warm-ivory/60 hover:text-champagne-gold transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="text-warm-ivory/60 hover:text-champagne-gold transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.88z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="LinkedIn" class="text-warm-ivory/60 hover:text-champagne-gold transition-colors duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                    </a>
                </div>

                <!-- متن کپی‌رایت -->
                <p class="text-warm-ivory/50 text-caption text-center md:text-end">
                    کلیه حقوق مادی و معنوی برای این سایت محفوظ می باشد.
                </p>
            </div>

            <!-- ========================================== -->
            <!-- ۴. منحنی پایین و دکمه بازگشت به بالا -->
            <!-- ========================================== -->

            <!-- Back to Top Button -->
            <a href="#" id="back-to-top" aria-label="بازگشت به بالا" class="hidden absolute bottom-20 left-1/2 -translate-x-1/2 translate-y-1/2 z-30 w-14 h-14 bg-champagne-gold text-deep-emerald rounded-full md:flex items-center justify-center shadow-[0_8px_24px_rgba(200,165,106,0.4)] hover:bg-warm-ivory hover:text-deep-emerald hover:-translate-y-1 transition-all duration-300 group">
                <svg class="w-6 h-6 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </a>

        </div>
    </div>
</footer><!-- #colophon -->

<!-- ========================================== -->
<!-- Floating Contact Widget -->
<!-- ========================================== -->
<?php
// Retrieve existing phone number from theme settings
$phone = get_theme_mod('sarv_phone_number', '021-12345678');
// Clean phone for tel: link
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);

// Format for WhatsApp (Assuming Iran country code 98 if it starts with 0)
$wa_phone = str_starts_with($phone_clean, '0') ? '98' . substr($phone_clean, 1) : ltrim($phone_clean, '+');
?>

<div id="floating-contact"
     class="fixed z-40 bottom-3 left-1/2 -translate-x-1/2 md:bottom-6 md:left-auto md:right-6 md:translate-x-0 mb-[env(safe-area-inset-bottom)] font-peyda">

  <div class="fc-dock flex items-center gap-0.5 md:gap-1 p-1.5 md:p-1 rounded-full bg-white/90 backdrop-blur-md ring-1 ring-black/5 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.25)]">

    <!-- Telegram -->
    <a href="https://t.me/sarvdental_clinic_bot" target="_blank" rel="noopener noreferrer"
       aria-label="مشاوره در تلگرام"
       class="group relative flex flex-col items-center justify-center w-12 h-12 md:w-11 md:h-11 rounded-full text-deep-emerald hover:bg-deep-emerald hover:text-warm-ivory active:bg-deep-emerald active:text-warm-ivory active:scale-95 transition-all duration-200">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
        <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
      </svg>
      <span class="mt-0.5 text-[9px] leading-none md:hidden">تلگرام</span>
      <span class="hidden md:block absolute -top-9 left-1/2 -translate-x-1/2 bg-deep-emerald text-warm-ivory text-caption px-2.5 py-1 rounded-brand whitespace-nowrap opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none shadow-md">مشاوره در تلگرام</span>
    </a>

    <!-- WhatsApp -->
    <a href="https://wa.me/<?php echo esc_attr($wa_phone); ?>" target="_blank" rel="noopener noreferrer"
       aria-label="مشاوره در واتساپ"
       class="group relative flex flex-col items-center justify-center w-12 h-12 md:w-11 md:h-11 rounded-full text-deep-emerald hover:bg-deep-emerald hover:text-warm-ivory active:bg-deep-emerald active:text-warm-ivory active:scale-95 transition-all duration-200">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
      </svg>
      <span class="mt-0.5 text-[9px] leading-none md:hidden">واتساپ</span>
      <!-- online dot -->
      <span class="absolute top-1 right-1 md:top-1.5 md:right-1.5 flex w-2 h-2">
        <span class="absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-70 animate-ping"></span>
        <span class="relative inline-flex w-2 h-2 rounded-full bg-green-500 ring-2 ring-white"></span>
      </span>
      <span class="hidden md:block absolute -top-9 left-1/2 -translate-x-1/2 bg-deep-emerald text-warm-ivory text-caption px-2.5 py-1 rounded-brand whitespace-nowrap opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none shadow-md">مشاوره در واتساپ</span>
    </a>

    <!-- Phone -->
    <a href="tel:<?php echo esc_attr($phone_clean); ?>"
       aria-label="تماس تلفنی"
       class="group relative flex flex-col items-center justify-center w-12 h-12 md:w-11 md:h-11 rounded-full text-deep-emerald hover:bg-deep-emerald hover:text-warm-ivory active:bg-deep-emerald active:text-warm-ivory active:scale-95 transition-all duration-200">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
      </svg>
      <span class="mt-0.5 text-[9px] leading-none md:hidden">تماس</span>
      <span class="hidden md:block absolute -top-9 left-1/2 -translate-x-1/2 bg-deep-emerald text-warm-ivory text-caption px-2.5 py-1 rounded-brand whitespace-nowrap opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none shadow-md">تماس تلفنی</span>
    </a>

    <!-- Instagram -->
    <a href="https://instagram.com/sarvdental" target="_blank" rel="noopener noreferrer"
       aria-label="اینستاگرام"
       class="group relative flex flex-col items-center justify-center w-12 h-12 md:w-11 md:h-11 rounded-full text-deep-emerald hover:bg-deep-emerald hover:text-warm-ivory active:bg-deep-emerald active:text-warm-ivory active:scale-95 transition-all duration-200">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.88z"/>
      </svg>
      <span class="mt-0.5 text-[9px] leading-none md:hidden">اینستا</span>
      <span class="hidden md:block absolute -top-9 left-1/2 -translate-x-1/2 bg-deep-emerald text-warm-ivory text-caption px-2.5 py-1 rounded-brand whitespace-nowrap opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none shadow-md">اینستاگرام</span>
    </a>

  </div>
</div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>