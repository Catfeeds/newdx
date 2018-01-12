<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

if($_G['gp_action'] == 'typeadd'){
	if(!submitcheck('typeaddsubmit')){
		include template('drc_qqgroup:type_add');
	}else{
		$typename = dhtmlspecialchars($_G['gp_typename']);
		$displayorder = intval($_G['gp_displayorder']);
		DB::insert('drc_qqgroup_type', array('typename' => $typename, 'displayorder' => $displayorder));
		showmessage(lang('plugin/drc_qqgroup', 'add_success'), dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
	}
}elseif($_G['gp_action'] == 'check'){
	if($_G['gp_operation'] == 'yes'){
		$qid = intval($_G['gp_qid']);
		DB::query("UPDATE ".DB::table('drc_qqgroups')." SET display=1 WHERE id='$qid'");
		showmessage(lang('plugin/drc_qqgroup', 'check_success'), dreferer());
	}elseif($_G['gp_operation'] == 'no'){
		$qid = intval($_G['gp_qid']);
		DB::query("DELETE FROM ".DB::table('drc_qqgroups')." WHERE id='$qid'");
		showmessage(lang('plugin/drc_qqgroup', 'check_failed'), dreferer());
	}else{
		$plugin_nav = lang('plugin/drc_qqgroup', 'check_nav');
		$query = DB::query("SELECT * FROM ".DB::table('drc_qqgroups')." WHERE display=0 ORDER BY id DESC");
		$checklists = $checklist = array();
		while($checklist = DB::fetch($query)){
			$checklist['createtime'] = dgmdate($checklist['createtime'], 'd');
			$checklists[] = $checklist;
		}
		include template('drc_qqgroup:check');
	}
}elseif($_G['gp_action'] == 'typeedit'){
	if(!submitcheck('typeeditsubmit')){
		$qtid = intval($_G['gp_qtid']);
		$qtinfo = DB::fetch_first("SELECT * FROM ".DB::table('drc_qqgroup_type')." WHERE id='$qtid'");
		include template('drc_qqgroup:type_edit');
	}else{
		$typename = dhtmlspecialchars($_G['gp_typename']);
		$displayorder = intval($_G['gp_displayorder']);
		$newqtid = intval($_G['gp_newqtid']);
		DB::query("UPDATE ".DB::table('drc_qqgroup_type')." SET typename='$typename', displayorder='$displayorder' WHERE id='$newqtid'");
		showmessage(lang('plugin/drc_qqgroup', 'typeedit_success'), dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
	}
}elseif($_G['gp_action'] == 'typedelete'){
	$qtid = intval($_G['gp_qtid']);
	DB::query("DELETE FROM ".DB::table('drc_qqgroup_type')." WHERE id='$qtid'");
	DB::query("DELETE FROM ".DB::table('drc_qqgroups')." WHERE typeid='$qtid'");
	showmessage(lang('plugin/drc_qqgroup', 'typedelete_success'), dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
}elseif($_G['gp_action'] == 'type'){
	$plugin_nav = lang('plugin/drc_qqgroup', 'typecp_nav');
	$query = DB::query("SELECT * FROM ".DB::table('drc_qqgroup_type')." ORDER BY displayorder");
	$typelist = $typelists = array();
	while($typelist = DB::fetch($query)){
		$typelists[] = $typelist;
	}
	include template('drc_qqgroup:cpanel');
}elseif($_G['gp_action'] == 'qcp'){
	if($_G['gp_operation'] == 'edit'){
		if(!submitcheck('qeditsubmit')){
			require_once libfile('function/editor');
			$qid = intval($_G['gp_qid']);
			$qeditinfo = DB::fetch_first("SELECT * FROM ".DB::table('drc_qqgroups')." WHERE id='$qid'");
			$qeditinfo['createtime'] = dgmdate($qeditinfo['createtime'], 'd');
			$qeditinfo['intro'] = html2bbcode($qeditinfo['intro']);
			include template('drc_qqgroup:qedit');
		}else{
			require_once libfile('function/discuzcode');
			$newqid = intval($_G['gp_newqid']);
			$typeid = intval($_G['gp_qtype']);
			$name = dhtmlspecialchars($_G['gp_name']);
			$num = intval($_G['gp_num']);
			$creator = intval($_G['gp_creator']);
			$createtime = strtotime($_G['gp_createtime']);
			$intro = discuzcode($_G['gp_intro'], 1, 0, 0, 0, 1, 1, 0, 0, 1);
			DB::query("UPDATE ".DB::table('drc_qqgroups')." SET num='$num', name='$name', typeid='$typeid', intro='$intro', creator='$creator', createtime='$createtime' WHERE id='$newqid'");
			showmessage(lang('plugin/drc_qqgroup', 'qedit_success'), dreferer(), array(), array('locationtime'=>2, 'showdialog'=>1, 'showmsg' => true, 'closetime' => 2));
		}
	}elseif($_G['gp_operation'] == 'delete'){
		$qid = intval($_G['gp_qid']);
		DB::query("DELETE FROM ".DB::table('drc_qqgroups')." WHERE id='$qid'");
		showmessage(lang('plugin/drc_qqgroup', 'qdelete_success'), dreferer());
	}else{
		$plugin_nav = lang('plugin/drc_qqgroup', 'qcp_nav');
		$perpage = 20;
		$page = empty($_G['page']) ? 1 : $_G['page'];
		$num = DB::result_first("SELECT COUNT(*) FROM ".DB::table('drc_qqgroups')." WHERE display=1");
		$start_limit = ($page - 1) * $perpage;
		$multipage = multi($num, $perpage, $page, 'plugin.php?id=drc_qqgroup:main&mod=cpanel&action=qcp', 0, 10);
		$sql = "SELECT * FROM ".DB::table('drc_qqgroups')." WHERE display=1 ORDER BY id DESC LIMIT $start_limit, $perpage";
		$query = DB::query($sql);
		$qcplist = $qcplists = array();
		while($qcplist = DB::fetch($query)){
			$qcplist['createtime'] = dgmdate($qcplist['createtime'], 'd');
			$qcplists[] = $qcplist;
		}
		include template('drc_qqgroup:qcp');
	}
}

?>