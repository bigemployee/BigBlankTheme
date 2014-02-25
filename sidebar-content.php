<?php
/**
 * The Content Sidebar
 *
 */
if (!is_active_sidebar('sidebar')) {
    return;
}
?>
<div id="content-sidebar" class="content-sidebar widget-area" role="complementary">
    <?php dynamic_sidebar('sidebar'); ?>
</div><!-- #content-sidebar -->
