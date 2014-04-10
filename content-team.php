<?php
/**
 * The template used for displaying registered custom post type
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    // Page thumbnail and title.
    bigblank_post_thumbnail();
    the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
    ?>
    <div class="entry-content">
        <?php
        the_content();
        edit_post_link(__('Edit', 'bigblank'));
        // wp_reset_query() does not integrate well with pagination, 
        // so we assign $wp_query to a variable and we will reassing it back
        wp_reset_query();
        $orig_query = $wp_query;
        $wp_query = new WP_Query(array(
            'post_type' => 'team',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'paged'=>$paged
        ));
        ?>
        <?php if ($wp_query->have_posts()) : ?>
            <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                <div class="team-member">
                    <?php $slug = sanitize_title_with_dashes(get_the_title()); ?>
                    <?php $title = get_post_meta(get_the_ID(), 'title', true); ?>
                    <?php $facebook = get_post_meta(get_the_ID(), 'facebook', true); ?>
                    <h2 id="<?php echo $slug; ?>"><a class="anchor" href="#<?php echo $slug; ?>"><i class="fa fa-link"></i></a><?php the_title(); ?> <?php bigblank_print($title, '<em>(',')</em>'); ?></h2>
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('medium', 'class=alignright portrait'); ?>
                    <?php endif ?>
                    <?php
                    global $more;
                    $more = 0;
                    ?>
                    <?php the_content('Get to know ' . get_the_title()); ?>
                </div>
                <?php edit_post_link(__('Edit', 'bigblank')); ?>
            <?php endwhile; ?>
            <?php
            // Previous/next post navigation.
            bigblank_paging_nav();
            ?>
        <?php endif; ?>
        <?php $wp_query = $orig_query; ?>
        <?php wp_reset_query(); ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->