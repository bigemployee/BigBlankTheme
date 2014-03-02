<?php

/**
 * The Template for displaying all single posts
 *
 */
get_header();
get_header('layout');
?>
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
    if (comments_open() || get_comments_number()) {
        comments_template();
    }
endwhile;
?>
<?php

get_footer('layout');
get_footer();
