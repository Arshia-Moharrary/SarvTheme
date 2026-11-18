<?php

/**
 * Contact — Form markup (Phase 1 frontend + Phase 2 backend wiring).
 *
 * Backend is implemented in inc/contact-form.php. This file only renders
 * the form and fills in the endpoint/nonce/action attributes the JS
 * (src/js/contact-form.js) reads from data-*.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$subjects = [
    'consultation' => 'مشاوره درمانی',
    'appointment'  => 'رزرو نوبت',
    'other'        => 'سایر',
];

// --- Phase 2: post-redirect status (no-JS path) -----------------------------
$contact_status = isset($_GET['contact']) ? sanitize_key(wp_unslash($_GET['contact'])) : '';
$status_map = [
    'success'       => ['success', 'درخواست شما دریافت شد. تیم سرو در اولین فرصت با شما تماس خواهد گرفت.'],
    'validation'    => ['error',   'لطفاً اطلاعات فرم را بررسی کنید و دوباره تلاش کنید.'],
    'invalid_nonce' => ['error',   'درخواست شما منقضی شده است. لطفاً صفحه را بازخوانی کنید.'],
    'rate_limited'  => ['error',   'تعداد درخواست‌های شما بیش از حد مجاز است. لطفاً کمی بعد تلاش کنید.'],
    'mail_failed'   => ['error',   'ارسال پیام با خطا مواجه شد. لطفاً دوباره تلاش کنید یا با شماره تماس مستقیم در ارتباط باشید.'],
];
$initial_status = $status_map[$contact_status] ?? null;

// --- Phase 2: values consumed by the JS / native form -----------------------
$nonce    = wp_create_nonce(SARV_CONTACT_NONCE);
$endpoint = admin_url('admin-post.php');
$action   = SARV_CONTACT_ACTION;

// Resolve status classes once so both code paths stay in sync.
$status_classes = 'hidden';
if ($initial_status) {
    $status_classes = 'mt-4 rounded-brand p-4 text-body font-peyda leading-relaxed border ';
    $status_classes .= $initial_status[0] === 'success'
        ? 'bg-deep-emerald/5 border-deep-emerald/30 text-deep-emerald'
        : 'bg-champagne-gold/10 border-champagne-gold/50 text-deep-emerald';
}
?>

<style>
    /* Contact form — scoped styles */
    .contact-field-error:not(:empty)::before {
        content: '!';
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1rem;
        height: 1rem;
        margin-inline-end: 0.375rem;
        border: 1px solid currentColor;
        border-radius: 9999px;
        font-size: 0.65rem;
        line-height: 1;
        flex-shrink: 0;
        vertical-align: middle;
    }
</style>

<form
    data-contact-form
    data-endpoint="<?php echo esc_url($endpoint); ?>"
    data-action="<?php echo esc_attr($action); ?>"
    data-nonce="<?php echo esc_attr($nonce); ?>"
    action="<?php echo esc_url($endpoint); ?>"
    method="post"
    novalidate
    class="space-y-6"
    aria-describedby="contact-form-intro">

    <p id="contact-form-intro" class="sr-only">
        فیلدهای ستاره‌دار الزامی هستند.
    </p>

    <!-- Hidden routing fields — used by the no-JS submission path. -->
    <input type="hidden" name="action" value="<?php echo esc_attr($action); ?>">
    <input type="hidden" name="_wpnonce" value="<?php echo esc_attr($nonce); ?>">

    <!-- Name + Phone -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        <div>
            <label for="contact-name" class="block mb-2 text-caption font-peyda font-bold text-deep-emerald">
                نام و نام خانوادگی
                <span class="text-champagne-gold" aria-hidden="true">*</span>
            </label>
            <input
                id="contact-name"
                name="name"
                type="text"
                autocomplete="name"
                required
                maxlength="60"
                placeholder="مثلاً سارا احمدی"
                aria-describedby="contact-name-error"
                class="w-full h-14 px-4 rounded-brand border border-soft-stone/80 bg-warm-ivory text-deep-emerald font-peyda text-body placeholder:text-charcoal/40 outline-none transition-all duration-300 focus:bg-white focus:border-deep-emerald focus:ring-2 focus:ring-deep-emerald/20 aria-[invalid=true]:border-deep-emerald aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-deep-emerald/30 aria-[invalid=true]:bg-white">
            <p id="contact-name-error" class="contact-field-error min-h-5 mt-1.5 text-caption font-peyda font-bold text-deep-emerald" aria-live="polite"></p>
        </div>

        <div>
            <label for="contact-phone" class="block mb-2 text-caption font-peyda font-bold text-deep-emerald">
                شماره موبایل
                <span class="text-champagne-gold" aria-hidden="true">*</span>
            </label>
            <input
                id="contact-phone"
                name="phone"
                type="tel"
                inputmode="numeric"
                autocomplete="tel"
                dir="ltr"
                required
                maxlength="14"
                placeholder="09121234567"
                aria-describedby="contact-phone-error"
                class="w-full h-14 px-4 rounded-brand border border-soft-stone/80 bg-warm-ivory text-deep-emerald font-peyda text-body placeholder:text-charcoal/40 outline-none transition-all duration-300 focus:bg-white focus:border-deep-emerald focus:ring-2 focus:ring-deep-emerald/20 aria-[invalid=true]:border-deep-emerald aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-deep-emerald/30 aria-[invalid=true]:bg-white">
            <p id="contact-phone-error" class="contact-field-error min-h-5 mt-1.5 text-caption font-peyda font-bold text-deep-emerald" aria-live="polite"></p>
        </div>
    </div>

    <!-- Email (optional) -->
    <div>
        <label for="contact-email" class="block mb-2 text-caption font-peyda font-bold text-deep-emerald">
            ایمیل
            <span class="text-charcoal/40 font-normal text-caption" aria-hidden="true">— اختیاری</span>
        </label>
        <input
            id="contact-email"
            name="email"
            type="email"
            inputmode="email"
            autocomplete="email"
            dir="ltr"
            maxlength="120"
            placeholder="you@example.com"
            aria-describedby="contact-email-error"
            class="w-full h-14 px-4 rounded-brand border border-soft-stone/80 bg-warm-ivory text-deep-emerald font-peyda text-body placeholder:text-charcoal/40 outline-none transition-all duration-300 focus:bg-white focus:border-deep-emerald focus:ring-2 focus:ring-deep-emerald/20 aria-[invalid=true]:border-deep-emerald aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-deep-emerald/30 aria-[invalid=true]:bg-white">
        <p id="contact-email-error" class="contact-field-error min-h-5 mt-1.5 text-caption font-peyda font-bold text-deep-emerald" aria-live="polite"></p>
    </div>

    <!-- Subject -->
    <fieldset>
        <legend class="block mb-3 text-caption font-peyda font-bold text-deep-emerald">
            موضوع تماس
        </legend>
        <div class="flex flex-wrap gap-2" role="radiogroup" aria-label="موضوع تماس">
            <?php foreach ($subjects as $value => $label) : ?>
                <label class="cursor-pointer">
                    <input
                        type="radio"
                        name="subject"
                        value="<?php echo esc_attr($value); ?>"
                        class="peer sr-only"
                        <?php checked($value, 'consultation'); ?>>
                    <span class="inline-flex items-center justify-center h-10 px-5 rounded-full border border-soft-stone text-caption font-peyda font-bold text-charcoal/70 transition-all duration-300 hover:border-deep-emerald/40 peer-checked:bg-deep-emerald peer-checked:border-deep-emerald peer-checked:text-warm-ivory peer-focus-visible:ring-2 peer-focus-visible:ring-champagne-gold peer-focus-visible:ring-offset-2">
                        <?php echo esc_html($label); ?>
                    </span>
                </label>
            <?php endforeach; ?>
        </div>
    </fieldset>

    <!-- Message -->
    <div>
        <label for="contact-message" class="block mb-2 text-caption font-peyda font-bold text-deep-emerald">
            پیام شما
            <span class="text-champagne-gold" aria-hidden="true">*</span>
        </label>
        <textarea
            id="contact-message"
            name="message"
            rows="5"
            required
            minlength="10"
            maxlength="2000"
            placeholder="مثلاً درخواست مشاوره کامپوزیت یا رزرو نوبت برای هفته آینده..."
            aria-describedby="contact-message-error"
            class="w-full px-4 py-3 rounded-brand border border-soft-stone/80 bg-warm-ivory text-deep-emerald font-peyda text-body leading-relaxed placeholder:text-charcoal/40 outline-none resize-none transition-all duration-300 focus:bg-white focus:border-deep-emerald focus:ring-2 focus:ring-deep-emerald/20 aria-[invalid=true]:border-deep-emerald aria-[invalid=true]:ring-2 aria-[invalid=true]:ring-deep-emerald/30 aria-[invalid=true]:bg-white"></textarea>
        <p id="contact-message-error" class="contact-field-error min-h-5 mt-1.5 text-caption font-peyda font-bold text-deep-emerald" aria-live="polite"></p>
    </div>

    <!-- Honeypot -->
    <div class="sr-only" aria-hidden="true">
        <label>وب‌سایت <input type="text" name="website" tabindex="-1" autocomplete="off" data-honeypot></label>
    </div>

    <!-- Submit row -->
    <div class="pt-2 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <p class="text-caption font-peyda text-charcoal/60 leading-relaxed max-w-[16rem]">
            اطلاعات شما نزد ما محفوظ است و هرگز با شخص ثالث به اشتراک گذاشته نمی‌شود.
        </p>

        <button type="submit"
            class="btn btn-dark w-full sm:w-auto justify-center group">
            <span data-submit-label>ارسال درخواست</span>
            <span data-submit-loading hidden class="inline-flex items-center gap-2">
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                در حال ارسال…
            </span>
            <svg data-submit-icon class="w-4 h-4 ms-2 rtl:rotate-180 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5-5 5M6 12h12" />
            </svg>
        </button>
    </div>

    <!-- Status region (used by both JS and post-redirect) -->
    <div
        data-form-status
        role="status"
        aria-live="polite"
        class="<?php echo esc_attr($status_classes); ?>">
        <?php echo $initial_status ? esc_html($initial_status[1]) : ''; ?>
    </div>
</form>

<?php if ($initial_status) : ?>
    <script>
        (function() {
            var status = document.querySelector('[data-form-status]');
            if (!status) return;
            // Give the DOM a beat, then bring the message into view.
            requestAnimationFrame(function() {
                status.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                status.setAttribute('tabindex', '-1');
                status.focus({
                    preventScroll: true
                });
            });
        })();
    </script>
<?php endif; ?>