<?php

/**
 * @author JiangHong
 * @copyright 2014
 */

$op = $_G['gp_op'];
$swfhash = md5($_G['uid'].UC_KEY);
if($op == 'config'){
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><parameter><config><uid>$_G[uid]</uid><hash>$swfhash</hash></config></parameter>";
}
?>