<?php
/**
 * The template for displaying search forms in hellozen
 *
 * @package hellozen
 * @since hellozen 1.0
 */
?>

	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s">
			<span class="visuallyhidden"><?php _ex( 'Search', 'visuallyhidden', 'hellozen' ); ?></span>
			<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'hellozen' ); ?>" />
		</label>
		<input type="submit" class="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'hellozen' ); ?>" />
	</form>
	
	
	
	