<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('class/record');
class fmboardadmin extends record
{
	var $_vars = array(
		'boardid' => true,
		'boardname' => true,
		'adminuid' => true,
		'adminusername' => true,
		'action' => true,
		'capturetime' => true,
		);
	var $_relation = array(
		'boardname' => 'name',
		'boardid' => 'fid',
		'capturetime' => 'capturetime',
		);
	var $_typename = 'fmboardadmin';
}
?>