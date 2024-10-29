<?php

/*

Plugin Name: Basic-Contact-Form

Plugin URI: http://www.web-uk.co.uk/wordpress/plugins/

Description: Basic contact form

Version: 1.0.3

Author: D.J.Gennoe

Author URI: http://www.web-uk.co.uk

*/

//*********************************************************************************



defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('BCF_FILEPATH', plugin_dir_path(__FILE__));



if(!isset($_COOKIE['bcf'])) {
	
	LOOP1:
if ($count>100){goto exit1;}
$a = rand(1000, 10000);
 if(get_option('bcftitle'.$a)){$count++;goto LOOP1;}
setcookie("bcf", $a, time()+300);
}
else {$a = $_COOKIE['bcf'];}

exit1:

if ( is_admin() ) {

     // We are in admin mode



require_once (BCF_FILEPATH."includes/admin.php" );

}

require_once (BCF_FILEPATH."functions.php" );

delete_bcf_data($a);

add_filter('widget_text', 'do_shortcode');
