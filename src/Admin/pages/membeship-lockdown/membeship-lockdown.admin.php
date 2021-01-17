<?php

use MembershipLock\LockItdown;

/**
 * Process the data
 */
if ( isset( $_POST['submit'] ) ) { // @codingStandardsIgnoreLine

	if ( ! $this->form()->verify_nonce() ) {
		wp_die( $this->form()->user_feedback( 'error', 'Verification Failed !!!' ) ); // @codingStandardsIgnoreLine
	}

	// get rest api val.
	$disable_rest_api = $this->form()->input_val( 'disable_rest_api' );
	if ( 'on' === $disable_rest_api ) {
		$disable_rest_api = 1;
	} else {
		$disable_rest_api = 0;
	}
	$disable_rest_api = absint( $disable_rest_api );
	//update_option( 'mlockdown_rest_api', $disable_rest_api );

	// get lockdown val
	$slockdown = $this->form()->input_val( 'membership_lockdown' );

	// clean up before we save.
	sanitize_text_field( $slockdown );

	// numbers only.
	if ( ! is_numeric( $slockdown ) ) {
		wp_die( $this->form()->user_feedback( 'error', 'you need to choose something' ) ); // @codingStandardsIgnoreLine
	}

	// update the lockdown status.
	update_option( 'mlockdown_status', $slockdown );

}
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
		* You can choose to Disable the REST API.
		<br/>
		* If not checked the REST API data will be available.
</div>
<hr/>
<div id="frmwrap" >
	<form action="" method="POST"	enctype="multipart/form-data">
		<?php
			// checkbox.
			$color    = '#424242';
			$checkbox = '<div id="rest_api_checkbox" style="color:' . $color . ';font-weight:600">';
			$checkbox .= '<input type="checkbox" id="disable_rest_api" name="disable_rest_api" style="margin:unset;">';
			$checkbox .= '<label for="disable_rest_api" style="padding-left: 0.5em;"> Disable REST API</label>';
			$checkbox .= '</div>';
			echo $checkbox;

			// submit button.
			echo LockItdown::setup()->lock_button(); // @codingStandardsIgnoreLine

			// nonce_field.
		    $this->form()->nonce();
		?>
	</form>
</div><!--frmwrap-->
<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {

		// selection
		jQuery('input[type="checkbox"]').on('click', function( event ){
			$(this).parent().css('background-color', '#fff').css('color', '#424242');
				if ($(this).is(":checked")) {
					$(this).parent().css('background-color', '#fff').css('color', '#b9b9b9');
			}
		});

	});
</script>
