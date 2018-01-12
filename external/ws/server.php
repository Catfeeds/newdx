<?php
require_once 'service.php';
$server = new SoapServer(null, array('uri' => 'service.php', 'encoding'=>'gbk'));
$server->setClass('Service');
$server->handle();
?>