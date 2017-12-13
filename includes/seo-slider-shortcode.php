<?php
/**
 * This file registers the [slider] shortcode.
 *
 * @package SEOSlider
 */

/**
 * Add shortcode.
 *
 * @param  array $atts Shortcode attributes.
 * @return void
 */
function seo_slider_shortcode( $atts ) {

	$terms = get_terms( 'slider', array(
		'hide_empty' => 0,
		'fields'     => 'ids',
	) );

	$atts = shortcode_atts(
		array(
			'post_type'      => 'slide',
			'posts_per_page' => '5',
			'tax_query'      => array(
				array(
					'taxonomy' => 'slider',
					'field'    => 'ids',
					'terms'    => $terms,
				),
			),
		),
		$atts,
		'slider'
	);

	// Loop through slides.
	$query = new WP_Query( $atts );

	ob_start();

	if ( $query->have_posts() ) :

		echo '<section class="slick-slider" role="banner">';

		while ( $query->have_posts() ) :

			$query->the_post();

			?>
			<div class="slick-slide" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">

				<div class="wrap container">

				<?php $markup = '<h2 class="slide-title">%s</h2>'; ?>

					<?php echo apply_filters( 'seo_slider_title_markup', sprintf( $markup, get_the_title() ) ); ?>

					<?php the_content(); ?>

				</div>

				</figcaption>

			</div>
			<?php

		endwhile;

		echo '</section>';

	endif;

	$slider = ob_get_clean();

	// Reset query.
	wp_reset_query();

	return $slider;


}
add_shortcode( 'slider', 'seo_slider_shortcode' );
