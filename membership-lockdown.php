<?php
/**
 * Membership Lock
 *
 * @package         MembershipLock
 * @author          Uriel Wilson
 * @copyright       2020 Uriel Wilson
 * @license         GPL-2.0
 * @link            https://urielwilson.com
 *
 * @wordpress-plugin
 * Plugin Name:       Membership Lock
 * Plugin URI:        https://wpbrisko.com/wordpress-plugins/
 * Description:       Membership Lock down lets you easily lock all post content including attached images, video, docs, and everything else.
 * Version:           2.5.0
 * Requires at least: 4.6
 * Requires PHP:      5.6
 * Author:            uriel
 * Author URI:        https://urielwilson.com
 * Text Domain:       membership-lock
 * Domain Path:       languages
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

	// deny direct access.
	if ( ! \defined( 'ABSPATH' ) ) {
	    exit;
	}

	// plugin directory.
	define( 'SWMLD_VERSION', '2.4.4' );

	// plugin directory.
	define( 'SWMLD_DIR', dirname( __FILE__ ) );

	// plugin url.
	define( 'SWMLD_URL', plugins_url( '/', __FILE__ ) );

	/**
	 * Load composer
	 */
	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

// -----------------------------------------------------------------------------

	// Activate.
	register_activation_hook( __FILE__, function() {
			update_option( 'mlockdown_status', 0 );
			update_option( 'mlock_basic_auth', 0 );
		}
	);

// ------------------------------------------------------------------------------

	// setup the lock.
	MembershipLock\LockItdown::setup()->lock();

	// enable basic auth.
	MembershipLock\BasicAuth::init();

	/**
	 * Load Admin Pages.
	 */
	if ( is_admin() ) :
		MembershipLock\Admin\MembershipAdmin::init();
	endif;
