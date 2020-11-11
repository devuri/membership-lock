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
