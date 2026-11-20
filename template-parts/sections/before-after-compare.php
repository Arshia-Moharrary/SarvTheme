<?php
    /**
 * Reusable Before/After comparison section.
 *
 * @package Sarv
 *
 * @var array $args {
 *   @type array  $cases   Required. Each: title, description, before, after,
 *                         before_width, before_height, meta[].
 *   @type string $title       Section h2. Default: 'تفاوت را خودتان ببینید'
 *   @type string $intro       Optional lead paragraph.
 *   @type string $hint        Helper text next to the hint icon.
 *   @type string $section_id  Default: 'before-after-compare'
 * }
 */

    defined('ABSPATH') || exit;

    $cases      = $args['cases'] ?? [];
    $title      = $args['title'] ?? 'تفاوت را خودتان ببینید';
    $intro      = $args['intro'] ?? '';
    $hint       = $args['hint'] ?? 'برای مقایسه، دستگیره را بکشید';
    $section_id = $args['section_id'] ?? 'before-after-compare';

    if (empty($cases)) {
    return;
    }

    $rtl_class = is_rtl() ? 'veneer-compare--rtl' : '';
    $title_id  = $section_id . '-title';
?>

<section id="<?php echo esc_attr($section_id); ?>" aria-labelledby="<?php echo esc_attr($title_id); ?>" class="relative bg-warm-ivory text-charcoal py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <header class="grid grid-cols-1 lg:grid-cols-12 items-end gap-6 lg:gap-12 mb-12 lg:mb-16">
            <h2 id="<?php echo esc_attr($title_id); ?>" class="lg:col-span-7 text-h3 sm:text-h2 font-black font-peyda text-deep-emerald leading-[1.3] tracking-normal reveal-up">
                <?php echo esc_html($title); ?>
            </h2>

            <div class="lg:col-span-5 reveal-up delay-100">
                <?php if ($intro !== ''): ?>
                    <p class="text-body-range text-charcoal/70 font-peyda leading-relaxed max-w-xl">
                        <?php echo esc_html($intro); ?>
                    </p>
                <?php endif; ?>
                <p class="mt-5 inline-flex items-center gap-3 text-caption font-bold font-peyda text-deep-emerald">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-deep-emerald text-champagne-gold" aria-hidden="true">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                    <?php echo esc_html($hint); ?>
                </p>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 items-start gap-14 md:gap-16 lg:gap-8 xl:gap-10">
            <?php foreach ($cases as $i => $case):
                    $case_title = $case['title'] ?? '';
                    $case_desc  = $case['description'] ?? '';
                    $case_meta  = $case['meta'] ?? [];
                    $before_url = $case['before'] ?? '';
                    $after_url  = $case['after'] ?? '';
                    $bw         = (int) ($case['before_width'] ?? 1000);
                    $bh         = (int) ($case['before_height'] ?? 1000);
                    if (! $before_url || ! $after_url) {
                        continue;
                    }

            ?>
                <article class="flex flex-col md:max-lg:flex-row md:max-lg:items-center md:max-lg:gap-8 md:max-lg:even:flex-row-reverse reveal-up delay-<?php echo esc_attr(($i + 1) * 100); ?> <?php echo $i === 1 ? 'lg:mt-16' : ''; ?>">

                    <div class="md:max-lg:w-[56%] md:max-lg:shrink-0">
                        <div data-compare
                             dir="ltr"
                             role="group"
                             aria-label="<?php echo esc_attr('مقایسه قبل و بعد: ' . $case_title); ?>"
                             class="veneer-compare <?php echo esc_attr($rtl_class); ?>">

                            <img class="veneer-img"
                                 src="<?php echo esc_url($after_url); ?>"
                                 alt="<?php echo esc_attr('بعد — ' . $case_title); ?>"
                                 width="<?php echo esc_attr($bw); ?>" height="<?php echo esc_attr($bh); ?>"
                                 sizes="(min-width: 1024px) 33vw, (min-width: 768px) 56vw, 100vw"
                                 loading="lazy" decoding="async" draggable="false">

                            <div class="veneer-before">
                                <img class="veneer-img"
                                     src="<?php echo esc_url($before_url); ?>"
                                     alt="<?php echo esc_attr('قبل — ' . $case_title); ?>"
                                     width="<?php echo esc_attr($bw); ?>" height="<?php echo esc_attr($bh); ?>"
                                     sizes="(min-width: 1024px) 33vw, (min-width: 768px) 56vw, 100vw"
                                     loading="lazy" decoding="async" draggable="false">
                            </div>

                            <span class="veneer-tag veneer-tag--before">قبل</span>
                            <span class="veneer-tag veneer-tag--after">بعد</span>

                            <div class="veneer-handle"
                                 data-handle
                                 role="slider"
                                 tabindex="0"
                                 aria-orientation="horizontal"
                                 aria-valuemin="0" aria-valuemax="100" aria-valuenow="50"
                                 aria-label="<?php echo esc_attr('دستگیره مقایسه: ' . $case_title); ?>">
                                <span class="veneer-grip" aria-hidden="true">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5 md:max-lg:pt-0 md:max-lg:flex-1 text-start">
                        <?php if ($case_title): ?>
                            <h3 class="text-h4 font-bold font-peyda text-deep-emerald leading-snug">
                                <?php echo esc_html($case_title); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ($case_desc): ?>
                            <p class="mt-2 text-body font-peyda text-charcoal/70 leading-relaxed max-w-prose">
                                <?php echo esc_html($case_desc); ?>
                            </p>
                        <?php endif; ?>
                        <?php if (! empty($case_meta)): ?>
                            <dl class="mt-4 pt-4 border-t border-soft-stone flex flex-wrap gap-x-8 gap-y-3">
                                <?php foreach ($case_meta as $row): ?>
                                    <div>
                                        <dt class="text-caption font-peyda text-charcoal/60"><?php echo esc_html($row['label'] ?? ''); ?></dt>
                                        <dd class="text-body font-peyda font-bold text-deep-emerald"><?php echo esc_html($row['value'] ?? ''); ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>