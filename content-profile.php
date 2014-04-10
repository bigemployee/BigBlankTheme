<?php
/**
 * The template used for displaying registered custom post type
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('profile'); ?>>
    <header class="entry-header">
        <?php if (has_post_thumbnail()): ?>
            <div id="featured-header">
                <?php the_post_thumbnail('post-thumbnail', 'itemprop=image'); ?>
            </div>
        <?php endif; ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php $title = get_post_meta(get_the_ID(), 'title', true); ?>
        <?php $facebook = get_post_meta(get_the_ID(), 'facebook', true); ?>
        <?php $twitter = get_post_meta(get_the_ID(), 'twitter', true); ?>
        <?php $google_plus = get_post_meta(get_the_ID(), 'google+', true); ?>
        <?php $instagram = get_post_meta(get_the_ID(), 'instagram', true); ?>
        <?php $youtube = get_post_meta(get_the_ID(), 'youtube', true); ?>
        <?php $pinterest = get_post_meta(get_the_ID(), 'pinterest', true); ?>
        <?php bigblank_print($title, '<h2><em>(', ')</em></h2>'); ?>
        <?php bigblank_print($facebook, '<a href="', '"><i class="fa fa-facebook-square"></i></a>'); ?>
        <?php bigblank_print($twitter, '<a href="', '"><i class="fa fa-twitter-square"></i></a>'); ?>
        <?php bigblank_print($google_plus, '<a href="', '"><i class="fa fa-google-plus-square"></i></a>'); ?>
        <?php bigblank_print($instagram, '<a href="', '"><i class="fa fa-instagram"></i></a>'); ?>
        <?php bigblank_print($youtube, '<a href="', '"><i class="fa fa-youtube-play"></i></a>'); ?>
        <?php bigblank_print($pinterest, '<a href="', '"><i class="fa fa-pinterest"></i></a>'); ?>
    </header>
    <section class="entry-content">
        <?php the_content(); ?>
        <?php edit_post_link(__('Edit', 'bigblank')); ?>
    </section>
</article>