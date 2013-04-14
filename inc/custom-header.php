<?php
/**
 * Implements a custom header for Zen Hacker.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage hellozen
 * @since Zen Hacker 1.0
 */

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses hellozen_header_style() to style front-end.
 * @uses hellozen_admin_header_style() to style wp-admin form.
 * @uses hellozen_admin_header_image() to add custom markup to wp-admin form.
 * @uses register_default_headers() to set up the bundled header images.
 *
 * @since Zen Hacker 1.0
 */
function hellozen_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '54413b',
		'default-image'          => '%s/img/headers/circle.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 200,
		'width'                  => 768,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'hellozen_header_style',
		'admin-head-callback'    => 'hellozen_admin_header_style',
		'admin-preview-callback' => 'hellozen_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'circle' => array(
			'url'           => '%s/img/headers/circle.png',
			'thumbnail_url' => '%s/img/headers/circle-thumbnail.png',
			'description'   => _x( 'Circle', 'header image description', 'hellozen' )
		),
		'diamond' => array(
			'url'           => '%s/img/headers/diamond.png',
			'thumbnail_url' => '%s/img/headers/diamond-thumbnail.png',
			'description'   => _x( 'Diamond', 'header image description', 'hellozen' )
		),
		'star' => array(
			'url'           => '%s/img/headers/star.png',
			'thumbnail_url' => '%s/img/headers/star-thumbnail.png',
			'description'   => _x( 'Star', 'header image description', 'hellozen' )
		),
	) );
}
add_action( 'after_setup_theme', 'hellozen_custom_header_setup' );

/**
 * Styles the header text displayed on the blog.
 *
 * get_header_textcolor() options: Hide text (returns 'blank'), or any hex value.
 *
 * @since Zen Hacker 1.0
 */
function hellozen_header_style() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css">
	<?php
		if ( ! empty( $header_image ) ) :
	?>
		.site-banner {
			background: url("<?php header_image(); ?>") no-repeat center;
			background-size: 48em auto;
			min-height: 12.5em;
		}
	<?php
		endif;

		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
			if ( empty( $header_image ) ) :
	?>
		.site-header hgroup {
			min-height: 0;
		}
	<?php
			endif;

		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $text_color ); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Zen Hacker 1.0
 */
function hellozen_admin_header_style() {
	$header_image = get_header_image();
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'background: url("' . esc_url( $header_image ) . '") no-repeat scroll top; background-size: 48em auto;';
		} ?>
		padding: 0 2em;
	}
	#headimg .hgroup {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 48em;
		<?php
		if ( ! empty( $header_image ) || display_header_text() ) {
			echo 'min-height: 200px;';
		} ?>
		text-align: center;
		width: 100%;
	}
	<?php if ( ! display_header_text() ) : ?>
	#headimg h1,
	#headimg h2 {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php endif; ?>
	#headimg h1 {
		font: 46px/1.5 'Raleway', Tahoma, Arial, sans-serif;
		margin: 0;
		padding: 45px 0 0;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#headimg h1 a:hover {
		text-decoration: underline;
	}
	#headimg h2 {
		font: 20px/1.5 'Raleway', Tahoma, Arial, sans-serif;
		margin: 0;
	}
	.default-header img {
		max-width: 48em;
		width: auto;
	}
	</style>
<?php
}

/**
 * Outputs markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 *
 * @since Twenty Thirteen 1.0
 */
function hellozen_admin_header_image() {
	?>
	<div id="headimg" style="background: url('<?php esc_url( header_image() ); ?>') no-repeat scroll top; background-size: 768px auto;">
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="hgroup">
			<h1><a id="name"<?php echo $style; ?> href="#"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div>
<?php }
