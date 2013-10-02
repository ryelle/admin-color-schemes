<?php 
/**
 * Plugin Name: MP6 Color Schemes
 * Description: Even more admin color schemes for MP6, designed by Dave Whitley. 
 * Version: 1.0
 * Author: Kelly Dwan
 * Author URI: http://redradar.net
 * License: GPL2
 */
function kd_mp6_add_colors() {
	if ( function_exists( 'mp6_add_admin_colors' ) ) {
		mp6_add_admin_colors( 'sunset', array(
			'label' => 'Sunset',
			'palette' => array( '#b43c38', '#cf4944', '#dd823b', '#ccaf0b' ),
			'icon' => array( 'base' => '#f3f1f1', 'focus' => '#fff', 'current' => '#fff' ),
			'admin_path' => plugin_dir_path( __FILE__ ) . "sunset/admin-colors.css",
			'admin_url'  => plugins_url( "sunset/admin-colors.css", __FILE__ ),
			'customizer_path' => plugin_dir_path( __FILE__ ) . "sunset/customizer.css",
			'customizer_url'  => plugins_url( "sunset/customizer.css", __FILE__ ),
		) );
		
		mp6_add_admin_colors( 'navy', array(
			'label' => 'Midnight',
			'palette' => array( '#25282b', '#363b3f', '#69a8bb', '#e14d43' ),
			'icon' => array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' ),
			'admin_path' => plugin_dir_path( __FILE__ ) . "midnight/admin-colors.css",
			'admin_url'  => plugins_url( "midnight/admin-colors.css", __FILE__ ),
			'customizer_path' => plugin_dir_path( __FILE__ ) . "midnight/customizer.css",
			'customizer_url'  => plugins_url( "midnight/customizer.css", __FILE__ ),
		) );
	}
}
add_action( 'admin_init' , 'kd_mp6_add_colors', 7 );
