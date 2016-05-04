<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0

 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
?>
	<?php if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) )
		return;

	// If we get this far, we have widgets. Let do this.
	?>
		<aside id="secondary" <?php accessiblezen_footer_sidebar_class(); ?> role="complementary">
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<div class="first sidebar-widgets cf">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .first -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div class="second sidebar-widgets cf">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .second -->
			<?php endif; ?>
		</aside><!-- #secondary -->
