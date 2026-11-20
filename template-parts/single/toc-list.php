<?php
    /**
 * TOC list.
 *
 * @package Sarv
 */

    defined('ABSPATH') || exit;

    $toc = $args['toc'] ?? [];
    if (empty($toc)) {
    return;
    }

?>

<ol class="space-y-2 font-peyda text-body">
    <?php foreach ($toc as $item): ?>
        <li class="<?php echo $item['level'] === 3 ? 'ps-4' : ''; ?>">
            <a href="#<?php echo esc_attr($item['id']); ?>"
               class="sarv-article-toc__link block py-1 text-charcoal/70 hover:text-deep-emerald border-s-2 border-transparent ps-3 transition-colors duration-200"
               data-sarv-toc-target="<?php echo esc_attr($item['id']); ?>">
                <?php echo esc_html($item['text']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ol>