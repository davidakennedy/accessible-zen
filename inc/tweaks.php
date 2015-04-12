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

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function accessiblezen_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}
		global $page, $paged;
		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}
		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'accessiblezen' ), max( $paged, $page ) );
		}
		return $title;
	}
	add_filter( 'wp_title', 'accessiblezen_wp_title', 10, 2 );
	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 * @since accessiblezen 1.1.4
	 */
	function accessiblezen_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'accessiblezen_render_title' );
endif;

if ( ! function_exists( 'accessiblezen_excerpt_length' ) ) :
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
endif; // accessiblezen_excerpt_length

if ( ! function_exists( 'accessiblezen_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 * @since accessiblezen 1.0
 * @return string with 'Continue reading' link.
 */
function accessiblezen_continue_reading_link() {
	return sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( esc_html__( 'Continue reading %s', 'accessiblezen' ), get_the_title( get_the_ID() ) )
		);
}
endif; // accessiblezen_continue_reading_link

if ( ! function_exists( 'accessiblezen_auto_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and accessiblezen_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 * @since accessiblezen 1.0
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function accessiblezen_auto_excerpt_more( $more ) {
	return ' &hellip; ' . accessiblezen_continue_reading_link();
}
add_filter( 'excerpt_more', 'accessiblezen_auto_excerpt_more' );
endif; // accessiblezen_auto_excerpt_more

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
