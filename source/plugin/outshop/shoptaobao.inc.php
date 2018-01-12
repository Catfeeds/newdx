<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/shop.php';



$list = ForumOptionShop::gettaobaodate(0);

print_r($list);exit;


