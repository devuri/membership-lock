<?php

  if (!is_user_logged_in()) {
    wp_die();
  }

  if (!current_user_can($this->capability)) {
    wp_die();
  }
	// thickbox support
	add_thickbox();

?><div id="wll-important-notice">
  <span class="wll-notice-message">
    <!-- notes -->
  </span>
</div>
<header class="wll-header"><?php
    if (!$this->admin_submenu) {
      // do not show for admin submenu setttings pages
        echo $this->menu_title();
        $this->tab_menu();
    } elseif ($this->admin_submenu) {
      #admin submenu items
      echo '<h2>';
      echo ucwords(
      //  str_replace( '-', ' ',$this->get_thepage_name())
      );
      echo '</h2>';
      echo '<hr>';
      }
?></header>
	<div class="wrap"><h2></h2></div><!---admin notices -->
	<div class="wll-container">
	  <div class="wll-child">
	    	<div class="wll-grid-item">
	      	<div class="wll-padding">
						<p><!---innner paragraph -->
