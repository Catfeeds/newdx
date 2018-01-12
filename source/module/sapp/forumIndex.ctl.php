<?php

if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ForumIndexCtl extends FrontendCtl{

	function __construct()
	{
		parent::__construct();
		require_once libfile('function/forumlist');
	}


	function index()
	{
		global $_G;

		$page = max($_GET['page'], 1);
		$perpage = 20;
		$start 	 = ($page - 1) * $perpage;

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

		!is_array($weightList) && $weightList = array();
		foreach ($weightList as $k=>$v) {
			if($hotThreadList[$k]['forbid'] == 1){
				unset($weightList[$k]);
				continue;
			}
			$weightList[$k] = $hotThreadList[$k];
		}

		$weightList = $this->tuijian() + $weightList;
		$weightList = array_slice($weightList, $start, $perpage, true);

		if(!empty($weightList)) {
			foreach ($weightList as $k=>$v) {
				unset($weightList[$k]['message']);
				//�б�ͼƬ����ɴ�����
				if($weightList[$k]['imgList']) {
					foreach ($weightList[$k]['imgList'] as $ik => $iv) {
						$weightList[$k]['imgList'][$ik] = $this->_matchimg($iv);
					}
				}
				$weightList[$k]['views'] += get_redis_views($v['tid'],'viewthread');
			}

			$returnData = array_values($weightList);
		}else{
			$returnData = array('error'=>true , 'errorinfo'=>"û�и�����");
		}

		encodeData($returnData);
	}

    //��̳��ҳ�����б�--�ο�module/forum/forum_index.php��module/forum/forum_forumdisplay.php
    function forum()
    {
        global $_G;

        $memKey = 'cache_sapp_catList_nofid';

        if (!$catList = memory('get', $memKey)) {
        	//��÷����б�
        	extract($this->_getCatList());
        	$catList = array_values($catList);
        	memory('set', $memKey, $catList, 3600*5);

    	}

        $returnData["catList"] 					= $catList;

        encodeData($returnData);
    }

    //���������˵���
    function nav()
    {
    	$returnData["navList"] = array(
    		0 => array('fid' => '12', 'name' => '�������'),
    		1 => array('fid' => '161', 'name' => 'AA��Լ'),
    		2 => array('fid' => '52', 'name' => '�μǹ���'),
    		3 => array('fid' => '39', 'name' => '������Ӱ'),
    		4 => array('fid' => '7', 'name' => 'װ������'),
    		5 => array('fid' => '88', 'name' => '��������'),
    		6 => array('fid' => '24', 'name' => 'ɽ���Ⱥ'),
    		7 => array('fid' => '135', 'name' => '����|̽��|����')
    	);

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
					//$catList[$forum['fup']]['forumsname'][$forum['fid']] = $forum['name'];
					$catList[$forum['fup']]['forumslist'][] = $forum;
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
				$imgList[] = "{$info['pic']}!{$suffix}";
				$i++;
				if ($i == $max)
					break;
			}
		}
		return $imgList;
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

	//ƥ���ͼƬԭʼ����
	function _matchimg($html) {
		preg_match('/<img.+?file=\'(.+?)\'.+?>/', $html, $s);
		return $s[1];
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
			// memory('set', $memKey, $recommendList, 3600 * 5); //С������ͼƬ����ʽ��wap�治ͬ���ʴ˴�����������
		}
		return $recommendList;
	}

}
?>
