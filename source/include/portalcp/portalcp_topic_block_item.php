<?php
/**
 * ��ר��ģ�����ݴ���
 *
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$navtitle = '��ר��ģ�����ݹ��� - �Ż����� - ����������';

$op = in_array($_GET['op'], array('add', 'edit', 'del')) ? $_GET['op'] : 'list';

$topicid = intval($_G['gp_topicid']) ? intval($_G['gp_topicid']) : 0;
$bid = intval($_G['gp_bid']) ? intval($_G['gp_bid']) : 0;
$topic = $topic_block = '';

//���ר��Ȩ��
if(!$_G['group']['allowaddtopic'] || !$_G['group']['allowmanagetopic']) {
	showmessage('�޹���ר��Ȩ��', dreferer());
}

if($topicid) {
	$the_topic = DB::fetch_first('SELECT * FROM '.DB::table('portal_topic')." WHERE topicid = '$topicid'");
	if(empty($the_topic)) {
		showmessage('topic_not_exist');
	}
}

//�����block����
function update_block_cache($bid)
{
	if(!$bid) return false;

	$query = DB::query("SELECT * FROM ".DB::table('portal_topic_block_item')." WHERE bid='$bid' ORDER BY displayorder ASC");
	while($row = DB::fetch($query)){
		if($row['serverid']>0){
			require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
			$attachserver = new attachserver;
			$serverdomain = $attachserver->get_server_domain($row['serverid']);
		}
		$row['showimg'] = $row['showimg'] ? (($row['serverid']>0 ? "http://".$serverdomain."/".$row['dir']."/" : $_G['setting']['attachurl']).$row['showimg']) : '';
		$data[] = $row;
	}
	memory('set', 'topic_block_data_'.$bid, $data);
}

if($op == 'list') {
	$bid = intval($_G['gp_bid']) ? intval($_G['gp_bid']) : 0;
	if($bid == 0) { showmessage('��������', dreferer()); }

	$query = DB::query("SELECT itemid, bid, title, url, description, showimg, dir, serverid, showdate, uid, username, displayorder FROM ".DB::table('portal_topic_block_item')." WHERE bid='$bid' ORDER BY displayorder ASC");
	while ($row = DB::fetch($query)) {
		$topic_block_item[] = $row;
	}
} elseif($op == 'add') {
	if(submitcheck('addsubmit')) {
		$add_param = array(
			'bid' => $_G['gp_bid'],
			'title' => $_G['gp_title'],
			'url' => $_G['gp_url'],
			'description' => $_G['gp_description'],
			'showdate' => $_G['gp_showdate'],
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'displayorder' => $_G['gp_displayorder'],
			'dateline' => $_G['timestamp']
			);

		if($_FILES['newimg']['tmp_name']) {
			require_once libfile('class/upload');
			$upload = new discuz_upload();

			$upload->init($_FILES['newimg'], 'portal');
			if($upload->error()) {
				showmessage('ͼƬ�ϴ�ʧ��', dreferer());
			}

			$upload->save(0, true, true, false);
			if($upload->error()) {
				showmessage('ͼƬ����ʧ��', dreferer());
			}

			$add_param['showimg'] = $upload->attach['attachment'];
			$add_param['dir'] = 'portal';
			$add_param['serverid'] = $upload->attach['serverid'];
		}

		$insert_id = DB::insert('portal_topic_block_item', $add_param, 1);
		if($insert_id)
		{
			//�����block����
			update_block_cache($bid);
			showmessage('������', "portal.php?mod=portalcp&ac=topic_block_item&op=list&topicid=$topicid&bid=$bid");
		}
	}
} elseif($op == 'edit') {
	$itemid = intval($_G['gp_itemid']) ? intval($_G['gp_itemid']) : 0;
	if($itemid == 0) { showmessage('��������', dreferer()); }
	if(submitcheck('editsubmit')) {

		$edit_param = array(
			'title' => $_G['gp_title'],
			'url' => $_G['gp_url'],
			'description' => $_G['gp_description'],
			'showdate' => $_G['gp_showdate'],
			'uid' => $_G['uid'],
			'username' => $_G['username'],
			'displayorder' => $_G['gp_displayorder'],
			'dateline' => $_G['timestamp']
			);

		if($_FILES['newimg']['tmp_name']) {
			require_once libfile('class/upload');
			$upload = new discuz_upload();

			$upload->init($_FILES['newimg'], 'portal');
			if($upload->error()) {
				showmessage('ͼƬ�ϴ�ʧ��', dreferer());
			}

			$upload->save(0, true, true, false);
			if($upload->error()) {
				showmessage('ͼƬ����ʧ��', dreferer());
			}

			$edit_param['showimg'] = $upload->attach['attachment'];
			$edit_param['dir'] = 'portal';
			$edit_param['serverid'] = $upload->attach['serverid'];
			//ɾ����ͼƬ
			if($_G['gp_serverid']>0){
				require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				$attachserver = new attachserver;
				$serverinfo = $attachserver->get_server_domain($_G['gp_serverid'],"*");
				$attachserver->delete($serverinfo['domain'] , $serverinfo['api'] , $_G['gp_dir'].'/'.$_G['gp_oldimg']);
			}else{
				@unlink($_G['setting']['attachdir'].'/'.$_G['gp_dir'].'/'.$_G['gp_oldimg']);
			}
		}

		DB::update('portal_topic_block_item', $edit_param, array('itemid' => $itemid));
		//�����block����
		update_block_cache($bid);
		showmessage('�������', "portal.php?mod=portalcp&ac=topic_block_item&op=list&topicid=$topicid&bid=$bid");
	}else{
		$block_item = DB::fetch_first("SELECT itemid, bid, title, url, description, showimg, dir, serverid, showdate, displayorder FROM ".DB::table('portal_topic_block_item')." WHERE itemid='$itemid'");
		if($block_item['serverid']>0){
			require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
			$attachserver = new attachserver;
			$serverdomain = $attachserver->get_server_domain($block_item['serverid']);
		}
		$block_item['showimage'] = $block_item['showimg'] ? (($block_item['serverid']>0 ? "http://".$serverdomain."/".$block_item['dir']."/" : $_G['setting']['attachurl']).$block_item['showimg']) : '';
	}
} elseif($op == 'del') {
	$itemid = intval($_G['gp_itemid']) ? intval($_G['gp_itemid']) : 0;
	if($itemid == 0) { showmessage('��������', dreferer()); }

	//�鿴�Ƿ���ͼƬ������ɾ���ļ�
	$block_item = DB::fetch_first("SELECT itemid, bid, title, url, description, showimg, dir, serverid, showdate, displayorder FROM ".DB::table('portal_topic_block_item')." WHERE itemid='$itemid'");
	if($block_item['serverid']>0){
		require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		$attachserver = new attachserver;
		$serverinfo = $attachserver->get_server_domain($block_item['serverid'],"*");
		$attachserver->delete($serverinfo['domain'] , $serverinfo['api'] , $block_item['dir'].'/'.$block_item['showimg']);
	}
	//ɾ����ǰ��Ŀ
	DB::query("DELETE FROM " . DB::table('portal_topic_block_item') . " WHERE itemid = '$itemid'");
	update_block_cache($bid);
	showmessage('ɾ�����', "portal.php?mod=portalcp&ac=topic_block_item&op=list&topicid=$topicid&bid=$bid");
}

include_once template("portal/portalcp_topic_block_item");
?>
