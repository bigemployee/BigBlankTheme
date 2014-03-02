<?php
/**
 * The template for displaying Search Results pages
 *
 */
get_header();
get_header('layout');
?>
<?php if (have_posts()) : ?>
    <header class="page-header">
        <h1 class="page-title"><?php printf(__('Search Results for: %s', 'bigblank'), get_search_query()); ?></h1>
    </header><!-- .page-header -->
    <?php
    // Start the Loop.
    while (have_posts()) : the_post();
        /*
         * Include the post format-specific template for the content. If you want to
         * use this in a child theme, then include a file called called content-___.php
         * (where ___ is the post format) and that will be used instead.
         */
        get_template_part('content', get_post_format());
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
