<?php

/**
* 活动帖子操作
*/


if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class thread
{
	public $tid;
	public $thread;
	public $activity;
	protected $uid;
	protected $username;
	protected $groupid;
	public $timestamp;
	public $redis;
	public $logs;
	protected $model;
	protected $errmsg;
	protected $arrDi;

	function __construct()
	{
		global $redis, $logs, $_G;

		$this->timestamp = time();
		$this->redis = $redis;
		$this->logs = $logs;
		$this->errmsg = diconv('"errorCode": 2, "errorReason":"服务器出错，请与我们工作人员联系", ', 'gbk', 'utf-8');
		$this->groupid = 7;	//初始用户为游客

		require DISCUZ_ROOT.'api/activity/activity_model.php';
		$this->model = new activity;

		//获取用户信息
		$userkey = $_G['gp_userkey'];
		if($userkey) {
			$userkey = urldecode($userkey);
			$userkey = diconv($userkey, 'utf-8', 'gbk//TRANSLIT');
			list($this->uid, $this->username) = explode("|", $userkey);
			if($this->uid) {
				$user = getuserbyuid($this->uid);
				$this->groupid = $user['groupid'];
			}
		}

		//地方版版块id
		$this->arrDi = array(100,101,48,166,112,158,113,110,108,176,117,104,106,164,114,159,116,109,111,115,170,143,177,103,165,107,102,139,171,105,147);
		$this->arrDi = array_flip($this->arrDi);

	}

	protected function base()
	{
		$tid = intval($_GET['tid']);
		if(!$tid) {
			output_errorMsg(423, 'Param tid miss.', '');
		}

		$this->thread = DB::fetch_first("SELECT tid, special, authorid, typeid, fid, subject, displayorder FROM ".DB::table("forum_thread")." WHERE tid='$tid' ".getSlaveID());
		if(!$this->thread['tid'] || $this->thread['special'] != 4) {
			output_errorMsg(431, 'Thread don\'t exist or type error.', '此贴子不是活动贴');
		}
		$this->tid = $this->thread['tid'];
	}

	protected function act_info()
	{
		//校正报名人数
		setPassnumAndApplynum($this->tid);
		$this->activity = DB::fetch_first("SELECT tid, uid, starttimefrom as starttime, starttimeto as endtime, number, applynumber, passnumber, expiration as exptime, ufield, title, place FROM ".DB::table("forum_activity")." WHERE tid='$this->tid' ".getSlaveID());
	}

	// 检查活动帖状态
	public function status()
	{
		$this->base();
		$this->act_info();

		$data = array();

		//是否需要传身份证
		$ufield = unserialize($this->activity['ufield']);
		$this->activity['isIdcard'] = in_array("idcard", $ufield['userfield']) ? 1 : 0;
		unset($ufield);
		unset($this->activity['ufield']);

		$data['status'] = $this->activity;
		$data['status']['displayorder'] = $this->thread['displayorder'];
		output_msg($data, true);
	}

	//获取省份列表(没用了)
	public function cityList()
	{
		global $_G;

		//城市对应的拼音名
		$citylist_info = array(
			100 => array('fid' => 100, 'ename' => 'Tianjin', 'lng' => 117.21503, 'lat' => 39.120876),
			101 => array('fid' => 101, 'ename' => 'Beijing', 'lng' => 116.408198, 'lat' => 39.904667),
			158 => array('fid' => 158, 'ename' => 'Anhui', 'lng' => 117.2847, 'lat' => 31.860611),
			48 => array('fid' => 48, 'ename' => 'Shanghai', 'lng' => 121.472916, 'lat' => 31.230708),
			166 => array('fid' => 166, 'ename' => 'Chongqing', 'lng' => 106.551234, 'lat' => 29.562686),
			113 => array('fid' => 113, 'ename' => 'Fujian', 'lng' => 119.295863, 'lat' => 26.101062),
			110 => array('fid' => 110, 'ename' => 'Gansu', 'lng' => 103.826363, 'lat' => 36.0593),
			112 => array('fid' => 112, 'ename' => 'Guangdong', 'lng' => 113.266558, 'lat' => 23.131614),
			108 => array('fid' => 108, 'ename' => 'Guangxi', 'lng' => 108.327697, 'lat' => 22.815547),
			176 => array('fid' => 176, 'ename' => 'Guizhou', 'lng' => 106.706927, 'lat' => 26.598435),
			117 => array('fid' => 117, 'ename' => 'Hainan', 'lng' => 110.356808, 'lat' => 20.029341),
			104 => array('fid' => 104, 'ename' => 'Hebei', 'lng' => 114.469259, 'lat' => 38.037252),
			106 => array('fid' => 106, 'ename' => 'Henan', 'lng' => 113.687816, 'lat' => 113.687816),
			164 => array('fid' => 164, 'ename' => 'Hubei', 'lng' => 114.341719, 'lat' => 30.54565),
			114 => array('fid' => 114, 'ename' => 'Hunan', 'lng' => 112.983521, 'lat' => 28.113053),
			159 => array('fid' => 159, 'ename' => 'Heilongjiang', 'lng' => 126.66268, 'lat' => 45.742352),
			116 => array('fid' => 116, 'ename' => 'Jilin', 'lng' => 126.549572, 'lat' => 43.837883),
			109 => array('fid' => 109, 'ename' => 'Jiangsu', 'lng' => 118.762313, 'lat' => 32.061241),
			111 => array('fid' => 111, 'ename' => 'Jiangxi', 'lng' => 115.90893, 'lat' => 28.674628),
			115 => array('fid' => 115, 'ename' => 'Liaoning', 'lng' => 123.437162, 'lat' => 41.836521),
			170 => array('fid' => 170, 'ename' => 'Neimenggu', 'lng' => 111.674121, 'lat' => 40.823542),
			143 => array('fid' => 143, 'ename' => 'Ningxia', 'lng' => 106.25868, 'lat' => 38.47117),
			177 => array('fid' => 177, 'ename' => 'Qinghai', 'lng' => 101.778208, 'lat' => 36.617085),
			103 => array('fid' => 103, 'ename' => 'Shandong', 'lng' => 117.019896, 'lat' => 36.669227),
			165 => array('fid' => 165, 'ename' => 'Shanxi', 'lng' => 112.562537, 'lat' => 37.873464),
			107 => array('fid' => 107, 'ename' => 'Shanxi', 'lng' => 108.954132, 'lat' => 34.265173),
			102 => array('fid' => 102, 'ename' => 'Sichuan', 'lng' => 104.076418, 'lat' => 30.650892),
//							139 => array('fid' => 139, 'ename' => 'Xizang', 'lng' => 91.117006, 'lat' => 29.647951),
			171 => array('fid' => 171, 'ename' => 'Xinjiang', 'lng' => 87.627546, 'lat' => 43.793147),
			105 => array('fid' => 105, 'ename' => 'Yunnan', 'lng' => 102.709809, 'lat' => 25.045254),
			147 => array('fid' => 147, 'ename' => 'Zhejiang', 'lng' => 120.15383, 'lat' => 30.266214)
		);

		$province = $this->model->province();

		$_citylist_hot = array(
			'101' => 1,
			'48'  => 1,
			'112' => 1,
			'115' => 1
		);

		$citylist_hot   = array();
		$province_other = array();

		//过滤热门城市
		foreach ($province as $k=>$v) {
			if ($v['fid'] == 139) {continue;}
			$temp = array();
			$temp		    = $citylist_info[$v['fid']];
			$temp['fid']    = $v['fid'];
			$temp['name']   = $v['name'];
			$temp['picUrl'] = "{$_G['config']['web']['static']}wei/images/city/{$v['fid']}.jpg!wap";

			if(isset($_citylist_hot[$v['fid']])) {
				$citylist_hot[] = $temp;
			} else {
				$province_other[] = $temp;
			}

		}
		// $citynumbers_cache = $this->redis->get("act_api_citynumbers");
		// $citynumbers = unserialize($citynumbers_cache);	//城市版块fid对应的活动数量

		$data['cityList'] = array("cityListHot" => $citylist_hot, "cityListOther" => $province_other);	// , "cityNumbers" => $citynumbers
		unset($province);

		output_msg($data, true);
	}

	// 列表 排序参数()
	public function actList()
	{
		$page 	    = max(intval($_GET['page']), 1);
		$perpage    = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start 	    = ($page-1)*$perpage;
		$fid 	    = intval($_GET['fid']);	//切换城市时传入地方版对应fid
		$lat 	    = $_GET['lat'];
		$lng 	    = $_GET['lng'];
		$radius     = !empty($_GET['radius']) ? intval($_GET['radius']) : 300000;
		$clubid     = intval($_GET['clubid']);
		$recycle    = intval($_GET['recycle']) ? 1 : 0;
		$daterange  = in_array($_GET['daterange'], array('weekend', 'week', 'month', 'expire', 'mine', 'all')) ? $_GET['daterange'] : 'all';
		$order      = in_array($_GET['order'], array('nearest', 'recent', 'hottest', 'latest')) ? $_GET['order'] : 'nearest';
		$isDistance = false;
		$fid_loc    = 0;

		// 俱乐部活动列表
		if($clubid) {
			$club_stat = $this->model->club_stat($clubid);
			$data['clubStat'] = $club_stat;
		}

		//若是没有定位的经纬度，而且也没有版块id，而且也没有俱乐部ID，则返回空数组
		if (empty($lat) && empty($lat) && empty($fid) && empty($clubid)) {
			$data['next'] 	 = "";
			$data['actList'] = array();
			output_msg($data, true);
		}

		if (!empty($_GET['location']) && $order == 'nearest') {
			$_GET['location'] = str_replace('%2C', ',', $_GET['location']);
			list($lat_loc, $lng_loc) = explode(',', $_GET['location']);

			//自动匹配版块,分类
			$parse_fid = $this->model->parse_forum($lng_loc, $lat_loc);
			$fid_loc   = !empty($parse_fid['fid']) ? $parse_fid['fid'] : 0;
		}

		$where = '';
		$list  = array();

		if(!$recycle) {
			$where .= " AND t.displayorder >= 0";
		}

		//没有时间范围，则列出过期活动
		switch ($daterange) {
			case 'weekend':	//周末，本周六0点到周日23点
				$nowdate   = date("N");
				$starttime = $nowdate < 6 ? strtotime(date("Y-m-d", $this->timestamp+(6-$nowdate)*86400)." 00:00:00") : $this->timestamp;
				$endtime   = strtotime(date("Y-m-d", $this->timestamp+(7-$nowdate)*86400)." 23:59:59");
				$where    .= " AND a.starttimefrom > {$starttime} AND a.starttimefrom < {$endtime}";
				break;
			case 'week':	//开始时间在7天内
				$endtime = $this->timestamp+604800;
				$where  .= " AND a.starttimefrom > {$this->timestamp} AND a.starttimefrom < {$endtime}";
				break;
			case 'month':	//开始时间在28天内
				$endtime = $this->timestamp+2419200;
				$where  .= " AND a.starttimefrom > {$this->timestamp} AND a.starttimefrom < {$endtime}";
				break;
			case 'expire':	//过期活动
				$where .= " AND a.starttimefrom < {$this->timestamp}";
				break;
			case 'all':
				$where .= " AND a.starttimefrom > {$this->timestamp}";
				break;
			default:
				break;
		}
		if ($clubid) {
			$where .= $clubid ? " AND a.clubid = {$clubid}" : '';
		} else {
			if ($fid) {
				$where .= " AND t.fid = {$fid}";
			} elseif ($lat && $lng) {

				//自动匹配版块,分类
				$parse_fid = $this->model->parse_forum($lng, $lat);
				$fid  = !empty($parse_fid['fid']) ? $parse_fid['fid'] : 0;

				if ($fid) {
					$where .= " AND t.fid = {$fid}";
				} else {
					$range  = $this->model->getrange($lat, $lng, $radius);
					$where .= " AND a.lat>{$range[minlat]} AND a.lat<{$range[maxlat]} AND a.lng>{$range[minlng]} AND a.lng<{$range[maxlng]}";
				}
			}
		}

		//判断是否计算距离
		$isDistance = $fid == $fid_loc && !$clubid ? true : false;

		$sql = "SELECT t.subject, t.author, t.dateline, t.fid, a.tid, a.aid, a.title, a.cost, a.starttimefrom as starttime, a.starttimeto as endtime, a.place, a.collectplace, a.class, a.number, a.applynumber, a.passnumber, a.expiration as exptime, a.nature, a.clubid, a.clubname, a.lng, a.lat, a.hottest FROM ".DB::table("forum_activity")." AS a
		LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=a.tid
		WHERE a.tid > 5161751 AND a.timediff < 4 AND a.credit = 0 {$where}" . getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			if (!isset($this->arrDi[$row['fid']])) {
				continue;
			}

			$row['starttime'] = intval($row['starttime']);
			$row['endtime']   = intval($row['endtime']);
			$row['hottest']   = intval($row['hottest']);
			$row['tid']   	  = intval($row['tid']);
			$row['isExpired'] = $row['starttime'] < $this->timestamp ? 1 : 0;	//活动是否过期

			$row['distance']  = $isDistance ? $this->model->distance($lat_loc, $lng_loc, $row['lat'], $row['lng']) : '';
			$row['coverpic']  = $this->model->attach($row['aid']);

			//格式化时间
			$row['dateline_f']  = date("YmdHis", $row['dateline']);
			$row['starttime_f'] = date("YmdHis", $row['starttime']);
			$row['endtime_f'] 	= date("YmdHis", $row['endtime']);
			$row['exptime_f'] 	= date("YmdHis", $row['exptime']);

			$list[] = $row;
		}
		switch ($order) {
			case 'recent':
//				$orderby = 'a.starttimefrom ASC';
				$list = $this->model->multi_array_sort($list, 'starttime');
				break;
			case 'hottest':
//				$orderby = 'a.hottest DESC, a.starttimeto DESC';
				$list = $this->model->multi_array_sort($list, 'hottest', SORT_DESC);
				$listCount = count($list);
				for ($i=0;$i<$listCount-1;$i++) {
		        	for ($j=$i+1;$j<=$listCount-1;$j++) {
		        		if ($list[$i]['distance'] > $list[$j]['distance'] && $list[$i]['hottest'] == $list[$j]['hottest']) {
		        			$temp = $list[$i];
		        			$list[$i] = $list[$j];
		        			$list[$j] = $temp;
		        		}
		        	}
		        }
				break;
			case 'nearest':
				$list = $this->model->multi_array_sort($list, 'distance');
				$listCount = count($list);
				for ($i=0;$i<$listCount-1;$i++) {
		        	for ($j=$i+1;$j<=$listCount-1;$j++) {
		        		if ($list[$i]['tid'] < $list[$j]['tid'] && $list[$i]['distance'] == $list[$j]['distance']) {
		        			$temp = $list[$i];
		        			$list[$i] = $list[$j];
		        			$list[$j] = $temp;
		        		}
		        	}
		        }
				break;
			case 'latest':
				$list = $this->model->multi_array_sort($list, 'isExpired');
				$listCount = count($list);
				for ($i=0;$i<$listCount-1;$i++) {
		        	for ($j=$i+1;$j<=$listCount-1;$j++) {
		        		if ($list[$i]['tid'] < $list[$j]['tid'] && $list[$i]['isExpired'] == $list[$j]['isExpired']) {
		        			$temp = $list[$i];
		        			$list[$i] = $list[$j];
		        			$list[$j] = $temp;
		        		}
		        	}
		        }
				break;
		}

		$listCount = count($list);
		$listpage  = ceil($listCount / $perpage);
		$list 	   = array_slice($list, $start, $perpage);
		if($list) {
			$data['next']    = $listpage <= $page ? '' : "page=".($page+1);
			$data['actList'] = $list;
		} else {
			$data['next'] 	 = "";
			$data['actList'] = array();
		}
		$data['fid'] = $fid;
		output_msg($data, true);
	}

	//按经纬度获得活动列表
	public function actListByLocation()
	{
		$page 	   = max(intval($_GET['page']), 1);
		$perpage   = intval($_GET['perpage']) && intval($_GET['perpage']) < 50 ? intval($_GET['perpage']) : 10;
		$start 	   = ($page-1)*$perpage;
		$lat 	   = $_GET['lat'];
		$lng 	   = $_GET['lng'];
		$radius    = !empty($_GET['radius']) ? intval($_GET['radius']) : 300000;

		if (!empty($_GET['location'])) {
			$_GET['location'] = str_replace('%2C', ',', $_GET['location']);
			list($lat_loc, $lng_loc) = explode(',', $_GET['location']);
		}

		//若是没有定位的经纬度，则返回空数组
		if (empty($lat) && empty($lat)) {
			$data['next'] 	 = "";
			$data['actList'] = array();
			output_msg($data, true);
		}

		$where  = '';
		$list   = array();
		$where .= " AND t.displayorder >= 0";
		$where .= " AND a.starttimefrom > {$this->timestamp}";

		$range  = $this->model->getrange($lat, $lng, $radius);
		$where .= " AND a.lat>{$range[minlat]} AND a.lat<{$range[maxlat]} AND a.lng>{$range[minlng]} AND a.lng<{$range[maxlng]}";
		if (empty($fid)) {
			//自动匹配版块,分类
			$parse_fid = $this->model->parse_forum($lng, $lat);
			$fid  = !empty($parse_fid['fid']) ? $parse_fid['fid'] : 0;
		}

		$sql = "SELECT t.subject, t.author, t.dateline, t.fid, a.tid, a.aid, a.title, a.cost, a.starttimefrom as starttime, a.starttimeto as endtime, a.place, a.collectplace, a.class, a.number, a.applynumber, a.passnumber, a.expiration as exptime, a.nature, a.clubid, a.clubname, a.lng, a.lat, a.hottest FROM ".DB::table("forum_activity")." AS a
		LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid=a.tid
		WHERE a.tid > 5161751 AND a.timediff < 4 AND a.credit = 0 {$where}" . getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			if (!isset($this->arrDi[$row['fid']])) {
				continue;
			}

			$row['starttime'] = intval($row['starttime']);
			$row['endtime']   = intval($row['endtime']);
			$row['hottest']   = intval($row['hottest']);
			$row['tid']   	  = intval($row['tid']);
			$row['isExpired'] = $row['starttime'] < $this->timestamp ? 1 : 0;	//活动是否过期

			$row['distance']  = !empty($lat_loc) && !empty($lng_loc) ? $this->model->distance($lat_loc, $lng_loc, $row['lat'], $row['lng']) : '';
			$row['coverpic']  = $this->model->attach($row['aid']);

			//格式化时间
			$row['dateline_f']  = date("YmdHis", $row['dateline']);
			$row['starttime_f'] = date("YmdHis", $row['starttime']);
			$row['endtime_f'] 	= date("YmdHis", $row['endtime']);
			$row['exptime_f'] 	= date("YmdHis", $row['exptime']);

			$list[] = $row;
		}

		$list = $this->model->multi_array_sort($list, 'distance');
		$listCount = count($list);
		for ($i=0;$i<$listCount-1;$i++) {
        	for ($j=$i+1;$j<=$listCount-1;$j++) {
        		if ($list[$i]['tid'] < $list[$j]['tid'] && $list[$i]['distance'] == $list[$j]['distance']) {
        			$temp = $list[$i];
        			$list[$i] = $list[$j];
        			$list[$j] = $temp;
        		}
        	}
        }

		$listCount = count($list);
		$listpage  = ceil($listCount / $perpage);
		$list 	   = array_slice($list, $start, $perpage);
		if($list) {
			$data['next']    = $listpage <= $page ? '' : "page=".($page+1);
			$data['actList'] = $list;
		} else {
			$data['next'] 	 = "";
			$data['actList'] = array();
		}
		$data['fid'] = $fid;
		output_msg($data, true);
	}

	// 获取活动详情
	public function detail()
    {

		$this->base();

		$sql = "SELECT t.tid, t.subject, t.author, t.authorid, t.dateline, t.displayorder, a.title, a.aid, a.cost, a.starttimefrom as starttime, a.starttimeto as endtime, a.place, a.collectplace, a.class, a.number, a.applynumber, a.passnumber, a.expiration as exptime, a.ufield, a.nature, a.clubid, a.clubname, a.lng, a.lat, a.mobile FROM ".DB::table("forum_thread")." AS t
				LEFT JOIN ".DB::table("forum_activity")." AS a
				ON t.tid=a.tid WHERE t.tid = {$this->tid} AND t.special = 4 ".getSlaveID();
		$activity = DB::fetch_first($sql);

		if(!$activity){
			output_errorMsg(430, 'Activity don\'t exist.', '此活动不存在');
		}

		//是否需要传身份证
		$ufield = unserialize($activity['ufield']);
		$activity['isIdcard'] = in_array("idcard", $ufield['userfield']) ? 1 : 0;
		unset($ufield);
		unset($activity['ufield']);

		//格式化时间
		$activity['dateline_f']  = date("YmdHis", $activity['dateline']);
		$activity['starttime_f'] = date("YmdHis", $activity['starttime']);
		$activity['endtime_f']   = date("YmdHis", $activity['endtime']);
		$activity['exptime_f']   = date("YmdHis", $activity['exptime']);

		//若是报名人数上线为0(不限制人数)，则把它改为999.为适应ios的判断
		$activity['number']      = !empty($activity['number']) ? $activity['number'] : 999;

		//获取图片
		$activity['coverpic'] = $this->model->attach($activity['aid']);

		//计算访问者和集合地的距离
		if (!empty($_GET['location'])) {
			list($lat_loc, $lng_loc) = explode(',', $_GET['location']);
		}

		if(!empty($lat_loc) && !empty($lng_loc)) {
			$activity['distance'] = sprintf('%0.1f', $this->model->distance($lat_loc, $lng_loc, $activity['lat'], $activity['lng']));
		}

		//俱乐部出行次数
		if($activity['clubid']){
			$activity['clubStat'] = $this->model->club_stat($activity['clubid']);
		}

		//行程 装备 其他
		$message = DB::result_first("SELECT message FROM ".DB::table('forum_post')." WHERE tid='{$activity['tid']}' AND first=1");
		if(!empty($message) && strpos($message, '[----]')){
			list($activity['intro'], $activity['introCost'], $activity['introOther']) = explode('[----]', $message);
			$activity['intro'] 		  = $activity['intro'] == "暂无内容" ? '' : $this->model->dealActivityMessage($activity['intro']);
			$activity['introCost'] 	  = $activity['introCost'] == "暂无内容" ? '' : $this->model->dealActivityMessage($activity['introCost']);
			$activity['introOther']   = $activity['introOther'] == "暂无内容" ? '' : $this->model->dealActivityMessage($activity['introOther']);
		}

		//剩余名额	报名总数-审核通过人数
		if($activity['number']) {
			$activity['surplusnumber'] = $activity['number'] - $activity['passnumber'];
			$data['applyStatus'] = $activity['surplusnumber'] > 0 ? 1 : 3;	//applyStatus:用户报名状态 1=可以报名, 2=报名结束, 3=满员, 4=已报名
		} else {
			$data['applyStatus'] = 1;	//不限报名人数
		}

		if($activity['exptime'] < $this->timestamp) {
			$data['applyStatus'] = 2;
		}

		$data['detail'] = $activity;

		//用户的报名状态
		$appuserid = number_format($_GET['appuserid'], 0, ".", '');
		$wechatuserid = $_GET['wechatuserid'];

		$user_apply_status = $this->model->user_apply_status($this->tid, $this->uid, $appuserid, $wechatuserid);
		if($user_apply_status) {
			if($user_apply_status['apply']['applyid'] > 0) {
				$data['applyStatus'] = 4;
				unset($user_apply_status['apply']['ufielddata']);
				unset($user_apply_status['apply']['appusername']);
				unset($user_apply_status['apply']['wechatusername']);
			}
			$data = array_merge($data, $user_apply_status);
		}

		//感兴趣的人
		$data['follower'] = $this->model->follower_list($this->tid, 1, 10);

		//活动组织者绑定的APP帐户信息
		$leader = $this->model->leader_info($activity['authorid']);
		$data['leaderId'] 		= $leader['appuserid'] ? $leader['appuserid'] : '';
		$data['leaderUsername'] = $leader['appusername'] ? $leader['appusername'] : '';

		output_msg($data, true);
	}

	//删除指定活动
	public function actDel()
	{
		$this->base();
		$this->act_info();

		if($this->activity['uid'] != $this->uid) {
			output_errorMsg(431, 'Delete activity failed. Unauthorized operation.', '删除活动失败，此活动不是你发起的');
		}

		if($this->activity['starttime'] < $this->timestamp) {
			output_errorMsg(431, 'Delete activity failed. Activity is over.', '删除活动失败，此活动已结束');
		}

		DB::query("UPDATE ".DB::table("forum_thread")." SET displayorder='-1' WHERE tid='$this->tid'");
		if(DB::affected_rows()) {
			output_msg('{"result":1}');
		} else {
			output_errorMsg(431, 'Delete activity failed.', '删除活动失败');
		}
	}

	// 获取发布活动时需要的属性
	public function actAttr()
	{
		// 省份板块及下级分类
		// $data['actAttr']['province'] = $this->model->zone();

		// 活动玩法
		$data['actAttr']['type'] = $this->model->act_type();
		if($data) {
			output_msg($data, true);
		} else {
			output_errorMsg(431, 'Get actAttr data error.', '获取活动玩法失败');
		}
	}

	// 上传封面图
	function uploadCoverpic()
	{
		// $picdir = $_POST['picdir'];	// 201508/24/092233arladud3rbeb3ks5.jpg 需上传到forum目录下

		if(!$this->uid) {
			output_errorMsg(459, 'userkey error.', '');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '用户权限被禁止，请联系8264客服');
		}

		$mtype = 'forum';
		require_once libfile('class/upload');

		$upload = new discuz_upload();
		if(!$upload->init($_FILES['Filedata'], $mtype)) {
			output_errorMsg(431, 'Upload filedata error.', '网络连接失败，请重新尝试');
		}
		$this->attach = &$upload->attach;

		$serverid = isset($upload->attach['serverid']) ? $upload->attach['serverid'] : 99;
		$thumb = $remote = $width = 0;
		if($upload->attach['isimage']) {
			$thumb = $upload->attach['thumb'];
			$width = $upload->attach['width'];
		}
		$upload->save();

		DB::query("INSERT INTO ".DB::table('forum_attachment')." (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid, dir)
			VALUES ('0', '0', '$this->timestamp', '0', '0', '".$upload->attach['name']."', '".$upload->attach['type']."', '".$upload->attach['size']."', '".$upload->attach['attachment']."', '0', '".$upload->attach['isimage']."', '".$this->uid."', '$thumb', '$remote', '$width', '$serverid', '$mtype')");
		$attach_aid = DB::insert_id();

		if($attach_aid) {
			$data['result']   = 1;
			$data['coverpic'] = array("attachIid" => $attach_aid, "imgUrl" => "http://image1.8264.com/forum/".$upload->attach['attachment']);
			output_msg($data, true);
		} else {
			output_errorMsg(431, 'Upload pic error.', '上传封面失败，请重试');
		}
	}

	//上传图片--入库
	function uploadPicInsertData()
	{
		global $_G;

		if(!$this->uid || empty($_G['gp_name']) || empty($_G['gp_type']) || empty($_G['gp_num']) || empty($_G['gp_attachment']) || empty($_G['gp_width'])) {
			output_errorMsg(459, 'para miss.', '请求失败，请联系8264客服');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '用户权限被禁止，请联系8264客服');
		}

		$_G['gp_name'] = iconv("utf-8","gbk//TRANSLIT",$_G['gp_name']);

		DB::query("INSERT INTO ".DB::table('forum_attachment')." (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid)
			VALUES ('0', '0', '{$_G[timestamp]}', '0', '0', '{$_G['gp_name']}', '{$_G['gp_type']}', '{$_G['gp_num']}', '{$_G['gp_attachment']}', '0', '1', '{$this->uid}', '0', '0', '{$_G['gp_width']}', 99)");
		$aid = DB::insert_id();

		dsetcookie("upload_attach_8264_attachmentname", $_G['gp_name'],10);
		dsetcookie("upload_attach_8264_attachmentserverid", $_G['gp_name'],10);

    	$data['result']   = 1;
		$data['data']     = array("aid" => $aid);
		output_msg($data, true);
	}

	//更新活动贴的aid
	function uploadThreadAid()
	{
		global $_G;

		$this->base();

		$_G['gp_aid'] = intval($_G['gp_aid']);

		if(empty($_G['gp_aid'])) {
			output_errorMsg(459, 'para miss.', '请求失败，请联系8264客服');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '用户权限被禁止，请联系8264客服');
		}

		DB::update('forum_activity', array('aid'=>$_G['gp_aid']), "tid={$this->tid}");

		$pid = DB::result_first("SELECT pid FROM ".DB::table('forum_post')." WHERE tid={$this->tid} and first=1 " . getSlaveID());
		DB::query("UPDATE ".DB::table('forum_attachment')." SET tid={$this->tid}, pid={$pid} WHERE aid={$_POST['aid']}");

    	$data['result']   = 1;
		output_msg($data, true);
	}

	//发布活动
	public function actPost()
	{
		global $_G;
		set_time_limit(0);

		if(!$this->uid) {
			output_errorMsg(459, 'userkey error.', '');
		}

		if(in_array($this->groupid, array(4,5,6,8))) {
			output_errorMsg(459, 'User permission is prohibited.', '用户权限被禁止，请联系8264客服');
		}

		//自动匹配版块,分类
		$parse_fid = $this->model->parse_forum($_POST['lng'], $_POST['lat']);
		$_POST['fid'] = $parse_fid['fid'];
		$typeid = $parse_fid['typeid'];

		require libfile('function/forum');
		require libfile('function/post');
		loadforum();

//		$_POST   		= iconv_array($_POST, "GBK", "UTF-8");//上线时去掉
		$_POST   		= iconv_array($_POST, "UTF-8", "gbk//TRANSLIT");

		$plat = intval( $_POST['plat'] );

		//若是app发布活动，读取下username
		if ($plat == 4 || $plat == 2) {
			$this->username = DB::result_first("SELECT username FROM ".DB::table('common_member')." where uid = {$this->uid} " . getSlaveID());
		}

		$dataLog = $_POST;
		$dataLog['uid'] = $this->uid;

		$special 		= 4;
		$displayorder 	= 0;
		$digest 		= 0;
		$readperm 		= 0;
		$typeid 	    = isset( $_G['forum']['threadtypes']['types'][$typeid] ) ? $typeid : 0;
		$isgroup 		= 0;
		$_G['uid'] 		= $this->uid;
		$_G['username'] = $this->username;
		$author    		= $this->username;
		$moderated      = 0;
		$posttableid    = getposttableid( 'p' );
		$attachment     = 0;
		$bbcodeoff 		= -1;
		$smileyoff 		= -1;
		$parseurloff 	= 0;
		$htmlon 		= 0;
		$usesig 		= 0;
		$pinvisible     = 0;
		$sortid 		= 0;

		$_POST['place']      = $_POST['place'] ? explode("zaiwaiapp", $_POST['place']) : array();
		$_POST['place']      = array_filter($_POST['place']);
		$_POST['clientip']   = $_G['clientip'];
		$thread['status']    = 224;

		foreach ($_POST['place'] as $k=>$v) {
			$_POST['place'][$k] = dealActivityText($v);
		}

		if ( checkflood() )	{
			output_errorMsg(460, 'post_flood_ctrl.', '两次发活动间隔不能少于2秒');
//		} elseif ( checkmaxpostsperhour() ) {
//			output_errorMsg(461, 'post_flood_ctrl_posts_per_hour.', '您所在的用户组每小时限制发帖个数');
		}

		$activity = array();
		$activity['cost'] 				= intval( $_POST['cost'] );
		$activity['starttimefrom'] 		= intval($_POST['starttime']);
		$activity['starttimefrom_int'] 	= strtotime(date('Y-m-d', $activity['starttimefrom']));
		$activity['starttimeto'] 		= intval($_POST['endtime']);
		$activity['starttimeto_int'] 	= strtotime(date('Y-m-d', $activity['starttimeto']));
		$activity['timediff'] 			= floor(($activity['starttimeto_int'] - $activity['starttimefrom_int'])/86400) + 1;
		$activity['place'] 				= !empty($_POST['place']) ? implode('，', $_POST['place']) : '';
		$activity['place'] 				= dhtmlspecialchars( $activity['place'] );
		$activity['collectplace'] 		= !empty($_POST['collectplace']) ? dhtmlspecialchars( trim( $_POST['collectplace'] ) ) : '';
		$activity['class'] 				= !empty($_POST['class']) ? dhtmlspecialchars( trim( $_POST['class'] ) ) : '';
		$activity['number'] 			= intval( $_POST['number'] );
		$activity['expiration'] 		= intval($_POST['exptime']);
		$activity['nature'] 			= intval( $_POST['nature'] );
		$activity['lng'] 				= $_POST['lng'];
		$activity['lat'] 				= $_POST['lat'];
		$activity['lasttime'] 			= $_G['timestamp'];
		$activity['title'] 		    	= $activity['place'].$activity['class'].$activity['timediff'].'日';
		$activity['plat'] 		    	= $plat;
		unset($activity['starttimefrom_int'], $activity['starttimeto_int']);

		if (!$activity['place']) {
			output_errorMsg(462, 'activity_address_please.', '请输入活动地点');
		} elseif (!$activity['collectplace']) {
			output_errorMsg(463, 'activity_collectplace_please.', '请选择集合地点');
		} elseif (!$activity['starttimefrom']) {
			output_errorMsg(464, 'activity_fromtime_please.', '请选择活动开始时间');
		} elseif (!$activity['starttimeto']) {
			output_errorMsg(465, 'activity_endtime_please.', '请选择活动结束时间');
		} elseif ($activity['starttimefrom'] > $activity['starttimeto']) {
			output_errorMsg(466, 'endtime less than starttime.', '活动开始时间应早于活动结束时间');
		} elseif (!$activity['expiration']) {
			output_errorMsg(467, 'activity_exptime_please.', '请选择活动报名截止时间');
		} elseif ($activity['expiration'] > $activity['starttimefrom']) {
			output_errorMsg(468, 'expiration more than starttime.', '活动报名截止时间应早于活动开始时间');
		} elseif ($activity['expiration'] < $_G['timestamp']) {
			output_errorMsg(469, 'expiration less than currtime.', '活动报名截止时间应晚于当前时间');
		} elseif (!$typeid) {
			output_errorMsg(470, 'activity_sort_please.', '请选择子版分类');
		} elseif (!$activity['class']) {
			output_errorMsg(471, 'activity_class_please.', '请选择活动玩法');
		} elseif (!$activity['nature']) {
			output_errorMsg(472, 'natrue is null.', '请选择活动性质');
		} elseif ($activity['nature'] == 2 && !$activity['cost']) {
			output_errorMsg(473, 'cost is null.', '请输入活动价格');
		} elseif (!$_POST['aid']) {
			output_errorMsg(474, 'aid is null.', '请上传活动封面');
		} elseif (!$_POST['intro']) {
			output_errorMsg(475, 'intro is null.', '请输入活动行程');
		} elseif (!$_POST['introCost']) {
			output_errorMsg(476, 'introCost is null.', '请输入装备费用');
		} elseif (!$activity['lat'] || !$activity['lng']) {
			output_errorMsg(477, 'lng or lat is null.', '');
		} elseif ($this->model->censor_app($activity['place'])) {
			output_errorMsg(478, 'place contains banned words.', '活动地点包含违禁词汇');
		} elseif ($this->model->censor_app($activity['collectplace'])) {
			output_errorMsg(479, 'collectplace contains banned words.', '集合地点包含违禁词汇');
		} elseif ($activity['timediff'] > 3) {
			output_errorMsg(482, 'timediff more than three.', '活动时间不能超过3天');
		}

		//设置俱乐部
		$activity['clubname'] = censor( dhtmlspecialchars( trim( $_POST['clubname'] ) ) );
		$activity['clubname'] = dealActivityText($activity['clubname']);
		$activity['clubid']   = setClubList($activity['clubname']);

		//更新在外app目的地库
		setZaiwaiPlace($_POST['place']);

		//统计地方版版块下有效的活动数量
		if ($_G['forum']['nfup'] == 76) {
			setCityNum($_G['fid']);
		}

		$userfield = array('0'=>"realname", '1'=>'mobile', '2'=>'field3');
		$isIdcard  = intval($_POST['isIdcard']);
		if ($isIdcard > 0) {
			$userfield[] = 'idcard';
		}
		$activity['ufield'] = array( 'userfield' => $userfield, 'extfield' => array() );
		$activity['ufield'] = serialize( $activity['ufield'] );

		$subject  = $activity['clubname'] ? $activity['clubname'].' ' : '';
		$subject .= date('n月d日', $activity['starttimefrom'])."-".date('n月d日', $activity['starttimeto'])." ".str_replace('，', '-', $activity['place'])." {$activity['class']}{$activity['timediff']}日";

		DB::query( "INSERT INTO " . DB::table( 'forum_thread' ) . " (fid, posttableid, readperm, price, typeid, sortid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, status, isgroup)
			VALUES ('$_G[fid]', '$posttableid', '$readperm', '0', '$typeid', '$sortid', '$author', '$_G[uid]', '$subject', '$_G[timestamp]', '$_G[timestamp]', '$author', '$displayorder', '$digest', '$special', '$attachment', '$moderated', '$thread[status]', '0')" );
		$tid = DB::insert_id();
		$typeid > 0 && DB::query( "UPDATE " . DB::table( 'forum_threadclass' ) . " SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED' );

		//更新空间动态
		DB::update( 'common_member_field_home', array( 'recentnote' => $subject ), array( 'uid' => $_G['uid'] ) );

		$activity['tid'] = $tid;
		$activity['uid'] = $_G['uid'];
		$activity['aid'] = $_POST['aid'];

		DB::insert('forum_activity', $activity);

		// 将活动tid添加入队列，等待发送给APP API
		if($this->redis->connected) {
			$this->redis->obj->rpush('thread_activity', $tid);
		}

		//新的活动内容
		$message  = $_POST['intro'] ? dhtmlspecialchars( trim( $_POST['intro'] ) ) : '暂无内容';
		$message .= $_POST['introCost'] ? '[----]' . dhtmlspecialchars( trim( $_POST['introCost'] ) ) : '[----]暂无内容';
		$message .= $_POST['introOther'] ? '[----]' . dhtmlspecialchars( trim( $_POST['introOther'] ) ) : '[----]暂无内容';

		if ($this->model->censor_app($message)) {
			output_errorMsg(481, 'message contains banned words.', '活动详细中包含违禁词汇');
		}

		$pid = insertpost( array(
			'fid' 			=> $_G['fid'],
			'tid' 			=> $tid,
			'first' 		=> '1',
			'author' 		=> $_G['username'],
			'authorid' 		=> $_G['uid'],
			'subject' 		=> $subject,
			'dateline' 		=> $_G['timestamp'],
			'message' 		=> $message,
			'useip' 		=> $_POST['clientip'],
			'invisible' 	=> $pinvisible,
			'anonymous' 	=> 0,
			'usesig' 		=> $usesig,
			'htmlon' 		=> $htmlon,
			'bbcodeoff' 	=> $bbcodeoff,
			'smileyoff' 	=> $smileyoff,
			'parseurloff' 	=> $parseurloff,
			'attachment' 	=> $attachment,
			'tags' 			=> 0,
			) );
		//start 记录发帖信息
		$parr = array(
			'tid' 		=> $tid,
			'pid'		=> $pid,
			'uid' 		=> $_G['uid'],
			'username' 	=> $_G['username'],
			'fid' 		=> $_G['fid'],
			'name' 		=> $_G['forum']['name'], // lxp 20140126
			'subject' 	=> $subject,
			'message' 	=> $message,
			'ip' 		=> $_POST['clientip'] );
		addrecordthread( $parr, 1 );
		//end

		if(in_array($_G['groupid'], array(1,2,3)) || $_G['groupid'] >= 13) {
			//增加@功能
			require_once libfile("class/at");
			$at = new at;
			$message = $at->parse($message);
			if($at->atlist) { $bbcodeoff = 0; }
		}

		if ( $pid && getstatus( $thread['status'], 1 ) ) {
			savepostposition( $tid, $pid );
		}

		DB::query( "UPDATE " . DB::table( 'forum_attachment' ) . " SET tid={$tid}, pid={$pid} WHERE aid={$_POST['aid']}" );

		$statarr = array(
			0 => 'thread',
			1 => 'poll',
			2 => 'trade',
			3 => 'reward',
			4 => 'activity',
			5 => 'debate',
			127 => 'thread' );
		include_once libfile( 'function/stat' );
		updatestat( $isgroup ? 'groupthread' : $statarr[$special] );

		//新的动态表的增加
		$feedarr = array(
			'uid' 	    => $_G[uid],
			'fid' 	    => $_G[fid],
			'id' 	    => $tid,
			'pid'  	    => $pid,
			'type'      => 6,
			'dateline'  => $_G[timestamp],
			'subject'   => '发布了新活动',
			'message'   => $message,
			'username'  => $author,
			'authorid'  => $_G['uid'],
			'htmlon'    => $htmlon,
			'bbcodeoff' => $bbcodeoff,
			'smileyoff' => $smileyoff,
			'title'     => $subject,
		);

		require_once libfile('function/feed');
		feed_add_ucenter($feedarr);

		updatepostcredits( '+', $_G['uid'], 'post', $_G['fid'] );

		if ( $displayorder != -4 )
		{
			$subject = str_replace( "\t", ' ', $subject );
			$lastpost = "$tid\t$subject\t$_G[timestamp]\t$author";

			DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET lastpost='$lastpost', threads=threads+1, posts=posts+1, todayposts=todayposts+1 WHERE fid='$_G[fid]'", 'UNBUFFERED' );

			if ( $_G['forum']['type'] == 'sub' ) {
				DB::query( "UPDATE " . DB::table( 'forum_forum' ) . " SET lastpost='$lastpost' WHERE fid='" . $_G['forum'][fup] . "'", 'UNBUFFERED' );
			}

			//start 记录修改版块操作
			addrecordforuminfo( $_G['fid'], 3 );
			//end
		}

		output_msg('{"result":1,"data":{"tid":'.$tid.'}}');
	}

	//编辑活动时的信息
	public function actEditInfo() {

		$this->base();

		if ($this->thread['authorid'] != $this->uid) {
			output_errorMsg(483, 'this activity is not your post.', '此活动不是你发布的');
		}

		//获得活动信息
		$activityShow = DB::fetch_first("SELECT place,collectplace,aid,starttimefrom,starttimeto,expiration,class,nature,cost,number,clubid,clubname,ufield FROM ".DB::table("forum_activity")." WHERE tid={$this->tid} ". getSlaveID());

		if (empty($activityShow)) {
			output_errorMsg(430, 'Activity don\'t exist.', '此活动不存在');
		}

		//获得message信息
		$message = DB::result_first("SELECT message FROM ".DB::table("forum_post")." WHERE tid={$this->tid} and first=1 ". getSlaveID());
		$message = explode('[----]', $message);

		//是否需要填写身份证
		$activityShow['ufield'] = $activityShow['ufield'] ? unserialize($activityShow['ufield']) : array();
		$isIdcard = 0;
		foreach ($activity['ufield']['userfield'] as $v) {
			if ($v == 'idcard') {
				$isIdcard = 1;
				break;
			}
		}

		$data 				  = array();
		$data['place'] 		  = $activityShow['place'];
		$data['collectplace'] = $activityShow['collectplace'];
		$data['aid'] 		  = $activityShow['aid'];
		$data['coverpic']     = $this->model->attach($data['aid']);
		$data['starttime'] 	  = $activityShow['starttimefrom'];
		$data['endtime'] 	  = $activityShow['starttimeto'];
		$data['exptime'] 	  = $activityShow['expiration'];
		$data['starttime_f']  = date("YmdHis", $activityShow['starttimefrom']);
		$data['endtime_f'] 	  = date("YmdHis", $activityShow['starttimeto']);
		$data['exptime_f'] 	  = date("YmdHis", $activityShow['expiration']);
		$data['typeid'] 	  = $this->thread['typeid'];
		$data['class'] 		  = $activityShow['class'];
		$data['nature'] 	  = $activityShow['nature'];
		$data['cost'] 		  = $activityShow['cost'];
		$data['number'] 	  = $activityShow['number'];
		$data['clubid'] 	  = $activityShow['clubid'];
		$data['clubname'] 	  = $activityShow['clubname'];
		$data['intro'] 		  = $message[0] == "暂无内容" ? '' : $message[0];
		$data['introCost']    = $message[1] == "暂无内容" ? '' : $message[1];
		$data['introOther']   = $message[2] == "暂无内容" ? '' : $message[2];
		$data['isIdcard']     = $isIdcard;

		output_msg(array('activityShow'=>$data), true);

	}

	//编辑活动
	public function actEdit() {

		global $_G;
		set_time_limit(0);

		$this->base();

		if ($this->thread['authorid'] != $this->uid) {
			output_errorMsg(483, 'this activity is not your post.', '此活动不是你发布的');
		}

		$_POST['fid'] = $this->thread['fid'];

		require libfile('function/forum');
		require libfile('function/post');
		loadforum();

//		$_POST   		= iconv_array($_POST, "GBK", "UTF-8");//上线时去掉
		$_POST   		= iconv_array($_POST, "UTF-8", "gbk//TRANSLIT");

		$this->username = DB::result_first("SELECT username FROM ".DB::table('common_member')." where uid = {$this->uid} " . getSlaveID());

		$_G['uid'] 		= $this->uid;
		$_G['username'] = $this->username;
		$author    		= $this->username;
		$tid    		= $this->tid;
		$posttableid    = getposttableid( 'p' );
		$bbcodeoff 		= -1;
		$smileyoff 		= -1;
		$parseurloff 	= 0;
		$htmlon 		= 0;
		$usesig 		= 0;
		$pinvisible     = 0;
		$sortid 		= 0;
		$pid            = DB::result_first("SELECT pid FROM ".DB::table("forum_post")." WHERE tid={$tid} and first=1 ". getSlaveID());
		$activityaid    = DB::result_first("SELECT aid FROM ".DB::table("forum_activity")." WHERE tid={$tid} ". getSlaveID());

		$_POST['place']    = $_POST['place'] ? explode("zaiwaiapp", $_POST['place']) : array();
		$_POST['place']    = array_filter($_POST['place']);
		$_POST['clientip'] = $_G['clientip'];
		$thread['status']  = 224;

		foreach ($_POST['place'] as $k=>$v) {
			$_POST['place'][$k] = dealActivityText($v);
		}

		$activity = array();
		$activity['cost'] 				= intval( $_POST['cost'] );
		$activity['starttimefrom'] 		= intval($_POST['starttime']);
		$activity['starttimefrom_int'] 	= strtotime(date('Y-m-d', $activity['starttimefrom']));
		$activity['starttimeto'] 		= intval($_POST['endtime']);
		$activity['starttimeto_int'] 	= strtotime(date('Y-m-d', $activity['starttimeto']));
		$activity['timediff'] 			= floor(($activity['starttimeto_int'] - $activity['starttimefrom_int'])/86400) + 1;
		$activity['place'] 				= !empty($_POST['place']) ? implode('，', $_POST['place']) : '';
		$activity['place'] 				= dhtmlspecialchars( $activity['place'] );
		$activity['collectplace'] 		= !empty($_POST['collectplace']) ? dhtmlspecialchars( trim( $_POST['collectplace'] ) ) : '';
		$activity['class'] 				= !empty($_POST['class']) ? dhtmlspecialchars( trim( $_POST['class'] ) ) : '';
		$activity['number'] 			= intval( $_POST['number'] );
		$activity['expiration'] 		= intval($_POST['exptime']);
		$activity['nature'] 			= intval( $_POST['nature'] );
		$activity['lng'] 				= $_POST['lng'];
		$activity['lat'] 				= $_POST['lat'];
		$activity['title'] 		    	= $activity['place'].$activity['class'].$activity['timediff'].'日';
		unset($activity['starttimefrom_int'], $activity['starttimeto_int']);

		if (!$activity['place']) {
			output_errorMsg(462, 'activity_address_please.', '请输入活动地点');
		} elseif (!$activity['collectplace']) {
			output_errorMsg(463, 'activity_collectplace_please.', '请选择集合地点');
		} elseif (!$activity['starttimefrom']) {
			output_errorMsg(464, 'activity_fromtime_please.', '请选择活动开始时间');
		} elseif (!$activity['starttimeto']) {
			output_errorMsg(465, 'activity_endtime_please.', '请选择活动结束时间');
		} elseif ($activity['starttimefrom'] > $activity['starttimeto']) {
			output_errorMsg(466, 'endtime less than starttime.', '活动开始时间应早于活动结束时间');
		} elseif (!$activity['expiration']) {
			output_errorMsg(467, 'activity_exptime_please.', '请选择活动报名截止时间');
		} elseif ($activity['expiration'] > $activity['starttimefrom']) {
			output_errorMsg(468, 'expiration more than starttime.', '活动报名截止时间应早于活动开始时间');
		} elseif ($activity['expiration'] < $_G['timestamp']) {
			output_errorMsg(469, 'expiration less than currtime.', '活动报名截止时间应晚于当前时间');
		} elseif (!$activity['class']) {
			output_errorMsg(471, 'activity_class_please.', '请选择活动玩法');
		} elseif (!$activity['nature']) {
			output_errorMsg(472, 'natrue is null.', '请选择活动性质');
		} elseif ($activity['nature'] == 2 && !$activity['cost']) {
			output_errorMsg(473, 'cost is null.', '请输入活动价格');
		} elseif (!$_POST['aid']) {
			output_errorMsg(474, 'aid is null.', '请上传活动封面');
		} elseif (!$_POST['intro']) {
			output_errorMsg(475, 'intro is null.', '请输入活动行程');
		} elseif (!$_POST['introCost']) {
			output_errorMsg(476, 'introCost is null.', '请输入装备费用');
		} elseif (!$activity['lat'] || !$activity['lng']) {
			output_errorMsg(477, 'lng or lat is null.', '');
		} elseif ($this->model->censor_app($activity['place'])) {
			output_errorMsg(478, 'place contains banned words.', '活动地点包含违禁词汇');
		} elseif ($this->model->censor_app($activity['collectplace'])) {
			output_errorMsg(479, 'collectplace contains banned words.', '集合地点包含违禁词汇');
		} elseif ($activity['timediff'] > 3) {
			output_errorMsg(482, 'timediff more than three.', '活动时间不能超过3天');
		}

		//设置俱乐部
		$activity['clubname'] = censor( dhtmlspecialchars( trim( $_POST['clubname'] ) ) );
		$activity['clubname'] = dealActivityText($activity['clubname']);
		$activity['clubid']   = setClubList($activity['clubname']);

		//更新在外app目的地库
		setZaiwaiPlace($_POST['place']);

		//统计地方版版块下有效的活动数量
		if ($_G['forum']['nfup'] == 76) {
			setCityNum($_G['fid']);
		}

		$userfield = array('0'=>"realname", '1'=>'mobile', '2'=>'field3');
		$isIdcard  = intval($_POST['isIdcard']);
		if ($isIdcard > 0) {
			$userfield[] = 'idcard';
		}
		$activity['ufield'] = array( 'userfield' => $userfield, 'extfield' => array() );
		$activity['ufield'] = serialize( $activity['ufield'] );

		$subject  = $activity['clubname'] ? $activity['clubname'].' ' : '';
		$subject .= date('n月d日', $activity['starttimefrom'])."-".date('n月d日', $activity['starttimeto'])." ".str_replace('，', '-', $activity['place'])." {$activity['class']}{$activity['timediff']}日";

		$activity['aid'] = $_POST['aid'];
		DB::update('forum_activity', $activity, "tid={$tid}");

		//新的活动内容
		$message  = $_POST['intro'] ? dhtmlspecialchars( trim( $_POST['intro'] ) ) : '暂无内容';
		$message .= $_POST['introCost'] ? '[----]' . dhtmlspecialchars( trim( $_POST['introCost'] ) ) : '[----]暂无内容';
		$message .= $_POST['introOther'] ? '[----]' . dhtmlspecialchars( trim( $_POST['introOther'] ) ) : '[----]暂无内容';

		if ($this->model->censor_app($message)) {
			output_errorMsg(481, 'message contains banned words.', '活动详细中包含违禁词汇');
		}

		$dataThread = array();
		$dataThread['subject'] = $subject;
		DB::update('forum_thread', $dataThread, "tid={$tid}");

		$dataPost = array();
		$dataPost['subject'] = $subject;
		$dataPost['message'] = $message;
		DB::update('forum_post', $dataPost, "pid={$pid}");

		//start 记录修改帖子信息
		$parr = array(
			'tid' 		=> $tid,
			'pid'		=> $pid,
			'uid' 		=> $_G['uid'],
			'username' 	=> $_G['username'],
			'fid' 		=> $_G['fid'],
			'name' 		=> $_G['forum']['name'],
			'subject' 	=> $subject,
			'message' 	=> $message,
			'ip' 		=> $_POST['clientip'] );
		addrecordthread( $parr, 2 );
		//end

		if ($activityaid != $_POST['aid']) {
			$attach = DB::fetch_first("SELECT attachment, thumb, remote, aid FROM ".DB::table('forum_attachment')." WHERE aid={$activityaid} " . getSlaveID());
			DB::query("DELETE FROM ".DB::table('forum_attachment')." WHERE aid={$activityaid}");
			dunlink($attach);
			DB::query("UPDATE ".DB::table('forum_attachment')." SET tid={$tid}, pid={$pid} WHERE aid={$_POST['aid']}");
		}

		output_msg('{"result":1}');
	}

}

?>
