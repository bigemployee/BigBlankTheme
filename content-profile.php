<?php
/**
 * The template used for displaying registered custom post type
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('profile'); ?> <?php schema(false, 'Person'); ?>>
    <header class="entry-header">
        <?php if (has_post_thumbnail()): ?>
            <div id="featured-header">
                <?php the_post_thumbnail('post-thumbnail', 'property=schema:image'); ?>
            </div>
        <?php endif; ?>
        <?php the_title('<h1 class="entry-title" ' . schema('name', false, false) . '>', '</h1>'); ?>
        <?php $title = get_post_meta(get_the_ID(), 'title', true); ?>
        <?php $facebook = get_post_meta(get_the_ID(), 'facebook', true); ?>
        <?php $twitter = get_post_meta(get_the_ID(), 'twitter', true); ?>
        <?php $google_plus = get_post_meta(get_the_ID(), 'google+', true); ?>
        <?php $instagram = get_post_meta(get_the_ID(), 'instagram', true); ?>
        <?php $youtube = get_post_meta(get_the_ID(), 'youtube', true); ?>
        <?php $pinterest = get_post_meta(get_the_ID(), 'pinterest', true); ?>
        <?php bigblank_print($title, '<h2 ' . schema('jobTitle', false, false) . '><em>(', ')</em></h2>'); ?>
        <?php bigblank_print($facebook, '<a href="', '"><i class="fa fa-facebook-square"></i></a>'); ?>
        <?php bigblank_print($twitter, '<a href="', '"><i class="fa fa-twitter-square"></i></a>'); ?>
        <?php bigblank_print($google_plus, '<a href="', '"><i class="fa fa-google-plus-square"></i></a>'); ?>
        <?php bigblank_print($instagram, '<a href="', '"><i class="fa fa-instagram"></i></a>'); ?>
        <?php bigblank_print($youtube, '<a href="', '"><i class="fa fa-youtube-play"></i></a>'); ?>
        <?php bigblank_print($pinterest, '<a href="', '"><i class="fa fa-pinterest"></i></a>'); ?>
        <?php if (has_term('', 'department')) : ?>
            <span class="entry-meta entry-categories department">
                <?php echo get_the_term_list($post->ID, 'department', '', ', ', ''); ?>
            </span>
        <?php endif; ?>
    </header>
    <section class="entry-content" <?php schema('description'); ?>>
        <?php the_content(); ?>
        <?php edit_post_link(__('Edit', 'bigblank')); ?>
    </section>
</article>
