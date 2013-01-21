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

	</div><!-- #main -->

	<footer id="colophon" class="site-footer cf" role="contentinfo">
		<?php get_sidebar(); ?>
		<nav role="navigation" class="promo-navigation secondary-navigation g1 cf">
			<h1 class="visuallyhidden"><?php _e( 'Secondary Menu', 'zh' ); ?></h1>

			<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
		</nav><!-- .promo-navigation .secondary-navigation -->
		
		<nav role="navigation" class="site-navigation main-navigation g1 cf">
			<h1 class="visuallyhidden"><?php _e( 'Main Menu', 'zh' ); ?></h1>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->
		
		<div class="site-info g1 cf">	<?php do_action( 'zh_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'zh' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'zh' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'zh' ), 'Zen Hacker', '<a href="http://davidakennedy.com/">David A. Kennedy</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>