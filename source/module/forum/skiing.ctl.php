<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class SkiingCtl extends DianpingCtl{
	var $modname = 'skiing';

	/**
	 * 修改雪场坐标
	 * 
	 * @author lxp 20131016
	 */
	function editmap(){
		global $_G;
		if(!$_G['tid'] || !$_G['gp_lng'] || !$_G['gp_lat'] || $_G['forum']['ismoderator'] != 1){
			$this->showmessage('数据错误');
		}
		
		$mod_skiing = m('skiing');
		$mod_skiing->edit("tid = {$_G['tid']}", array('longitude' => $_G['gp_lng'], 'latitude' => $_G['gp_lat']));
		die('success');
	}
}
?>