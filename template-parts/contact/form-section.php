<?php
/**
 * Contact — Form section (dark) + direct-contact sidebar
 *
 * Enqueues the page-scoped form JS. Follows the same convention as
 * template-parts/cost-estimator.php (enqueue inside the template part).
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$phone = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
$wa_phone = str_starts_with($phone_clean, '0')
    ? '98' . substr($phone_clean, 1)
    : ltrim($phone_clean, '+');

$sarv_contact_script = '/src/js/contact-form.js';
wp_enqueue_script(
    'sarv-contact-form',
    get_template_directory_uri() . $sarv_contact_script,
    [],
    file_exists(get_template_directory() . $sarv_contact_script)
        ? filemtime(get_template_directory() . $sarv_contact_script)
        : '1.0.0',
    ['in_footer' => true, 'strategy' => 'defer']
);
?>

<section id="contact-form-section" aria-labelledby="contact-form-title"
    class="relative bg-forest-noir text-warm-ivory py-20 lg:py-28 overflow-hidden">

    <!-- Decorative -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-0 start-1/3 w-96 h-96 rounded-full bg-champagne-gold/5 blur-3xl"></div>
        <div class="absolute bottom-12 end-8 text-champagne-gold/10">
            <svg class="w-16 h-16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
            </svg>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-12 lg:gap-x-8 xl:gap-x-12 items-start">

            <!-- ── Form (start) ── -->
            <div class="lg:col-span-7">

                <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-champagne-gold tracking-widest mb-6 reveal-up">
                    <span class="w-10 h-px bg-champagne-gold"></span>
                    فرم تماس
                </span>

                <h2 id="contact-form-title"
                    class="text-h2 lg:text-h1 font-black font-peyda text-warm-ivory leading-[1.25] reveal-up delay-100">
                    پیام خود را برای ما <span class="text-champagne-gold">بنویسید</span>
                </h2>

                <p class="mt-5 text-body-range font-peyda text-warm-ivory/75 leading-relaxed max-w-xl reveal-up delay-200">
                    فرم را تکمیل کنید و در اولین فرصت با شما تماس خواهیم گرفت. اطلاعات شما نزد ما محفوظ است.
                </p>

                <div class="mt-10 bg-white rounded-brand-lg p-6 sm:p-8 lg:p-10 text-charcoal shadow-2xl ring-1 ring-warm-ivory/10 reveal-up delay-300">
                    <?php get_template_part('template-parts/contact/form'); ?>
                </div>
            </div>

            <!-- ── Direct-contact sidebar (end) ── -->
            <aside class="lg:col-span-5 lg:sticky lg:top-24 self-start reveal-up delay-200" aria-label="راه‌های تماس مستقیم">
                <div class="bg-deep-emerald rounded-brand-lg p-7 lg:p-8 ring-1 ring-warm-ivory/10">

                    <span class="inline-flex items-center gap-2 text-caption font-peyda font-bold text-champagne-gold tracking-wider mb-3">
                        <span class="w-6 h-px bg-champagne-gold"></span>
                        یا مستقیم در ارتباط باشید
                    </span>

                    <h3 class="text-h3 font-peyda font-black text-warm-ivory leading-tight">
                        ترجیح می‌دهید صحبت کنیم؟
                    </h3>

                    <p class="mt-3 text-body font-peyda text-warm-ivory/70 leading-relaxed">
                        اگر برایتان سریع‌تر است، می‌توانید مستقیم تماس بگیرید یا در واتساپ پیام بفرستید.
                    </p>

                    <div class="mt-7 space-y-3">

                        <!-- Phone -->
                        <a href="tel:<?php echo esc_attr($phone_clean); ?>"
                           class="group flex items-center gap-4 p-4 rounded-brand bg-forest-noir/60 border border-warm-ivory/10 hover:border-champagne-gold/50 hover:bg-forest-noir transition-all duration-300">
                            <span class="w-10 h-10 rounded-full bg-champagne-gold text-deep-emerald flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-caption font-peyda text-warm-ivory/60">تماس تلفنی</p>
                                <p class="mt-0.5 text-body font-peyda font-bold text-warm-ivory group-hover:text-champagne-gold transition-colors">
                                    <span dir="ltr"><?php echo esc_html($phone); ?></span>
                                </p>
                            </div>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/<?php echo esc_attr($wa_phone); ?>" target="_blank" rel="noopener noreferrer"
                           class="group flex items-center gap-4 p-4 rounded-brand bg-forest-noir/60 border border-warm-ivory/10 hover:border-champagne-gold/50 hover:bg-forest-noir transition-all duration-300">
                            <span class="w-10 h-10 rounded-full bg-champagne-gold text-deep-emerald flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-caption font-peyda text-warm-ivory/60">واتساپ</p>
                                <p class="mt-0.5 text-body font-peyda font-bold text-warm-ivory group-hover:text-champagne-gold transition-colors">
                                    گفتگوی فوری
                                </p>
                            </div>
                        </a>

                        <!-- Hours -->
                        <div class="flex items-center gap-4 p-4 rounded-brand bg-forest-noir/60 border border-warm-ivory/10">
                            <span class="w-10 h-10 rounded-full bg-warm-ivory/10 text-champagne-gold flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-caption font-peyda text-warm-ivory/60">ساعات پاسخگویی</p>
                                <p class="mt-0.5 text-body font-peyda font-bold text-warm-ivory">
                                    شنبه تا پنجشنبه، ۹ تا ۲۰
                                </p>
                            </div>
                        </div>

                        <!-- Location link -->
                        <a href="#our-locations"
                           class="group flex items-center gap-4 p-4 rounded-brand bg-forest-noir/60 border border-warm-ivory/10 hover:border-champagne-gold/50 hover:bg-forest-noir transition-all duration-300">
                            <span class="w-10 h-10 rounded-full bg-warm-ivory/10 text-champagne-gold flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-caption font-peyda text-warm-ivory/60">موقعیت مکانی</p>
                                <p class="mt-0.5 text-body font-peyda font-bold text-warm-ivory group-hover:text-champagne-gold transition-colors">
                                    مشاهده شعبه‌ها روی نقشه
                                </p>
                            </div>
                        </a>
                    </div>

                    <p class="mt-7 pt-6 border-t border-warm-ivory/15 text-caption font-peyda text-warm-ivory/60 leading-relaxed">
                        پیام‌هایی که از طریق فرم ارسال می‌شوند در اولین فرصت توسط تیم مشاوره بررسی می‌شوند.
                    </p>
                </div>
            </aside>
        </div>
    </div>
</section>