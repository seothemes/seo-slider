<?php
/**
 * This file adds helper functions for the SEO Slider plugin.
 *
 * @package SEOSlider
 */

/**
 * Minify JS helper function.
 *
 * @param  string $js Input JS.
 *
 * @return string
 */
function seo_slider_minify_js( $js ) {

	// Setup blocks.
	$blocks = array( 'for', 'while', 'if', 'else' );
	$js = preg_replace( '/([-\+])\s+\+([^\s;]*)/', '$1 (+$2)', $js );

	// Remove new line in statements.
	$js = preg_replace( '/\s+\|\|\s+/', ' || ', $js );
	$js = preg_replace( '/\s+\&\&\s+/', ' && ', $js );
	$js = preg_replace( '/\s*([=+-\/\*:?])\s*/', '$1 ', $js );

	// Handle missing brackets.
	foreach ( $blocks as $block ) {

		$js = preg_replace( '/(\s*\b' . $block . '\b[^{\n]*)\n([^{\n]+)\n/i', '$1{$2}', $js );

	}

	// Handle spaces.
	$js = preg_replace( array( "/\s*\n\s*/", '/\h+/' ), array( "\n", ' ' ), $js );

	// Horizontal white space.
	$js = preg_replace( array( '/([^a-z0-9\_])\h+/i', '/\h+([^a-z0-9\$\_])/i' ), '$1', $js );
	$js = preg_replace( '/\n?([[;{(\.+-\/\*:?&|])\n?/', '$1', $js );
	$js = preg_replace( '/\n?([})\]])/', '$1', $js );
	$js = str_replace( "\nelse", 'else', $js );
	$js = preg_replace( "/([^}])\n/", '$1;', $js );
	$js = preg_replace( "/;?\n/", ';', $js );

	return $js;

}

 /**
  * Minify CSS helper function.
  *
  * @author Gary Jones
  * @link   https://github.com/GaryJones/Simple-PHP-CSS-Minification
  * @param  string $css The CSS to minify.
  *
  * @return string Minified CSS.
  */
function seo_slider_minify_css( $css ) {

	// Normalize whitespace.
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove spaces before and after comment.
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );

	// Remove comment blocks, everything between /* and */, unless preserved with /*! ... */ or /** ... */.
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );

	// Remove ; before }.
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >.
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { } ( ) >.
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px).
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0).
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Converts all zeros value into short-hand.
	$css = preg_replace( '/0 0 0 0/', '0', $css );

	// Shorten 6-character hex color codes to 3-character where possible.
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );

}
