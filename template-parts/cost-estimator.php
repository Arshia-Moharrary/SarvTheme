<?php

/**
 * Treatment cost estimator → consultation request.
 *
 * Usage:  get_template_part('template-parts/cost-estimator');
 * Needs:  inc/estimator.php loaded from functions.php (lead storage + AJAX endpoint),
 *         src/js/cost-estimator.js, and the CSS from estimator-additions.css.
 */

defined('ABSPATH') || exit;

$sarv_range = function_exists('sarv_estimator_teeth_range') ? sarv_estimator_teeth_range() : [1, 32];
$sarv_quick = [8, 10, 12, 16, 20];                       // predefined quantities
$sarv_fa    = static function ($n) {
    return strtr((string) $n, ['0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹']);
};

$sarv_tooth = 'M12 5.2C10.9 4.3 9.6 3.6 8 3.6 5.6 3.6 4 5.4 4 7.8c0 2.2.9 3.4 1.4 5.4.5 2 .4 4.6 1.2 6.6.3.8 1.3.8 1.6 0l.9-3c.3-1 .8-1.5 1.7-1.5h0c.9 0 1.4.5 1.7 1.5l.9 3c.3.8 1.3.8 1.6 0 .8-2 .7-4.6 1.2-6.6.5-2 1.4-3.2 1.4-5.4 0-2.4-1.6-4.2-4-4.2-1.6 0-2.9.7-4 1.6z';

// Default selection: composite.
$sarv_treatments = [
    'composite' => [
        'label' => 'کامپوزیت',
        'icon'  => '<path d="' . $sarv_tooth . '"/><path d="M19.5 2v4M17.5 4h4"/>',
    ],
    'veneer'    => [
        'label' => 'لمینت',
        'icon'  => '<path d="' . $sarv_tooth . '"/><path d="M8 8c1.5-.9 3.5-.9 5 0"/><path d="M7.2 10.5c.1 1.8.5 3 .9 4.3"/>',
    ],
    'implant'   => [
        'label' => 'ایمپلنت',
        'icon'  => '<path d="M7 3.5h10a1 1 0 011 1v4.2a2 2 0 01-2 2H8a2 2 0 01-2-2V4.5a1 1 0 011-1z"/><path d="M9 12.5h6M9.5 15h5M10 17.5h4M11 20.5h2"/><path d="M10 10.7v1.8M14 10.7v1.8"/>',
    ],
];
$sarv_default_treatment = 'composite';

$sarv_script = '/src/js/cost-estimator.js';
wp_enqueue_script(
    'sarv-estimator',
    get_template_directory_uri() . $sarv_script,
    [],
    file_exists(get_template_directory() . $sarv_script) ? filemtime(get_template_directory() . $sarv_script) : '1.0.0',
    ['in_footer' => true, 'strategy' => 'defer']
);
?>

<section
    id="cost-estimator"
    aria-labelledby="estimator-title"
    class="relative bg-warm-ivory text-charcoal py-20 lg:py-28"
    data-estimator
    data-endpoint="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
    data-action="sarv_estimator_submit"
    data-nonce="<?php echo esc_attr(wp_create_nonce('sarv_estimator')); ?>"
    data-min="<?php echo (int) $sarv_range[0]; ?>"
    data-max="<?php echo (int) $sarv_range[1]; ?>">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-brand-lg bg-deep-emerald text-warm-ivory shadow-2xl p-5 sm:p-10 lg:p-14 reveal-up">

            <header class="max-w-2xl mb-10 lg:mb-14">
                <h2 id="estimator-title" class="text-h2 sm:text-h1 font-black font-peyda leading-[1.3] tracking-normal mb-4">
                    هزینه درمان خود را <span class="text-champagne-gold">برآورد</span> کنید
                </h2>
                <p class="text-body-range text-warm-ivory/80 font-peyda leading-relaxed">
                    نوع درمان و تعداد دندان‌ها را مشخص کنید تا مشاوران ما قیمت دقیق را متناسب با نیاز شما اعلام کنند.
                </p>
            </header>

            <noscript>
                <p class="mb-8 text-body font-peyda text-champagne-gold">برای استفاده از این بخش، لطفاً جاوااسکریپت مرورگر را فعال کنید.</p>
            </noscript>

            <form data-form novalidate class="grid grid-cols-1 lg:grid-cols-12 gap-x-12 gap-y-10 lg:gap-y-12" aria-describedby="estimator-title">

                <!-- ============ A · Steps 1 & 2 ============ -->
                <div class="lg:col-span-7 space-y-10">

                    <!-- Step 1: treatment -->
                    <fieldset>
                        <legend class="est-step"><span class="est-step__num" aria-hidden="true">۱</span>نوع درمان</legend>
                        <div class="grid grid-cols-3 gap-3 sm:gap-4 mt-5">
                            <?php foreach ($sarv_treatments as $key => $t) : ?>
                                <div>
                                    <input
                                        type="radio"
                                        class="est-radio sr-only"
                                        name="treatment"
                                        id="est-treatment-<?php echo esc_attr($key); ?>"
                                        value="<?php echo esc_attr($key); ?>"
                                        data-label="<?php echo esc_attr($t['label']); ?>"
                                        <?php checked($key, $sarv_default_treatment); ?>>
                                    <label for="est-treatment-<?php echo esc_attr($key); ?>" class="est-card">
                                        <span class="est-card__check" aria-hidden="true">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </span>
                                        <svg class="est-card__icon" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><?php echo $t['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG 
                                                                                                                                                                                                                ?></svg>
                                        <span class="text-body sm:text-h4"><?php echo esc_html($t['label']); ?></span>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <!-- Step 2: quantity -->
                    <fieldset>
                        <legend class="est-step"><span class="est-step__num" aria-hidden="true">۲</span>چند دندان نیاز دارید؟</legend>

                        <div class="mt-5 flex flex-wrap gap-3" role="group" aria-label="تعداد پیشنهادی دندان">
                            <?php foreach ($sarv_quick as $n) : ?>
                                <button type="button" class="est-chip" data-count="<?php echo (int) $n; ?>" aria-pressed="false">
                                    <?php echo esc_html($sarv_fa($n)); ?> <span class="font-medium text-caption">دندان</span>
                                </button>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-6 sm:max-w-xs">
                            <label for="est-count" class="block mb-2 text-caption font-peyda text-warm-ivory/70">
                                یا تعداد دلخواه را وارد کنید (<?php echo esc_html($sarv_fa($sarv_range[0]) . ' تا ' . $sarv_fa($sarv_range[1])); ?>)
                            </label>
                            <input
                                id="est-count"
                                name="count"
                                type="text"
                                inputmode="numeric"
                                autocomplete="off"
                                dir="rtl"
                                maxlength="2"
                                placeholder="<?php echo esc_attr($sarv_fa(14)); ?>"
                                class="est-field"
                                data-count-input
                                aria-describedby="est-count-msg">
                            <p id="est-count-msg" class="est-msg" data-count-msg aria-live="polite"></p>
                        </div>
                    </fieldset>
                </div>

                <!-- ============ B · Step 3: visual selector (spans both rows on desktop, stays in view) ============ -->
                <div class="lg:col-span-5 lg:col-start-8 lg:row-span-2 lg:self-start lg:sticky lg:top-8">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                        <h3 class="est-step"><span class="est-step__num" aria-hidden="true">۳</span>موقعیت دقیق دندان‌ها</h3>
                        <span class="est-tag">اختیاری</span>
                    </div>
                    <p class="mt-3 text-body font-peyda text-warm-ivory/70 leading-relaxed">
                        اگر می‌خواهید، روی دندان‌های موردنظر بزنید؛ تعداد به‌صورت خودکار به‌روز می‌شود.
                    </p>

                    <div class="mt-5 rounded-brand-lg bg-forest-noir border border-warm-ivory/10 p-4 sm:p-6">
                        <div class="mx-auto w-full max-w-md" data-arch>
                            <?php get_template_part('template-parts/estimator-arch'); ?>
                        </div>
                    </div>

                    <p class="mt-3 min-h-6 text-caption font-bold font-peyda text-warm-ivory/80" data-readout aria-live="polite"></p>

                    <div class="mt-2 flex flex-wrap gap-2">
                        <button type="button" class="est-mini" data-arch-toggle="upper" aria-pressed="false">کل فک بالا</button>
                        <button type="button" class="est-mini" data-arch-toggle="lower" aria-pressed="false">کل فک پایین</button>
                        <button type="button" class="est-mini" data-clear disabled>پاک کردن انتخاب</button>
                    </div>

                    <!-- Mode-change notice with undo: nothing is ever dropped silently -->
                    <div class="est-notice" data-notice hidden aria-live="polite">
                        <span data-notice-text></span>
                        <button type="button" class="est-notice__undo" data-undo>بازگردانی</button>
                    </div>
                </div>

                <!-- ============ C · Summary, price request & consultation ============ -->
                <div class="lg:col-span-7">
                    <div class="border-t border-warm-ivory/15 pt-8">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                            <div>
                                <p class="text-caption font-peyda text-warm-ivory/70">انتخاب شما</p>
                                <p class="mt-1 text-h4 font-bold font-peyda" aria-live="polite">
                                    <span data-sum-treatment>کامپوزیت</span>
                                    <span class="mx-2 text-champagne-gold" aria-hidden="true">·</span>
                                    <span data-sum-count>تعداد مشخص نشده</span>
                                </p>
                                <p class="mt-1 text-caption font-peyda text-warm-ivory/70" data-sum-mode></p>
                            </div>

                            <button type="button" class="btn btn-primary w-full sm:w-auto" data-reveal-btn aria-controls="est-lead" aria-disabled="true">
                                برای مشاهده قیمت
                                <svg class="w-5 h-5 ms-2 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5-5 5M6 12h12"></path>
                                </svg>
                            </button>
                        </div>

                        <p class="mt-4 min-h-6 text-caption font-bold font-peyda text-champagne-gold" data-hint aria-live="polite"></p>

                        <!-- Revealed step: grid-rows 0fr→1fr, so the page never jumps -->
                        <div id="est-lead" class="est-reveal mt-4" data-lead inert>
                            <div class="est-reveal__inner p-1 -m-1">
                                <div class="rounded-brand-lg bg-warm-ivory text-deep-emerald p-6 sm:p-8 shadow-xl">

                                    <div data-lead-form>
                                        <p class="text-body font-peyda font-medium leading-loose">
                                            با توجه به تنوع برندها و مواد مورد استفاده، قیمت نهایی درمان متفاوت است. برای دریافت قیمت دقیق و متناسب با نیازتان، لطفاً شماره تماس خود را وارد کنید. مشاوران ما در اولین فرصت با شما ارتباط خواهند گرفت.
                                        </p>

                                        <div class="mt-6">
                                            <label for="est-phone" class="block mb-2 text-caption font-bold font-peyda">شماره موبایل</label>
                                            <div class="relative">
                                                <input
                                                    id="est-phone"
                                                    name="phone"
                                                    type="tel"
                                                    inputmode="numeric"
                                                    autocomplete="tel"
                                                    dir="rtl"
                                                    maxlength="14"
                                                    placeholder="۰۹۱۲۱۲۳۴۵۶۷"
                                                    class="est-field est-field--light"
                                                    data-phone
                                                    aria-describedby="est-phone-msg"
                                                    required>
                                                <span class="est-valid" aria-hidden="true">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <p id="est-phone-msg" class="est-msg" data-phone-msg aria-live="polite"></p>
                                        </div>

                                        <!-- Honeypot: humans never see or fill this -->
                                        <div class="sr-only" aria-hidden="true">
                                            <label>وب‌سایت <input type="text" name="website" tabindex="-1" autocomplete="off" data-honeypot></label>
                                        </div>

                                        <p class="est-msg est-msg--block" data-error role="alert" hidden></p>

                                        <button type="submit" class="btn btn-dark w-full sm:w-auto mt-2" data-submit>
                                            <span data-submit-label>ارتباط با مشاور</span>
                                            <span class="hidden items-center gap-3" data-submit-loading>
                                                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                                </svg>
                                                در حال ارسال…
                                            </span>
                                        </button>
                                    </div>

                                    <!-- Success: only ever shown after the server confirmed the save -->
                                    <div data-lead-success hidden class="text-center sm:text-start">
                                        <div class="flex flex-col sm:flex-row items-center gap-5">
                                            <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-deep-emerald text-champagne-gold shrink-0" aria-hidden="true">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path class="est-check" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                            <div>
                                                <h3 class="text-h4 font-bold font-peyda" tabindex="-1" data-success-title>درخواست شما با موفقیت ثبت شد</h3>
                                                <p class="mt-2 text-body font-peyda leading-relaxed text-deep-emerald/80">مشاوران ما در اولین فرصت با شما تماس خواهند گرفت.</p>
                                            </div>
                                        </div>
                                        <dl class="mt-6 pt-6 border-t border-soft-stone grid grid-cols-1 sm:grid-cols-3 gap-4 text-start">
                                            <div>
                                                <dt class="text-caption font-peyda text-charcoal/60">درمان</dt>
                                                <dd class="font-bold font-peyda" data-done-treatment></dd>
                                            </div>
                                            <div>
                                                <dt class="text-caption font-peyda text-charcoal/60">تعداد دندان</dt>
                                                <dd class="font-bold font-peyda" data-done-count></dd>
                                            </div>
                                            <div>
                                                <dt class="text-caption font-peyda text-charcoal/60">شماره تماس</dt>
                                                <dd class="font-bold font-peyda" data-done-phone></dd>
                                            </div>
                                        </dl>
                                        <button type="button" class="mt-6 text-caption font-bold font-peyda underline underline-offset-4 hover:text-forest-noir" data-restart>ثبت درخواست جدید</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>
</section>