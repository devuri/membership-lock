<?php
/**
 * Membership Lock
 *
 * @package           MembershipLock
 * @author            Uriel Wilson
 * @copyright         2020 Uriel Wilson
 * @license           GPL-2.0
 * @link           		https://urielwilson.com
 *
 * @wordpress-plugin
 * Plugin Name:       Membership Lock
 * Plugin URI:        https://switchwebdev.com/wordpress-plugins/
 * Description:       Membership Lock down lets you easily lock all post content including attached images, video, docs, and everything else.
 * Version:           2.3.1
 * Requires at least: 3.4
 * Requires PHP:      5.6
 * Author:            SwitchWebdev.com
 * Author URI:        https://switchwebdev.com
 * Text Domain:       membership-lock
 * Domain Path:       languages
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

  # deny direct access
    if ( ! defined( 'WPINC' ) ) {
      die;
    }

  # plugin directory
	  define("SWMLD_VERSION", '2.3.1');

  # plugin directory 
    define("SWMLD_DIR", dirname(__FILE__));

  # plugin url
    define("SWMLD_URL", plugins_url( "/",__FILE__ ));
#  -----------------------------------------------------------------------------

//Activate
register_activation_hook( __FILE__, 'membershiplockdown_activation' );
function membershiplockdown_activation() {

  // add option
  $lockdown_status = 0;
  update_option('mlockdown_status', $lockdown_status);
}

#  ----------------------------------------------------------------------------

  /**
	 * Load admin page class via composer
	 */
	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

  # lock down class
  New MembershipLock\LockItdown();

  /**
   * Load Admin Pages
   */
  MembershipLock\Admin\MembershipAdmin::init();
