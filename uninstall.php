<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Movie_Discovery
 * @author    Michael Schoenrock <info@aliquit.de>
 * @license   GPL-2.0+
 * @link      https://github.com/flymke/movie-discovery-plugin
 * @copyright 2014 Michael Schoenrock
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
