<?php

/**
 * In WordPress, a "taxonomy" is a grouping mechanism for some posts 
 * (or links or custom post types).
 * 
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 * @link http://codex.wordpress.org/Taxonomies#Custom_Taxonomies
 */
// create two taxonomies, genres and writers for the post type "book"
function bigblank_register_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name' => __('Departments', 'bigblank'),
        'singular_name' => __('Department', 'bigblank'),
        'search_items' => __('Search Departments', 'bigblank'),
        'all_items' => __('All Departments', 'bigblank'),
        'parent_item' => __('Parent Department', 'bigblank'),
        'parent_item_colon' => __('Parent Department:', 'bigblank'),
        'edit_item' => __('Edit Department', 'bigblank'),
        'update_item' => __('Update Department', 'bigblank'),
        'add_new_item' => __('Add New Department', 'bigblank'),
        'new_item_name' => __('New Department Name', 'bigblank'),
//        'separate_items_with_commas' => __('Separate departments with commas', 'bigblank'),
        'add_or_remove_items' => __('Add or remove departments', 'bigblank'),
//        'choose_from_most_used' => __('Choose from the most used departments', 'bigblank'),
        'not_found' => __('No department was found.', 'bigblank'),
        'menu_name' => __('Departments', 'bigblank'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
//        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'department')
    );

    register_taxonomy('department', array('team'), $args);
}

add_action('init', 'bigblank_register_taxonomies');

/**
 * To get permalinks to work when you activate the theme
 */
if (!function_exists('bigblank_rewrite_flush')){
    function bigblank_rewrite_flush() {
        flush_rewrite_rules();
    }
}

add_action('after_switch_theme', 'flush_rewrite_rules');