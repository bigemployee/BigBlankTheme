<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */
get_header();
get_header('layout');
?>
<header class="page-header">
    <h1 class="page-title"><?php _e('Not Found', 'bigblank'); ?></h1>
</header>
<div class="page-content">
    <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'bigblank'); ?></p>
    <?php get_search_form(); ?>
</div><!-- .page-content -->
<?php
get_footer('layout');
get_footer();
