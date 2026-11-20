<?php
    /**
 * Portfolio grid — grouped by image presentation type.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $query = $args['query'] ?? null;
    if (! $query || empty($query->posts)) {
    return;
    }

    /* Group posts by their primary image type priority. */
    $groups = [];
    foreach ($query->posts as $p) {
    $images = sarv_get_portfolio_images((int) $p->ID);
    if (empty($images)) {
        continue;
    }

    $type                = sarv_get_image_type((int) $images[0]->ID);
    $priority            = sarv_portfolio_type_priority($type);
    $groups[$priority][] = $p;
    }

    if (empty($groups)) {
    return;
    }

    ksort($groups);
?>

<div class="sarv-portfolio-sections">
    <?php foreach ($groups as $priority => $posts): ?>
        <section class="sarv-portfolio-section" data-priority="<?php echo esc_attr($priority); ?>">
            <div class="sarv-portfolio-section__header">
                <span class="sarv-portfolio-section__line" aria-hidden="true"></span>
                <h2 class="sarv-portfolio-section__title">
                    <?php echo esc_html(sarv_portfolio_section_label($priority)); ?>
                </h2>
            </div>

            <div class="sarv-portfolio-section__grid sarv-portfolio-section__grid--p<?php echo esc_attr($priority); ?>">
                <?php foreach ($posts as $i => $p):
                        setup_postdata($GLOBALS['post'] = $p);
                        get_template_part('template-parts/portfolio/item', null, ['index' => $i]);
                    endforeach;
                    wp_reset_postdata();
                ?>
            </div>
        </section>
    <?php endforeach; ?>
</div>