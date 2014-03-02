<?php
/**
 * Adding layout class to our main content
 * Always call get_footer('layout'); to close tags opened here.
 * @todo create a function to overwrite comments open
 * @todo create a function to get the layout
 * @link https://codex.wordpress.org/Function_Reference/comments_open#Examples
 */
$layout = get_post_meta(get_the_ID(), 'bigblank_post_layout', true);
$options = bigblank_get_theme_options();
if (!$layout) {
    $layout = $options['theme_layout'];
}
if(is_page()){
    $comments = $options['page_comments'];
}
if(is_single()){
    $comments = $options['post_comments'];
}
?>
<div id="content" class="site-content <?php echo $layout; ?>">
    <div id="main" role="main">
