<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('class/record');
class fmpostinfo extends record
{
	var $_vars = array(
		'boardid' => true,
		'boardname' => true,
		'mainpostid' => true,
		'uid' => true,
		'username' => true,
		'postid' => true,
		'topic' => false,
		'content' => false,
		'mainfile' => false,
		'url' => false,
		'replynum' => false,
		'browsenum' => false,
		'lastreplyusername' => false,
		'lastreplytime' => false,
		'action' => true,
		'capturetime' => true,
		);
	var $_relation = array(
		'boardid' => 'fid',
		'boardname' => 'name',
		'mainpostid' => 'tid',
		'postid' => 'pid',
		'topic' => 'subject',
		'content' => 'message',
		'mainfile' => 'mainfile',
		'url' => 'url',
		'replynum' => 'replies',
		'browsenum' => 'views',
		'lastreplyusername' => 'lastposter',
		'lastreplytime' => 'lastpost',
		'capturetime' => 'capturetime',
		);
	var $_typename = 'fmpostinfo';
	function relation_url_handle($arr)
	{
		global $_G;
		return $_G['config']['web']['forum'].'forum.php?mod=redirect&goto=findpost&ptid='.$arr['tid'].'&pid='.$arr['pid'];
	}
	function relation_content_handle($arr)
	{
		$arr['message'] = str_replace(array(
			"\\r",
			"\\n",
			"\\t",
			"\t",
			"\n",
			"\r"), " ", $arr['message']);
		if ($arr['action'] == 1) {
			require_once libfile('function/post');
			self::_savefile(self::relation_mainfile_handle($arr), $arr['message']);
			return cutstr($arr['message'], 100);
		} else {
			return $arr['message'];
		}
	}
	function relation_mainfile_handle($arr)
	{
		global $_G;
		return $arr['action'] == 1 ? $arr['tid'].'_'.$arr['pid'].'.txt' : '';
	}
}
?>