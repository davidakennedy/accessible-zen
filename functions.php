<?php
/**
 * ZH functions and definitions
 *
 * @package ZH
 * @since ZH 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since ZH 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'zh_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since ZH 1.0
 */
function zh_setup() {

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
	 * If you're building a theme based on ZH, use a find and replace
	 * to change 'zh' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'zh', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', 'zh' ),
		'secondary' => __( 'Secondary Menu', 'zh' )
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
endif; // zh_setup
add_action( 'after_setup_theme', 'zh_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since ZH 1.0
 */
function zh_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Widget Area One', 'zh' ),
		'id' => 'sidebar-1',
		'description'   => 'A widget area for the left side of the footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Two', 'zh' ),
		'id' => 'sidebar-2',
		'description'   => 'A widget area for the right side of the footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
}
add_action( 'widgets_init', 'zh_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function zh_footer_sidebar_class() {
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

/**
 * Enqueue scripts and styles
 */
function zh_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_style(
        'font_stylesheet', # replace with a name for your font stylesheet
        'http://fonts.googleapis.com/css?family=Raleway' # replace with url to your font stylesheet
    );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'zh_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
