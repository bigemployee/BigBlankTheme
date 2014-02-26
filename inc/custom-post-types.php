<?php
/**
 * Custom post types are new post types you can create. A custom post type can 
 * be added to WordPress via the register_post_type() function. This function 
 * allows you to define a new post type by its labels, supported features, 
 * availability and other specifics.
 * 
 * @link http://codex.wordpress.org/Post_Types#Custom_Post_Types
 */
function be_register_post_type() {
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
    flush_rewrite_rules();
}

add_action('init', 'be_register_post_type');