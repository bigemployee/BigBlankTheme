<?php
/**
 * Adding layout class to our main content
 * Always call get_footer('layout'); to close tags opened here.
 */
$layout = bigblank_get_layout();
$schema = '';
if (is_home() || is_archive()) {
    $schema = schema(false, 'Blog', false);
    if (is_author()) {
        $schema = schema(false, 'ProfilePage', false);
    }
}
?>
<div id="content" class="site-content<?php echo $layout ? ' ' . $layout : '' ?>"<?php echo $schema ? ' ' . $schema : '' ?>>
    <div id="main" role="main">
