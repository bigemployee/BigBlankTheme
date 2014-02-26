<?php

/**
 * Widgets and Sidebars
 * 
 * WordPress Widgets add content and features to your Sidebars. Examples are 
 * the default widgets that come with WordPress; for post categories, tag 
 * clouds, navigation, search, etc.
 * 
 * Sidebar is a theme feature introduced with Version 2.2. It's basically a 
 * vertical column provided by a theme for displaying information other than 
 * the main content of the web page. Themes usually provide at least one 
 * sidebar at the left or right of the content. Sidebars usually contain 
 * widgets that an administrator of the site can customize.
 * 
 * @link https://codex.wordpress.org/WordPress_Widgets
 * @link https://codex.wordpress.org/Widgets_API
 * @link https://codex.wordpress.org/Sidebars
 */

/**
 * Remove recent comments inline style form WP <head>
 * Since function recent_comments_style() in wp-includes\default-widgets.php 
 * checks for show_recent_comments_widget_style to be true, lets make it false 
 * so it will not display inline css.
 * .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
 * @link http://codex.wordpress.org/Function_Reference/_return_false
 */
function bigblank_remove_recent_comments_style() {
    add_filter('show_recent_comments_widget_style', '__return_false');
}

add_action('widgets_init', 'bigblank_remove_recent_comments_style');

/**
 * Register Big Blank widget areas.
 *
 * @return void
 */
function bigblank_widgets_init() {
    // Main sidebar
    register_sidebar(array(
        'id' => 'sidebar',
        'name' => __('Primary Sidebar', 'bigblank'),
        'description' => __('Sidebar appears next to content.', 'bigblank'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Call to action block
    register_sidebar(array(
        'id' => 'call2action',
        'name' => __('Footer Call to Action', 'bigblank'),
        'description' => __('This "Call to Action" area appears after our content', 'bigblank'),
        'before_widget' => '<div id="call2action">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    // Newsletter Widget area
    register_sidebar(array(
        'id' => 'newsletter',
        'name' => __('Newsletter', 'bigblank'),
        'description' => __('Newsletter widget appears in footer section on every page.', 'bigblank'),
        'before_widget' => '<div class="newsletter-widget"><i class="fa fa-envelope"></i>',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    
    // Footer sidebar
    register_sidebar(array(
        'id' => 'footer',
        'name' => __('Footer', 'bigblank'),
        'description' => __('Footer widget area', 'bigblank'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Register Widgets
    // @param string $widget_class The name of a class that extends WP_Widget
    register_widget('Title_Widget');
    register_widget('Call_To_Action_Widget');
}

add_action('widgets_init', 'bigblank_widgets_init');
