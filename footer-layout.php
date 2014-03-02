<?php
/**
 * Closing our content scaffold and checking to see if we should include sidebar
 * Always call get_header('layout'); to open tags closed here.
 * 
 */
?>
    </div><!-- #main -->
    <?php if (bigblank_has_sidebar()): ?>
        <?php get_sidebar(); ?>
    <?php endif; ?>
</div><!-- #content -->