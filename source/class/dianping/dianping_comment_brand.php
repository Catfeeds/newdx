<?php
/**
 *	Ʒ�Ƶ���������޴���
 *	TODO:���ݽṹ������
 *	1.ϲ���б�δ��username�ֶΣ��б��������ѯ
 *	2.info��δ��¼ϲ��/���õļ�¼�����赥����ѯ������
 *	3.plugin_brand_users_value�����Ϊ�����ݣ�Ŀǰ���õ��ĵط�
 *	4.Ʒ�Ƶ�ϲ��/����δʹ���롰���á���ͬ�����ݱ��¼����
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

require_once DISCUZ_ROOT.'/source/class/dianping/dianping_comment.php';
class comment_brand extends comment
{
	/**
	 *	ϲ��/����
	 *	type:likeit/wantuse
	 */
	function like($tid,$uid,$username,$type)
	{
		//���¹�����¼��
		DB::query("INSERT INTO ".DB::table("dianping_brand_users")."(uid, tid, type,username) VALUES('$uid', '$tid', '$type','$username')");
		return true;
	}

	/**
	 *	��ȡ�û��Ƿ���ϲ��/����
	 */
	function getlike($tid, $uid, $type)
	{
		if($tid <= 0 || $uid <= 0) { return false; }
		$id = DB::result_first("SELECT id FROM ".DB::table("dianping_brand_users")." WHERE tid='$tid' AND uid='$uid' AND type='$type' ".getSlaveID());
		return $id;
	}

	/**
	 *	ϲ�����û��б�
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
	 *	ϲ�����û���
	 */
	function likenum($tid, $type)
	{
		if($tid <= 0) { return false; }
		$data = DB::result_first("SELECT count(id) FROM ".DB::table('dianping_brand_users')." WHERE tid = '$tid' AND type='$type' ".getSlaveID());
		return $data;
	}
}
