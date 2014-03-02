<?php
/**
 * Adding layout class to our main content
 * Always call get_footer('layout'); to close tags opened here.
 * @todo create a function to overwrite comments open
 * @link https://codex.wordpress.org/Function_Reference/comments_open#Examples
 */
$layout = bigblank_get_layout();
?>
<div id="content" class="site-content <?php echo $layout; ?>">
    <div id="main" role="main">
