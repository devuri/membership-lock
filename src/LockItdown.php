<?php

namespace MembershipLock;

/**
 *  Main Class
 *
 * Activate lockdonw based on given mlockdown_status
 *
 * @since 1.0
 */
final class LockItdown {

	/**
	 * Private $instance
	 *
	 * @var $instance
	 */
	private static $instance;

	/**
	 * [setup description]
	 *
	 * @return [type] [description]
	 */
	public static function setup() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new LockItdown();
		}
		return self::$instance;
	}

	/**
	 * [__construct description]
	 */
	private function __construct() {
	    // nothing to do here.
	}

	/**
	 * Lock
	 *
	 * @return void
	 */
	public function lock() {
		if ( $this->lockdown() ) {
		  	add_action( 'init', array( $this, 'membershiplock' ), 10 );
		}
	}

	/**
	 * Checks if the current request is a WP REST API request.
	 *
	 * @returns boolean
	 * @link https://gist.github.com/devuri/f9654cc59a2a4251005ac1be0ff1a9af
	 */
	public function is_rest() {
		$prefix = rest_get_url_prefix( );
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST
			|| isset($_GET['rest_route'])
				&& strpos( trim( $_GET['rest_route'], '\\/' ), $prefix , 0 ) === 0)
				return true;
		global $wp_rewrite;
		if ( $wp_rewrite === null ) $wp_rewrite = new WP_Rewrite();
		$rest_url = wp_parse_url( trailingslashit( rest_url( ) ) );
		$current_url = wp_parse_url( add_query_arg( array( ) ) );
		return strpos( $current_url['path'], $rest_url['path'], 0 ) === 0;
	}

	/**
	 * WordPress REST API.
	 *
	 * Checks if we should lock the the WordPress REST API.
	 *
	 * @return bool
	 */
	public function disable_rest_api() {

		if ( get_option( 'mlockdown_rest_api', false ) ) {
			return true;
		}
		return false;
	}

  	/**
  	 * Redirect to the Login Page
  	 * all data will be locked behind authentication
  	 * REST API data will not be available.
  	 *
  	 * TODO add a message to the rest API
  	 *
  	 * @link https://developer.wordpress.org/reference/functions/auth_redirect/
  	 */
	public function membershiplock() {

		global $pagenow;

		if ( $this->disable_rest_api() && $this->is_rest() ) {
			return;
		}

	    if ( ! is_user_logged_in() ) {

			if ( 'wp-login.php' !== $pagenow ) {
				auth_redirect();
			}
	    }
	}

  	/**
  	 * Get the lockdown status
  	 *
  	 * @return boolean
  	 */
	public function lockdown() {
	    $lockdown = get_option( 'mlockdown_status' );
	    return $lockdown;
	}

  	/**
  	 * Get the Lockdown status ON/OFF
  	 *
  	 * @return string
  	 */
	public function status() {
	    if ( $this->lockdown() ) {
	      	return 'Status: <span style="
	        text-align: center;
	        border: solid 2px #02af07;
	        color: #02af07;
	        width: 100px;
	        font-weight: 600;
	        text-transform: capitalize;
	        padding-left: 8px;
	        padding-right: 8px;" class="lockdown status-on">enabled</span>';
	    } else {
	      	return 'Status: <span style="
	        text-align: center;
	        border: solid 2px #af0202;
	        color: #af0202;
	        width: 100px;
	        font-weight: 600;
	        text-transform: capitalize;
	        padding-left: 8px;
	        padding-right: 8px;" class="lockdown status-on">disabled</span>';
	    }
	}

	/**
	 * The REST API button
	 *
	 * @return string button
	 */
	public function rest_api_button() {
	    if ( get_option( 'mlockdown_rest_api', false ) ) {
		    $button = '<input type="hidden" id="mlockdown_rest_api" name="mlockdown_rest_api" value="0">';
		    $button .= get_submit_button( 'Disable REST API', 'primary', 'submit_rest_api');
		    return $button;
	    } else {
	      	$button = '<input type="hidden" id="mlockdown_rest_api" name="mlockdown_rest_api" value="1">';
	      	$button .= get_submit_button( 'Enable REST API', 'primary', 'submit_rest_api');
	      	return $button;
	    }
	}

	/**
	 * The lock button
	 *
	 * @return string button
	 */
	public function lock_button() {
	    if ( $this->lockdown() ) {
		    $button = '<input type="hidden" id="membership_lockdown" name="membership_lockdown" value="0">';
		    $button .= get_submit_button( 'Deactivate', 'browser button-hero' );
		    return $button;
	    } else {
	      	$button = '<input type="hidden" id="membership_lockdown" name="membership_lockdown" value="1">';
	      	$button .= get_submit_button( 'Activate', 'button-primary button-hero' );
	      	return $button;
	    }
	}
}
