<?php

/**
 * Template Name: درباره ما (About Us)
 * Template Post Type: page
 *
 * Requires the global reveal observer (adds `.is-visible` to `.reveal-up`
 * and `.reveal-fade` elements) — already used by cost-estimator.php
 * and veneer-showcase.php, so it must exist in your main JS bundle.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

get_header();
?>

<?php
get_template_part('template-parts/about/hero');
get_template_part('template-parts/about/story');
get_template_part('template-parts/about/values');
get_template_part('template-parts/about/team');
get_template_part('template-parts/about/timeline');
get_template_part('template-parts/about/facility');
get_template_part('template-parts/about/testimonials');
get_template_part('template-parts/about/cta');
?>

<?php
get_footer();
