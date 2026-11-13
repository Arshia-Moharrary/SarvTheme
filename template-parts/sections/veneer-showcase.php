<?php

/**
 * Veneer Showcase Section
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<?php
/**
 * Veneer Showcase — before / after comparisons (1:1 photographs).
 *
 * Map your existing cases into $sarv_veneer_cases (the only integration point):
 *   'before' / 'after' → image URLs (use your existing paths), 1000×1000 or any square size
 *   'meta'             → optional clinical details, e.g. [ ['label' => '...', 'value' => '...'] ]
 */

$sarv_img = get_template_directory_uri() . '/src/images/veneers/'; // ← adjust to your real folder

$sarv_veneer_title = 'تفاوت را خودتان ببینید';
$sarv_veneer_intro = 'نمونه‌هایی واقعی از لمینت‌های انجام‌شده در کلینیک سرو؛ هر دو تصویر مربوط به یک بیمار است.';
$sarv_veneer_hint  = 'برای مقایسه، دستگیره را بکشید';

$sarv_veneer_cases = [
    [
        'title'       => 'طراحی لبخند با لمینت — نمونه اول',
        'description' => 'شرح کوتاه این درمان را اینجا بنویسید.',
        'before'      => $sarv_img . 'before-1.jpg',
        'after'       => $sarv_img . 'after-1.jpg',
        'meta'        => [], // e.g. [ ['label' => 'نوع درمان', 'value' => 'لمینت سرامیکی'] ]
    ],
    [
        'title'       => 'طراحی لبخند با لمینت — نمونه دوم',
        'description' => 'شرح کوتاه این درمان را اینجا بنویسید.',
        'before'      => $sarv_img . 'before-2.jpg',
        'after'       => $sarv_img . 'after-2.jpg',
        'meta'        => [],
    ],
    [
        'title'       => 'طراحی لبخند با لمینت — نمونه سوم',
        'description' => 'شرح کوتاه این درمان را اینجا بنویسید.',
        'before'      => $sarv_img . 'before-3.jpg',
        'after'       => $sarv_img . 'after-3.jpg',
        'meta'        => [],
    ],
];

$sarv_rtl_class = is_rtl() ? 'veneer-compare--rtl' : '';
?>

<section id="veneer-showcase" aria-labelledby="veneer-title" class="relative bg-warm-ivory text-charcoal py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- ============ Header ============ -->
        <header class="grid grid-cols-1 lg:grid-cols-12 items-end gap-6 lg:gap-12 mb-12 lg:mb-16">
            <h2 id="veneer-title" class="lg:col-span-7 text-h3 sm:text-h2 font-black font-peyda text-deep-emerald leading-[1.3] tracking-normal reveal-up">
                <?php echo esc_html($sarv_veneer_title); ?>
            </h2>

            <div class="lg:col-span-5 reveal-up delay-100">
                <p class="text-body-range text-charcoal/70 font-peyda leading-relaxed max-w-xl">
                    <?php echo esc_html($sarv_veneer_intro); ?>
                </p>
                <p class="mt-5 inline-flex items-center gap-3 text-caption font-bold font-peyda text-deep-emerald">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-deep-emerald text-champagne-gold" aria-hidden="true">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                    <?php echo esc_html($sarv_veneer_hint); ?>
                </p>
            </div>
        </header>

        <!-- ============ Cases ============
             Phone: stacked, full-width squares.
             Tablet: square left / text right, alternating sides.
             Desktop: three squares, middle one dropped for rhythm. -->
        <div class="grid grid-cols-1 lg:grid-cols-3 items-start gap-14 md:gap-16 lg:gap-8 xl:gap-10">
            <?php foreach ($sarv_veneer_cases as $i => $case) :
                $title = $case['title'];
            ?>
                <article class="flex flex-col md:max-lg:flex-row md:max-lg:items-center md:max-lg:gap-8 md:max-lg:even:flex-row-reverse reveal-up delay-<?php echo ($i + 1) * 100; ?> <?php echo $i === 1 ? 'lg:mt-16' : ''; ?>">

                    <!-- Comparison: After = base layer, Before = clipped layer above. Square, always. -->
                    <div class="md:max-lg:w-[56%] md:max-lg:shrink-0">
                        <div
                            data-compare
                            dir="ltr"
                            role="group"
                            aria-label="<?php echo esc_attr('مقایسه قبل و بعد: ' . $title); ?>"
                            class="veneer-compare <?php echo esc_attr($sarv_rtl_class); ?>">

                            <img class="veneer-img"
                                 src="<?php echo esc_url($case['after']); ?>"
                                 alt="<?php echo esc_attr('پس از لمینت — ' . $title); ?>"
                                 width="1000" height="1000"
                                 sizes="(min-width: 1024px) 33vw, (min-width: 768px) 56vw, 100vw"
                                 loading="lazy" decoding="async" draggable="false">

                            <div class="veneer-before">
                                <img class="veneer-img"
                                     src="<?php echo esc_url($case['before']); ?>"
                                     alt="<?php echo esc_attr('پیش از لمینت — ' . $title); ?>"
                                     width="1000" height="1000"
                                     sizes="(min-width: 1024px) 33vw, (min-width: 768px) 56vw, 100vw"
                                     loading="lazy" decoding="async" draggable="false">
                            </div>

                            <!-- Labels live in the corners of their own side and are never clipped -->
                            <span class="veneer-tag veneer-tag--before">قبل</span>
                            <span class="veneer-tag veneer-tag--after">بعد</span>

                            <div class="veneer-handle"
                                 data-handle
                                 role="slider"
                                 tabindex="0"
                                 aria-orientation="horizontal"
                                 aria-valuemin="0" aria-valuemax="100" aria-valuenow="50"
                                 aria-label="<?php echo esc_attr('دستگیره مقایسه قبل و بعد: ' . $title); ?>">
                                <span class="veneer-grip" aria-hidden="true">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Caption: supports the photographs, never competes with them -->
                    <div class="pt-5 md:max-lg:pt-0 md:max-lg:flex-1 text-start">
                        <h3 class="text-h4 font-bold font-peyda text-deep-emerald leading-snug">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <?php if (!empty($case['description'])) : ?>
                            <p class="mt-2 text-body font-peyda text-charcoal/70 leading-relaxed max-w-prose">
                                <?php echo esc_html($case['description']); ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($case['meta'])) : ?>
                            <dl class="mt-4 pt-4 border-t border-soft-stone flex flex-wrap gap-x-8 gap-y-3">
                                <?php foreach ($case['meta'] as $row) : ?>
                                    <div>
                                        <dt class="text-caption font-peyda text-charcoal/60"><?php echo esc_html($row['label']); ?></dt>
                                        <dd class="text-body font-peyda font-bold text-deep-emerald"><?php echo esc_html($row['value']); ?></dd>
                                    </div>
                                <?php endforeach; ?>
                            </dl>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    (function () {
        var frames = document.querySelectorAll('#veneer-showcase [data-compare]');
        if (!frames.length) return;
        var reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
        var nf = new Intl.NumberFormat('fa-IR');

        Array.prototype.forEach.call(frames, function (frame, idx) {
            var handle = frame.querySelector('[data-handle]');
            var rtl = frame.classList.contains('veneer-compare--rtl'); // RTL: "before" sits on the right
            var x = 50;            // handle position, % from the physical left edge
            var raf = 0, nudgeRaf = 0, dragging = false, offset = 0, touched = false;

            function render() {
                raf = 0;
                frame.style.setProperty('--x', x.toFixed(2));
                var before = Math.round(rtl ? 100 - x : x);
                handle.setAttribute('aria-valuenow', before);
                handle.setAttribute('aria-valuetext', 'قبل ' + nf.format(before) + '٪ — بعد ' + nf.format(100 - before) + '٪');
            }
            function set(v) {
                x = Math.min(100, Math.max(0, v));
                if (!raf) raf = requestAnimationFrame(render); // one style write per frame
            }
            function xFromEvent(e) {
                var r = frame.getBoundingClientRect();
                return ((e.clientX - r.left) / r.width) * 100;
            }
            function interacted() {
                touched = true;
                if (nudgeRaf) { cancelAnimationFrame(nudgeRaf); nudgeRaf = 0; }
            }

            // Pointer: mouse can grab anywhere (click jumps). Touch/pen only grab the handle,
            // so scrolling the page with a finger over a photo never moves the slider.
            frame.addEventListener('pointerdown', function (e) {
                if (e.pointerType === 'mouse' && e.button !== 0) return;
                var onHandle = !!e.target.closest('[data-handle]');
                if (e.pointerType !== 'mouse' && !onHandle) return;
                interacted();
                dragging = true;
                offset = onHandle ? xFromEvent(e) - x : 0; // no jump when grabbing the handle off-centre
                frame.setPointerCapture(e.pointerId);
                frame.classList.add('is-dragging');
                if (!onHandle) set(xFromEvent(e));
            });
            frame.addEventListener('pointermove', function (e) {
                if (dragging) set(xFromEvent(e) - offset);
            });
            function end(e) {
                if (!dragging) return;
                dragging = false;
                frame.classList.remove('is-dragging');
                try { frame.releasePointerCapture(e.pointerId); } catch (err) {}
            }
            frame.addEventListener('pointerup', end);
            frame.addEventListener('pointercancel', end);
            frame.addEventListener('dragstart', function (e) { e.preventDefault(); });

            // Keyboard (arrow keys follow screen direction; value = share of "before" shown)
            handle.addEventListener('keydown', function (e) {
                var step = e.shiftKey ? 10 : 2, next = null;
                switch (e.key) {
                    case 'ArrowLeft':  next = x - step; break;
                    case 'ArrowRight': next = x + step; break;
                    case 'ArrowUp':    next = x + (rtl ? -step : step); break;
                    case 'ArrowDown':  next = x - (rtl ? -step : step); break;
                    case 'PageUp':     next = x + (rtl ? -10 : 10); break;
                    case 'PageDown':   next = x - (rtl ? -10 : 10); break;
                    case 'Home':       next = rtl ? 100 : 0; break;
                    case 'End':        next = rtl ? 0 : 100; break;
                }
                if (next === null) return;
                e.preventDefault();
                interacted();
                set(next);
            });

            // One gentle nudge when a case first scrolls into view: shows it's interactive.
            function nudge() {
                if (touched) return;
                var t0 = performance.now(), dur = 1400;
                (function tick(now) {
                    var t = Math.min(1, (now - t0) / dur);
                    set(50 + 12 * Math.sin(t * Math.PI * 2));
                    nudgeRaf = t < 1 ? requestAnimationFrame(tick) : 0;
                })(t0);
            }
            if (!reduce && 'IntersectionObserver' in window) {
                var io = new IntersectionObserver(function (entries) {
                    if (!entries[0].isIntersecting) return;
                    io.disconnect();
                    setTimeout(nudge, 500 + idx * 250);
                }, { threshold: 0.7 });
                io.observe(frame);
            }

            render();
        });
    })();
    </script>
</section>