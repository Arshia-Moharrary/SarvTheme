<?php
/**
 * Bleaching Service Page.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

get_header();

$page_id = (int) get_the_ID();
if (have_posts()) { the_post(); }

$sections = sarv_service_sections($page_id);

$hero     = isset($sections[0]) ? sarv_service_hero($sections[0])          : [];
$stats    = isset($sections[1]) ? sarv_service_stats($sections[1])         : [];
$process  = isset($sections[2]) ? sarv_service_process($sections[2])       : [];
$bafg_ids = isset($sections[3]) ? sarv_service_bafg_ids($sections[3])      : [];
$gf_id    = isset($sections[4]) ? sarv_service_gravityform_id($sections[4]) : 0;
$faq      = isset($sections[5]) ? sarv_service_faq($sections[5])           : [];
$long_raw = $sections[6] ?? '';

/* Resolve bafg pairs (same IDs as the other services — source reuses them). */
$bafg_cases = [];
foreach ($bafg_ids as $i => $id) {
    $pair = sarv_bafg_pair($id);
    if (!$pair) continue;
    $bafg_cases[] = [
        'title'         => sprintf('نمونه بلیچینگ %s', number_format_i18n($i + 1)),
        'description'   => '',
        'before'        => $pair['before'],
        'after'         => $pair['after'],
        'before_width'  => 1000,
        'before_height' => 1000,
        'meta'          => [],
    ];
}
?>

<div class="bg-warm-ivory sarv-bleaching-page">

    <?php get_template_part('template-parts/composite/hero', null, ['hero' => $hero]); ?>

    <?php get_template_part('template-parts/composite/stats', null, ['stats' => $stats]); ?>

    <?php get_template_part('template-parts/composite/process', null, ['process' => $process]); ?>

    <?php if (!empty($bafg_cases)) :
        get_template_part('template-parts/sections/before-after-compare', null, [
            'section_id' => 'bleaching-before-after',
            'title'      => 'نتایج بلیچینگ در کلینیک سرو',
            'intro'      => 'نمونه‌های واقعی بلیچینگ انجام‌شده در کلینیک سرو. برای مقایسه، دستگیره را بکشید.',
            'hint'       => 'برای مقایسه، دستگیره را بکشید',
            'cases'      => $bafg_cases,
        ]);
    endif; ?>

    <?php if ($gf_id > 0) :
        get_template_part('template-parts/composite/form', null, [
            'form_id' => $gf_id,
            'title'   => 'فرم تماس',
            'intro'   => 'برای دریافت مشاوره تخصصی و رایگان، این فرم را تکمیل کنید. همکاران ما در اسرع وقت با شما تماس می‌گیرند.',
        ]);
    endif; ?>

    <?php if (!empty($faq)) :
        get_template_part('template-parts/composite/faq', null, [
            'items' => $faq,
            'title' => 'سوالات متداول',
        ]);
    endif; ?>

    <?php if (trim($long_raw) !== '') :
        get_template_part('template-parts/composite/long-content', null, ['raw' => $long_raw]);
    endif; ?>

    <?php get_template_part('template-parts/composite/cta'); ?>

</div>

<?php get_footer(); ?>