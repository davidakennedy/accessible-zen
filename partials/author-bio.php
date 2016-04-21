<?php
/**
 * The template for displaying Author bios.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0
 */
?>

<div class="author-info cf">
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'accessiblezen_author_bio_avatar_size', 64 ) ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2><?php printf( esc_html__( 'About %s', 'accessible-zen' ), get_the_author() ); ?></h2>
		<p>
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( wp_kses( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'accessible-zen' ), array( 'span' => array( 'class' => array() ) ) ), get_the_author() ); ?>
			</a>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->
