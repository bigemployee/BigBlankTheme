<?php
/**
 * The template for displaying image attachments
 *
 */
// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();
get_header();
get_header('layout');
?>
<?php
// Start the Loop.
while (have_posts()) : the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            <div class="entry-meta">
                <time class="entry-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                <a href="<?php echo wp_get_attachment_url(); ?>" class="full-size-link"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a>
                <a href="<?php echo get_permalink($post->post_parent); ?>" class="parent-post-link" rel="gallery"><?php echo get_the_title($post->post_parent); ?></a>
                <?php edit_post_link(__('Edit', 'bigblank')); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
        <div class="entry-content">
            <div class="entry-attachment">
                <div class="attachment">
                    <?php bigblank_the_attached_image(); ?>
                </div><!-- .attachment -->
                <?php if (has_excerpt()) : ?>
                    <div class="entry-caption">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-caption -->
                <?php endif; ?>
            </div><!-- .entry-attachment -->
            <?php
            the_content();
            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'bigblank') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
            ));
            ?>
        </div><!-- .entry-content -->
    </article><!-- #post-## -->
    <nav id="image-navigation" class="navigation image-navigation">
        <div class="nav-links">
            <?php previous_image_link(false, '<div class="previous-image">' . __('Previous Image', 'bigblank') . '</div>'); ?>
            <?php next_image_link(false, '<div class="next-image">' . __('Next Image', 'bigblank') . '</div>'); ?>
        </div><!-- .nav-links -->
    </nav><!-- #image-navigation -->
    <?php comments_template(); ?>
<?php endwhile; // end of the loop. ?>
<?php
get_footer('layout');
get_footer();
