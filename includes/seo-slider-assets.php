<?php
/**
 * This file loads plugin scripts and styles.
 *
 * @package SEOSlider
 */

add_action( 'admin_enqueue_scripts', 'seo_slider_admin_scripts_styles', 100 );
/**
 * Load admin scripts and styles.
 *
 * @return void
 */
function seo_slider_admin_scripts_styles() {

	$screen = get_current_screen()->id;

	if ( $screen === 'slide' || $screen === 'edit-slide' ) {

		// Enqueue admin CSS.
		wp_enqueue_style( 'seo-slider-admin', plugin_dir_url( SEO_SLIDER_FILE ) . 'assets/styles/admin.css' );

	}

}

add_action( 'wp_enqueue_scripts', 'seo_slider_scripts_styles' );
/**
 * Load frontend scripts and styles.
 *
 * @return void
 */
function seo_slider_scripts_styles() {

	// Enqueue frontend CSS.
	wp_enqueue_style( 'seo-slider', plugin_dir_url( SEO_SLIDER_FILE ) . 'assets/styles/styles.min.css' );

	// Enqueue frontend JS.
	wp_enqueue_script( 'seo-slider', plugin_dir_url( SEO_SLIDER_FILE ) . 'assets/scripts/scripts.min.js', [ 'jquery' ] );

}
