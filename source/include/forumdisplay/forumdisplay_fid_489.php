<?php
/**
 *	�����ȷ�Ӫ�����ҳ���⴦��
 *	Qiudongfang
 *	2014��6��13��
 */

//���û��ȷ����ȷ���ȼ� �ȷ�ҵĻ��ֹ������ã�������ʾȥ����
// $xianfeng_level_conf = array(
// 	33 => 80,	//���20
// 	35 => 300,
// 	36 => 1500,
// 	37 => 3000,
// 	38 => 9000,
// 	39 => 15000,
// 	40 => 100000,
// );

$xianfeng_vip = $level_is_upgrade = 0;
if($_G['uid']) {
	//�ж��û��ǲ��ǡ������ȷ�Ӫ����Ա�����û���û���ȷ�ѫ��Ϊ׼
	$xianfeng_medal = DB::fetch_first("SELECT ml.medalid, m.image FROM ".DB::table('forum_medallog')." AS ml INNER JOIN ".DB::table('forum_medal')." AS m ON ml.medalid=m.medalid AND ml.uid = '$_G[uid]' AND ml.type<2 ORDER BY ml.id DESC LIMIT 1 ".getSlaveID());
	$xianfeng_vip = $xianfeng_medal['medalid'];
	$_G['member']['activedate'] = floor((TIMESTAMP-$_G['member']['regdate'])/86400);

	//�ж��û��Ƿ�ﵽ��������
	// if(in_array($xianfeng_vip, array(33,35,36,37,38,39,40))) {
	// 	$level_is_upgrade = ($xianfeng_vip > 0 && $_G['member']['extcredits6'] > $xianfeng_level_conf[$xianfeng_vip]) || (empty($xianfeng_vip) && $_G['member']['extcredits6'] >= 20) ? 1 : 0;
	// }
}

//���������ֱ��ѯ�������������б�
$forum_threadlist = $thread = array();
foreach($_G['forum']['threadtypes']['types'] as $typeid => $typename){
	$forum_threadlist[$typeid]['typename'] = $typename;
	if($_G['forum']['threadtypes']['childtypes'][$typeid]){
		$sql_where = " AND typeid IN ('$typeid' ";
		foreach ($_G['forum']['threadtypes']['childtypes'][$typeid] as $subtypeid => $subtypename) {
			$sql_where .= ", '$subtypeid'";
		}
		$sql_where .= ") ";
	}else{
		$sql_where = " AND typeid='$typeid' ";
	}
	$sql = "SELECT * FROM ".DB::table($threadtable)."
			WHERE fid='489' AND displayorder >= 0 ".$sql_where."
			ORDER BY displayorder DESC, lastpost DESC
			LIMIT 0,6 ".getSlaveID();
	$query = DB::query($sql);
	while($thread = DB::fetch($query)) {
		$thread['lastposterenc'] = rawurlencode($thread['lastposter']);
		$thread['sorthtml'] = $thread['sortid'] && !empty($_G['forum']['threadsorts']['prefix']) && isset($_G['forum']['threadsorts']['types'][$thread['sortid']]) ?
		'<em>[<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'&amp;filter=sortid&amp;sortid='.$thread['sortid'].'">'.$_G['forum']['threadsorts']['types'][$thread['sortid']].'</a>]</em>' : //'';
		$thread['multipage'] = '';
		$topicposts = $thread['special'] ? $thread['replies'] : $thread['replies'] + 1;
		$multipate_archive = $_G['gp_archiveid'] && in_array($_G['gp_archiveid'], $threadtableids) ? "archiveid={$_G['gp_archiveid']}" : '';
		if($topicposts > $_G['ppp']) {
			$pagelinks = '';
			$thread['pages'] = ceil($topicposts / $_G['ppp']);
			$realtid = $_G['forum']['status'] != 3 && $thread['isgroup'] == 1 ? $thread['closed'] : $thread['tid'];
			$show_pagenum = $_G['newtpl'] ? 3 : 6;
			for($i = 2; $i <= $show_pagenum && $i <= $thread['pages']; $i++) {
				$pagelinks .= "<a href=\"forum.php?mod=viewthread&tid=$realtid&amp;".(!empty($multipate_archive) ? "$multipate_archive&amp;" : '')."extra=$extra&amp;page=$i\" target=\"_blank\">$i</a>";
			}
			if($thread['pages'] > $show_pagenum) {
				$pagelinks .= "..<a href=\"forum.php?mod=viewthread&tid=$realtid&amp;".(!empty($multipate_archive) ? "$multipate_archive&amp;" : '')."extra=$extra&amp;page=$thread[pages]\" target=\"_blank\">$thread[pages]</a>";
			}
			$thread['multipage'] = '&nbsp;'.($_G['newtpl']?'':'...').$pagelinks;
		}

		if($thread['highlight']) {
			$string = sprintf('%02d', $thread['highlight']);
			$stylestr = sprintf('%03b', $string[0]);

			$thread['highlight'] = ' style="';
			$thread['highlight'] .= $stylestr[0] ? 'font-weight: bold;' : '';
			$thread['highlight'] .= $stylestr[1] ? 'font-style: italic;' : '';
			$thread['highlight'] .= $stylestr[2] ? 'text-decoration: underline;' : '';
			$thread['highlight'] .= $string[1] ? 'color: '.$_G['forum_colorarray'][$string[1]] : '';
			$thread['highlight'] .= '"';
		} else {
			$thread['highlight'] = '';
		}

		$thread['recommendicon'] = '';
		if(!empty($_G['setting']['recommendthread']['status']) && $thread['recommends']) {
			foreach($_G['setting']['recommendthread']['iconlevels'] as $key => $i) {
				if($thread['recommends'] > $i) {
					$thread['recommendicon'] = $key+1;
					break;
				}
			}
		}

		$thread['moved'] = $thread['heatlevel'] = 0;
		$thread['icontid'] = !$thread['moved'] && $thread['isgroup'] != 1 ? $thread['tid' ] : $thread['closed'];
		if($_G['forum']['status'] != 3 && ($thread['closed'] || ($_G['forum']['autoclose'] && TIMESTAMP - $thread[$closedby] > $_G['forum']['autoclose']))) {
			$thread['new'] = 0;
			if($thread['isgroup'] == 1) {
				$thread['folder'] = 'common';
				$grouptids[] = $thread['closed'];
			} else {
				if($thread['closed'] > 1) {
					$thread['moved'] = $thread['tid'];
					$thread['replies'] = '-';
					$thread['views'] = '-';
				}
				$thread['folder'] = 'lock';
			}
		} elseif($_G['forum']['status'] == 3 && $thread['closed'] == 1) {
			$thread['folder'] = 'lock';
		} else {
			$thread['folder'] = 'common';
			if(!IS_ROBOT && (empty($_G['cookie']['oldtopics']) || strpos($_G['cookie']['oldtopics'], 'D'.$thread['tid'].'D') === FALSE)) {
				$thread['new'] = 1;
				$thread['folder'] = 'new';
			} else {
				$thread['new'] = 0;
			}
			$thread['weeknew'] = $thread['new'] && TIMESTAMP - 604800 <= $thread['dateline'];
			$thread['views'] += get_redis_views($thread['tid'],'viewthread');
			if($thread['replies'] > $thread['views']) {
				$thread['views'] = $thread['replies'];
			}
			if($_G['setting']['heatthread']['iconlevels']) {
				foreach($_G['setting']['heatthread']['iconlevels'] as $k => $i) {
					if($thread['heats'] > $i) {
						$thread['heatlevel'] = $k + 1;
						break;
					}
				}
			}
		}
		//���뵱�췢�����ӱ�����
		if (date('Y-m-d') == date('Y-m-d',$thread['dateline'])) {
			$thread['color'] = "style='color:red;'";
		}
		$thread['dateline'] = dgmdate($thread['dateline'], 'd');
		$thread['lastpost'] = dgmdate($thread['lastpost'], 'u');
	// 	//�����жϵ��ǵ���ʱ���������ö���ȡ����
	//     $thread['displayorder'] = ($_G['gp_typeid'] > 0 && $_G['gp_typeid'] == $thread['typeid'] && $thread['typedorder']>0) ? 'p' : $thread['displayorder'];
	// 	if(in_array($thread['displayorder'], array(1, 2, 3, 4,'p')) ) {
	// 		$thread['id'] = 'stickthread_'.$thread['tid'];
	// 		$separatepos++;
	// 	} else {
	// 		$thread['id'] = 'normalthread_'.$thread['tid'];
	// 	}
	// 	if(isset($_G['setting']['verify']['enabled']) && $_G['setting']['verify']['enabled']) {
	// 		$verifyuids[$thread['authorid']] = $thread['authorid'];
	// 	}
	// 	if($_G['newtpl']){
	// 		$thread['sorthtml'] = str_replace(array('<em>[',']</em>','<em>','</em>'), '', $thread['sorthtml']);
	// 		$thread['typehtml'] = str_replace(array('<em>[',']</em>','<em>','</em>'), '', $thread['typehtml']);
	// 		$thread['lastpost'] = strip_tags($thread['lastpost']);
	// 	/*
	// 		if(in_array($thread['displayorder'], array(2,3,4))){
	// 			$_G['forum_toplist'][] = $thread;
	// 		} elseif(in_array($thread['displayorder'], array(1,'p'))){
	// 			$_G['forum_middlelist'][] = $thread;
	// 		} else {
	// 			$_G['forum_mainlist'][] = $thread;
	// 		}

	// 	}
	// 	$threadids[] = $thread['tid'];
	// 	*/
		$forum_threadlist[$typeid]['thread'][] = $thread;
	}
}

//���» ֻ��ȡ�����ȷ�Ӫ�ʺŷ��Ļ
$query = DB::query("SELECT tid, subject FROM ".DB::table('forum_thread')." WHERE fid='489' AND special='4' AND displayorder >= 0 AND authorid='38602481' ORDER BY tid DESC LIMIT 6 ".getSlaveID());
while($row = DB::fetch($query)){
	$thread_active[] = $row;
}

//һ������ж��ͼƬ�����������һ���Ļ��¼�еĸ���
$attach_tid = $thread_active[0]['tid'];
$thread_attach = DB::fetch_first("SELECT at.attachment, at.serverid, at.dir, at.aid FROM ".DB::table('forum_attachment')." AS at LEFT JOIN ".DB::table('forum_activity')." AS ac ON at.aid = ac.aid WHERE ac.tid ='$attach_tid' ".getSlaveID());
if($thread_attach['serverid']>0){
	$attachpath = getimagethumb(260, 170, 1, $thread_attach['dir'] . '/' . $thread_attach['attachment'], $thread_attach['aid'], $thread_attach['serverid']);
	/*require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
	$attachserver = new attachserver;
	$domain  = $attachserver->get_server_domain($thread_attach['serverid'], '*');
	$attachpath = "http://".$domain['name'].'/'.$thread_attach['dir'].'/'.$thread_attach['attachment'] . attachserver::getPreStr($domain, $thread_attach['dir'], true, false);*/
}elseif($attachment['remote']){
	$attachpath = $_G['setting']['ftp']['attachurl'].$thread_attach['dir'].'/'.$attachment['attachment'];
}else{
	$attachpath = $_G['setting']['attachurl'].$thread_attach['dir'].'/'.$attachment['attachment'];
}

//�¼����Ա���Ի���ȷ�ѫ��ʱ��Ϊ׼
$vip_new = memory('get', 'gore_vip_new');
if(!$vip_new || ($_G['adminid'] == 1 && $_GET['nocache'] == 1)) {
	memory('rm', 'gore_vip_new');
	$query = DB::query("SELECT m.uid, u.username FROM ".DB::table('forum_medallog')." m, ".DB::table('common_member')." u WHERE m.uid=u.uid AND m.type=1 AND medalid IN (33,35,36,37,38,39,40) ORDER BY m.dateline DESC LIMIT 0,21 ".getSlaveID());
	while($row = DB::fetch($query)){
		$vip_new[] = $row;
	}
	memory('set', 'gore_vip_new', $vip_new, 86400);
}

//��Ծ��Ա�����ȷ�ѫ�µȼ��ߵ�Ϊ׼
$vip_active = memory('get', 'gore_vip_active');
if(!$vip_active || ($_G['adminid'] == 1 && $_GET['nocache'] == 1)) {
	memory('rm', 'gore_vip_active');
	$query = DB::query("SELECT m.uid, u.username FROM ".DB::table('forum_medallog')." m, ".DB::table('common_member')." u WHERE m.uid=u.uid AND m.type=1 AND medalid IN (33,35,36,37,38,39,40) ORDER BY m.medalid DESC LIMIT 0,21 ".getSlaveID());
	while($row = DB::fetch($query)){
		$vip_active[] = $row;
	}
	memory('set', 'gore_vip_active', $vip_active, 86400);
}
?>
