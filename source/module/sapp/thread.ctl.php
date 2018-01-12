<?php

if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ThreadCtl extends FrontendCtl{

	function __construct()
	{
		parent::__construct();
		require_once libfile('function/forumlist');
	}

	//��ʾ�б�--�ο�module/forum/forum_forumdisplay.php
	function showlist()
	{
		global $_G;

		if(empty($_G['fid'])) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'forum_nonexistence')));
		}

		if($_G['forum']['type'] == 'group') {
			encodeData(array("url"=>"{$_G["config"]['web']['mobile']}bbs"));
		}

		if($_G['forum']['status'] == 3) {
			encodeData(array('error'=>true , 'errorinfo'=>"�ֻ���¿��¼��δ����"));
		}

		//��������
		$_G['action']['fid'] 	= $_G['fid'];
		$_G['gp_filter'] 		= !empty($_G['gp_filter']) ? $_G['gp_filter'] : "";
		$_G['gp_typeid'] 		= !empty($_G['gp_typeid']) ? $_G['gp_typeid'] : 0;
		$_G['gp_orderby'] 		= !empty($_G['gp_orderby']) ? $_G['gp_orderby'] : "lastpost";
		$_G['gp_digest'] 		= !empty($_G['gp_digest']) ? 1 : 0;
		$_G['gp_specialtype'] 	= !empty($_G['gp_specialtype']) ? $_G['gp_specialtype'] : '';
		$_G['gp_page'] 			= !empty($_G['gp_page']) ? max(intval($_G['gp_page']),1) : 1;
		$_G['gp_dateline']		= !empty($_G['gp_dateline']) ? intval($_G['gp_dateline']) : 0;
		$_G['gp_archiveid'] 	= !empty($_G['gp_archiveid']) ? intval($_G['gp_archiveid']) : 0;

		//�Ӱ����ת������
		if($_G['forum']['type'] == 'sub') {
			$hasCycle  = true;
			$parentFid = "";
			$cycleFid  = $_G['forum']['fup'];
			$sqlFormat = "SELECT f.fid, f.fup, f.type from ".DB::table('forum_forum')." f where f.fid = %u limit 1";
			while ($hasCycle) {

				$sql   = sprintf($sqlFormat,$cycleFid);
				$query = DB::query($sql);
				while($forum = DB::fetch($query)) {
					$cycleForum = $forum;
				}
				if ($cycleForum['type'] == 'forum') {
					$parentFid = $cycleForum['fid'];
					$hasCycle = false;
				}
				$cycleFid   = $cycleForum['fup'];
				if ($cycleFid == 0) {$hasCycle = false;}
			}
			if (!empty($parentFid)) {
				$url = empty($_G['gp_filter']) ? "{$_G["config"]['web']['mobile']}bbs-{$parentFid}-{$_G['gp_page']}.html" : "{$_G["config"]['web']['mobile']}bbs-{$parentFid}-{$_G['gp_filter']}-{$_G['gp_orderby']}-{$_G['gp_typeid']}-{$_G['gp_digest']}-{$_G['gp_specialtype']}-{$_G['gp_page']}.html";
				encodeData(array("url"=>$url));
			}
		}

		$forumOption = $_G['obj_forumOption'];
		unset($_G['obj_forumOption']);

		$showoldetails = isset($_G['gp_showoldetails']) ? $_G['gp_showoldetails'] : '';
		switch($showoldetails) {
			case 'no': dsetcookie('onlineforum', ''); break;
			case 'yes': dsetcookie('onlineforum', 1, 31536000); break;
		}

		$_G['forum']['name']  = strip_tags($_G['forum']['name']);
		$_G['forum']['extra'] = unserialize($_G['forum']['extra']);
		if(!is_array($_G['forum']['extra'])) {
			$_G['forum']['extra'] = array();
		}

		//$_G['forum']['archive']���Ƿ��д浵��2014-06-03ʱ���˹���û������
		$threadtable_info = !empty($_G['cache']['threadtable_info']) ? $_G['cache']['threadtable_info'] : array();
		$forumarchive 	  = array();
		if($_G['forum']['archive']) {
			$query = DB::query("SELECT * FROM ".DB::table('forum_forum_threadtable')." WHERE fid='{$_G['fid']}'");
			while($archive = DB::fetch($query)) {
				$forumarchive[$archive['threadtableid']] = array(
					'displayname' => htmlspecialchars($threadtable_info[$archive['threadtableid']]['displayname']),
					'threads' => $archive['threads'],
					'posts' => $archive['posts'],
				);
				if(empty($forumarchive[$archive['threadtableid']]['displayname'])) {
					$forumarchive[$archive['threadtableid']]['displayname'] = lang('forum/template', 'forum_archive').' '.$archive['threadtableid'];
				}
			}
		}

		//���Ⱥ��ͷͼƬ
		$_G['forum']['banner'] = get_forumimg($_G['forum']['banner']);

		//Ȩ���ж�
		if($_G['forum']['viewperm'] && !forumperm($_G['forum']['viewperm']) && !$_G['forum']['allowview']) {
			encodeData(array('error'=>true , 'errorinfo'=>showmessagenoperm_wap('viewperm', $_G['fid'], $_G['forum']['formulaperm'])));
		} elseif($_G['forum']['formulaperm']) {
			if ($message = formulaperm_wap($_G['forum']['formulaperm'])) {
				encodeData(array('error'=>true , 'errorinfo'=>$message));
			}
		}

		//�����������
		$threadtableids = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		$threadtable = $_G['gp_archiveid'] && in_array($_G['gp_archiveid'], $threadtableids) ? "forum_thread_{$_G['gp_archiveid']}" : 'forum_thread';
		if($_G['setting']['allowmoderatingthread'] && $_G['uid']) {
			$threadmodcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table($threadtable)." WHERE fid='{$_G['fid']}' AND displayorder='-2' AND authorid='{$_G['uid']}'" . getSlaveID());
		}

		if($_G['forum']['modworks'] || $_G['forum']['modnewposts']) {
			$_G['forum']['modnewposts'] && $_G['forum']['modworks'] = 1;
			//�������
			$modnum = $_G['group']['allowmodpost'] ? getcountofposts(DB::table('forum_post'), "invisible='-2' AND fid='$_G[fid]'") : 0;
			//������û�
			$modusernum = $_G['group']['allowmoduser'] ? DB::result_first("SELECT COUNT(*) FROM ".DB::table('common_member_validate')." WHERE status='0'") : 0;
		}

		//����ɸѡ����--�ɰ滧����·��ɽ�����Ͽ��õ���,�ֻ���û�ã��ȼ��ϣ����¾ɰ滧����·�Ĵ���
		$optionadd = $filterurladd = $searchsorton = '';
		$quicksearchlist = array();
		if(!empty($_G['forum']['threadsorts']['types'])) {
			require_once libfile('function/threadsort');

			$showpic = intval($_G['gp_showpic']);
			$templatearray = $sortoptionarray = array();
			foreach($_G['forum']['threadsorts']['types'] as $stid => $sortname) {
				loadcache(array('threadsort_option_'.$stid, 'threadsort_template_'.$stid));
				$templatearray[$stid] = $_G['cache']['threadsort_template_'.$stid]['subject'];
				$sortoptionarray[$stid] = $_G['cache']['threadsort_option_'.$stid];
			}

			if(!empty($_G['forum']['threadsorts']['defaultshow']) && empty($_G['gp_sortid']) && empty($_G['gp_sortall'])) {
				$_G['gp_sortid'] = $_G['forum']['threadsorts']['defaultshow'];
				$filterurladd = '&amp;filter=sort';
			}

			$_G['gp_sortid'] = $_G['gp_sortid'] ? $_G['gp_sortid'] : $_G['gp_searchsortid'];
			if(isset($_G['gp_sortid']) && $_G['forum']['threadsorts']['types'][$_G['gp_sortid']]) {
				$searchsortoption = $sortoptionarray[$_G['gp_sortid']];
				$quicksearchlist = quicksearch($searchsortoption);
			}
		}

		//���Ϊ�ط�������ȡ������ģ�ȥ��ǰ���ַ�
		$_G['forum']['name'] = str_replace(array('��', '��', '��-A', '��-B', '��-C', '��-D', '��-E', '��-F', '��-G', '��-H', '��-I', '��-J', '��-K', '��-L', '��-M', '��-N', '��-O', '��-P', '��-Q', '��-R', '��-S', '��-T', '��-U', '��-V', '��-W', '��-X', '��-Y', '��-Z'), '', $_G['forum']['name']);

		//��typeid��Ϊ0�����ø�type��Ϣ
		if($_G['gp_typeid'] > 0) {
			$nowtype_moderator = DB::fetch_first("SELECT name, moderator_type, fatherid FROM " . DB::table('forum_threadclass') . " WHERE typeid = '{$_G[gp_typeid]}'");
			$nowtype_moderator['moderator_type'] = moddisplay($nowtype_moderator['moderator_type'], 'forumdisplay');
		}

		//fatherid��Ϊ0�����ø�type��Ϣ
		if($nowtype_moderator['fatherid'] > 0) {
			$fathertype_moderator = DB::fetch_first("SELECT name, moderator_type FROM " . DB::table('forum_threadclass') . " WHERE typeid = '{$nowtype_moderator[fatherid]}'");
			$fathertype_moderator['moderator_type'] = moddisplay($fathertype_moderator['moderator_type'], 'forumdisplay');
		}

		//�˴��°����չʾ��������Ҫ��ʾ���Ӱ������

		//��ǰ��id
		$thistypefatherid = $nowtype_moderator['fatherid'] > 0 ? $nowtype_moderator['fatherid'] : $_G['gp_typeid'];

		//����fid��typeid��ѯ������Ϣ
		$alldomainlist = $forumOption->getdomainbyfidandtypeid($_G['fid']);
		if(($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || $_G['forum']['threadsorts']) {
			foreach($_G['forum']['threadtypes']['types'] as $_k => $_v) {
				$allthreadsname[$_k] = $_G['forum']['threadtypes']['types'][$_k];
				if($_G['forum']['threadtypes']['fatherid'][$_k] > 0) {
					$_G['forum']['threadtypes']['childtypes'][$_G['forum']['threadtypes']['fatherid'][$_k]][$_k] = $_v;
					unset($_G['forum']['threadtypes']['types'][$_k]);
				}
			}
		}

		//����
		$_G['gp_highlight'] = empty($_G['gp_highlight']) ? '' : htmlspecialchars($_G['gp_highlight']);

		//�Զ��ر�����
		if($_G['forum']['autoclose']) {
			$closedby = $_G['forum']['autoclose'] > 0 ? 'dateline' : 'lastpost';
			$_G['forum']['autoclose'] = abs($_G['forum']['autoclose']) * 86400;
		}

		//start,limit
		$page = $_G['page'];
		$page = $_G['setting']['threadmaxpages'] && $page > $_G['setting']['threadmaxpages'] ? 1 : $page;
		$start_limit = ($page - 1) * $_G['tpp'];

		//�����Ƽ�����
		if($_G['forum']['modrecommend'] && $_G['forum']['modrecommend']['open']) {
			$_G['forum']['recommendlist'] = recommendupdate($_G['fid'], $_G['forum']['modrecommend'], '', 1);
		}

		$filteradd = $sortoptionurl = $sp = '';
		$sorturladdarray = $selectadd = array();
		$forumdisplayadd = array('orderby' => '');
		$specialtype = array('poll' => 1, 'trade' => 2, 'reward' => 3, 'activity' => 4, 'debate' => 5);
		$filterfield = array('digest', 'recommend', 'typeid', 'sortid', 'special', 'dateline', 'specialtype', 'author', 'reply', 'view', 'lastpost', 'heat', 'page', 'moderate');

		foreach ($filterfield as $v) {
			$forumdisplayadd[$v] = '';
		}

		//������filter(������)
		$filter = isset($_G['gp_filter']) && in_array($_G['gp_filter'], $filterfield) ? $_G['gp_filter'] : '';
		$geturl = isset($_POST["ctl"]) ? $_POST : $_GET;
		if($filter && !empty($geturl)) {
			$issort = isset($_G['gp_sortid']) && isset($_G['forum']['threadsorts']['types'][$_G['gp_sortid']]) && $quicksearchlist ? TRUE : FALSE;
			$selectadd = $issort ? $geturl : array();
			foreach($filterfield as $option) {
				foreach($geturl as $field => $value) {
					if(in_array($field, $filterfield) && $option != $field && $field != 'page') {
						$forumdisplayadd[$option] .= '&'.$field.'='.rawurlencode($value);
					}
				}
				if($issort) {
					$sfilterfield = array_merge(array('filter', 'sortid', 'orderby', 'fid'), $filterfield);
					foreach($geturl as $soption => $value) {
						$forumdisplayadd[$soption] .= !in_array($soption, $sfilterfield) ? "&$soption=".rawurlencode($value) : '';
					}
				}
			}
			if($issort && is_array($quicksearchlist)) {
				foreach($quicksearchlist as $option) {
					$identifier = $option['identifier'];
					foreach($geturl as $option => $value) {
						$sorturladdarray[$identifier] .= !in_array($option, array('filter', 'sortid', 'orderby', 'fid', 'searchsort', $identifier)) ? "&amp;$option=$value" : '';
					}
				}
			}
			foreach($geturl as $field => $value) {
				if($field != 'page' && $field != 'fid' && !empty($value)) {
					if ($field != 'login' && $field != 'token' && $field != 'posttime' && $field != 'ctl' && $field != 'act') {
						$multiadd[] = $field.'='.rawurlencode($value);
					}

					if(in_array($field, $filterfield)) {
						$filteradd .= $sp;
						if($field == 'digest') {
							$filteradd .= "AND digest>'0'";
						} elseif($field == 'recommend') {
							$filteradd .= "AND recommends>'".intval($_G['setting']['recommendthread']['iconlevels'][0])."'";
						} elseif($field == 'specialtype') {
							$filteradd .= "AND special='$specialtype[$value]'";
						} elseif($field == 'dateline') {
							$filteradd .= $value ? "AND lastpost>='".(TIMESTAMP - $value)."'" : '';
						} elseif($field == 'sortid') {
							$filteradd .= "AND $field='$value'";
						} elseif($field == 'typeid') {
							$filteradd .= $thistypefatherid == $value ? "AND $field IN('$value','" . implode("','", array_keys($_G['forum']['threadtypes']['childtypes'][$thistypefatherid])) . "')" : "AND $field='$value'";
						}
						$sp = ' ';
					}
				}
			}
		}
		if(!empty($_G['gp_orderby']) && in_array($_G['gp_orderby'], array('lastpost', 'dateline', 'replies', 'views', 'recommends', 'heats', 'digest'))) {
			$forumdisplayadd['orderby'] .= '&orderby='.$_G['gp_orderby'];
		} else {
			//�˴��жϰ���������
			$_G['gp_orderby'] = isset($_G['cache']['forums'][$_G['fid']]['orderby']) ? $_G['cache']['forums'][$_G['fid']]['orderby'] : 'lastpost';
			$forumdisplayadd['orderby'] .= '&orderby='.$_G['gp_orderby'];
		}

		//������������
		if(($_G['forum']['status'] != 3 && $_G['forum']['allowside']) || !empty($_G['forum']['threadsorts']['templatelist'])) {
			updatesession();
			$onlinenum = getonlinenum($_G['fid']);
			if(!IS_ROBOT && ($_G['setting']['whosonlinestatus'] == 2 || $_G['setting']['whosonlinestatus'] == 3)) {
				$_G['setting']['whosonlinestatus'] = 1;
				$detailstatus = $showoldetails == 'yes' || (((!isset($_G['cookie']['onlineforum']) && !$_G['setting']['whosonline_contract']) || $_G['cookie']['onlineforum']) && !$showoldetails);

				if($detailstatus) {
					$actioncode = lang('forum/action');
					$whosonline = array();
					$forumname = strip_tags($_G['forum']['name']);
					$query = DB::query("SELECT uid, groupid, username, invisible, lastactivity FROM ".DB::table('common_session')." WHERE uid>'0' AND fid='$_G[fid]' AND invisible='0' ORDER BY lastactivity DESC LIMIT 12");
					$_G['setting']['whosonlinestatus'] = 1;
					while($online = DB::fetch($query)) {
						if($online['uid']) {
							$online['icon'] = isset($_G['cache']['onlinelist'][$online['groupid']]) ? $_G['cache']['onlinelist'][$online['groupid']] : $_G['cache']['onlinelist'][0];
						} else {
							$online['icon'] = $_G['cache']['onlinelist'][7];
							$online['username'] = $_G['cache']['onlinelist']['guest'];
						}
						$online['lastactivity'] = dgmdate($online['lastactivity'], 't');
						$whosonline[] = $online;
					}
					unset($online);
				}
			} else {
				$_G['setting']['whosonlinestatus'] = 0;
			}
		}

		$forumdisplayadd['page'] = '';
		if($_G['forum']['threadsorts']['types'] && $sortoptionarray && ($_G['gp_searchoption'] || $_G['gp_searchsort'])) {
			$sortid = intval($_G['gp_sortid']);

			if($_G['gp_searchoption']){
				$forumdisplayadd['page'] = '&sortid='.$sortid;
				foreach($_G['gp_searchoption'] as $optionid => $option) {
					$identifier = $sortoptionarray[$sortid][$optionid]['identifier'];
					$forumdisplayadd['page'] .= $option['value'] ? "&searchoption[$optionid][value]=$option[value]&searchoption[$optionid][type]=$option[type]" : '';
				}
			}

			if($searchsorttids = sortsearch($_G['gp_sortid'], $sortoptionarray, $_G['gp_searchoption'], $selectadd, $_G['fid'])) {
				$filteradd .= "AND t.tid IN (".dimplode($searchsorttids).")";
			}
		}

		//��ô˰���������,����ҳ��,�ֻ����$_G['forum_threadcount']��Ϊ$_G['forum']['forum_threadcount']
		if(empty($filter) && empty($_G['gp_sortid']) && empty($_G['gp_archiveid']) && empty($_G['forum']['archive'])) {
			$_G['forum']['forum_threadcount'] = $_G['forum']['threads'];
		} elseif(!$_G['gp_moderate']) {
			//����������鿴Ч�ʣ���ʱ����
			//TODO X2.0 ��������棬�Ͼ�������������
			$indexadd = '';
			if(strexists($filteradd, "t.digest>'0'")) {
				$indexadd = " FORCE INDEX (digest) ";
			}
			$_G['forum']['forum_threadcount'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table($threadtable)." t $indexadd WHERE t.fid='{$_G['fid']}' $filteradd AND t.displayorder>='0'" . getSlaveID());
		}

		//$thisgid:�˰����������fid;$stickycount:ȫ���ö��ͷ����ö��ͱ����ö���;$stickytids:ȫ���ö��ͷ����ö��ͱ����ö�����id
		$thisgid = $_G['forum']['type'] == 'forum' ? $_G['forum']['fup'] : (!empty($_G['cache']['forums'][$_G['forum']['fup']]['fup']) ? $_G['cache']['forums'][$_G['forum']['fup']]['fup'] : 0);
		$forumstickycount = $stickycount = $stickytids = 0;

		//�ж��Ƿ���filter(������)
		$filterbool = !empty($filter) && in_array($filter, $filterfield);

		if (!$filterbool) {

			//ȫ���ö��ͷ����ö���
			if($_G['setting']['globalstick'] && $_G['forum']['allowglobalstick']) {
				$stickytids = $_G['cache']['globalstick']['global']['tids'].(empty($_G['cache']['globalstick']['categories'][$thisgid]['count']) ? '' : ','.$_G['cache']['globalstick']['categories'][$thisgid]['tids']);

				$stickytids = trim($stickytids, ', ');
				if ($stickytids === ''){
					$stickytids = '0';
				}

				if($_G['forum']['status'] != 3) {
					$stickycount = $_G['cache']['globalstick']['global']['count'];
					if(!empty($_G['cache']['globalstick']['categories'][$thisgid])) {
						$stickycount += $_G['cache']['globalstick']['categories'][$thisgid]['count'];
					}
				}
			}

			//�����ö�
			$forumstickytids = array();
			loadcache('forumstick');
			$_G['cache']['forumstick'][$_G['fid']] = isset($_G['cache']['forumstick'][$_G['fid']]) ? $_G['cache']['forumstick'][$_G['fid']] : array();
			$forumstickycount = count($_G['cache']['forumstick'][$_G['fid']]);
			foreach($_G['cache']['forumstick'][$_G['fid']] as $forumstickthread) {
				$forumstickytids[] = $forumstickthread['tid'];
			}
			if(!empty($forumstickytids)) {
				$forumstickytids = dimplode($forumstickytids);
				$stickytids .= ", $forumstickytids";
			}
			$stickycount += $forumstickycount;

			//��û��filter(������),������ö���
			$_G['forum']['forum_threadcount'] += $stickycount;
		}

		$forumdisplayadd['page'] = !empty($forumdisplayadd['page']) ? $forumdisplayadd['page'] : '';
		$multipage_archive = $_G['gp_archiveid'] && in_array($_G['gp_archiveid'], $threadtableids) ? "&archiveid={$_G['gp_archiveid']}" : '';

		//��ҳ
		$pageCnt = ceil($_G["forum"]['forum_threadcount'] / $_G['tpp']);
		$pageCnt = $_G['setting']['threadmaxpages'] && $pageCnt > $_G['setting']['threadmaxpages'] ? $_G['setting']['threadmaxpages'] : $pageCnt;

		$queryStr  = "";
		$queryStr .= !empty($_G['gp_filter']) ? '&amp;filter='.$_G['gp_filter'] : '&amp;filter=';
		$queryStr .= !empty($_G['gp_orderby']) ? '&amp;orderby='.$_G['gp_orderby'] : '&amp;orderby=';
		$queryStr .= !empty($_G['gp_typeid']) ? '&amp;typeid='.$_G['gp_typeid'] : '&amp;typeid=0';
		$queryStr .= !empty($_G['gp_digest']) ? '&amp;digest='.$_G['gp_digest'] : '&amp;digest=0';
		$queryStr .= !empty($_G['gp_specialtype']) ? '&amp;specialtype='.$_G['gp_specialtype'] : '&amp;specialtype=';

		$pager   = array(
			"pageCnt"  => $pageCnt,
//			"queryStr" => "fid=$_G[fid]".($multiadd ? '&'.implode('&', $multiadd) : '').$multipage_archive,
			"queryStr" => "fid=$_G[fid]".($multiadd ? $queryStr : '').$multipage_archive,
			"prevPage" => $page == 1 ? 1 : $page - 1,
			"nextPage" => $page == $pageCnt ? $pageCnt : $page + 1,
			"currPage" => $page
		);

		$extra = rawurlencode(!IS_ROBOT ? 'page='.$page.($forumdisplayadd['page'] ? '&filter='.$filter.$forumdisplayadd['page'] : '').($forumdisplayadd['orderby'] ? $forumdisplayadd['orderby'] : '') : 'page=1');

		$separatepos = 0;
		//�ֻ����$_G['forum_threadlist']��Ϊ$_G['forum']['forum_threadlist']
		$_G['forum']['forum_threadlist'] = array();

		$displayorderadd = !$filterbool && $stickycount ? 't.displayorder IN (0, 1)' : 't.displayorder IN (0, 1, 2, 3, 4)';

		//���򣬽�����ж�
		if(!empty($_G['gp_ascdesc']) && in_array($ascdesc, array('ASC', 'DESC'))) {
			$forumdisplayadd['ascdesc'] .= '&ascdesc='.$_G['gp_ascdesc'];
		} else {
			$_G['gp_ascdesc'] = isset($_G['cache']['forums'][$_G['fid']]['ascdesc']) ? $_G['cache']['forums'][$_G['fid']]['ascdesc'] : 'DESC';
		}

		//��filter(������)��û���ö���$start_limit�����ö����������
		if(($start_limit && $start_limit > $stickycount) || !$stickycount || $filterbool) {
			$querysticky = '';
			$distype = ($_G['gp_typeid']) ? ",t.typedorder DESC" :"";
			$sql = "SELECT t.* FROM ".DB::table($threadtable)." t
				WHERE t.fid='{$_G['fid']}' $filteradd AND ($displayorderadd)
				ORDER BY t.displayorder DESC ".$distype.", t.$_G[gp_orderby] $_G[gp_ascdesc]
				LIMIT ".($filterbool ? $start_limit : $start_limit - $stickycount).", $_G[tpp] " . getSlaveID() . " ";
			$query = DB::query($sql);
		} else {
			$sql = "SELECT t.* FROM ".DB::table($threadtable)." t
				WHERE t.tid IN ($stickytids) AND (t.displayorder IN (2, 3, 4))
				ORDER BY displayorder DESC, $_G[gp_orderby] $_G[gp_ascdesc]
				LIMIT $start_limit, ".($stickycount - $start_limit < $_G['tpp'] ? $stickycount - $start_limit : $_G['tpp']) . " " . getSlaveID() . " ";
			$querysticky = DB::query($sql);
			if($_G['tpp'] - $stickycount + $start_limit > 0) {
				$sql = "SELECT t.* FROM ".DB::table($threadtable)." t
					WHERE t.fid='{$_G['fid']}' $filteradd AND ($displayorderadd)
					ORDER BY displayorder DESC, $_G[gp_orderby] $_G[gp_ascdesc]
					LIMIT ".($_G['tpp'] - $stickycount + $start_limit) . " " . getSlaveID() . " ";
				$query = DB::query($sql);
			} else {
				$query = '';
			}
		}
//		encodeData(array('error'=>true , 'errorinfo'=>$sql));
		//�����б�,�����ֻ�����Ҫ�ع���
		$verify = $verifyuids = $grouptids = array();
		$_G['forum_toplist'] = $_G['forum_middlelist'] = $_G['forum_mainlist'] = array();
		$listIndex = 0;
		while(($querysticky && $thread = DB::fetch($querysticky)) || ($query && $thread = DB::fetch($query))) {
			$thread['lastposterenc'] = rawurlencode($thread['lastposter']);

			$thread['recommendicon'] = '';
			if(!empty($_G['setting']['recommendthread']['status']) && $thread['recommends']) {
				foreach($_G['setting']['recommendthread']['iconlevels'] as $k => $i) {
					if($thread['recommends'] > $i) {
						$thread['recommendicon'] = $k+1;
						break;
					}
				}
			}

			//����ǰͼ��
			$thread['moved'] = $thread['heatlevel'] = 0;
			$thread['icontid'] = !$thread['moved'] && $thread['isgroup'] != 1 ? $thread['tid'] : $thread['closed'];
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

				if($_G['setting']['heatthread']['iconlevels']) {
					foreach($_G['setting']['heatthread']['iconlevels'] as $k => $i) {
						if($thread['heats'] > $i) {
							$thread['heatlevel'] = $k + 1;
							break;
						}
					}
				}
			}

			//�����жϵ��ǵ���ʱ���������ö���ȡ����
			$thread['displayorder'] = ($_G['gp_typeid'] > 0 && $_G['gp_typeid'] == $thread['typeid'] && $thread['typedorder']>0) ? 'p' : $thread['displayorder'];
			if(in_array($thread['displayorder'], array(1, 2, 3, 4,'p')) ) {
				$thread['id'] = 'stickthread_'.$thread['tid'];
				$separatepos++;
			} else {
				$thread['id'] = 'normalthread_'.$thread['tid'];
			}
			if(isset($_G['setting']['verify']['enabled']) && $_G['setting']['verify']['enabled']) {
				$verifyuids[$thread['authorid']] = $thread['authorid'];
			}

			if(in_array($thread['displayorder'], array(2,3,4))){
				$_G['forum_toplist'][$listIndex] = $thread;
				$_G['forum_toplist'][$listIndex]['is_top'] = 1;
			} elseif(in_array($thread['displayorder'], array(1,'p'))){
				$_G['forum_middlelist'][$listIndex] = $thread;
				$_G['forum_middlelist'][$listIndex]['is_middle'] = 1;
			} else {
				$_G['forum_mainlist'][$listIndex] = $thread;
				$_G['forum_mainlist'][$listIndex]['is_main'] = 1;
			}
			$listIndex++;
		}
		$_G['forum']['forum_threadlist'] = array_merge($_G['forum_toplist'], $_G['forum_middlelist'], $_G['forum_mainlist']);
		$_G['forum']['forum_toplist']    = $_G['forum_toplist'];
		$_G['forum']['forum_middlelist'] = $_G['forum_middlelist'];
		$_G['forum']['forum_mainlist'] 	 = $_G['forum_mainlist'];

		//��ѯ��֤,�ֳ���û�õ�
		if($_G['setting']['verify']['enabled'] && $verifyuids) {
			$verifyquery = DB::query("SELECT * FROM ".DB::table('common_member_verify')." WHERE uid IN(".dimplode($verifyuids).")");
			while($value = DB::fetch($verifyquery)) {
				foreach($_G['setting']['verify'] as $vid => $vsetting) {
					if($vsetting['available'] && $vsetting['showicon'] && !empty($vsetting['icon']) && $value['verify'.$vid] == 1) {
						$verify[$value['uid']] .= "<a href=\"home.php?mod=spacecp&ac=profile&op=verify&vid=$vid\" target=\"_blank\">".(!empty($vsetting['icon']) ? '<img src="'.$vsetting['icon'].'" class="vm" alt="'.$vsetting['title'].'" title="'.$vsetting['title'].'" />' : $vsetting['title']).'</a>';
					}
				}
			}
		}

		//�������������
		/*$advShow = array();
		if ($page == 1) {
			$advShow = DB::fetch_first("SELECT parameters,code FROM ".DB::table('common_advertisement')." WHERE advid=650 " . getSlaveID());
			$advShow['parameters']  = unserialize($advShow['parameters']);
			$advShow['tid'] 		= $advShow['parameters']['tid'];

			preg_match_all('/<script>(.*)<\/script>/isU', $advShow['code'], $matA);
			$advShow['code'] = $matA[1][0];

			preg_match_all('/<a href="(.*)".*>(.*)<\/a>/isU', $advShow['code'], $matA);

			$advrand = rand(0, count($matA[0])-1);
			$advShow['subject'] = $matA[2][$advrand];
			$advShow['url'] 	= $matA[1][$advrand];
			if(($pos2 = strrpos($advShow['url'], '?')) !== false){
				$advShow['url'] = substr($advShow['url'], 0, $pos2);
			}
			$advShow['url'] = str_replace('www.zaiwai.com', 'm.zaiwai.com', $advShow['url']);

			$advShow['thread'] = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid={$advShow['tid']} " . getSlaveID());

			unset($advShow['parameters'], $advShow['code'], $advShow['tid']);
//			print_r($advShow);

			$returnData["advShow"] 		    		= $advShow;
		}		*/

		$returnData["forum"] 					= $_G["forum"];
		$returnData["pager"] 					= $pager;
		$returnData["forum"]["forumdisplayadd"]	= $forumdisplayadd;
		$returnData["metakeywords"] 			= !$_G['forum']['keywords'] ? $_G['forum']['name'] : $_G['forum']['keywords'];
		$returnData["metadescription"] 			= !$_G['forum']['description'] ? $_G['forum']['name'] : strip_tags($_G['forum']['description']);

		if (!empty($returnData["forum"]['threadtypes']) && !empty($returnData["forum"]['threadtypes']['listable'])) {
			$typename = !empty($returnData["forum"]['threadtypes']['types'][$_G['gp_typeid']]) ? $returnData["forum"]['threadtypes']['types'][$_G['gp_typeid']] : $returnData["forum"]["name"];
			$returnData["metakeywords"] 	= str_replace($returnData["forum"]["name"], $typename, $returnData["metakeywords"]);
			$returnData["metadescription"]  = str_replace($returnData["forum"]["name"], $typename, $returnData["metadescription"]);
		}

		$returnData["filter"] 		    		= $filter;

		//����ͼƬ
		foreach ($returnData["forum"]['forum_mainlist'] as $i => $info) {
			$returnData["forum"]['forum_mainlist'][$i]['imgList'] = $this->_getMessageImage($info['tid'], 3);
		}

		$returnData["forum"]['forum_middlelist'] = array_values($returnData["forum"]['forum_middlelist']);
		$returnData["forum"]['forum_mainlist'] = array_values($returnData["forum"]['forum_mainlist']);

		encodeData($returnData);
	}

	//������ϸ--�ο�module/forum/forum_viewthread.php
	function showview()
	{
		global $_G;

		require_once libfile('function/forumlist');
		require_once libfile('function/discuzcode');
		require_once libfile('function/post');

		//û��tid
		if(empty($_G['tid'])) {
//			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nonexistence')));
			//�����,����ɨ��ά��ҳ��
			if (empty($_G["forum_thread"]) && $_G["gp_other_activity"]) {
				$_G["forum_thread"] = DB::fetch_first("select * from ".DB::table('forum_thread')." where tid={$_G['gp_tid']} " . getSlaveID());
				$_G["forum"] = DB::fetch_first("select * from ".DB::table('forum_forum')." where fid={$_G["forum_thread"]['fid']} " . getSlaveID());

				$returnData = $this->viewthread_other_activity_list($returnData);

				$returnData["forum"] 	    	= $_G["forum"];
				$returnData["threadShow"]		= $_G["forum_thread"];
				$returnData["metakeywords"] 	= $_G['forum']['name'];
				$returnData["metadescription"] 	= $metadescription ? $metadescription : strip_tags($_G['forum_thread']['subject']);

				encodeData($returnData);
			} else {
				encodeData(array('error'=>true , 'errorinfo'=>"ָ�������ⲻ���ڻ��ѱ�ɾ�������ڱ���ˣ��뷵�ء�"));
			}
		}
		if($_G['forum']['status'] == 3) {
			encodeData(array('error'=>true , 'errorinfo'=>"�ֻ���¿��¼��δ����"));
		}

		//Ȩ���ж�
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

		$_G['forum']['extra'] = unserialize($_G['forum']['extra']);
		if(!is_array($_G['forum']['extra'])) {
			$_G['forum']['extra'] = array();
		}

		$page = max(1, $_G['page']);
		$_G['setting']['commentnumber'] = $_G["gp_commentnumber"] ? $_G["gp_commentnumber"] : $_G['setting']['commentnumber'];//ÿ�����ӵ�������

		//����̳�ö��й�
		$forumOption = $_G['obj_forumOption'];
		unset($_G['obj_forumOption']);

		//$_G['forum']['archive']���Ƿ��д浵��2014-06-03ʱ���˹���û������
		$threadtableids   = !empty($_G['cache']['threadtableids']) ? $_G['cache']['threadtableids'] : array();
		$threadtable_info = !empty($_G['cache']['threadtable_info']) ? $_G['cache']['threadtable_info'] : array();

		if(!in_array(0, $threadtableids)) {
			$threadtableids = array_merge(array(0), $threadtableids);
		}
		$archiveid 		 = intval($_G['gp_archiveid']);
		$displayorderadd = $_G['uid'] ? " OR (t.displayorder IN ('-4', '-3', '-2') AND t.authorid='{$_G['uid']}')" : '';
		if(empty($archiveid) || !in_array($archiveid, $threadtableids)) {
			$threadtable = !empty($_G['forum']['threadtableid']) ? "forum_thread_{$_G['forum']['threadtableid']}" : 'forum_thread';
			//���������Ϣ
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

		//û��������Ϣ
		if(!$_G['forum_thread']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nonexistence')));
		}

		if($_G['forum_thread']['readperm'] && $_G['forum_thread']['readperm'] > $_G['group']['readaccess'] && !$_G['forum']['ismoderator'] && $_G['forum_thread']['authorid'] != $_G['uid']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'thread_nopermission', array('readperm' => $_G['forum_thread']['readperm']))));
		}

		//���ӱ�����ַ�
		$_G['forum_thread']['short_subject'] = cutstr($_G['forum_thread']['subject'], 52);
		$_G['forum_thread']['views'] += get_redis_views($_G['forum_thread']['tid'],'viewthread');

		$_G['action']['fid'] = $_G['fid'];
		$_G['action']['tid'] = $_G['tid'];
		$_G['gp_authorid']   = !empty($_G['gp_authorid']) ? intval($_G['gp_authorid']) : 0;
		$_G['gp_ordertype']  = !empty($_G['gp_ordertype']) ? intval($_G['gp_ordertype']) : 0;

		//������ȫ�ֱ��� discuzcode funtion attachlist
		$aimgs = array();

		//���ô�����������̳�����ظ�ʱ���cookie
		if($_G['member']['lastvisit'] < $_G['forum_thread']['lastpost'] && (!isset($_G['cookie']['fid'.$_G['fid']]) || $_G['forum_thread']['lastpost'] > $_G['cookie']['fid'.$_G['fid']])) {
			dsetcookie('fid'.$_G['fid'], $_G['forum_thread']['lastpost'], 3600);
		}

		//���뿴������������ֻ���Ӧ���������ȥ��
		$_G['gp_from'] = !empty($_G['gp_from']) && $_G['gp_from'] == 'portal' ? 'portal' : '';
		$fromuid 	 = $_G['setting']['creditspolicy']['promotion_visit'] && $_G['uid'] ? '&amp;fromuid='.$_G['uid'] : '';
		$feeduid 	 = $_G['forum_thread']['authorid'] ? $_G['forum_thread']['authorid'] : 0;
		$feedpostnum = $_G['forum_thread']['replies'] > $_G['ppp'] ? $_G['ppp'] : ($_G['forum_thread']['replies'] ? $_G['forum_thread']['replies'] : 1);

		//���������ѯ�ַ���
		if(!empty($_G['gp_extra'])) {
			parse_str($_G['gp_extra'], $extra);
			$_G['gp_extra'] = array();
			foreach($extra as $_k => $_v) {
				if(preg_match('/^\w+$/', $_k)) {
					$_G['gp_extra'][] = $_k.'='.$_v;
				}
			}
			$_G['gp_extra'] = implode('&', $_G['gp_extra']);
		}
		$_G['gp_extra'] = $_G['gp_extra'] ? rawurlencode($_G['gp_extra']) : '';

		//����Ȩ�޼�����
		$hiddenreplies 	  = getstatus($_G['forum_thread']['status'], 2);
		$rushreply 		  = getstatus($_G['forum_thread']['status'], 3);
		$savepostposition = getstatus($_G['forum_thread']['status'], 1);

		$_G['group']['raterange'] = $_G['setting']['modratelimit'] && $adminid == 3 && !$_G['forum']['ismoderator'] ? array() : $_G['group']['raterange'];
		$_G['group']['allowgetattach'] = !empty($_G['forum']['allowgetattach']) || ($_G['group']['allowgetattach'] && !$_G['forum']['getattachperm']) || forumperm($_G['forum']['getattachperm']);
		$_G['getattachcredits'] = '';
		if($_G['forum_thread']['attachment']) {
			$exemptvalue = $_G['forum']['ismoderator'] ? 32 : 4;
			if(!($_G['group']['exempt'] & $exemptvalue)) {
				$creditlog = updatecreditbyaction('getattach', $_G['uid'], array(), '', 1, 0, $_G['forum_thread']['fid']);
				$p = '';
				if($creditlog['updatecredit']) for($i = 1;$i <= 8;$i++) {
					if($policy = $creditlog['extcredits'.$i]) {
						$_G['getattachcredits'] .= $p.$_G['setting']['extcredits'][$i]['title'].' '.$policy.' '.$_G['setting']['extcredits'][$i]['unit'];
						$p = ', ';
					}
				}
			}
		}

		$exemptvalue = $_G['forum']['ismoderator'] ? 64 : 8;
		$_G['forum_attachmentdown'] = $_G['group']['exempt'] & $exemptvalue;

		$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (!$_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
		$secqaacheck  = $_G['setting']['secqaa']['status'] & 2 && (!$_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

		$postlist  = $_G['forum_attachtags'] = $attachlist = $_G['forum_threadstamp'] = array();
		$aimgcount = 0;
		$_G['forum_attachpids'] = -1;

		$showsettings   = str_pad(decbin($_G['setting']['showsettings']), 3, '0', STR_PAD_LEFT);
		$showsignatures = $showsettings{0};
		$showavatars    = $showsettings{1};
		$_G['setting']['showimages'] = $showsettings{2};

		$_G['forum']['allowreply'] = isset($_G['forum']['allowreply']) ? $_G['forum']['allowreply'] : '';
		$_G['forum']['allowpost'] = isset($_G['forum']['allowpost']) ? $_G['forum']['allowpost'] : '';

		if(!$_G['uid']) {
			$guestallowpostreply = ($_G['forum']['allowreply'] != -1) && (($_G['forum_thread']['isgroup'] || (!$_G['forum_thread']['closed'] && !checkautoclose($_G['forum_thread']))) || $_G['forum']['ismoderator']) && ((!$_G['forum']['replyperm'] && $_G['perm']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'], $_G['perm']['groupid'])) || $_G['forum']['allowreply']);
		}

		$allowpostreply = ($_G['forum']['allowreply'] != -1) && (($_G['forum_thread']['isgroup'] || (!$_G['forum_thread']['closed'] && !checkautoclose($_G['forum_thread']))) || $_G['forum']['ismoderator']) && ((!$_G['forum']['replyperm'] && $_G['group']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'])) || $_G['forum']['allowreply']);
		if(!$_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
			$allowpostreply = false;
		}
		$_G['group']['allowpost'] = $_G['forum']['allowpost'] != -1 && ((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])) || $_G['forum']['allowpost']);

		if(!$_G['uid']) {
			$guestreply = $guestallowpostreply && !$allowpostreply;
			$allowpostreply = $guestreply || $allowpostreply;
		}
		if($_G['group']['allowpost']) {
			$_G['group']['allowpostpoll'] = $_G['group']['allowpostpoll'] && ($_G['forum']['allowpostspecial'] & 1);
			$_G['group']['allowposttrade'] = $_G['group']['allowposttrade'] && ($_G['forum']['allowpostspecial'] & 2);
			$_G['group']['allowpostreward'] = $_G['group']['allowpostreward'] && ($_G['forum']['allowpostspecial'] & 4) && isset($_G['setting']['extcredits'][$_G['setting']['creditstrans']]);
			$_G['group']['allowpostactivity'] = $_G['group']['allowpostactivity'] && ($_G['forum']['allowpostspecial'] & 8);
			$_G['group']['allowpostdebate'] = $_G['group']['allowpostdebate'] && ($_G['forum']['allowpostspecial'] & 16);
		} else {
			$_G['group']['allowpostpoll'] = $_G['group']['allowposttrade'] = $_G['group']['allowpostreward'] = $_G['group']['allowpostactivity'] = $_G['group']['allowpostdebate'] = FALSE;
		}

		//��������������
		$_G['forum']['threadplugin'] = $_G['group']['allowpost'] && $_G['setting']['threadplugins'] ? is_array($_G['forum']['threadplugin']) ? $_G['forum']['threadplugin'] : unserialize($_G['forum']['threadplugin']) : array();

		$postfieldsadd = $specialadd1 = $specialadd2 = $specialextra = '';
		if($_G['forum_thread']['special'] == 2) {
			//����
			if(!empty($_G['gp_do']) && $_G['gp_do'] == 'tradeinfo') {
				require_once libfile('thread/trade', 'include');
			}
			$query = DB::query("SELECT pid FROM ".DB::table('forum_trade')." WHERE tid='$_G[tid]'");
			while($trade = DB::fetch($query)) {
				$tpids[] = $trade['pid'];
			}
			$specialadd2 = " AND pid NOT IN (".dimplode($tpids).")";
		} elseif($_G['forum_thread']['special'] == 5) {
			//����
			if(isset($_G['gp_stand']) && $_G['gp_stand'] >= 0 && $_G['gp_stand'] < 3) {
				$specialadd1 .= "LEFT JOIN ".DB::table('forum_debatepost')." dp ON p.pid=dp.pid";
				if($_G['gp_stand']) {
					$specialadd2 .= "AND (dp.stand='$_G[gp_stand]' OR p.first='1')";
				} else {
					$specialadd2 .= "AND (dp.stand='0' OR dp.stand IS NULL OR p.first='1')";
				}
				$specialextra = "&amp;stand=$_G[gp_stand]";
			} else {
				$specialadd1 = "LEFT JOIN ".DB::table('forum_debatepost')." dp ON p.pid=dp.pid";
			}
			$postfieldsadd .= ", dp.stand, dp.voters";
		}

		$onlyauthoradd = $threadplughtml = '';
		$posttableid   = $_G['forum_thread']['posttableid'];
		$posttable 	   = $posttableid ? "forum_post_$posttableid" : 'forum_post';

		if(empty($_G['gp_viewpid'])) {
			$ordertype = empty($_G['gp_ordertype']) && getstatus($_G['forum_thread']['status'], 4) ? 1 : $_G['gp_ordertype'];

			//�����ö�
			$sticklist = array();
			if($_G['forum_thread']['stickreply'] && $page == 1 && !$_G['gp_authorid'] && !$ordertype) {
				$query = DB::query("SELECT p.*, ps.position FROM ".DB::table('forum_poststick')." ps
					LEFT JOIN ".DB::table($posttable)." p USING(pid)
					WHERE ps.tid='$_G[tid]' ORDER BY ps.dateline DESC");
				while($post = DB::fetch($query)) {
					$post['message'] = messagecutstr($post['message'], 400);
					$post['message'] = trim($post['message']);
					$post['avatar']  = avatar($post['authorid'], 'small', true);
					$sticklist[$post['pid']] = $post;
				}
				$stickcount = count($sticklist);
			}

			//ֻ��������
			if($_G['gp_authorid']) {
				$_G['forum_thread']['replies'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND invisible='0' AND authorid='$_G[gp_authorid]' " . getSlaveID());
				$_G['forum_thread']['replies']--;
				if($_G['forum_thread']['replies'] < 0) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'undefined_action')));
				}
				$onlyauthoradd = "AND p.authorid='$_G[gp_authorid]'";
			} elseif($_G['forum_thread']['special'] == 5) {
				//����
				if(isset($_G['gp_stand']) && $_G['gp_stand'] >= 0 && $_G['gp_stand'] < 3) {
					$_G['forum_thread']['replies'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_debatepost')." WHERE tid='$_G[tid]' AND stand='$_G[gp_stand]'");
				} else {
					$_G['forum_thread']['replies'] = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND invisible='0' " . getSlaveID());
					$_G['forum_thread']['replies'] > 0 && $_G['forum_thread']['replies']--;
				}
			} elseif($_G['forum_thread']['special'] == 2) {
				//����
				$tradenum = DB::result_first("SELECT count(*) FROM ".DB::table('forum_trade')." WHERE tid='$_G[tid]'");
				$_G['forum_thread']['replies'] -= $tradenum;
			}

			//������ϸҳ��ÿҳ����
			$_G['ppp'] = $_G['forum']['threadcaches'] && !$_G['uid'] ? $_G['setting']['postperpage'] : $_G['ppp'];
			$totalpage = ceil(($_G['forum_thread']['replies'] + 1) / $_G['ppp']);
			$page > $totalpage && $page = $totalpage;

			//��ҳ�߼����ֻ�����Ϊfalse
			$_G['forum_pagebydesc'] = FALSE;

			if(!$_G['forum_pagebydesc']) {
				//���$pageadd������$page
				$start_limit = $_G['forum_numpost'] = max(0, ($page - 1) * $_G['ppp']);
				if($start_limit > $_G['forum_thread']['replies']) {
					$start_limit = $_G['forum_numpost'] = 0;
					$page = 1;
				}
				if($ordertype != 1) {
					$pageadd = "ORDER BY p.dateline LIMIT $start_limit, $_G[ppp]";
				} else {
					$_G['forum_numpost'] = $_G['forum_thread']['replies'] + 2 - $_G['forum_numpost'] + ($page > 1 ? 1 : 0);
					$pageadd = "ORDER BY p.first DESC, p.dateline DESC LIMIT $start_limit, $_G[ppp]";
				}
			}

			//��ҳ
			$pageCnt   = $totalpage;
			$queryStr  = 'tid='.$_G['tid'];
			$queryStr .= $_G['forum_thread']['is_archived'] ? '&archive='.$_G['forum_thread']['archiveid'] : '';
			$queryStr .= $_G['gp_extra'] ? '&amp;extra='.$_G['gp_extra'] : "";
			$queryStr .= $ordertype && $ordertype != getstatus($_G['forum_thread']['status'], 4) ? '&amp;ordertype='.$ordertype : '';
			$queryStr .= !empty($_G['gp_highlight']) ? '&amp;highlight='.rawurlencode($_G['gp_highlight']) : '';
			$queryStr .= !empty($_G['gp_authorid']) ? '&amp;authorid='.$_G['gp_authorid'] : '';
			$queryStr .= !empty($_G['gp_from']) ? '&amp;from='.$_G['gp_from'] : '';
			$queryStr .= !empty($_G['gp_checkrush']) ? '&amp;checkrush='.$_G['gp_checkrush'] : '';
			$queryStr .= !empty($_G['gp_modthreadkey']) ? '&amp;modthreadkey='.rawurlencode($_G['gp_modthreadkey']) : '';
			$queryStr .= $specialextra;
			$pager	   = array(
				"pageCnt"  => $pageCnt,
				"queryStr" => $queryStr,
				"prevPage" => $page == 1 ? 1 : $page - 1,
				"nextPage" => $page == $pageCnt ? $pageCnt : $page + 1,
				"currPage" => $page
			);

		} else {
			$_G['gp_viewpid'] = intval($_G['gp_viewpid']);
			$pageadd = "AND p.pid='$_G[gp_viewpid]'";
		}

		//ƴ��$query
		$_G['forum_newpostanchor'] = $_G['forum_postcount'] = $_G['forum_ratelogpid'] = $_G['forum_commonpid'] = 0;

		$_G['forum_onlineauthors'] = array();
		$query = "SELECT p.* $postfieldsadd
				FROM ".DB::table($posttable)." p
				$specialadd1 ";

		$cachepids = $positionlist = $postusers = $skipaids = array();

		//���$cachepids��$positionlist
		if($savepostposition && empty($onlyauthoradd) && empty($specialadd2) && empty($_G['gp_viewpid']) && $ordertype != 1) {
			$start = ($page - 1) * $_G['ppp'] + 1;
			$end   = $start + $_G['ppp'];
			$q2    = DB::query("SELECT pid, position FROM ".DB::table('forum_postposition')." WHERE tid='$_G[tid]' AND position>='$start' AND position<'$end' ORDER BY position");
			while ($post = DB::fetch($q2)) {
				$cachepids[] = $post['pid'];
				$positionlist[$post['pid']] = $post['position'];
			}
			$cachepids = dimplode($cachepids);
			$pagebydesc = false;
		}

		$query .= $savepostposition && $cachepids ? "WHERE p.pid IN ($cachepids)" : ("where p.tid='$_G[gp_tid]'".($_G['forum_auditstatuson'] || in_array($_G['forum_thread']['displayorder'], array(-2, -3, -4)) && $_G['forum_thread']['authorid'] == $_G['uid'] ? '' : " and p.invisible='0'")." $specialadd2 $onlyauthoradd $pageadd");
		$query .= getSlaveID();

		//������(�������ӣ���Ӧһ������������Ϊforpid��Ϊ0)���ڲ���������Ӧ�����ı��
		$forumComment = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and forpid <> 0 and tid=$_G[gp_tid] " . getSlaveID());
		while($comment = DB::fetch($forumComment)) {
			$replyComment[] = $comment;
		}

		$query = DB::query($query);
		while($post = DB::fetch($query)) {
			if(($onlyauthoradd && $post['anonymous'] == 0) || !$onlyauthoradd) {
				//ѭ���������ӵ�pid�����������б�$replyComment����ͬ�� ������¼�ı��id��������$post������
				for($i=0;$i<count($replyComment);$i++){
					if($post['pid'] == $replyComment[$i]['forpid']){
						$post['cid'] = $replyComment[$i]['id'];
					}
				}
				$postusers[$post['authorid']] = array();
				$postlist[$post['pid']] 	  = $post;
				if($post['first']) {
					$_G['forum_firstpid'] = $post['pid'];
					$metadescription = str_replace(array("\r", "\n"), '', messagecutstr(strip_tags($post['message']), 160));

					//��ݵ���,��ʱ�ò���
					$message = messagecutstr($post['message'], 100);
					$message = implode("\n", array_slice(explode("\n", $message), 0, 3));
					$fastreply_noticeauthormsg = htmlspecialchars($message);
					$post_reply_quote = lang('forum/misc', 'post_reply_quote', array('author' => $post['author'], 'time' => $time));
					$message = "[quote][size=2][color=#999999]{$post_reply_quote}[/color] [url=forum.php?mod=redirect&goto=findpost&pid={$post['pid']}&ptid={$post['tid']}][img]static/image/common/back.gif[/img][/url][/size]\n{$message}[/quote]";
					$fastreply_noticetrimstr = htmlspecialchars($message);
				}
			}
		}
		$postno = & $_G['cache']['custominfo']['postno'];

		//�û���ϸ��Ϣ
		if($postusers) {
			$postusersinfo = array();
			foreach($postusers as $k => $v){
				$lsinfo = memory('get' ,'user_info_viewthread_uid_'.$k.'_cache');
				if($lsinfo){
					$postusersinfo[$k] = $lsinfo;
					unset($postusers[$k]);
				}
			}
			if($postusers){
				$verifyadd = '';
				$fieldsadd = $_G['cache']['custominfo']['fieldsadd'];
				if($_G['setting']['verify']['enabled']) {
					$verifyadd  = "LEFT JOIN ".DB::table('common_member_verify')." mv USING(uid)";
					$fieldsadd .= ', mv.verify1, mv.verify2, mv.verify3, mv.verify4, mv.verify5';
				}
				$query = DB::query("SELECT m.uid, m.username, m.groupid, m.adminid, m.regdate, m.credits, m.email, m.status AS memberstatus,
						ms.lastactivity, ms.invisible AS authorinvisible,
						mc.*,
						mf.medals, mf.sightml AS signature, mf.customstatus $fieldsadd
						FROM ".DB::table('common_member')." m
						LEFT JOIN ".DB::table('common_member_field_forum')." mf USING(uid)
						LEFT JOIN ".DB::table('common_member_status')." ms USING(uid)
						LEFT JOIN ".DB::table('common_member_count')." mc USING(uid)
						$verifyadd
						WHERE m.uid IN (".dimplode(array_keys($postusers)).")" . getSlaveID());
				while($postuser = DB::fetch($query)) {
					$postusersinfo[$postuser['uid']] = $postuser;
					memory('set' ,'user_info_viewthread_uid_'.$postuser['uid'].'_cache' ,$postuser ,3600 * 24 * 7);
				}
			}

			foreach($postlist as $pid => $post) {
				$post = array_merge($postlist[$pid], $postusersinfo[$post['authorid']]);
				$postlist[$pid] = $this->viewthread_procpost($post, $_G['member']['lastvisit'], $ordertype);
				$postlist[$pid] = preg_replace("/(\<br\s?\/\>)\r\n(\<img)/i","<img",$postlist[$pid]);
				$postlist[$pid] = preg_replace("/(\<img .*\>)(\<br\s?\/\>)/i","$1",$postlist[$pid]);

				if(!empty($post['attachment_old'])) {

					//��ͼƬ���д���
					$postlist[$post["pid"]]["message"] = $this->_dealThreadPic($post["message"]);
				}
			}
		}

		if($savepostposition && $positionlist) {
			foreach ($positionlist as $pid => $position)
			$postlist[$pid]['number'] = $position;
		}

		//��������
		if($_G['forum_thread']['special'] > 0 && (empty($_G['gp_viewpid']) || $_G['gp_viewpid'] == $_G['forum_firstpid'])) {
			$_G['forum_thread']['starttime'] = gmdate($_G['forum_thread']['dateline']);
			$_G['forum_thread']['remaintime'] = '';
			switch($_G['forum_thread']['special']) {
//				case 1: require_once libfile('thread/poll', 'include'); break;
//				case 2: require_once libfile('thread/trade', 'include'); break;
				case 3:
					require_once libfile('thread/reward', 'include');
					$returnData["rewardprice"] = $rewardprice;
					$returnData["bestpost"]    = !empty($bestpost) ? $bestpost : array();
					break;
				case 4:
					require_once libfile('thread/activity', 'include');
					//����ѡ��ԭͼ����ͼƬ����,��һ������������ֵ,�ڶ�������Ϊ0,����������Ϊ5
					$activity["thumb"]      	= !empty($attach['isimage']) ? getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, str_replace($_G['config']['web']['attach'], "", 'forum/'.$attach["attachment"]), 0, $attach['serverid']) : '';
					$activity["allapplynum"]	= $allapplynum;
					$activity["aboutmembers"]	= $aboutmembers;
					$activity["applied"]	    = $applied;
					$activity["isverified"]	    = $isverified;
					$activity["activityclose"]	= $activityclose;
					$returnData["activity"] 	= $activity;
					break;
				case 5:
					require_once libfile('thread/debate', 'include');
					$debate['affirmpoint']  		= explode("\r\n", $debate['affirmpoint']);
					$debate['affirmpoint_title']    = $debate['affirmpoint'][0];
					$debate['affirmpoint_title']    = strip_tags($debate['affirmpoint_title']);
					unset($debate['affirmpoint'][0]);
					$debate['affirmpoint_content']  = !empty($debate['affirmpoint']) ? implode("", $debate['affirmpoint']) : "";
					$debate['affirmpoint_content']  = strip_tags($debate['affirmpoint_content']);

					$debate['negapoint']  		  = explode("\r\n", $debate['negapoint']);
					$debate['negapoint_old']      = $debate['negapoint'];
					$debate['negapoint_title']    = $debate['negapoint'][0];
					$debate['negapoint_title']    = strip_tags($debate['negapoint_title']);
					unset($debate['negapoint'][0]);
					$debate['negapoint_content']  = !empty($debate['negapoint']) ? implode("", $debate['negapoint']) : "";
					$debate['negapoint_content']  = strip_tags($debate['negapoint_content']);

					$returnData["debate"]   = $debate;
					break;
				case 127:
					if($_G['forum_firstpid']) {
						$sppos = strpos($postlist[$_G['forum_firstpid']]['message'], chr(0).chr(0).chr(0));
						$specialextra = substr($postlist[$_G['forum_firstpid']]['message'], $sppos + 3);

						$postlist[$_G['forum_firstpid']]['message'] = substr($postlist[$_G['forum_firstpid']]['message'], 0, $sppos);
						if($specialextra) {
							if(array_key_exists($specialextra, $_G['setting']['threadplugins'])) {
								@include_once DISCUZ_ROOT.'./source/plugin/'.$_G['setting']['threadplugins'][$specialextra]['module'].'.class.php';
								$classname = 'threadplugin_'.$specialextra;
								if(class_exists($classname) && method_exists($threadpluginclass = new $classname, 'viewthread')) {
									$threadplughtml = $threadpluginclass->viewthread($_G['tid']);
								}
							}
						}
					}
					break;
			}
		}

		//�Ժ�����ת����
		if(empty($_G['gp_authorid']) && empty($postlist)) {
			$replies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND invisible='0' " . getSlaveID());
			$replies = intval($replies) - 1;
			if($_G['forum_thread']['replies'] != $replies && $replies > 0) {
				DB::query("UPDATE ".DB::table($threadtable)." SET replies='$replies' WHERE tid='$_G[tid]'");
				dheader("Location: forum.php?mod=redirect&tid=$_G[tid]&goto=lastpost");
			}
		}

		//���ӵ���:$commentcount:��¼ÿ��post�е����ĸ���
		$comments = $commentcount = array();
		if($_G['forum_commonpid'] && $_G['setting']['commentnumber']){

			//$_G['forum_commonpid'],�Ǳ�ҳ���е�����postid
			$querys = DB::query("SELECT * FROM ".DB::table('forum_postcomment')." WHERE isshow = 1 and pid IN (".$_G['forum_commonpid'].') ORDER BY dateline DESC ' . getSlaveID());
			while($comment = DB::fetch($querys)) {
				$comment['avatar']  = avatar($comment['authorid'], 'small', true);
				if($comment['authorid']) {
					$commentcount[$comment['pid']]++;
				}
				if(count($comments[$comment['pid']]) < $_G['setting']['commentnumber'] && $comment['authorid']) {
					$comments[$comment['pid']][] = $comment;
				}
			}
		}

		//������Ϣ
		$threadsort = $_G['forum_thread']['sortid'] && isset($_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']]) ? 1 : 0;

		if($threadsort) {
			require_once libfile('function/threadsort');
			$threadsortshow = threadsortshow($_G['forum_thread']['sortid'], $_G['tid']);
		}

		//Ȩ�����
		$allowblockrecommend = $_G['group']['allowdiy'] || $_G['group']['allowauthorizedblock'];
		$allowpostarticle = $_G['group']['allowmanagearticle'] || $_G['group']['allowauthorizedarticle'];
		$allowpusharticle = empty($_G['forum_thread']['special']) && empty($_G['forum_thread']['sortid']) && !$_G['forum_thread']['pushedaid'];
		if($_G['forum_thread']['displayorder'] != -4) {
			$modmenu = array(
				'thread' => $_G['forum']['ismoderator'] || $allowblockrecommend || $allowpusharticle && $allowpostarticle,
				'post' => $_G['forum']['ismoderator'] && ($_G['group']['allowwarnpost'] || $_G['group']['allowbanpost'] || $_G['group']['allowdelpost'] || $_G['group']['allowstickreply']) || $_G['forum_thread']['pushedaid'] && $allowpostarticle
			);
		} else {
			$modmenu = array();
		}

		//�����,����ɨ��ά��ҳ��
		if ($_G["forum_thread"]['special'] == 4 && $_G["gp_other_activity"]) {
			$returnData = $this->viewthread_other_activity_list($returnData);
		}

		$this->_updateviews($threadtable);
		// $returnData["forum"] 	    	= $_G["forum"];
		$returnData["thread"]		= $_G["forum_thread"];
		$returnData["thread"]['avatar'] = avatar($_G['forum_thread']['authorid'], 'small', true);
		$returnData["postList"] 		= $postlist;
		// $returnData["commentList"]	    = $comments;
		// $returnData["commentcountList"] = $commentcount;
		// $returnData["stickList"] 		= $sticklist;
		$returnData["pager"] 			= $pager;
		// $returnData["rcStart"] 			= $start_limit;

		encodeData($returnData);

	}

	//������ʾ���ݵĸ�ʽ��,������Ҫ�����Ķ�--�ο�module/forum/forum_viewthread.php
	function viewthread_procpost($post, $lastvisit, $ordertype, $special = 0) {
		global $_G;

		if(!$_G['forum_newpostanchor'] && $post['dateline'] > $lastvisit) {
			$post['newpostanchor'] = '<a name="newpost"></a>';
			$_G['forum_newpostanchor'] = 1;
		} else {
			$post['newpostanchor'] = '';
		}

		$post['lastpostanchor'] = ($ordertype != 1 && $_G['forum_numpost'] == $_G['forum_thread']['replies']) || ($ordertype == 1 && $_G['forum_numpost'] == $_G['forum_thread']['replies'] + 2) ? '<a name="lastpost"></a>' : '';
		if($_G['forum_pagebydesc']) {
			if($ordertype != 1) {
				$post['number'] = $_G['forum_numpost'] + $_G['forum_ppp2']--;
			} else {
				$post['number'] = $post['first'] == 1 ? 1 : $_G['forum_numpost'] - $_G['forum_ppp2']--;
			}
		} else {
			if($ordertype != 1) {
				$post['number'] = ++$_G['forum_numpost'];
			} else {
				$post['number'] = $post['first'] == 1 ? 1 : --$_G['forum_numpost'];
			}
		}

		$_G['forum_postcount']++;

		$post['dbdateline'] = $post['dateline'];
		$post['dateline']   = dgmdate($post['dateline'], 'u');
		$post['groupid']    = $_G['cache']['usergroups'][$post['groupid']] ? $post['groupid'] : 7;

		if($post['username']) {
			$_G['forum_onlineauthors'][] = $post['authorid'];
			$post['usernameenc'] 		 = rawurlencode($post['username']);
			$post['readaccess']  		 = $_G['cache']['usergroups'][$post['groupid']]['readaccess'];
			if($_G['cache']['usergroups'][$post['groupid']]['userstatusby'] == 1) {
				$post['authortitle'] = $_G['cache']['usergroups'][$post['groupid']]['grouptitle'];
				$post['stars'] 		 = $_G['cache']['usergroups'][$post['groupid']]['stars'];
			}
			$post['upgradecredit'] = false;
			if($_G['cache']['usergroups'][$post['groupid']]['type'] == 'member' && $_G['cache']['usergroups'][$post['groupid']]['creditslower'] != 999999999) {
				$post['upgradecredit'] = $_G['cache']['usergroups'][$post['groupid']]['creditslower'] - $post['credits'];
			}

			$post['taobaoas'] = addslashes($post['taobao']);
			$post['regdate']  = dgmdate($post['regdate'], 'd');
			$post['lastdate'] = dgmdate($post['lastactivity'], 'd');

			if($post['medals']) {
				loadcache('medals');
				foreach($post['medals'] = explode("\t", $post['medals']) as $key => $medalid) {
					list($medalid, $medalexpiration) = explode("|", $medalid);
					if(isset($_G['cache']['medals'][$medalid]) && (!$medalexpiration || $medalexpiration > TIMESTAMP)) {
						$post['medals'][$key] = $_G['cache']['medals'][$medalid];
					} else {
						unset($post['medals'][$key]);
					}
				}
			}

			$post['avatar']    = avatar($post['authorid'], 'small', true);
			$post['groupicon'] = $post['avatar'] ? g_icon($post['groupid'], 1) : '';
			$post['banned']    = $post['status'] & 1;
			$post['warned']    = ($post['status'] & 2) >> 1;

		} else {
			if(!$post['authorid']) {
				$post['useip'] = substr($post['useip'], 0, strrpos($post['useip'], '.')).'.x';
			}
		}
		$post['attachments'] = array();
		$post['imagelist'] = $post['attachlist'] = '';

		if($post['attachment']) {
			if($_G['group']['allowgetattach']) {
				$_G['forum_attachpids'] .= ",$post[pid]";
				$post['attachment_old'] = $post['attachment'];
				$post['attachment']     = 0;
				if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $post['message'], $matchaids)) {
					$_G['forum_attachtags'][$post['pid']] = $matchaids[1];
				}
			} else {
				$post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $post['message']);
			}
		}

		$_G['forum_ratelogpid'] .= ($_G['setting']['ratelogrecord'] && $post['ratetimes']) ? ','.$post['pid'] : '';
		if($_G['setting']['commentnumber'] && ($post['first'] && $_G['setting']['commentfirstpost'] || !$post['first'])) {
			$_G['forum_commonpid'] .= $post['comment'] ? ','.$post['pid'] : '';
		}
		$post['allowcomment'] = $_G['setting']['commentnumber'] && ($_G['setting']['commentpostself'] || $post['authorid'] != $_G['uid']) &&
			($post['first'] && $_G['setting']['commentfirstpost'] && in_array($_G['group']['allowcommentpost'], array(1, 3)) ||
			(!$post['first'] && in_array($_G['group']['allowcommentpost'], array(2, 3))));
		$_G['forum']['allowbbcode'] = $_G['forum']['allowbbcode'] ? -$post['groupid'] : 0;
		$post['signature'] = $post['usesig'] ? ($_G['setting']['sigviewcond'] ? (strlen($post['message']) > $_G['setting']['sigviewcond'] ? $post['signature'] : '') : $post['signature']) : '';

		if(!$_G['gp_archiver']) {

			//ֻ������ͼƬ������
			$post['message'] = preg_replace("/\[swf\]\s*([^\[\<\r\n]+?)\s*\[\/swf\]/ies", "�Բ��𣬻�δ������Ƶ���Ź���", $post['message']);
			$post['message'] = preg_replace("/\[media=([\w,]+)\]\s*([^\[\<\r\n]+?)\s*\[\/media\]/ies", "�Բ��𣬻�δ������Ƶ���Ź���", $post['message']);

			$post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], $post['htmlon'] & 1, $_G['forum']['allowsmilies'], $_G['forum']['allowbbcode'], ($_G['forum']['allowimgcode'] && $_G['setting']['showimages'] ? 1 : 0), $_G['forum']['allowhtml'], ($_G['forum']['jammer'] && $post['authorid'] != $_G['uid'] ? 1 : 0), 0, $post['authorid'], $_G['forum']['allowmediacode'], $post['pid']);
		}

		//��message�Ĵ��� shuaiquan
		//��message�����õĴ���
		preg_match_all("/<blockquote>(.*)<a.*pid=(\d*)&.*>.*<\/a>(.*)<\/blockquote>/isU", $post["message"], $matA);
		if (!empty($matA[2][0])) {

			$post["message_quote_content"] = strip_tags($matA[3][0]);

			$arr = explode(" ", strip_tags($matA[1][0]));
			$post["message_quote_author"]   = $arr[0];
			$post["message_quote_dateline"] = $arr[2]." ".$arr[3];
			$post["message_quote_pid"] 		= $matA[2][0];

			$post["message"] = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $post["message"]);//����
		}

		$post["message"] = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $post["message"]);//���������ʾ��font��ǩ
		$post["message"] = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $post["message"]);

		$post["message"] = strip_tags($post["message"], "<a><p><img><table><tbody><tr><th><td><span><script><br>");

		//��message�еı����д���,������
		$post["message"] = preg_replace('/(<table.*>.*<\/table>)/isU', '<div class="scroll-table" style="display:none;"><div class="scroller">\1</div></div>', $post["message"]);

		$post["message"] = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $post["message"]);//n������<br/>
		$post["message"] = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $post["message"]);//<p><br/></p>
		$post["message"] = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $post["message"]);//<p><br/>
		$post["message"] = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $post["message"]);//</p><br/>

		$post["message"] = str_replace('target="_blank"', "", $post["message"]);
		$post["message"] = preg_replace('/���������.*�༭/isU', '', $post["message"]);//���������...�༭
		$post["message"] = str_replace('����8264�ֻ��� m.8264.com', "", $post["message"]);

		//���ı��е�ͼƬ���н��ʴ���
		$post["message"] = $this->_dealTextPic($post["message"]);

		//��������
		preg_match_all('/\[attach\](\d+)\[\/attach\]/isU', $post["message"], $matA);
		if ($matA[1]) {
			$aids  = implode(',', $matA[1]);
			$sql   = "SELECT aid, attachment, dir  FROM ".DB::table('forum_attachment')." WHERE aid in ({$aids}) and isimage=1 " . getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				$imgsrc 		 = "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['attachment']}!wap";
				$pics[$v['aid']] = "<img src='{$imgsrc}' width='100%' />";
			}
			foreach ($matA[1] as $k=>$v) {
				if (isset($pics[$v])) {
					$post["message"] = str_replace("[attach]{$v}[/attach]", $pics[$v], $post["message"]);
				} else {
					$post["message"] = str_replace("[attach]{$v}[/attach]", '', $post["message"]);
				}
			}
		}

		//�µĻ������ʾ
		if ($post['first'] == 1) {
			$post['activitymessage'] = explode('[----]', $post['message']);
			if (count($post['activitymessage']) > 1) {
				$post['message'] = '<div class="activitymessage">';
				$arrTitle = array('�г̽���', '����װ��', '����');
				foreach ($post['activitymessage'] as $k=>$v) {
					if ($k > 2) {break;}
					if ($v == '��������') {continue;}
					$post['message'] .= "<p class='title'>{$arrTitle[$k]}</p>";
					$post['message'] .= "<p class='message'>{$v}</p>";
				}
				$post['message'] .= '</div>';
			}
		}

		$_G['forum_firstpid'] = intval($_G['forum_firstpid']);

		return $post;
	}

	//������ϸҳ-���������
	function viewthread_other_activity_order($list) {
		$item_count = count($list);
		for ($i=0;$i<$item_count-1;$i++) {
			for ($j=$i+1;$j<=$item_count-1;$j++) {
				if ($list[$i]['last_in_time'] < $list[$j]['last_in_time']) {
					$temp 	  = $list[$i];
					$list[$i] = $list[$j];
					$list[$j] = $temp;
				}
			}
		}
		return $list ? $list : array();
	}

	//������ϸҳ-���������б�
	function viewthread_other_activity_list($returnData) {
		global $_G;
		global $returnData;

		$list    = array();
		$listN   = array();
		$listMan = array();
		$tids    = array();
		$aids    = array();
		$createdtimes  = array();

		$sql   = "select a.*, t.subject from ";
		$sql  .= DB::table('forum_activity')." a ";
		$sql  .= " left join ".DB::table('forum_thread')." t ON t.tid=a.tid";
		$sql  .= " WHERE t.displayorder>'-1' and t.special=4 and t.authorid = {$_G["forum_thread"]['authorid']} ";
		$sql  .= getSlaveID();
		$query = DB::query($sql);
		while ($v = DB::fetch($query)) {
			if ($_G["forum_thread"]['tid'] == $v['tid']) {continue;}

			$list[$v['tid']] = $v;
			$tids[$v['tid']] = $v['tid'];
		}

		if ($tids) {
			$tids  = implode(',', $tids);
			$sql   = "select aa.tid, aa.uid ,aa.verified, aa.ufielddata, aa.dateline from ".DB::table('forum_activityapply')." aa where aa.tid in ({$tids}) " . getSlaveID();
			$query = DB::query($sql);
			while($v = DB::fetch($query)) {
				if (!isset($createdtimes[$v['tid']])) {
					$createdtimes[$v['tid']] = $v['dateline'];
				} elseif ($createdtimes[$v['tid']] < $v['dateline']) {
					$createdtimes[$v['tid']] = $v['dateline'];
				}

				$v['ufielddata'] = unserialize($v['ufielddata']);
				$nofilds = $v['ufielddata']['userfield']['field3'];
				if($v['verified'] == 1) {
					$arrApplynumbers[$v['tid']] += !empty($nofilds) && is_numeric($nofilds) ? intval($nofilds) : 1;
				} else {
					$arrNoverifiednum[$v['tid']] += !empty($nofilds) && is_numeric($nofilds) ? intval($nofilds) : 1;
				}
			}
		}

		foreach ($list as $k=>$v) {
			$applynumbers  = isset($arrApplynumbers[$v['tid']]) ? $arrApplynumbers[$v['tid']] : 0;
			$noverifiednum = isset($arrNoverifiednum[$v['tid']]) ? $arrNoverifiednum[$v['tid']] : 0;
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

			$v['last_in_time']   = !empty($createdtimes[$v['tid']]) ? $createdtimes[$v['tid']] : 0;

			$v['activityStatus'] = $aboutmembers > 0 ? '�ѿ�ʼ' : '����Ա';
			$v['activityStatus'] = $activityclose ? '�ѽ���' : $v['activityStatus'];

			if ($v['activityStatus'] == '�ѿ�ʼ') {
				$listN[]   = $v;
			} elseif ($v['activityStatus'] == '����Ա') {
				$listMan[] = $v;
			} else {
				unset($aids[$v['aid']]);
			}
		}

		//����,�ѿ�ʼ����ǰ�棬����Ա���ں���
		$listN 	 = $this->viewthread_other_activity_order($listN);
		$listMan = $this->viewthread_other_activity_order($listMan);

		$list    = array_merge($listN, $listMan);
		$list    = array_slice($list, 0, 4);
		foreach ($list as $k=>$v) {
			$aids[$v['aid']] = $v['aid'];
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
					$attachList[$v['aid']] = getimagethumb(284 ,188 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
				}
			}
		}
		foreach ($list as $k=>$v) {

			//����ͼ
			$list[$k]['thumb'] 				= !empty($attachList[$v['aid']]) ? $attachList[$v['aid']] : '';

			unset($list[$k]['activityStatus'], $list[$k]['starttimefrom'], $list[$k]['starttimeto'], $list[$k]['ufield'], $list[$k]['credit'], $list[$k]['area'], $list[$k]['expiration'], $list[$k]['gender'], $list[$k]['aid'], $list[$k]['uid'], $list[$k]['class'], $list[$k]['place'], $list[$k]['nature']);
		}

		$returnData["activityList"]	= $list;

		return $returnData;
	}

	//�õ����������е�ͼƬ gtl �°�
	function _getMessageImage($tid, $max = 1){
		global $_G;
		$imgList = array();
		$result = DB::fetch_first("SELECT tid, image FROM " . DB::table('forum_post_previewimg') . " WHERE tid = $tid" . getSlaveID());
		if($result){
			$pic = json_decode($result['image'], true);
			$suffix = "wapw320h0";
			$i = 0;
			foreach ($pic as $info) {
				//$imgList[] = _replace_post_image($info['pic'], $tid, $wh);
				//$imgList[] = "<img file='{$info['pic']}!{$suffix}' id='{$tid}' class='lazy' data-original='{$info['pic']}!{$suffix}'/>";
				$imgList[] = "{$info['pic']}!{$suffix}";
				$i++;
				if ($i == $max)
					break;
			}
		}
		return $imgList;
	}

	//�����û��� gtl
	function userPostList(){
		global $_G;
		global $returnData;
		require_once libfile('function/space');
		$uid		=	$_G['member']['uid']; //��½״̬
		$postlist	=	array(); //���

		if($uid){
			//����ѿ����ĵ���ģ���б�
			$dianpingFids = getdianpingfids();
			$notfids = implode(',', $dianpingFids);

			//sql
			$sql   = "SELECT t.tid,t.fid,t.subject FROM ".DB::table('forum_thread')." t WHERE t.authorid = {$uid} and t.displayorder>=0 and t.special=0 ";
			$sql  .= " and t.fid not in ({$notfids}) ";
			$sql  .= " order by t.dateline desc"  . getSlaveID();
			$query = DB::query($sql);
			while($v = DB::fetch($query)) {
				$postlist[$v['tid']] = $v;
			}
		}

		$returnData['postlist'] = $postlist;

		encodeData($returnData);
	}

	function showpreview(){
		global $_G;
		global $returnData;

		//�жϵ�ǰ��¼״̬
		$uid = $_G['uid'];
		$tid = $_G['tid'];
		if (!$uid) {
			encodeData(array('error' => true, 'errorinfo' => '����Ҫ��¼����ܽ��б�����'));
		}
		if (empty($tid)) {
			encodeData(array('error' => true, 'errorinfo' => "ָ�������ⲻ���ڻ��ѱ�ɾ�������ڱ���ˣ��뷵�ء�"));
		}
		if ($_G['forum']['status'] == 3) {
			encodeData(array('error' => true, 'errorinfo' => "�ֻ���¿��¼��δ����"));
		}

		//��ȡ������Ϣ && �жϵ�ǰ��¼�û������ӵĹ�ϵ
		$threadtable = !empty($_G['forum']['threadtableid']) ? "forum_thread_{$_G['forum']['threadtableid']}" : 'forum_thread';
		$tinfo = DB::fetch_first("SELECT tid,authorid FROM " . DB::table($threadtable) . " t WHERE tid={$tid} AND displayorder>=0 " . getSlaveID());
		if(!$tinfo || $tinfo['authorid'] != $uid){
			encodeData(array('error' => true, 'errorinfo' => "ָ�������ⲻ���ڻ��ѱ�ɾ�������ڱ���ˣ��뷵�ء�"));
		}
		$posttableid   = $_G['forum_thread']['posttableid'];
		$posttable 	   = $posttableid ? "forum_post_$posttableid" : 'forum_post';
		$postinfo = DB::fetch_first("SELECT p.tid, p.fid, p.message, p.subject FROM ".DB::table($posttable)." p WHERE p.tid={$tid} and first=1 ".getSlaveID());
		$postinfo = $this->_getMessageText($postinfo);

		$returnData['post'] = $postinfo;
		encodeData($returnData);
	}

	//�õ������е��ı�
	function _getMessageText($post) {
		$post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $post['message']);
		$post['message'] = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $post['message']);//���������ʾ��font��ǩ
		$post['message'] = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $post['message']);
		$post['message'] = preg_replace('/���������.*�༭/isU', '', $post['message']);//���������...�༭
		$post['message'] = strip_tags($post['message']);
		$post['message'] = preg_replace('/\s|&nbsp;/', '', $post['message']);
		return $post;
	}

	function _updateviews($threadtable) {
		global $_G;

		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6381);

		if($myredis->connected){
			$myredis->obj->hincrby('viewthread_number',$_G['tid'],1);
		}else{
			DB::query("UPDATE LOW_PRIORITY ".DB::table($threadtable)." SET views=views+1 WHERE tid='$_G[tid]'", 'UNBUFFERED');
		}
	}

	//���ı��е�ͼƬ���н��ʴ���
	function _dealTextPic($content) {
		/*�˴�ʹ������ֱ���滻����ʹ��ѭ����������滻������Ч��*/
		$content = preg_replace("/<img.*src=[\"|'](.[^>]*)[\"|'].*>/iseU", "\$this->_replace_image('\\1')", $content);
		return $content;
	}

	/**
	 * @todo �������������滻ͼƬ���ʵĺ���
	 * @author JiangHong
	 * @param String $imgsrc ͼƬ��ַ
	 * @return String
	 */
	function _replace_image($imgsrc){
		global $_G;

		/*����ͼƬ��ַ����ĺ�׺#*/
		if(($pos = stripos($imgsrc, "#")) !== false){
			$imgsrc = substr($imgsrc, 0, $pos);
		}
		$smileClass = "";
		$imgsrc 	= str_replace($_G['config']['web']['attach'], "", $imgsrc);

		if (preg_match("#http://.*\.(com|cn|org|net).*#is", $imgsrc) && !preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)) {
		} elseif (strrpos($imgsrc, "static/") === false) {
			$imgsrc = str_replace('image.', 'image1.', $imgsrc);
			if(!preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)){
				$imgsrc = 'http://'.$_G['config']['cdn']['images']['cdnurl'].'/'.$imgsrc;
			}
			if(($pos2 = strrpos($imgsrc, '!')) !== false){
				$imgsrc = substr($imgsrc, 0, $pos2);
			}
			$imgsrc .= '!wap';
		} else {
			$imgsrc = $_G["config"]['web']['portal'].$imgsrc;
			$smileClass = "smile";
		}

		return "<img src='{$imgsrc}' width='100%' />";
	}

	//�������е�ͼƬ���н��ʴ���
	function _dealThreadPic($content, $wh = '0') {
		/*�˴�ʹ������ֱ���滻����ʹ��ѭ����������滻������Ч��*/
		$content = preg_replace("/<img.*src=[\"|'](.[^>]*)[\"|'].*id=[\"|'](.[^>]*)[\"|'].*>/iseU", "\$this->_replace_post_image('\\1', '\\2', '$wh')", $content);
		return $content;
	}

	//���������������滻ͼƬ���ʵĺ���
	function _replace_post_image($imgsrc, $id, $wh){
		global $_G;
		if (preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)) {
			if(($pos2 = strrpos($imgsrc, '!')) !== false){
				$imgsrc = substr($imgsrc, 0, $pos2);
			}
			$imgsrc .= '!wap';
			return "<img src='{$imgsrc}' width='100%' id='{$id}' />";
		} else {
			//ͼƬ�ߴ�Ĵ���
			if ($wh) {
				list($width, $height) = explode(",", $wh);
				$imgsrc = getimagethumb($width, $height , 2, str_replace($_G['config']['web']['attach'], "", $imgsrc));
			} else {
				//����ѡ��ԭͼ����ͼƬ����,��һ������������ֵ,�ڶ�������Ϊ0,����������Ϊ5
				$imgsrc = getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, str_replace($_G['config']['web']['attach'], "", $imgsrc));
			}

			return "<img src='{$imgsrc}' width='100%' id='{$id}' />";
		}
	}


}
?>
