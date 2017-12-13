<?php
/**
 * This file adds the plugin settings.
 *
 * @package SEO_Slider
 */

add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __DIR__ ) . 'seo-slider.php' ), 'seo_slider_action_links' );
/**
 * Add settings link.
 *
 * @param  array $links Plugin links.
 *
 * @return array
 */
function seo_slider_action_links( $links ) {

	$settings_link = array(
		'<a href="' . admin_url( 'options-general.php?page=seo_slider' ) . '">Settings</a>',
	);

	return array_merge( $links, $settings_link );

}

add_action( 'admin_menu', 'seo_slider_add_admin_menu' );
/**
 * Add settings menu item.
 *
 * @return void
 */
function seo_slider_add_admin_menu() {

	add_options_page( 'SEO Slider', 'SEO Slider', 'manage_options', 'seo_slider', 'seo_slider_options_page' );

}

add_action( 'admin_init', 'seo_slider_settings_init' );
/**
 * Initialize settings.
 *
 * @return void
 */
function seo_slider_settings_init() {

	register_setting( 'seo_slider_setting', 'seo_slider_settings' );

	add_settings_section(
		'seo_slider_section',
		__( 'Settings page for the SEO Slider plugin.', 'seo-slider' ),
		'seo_slider_settings_section_callback',
		'seo_slider_setting'
	);

	add_settings_field(
		'dots',
		__( 'Display navigation dots', 'seo-slider' ),
		'dots_render',
		'seo_slider_setting',
		'seo_slider_section'
	);

	add_settings_field(
		'arrows',
		__( 'Display navigation arrows', 'seo-slider' ),
		'seo_slider_arrows_render',
		'seo_slider_setting',
		'seo_slider_section'
	);

	add_settings_field(
		'loop',
		__( 'Loop', 'seo-slider' ),
		'seo_slider_loop_render',
		'seo_slider_setting',
		'seo_slider_section'
	);

	add_settings_field(
		'autoplay',
		__( 'Autoplay', 'seo-slider' ),
		'seo_slider_autoplay_render',
		'seo_slider_setting',
		'seo_slider_section'
	);

	add_settings_field(
		'speed',
		__( 'Speed (in milliseconds)', 'seo-slider' ),
		'seo_slider_speed_render',
		'seo_slider_setting',
		'seo_slider_section'
	);

	add_settings_field(
		'transition',
		__( 'Transition (in milliseconds)', 'seo-slider' ),
		'transition_render',
		'seo_slider_setting',
		'seo_slider_section'
	);

}

/**
 * Render dots.
 *
 * @return void
 */
function seo_slider_dots_render() {

	$options = get_option( 'seo_slider_settings' );
	?>
	<input type='checkbox' name='seo_slider_settings[dots]' <?php checked( $options['dots'], 1 ); ?> value='1'>
	<?php

}

/**
 * Render arrows.
 *
 * @return void
 */
function seo_slider_arrows_render() {

	$options = get_option( 'seo_slider_settings' );
	?>
	<input type='checkbox' name='seo_slider_settings[arrows]' <?php checked( $options['arrows'], 1 ); ?> value='1'>
	<?php

}

/**
 * Render loop.
 *
 * @return void
 */
function seo_slider_loop_render() {

	$options = get_option( 'seo_slider_settings' );
	?>
	<input type='checkbox' name='seo_slider_settings[loop]' <?php checked( $options['loop'], 1 ); ?> value='1'>
	<?php

}

/**
 * Render autoplay.
 *
 * @return void
 */
function seo_slider_autoplay_render() {

	$options = get_option( 'seo_slider_settings' );
	?>
	<input type='checkbox' name='seo_slider_settings[autoplay]' <?php checked( $options['autoplay'], 1 ); ?> value='1'>
	<?php

}

/**
 * Render radio.
 *
 * @return void
 */
function seo_slider_radio_field_1_render() {

	$options = get_option( 'seo_slider_settings' );
	?>
	<input type='radio' name='seo_slider_settings[seo_slider_radio_field_1]' <?php checked( $options['seo_slider_radio_field_1'], 0 ); ?> value='0' id="false">
	<label for="false">Before title &nbsp;</label>
	<input type='radio' name='seo_slider_settings[seo_slider_radio_field_1]' <?php checked( $options['seo_slider_radio_field_1'], 1 ); ?> value='1' id="true">
	<label for="true">After title</label>
	<?php

}

/**
 * Render select dropdown.
 *
 * @return void
 */
function seo_slider_font_render() {

	$options  = get_option( 'seo_slider_settings' );
	$selected = $options['font'] ? $options['font'] : 'font-awesome';

	?>
	<select name='seo_slider_settings[font]'>
		<option value='font-awesome' <?php selected( $selected, 'font-awesome' ); ?>><?php esc_html_e( 'Font Awesome', 'seo-slider' ); ?></option>
		<option value='line-awesome' <?php selected( $selected, 'line-awesome' ); ?>><?php esc_html_e( 'Line Awesome', 'seo-slider' ); ?></option>
		<option value='ionicons' <?php selected( $selected, 'ionicons' ); ?>><?php esc_html_e( 'Ionicons', 'seo-slider' ); ?></option>
	</select>

<?php

}

/**
 * Render text field.
 *
 * @return void
 */
function seo_slider_speed_render() {

	$options = get_option( 'seo_slider_settings' );
	?>
	<input type='number' name='seo_slider_settings[speed]' value='<?php echo $options['speed']; ?>'>
	<?php

}

/**
 * Render text field.
 *
 * @return void
 */
function seo_slider_transition_render() {
	
	$options = get_option( 'seo_slider_settings' );
	?>
	<input type='number' name='seo_slider_settings[transition]' value='<?php echo $options['transition']; ?>'>
	<?php

}

/**
 * Render textarea.
 *
 * @return void
 */
function seo_slider_textarea_field_4_render() {

	$options = get_option( 'seo_slider_settings' );
	?>
	<textarea cols='40' rows='5' name='seo_slider_settings[seo_slider_textarea_field_4]'> 
		<?php echo $options['seo_slider_textarea_field_4']; ?>
 	</textarea>
	<?php

}

/**
 * Section description.
 *
 * @return void
 */
function seo_slider_settings_section_callback() {

	// Section description.
	echo __( '', 'seo-slider' );

}

/**
 * Display options page.
 *
 * @return void
 */
function seo_slider_options_page() {

	?>
	<div class="wrap">

	<h1>SEO Slider</h1>

	<form action='options.php' method='post'>

		<?php
		settings_fields( 'seo_slider_setting' );
		do_settings_sections( 'seo_slider_setting' );
		submit_button();
		?>

	</form>

	</div>

	<?php

}