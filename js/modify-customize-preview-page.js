/**
 * Hide theme option on Customizer panel, based on selection.
 */

jQuery( document ).ready(function( $ ) {
	// Hide divs on Customizer panel by default
	$( '#customize-control-show_more_posts_link' ).hide();
	// But show it if it's already selected
	if ( $( 'input[value="page"]' ).is( ':checked' ) ) {
		$( '#customize-control-show_more_posts_link' ).show();
	}
	// Hide/Show divs on Customizer panel, based on selection
	$( 'input[value="posts"]' ).change(function() {
		$( '#customize-control-show_more_posts_link' ).hide();
	});
	$( 'input[value="page"]' ).change(function() {
		$( '#customize-control-show_more_posts_link' ).show();
	});
});