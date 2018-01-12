<?php

require './source/class/class_core.php';
require_once './source/function/function_core.php';

$discuz = & discuz_core::instance();
$discuz->init();

$mod = $_REQUEST['mod'];

$connect_mod = array('sinaconnect', 'qqconnect');
if(! $mod || ! in_array($mod, $connect_mod)) {
	//to do
}
$action = $_REQUEST['action'] ? : 'register';

switch ($mod) {
	case 'sinaconnect':
		require_once libfile("{$mod}/{$action}", 'module');
		break;
	
	default:
	
		break;
}
