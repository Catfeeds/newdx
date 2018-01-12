<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ForumIndexCtl extends FrontendCtl{

	function __construct()
	{
		parent::__construct();
	}

	//��̳��ҳ�����б�--�ο�module/forum/forum_index.php��module/forum/forum_forumdisplay.php
	function index()
	{
		global $_G;
		global $returnData;

		//��������--��,Դ��source/include/misc/misc_ranklist_thread.php
		$memKey 		= 'cache_mobile_zxrt_list';
		$memKeyWeight 	= 'cache_mobile_zxrt_weight_list';

		//����mencache�ѵ��ڣ������»���
//		memory('rm', $memKey);
//		memory('rm', $memKeyWeight);
		if (!$hotThreadList = memory('get', $memKey)) {
			$result = $this->_getHotList();
			$hotThreadList  = $result['hotThreadList'];
			$weightList		= $result['weightList'];
			memory('set', $memKey, $hotThreadList, 3600*5);
			memory('set', $memKeyWeight, $weightList, 3600*5);
		} else {
			$weightList = memory('get', $memKeyWeight);
		}

		$weightList = array_slice($weightList, 0, 20, true);
		foreach ($weightList as $k=>$v) {
			if($hotThreadList[$k]['forbid'] == 1){
				unset($weightList[$k]);
				continue;
			}
			$weightList[$k] = $hotThreadList[$k];
		}
		!is_array($weightList) && $weightList = array();
		$weightList = $this->tuijian() + $weightList;

		//��÷����б�
		extract($this->_getCatList());

		//����ip�ҵ��ط�����̳��fid
		$forumOption = $_G['obj_forumOption'];
		unset($_G['obj_forumOption']);
		$ip = $_G["clientip"];
//		$ip = "111.160.216.2";

		$state = $forumOption->getStateByIp($ip);
		$state = !$state ? '���' : $state;
		$forum = memory('get' ,'cache_forum_forumlike_'.md5($state));
		if(!$forum){
			$forum = DB::fetch_first("SELECT * FROM ".DB::table('forum_forum')." WHERE fup = 76 AND name LIKE '%$state'");
			memory('set' ,'cache_forum_forumlike_'.md5($state) ,$forum ,3600);
		}

		//SEO
		$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['forum']);
		if(!$navtitle) {
			$navtitle = $_G['setting']['navs'][2]['navname'];
		}
		$metadescription = $_G['setting']['seodescription']['forum'] ? $_G['setting']['seodescription']['forum'] : $navtitle;
		$metakeywords    = $_G['setting']['seokeywords']['forum'] ? $_G['setting']['seokeywords']['forum'] : $navtitle;

		$returnData["catList"] 					= $catList;
		$returnData["forumList"]				= $forumList;
		$returnData["ipFid"]				    = $forum['fid'];
		$returnData["weightList"] 	 			= $weightList;
		$returnData["metakeywords"] 			= $metakeywords;
		$returnData["metadescription"] 			= $metadescription;

		encodeData($returnData);
	}

	//��÷����б�--�ο�module/forum/forum_index.php��module/forum/forum_forumdisplay.php
	function _getCatList() {
		$catList 	= array();
		$forumList  = array();

		$sql = "SELECT f.fid, f.fup as ofup, f.nfup as fup, f.type, f.name, f.threads, f.posts, f.todayposts, f.lastpost, f.inheritedmod, f.domain, f.forumcolumns, f.simple, ff.description, ff.moderators, ff.icon, ff.viewperm, ff.redirect, ff.extra FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff USING(fid) WHERE f.status='1' ORDER BY f.type, f.ndisplayorder";

		$query = DB::query($sql);
		while($forum = DB::fetch($query)) {
			$forum['name'] = str_replace(array('��', '��', '��-A', '��-B', '��-C', '��-D', '��-E', '��-F', '��-G', '��-H', '��-I', '��-J', '��-K', '��-L', '��-M', '��-N', '��-O', '��-P', '��-Q', '��-R', '��-S', '��-T', '��-U', '��-V', '��-W', '��-X', '��-Y', '��-Z'), '', $forum['name']);

			$forum['name']  = strip_tags($forum['name']);
			$forum['extra'] = unserialize($forum['extra']);
			if(!is_array($forum['extra'])) {
				$forum['extra'] = array();
			}
			if($forum['type'] != 'group') {
				if($forum['type'] == 'forum' && isset($catList[$forum['fup']])) {
					$catList[$forum['fup']]['forums'][] = $forum['fid'];
					$forum['orderid']   = $catList[$forum['fup']]['forumscount']++;
					$forum['subforums'] = '';
				}
			} else {
				$forum['forumscount'] 	= 0;
				$catList[$forum['fid']] = $forum;
			}
			$forumList[$forum['fid']] = $forum;
		}
		foreach($catList as $catid => $category) {
			if(empty($category['forumscount'])) {
				unset($catList[$catid]);
			}
		}
		return array("catList"=>$catList, "forumList"=>$forumList);
	}

	//������ӵ�����--��,Դ��source/module/misc/misc_ranklist.php
	function _getranklist_threads($num = 20, $dateline = 0, $orderby = 'replies', $forbid = array()) {
		$dateline = !$dateline ? TIMESTAMP - 86400 * 30 : $dateline;
		$threadlist = array();

		require_once libfile('function/space');
		$dianpingFids = getdianpingfids();
		$notfids = implode(',', array_merge($dianpingFids, array(161,5,53,489,185)));

		//�������� ��Ҫ�Ǽ��㱾����Ҫ��ѯ���������ݣ�$num��
		$query1 = DB::query("SELECT t.tid
				FROM " . DB::table('forum_thread') . " t
				LEFT JOIN " . DB::table('forum_forum') . " f USING(fid)
				WHERE t.dateline>='$dateline' AND t.displayorder>='0' and f.fup not in(36) and t.fid not in({$notfids})
				ORDER BY t.$orderby desc
				LIMIT 0, $num" . getSlaveID());
		while ($thread = DB::fetch($query1)) {
			isset($forbid[$thread['tid']]) && $num++;
		}

		$query = DB::query("SELECT t.tid, t.fid, t.author, t.authorid, t.subject, t.dateline, t.views, t.replies, t.favtimes, t.sharetimes, t.typeid, f.name AS forum
			FROM ".DB::table('forum_thread')." t
			LEFT JOIN ".DB::table('forum_forum')." f USING(fid)
			WHERE t.dateline>='$dateline' AND t.displayorder>='0' and f.fup not in(36) and t.fid not in({$notfids})
			ORDER BY t.$orderby desc
			LIMIT 0, $num". getSlaveID());
		$rank = 0;
		while($thread = DB::fetch($query)) {
			++$rank;
			$thread['rank'] = $rank;
			$thread['dateline'] = dgmdate($thread['dateline']);
			$thread['forbid'] = 0; //Ĭ��ֵ
			isset($forbid[$thread['tid']]) && $thread['forbid'] = 1;
			$threadlist[] = $thread;
		}
		return $threadlist;
	}

	//���������б�
	function _getHotList() {
		global $_G;

		$ranklist_setting = $_G['setting']['ranklist'];
		if(!$ranklist_setting['status']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'ranklist_status_off')));
		}

		$type = 'thread';

		if(!$ranklist_setting[$type]['available']) {
			encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'ranklist_this_status_off')));
		}

		$cache_time = $ranklist_setting[$type]['cache_time'];
		$cache_num  =  $ranklist_setting[$type]['show_num'];
		if($cache_time <=0 ) $cache_time = 5;
		$cache_time = $cache_time * 3600;
		if($cache_num <=0 ) $cache_num = 20;

		$hotThreadList 	= array();
		$_hotThreadList	= array();
		$before			= 604800;
		$orderby  		= array('replies','views','favtimes');
		$dateline 		= !empty($before) ? TIMESTAMP - $before : 0;
		$replyCnt		= 0;
		$viewCnt		= 0;
		$favCnt			= 0;
		$arrUpdate		= array();
		$weightList		= array();
		$tids			= array();
		$postList		= array();

		//�����б� ���²�ѯ����tid����������չʾ ��ѯ�����б�-��ѯ��������-ɸѡӦ��������-�ٴ�ɸѡ����-�趨���α��-������
		$rows = DB::query("SELECT tid FROM " . DB::table('common_forum_recommend_wap') . " where optype = 2" . getSlaveID());
		while ($row = DB::fetch($rows)) {
			$forbid[$row['tid']] = $row['tid'];
		}

		$ranklistvars = array();
		loadcache('ranklist_thread');

		foreach ($orderby as $v) {
			$ranklistvars = & $_G['cache']['ranklist_thread']['thisweek_'.$v];
			if(!empty($ranklistvars['lastupdated']) && TIMESTAMP - $ranklistvars['lastupdated'] < $cache_time) {
				$_hotThreadList[$v] = $ranklistvars;
			} else {
				$ranklistvars = $this->_getranklist_threads($cache_num, $dateline, $v, $forbid);
				$ranklistvars['lastupdated'] = TIMESTAMP;
				$ranklistvars['lastupdate']  = dgmdate(TIMESTAMP);
				$ranklistvars['nextupdate']  = dgmdate(TIMESTAMP + $cache_time);
				$_G['cache']['ranklist_thread']['thisweek_'.$v] = $ranklistvars;
				save_syscache('ranklist_thread', $_G['cache']['ranklist_thread']);
			}

			$arrUpdate[$v] = $ranklistvars['lastupdated'];
			unset($ranklistvars['lastupdated'], $ranklistvars['lastupdate'], $ranklistvars['nextupdate']);
			$_hotThreadList[$v] = $ranklistvars;
		}

		//���������ݽ�����������ܻظ�����������������ղ���
		require_once libfile('function/forumlist');
		foreach ($_hotThreadList as $key=>$val) {
			foreach ($val as $v) {
				if ($key == 'replies') {
					$replyCnt += $v['replies'];
				} elseif($key == 'views') {
					$viewCnt += $v['views'];
				} elseif($key == 'favtimes') {
					$favCnt += $v['favtimes'];
				}
				if (isset($hotThreadList[$v['tid']])) {
					$hotThreadList[$v['tid']]['lastupdated'] = max($hotThreadList[$v['tid']]['lastupdated'], $arrUpdate[$key]);
					continue;
				}
				$v['lastupdated'] = $arrUpdate[$key];
				$hotThreadList[$v['tid']] = $v;
				$tids[$v['tid']] = $v['tid'];
			}
		}

		//���ͷ������
		if ($tids) {
			$tids  = implode(',', $tids);
			$query = DB::query("SELECT * FROM ".DB::table('forum_post')." p WHERE p.first=1 and p.tid in ({$tids})". getSlaveID());
			while($v = DB::fetch($query)) {
				$v['typeid'] = !empty($hotThreadList[$v['tid']]['typeid']) ? $hotThreadList[$v['tid']]['typeid'] : 0;
				$postList[$v['tid']] = $this->_viewthread_procpost($v);
			}
		}

		//����Ȩ�ؼ���
		$replyCnt 	= max($replyCnt, 1);
		$viewCnt 	= max($viewCnt, 1);
		$favCnt 	= max($favCnt, 1);
		$r_v		= $replyCnt / $viewCnt;
		$r_f		= $replyCnt / $favCnt;
		foreach ($hotThreadList as $k=>$v) {
			$v['dateline'] = strtotime($v['dateline']);
			$t = ($v['lastupdated'] - $v['dateline']) / 3600;
			$v['weight']  = ($v['replies'] + $v['views']*$r_v + $v['favtimes']*$r_f) / $t;
			$v['message'] = !empty($postList[$v['tid']]['message']) ? $postList[$v['tid']]['message'] : '';
			$v['imgList'] = !empty($postList[$v['tid']]['imgList']) ? $postList[$v['tid']]['imgList'] : array();
			unset($v['lastupdated'], $v['rank']);
			$hotThreadList[$k] = $v;
			$weightList[$v['tid']] = $v['weight'];
			if($v['fid'] == 53) { unset($hotThreadList[$v['tid']], $weightList[$v['tid']]); }	//���˵�װ�����װ�����
		}
		arsort($weightList);

		return array('hotThreadList'=>$hotThreadList,'weightList'=>$weightList);

	}

	//������ʾ���ݵĸ�ʽ��,������Ҫ�����Ķ�--�ο�module/forum/forum_viewthread.php
	function _viewthread_procpost($post) {
		global $_G;

		require_once libfile('function/discuzcode');
		require_once libfile('function/attachment');

		$post['attachments'] = array();
		$post['imagelist'] = $post['attachlist'] = '';

		//ֻ������ͼƬ������
		$post['message'] = preg_replace("/\[swf\]\s*([^\[\<\r\n]+?)\s*\[\/swf\]/ies", "", $post['message']);
		$post['message'] = preg_replace("/\[media=([\w,]+)\]\s*([^\[\<\r\n]+?)\s*\[\/media\]/ies", "", $post['message']);

		$post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], $post['htmlon'] & 1, 0, 1, 1, 1, 0, 0, $post['authorid'], 1, $post['pid']);

		//������Ӱ-ÿ��һͼ,�����һ���-Ů¿��
		if ($post['fid'] == 39 || $post['fid'] == 443 || ($post['fid'] == 56 && $post['typeid'] == 77)) {
			$post['imgList'] = $this->_getMessageImage2($post['tid'], 1);
			$post['message'] = '';
		} else {
			$message = $this->_getMessageText($post);
			$post['imgList'] = $this->_getMessageImage2($post['tid'], 3);
			$post['message'] = $message;
		}
		return array('message'=>$post['message'],'imgList'=>$post['imgList']);
	}

	//�õ����������е�ͼƬ gtl �°�
	function _getMessageImage2($tid, $max = 1){
		global $_G;
		$imgList = array();
		$result = DB::fetch_first("SELECT tid, image FROM " . DB::table('forum_post_previewimg') . " WHERE tid = $tid" . getSlaveID());
		if($result){
			$pic = json_decode($result['image'], true);
			$suffix = "wapw320h0";
			$i = 0;
			foreach ($pic as $info) {
				//$imgList[] = _replace_post_image($info['pic'], $tid, $wh);
				$imgList[] = "<img file='{$info['pic']}!{$suffix}' id='{$tid}' class='lazy' data-original='{$info['pic']}!{$suffix}'/>";
				$i++;
				if ($i == $max)
					break;
			}
		}
		return $imgList;
	}

	//�õ����������е�ͼƬ lishuaioquan �ɰ�
	function _getMessageImage($post, $max = 1, $wh) {
		preg_match_all("/\[attach\](\d+)\[\/attach\]/isU", $post['message'], $matA);
		if ($matA[0][0]) {
			$index = 0;
			foreach ($matA[0] as $k=>$v) {
				$post['message'] = $matA[0][$k];
				$postList = array($post['pid']=>$post);
				parseattach($post['pid'], array($post['pid']=>array($matA[1][$k])), $postList);
				$temp = $postList[$post['pid']]['message'];
				$temp = preg_replace("/<div.*>.*<\/div>/is", '', $temp);
				$temp = dealThreadPic($temp, $wh);
				//����ϵͳͼƬ
				if (strrpos($temp, 'data-original') === false) {continue;}
				$post['imgList'][$k] = $temp;
				$index++;
				if ($index == $max) {break;}
			}
		}
		return $post['imgList'];
	}

	//�õ������е��ı�
	function _getMessageText($post) {
		$post['message'] = preg_replace("/\[attach\](\d+)\[\/attach\]/i", '', $post['message']);
		$post['message'] = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $post['message']);//���������ʾ��font��ǩ
		$post['message'] = preg_replace('/���ص�ַ�ظ��ɼ�.*<\/p>/isU', '</p>', $post['message']);
		$post['message'] = preg_replace('/���������.*�༭/isU', '', $post['message']);//���������...�༭
		$post['message'] = strip_tags($post['message']);
		$post['message'] = preg_replace('/\s|&nbsp;/', '', $post['message']);
		return $post['message'];
	}

	//��ȡ�˵�
	function getNav(){
		global $_G;
		global $returnData;

		//��÷����б�
		extract($this->_getCatList());

		//SEO
		$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['forum']);
		if(!$navtitle) {
			$navtitle = $_G['setting']['navs'][2]['navname'];
		}
		$metadescription = $_G['setting']['seodescription']['forum'] ? $_G['setting']['seodescription']['forum'] : $navtitle;
		$metakeywords    = $_G['setting']['seokeywords']['forum'] ? $_G['setting']['seokeywords']['forum'] : $navtitle;

		$returnData["catList"] 					= $catList;
		$returnData["forumList"]				= $forumList;
		$returnData["metakeywords"] 			= $metakeywords;
		$returnData["metadescription"] 			= $metadescription;

		encodeData($returnData);
	}

	//��ȡ�Ѿ����ڵĲ˵�
	function getSubscibe(){
		global $_G;
		global $returnData;

		$uid	= $_G['uid'];
		$nav	= array();

		//������֤
		if (!$uid) {
			encodeData(array('error' => true, 'errorinfo' => "���¼"));
		}

		$sql = "SELECT nav from pre_common_mobile_user_nav where uid = $uid";
		$userinfo = DB::fetch_first($sql);

		if(!$userinfo){
			/*//��ʼ��
			$allinfo = $this->_navlist();
			foreach ($allinfo as $fid => $info) {
				if($info['fup'] == 38 || $info['fup'] == 67){
					$nav[$fid] = $info;
				}
			}
			$insert = array(
				'uid' => $uid,
				'nav' => serialize($nav)
			);
			$result = DB::insert('common_mobile_user_nav', $insert);*/
		}elseif(!empty($userinfo['nav'])){
			$nav = unserialize($userinfo['nav']);
		}

		$returnData["nav"]	= $nav;

		encodeData($returnData);
	}

	//��Ӳ˵�(����)
	function addnav() {
		global $_G;
		global $returnData;

		$fid	= $_G['gp_fid'];
		$uid	= $_G['uid'];
		$tempForum = array();

		//������֤
		if (!$fid || !$uid) {
			encodeData(array('error' => true, 'errorinfo' => "���¼"));
		}

		//��֤����ȡ������Ϣ
		$allinfo = $this->_navlist();
		if(!isset($allinfo[$fid])){
			encodeData(array('error' => true, 'errorinfo' => "��鲻���ڻ��Ѿ��ر�"));
		}
		$tempForum = $allinfo[$fid];

		//�Ƿ��Ѿ�����
		$sql = "SELECT nav from pre_common_mobile_user_nav where uid = $uid";
		$userinfo = DB::fetch_first($sql);
		if (!$userinfo) {
			$nav = array(
				$fid => array(
					'fup'  => $tempForum['fup'],
					'extra' => array('localname' => $tempForum['extra']['localname']),
					'name' => addslashes(dhtmlspecialchars($tempForum['name'])),
					'icon' => $tempForum['icon'],
					'url'  => $tempForum["url"]
				)
			);
			$insert = array(
				'uid' => $uid,
				'nav' => serialize($nav)
			);
			$result = DB::insert('common_mobile_user_nav', $insert);
		} else {
			$nav = unserialize($userinfo['nav']);
			$tmp[$fid] = array(
				'fup'  => $tempForum['fup'],
				'extra' => array('localname' => $tempForum['extra']['localname']),
				'name' => addslashes(dhtmlspecialchars($tempForum['name'])),
				'icon' => $tempForum['icon'],
				'url'  => $tempForum["url"]
			);
			$nav = $tmp + $nav;
			$result = DB::update('common_mobile_user_nav', array('nav' => serialize($nav)), "uid=$uid");
		}

		if($result){
			encodeData(array('msg' => '1', 'info' => '���ĳɹ�'));
		}
		encodeData(array('error' => true, 'errorinfo' => "����ʧ��"));
	}

	//ɾ���˵�(ȡ������)
	function removenav(){
		global $_G;
		global $returnData;

		$fid	= $_G['gp_fid'];
		$uid	= $_G['uid'];

		//������֤
		if (!$fid || !$uid) {
			encodeData(array('error' => true, 'errorinfo' => "���¼"));
		}

		//�Ƿ��Ѿ�����
		$sql = "SELECT nav from pre_common_mobile_user_nav where uid = $uid";
		$userinfo = DB::fetch_first($sql);
		if ($userinfo) {
			$nav = unserialize($userinfo['nav']);
			unset($nav[$fid]);
			$result = DB::update('common_mobile_user_nav', array('nav' => serialize($nav)), "uid=$uid");
			if(!$result){
				encodeData(array('error' => true, 'errorinfo' => "ȡ������ʧ��"));
			}
		}
		encodeData(array('msg' => '2', 'info' => 'ȡ���ɹ�'));
	}

	//��ȡ�Ѿ����õİ����Ϣ����
	function navlist(){
		global $_G;
		global $returnData;

		$returnData["allinfo"]	= $this->_navlist();
		encodeData($returnData);
	}

	//��ȡ�Ѿ����õİ����Ϣ����
	function _navlist(){
		global $_G;
		global $returnData;
		$allinfo = array();

		extract($this->_getCatList());
		$forumoptionList = $returnData['forumoptionList'];
		$noCycleCateList = array("490"=>"װ����","408"=>"����Ʒ�����а�","493"=>"¿���̳�","467"=>"�۷���Ӽ�԰","43"=>"��������","42"=>"��Ƶ|����"); //�����Ų���
		$otherCateList   = array("180"=>"����װ��","35"=>"����¿;","36"=>"��������"); //�����Ų���
		$otherFirstList  = array("483"=>"�һ���Ʒ","185"=>"¿�з���");
		if($catList){
			foreach($catList as $val){
				if (isset($otherCateList[$val['fid']]))
					continue;
				foreach ($val["forums"] as $fid) {
					if(isset($noCycleCateList[$fid])) continue;
					$allinfo[$fid] = array(
						'fup' => $val['fid'],
						'extra' => array('localname' => $forumList[$fid]['extra']['localname']),
						'name' => $forumList[$fid]['name'],
						'icon' => $forumList[$fid]['icon'],
						'url'  => $forumList[$fid]["redirect"] ? $forumList[$fid]["redirect"] : (!empty($forumoptionList[$fid]) ? "d=forum&c=thread&m=showList&fid={$fid}&filter=digest&orderby=lastpost&typeid=0&digest=1&specialtype=&page=1" : "d=forum&c=thread&m=showList&fid={$fid}&page=1")
					);
				}
				unset($catList[$val['fid']]);
			}
			foreach ($otherFirstList as $fid => $something) {
				if(isset($noCycleCateList[$fid])) continue;
				$allinfo[$fid] = array(
					'fup' => -1,
					'extra' => array('localname' => ''),
					'name' => $forumList[$fid]['name'],
					'icon' => $forumList[$fid]['icon'],
					'url' => $forumList[$fid]["redirect"] ? $forumList[$fid]["redirect"] : (!empty($forumoptionList[$fid]) ? "d=forum&c=thread&m=showList&fid={$fid}&filter=digest&orderby=lastpost&typeid=0&digest=1&specialtype=&page=1" : "d=forum&c=thread&m=showList&fid={$fid}&page=1")
				);
			}
			foreach ($catList as $val) {
				foreach ($val["forums"] as $fid) {
					if (isset($noCycleCateList[$fid]) || isset($otherFirstList[$fid]))
						continue;
					$allinfo[$fid] = array(
						'fup' => $val['fid'],
						'extra' => array('localname' => $forumList[$fid]['extra']['localname']),
						'name' => $forumList[$fid]['name'],
						'icon' => $forumList[$fid]['icon'],
						'url' => $forumList[$fid]["redirect"] ? $forumList[$fid]["redirect"] : (!empty($forumoptionList[$fid]) ? "d=forum&c=thread&m=showList&fid={$fid}&filter=digest&orderby=lastpost&typeid=0&digest=1&specialtype=&page=1" : "d=forum&c=thread&m=showList&fid={$fid}&page=1")
					);
				}
			}
		}
		return $allinfo;
	}

	//��ȡ�����Ƽ�
	function tuijian() {
		$memKey = "cache_mobile_zxrt_tj_list";
		//memory('rm', $memKey);
		if (!$recommendList = memory('get', $memKey)) {
			$recommendList = array();

			$rows = DB::query("SELECT tid FROM " . DB::table('common_forum_recommend_wap') . ' where optype = 1' . getSlaveID());
			while ($row = DB::fetch($rows)) {
				$dbtids[] = $row['tid'];
			}
			if (!empty($dbtids)) {
				$wheresql = implode(",", $dbtids);
				$query = DB::query("SELECT t.tid, t.fid, t.author, t.authorid, t.subject, t.dateline, t.views, t.replies, t.favtimes, t.sharetimes, t.typeid, f.fup, f.name AS forum
				FROM " . DB::table('forum_thread') . " t
				LEFT JOIN " . DB::table('forum_forum') . " f USING(fid)
				WHERE t.tid in ({$wheresql})
				ORDER BY FIND_IN_SET(t.tid, '{$wheresql}') " . getSlaveID());
				while ($thread = DB::fetch($query)) {
					$recommendList[$thread['tid']] = $thread;
					$tids[] = $thread['tid'];
				}
			}

			//���ͷ������
			if ($tids) {
				$tids = implode(',', $tids);
				$query = DB::query("SELECT * FROM " . DB::table('forum_post') . " p WHERE p.first=1 and p.tid in ({$tids})" . getSlaveID());
				while ($v = DB::fetch($query)) {
					$v['typeid'] = !empty($recommendList[$v['tid']]['typeid']) ? $recommendList[$v['tid']]['typeid'] : 0;
					$postList[$v['tid']] = $this->_viewthread_procpost($v);
				}
			}
			if (!empty($recommendList)) {
				foreach ($recommendList as $k => $v) {
					$v['dateline'] = strtotime($v['dateline']);
					$v['message'] = !empty($postList[$v['tid']]['message']) ? $postList[$v['tid']]['message'] : '';
					$v['imgList'] = !empty($postList[$v['tid']]['imgList']) ? $postList[$v['tid']]['imgList'] : array();
					$v['poitype'] = 1; //�����ı�� �������Ƽ�
					$v['forbid'] = 0; //�Ƿ����� 0 չʾ 1����
					$recommendList[$k] = $v;
				}
			}
			memory('set', $memKey, $recommendList, 3600 * 5);
		}
		return $recommendList;
	}

}
?>
