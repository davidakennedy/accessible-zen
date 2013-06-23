<?php
/**
 * Zen Hacker Theme Customizer
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
}
add_action( 'customize_register', 'accessiblezen_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_customize_preview_js() {
	wp_enqueue_script( 'accessiblezen_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'accessiblezen_customize_preview_js' );