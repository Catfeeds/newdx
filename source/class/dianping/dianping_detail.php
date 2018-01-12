<?php
/**
 *	点评详情基础信息处理
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

class detail
{
	var $tid;

	function __construct($tid)
	{
		$this->tid = $tid;
	}

	/**
	 *	cols:传入相应点评特殊的字段
	 */
	function getdetail($modname, $cols)
	{
		$cols = $cols ? ', '.$cols : '';
		$data = DB::fetch_first("SELECT i.tid, i.subject, i.ispublish,i.showimg, i.score, i.cnum,i.serverid, s.percent1, s.percent2, s.percent3, s.percent4, s.percent5, s.count, s.price, p.pid, p.fid, p.message $cols
			FROM ".DB::table("dianping_{$modname}_info")." AS i
			LEFT JOIN ".DB::table("dianping_star_statistics")." AS s ON i.tid=s.typeid
			LEFT JOIN ".DB::table("forum_post")." AS p ON i.tid=p.tid
			WHERE i.tid='{$this->tid}' AND p.first=1 ".getSlaveID());
		//对discuz code处理
		require_once libfile('function/newdiscuzcode');
		$data['message'] = discuzcode($data['message']);
		//有附件调用，进行处理
		if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $data['message'], $matches)) {
			require_once libfile('dianping/attach','class');
	        $this->attach = new attach();
	        $data['message'] = $this->attach->handle_img($data['message']);
		}
		return $data;
	}

	function updateviews()
	{
		require_once libfile('class/myredis');
		$redis = &myredis::instance();
		if ($redis->connected)
		{
			$redis->obj->hincrby('viewthread_number', $this->tid, 1);
		} else
		{
			DB::query("UPDATE LOW_PRIORITY ".DB::table('forum_thread')." SET views=views+1 WHERE tid='{$this->tid}'");
		}
	}

	function checkit($modname, $type)
	{
		$closed = $type == 1 ? 0 : 1;
		DB::query("UPDATE ".DB::table("forum_thread")." SET closed='$closed' WHERE tid='{$this->tid}'");
		return DB::query("UPDATE ".DB::table("dianping_{$modname}_info")." SET ispublish='$type' WHERE tid='{$this->tid}'");
	}
}
?>
