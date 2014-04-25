<?php
/**
 * Documentation & Quick Start Guide
 * @link http://bigemployee.com/projects/big-blank-responsive-wordpress-theme/
 * 
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php wp_head(); ?>
        <!--[if lte IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body <?php body_class(); ?>>
        <header id="header" class="site-header" role="banner">
            <a id="logo" href="<?php echo home_url(); ?>" title="<?php _e('Home', 'bigblank'); ?>" rel="home">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bigblanktheme_logo.png" alt="<?php bloginfo('name'); ?> logo" width="200" height="29"/>
                <span><?php bloginfo('name'); ?></span>
            </a>
            <nav id="nav" role="navigation">
                <h1 id="menu-toggle"><i class="fa fa-bars"></i><?php _e('Primary Menu', 'bigblank'); ?></h1>
                <a class="screen-reader-text skip-link" href="#content"><?php _e('Skip to content', 'bigblank'); ?></a>
                <?php bigblank_main_menu(); ?>
            </nav>
        </header><!-- #header -->
