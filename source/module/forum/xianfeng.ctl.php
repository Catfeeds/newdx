<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if(!defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class XianfengCtl extends ForumCtl{
	function __construct(){
		parent::__construct();
	}
	function index(){
		global $_G;
		/*in debug*/
		var_dump($_G);
	}
}
?>