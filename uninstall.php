<?php
/**
 *  Uninstall stuff.
 *  do some cleanup after user uninstalls the plugin
 *  ----------------------------------------------------------------------------
 *  -remove stuff
 * ----------------------------------------------------------------------------
 *
 * @category   Plugin
 * @copyright  Copyright © 2021 Uriel Wilson.
 * @package    MembershipLock
 * @author     Uriel Wilson
 * @link       https://switchwebdev.com
 *  ----------------------------------------------------------------------------
 */

	// Deny direct access.
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
		die;
	}

	/**
	 * Delete the plugin options
	 */
	delete_option( 'mlockdown_status' );
	delete_option( 'mlockdown_rest_api' );

	// clear the cache.
	wp_cache_flush();
