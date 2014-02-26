<?php

/**
 * Big Blank Theme Customizer support
 *
 */

/**
 * Implement Theme Customizer additions and adjustments.
 * Static front page priority is 120, so we assign our section priorities higher
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bigblank_customize_register($wp_customize) {
    // Add postMessage support for site title and description.
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    // Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
    $wp_customize->get_control('display_header_text')->label = __('Display Site Title &amp; Tagline', 'bigblank');
    
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $defaults = bigblank_get_default_theme_options();

    // Contact Section
    $wp_customize->add_section('contact', array(
        'title' => __('Contact Settings', 'bigblank'),
        'priority' => 140
    ));
    // phone text
    $wp_customize->add_setting('bigblank_theme_options[phone]', array(
        'type' => 'option',
        'default' => $defaults['phone'],
    ));
    $wp_customize->add_control('bigblank_theme_options[phone]', array(
        'label' => __('Phone Number', 'bigblank'),
        'section' => 'contact',
        'settings' => 'bigblank_theme_options[phone]',
    ));
    // address text
    $wp_customize->add_setting('bigblank_theme_options[address]', array(
        'type' => 'option',
        'default' => $defaults['address'],
    ));
    $wp_customize->add_control('bigblank_theme_options[address]', array(
        'label' => __('Address', 'bigblank'),
        'section' => 'contact',
        'settings' => 'bigblank_theme_options[address]',
    ));

    // social section
    $wp_customize->add_section('social', array(
        'title' => __('Social Links', 'bigblank'),
        'priority' => 150
    ));
    // twitter
    $wp_customize->add_setting('bigblank_theme_options[twitter]', array(
        'type' => 'option',
        'default' => $defaults['twitter'],
    ));
    $wp_customize->add_control('bigblank_theme_options[twitter]', array(
        'label' => __('Twitter', 'bigblank'),
        'section' => 'social',
        'settings' => 'bigblank_theme_options[twitter]',
    ));
    // facebook
    $wp_customize->add_setting('bigblank_theme_options[facebook]', array(
        'type' => 'option',
        'default' => $defaults['facebook'],
    ));
    $wp_customize->add_control('bigblank_theme_options[facebook]', array(
        'label' => __('Facebook', 'bigblank'),
        'section' => 'social',
        'settings' => 'bigblank_theme_options[facebook]',
    ));

    // instagram
    $wp_customize->add_setting('bigblank_theme_options[instagram]', array(
        'type' => 'option',
        'default' => $defaults['instagram'],
    ));
    $wp_customize->add_control('bigblank_theme_options[instagram]', array(
        'label' => __('Instagram', 'bigblank'),
        'section' => 'social',
        'settings' => 'bigblank_theme_options[instagram]',
    ));
    // youtube
    $wp_customize->add_setting('bigblank_theme_options[youtube]', array(
        'type' => 'option',
        'default' => $defaults['youtube'],
    ));
    $wp_customize->add_control('bigblank_theme_options[youtube]', array(
        'label' => __('Youtube', 'bigblank'),
        'section' => 'social',
        'settings' => 'bigblank_theme_options[youtube]',
    ));

    // Default Layout
    $wp_customize->add_section('bigblank_layout', array(
        'title' => __('Layout', 'bigblank'),
        'priority' => 130,
    ));

    $wp_customize->add_setting('bigblank_theme_options[theme_layout]', array(
        'type' => 'option',
        'default' => $defaults['theme_layout'],
        'sanitize_callback' => 'sanitize_key',
    ));

    $layouts = bigblank_layouts();
    $choices = array();
    foreach ($layouts as $layout) {
        $choices[$layout['value']] = $layout['label'];
    }

    $wp_customize->add_control('bigblank_theme_options[theme_layout]', array(
        'section' => 'bigblank_layout',
        'type' => 'radio',
        'choices' => $choices,
    ));

    // Footer Section
    $wp_customize->add_section('footer', array(
        'title' => __('Footer Settings', 'bigblank'),
        'priority' => 160,
    ));
    // copyright text
    $wp_customize->add_setting('bigblank_theme_options[footer_copyright]', array(
        'type' => 'option',
        'default' => $defaults['footer_copyright'],
    ));
    $wp_customize->add_control('bigblank_theme_options[footer_copyright]', array(
        'label' => __('Copyright Text', 'bigblank'),
        'section' => 'footer',
        'settings' => 'bigblank_theme_options[footer_copyright]',
    ));
    // footer text
    $wp_customize->add_setting('bigblank_theme_options[footer_text]', array(
        'type' => 'option',
        'default' => $defaults['footer_text'],
    ));
    $wp_customize->add_control('bigblank_theme_options[footer_text]', array(
        'label' => __('Footer Text', 'bigblank'),
        'section' => 'footer',
        'settings' => 'bigblank_theme_options[footer_text]',
    ));
}

add_action('customize_register', 'bigblank_customize_register');

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 */
function bigblank_customize_preview_js() {
    wp_enqueue_script('bigblank_customizer', get_template_directory_uri() . '/js/admin-customizer.js', array('customize-preview'), '20131205', true);
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
