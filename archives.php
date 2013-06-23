<?php
/**
 * @package accessiblezen
 * @since accessiblezen 1.0
 * Template Name: Archives Template
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="site-content cf" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'archives' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer(); ?>