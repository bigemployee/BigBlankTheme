<?php

/**
 * Big Blank Theme Customizer support
 *
 */

/**
 * Implement Theme Customizer additions and adjustments.
 *
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bigblank_customize_register($wp_customize) {
    // Add postMessage support for site title and description.
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    // Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
    $wp_customize->get_control('display_header_text')->label = __('Display Site Title &amp; Tagline', 'bigblank');
}

add_action('customize_register', 'bigblank_customize_register');

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 */
function bigblank_customize_preview_js() {
    wp_enqueue_script('bigblank_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20131205', true);
}

add_action('customize_preview_init', 'bigblank_customize_preview_js');

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 *
 * @return void
 */
function bigblank_contextual_help() {
    if ('admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow']) {
        return;
    }
    get_current_screen()->add_help_tab(array(
        'id' => 'bigblank',
        'title' => __('Big Blank', 'bigblank'),
        'content' =>
        '<ul>' .
        '<li>' . sprintf(__('Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. Big Blank uses featured images for posts and pages&mdash;above the title.', 'bigblank'), 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail') . '</li>' .
        '<li>' . sprintf(__('For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">Big Blank documentation</a>.', 'bigblank'), 'http://bigemployee.com/projects/big-blank-responsive-wordpress-theme/') . '</li>' .
        '</ul>',
    ));
}

add_action('admin_head-themes.php', 'bigblank_contextual_help');
add_action('admin_head-edit.php', 'bigblank_contextual_help');
