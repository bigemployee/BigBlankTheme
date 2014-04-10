<?php
/**
 * Template Name: Team
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();
get_header('layout');
?>
<?php 
if (have_posts()) :
    // Start the Loop.
    while (have_posts()) : the_post();
        /*
         * Include the post format-specific template for the content. If you want to
         * use this in a child theme, then include a file called called content-___.php
         * (where ___ is the post format) and that will be used instead.
         */
        get_template_part('content', 'team');
    endwhile;
    // Previous/next post navigation.
    bigblank_paging_nav();
else :
    // If no content, include the "No posts found" template.
    get_template_part('content', 'none');
endif;
?>
<?php
get_footer('layout');
get_footer();
