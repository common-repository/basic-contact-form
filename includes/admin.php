<?php

		if (get_option('bcftitletext',true) == '1'){update_option('bcftitletext','');}
		if (get_option('bcfsubject',true) == '1'){update_option('bcfsubject','');}
		if (get_option('bcfredirect',true) == '1'){update_option('bcfredirect','');}
		
function whbcf_plugin_menu() {



	add_menu_page(__('Basic Contact Form'), __('Basic Contact Form'), 'manage_options', __FILE__,'whbcf_plugin_options'); 



}

add_action( 'admin_menu', 'whbcf_plugin_menu' );

function whbcf_plugin_options(){

if ( !current_user_can( 'manage_options' ) ){

		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );

						}
						echo '<div class="wrap">';

	echo '<h2>Contact Form Settings</h2>';

	echo '</div>';
	
	
	 if( isset($_POST[ 'bcftitle_hidden' ]) && $_POST[ 'bcftitle_hidden' ] == 'Y' ) 

	{

	$retrieved_nonce = $_REQUEST['_wpnonce'];

	if (!wp_verify_nonce($retrieved_nonce, 'bcf_admin_contact_form' ) ) die( 'Sorry security token has expired' );

	$title = sanitize_text_field ($_POST[ 'bcftitletext']);
	update_option( 'bcftitletext', $title );
	$subject = sanitize_text_field ($_POST[ 'bcfsubject']);
	update_option( 'bcfsubject', $subject );
	$redirectpage = sanitize_text_field ($_POST[ 'bcfredirect']);
	update_option( 'bcfredirect', $redirectpage );
	$fileuploader = sanitize_text_field ($_POST[ 'bcffileuploader']);
	if ($fileuploader == 'yes'){update_option( 'bcffileuploader', '2' );} else {update_option( 'bcffileuploader', '1' );}
}


?>

<table>

<form name="form" method="post" action="">

<?php wp_nonce_field('bcf_admin_contact_form'); ?>

<input type="hidden" name="bcftitle_hidden" value="Y">



<tr>
<td>
<p>
<input type="text" name="bcftitletext" value="<?php echo  esc_attr (get_option( 'bcftitletext', true )); ?>" >Title to use at top of message window
</p>
</td>
</tr>

<tr>
<td>
<p>
<input type="text" name="bcfsubject" value="<?php echo  esc_attr (get_option( 'bcfsubject', true )); ?>" >Subject of message
</p>
</td>
</tr>

<tr>
<td>
<p>
<input type="text" name="bcfredirect" value="<?php echo  esc_attr (get_option( 'bcfredirect', true )); ?>" >Send user to this page after submitting form leave blank for no redirection
</p>
</td>
</tr>

<tr>
<td>
<p>
<?php $fileuploader = get_option( 'bcffileuploader', true );  if ($fileuploader == '2') {$checked = 'checked';}?>
<input type="checkbox" <?php echo esc_attr( $checked ); ?> name="bcffileuploader" value="yes" >Check to display file upload field on form
</p>
</td>
</tr>
</table>

<p>
Use shortcode [basic_contact_form] on any page or widget.
</p>


<p class="submit">

<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />

</p>

</form>

</div>


<?php
}
