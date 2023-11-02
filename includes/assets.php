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

	if ( 'slide' === $screen || 'edit-slide' === $screen ) {
		wp_enqueue_style(
			'seo-slider-admin',
			seo_slider_get_url() . 'assets/styles/admin.css'
		);
	}
}

add_action( 'wp_enqueue_scripts', 'seo_slider_scripts_styles' );
/**
 * Load frontend scripts and styles.
 *
 * @return void
 */
function seo_slider_scripts_styles() {
	wp_enqueue_style(
		seo_slider_get_slug(),
		seo_slider_get_url() . 'assets/styles/styles.css',
		[],
		seo_slider_get_asset_version( 'styles/styles.css' ),
	);

	wp_enqueue_script(
		seo_slider_get_slug() . '-slick',
		seo_slider_get_url() . 'assets/scripts/slick.js',
		[ 'jquery' ],
		seo_slider_get_asset_version( 'scripts/slick.js' ),
		true
	);

	wp_enqueue_script(
		seo_slider_get_slug(),
		seo_slider_get_url() . 'assets/scripts/scripts.js',
		[ 'jquery' ],
		seo_slider_get_asset_version( 'scripts/scripts.js' ),
		true
	);
}
