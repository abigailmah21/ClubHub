<?php
ob_start();
ini_set('date.timezone','Asia/Kuala_Lumpur');
date_default_timezone_set('Asia/Kuala_Lumpur');
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;

function redirect($url=''){
	if(!empty($url))
	echo '<script>location.href="'.base_url .$url.'"</script>';
}
function validate_image($file){
    $ex_file = explode("?",$file)[0];
	if(!empty($ex_file)){
			// exit;
		if(is_file(base_app.$ex_file)){
			return base_url.$file;
		}else{
			return base_url.'uploads/defaults/no-image-available.png';
		}
	}else{
		return base_url.'uploads/defaults/no-image-available.png';
	}
}
function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..  
    return false;
}
ob_end_flush();
?>