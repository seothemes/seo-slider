<?php
/**
 * This file registers the settings for the SEO Slider plugin.
 *
 * @package SEOSlider
 */

add_action( 'cmb2_admin_init', 'seo_slider_register_metabox' );
/**
 * Register slider metaboxes.
 *
 * @return void
 */
function seo_slider_register_metabox() {
	$prefix = 'seo_slider_';

	$slides_group = new_cmb2_box( [
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Slides', 'seo-slider' ),
		'object_types' => [ 'slide' ],
	] );

	$group_field_id = $slides_group->add_field( [
		'id'          => $prefix . 'slides',
		'type'        => 'group',
		'description' => '',
		'options'     => [
			'group_title'   => __( 'Slide {#}', 'seo-slider' ),
			'add_button'    => __( 'Add Slide', 'seo-slider' ),
			'remove_button' => __( 'Remove Slide', 'seo-slider' ),
			'sortable'      => true,
		],
	] );

	$slides_group->add_group_field( $group_field_id, [
		'name'         => __( 'Image', 'seo-slider' ),
		'id'           => $prefix . 'image',
		'type'         => 'file',
		'preview_size' => 'thumbnail',
	] );

	$slides_group->add_group_field( $group_field_id, [
		'name'            => __( 'Content', 'seo-slider' ),
		'id'              => $prefix . 'content',
		'type'            => 'wysiwyg',
		'options'         => [
			'textarea_rows' => get_option( 'default_post_edit_rows', 12 ),
		],
		'sanitization_cb' => apply_filters( 'seo_slider_wysiwyg_sanitization', 'wp_kses_post' ),
	] );

	$slider_settings = new_cmb2_box( [
		'id'           => $prefix . 'settings',
		'title'        => __( 'Slider Settings', 'seo-slider' ),
		'object_types' => [ 'slide' ],
		'context'      => 'side',
		'priority'     => 'default',
		'show_names'   => true,
	] );

	$slider_settings->add_field( [
		'name'    => __( 'Overlay color', 'seo-slider' ),
		'id'      => $prefix . 'overlay',
		'type'    => 'colorpicker',
		'default' => apply_filters( 'seo_slider_default_overlay', 'rgba(10,20,30,0.2)' ),
		'options' => [
			'alpha' => true,
		],
	] );

	$slider_settings->add_field( [
		'name'    => __( 'Text color', 'seo-slider' ),
		'id'      => $prefix . 'text',
		'type'    => 'colorpicker',
		'default' => apply_filters( 'seo_slider_default_text', '#ffffff' ),
		'options' => [
			'alpha' => true,
		],
	] );

	$slider_settings->add_field( [
		'name' => 'Display settings',
		'desc' => '',
		'id'   => $prefix . 'display',
		'type' => 'title',
	] );

	$slider_settings->add_field( [
		'name'    => '',
		'desc'    => 'Display dots',
		'id'      => $prefix . 'dots',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	] );

	$slider_settings->add_field( [
		'name'    => '',
		'desc'    => 'Display arrows',
		'id'      => $prefix . 'arrows',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	] );

	$slider_settings->add_field( [
		'name'    => '',
		'desc'    => 'Loop slider',
		'id'      => $prefix . 'loop',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	] );

	$slider_settings->add_field( [
		'name'    => '',
		'desc'    => 'Enable autoplay',
		'id'      => $prefix . 'autoplay',
		'type'    => 'checkbox',
		'default' => seo_slider_set_checkbox_default( true ),
	] );

	$slider_settings->add_field( [
		'name'    => 'Effect',
		'desc'    => '',
		'id'      => $prefix . 'effect',
		'type'    => 'radio_inline',
		'default' => 'slide',
		'options' => [
			'false' => __( 'Slide', 'cmb2' ),
			'true'  => __( 'Fade', 'cmb2' ),
		],
	] );

	$slider_settings->add_field( [
		'name'       => __( 'Duration (ms)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'duration',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_duration', '5000' ),
		'attributes' => [
			'type'    => 'number',
			'pattern' => '\d*',
		],
	] );

	$slider_settings->add_field( [
		'name'       => __( 'Transition (ms)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'transition',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_transition', '1000' ),
		'attributes' => [
			'type'    => 'number',
			'pattern' => '\d*',
		],
	] );

	$slider_settings->add_field( [
		'name'       => __( 'Height mobile (px)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'mobile',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_height', '600' ),
		'attributes' => [
			'type'    => 'number',
			'pattern' => '\d*',
		],
	] );

	$slider_settings->add_field( [
		'name'       => __( 'Height desktop (px)', 'seo-slider' ),
		'desc'       => '',
		'id'         => $prefix . 'desktop',
		'type'       => 'text',
		'default'    => apply_filters( 'seo_slider_default_height', '600' ),
		'attributes' => [
			'type'    => 'number',
			'pattern' => '\d*',
		],
	] );

	$slider_settings->add_field( [
		'name'       => __( 'Shortcode', 'seo-slider' ),
		'id'         => $prefix . 'shortcode',
		'type'       => 'text',
		'column'     => [
			'position' => 2,
			'name'     => 'Shortcode',
		],
		'attributes' => [
			'readonly' => '',
			'onClick'  => 'this.select();',
		],
		'default_cb' => 'seo_slider_set_shortcode_id',
	] );
}

/**
 * Only return default value if we don't have a post ID (in the 'post' query variable).
 *
 * @param  bool $default On/Off (true/false).
 *
 * @return mixed
 */
function seo_slider_set_checkbox_default( $default ) {
	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

/**
 * Set post ID for shortcode.
 *
 * @param  array      $args  Field args.
 * @param  CMB2_Field $field Field object.
 *
 * @return string
 */
function seo_slider_set_shortcode_id( $args, $field ) {
	return sprintf( '[slider id="%s"]', $field->args['attributes']['data-postid'] = $field->object_id );
}
