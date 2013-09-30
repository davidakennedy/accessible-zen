<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area cf">
			<main id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'accessiblezen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php accessiblezen_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', 'search' ); ?>

				<?php endwhile; ?>

				<?php accessiblezen_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'partials/no-results', 'search' ); ?>

			<?php endif; ?>

			</main><!-- #content -->
		</section><!-- #primary .content-area -->

<?php get_footer(); ?>