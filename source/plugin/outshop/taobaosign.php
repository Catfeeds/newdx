<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$app_key = '21216498';/*��дappkey */
$secret='0118e1fc54055311afb447f32e8ae4b0';/* ��дappkey��Ӧ��secret */
$timestamp=time()."000"; 
$message = $secret.'app_key'.$app_key.'timestamp'.$timestamp.$secret; 
$mysign=strtoupper(hash_hmac("md5",$message,$secret)); 
setcookie("timestamp",$timestamp); 
setcookie("sign",$mysign);
?>


