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
$phone = $options['phone'];
$address = $options['address'];
$footer_copyright = $options['footer_copyright'];
$footer_text = $options['footer_text'];
?>
<footer id="footer" class="site-footer" role="contentinfo">
    <?php get_sidebar('footer'); ?>
    <?php bigblank_footer_menu(); ?>
    <?php
    // Social media links (social-links.php)
    get_template_part('social', 'links');
    ?>
    <div id="site-info">
        <?php if ($phone) : ?>
            <a href="/contact/" id="footer-tel" class="tel"><i class="fa fa-phone"></i><?php echo $phone; ?></a>
        <?php endif; ?>
        <?php if ($address) : ?>
            <a href="http://maps.google.com/maps?daddr=<?php echo urlencode($address); ?>&amp;saddr=" id="footer-address" class="address"><i class="fa fa-map-marker"></i><?php echo $address; ?></a>
        <?php endif; ?>
        <?php if ($footer_copyright) : ?>
            <span id="copyright"><?php echo $footer_copyright; ?></span>
        <?php endif; ?>
        <?php if ($footer_text) : ?>
            <span id="footer-text"><?php echo $footer_text; ?></span>
        <?php endif; ?>
        <div id="bigemployee"><?php _e('theme by', 'bigblank'); ?> <a href="<?php echo esc_url(__('http://bigemployee.com/', 'bigblank')); ?>"><?php printf(__('%s', 'bigblank'), 'Big Employee'); ?></a></div>
    </div><!-- #site-info -->
</footer><!-- #footer -->
<?php wp_footer(); ?>
<!-- @attribution: Based on Big Blank Theme for WordPress by BigEmployee.com -->
</body>
</html>