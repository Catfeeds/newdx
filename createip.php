<?php
$list = file('drop_ip.txt');
foreach($list as $vv)
{
	$_tp = trim($vv);
	echo "iptables -I INPUT -s {$_tp} -j DROP<br/>";
}