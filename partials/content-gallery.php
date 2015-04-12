<?php
/**
 * The template for displaying posts in the Gallery post format.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="gallery">
			<header class="entry-header">
				<span class="title">
					<?php _e( 'Gallery', 'accessiblezen' ); ?>
				</span>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header>

			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'accessiblezen' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .gallery -->

		<footer class="entry-meta">
			<?php accessiblezen_posted_on(); ?>
			<span class="post-format-info">
				<?php echo get_post_format_archive_link(); ?><?php get_post_format_icon(); ?>
			</span>
			<?php edit_post_link( __( 'Edit', 'accessiblezen' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
