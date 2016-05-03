<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after.
 *
 * @package Accessible_Zen
 * @since Accessible Zen 1.0
 */
?>

	<?php get_sidebar(); ?>
	</div><!-- #main -->

	<footer id="colophon" class="site-footer cf" role="contentinfo">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav role="navigation" class="main-navigation cf" aria-labelledby="main-menu-heading">
				<h2 id="main-menu-heading" class="screen-reader-text"><?php esc_html_e( 'Main Menu', 'accessible-zen' ); ?></h2>

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav', 'depth' => 1 ) ); ?>
			</nav><!-- .main-navigation -->
		<?php endif; ?>

		<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<nav role="navigation" class="secondary-navigation cf" aria-labelledby="secondary-menu-heading">
				<h2 id="secondary-menu-heading" class="screen-reader-text"><?php esc_html_e( 'Secondary Menu', 'accessible-zen' ); ?></h2>

				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav', 'depth' => 1 ) ); ?>
			</nav><!-- .secondary-navigation -->
		<?php endif; ?>

		<div class="site-info cf">
			<?php accessiblezen_credits(); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
	<div class="skip-container cf">
		<a class="skip-link" href="#page"><?php esc_html_e( '&uarr; Back to the Top', 'accessible-zen' ); ?></a>
	</div><!-- .skip-container -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>
