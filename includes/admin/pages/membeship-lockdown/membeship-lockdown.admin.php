<?php
/**
 * Process the data
 *
 */
if ( isset( $_POST['submit'] ) ){

	$processing = true;

	if ( ! $siform->verify_nonce()  ) {
		wp_die('Verification Failed !!!');
	}

	echo $siform->input_val('redirect_after_login');

}
?><div id="frmwrap" >
		<form action="" method="POST"	enctype="multipart/form-data"><?php
	    // open table
	    echo $siform->table('open');

			// Turn On Lockdown
			$lockdown = array('Off','On');
			echo $siform->select($lockdown,'Turn On Lockdown');

			// Redirect
			$pages = $siform->page_list();
			echo $siform->select($pages,'Redirect After Login');

	    // close table
	    echo $siform->table('close');

	    // nonce_field
	    $siform->nonce();

	    // submit button
	    echo get_submit_button('Save', 'button-primary button-hero ');

	?></form>
</div><!--frmwrap-->
