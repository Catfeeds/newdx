<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_portalcategory.php 19305 2010-12-27 08:24:51Z zhangguosheng $
 */

if(!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}

cpheader();
$operation = in_array($_G['gp_operation'], array('delete', 'add', 'edit')) ? $_G['gp_operation'] : 'list';

$topicid = intval($_G['gp_topicid']);

showsubmenu('新模块',  array(
		array('列表', 'topic_block&operation=list&topicid='.$topicid, 1),
		array('添加模块', 'admin.php?action=topic_block&operation=add&topicid='.$topicid, 0, 0, 1)
	));

if($operation == 'list') {
	showformheader('topic_block&operation=delete');
	showtableheader('该专题模块列表');
	$query = DB::query("SELECT * FROM ".DB::table('portal_topic_block')." WHERE topicid='$topicid' ORDER BY bid DESC");
	while ($value = DB::fetch($query)) {
		showtablerow('', array('class="td25"', 'class="td28"', 'class=""', 'class=""', 'class=""', 'class="td28"'), array(
			"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[bid]\">",
			"模块ID:".$value[bid],
			$value['name'],
			"<a href=\"http://u.8264.com/home.php?uid=$value[uid]\" target=\"_blank\">$value[username]</a>",
			date("Y-m-d", $value['dateline']),
			"<a href=\"".ADMINSCRIPT."?action=topic_block&operation=edit&bid=$value[bid]\">编辑</a>",
		));
	}
	//$ops = cplang('operation').': '
		//."<input type='radio' class='radio' name='optype' value='delete' id='op_delete' /><label for='op_delete'>".cplang('delete')."</label>&nbsp;&nbsp;";
	showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$ops.'<input type="submit" class="btn" name="opsubmit" value="删除" />', $multipage);
	showtablefooter();
	showformfooter();
} elseif($operation == 'delete') {

	$delids = $_POST['ids'];
	if(submitcheck('opsubmit') && $delids)
	{
		DB::delete('portal_topic_block', 'bid IN ('.dimplode($delids).')');
		//查看关联内容中是否有图片，有则删除文件
		$query = DB::query("SELECT itemid, bid, title, url, description, showimg, dir, serverid, showdate, displayorder FROM ".DB::table('portal_topic_block_item')." WHERE bid IN (".dimplode($delids).")");
		while ($row = DB::fetch($query)) {
			$block_item[] = $row;
		}
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		foreach ($block_item as $key => $value) {
			if($value['serverid']>0){
				$serverinfo = $attachserver->get_server_domain($value['serverid'],"*");
				$attachserver->delete($serverinfo['domain'] , $serverinfo['api'] , $value['dir'].'/'.$value['showimg']);
			}
		}

		DB::delete('portal_topic_block_item', 'bid IN ('.dimplode($delids).')');

		cpmsg('删除完成', 'action=topic_block&operation=list&topicid='.$topicid, 'succeed');
	}
	else
	{
		cpmsg('非法操作', 'action=topic_block&operation=list&topicid='.$topicid, 'error');
	}
} elseif($operation == 'add') {

	showsubmenu('新模块',  array(
			array('列表', 'topic_block&topicid='.$topicid, 0),
			array('添加', 'topic_block&operation=add&topicid='.$topicid, 1)
		));

	if(submitcheck('opsubmit')) {

		$addblock = array(
			'topicid' => $_G['gp_topicid'],
			'name' => $_G['gp_name'],
			'shownum'=>$_G['gp_shownum'],
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'dateline' => $_G['timestamp']
		);
		$insert_id = DB::insert('portal_topic_block', $addblock, 1);
		if($insert_id)
		{
			cpmsg('添加完成', "action=topic_block&operation=list&topicid=".$_G['gp_topicid'], 'succeed');
		}

	} else {
		showformheader('topic_block&operation=add');
		if($operation=='add') {
			echo "<input type=\"hidden\" name=\"topicid\" value=\"$topicid\" />";
		}
		showtableheader();

		showsetting('模块名称', 'name', $topic_block['name'], 'text');
		showsetting('内容条数', 'shownum', $topic_block['shownum'], 'text');

		showsubmit('opsubmit');
		showtablefooter();
		showformfooter();
	}
} elseif($operation == 'edit') {

	if(submitcheck('opsubmit')) {

		$editblock = array(
			'bid' => $_G['gp_bid'],
			'name' => $_G['gp_name'],
			'shownum'=>$_G['gp_shownum'],
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'dateline' => $_G['timestamp']
		);
		$result = DB::update('portal_topic_block', $editblock, "bid='$_G[gp_bid]'");
		if($result)
		{
			cpmsg('修改完成', "action=topic_block&operation=list&topicid=$_G[gp_topicid]", 'succeed');
		}

	} else {
		$bid = intval($_G['gp_bid']) ? intval($_G['gp_bid']) : 0;
		if(!$bid) { cpmsg('参数错误', dreferer()); }

		$topic_block = DB::fetch_first("SELECT * FROM ".DB::table('portal_topic_block')." WHERE bid='$bid'");

		showsubmenu('新模块',  array(
			array('列表', 'topic_block&topicid='.$topic_block['topicid'], 0),
			array('编辑', 'topic_block&operation=edit&bid='.$_GET['bid'], 1)
		));

		showformheader('topic_block&operation=edit');
		echo "<input type=\"hidden\" name=\"bid\" value=\"$bid\" />";
		echo "<input type=\"hidden\" name=\"topicid\" value=\"$topic_block[topicid]\" />";

		showtableheader();

		showsetting('模块名称', 'name', $topic_block['name'], 'text');
		showsetting('内容条数', 'shownum', $topic_block['shownum'], 'text');

		showsubmit('opsubmit');
		showtablefooter();
		showformfooter();
	}
}

?>
