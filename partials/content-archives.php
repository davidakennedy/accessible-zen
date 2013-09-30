<?php
/**
 * A content part to display site archives.
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
	<div class="entry-content">	
		<?php the_content(); ?>
		<div class="search-archives">
			<p><?php _e( 'Try searching to find something.', 'accessiblezen' ); ?></p>
			<?php get_search_form(); ?>
		</div>
		<h2><?php _e( 'Archives by Month', 'accessiblezen' ); ?></h2>
		<ul>
			<?php wp_get_archives('show_post_count=1'); ?>
		</ul>
		<h2><?php _e( 'Archives by Category', 'accessiblezen' ); ?></h2>
		<ul>
			 <?php wp_list_categories(); ?>
		</ul>
		<h2><?php _e( 'Archives by Tag', 'accessiblezen' ); ?></h2>
		<div class="tags">
			<?php wp_tag_cloud('orderby=count'); ?>
		</div>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'duster' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'accessiblezen' ), '<span class="edit-link cf">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->