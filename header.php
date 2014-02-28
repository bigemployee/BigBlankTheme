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
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--[if lte IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <header id="header" class="site-header" role="banner">
                <?php
                /**
                 * Use Logo instead of site title
                 */
                ?>
                <a id="logo" href="<?php echo home_url(); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/bigblanktheme_logo.png" alt="<?php bloginfo('name'); ?> logo" width="200" height="29"/>
                </a>
                <?php
                /**
                 * Use this line to display site title as text, don't foget to comment above lines
                 * <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                 */
                ?>
                <nav id="menu" role="navigation">
                    <h1 id="menu-toggle"><i class="fa fa-bars"></i><?php _e('Primary Menu', 'bigblank'); ?></h1>
                    <a class="screen-reader-text skip-link" href="#content"><?php _e('Skip to content', 'bigblank'); ?></a>
                    <?php bigblank_main_menu(); ?>
                </nav>
            </header><!-- #header -->
            <div id="main" class="site-main">
