<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package hellozen
 * @since hellozen 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="video">
			<div class="entry-media">
				<?php the_post_format_video(); ?>
			</div><!-- .entry-media -->
	
			<header class="entry-header">
				<span class="title">
					<?php _e( 'Video', 'hellozen' ); ?>
				</span>
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</header>
			
			<div class="entry-content">
				<?php the_remaining_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'hellozen' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .video -->

		<footer class="entry-meta">
		<?php hellozen_posted_on(); ?>
		<?php edit_post_link( __( 'Edit', 'hellozen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	</article><!-- #post -->
