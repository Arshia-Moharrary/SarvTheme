<?php

/**
 * Template Name: تماس با ما (Contact Us)
 * Template Post Type: page
 *
 * Auto-applies to the page with slug "contact".
 * Also available in admin template dropdown for manual assignment.
 *
 * Requires the global reveal observer (adds `.is-visible` to `.reveal-up`
 * and `.reveal-fade`) — already used by about, estimator, veneer.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

get_header();
?>

<?php
get_template_part('template-parts/contact/hero');
get_template_part('template-parts/contact/form-section');
get_template_part('template-parts/contact/locations');
get_template_part('template-parts/contact/closing');
?>

<?php
get_footer();
