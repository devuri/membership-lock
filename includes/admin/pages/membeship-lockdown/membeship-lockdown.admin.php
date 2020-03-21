<?php
/**
 * Process the data
 *
 */
if ( isset( $_POST['submit'] ) ){

	$siform->processing = true;

	if ( ! $siform->verify_nonce()  ) {
		wp_die($siform->user_feedback('error','Verification Failed !!!'));
	}

	// get the lcg_value
	$slockdown = $siform->input_val('membership_lockdown');

	// clean up before we save
	sanitize_text_field($slockdown);

	// numbers only
	if ( ! is_numeric($slockdown) ) {
		wp_die($siform->user_feedback('error','you need to choose something'));
	}

	// update the lockdown status
	update_option('mlockdown_status', $slockdown);

}
?><div class"lockdown-status">
	Status: <?php echo Si_Member_Lockdown::status() ?>
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
<?php if ( ! $siform->processing ): ?>
		<form action="" method="POST"	enctype="multipart/form-data"><?php
	    // open table
	    echo $siform->table('open');

			// Turn On Lockdown
			$lockdown = array('Off','On');
			echo $siform->select($lockdown,'Membership Lockdown');

	    // close table
	    echo $siform->table('close');

	    // nonce_field
	    $siform->nonce();

	    // submit button
	    echo get_submit_button('Save', 'button-primary button-hero ');

	?></form>
<?php endif;

if ($siform->processing) {
	echo '<a class="browser button button-hero" href="'.admin_url('/admin.php?page=membeship-lockdown').'">Back</a>';
}
?>
</div><!--frmwrap-->
