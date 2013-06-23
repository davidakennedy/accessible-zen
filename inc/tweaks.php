<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package hellozen
 * @since hellozen 1.0
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since hellozen 1.0
 */
function hellozen_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'hellozen_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since hellozen 1.0
 */
function hellozen_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

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

/**
 * Add body classes for custom background options
 */
function hellozen_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();
	
		if ( empty( $background_color ) && empty( $background_image )  )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	return $classes;
}
add_filter( 'body_class', 'hellozen_body_class' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since hellozen 1.0
 */
function hellozen_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'hellozen_enhanced_image_navigation', 10, 2 );

/**
 * Sets the post excerpt length to 100 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function hellozen_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'hellozen_excerpt_length' );

if ( ! function_exists( 'hellozen_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 */
function hellozen_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . ('Continue reading ' . the_title('', '', false) . '' . '</a>');
}
endif; // hellozen_continue_reading_link

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function hellozen_auto_excerpt_more( $more ) {
	return ' &hellip;' . hellozen_continue_reading_link();
}
add_filter( 'excerpt_more', 'hellozen_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function hellozen_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= hellozen_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'hellozen_custom_excerpt_more' );

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Hello Zen 1.0
 * @return string|bool URL or false when no link is present.
 */
function hellozen_get_link_url() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}