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

  public function __construct() {
    if (self::lockdown()) {
      add_action( 'init', array( $this, 'membershiplock'), 10 );
    }
    add_action( 'admin_enqueue_scripts', array( $this, 'si_lockdown_styles'), 10 );
  }

  /**
   * si_lockdown_styles
   * @return
   */
  public function si_lockdown_styles() {
    wp_enqueue_style( 'lockdown-style', plugin_dir_url( __FILE__ ) . 'includes/admin/css/slockdown.css', array(), SWMLD_VERSION, 'all' );
  }

  /**
   * Redirect to the Login Page
   *
   * all data will be locked behind authentication
   * REST API data will not be available.
   * TODO add a message to the rest API
   * @since 1.0
   */
  public function membershiplock() {
    if ( ! is_user_logged_in() ){
      if ($GLOBALS['pagenow'] === 'wp-login.php') {
        } else {
          wp_safe_redirect( wp_login_url() );
          exit;
      }
    }
  }

  /**
   * get the lockdown status
   * @return boolean
   */
  public static function lockdown(){
    $lockdown = get_option( 'mlockdown_status' );
    return $lockdown;
  }

  /**
   * Get the Lockdown status ON/OFF
   * @return string
   */
  public static function status(){
    if (self::lockdown()) {
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

  public static function lock_button(){
    if (self::lockdown()) {
      $button = '<input type="hidden" id="membership_lockdown" name="membership_lockdown" value="0">';
      $button .= get_submit_button('Deactivate', 'browser button-hero');
      return $button;
    } else {
      $button = '<input type="hidden" id="membership_lockdown" name="membership_lockdown" value="1">';
      $button .= get_submit_button('Activate', 'button-primary button-hero');
      return $button;
    }
  }
}
