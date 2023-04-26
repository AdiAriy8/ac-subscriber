<?php
// Create custom post type for Subscribers
function create_subscriber_post_type() {
    $labels = array(
        'name' => __('Subscribers'),
        'singular_name' => __('Subscriber'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Subscriber'),
        'edit_item' => __('Edit Subscriber'),
        'new_item' => __('New Subscriber'),
        'view_item' => __('View Subscriber'),
        'search_items' => __('Search Subscribers'),
        'not_found' => __('No Subscribers found'),
        'not_found_in_trash' => __('No Subscribers found in Trash')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-email-alt2',
        'supports' => array('title', 'editor'),
        'rewrite' => array('slug' => 'subscriber'),
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'show_in_rest' => true
    );
    register_post_type('subscriber', $args);
}
add_action('init', 'create_subscriber_post_type');
