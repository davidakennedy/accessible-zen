<?php
/**
 * The template for displaying posts in the Aside post format.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="aside">
			<header class="entry-header">
				<span class="title">
					<?php esc_html_e( 'Aside', 'accessible-zen' ); ?>
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
		</div><!-- .aside -->

		<footer class="entry-meta">
			<?php accessiblezen_posted_on(); ?>
			<span class="post-format-info">
				<?php echo get_post_format_archive_link(); // WPCS: XSS OK. ?>
				<?php get_post_format_icon(); ?>
			</span>
			<?php edit_post_link( __( 'Edit', 'accessible-zen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	</article><!-- #post -->
