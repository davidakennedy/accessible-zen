<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package hellozen
 * @since hellozen 1.0
 */

if ( ! function_exists( 'hellozen_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since hellozen 1.0
 */
function hellozen_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation cf';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation cf';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="visuallyhidden"><?php _e( 'Post navigation', 'hellozen' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( 'Previous Post: ', 'Previous post link', 'hellozen' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( 'Next Post: ', 'Next post link', 'hellozen' ) . '</span> %title' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'hellozen' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'hellozen' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // hellozen_content_nav

if ( ! function_exists( 'hellozen_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since hellozen 1.0
 */
function hellozen_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'hellozen' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'hellozen' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'hellozen' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'hellozen' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'hellozen' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for hellozen_comment()

if ( ! function_exists( 'hellozen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since hellozen 1.0
 */
function hellozen_posted_on() {
	printf( __( 'Posted: <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>.<br />', 'hellozen' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'm.d.Y' ) )
	);
}
endif;

if ( ! function_exists( 'hellozen_archive_page_title_etc' ) ):
/**
 * Display info for the page title on the archive page
 *
 * @since hellozen 1.0
 */
function hellozen_archive_page_title_etc() {
		if ( is_category() ) {
			printf( __( 'Category Archives: %s', 'hellozen' ), '<span>' . single_cat_title( '', false ) . '</span>' );

		} elseif ( is_tag() ) {
			printf( __( 'Tag Archives: %s', 'hellozen' ), '<span>' . single_tag_title( '', false ) . '</span>' );

		} elseif ( has_post_format( 'aside' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'aside' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'audio' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'chat' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'gallery' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'image' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'link' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} 
		elseif ( has_post_format( 'quote' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'status' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( has_post_format( 'video' ) ) {
			printf( __( '%s Archives', 'hellozen' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' );
		} elseif ( is_author() ) {
			/* Queue the first post, that way we know
			 * what author we're dealing with (if that is the case).
			*/
			the_post();
			printf( __( 'Author Archives: %s', 'hellozen' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		} elseif ( is_day() ) {
			printf( __( 'Daily Archives: %s', 'hellozen' ), '<span>' . get_the_date() . '</span>' );

		} elseif ( is_month() ) {
			printf( __( 'Monthly Archives: %s', 'hellozen' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		} elseif ( is_year() ) {
			printf( __( 'Yearly Archives: %s', 'hellozen' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

		} else {
			_e( 'Archives', 'hellozen' );

		}
	?>
</h1>
<?php
	if ( is_category() ) {
		// show an optional category description
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

	} elseif ( is_tag() ) {
		// show an optional tag description
		$tag_description = tag_description();
		if ( ! empty( $tag_description ) )
			echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
						}
}
endif; // hellozen_content_nav

if ( ! function_exists( 'hellozen_cats_and_tags' ) ) :
/**
 * Prints HTML with information for the categories and tags.
 *
 * @since hellozen 1.0
 */
function hellozen_cats_and_tags() {

			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'hellozen' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! hellozen_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'Tagged: %2$s.<br /> Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.<br />', 'hellozen' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.<br />', 'hellozen' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'Posted in: %1$s.<br /> Tagged: %2$s.<br /> Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.<br />', 'hellozen' );
				} else {
					$meta_text = __( 'Posted in: %1$s.<br /> Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.<br />', 'hellozen' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
}
endif;

/**
 * Prints a link to the Post Format archive page
 * Use: echo get_post_format_archive_link();
 * @since hellozen 1.0
 */
 
 function get_post_format_archive_link() {
    return sprintf( 
        'Format: <a href="' . get_post_format_link( get_post_format() ) . '">' . get_post_format_string( get_post_format() ) . '</a><br>' 
    );
}

/**
 * Returns true if a blog has more than 1 category
 *
 * @since hellozen 1.0
 */
function hellozen_categorized_blog() {
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
		// This blog has more than 1 category so hellozen_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so hellozen_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in hellozen_categorized_blog
 *
 * @since hellozen 1.0
 */
function hellozen_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'hellozen_category_transient_flusher' );
add_action( 'save_post', 'hellozen_category_transient_flusher' );

function hellozen_credits() {
	$credits = printf(
		'<p>Made with <a href="%1$s">%2$s</a> &amp; <a href="%3$s">%4$s</a>.</p>',
		esc_url( 'http://wordpress.org' ),
		__( 'WordPress', 'hellozen' ),
		esc_url( 'http://davidakennedy.com/projects/hello-zen' ),
		__( 'the Hello Zen theme', 'hellozen' )
    );
    return $credits;
}