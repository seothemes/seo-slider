<?php
/**
 * Plugin Name: SEO Slider
 * Plugin URI:  https://seothemes.com/plugins/seo-slider
 * Description: A simple and lightweight, search engined optimized, accessible and mobile responsive slider plugin.
 * Author:      SEO Themes
 * Author URI:  https://seothemes.com
 * Version:     1.0.8
 * Text Domain: seo-slider
 * Domain Path: /assets/lang
 * License:     GPL-2.0-or-later
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 *
 * @package     SEOSlider
 * @link        https://seothemes.com/plugins/seo-slider
 * @author      Seo Themes
 * @copyright   Copyright © 2019 Seo Themes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define constants.
define( 'SEO_SLIDER_FILE', __FILE__ );

// Load CMB2 library.
require_once 'cmb2/init.php';

// Load slider helper functions.
require_once 'includes/seo-slider-helpers.php';

// Load slider metabox settings.
require_once 'includes/seo-slider-settings.php';

// Load slider custom post type.
require_once 'includes/seo-slider-cpt.php';

// Load slider shortcode.
require_once 'includes/seo-slider-shortcode.php';

// Load slider widget.
require_once 'includes/seo-slider-widget.php';

// Load plugin assets.
require_once 'includes/seo-slider-assets.php';

// Add custom image size.
add_image_size( 'slider', 1280, 720, true );

// Register the widget.
add_action( 'widgets_init', function () {
	register_widget( 'SEO_Slider_Widget' );
} );
