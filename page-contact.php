<?php
/**
 * Contact Page Template
 *
 */
get_header();
get_header('layout');
?>
<?php

// Start the Loop.
while (have_posts()) : the_post();
?>
<article id="page-contact" <?php post_class(); ?> <?php schema(); ?>>
    <header class="entry-header">
    <?php
    echo do_shortcode('[bigContact map=on]');
    the_title('<h1 class="entry-title"> ' . schema('name') . '>', '</h1>');
    ?>
    </header><!-- .entry-header -->
    <div class="entry-content" <?php schema('mainContentOfPage'); ?>>
        <?php
        the_content();
        ?>
    </div><!-- .entry-content -->
    <footer class="entry-meta">
        <?php edit_post_link(__('Edit', 'bigblank')); ?>
    </footer><!-- .entry-meta -->
</article><!-- #page-contact -->
<?php
endwhile;
?>
<?php

get_footer('layout');
get_footer();
