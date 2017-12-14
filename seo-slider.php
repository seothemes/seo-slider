<?php
/**
 * Plugin Name: SEO Slider
 * Plugin URI:  https://seothemes.com
 * Description: A search engined optimized, accessible and responsive slider plugin.
 * Author:      SEO Themes
 * Author URI:  https://seothemes.com
 * Version:     0.1.0
 * Text Domain: seo-slider
 * Domain Path: /languages
 * License:     GNU General Public License v2.0 (or later)
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 *
 * @package     SEOSlider
 * @link        https://seothemes.com/seo-slider
 * @author      Seo Themes
 * @copyright   Copyright © 2017 Seo Themes
 * @license     GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Load CMB2.
require_once( 'cmb2/init.php' );

// Load slider settings.
require_once( 'includes/seo-slider-settings.php' );

// Load custom post type.
require_once( 'includes/seo-slider-cpt.php' );

// Load slider shortcode.
require_once( 'includes/seo-slider-shortcode.php' );

// Load slider widget.
require_once( 'includes/seo-slider-widget.php' );

add_action( 'admin_enqueue_scripts', 'seo_slider_admin_scripts_styles', 100 );
/**
 * Register scripts and styles.
 */
function seo_slider_admin_scripts_styles() {

	if ( get_current_screen()->id === 'slide' || get_current_screen()->id === 'edit-slide' ) {

		// Slick CSS.
		wp_enqueue_style( 'seo-slider', plugin_dir_url( __FILE__ ) . 'assets/styles/admin.css' );

	}

}

add_action( 'wp_enqueue_scripts', 'seo_slider_scripts_styles' );
/**
 * Register scripts and styles.
 */
function seo_slider_scripts_styles() {

	if ( apply_filters( 'seo_slider_output_css', true ) ) {

		// Slick CSS.
		wp_enqueue_style( 'slick', plugin_dir_url( __FILE__ ) . 'assets/styles/slick.css' );

	}

	if ( apply_filters( 'seo_slider_output_js', true ) ) {

		// Slick JS.
		wp_enqueue_script( 'slick', plugin_dir_url( __FILE__ ) . 'assets/scripts/slick.min.js', array( 'jquery' ) );

	}

}
