<?php
/**
 * Portfolio per-image type + admin gallery metabox.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

/**
 * Allowed image types, with human labels.
 */
function sarv_portfolio_image_types(): array
{
    return [
        'smile_portrait' => 'پرترهٔ لبخند — 1:1',
        'dental_closeup' => 'نمای نزدیک دندان — 4:5',
        'dental_square'  => 'نمای نزدیک مربع — 1:1',
        'multi_tooth'    => 'مقایسهٔ چند دندان — 7:12',
        'before_after'   => 'قبل/بعد طراحی‌شده — 197:350',
    ];
}

/**
 * Read the type for a single attachment, with safe fallback.
 */
function sarv_get_image_type(int $attachment_id): string
{
    $allowed = array_keys(sarv_portfolio_image_types());
    $type    = (string) get_post_meta($attachment_id, '_sarv_image_type', true);
    return in_array($type, $allowed, true) ? $type : 'dental_square';
}

/**
 * Group priority for portfolio sections.
 * Lower = rendered higher on the page.
 */
function sarv_portfolio_type_priority(string $type): int
{
    return match ($type) {
        'before_after'   => 1,
        'smile_portrait' => 2,
        'dental_square'  => 2,
        'dental_closeup' => 3,
        'multi_tooth'    => 4,
        default          => 5,
    };
}

/**
 * Section label for the given priority.
 */
function sarv_portfolio_section_label(int $priority): string
{
    return match ($priority) {
        1       => 'قبل و بعد',
        2       => 'لبخندها',
        3       => 'نمای نزدیک',
        4       => 'جزئیات',
        default => 'سایر',
    };
}

/**
 * Static cache for portfolio images — prevents duplicate DB queries
 * when grid.php and item.php both need the same post's attachments.
 */
function sarv_get_portfolio_images(int $post_id): array
{
    static $cache = [];
    if (isset($cache[$post_id])) {
        return $cache[$post_id];
    }
    return $cache[$post_id] = get_posts([
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_parent'    => $post_id,
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'inherit',
    ]);
}

/**
 * Metabox registration.
 */
add_action('add_meta_boxes', function (): void {
    add_meta_box(
        'sarv_portfolio_gallery',
        'تصاویر نمونه‌کار',
        'sarv_render_portfolio_gallery_metabox',
        'sarv_portfolio',
        'normal',
        'high'
    );
});

function sarv_render_portfolio_gallery_metabox(WP_Post $post): void
{
    wp_nonce_field('sarv_portfolio_gallery_save', 'sarv_portfolio_gallery_nonce');

    $images = sarv_get_portfolio_images((int) $post->ID);
    $types  = sarv_portfolio_image_types();
    ?>
    <div id="sarv-portfolio-gallery" class="sarv-gallery">

        <p class="description" style="margin-bottom:12px">
            تصاویر را با کشیدن آیکن ☰ به ترتیب دلخواه مرتب کنید. برای هر تصویر، نوع نمایش را انتخاب کنید.
            تصویر اول به‌صورت خودکار به‌عنوان شاخص (Featured Image) تنظیم می‌شود اگر هنوز تنظیم نشده باشد.
        </p>

        <ul class="sarv-gallery-list" id="sarv-gallery-list">
            <?php foreach ($images as $image) :
                $type = sarv_get_image_type((int) $image->ID);
            ?>
                <li class="sarv-gallery-item" data-id="<?php echo esc_attr($image->ID); ?>" draggable="true">
                    <span class="sarv-gallery-handle" title="جابه‌جایی">☰</span>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($image->ID, 'thumbnail')); ?>"
                         class="sarv-gallery-thumb" alt="" draggable="false">
                    <select name="sarv_image_type[<?php echo esc_attr($image->ID); ?>]" class="sarv-gallery-type">
                        <?php foreach ($types as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" <?php selected($type, $value); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden"
                           name="sarv_image_order[<?php echo esc_attr($image->ID); ?>]"
                           value="<?php echo esc_attr((int) $image->menu_order); ?>"
                           class="sarv-gallery-order">
                    <button type="button" class="sarv-gallery-remove" aria-label="حذف تصویر">×</button>
                </li>
            <?php endforeach; ?>
        </ul>

        <p style="margin-top:12px">
            <button type="button" class="button button-secondary" id="sarv-add-images">
                + افزودن تصاویر
            </button>
        </p>
    </div>
    <?php
}

/**
 * Save handler.
 */
add_action('save_post_sarv_portfolio', function (int $post_id, WP_Post $post): void {
    if (!isset($_POST['sarv_portfolio_gallery_nonce'])) return;
    if (!wp_verify_nonce($_POST['sarv_portfolio_gallery_nonce'], 'sarv_portfolio_gallery_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // If the metabox was not submitted at all (e.g. hidden via Screen Options),
    // do not touch existing associations.
    if (!array_key_exists('sarv_image_type', $_POST)) return;

    $posted_types = is_array($_POST['sarv_image_type']) ? $_POST['sarv_image_type'] : [];
    $posted_order = is_array($_POST['sarv_image_order'] ?? null) ? $_POST['sarv_image_order'] : [];

    // 1. Detach attachments no longer present in the submitted list.
    foreach (sarv_get_portfolio_images($post_id) as $image) {
        if (!array_key_exists($image->ID, $posted_types)) {
            wp_update_post(['ID' => (int) $image->ID, 'post_parent' => 0]);
        }
    }

    // 2. Attach / update the ones that remain.
    $allowed_types = array_keys(sarv_portfolio_image_types());
    $ordered_ids   = [];

    foreach ($posted_types as $att_id => $type_val) {
        $att_id = (int) $att_id;
        if ($att_id <= 0) continue;
        if (get_post_type($att_id) !== 'attachment') continue;
        if (!wp_attachment_is_image($att_id)) continue;

        $type = sanitize_key((string) $type_val);
        if (in_array($type, $allowed_types, true)) {
            update_post_meta($att_id, '_sarv_image_type', $type);
        }

        $order = (int) ($posted_order[$att_id] ?? 0);

        wp_update_post([
            'ID'          => $att_id,
            'post_parent' => $post_id,
            'menu_order'  => $order,
        ]);

        $ordered_ids[] = $att_id;
    }

    // 3. Auto-set featured image from first attachment if none exists yet.
    if (!has_post_thumbnail($post_id) && !empty($ordered_ids)) {
        usort($ordered_ids, function ($a, $b) use ($posted_order) {
            return (int) ($posted_order[$a] ?? 0) <=> (int) ($posted_order[$b] ?? 0);
        });
        set_post_thumbnail($post_id, $ordered_ids[0]);
    }
}, 10, 2);

/**
 * Enqueue admin assets on the portfolio edit screen only.
 */
add_action('admin_enqueue_scripts', function (string $hook): void {
    $screen = get_current_screen();
    if (!$screen || 'sarv_portfolio' !== $screen->post_type) return;

    wp_enqueue_media();

    wp_enqueue_style(
        'sarv-portfolio-admin',
        get_template_directory_uri() . '/admin/css/portfolio-admin.css',
        [],
        '1.0.0'
    );

    wp_enqueue_script(
        'sarv-portfolio-admin',
        get_template_directory_uri() . '/admin/js/portfolio-admin.js',
        [],
        '1.0.0',
        true
    );
});