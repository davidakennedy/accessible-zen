<?php
/**
 * hellozen functions and definitions
 *
 * @package hellozen
 * @since hellozen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since hellozen 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 768; /* pixels */

if ( ! function_exists( 'hellozen_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since hellozen 1.0
 */
function hellozen_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );
	
	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on hellozen, use a find and replace
	 * to change 'hellozen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hellozen', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/** This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();
	
	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in two locations.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hellozen' ),
		'secondary' => __( 'Secondary Menu', 'hellozen' )
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
	
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => '',
	) );
}
endif; // hellozen_setup
add_action( 'after_setup_theme', 'hellozen_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since hellozen 1.0
 */
function hellozen_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Widget Area One', 'hellozen' ),
		'id' => 'sidebar-1',
		'description'   => 'A widget area for the left side of the footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Two', 'hellozen' ),
		'id' => 'sidebar-2',
		'description'   => 'A widget area for the right side of the footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'hellozen_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function hellozen_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-1' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one sidebar cf';
			break;
		case '2':
			$class = 'two sidebar cf';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

function hellozen_body_class( $classes ) {
	$background_color = get_background_color();
	
		if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	return $classes;
}
add_filter( 'body_class', 'hellozen_body_class' );

/**
 * Enqueue scripts and styles
 */
function hellozen_scripts_styles() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_style(
        'font_stylesheet',
        'http://fonts.googleapis.com/css?family=Cardo|Noticia+Text:400,400italic,700,700italic'
    );
        
    wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'hellozen_scripts_styles' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
