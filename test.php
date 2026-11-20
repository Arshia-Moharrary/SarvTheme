<?php
// tools/audit-bafg.php
// defined('ABSPATH') || die('CLI only');
// if (PHP_SAPI !== 'cli') die("CLI only\n");
$wp_root = 'C:/xampp/htdocs/sarv-old/wp-load.php';
if (!file_exists($wp_root)) { $wp_root = '/opt/lampp/htdocs/sarv-dental/wp-load.php'; }
require_once $wp_root;

foreach ([15851, 15862, 15864, 15872] as $id) {
    $p = get_post($id);
    echo "\n=== ID {$id} ({$p->post_title}) ===\n";
    echo "Content (" . strlen($p->post_content) . " chars):\n";
    echo substr($p->post_content, 0, 500) . "\n";
    echo "Meta:\n";
    foreach (get_post_meta($id) as $k => $v) {
        echo "  {$k} => " . wp_json_encode($v) . "\n";
    }
    echo "Attachments (children):\n";
    $atts = get_children(['post_parent' => $id, 'post_type' => 'attachment', 'numberposts' => -1]);
    foreach ($atts as $a) {
        echo "  [{$a->ID}] {$a->post_title} → " . wp_get_attachment_url($a->ID) . "\n";
    }
}

// Also check the composite page for its specific content shape
$page = get_post(13533);
echo "\n\n=== COMPOSITE PAGE 13533 — shortcode map ===\n";
preg_match_all('/\[([a-z_]+)/i', $page->post_content, $m);
$counts = array_count_values($m[1]);
arsort($counts);
foreach ($counts as $sc => $n) echo "  [{$sc}]: {$n}\n";

echo "\n=== Check if shortcodes are registered ===\n";
global $shortcode_tags;
foreach (['bafg', 'accordion', 'accordion-item', 'featured_box', 'ux_image', 'ux_text', 'button', 'gap', 'divider', 'gravityform', 'gallery'] as $sc) {
    echo "  [{$sc}]: " . (isset($shortcode_tags[$sc]) ? 'YES ('.$shortcode_tags[$sc].')' : 'NO') . "\n";
}

echo "\n=== ACTIVE PLUGINS ===\n";
foreach (get_option('active_plugins', []) as $p) echo "  {$p}\n";