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
 *
 * @return string
 */
function seo_slider_shortcode( $atts ) {

	// Shortcode attributes.
	$atts = shortcode_atts(
		[
			'id' => '1',
		],
		$atts
	);

	// Shortcode markup.
	$output = '';
	$schema = apply_filters( 'seo_slider_schema', [
		'gallery' => ' itemscope itemtype="http://schema.org/ImageGallery"',
		'object'  => ' itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"',
		'content' => ' itemprop="description"',
		'image'   => [
			'class'    => 'slick-image',
			'itemprop' => 'image',
		],
	] );

	if ( defined( 'WPSEO_VERSION' ) ) {
		$schema = [
			'gallery' => '',
			'object'  => '',
			'content' => '',
			'image'   => [
				'class' => 'slick-image',
			],
		];
	}

	// Slider variables.
	$id         = $atts['id'];
	$prefix     = 'seo_slider_';
	$breakpoint = apply_filters( 'seo_slider_breakpoint', 640 );

	// Get slider settings.
	$dots       = ( get_post_meta( $id, $prefix . 'dots', true ) ? 'true' : 'false' );
	$arrows     = ( get_post_meta( $id, $prefix . 'arrows', true ) ? 'true' : 'false' );
	$loop       = ( get_post_meta( $id, $prefix . 'loop', true ) ? 'true' : 'false' );
	$autoplay   = ( get_post_meta( $id, $prefix . 'autoplay', true ) ? 'true' : 'false' );
	$effect     = ( get_post_meta( $id, $prefix . 'effect', true ) === 'true' ? 'true' : 'false' );
	$duration   = get_post_meta( $id, $prefix . 'duration', true );
	$transition = get_post_meta( $id, $prefix . 'transition', true );
	$mobile     = get_post_meta( $id, $prefix . 'mobile', true );
	$desktop    = get_post_meta( $id, $prefix . 'desktop', true );
	$image      = get_post_meta( $id, $prefix . 'image', true );
	$content    = get_post_meta( $id, $prefix . 'content', true );
	$overlay    = get_post_meta( $id, $prefix . 'overlay', true );
	$text       = get_post_meta( $id, $prefix . 'text', true );
	$slides     = get_post_meta( $id, $prefix . 'slides', true );

	// Build JS.
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

	// Build CSS.
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
		$output .= sprintf( '<script>%s</script>', seo_slider_minify_js( $js ) );
	}

	if ( apply_filters( 'seo_slider_output_inline_css', true ) ) {
		$output .= sprintf( '<style>%s</style>', seo_slider_minify_css( $css ) );
	}

	ob_start();

	do_action( 'seo_slider_before_slider' );
	?>

	<section class="slick-slider slick-slider-<?php echo esc_attr( $id ); ?>" role="banner"<?php echo $schema['gallery']; ?>>

		<?php $slide_id = 1; ?>

		<?php foreach ( $slides as $slide ) : ?>

			<?php do_action( 'seo_slider_before_slide' ); ?>

			<figure class="slick-slide slick-slide-<?php esc_attr_e( $slide_id++ ); ?>"<?php echo $schema['object']; ?>>

				<?php
				$img_size = apply_filters( 'seo_slider_image_size', 'slider' );
				$img_atts = apply_filters( 'seo_slider_image_args', $schema['image'] );
				?>

				<?php if ( isset( $slide['seo_slider_image_id'] ) ) :
					echo wp_get_attachment_image( $slide['seo_slider_image_id'], $img_size, false, $img_atts );
				endif; ?>

				<div class="slick-overlay"></div>

				<?php do_action( 'seo_slider_before_wrap' ); ?>

				<div class="slick-wrap">

					<?php do_action( 'seo_slider_before_content' ); ?>

					<div class="slick-content"<?php echo $schema['content']; ?>>

						<?php if ( isset( $slide['seo_slider_content'] ) ) :
							echo do_shortcode( wp_kses_post( wpautop( $slide['seo_slider_content'] ) ) );
						endif; ?>

					</div>

					<?php do_action( 'seo_slider_after_content' ); ?>

				</div>

				<?php do_action( 'seo_slider_after_wrap' ); ?>

			</figure>

			<?php do_action( 'seo_slider_after_slide' ); ?>

		<?php endforeach; ?>

	</section>

	<?php

	do_action( 'seo_slider_after_slider' );

	$output .= ob_get_clean();

	return apply_filters( 'seo_slider_output', $output );
}
