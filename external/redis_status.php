<?php
$config_file = '../config/config_global.php';

if(file_exists($config_file)) {
	require $config_file;
} else {
	exit('config file miss.');
}

$jkb_version='1.0';

$host=$_config['memory']['redis']['server'];
$port=$_GET['p'] ? intval($_GET['p']) : '6381';

$redis = new Redis();
$redis->connect($host,$port);
$redis->auth($_config['memory']['redis']['pwd']);
$status = $redis->info();
$redis->close();

if (empty($status) || !is_array($status)) {
	echo 'cannot connect to redis';
	exit;
}

$status['jkb_version'] = $jkb_version;
$status=json_encode($status);
$status =preg_replace('/# [a-zA-Z\r\n]*/', '', $status);
$status =str_replace('\r\n', '', $status );
echo $status ;
?>
