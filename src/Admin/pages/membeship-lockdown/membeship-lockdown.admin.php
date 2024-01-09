<?php

use MembershipLock\LockItdown;

if ( ! \defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Process the data
 */
if ( isset( $_POST['submit'] ) ) : // @codingStandardsIgnoreLine

	if ( ! $this->form()->verify_nonce() ) {
		wp_die( $this->form()->user_feedback( 'error', 'Verification Failed !!!' ) ); // @codingStandardsIgnoreLine
	}

	$slockdown = absint($this->form()->input_val( 'membership_lockdown' ));
	sanitize_text_field( $slockdown );
	if ( ! is_numeric( $slockdown ) ) {
		wp_die( $this->form()->user_feedback( 'error', 'you need to choose something' ) ); // @codingStandardsIgnoreLine
	}
	update_option( 'mlockdown_status', $slockdown );

endif;

/**
 * REST API
 */
if ( isset( $_POST['submit_rest_api'] ) ) : // @codingStandardsIgnoreLine

  if ( ! $this->form()->verify_nonce()  ) {
    wp_die($this->form()->user_feedback('Verification Failed !!!' , 'error'));
  }

  $mlockdown_rest_api = absint( $this->form()->input_val( 'mlockdown_rest_api' ) );
  if ( ! is_numeric( $mlockdown_rest_api ) ) {
	  wp_die( $this->form()->user_feedback( 'error', 'you need to choose something' ) ); // @codingStandardsIgnoreLine
  }
  update_option( 'mlockdown_rest_api', $mlockdown_rest_api );

endif;


/**
 * REST API
 */
if ( isset( $_POST['submit_basic_auth'] ) ) : // @codingStandardsIgnoreLine

	if ( ! $this->form()->verify_nonce()  ) {
	    wp_die($this->form()->user_feedback('Verification Failed !!!' , 'error'));
	}

	// make sure the constants are defined.
	if ( ! defined('BASIC_AUTH_USER') && ! defined('BASIC_AUTH_PASSWORD') ){
		echo $this->form()->user_feedback('You need to set BASIC_AUTH_USER and BASIC_AUTH_PASSWORD constant' , 'error');
	} else {
		$basic_auth_lock = absint( $this->form()->input_val( 'basic_auth_lockdown' ) );
	    if ( ! is_numeric( $basic_auth_lock ) ) {
	  	  wp_die( $this->form()->user_feedback( 'error', 'you need to choose something' ) ); // @codingStandardsIgnoreLine
	    }
	    update_option( 'mlock_basic_auth', $basic_auth_lock );
	}

endif;
?><div class"lockdown">
		<div class"lockdown-status">
			<?php
				echo LockItdown::setup()->get_lock_status( 'Lockdown', 'mlockdown_status' ); // @codingStandardsIgnoreLine
			?>
			<br/>
			<?php
				echo LockItdown::setup()->get_lock_status( 'Basic Authentication', 'mlock_basic_auth' ); // @codingStandardsIgnoreLine
			?>
		</div>
		<hr/>
		<strong>Warning:</strong> When Membership Lockdown is turned on, all access to your entire site will be affected.
		<br/>
		* All content will be locked everywhere.
		<br/>
		* All data will be locked behind authentication
		<br/>
		* You can choose to Enable the REST API.

		<hr/>
		<strong>Warning:</strong> If you use basic authentication:
		By checking this box, you ensure that users will need to provide authentication credentials to access the environment. By default, this feature is activated for both development (dev) and debug environments. You need to set BASIC_AUTH_USER and BASIC_AUTH_PASSWORD constant
</div>
<hr/>
<div id="frmwrap" >
	<form action="" method="POST"	enctype="multipart/form-data">
		<?php

			if ( get_option( 'mlockdown_status', false ) ) {
				echo LockItdown::setup()->rest_api_button(); // @codingStandardsIgnoreLine.
			}

			// LOCKDOWN submit button.
			echo LockItdown::setup()->lock_button(); // @codingStandardsIgnoreLine
			echo LockItdown::setup()->basic_auth_button(); // @codingStandardsIgnoreLine

			// nonce_field.
		    $this->form()->nonce();
		?>
	</form>
</div><!--frmwrap-->
