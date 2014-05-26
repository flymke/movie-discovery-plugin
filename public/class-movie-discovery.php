<?php
/**
 * Movie Discovery
 *
 * @package   Movie_Discovery
 * @author    Mike Schoenrock <info@aliquit.de>
 * @license   GPL-2.0+
 * @link      http://www.movie-discovery.com
 * @copyright 2014 aliquit labs
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 *
 * @package Movie_Discovery
 * @author  Your Name <email@example.com>
 */
class Movie_Discovery {
	
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'movie-discovery';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
		add_shortcode( 'md', array( $this, 'md_func' ) );
		//add_filter('the_content',  array( $this, 'do_shortcode' ) );
		
		/* Define custom functionality.
		 * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		//add_action( '@TODO', array( $this, 'action_method_name' ) );
		//add_filter( '@TODO', array( $this, 'filter_method_name' ) );
		


	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 *@return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
	}

	/**
	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *        Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *        Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.0.0
	 */
	public function action_method_name() {
		// @TODO: Define your action hook callback here
	}

	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *        Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.0.0
	 */
	public function filter_method_name() {
		// @TODO: Define your filter hook callback here
	}
	
	/* Shortcode */
	public function md_func( $atts, $content="" ) {
		
		extract( shortcode_atts( array(
			'src' => 'movie-discovery',
			'keywords' => '',
			'id' => '',
			'aid' => ''
		), $atts, 'bartag' ) );
		
		$keywords = str_replace(',', '|', $keywords);
            
		if(strpos($_SERVER["SERVER_NAME"], '127.0.0.1') !== false ) { // dev
			$url = 'http://127.0.0.1:8080/_movie-discovery.com/api';
		}
		else { // prod
			$url = 'http://www.movie-discovery.com/api';
		}
		
		if(is_numeric($id)) {
			$data = file_get_contents($url . '/get-movie.php?id=' . $id);
		}
		else { // => keyword search
			$data = file_get_contents($url . '/get-movie.php?k=' . $keywords);
		}

		$data = json_decode($data);
		
		if(!empty($data)) {
			
			$movie = $data[0];
			
			//$return_test = '<div class="movie-discovery"><span class="md-headline">Watch related movie:</span><div class="md-content"><span class="md-title">'.$movie->title.'</span><span class="md-desc">'.$movie->metadesc.'</span><span class="md-price-rent">Price Rent: '.$movie->priceRent.'</span><span class="md-price-buy">Price Buy: '.$movie->priceBuy.'</span></div></div>';
			
			$return = '<div class="movie-discovery"><div class="md-inner">
			<span class="md-headline">Watch related movie:</span>
			<div class="md-content">
				<span class="md-poster-image"><img src="'.$movie->image.'" alt="'.$movie->title.'" title="'.$movie->title.'"/></span>
				<div class="md-overlay" style="opacity:0;">
				<span class="md-overlay-inner">
					<h2 class="md-title">'.$movie->title.'</h2>
					<p class="md-desc">'.$movie->metadesc.'</p>
					<div class="md-buy">
						<span class="md-buy-now-title">Buy now:</span>
						<span class="md-price-rent">Rent: '.$movie->priceRent.'</span>
						<span class="md-price-buy">Buy: '.$movie->priceBuy.'</span>
					</div>
					<a href="http://www.movie-discovery.com/index.php?option=com_content&view=article&id='.$movie->id.'&a_aid='.$aid.'" class="md-btn md-trans" target="_blank">Click here</a>
				</span>
				<span class="md-powered-by"><a href="http://www.movie-discovery.com" target="_blank">www.movie-discovery.com</a></span>
				</div>
				<span class="md-title">'.$movie->title.'</span>
			</div></div></div>';
			
			return $return;
		
		}
		else {
			return '<span class="md-notice">Sorry no movie has matched your criteria<br /><br /><span class="md-powered-by"><a href="http://www.movie-discovery.com" target="_blank">www.movie-discovery.com</a></span></span>';
		}
		

	}

}
