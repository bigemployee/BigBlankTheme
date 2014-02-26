<?php
/**
 * The Content Sidebar
 *
 */
?>
<?php if (is_active_sidebar('sidebar')) : ?>
    <div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar('sidebar'); ?>
    </div><!-- #content-sidebar -->
<?php endif; ?>