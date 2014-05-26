<?php
/**
 * Closing our content scaffold and checking to see if we should include sidebar
 * Always call get_header('layout'); to open tags closed here.
 * 
 */
?>
    <?php if (is_active_sidebar('call2action') && 
            (is_single() || is_page()) &&
            !is_page('contact') &&
            !is_page('team') &&
            !is_singular('team') &&
            !is_page('about')) : ?>
        <?php dynamic_sidebar('call2action'); ?>
    <?php endif; ?>
    </div><!-- #main -->
    <?php if (bigblank_has_sidebar()): ?>
        <?php get_sidebar(); ?>
    <?php endif; ?>
</div><!-- #content -->