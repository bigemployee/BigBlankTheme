<?php
/**
 * Display social media links set from theme options settings
 *
 */
?>
<?php
$options = bigblank_get_theme_options();
$facebook = $options['facebook'];
$twitter = $options['twitter'];
$instagram = $options['instagram'];
$youtube = $options['youtube'];
$pinterest = $options['pinterest'];
?>
<?php if ($facebook || $twitter || $instagram || $youtube || $pinterest) : ?>
    <div class="social-media">
        <?php if ($facebook) : ?>
            <a href="<?php echo $facebook; ?>" class="fa fa-facebook"></a>
        <?php endif; ?>
        <?php if ($twitter) : ?>
            <a href="<?php echo $twitter; ?>" class="fa fa-twitter"></a>
        <?php endif; ?>
        <?php if ($instagram) : ?>
            <a href="<?php echo $instagram; ?>" class="fa fa-instagram"></a>
        <?php endif; ?>
        <?php if ($youtube) : ?>
            <a href="<?php echo $youtube; ?>" class="fa fa-youtube-play"></a>
        <?php endif; ?>
        <?php if ($pinterest) : ?>
            <a href="<?php echo $pinterest; ?>" class="fa fa-pinterest"></a>
        <?php endif; ?>
    </div><!-- .social-media -->
<?php endif; ?>