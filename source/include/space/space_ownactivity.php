<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: space_activity.php 22550 2011-05-12 05:21:39Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/activity');
require_once libfile('function/space');
space_merge($space, 'count');

$page 		= empty($_GET['page']) ? 1 : intval($_GET['page']);
$perpage 	= 15;
$perpage 	= mob_perpage($perpage);
$start 	 	= ($page-1)*$perpage;
ckstart($start, $perpage);

$list = array();
$aids = array();
$gets = array(
	'mod' 	=> 'space',
	'uid' 	=> $_G['gp_uid'],
	'do' 	=> 'ownactivity',
	'type' 	=> $_G['gp_type']
);
$theurl = 'home.php?'.url_implode($gets);
$endactivity = array();

$viewtype  = in_array($_G['gp_type'], array('orig', 'apply')) ? $_G['gp_type'] : 'apply';
$applylist = getapply(array('uid' => $space['uid'], 'isshow' => 1, 'page' => $page, 'perpage' => $perpage));
$applyCnt  = $applylist['count'];
$origCnt   = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_thread')." t WHERE t.authorid={$space['uid']} and t.special=4 and t.displayorder>-1 " . getSlaveID());
if ($viewtype == 'apply') { //�ұ����Ļ
	if ($applyCnt) {
		$tids = $aids = $list = array();
		if($applylist['list']){
			foreach ($applylist['list'] as $applyid => $item) {
				$tids[] = $item['tid'];
			}
			$tids = array_unique($tids);
			
			$sql  = "select a.*, t.subject, t.displayorder from ";
			$sql .= DB::table('forum_activity')." a ";
			$sql .= " inner join ".DB::table('forum_thread')." t ON t.tid=a.tid";
			$sql .= " WHERE t.tid in (".  implode(',', $tids).")" . getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				$hdlist[$v['tid']] = $v;
				$aids[$v['aid']] = $v['aid'];			
			}
			unset($aids[0]);

			foreach ($applylist['list'] as $applyid => $item) {
				if($hdlist[$item['tid']]){
					$item = array_merge($hdlist[$item['tid']], $item);
				}else{
					$item['displayorder'] = -1;
				}
				$list[] = $item;
			}
		}
		//��ûͼƬ����Ϣ
		if ($aids) {
			$aids  = implode(',', $aids);
			$sql   = "select a.aid, a.attachment, a.serverid, a.dir from ".DB::table('forum_attachment')." a where a.aid in ({$aids})";
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {				
				if ($v['serverid'] > 50) {
					$attachList[$v['aid']] = getimagethumb(360 ,240 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
				} else {
					$attachList[$v['aid']] = getimagethumb(230 ,153 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
				}				
			}
		}
		
		foreach ($list as $k=>$v) {
			
			//��û״̬;
			$activityclose = $v['expiration'] ? ($v['expiration'] > TIMESTAMP ? 0 : 1) : 0;
						
			$v['activityStatus'] = '�ѽ���';
	        if ($v['verified'] < 2) {
	            if (!$activityclose) {
	                $v['activityStatus'] = '�ѱ���';
	            }
	        }
	        
	        //����ͼ
	        $v['thumb'] = !empty($attachList[$v['aid']]) ? $attachList[$v['aid']] : '';	        
	        
	        if ($v['activityStatus'] == '�ѽ���') {
				$endactivity[$k] = $v;
				unset($list[$k]);
			} else {
				$list[$k] = $v;
			}
		}
		$list  = array_merge($list, $endactivity);
		$multi = multi($applyCnt, $perpage, $page, $theurl);
	}
} else {//�ҷ���Ļ		
	
	if ($origCnt) {	
		$tids  = array();	
		$sql   = "select a.*, t.subject, t.dateline from ";
		$sql  .= DB::table('forum_activity')." a ";
		$sql  .= " inner join ".DB::table('forum_thread')." t ON t.tid=a.tid";
		$sql  .= " WHERE t.displayorder>'-1' and a.uid={$space['uid']} and t.special=4";
		$sql  .= " order by t.dateline desc limit {$start},{$perpage}" . getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			$list[$v['tid']] = $v;
			$tids[$v['tid']] = $v['tid'];
			$aids[$v['aid']] = $v['aid'];	
			$arrManageHash[$v['tid']] = getmanagehash($v['tid']);
		}
		
		//��ûͼƬ����Ϣ
		if ($aids) {
			$aids  = implode(',', $aids);
			$sql   = "select a.aid, a.attachment, a.serverid, a.dir from ".DB::table('forum_attachment')." a where a.aid in ({$aids})";
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {				
				if ($v['serverid'] > 50) {
					$attachList[$v['aid']] = getimagethumb(450 ,300 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
				} else {
					$attachList[$v['aid']] = getimagethumb(230 ,153 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
				}				
			}
		}

//�İ����������ýӿڵ� ���ǿ������ĺ���ʹ�øо�û��Ҫ��ȡ�ӿ�
//		if ($tids) {
//			$tids  = implode(',', $tids);				
//			$sql   = "select aa.tid, aa.uid ,aa.verified, aa.ufielddata from ".DB::table('forum_activityapply')." aa where aa.tid in ({$tids})";			
//			$query = DB::query($sql);
//			while($v = DB::fetch($query)) {
//				$v['ufielddata'] = unserialize($v['ufielddata']);
//				$nofilds = $v['ufielddata']['userfield']['field3'];
//				if($v['verified'] == 1) {
//					$arrApplynumbers[$v['tid']] += !empty($nofilds) && is_numeric($nofilds) ? intval($nofilds) : 1;
//				} else {
//					$arrNoverifiednum[$v['tid']] += !empty($nofilds) && is_numeric($nofilds) ? intval($nofilds) : 1;
//				}
//			}
//		}		
		
		foreach ($list as $k=>$v) {
			//ʵ���ǿ���������ע�ʹ�����Ǹ�if��֧
			//$applynumbers  = isset($arrApplynumbers[$v['tid']]) ? $arrApplynumbers[$v['tid']] : 0; //ͨ������
			//$noverifiednum = isset($arrNoverifiednum[$v['tid']]) ? $arrNoverifiednum[$v['tid']] : 0;	//δͨ������	
			$applynumbers = $v['passnumber'];
			$noverifiednum = $v['applynumber'] - $v['passnumber'];
			$v['ufield']   = !empty($v['ufield']) ? unserialize($v['ufield']) : '';	
			if(!empty($v['ufield']['userfield'])) {				
				$v['ufield']['userfield'] = array_flip($v['ufield']['userfield']);				
				if (isset($v['ufield']['userfield']['field3'])) {
					$applynumbers = $applynumbers;			
					$allapplynum  = $applynumbers + $noverifiednum;
				} else {
					$applynumbers = $applynumbers;			
					$allapplynum  = $v['applynumber'] + $noverifiednum;
				}
			}else{
				$applynumbers = $v['applynumber'];
				$allapplynum  = $applynumbers + $noverifiednum;
			}
			$aboutmembers = $v['number'] >= $applynumbers ? $v['number'] - $applynumbers : 0;
			
			$v['allapplynum'] 	= $allapplynum;
			$v['noverifiednum'] = $noverifiednum;
			
			//��û״̬
			$activityclose = $v['expiration'] ? ($v['expiration'] > TIMESTAMP ? 0 : 1) : 0;
						
			$v['activityStatus'] = $aboutmembers > 0 ? '�ѿ�ʼ' : '����Ա';
			$v['activityStatus'] = $activityclose ? '�ѽ���' : $v['activityStatus'];			
			
			//����ͼ
	        $v['thumb'] = !empty($attachList[$v['aid']]) ? $attachList[$v['aid']] : '';
			
			//��վ��������
			$v['manageurl'] = "http://hd.8264.com/index.php?app=my_manage&act=bbshd&mhash={$arrManageHash[$v['tid']]}";
			
			if ($v['activityStatus'] == '�ѽ���') {
				$endactivity[$k] = $v;
				unset($list[$k]);
			} else {
				$list[$k] = $v;
			}
  
		}
		$list  = array_merge($list, $endactivity);		
        $multi = multi($origCnt, $perpage, $page, $theurl);
	}
}

$navtitle = $viewtype == 'apply' ? "{$space['username']}�����Ļ" : "{$space['username']}����Ļ";

if ($_G['gp_tpl']) {
	include_once template("diy:home/space_ownactivity20141202");	
} else {
	include_once template("home/space_ownactivity");
}
?>