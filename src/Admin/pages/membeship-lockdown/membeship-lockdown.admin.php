<?php
/**
 * Process the data
 *
 */
if ( isset( $_POST['submit'] ) ){

	if ( ! $this->form()->verify_nonce()  ) {
		wp_die($this->form()->user_feedback('error','Verification Failed !!!'));
	}

	// get the lcg_value
	$slockdown = $this->form()->input_val('membership_lockdown');

	// clean up before we save
	sanitize_text_field($slockdown);

	// numbers only
	if ( ! is_numeric($slockdown) ) {
		wp_die($this->form()->user_feedback('error','you need to choose something'));
	}

	// update the lockdown status
	update_option('mlockdown_status', $slockdown);

}
?><div class"lockdown">
		<div class"lockdown-status">
			<?php echo Si_Member_Lockdown::status() ?>
		</div>
		<hr/>
		<strong>Warning:</strong> When Membership Lockdown is turned on, all access to your entire site will be affected.
		<br/>
		* All content will be locked everywhere.
		<br/>
		* All data will be locked behind authentication
		<br/>
		* Including REST API data will not be available.
</div>
<hr/>
<div id="frmwrap" >
		<form action="" method="POST"	enctype="multipart/form-data"><?php
			// submit button
			echo Si_Member_Lockdown::lock_button();
	    // nonce_field
	    $this->form()->nonce();
	?></form>
</div><!--frmwrap-->
