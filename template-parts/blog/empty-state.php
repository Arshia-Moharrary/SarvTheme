<?php

/**
 * Empty state — shared across archive contexts.
 *
 * @param array $args {
 *     @type string $context  'home' | 'category' | 'search'
 * }
 *
 * @package Sarv
 */

defined('ABSPATH') || exit;

$context = $args['context'] ?? 'home';

$message = 'هنوز مقاله‌ای در این بخش منتشر نشده است.';
$cta_url = home_url('/blog/');
$cta_txt = 'بازگشت به وبلاگ';

if ($context === 'search') {
    $message = 'نتیجه‌ای برای جستجوی شما یافت نشد. عبارت دیگری را امتحان کنید.';
    $cta_txt = 'مشاهده همه مقالات';
} elseif ($context === 'category') {
    $message = 'هنوز مقاله‌ای در این دسته‌بندی منتشر نشده است.';
}
?>

<div class="py-20 text-center reveal-up">
    <div class="w-16 h-16 rounded-full bg-soft-stone/40 flex items-center justify-center mx-auto mb-6">
        <svg class="w-8 h-8 text-charcoal/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    <p class="text-body-range font-peyda text-charcoal/70 leading-relaxed max-w-md mx-auto">
        <?php echo esc_html($message); ?>
    </p>
    <a href="<?php echo esc_url($cta_url); ?>"
        class="mt-6 inline-flex items-center gap-2 text-caption font-peyda font-bold text-deep-emerald hover:text-champagne-gold transition-colors duration-300">
        <?php echo esc_html($cta_txt); ?>
        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
        </svg>
    </a>
</div>