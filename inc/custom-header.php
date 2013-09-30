<?php
/**
 * Implements a custom header for Hello Zen.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses accessiblezen_header_style() to style front-end.
 * @uses accessiblezen_admin_header_style() to style wp-admin form.
 * @uses accessiblezen_admin_header_image() to add custom markup to wp-admin form.
 * @uses register_default_headers() to set up the bundled header images.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '',
		'default-image'          => accessiblezen_get_default_header_image(),
		'header-text'            => false,
		'uploads'                => true,

		// Set height and width, with a maximum value for the width.
		'height'                 => 150,
		'width'                  => 150,
		
		// Add flex height and width.
		'flex-width'             => true,
		'flex-height'            => true,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);

	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'accessiblezen_custom_header_setup' );

/**
 * A default header image
 *
 * Use the admin email's gravatar as the default header image.
 * Thanks Konstantin Kovshenin and the Publish theme!
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_get_default_header_image() {

	// Get default from Discussion Settings.
	$default = get_option( 'avatar_default', 'mystery' ); // Mystery man default
	if ( 'mystery' == $default )
		$default = 'mm';
	elseif ( 'gravatar_default' == $default )
		$default = '';

	$url = ( is_ssl() ) ? 'https://secure.gravatar.com' : 'http://gravatar.com';
	$url .= sprintf( '/avatar/%s/', md5( get_option( 'admin_email' ) ) );
	$url = add_query_arg( array(
		's' => 150,
		'd' => urlencode( $default ),
	), $url );

	return esc_url_raw( $url );
} // accessiblezen_get_default_header_image