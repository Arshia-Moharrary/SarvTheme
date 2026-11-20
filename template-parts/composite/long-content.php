<?php
/**
 * Composite long-form content — preserves original HTML through the_content filter.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$raw = $args['raw'] ?? '';
if (trim($raw) === '') return;

/* Strip Flatsome wrappers only. Leave h2, p, ul, table, img, iframe, gallery shortcode intact. */
$clean = sarv_service_strip_wrappers($raw);
$html  = apply_filters('the_content', $clean);
?>

<section class="sarv-composite-long py-16 md:py-24 bg-warm-ivory">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="sarv-article-content mx-auto" style="max-width: 72ch;">
            <?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
    </div>
</section>