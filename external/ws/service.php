<?php
/**
 * 获取主站数据WebService
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
	 * 获取8264用户统计信息
	 * 
	 * @author wistar 120531
	 * 
	 * @param int uid 用户ID
	 * @return array 用户统计信息
	 */
	function getExtcredits ($uid) {
		$arr_extcs = DB::fetch_first('SELECT * FROM ' . DB::table('common_member_count') . " WHERE uid='{$uid}'");
		return $arr_extcs;
	}

	/**
	 * 修改8264用户积分等信息
	 * 
	 * @author wistar 120531
	 * 
	 * @param int uid 用户ID
	 * @param int lvbi 驴币（extcredits2）
	 */
	function setExtcredits($uid, $lvbi) {
		// 将剩余驴币设置到用户信息统计表
		DB::update('common_member_count', array('extcredits2' => $lvbi), array('uid' => $uid));
		// 取出计算表达式
		$exp = DB::fetch_first('SELECT svalue FROM ' . DB::table('common_setting') . " WHERE skey = 'creditsformula'");
		// 取出用户统计信息
		$user_status = DB::fetch_first('SELECT * FROM ' . DB::table('common_member_count') . " WHERE uid = '{$uid}'");
		// 重新组合键值对应
		$key = array('digestposts', 'threads', 'posts', 'oltime', 'friends', 'doings', 'blogs', 'albums', 'sharings', 'extcredits1', 'extcredits2', 'extcredits3', 'extcredits4', 'extcredits5', 'extcredits6', 'extcredits7', 'extcredits8');
		$val = array($user_status['digestposts'], $user_status['threads'], $user_status['posts'], $user_status['oltime'], $user_status['friends'], $user_status['doings'], $user_status['blogs'], $user_status['albums'], $user_status['sharings'], $user_status['extcredits1'], $user_status['extcredits2'], $user_status['extcredits3'], $user_status['extcredits4'], $user_status['extcredits5'], $user_status['extcredits6'], $user_status['extcredits7'], $user_status['extcredits8']);
		$express = str_replace($key, $val, $exp['svalue']);
		// 总分值计算并写回member表
		eval('\$credits = '.$express.';');
		DB::update('common_member', array('credits' => $credits), array('uid' => $uid));
	}

	/**
	 * 获取主站用户信息
	 * @author wangyixiang
	 *
	 * @param type uid
	 * @return array 用户积分等信息
	 * 
	 * extcredits1[_title] [威望]；extcredits2[_title] [驴币]；extcredits3[_title] [贡献]；extcredits4[_title] [魅力]；extcredits5[_title] [8264币]；
	 * groupid:1-管理员；2-超级版主；3-版主；17-实习斑竹；33-地方论坛版主；45-半脊峰；49-荣誉版主；51-版主助理
	 *		   9-乞丐；11-新驴上路；12-希夏邦玛峰；13-迦舒布鲁姆Ⅱ峰；14-布洛阿特峰；15-迦舒布鲁姆Ⅰ峰；23-安纳普尔那峰；24-南迦帕尔巴特峰
	 *		   25-马纳斯鲁峰；26-道拉吉利峰；27-卓奥友峰；28-马卡鲁峰；29-洛子峰；30-干城章嘉峰；42-乔戈里峰；44-珠穆朗玛峰
	 *		   18-驴友；21-攀岩版核心会员；31-行摄版核心会员；48-8264QQ群联盟群主；41-骑行版核心会员
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
	 * 获取主站存在的用户组信息
	 * @author wangyixiang
	 *
	 * @return array 用户组信息
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
	 * 在兑换代金券后修改主站驴币信息
	 * @author wangyixiang
	 *
	 * @return 修改后的驴币值
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