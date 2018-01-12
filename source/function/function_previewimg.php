<?php

/**
 * @author gtl
 * @copyright 20170301
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//更新
function update_previewimg($pid) {
	$returnstatus = false;
	//为获取图片做准备
	require_once DISCUZ_ROOT . 'source/plugin/attachment_server/attachment_server.class.php';
	$attachserver = new attachserver;
	$attachlist = $attachserver->get_server_domain('all', '*');
	//根据pid查询附件
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
		//查询数据是否已经存在
		$result = DB::fetch_first("SELECT tid, isedit FROM " . DB::table('forum_post_previewimg') . " WHERE tid = $tid" . getSlaveID());
		if ($result) { //更新 当没发生编辑的情况才进行更新
			if(!$result['isedit']){
				$data = array(
					'image' => addslashes(json_encode($pic))
				);
				$returnstatus = DB::query("UPDATE pre_forum_post_previewimg SET `image`='{$data['image']}' WHERE tid = $tid");
			}
		} else { //创建
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
