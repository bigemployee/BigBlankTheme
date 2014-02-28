<?php
/**
 * Display social media links set from theme options settings
 *
 */
?>
<?php
$options = bigblank_get_theme_options();
?>
<div class="social-media">
    <?php if (isset($options['facebook']) && $facebook = $options['facebook']) : ?>
        <a href="<?php echo $facebook; ?>" class="fa fa-facebook"></a>
    <?php endif; ?>
    <?php if (isset($options['twitter']) && $twitter = $options['twitter']) : ?>
        <a href="<?php echo $twitter; ?>" class="fa fa-twitter"></a>
    <?php endif; ?>
    <?php if (isset($options['instagram']) && $instagram = $options['instagram']) : ?>
        <a href="<?php echo $instagram; ?>" class="fa fa-instagram"></a>
    <?php endif; ?>
    <?php if (isset($options['youtube']) && $youtube = $options['youtube']) : ?>
        <a href="<?php echo $youtube; ?>" class="fa fa-youtube-play"></a>
    <?php endif; ?>
</div>