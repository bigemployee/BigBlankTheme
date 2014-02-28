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
<footer id="footer" role="contentinfo">
    <?php get_sidebar('footer'); ?>
    <?php
    // Social media links (social-links.php)
    get_template_part('social', 'links');
    ?>
    <div id="site-info">
        <span id="copyright"><?php echo $footer_copyright; ?></span>
        <span id="footer-text"><?php echo $footer_text; ?></span>
        <div id="bigemployee"><?php _e('theme by', 'bigblank') ?> <a href="<?php echo esc_url(__('http://bigemployee.com/', 'bigblank')); ?>"><?php printf(__('%s', 'bigblank'), 'Big Employee'); ?></a></div>
    </div><!-- #site-info -->
</footer><!-- #footer -->
</div><!-- #page -->
<?php wp_footer(); ?>
<!-- @attribution: Based on Big Blank Theme for WordPress by BigEmployee.com -->
</body>
</html>