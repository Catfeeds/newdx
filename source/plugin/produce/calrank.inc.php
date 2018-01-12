<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';

if ($_GET['type'] == 'post') {
	ForumOptionProduce::calPostRank();
} elseif ($_GET['type'] == 'publisher') {
	ForumOptionProduce::calPublisherRank();
}
