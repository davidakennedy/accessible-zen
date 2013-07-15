<?php
/**
 * The template for displaying Custom Taxonomy Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
 
get_header(); ?>

		<section id="primary" class="content-area cf">
			<main id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php echo apply_filters( 'the_title', $term->name ); ?>
				</header><!-- .page-header -->

				<?php rewind_posts(); ?>

				<?php accessiblezen_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php accessiblezen_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

			</main><!-- #content -->
		</section><!-- #primary .content-area -->

<?php get_footer(); ?>