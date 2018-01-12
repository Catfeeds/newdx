<?php

/**
* �����model��
*/


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class activity
{
	public $redis;
	private $virtual_uid = 40269021;
	private $virtual_username = '�����û�';
	private $follower_connent = '#zaiwaiapp#';
	const EARTH_RADIUS = 6378.137;

	function __construct()
	{
		global $redis;
		if (!$redis) {
			require_once libfile('class/myredis');
			$redis = & myredis::instance(6381);
		}
		$this->redis = $redis;
	}

	//��ȡ�������� $raidus ���ڷ�Χ
	public function getrange($lat, $lng, $raidus)
	{
		//����γ��
		$degree = (24901 * 1609) / 360;
		$dpmlat = 1 / $degree;
		$radiuslat = $dpmlat * $raidus;
		$minlat = $lat - $radiuslat; //�õ���Сγ��
		$maxlat = $lat + $radiuslat; //�õ����γ��
		//���㾭��
		$mpdlng = $degree * cos($lat * (M_PI / 180));
		$dpmlng = 1 / $mpdlng;
		$radiuslng = $dpmlng * $raidus;
		$minlng = $lng - $radiuslng;  //�õ���С����
		$maxlng = $lng + $radiuslng;  //�õ���󾭶�

		//��Χ
		$range = array(
			'minlat' => $minlat,
			'maxlat' => $maxlat,
			'minlng' => $minlng,
			'maxlng' => $maxlng
		);
		return $range;
	}

	//����2��֮��ľ��� (km)
	public function distance($lat1, $lng1, $lat2, $lng2)
	{
		$radlat1 = $lat1 * (M_PI / 180);
		$radlat2 = $lat2 * (M_PI / 180);

		$a = $radlat1 - $radlat2;
		$b = ($lng1 * (M_PI / 180)) - ($lng2 * (M_PI / 180));

		$s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radlat1)*cos($radlat2)*pow(sin($b/2),2)));
		$s = $s * self::EARTH_RADIUS;
		$s = round($s, 2);
		return $s;
	}

	//��ά��������
	public function multi_array_sort($multi_array, $sort_key, $sort=SORT_ASC)
	{
		if(is_array($multi_array)){
			foreach ($multi_array as $row_array){
				if(is_array($row_array)){
					$key_array[] = $row_array[$sort_key];
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
		array_multisort($key_array, $sort, $multi_array);
		return $multi_array;
	}

	// ����ͼƬ
	public function attach($aid)
	{
		if(!intval($aid)) return false;

		require_once DISCUZ_ROOT.'source/plugin/attachment_server/attachment_server.class.php';
		$attachserver = new attachserver;
		$attachlist = $attachserver->get_server_domain('all', '*');

		$attachment = DB::fetch_first("SELECT attachment, isimage, remote, width, serverid, dir FROM " . DB::table('forum_attachment') . " WHERE aid='$aid' ".getSlaveID());
		if($attachment['isimage'] && $attachment['serverid'] > 0) {
			$path = "http://" . $attachlist[$attachment['serverid']]['name'] . "/".$attachment['dir']."/" . $attachment['attachment'];
		}

		return $path;
	}

	// ����ʡ������
	public function province()
	{
		$province_cache = $this->redis->get("act_api_province");
		$province = unserialize($province_cache);
		if(!$province) {
			$sql = "SELECT fid, name FROM ".DB::table("forum_forum")." WHERE fup = 76 ORDER BY displayorder ASC ".getSlaveID();
			$query = DB::query($sql);
			while($row = DB::fetch($query)){
				$province[] = $row;
			}

			$this->redis->set("act_api_province", serialize($province));
		}

		return $province;
	}

	// ����ط��棨ʡ�ݣ��������ࣨ������
	public function zone()
	{
		$zone_cache = $this->redis->get("act_api_zone");
		$province = unserialize($zone_cache);
		if(!$province) {
			$province = $this->province();
			foreach ($province as $key => $value) {
				$sql = "SELECT typeid, name FROM ".DB::table("forum_threadclass")." WHERE fid = '$value[fid]' ORDER BY displayorder ASC ".getSlaveID();
				$query = DB::query($sql);
				while($row = DB::fetch($query)){
					$province[$key]['zone'][] = $row;
				}
			}
			$this->redis->obj->set("act_api_zone", serialize($province), 864000);
		}

		return $province;
	}

	// ����ط����鼰�����ϵ
	public function forum_type()
	{
		$forum_cache = $this->redis->get("act_api_forum");
		$forum = unserialize($forum_cache);
		if(!$forum) {
			$province = $this->province();
			foreach ($province as $value) {
				$sql = "SELECT typeid, name FROM ".DB::table("forum_threadclass")." WHERE fid = '$value[fid]' ORDER BY displayorder ASC ".getSlaveID();
				$query = DB::query($sql);
				while($row = DB::fetch($query)){
					$forum[$value['fid']]['name'] = $value['name'];
					$forum[$value['fid']]['type'][$row['typeid']] = $row['name'];
				}
			}
			$this->redis->obj->set("act_api_forum", serialize($forum), 864000);
		}

		return $forum;
	}

	//���ݼ��ϵؾ�γ������ƥ�������������
	public function parse_forum($lng, $lat)
	{
		//��Ĭ��ֵ
		$return = array('fid' => 101, 'typeid' => 1500);

		$lng = doubleval($lng);
		$lat = doubleval($lat);

		$result = requestRemoteData("http://api.map.baidu.com/geocoder/v2/?ak=kPPtRU331p8sFr6ewML5sN53&location={$lat},{$lng}&output=json");
		$result_data = json_decode($result, true);
		if($result_data['status'] > 0) {
			return $return;
		} else {
			$province_name = diconv($result_data['result']['addressComponent']['province'], "utf-8", "gbk//TRANSLIT");
			$city_name     = diconv($result_data['result']['addressComponent']['city'], "utf-8", "gbk//TRANSLIT");

			//����������ϵ
			$forum = $this->forum_type();
			//ƥ��fid
			foreach ($forum as $key => $value) {
				if(strpos($province_name, $value['name']) === false) {
					contniue;
				} else {
					$fid = $key;
					break;
				}
			}
			//ƥ��typeid
			if($fid) {
				$j = 0;
				foreach ($forum[$fid]['type'] as $key => $value) {
					if($j == 0) { $typeid = $key; }
					if(strpos($city_name, $value) === false) {
						contniue;
					} else {
						$typeid = $key;
						break;
					}
					$j++;
				}
			} else {
				return $return;
			}

			return $fid == 139 ? $return : array('fid' => $fid, 'typeid' => $typeid);
		}
	}

	// ��淨
	public function act_type()
	{
		global $_G;

		$activitytypelist = $_G['setting']['activitytype'] ? explode( "\r\n", trim( $_G['setting']['activitytype'] ) ) : '';

		return $activitytypelist;
	}

	// ���ؾ��ֲ��ĳ��д������˴�
	public function club_stat($clubid)
	{
		$club_stat = DB::fetch_first("SELECT clubid, clubname, actnum, usernum FROM ".DB::table("forum_activity_club")." WHERE clubid = '$clubid' ".getSlaveID());
		return $club_stat;
	}

	// ����Ȥ���û� ������ĺͱ����ģ�ʵ��ֻ�轫������û����뻺��
	public function follower($tid, $str)
	{
		$this->redis->sadd("activity_followers_".$tid, $str);
	}

	// ������Ȥ���û����������ӻ����¼�����
	public function follower_rem($tid, $str)
	{
		$this->redis->srem("activity_followers_".$tid, $str);
	}

	// ����Ȥ���û� ������ĺͱ����ģ�ʵ��ֻ�轫������û����뻺��
	public function followers($tid)
	{
		return $this->redis->smembers("activity_followers_".$tid);
	}

	// ����Ȥ�����б�
	public function follower_list($tid, $page = 1, $perpage = 10, $appuserid, $location)
	{
		$start = ($page-1)*$perpage;

		//�ѱ�������
		$applyers = $applyed = array();
		$applyers = $this->apply_list($tid);
		if($applyers) {
			foreach ($applyers as $key => $value) {
				if($value['wechatunionid'] && $value['wechatuserid'] && $value['wechatusername']) {
					$applyed[$key] = '3|'.$value['wechatunionid'].$this->follower_connent.$value['wechatuserid'].'|'.$value['wechatusername'].'|1';
				} else if ($value['appuserid'] && $value['appusername']) {
					$applyed[$key] = '2|'.$value['appuserid'].'|'.$value['appusername'].'|1';
				} elseif($value['uid'] && $value['username'] && $value['uid'] != $this->virtual_uid) {
					$applyed[$key] = '1|'.$value['uid'].'|'.$value['username'].'|1';
				}
			}
		}
		//��������û�
		$followers = $this->followers($tid);

		$followlist = array_merge($applyed, $followers);

		$hasfirst = array();
		foreach ($followlist as $k=>$v) {
			list($tempUsertype, $tempUserid, $tempUsername, $tempApplystatus) = explode('|', $v);
			if ($tempUsertype == '2') {
				$hasfirst[$tempUserid][] = array('k'=>$k,'v'=>$v, 'applyStatus'=>$tempApplystatus);
			}
		}

		foreach ($hasfirst as $key=>$value) {
			$tempCount = count($value);
			if ($tempCount == 1) {continue;}
			$tempHasVerify = empty($value['applyStatus']) ? true : false;
			foreach ($value as $k=>$v) {
				if ($tempHasVerify && $k == 0) {continue;}
				if (!$tempHasVerify && $k == $tempCount - 1) {continue;}

				unset($followlist[$v['k']]);
				$this->follower_rem($tid, $v['v']);
			}
		}

		$activity['followernum'] = count($followlist);

		//����Ȥ�б���з�ҳ
		$followlist            = array_slice($followlist, $start, $perpage);
		$activity['next']      = ceil($activity['followernum']/$perpage) <= $page ? '' : "page=".($page+1);
		$activity['followers'] = array();

		if($activity['followernum']) {
			$wechat_token = $this->wechat_token();
			foreach ($followlist as $key => $value) {
				list($activity['followers'][$key]['usertype'], $activity['followers'][$key]['userid'], $activity['followers'][$key]['username'], $activity['followers'][$key]['applystatus']) = explode('|', $value);
				//΢���û�
				if($activity['followers'][$key]['usertype'] == 3) {
					$wechat_result = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$wechat_token."&openid=".$activity['followers'][$key]['userid']."&lang=zh_CN");
					$wechat_result = json_decode($wechat_result, true);
					$activity['followers'][$key]['avatar'] = $wechat_result['headimgurl'] ? $wechat_result['headimgurl'] : 'http://static.8264.com/wei/images/default.png';
					list($activity['followers'][$key]['wechatunionid'], $activity['followers'][$key]['userid']) = explode($this->follower_connent, $activity['followers'][$key]['userid']);
				}
				//��̳�û�
				if($activity['followers'][$key]['usertype'] == 1 && $activity['followers'][$key]['userid'] != $this->virtual_uid) {
					$activity['followers'][$key]['avatar'] = avatar($activity['followers'][$key]['userid'], 'middle', true);
				}
				//APP�û�
				if($activity['followers'][$key]['usertype'] == 2) {
					//�û����ע��ϵ
					//http://182.92.190.90/userService/findCustomerNearByUserVOBysourceUserIdAndTargetUserIdList?sToken=76879844270&sourceUserId=368402193299104&targetUserIdList=368455851044512,368156296318624,368209375262368&lng=116.48377&lat=39.99813
					if($appuserid && $activity['followers'][$key]['userid'] && !empty($location)) {
						list($lat, $lng) = explode(',', $location);

						$userinfo_result = requestRemoteData(ZAIWAI_API_URL."userService/findCustomerNearByUserVOBysourceUserIdAndTargetUserIdList?sourceUserId=".$appuserid."&targetUserIdList=".$activity['followers'][$key]['userid']."&lng=".$lng."&lat=".$lat."&sToken=".ZAIWAI_API_TOKEN);
						$userinfo_result  = json_decode($userinfo_result, true);
						$customerUserShow = iconv_array($userinfo_result['customerUserList'][0], "UTF-8", "gbk//TRANSLIT");
						$activity['followers'][$key]['avatar'] 			= $customerUserShow['userBasicDto']['picUrl'] ? $customerUserShow['userBasicDto']['picUrl'] : 'http://static.8264.com/wei/images/default.png';
						$activity['followers'][$key]['tabs'] 			= $customerUserShow['userBasicDto']['tabs'];	//��ǩ
						$activity['followers'][$key]['content'] 		= $customerUserShow['userBasicDto']['content'];	//�û�ǩ��
						$activity['followers'][$key]['lastRequestTime'] = $customerUserShow['userBasicDto']['lastRequestTime'];	//������ʱ��
						$activity['followers'][$key]['relationType'] 	= $customerUserShow['relationType'];	//�û���ע��ϵ
						$activity['followers'][$key]['distance'] 		= $customerUserShow['distance'];	//�û�����
					} else {
						// $activity['followers'][$key]['followed'] = 0;
						// $relation_result = requestRemoteData(ZAIWAI_API_URL."userRelationService/findUserRelationTypeBetweenUser?sourceUserId=".$appuserid."&targetUserId=".$activity['followers'][$key]['userid']."&sToken=".ZAIWAI_API_TOKEN);
						// 	$relation_result = json_decode($relation_result, true);
						// 	$activity['followers'][$key]['followed'] = $relation_result['relationType'];
						//�û�ͷ���޵�ǰ�û�appuseridʱ�����������ӿڵ�ȡչʾ�û�ͷ��
						$user_result = requestRemoteData(ZAIWAI_API_URL."userService/findCustomerUserListByUserIdList?userIdList=".$activity['followers'][$key]['userid']."&sourceUserId=".$activity['followers'][$key]['userid']."&sToken=".ZAIWAI_API_TOKEN);
						$user_result = json_decode($user_result, true);
						$activity['followers'][$key]['avatar'] = $user_result['customerUserList'][0]['userBasic']['picUrl'] ? diconv($user_result['customerUserList'][0]['userBasic']['picUrl'], 'utf-8', 'gbk//TRANSLIT') : 'http://static.zaiwai.com/wei/images/default.png';
					}
				}
			}
		}

		return $activity;
	}

	//��ѯ�û���ĳ�����״̬
	public function user_apply_status($tid, $uid, $appuserid, $wechatuserid)
	{
		if(!$tid) return false;
		if(!$uid && !$appuserid && !$wechatuserid) return false;

		//�����û��Ƿ񱨹��û
		if($wechatuserid) {
			$apply_where = " AND wechatuserid='$wechatuserid'";
		}
		if ($appuserid) {
			$apply_where = " AND appuserid='$appuserid'";
		}
		if ($uid) {
			$apply_where = " AND uid='$uid'";
		}
		if($apply_where) {
			$data['apply'] = DB::fetch_first("SELECT applyid, verified, ufielddata, appusername, wechatusername, uid FROM ".DB::table("forum_activityapply")." WHERE tid='$tid' $apply_where ".getSlaveID());
			if(!$data['apply']) {
				$data['apply']['applyid'] = $data['apply']['verified'] = 0;
			}
		}
		return $data;
	}

	//��ѯĳ��ı����û�
	public function apply_list($tid)
	{
		if(!$tid) return false;

		$sql = "SELECT applyid, username, uid, verified, appuserid, appusername, wechatunionid, wechatuserid, wechatusername FROM ".DB::table("forum_activityapply")." WHERE tid='$tid' ORDER BY applyid DESC ".getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			$data[] = $row;
		}
		return $data;
	}

	//�ؼ�������
	public function censor_app( $message, $modword = null)
	{
		// ��ֹ���� &#x6C88;&#x9633; ��htmlʵ�庺���ύ
		if(preg_match('/[&amp;|&]#x(\w+);/', $message)) {return true;}
		require_once libfile( 'class/censor' );
		$censor = discuz_censor::instance();
		$censor->check( $message, $modword );

		if ($censor->modbanned()) {
			return true;
		}

		return false;
	}

	//�Զ�����ǩ��
	public function build_url($params, $secret)
	{
		ksort($params);
		reset($params);
		$str_q = http_build_query($params);
		$sign = md5($str_q.$secret);
		return '?'.$str_q.'&sign='.$sign;
	}

	//��ȡ΢�Ź��ں�token
	public function wechat_token()
	{
		//���΢��token
		require_once libfile('function/activity');
		$wechat_token = getWechatTokenOfZaiwai();

		return $wechat_token;
	}

	//����Ϣ--Դ��source/function/function_core.php
	function notification_add( $touid, $type, $note, $notevars = array(), $system = 0 )
	{

		$notevars['actor'] = "<a href=\"home.php?mod=space&uid=$notevars[fromid]\">" . $notevars['username'] . "</a>";
		$notestring = lang( 'notification', $note, $notevars );

		$oldnote = array();
		if ( empty( $oldnote['from_num'] ) ) {
			$oldnote['from_num'] = 0;
		}

		$setarr = array(
			'uid' 		=> $touid,
			'type' 		=> $type,
			'new' 		=> 1,
			'authorid' 	=> $notevars['fromid'],
			'author' 	=> $notevars['username'],
			'note' 		=> addslashes( $notestring ),
			'dateline'  => time(),
			'from_num'  => ( $oldnote['from_num'] + 1 ) );
		if ( $system )
		{
			$setarr['authorid'] = 0;
			$setarr['author'] = '';
		}

		DB::insert( 'home_notification', $setarr );

		DB::query( "UPDATE " . DB::table( 'common_member_status' ) . " SET notifications=notifications+1 WHERE uid='$touid'" );
		DB::query( "UPDATE " . DB::table( 'common_member' ) . " SET newprompt=newprompt+1 WHERE uid='$touid'" );

		require_once libfile( 'function/mail' );
		$mail_subject = lang( 'notification', 'mail_to_user' );
		sendmail_touser( $touid, $mail_subject, $notestring, $type );

		if ( ! $system && $notevars['fromid'] && $touid != $notevars['fromid'] )
		{
			require_once libfile('function/friend');
			increase_intimacy($notevars['fromid'], $touid);
		}
	}

	// ��ѯ�û�������APP�û�ID
	public function leader_info($uid)
	{
		if(!intval($uid)) return false;

		$leader = DB::fetch_first("SELECT appuid AS appuserid, appusername FROM ".DB::table('common_openid')." WHERE uid='$uid'");

		return $leader;
	}

	// �ļ���־
	public function filelog($filename, $content)
	{
		$timestamp = time();
		$filename = $filename.'_'.date("Ymd", $timestamp).'.log';
		$str = date("H:i:s", $timestamp)."\t";
		$str .= is_array($content) ? var_export($content, true) : $content;
		$str .= "\r\n---------------\r\n";

		file_put_contents(DISCUZ_ROOT.'data/dlogs/'.$filename, $str, FILE_APPEND);
	}

	//�����������\r\n
	function dealActivityMessage($str) {
		$str = preg_replace("/(\r\n){2,}/", "\r\n", $str);
		$str = preg_replace("/\r\n[\s]+/", "\r\n", $str);
		return $str;
	}

}
