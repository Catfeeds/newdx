<?php
//邀请的mtype为1
class Invitation_Model {
	var $table = 'home_notice_';
	var $relatedUid;
	var $news;
	var $currentUid;
	var $toReadCount;

	function __construct() {
		global $_G;
		$this->currentUid = $_G['uid'];
		$this->toReadCount = 0;
		$this->table .= substr($this->currentUid, -1);
	}
	function getDataList($page, $perPage) {

		$start = ($page - 1) * $perPage;
		$sql = 'SELECT id, uid, new, authorid, author, message, dateline FROM ' . DB::table($this->table) . " WHERE uid = '$this->currentUid' AND mtype = 1 ORDER BY new DESC, dateline DESC LIMIT {$start}, {$perPage} " . getSlaveID();
		$list = array();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			$list[] = $row;
			$mids[] = $row['id'];
		}
		//更新为已读
		$this->updateToReaded($mids);

		return $list;
	}

	function updateToReaded($mids) {
		if(!$mids) return;

		if(is_array($mids)) {
			$this->toReadCount = count($mids);
			$mids = dimplode($mids);
			DB::query('UPDATE '.DB::table($this->table)." SET new=0 WHERE uid='$this->currentUid' AND id IN ($mids)");
		} else {
			$this->toReadCount = 1;
			DB::query('UPDATE '.DB::table($this->table)." SET new=0 WHERE uid='$this->currentUid' AND id = '$mids'");
		}
	}

	function delete($mids) {
		if(! $mids || ! $this->currentUid) return;

		if(is_array($mids)) {
			$mids = dimplode($mids);
			DB::query('DELETE FROM ' . DB::table($this->table) . " WHERE uid='$this->currentUid' AND id IN ('$mids')");
		} else {
			DB::query('DELETE FROM ' . DB::table($this->table) . " WHERE uid='$this->currentUid' AND id = '$mids'");
		}
	}

	function getTotalCount() {
		static $totalCount;
		if(!$totalCount) {
			$totalCount = DB::result_first('SELECT COUNT(*) FROM ' . DB::table($this->table) . " WHERE uid = '$this->currentUid' AND mtype = 1 " . getSlaveID());
		}
		return $totalCount;
	}
}
