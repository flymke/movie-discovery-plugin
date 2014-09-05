<?php
/**
 * View for the administration dashboard.
 *
 * Movie Discovery
 *
 * @package   Movie_Discovery
 * @author    Michael Schoenrock <hello@michaelschoenrock.com>
 * @license   GPL-2.0+
 * @link      https://github.com/flymke/movie-discovery-plugin
 * @copyright 2014 Michael Schoenrock
 */
?>

<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function md_validate_form() {
	
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST['submit'] ) ) {
				
		if($_POST['md_aid']) {
		
			$option_name = 'md_aid';
			$new_value = $_POST['md_aid'];
			
			if ( get_option( $option_name ) !== false ) {
			
			    // The option already exists, so we just update it.
			    update_option( $option_name, $new_value );
			
			} else {
			
			    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
			    $deprecated = null;
			    $autoload = 'no';
			    add_option( $option_name, $new_value, $deprecated, $autoload );
			}
			
		}
		
		if($_POST['md_lang']) {
		
			$option_name = 'md_lang';
			$new_value = $_POST['md_lang'];
			
			if ( get_option( $option_name ) !== false ) {
			
			    // The option already exists, so we just update it.
			    update_option( $option_name, $new_value );
			
			} else {
			
			    // The option hasn't been added yet. We'll add it with $autoload set to 'no'.
			    $deprecated = null;
			    $autoload = 'no';
			    add_option( $option_name, $new_value, $deprecated, $autoload );
			}
			
		}
		
	}
	
}

function md_show_admin_settings() {
	
	$md_aid = get_option( 'md_aid' );
	if(!$md_aid) $md_aid = '';

	$md_lang = get_option( 'md_lang' );
	if(!$md_lang) $md_lang = '';
	
	?>
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="md_admin_form">
	
	<div>
		<label for="md_aid">Affiliate/Referral ID</label>
		<input type="text" name="md_aid" id="md_aid" value="<?php echo $md_aid; ?>" />
		
		<div>
			<small>Please go to &raquo; <a href="http://pap.movie-discovery.com" target="_blank">
			http://pap.movie-discovery.com</a> to obtain your personal affiliate ID.</small>
		</div>
	</div>
	
	<div>
	
		<label for="ms_lang">Select language</label>
		<select name="md_lang" id="md_lang" />
			<option value="en"<?php echo($md_lang == 'en') ? ' selected' : ''; ?>>en</option>
			<option value="heb"<?php echo($md_lang == 'heb') ? ' selected' : ''; ?>>heb</option>
		</select>
		
		<div>
			<small>This will be the default label language.</small>
		</div>
	
	</div>
	
	<?php submit_button(); ?>

	</form>

<?php } ?>

<div class="wrap">

	<?php screen_icon(); ?>
	
	<?php md_validate_form(); ?>
	
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	
	<?php md_show_admin_settings(); ?>
	
	<div class="md_copy">
		<hr />
		<a href="http://www.movie-discovery.com" target="_blank">Movie Discovery</a> | Version: <?php echo WP_MOVIE_DISCOVERY_VERSION; ?> | &copy; <?php echo date( 'Y' ); ?>
		<!-- Donate -->
		<!-- /Donate -->
	</div>

</div>
