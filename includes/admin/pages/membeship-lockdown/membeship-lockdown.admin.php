<?php
/**
 * Process the data
 * @var [type]
 */
if ( isset( $_POST['submit'] ) ){

	if ( ! $siform->verify_nonce()  ) {
		wp_die('Verification Failed !!!');
	}

	echo $siform->input_val('youtube_video_url');


}
?><div id="frmwrap" >
		<form action="" method="POST"	enctype="multipart/form-data"><?php
	        // open table
	        echo $siform->table('open');

	        // Video Title
	        echo $siform->input('YouTube Video Url',true);

	        // Category
	        echo $siform->categorylist('Video Category');

	        // Description
	        echo $siform->textarea('Description',true);

	        // Tags
	        echo $siform->input('Post Tags');

	        // close table
	        echo $siform->table('close');


	        // wp_nonce_field
	        $siform->nonce();

	        // submit button
	        echo get_submit_button('Add Video', 'button-primary button-hero ');

	      ?></form>
	    </div><!--frmwrap-->
Where do you want to redirect users
	<select name="page-dropdown">
 <option value="">
<?php echo esc_attr( __( 'Select page' ) ); ?></option>
 <?php
  $pages = get_pages();
  foreach ( $pages as $page ) {
    $option = '<option value="' . get_page_link( $page->ID ) . '">';
    $option .= $page->post_title;
    $option .= '</option>';
    echo $option;
  }
 ?>
</select>

<hr/>
 Also redirect after login :
 	<select name="page-dropdown">
  <option value="">
 <?php echo esc_attr( __( 'Select page' ) ); ?></option>
  <?php
   $pages = get_pages();
   foreach ( $pages as $page ) {
     $option = '<option value="' . get_page_link( $page->ID ) . '">';
     $option .= $page->post_title;
     $option .= '</option>';
     echo $option;
   }
  ?>
</select>
