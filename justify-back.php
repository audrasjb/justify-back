<?php

/**
 * @link              http://jeanbaptisteaudras.com/justify-back/
 * @since             1.0
 * @package           Bring back text justify
 *
 * @wordpress-plugin
 * Plugin Name:       Bring back text justify button !
 * Plugin URI:        http://jeanbaptisteaudras.com/justify-back/
 * Description:       Oh noes! WP 4.7 stole my text justify button! Please bring it back!
 * Version:           1.0
 * Author:            Jean-Baptiste Audras, project manager @ Whodunit
 * Author URI:        http://jeanbaptisteaudras.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       justify-back
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class justifyBack {
	function __construct() {
		if ( is_admin() ) {
			add_action( 'init', array(  $this, 'setup_justifyBack' ) );
		}
	}
	function setup_justifyBack() {
		// Check if the logged in WordPress User can edit Posts or Pages
		// If not, don't register
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        	return;
		}
		// Check if the logged in WordPress User has the Visual Editor enabled
		// If not, don't register
		if ( get_user_option( 'rich_editing' ) !== 'true' ) {
			return;
		}
		function mce_justifyBack( $mce_buttons ) {	
			$mce_buttons[] = 'alignjustify';
			return $mce_buttons;
		}	
		add_filter( 'mce_buttons_2', 'mce_justifyBack', 5 );
	}
}
$justifyBack = new justifyBack;