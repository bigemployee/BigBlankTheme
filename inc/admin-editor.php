<?php
/**
 * Modified Tiny MCE Editor with custom style_formats, and block_formats
 * Includes Drop Cap, Message Boxes, and removed some less used styles
 * such as H1 and H6 to promote more consistency throughout the content.
 * 
 * @link http://www.tinymce.com/wiki.php/Configuration
 */

// Add Custom Styles to second row of TinyMCE editor
function my_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Customize the format dropdown items
function bigblank_custom_editor_styles($settings) {
    $style_formats = array(
        array(
            'title' => __('Default Style', 'bigblank'),
            'format' => 'p'
        ),
//        array(
//            'title' => __('Drop Cap', 'bigblank'),
//            'block' => 'p',
//            'classes' => 'dropcap',
//            'remove' => 'all'
//        ),
//        array(
//            'title' => __('Button', 'bigblank'),
//            'selector' => 'a',
//            'classes' => 'button',
//            'remove' => 'all'
//        ),
        array(
            'title' => __('Message Boxes', 'bigblank'),
            'items' => array(
                array(
                    'title' => __('Success', 'bigblank'),
                    'block' => 'p',
                    'classes' => 'alert alert-success',
                    'remove' => 'all'
                ),
                array(
                    'title' => __('Info', 'bigblank'),
                    'block' => 'p',
                    'classes' => 'alert alert-info',
                    'remove' => 'all'
                ),
                array(
                    'title' => __('Warning', 'bigblank'),
                    'block' => 'p',
                    'classes' => 'alert alert-warning',
                    'remove' => 'all'
                ),
                array(
                    'title' => __('Danger', 'bigblank'),
                    'block' => 'p',
                    'classes' => 'alert alert-danger',
                    'remove' => 'all'
                )
            )
        )
    );
    $settings['style_formats'] = json_encode($style_formats);
    $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5';
    return $settings;
}

add_filter('tiny_mce_before_init', 'bigblank_custom_editor_styles');
