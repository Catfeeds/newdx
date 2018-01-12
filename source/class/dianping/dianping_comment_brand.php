<?php
/**
 *	品牌点评主题点赞处理
 *	TODO:数据结构需升级
 *	1.喜欢列表未加username字段，列表需联表查询
 *	2.info表未记录喜欢/想用的记录数，需单独查询出数据
 *	3.plugin_brand_users_value表可能为旧数据，目前无用到的地方
 *	4.品牌的喜欢/想用未使用与“有用”相同的数据表记录数据
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'/source/class/dianping/dianping_comment.php';
class comment_brand extends comment
{
	/**
	 *	喜欢/想用
	 *	type:likeit/wantuse
	 */
	function like($tid,$uid,$username,$type)
	{
		//更新关联记录表
		DB::query("INSERT INTO ".DB::table("dianping_brand_users")."(uid, tid, type,username) VALUES('$uid', '$tid', '$type','$username')");
		return true;
	}

	/**
	 *	获取用户是否点过喜欢/想用
	 */
	function getlike($tid, $uid, $type)
	{
		if($tid <= 0 || $uid <= 0) { return false; }
		$id = DB::result_first("SELECT id FROM ".DB::table("dianping_brand_users")." WHERE tid='$tid' AND uid='$uid' AND type='$type' ".getSlaveID());
		return $id;
	}

	/**
	 *	喜欢的用户列表
	 */
	function likelist($tid)
	{
		if($tid <= 0) { return false; }

		/*$query = DB::query("SELECT uid, username FROM ".DB::table('dianping_brand_users')."
			WHERE tid = '$tid' AND type='likeit'
			ORDER BY id DESC
			LIMIT 30".getSlaveID());*/
		$query = DB::query("SELECT b.id, b.uid, m.username FROM ".DB::table('dianping_brand_users')." AS b
					LEFT JOIN ".DB::table('common_member')." AS m
					ON b.uid = m.uid
					WHERE b.tid = '$tid' AND b.type='likeit'
					ORDER BY b.id DESC
					LIMIT 30 ".getSlaveID());
		while ($value = DB::fetch($query)) {
			   $data[] = $value;
		}

		return $data;
	}

	/**
	 *	喜欢的用户数
	 */
	function likenum($tid, $type)
	{
		if($tid <= 0) { return false; }
		$data = DB::result_first("SELECT count(id) FROM ".DB::table('dianping_brand_users')." WHERE tid = '$tid' AND type='$type' ".getSlaveID());
		return $data;
	}
}
