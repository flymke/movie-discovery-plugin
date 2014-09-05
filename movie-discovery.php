<?php
/**
 * Movie Discovery Plugin
 *
 * This plugin lets you put movies by keywords on your blog.
 *
 * @package   Movie_Discovery
 * @author    Mike Schoenrock <info@aliquit.de>
 * @license   GPL-2.0+
 * @link      https://github.com/flymke/movie-discovery-plugin
 * @copyright 2014 aliquit labs
 *
 * @wordpress-plugin
 * Plugin Name:       Movie Discovery
 * Plugin URI:        http://www.movie-discovery.com/wp-plugin
 * Description:       This plugin gathers movies by keywords that you have set up on your website. The movie that fits best will be presented as a poster with a link to buy or rent that movie.
 * Version:           1.0.0
 * Author:            Mike Schoenrock, Yoram Schaffer
 * Author URI:        http://www.aliquit.de
 * Text Domain:       movie-discovery
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/flymke/movie-discovery-plugin
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

 
/*
 * plugin version
 *
 */
if ( ! defined( 'WP_MOVIE_DISCOVERY_VERSION' ) ) {
	define( 'WP_MOVIE_DISCOVERY_VERSION', '1.0.0' );
}

/*
 * plugin dir path
 *
 */
if ( ! defined( 'WP_MOVIE_DISCOVERY_PATH' ) ) {
	define( 'WP_MOVIE_DISCOVERY_PATH', plugin_dir_path( __FILE__ ) );
}

/*
 * plugin's class file
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'public/class-movie-discovery.php' );


/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 */
register_activation_hook( __FILE__, array( 'Movie_Discovery', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Movie_Discovery', 'deactivate' ) );

/*
 * Add action plugins_loaded
 * 
 */
add_action( 'plugins_loaded', array( 'Movie_Discovery', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-movie-discovery-admin.php' );
	add_action( 'plugins_loaded', array( 'Movie_Discovery_Admin', 'get_instance' ) );

}
