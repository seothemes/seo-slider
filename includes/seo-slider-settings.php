<?php
/**
 * This file registers the settings for the SEO Slider plugin.
 *
 * @package SEOSlider
 */

add_action( 'cmb2_admin_init', 'seo_slider_register_metabox' );
/**
 * Register slider metaboxes.
 */
function seo_slider_register_metabox() {

	// Field prefix.
	$prefix = 'seo_slider_';

	/**
	 * Repeatable Field Groups.
	 *
	 * Displays in the main context of the Edit Slider screen. The
	 * parent field's id needs to be passed as the first argument.
	 */
	$slides_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Slides', 'seo-slider' ),
		'object_types' => array( 'slide' ),
	) );

	// Add slides repeater field.
	$group_field_id = $slides_group->add_field( array(
		'id'          => $prefix . 'slides',
		'type'        => 'group',
		'description' => '',
		'options'     => array(
			'group_title'   => __( 'Slide {#}', 'seo-slider' ),
			'add_button'    => __( 'Add Slide', 'seo-slider' ),
			'remove_button' => __( 'Remove Slide', 'seo-slider' ),
			'sortable'      => true,
		),
	) );

	// Add image field to slides repeater field.
	$slides_group->add_group_field( $group_field_id, array(
		'name'         => __( 'Image', 'seo-slider' ),
		'id'           => $prefix . 'image',
		'type'         => 'file',
		'preview_size' => 'thumbnail',
	) );

	// Add content field to slides repeater field.
	$slides_group->add_group_field( $group_field_id, array(
		'name'            => __( 'Content', 'seo-slider' ),
		'id'              => $prefix . 'content',
		'type'            => 'wysiwyg',
		'options'         => array(
			'textarea_rows' => get_option( 'default_post_edit_rows', 12 ),
		),
		'sanitization_cb' => apply_filters( 'seo_slider_wysiwyg_sanitization', 'wp_kses_post' ),
	) );

	/**
	 * Initiate the metabox for slider settings.
	 *
	 * Displays in the side context of the Edit Slider screen.
	 */
	$slider_settings = new_cmb2_box( array(
		'id'           => $prefix . 'settings',
		'title'        => __( 'Slider Settings', 'seo-slider' ),
		'object_types' => array( 'slide' ),
		'context'      => 'side',
		'priority'     => 'default',
		'show_names'   => true,
	) );

	// Add overlay color field.
	$slider_settings->add_field( array(
		'name'    => __( 'Overlay color', 'seo-slider' ),
		'id'      => $prefix . 'overlay',
		'type'    => 'colorpicker',
		'default' => apply_filters( 'seo_slider_default_overlay', 'rgba(10,20,30,0.2)' ),
		'options' => array(
			'alpha' => true,
		),
	) );

	// Add text color field.
	$slider_settings->add_field( array(
		'name'    => __( 'Text color', 'seo-slider' ),
		'id'      => $prefix . 'text',
		'type'    => 'colorpicker',
		'default' => apply_filters( 'seo_slider_default_text', '#ffffff' ),
		'options' => array(
			'alpha' => true,
		),
	) );

	// Add title field.
	$slider_settings->add_field( array(
		'name' => 'Display settings',
		'desc' => '',
		'id'   => $prefix . 'display',
		'type' => 'title',
	) );

	// Add dots field.
	$slider_settings->add_field( array(
		'name'    => '',
		'desc'    => 'Display dots',
		'id'      => $prefix . 'dots',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	) );

	// Add arrows field.
	$slider_settings->add_field( array(
		'name'    => '',
		'desc'    => 'Display arrows',
		'id'      => $prefix . 'arrows',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	) );

	// Add loop field.
	$slider_settings->add_field( array(
		'name'    => '',
		'desc'    => 'Loop slider',
		'id'      => $prefix . 'loop',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	) );

	// Add autoplay field.
	$slider_settings->add_field( array(
		'name'    => '',
		'desc'    => 'Enable autoplay',
		'id'      => $prefix . 'autoplay',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	) );

	// Add fade field.
	$slider_settings->add_field( array(
		'name'    => 'Effect',
		'desc'    => '',
		'id'      => $prefix . 'effect',
		'type'    => 'radio_inline',
		'default' => 'slide',
		'options' => array(
			'false' => __( 'Slide', 'cmb2' ),
			'true'  => __( 'Fade', 'cmb2' ),
		),
	) );

	// Add duration field.
	$slider_settings->add_field( array(
		'name'       => __( 'Duration (ms)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'duration',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_duration', '5000' ),
		'attributes' => array(
			'type'    => 'number',
			'pattern' => '\d*',
		),
	) );

	// Add transition field.
	$slider_settings->add_field( array(
		'name'       => __( 'Transition (ms)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'transition',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_transition', '1000' ),
		'attributes' => array(
			'type'    => 'number',
			'pattern' => '\d*',
		),
	) );

	// Add height field.
	$slider_settings->add_field( array(
		'name'       => __( 'Height mobile (px)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'mobile',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_height', '600' ),
		'attributes' => array(
			'type'    => 'number',
			'pattern' => '\d*',
		),
	) );

	// Add height field.
	$slider_settings->add_field( array(
		'name'       => __( 'Height desktop (px)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'desktop',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_height', '600' ),
		'attributes' => array(
			'type'    => 'number',
			'pattern' => '\d*',
		),
	) );

	// Add shortcode field.
	$slider_settings->add_field( array(
		'name'       => __( 'Shortcode', 'seo-slider' ),
		'id'         => $prefix . 'shortcode',
		'type'       => 'text',
		'column'     => array(
			'position' => 2,
			'name'     => 'Shortcode',
		),
		'attributes' => array(
			'readonly' => '',
			'onClick'  => 'this.select();',
		),
		'default_cb' => 'seo_slider_set_shortcode_id',
	) );

}

/**
 * Only return default value if we don't have a post ID (in the 'post' query variable).
 *
 * @param  bool $default On/Off (true/false).
 *
 * @return mixed Returns true or '', the blank default.
 */
function seo_slider_set_checkbox_default( $default ) {

	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );

}

/**
 * Set post ID for shortcode.
 *
 * @param  array $args  Field args.
 * @param  array $field Field object.
 *
 * @return string
 */
function seo_slider_set_shortcode_id( $args, $field ) {

	$id = $field->args['attributes']['data-postid'] = $field->object_id;

	return sprintf( '[slider id="%s"]', $id );

}
