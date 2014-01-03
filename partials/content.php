<?php
/**
 * The template part used for displaying content for the theme.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() ) : ?>
		<?php the_post_thumbnail(); ?>
		<span class="title"><?php _e( 'Featured', 'accessiblezen' ); ?></span>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php else : ?>	
		<?php the_post_thumbnail(); ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; ?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<p><?php _e( 'By', 'accessiblezen' ); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a>.</p>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_category() || is_tag() || is_author() || is_day() || is_month() || is_year() || is_search() ) : // Only display Excerpts for certain pages ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
		if ( get_theme_mod( 'accessiblezen_post_content' ) == '' || 'option2' ) :
		the_content('Continue reading ' . the_title('', '', false) . '');
		else :
		the_excerpt();
		endif;
		?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'accessiblezen' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php accessiblezen_posted_on(); ?>
		<?php edit_post_link( __( 'Edit', 'accessiblezen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->