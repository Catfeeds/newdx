<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ForumActivityCtl extends FrontendCtl{
	
	function __construct()
	{
		parent::__construct();
		require_once libfile('function/activity');
	}
		
	//活动报名表单--源自module/wap/thread.ctl.php
	function form() 
	{	
		global $_G;	
		global $returnData;
		
		//没有tid		
		if(empty($_G['tid'])) {
			encodeData(array('error'=>true , 'errorinfo'=>"指定的主题不存在或已被删除或正在被审核，请返回。"));
		}		
		if($_G['forum']['status'] == 3) {
			encodeData(array('error'=>true , 'errorinfo'=>"手机版驴友录暂未开放"));
		}	
		
		//权限判断
		if(empty($_G['forum']['allowview'])) {
			if(!$_G['forum']['viewperm'] && !$_G['group']['readaccess']) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nonexistence', array('grouptitle' => $_G['group']['grouptitle']))));
			} elseif($_G['forum']['viewperm'] && !forumperm($_G['forum']['viewperm'])) {				
				encodeData(array('error'=>true , 'errorinfo'=>showmessagenoperm_wap('viewperm', $_G['fid'])));
			}
		} elseif($_G['forum']['allowview'] == -1) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'forum_access_view_disallow')));
		}
		
		if($_G['forum']['formulaperm']) {
			if ($message = formulaperm_wap($_G['forum']['formulaperm'])) {
				encodeData(array('error'=>true , 'errorinfo'=>$message));
			}
		}
		
		//$_G['forum']['archive']：是否有存档表，2014-06-03时，此功能没有用上
		$threadtableids   = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		$threadtable_info = !empty($_G['cache']['threadtable_info']) ? $_G['cache']['threadtable_info'] : array();
		
		if(!in_array(0, $threadtableids)) {
			$threadtableids = array_merge(array(0), $threadtableids);
		}
		$archiveid 		 = intval($_G['gp_archiveid']);
		$displayorderadd = $_G['uid'] ? " OR (t.displayorder IN ('-4', '-3', '-2') AND t.authorid='{$_G['uid']}')" : '';		
		if(empty($archiveid) || !in_array($archiveid, $threadtableids)) {
			$threadtable = !empty($_G['forum']['threadtableid']) ? "forum_thread_{$_G['forum']['threadtableid']}" : 'forum_thread';
			//获得帖子信息
			$_G['forum_thread'] = DB::fetch_first("SELECT * FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' $displayorderadd)" . getSlaveID()));
			if($_G['forum_thread']) {
				if($_G['forum']['threadtableid']) {
					$_G['forum_thread']['is_archived'] = true;
					$_G['forum_thread']['archiveid'] = $_G['forum']['threadtableid'];
				} else {
					$_G['forum_thread']['is_archived'] = false;
				}
			}
		} elseif(in_array($archiveid, $threadtableids)) {
			$threadtable = $archiveid ? "forum_thread_{$archiveid}" : 'forum_thread';
			$_G['forum_thread'] = DB::fetch_first("SELECT * FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' $displayorderadd)" . getSlaveID()));
		
			$_G['forum_thread']['is_archived'] = true;
			$_G['forum_thread']['archiveid'] = $_G['gp_archiveid'];
		} else {
			$threadtable = 'forum_thread';
			$_G['forum_thread'] = DB::fetch_first("SELECT * FROM ".DB::table($threadtable)." t WHERE tid='$_G[tid]'".($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' $displayorderadd)" . getSlaveID()));
		}
		
		//没有帖子信息
		if(!$_G['forum_thread']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nonexistence')));
		}
		
		if($_G['forum_thread']['readperm'] && $_G['forum_thread']['readperm'] > $_G['group']['readaccess'] && !$_G['forum']['ismoderator'] && $_G['forum_thread']['authorid'] != $_G['uid']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nopermission', array('readperm' => $_G['forum_thread']['readperm']))));
		}		
		
		//特殊主题
		if($_G['forum_thread']['special'] > 0 && (empty($_G['gp_viewpid']) || $_G['gp_viewpid'] == $_G['forum_firstpid'])) {	
			$_G['forum_thread']['starttime']  = gmdate($_G['forum_thread']['dateline']);
			$_G['forum_thread']['remaintime'] = '';
			switch($_G['forum_thread']['special']) {
				case 4: 
					require_once libfile('thread/activity', 'include');
					//若是选择原图降低图片质量,第一个参数传质量值,第二个参数为0,第三个参数为5
					$activity["thumb"]      	= !empty($activity["thumb"]) ? getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, str_replace($_G['config']['web']['attach'], "", $activity["thumb"]), 0, $attach['serverid']) : '';
					$activity["allapplynum"]	= $allapplynum;					
					$activity["aboutmembers"]	= $aboutmembers;					
					$activity["applied"]	    = $applied;
					$activity["isverified"]	    = $isverified;					
					$activity["activityclose"]	= $activityclose;					
					$activity["settings"]		= $settings;				
					$activity["ufielddata"]		= $ufielddata;					
					$activity["applyinfo"]		= $applyinfo;				
					
					//判断8264是否够此次活动
					if ($_G['setting']['activitycredit'] && $activity['credit'] && checklowerlimit(array('extcredits'.$_G['setting']['activitycredit'] => '-'.$activity['credit']), $_G['uid'], 1, 0, 1) !== true) {
	       				encodeData(array('error'=>true , 'errorinfo'=>$_G['setting']['extcredits'][$_G['setting']['activitycredit']]['title'].' 不足'.$activity['credit'], 'template'=>1));
					}
					
					//获取地区
					$districtList = array();
					$query = DB::query('SELECT * FROM '.DB::table('common_district'));
					while($v = DB::fetch($query)) {
						if ($v['upid'] == 0) {
							$districtList['province'][$v['id']] = $v['name'];
						} else {
							$districtList['city'][$v['upid']][$v['id']] = $v['name'];
						}
					}
									
					$returnData["activity"] 	= $activity;
					$returnData["districtList"] = $districtList;
					break;
			}
		}
		
		encodeData($returnData);
		
	}
	
	//活动报名--源自source/module/forum/forum_misc.php的action=activityapplies
	function doApply()
	{
		global $_G;	
		global $returnData;

		if(!$_G['uid']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
		}
	
		//为获取图片做准备
		require_once DISCUZ_ROOT.'source/plugin/attachment_server/attachment_server.class.php';
		$attachserver = new attachserver;
		$attachlist = $attachserver->get_server_domain('all', '*');
		
		//活动报名
		if(submitcheck('activitysubmit')) {		
			
			$activity = DB::fetch(DB::query("SELECT uid, expiration, ufield, credit, title, starttimefrom, starttimeto, timediff, aid, formid FROM ".DB::table('forum_activity')." WHERE tid='$_G[tid]'"));		
			if($activity['expiration'] && $activity['expiration'] < TIMESTAMP) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'activity_stop')));
			}
			$applyinfo = getapplyhistory($_G['tid'], $_G['uid']);
			if($applyinfo && $applyinfo['verified'] < 2) {
				encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'activity_repeat_apply')));
			}			
			$payvalue = intval($_G['gp_payvalue']);
			$payment  = $_G['gp_payment'] ? $payvalue : -1;
			$message  = iconv("utf-8","gbk//TRANSLIT",$_G['gp_message']);
			$message  = cutstr(dhtmlspecialchars($message), 200);
			$thread   = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid='$_G[tid]'" . getSlaveID());
			$verified = $thread['authorid'] == $_G['uid'] ? 1 : 0;
			$realname = '';
			$mobile   = '';
			$quantity = 0;
			if($activity['ufield']) {
				$ufielddata = array();
				$activity['ufield'] = unserialize($activity['ufield']);
				if(!empty($activity['ufield']['userfield'])) {
					$_POST = iconv_array($_POST, 'UTF-8', 'GBK');
					if($activity['formid']){
						//使用了表单助手
						gethdfieldsetting();
						foreach($_POST as $key => $value) {
							if(empty($_G['cache']['profilesetting2'][$key])) continue;
							$value = cutstr(dhtmlspecialchars(trim($value)), 100, '.');
							if(empty($value) && $_G['cache']['profilesetting2'][$key]['required']) {
								encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'activity_exile_field')));
							}
							if(!empty($value)&& $key == 'field3'){
								if(is_numeric($value)&&$value>0&&$value<=50){
									$quantity = $value;
								}else{
									encodeData(array('error'=>true , 'errorinfo'=>'您填写的报名人数不是一个数字或者数字过大'));
								}
							}
							$ufielddata['userfield'][$key] = $value;
							unset($_POST[$key]);
						}
					}else{
						if(!class_exists('discuz_censor')) {
							include libfile('class/censor');
						}
						$censor = discuz_censor::instance();
						loadcache('profilesetting');
					
						foreach($_POST as $key => $value) {
							if(empty($_G['cache']['profilesetting'][$key])) continue;
							$value = cutstr(dhtmlspecialchars(trim($value)), 100, '.');
							if(empty($value) && $key != 'residedist' && $key != 'residecommunity') {
								encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'activity_exile_field')));
							}
							if(!empty($value)&& $key == 'field3'){
								if(is_numeric($value)&&$value>=0&&$value<=50){						
										$quantity = $value;
								}else{
									encodeData(array('error'=>true , 'errorinfo'=>'您填写的报名人数不是一个数字或者数字过大'));
								}
							}
							$ufielddata['userfield'][$key] = $value;
							unset($_POST[$key]);
						}
					}
					$realname = !empty($ufielddata['userfield']['realname']) ? $ufielddata['userfield']['realname'] : '';
					$mobile   = !empty($ufielddata['userfield']['mobile']) ? $ufielddata['userfield']['mobile'] : '';
				}
				//扩展字段
				if(!empty($activity['ufield']['extfield'])) {	
					foreach($_POST as $k=>$fieldid) {
						if (strrpos($k, 'extKey') === false) {continue;}
						$fieldSort = str_replace('extKey', '', $k);
						$value = cutstr(dhtmlspecialchars(trim($_POST['extValue'.$fieldSort])), 50, '.');
						$fieldid = dhtmlspecialchars(stripslashes($fieldid));
						$ufielddata['extfield'][$fieldid] = $value;
					}
				}
				$ufielddata = !empty($ufielddata) ? serialize($ufielddata) : '';
			}
			if($_G['setting']['activitycredit'] && $activity['credit'] && empty($applyinfo['verified'])) {
				checklowerlimit_wap(array('extcredits'.$_G['setting']['activitycredit'] => '-'.$activity['credit']));
				updatemembercount($_G['uid'], array($_G['setting']['activitycredit'] => '-'.$activity['credit']), true, 'ACC', $_G['tid']);
			}
			if($applyinfo && $applyinfo['verified'] == 2) {
				$newinfo = array(
					'tid' 			=> $_G['tid'],
					'username' 		=> $_G['username'],
					'uid' 			=> $_G['uid'],
					'message' 		=> $message,
					'verified' 		=> $verified,
					'dateline' 		=> $_G['timestamp'],
					'payment' 		=> $payment,
					'ufielddata' 	=> $ufielddata,
					'useform'		=> $activity['formid'],
					'contacts_name' => $realname,
					'contacts_mobile'	=> $mobile
				);
				updateapply($applyinfo['applyid'], $newinfo);
			} else {
				$subject = DB::result_first("SELECT subject FROM " . DB::table('forum_thread') . " WHERE tid='{$_G["tid"]}' " . getSlaveID());
				$newinfo = array(
					'tid' => $_G['tid'],
					'username' => $_G['username'],
					'uid' => $_G['uid'],
					'message' => $message,
					'verified' => $verified,
					'dateline' => $_G['timestamp'],
					'payment' => $payment>0?$payment:0,
					'ufielddata' => $ufielddata,
					'contacts_name' => $realname,
					'contacts_mobile' => $mobile,
					'quantity' => $quantity,
					'sex' => '1',
					'order_type' => '21',
					'ip' => $_G['clientip'],
					'subject' => $subject,
					'authorid' => $activity['uid'],
					'starttimefrom' => $activity['starttimefrom'],
					'starttimeto' => $activity['starttimeto'],
					'days' => $activity['timediff'],
					'coverpic' => '',
					'useform' => $activity['formid'],
					'isshow' => 1,
					'applyid' => 0
				);
				$attachment = DB::fetch_first("SELECT attachment, isimage, serverid, dir FROM " . DB::table('forum_attachment') . " WHERE aid='{$activity['aid']}' ".getSlaveID());
				if($attachment['isimage'] && $attachment['serverid'] > 0) {
					$newinfo['coverpic'] = "http://" . $attachlist[$attachment['serverid']]['name'] . "/".$attachment['dir']."/" . $attachment['attachment'];
				}
				$createresult = newapply($newinfo); //创建
				if(!$createresult){
					encodeData(array('error'=>true , 'errorinfo'=>'报名失败'));
				}
				
				$threadShow = DB::fetch_first("SELECT subject,fid FROM " . DB::table('forum_thread') . " WHERE tid={$_G["tid"]} " . getSlaveID());
				$pid        = DB::result_first("SELECT pid FROM " . DB::table('forum_post') . " WHERE tid={$_G["tid"]}  and first=1" . getSlaveID());
				
				//新的动态表的增加
				$feedarr = array(
					'uid' 	    => $_G['uid'],
					'fid' 	    => $threadShow['fid'],
					'id' 	    => $_G['tid'],
					'pid'  	    => $pid,
					'type'      => 7,
					'dateline'  => $_G[timestamp],
					'subject'   => '参加了活动',
					'message'   => '',
					'title'     => $threadShow['subject'],
					'username'  => $_G['username'],
				);
	
				require_once libfile('function/feed');
				feed_add_ucenter($feedarr);
				
			}
			
			//清缓存
			clearcache_getapplyhistory($_G['tid'], $_G['uid']);
			clearcache_getallorder($_G['tid']);
			clearcache_getapply($_G['uid']);
			
			//更新下某个活动的总报名人数和已通过报名人数
			setPassnumAndApplynum($_G['tid']);	
			
			//计算当前活动热度
			setActHot($_G['tid']);
			
			if($thread['authorid'] != $_G['uid']) {
				notification_add($thread['authorid'], 'activity', 'activity_notice', array(
					'tid' => $_G['tid'],
					'subject' => $thread['subject'],
				));
				$space = array();
				space_merge($space, 'field_home');
	
				if(!empty($space['privacy']['feed']['newreply'])) {
					require libfile('function/post');
					$feed['icon'] = 'activity';
					$feed['title_template'] = 'feed_reply_activity_title';
					$feed['title_data'] = array(
						'subject' => "<a href=\"forum.php?mod=viewthread&tid=$_G[tid]\">$thread[subject]</a>",
						'hash_data' => "tid{$_G[tid]}"
					);
					$feed['id'] = $_G['tid'];
					$feed['idtype'] = 'tid';
					postfeed($feed);
				}
				
				//给app用户(活动发布者)发通知
				pushActivityMsg(12, $thread['authorid'], 0);
			}
			
			
		}
		
		encodeData($returnData);
	}	
	
	
	//取消报名--源自source/module/forum/forum_misc.php的action=activityapplies
	function doApplyCancle()
	{
		global $_G;	
		global $returnData;		
		
		if(!$_G['uid']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
		}		

		$cancelresult = cancelapply($_G['tid'], $_G['uid']);
		
		//清除缓存
		clearcache_getapplyhistory($_G['tid'], $_G['uid']);
		clearcache_getallorder($_G['tid']);
		clearcache_getapply($_G['uid']);
		
		//更新下某个活动的总报名人数和已通过报名人数
		setPassnumAndApplynum($_G['tid']);	
		
		$thread  = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid='$_G[tid]'" . getSlaveID());
		if($thread['authorid'] != $_G['uid']) {
			notification_add($thread['authorid'], 'activity', 'activity_cancel', array(
				'tid' 		=> $_G['tid'],
				'subject' 	=> $thread['subject'],
				'reason' 	=> ''
			));
		}
		
		encodeData($returnData);
	}
	
	//提供给在外的短线线路接口
	function zaiwaiList() 
	{	
		global $_G;	
		global $returnData;
		
		$_area = array(
            "beijing"=> 101,
            "tianjin" => 100,
            "chongqing"=> 166,
            "shanghai" => 48,
            "hebei"=> 104,
            "shanxi"=> 165,
            "liaoning"=> 115,
            "jilin"=> 116,
            "heilongjiang"=> 159,
            "jiangsu"=> 109,
            "zhejiang"=> 147,
            "anhui"=> 158,
            "fujian"=> 113,
            "jiangxi"=> 111,
            "shandong"=> 103,
            "henan"=> 106,
            "hubei"=> 164,
            "hunan"=> 114,
            "guangdong"=> 112,
            "hainan"=> 117,
            "sichuan"=> 102,
            "guizhou"=>176,
            "yunnan"=> 105,
            "shan_xi"=> 107,
            "gansu"=> 110,
            "qinghai"=> 177,
            "neimenggu"=> 170,
            "guangxi"=> 108,
            "xizang"=> 139,
            "ningxia"=> 143,
            "xinjiang"=> 171
        );
        $_G['gp_space'] = $_G['gp_space'] ? $_G['gp_space'] : 'beijing';
        $_G['gp_space'] = !empty($_area[$_G['gp_space']]) ? $_area[$_G['gp_space']] : '';      
      
        if (!$_G['gp_space']) {
        	unset($returnData['G'], $returnData['forumoptionList']);		
			encodeData($returnData);
        }
        
        $_G['gp_cate']   	 = !empty($_G['gp_cate']) ? intval($_G['gp_cate']) : 0;        
        $_G['gp_days']   	 = !empty($_G['gp_days']) ? intval($_G['gp_days']) : 0;   
        $_G['gp_nature'] 	 = !empty($_G['gp_nature']) ? intval($_G['gp_nature']) : 0;   
        $_G['gp_start_time'] = !empty($_G['gp_start_time']) ? intval($_G['gp_start_time']) : 0;   
        $_G['gp_end_time'] 	 = !empty($_G['gp_end_time']) ? intval($_G['gp_end_time']) : 0;
        
        $arrWeek   = array("","一","二","三","四","五","六","日");
		$arrNature = array("1"=>"AA","2"=>"商业");
		$arrCatetoid = array(
			'高海拔登山' => 100, 
			'普通登山' => 100,
			'攀岩攀冰' => 3,
			'滑雪' => 6,
			'自助游' => 101,
			'休闲' => 102,
			'露营' => 7,
			'骑行' => 5,
			'徒步' => 4,
			'摄影' => 9,
			'跑步/越野跑' => 103,
			'其它' => 104		
		);
		
		$list    = array();
		$tids    = array();
		$aids    = array();
		$arrCate = array();
		$createdtimes  	  = array();
		$arrApplynumbers  = array();
		
		//北京、重庆、黑龙江（群山之友群），上海,获得下线路提供人
		if ($_G['gp_space'] == 101 || $_G['gp_space'] == 166 || $_G['gp_space'] == 159  || $_G['gp_space'] ==48) {
			$threadtypes = DB::result_first('select threadtypes from ' . DB::table('forum_forumfield') . ' where fid=' . $_G['gp_space'] . getSlaveID());
			$threadtypes = unserialize($threadtypes);
			$threadtypes = $threadtypes['types'];
		}
		
		if ($_G['gp_cate']) {
			foreach ($arrCatetoid as $k=>$v) {
				if ($v == $_G['gp_cate']) {
					$arrCate[$k] = 1;
				}
			}
		}
		
		$sql   = "select a.aid, a.tid, a.cost, a.starttimefrom, a.starttimeto, a.place, a.expiration, a.nature, a.class, a.timediff, t.subject, t.typeid from ";
		$sql  .= DB::table('forum_activity')." a ";
		$sql  .= " left join ".DB::table('forum_thread')." t ON t.tid=a.tid";
		$sql  .= " WHERE t.displayorder>'-1' and t.fid = {$_G['gp_space']} and (a.starttimeto - a.starttimefrom <= 86400 * 3) ";
		if ($_G['gp_start_time']) {
			$sql  .= $_G['gp_end_time'] ? " and a.starttimefrom between '{$_G['gp_start_time']}' and '{$_G['gp_end_time']}' " : " and a.starttimefrom >= '{$_G['gp_start_time']}'";
		}
		$sql  .= " and a.starttimeto > '{$_G['timestamp']}' ";

		//在本地测试用的条件，上线时关掉
//		$time  = $_G['timestamp'] - 86400*30*30;
//		$sql  .= " and a.starttimeto > '{$time}' ";
				
		$sql  .= getSlaveID();		
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			//获得活动状态
			$activityclose = $v['expiration'] ? ($v['expiration'] > TIMESTAMP ? 0 : 1) : 0;
			if ($activityclose) {continue;}
			
			if ($arrCate && !isset($arrCate[$v['class']])) {continue;}
			
			$v['days']  = $v['timediff'] ? $v['timediff'] : ceil(($v['starttimeto'] - $v['starttimefrom']) / 86400);
			$isdays = !$_G['gp_days'] || ($_G['gp_days'] == $v['days']) ? true : false;
			if (!$isdays) {continue;}
			
			$isnature = !$_G['gp_nature'] || ($_G['gp_nature'] == $v['nature']) ? true : false;
			if (!$isnature) {continue;}
			
			$list[] = $v;
			$tids[$v['tid']] = $v['tid'];
			$aids[$v['aid']] = $v['aid'];
		}
				
		if ($tids) {
			$tids  = implode(',', $tids);				
			$sql   = "select aa.tid , aa.dateline, aa.verified, aa.ufielddata from ".DB::table('forum_activityapply')." aa where aa.tid in ({$tids}) " . getSlaveID();
			$query = DB::query($sql);
			while($v = DB::fetch($query)) {
				$v['dateline'] = intval($v['dateline']);
				if (!isset($createdtimes[$v['tid']])) {
					$createdtimes[$v['tid']] = $v['dateline'];
				} elseif ($createdtimes[$v['tid']] < $v['dateline']) {
					$createdtimes[$v['tid']] = $v['dateline'];
				}
				
				$v['ufielddata'] = unserialize($v['ufielddata']);
				$nofilds = $v['ufielddata']['userfield']['field3'];
				if($v['verified'] == 1) {
					$arrApplynumbers[$v['tid']] += !empty($nofilds) && is_numeric($nofilds) ? intval($nofilds) : 1;
				} 
			}
		}			
		
		//获得活动图片的信息
		if ($aids) {
			$aids  = implode(',', $aids);
			$sql   = "select a.aid, a.attachment, a.serverid, a.dir from ".DB::table('forum_attachment')." a where a.aid in ({$aids})";
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {				
				if ($v['serverid'] > 50) {
					$attachList[$v['aid']] = getimagethumb(450 ,300 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
				} else {
					$attachList[$v['aid']] = getimagethumb(150 ,100 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
				}
			}
		}
			
		$arrNoStore = array('北京综合'=>1,'重庆综合'=>1,'上海综合'=>1);
		foreach ($list as $k=>$v) {
			//缩略图
	        $list[$k]['thumb'] 		  		= !empty($attachList[$v['aid']]) ? $attachList[$v['aid']] : '';
	        $list[$k]['start_time_format']  = date('Y-m-d',$v['starttimefrom'])."(周".$arrWeek[date('N',$v['starttimefrom'])].")";
	        $list[$k]['nature']  			= !empty($arrNature[$v['nature']]) ? $arrNature[$v['nature']] : '未选择';
	        $list[$k]['start_time']			= $v['starttimefrom'];
	        $list[$k]['end_time']			= $v['starttimeto'];
	        $list[$k]['price']			    = $v['cost'];
	        $list[$k]['last_in_time']	    = !empty($createdtimes[$v['tid']]) ? $createdtimes[$v['tid']] : 0;
	        $list[$k]['cate_id']	    	= !empty($arrCatetoid[$v['class']]) ? $arrCatetoid[$v['class']] : 0;
	        $list[$k]['sales']	    	    = !empty($arrApplynumbers[$v['tid']]) ? $arrApplynumbers[$v['tid']] : 0;
	        $list[$k]['store_name']	    	= !empty($threadtypes[$v['typeid']]) ? $threadtypes[$v['typeid']] : '';
	        if ($_G['gp_space'] == 159) {
	        	$list[$k]['store_name'] = $list[$k]['store_name'] == '群山之友群' ? '群山之友群' : '';
	        }
	        $list[$k]['store_name'] = isset($arrNoStore[$list[$k]['store_name']]) ? '' : $list[$k]['store_name'];	        
	        
	        unset($list[$k]['starttimefrom'], $list[$k]['starttimeto'], $list[$k]['cost'], $list[$k]['expiration']);
		}
		
		$returnData["activityList"]	= $list;
		unset($returnData['G'], $returnData['forumoptionList']);		
		encodeData($returnData);
	}
	
}
?>