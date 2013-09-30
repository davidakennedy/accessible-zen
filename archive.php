<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area cf">
			<main id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php accessiblezen_archive_page_title_etc(); ?>
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
						get_template_part( 'partials/content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php accessiblezen_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'partials/no-results', 'archive' ); ?>

			<?php endif; ?>

			</main><!-- #content -->
		</section><!-- #primary .content-area -->

<?php get_footer(); ?>