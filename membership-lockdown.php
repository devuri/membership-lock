<?php
/**
 * Plugin Name: Membership Lockdown
 * Plugin URI:  https://switchwebdev.com/wordpress-plugins/
 * Description: Lockout everyone only registered website users will be able to access, If a user is not logged in we will redirect them to the login page.
 * Author:      SwitchWebdev.com
 * Author URI:  https://switchwebdev.com
 * Version:     1.3.0
 * License:     GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: sw-membership-lockdown
 *
 * Requires PHP: 5.4+
 * Tested up to PHP: 7.0
 *
 * Copyright 2020 Uriel Wilson, support@switchwebdev.com
 * License: GNU General Public License
 * GPLv2 Full license details in license.txt
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 * ----------------------------------------------------------------------------
 * @category  	Plugin
 * @copyright 	Copyright © 2020 Uriel Wilson.
 * @package   	MembershipLockdown
 * @author    	Uriel Wilson
 * @link      	https://switchwebdev.com
 *  ----------------------------------------------------------------------------
 */

  # deny direct access
    if ( ! defined( 'WPINC' ) ) {
      die;
    }

  # plugin directory
	  define("SWMLD_VERSION", '1.3.0');

  # plugin directory
    define("SWMLD_DIR", dirname(__FILE__));

  # plugin url
    define("SWMLD_URL", plugins_url( "/",__FILE__ ));
#  -----------------------------------------------------------------------------
/**
 *  Main Class
 *
 * Activate lockdonw based on given mlockdown_status
 *
 * @since 1.0
 */
final class swMember_Lockdown {

  public function __construct() {
    if ($this->lockdown()) {
      add_action( 'init', array( $this, 'membershiplock'), 99 );
    }
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
   * @return [bool]
   */
  public function lockdown(){
    $lockdown = get_option( 'mlockdown_status' );
    return $lockdown;
  }
}
#  ----------------------------------------------------------------------------
New swMember_Lockdown();

  /**
   * Setup the menu builder class
   *
   */
  if (!class_exists('Sim_Admin_Menu')) {
    include plugin_dir_path( __FILE__ ). 'includes/admin/class-sim-admin-menu.php';
   }

   /**
    * Form Class
    *
    */
   if (!class_exists('Sim_Form_Helper')) {
     include plugin_dir_path( __FILE__ ). 'includes/admin/class-sim-form-helper.php';
    }

  /**
   * Menu Item
   *
   */
  include plugin_dir_path( __FILE__ ). 'includes/admin/menu/lockdown.php';
