<?php
/**
 * This file registers the Slides custom post type.
 *
 * @package SEOSlider
 */

/**
 * Register Custom Post Type.
 */
function seo_slider_cpt() {

	$labels = array(
		'name'                  => _x( 'Slides', 'Slide General Name', 'seo-slider' ),
		'singular_name'         => _x( 'Slide', 'Slide Singular Name', 'seo-slider' ),
		'menu_name'             => __( 'Slides', 'seo-slider' ),
		'name_admin_bar'        => __( 'Slide', 'seo-slider' ),
		'archives'              => __( 'Slide Archives', 'seo-slider' ),
		'attributes'            => __( 'Slide Attributes', 'seo-slider' ),
		'parent_item_colon'     => __( 'Parent Slide:', 'seo-slider' ),
		'all_items'             => __( 'All Slides', 'seo-slider' ),
		'add_new_item'          => __( 'Add New Slide', 'seo-slider' ),
		'add_new'               => __( 'Add New', 'seo-slider' ),
		'new_item'              => __( 'New Slide', 'seo-slider' ),
		'edit_item'             => __( 'Edit Slide', 'seo-slider' ),
		'update_item'           => __( 'Update Slide', 'seo-slider' ),
		'view_item'             => __( 'View Slide', 'seo-slider' ),
		'view_items'            => __( 'View Slides', 'seo-slider' ),
		'search_items'          => __( 'Search Slide', 'seo-slider' ),
		'not_found'             => __( 'Not found', 'seo-slider' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'seo-slider' ),
		'featured_image'        => __( 'Featured Image', 'seo-slider' ),
		'set_featured_image'    => __( 'Set featured image', 'seo-slider' ),
		'remove_featured_image' => __( 'Remove featured image', 'seo-slider' ),
		'use_featured_image'    => __( 'Use as featured image', 'seo-slider' ),
		'insert_into_item'      => __( 'Insert into slide', 'seo-slider' ),
		'uploaded_to_this_item' => __( 'Uploaded to this slide', 'seo-slider' ),
		'items_list'            => __( 'Slides list', 'seo-slider' ),
		'items_list_navigation' => __( 'Slides list navigation', 'seo-slider' ),
		'filter_items_list'     => __( 'Filter slides list', 'seo-slider' ),
	);
	$args = array(
		'label'                 => __( 'Slide', 'seo-slider' ),
		'description'           => __( 'Slide Description', 'seo-slider' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'slider' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'slide', $args );

}
add_action( 'init', 'seo_slider_cpt', 0 );
