<?php
/**
 * This file registers the Slider custom post type.
 *
 * @package SEOSlider
 */

add_action( 'init', 'seo_slider_cpt', 0 );
/**
 * Register Custom Post Type.
 *
 * @return void
 */
function seo_slider_cpt() {
	$labels = [
		'name'                  => _x( 'Sliders', 'Slider General Name', 'seo-slider' ),
		'singular_name'         => _x( 'Slider', 'Slider Singular Name', 'seo-slider' ),
		'menu_name'             => __( 'Sliders', 'seo-slider' ),
		'name_admin_bar'        => __( 'Slider', 'seo-slider' ),
		'archives'              => __( 'Slider Archives', 'seo-slider' ),
		'attributes'            => __( 'Slider Attributes', 'seo-slider' ),
		'parent_item_colon'     => __( 'Parent Slider:', 'seo-slider' ),
		'all_items'             => __( 'All Sliders', 'seo-slider' ),
		'add_new_item'          => __( 'Add New Slider', 'seo-slider' ),
		'add_new'               => __( 'Add New', 'seo-slider' ),
		'new_item'              => __( 'New Slider', 'seo-slider' ),
		'edit_item'             => __( 'Edit Slider', 'seo-slider' ),
		'update_item'           => __( 'Update Slider', 'seo-slider' ),
		'view_item'             => __( 'View Slider', 'seo-slider' ),
		'view_items'            => __( 'View Sliders', 'seo-slider' ),
		'search_items'          => __( 'Search Slider', 'seo-slider' ),
		'not_found'             => __( 'Not found', 'seo-slider' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'seo-slider' ),
		'featured_image'        => __( 'Featured Image', 'seo-slider' ),
		'set_featured_image'    => __( 'Set featured image', 'seo-slider' ),
		'remove_featured_image' => __( 'Remove featured image', 'seo-slider' ),
		'use_featured_image'    => __( 'Use as featured image', 'seo-slider' ),
		'insert_into_item'      => __( 'Insert into slide', 'seo-slider' ),
		'uploaded_to_this_item' => __( 'Uploaded to this slide', 'seo-slider' ),
		'items_list'            => __( 'Sliders list', 'seo-slider' ),
		'items_list_navigation' => __( 'Sliders list navigation', 'seo-slider' ),
		'filter_items_list'     => __( 'Filter slides list', 'seo-slider' ),
	];

	$args   = [
		'label'               => __( 'Slider', 'seo-slider' ),
		'description'         => __( 'Slider Description', 'seo-slider' ),
		'labels'              => $labels,
		'supports'            => [ 'title' ],
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-images-alt2',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	];

	register_post_type( 'slide', $args );
}
