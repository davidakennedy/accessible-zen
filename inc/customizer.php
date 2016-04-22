<?php
/**
 * Accessible Zen Theme Customizer.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

	// Hide the site/blog description
	$wp_customize->add_setting( 'displayblogname', array(
		'sanitize_callback' => 'displayblogname_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'displayblogname', array(
		'label'	=> esc_html__( 'Hide Site Tagline', 'accessible-zen' ),
		'section'  => 'title_tagline',
		'settings' => 'displayblogname',
		'type'	 => 'checkbox',
	) ) );

	function displayblogname_sanitize_checkbox( $displayblognameinput ) {
		if ( $displayblognameinput == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// Choose excerpt or full content on blog
	$wp_customize->add_section( 'accessiblezen_layout_section' , array(
		'title' => esc_html__( 'Content', 'accessible-zen' ),
		'priority' => 30,
		'description' => esc_html__( 'Change how Accessible Zen displays posts', 'accessible-zen' ),
	) );

	$wp_customize->add_setting( 'accessiblezen_post_content', array(
		'default'	=> 'option2',
		'sanitize_callback' => 'accessiblezen_post_content_sanitize_radio_buttons',
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'accessiblezen_post_content', array(
		'label'	=> esc_html__( 'Post content', 'accessible-zen' ),
		'section'	=> 'accessiblezen_layout_section',
		'settings'	=> 'accessiblezen_post_content',
		'type'	=> 'radio',
		'choices'	=> array(
			'option1'	=> esc_html__( 'Excerpts', 'accessible-zen' ),
			'option2'	=> esc_html__( 'Full content', 'accessible-zen' ),
		),
	) ) );

	function accessiblezen_post_content_sanitize_radio_buttons( $postcontentinput ) {
		$valid = array(
			'option1'	=> 'Excerpts',
			'option2'	=> 'Full content',
		);

		if ( array_key_exists( $postcontentinput, $valid ) ) {
			return $postcontentinput;
		} else {
			return '';
		}
	}

	// Show more posts link on Front Page template
	$wp_customize->add_setting(
		'show_more_posts_link', array(
			'default' => null,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'accessiblezen_sanitize_dropdown_integer',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control( $wp_customize, 'show_more_posts_link', array(
			'label' => esc_html__( 'Link to this page in Read More Posts on Front Page Template', 'accessible-zen' ),
			'section' => 'static_front_page',
			'type'	   => 'dropdown-pages',
			'settings' => 'show_more_posts_link',
		) )
	);

	function accessiblezen_sanitize_dropdown_integer( $dropdownintegerinput ) {
		if ( is_numeric( $dropdownintegerinput ) ) {
			return intval( $dropdownintegerinput );
		}
	}

}
add_action( 'customize_register', 'accessiblezen_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_customize_preview_js() {
	wp_enqueue_script( 'accessiblezen_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'accessiblezen_customize_preview_js' );

/**
 * Load extra jQuery script to theme customizer page to toggle options.
 *
 * @since Accessible Zen 1.0
 */
function modify_customize_preview_page_script() {
	wp_enqueue_script( 'modify-customize-preview-page-script', get_template_directory_uri() . '/js/modify-customize-preview-page.js',
		array( 'jquery' ), '20120827', true );
}
// Action will load script to customizer.php only.
add_action( 'customize_controls_print_footer_scripts', 'modify_customize_preview_page_script' );

/**
 * Add contextual help to the Themes screens.
 *
 * @since Accessible Zen 1.0
 *
 * @return void
 */
function accessiblezen_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'	  => 'accessiblezen',
		'title'   => esc_html__( 'Accessible Zen', 'accessible-zen' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( wp_kses( __( 'Accessible Zen uses the WordPress Theme Customizer to allow you to adjust several settings, including showing/hiding the site tagline, displaying post excerpts and much more. Get started customizing the theme under <a href="%s">Appearance &rarr; Customize</a>.', 'accessible-zen' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'customize.php' ) ) ) . '</li>' .
				'<li>' . sprintf( wp_kses( __( 'If you have questions about the theme, want to suggest a new feature or need support, visit the <a href="%s">Accessible Zen support forum</a>.', 'accessible-zen' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( 'http://wordpress.org/support/theme/accessible-zen' ) ) . '</li>' .
				'<li>' . sprintf( wp_kses( __( 'For in-depth documentation on Accessible Zen, see the file bundled with the theme called <code>accessible-zen-documentation</code>, or view it <a href="%s">in the Github repository</a>.', 'accessible-zen' ), array( 'a' => array( 'href' => array() ), 'code' => array() ) ), esc_url( 'https://github.com/davidakennedy/accessible-zen/blob/master/accessible-zen-documentation.txt' ) ) . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'accessiblezen_contextual_help' );
