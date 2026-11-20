<?php
/**
 * Archive header — shared editorial introduction.
 *
 * @param array $args {
 *     @type string    $context      'home' | 'category' | 'search'
 *     @type WP_Term   $category     Category object (category context only)
 *     @type string    $search_term  Search query (search context only)
 * }
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$context     = $args['context'] ?? 'home';
$category    = $args['category'] ?? null;
$search_term = $args['search_term'] ?? '';

$eyebrow = 'مقالات سرو';
$title   = 'دانش لبخند';
$desc    = 'مجموعه‌ای از مقالات تخصصی درباره ایمپلنت، لمینت، کامپوزیت و بلیچینگ — نوشته‌شده توسط تیم درمانی کلینیک سرو.';

if ($context === 'category' && $category instanceof WP_Term) {
    $eyebrow = 'دسته‌بندی';
    $title   = $category->name;
    $desc    = $category->description ?: sprintf('مقالات مرتبط با %s در وبلاگ کلینیک سرو.', $category->name);
} elseif ($context === 'search') {
    $eyebrow = 'نتایج جستجو';
    $title   = sprintf('جستجو برای: %s', $search_term ?: '—');
    $desc    = 'مقالات یافت‌شده در وبلاگ کلینیک سرو.';
}

$search_value = $context === 'search' ? $search_term : '';
$blog_url     = get_permalink(get_option('page_for_posts')) ?: home_url('/blog/');
?>

<section class="pt-12 lg:pt-20 pb-10 lg:pb-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav aria-label="مسیر صفحه" class="mb-10 lg:mb-14 reveal-fade">
            <ol class="flex items-center gap-2 text-caption font-peyda text-charcoal/60 flex-wrap">
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                       class="hover:text-champagne-gold transition-colors duration-300">خانه</a>
                </li>
                <li aria-hidden="true" class="text-soft-stone">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </li>
                <?php if ($context === 'category' && $category) : ?>
                    <li>
                        <a href="<?php echo esc_url($blog_url); ?>"
                           class="hover:text-champagne-gold transition-colors duration-300">وبلاگ</a>
                    </li>
                    <li aria-hidden="true" class="text-soft-stone">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </li>
                    <li aria-current="page" class="text-deep-emerald font-bold">
                        <?php echo esc_html($category->name); ?>
                    </li>
                <?php elseif ($context === 'search') : ?>
                    <li>
                        <a href="<?php echo esc_url($blog_url); ?>"
                           class="hover:text-champagne-gold transition-colors duration-300">وبلاگ</a>
                    </li>
                    <li aria-hidden="true" class="text-soft-stone">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </li>
                    <li aria-current="page" class="text-deep-emerald font-bold">جستجو</li>
                <?php else : ?>
                    <li aria-current="page" class="text-deep-emerald font-bold">وبلاگ</li>
                <?php endif; ?>
            </ol>
        </nav>

        <header class="max-w-3xl">
            <span class="inline-flex items-center gap-3 text-caption font-peyda font-bold text-deep-emerald/80 tracking-widest mb-6 reveal-up">
                <span class="w-10 h-px bg-champagne-gold"></span>
                <?php echo esc_html($eyebrow); ?>
            </span>

            <h1 class="text-h2 sm:text-h1 lg:text-hero font-black font-peyda text-deep-emerald leading-[1.15] tracking-normal reveal-up delay-100">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($desc) : ?>
                <p class="mt-6 text-body-range text-charcoal/75 font-peyda leading-loose max-w-2xl reveal-up delay-200">
                    <?php echo esc_html($desc); ?>
                </p>
            <?php endif; ?>

            <!-- Search form -->
            <form role="search"
                  method="get"
                  action="<?php echo esc_url(home_url('/')); ?>"
                  class="mt-8 reveal-up delay-300">
                <label for="blog-search" class="sr-only">جستجوی مقالات</label>
                <div class="relative max-w-lg">
                    <span class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none text-charcoal/40" aria-hidden="true">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="search"
                           id="blog-search"
                           name="s"
                           value="<?php echo esc_attr($search_value); ?>"
                           placeholder="جستجو در مقالات..."
                           autocomplete="off"
                           class="w-full h-14 ps-12 pe-28 rounded-brand border border-soft-stone/80 bg-white text-deep-emerald font-peyda text-body placeholder:text-charcoal/40 outline-none transition-all duration-300 focus:border-deep-emerald focus:ring-2 focus:ring-deep-emerald/20">
                    <button type="submit"
                            class="absolute inset-y-2 end-2 px-5 rounded-brand bg-deep-emerald text-warm-ivory font-peyda font-bold text-caption hover:bg-forest-noir transition-colors duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-champagne-gold focus-visible:ring-offset-2">
                        جستجو
                    </button>
                </div>
            </form>
        </header>
    </div>
</section>