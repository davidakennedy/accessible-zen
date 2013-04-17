<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Zen Hacker consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by your most recent post.
 *
 * @package hellozen
 * @since hellozen 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content cf">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); // The  Main Loop ?>
				
					<?php if( !empty( $post->post_content) ) {
					// Grab our content, if not empty
					get_template_part( 'content', 'page' );
					} ?>		
				
				<?php endwhile; // end of the main loop. ?>
					
					<?php
						$args = array(
							'post__not_in' => get_option( 'sticky_posts'),
							'posts_per_page' => 1
						);
						
						// The New Query	
						$the_query = new WP_Query( $args );
						
						// The New Loop
						while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
							<?php
							/* Include the Post-Format-specific template for the content.
						 	* If you want to overload this in a child theme then include a file
						 	* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 	*/
							get_template_part( 'content', get_post_format() ); ?>
						
						<?php endwhile; // end of the new loop.
						
						// Reset Post Data
						wp_reset_postdata(); ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer(); ?>