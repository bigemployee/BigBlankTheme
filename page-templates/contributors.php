<?php
/**
 * Template Name: Contributor Page
 *
 */
get_header();
get_header('layout');
?>
<?php
// Start the Loop.
while (have_posts()) : the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
        // Output the authors list.
        bigblank_list_authors();
        edit_post_link(__('Edit', 'bigblank'), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>');
        ?>
    </article><!-- #post-## -->
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ((comments_open() || get_comments_number()) && $comments == 'on') {
        comments_template();
    }
endwhile;
?>
<?php
get_footer('layout');
get_footer();
