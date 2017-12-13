<?php
/**
 * This file registers the Slider custom taxonomy.
 *
 * @package SEOSlider
 */

/**
 * Register Custom Taxonomy.
 *
 * @return void
 */
function seo_slider_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Slider', 'Taxonomy General Name', 'seo-slider' ),
		'singular_name'              => _x( 'Slider', 'Taxonomy Singular Name', 'seo-slider' ),
		'menu_name'                  => __( 'Sliders', 'seo-slider' ),
		'all_items'                  => __( 'All Sliders', 'seo-slider' ),
		'parent_item'                => __( 'Parent Item', 'seo-slider' ),
		'parent_item_colon'          => __( 'Parent Item:', 'seo-slider' ),
		'new_item_name'              => __( 'New Slider', 'seo-slider' ),
		'add_new_item'               => __( 'Add New Slider', 'seo-slider' ),
		'edit_item'                  => __( 'Edit Slider', 'seo-slider' ),
		'update_item'                => __( 'Update Slider', 'seo-slider' ),
		'view_item'                  => __( 'View Slider', 'seo-slider' ),
		'separate_items_with_commas' => __( 'Separate sliders with commas', 'seo-slider' ),
		'add_or_remove_items'        => __( 'Add or remove sliders', 'seo-slider' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'seo-slider' ),
		'popular_items'              => __( 'Popular Sliders', 'seo-slider' ),
		'search_items'               => __( 'Search Sliders', 'seo-slider' ),
		'not_found'                  => __( 'Not Found', 'seo-slider' ),
		'no_terms'                   => __( 'No sliders', 'seo-slider' ),
		'items_list'                 => __( 'Sliders list', 'seo-slider' ),
		'items_list_navigation'      => __( 'Sliders list navigation', 'seo-slider' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => false,
	);

	register_taxonomy( 'slider', array( 'slide' ), $args );

}
add_action( 'init', 'seo_slider_taxonomy', 0 );
