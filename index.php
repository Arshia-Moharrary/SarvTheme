<?php
/**
 * The main template file (Mock Hero for Header Connection Test)
 *
 * @package Sarv
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- Mock Hero Section -->
<section class="relative bg-deep-emerald text-warm-ivory pt-32 pb-24 rounded-t-[3rem] mx-2 md:mx-4 -mt-4 overflow-hidden shadow-2xl z-10">
    
    <!-- المان‌های تزئینی پس‌زمینه (مشابه تصویر مرجع) -->
    <div class="absolute top-10 left-10 opacity-20">
        <svg class="w-12 h-12 text-champagne-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
    </div>
    <div class="absolute bottom-20 right-10 opacity-20">
        <svg class="w-16 h-16 text-champagne-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto mt-8">
            <h1 class="text-hero font-black font-peyda text-warm-ivory mb-6 leading-tight">
                نوبت دکتر رو <span class="text-champagne-gold">آتلاین</span> بگیر
            </h1>
            <p class="text-body-range text-warm-ivory/80 font-peyda mb-10 leading-relaxed">
                با چند کلیک ساده و سریع، پزشک معتبر پیدا کن، نوبت رزرو کن و از خدمات پزشکی مطمئن و حرفه‌ای در هر زمان و هر مکان استفاده کن.
            </p>
            <div class="flex items-center gap-4">
                <a href="#" class="bg-champagne-gold text-deep-emerald px-8 py-3 rounded-brand text-body font-bold hover:bg-warm-ivory transition-colors duration-300 shadow-lg">
                    رزرو نوبت
                </a>
                <a href="#" class="bg-transparent border-2 border-warm-ivory/30 text-warm-ivory px-8 py-3 rounded-brand text-body font-bold hover:bg-warm-ivory/10 transition-colors duration-300">
                    درباره ما
                </a>
            </div>
        </div>
    </div>
    
    <!-- المان تزئینی پایین Hero -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 z-20">
        <div class="w-12 h-12 bg-champagne-gold rounded-full flex items-center justify-center shadow-lg text-deep-emerald">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </div>
</section>

<!-- بقیه محتوای صفحه (برای تست اسکرول) -->
<div class="max-w-7xl mx-auto px-4 py-20">
    <div class="bg-white rounded-brand-lg shadow-sm border border-soft-stone p-10 min-h-[500px] flex items-center justify-center text-charcoal/50 font-peyda text-h2">
        محتوای صفحات بعدی در اینجا قرار می‌گیرد...
    </div>
</div>

<?php
get_footer();