<?php
/**
 * The template for displaying posts in the Image post format.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="image">
			<header class="entry-header">
				<span class="title">
					<?php esc_html_e( 'Image', 'accessible-zen' ); ?>
				</span>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header>

			<div class="entry-content">
				<?php
					the_content(
						wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'accessible-zen' ),
						array( 'span' => array( 'class' => array() ) ) )
					);
				?>
			</div><!-- .entry-content -->
		</div><!-- .image -->

		<footer class="entry-meta">
			<?php accessiblezen_posted_on(); ?>
			<span class="post-format-info">
				<?php get_post_format_archive_link(); ?>
				<?php get_post_format_icon(); ?>
			</span>
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'accessible-zen' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
