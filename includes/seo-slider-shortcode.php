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

	// Shortcode attributes.
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
	$height      = get_post_meta( $id, $prefix . 'height', true );
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
		.slick-slider-$id {
			min-height: ${height}px;
		}
		.slick-slider-$id,
		.slick-slider-$id p {
			color: $text;
		}
		.slick-slider-$id .slick-overlay {
			background-color: $overlay;
		}
	";

	if ( apply_filters( 'seo_slider_output_inline_js', true ) ) {

		printf( '<script>%s</script>', seo_slider_minify_js( $js ) );

	}

	if ( apply_filters( 'seo_slider_output_inline_css', true ) ) {

		printf( '<style>%s</style>', seo_slider_minify_css( $css ) );

	}

	?>

	<?php do_action( 'seo_slider_before_slider' ); ?>

	<section class="slick-slider slick-slider-<?php echo esc_attr( $id ); ?>" role="banner" itemscope itemtype="http://schema.org/ImageGallery">

		<?php foreach ( $slides as $slide ) : ?>

		<?php do_action( 'seo_slider_before_slide' ); ?>

		<figure class="slick-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">

			<?php
			$img_args = array(
				'itemprop' => 'image',
			);
			?>

			<?php echo wp_get_attachment_image( $slide['seo_slider_image_id'], 'full', false, $img_args ); ?>

			<div class="slick-overlay"></div>

			<?php do_action( 'seo_slider_before_wrap' ); ?>

			<div class="slick-wrap" itemprop="description">

				<?php do_action( 'seo_slider_before_content' ); ?>

				<?php echo wp_kses_post( wpautop( $slide['seo_slider_content'] ) ); ?>

				<?php do_action( 'seo_slider_after_content' ); ?>

			</div>

			<?php do_action( 'seo_slider_after_wrap' ); ?>

		</figure>

		<?php do_action( 'seo_slider_after_slide' ); ?>

		<?php endforeach; ?>

	</section>

	<?php do_action( 'seo_slider_after_slider' ); ?>

	<?php

}
