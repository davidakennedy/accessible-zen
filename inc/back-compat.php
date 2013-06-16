<?php
/**
 * Hello Zen back compat functionality.
 *
 * Prevents Hello Zen from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backwards compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Hello Zen 1.0
 */

/**
 * Prevent switching to Hello Zen on old versions of WordPress. Switches
 * to the default theme.
 *
 * @since Hello Zen 1.0
 *
 * @return void
 */
function hellozen_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'hellozen_upgrade_notice' );
}
add_action( 'after_switch_theme', 'hellozen_switch_theme' );

/**
 * Prints an update nag after an unsuccessful attempt to switch to
 * Hello Zen on WordPress versions prior to 3.6.
 *
 * @since Hello Zen 1.0
 *
 * @return void
 */
function hellozen_upgrade_notice() {
	$message = sprintf( __( 'Hello Zen requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'hellozen' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since Hello Zen 1.0
 *
 * @return void
 */
function hellozen_customize() {
	wp_die( sprintf( __( 'Hello Zen requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'hellozen' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'hellozen_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since Hello Zen 1.0
 *
 * @return void
 */
function hellozen_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Hello Zen requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'hellozen' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'hellozen_preview' );