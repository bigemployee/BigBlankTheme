<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 */
?>
<?php
$options = bigblank_get_theme_options();
$footer_copyright = $options['footer_copyright'];
$footer_text = $options['footer_text'];
?>
</div><!-- #main -->
<footer id="footer" class="site-footer" role="contentinfo">
    <?php get_sidebar('footer'); ?>
    <div id="site-info" class="site-info">
        <span id="copyright"><?php echo $footer_copyright; ?></span>
        <span id="footer-text"><?php echo $footer_text; ?></span>
        <a href="<?php echo esc_url(__('http://bigblanktheme.com/', 'bigblank')); ?>"><?php printf(__('BigBlank by %s', 'bigblank'), 'Big Employee'); ?></a>
    </div><!-- #site-info -->
</footer><!-- #footer -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>