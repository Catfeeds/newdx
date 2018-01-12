<?php

/**
* 活动帖子model层
*/


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class activity
{
	public $redis;
	private $virtual_uid = 40269021;
	private $virtual_username = '在外用户';
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

	//获取给定坐标 $raidus 米内范围
	public function getrange($lat, $lng, $raidus)
	{
		//计算纬度
		$degree = (24901 * 1609) / 360;
		$dpmlat = 1 / $degree;
		$radiuslat = $dpmlat * $raidus;
		$minlat = $lat - $radiuslat; //得到最小纬度
		$maxlat = $lat + $radiuslat; //得到最大纬度
		//计算经度
		$mpdlng = $degree * cos($lat * (M_PI / 180));
		$dpmlng = 1 / $mpdlng;
		$radiuslng = $dpmlng * $raidus;
		$minlng = $lng - $radiuslng;  //得到最小经度
		$maxlng = $lng + $radiuslng;  //得到最大经度

		//范围
		$range = array(
			'minlat' => $minlat,
			'maxlat' => $maxlat,
			'minlng' => $minlng,
			'maxlng' => $maxlng
		);
		return $range;
	}

	//计算2点之间的距离 (km)
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

	//二维数组排序
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

	// 处理图片
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

	// 缓存省份数据
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

	// 缓存地方版（省份）及板块分类（地区）
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

	// 缓存地方版板块及分类关系
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

	//根据集合地经纬度智能匹配帖子所属版块
	public function parse_forum($lng, $lat)
	{
		//附默认值
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

			//引入版块分类关系
			$forum = $this->forum_type();
			//匹配fid
			foreach ($forum as $key => $value) {
				if(strpos($province_name, $value['name']) === false) {
					contniue;
				} else {
					$fid = $key;
					break;
				}
			}
			//匹配typeid
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

	// 活动玩法
	public function act_type()
	{
		global $_G;

		$activitytypelist = $_G['setting']['activitytype'] ? explode( "\r\n", trim( $_G['setting']['activitytype'] ) ) : '';

		return $activitytypelist;
	}

	// 返回俱乐部的出行次数和人次
	public function club_stat($clubid)
	{
		$club_stat = DB::fetch_first("SELECT clubid, clubname, actnum, usernum FROM ".DB::table("forum_activity_club")." WHERE clubid = '$clubid' ".getSlaveID());
		return $club_stat;
	}

	// 感兴趣的用户 浏览过的和报名的，实际只需将浏览的用户计入缓存
	public function follower($tid, $str)
	{
		$this->redis->sadd("activity_followers_".$tid, $str);
	}

	// 将感兴趣的用户报过名将从缓存记录中清除
	public function follower_rem($tid, $str)
	{
		$this->redis->srem("activity_followers_".$tid, $str);
	}

	// 感兴趣的用户 浏览过的和报名的，实际只需将浏览的用户计入缓存
	public function followers($tid)
	{
		return $this->redis->smembers("activity_followers_".$tid);
	}

	// 感兴趣的人列表
	public function follower_list($tid, $page = 1, $perpage = 10, $appuserid, $location)
	{
		$start = ($page-1)*$perpage;

		//已报名的人
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
		//浏览过的用户
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

		//对兴趣列表进行分页
		$followlist            = array_slice($followlist, $start, $perpage);
		$activity['next']      = ceil($activity['followernum']/$perpage) <= $page ? '' : "page=".($page+1);
		$activity['followers'] = array();

		if($activity['followernum']) {
			$wechat_token = $this->wechat_token();
			foreach ($followlist as $key => $value) {
				list($activity['followers'][$key]['usertype'], $activity['followers'][$key]['userid'], $activity['followers'][$key]['username'], $activity['followers'][$key]['applystatus']) = explode('|', $value);
				//微信用户
				if($activity['followers'][$key]['usertype'] == 3) {
					$wechat_result = requestRemoteData("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$wechat_token."&openid=".$activity['followers'][$key]['userid']."&lang=zh_CN");
					$wechat_result = json_decode($wechat_result, true);
					$activity['followers'][$key]['avatar'] = $wechat_result['headimgurl'] ? $wechat_result['headimgurl'] : 'http://static.8264.com/wei/images/default.png';
					list($activity['followers'][$key]['wechatunionid'], $activity['followers'][$key]['userid']) = explode($this->follower_connent, $activity['followers'][$key]['userid']);
				}
				//论坛用户
				if($activity['followers'][$key]['usertype'] == 1 && $activity['followers'][$key]['userid'] != $this->virtual_uid) {
					$activity['followers'][$key]['avatar'] = avatar($activity['followers'][$key]['userid'], 'middle', true);
				}
				//APP用户
				if($activity['followers'][$key]['usertype'] == 2) {
					//用户间关注关系
					//http://182.92.190.90/userService/findCustomerNearByUserVOBysourceUserIdAndTargetUserIdList?sToken=76879844270&sourceUserId=368402193299104&targetUserIdList=368455851044512,368156296318624,368209375262368&lng=116.48377&lat=39.99813
					if($appuserid && $activity['followers'][$key]['userid'] && !empty($location)) {
						list($lat, $lng) = explode(',', $location);

						$userinfo_result = requestRemoteData(ZAIWAI_API_URL."userService/findCustomerNearByUserVOBysourceUserIdAndTargetUserIdList?sourceUserId=".$appuserid."&targetUserIdList=".$activity['followers'][$key]['userid']."&lng=".$lng."&lat=".$lat."&sToken=".ZAIWAI_API_TOKEN);
						$userinfo_result  = json_decode($userinfo_result, true);
						$customerUserShow = iconv_array($userinfo_result['customerUserList'][0], "UTF-8", "gbk//TRANSLIT");
						$activity['followers'][$key]['avatar'] 			= $customerUserShow['userBasicDto']['picUrl'] ? $customerUserShow['userBasicDto']['picUrl'] : 'http://static.8264.com/wei/images/default.png';
						$activity['followers'][$key]['tabs'] 			= $customerUserShow['userBasicDto']['tabs'];	//标签
						$activity['followers'][$key]['content'] 		= $customerUserShow['userBasicDto']['content'];	//用户签名
						$activity['followers'][$key]['lastRequestTime'] = $customerUserShow['userBasicDto']['lastRequestTime'];	//最后更新时间
						$activity['followers'][$key]['relationType'] 	= $customerUserShow['relationType'];	//用户关注关系
						$activity['followers'][$key]['distance'] 		= $customerUserShow['distance'];	//用户距离
					} else {
						// $activity['followers'][$key]['followed'] = 0;
						// $relation_result = requestRemoteData(ZAIWAI_API_URL."userRelationService/findUserRelationTypeBetweenUser?sourceUserId=".$appuserid."&targetUserId=".$activity['followers'][$key]['userid']."&sToken=".ZAIWAI_API_TOKEN);
						// 	$relation_result = json_decode($relation_result, true);
						// 	$activity['followers'][$key]['followed'] = $relation_result['relationType'];
						//用户头像，无当前用户appuserid时，采用其它接口调取展示用户头像
						$user_result = requestRemoteData(ZAIWAI_API_URL."userService/findCustomerUserListByUserIdList?userIdList=".$activity['followers'][$key]['userid']."&sourceUserId=".$activity['followers'][$key]['userid']."&sToken=".ZAIWAI_API_TOKEN);
						$user_result = json_decode($user_result, true);
						$activity['followers'][$key]['avatar'] = $user_result['customerUserList'][0]['userBasic']['picUrl'] ? diconv($user_result['customerUserList'][0]['userBasic']['picUrl'], 'utf-8', 'gbk//TRANSLIT') : 'http://static.zaiwai.com/wei/images/default.png';
					}
				}
			}
		}

		return $activity;
	}

	//查询用户在某活动报名状态
	public function user_apply_status($tid, $uid, $appuserid, $wechatuserid)
	{
		if(!$tid) return false;
		if(!$uid && !$appuserid && !$wechatuserid) return false;

		//检测该用户是否报过该活动
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

	//查询某活动的报名用户
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

	//关键字屏蔽
	public function censor_app( $message, $modword = null)
	{
		// 禁止类似 &#x6C88;&#x9633; 的html实体汉字提交
		if(preg_match('/[&amp;|&]#x(\w+);/', $message)) {return true;}
		require_once libfile( 'class/censor' );
		$censor = discuz_censor::instance();
		$censor->check( $message, $modword );

		if ($censor->modbanned()) {
			return true;
		}

		return false;
	}

	//自动计算签名
	public function build_url($params, $secret)
	{
		ksort($params);
		reset($params);
		$str_q = http_build_query($params);
		$sign = md5($str_q.$secret);
		return '?'.$str_q.'&sign='.$sign;
	}

	//获取微信公众号token
	public function wechat_token()
	{
		//获得微信token
		require_once libfile('function/activity');
		$wechat_token = getWechatTokenOfZaiwai();

		return $wechat_token;
	}

	//发消息--源自source/function/function_core.php
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

	// 查询用户关联的APP用户ID
	public function leader_info($uid)
	{
		if(!intval($uid)) return false;

		$leader = DB::fetch_first("SELECT appuid AS appuserid, appusername FROM ".DB::table('common_openid')." WHERE uid='$uid'");

		return $leader;
	}

	// 文件日志
	public function filelog($filename, $content)
	{
		$timestamp = time();
		$filename = $filename.'_'.date("Ymd", $timestamp).'.log';
		$str = date("H:i:s", $timestamp)."\t";
		$str .= is_array($content) ? var_export($content, true) : $content;
		$str .= "\r\n---------------\r\n";

		file_put_contents(DISCUZ_ROOT.'data/dlogs/'.$filename, $str, FILE_APPEND);
	}

	//处理活动内容里的\r\n
	function dealActivityMessage($str) {
		$str = preg_replace("/(\r\n){2,}/", "\r\n", $str);
		$str = preg_replace("/\r\n[\s]+/", "\r\n", $str);
		return $str;
	}

}
