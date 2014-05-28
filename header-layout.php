<?php
/**
 * Adding layout class to our main content
 * Always call get_footer('layout'); to close tags opened here.
 */
$layout = bigblank_get_layout();
if (is_home() || is_archive()) {
    $schema = schema(false, 'Blog', false);
    if (is_author()) {
        $schema =  schema(false, 'ProfilePage', false);
    }
}
?>
<div id="content" class="site-content <?php echo $layout; ?>  <?php echo $schema; ?>">
    <div id="main" role="main">
