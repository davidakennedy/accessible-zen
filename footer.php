<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package ZH
 * @since ZH 1.0
 */
?>

	<?php get_sidebar(); ?>
	</div><!-- #main -->

	<footer id="colophon" class="site-footer cf" role="contentinfo">
		<nav role="navigation" class="secondary-navigation cf">
			<h1 class="visuallyhidden"><?php _e( 'Secondary Menu', 'zh' ); ?></h1>

			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class'      => 'nav' ) ); ?>
		</nav><!-- .promo-navigation .secondary-navigation -->
		
		<nav role="navigation" class="main-navigation cf">
			<h1 class="visuallyhidden"><?php _e( 'Main Menu', 'zh' ); ?></h1>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class'      => 'nav' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->
		
		<div class="site-info cf">	<?php do_action( 'zh_credits' ); ?>
			<p><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'zh' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'zh' ), 'WordPress' ); ?></a> <?php _e( 'with the Zen Hacker theme ', 'zh' ); ?><a href="<?php echo esc_url( __( 'http://davidakennedy.com/', 'zh' ) ); ?>"><?php printf( __( 'by %s', 'zh' ), 'David A. Kennedy' ); ?></a>.</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
	<div class="skip-container">
		<a class="skip-link" href="#page"><?php _e( '&uarr; Back to the Top', 'zh' ); ?></a>
	</div><!-- .skip-container -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>