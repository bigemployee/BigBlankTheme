<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 */
get_header();
$layout = get_post_meta(get_the_ID(), 'bigblank_post_layout', true);
$options = bigblank_get_theme_options();
if (!$layout) {
    $layout = $options['theme_layout'];
}
$comments = $options['page_comments'];
?>
<div id="content" class="site-content <?php echo $layout; ?>">
    <div id="main" role="main">
            <?php
            // Start the Loop.
            while (have_posts()) : the_post();
                // Include the page content template.
                get_template_part('content', 'page');
                // If comments are open or we have at least one comment, load up the comment template.
                if ((comments_open() || get_comments_number()) && $comments == 'on') {
                    comments_template();
                }
            endwhile;
            ?>
        </div><!-- #main -->
    <?php if ($layout == 'content-sidebar' || $layout == 'sidebar-content'): ?>
        <?php get_sidebar(); ?>
    <?php endif; ?>
</div><!-- #content -->
<?php
get_footer();
