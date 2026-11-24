<?php
/**
 * Portfolio CPT & taxonomy.
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

add_action('init', function (): void {
    register_post_type('sarv_portfolio', [
        'labels'             => [
            'name'               => 'نمونه‌کارها',
            'singular_name'      => 'نمونه‌کار',
            'add_new'            => 'افزودن نمونه‌کار',
            'add_new_item'       => 'افزودن نمونه‌کار جدید',
            'edit_item'          => 'ویرایش نمونه‌کار',
            'new_item'           => 'نمونه‌کار جدید',
            'view_item'          => 'مشاهده نمونه‌کار',
            'view_items'         => 'مشاهده نمونه‌کارها',
            'search_items'       => 'جستجوی نمونه‌کار',
            'not_found'          => 'نمونه‌کاری یافت نشد',
            'not_found_in_trash' => 'نمونه‌کاری در سطل زباله نیست',
            'menu_name'          => 'نمونه‌کارها',
        ],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-format-gallery',
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
        'hierarchical'       => false,
        'has_archive'        => false, // /portfolio/ Page handles the listing
        'rewrite'            => ['slug' => 'portfolio-item', 'with_front' => false],
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'       => true,
    ]);

    register_taxonomy('sarv_treatment', ['sarv_portfolio'], [
        'labels'             => [
            'name'              => 'دسته‌های درمان',
            'singular_name'     => 'دستهٔ درمان',
            'search_items'      => 'جستجوی دسته',
            'all_items'         => 'همهٔ دسته‌ها',
            'parent_item'       => 'دستهٔ والد',
            'parent_item_colon' => 'دستهٔ والد:',
            'edit_item'         => 'ویرایش دسته',
            'update_item'       => 'به‌روزرسانی دسته',
            'add_new_item'      => 'افزودن دستهٔ جدید',
            'new_item_name'     => 'نام دستهٔ جدید',
            'menu_name'         => 'دسته‌های درمان',
        ],
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_admin_column'  => true,
        'hierarchical'       => true,
        'rewrite'            => false,
        'show_in_rest'       => true,
    ]);
});

/**
 * Seed the four default treatment terms once.
 */
add_action('init', function (): void {
    if (get_option('sarv_portfolio_seeded_v1')) {
        return;
    }
    $defaults = [
        ['slug' => 'composite', 'name' => 'کامپوزیت'],
        ['slug' => 'laminate', 'name' => 'لمینت'],
        ['slug' => 'implant', 'name' => 'ایمپلنت'],
        ['slug' => 'bleaching', 'name' => 'بلیچینگ'],
    ];
    foreach ($defaults as $term) {
        if (! term_exists($term['slug'], 'sarv_treatment')) {
            wp_insert_term($term['name'], 'sarv_treatment', ['slug' => $term['slug']]);
        }
    }
    update_option('sarv_portfolio_seeded_v1', 1);
}, 20);
