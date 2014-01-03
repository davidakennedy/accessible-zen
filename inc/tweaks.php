<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'accessiblezen_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function accessiblezen_footer_sidebar_class() {
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
 * Add body classes for custom background options
 */
function accessiblezen_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();
	
		if ( empty( $background_color ) && empty( $background_image )  )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	return $classes;
}
add_filter( 'body_class', 'accessiblezen_body_class' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'accessiblezen_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function accessiblezen_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'accessiblezen_wp_title', 10, 2 );

/**
 * Sets the post excerpt length to 100 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function accessiblezen_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'accessiblezen_excerpt_length' );

if ( ! function_exists( 'accessiblezen_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 */
function accessiblezen_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . ('Continue reading ' . the_title('', '', false) . '' . '</a>');
}
endif; // accessiblezen_continue_reading_link

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and accessiblezen_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function accessiblezen_auto_excerpt_more( $more ) {
	return ' &hellip;' . accessiblezen_continue_reading_link();
}
add_filter( 'excerpt_more', 'accessiblezen_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function accessiblezen_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= accessiblezen_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'accessiblezen_custom_excerpt_more' );

/**
 * Return the URL for the first link found in the post content.
 *
 * @since accessiblezen 1.0
 * @return string|bool URL or false when no link is present.
 */
function accessiblezen_get_link_url() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}