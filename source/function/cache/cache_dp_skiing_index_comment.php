<?php

/**
 *  点评滑雪场列表页评论
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_dp_skiing_index_comment()
{
	global $_G;

	require_once libfile('dianping/comment', 'class');
	$comment_obj = new comment();
	$commentlist = $comment_obj->getlist('', $_G['config']['fids']['skiing'], 0, 15, 's.showorder');
	memory('set', 'dp_skiing_index_comment', $commentlist, 86400);
}

?>
