<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class MountainCtl extends DianpingCtl{
	var $modname = 'mountain';
	/**
	 * 显示发布页--参考forum.base.php相应方法
	 * @author LiShuaiquan
	 */
	function _newpost($data)
	{
		global $_G;
		//用来检查积分限制的
		checklowerlimit('post', 0, 1, $this->mod->_fid);
		$data = array_merge($data, $this->_getGlobalArgs('post'));
		$_G['fid'] =  $this->mod->_fid;
		if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			//表单
			$data['url']		= $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action']		= 'new';
			$data['typelist']	= $this->mod->typelist;
			$data['timelist'] 	= $this->mod->timelist;

			// 初始化编辑器相关设置
			$data['editorid'] = 'e';
			$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
			$data['editor'] = array(
					'editormode' => $_G['setting']['editoroptions']{0},
					'allowswitcheditor' => $_G['setting']['editoroptions']{1},
					'allowhtml' => 1,
					'allowsmilies' => 0,
					'allowbbcode' => 1,
					'allowimgcode' => 1,
					'allowresize' => 1,
					'textarea' => 'message',
					'simplemode' => !isset($_G['cookie']['editormode_'.$data['editorid']]) ? 1 : $_G['cookie']['editormode_'.$data['editorid']],
			);


			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				require_once libfile('function/post');
				$data['attachlist'] = getattach(0);
				$data['attachs']  	= $data['attachlist']['attachs'];
				$data['imgattachs'] = $data['attachlist']['imgattachs'];
				unset($data['attachlist']);

				//个人相册加载
				$albumlist = array();
				if($_G['uid']) {
					$query = DB::query("SELECT albumid, albumname, picnum FROM ".DB::table('home_album')." WHERE uid='$_G[uid]' ORDER BY updatetime DESC");
					while($value = DB::fetch($query)) {
						if($value['picnum']) {
							$albumlist[] = $value;
						}
					}
				}
				$data['albumlist'] = $albumlist;
			}

			//获得地区
			$data['dqlist']		= $this->mod->dqlist;
			$data['gdqjlist'] 	= $this->mod->gdqjlist;

			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {

			//提交
			$postdata 	  = array_merge($_GET, $_POST);

			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic')){
				$this->showmessage('model_need_pic');
			}

			//处理编辑器图片
			$new_img_edit = $_G['gp_attachnew'];
			if(preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $postdata['message'])){
				preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $postdata['message'], $matches);
				$send_img=$matches[2];
				foreach($new_img_edit as $key=>$descon){
					if(!in_array($key, $send_img)){
						unset($new_img_edit[$key]);
					}
				}
			}else{
				unset($new_img_edit);
			}
			$postdata['new_img_edit'] = $new_img_edit;
			$postdata['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $postdata['message']);
			foreach($postdata as $k => $v){
				if(in_array($k, array('subject','message','region','season'))){
					$postdata[$k] = trim(dhtmlspecialchars($postdata[$k]));
				}
			}

			$this->mod->dopost($postdata);
		}
	}




	/**
	 * 显示列表页--参考forum.base.php相应方法
	 * @author LiShuaiquan
	 */
	function showlist()
	{
		global $_G;
		$data	 	 = $this->_getGlobalArgs('list');
		$perpage 	 = max($this->mod->limit, 1);
		$page 	 	 = max(intval($_G['gp_page']), 1);
		$start   	 = ($page - 1) * $perpage;
		$data['url'] = $data['myurl'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";

		$pagestr = $htmlstate == 1 ? 'page-' : 'page=';
		$order = isset($_G['gp_order']) ? $_G['gp_order'] : 'lastpost';
		$data['url'] .= "&act=showlist";
		$data['url'] .= "&order={$order}";
		$data['order'] = $order;
		//获得条件
		$where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 ';
		//获得排序
		$desc = $_G['gp_desc'] === 0 ? 'ASC' : 'DESC';

		/*heats: order by the number of people give comments
		*newest: order by the lastest feedback to the mountain
		*score:
		*/

		//高度区间类型
		$gd   = !empty($_G['gp_gd']) ? intval($_G['gp_gd']) : 0;
		if(intval($_G['gp_gd'])){
			$where 		.= " and {$this->mod->alias}.{$this->mod->_vars['gdqj']} = {$gd}";
		}

		//地区筛选
		$dq   = !empty($_G['gp_dq']) ? intval($_G['gp_dq']) : 0;
		if(intval($_G['gp_dq'])){
			$where 		.= " and {$this->mod->alias}.{$this->mod->_vars['type']} = {$dq}";
		}
		$data['url'] .= "&dq={$dq}";
		$data['url'] .= "&gd={$gd}";
		$data['dqnum']=$dq;
		$data['gdnum']=$gd;

		//处理分页
		$max = $this->mod->getMaxCount($where);
		$realpages = @ceil($max / $perpage);

		//$where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 ';
		if ($max) {
			$data['multipage'] = multi($max, $perpage, $page, $data['url']);
			$data['list'] = $this->mod->getData(array(
					'tid',
					'name',
					'pic',
					'height',
					'serverid',
					'num'

				), $where, $order, $desc, $start, $perpage);
		}

		//最新发布列表
		//$data['listnew'] = $this->mod->getlist(array(
		//	'order' => array('dateline' => 'DESC'),
		//	'limit' => $this->mod->otherlimit
		//));

		$data['dqlist']		= $this->mod->dqlist;
		$data['gdqjlist'] 	= $this->mod->gdqjlist;

		//获得地区
		//$mdRegion = m('regions');
		//$data['regionsList']  = $mdRegion->getCity();
		//if ($data['city']) {
		//	$data['cityShow'] = $data['regionsList']['city'][$data['province']][$data['city']];
		//}

        /*新增页面title自定义 by lgt at 201408013*/
        if($dq||$gd){
            $data['titlediy']=$data['dqlist'][$dq].'地区海拔'.$data['gdqjlist'][$gd].'雪山资料查询和用户攀登经验分享';
            if($dq && $gd==0){$data['titlediy']=$data['dqlist'][$dq].'地区雪山资料查询和用户攀登经验分享';}
            if($dq==0 && $gd){$data['titlediy']='海拔'.$data['gdqjlist'][$gd].'雪山资料查询和用户攀登经验分享';}
            $data['pageTitle']=$data['titlediy'];
            $data['metakeywords']=$data['dqlist'][$dq].'海拔'.$data['gdqjlist'][$gd].'雪山';
            $data['metadescription']=$data['dqlist'][$dq].'地区海拔'.$data['gdqjlist'][$gd].'雪山资料查询和用户攀登经验分享，为登山爱好者攀登'.$data['dqlist'][$dq].'地区海拔'.$data['gdqjlist'][$gd].'的雪山提供帮助';
        }

		//精彩点评列表
		$mdForumPost = m('forum_post');
		$tids 		 = array();
		$data["jcdpList"] = $mdForumPost->find(array(
			'fields'     => 'f_p.pid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate',
			'conditions' => "f_p.fid={$this->mod->_fid} and f_p.first=0 and rate>0 " . getSlaveID(),
			'order'      => 'f_p.dateline DESC',
			'limit'      => 10
		),false);
		foreach ($data['jcdpList'] as $k=>$v) {
			$data['jcdpList'][$k]['message'] = cutstr($v['message'], 170, '...');
			$tids[$v['tid']] = $v['tid'];
		}
		$tids = implode(',', $tids);
		if ($tids) {
			$mdForumThread = m('forum_thread');
			$data['titleList'] = $mdForumThread->find(array(
				'fields'     => 'tid,subject',
				'conditions' => "tid in ($tids) " . getSlaveID()
			));
		}

		$this->assign($data);
		$this->display($this->mod->template['list']);
	}


	/**
	 * 显示详细页--参考forum.base.php相应方法
	 * @author Lishuaiquan
	 */
	function showview()
	{
		global $_G;
		$data = $this->_getGlobalArgs('view');
		$tid  = intval($_G['gp_tid']);
		$page = max(1, $_G['gp_page']);
		if ($tid <= 0) {
			$this->showlist();
		} else {
			$data['url'] = $data['myurl'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$tid = trim($_GET['tid']);
			//获得页面信息
			$data['viewdata'] = $this->mod->getview($tid);
			if (empty($data['viewdata']))
				$this->showmessage('thread_nonexistence');
			$data['viewdata']['message'] = $this->mod->_messageHandle($data['viewdata']['message']);
			$data['piclist'] = $this->_getimgbytidpid($tid, $data['viewdata']['pid'], 'plugin', false, 5);
			/*增加初始时获得第一页的评论列表*/
			$page = max(1, $_G['gp_page']);
			$data['page'] = $page;
			$perpage =  max($this->mod->commentlimit, 1);
			$start = ($page - 1) * $perpage;
			$replyList = $this->mod->getComment($tid,$start);
			//判断楼层用户是否被点评过
			// 当前用户回复
			$mod_forum_post = m('forum_post');
			$data['my_comment'] = array();
			$data['my_comment'] = $mod_forum_post->get(array('conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}", 'join' => 'has_star'));
			if ($data['my_comment']) {
				if(date("Y-m-d",$data['my_comment']['ext1'])==date("Y-m-d",$data['my_comment']['ext2'])){
					$date=floor($data['my_comment']['ext2']-$data['my_comment']['ext1'])/3600;
					$data['my_comment']['time'] = $date."&nbsp;小时";
					$data['my_comment']['starHour'] = date('G',$data['my_comment']['ext1']);
					$data['my_comment']['endHour'] = date('G',$data['my_comment']['ext2']);

				}else{
					$date=floor($data['my_comment']['ext2']-$data['my_comment']['ext1'])/86400;
					$data['my_comment']['time'] = $date."&nbsp;天";
				}
				$data['my_comment']['ext1'] = date("Y-m-d",$data['my_comment']['ext1']);
				$data['my_comment']['ext2'] = date("Y-m-d",$data['my_comment']['ext2']);
				$data['my_comment']['ext3'] = $this->_set_br($data['my_comment']['ext3']);
				$data['my_comment']['ext4'] = $this->_set_br($data['my_comment']['ext4']);
				$data['my_comment']['message'] = $this->_set_br($data['my_comment']['message']);
				$data['my_comment']['rate'] =($data['my_comment']['rate']);
				$data['my_comment']['dateline'] = dgmdate($data['my_comment']['dateline'],'u');
				//$data['my_comment']['extdata'] = unserialize($data['my_comment']['extdata']);
			}
			$dianping = m('dianping');
// 			$data['scores'] = $dianping->getAllRate($tid);
			$data['myrate'] = max(intval($dianping->getMyRate($_G['uid'], $tid)), 0);
			$dianpingshow = m('dianpingshow');
			$data['star_data'] = $dianpingshow->getData($tid);


			//print_r($data['star_data']);exit;

			if (is_array($replyList)) {
				foreach ($replyList as $k => $v) {
					if($v['authorid'] == $_G['uid']){
						unset($replyList[$k]);continue;
					}else{
						$replyLists[$k]['pid'] = $v['pid'];
						$replyLists[$k]['starnum'] = $v['starnum'];
						$replyLists[$k]['supports'] = $v['supports'];
						$replyLists[$k]['goodpoint'] = $this->_set_br($v['goodpoint']);
						$replyLists[$k]['weakpoint'] = $this->_set_br($v['weakpoint']);
						$replyLists[$k]['author'] = $v['author'];
						$replyLists[$k]['authorid'] = $v['authorid'];
						$replyLists[$k]['message'] = $this->_set_br($v['message']);
						$replyLists[$k]['rate'] = $v['rate'];
						$replyLists[$k]['dateline'] = dgmdate($v['dateline'],'u');
						if(date("Y-m-d",$v['ext1'])==date("Y-m-d",$v['ext2'])){
							$date=floor($v['ext2']-$v['ext1'])/3600;
							$replyLists[$k]['time'] = $date."&nbsp;小时";
							$replyLists[$k]['starHour'] = date('G',$v['ext1']);
							$replyLists[$k]['endHour'] = date('G',$v['ext2']);
						}else{
							$date=ceil(($v['ext2']-$v['ext1'])/86400);
							$replyLists[$k]['time'] = $date."&nbsp;天";
						}
						$replyLists[$k]['ext1'] = date("Y-m-d",$v['ext1']);
						$replyLists[$k]['ext2'] = date("Y-m-d",$v['ext2']);
						$replyLists[$k]['ext3'] = $this->_set_br($v['ext3']);
						$replyLists[$k]['ext4'] = $this->_set_br($v['ext4']);
					}
				}
			}
			$multipage = multi($data['viewdata']['replies'], $perpage, $page, $data['url'] . "&act=showview&tid={$tid}");
			if ($_G['uid']) {
				$mod_dianping_support = m('dianpingsupport');
				$data['supportlist'] = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
			}
			$data['myreply'] = $myreply;
			$data['replylist'] = $replyLists;
			$data['replymulti'] = $multipage;


			$data['pageTitle']       = str_replace('[subject]', $data['viewdata']['subject'], $data['pageTitle']);
			$data['metakeywords'] 	 = str_replace('[subject]', $data['viewdata']['subject'], $data['metakeywords']);
			$data['metadescription'] = str_replace('[subject]', $data['viewdata']['subject'], $data['metadescription']);

			$data = array_merge($data, $this->mod->getPlugin('view', array_merge($data['viewdata'], $_GET)));
			/*
			$data['piclist'] = $this->_getimgbytidpid($tid, $data['viewdata']['pid'], 'plugin', false, 5);
			if (empty($data['piclist'])) {
				$data['piclist'][0]['attachment'] = $data['viewdata']['attachment'];
				$data['piclist'][0]['url'] = $_G['config']['web']['attach'] . 'plugin/';
			}*/
			$this->assign($data);
			$this->display($this->mod->template['view']);
		}
	}

	/**
	 * 显示编辑页--参考forum.base.php相应方法
	 * @author Lishuaiquan
	 */
	function _editpost($data)
	{
		global $_G;
		$tid = intval($_G['gp_tid']);
		$pid = intval($_G['gp_pid']);
		if ($pid <= 0 || $tid <= 0) {
			$this->showmessage('nopidandtid');
		}
		$data = $this->_getGlobalArgs('post');
		//print_r($data);exit;
		if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['pageTitle']  = str_replace('发布', '编辑', $data['pageTitle']);

			$data['editdata'] 	= $this->mod->getview($tid);
			$data['url'] 		= $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] 	= 'edit';

			//处理编辑器内容/图片
			$data['editdata']['message'] = dhtmlspecialchars($data['editdata']['message']);
			require_once libfile('function/post');
			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				$data['attachlist'] = getattach($pid);
				$data['attachs'] = $data['attachlist']['attachs'];
				$data['imgattachs'] = $data['attachlist']['imgattachs'];
				unset($data['attachlist']);
				$attachfind = $attachreplace = array();
				if(!empty($data['attachs']['used'])) {
					foreach($data['attachs']['used'] as $attach) {
						if($attach['isimage']) {
							$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
							$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
						}
					}
				}
				if(!empty($data['imgattachs']['used'])) {
					foreach($data['imgattachs']['used'] as $attach) {
						$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
						$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
					}
				}
				$attachfind && $data['editdata']['message'] = preg_replace($attachfind, $attachreplace, $data['editdata']['message']);
			}
			$data['imgattachs']['unused'] = !$sortid ? $data['imgattachs']['unused'] : '';

			// 初始化编辑器相关设置
			$data['editorid'] = 'e';
			$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
			$data['editor'] = array(
				'editormode' => $_G['setting']['editoroptions']{0},
				'allowswitcheditor' => $_G['setting']['editoroptions']{1},
				'allowhtml' => 1,
				'allowsmilies' => 0,
				'allowbbcode' => 1,
				'allowimgcode' => 1,
				'allowresize' => 1,
				'textarea' => 'message',
				'simplemode' => !isset($_G['cookie']['editormode_'.$data['editorid']]) ? 1 : $_G['cookie']['editormode_'.$data['editorid']],
			);

			//个人相册加载
			$albumlist = array();
			if($_G['uid']) {
				$query = DB::query("SELECT albumid, albumname, picnum FROM ".DB::table('home_album')." WHERE uid='$_G[uid]' ORDER BY updatetime DESC");
				while($value = DB::fetch($query)) {
					if($value['picnum']) {
						$albumlist[] = $value;
					}
				}
			}
			$data['albumlist'] = $albumlist;
			$data['imgselectlimit'] = $this->mod->_setting['imagelimit'] > 0 ? $this->mod->_setting['imagelimit'] : 5;
			//获得地区
			$data['dqlist']		= $this->mod->dqlist;
			$data['gdqjlist'] 	= $this->mod->gdqjlist;


			//print_r($data);exit;

			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$pstatus = DB::fetch_first("SELECT COUNT(*) AS count, first, authorid FROM " . DB::table('forum_post') . " WHERE pid = {$pid}");
			$postdata = array_merge($_GET, $_POST);

			if ($_G['forum']['ismoderator'] != 1 && $pstatus['authorid'] != $_G['uid']){
				$this->showmessage('model_edit_nopermission');
			}
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic')){
				$this->showmessage('model_need_pic');
			}
			//是否是首帖
			if ($pstatus['first'] == 1) {
				//处理编辑器图片
				$new_img_edit = $_G['gp_attachnew'];
				if(preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $postdata['message'])){
					preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $postdata['message'], $matches);
					$send_img = $matches[2];
					foreach($new_img_edit as $key=>$descon){
						if(!in_array($key, $send_img)){
							unset($new_img_edit[$key]);
						}
					}
				} else {
					unset($new_img_edit);
				}
				$postdata['new_img_edit'] = $new_img_edit;
				$postdata['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $postdata['message']);
				foreach($postdata as $k => $v){
					if(in_array($k, array('subject','message','region','season'))){
						$postdata[$k] = trim(dhtmlspecialchars($postdata[$k]));
					}
				}

				$this->mod->dopost($postdata, $tid, $pid);
			}
		}
	}

	/**
	 * 发/编辑 点评 - ajax
	 *
	 * @author zhl
	 */
	function _replypost($data)
	{
		global $_G;
		if(!$_G['uid'] && !$_G['group']['allowpost']){
			$this->showmessage('postperm_login_nopermission');
		}
		$this->check_allow_action('allowreply');
		if (submitcheck('replypostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$postdata = array_merge($_GET, $_POST);
			$postdata = iconv_array($postdata, 'UTF-8', 'GBK'); // jquery ajax提交转码

			if($postdata['f_starttime']==$postdata['f_endtime']){
				$postdata['f_starttime'] = $postdata['f_starttime']+ $postdata['f_starhour']*3600;
				$postdata['f_endtime'] = $postdata['f_endtime']+ $postdata['f_endhour']*3600;
			}
			// 简单验证
			$star_num = intval($postdata['starnum']);
			if ($star_num > 5 || $star_num <= 0 || !trim($postdata['f_starttime']) || !trim($postdata['f_endtime']) || !trim($postdata['f_pricedesc'])|| !trim($postdata['f_comment'])) {
				$this->showmessage("数据错误，请重新提交");
			}
			if($postdata['message'] == $this->mod->_setting['initdianping']){
				$this->showmessage("请认真填写综合评价");
			}
			// 初始化模型
			$mod_forum_post = m('forum_post');
			$mod_star_logs = m('dianping');
			if (isset($postdata['ext']) && $postdata['ext'] == 'edit') {
				// 修改评价
				$pid = $postdata['pid'];
				if ($_G['forum']['ismoderator'] == 1 || $mod_star_logs->get(array('conditions' => "uid = {$_G['uid']} AND pid = {$postdata['pid']}", 'index_key' => 'pid'))) {
					$mod_forum_post->edit("pid = {$postdata['pid']}", array('message' => trim(dhtmlspecialchars($postdata['message'])), ));
					$mod_star_logs->edit("pid = {$postdata['pid']}", array(
						'starnum' => $postdata['starnum'],
						'ext1' => trim(($postdata['f_starttime'])),
						'ext2' => trim(($postdata['f_endtime'])),
						'ext3' => trim(dhtmlspecialchars($postdata['f_pricedesc'])),
						'ext4' => trim(dhtmlspecialchars($postdata['f_comment'])),
						'lastupdate' => $_G['timestamp']
					));
					$starid = $mod_star_logs->_getStarid($_G['tid']);
					$score = $mod_star_logs->updateStar($starid);
					if($score){
						$this->mod->edit("{$this->mod->_vars[tid]} = {$_G['tid']}", $this->mod->postdataHandle(array('score' => $score, 'lastscore' => $mod_star_logs->t_lastprice)));
					}
				}
			} else {
				require_once libfile('function/post');
				$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
				$pid = insertpost(array(
					'fid' => $this->mod->_fid,
					'tid' => $_G['tid'],
					'first' => '0',
					'author' => $_G['username'],
					'authorid' => $_G['uid'],
					'subject' => '',
					'dateline' => $_G['timestamp'],
					'message' => $postdata['message'],
					'useip' => $_G['clientip'],
					'attachment' => '0',
				));
				// 新增点评分数
				$myrate = max(intval($mod_star_logs->getMyRate($_G['uid'], $_G['tid'])), 0);
				if(!$myrate && $star_num){
					$starid = $mod_star_logs->_getStarid($_G['tid']);
					if(!$starid){
						$dianpingcache = m('dianpingshow');
						$starid = $dianpingcache->_add(array(
									'type' => 'forum',
									'typeid' => $_G['tid']
									));
					}
					if($starid&&$star_num){
						$mod_star_logs->add(array(
							'starid' => $starid,
							'starnum' => $star_num,
							'dateline' => $_G['timestamp'],
							'uid' => $_G['uid'],
							'username' => $_G['username'],
							'pid' => $pid,
							'ip' => $_G['clientip'],
							'ext1' => trim(($postdata['f_starttime'])),
							'ext2' => trim(($postdata['f_endtime'])),
							'ext3' => trim(dhtmlspecialchars($postdata['f_pricedesc'])),
							'ext4' => trim(dhtmlspecialchars($postdata['f_comment'])),
							'lastupdate' => $_G['timestamp']
							));
					}
					$score = $mod_star_logs->updateStar($starid);
					if($score){
						$this->mod->edit("{$this->mod->_vars[tid]} = {$_G['tid']}", $this->mod->postdataHandle(array('score' => $score, 'lastscore' => $mod_star_logs->t_lastprice)));
					}
				}
				//更新热度
				$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid='$_G[tid]'");
				$heat = $thread['heats'];
				if($thread['lastposter'] != $_G['member']['username']) {
					$posttable = getposttablebytid($_G['tid']);
					$userreplies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='0' AND authorid='$_G[uid]'");
					$thread['heats'] += round($_G['setting']['heatthread']['reply'] * pow(0.8, $userreplies));
					DB::query("UPDATE ".DB::table('forum_thread')." SET heats='$thread[heats]' WHERE tid='$_G[tid]'", 'UNBUFFERED');
				}
				// 相关更新
				$lastpost = "{$_G['tid']}\t\t{$_G['timestamp']}\t{$_G['username']}";
				DB::query("UPDATE " . DB::table('forum_forum') . " SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid='{$this->mod->_fid}'", 'UNBUFFERED');
				require_once libfile('function/stat');
				updatestat('post');
				$typeid = DB::result_first("SELECT typeid FROM " . DB::table('forum_thread') . " WHERE tid='{$_G['tid']}'");
				DB::query("UPDATE " . DB::table('forum_threadclass') . " SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED');
				updatepostcredits('+', $_G['uid'], 'reply', $this->mod->_fid); // 更新积分
				$mod_thread = m('forum_thread');
				$mod_thread->edit($_G['tid'], "replies=replies+1, lastpost='{$_G['timestamp']}', lastposter='{$_G['username']}'");
				// 更新点评人数
				$this->mod->updateNum($_G['tid'], $starid);
			}
			$array = DB::fetch_first("SELECT * FROM " . DB::table('forum_post') . " WHERE pid={$pid}");
			if($array){
				die('ok');
			}else{
				die('error');
			}
		}

	}

	public function copyFiles(){
		exit('error');
	}


}
?>
