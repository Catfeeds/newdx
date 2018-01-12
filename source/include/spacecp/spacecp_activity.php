<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: spacecp_blog.php 17343 2010-10-11 01:44:05Z zhengqingpeng $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$tid = empty($_GET['tid']) ? 0 : intval($_GET['tid']);

include_once template("home/spacecp_activity");
?>