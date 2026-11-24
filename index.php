<?php

/**
 * The front page template file
 *
 * @package Sarv
 */

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php
/**
 * Hero section — text + dedicated video showcase.
 *
 * The video is CONTENT: it lives in its own framed player, nothing is ever drawn on top of it.
 * Replace the placeholders below (or set the matching theme mods).
 *
 * Video: H.264 MP4, ~1280px wide for the desktop file; make it the same aspect ratio as $sarv_hero_ratio.
 */

$phone      = get_theme_mod('sarv_phone_number', '۰۲۱-۱۲۳۴۵۶۷۸');
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);

$sarv_hero_video        = get_theme_mod('sarv_hero_video', get_template_directory_uri() . '/src/video/hero-video.mp4');
$sarv_hero_video_mobile = get_theme_mod('sarv_hero_video_mobile', '');   // optional lighter file (~720px) for phones
$sarv_hero_poster       = get_theme_mod('sarv_hero_poster', get_template_directory_uri() . '/src/images/hero-poster.jpg');
$sarv_hero_captions     = get_theme_mod('sarv_hero_captions', '');       // optional .vtt subtitle file
$sarv_hero_ratio        = preg_replace('/[^0-9.\s\/]/', '', get_theme_mod('sarv_hero_ratio', '16 / 9')); // e.g. "16 / 9", "4 / 3"
$sarv_hero_has_audio    = (bool) get_theme_mod('sarv_hero_has_audio', true); // false → hides the mute button
$sarv_hero_video_label  = 'ویدیو معرفی کلینیک سرو';

// Same theme_mod keys and defaults as before.
$sarv_hero_stats = [
    1 => [
        'number'  => '+280',
        'label'   => 'پزشک فعال',
        'viewBox' => '0 0 24 24',
        'solid'   => false,
        'path'    => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
    ],
    2 => [
        'number'  => '99%',
        'label'   => 'رضایت کاربران',
        'viewBox' => '0 0 20 20',
        'solid'   => true,
        'path'    => 'M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z',
    ],
    3 => [
        'number'  => '+100K',
        'label'   => 'نوبت رزرو شده',
        'viewBox' => '0 0 24 24',
        'solid'   => false,
        'path'    => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
    ],
];
?>

<section
    data-hero
    aria-labelledby="hero-title"
    class="relative isolate bg-deep-emerald text-warm-ivory pt-16 pb-48 lg:pt-22 lg:pb-56 rounded-t-[2.5rem] mx-4 md:mx-8 mt-4 overflow-hidden shadow-2xl z-10">

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Phones/tablets: text → video → stats. Desktop: text (5) | video (7), stats below. -->
        <div class="grid grid-cols-1 lg:grid-cols-12 items-center gap-y-12 lg:gap-x-12 xl:gap-x-16">

            <!-- ============ Text ============ -->
            <div class="lg:col-span-5 text-start max-w-2xl lg:max-w-none">

                <h1 id="hero-title" class="text-4xl sm:text-5xl lg:text-h1 xl:text-hero font-black font-peyda leading-[1.3] tracking-normal mb-6">
                    <span class="hero-mask"><span class="hero-mask__inner" style="--d:150ms">با <span class="text-champagne-gold">سرو</span></span></span>
                    <span class="hero-mask"><span class="hero-mask__inner" style="--d:280ms">لبخندت رو زیبا کن</span></span>
                </h1>

                <p class="hero-fade text-body-range text-warm-ivory/80 font-peyda leading-relaxed mb-10 max-w-xl" style="--d:500ms">
                    در کلینیک سرو، ما لبخند شما را می‌سازیم! سال‌هاست چهره‌های شناخته‌شده، از فوتبالیست‌ها تا بازیگران، به ما اعتماد دارند. شما هم همین امروز وقت رزرو کنید و تجربه‌ای متفاوت داشته باشید.
                </p>

                <div class="hero-fade flex flex-col sm:flex-row items-stretch sm:items-center gap-4" style="--d:650ms">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary group w-full sm:w-auto">
                        <svg class="w-5 h-5 me-2 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        دریافت مشاوره
                    </a>
                    <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn btn-outline w-full sm:w-auto">
                        درباره ما
                    </a>
                </div>
            </div>

            <!-- ============ Video showcase ============ -->
            <div class="hero-frame-in lg:col-span-7 relative" style="--d:350ms">

                <!-- Soft light behind the frame so the dark bezel separates from the dark section. Never over the video. -->
                <div class="hero-glow absolute -inset-8 sm:-inset-12 pointer-events-none" aria-hidden="true"></div>

                <figure
                    data-player
                    data-state="idle"
                    data-muted="true"
                    data-audio="<?php echo $sarv_hero_has_audio ? 'true' : 'false'; ?>"
                    role="group"
                    aria-label="<?php echo esc_attr($sarv_hero_video_label); ?>"
                    class="hero-player group relative m-0 p-3 rounded-brand-lg bg-forest-noir border border-warm-ivory/15 shadow-2xl">

                    <!-- Stage: only the video (and, before first play, a play button on the poster). Radius = outer 24px − 12px padding. -->
                    <div class="hero-stage relative overflow-hidden rounded-brand bg-forest-noir" style="aspect-ratio: <?php echo esc_attr($sarv_hero_ratio); ?>;">
                        <!-- `controls` is the no-JS fallback; the script removes it and enables the custom dock. -->
                        <video
                            data-video
                            class="absolute inset-0 w-full h-full object-contain"
                            src="<?php echo esc_url($sarv_hero_video); ?>"
                            <?php if ($sarv_hero_video_mobile) : ?>data-src-mobile="<?php echo esc_url($sarv_hero_video_mobile); ?>"<?php endif; ?>
                            poster="<?php echo esc_url($sarv_hero_poster); ?>"
                            muted loop playsinline controls
                            preload="none"
                            disablepictureinpicture
                            aria-label="<?php echo esc_attr($sarv_hero_video_label); ?>">
                            <?php if ($sarv_hero_captions) : ?>
                                <track kind="captions" src="<?php echo esc_url($sarv_hero_captions); ?>" srclang="fa" label="فارسی" default>
                            <?php endif; ?>
                        </video>

                        <!-- Only visible while the video has not started (autoplay off / blocked) -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <button type="button" hidden data-overlay
                                class="btn btn-primary opacity-0 invisible group-data-[state=idle]:opacity-100 group-data-[state=idle]:visible group-data-[state=idle]:pointer-events-auto transition-[opacity,visibility] duration-300">
                                <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z" /></svg>
                                پخش ویدیو
                            </button>
                        </div>
                    </div>

                    <!-- Dock: below the video, not on it. Kept LTR like every media player. -->
                    <div data-dock hidden dir="ltr" class="flex items-center gap-1 sm:gap-2 pt-3">
                        <button type="button" data-play class="hero-ctrl" aria-label="پخش / توقف">
                            <svg class="w-5 h-5 group-data-[state=playing]:hidden" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z" /></svg>
                            <svg class="w-5 h-5 hidden group-data-[state=playing]:block" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 5h4v14H6zM14 5h4v14h-4z" /></svg>
                        </button>

                        <span data-time class="hidden sm:block shrink-0 min-w-[5.5rem] text-caption font-satoshi font-medium tabular-nums text-warm-ivory/80">0:00 / 0:00</span>

                        <input type="range" data-seek class="hero-seek flex-1 min-w-0" min="0" max="1000" step="10" value="0" aria-label="نوار پیشرفت ویدیو">

                        <?php if ($sarv_hero_has_audio) : ?>
                            <button type="button" data-mute class="hero-ctrl" aria-label="قطع / وصل صدا">
                                <svg class="w-5 h-5 group-data-[muted=true]:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
                                <svg class="w-5 h-5 hidden group-data-[muted=true]:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15zM17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path></svg>
                            </button>
                        <?php endif; ?>

                        <button type="button" data-fs class="hero-ctrl" aria-label="تمام‌صفحه">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                        </button>
                    </div>
                </figure>
            </div>

            <!-- ============ Stats ============ -->
            <ul role="list" class="lg:col-span-12 grid md:grid-cols-4 grid-cols-2 sm:gap-0 gap-4 lg:mt-8 pt-8 border-t border-warm-ivory/15">
                <?php foreach ($sarv_hero_stats as $i => $stat) : ?>
                    <li class="hero-fade flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-4 border-s border-warm-ivory/15 ps-3 sm:ps-8"
                        style="--d:<?php echo 800 + ($i * 100); ?>ms">
                        <span class="hidden sm:flex w-11 h-11 rounded-full border border-champagne-gold/40 text-champagne-gold items-center justify-center shrink-0" aria-hidden="true">
                            <svg class="w-5 h-5" viewBox="<?php echo esc_attr($stat['viewBox']); ?>"
                                 fill="<?php echo $stat['solid'] ? 'currentColor' : 'none'; ?>"
                                 stroke="<?php echo $stat['solid'] ? 'none' : 'currentColor'; ?>">
                                <path <?php if (!$stat['solid']) : ?>stroke-linecap="round" stroke-linejoin="round" stroke-width="2"<?php endif; ?> d="<?php echo esc_attr($stat['path']); ?>"></path>
                            </svg>
                        </span>
                        <span class="flex flex-col">
                            <span class="text-h4 sm:text-h3 font-bold text-warm-ivory font-satoshi leading-none mb-1.5" dir="ltr">
                                <?php echo esc_html(get_theme_mod("sarv_stat_{$i}_number", $stat['number'])); ?>
                            </span>
                            <span class="text-caption text-warm-ivory/75 font-peyda">
                                <?php echo esc_html(get_theme_mod("sarv_stat_{$i}_label", $stat['label'])); ?>
                            </span>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>

    <script>
    (function () {
        var hero   = document.currentScript.closest('[data-hero]');
        var player = hero && hero.querySelector('[data-player]');
        var video  = player && player.querySelector('[data-video]');
        if (!video) return; // without JS the native controls stay available

        function q(s) { return player.querySelector(s); }
        var dock = q('[data-dock]'), overlay = q('[data-overlay]'), seek = q('[data-seek]'),
            timeEl = q('[data-time]'), btnPlay = q('[data-play]'), btnMute = q('[data-mute]'), btnFs = q('[data-fs]');
        var hasAudio = player.dataset.audio === 'true';

        // Autoplay (muted) unless the visitor asked for less motion / less data.
        var conn = navigator.connection || {};
        var auto = !(matchMedia('(prefers-reduced-motion: reduce)').matches ||
                     conn.saveData === true || /(^|-)2g$/.test(conn.effectiveType || ''));
        var started = false, userPaused = false;

        // Switch to the custom UI.
        video.removeAttribute('controls');
        dock.hidden = false;
        overlay.hidden = false;
        if (matchMedia('(max-width: 767px)').matches && video.dataset.srcMobile) video.src = video.dataset.srcMobile;

        function state(s) { player.dataset.state = s; }
        function fmt(t) { t = Math.max(0, Math.floor(t || 0)); return Math.floor(t / 60) + ':' + ('0' + (t % 60)).slice(-2); }
        function sync() {
            var d = isFinite(video.duration) ? video.duration : 0;
            var p = d ? video.currentTime / d : 0;
            var txt = fmt(video.currentTime) + ' / ' + fmt(d);
            seek.value = Math.round(p * 1000);
            seek.style.setProperty('--p', (p * 100) + '%');
            seek.setAttribute('aria-valuetext', txt);
            if (timeEl) timeEl.textContent = txt;
        }
        function tryPlay() {
            var p = video.play();
            if (p && p.catch) p.catch(function (e) {
                if (e && e.name === 'AbortError') return;
                if (!started) state('idle'); // autoplay blocked → show the play button
            });
        }
        function toggle() {
            if (video.paused) {
                userPaused = false;
                if (!started && hasAudio) video.muted = false; // a deliberate first click starts with sound
                tryPlay();
            } else {
                userPaused = true;
                video.pause();
            }
        }

        video.addEventListener('timeupdate', sync);
        video.addEventListener('loadedmetadata', sync);
        video.addEventListener('playing', function () { started = true; state('playing'); });
        video.addEventListener('pause', function () { state(started ? 'paused' : 'idle'); });
        video.addEventListener('volumechange', function () { player.dataset.muted = String(video.muted); });
        video.addEventListener('error', function () { state('error'); dock.hidden = true; }); // poster stays as fallback

        video.addEventListener('click', toggle);
        overlay.addEventListener('click', toggle);
        btnPlay.addEventListener('click', toggle);
        if (btnMute) btnMute.addEventListener('click', function () { video.muted = !video.muted; });
        seek.addEventListener('input', function () {
            if (isFinite(video.duration)) { video.currentTime = (seek.value / 1000) * video.duration; sync(); }
        });

        var fsReq = player.requestFullscreen || player.webkitRequestFullscreen;
        if (!fsReq && !video.webkitEnterFullscreen) btnFs.hidden = true;
        btnFs.addEventListener('click', function () {
            if (document.fullscreenElement || document.webkitFullscreenElement) {
                (document.exitFullscreen || document.webkitExitFullscreen).call(document);
            } else if (fsReq) {
                fsReq.call(player);
            } else {
                video.webkitEnterFullscreen(); // iOS Safari
            }
        });

        state(auto ? 'pending' : 'idle');
        sync();

        if (!auto) return;
        video.muted = true;
        if ('IntersectionObserver' in window) {
            // Start when (nearly) visible, pause when scrolled away — saves data and battery, esp. on phones.
            new IntersectionObserver(function (entries) {
                if (userPaused) return;
                if (entries[0].isIntersecting) tryPlay(); else if (!video.paused) video.pause();
            }, { rootMargin: '200px 0px', threshold: 0.25 }).observe(player);
        } else {
            tryPlay();
        }
    })();
    </script>
</section>

<?php
// فراخوانی کامپوننت نوار شناور پایینی
get_template_part('template-parts/hero/features');
?>

<!-- فراخوانی بخش نمونه‌کار لمینت -->
<?php
get_template_part('template-parts/sections/veneer-showcase');
?>

<!-- فراخوانی بخش محاسبه قیمت -->
<?php
get_template_part('template-parts/cost-estimator');
?>

<!-- فراخوانی بخش درباره ما -->
<?php
get_template_part('template-parts/sections/about-section');
?>

<!-- فراخوانی بخش گارانتی و پالیش -->
<?php
get_template_part('template-parts/sections/guarantee-section');
?>

<!-- @TODO: fix that section -->
<!-- فراخوانی بخش مجله آموزشی -->
<?php
// get_template_part('template-parts/sections/blog-magazine');
?>

<?php
get_footer();
