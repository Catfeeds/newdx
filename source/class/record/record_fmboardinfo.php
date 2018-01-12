<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('class/record');
class fmboardinfo extends record
{
	var $_vars = array(
		'boardlevel1' => true,
		'boardlevel2' => false,
		'boardlevel3' => false,
		'boardid' => true,
		'boardname' => true,
		'level' => true,
		'curpostnum' => false,
		'topicnum' => false,
		'postnum' => false,
		'lasttime' => false,
		'action' => true,
		'capturetime' => true);
	var $_relation = array(
		'boardid' => 'fid',
		'boardname' => 'name',
		'curpostnum' => 'todayposts',
		'topicnum' => 'threads',
		'postnum' => 'posts',
		'lasttime' => 'lastpost',
		'capturetime' => 'capturetime');
	var $_typename = 'fmboardinfo';
	function data_lasttime_handle($time)
	{
		$return = '';
		if (! empty($time)) {
			$time = explode("\t", $time);
			$return = $time[2];
		}
		return $return;
	}
	function relation_level_handle($arr)
	{
		if ($arr['type'] == 'sub')
			return 3;
		if ($arr['type'] == 'forum') {
			if ($arr['fup'] > 0)
				return 2;
			return 1;
		}
	}
}
?>