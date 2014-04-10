<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php bigblank_post_thumbnail(); ?>
    <header class="entry-header">
        <?php
        if (is_single()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h1 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h1>');
        endif;
        ?>
        <div class="entry-meta">
            <?php
            if ('post' == get_post_type())
                bigblank_posted_on();
            if (!post_password_required() && (comments_open() || get_comments_number())) :
                ?>
                <?php comments_popup_link(__('Leave a comment', 'bigblank'), __('1 Comment', 'bigblank'), __('% Comments', 'bigblank'), "entry-comments"); ?>
                <?php
            endif;
            edit_post_link(__('Edit', 'bigblank'));
            ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <?php if (is_search()) : ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    <?php else : ?>
        <div class="entry-content">
            <?php
            the_content(sprintf(__('Continue Reading %s <span class="meta-nav">&rarr;</span>', 'bigblank'), get_the_title()));
            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'bigblank') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
            ));
            ?>
        </div><!-- .entry-content -->
    <?php endif; ?>
    <footer class="entry-meta">
        <?php if (in_array('category', get_object_taxonomies(get_post_type())) && bigblank_categorized_blog()) : ?>
            <span class="entry-categories"><?php echo get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'bigblank')); ?></span>
            <?php
        endif;
        the_tags('<span class="entry-tags">', _x(', ', 'Used between list items, there is a space after the comma.', 'bigblank'), '</span>');
        ?>
        <?php
        if (is_sticky() && is_home() && !is_paged()) {
            echo '<span class="featured-post">' . __('Sticky', 'bigblank') . '</span>';
        }
        ?>
        <?php if (is_singular() && get_the_author_meta('description') && is_multi_author() && get_post_type() == "post") : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
            <div class="author-info">
                <div class="author-avatar">
                    <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('gravatar', 128)); ?>
                </div><!-- .author-avatar -->
                <div class="author-description">
                    <h2><?php printf(__('About %s', 'betheme'), get_the_author()); ?></h2>
                    <p><?php the_author_meta('description'); ?></p>
                    <div class="author-link">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
                            <?php printf(__('View all posts by %s <span class="meta-nav">&rarr;</span>', 'betheme'), get_the_author()); ?>
                        </a>
                    </div><!-- .author-link	-->
                </div><!-- .author-description -->
            </div><!-- .author-info -->
        <?php endif; ?>            
    </footer>
</article><!-- #post-## -->
