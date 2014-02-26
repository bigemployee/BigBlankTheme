<?php
/**
 * The Sidebar containing the main widget area
 *
 */
?>
<?php if (is_active_sidebar('sidebar')) : ?>
    <div id="sidebar" role="complementary">
        <?php dynamic_sidebar('sidebar'); ?>
    </div><!-- #sidebar -->
<?php endif; ?>