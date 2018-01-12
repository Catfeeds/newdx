<?php

/**
 * @author gtl
 * @copyright 20170301
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//����
function update_previewimg($pid) {
	$returnstatus = false;
	//Ϊ��ȡͼƬ��׼��
	require_once DISCUZ_ROOT . 'source/plugin/attachment_server/attachment_server.class.php';
	$attachserver = new attachserver;
	$attachlist = $attachserver->get_server_domain('all', '*');
	//����pid��ѯ����
	$pic = array();
	$tid = 0;
	$query = DB::query("SELECT aid, attachment, isimage, serverid, dir, tid, width FROM " . DB::table('forum_attachment') . " WHERE pid = $pid" . getSlaveID());
	while ($attach = DB::fetch($query)) {
		$tid = $attach['tid'];
		if ($attach['isimage'] && $attach['serverid'] > 0) {
			$pic[] = array(
				'pic' => "http://" . $attachlist[$attach['serverid']]['name'] . "/" . $attach['dir'] . "/" . $attach['attachment'],
				'width' => $attach['width'],
				'aid' => $attach['aid']
			);
		}
	}
	if (!empty($pic)) {
		$pic = array_slice($pic, 0, 3);
		//��ѯ�����Ƿ��Ѿ�����
		$result = DB::fetch_first("SELECT tid, isedit FROM " . DB::table('forum_post_previewimg') . " WHERE tid = $tid" . getSlaveID());
		if ($result) { //���� ��û�����༭������Ž��и���
			if(!$result['isedit']){
				$data = array(
					'image' => addslashes(json_encode($pic))
				);
				$returnstatus = DB::query("UPDATE pre_forum_post_previewimg SET `image`='{$data['image']}' WHERE tid = $tid");
			}
		} else { //����
			$data = array(
				'tid' => $tid,
				'image' => json_encode($pic),
				'dateline' => TIMESTAMP
			);
			$returnstatus = DB::insert('forum_post_previewimg', $data);
		}
	}
	return $returnstatus;
}

?>
