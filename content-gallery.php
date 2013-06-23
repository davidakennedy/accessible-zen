<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package hellozen
 * @since hellozen 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="gallery">
			<header class="entry-header">
				<span class="title">
					<?php _e( 'Gallery', 'hellozen' ); ?>
				</span>
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</header>
			
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'hellozen' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .gallery -->

		<footer class="entry-meta">
		<?php hellozen_posted_on(); ?>
		<?php edit_post_link( __( 'Edit', 'hellozen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	</article><!-- #post -->
