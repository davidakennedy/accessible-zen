<?php
/**
 * The template for displaying posts in the Audio post format.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="audio">
			<header class="entry-header">
				<span class="title">
					<?php _e( 'Audio', 'accessiblezen' ); ?>
				</span>
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</header>
			
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'accessiblezen' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .audio -->

		<footer class="entry-meta">
		<?php accessiblezen_posted_on(); ?>
		<?php echo get_post_format_archive_link(); ?><?php get_post_format_icon(); ?>
		<?php edit_post_link( __( 'Edit', 'accessiblezen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	</article><!-- #post -->