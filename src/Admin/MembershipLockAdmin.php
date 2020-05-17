<?php

use WPAdminPage\AdminPage;

final class MembershipLockAdmin extends AdminPage {
  /**
   * admin_menu()
   *
   * Main top level admin menus
   * @return [type] [description]
   */
  private static function admin_menu(){
    $menu = array();
    $menu[] = 'Membership Lockdown';
    $menu[] = 'Lockdown';
    $menu[] = 'manage_options';
    $menu[] = 'membeship-lockdown';
    $menu[] = 'memlockdown_callback';
    $menu[] = 'dashicons-lock';
    $menu[] = null;
    $menu[] = 'mls';
    $menu[] = plugin_dir_path( __FILE__ );
    return $menu;
  }

  /**
   * [whitelabeladmin description]
   * @return [type] [description]
   */
  public static function init(){
    return new MembershipLockAdmin(self::admin_menu());
  }
}

  // create admin pages
  MembershipLockAdmin::init();
