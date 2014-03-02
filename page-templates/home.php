<?php
/**
 * Template Name: Home
 *
 */
get_header();
?>
<div id="home" class="site-content">
    <div id="main" role="main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="home-content" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->
            </article><!-- #home -->
        <?php endwhile; ?>
    </div><!-- #main -->
</div><!-- #home -->
<?php
get_footer();
