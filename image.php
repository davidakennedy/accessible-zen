<?php
/**
 * The template for displaying image attachments.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area image-attachment cf">
			<main id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf(
									wp_kses( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%7$s</a>', 'accessible-zen' ), array( 'span' => array( 'class' => array() ), 'time' => array( 'class' => array(), 'datetime' => array() ), 'a' => array( 'class' => array(), 'href' => array(), 'rel' => array() ) ) ),
										esc_attr( get_the_date( 'c' ) ),
										esc_html( get_the_date() ),
										esc_url( wp_get_attachment_url() ),
										absint( $metadata['width'] ),
										absint( $metadata['height'] ),
										esc_url( get_permalink( $post->post_parent ) ),
										get_the_title( $post->post_parent )
								);
							?>
							<?php
								edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										esc_html__( 'Edit %s', 'accessible-zen' ),
										the_title( '<span class="screen-reader-text">"', '"</span>', false )
									),
									'<span class="sep"> | </span> <span class="edit-link">',
									'</span>'
								);
							?>
						</div><!-- .entry-meta -->

						<nav id="image-navigation">
							<span class="previous-image"><?php previous_image_link( false, esc_html__( '&larr; Previous', 'accessible-zen' ) ); ?></span>
							<span class="next-image"><?php next_image_link( false, esc_html__( 'Next &rarr;', 'accessible-zen' ) ); ?></span>
						</nav><!-- #image-navigation -->
					</header><!-- .entry-header -->

					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">
								<?php
									/**
									 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
									 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
									 */
									$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment->ID == $post->ID )
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
								?>

								<a href="<?php echo esc_url( $next_attachment_url ); ?>" rel="attachment"><?php
									$attachment_size = apply_filters( 'accessiblezen_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
									echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>
							</div><!-- .attachment -->

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'accessible-zen' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open ?>
							<?php
								printf(
									wp_kses( __( '<a class="comment-link" href="#respond">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" rel="trackback">Trackback URL</a>.', 'accessible-zen' ),
										array( 'a' => array( 'class' => array(), 'href' => array(), 'rel' => array() ) )
									),
									esc_url( get_trackback_url() )
								);
							?>
						<?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open ?>
							<?php
								printf(
									wp_kses( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" rel="trackback">Trackback URL</a>.', 'accessible-zen' ),
										array( 'a' => array( 'class' => array(), 'href' => array(), 'rel' => array() ) )
									),
									esc_url( get_trackback_url() )
								);
							?>
						<?php elseif ( comments_open() && ! pings_open() ) : // Only comments open ?>
							<?php
								printf(
									wp_kses( __( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond">post a comment</a>.', 'accessible-zen' ),
										array( 'a' => array( 'class' => array(), 'href' => array() ) )
									)
								);
							?>
						<?php elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed ?>
							<?php esc_html_e( 'Both comments and trackbacks are currently closed.', 'accessible-zen' ); ?>
						<?php endif; ?>
						<?php
							edit_post_link(
								sprintf(
									/* translators: %s: Name of current post */
									esc_html__( 'Edit %s', 'accessible-zen' ),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								),
								' <span class="edit-link">',
								'</span>'
							);
						?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php comments_template(); ?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #content -->
		</div><!-- #primary .content-area .image-attachment -->

<?php get_footer(); ?>
