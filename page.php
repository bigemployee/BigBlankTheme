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
get_header('layout');
?>
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
<?php
get_footer('layout');
get_footer();
