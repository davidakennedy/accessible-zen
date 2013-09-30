<?php
/**
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Accessible Zen consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by your most recent post.
 * Template Name: Front Page Template
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area cf">
			<main id="content" role="main">

				<?php while ( have_posts() ) : the_post(); // The  Main Loop ?>
				
					<?php if( !empty( $post->post_content) ) {
					// Grab our content, if not empty
					get_template_part( 'partials/content', 'page' );
					} ?>		
				
				<?php endwhile; // end of the main loop.
				
				// Reset Post Data
				wp_reset_postdata(); ?>
					
				<?php
					$args = array(
						'post__not_in' => get_option( 'sticky_posts'), // Don't show stickey posts.
						'posts_per_page' => 1 // Show only one post on front page.
					);
					
					// The New Query	
					$front_page_post_query = new WP_Query( $args );
					
					// The New Loop
					while ( $front_page_post_query->have_posts() ) : $front_page_post_query->the_post(); ?>
					
						<?php
						/* Include the Post-Format-specific template for the content.
						* If you want to overload this in a child theme then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'partials/content', get_post_format() ); ?>
						
						<?php
						$value = get_theme_mod( 'show_more_posts_link' );
						if ( 'default' != get_theme_mod( 'show_more_posts_link' ) ) : ?>
	
						<span class="h6"><a href="<?php echo get_permalink($value); ?>" rel="bookmark"><?php _e( 'Read more posts', 'accessiblezen' ); ?></a></span>
						<?php endif; ?>
					
					<?php endwhile; // end of the new loop. ?>

			</main><!-- #content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>