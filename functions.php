<?php
/**
 * accessiblezen functions and definitions.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since accessiblezen 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 768; /* pixels */

if ( ! function_exists( 'accessiblezen_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_setup() {

	/**
	 * Accessible Zen only works in WordPress 3.6 or later.
	 */
	if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
		require get_template_directory() . '/inc/back-compat.php';
	
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
	 * If you're building a theme based on accessiblezen, use a find and replace
	 * to change 'accessiblezen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'accessiblezen', get_template_directory() . '/languages' );
	
	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	 */
	add_editor_style( 'css/editor-style.css' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/** This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style('css/editor-style.css');
	
	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 768, 150, true );

	/**
	 * This theme uses wp_nav_menu() in two locations.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'accessiblezen' ),
		'secondary' => __( 'Secondary Menu', 'accessiblezen' )
	) );

	/*
	 * Add support for all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => '',
	) );
}
endif; // accessiblezen_setup
add_action( 'after_setup_theme', 'accessiblezen_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Widget Area One', 'accessiblezen' ),
		'id' => 'sidebar-1',
		'description'   => 'A widget area for the left side of the footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area Two', 'accessiblezen' ),
		'id' => 'sidebar-2',
		'description'   => 'A widget area for the right side of the footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'accessiblezen_widgets_init' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Noticia Text by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since accessiblezen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function accessiblezen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$merriweather_sans = _x( 'on', 'Merriweather Sans font: on or off', 'accessiblezen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$merriweather = _x( 'on', 'Merriweather font: on or off', 'accessiblezen' );

	if ( 'off' !== $merriweather_sans || 'off' !== $merriweather ) {
		$font_families = array();

		if ( 'off' !== $merriweather_sans )
			$font_families[] = 'Merriweather+Sans:400,700,400italic,700italic';

		if ( 'off' !== $merriweather )
			$font_families[] = 'Merriweather:400,700,400italic,700italic';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin',
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses accessiblezen_fonts_url() to get the Google Font stylesheet URL.
 *
 * @since accessiblezen 1.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string The filtered CSS paths list.
 */
function accessiblezen_mce_css( $mce_css ) {
	$fonts_url = accessiblezen_fonts_url();

	if ( empty( $fonts_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $fonts_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'accessiblezen_mce_css' );

/**
 * Enqueue scripts and styles
 */
function accessiblezen_scripts_styles() {
	global $wp_styles;

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
    $fonts_url = accessiblezen_fonts_url();
	if ( ! empty( $fonts_url ) )
		wp_enqueue_style( 'accessiblezen-fonts', esc_url_raw( $fonts_url ), array(), null );
		
	// Loads the icon fonts stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/font/genericons.css', array(), '3.0.2' );
        
    wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'accessiblezen_scripts_styles' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
