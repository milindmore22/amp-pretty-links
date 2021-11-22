<?php
/**
 * AMP plugin name compatibility plugin bootstrap.
 *
 * @package   Google\AMP_Pretty_Links
 * @author    Your Name, Google
 * @license   GPL-2.0-or-later
 * @copyright 2020 Google Inc.
 *
 * @wordpress-plugin
 * Plugin Name: AMP Pretty Links
 * Plugin URI: https://github.com/milindmore22/amp-pretty-links
 * Description: Plugin to add <a href="https://wordpress.org/plugins/amp/">AMP plugin</a> compatibility Pretty Link Plugin.
 * Version: 0.1
 * Author: milindmore22, Google
 * Author URI: https://amp-wp.org
 * License: GNU General Public License v2 (or later)
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Google\AMP_Pretty_Links;

/**
 * Whether the page is AMP.
 *
 * @return bool Is AMP.
 */
function is_amp() {
	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}

/**
 * Run Hooks.
 */
function add_hooks() {

	/**
	 *  Keep this if you are using theme.
	 */
	if ( class_exists( 'PrliLink' ) && is_amp() ) {
		/**
		 * Add sanitizers to convert non-AMP functions to AMP components.
		 *
		 * @see https://amp-wp.org/reference/hook/amp_content_sanitizers/
		 */
		add_filter( 'amp_content_sanitizers', __NAMESPACE__ . '\filter_sanitizers' );
	}
}

add_action( 'wp', __NAMESPACE__ . '\add_hooks' );

/**
 * Add sanitizer to fix up the markup.
 *
 * @param array $sanitizers Sanitizers.
 * @return array Sanitizers.
 */
function filter_sanitizers( $sanitizers ) {
	require_once __DIR__ . '/sanitizers/class-sanitizer.php';
	$sanitizers[ __NAMESPACE__ . '\Sanitizer' ] = array();
	return $sanitizers;
}
