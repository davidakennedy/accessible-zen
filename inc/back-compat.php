<?php
/**
 * Accessible Zen back compat functionality.
 *
 * Prevents Accessible Zen from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backwards compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

/**
 * Prevent switching to Accessible Zen on old versions of WordPress. Switches
 * to the default theme.
 *
 * @since accessiblezen 1.0
 *
 * @return void
 */
function accessiblezen_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'accessiblezen_upgrade_notice' );
}
add_action( 'after_switch_theme', 'accessiblezen_switch_theme' );

/**
 * Prints an update nag after an unsuccessful attempt to switch to
 * Accessible Zen on WordPress versions prior to 3.6.
 *
 * @since accessiblezen 1.0
 *
 * @return void
 */
function accessiblezen_upgrade_notice() {
	$message = sprintf( __( 'Accessible Zen requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'accessiblezen' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since accessiblezen 1.0
 *
 * @return void
 */
function accessiblezen_customize() {
	wp_die( sprintf( __( 'Accessible Zen requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'accessiblezen' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'accessiblezen_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since accessiblezen 1.0
 *
 * @return void
 */
function accessiblezen_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Accessible Zen requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'accessiblezen' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'accessiblezen_preview' );