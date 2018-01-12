<?php
/**
 *	点评评论内容
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

class comment
{
	var $recordnum = 0;

	function __construct()
	{

	}

	function getlist($tid, $fid, $start = 0, $limit = 10, $orderby = 'p.dateline', $multipage = 0, $where = '')
	{
		$where .= !empty($fid) ? " AND p.fid IN ($fid)" : '';
		$where .= !empty($tid) ? " AND p.tid='$tid'" : '';
		if($multipage)
		{
			$this->recordnum = DB::result(DB::query("SELECT count(*) FROM ".DB::table("dianping_star_logs")." AS s
			LEFT JOIN ".DB::table("forum_post")." AS p ON s.pid=p.pid
			LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=p.tid
			WHERE p.first=0 $where ".getSlaveID()));
		}
		$query = DB::query("SELECT s.starnum,s.uid, s.goodpoint, s.weakpoint, s.extdata, s.ext1, s.ext2, s.ext3, s.ext4, s.ext5, s.supports, p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, p.rate, p.attachment, t.subject
			FROM ".DB::table("dianping_star_logs")." AS s
			LEFT JOIN ".DB::table("forum_post")." AS p ON s.pid=p.pid
			LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=p.tid
			WHERE p.first=0 $where
			ORDER BY s.displayorder DESC, $orderby DESC
			LIMIT $start, $limit ".getSlaveID());
		while ($row = DB::fetch($query)) {
			$row['goodpoint'] = nl2br($row['goodpoint']);
			$row['weakpoint'] = nl2br($row['weakpoint']);
			$row['ext3'] = nl2br($row['ext3']);
			$row['message'] = nl2br($row['message']);
			$data[$row['pid']] = $row;
			if($row['attachment'])
			{
				$data[$row['pid']]['attachlist'] = $this->getattachlist($row['pid']);
			}
		}
		return $data;
	}

	/**
	 *	获取评论附件图片
	 */
	function getattachlist($pid)
	{
		if(empty($pid)) return '';
		$query = DB::query("SELECT aid, tid, pid, width, attachment, serverid, dir
			FROM ".DB::table("forum_attachment")."
			WHERE pid='$pid' AND isimage=1
			ORDER BY aid DESC
			LIMIT 0, 6 ".getSlaveID());
		while ($row = DB::fetch($query)) {
			$data[] = $row;
		}
		return $data;
	}

	/**
	 *	只需获取post内容的精彩评论列表 如：山峰右侧
	 */
	function getpostlist($fid, $start = 0, $limit = 10, $orderby = 'p.dateline')
	{
		if($fid <= 0) { return false; }
		$query = DB::query("SELECT p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, t.subject FROM ".DB::table("forum_post")." AS p
			LEFT JOIN ".DB::table("forum_thread")." AS t
			ON p.tid=t.tid
			WHERE p.first=0 AND p.rate>0 AND p.fid='$fid'
			ORDER BY $orderby DESC
			LIMIT $start, $limit ".getSlaveID());
		while ($row = DB::fetch($query)) {
			$row['message'] = cutstr($row['message'], 120, '');
			$data[] = $row;
		}
		return $data;
	}

	/**
	 *	获取指定点评内容
	 */
	function getdetail($pid, $tid, $uid,$edit=0)
	{
		if($tid && $uid)
		{
			// $pid = DB::result_first("SELECT pid FROM ".DB::table("forum_post")." WHERE tid='$tid' AND authorid='$uid'");
			$where = "AND p.tid='$tid' AND s.uid='$uid'";
		}else{
			$where = "AND s.pid='$pid'";
		}
		$data = DB::fetch_first("SELECT s.starnum, s.goodpoint,s.uid, s.weakpoint, s.extdata, s.ext1, s.ext2, s.ext3, s.ext4, s.ext5, s.supports, p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, p.rate, p.attachment, t.subject
			FROM ".DB::table("dianping_star_logs")." AS s
			LEFT JOIN ".DB::table("forum_post")." AS p ON s.pid=p.pid
			LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=p.tid
			WHERE p.first=0 $where ".getSlaveID());
		if($data && $edit==0){
			$data['goodpoint'] = nl2br($data['goodpoint']);
			$data['weakpoint'] = nl2br($data['weakpoint']);
			$data['ext3'] = nl2br($data['ext3']);
			$data['message'] = nl2br($data['message']);
		}
		if($data['attachment'])
		{
			$data['attachlist'] = $this->getattachlist($data['pid']);
		}
		return $data;
	}
        /**
         * 获取上一条或者下一条数据
         */
        function getpre_next($pid, $lt, $tid,$order, $limit)
	{
            $where = "AND p.tid='$tid' AND p.pid $lt '$pid' order by p.pid $order limit $limit  ";	
            $query = DB::query("SELECT s.starnum, s.goodpoint,s.uid, s.weakpoint, s.extdata, s.ext1, s.ext2, s.ext3, s.ext4, s.ext5, s.supports, p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, p.rate, p.attachment, t.subject
                FROM ".DB::table("dianping_star_logs")." AS s
                LEFT JOIN ".DB::table("forum_post")." AS p ON s.pid=p.pid
                LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=p.tid
                WHERE p.first=0 $where ".getSlaveID());
            while ($row = DB::fetch($query)) {
                $data[] = $row;
            }
            return $data;
	}
        function get_max($tid){
            $data = DB::result_first("SELECT max(p.pid)
                FROM ".DB::table("dianping_star_logs")." AS s
                LEFT JOIN ".DB::table("forum_post")." AS p ON s.pid=p.pid
                LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=p.tid
                WHERE p.first=0 AND p.tid='$tid' ".getSlaveID());
            return $data;
        }
        function get_min($tid){
            $data = DB::result_first("SELECT min(p.pid)
                FROM ".DB::table("dianping_star_logs")." AS s
                LEFT JOIN ".DB::table("forum_post")." AS p ON s.pid=p.pid
                LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=p.tid
                WHERE p.first=0 AND p.tid='$tid' ".getSlaveID());
            return $data;
        }
        function get_line_pro($tid){
            $data = DB::result_first("SELECT province
                FROM ".DB::table("dianping_line_cross")."
                WHERE  tid='$tid' ".getSlaveID());
            return $data;
        }
        
        
        
        
        
	/**
	 *	发布点评记录
	 */
	/*function public()
	{
		//to do
		//需要更新评论内容及评分记录
		//发完点评需更新T表最后回复时间
	}
*/
	/**
	 *	更新指定点评记录
	 */
	/*function edit()
	{
		//to do
		//需要更新评论内容及评分记录
	}
*/
	/**
	 *	删除点评记录
	 */
	function del($pid, $tid, $mod)
	{
		global $dp_modules;
		if($pid <= 0) { return false; }
		//需要查出来此pid的tid及属于哪个mod，更新相应表的点评数
		if(empty($tid) && empty($mod))
		{
			$mod_info = DB::fetch_first("SELECT tid, fid FROM ".DB::table("forum_post")." WHERE pid='$pid'");
			foreach ($dp_modules as $key => $value) {
				if($value['fid'] == $mod_info['fid'])
				{
					$mod_info['mod'] = $value['mname'];
					break;
				}
			}
			$tid = $mod_info['tid'];
			$mod = $mod_info['mod'] ? $mod_info['mod'] : 'equipment';	//避免无记录时SQL执行错误
		}
		DB::query("DELETE FROM ".DB::table("dianping_star_logs")." WHERE pid='$pid'");
		DB::query("DELETE FROM ".DB::table("forum_post")." WHERE pid='$pid'");
		DB::query("UPDATE ".DB::table("dianping_{$mod}_info")." SET cnum=cnum-1 WHERE tid='$tid'");
		// TODO 需重计评分
		return true;
	}

	/**
	 *	点个赞
	 */
	function support($pid)
	{
		global $_G;
		if($pid <= 0) { return false; }

		//更新点赞记录表
		$mod_info = DB::fetch_first("SELECT fid, tid, authorid FROM ".DB::table("forum_post")." WHERE pid='$pid' ".getSlaveID());
		if($mod_info['authorid'] == $_G['uid'])	//不能点评自己的
		{
			return '-1'; exit;
		}
		DB::query("INSERT INTO ".DB::table("dianping_support")."(fid, tid, pid, uid, username, ip, dateline, good) VALUES('$mod_info[fid]', '$mod_info[tid]', '$pid', '$_G[uid]', '$_G[username]', '$_G[clientip]', '$_G[timestamp]', 1)");
		DB::query("UPDATE ".DB::table("dianping_star_logs")." SET supports=supports+1 WHERE pid='$pid'");
		$num = DB::result_first("SELECT supports FROM ".DB::table("dianping_star_logs")." WHERE pid='$pid' ".getSlaveID());
		return $num;
	}

	/**
	 *	获取用户是否点过赞
	 */
	function getsupport($pid, $uid)
	{
		if($pid <= 0 || $uid <= 0) { return false; }
		$pid = DB::result_first("SELECT pid FROM ".DB::table("dianping_support")." WHERE pid='$pid' AND uid='$uid' ".getSlaveID());
		return $pid;
	}

	/**
	 *	置顶
	 *	默认操作为取消置顶，可以增量置顶，加大置顶顺序
	 */
	function stickreply($pid, $mode = 0)
	{
		if($pid <= 0) { return false; }
		$set = $mode ? "displayorder=displayorder+1" : "displayorder=0";
		DB::query("UPDATE ".DB::table("dianping_star_logs")." SET $set WHERE pid='$pid'");
		return true;
	}


}
?>
