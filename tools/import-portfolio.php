<?php
/**
 * Portfolio import from legacy Flatsome page HTML.
 *
 * Classifies each image by aspect ratio and creates one sarv_portfolio post per image.
 *
 * Usage (from theme root):
 *   php tools/import-portfolio.php                     # dry-run
 *   php tools/import-portfolio.php --execute           # real import
 *   php tools/import-portfolio.php --execute --category=laminate
 *
 * Source: tools/portfolio-source.html
 *
 * @package Sarv
 */

if (PHP_SAPI !== 'cli') {
    die("Run from CLI only.\n");
}

/* ---- Load WordPress ---- */
$wp_root = 'C:/xampp/htdocs/sarv-dental/wp-load.php';
if (! file_exists($wp_root)) {
    // Fallback: common XAMPP path
    $wp_root = 'C:/xampp/htdocs/sarv-dental/wp-load.php';
}
if (! file_exists($wp_root)) {
    fwrite(STDERR, "wp-load.php not found. Edit the path at the top of this script.\n");
    exit(1);
}
require_once $wp_root;
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

/* ---- Args ---- */
$argv     = $_SERVER['argv'] ?? [];
$execute  = in_array('--execute', $argv, true);
$category = 'composite';
$source   = __DIR__ . '/portfolio-source.html';

foreach ($argv as $arg) {
    if (str_starts_with($arg, '--category=')) {
        $category = sanitize_key(substr($arg, 11));
    } elseif (! str_starts_with($arg, '--')) {
        // $source = $arg;
    }
}

if (! file_exists($source)) {
    fwrite(STDERR, "Source file not found: {$source}\n");
    exit(1);
}

$term = get_term_by('slug', $category, 'sarv_treatment');
if (! $term) {
    fwrite(STDERR, "Term '{$category}' not found in sarv_treatment.\n");
    exit(1);
}

$html = file_get_contents($source);
if (trim($html) === '') {
    fwrite(STDERR, "Source file is empty.\n");
    exit(1);
}

/* ---- Extract <img> ---- */
$images = [];
if (preg_match_all('/<img\b([^>]+)>/i', $html, $m)) {
    foreach ($m[1] as $attrs_str) {
        $attrs = [];
        if (preg_match_all('/(\w+)\s*=\s*(["\'])(.*?)\2/s', $attrs_str, $am, PREG_SET_ORDER)) {
            foreach ($am as $a) {
                $attrs[strtolower($a[1])] = $a[3];
            }
        }
        $src    = $attrs['src'] ?? '';
        $width  = (int) ($attrs['width'] ?? 0);
        $height = (int) ($attrs['height'] ?? 0);
        $alt    = trim($attrs['alt'] ?? '');

        if (! $src || $width <= 0 || $height <= 0) {
            continue;
        }

        $images[] = ['src' => $src, 'width' => $width, 'height' => $height, 'alt' => $alt];
    }
}

if (empty($images)) {
    fwrite(STDERR, "No images found.\n");
    exit(1);
}

/* ---- Dedupe by src ---- */
$seen   = [];
$unique = [];
foreach ($images as $img) {
    if (isset($seen[$img['src']])) {
        continue;
    }

    $seen[$img['src']] = true;
    $unique[]          = $img;
}

/* ---- Classifier ---- */
function sarv_classify_import(int $w, int $h): string
{
    if ($h <= 0) {
        return 'dental_square';
    }

    $ratio = $w / $h;
    if ($ratio >= 0.92) {
        return $w >= 1000 ? 'smile_portrait' : 'dental_square';
    }

    if ($ratio >= 0.69) {
        return 'dental_closeup';
    }

    if ($ratio >= 0.573) {
        return 'multi_tooth';
    }

    return 'before_after';
}

/* ---- Strip WP size suffix from URL ---- */
function sarv_strip_size(string $url): string
{
    return preg_replace('/-\d+x\d+(?=\.[a-z]+(\?.*)?$)/i', '', $url);
}

function sarv_find_attachment_by_filename(string $basename): int
{
    global $wpdb;

    // Strip WP size suffix: foo-576x1024.jpg → foo.jpg
    $base = preg_replace('/-\d+x\d+(?=\.[a-z]+$)/i', '', $basename);

    // Strip WP image editor suffix: foo-e1234567890123.jpg → foo.jpg
    $base = preg_replace('/-e\d{13}(?=\.[a-z]+$)/i', '', $base);

    $like = '%' . $wpdb->esc_like($base);

    $id = (int) $wpdb->get_var($wpdb->prepare(
        "SELECT post_id FROM {$wpdb->postmeta}
         WHERE meta_key = '_wp_attached_file'
         AND meta_value LIKE %s
         LIMIT 1",
        $like
    ));

    return $id;
}

/* ---- Banner ---- */
echo "=========================================\n";
echo " Sarv Portfolio Importer\n";
echo "=========================================\n";
echo "Source:   {$source}\n";
echo "Category: {$category} ({$term->name})\n";
echo "Mode:     " . ($execute ? 'EXECUTE' : 'DRY-RUN') . "\n";
echo "Images:   " . count($images) . " tags, " . count($unique) . " unique\n\n";

$created  = 0;
$skipped  = 0;
$failed   = 0;
$warnings = [];

/* ---- Loop ---- */
foreach ($unique as $i => $img) {
    $src      = $img['src'];
    $width    = $img['width'];
    $height   = $img['height'];
    $alt      = $img['alt'];
    $ratio    = round($width / $height, 3);
    $type     = sarv_classify_import($width, $height);
    $basename = basename(wp_parse_url($src, PHP_URL_PATH) ?: $src);

    $label = sprintf(
        "[%02d/%02d] %-55s %4d×%-4d (r=%.3f) → %-15s",
        $i + 1, count($unique),
        mb_strimwidth($basename, 0, 55, '…'),
        $width, $height, $ratio, $type
    );

    /* Sanity warnings */
    if ($ratio > 1.1) {
        $warnings[] = "LANDSCAPE not matching any spec: {$basename} ({$width}×{$height}, r={$ratio})";
    }
    if ($alt === '' || preg_match('/^(sr\d+|img[-_]?\d+)$/i', $alt)) {
        $warnings[] = "Generic alt text: '{$alt}' for {$basename}";
    }

    /* Existing attachment? */
    $att_id = attachment_url_to_postid($src);
    if (! $att_id) {
        // Try original (stripping size suffix, e.g. -576x1024)
        $stripped = sarv_strip_size($src);
        if ($stripped !== $src) {
            $att_id = attachment_url_to_postid($stripped);
        }
    }

    if (! $att_id) {
        $att_id = sarv_find_attachment_by_filename($basename);
    }

    /* Already attached to a portfolio item? */
    if ($att_id) {
        $old_parent = (int) wp_get_post_parent_id($att_id);
        if ($old_parent && get_post_type($old_parent) === 'sarv_portfolio') {
            echo $label . " SKIP (already in post #{$old_parent})\n";
            $skipped++;
            continue;
        }
    }

    /* DRY-RUN output */
    if (! $execute) {
        echo $label . ' | att=' . ($att_id ?: 'NEW') . "\n";
        continue;
    }

    /* EXECUTE */

    /* 1. Ensure attachment exists */
    if (! $att_id) {
        $tmp = download_url($src, 60);
        if (is_wp_error($tmp)) {
            fwrite(STDERR, $label . "\n  ✗ download: " . $tmp->get_error_message() . "\n");
            $failed++;
            continue;
        }

        $file_array = [
            'name'     => $basename ?: 'portfolio-' . ($i + 1) . '.jpg',
            'tmp_name' => $tmp,
        ];

        $att_id = media_handle_sideload($file_array, 0, $alt ?: null);
        if (is_wp_error($att_id)) {
            @unlink($tmp);
            fwrite(STDERR, $label . "\n  ✗ sideload: " . $att_id->get_error_message() . "\n");
            $failed++;
            continue;
        }

        if ($alt !== '') {
            update_post_meta($att_id, '_wp_attachment_image_alt', $alt);
        }
    }

    /* 2. Create portfolio post */
    $title = $alt !== '' ? $alt : pathinfo($basename, PATHINFO_FILENAME);

    $post_id = wp_insert_post([
        'post_type'   => 'sarv_portfolio',
        'post_status' => 'publish',
        'post_title'  => $title,
    ], true);

    if (is_wp_error($post_id)) {
        fwrite(STDERR, $label . "\n  ✗ post: " . $post_id->get_error_message() . "\n");
        $failed++;
        continue;
    }

    /* 3. Attach image */
    wp_update_post([
        'ID'          => (int) $att_id,
        'post_parent' => (int) $post_id,
        'menu_order'  => 0,
    ]);
    update_post_meta((int) $att_id, '_sarv_image_type', $type);

    /* 4. Category + featured */
    wp_set_object_terms((int) $post_id, $category, 'sarv_treatment');
    set_post_thumbnail((int) $post_id, (int) $att_id);

    echo $label . " ✓ post={$post_id} att={$att_id}\n";
    $created++;
}

/* ---- Summary ---- */
echo "\n=========================================\n";
echo " Summary\n";
echo "=========================================\n";
echo "Created: {$created}\n";
echo "Skipped: {$skipped}\n";
echo "Failed:  {$failed}\n";

if (! empty($warnings)) {
    echo "\n⚠ " . count($warnings) . " warning(s):\n";
    foreach ($warnings as $w) {
        echo "  · {$w}\n";
    }
}

if (! $execute) {
    echo "\nThis was a DRY RUN. Re-run with --execute to import.\n";
}
