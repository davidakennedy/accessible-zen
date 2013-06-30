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
	$wp_customize->get_setting('displayblogname')->transport='postMessage';
	
	// Hide the site/blog description
	$wp_customize->add_setting( 'displayblogname', array(
		'default'	=> '1',
		'sanitize_callback' => 'displayblogname_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'displayblogname', array(
	'label'	=> __( 'Display Site Tagline', 'accessiblezen' ),
	'section'    => 'title_tagline',
	'settings'	=> 'displayblogname',
	'type'     => 'checkbox',
) ) );

function displayblogname_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

    // Choose excerpt or full content on blog
    $wp_customize->add_section( 'accessiblezen_layout_section' , array(
		'title' => __( 'Content', 'accessiblezen' ),
		'priority' => 30,
		'description' => 'Change how Accessible Zen displays posts',
		) );
		$wp_customize->add_setting( 'accessiblezen_post_content', array(
		'default'	=> 'option1',
		'sanitize_callback' => 'accessiblezen_post_content_sanitize_radio_buttons',
		'capability' => 'edit_theme_options',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'debut_post_content', array(
		'label'	=> __( 'Post content', 'accessiblezen' ),
		'section'	=> 'accessiblezen_layout_section',
		'settings'	=> 'accessiblezen_post_content',
		'type'	=> 'radio',
		'choices'	=> array(
		'option1'	=> 'Excerpts',
		'option2'	=> 'Full content',
		),
) ) );

function accessiblezen_post_content_sanitize_radio_buttons( $input ) {
    $valid = array(
        'option1'	=> 'Excerpts',
		'option2'	=> 'Full content',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

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