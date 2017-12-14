<?php
/**
 * This file registers the [slider] shortcode.
 *
 * @package SEOSlider
 */

add_shortcode( 'slider', 'seo_slider_shortcode' );
/**
 * Add shortcode.
 *
 * @param  array $atts Shortcode attributes.
 * @return void
 */
function seo_slider_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '1',
		),
		$atts
	);

	$id     = $atts['id'];
	$prefix = 'seo_slider_';

	// Get slider settings.
	$dots        = ( get_post_meta( $id, $prefix . 'dots', true ) ? 'true' : 'false' );
	$arrows      = ( get_post_meta( $id, $prefix . 'arrows', true ) ? 'true' : 'false' );
	$loop        = ( get_post_meta( $id, $prefix . 'loop', true ) ? 'true' : 'false' );
	$autoplay    = ( get_post_meta( $id, $prefix . 'autoplay', true ) ? 'true' : 'false' );
	$duration    = get_post_meta( $id, $prefix . 'duration', true );
	$transition  = get_post_meta( $id, $prefix . 'transition', true );
	$image       = get_post_meta( $id, $prefix . 'image', true );
	$content     = get_post_meta( $id, $prefix . 'content', true );
	$overlay     = get_post_meta( $id, $prefix . 'overlay', true );
	$text        = get_post_meta( $id, $prefix . 'text', true );
	$slides      = get_post_meta( $id, $prefix . 'slides', true );

	$js = "
	jQuery( document ).ready( function($) {
		$( '.slick-slider-$id' ).slick( {
			dots: $dots,
			infinite: $loop,
			speed: $transition,
			arrows: $arrows,
			autoplay: $autoplay,
			autoplaySpeed: $duration,
			slidesToShow: 1	,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
					}
				},
				{
					breakpoint: 640,
					settings: {
						slidesToShow: 1,
					}
				}
			]
		} );	
	} );
	";

	$css = "
		.slick-slider-$id,
		.slick-slider-$id p {
			color: $text;
		}
		.slick-slider-$id .slick-overlay {
			background-color: $overlay;
		}
	";

	if ( apply_filters( 'seo_slider_output_js', true ) ) {

		printf( '<script>%s</script>', $js );

	}

	if ( apply_filters( 'seo_slider_output_css', true ) ) {

		printf( '<style>%s</style>', $css );

	}

	?>
	<section class="slick-slider slick-slider-<?php echo $id; ?>" role="banner">

		<?php foreach ( $slides as $slide ) : ?>

		<div class="slick-slide" style="background-image:url('<?php echo $slide['seo_slider_image']; ?>')">

			<div class="slick-overlay"></div>

			<div class="slick-wrap">

			<?php echo wpautop( $slide['seo_slider_content'] ); ?>

			</div>

		</div>

		<?php endforeach; ?>

	</section>

	<?php

}
