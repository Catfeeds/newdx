<?php
/**
 * ��ȡ��վ����WebService
 * 
 * @author rinne 110711
 */
class Service {

	function __construct() {
		$this->Service();
	}

	function Service() {
		require_once '../../source/class/class_core.php';
		require_once '../../source/function/function_forum.php';
		$discuz = & discuz_core::instance();
		$discuz->init();
	}

	/**
	 * ��ȡ8264�û�ͳ����Ϣ
	 * 
	 * @author wistar 120531
	 * 
	 * @param int uid �û�ID
	 * @return array �û�ͳ����Ϣ
	 */
	function getExtcredits ($uid) {
		$arr_extcs = DB::fetch_first('SELECT * FROM ' . DB::table('common_member_count') . " WHERE uid='{$uid}'");
		return $arr_extcs;
	}

	/**
	 * �޸�8264�û����ֵ���Ϣ
	 * 
	 * @author wistar 120531
	 * 
	 * @param int uid �û�ID
	 * @param int lvbi ¿�ң�extcredits2��
	 */
	function setExtcredits($uid, $lvbi) {
		// ��ʣ��¿�����õ��û���Ϣͳ�Ʊ�
		DB::update('common_member_count', array('extcredits2' => $lvbi), array('uid' => $uid));
		// ȡ��������ʽ
		$exp = DB::fetch_first('SELECT svalue FROM ' . DB::table('common_setting') . " WHERE skey = 'creditsformula'");
		// ȡ���û�ͳ����Ϣ
		$user_status = DB::fetch_first('SELECT * FROM ' . DB::table('common_member_count') . " WHERE uid = '{$uid}'");
		// ������ϼ�ֵ��Ӧ
		$key = array('digestposts', 'threads', 'posts', 'oltime', 'friends', 'doings', 'blogs', 'albums', 'sharings', 'extcredits1', 'extcredits2', 'extcredits3', 'extcredits4', 'extcredits5', 'extcredits6', 'extcredits7', 'extcredits8');
		$val = array($user_status['digestposts'], $user_status['threads'], $user_status['posts'], $user_status['oltime'], $user_status['friends'], $user_status['doings'], $user_status['blogs'], $user_status['albums'], $user_status['sharings'], $user_status['extcredits1'], $user_status['extcredits2'], $user_status['extcredits3'], $user_status['extcredits4'], $user_status['extcredits5'], $user_status['extcredits6'], $user_status['extcredits7'], $user_status['extcredits8']);
		$express = str_replace($key, $val, $exp['svalue']);
		// �ܷ�ֵ���㲢д��member��
		eval('\$credits = '.$express.';');
		DB::update('common_member', array('credits' => $credits), array('uid' => $uid));
	}

	/**
	 * ��ȡ��վ�û���Ϣ
	 * @author wangyixiang
	 *
	 * @param type uid
	 * @return array �û����ֵ���Ϣ
	 * 
	 * extcredits1[_title] [����]��extcredits2[_title] [¿��]��extcredits3[_title] [����]��extcredits4[_title] [����]��extcredits5[_title] [8264��]��
	 * groupid:1-����Ա��2-����������3-������17-ʵϰ����33-�ط���̳������45-�뼹�壻49-����������51-��������
	 *		   9-��ؤ��11-��¿��·��12-ϣ�İ���壻13-���沼³ķ��壻14-���尢�ط壻15-���沼³ķ��壻23-�����ն��Ƿ壻24-�����������ط�
	 *		   25-����˹³�壻26-���������壻27-׿���ѷ壻28-��³�壻29-���ӷ壻30-�ɳ��¼η壻42-�Ǹ���壻44-���������
	 *		   18-¿�ѣ�21-���Ұ���Ļ�Ա��31-�������Ļ�Ա��48-8264QQȺ����Ⱥ����41-���а���Ļ�Ա
	 */
	function getUserInfo($uid) {
		$arr_UserInfo = DB::fetch_first("SELECT mc.*, ms.*, m.*, ug.grouptitle, cug.grouptitle as admintitle FROM " . DB::table('common_member') . " m
			LEFT JOIN " . DB::table('common_member_count') . " mc USING(uid)
			LEFT JOIN " . DB::table('common_member_status') . " ms USING(uid)
			LEFT JOIN " . DB::table('common_usergroup') . " ug USING(groupid)
			LEFT JOIN " . DB::table('common_usergroup') . " cug ON cug.groupid = m.adminid
			WHERE m.uid='{$uid}'");
		$setting = DB::fetch_first("SELECT svalue FROM " . DB::table('common_setting') . " WHERE skey='extcredits'");
		$setting = unserialize($setting['svalue']);
		foreach ($setting as $key => $value) {
			$arr_UserInfo['extcredits' . $key . '_title'] = $value['title'];
		}
		return $arr_UserInfo;
	}

	/**
	 * ��ȡ��վ���ڵ��û�����Ϣ
	 * @author wangyixiang
	 *
	 * @return array �û�����Ϣ
	 */
	function getGroupInfo () {
		$arr_GroupInfo = array();
		$query = DB::query("SELECT * FROM " . DB::table('common_usergroup'). " order by groupid");
		while ($item = DB::fetch($query)) {
			$arr_GroupInfo['special'][$item['groupid']] = $item['grouptitle'];
		}
		$query = DB::query("SELECT * FROM " . DB::table('common_usergroup') . " WHERE type = 'member'");
		while ($item = DB::fetch($query)) {
			$arr_GroupInfo['member'][$item['groupid']] = $item['grouptitle'];
		}
		return $arr_GroupInfo;
	}

	/**
	 * �ڶһ�����ȯ���޸���վ¿����Ϣ
	 * @author wangyixiang
	 *
	 * @return �޸ĺ��¿��ֵ
	 */
	function alterExtCredits($uid,$lvbi) {
		$query = DB::query("UPDATE " . DB::table('common_member_count') . " SET extcredits2 = '{$lvbi}' WHERE uid = '$uid'");
		$express = DB::fetch_first("SELECT svalue FROM " . DB::table('common_setting') . " WHERE skey = 'creditsformula'");
		$express = $express['svalue'];
		$user_status = DB::fetch_first("SELECT * FROM " . DB::table('common_member_count') . " WHERE uid = '{$uid}'");
		$polls_count = DB::fetch_first("SELECT COUNT(*) FROM " . DB::table('forum_poll') . " LEFT JOIN " . DB::table('forum_post') . " USING(tid) WHERE authorid = '{$uid}'");
		$polls_count = intval($polls_count["COUNT(*)"]);
		$express = str_replace(array('digestposts', 'threads', 'posts', 'oltime', 'friends', 'doings', 'blogs', 'albums', 'sharings', 'extcredits1', 'extcredits2', 'extcredits3', 'extcredits4', 'extcredits5', 'extcredits6', 'extcredits7', 'extcredits8', 'polls'),array($user_status['digestposts'], $user_status['threads'], $user_status['posts'], $user_status['oltime'], $user_status['friends'], $user_status['doings'], $user_status['blogs'], $user_status['albums'], $user_status['sharings'], $user_status['extcredits1'], $user_status['extcredits2'], $user_status['extcredits3'], $user_status['extcredits4'], $user_status['extcredits5'], $user_status['extcredits6'], $user_status['extcredits7'], $user_status['extcredits8'], $polls_count),$express);
		eval('\$credits = '.$express.';');
		$query = DB::query("UPDATE " . DB::table('common_member') . " SET credits = '{$credits}' WHERE uid = '$uid'");
	}
}

?>