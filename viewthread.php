<?php
/**
 * 临时兼容7.2以前版本的帖子地址
 */

if(!empty($_GET['tid'])){
	$tid = intval($_GET['tid']);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://bbs.8264.com/thread-{$tid}-1-1.html");exit;
}else{
	exit('Access Denied');
}
?>
