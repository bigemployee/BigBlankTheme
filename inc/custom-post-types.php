<?php

/**
 * Custom post types are new post types you can create. A custom post type can 
 * be added to WordPress via the register_post_type() function. This function 
 * allows you to define a new post type by its labels, supported features, 
 * availability and other specifics.
 * 
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 * @link http://codex.wordpress.org/Post_Types#Custom_Post_Types
 */
function bigblank_register_post_type() {
    $teamLabels = array(
        'name' => 'Team',
        'singular_name' => 'Team',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Profile',
        'edit_item' => 'Edit Profile',
        'new_item' => 'New Profile',
        'all_items' => 'All Profiles',
        'view_item' => 'View Profile',
        'search_items' => 'Search Profiles',
        'not_found' => 'No profile was found',
        'not_found_in_trash' => 'No profile was found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Team'
    );

    $teamArgs = array(
        'labels' => $teamLabels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => 'dashicons-businessman',
        'query_var' => true,
        'rewrite' => array('slug' => 'team'),
        'has_archive' => false,
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
//            'trackbacks',
            'custom-fields',
//            'comments',
            'revisions',
//            'page-attributes',
//            'post-formats',
        )
    );

    register_post_type('team', $teamArgs);
}

add_action('init', 'bigblank_register_post_type');

/**
 * To get permalinks to work when you activate the theme
 */
function bigblank_rewrite_flush() {
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'bigblank_rewrite_flush');

function bigblank_print($title = '', $before = '', $after = '', $echo = true) {

    if (strlen($title) == 0)
        return;

    $title = $before . $title . $after;

    if ($echo)
        echo $title;
    else
        return $title;
}
