<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

if ( ! function_exists( 'accessiblezen_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation cf';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation cf';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'accessiblezen' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( 'Previous Post: ', 'Previous post link', 'accessiblezen' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( 'Next Post: ', 'Next post link', 'accessiblezen' ) . '</span> %title' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'accessiblezen' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'accessiblezen' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // ends check for accessiblezen_content_nav

if ( ! function_exists( 'accessiblezen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_posted_on() {
	printf( __( '<span class="post-date">Posted: <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>.</span>', 'accessiblezen' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'm.d.Y' ) )
	);
}
endif; // ends check for accessiblezen_posted_on

if ( ! function_exists( 'accessiblezen_archive_page_title_etc' ) ):
 /**
 * Display info for the page title on the archive page
 *
 * @since accessiblezen 1.0
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
		printf( __( 'Author: %s', 'accessiblezen' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();

	elseif ( is_day() ) :
		printf( __( 'Day: %s', 'accessiblezen' ), '<span>' . get_the_date() . '</span>' );

	elseif ( is_month() ) :
		printf( __( 'Month: %s', 'accessiblezen' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

	elseif ( is_year() ) :
		printf( __( 'Year: %s', 'accessiblezen' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
		_e( 'Asides', 'accessiblezen' );
		
	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
		_e( 'Audios', 'accessiblezen' );
		
	elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
		_e( 'Chats', 'accessiblezen' );
		
	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
		_e( 'Galleries', 'accessiblezen' );

	elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
		_e( 'Images', 'accessiblezen');
		
	elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
		_e( 'Statuses', 'accessiblezen' );

	elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
		_e( 'Videos', 'accessiblezen' );

	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
		_e( 'Quotes', 'accessiblezen' );

	elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
		_e( 'Links', 'accessiblezen' );
		
	elseif ( is_post_type_archive() ) :
		printf( __( '%s', 'accessiblezen' ), '<span>' . post_type_archive_title() . '</span>' );
		
	elseif ( is_tax() ) :
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		printf( __( '%s', 'accessiblezen' ), '<span>' . $term->name . '</span>' );

	else :
		_e( 'Archives', 'accessiblezen' );

	endif;

	// Show an optional term description.
	$term_description = term_description();
	if ( ! empty( $term_description ) ) :
	printf( '<div class="taxonomy-description">%s</div>', $term_description );
	endif;
}
endif; // ends check for accessiblezen_archive_page_title_etc

if ( ! function_exists( 'accessiblezen_cats_and_tags' ) ) :
/**
 * Prints HTML with information for the categories and tags.
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_cats_and_tags() {

			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'accessiblezen' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! accessiblezen_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="post-tags">Tagged: %2$s.</span> <span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessiblezen' );
				} else {
					$meta_text = __( '<span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessiblezen' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<span class="post-categories">Posted in: %1$s.</span> <span class="post-tags">Tagged: %2$s.</span> <span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessiblezen' );
				} else {
					$meta_text = __( '<span class="post-categories">Posted in: %1$s.</span> <span class="post-permalink">Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.</span>', 'accessiblezen' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
}
endif; // ends check for accessiblezen_cats_and_tags
 
if ( ! function_exists( 'get_post_format_archive_link' ) ): {
/**
 * Prints a link to the Post Format archive page
 * Use: echo get_post_format_archive_link();
 * @since accessiblezen 1.0
 */
function get_post_format_archive_link() {
    return sprintf( 
        'Format: <a href="' . get_post_format_link( get_post_format() ) . '">' . get_post_format_string( get_post_format() ) . '</a>' 
    );
}
}
endif; // ends check for get_post_format_archive_link

if ( ! function_exists( 'get_post_format_icon' ) ): {
/**
 * Prints the markup for the genericon icon font
 *
 * @since accessiblezen 1.0
 */
function get_post_format_icon() {
	if ( has_post_format('aside') ) {
    	printf('<span class="genericon genericon-aside"></span><br>');
    }
    elseif ( has_post_format('audio') ) {
    	printf('<span class="genericon genericon-audio"></span><br>');
    }
    elseif ( has_post_format('chat') ) {
    	printf('<span class="genericon genericon-chat"></span><br>');
    }
    elseif ( has_post_format('gallery') ) {
    	printf('<span class="genericon genericon-gallery"></span><br>');
    }
    elseif ( has_post_format('image') ) {
    	printf('<span class="genericon genericon-image"></span><br>');
    }
    elseif ( has_post_format('link') ) {
    	printf('<span class="genericon genericon-link"></span><br>');
    }
    elseif ( has_post_format('quote') ) {
    	printf('<span class="genericon genericon-quote"></span><br>');
    }
    elseif ( has_post_format('standard') ) {
    	printf('<span class="genericon genericon-standard"></span><br>');
    }
    elseif ( has_post_format('status') ) {
    	printf('<span class="genericon genericon-status"></span><br>');
    }
    elseif ( has_post_format('video') ) {
    	printf('<span class="genericon genericon-video"></span><br>');
    }
}
}
endif; // ends check for get_post_format_icon

/**
 * Returns true if a blog has more than 1 category
 *
 * @since accessiblezen 1.0
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
 * Flush out the transients used in accessiblezen_categorized_blog
 *
 * @since accessiblezen 1.0
 */
function accessiblezen_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'accessiblezen_category_transient_flusher' );
add_action( 'save_post', 'accessiblezen_category_transient_flusher' );

function accessiblezen_credits() {
	$credits = printf(
		'<p>Made with <a href="%1$s">%2$s</a> &amp; <a href="%3$s">%4$s</a>.</p>',
		esc_url( 'http://wordpress.org' ),
		__( 'WordPress', 'accessiblezen' ),
		esc_url( 'http://davidakennedy.com/projects/accessible-zen' ),
		__( 'Accessible Zen', 'accessiblezen' )
    );
    return $credits;
}