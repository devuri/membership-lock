<?php

  if (!is_user_logged_in()) {
    wp_die();
  }
    /**
     * run any additional PHP stuff here
     */
    Sim_Admin_Menu::admin_header();

?><head>
<meta charset="UTF-8">
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.1/dist/css/uikit.min.css" />

</head>
<header class="sw-header">
</header>
<div class="swa-container">
  <div class="swa-wrap"><?php

          if (!$this->admin_smenu) {

              // do not show for admin submenu setttings pages
              echo $this->get_menu_title();
              $this->dynamic_tab_menu();

            } elseif ($this->admin_smenu) {

              #admin submenu items
              echo '<h2>';
              echo ucwords(
                str_replace( '-', ' ',$this->get_thepage_name())
              );
              echo '</h2>';
              echo '<hr>';
            }


         ?><div class="swa-child">
            <div class="swa-grid-item">
                <div class="swa-padding">
                    <p><!---innner paragraph -->
