<?php
namespace MembershipLock\Admin;

use MembershipLock\WPAdminPage\AdminPage;

final class MembershipAdmin extends AdminPage {

	/**
	 * Admin Menu
	 * Main tp level admin menus
	 *
	 * @return array $menu
	 */
	private static function admin_menu() {

	    $menu = array();
	    $menu['page_title']   = 'Membership Lockdown';
	    $menu['menu_title']   = 'Lockdown';
	    $menu['capability']   = 'manage_options';
	    $menu['menu_slug']    = 'membeship-lockdown';
	    $menu['function']     = 'memlockdown_callback';
	    $menu['icon_url']     = 'dashicons-lock';
	    $menu['position']     = null;
	    $menu['prefix']       = 'mls';
	    $menu['plugin_path']  = plugin_dir_path( __FILE__ );
		return $menu;
	}

	/**
	 * [whitelabeladmin description]
	 *
	 * @return [type] [description]
	 */
	public static function init() {
		return new MembershipAdmin( self::admin_menu() );
	}
}
