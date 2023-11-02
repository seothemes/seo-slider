<?php
/**
 * Plugin Name: SEO Slider
 * Plugin URI:  https://seothemes.com/plugins/seo-slider
 * Description: A simple and lightweight, search engined optimized, accessible
 * and mobile responsive slider plugin. Author:      SEO Themes Author URI:
 * https://seothemes.com Version:     1.1.1 Text Domain: seo-slider Domain
 * Path: /assets/lang License:     GPL-2.0-or-later License URI:
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * @author      Seo Themes
 * @package     SEOSlider
 * @link        https://seothemes.com/plugins/seo-slider
 * @copyright   Copyright © 2019 Seo Themes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Load CMB2 library.
require_once 'cmb2/init.php';

// Load slider helper functions.
require_once 'includes/helpers.php';

// Load slider metabox settings.
require_once 'includes/settings.php';

// Load slider custom post type.
require_once 'includes/cpt.php';

// Load slider shortcode.
require_once 'includes/shortcode.php';

// Load slider widget.
require_once 'includes/widget.php';

// Load plugin assets.
require_once 'includes/assets.php';

// Set up plugin.
require_once 'includes/setup.php';
