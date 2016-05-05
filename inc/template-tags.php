<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0
 */

if ( ! function_exists( 'accessiblezen_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable.
 *
 * @since Accessible_Zen 1.0
 */
function accessiblezen_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation cf';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation cf';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>" aria-labelledby="<?php echo esc_attr( $nav_id ); ?>-post-menu-heading">
		<h2 id="<?php echo esc_attr( $nav_id ); ?>-post-menu-heading" class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'accessible-zen' ); ?></h2>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . esc_html_x( 'Previous Post: ', 'Previous post link', 'accessible-zen' ) . '</span>%title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . esc_html_x( 'Next Post: ', 'Next post link', 'accessible-zen' ) . '</span>%title' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( wp_kses( __( '<span class="meta-nav">&larr;</span> Older posts', 'accessible-zen' ), array( 'span' => array() ) ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( wp_kses( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'accessible-zen' ), array( 'span' => array() ) ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_attr( $nav_id ); ?> -->
	<?php
}
endif; // ends check for accessiblezen_content_nav

if ( ! function_exists( 'accessiblezen_author' ) ) :
/**
 * Prints HTML with author information for the current post.
 *
 * @since Accessible Zen 1.1.1
 */
function accessiblezen_author() {
	$byline = sprintf(
		esc_html_x( 'By %s', 'post author', 'accessible-zen' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif; // ends check for accessiblezen_author

if ( ! function_exists( 'accessiblezen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post date/time.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted: %s', 'post date', 'accessible-zen' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>.'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}
endif; // ends check for accessiblezen_posted_on

if ( ! function_exists( 'accessiblezen_archive_page_title_etc' ) ) :
 /**
 * Display info for the page title on the archive page.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_archive_page_title_etc() {
	if ( is_category() ) :
		single_cat_title();

	elseif ( is_tag() ) :
		single_tag_title();

	elseif ( is_author() ) :
		/* Queue the first post, that way we know
		 * what author we're dealing with (if that is the case).
		*/
		the_post();
		printf( esc_html__( 'Author: %s', 'accessible-zen' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();

	elseif ( is_day() ) :
		printf( esc_html__( 'Day: %s', 'accessible-zen' ), '<span>' . get_the_date() . '</span>' );

	elseif ( is_month() ) :
		printf( esc_html__( 'Month: %s', 'accessible-zen' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

	elseif ( is_year() ) :
		printf( esc_html__( 'Year: %s', 'accessible-zen' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
		esc_html_e( 'Asides', 'accessible-zen' );

	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
		esc_html_e( 'Audios', 'accessible-zen' );

	elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
		esc_html_e( 'Chats', 'accessible-zen' );

	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
		esc_html_e( 'Galleries', 'accessible-zen' );

	elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
		esc_html_e( 'Images', 'accessible-zen');

	elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
		esc_html_e( 'Statuses', 'accessible-zen' );

	elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
		esc_html_e( 'Videos', 'accessible-zen' );

	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
		esc_html_e( 'Quotes', 'accessible-zen' );

	elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
		esc_html_e( 'Links', 'accessible-zen' );

	elseif ( is_post_type_archive() ) :
		printf( esc_html__( '%s', 'accessible-zen' ), '<span>' . post_type_archive_title() . '</span>' );

	elseif ( is_tax() ) :
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		printf( esc_html__( '%s', 'accessible-zen' ), '<span>' . esc_html( $term->name ) . '</span>' );

	else :
		esc_html_e( 'Archives', 'accessible-zen' );

	endif;
}
endif; // ends check for accessiblezen_archive_page_title_etc

if ( ! function_exists( 'accessiblezen_term_description' ) ) :
 /**
 * Display optional term description for category, tag and custom taxonomy pages.
 *
 * @since Accessible Zen 1.1.1
 */
function accessiblezen_term_description() {
	// Show an optional term description.
	$term_description = term_description();

	if ( is_category() || is_tag() || is_tax() && ! empty( $term_description ) ) :
		printf( '<div class="taxonomy-description">%s</div>', $term_description, 'accessible-zen' ); // WPCS: XSS OK.
	endif;
}
endif; // ends check for accessiblezen_term_description

if ( ! function_exists( 'accessiblezen_cats_and_tags' ) ) :
/**
 * Prints HTML with information for the categories and tags.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_cats_and_tags() {

	/* translators: used between list items, there is a space after the comma */
	$category_list = get_the_category_list( esc_html__( ', ', 'accessible-zen' ) );

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', esc_html__( ', ', 'accessible-zen' ) );

	if ( ! accessiblezen_categorized_blog() ) {
		// This blog only has 1 category so we just need to worry about tags in the meta text
		if ( '' != $tag_list ) {
			$meta_text = wp_kses( __( '<span class="post-tags">Tagged: %2$s.</span> <span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessible-zen' ), array( 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'rel' => array() ) ) );
		} else {
			$meta_text = wp_kses( __( '<span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessible-zen' ), array( 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'rel' => array() ) ) );
		}

	} else {
		// But this blog has loads of categories so we should probably display them here
		if ( '' != $tag_list ) {
			$meta_text = wp_kses( __( '<span class="post-categories">Posted in: %1$s.</span> <span class="post-tags">Tagged: %2$s.</span> <span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessible-zen' ), array( 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'rel' => array() ) ) );
		} else {
			$meta_text = wp_kses( __( '<span class="post-categories">Posted in: %1$s.</span> <span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessible-zen' ), array( 'span' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'rel' => array() ) ) );
		}

	} // end check for categories on this blog

	printf( $meta_text, $category_list, $tag_list, get_permalink() ); // WPCS: XSS OK.
}
endif; // ends check for accessiblezen_cats_and_tags

if ( ! function_exists( 'accessiblezen_get_post_format_archive_link' ) ) :
/**
 * Prints a link to the Post Format archive page.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_get_post_format_archive_link() {
	$accessiblezen_get_post_format_archive_link = sprintf(
		esc_html_x( 'Format: %s', 'post-format-archive-link', 'accessible-zen' ),
		'<a href="' . esc_url( get_post_format_link( get_post_format() ) ) . '">' . get_post_format_string( get_post_format() ) . '</a>'
	);

	echo '<span class="post-format-archive-link">' . $accessiblezen_get_post_format_archive_link . '</span>'; // WPCS: XSS OK.
}
endif; // ends check for accessiblezen_get_post_format_archive_link

if ( ! function_exists( 'accessiblezen_get_post_format_icon' ) ) :
/**
 * Prints the markup for the genericon icon font.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_get_post_format_icon() {
	if ( has_post_format('aside') ) {
		printf( '<span class="genericon genericon-aside"></span>' );
	}
	elseif ( has_post_format('audio') ) {
		printf( '<span class="genericon genericon-audio"></span>' );
	}
	elseif ( has_post_format('chat') ) {
		printf( '<span class="genericon genericon-chat"></span>' );
	}
	elseif ( has_post_format('gallery') ) {
		printf( '<span class="genericon genericon-gallery"></span>' );
	}
	elseif ( has_post_format('image') ) {
		printf( '<span class="genericon genericon-image"></span>' );
	}
	elseif ( has_post_format('link') ) {
		printf( '<span class="genericon genericon-link"></span>' );
	}
	elseif ( has_post_format('quote') ) {
		printf( '<span class="genericon genericon-quote"></span>' );
	}
	elseif ( has_post_format('standard') ) {
		printf( '<span class="genericon genericon-standard"></span>' );
	}
	elseif ( has_post_format('status') ) {
		printf( '<span class="genericon genericon-status"></span>' );
	}
	elseif ( has_post_format('video') ) {
		printf('<span class="genericon genericon-video"></span>');
	}
}
endif; // ends check for accessiblezen_get_post_format_icon

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so accessiblezen_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so accessiblezen_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in accessiblezen_categorized_blog.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'accessiblezen_category_transient_flusher' );
add_action( 'save_post', 'accessiblezen_category_transient_flusher' );

/**
 * Adds credits to the footer.
 *
 * @since Accessible Zen 1.0
 */
function accessiblezen_credits() {
	$credits = printf(
		'<p>Made with <a href="%1$s">%2$s</a> &amp; <a href="%3$s">%4$s</a>.</p>',
		esc_url( 'http://wordpress.org' ),
		esc_html__( 'WordPress', 'accessible-zen' ),
		esc_url( 'http://davidakennedy.com/projects/accessible-zen' ),
		esc_html__( 'Accessible Zen', 'accessible-zen' )
	);
	return $credits;
}
