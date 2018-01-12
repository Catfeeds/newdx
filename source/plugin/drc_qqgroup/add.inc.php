<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if(!submitcheck('addsubmit')){
	include template('drc_qqgroup:add');
}else{
	require_once libfile('function/discuzcode');
	$typeid = intval($_G['gp_qtype']);
	$name = dhtmlspecialchars($_G['gp_name']);
	$num = intval($_G['gp_num']);
	$creator = intval($_G['gp_creator']);
	$createtime = strtotime($_G['gp_createtime']);
	$intro = discuzcode($_G['gp_intro'], 1, 0, 0, 0, 1, 1, 0, 0, 1);
	if(!$typeid){
		showmessage(lang('plugin/drc_qqgroup', 'qadd_msg1'));
	}elseif(empty($name)){
		showmessage(lang('plugin/drc_qqgroup', 'qadd_msg2'));
	}elseif(strlen($_G['gp_num']) < 5 || strlen($_G['gp_num']) > 10){
		showmessage(lang('plugin/drc_qqgroup', 'qadd_msg3'));
	}elseif(empty($createtime)){
		showmessage(lang('plugin/drc_qqgroup', 'qadd_msg5'));
	}elseif(empty($intro)){
		showmessage(lang('plugin/drc_qqgroup', 'qadd_msg6'));
	}else{
		DB::insert('drc_qqgroups', array('num' => $num, 'name' => $name, 'typeid' => $typeid, 'intro' => $intro, 'creator' => $creator, 'createtime' => $createtime, 'display' => '0'));
		showmessage(lang('plugin/drc_qqgroup', 'qadd_success'), 'plugin.php?id=drc_qqgroup:main', array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
	}
}

?>