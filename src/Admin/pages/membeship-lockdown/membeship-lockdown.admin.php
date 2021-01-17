<?php

use MembershipLock\LockItdown;

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
?><div class"lockdown">
		<div class"lockdown-status">
			<?php
				echo LockItdown::setup()->status() // @codingStandardsIgnoreLine
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
</div>
<hr/>
<div id="frmwrap" >
	<form action="" method="POST"	enctype="multipart/form-data">
		<?php

			// REST API submit button.
			echo LockItdown::setup()->rest_api_button(); // @codingStandardsIgnoreLine

			// LOCKDOWN submit button.
			echo LockItdown::setup()->lock_button(); // @codingStandardsIgnoreLine

			// nonce_field.
		    $this->form()->nonce();
		?>
	</form>
</div><!--frmwrap-->
