<?php
/**
 * Process the data
 * @var [type]
 */
if ( isset( $_POST['submit'] ) ){

	if ( ! $siform->verify_nonce()  ) {
		wp_die('Verification Failed !!!');
	}

	echo $siform->input_val('redirect_after_login');


}
?><div id="frmwrap" >
		<form action="" method="POST"	enctype="multipart/form-data"><?php
	        // open table
	        echo $siform->table('open');

					// Select
					$pages = $siform->page_list();
					echo $siform->select($pages,'Redirect After Login',true);

	        // close table
	        echo $siform->table('close');

	        // wp_nonce_field
	        $siform->nonce();

	        // submit button
	        echo get_submit_button('Add Video', 'button-primary button-hero ');

	      ?></form>
	    </div><!--frmwrap-->
