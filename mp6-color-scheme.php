<?php 
/**
 * Plugin Name: MP6 Color Schemes
 * Description: Even more admin color schemes for MP6, designed by Dave Whitley. 
 * Version: 1.0
 * Author: Kelly Dwan
 * Author URI: http://redradar.net
 * License: GPL2
 */
function admin_schemes_add_colors() {
	wp_admin_css_color( 
		'sunset', __( 'Sunset', 'admin_schemes' ), 
		plugins_url( "sunset/admin-colors.css", __FILE__ ),
		array( '#b43c38', '#cf4944', '#dd823b', '#ccaf0b' ), 
		array( 'base' => '#f3f1f1', 'focus' => '#fff', 'current' => '#fff' )
	);

	wp_admin_css_color( 
		'vinyard', __( 'Vinyard', 'admin_schemes' ), 
		plugins_url( "vineyard/admin-colors.css", __FILE__ ),
		array( '#301D25', '#462b36', '#d3995d', '#eabe3f' ), 
		array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
	);

	wp_admin_css_color( 
		'primary', __( 'Primary', 'admin_schemes' ), 
		plugins_url( "primary/admin-colors.css", __FILE__ ),
		array( '#282b48', '#35395c', '#f38135', '#e7c03a' ),
		array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
	);

	wp_admin_css_color( 
		'mint', __( 'Mint', 'admin_schemes' ), 
		plugins_url( "mint/admin-colors.css", __FILE__ ),
		array( '#4f6d59', '#33834e', '#5FB37C', '#81c498' ),
		array( 'base' => '#f1f3f2', 'focus' => '#fff', 'current' => '#fff' )
	);

	wp_admin_css_color( 
		'evergreen', __( 'Evergreen', 'admin_schemes' ), 
		plugins_url( "evergreen/admin-colors.css", __FILE__ ),
		array( '#324d3a', '#446950', '#56b274', '#324d3a' ),
		array( 'base' => '#f1f3f2', 'focus' => '#fff', 'current' => '#fff' )
	);
}
add_action( 'admin_init' , 'admin_schemes_add_colors' );

/**
 * Make sure `colors-fresh.css` gets enqueued, since we can't @import it
 * from a plugin stylesheet.
 */ 
function admin_schemes_load_mp6_default_css() {

	global $wp_styles, $_wp_admin_css_colors;

	$color_scheme = get_user_option( 'admin_color' );
	
	if ( $color_scheme == 'fresh' )
		return;

	$wp_styles->registered[ 'colors' ]->deps[] = 'colors-fresh';

}
add_action( 'admin_init', 'admin_schemes_load_mp6_default_css', 20 );
