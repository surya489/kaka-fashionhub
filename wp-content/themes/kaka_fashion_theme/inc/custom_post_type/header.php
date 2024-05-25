<?php

/**
 * Header & Footer post type
 */
function header_post_type() {
    $labels = array(
        'name' => _x('Header', 'Post Type General Name', 'konektgroup'),
        'singular_name' => _x('Header', 'Post Type Singular Name', 'konektgroup'),
        'menu_name' => __('Header & Footer', 'konektgroup'),
        'parent_item_colon' => __('Parent Header', 'konektgroup'),
        'all_items' => __('All Header', 'konektgroup'),
        'view_item' => __('View Header', 'konektgroup'),
        'add_new_item' => __('Add New Header', 'konektgroup'),
        'add_new' => __('Add New', 'konektgroup'),
        'edit_item' => __('Edit Header', 'konektgroup'),
        'update_item' => __('Update Header', 'konektgroup'),
        'search_items' => __('Search Header', 'konektgroup'),
        'not_found' => __('Not Found', 'konektgroup'),
        'not_found_in_trash' => __('Not found in Trash', 'konektgroup'),
    );

    $args = array(
        'label' => __('header-footer', 'konektgroup'),
        'description' => __('Header', 'konektgroup'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 20,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );

    register_post_type('header', $args);
}

add_action('init', 'header_post_type', 0);

function header_footer_register() {
    remove_menu_page('edit.php?post_type=header');
    add_menu_page(
            'Header & Footer', // page title
            'Header & Footer', // menu title
            'manage_options', // capability
            '/post.php?post=6&action=edit', // menu slug
            '', 'dashicons-admin-page', 21
    );
}

add_action('admin_menu', 'header_footer_register');