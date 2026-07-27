<?php
/**
 * Plugin Name: Admin Color Schemes
 * Plugin URI: http://wordpress.org/plugins/admin-color-schemes/
 * Description: Even more admin color schemes.
 * Version: 4.0.0-alpha
 * Requires PHP: 8.3
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
	$ver = false ? VERSION : time();
	return plugins_url( "dist/$color/colors$suffix.css?v=$ver", __FILE__ );
}

/**
 * Register color schemes.
 */
function add_colors() {
	wp_admin_css_color(
		'80s-kid',
		__( '80\'s Kid', 'admin-color-schemes' ),
		get_color_url( '80s-kid' ),
		array( '#1b4a8c', '#d13674', '#ff9abc', '#28b811' ),
		array(
			'base' => '#e4e5e7',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'adderley',
		__( 'Adderley', 'admin-color-schemes' ),
		get_color_url( 'adderley' ),
		array( '#154d9b', '#2d60ab', '#bde7f0' ),
		array(
			'base' => '#f1f3f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'aubergine',
		__( 'Aubergine', 'admin-color-schemes' ),
		get_color_url( 'aubergine' ),
		array( '#4a437c', '#574d97', '#ba5b32', '#eab444' ),
		array(
			'base' => '#e4e4e7',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'contrast-blue',
		__( 'High Contrast Blue', 'admin-color-schemes' ),
		get_color_url( 'contrast-blue' ),
		array( '#001e41', '#96c1dd', '#b2dcf6', '#9d2f4d' ),
		array(
			'base' => '#151923',
			'focus' => '#151923',
			'current' => '#151923',
		)
	);

	wp_admin_css_color(
		'cruise',
		__( 'Cruise', 'admin-color-schemes' ),
		get_color_url( 'cruise' ),
		array( '#303262', '#494d88', '#2b7a52', '#cda200' ),
		array(
			'base' => '#f1f1f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'flat',
		__( 'Flat', 'admin-color-schemes' ),
		get_color_url( 'flat' ),
		array( '#2c3e50', '#11919e', '#61c6d3', '#c04200' ),
		array(
			'base' => '#f1f2f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'kirk',
		__( 'Kirk', 'admin-color-schemes' ),
		get_color_url( 'kirk' ),
		array( '#4f1f27', '#8b2238', '#ad4253' ),
		array(
			'base' => '#fefcf7',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'lawn',
		__( 'Lawn', 'admin-color-schemes' ),
		get_color_url( 'lawn' ),
		array( '#0f1515', '#1e2a29', '#636a00', '#a7b145' ),
		array(
			'base' => '#f1f3f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'modern-aubergine',
		__( 'Modern Aubergine', 'admin-color-schemes' ),
		get_color_url( 'modern-aubergine' ),
		array( '#1d1d24', '#342a65', '#6e5ec9' ),
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
		array( '#0f231a', '#265843', '#1e8060' ),
		array(
			'base' => '#f1f3f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'primary',
		__( 'Primary', 'admin-color-schemes' ),
		get_color_url( 'primary' ),
		array( '#282b48', '#3c4065', '#bf4500', '#e4b903' ),
		array(
			'base' => '#f1f2f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);

	wp_admin_css_color(
		'seashore',
		__( 'Seashore', 'admin-color-schemes' ),
		get_color_url( 'seashore' ),
		array( '#eee5d6', '#d9c8aa', '#456a7f' ),
		array(
			'base' => '#533C2F',
			'focus' => '#F8F6F1',
			'current' => '#F8F6F1',
		)
	);

	wp_admin_css_color(
		// The color name needs to stay misspelled for back-compat.
		'vinyard',
		__( 'Vineyard', 'admin-color-schemes' ),
		get_color_url( 'vineyard' ),
		array( '#432531', '#934f69', '#ab7844', '#ffe9c6' ),
		array(
			'base' => '#f1f2f3',
			'focus' => '#fff',
			'current' => '#fff',
		)
	);
}
add_action( 'admin_init', __NAMESPACE__ . '\add_colors' );

/**
 * Add the JS plugin to override the admin theme values.
 */
function add_editor_theme() {
	$deps_path = __DIR__ . '/build/editor-color-scheme.ts.asset.php';

	if ( ! file_exists( $deps_path ) ) {
		return;
	}

	$block_info = require $deps_path;

	wp_enqueue_script(
		'admin-scheme-editor-script',
		plugin_dir_url( __FILE__ ) . 'build/editor-color-scheme.ts.js',
		$block_info['dependencies'],
		$block_info['version'],
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\add_editor_theme' );

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
