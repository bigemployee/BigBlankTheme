<?php
/**
 * Big Blank functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 */
/**
 * Set up the content width value based on the theme's design.
 *
 * @see bigblank_content_width()
 *
 */
if (!isset($content_width)) {
    $content_width = 960;
}
/**
 * Big Blank only works in WordPress 3.8 or later.
 */
if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
    require_once(get_template_directory() . '/inc/admin-back-compat.php');
}

/**
 * Download all the plugins required for our theme to work properly
 * @link http://tgmpluginactivation.com/
 */
require_once(get_template_directory() . '/inc/admin-theme-plugins.php');


if (!function_exists('bigblank_setup')) :

    /**
     * Big Blank setup.
     *
     * Set up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support post thumbnails.
     *
     */
    function bigblank_setup() {
        /*
         * Make Big Blank available for translation.
         *
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on Big Blank, use a find and
         * replace to change 'bigblank' to the name of your theme in all
         * template files.
         */
        load_theme_textdomain('bigblank', get_template_directory() . '/languages');

        // Theme options menu
        require(get_template_directory() . '/inc/admin-theme-options.php');

        // This theme styles the visual editor to resemble the theme style.
        add_editor_style(array('css/editor-style.css'));
        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');
        // Enable support for Post Thumbnails, and declare thumbnail sizes.
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(960, 480, true);
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'main_menu' => __('Top Primary Menu', 'bigblank'),
            'footer_menu' => __('Footer Menu', 'bigblank'),
        ));
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list',
        ));
        // This theme uses its own gallery styles.
        add_filter('use_default_gallery_style', '__return_false');

        // add custom metaboxs and save the data
        add_action('add_meta_boxes', 'bigblank_add_custom_box');
        add_action('save_post', 'bigblank_save_post');
    }

endif; // bigblank_setup
add_action('after_setup_theme', 'bigblank_setup');

/**
 * Adjust content_width value for image attachment template.
 *
 *
 * @return void
 */
function bigblank_content_width() {
    if (is_attachment() && wp_attachment_is_image()) {
        $GLOBALS['content_width'] = 960;
    }
}

add_action('template_redirect', 'bigblank_content_width');

/**
 * Let's remove some code and cleanup <head>
 */
function bigblank_head_cleanup() {
    /**
     * remove Really Simple Discoverability; Roll it in if you want to use 
     * Weblog Clients that use XML-RPC Support
     * @link http://codex.wordpress.org/XML-RPC_Support
     */
    remove_action('wp_head', 'rsd_link');
    // remove Windows Live Writer Manifest link
    remove_action('wp_head', 'wlwmanifest_link');
    // remove WordPress version meta
    remove_action('wp_head', 'wp_generator');
}

add_action('init', 'bigblank_head_cleanup');

/**
 * Remove version from CSS and JS files for Caching
 * @param string|array $src Query key or keys to remove.
 * @return string New URL query string.
 */
function bigblank_remove_wp_ver_css_js($src) {
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}

add_filter('style_loader_src', 'bigblank_remove_wp_ver_css_js');
add_filter('script_loader_src', 'bigblank_remove_wp_ver_css_js');

/**
 * Enqueue scripts and styles for the front end.
 *
 * Read more about wp_register_script at: 
 * @link http://codex.wordpress.org/Function_Reference/wp_register_script
 * @return void
 */
function bigblank_scripts() {

    // Load our main stylesheet.
    wp_enqueue_style('style', get_stylesheet_uri());
    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style('ie', get_template_directory_uri() . '/css/ie.css', false, '20140222');
    wp_style_add_data('ie', 'conditional', 'lt IE 9');

    // jQuery.js
    // 1. load the latest jQuery from theme library
    //    wp_deregister_script('jquery');
    //    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.js', false, '2.1.0', true);
    // 2. load from Google CDN        
    //    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', false, false, true);
    // 3. load from WP included library, Loading jQuery in footer sometimes causes 
    //    for some plugins to not work since they do not register jQuery as dependancy 
    //    wp_register_script('jquery', false, false, false, true);
    // 4. or do nothing and jQuery will load from current WordPress install
    $options = bigblank_get_theme_options();
    $comments = $options['page_comments'];
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply', false, false, false, true);
    }
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), '20140222', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'scripts'), '20140222', true);
}

add_action('wp_enqueue_scripts', 'bigblank_scripts');

// Widgets and Sidebars
require_once(get_template_directory() . '/inc/widget-title.php');
require_once(get_template_directory() . '/inc/widget-call-to-action.php');
require_once(get_template_directory() . '/inc/widgets-sidebars.php');

// Custom post types
require_once(get_template_directory() . '/inc/custom-post-types.php');

// Filters and functions to manipulate content
require_once(get_template_directory() . '/inc/filters.php');

// Custom template tags for this theme.
require_once(get_template_directory() . '/inc/template-tags.php');

// Add Theme Customizer functionality.
require_once(get_template_directory() . '/inc/admin-customizer.php');
