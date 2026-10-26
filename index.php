<?php

/**
 * The main template file (Temporary RTL Test)
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="p-10 bg-warm-ivory min-h-screen font-sans flex justify-center items-center">
    <div class="w-full max-w-2xl bg-white rounded-brand shadow-lg border border-soft-stone overflow-hidden">

        <!-- هدر کارت -->
        <div class="p-6 border-b border-soft-stone bg-deep-emerald text-warm-ivory">
            <h2 class="text-h3 font-bold m-0">تست منطق RTL و Logical Properties</h2>
        </div>

        <div class="p-8 space-y-10">

            <!-- تست ۱: حاشیه و پدینگ منطقی -->
            <div>
                <h3 class="text-body-range font-semibold text-deep-emerald mb-2">۱. Margin Inline-Start (ms) و Padding Inline-Start (ps)</h3>
                <p class="text-caption text-charcoal mb-4">در این تست، ما از <code class="bg-soft-stone px-1 rounded">ps-6</code> استفاده کرده‌ایم. در حالت RTL، پدینگ باید از سمت <strong>راست</strong> اعمال شود.</p>

                <div class="bg-warm-ivory border border-champagne-gold border-dashed rounded-lg ps-6 py-4">
                    <div class="bg-champagne-gold text-deep-emerald font-bold p-2 rounded text-caption inline-block">
                        این باکس باید از سمت راست فاصله داشته باشد (Padding Start)
                    </div>
                </div>
            </div>

            <!-- تست ۲: چیدمان فلکس (Flex) -->
            <div>
                <h3 class="text-body-range font-semibold text-deep-emerald mb-2">۲. چیدمان Flex (جهت پیش‌فرض)</h3>
                <p class="text-caption text-charcoal mb-4">در حالت RTL، اولین آیتم در یک کانتینر <code class="bg-soft-stone px-1 rounded">flex</code> باید در سمت <strong>راست</strong> قرار بگیرد.</p>

                <div class="flex items-center gap-4 bg-warm-ivory border border-soft-stone p-4 rounded-lg">
                    <div class="w-12 h-12 bg-deep-emerald rounded-full flex items-center justify-center text-white font-bold">۱</div>
                    <div class="w-12 h-12 bg-champagne-gold rounded-full flex items-center justify-center text-white font-bold">۲</div>
                    <div class="w-12 h-12 bg-charcoal rounded-full flex items-center justify-center text-white font-bold">۳</div>
                    <div class="ms-auto text-caption text-charcoal bg-soft-stone px-3 py-1 rounded-full">
                        من با <code class="font-bold">ms-auto</code> به سمت چپ (End) هل داده شدم.
                    </div>
                </div>
            </div>

            <!-- تست ۳: ترازبندی متن (Text Alignment) -->
            <div>
                <h3 class="text-body-range font-semibold text-deep-emerald mb-2">۳. ترازبندی متن (text-start vs text-end)</h3>

                <div class="space-y-4">
                    <div class="text-start bg-warm-ivory p-4 rounded-lg border border-soft-stone">
                        <span class="text-caption text-gray-500 block mb-1">text-start</span>
                        <p class="text-body text-charcoal m-0">این متن باید به سمت راست (شروع جمله در فارسی) تراز شود.</p>
                    </div>
                    <div class="text-end bg-warm-ivory p-4 rounded-lg border border-soft-stone">
                        <span class="text-caption text-gray-500 block mb-1">text-end</span>
                        <p class="text-body text-charcoal m-0">این متن باید به سمت چپ (پایان جمله در فارسی) تراز شود.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
get_footer();
