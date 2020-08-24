<?php
/**
 * This file sets up the plugin.
 *
 * @package SEOSlider
 */

// Add custom image size.
add_image_size( 'slider', 1280, 720, true );

// Register the widget.
add_action( 'widgets_init', function () {
	register_widget( 'SEO_Slider_Widget' );
} );
