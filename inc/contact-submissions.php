<?php

/**
 * Contact submissions — dashboard CPT + admin views.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

// -----------------------------------------------------------------------------
// CPT
// -----------------------------------------------------------------------------

add_action('init', function () {
    register_post_type('sarv_contact', [
        'labels' => [
            'name'          => 'درخواست‌های تماس',
            'singular_name' => 'درخواست تماس',
            'menu_name'     => 'درخواست‌های تماس',
            'all_items'     => 'همه درخواست‌ها',
            'edit_item'     => 'مشاهده درخواست',
            'view_item'     => 'مشاهده درخواست',
            'search_items'  => 'جستجوی درخواست‌ها',
            'not_found'     => 'درخواستی یافت نشد',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => false,
        'menu_icon'           => 'dashicons-email-alt',
        'menu_position'       => 26,
        'supports'            => ['title'],
        'capabilities'        => ['create_posts' => 'do_not_allow'],
        'map_meta_cap'        => true,
        'exclude_from_search' => true,
    ]);
});

// -----------------------------------------------------------------------------
// List columns
// -----------------------------------------------------------------------------

add_filter('manage_sarv_contact_posts_columns', function ($cols) {
    return [
        'cb'              => $cols['cb'],
        'title'           => 'خلاصه',
        'sarv_name'       => 'نام',
        'sarv_phone'      => 'موبایل',
        'sarv_email'      => 'ایمیل',
        'sarv_subject'    => 'موضوع',
        'sarv_mail_state' => 'وضعیت ایمیل',
        'date'            => 'تاریخ',
    ];
});

add_action('manage_sarv_contact_posts_custom_column', function ($col, $post_id) {
    switch ($col) {
        case 'sarv_name':
            echo esc_html(get_post_meta($post_id, '_sarv_name', true));
            break;
        case 'sarv_phone':
            $p = get_post_meta($post_id, '_sarv_phone', true);
            echo $p ? '<span dir="ltr">' . esc_html($p) . '</span>' : '—';
            break;
        case 'sarv_email':
            $e = get_post_meta($post_id, '_sarv_email', true);
            echo $e ? '<a href="mailto:' . esc_attr($e) . '">' . esc_html($e) . '</a>' : '—';
            break;
        case 'sarv_subject':
            echo esc_html(get_post_meta($post_id, '_sarv_subject_label', true) ?: '—');
            break;
        case 'sarv_mail_state':
            $sent = get_post_meta($post_id, '_sarv_email_sent', true);
            if ($sent === '1') {
                echo '<span style="color:#0E3B32;font-weight:600;">✓ ارسال شد</span>';
            } elseif ($sent === '0') {
                echo '<span style="color:#C8A56A;font-weight:600;">⚠ ناموفق</span>';
            } else {
                echo '—';
            }
            break;
    }
}, 10, 2);

add_filter('manage_edit-sarv_contact_sortable_columns', function ($cols) {
    $cols['sarv_subject'] = 'sarv_subject';
    return $cols;
});

// -----------------------------------------------------------------------------
// Detail meta box (read-only)
// -----------------------------------------------------------------------------

add_action('add_meta_boxes', function () {
    add_meta_box(
        'sarv_contact_details',
        'جزئیات درخواست',
        'sarv_contact_render_meta_box',
        'sarv_contact',
        'normal',
        'high'
    );

    remove_meta_box('slugdiv', 'sarv_contact', 'normal');
});

function sarv_contact_render_meta_box($post)
{
    $name     = get_post_meta($post->ID, '_sarv_name', true);
    $phone    = get_post_meta($post->ID, '_sarv_phone', true);
    $email    = get_post_meta($post->ID, '_sarv_email', true);
    $subject  = get_post_meta($post->ID, '_sarv_subject_label', true);
    $message  = get_post_meta($post->ID, '_sarv_message', true);
    $ip       = get_post_meta($post->ID, '_sarv_ip', true);
    $mail_sent = get_post_meta($post->ID, '_sarv_email_sent', true);
    $mail_err  = get_post_meta($post->ID, '_sarv_email_error', true);

    $row = static function ($label, $value, $extra = '') {
        echo '<tr>';
        echo '<th style="text-align:right;width:140px;padding:12px 0;vertical-align:top;">' . esc_html($label) . '</th>';
        echo '<td style="padding:12px 0;">' . $value . $extra . '</td>'; // phpcs:ignore -- pre-escaped above
        echo '</tr>';
    };

    echo '<table style="width:100%;border-collapse:collapse;font-size:14px;line-height:1.7;">';

    $row('نام', esc_html($name));
    $row(
        'موبایل',
        $phone
            ? '<a href="tel:' . esc_attr($phone) . '" dir="ltr">' . esc_html($phone) . '</a>'
            : '—'
    );
    $row(
        'ایمیل',
        $email
            ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>'
            : '<span style="color:#999;">وارد نشده</span>'
    );
    $row('موضوع', esc_html($subject ?: '—'));
    $row(
        'پیام',
        '<div style="background:#F6F3EC;border:1px solid #D8D5CE;border-radius:12px;padding:16px;white-space:pre-wrap;">'
            . esc_html($message) . '</div>'
    );

    $state_html = '';
    if ($mail_sent === '1') {
        $state_html = '<span style="color:#0E3B32;font-weight:600;">✓ ایمیل با موفقیت ارسال شد</span>';
    } elseif ($mail_sent === '0') {
        $state_html = '<span style="color:#C8A56A;font-weight:600;">⚠ ارسال ایمیل ناموفق بود</span>';
        if ($mail_err) {
            $state_html .= '<br><span style="color:#666;font-size:12px;">' . esc_html($mail_err) . '</span>';
        }
    } else {
        $state_html = '—';
    }
    $row('وضعیت ایمیل', $state_html);

    $row('IP', $ip ? '<span dir="ltr">' . esc_html($ip) . '</span>' : '—');

    echo '</table>';
}

// -----------------------------------------------------------------------------
// Make the title column link to the submission
// -----------------------------------------------------------------------------

add_filter('post_row_actions', function ($actions, $post) {
    if ($post->post_type !== 'sarv_contact') return $actions;
    unset($actions['inline hide-if-no-js']);
    return $actions;
}, 10, 2);

// -----------------------------------------------------------------------------
// Optional: unread badge in the admin menu (uses _sarv_read meta)
// -----------------------------------------------------------------------------

add_action('admin_menu', function () {
    global $menu;
    if (! is_array($menu)) return;

    $count = get_posts([
        'post_type'      => 'sarv_contact',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'meta_query'     => [
            ['key' => '_sarv_read', 'compare' => 'NOT EXISTS'],
        ],
    ]);

    $unread = get_posts([
        'post_type'      => 'sarv_contact',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_query'     => [
            ['key' => '_sarv_read', 'compare' => 'NOT EXISTS'],
        ],
    ]);

    if (! empty($unread)) {
        foreach ($menu as $i => $item) {
            if (isset($item[2]) && $item[2] === 'edit.php?post_type=sarv_contact') {
                $menu[$i][0] .= ' <span class="awaiting-mod"><span class="pending-count">'
                    . count($unread) . '</span></span>';
                break;
            }
        }
    }
}, 99);

// Mark as read when the post is opened in admin.
add_action('load-post.php', function () {
    $post_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;
    if (! $post_id) return;
    if (get_post_type($post_id) !== 'sarv_contact') return;
    update_post_meta($post_id, '_sarv_read', '1');
});
