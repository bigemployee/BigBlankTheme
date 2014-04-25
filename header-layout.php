<?php
/**
 * Adding layout class to our main content
 * Always call get_footer('layout'); to close tags opened here.
 */
$layout = bigblank_get_layout();
if (is_home() || is_archive()) {
    $schema = schema('', 'Blog');
}
?>
<div id="content" class="site-content <?php echo $layout ?>  <?php $schema ?>">
    <div id="main" role="main">
