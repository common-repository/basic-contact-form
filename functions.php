<?php
/*

Version: 1.0.3

*/
//*********************************************************************************



function bcf_basic_contact_form_a(){
	global $a;
		if(isset($_COOKIE['bcf'])) 
		{
		$a = $_COOKIE['bcf'];
		}
			$title = '';
			$surname = '';
			$firstname = '';
			$initals = '';
			$youremail = '';
			$address1 = '';
			$address2 = '';
			$address3 = '';
			$address4 = '';
			$address5 = '';
			$telephone = '';
			$message = '';
			$captcha = '';
			$filename = '';
		
		

	
		$admin_email = get_option( 'admin_email', $default );
		$headtitle = get_option( 'bcftitletext', true );
		$from = get_bloginfo();
		$subject = get_option( 'bcfsubject', true );
		$redirectpage = get_option( 'bcfredirect', true );
		$fileuploader = get_option('bcffileuploader',true);
		
		
		
			if($_POST['Submit'] == "Send")

			{
	  
			$retrieved_nonce = $_REQUEST['_wpnonce'];
			if (!wp_verify_nonce($retrieved_nonce, 'bcf_send' ) ) die( 'Sorry security token has expired' );
			$errorMessage = "";
			$a = sanitize_text_field($_POST['catcherror']);
	
//		 if(empty($_POST['catcherror']))
//	 {



		if (get_option('bcftitle'.$a,true) == '1'){ update_option('bcftitle'.$a,'');}
		if (get_option('bcfsurname'.$a,true) == '1'){ update_option('bcfsurname'.$a,'');}
		if (get_option('bcffirstname'.$a,true) == '1'){ update_option('bcffirstname'.$a,'');}
		if (get_option('bcfinitals'.$a,true) == '1'){ update_option('bcfinitals'.$a,'');}
		if (get_option('bcfyouremail'.$a,true) == '1'){ update_option('bcfyouremail'.$a,'');}
		if (get_option('bcfaddress1'.$a,true) == '1'){ update_option('bcfaddress1'.$a,'');}
		if (get_option('bcfaddress2'.$a,true) == '1'){ update_option('bcfaddress2'.$a,'');}
		if (get_option('bcfaddress3'.$a,true) == '1'){ update_option('bcfaddress3'.$a,'');}
		if (get_option('bcfaddress4'.$a,true) == '1'){ update_option('bcfaddress4'.$a,'');}
		if (get_option('bcfaddress5'.$a,true) == '1'){ update_option('bcfaddress5'.$a,'');}
		if (get_option('bcftelephone'.$a,true) == '1'){ update_option('bcftelephone'.$a,'');}
		if (get_option('bcfmessage'.$a,true) == '1'){update_option('bcfmessage'.$a,'');}
		if (get_option('bcffilename'.$a,true) == '1'){update_option('bcffilename'.$a,'');}






												if ($_FILES["file"]["name"] <> "")
												{
												$temp = sanitize_text_field ($_FILES["file"]["name"]);
												$temp2 = explode(".", $temp);
												$filetype = wp_check_filetype($temp);
												
		if (!preg_match("#^[a-zA-Z0-9]+$#", $filename)) { update_option('bcffilename',$filename);}
		else {$errorMessage .= "<li>Filename contains characters which are not allowed</li>";}
												
														if (($filetype['type'] == 'application/msword') 
														||  ($filetype['type'] == 'text/plain') 
														|| ($filetype['type'] == 'application/pdf') 
														||($filetype ['type'] == 'application/vnd.msword') 
														||($filetype ['type'] == 'application/vnd.ms-word') 
														||($filetype ['type'] == 'application/word') 
														||($filetype ['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') 
														||($filetype ['type'] == 'application/rtf') 
														||($filetype ['type'] == 'image/jpeg') 
														||($filetype ['type']== 'image/gif')
														||($filetype ['type']== 'image/png') 
														||($filetype ['type']== 'image/jpg'))
															{
	  

																if (sanitize_text_field($_FILES["file"]["error"] > 0))
																	{
																	$errorMessage .= "<li> Error:" . sanitize_text_field($_FILES["file"]["error"]) ."</li>";	
																	}
																	else
																		{
																		$uploads_url = wp_upload_dir() ;
																		$upload_dir = $uploads_url['basedir'];
																		$upload_dir2 = $upload_dir . '/bcf_uploads/';
																			if (! is_dir($upload_dir2)) {wp_mkdir_p( $upload_dir2);}
																			$uploads_url = $upload_dir2;
																			move_uploaded_file(sanitize_text_field($_FILES["file"]["tmp_name"]), $uploads_url . sanitize_text_field ($_POST['firstname']) . '.'.sanitize_text_field ($_POST['surname']) .'_' . sanitize_text_field($_FILES["file"]["name"]));
																		}
															} // end of if (($filetype['type'] == 'application/msword') 
					else

					{
						if (sanitize_text_field($_FILES["file"]["size"] > 1000000))
						{
						$errorMessage .= "<li> Filesize is too large please upload a smaller file max size 1000000 bytes (976Kb)</li>";
						}
 
					}

												} // end of if ($_FILES["file"]["name"] <> "")
													
												
	$randomnumber = sanitize_text_field($_POST['captchanumber']);
	if ($randomnumber == '1'){$captchanumber = 'afh7';}
	if ($randomnumber == '2'){$captchanumber = '5gt9';}
	if ($randomnumber == '3'){$captchanumber = '95tg';}
	if ($randomnumber == '4'){$captchanumber = 'jqkp';}




											if(empty($_POST['title']))
											  {
												$errorMessage = "<li>You forgot to select a title</li>";
											  }
											if(empty($_POST['surname']))
											  {
												$errorMessage .= "<li>You forgot to enter your surname</li>";
											  }
											if(empty($_POST['firstname']))
											  {
												$errorMessage .= "<li>You forgot to enter your firstname</li>";
											  }
											if(empty($_POST['youremail']))
											  {
												$errorMessage .= "<li>You forgot to enter your email</li>";
											  }
											if(empty($_POST['message']))
											 {
											   $errorMessage .= "<li>You forgot to enter your message</li>";
											  }
											
											if(empty($_POST['telephone']))
											  {
												$errorMessage .= "<li>You forgot to enter your telephone number</li>";
											  }
											  
													if(empty($_POST['yourcode']))
													{
														$errorMessage .= "<li>You forgot to enter the code</li>";
													}
														else
														
														
															if(sanitize_text_field($_POST['yourcode']<> $captchanumber))
															{
																$errorMessage .= "<li>You entered an incorrect code</li>";
															}
															
															


	$title = sanitize_text_field($_POST['title']);
	$surname = sanitize_text_field($_POST['surname']);
	$firstname = sanitize_text_field($_POST['firstname']);
	$initals = sanitize_text_field($_POST['initals']);
	$youremail = sanitize_text_field($_POST['youremail']);
	$address1 = sanitize_text_field($_POST['address1']);
	$address2 = sanitize_text_field($_POST['address2']);
	$address3 = sanitize_text_field($_POST['address3']);
	$address4 = sanitize_text_field($_POST['address4']);
	$address5 = sanitize_text_field($_POST['address5']);
	$telephone = sanitize_text_field($_POST['telephone']);
	$message = sanitize_text_field($_POST['message']);
	$captcha = sanitize_text_field($_POST['yourcode']);
	$filename = sanitize_text_field($_FILES["file"]["name"]);
	
	if(!empty($errorMessage))
				{ 

	update_option('bcftitle'.$a,$title);
	update_option('bcfsurname'.$a,$surname);
	update_option('bcffirstname'.$a,$firstname);
	update_option('bcfinitals'.$a,$initals);
	if (!filter_var($youremail, FILTER_VALIDATE_EMAIL) === false) { update_option('bcfyouremail'.$a,$youremail);}
	update_option('bcfaddress1'.$a,$address1);
	update_option('bcfaddress2'.$a,$address2);
	update_option('bcfaddress3'.$a,$address3);
	update_option('bcfaddress4'.$a,$address4);
	update_option('bcfaddress5'.$a,$address5);
	update_option('bcftelephone'.$a,$telephone);
	update_option('bcfmessage'.$a,$message);

				echo("<p>There was an error with your form:</p>\n");
				echo("<ul>" . $errorMessage . "</ul>\n");
goto ERROR1;
			
				


				} 

							else

{


$bodymessage ='<html><head><title>' . $headtitle . '</title></head><body><p><b>Message From ' . $from . '</b></p><br>';
$bodymessage .= '<b>Name:</b> ' . $title . " " . $firstname ." " . $initals . " " . $surname . '<br><br>' ;
$bodymessage .= '<b>Street Address:</b> ' . $address1 . ' ' . $address2 . '<br><br>';
$bodymessage .= '<b>Town/City:</b> ' . $address3 . '<br><br>';
$bodymessage .= '<b>County:</b> ' . $address4 . '<br><br>';
$bodymessage .= '<b>Postcode/Zip:</b> ' . $address5 . '<br><br>';
$bodymessage .= '<b>Telephone:</b>' . $telephone . '<br><br>';
$bodymessage .= '<b>Message:</b>' . $message . '<br><br>';
if ($filename > ''){
$bodymessage .= '<b>Uploaded file:</b>' . $firstname . '.' . $surname . '_' . $filename . '<br><br>';
}
$bodymessage .= '</body></html>';
$body_message  = 'From: '.$firstname . " " . $surname."\r\n";
$body_message .= 'E-mail: '.$youremail."\r\n";
$body_message .= $bodymessage;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:' . $youremail . "\r\n";
$mail_to = $admin_email;

		if(mail($mail_to, $subject, $body_message, $headers))
		{

			echo "The email was sent " ;
delete_bcf_data($a);

		} 

			else

			{

			echo "There was an error sending the mail.";
	delete_bcf_data($a);
			}




}
	?>
<br />
<?php
$url = site_url() . '/';
if ($redirectpage >''){


									?>
									<script>
									setTimeout(function() {
									window.location.href = "<?php echo $url . $redirectpage;?>";
									}, 2000);
									</script>
									<?php
									// delete_bcf_data($a);
									echo "please wait while we redirect you";
									delete_bcf_data($a);
								}
								goto EXIT2;
	
	
	
	
	
	
	
	// }
	 }
	ERROR1:

if(!get_option('bcftitle'.$a)){$title = "";$title_selected = 'Mr';} else {$title = get_option('bcftitle'.$a,true);}

if(!get_option('bcfsurname'.$a)){$surname = "";} else {$surname = get_option('bcfsurname'.$a,true);}

if(!get_option('bcffirstname'.$a)){$firstname = "";} else {$firstname = get_option('bcffirstname'.$a,true);}

if(!get_option('bcfinitals'.$a)){$initals = "";} else {$initals = get_option('bcfinitals'.$a,true);}

if(!get_option('bcfyouremail'.$a)){$youremail = "";} else {$youremail = get_option('bcfyouremail'.$a,true);}

if(!get_option('bcfaddress1'.$a)){$address1 = "";} else {$address1 = get_option('bcfaddress1'.$a,true);}

if(!get_option('bcfaddress2'.$a)){$address2 = "";} else {$address2 = get_option('bcfaddress2'.$a,true);}

if(!get_option('bcfaddress3'.$a)){$address3 = "";} else {$address3 = get_option('bcfaddress3'.$a,true);}

if(!get_option('bcfaddress4'.$a)){$address4 = "";} else {$address4 = get_option('bcfaddress4'.$a,true);}

if(!get_option('bcfaddress5'.$a)){$address5 = "";} else {$address5 = get_option('bcfaddress5'.$a,true);}

if(!get_option('bcftelephone'.$a)){$telephone = "";} else {$telephone = get_option('bcftelephone'.$a,true);}

if(!get_option('bcfmessage'.$a)){$message = "";} else {$message = get_option('bcfmessage'.$a,true);}

if(!get_option('bcffilename'.$a)){$filename = "";} else {$filename = get_option('bcffilename'.$a,true);}







?>
<div class="index-page">

<div class="gennoe-form-box">
<form action="" method="post" enctype="multipart/form-data">
<?php wp_nonce_field('bcf_send'); ?>
<p>   Title (required)<br>
<select name="title">
<?php

if ($title_selected == 'Mr') { ?> <option value="Mr" selected >Mr</option> <?php } else { ?> <option value="Mr">Mr</option> <?php }
if ($title_selected == 'Mrs') { ?> <option value="Mrs" selected >Mrs</option> <?php } else { ?> <option value="Mrs">Mrs</option> <?php }
if ($title_selected == 'Miss') { ?> <option value="Miss" selected >Miss</option> <?php } else { ?> <option value="Miss">Miss</option> <?php }
if ($title_selected == 'Ms') { ?> <option value="Ms" selected >Ms</option> <?php } else { ?> <option value="Ms">Ms</option> <?php }
if ($title_selected == 'Dr') { ?> <option value="Dr" selected >Dr</option> <?php } else { ?> <option value="Dr">Dr</option> <?php }
?>
</select>
</p>
<p> Your Surname (required)<br>
<input type="text" pattern="[A-Za-z]{1,20}" name="surname" value="<?php echo esc_attr ($surname);?>">
</p>
<p> Your First Name (required)<br>
<input type="text" pattern="[A-Za-z]{1,10}" name="firstname" value="<?php echo esc_attr($firstname);?>">
</p>

<p>   Your Initals <br>
    <input type="text" pattern="[A-Za-z]{1,2}" name="initals" value="<?php echo esc_attr($initals);?>">
</p>

<p>   Your e-mail (required)<br>
    <input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="youremail" value="<?php echo esc_attr($youremail);?>">
</p>


<p>    House/Flat No / Name <br>
    <input type="text" size="10" name="address1"  value="<?echo esc_attr($address1);?>">
</p> 
   
<p>    Street<br>
    <input type="text" name="address2" value="<?echo esc_attr($address2);?>">
</p>   

<p>    Town / City<br>
    <input type="text"  name="address3" value="<?echo esc_attr($address3);?>">
</p>   
 
 <p>    County<br>
    <input type="text"  name="address4" value="<?echo esc_attr($address4);?>">
</p>   
 
 <p>    Postcode / Zipcode<br>
    <input type="text"  size="20" name="address5" value="<?echo esc_attr($address5);?>">
</p>    

<p> Your Telephone No (required)<br>
<input type="text" pattern="[0-9 ]{1,14}" name="telephone" value="<?php echo esc_attr($telephone);?>">
</p>

<p>    Your Message (required)<br>
    <textarea name="message"  cols="60" rows="5" ><?echo esc_attr($message);?></textarea><br>
</p>
<?php if ($fileuploader == '2'){?>
<p> upload your file (please upload doc, pdf, txt, rtf, jpg, png formats only) filename must only contain letters, numbers, hyphens, underscores and periods<br>
<input type="file" name="file" id="file"><br>
</p>
<?php } ?>
<p> Input The Code<br>
<?php
$randomnumber = rand(1, 4);
?>
<img src="<?php echo plugins_url()?>/basic-contact-form/captcha/captcha<?php echo $randomnumber;?>.png" alt="captcha Image">
<input type="text"  name="yourcode"> 
<input type="hidden" name="captchanumber" value="<?php echo $randomnumber?>">
<input type="hidden" name="catcherror" value="<?php echo $a?>">
</p>  
    <input type="submit" name="Submit" value="Send">
    <input type="reset" value="Clear">
</form>
</div></div>
<?php
EXIT2:
}
add_shortcode('basic_contact_form','bcf_basic_contact_form_a');

function delete_bcf_data($a){
	global $a;
	
	$title = '';
 $surname = '';
 $firstname = '';
 $initals = '';
 $youremail = '';
 $address1 = '';
 $address2 = '';
 $address3 = '';
 $address4 = '';
 $address5 = '';
 $telephone = '';
 $message = '';
 $captcha = '';
 $filename = '';

 
delete_option( 'bcftitle'.$a );
delete_option( 'bcfsurname'.$a );
delete_option( 'bcffirstname'.$a );
delete_option( 'bcfinitals'.$a );
delete_option( 'bcfyouremail'.$a );
delete_option( 'bcfaddress1'.$a );
delete_option( 'bcfaddress2'.$a );
delete_option( 'bcfaddress3'.$a );
delete_option( 'bcfaddress4'.$a );
delete_option( 'bcfaddress5'.$a );
delete_option( 'bcftelephone'.$a );
delete_option( 'bcfmessage'.$a );
delete_option( 'bcffilename'.$a );
	

	
}
add_shortcode('delete_bcf_data','delete_bcf_data');