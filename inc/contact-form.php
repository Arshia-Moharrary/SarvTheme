<?php

/**
 * Contact form — server-side handler.
 *
 * Implements the Phase 2 backend for template-parts/contact/form.php.
 * Submission path: admin-post.php (works with and without JavaScript).
 *
 * Contract with the frontend:
 *   form[data-contact-form]
 *   fields: name, phone, subject, message, website (honeypot)
 *   action: sarv_contact_submit (POST)
 *   nonce:  sarv_contact_form
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

const SARV_CONTACT_ACTION      = 'sarv_contact_submit';
const SARV_CONTACT_NONCE       = 'sarv_contact_form';
const SARV_CONTACT_RATE_LIMIT  = 5;    // max submissions per IP per window
const SARV_CONTACT_RATE_WINDOW = 3600; // seconds

// -----------------------------------------------------------------------------
// Configuration
// -----------------------------------------------------------------------------

/**
 * Recipient of contact-form emails.
 *
 * Precedence:
 *   1. Theme mod `sarv_contact_email` (set in Appearance → Customize).
 *   2. WordPress admin email (Settings → General).
 *
 * Never invent an address here — both sources are explicit site config.
 */
function sarv_contact_get_recipient(): string
{
    $custom = get_theme_mod('sarv_contact_email', '');
    if (is_string($custom) && is_email($custom)) {
        return (string) $custom;
    }
    return (string) get_option('admin_email');
}

// -----------------------------------------------------------------------------
// Normalization
// -----------------------------------------------------------------------------

/**
 * Normalize Persian/Arabic-Indic digits and strip non-numeric characters.
 * Returns a digits-only string safe to store / compare.
 */
function sarv_contact_normalize_phone(string $raw): string
{
    // Persian digits ۰-۹ (U+06F0–U+06F9)
    $raw = preg_replace_callback('/[\x{06F0}-\x{06F9}]/u', static function ($m) {
        return (string) (mb_ord($m[0], 'UTF-8') - 0x06F0);
    }, $raw);

    // Arabic-Indic digits ٠-٩ (U+0660–U+0669)
    $raw = preg_replace_callback('/[\x{0660}-\x{0669}]/u', static function ($m) {
        return (string) (mb_ord($m[0], 'UTF-8') - 0x0660);
    }, $raw);

    return preg_replace('/[^0-9]/', '', (string) $raw);
}

// -----------------------------------------------------------------------------
// Validation (mirrors frontend; server-side is authoritative)
// -----------------------------------------------------------------------------

/**
 * @return array<string,string>  keyed by field name → Persian error message.
 */
function sarv_contact_validate(string $name, string $phone, string $email, string $message, string $subject): array
{
    $errors = [];

    $name = trim($name);
    if ($name === '') {
        $errors['name'] = 'نام خود را وارد کنید.';
    } elseif (mb_strlen($name, 'UTF-8') < 2) {
        $errors['name'] = 'نام باید حداقل ۲ حرف باشد.';
    } elseif (mb_strlen($name, 'UTF-8') > 60) {
        $errors['name'] = 'نام طولانی‌تر از حد مجاز است.';
    } elseif (! preg_match('/^[\p{L}\s\'\.\-]+$/u', $name)) {
        $errors['name'] = 'لطفاً فقط از حروف و فاصله استفاده کنید.';
    }

    if ($phone === '') {
        $errors['phone'] = 'شماره موبایل خود را وارد کنید.';
    } elseif (! preg_match('/^09\d{9}$/', $phone)) {
        $errors['phone'] = 'شماره موبایل معتبر نیست. مثال: ۰۹۱۲۱۲۳۴۵۶۷';
    }

    // Email is OPTIONAL — only validated when provided.
    if ($email !== '' && ! is_email($email)) {
        $errors['email'] = 'ایمیل وارد شده معتبر نیست.';
    }

    $message = trim($message);
    if (mb_strlen($message, 'UTF-8') < 10) {
        $errors['message'] = 'پیام خود را کمی بیشتر توضیح دهید (حداقل ۱۰ کاراکتر).';
    } elseif (mb_strlen($message, 'UTF-8') > 2000) {
        $errors['message'] = 'پیام بیش از حد طولانی است (حداکثر ۲۰۰۰ کاراکتر).';
    }

    if (! in_array($subject, ['consultation', 'appointment', 'other'], true)) {
        $errors['subject'] = 'موضوع تماس معتبر نیست.';
    }

    return $errors;
}

// -----------------------------------------------------------------------------
// Rate limiting (per IP, transient-backed)
// -----------------------------------------------------------------------------

function sarv_contact_rate_key(string $ip): string
{
    return 'sarv_contact_rl_' . md5($ip);
}

function sarv_contact_rate_allowed(string $ip): bool
{
    $count = (int) get_transient(sarv_contact_rate_key($ip));
    return $count < SARV_CONTACT_RATE_LIMIT;
}

function sarv_contact_rate_hit(string $ip): void
{
    $key   = sarv_contact_rate_key($ip);
    $count = (int) get_transient($key);
    set_transient($key, $count + 1, SARV_CONTACT_RATE_WINDOW);
}

// -----------------------------------------------------------------------------
// Response helpers
// -----------------------------------------------------------------------------

/**
 * Emit either a JSON response (JS path) or a safe redirect (no-JS path).
 * Never exposes user data in the URL — only status codes.
 *
 * @param array<string,string> $field_errors
 */
function sarv_contact_respond(bool $ok, string $code, string $message, array $field_errors = []): void
{
    $is_ajax = (
        (defined('DOING_AJAX') && DOING_AJAX)
        || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower((string) $_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        || (isset($_SERVER['HTTP_ACCEPT']) && strpos((string) $_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
    );

    if ($is_ajax) {
        wp_send_json([
            'ok'      => $ok,
            'code'    => $code,
            'message' => $message,
            'errors'  => $field_errors,
        ], $ok ? 200 : 400);
    }

    // No-JS path: redirect to the referring page (validated by wp_get_referer).
    // Only status code is passed — never field values.
    $redirect = wp_get_referer();
    if (! $redirect) {
        $contact_page = get_page_by_path('contact');
        $redirect     = $contact_page ? get_permalink($contact_page) : home_url('/contact/');
    }

    $args = ['contact' => $code];
    if (! empty($field_errors)) {
        $args['field'] = array_key_first($field_errors);
    }

    wp_safe_redirect(add_query_arg($args, $redirect));
    exit;
}

// -----------------------------------------------------------------------------
// Main handler
// -----------------------------------------------------------------------------

function sarv_contact_handle_submission(): void
{
    // 1) Nonce
    $nonce = isset($_POST['_wpnonce']) ? sanitize_text_field(wp_unslash($_POST['_wpnonce'])) : '';
    if (! wp_verify_nonce($nonce, SARV_CONTACT_NONCE)) {
        sarv_contact_respond(
            false,
            'invalid_nonce',
            'درخواست شما منقضی شده است. لطفاً صفحه را بازخوانی کنید و دوباره تلاش کنید.'
        );
    }

    // 2) Honeypot — silent success for bots (never send, never log the value)
    $honeypot = isset($_POST['website']) ? trim((string) wp_unslash($_POST['website'])) : '';
    if ($honeypot !== '') {
        sarv_contact_respond(true, 'success', 'درخواست شما دریافت شد.');
    }

    // 3) Rate limit (before doing any real work)
    $ip = isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : 'unknown';
    if (! sarv_contact_rate_allowed($ip)) {
        sarv_contact_respond(
            false,
            'rate_limited',
            'تعداد درخواست‌های شما بیش از حد مجاز است. لطفاً کمی بعد دوباره تلاش کنید یا با شماره تماس مستقیم در ارتباط باشید.'
        );
    }

    // 4) Sanitize
    $name    = isset($_POST['name'])    ? sanitize_text_field(wp_unslash($_POST['name']))         : '';
    $raw_ph  = isset($_POST['phone'])   ? (string) wp_unslash($_POST['phone'])                     : '';
    $email   = isset($_POST['email'])   ? sanitize_email(wp_unslash($_POST['email']))              : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message']))  : '';
    $subject = isset($_POST['subject']) ? sanitize_key(wp_unslash($_POST['subject']))             : 'consultation';

    $phone = sarv_contact_normalize_phone($raw_ph);

    // 5) Validate
    $errors = sarv_contact_validate($name, $phone, $email, $message, $subject);
    if (! empty($errors)) {
        $first = array_key_first($errors);
        sarv_contact_respond(false, 'validation', $errors[$first], $errors);
    }

    // 6) Rate-limit hit only after validation passes
    sarv_contact_rate_hit($ip);

    // 7) Persist the submission FIRST — this is the authoritative record.
    $subject_labels = [
        'consultation' => 'مشاوره درمانی',
        'appointment'  => 'رزرو نوبت',
        'other'        => 'سایر',
    ];
    $subject_label = $subject_labels[$subject] ?? 'تماس';

    $post_id = wp_insert_post([
        'post_type'   => 'sarv_contact',
        'post_status' => 'publish',
        'post_title'  => sprintf('%s — %s', $name, $subject_label),
    ], true);

    if (is_wp_error($post_id) || ! $post_id) {
        // Only a genuine storage failure counts as a failure.
        error_log('[Sarv Contact] wp_insert_post failed for new submission.');
        sarv_contact_respond(
            false,
            'storage_failed',
            'ثبت درخواست با خطا مواجه شد. لطفاً دوباره تلاش کنید یا با شماره تماس مستقیم در ارتباط باشید.'
        );
    }

    update_post_meta($post_id, '_sarv_name',          $name);
    update_post_meta($post_id, '_sarv_phone',         $phone);
    update_post_meta($post_id, '_sarv_email',         $email);
    update_post_meta($post_id, '_sarv_subject',       $subject);
    update_post_meta($post_id, '_sarv_subject_label', $subject_label);
    update_post_meta($post_id, '_sarv_message',       $message);
    update_post_meta($post_id, '_sarv_ip',            $ip);

    // 8) Try to send email — failure is logged, NEVER fatal.
    $to   = sarv_contact_get_recipient();
    $site = wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES);

    $mail_subject = sprintf('[%s] %s — %s', $site, $subject_label, $name);

    $body_lines = [
        'درخواست جدید از فرم تماس وب‌سایت ' . $site,
        '',
        'نام: '          . $name,
        'شماره موبایل: ' . $phone,
    ];
    if ($email !== '') {
        $body_lines[] = 'ایمیل: ' . $email;
    }
    $body_lines[] = 'موضوع: ' . $subject_label;
    $body_lines[] = '';
    $body_lines[] = 'پیام:';
    $body_lines[] = $message;
    $body_lines[] = '';
    $body_lines[] = '---';
    $body_lines[] = 'زمان ارسال: ' . current_time('mysql');
    $body_lines[] = 'IP: ' . $ip;
    $body_lines[] = 'شناسه درخواست: #' . $post_id;

    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    // Attach Reply-To only when the user supplied a valid email.
    if ($email !== '') {
        $headers[] = 'Reply-To: ' . $email;
    }

    $mail_error = '';
    $capture_error = static function ($wp_error) use (&$mail_error) {
        if ($wp_error instanceof WP_Error) {
            $mail_error = $wp_error->get_error_message();
        }
    };
    add_action('wp_mail_failed', $capture_error);
    $sent = wp_mail($to, $mail_subject, implode("\n", $body_lines), $headers);
    remove_action('wp_mail_failed', $capture_error);

    update_post_meta($post_id, '_sarv_email_sent', $sent ? '1' : '0');
    if (! $sent) {
        update_post_meta($post_id, '_sarv_email_error', $mail_error ?: 'wp_mail returned false');
        error_log(sprintf(
            '[Sarv Contact] wp_mail failed for post #%d (saved successfully). ip=%s',
            $post_id,
            $ip
        ));
    }

    // 9) ALWAYS report success — the submission is safely stored regardless of email.
    sarv_contact_respond(
        true,
        'success',
        'درخواست شما با موفقیت ثبت شد. تیم سرو در اولین فرصت با شما تماس خواهد گرفت.'
    );
}

// Register both authenticated and unauthenticated handlers.
add_action('admin_post_nopriv_' . SARV_CONTACT_ACTION, 'sarv_contact_handle_submission');
add_action('admin_post_'        . SARV_CONTACT_ACTION, 'sarv_contact_handle_submission');
