<?php

/**
 * The footer for our theme
 *
 * @package Sarv
 */

// جلوگیری از دسترسی مستقیم
if (! defined('ABSPATH')) {
    exit;
}
?>
</main><!-- #primary -->

<footer id="colophon" class="site-footer">
    <!-- محتوای فوتر در مرحله بعدی UI پیاده‌سازی می‌شود -->
    <div class="site-info">
        <p>
            &copy; <?php echo esc_html(date('Y')); ?>
            <?php bloginfo('name'); ?>
            - <?php esc_html_e('تمامی حقوق محفوظ است.', 'sarv'); ?>
        </p>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>