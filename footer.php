<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package accessiblezen
 * @since accessiblezen 1.0
 */
?>

	<?php get_sidebar(); ?>
	</div><!-- #main -->

	<footer id="colophon" class="site-footer cf" role="contentinfo">
		<nav role="navigation" class="main-navigation cf">
			<h1 class="visuallyhidden"><?php _e( 'Main Menu', 'accessiblezen' ); ?></h1>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class'      => 'nav', 'depth' => 1 ) ); ?>
		</nav><!-- .main-navigation -->
		
		<nav role="navigation" class="secondary-navigation cf">
			<h1 class="visuallyhidden"><?php _e( 'Secondary Menu', 'accessiblezen' ); ?></h1>

			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class'      => 'nav', 'depth' => 1 ) ); ?>
		</nav><!-- .secondary-navigation -->
		
		<div class="site-info cf">
			<?php accessiblezen_credits(); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
	<div class="skip-container cf">
		<a class="skip-link" href="#page"><?php _e( '&uarr; Back to the Top', 'accessiblezen' ); ?></a>
	</div><!-- .skip-container -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>