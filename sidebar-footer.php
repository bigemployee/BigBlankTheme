<?php
/**
 * The Footer Sidebar
 *
 */
?>
<?php if (is_active_sidebar('footer')) : ?>
    <div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar('footer'); ?>
    </div><!-- #footer-sidebar -->
<?php endif; ?>