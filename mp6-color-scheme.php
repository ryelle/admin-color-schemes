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
		
		mp6_add_admin_colors( 'midnight', array(
			'label' => 'Midnight',
			'palette' => array( '#25282b', '#363b3f', '#69a8bb', '#e14d43' ),
			'icon' => array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' ),
			'admin_path' => plugin_dir_path( __FILE__ ) . "midnight/admin-colors.css",
			'admin_url'  => plugins_url( "midnight/admin-colors.css", __FILE__ ),
			'customizer_path' => plugin_dir_path( __FILE__ ) . "midnight/customizer.css",
			'customizer_url'  => plugins_url( "midnight/customizer.css", __FILE__ ),
		) );

		mp6_add_admin_colors( 'vineyard', array(
			'label' => 'Vineyard',
			'palette' => array( '#301D25', '#462b36', '#d3995d', '#eabe3f' ),
			'icon' => array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' ),
			'admin_path' => plugin_dir_path( __FILE__ ) . "vineyard/admin-colors.css",
			'admin_url'  => plugins_url( "vineyard/admin-colors.css", __FILE__ ),
			'customizer_path' => plugin_dir_path( __FILE__ ) . "vineyard/customizer.css",
			'customizer_url'  => plugins_url( "vineyard/customizer.css", __FILE__ ),
		) );

		mp6_add_admin_colors( 'primary', array(
			'label' => 'Primary',
			'palette' => array( '#282b48', '#35395c', '#f38135', '#e7c03a' ),
			'icon' => array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' ),
			'admin_path' => plugin_dir_path( __FILE__ ) . "primary/admin-colors.css",
			'admin_url'  => plugins_url( "primary/admin-colors.css", __FILE__ ),
			'customizer_path' => plugin_dir_path( __FILE__ ) . "primary/customizer.css",
			'customizer_url'  => plugins_url( "primary/customizer.css", __FILE__ ),
		) );
	}
}
add_action( 'admin_init' , 'kd_mp6_add_colors', 7 );
