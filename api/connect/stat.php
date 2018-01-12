<?php

chdir('../../');

define('IN_API', true);
define('CURSCRIPT', 'api');

require_once './source/class/class_core.php';

$discuz = & discuz_core::instance();
$discuz->init_cron = false;
$discuz->init_session = false;
$discuz->init();

$password = $_G['setting']['connectsitekey'];

if(!isset($_GET['k']) || $_GET['k'] != $password) {
	exit;
}
	
$results = array();
$where = !empty($_GET['day']) && preg_match('/^\d{8}$/', $_GET['day']) ? " daytime='$_GET[day]'" : '1';
$query = DB::query("SELECT * FROM ".DB::table('common_stat')." WHERE $where");
while($row = DB::fetch($query)) {
	$key = $row['daytime'];
	unset($row['daytime']);
	$results[$key] = $row;
}

require_once libfile('class/xml');

@header("Content-type: text/xml; charset=ISO-8859-1");
echo array2xml($results);

?>