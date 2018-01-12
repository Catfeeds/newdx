<?php

/**
 *  点评产品供应链列表页边栏
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_chain_comment_rate()
{
	global $_G;
	require_once libfile('dianping/comment', 'class');
	$comment_obj = new comment();
	$comment_rate = $comment_obj->getpostlist($_G['config']['fids']['chain']);
	memory('set', 'dp_chain_comment_rate', $comment_rate, 86400);
}

?>
