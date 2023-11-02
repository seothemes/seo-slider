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
 * @param array $atts Shortcode attributes.
 *
 * @return string
 */
function seo_slider_shortcode( $atts ) {
	$atts = shortcode_atts(
		[
			'id' => 1,
		],
		$atts
	);

	$output     = '';
	$id         = (int) $atts['id'];
	$prefix     = 'seo_slider_';
	$breakpoint = apply_filters( 'seo_slider_breakpoint', 640 );
	$dots       = esc_html( get_post_meta( $id, $prefix . 'dots', true ) ? 'true' : 'false' );
	$arrows     = esc_html( get_post_meta( $id, $prefix . 'arrows', true ) ? 'true' : 'false' );
	$loop       = esc_html( get_post_meta( $id, $prefix . 'loop', true ) ? 'true' : 'false' );
	$autoplay   = esc_html( get_post_meta( $id, $prefix . 'autoplay', true ) ? 'true' : 'false' );
	$effect     = esc_html( get_post_meta( $id, $prefix . 'effect', true ) === 'true' ? 'true' : 'false' );
	$duration   = esc_html( get_post_meta( $id, $prefix . 'duration', true ) );
	$transition = esc_html( get_post_meta( $id, $prefix . 'transition', true ) );
	$mobile     = esc_html( get_post_meta( $id, $prefix . 'mobile', true ) );
	$desktop    = esc_html( get_post_meta( $id, $prefix . 'desktop', true ) );
	$overlay    = esc_html( get_post_meta( $id, $prefix . 'overlay', true ) );
	$text       = esc_html( get_post_meta( $id, $prefix . 'text', true ) );
	$slides     = get_post_meta( $id, $prefix . 'slides', true );

	$js = "
	jQuery( document ).ready( function($) {
		$( '.slick-slider-$id' ).slick( {
			dots: $dots,
			infinite: $loop,
			speed: $transition,
			arrows: $arrows,
			autoplay: $autoplay,
			autoplaySpeed: $duration,
			fade: $effect,
			slidesToShow: 1	,
			slidesToScroll: 1,
			lazyLoad: 'ondemand',
			mobileFirst: true
		} );
	} );
	";

	$css = "
	.slick-slider-$id {
		height: ${mobile}px;
	}
	.slick-slider-$id,
	.slick-slider-$id p,
	.slick-slider-$id h1,
	.slick-slider-$id h2,
	.slick-slider-$id h3,
	.slick-slider-$id h4,
	.slick-slider-$id h5,
	.slick-slider-$id h6,
	.slick-slider-$id li {
		color: $text;
	}
	.slick-slider-$id .slick-overlay {
		background-color: $overlay;
	}
	@media (min-width: ${breakpoint}px) {
		.slick-slider-$id {
			height: ${desktop}px;
		}
	}
	";

	if ( apply_filters( 'seo_slider_output_inline_js', true ) ) {
		$output .= sprintf( '<script>%s</script>', $js );
	} else {
		wp_add_inline_script( seo_slider_get_slug(), $js );
	}

	if ( apply_filters( 'seo_slider_output_inline_css', false ) ) {
		$output .= sprintf( '<style>%s</style>', seo_slider_minify_css( $css ) );
	} else {
		wp_add_inline_style( seo_slider_get_slug(), seo_slider_minify_css( $css ) );
	}

	ob_start();

	do_action( 'seo_slider_before_slider', $id );
	?>

	<section class="slick-slider slick-slider-<?php echo esc_attr( $id ); ?>"
			 role="banner" itemscope itemtype="http://schema.org/ImageGallery">

		<?php $slide_id = 1; ?>

		<?php foreach ( $slides as $slide ) : ?>

			<?php do_action( 'seo_slider_before_slide', $slide ); ?>

			<figure
				class="slick-slide slick-slide-<?php esc_attr_e( $slide_id++ ); ?>"
				itemprop="associatedMedia" itemscope
				itemtype="http://schema.org/ImageObject">

				<?php
				$img_id   = $slide['seo_slider_image_id'] ?? false;
				$img_size = apply_filters( 'seo_slider_image_size', 'slider' );
				$img_html = wp_get_attachment_image( $img_id, $img_size, false, [
					'class'    => 'slick-image',
					'itemprop' => 'image',
				] );
				?>

				<?php if ( isset( $slide['seo_slider_image_id'] ) ) :
					echo apply_filters( 'seo_slider_image_output', $img_html, $img_id, $img_size );
				endif; ?>

				<div class="slick-overlay"></div>

				<?php do_action( 'seo_slider_before_wrap', $slide ); ?>

				<div class="slick-wrap">

					<?php do_action( 'seo_slider_before_content', $slide ); ?>

					<div class="slick-content" itemprop="description">

						<?php if ( isset( $slide['seo_slider_content'] ) ) :
							printf( apply_filters(
								'seo_slider_content_output',
								do_shortcode( wp_kses_post( wpautop( $slide['seo_slider_content'] ) ) ),
								$slide['seo_slider_content']
							) );
						endif; ?>

					</div>

					<?php do_action( 'seo_slider_after_content', $slide ); ?>

				</div>

				<?php do_action( 'seo_slider_after_wrap', $slide ); ?>

			</figure>

			<?php do_action( 'seo_slider_after_slide', $slide ); ?>

		<?php endforeach; ?>

	</section>

	<?php

	do_action( 'seo_slider_after_slider', $id );

	$output .= ob_get_clean();

	return apply_filters( 'seo_slider_output', $output );
}
