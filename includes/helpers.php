<?php
/**
 * This file adds helper functions for the SEO Slider plugin.
 *
 * @package SEOSlider
 */

/**
 * Return plugin slug.
 *
 * @since 1.1.0
 *
 * @return string
 */
function seo_slider_get_slug() {
	return 'seo-slider';
}

/**
 * Returns the plugin directory.
 *
 * @since 1.1.0
 *
 * @return string
 */
function seo_slider_get_dir() {
	return trailingslashit( dirname( __DIR__ ) );
}

/**
 * Returns the main plugin file.
 *
 * @since 1.1.0
 *
 * @return string
 */
function seo_slider_get_file() {
	return seo_slider_get_dir() . '/seo-slider.php';
}

/**
 * Returns plugin directory URL.
 *
 * @since 1.1.0
 *
 * @return string
 */
function seo_slider_get_url() {
	return trailingslashit( plugin_dir_url( seo_slider_get_file() ) );
}

/**
 * Returns an array of plugin data from the main plugin file.
 *
 * @since 0.1.0
 *
 * @param string $key Optionally return one key.
 *
 * @return array|string|null
 */
function seo_slider_get_plugin_data( $key = '' ) {
	static $data = null;

	if ( is_null( $data ) ) {
		$data = get_file_data(
			seo_slider_get_file(),
			[
				'name'        => 'Plugin Name',
				'version'     => 'Version',
				'plugin-uri'  => 'Plugin URI',
				'text-domain' => 'Text Domain',
				'description' => 'Description',
				'author'      => 'Author',
				'author-uri'  => 'Author URI',
				'domain-path' => 'Domain Path',
				'network'     => 'Network',
			],
			'plugin'
		);
	}

	if ( array_key_exists( $key, $data ) ) {
		return $data[ $key ];
	}

	return $data;
}

/**
 * Returns the plugin version.
 *
 * @since 0.1.0
 *
 * @return string
 */
function seo_slider_get_version() {
	return seo_slider_get_plugin_data( 'version' );
}

/**
 * Description of expected behavior.
 *
 * @since 1.0.0
 *
 * @param $file
 *
 * @return string
 */
function seo_slider_get_asset_version( $file ) {
	$file    = seo_slider_get_dir() . 'assets/' . $file;
	$version = seo_slider_get_version();

	if ( file_exists( $file ) ) {
		$version .= '.' . date( 'njYHi', filemtime( $file ) );
	}

	return $version;
}

/**
 * Minify CSS helper function.
 *
 * @author Gary Jones
 * @link   https://github.com/GaryJones/Simple-PHP-CSS-Minification
 *
 * @param  string $css The CSS to minify.
 *
 * @return string Minified CSS.
 */
function seo_slider_minify_css( $css ) {
	$css = preg_replace( '/\s+/', ' ', $css );
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
	$css = preg_replace( '/;(?=\s*})/', '', $css );
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	$css = preg_replace( '/0 0 0 0/', '0', $css );
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}
