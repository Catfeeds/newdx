<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('class/record');
class fmpoststatus extends record
{
	var $_vars = array(
		'boardid' => true,
		'boardname' => true,
		'postid' => true,
		'adminusername' => false,
		'action' => true,
		'capturetime' => true);
	var $_relation = array(
		'boardid' => 'fid',
		'boardname' => 'name',
		'postid' => 'pid',
		'adminusername' => 'uid',
		'capturetime' => 'capturetime');
	var $_typename = 'fmpoststatus';
}
?>