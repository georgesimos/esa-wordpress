<?php namespace App\ESA\PostTypes\CaseStudy;

/**
 * Register Case Study post type
 */
add_action( 'init', function() {

    $labels = array(
        'name'                  => _x( 'Case Studies', 'Post Type General Name', 'esa' ),
        'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'esa' ),
        'menu_name'             => __( 'Case Studies', 'esa' ),
        'name_admin_bar'        => __( 'Case Studies', 'esa' ),
        'archives'              => __( 'Item Archives', 'esa' ),
        'attributes'            => __( 'Item Attributes', 'esa' ),
        'parent_item_colon'     => __( 'Parent Item:', 'esa' ),
        'all_items'             => __( 'All Items', 'esa' ),
        'add_new_item'          => __( 'Add New Item', 'esa' ),
        'add_new'               => __( 'Add New', 'esa' ),
        'new_item'              => __( 'New Item', 'esa' ),
        'edit_item'             => __( 'Edit Item', 'esa' ),
        'update_item'           => __( 'Update Item', 'esa' ),
        'view_item'             => __( 'View Item', 'esa' ),
        'view_items'            => __( 'View Items', 'esa' ),
        'search_items'          => __( 'Search Item', 'esa' ),
        'not_found'             => __( 'Not found', 'esa' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'esa' ),
        'featured_image'        => __( 'Featured Image', 'esa' ),
        'set_featured_image'    => __( 'Set featured image', 'esa' ),
        'remove_featured_image' => __( 'Remove featured image', 'esa' ),
        'use_featured_image'    => __( 'Use as featured image', 'esa' ),
        'insert_into_item'      => __( 'Insert into item', 'esa' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'esa' ),
        'items_list'            => __( 'Items list', 'esa' ),
        'items_list_navigation' => __( 'Items list navigation', 'esa' ),
        'filter_items_list'     => __( 'Filter items list', 'esa' ),
    );
    $default_page_id = wpc_get_default_page_id( 'esa_case_study' );
    $rewrite         = array(
        'slug'       => ! empty( $default_page_id ) ? get_page_uri( $default_page_id ) : __( 'case-studies', 'esa' ),
        'with_front'            => false,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Case Study', 'esa' ),
        'description'           => __( 'Case Study post type for ESA theme.', 'esa' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-analytics',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => false,
    );

    register_post_type( 'esa_case_study', $args );
}, 0 );
