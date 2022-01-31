<?php
/**
 * Plugin Name: Admin Color Schemes
 * Plugin URI: http://wordpress.org/plugins/admin-color-schemes/
 * Description: Even more admin color schemes
 * Version: 3.0.0
 * Requires PHP: 5.3
 * Author: WordPress Core Team
 * Author URI: http://wordpress.org/
 * Text Domain: admin-color-schemes
 */

/*
Copyright 2020 Kelly Dwan, Mel Choyce, Dave Whitley, Kate Whitley

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

namespace ACS_Color_Schemes;
use function add_action;
use function wp_admin_css_color;

const VERSION = '3.0.0';

/**
 * Helper function to get stylesheet URL.
 *
 * @param string $color The folder name for this color scheme.
 */
function get_color_url( $color ) {
	$suffix = is_rtl() ? '-rtl' : '';
	return plugins_url( "$color/colors$suffix.css?v=" . VERSION, __FILE__ );
}

/**
 * Register color schemes.
 */
function add_colors() {
	wp_admin_css_color(
		// The color name needs to stay misspelled for back-compat.
		'vinyard',
		__( 'Vineyard', 'admin_schemes' ),
		get_color_url( 'vineyard' ),
		array( '#301D25', '#462b36', '#ba8752', '#eabe3f' ),
		array(
			'base' => '#f1f2f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'primary',
		__( 'Primary', 'admin_schemes' ),
		get_color_url( 'primary' ),
		array( '#282b48', '#35395c', '#e46713', '#e7c03a' ),
		array(
			'base' => '#f1f2f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'80s-kid',
		__( '80\'s Kid', 'admin_schemes' ),
		get_color_url( '80s-kid' ),
		array( '#0c4da1', '#d13674', '#28b811' ),
		array(
			'base' => '#e4e5e7',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'aubergine',
		__( 'Aubergine', 'admin_schemes' ),
		get_color_url( 'aubergine' ),
		array( '#4c4b5f', '#585a61', '#ba5b32', '#da9b49' ),
		array(
			'base' => '#e4e4e7',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'cruise',
		__( 'Cruise', 'admin_schemes' ),
		get_color_url( 'cruise' ),
		array( '#292B46', '#36395c', '#cda200', '#79b591' ),
		array(
			'base' => '#f1f1f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'flat',
		__( 'Flat', 'admin_schemes' ),
		get_color_url( 'flat' ),
		array( '#1F2C39', '#2c3e50', '#1abc9c', '#f39c12' ),
		array(
			'base' => '#f1f2f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'lawn',
		__( 'Lawn', 'admin_schemes' ),
		get_color_url( 'lawn' ),
		array( '#0F1515', '#1e2a29', '#5D824B', '#a7b145' ),
		array(
			'base' => '#f1f3f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'seashore',
		__( 'Seashore', 'admin_schemes' ),
		get_color_url( 'seashore' ),
		array( '#F8F6F1', '#d5cdad', '#7D6B5C', '#456a7f' ),
		array(
			'base' => '#533C2F',
			'focus' => '#F8F6F1',
			'current' => '#F8F6F1',
		)
	);

	wp_admin_css_color(
		'kirk',
		__( 'Kirk', 'admin_schemes' ),
		get_color_url( 'kirk' ),
		array( '#bd3854', '#5f1b29', '#321017' ),
		array(
			'base' => '#fefcf7',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'contrast-blue',
		__( 'High Contrast Blue', 'admin_schemes' ),
		get_color_url( 'contrast-blue' ),
		array( '#22466d', '#5c98c8', '#a5cde8', '#dae9f3', '#9d2f4d' ),
		array(
			'base' => '#151923',
			'focus' => '#151923',
			'current' => '#151923',
		)
	);

	wp_admin_css_color(
		'adderley',
		__( 'Adderley', 'admin-color-schemes' ),
		get_color_url( 'adderley' ),
		array( '#bde7f0', '#216bce', '#1730e5' ),
		array(
			'base' => '#f1f3f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'modern-evergreen',
		__( 'Modern Evergreen', 'admin-color-schemes' ),
		get_color_url( 'modern-evergreen' ),
		array( '#1e8060', '#0f4232', '#1e1e1e', '#3855e1' ),
		array(
			'base' => '#f1f3f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);
}
add_action( 'admin_init', __NAMESPACE__ . '\add_colors' );

/**
 * Add our theme custom properties to the editor.
 */
function add_editor_themes() {
	wp_enqueue_style(
		'acs-editor-themes',
		plugins_url( 'editor.css', __FILE__ ),
		array(),
		VERSION
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\add_editor_themes' );

/**
 * Add the wordpress version to the body class, in format `wp-XX`.
 * This allows for some conditional styling depending on version.
 *
 * @param string $classes Space-separated list of CSS classes.
 * @return string Filtered class names.
 */
function admin_body_class( $classes ) {
	list( $display_version ) = explode( '-', get_bloginfo( 'version' ) );
	$classes .= ' wp-' . substr( str_replace( '.', '', $display_version ), 0, 2 );
	return $classes;
}
add_action( 'admin_body_class', __NAMESPACE__ . '\admin_body_class' );
