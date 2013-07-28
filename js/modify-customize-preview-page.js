// Hide theme option on Customizer panel, based on selection
jQuery(document).ready(function( $ ) {
	// Hide divs on Customizer panel, based on selection
	$('#customize-control-show_more_posts_link').hide();
	$('input[name="_customize-radio-show_on_front"]').change(function() {
		$('#customize-control-show_more_posts_link').toggle();
	});
});