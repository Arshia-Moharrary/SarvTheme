<?php
/**
 * Composite consultation form (Gravity Forms ID wrapper).
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$form_id = (int) ($args['form_id'] ?? 0);
$title   = (string) ($args['title'] ?? 'فرم درخواست مشاوره رایگان');
$intro   = (string) ($args['intro'] ?? 'برای دریافت مشاوره تخصصی و رایگان، این فرم را تکمیل کنید. همکاران ما در اسرع وقت با شما تماس می‌گیرند.');
if ($form_id <= 0 || !shortcode_exists('gravityform')) return;
?>

<section class="sarv-composite-form py-16 md:py-24 bg-warm-ivory">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-soft-stone/60 rounded-brand-lg p-6 md:p-10 shadow-sm reveal-up">

            <header class="text-center mb-8 md:mb-10">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="w-8 h-px bg-champagne-gold"></span>
                    <span class="text-champagne-gold font-bold font-peyda text-caption tracking-widest uppercase">فرم مشاوره</span>
                    <span class="w-8 h-px bg-champagne-gold"></span>
                </div>
                <h2 class="text-h3 md:text-h2 font-black text-deep-emerald leading-tight font-peyda mb-3">
                     <?php echo esc_html($title); ?>
                </h2>
                <p class="text-body text-charcoal/70 font-peyda max-w-lg mx-auto">
                    برای دریافت مشاوره تخصصی و رایگان، این فرم را تکمیل کنید. همکاران ما در اسرع وقت با شما تماس می‌گیرند.
                </p>
            </header>

            <div class="sarv-gf-scope">
                <?php echo do_shortcode('[gravityform id="' . $form_id . '" title="false" description="false" ajax="true"]'); ?>
            </div>

        </div>
    </div>
</section>