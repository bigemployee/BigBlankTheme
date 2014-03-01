<?php
/**
 * The Template for displaying all single posts
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
            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part('content', get_post_format());
            // Previous/next post navigation.
            bigblank_post_nav();
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
