<?php
/**
 * The template part used for displaying content for the Archive page template.
 * Template Name: Archives Template
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area cf">
			<main id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', 'archives' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer(); ?>