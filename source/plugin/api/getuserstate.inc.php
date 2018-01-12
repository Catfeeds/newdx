<?php

/**
 * @author JiangHong
 * @copyright 2015
 */

$returnarr = array();
if($_G['inajax'] && $_G['uid'] > 0)
{
	$counts= $_G['member']['newprompt'] + $_G['member']['newpm'];
	$returnarr = array(
				'uid' => $_G['uid'],
				'username' => $_G['username'],
				'news' => $counts <= 99 ? $counts : '99+',
				'bi' => $_G['member']['extcredits5'],
				'avatar' => avatar($_G['uid']),
				'groupid' => $_G['groupid']
				);
}
echo json_encode($returnarr);