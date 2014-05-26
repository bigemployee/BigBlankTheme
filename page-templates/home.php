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
            <article id="content" <?php post_class(); ?> <?php schema(); ?>>
                <?php
                bigblank_post_thumbnail();
                ?>
                <div class="entry-content" <?php schema('mainContentOfPage'); ?>>
                    <?php the_content(); ?>
                    <?php edit_post_link(__('Edit', 'bigblank')); ?>
                </div><!-- .entry-content -->
            </article><!-- #content -->
        <?php endwhile; ?>
    <?php if (is_active_sidebar('call2action') && 
            (is_single() || is_page()) &&
            !is_page('contact') &&
            !is_page('team') &&
            !is_singular('team') &&
            !is_page('about')) : ?>
        <?php dynamic_sidebar('call2action'); ?>
    <?php endif; ?>
    </div><!-- #main -->
</div><!-- #home -->
<?php
get_footer();
