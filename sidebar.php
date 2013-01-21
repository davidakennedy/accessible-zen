<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package ZH
 * @since ZH 1.0
 */
?>
	<?php if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'zh' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>
			<?php endif; // end first sidebar widget area ?>
				
			<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'zh' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>
			<?php endif; // end second sidebar widget area ?>
		</div><!-- #secondary .widget-area -->