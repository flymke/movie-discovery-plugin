<?php
/**
 * Movie Discovery Plugin
 *
 * This plugin lets you put movies by keywords on your blog.
 *
 * @package   Movie Discovery
 * @author    Mike Schoenrock <info@aliquit.de>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 aliquit labs
 *
 * @wordpress-plugin
 * Plugin Name:       Movie Discovery
 * Plugin URI:        http://www.movie-discovery.com/wp-plugin
 * Description:       This plugin lets you put movies by keywords on your blog 
 * Version:           1.0.0
 * Author:            Mike Schoenrock / Yoram Schaffer
 * Author URI:        http://www.aliquit.de
 * Text Domain:       movie-discovery
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: -
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name.php` with the name of the plugin's class file
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'public/class-movie-discovery.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */
register_activation_hook( __FILE__, array( 'Movie_Discovery', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Movie_Discovery', 'deactivate' ) );

/*
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */
add_action( 'plugins_loaded', array( 'Movie_Discovery', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-admin.php` with the name of the plugin's admin file
 * - replace Plugin_Name_Admin with the name of the class defined in
 *   `class-plugin-name-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-movie-discovery-admin.php' );
	add_action( 'plugins_loaded', array( 'Movie_Discovery_Admin', 'get_instance' ) );

}
