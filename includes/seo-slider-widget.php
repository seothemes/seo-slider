<?php
/**
 * This file registers the `[seo_slider]` shortcode.
 *
 * @package SEOSlider
 */

/**
 * Widget class.
 */
class SEO_Slider_Widget extends WP_Widget {

	/**
	 * Sets up the widget.
	 *
	 * @return void
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'seo_slider_widget',
			'description' => 'Displays the SEO Slider in a widget',
		);

		parent::__construct( 'seo_slider_widget', 'SEO Slider Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param  array $args     Widget args.
	 * @param  array $instance Widget instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {

			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

		}

		echo esc_html__( 'Hello, World!', 'seo-slider' );
		echo $args['after_widget'];

	}

	/**
	 * Outputs the options form on admin.
	 *
	 * @param  array $instance The widget options.
	 * @return void
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'seo-slider' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Processes widget options on save.
	 *
	 * @param  array $new_instance The new options.
	 * @param  array $old_instance The previous options.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		foreach ( $new_instance as $key => $value ) {

			$updated_instance[$key] = sanitize_text_field( $value );

		}

		return $updated_instance;

	}

}

// Register the widget.
add_action( 'widgets_init', function() { 
	register_widget( 'SEO_Slider_Widget' );
} );
