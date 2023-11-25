<?php
/*
Plugin Name: Hotel Plugin
Plugin URI: https://rezaabbasian.ir/
Description: Hotel plugin creation hotel custom content type.
Version: 1.0
Author: Reza Abbasian
Author URI: https://rezaabbasian.ir/
License: GPLv2 or later
Text Domain: hotel
*/

// Start Hotel Custom Post Type
function hotel_custom_post_type() {
    $labels = array(
        'name'                  => _x( 'Hotels', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Hotel', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Hotels', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Hotel', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Hotel', 'textdomain' ),
        'new_item'              => __( 'New Hotel', 'textdomain' ),
        'edit_item'             => __( 'Edit Hotel', 'textdomain' ),
        'view_item'             => __( 'View Hotel', 'textdomain' ),
        'all_items'             => __( 'All Hotels', 'textdomain' ),
        'search_items'          => __( 'Search Hotels', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Hotels:', 'textdomain' ),
        'not_found'             => __( 'No hotels found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No hotels found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Hotel Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Hotel archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into hotel', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this hotel', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter hotels list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Hotels list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Hotels list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'hotel' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments','custom-fields' ),
    );
 
    register_post_type( 'hotel', $args );
}

add_action('init', 'hotel_custom_post_type');
// End Hotel Custom Post Type

// Start Custom Rest API Endpoint
function custom_endpoint ( $data ) {
    $posts = get_posts( array(
        'numberposts'   => -1,
        'post_type'     => array('hotel', 'post'), 
    ));

    if ( empty( $posts ) ) {
        return null;
    }
    return  $posts;
    }

    add_action( 'rest_api_init', function () {
        register_rest_route( 'api/v1', '/all/', array(
          'methods' => 'GET',
          'callback' => 'custom_endpoint',
      ) );
    } );

// End Custom Rest API Endpoint