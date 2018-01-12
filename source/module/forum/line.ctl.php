<?php
/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class LineCtl extends DianpingCtl{
	var $modname = 'line';

	/**
	 * 显示发布页--参考forum.base.php相应方法
	 */
	function _newpost($data)
	{
		global $_G;

		if (! $_G['uid'] && ! ((! $_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])))) {
			$this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
		} elseif (empty($_G['forum']['allowpost'])) {
			if (! $_G['forum']['postperm'] && ! $_G['group']['allowpost']) {
				$this->showmessage('postperm_none_nopermission_dianping', null, array(), array('login' => 1));
			} elseif ($_G['forum']['postperm'] && ! forumperm($_G['forum']['postperm'])) {
				showmessagenoperm('postperm', $this->mod->_fid, $_G['forum']['formulaperm']);
			}
		} elseif ($_G['forum']['allowpost'] == -1) {
			$this->showmessage('post_forum_newthread_nopermission');
		}
		if (! $_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
			$this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
		}

		$_G['fid'] =  $this->mod->_fid;
		//用来检查积分限制的
		checklowerlimit('post', 0, 1, $this->mod->_fid);
		$data = array_merge($data, $this->_getGlobalArgs('post'));
		if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			//表单
			$data['url']		= $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action']		= 'new';
			$typelist           = $this->mod->_getTypeClass();
			$data['typelist']	= !empty($typelist[0]) ? $typelist[0] : array();
			$data['timelist'] 	= !empty($typelist[1]) ? $typelist[1] : array();

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
			$mdRegion = m("regions");
			$data['regionsList'] = $mdRegion->getMyInfo(0, 1);
			$data['regionsList']["999999"] = array("cityname"=>"国外","shengid"=>0,"shiid"=>0,"citycode"=>"999999");

			$mdLineRegion		= m("plugin_line_region");
			$where				= "num > 0";
			$lineRegionList     = $mdLineRegion->getAllList($where);
			$data['regionSort'] = $lineRegionList["num"];
			arsort($data['regionSort']);

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
			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));

			$this->mod->dopost($postdata);
		}
	}

	/**
	 * 显示列表页--参考forum.base.php相应方法
	 */
	function showlist()
	{
		global $_G;
		$data	 	 	= $this->_getGlobalArgs('list');
		$perpage 	 	= max($this->mod->limit, 1);
		$page 	 	 	= max(intval($_G['gp_page']), 1);
		$start   	 	= ($page - 1) * $perpage;
		$data['myurl']  = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$data['url'] 	= $data['myurl']."&act=showlist";
		$mdLinecross 	= m('linecross');
		$mdRegion 		= m("regions");
		$mdLineRegion	= m("plugin_line_region");

		$typelist           = $this->mod->_getTypeClass();
		$data['typelist']	= !empty($typelist[0]) ? $typelist[0] : array();
		$data['timelist'] 	= !empty($typelist[1]) ? $typelist[1] : array();

		//处理分页样式 lxp 20130922
		$pagestr = $htmlstate == 1 ? 'page-' : 'page=';
		$order   = isset($_G['gp_order']) ? $_G['gp_order'] : 'lastpost';
		$data['url']  .= "&order={$order}";
		$data['order'] = $order;

		//获得条件
		$where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 ';

		//get search parameters
		$data['lType']   = !empty($_G['gp_lType']) ? intval($_G['gp_lType']) : 0;
		$data['lTime']   = !empty($_G['gp_lTime']) ? intval($_G['gp_lTime']) : 0;
		$data['city']	 = !empty($_G['gp_city']) ? intval($_G['gp_city']) : 0;
		$data['province']= !empty($_G['gp_province']) ? intval($_G['gp_province']) : 0;

		$data['url']  	.= '&lType=' . $data['lType'];
		//line type
		$whereCross = '';
		if($data['lType']) {

			$where .= " and {$this->mod->alias}.{$this->mod->_vars['lType']}={$data['lType']}";
			$whereCross = "{$mdLinecross->alias}.{$mdLinecross->_vars['ltype']} = {$data['lType']}";
		}

		//路线时长
		$data['url']    .= '&lTime=' . $data['lTime'];
		if($data['lTime']){
			$where .= " and {$this->mod->alias}.{$this->mod->_vars['lTime']}={$data['lTime']}";
			$whereCrossTime = "{$mdLinecross->alias}.{$mdLinecross->_vars['ltime']} = {$data['lTime']}";
			$whereCross = $whereCross ? "{$whereCross} and {$whereCrossTime}" : $whereCrossTime;
		}

		//经过地域
		$data['url']    .= '&province=' . $data['province'];
		if($data['province']){
			//$where .= " and {$this->mod->alias}.{$this->mod->_vars['lTime']}={$data['lTime']}";
			$whereCrossProvince = "{$mdLinecross->alias}.{$mdLinecross->_vars['province']} = {$data['province']}";
			$whereCross = $whereCross ? "{$whereCross} and {$whereCrossProvince}" : $whereCrossProvince;
		}

		$data['url']    .= '&city=' . $data['city'];
		if($data['city']){
			$whereCrossCity = "{$mdLinecross->alias}.{$mdLinecross->_vars['city']} = {$data['city']}";
			$whereCross = $whereCross ? "{$whereCross} and {$whereCrossCity}" : $whereCrossCity;
		}

		if ($whereCross) {
			$tids = '';
			$linecrossList = $mdLinecross->getData($whereCross, 'tid, province, city, ltype, ltime');

			$reglist = array();
			$timeList = array();
			$typeList = array();
			$tidList = array();
			foreach ($linecrossList as $key => $value) {
				$tidList[$value['tid']] = 1;
				$reglist['province'][$value['province']]++;
				$reglist['city'][$value['province']][$value['city']]++;
				$timeList[$value['ltime']] = 1;
				$typeList[$value['ltype']] = 1;
			}
			//clean type


			arsort($reglist['province']);
			foreach ($reglist['city'] as $k => $v) {
				arsort($reglist['city'][$k]);
			}
			$tids = implode(',', array_keys($tidList));
			unset($tidList);

			if($tids){
				$where .= " and {$this->mod->alias}.{$this->mod->_vars["tid"]} in ({$tids})";
			}else{
				$where .= " and {$this->mod->alias}.{$this->mod->_vars["tid"]} in (0)";
			}
			unset($linecrossList);
			unset($tids);
		}

		//获得排序
		$desc  = $_G['gp_desc'] === 0 ? 'ASC' : 'DESC';
		$order = $order == 'latest' ? 'dateline' : $order;
		if ($order) {
			if($order == 'score'){
				$orders = array('score' => $desc);
			}else{
				$orders = array('displayorder' => 'DESC', $order => $desc);
			}
		} else {
			$orders = array('displayorder' => 'DESC');
		}

		//处理分页
		$max = $this->mod->getMaxCount($where);
		if ($max) {
			$data['multipage'] = multi($max, $perpage, $page, $data['url']);
			//获得列表
			$data['list'] = $this->mod->getlist(array(
				'start' => $start,
				'order' => $orders,
				'where' => $where
			));
		}

		//获得地区
		$data['regionsList'] = $mdRegion->getMyInfo(0, 1);
		$data['regionsList']["999999"] = array("cityname"=>"国外","shengid"=>0,"shiid"=>0,"citycode"=>"999999");
		foreach ($data["list"] as $k=>$v) {
			$category  = !empty($data["typelist"][$v['type']]["name"]) ? $data["typelist"][$v['type']]["name"] : "";
			$linecross = $mdLinecross->find(array('conditions' => "tid = {$v['tid']}","order"=>"id asc"), false);
			foreach ($linecross as $key=>$val) {
				if ($key == 0) {
					$area      = !empty($data['regionsList'][$val['province']]['cityname']) ? $data['regionsList'][$val['province']]['cityname'] : "";
					$data["list"][$k]['province'] = $val['province'];
				}
				if($area){
					$area = str_replace('省','',$area);
					$area = str_replace('市','',$area);
					$area = str_replace('回族','',$area);
					$area = str_replace('壮族','',$area);
					$area = str_replace('维吾尔','',$area);
					$area = str_replace('自治区','',$area);
					$area = str_replace('特别行政区','',$area);
					$data["list"][$k]['typename_area'] 	   = $area;
					$data["list"][$k]['typename_category'] = $category;
				}
				$data["list"][$k]['cityids'][$val['city']]  = $val['province'];
			}
		}

		//精彩点评列表
		$mdForumPost = m('forum_post');
		$tids 		 = array();
		$data["jcdpList"] = $mdForumPost->find(array(
			'fields'     => 'f_p.pid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate',
			'conditions' => "f_p.fid={$this->mod->_fid} and f_p.first=0 and rate>0",
			'order'      => 'f_p.dateline DESC',
			'limit'      => $this->mod->otherlimit
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
				'conditions' => "tid in ($tids)"
			));
		}

		$where				= "num > 0";
		$lineRegionList     = $mdLineRegion->getAllList($where);
		$data['cityList']   = $lineRegionList["list"];
		$data['onlycity']   = $lineRegionList["city"];
        if($reglist){
			$data['regionSort'] = $reglist["province"];
			$data['regionCity'] = $reglist["city"];
		}else {
			$data['regionSort'] = $lineRegionList["num"];
			arsort($data['regionSort']);
		}
		//同省其他线路列表
		if ($data['city']){
			$crossList = $mdLinecross->getData($whereCrossProvince, 'tid, province, city, ltype, ltime');
			$tidLists = array();
			foreach ($crossList as $key => $value) {
				$tidLists[$value['tid']] = 1;
			}
			$tidArray = implode(',', array_keys($tidLists));
			unset($tidLists);
			if($tidArray){
				$where = " {$this->mod->alias}.{$this->mod->_vars["tid"]} in ({$tidArray})";
			}else{
				$where = " {$this->mod->alias}.{$this->mod->_vars["tid"]} in (0)";
			}
			$data['provinceLine'] = $this->mod->getlist(array(
				'order' => array('heats' => 'DESC'),
				'limit' => $this->mod->otherlimit,
				'where' => $where
			));
			$data["jcdpList"]="";
		}
		//*临时解决百度收录问题，若提供的url地域不对，将跳转到正确地址 by JiangHong 2014-6-24*//
		if(! array_key_exists( $data['city'], $data['cityList'][$data['province']] ) && $data['city'] != 0 ){
			$_jumpurl = "{$data['myurl']}&act=showlist";
			if( ! array_key_exists($data['province'], $data['cityList'])){
				$data['province'] = 0;
			}
			if($data['order'] != 'heats' || $data['lTime'] || $data['lType']){
				$_jumpurl .= "&order={$data['order']}&lType={$data['lType']}&lTime={$data['lTime']}&province={$data['province']}&city=0&page=1";
			}
		}
		if( ! array_key_exists($data['province'], $data['cityList']) && $data['province'] != 0){
			$_jumpurl = "{$data['myurl']}&act=showlist";
			$data['province'] = 0;
		}
		//meta:title,description,keyword
		$lineType = $data['typelist'][$data['lType']]['name'];
		if(! $lineType && $data['lType'] != 0){
			$_jumpurl = "{$data['myurl']}&act=showlist";
			$data['lType'] = 0;
		}
		if(! $data['timelist'][$data['lTime']]['name'] && $data['lTime'] != 0){
			$_jumpurl = "{$data['myurl']}&act=showlist";
			$data['lTime'] = 0;
		}
		if( ! empty($_jumpurl) ){
			$_jumpurl .= "&order={$data['order']}&lType={$data['lType']}&lTime={$data['lTime']}&province={$data['province']}&city=0&page=1";
			$_jumpurl = $this->_get_myRewrite($_jumpurl);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: $_jumpurl");
		}
		$days = $data['timelist'][$data['lTime']]['name'] ? $data['timelist'][$data['lTime']]['name'] : '';
		$province = $data['regionsList'][$data['province']]['cityname'] ? $data['regionsList'][$data['province']]['cityname'] : '';
		$city = $data['cityList'][$data['province']][$data['city']]['name'] ? $data['cityList'][$data['province']][$data['city']]['name'] : '';
		$place = $province . $city ? $province . $city : '';
		$second_page = ($days || $place) ? '_second' : '';

		switch ($lineType) {
			case '徒步穿越':
				if($second_page)
					$data['pageTitle'] = lang('forum/line', 'foot' . $second_page . '_page_title');
				$data['metakeywords'] = lang('forum/line', 'foot' . $second_page . '_page_keywords');
				$data['metadescription'] = lang('forum/line', 'foot' . $second_page . '_page_description');
				break;
			case '自驾车游':
				if($second_page)
					$data['pageTitle'] = lang('forum/line', 'drive' . $second_page . '_page_title');
				$data['metakeywords'] = lang('forum/line', 'drive' . $second_page . '_page_keywords');
				$data['metadescription'] = lang('forum/line', 'drive' . $second_page . '_page_description');
				break;
			default:
				if($second_page)
					$data['pageTitle'] = lang('forum/line', 'line' . $second_page . '_page_title');
				$data['metakeywords'] = lang('forum/line', 'line' . $second_page . '_page_keywords');
				$data['metadescription'] = lang('forum/line', 'line' . $second_page . '_page_description');
				break;
		}
		//综合的不需要替换变量
		if($second_page) {
			$data['pageTitle'] = strtr($data['pageTitle'], array(
					'[city]' => $place,
					'[day]' => $days

			));
			$data['metakeywords'] = strtr($data['metakeywords'], array(
					'[city]' => $place,
					'[day]' => $days
				));
			$data['metadescription'] = strtr($data['metadescription'], array(
					'[city]' => $place,
					'[day]' => $days
				));
		}
		else {
			$data['pageTitle'] = strtr(lang('forum/line', 'line_page_title'), array(
					'[type]' => $lineType,
			));
		}
		$data['pageTitle'] = str_replace('{page}', $page>1 ? ' - 第'.$_G['gp_page'].'页' : '', $data['pageTitle']);
		$this->assign($data);
		$this->display($this->mod->template['list']);
	}

	/**
	 * ajax 获得地区
	 * @author LiShuaiquan
	 */
	function ajaxGetRegion()
	{
		global $_G;
		$provinceid = intval($_G['gp_provinceid']);
		if ($provinceid) {
			$mdLineRegion 	= m("plugin_line_region");
			$lineRegionList = $mdLineRegion->getList($provinceid);
		}
		$html  = "";
		if ($lineRegionList) {
			foreach ($lineRegionList as $k=>$v) {
				$html .= "<a href='javascript:void(0);' rel='{$v["id"]}'>{$v["name"]}</a>";
			}
		}
		echo $html;
		exit();
	}

	/**
	 * 显示详细页--参考forum.base.php相应方法
	 */
	function showview()
	{
		global $_G;
		$tid  = intval($_G['gp_tid']);
		$page = max(1, $_G['gp_page']);
		if ($tid <= 0) {
			$this->showlist();
		} else {

			$data = $this->_getGlobalArgs('view');

			//获得线路|帖子详细信息
			$data['viewdata'] = $this->mod->getview($tid);
			if (empty($data['viewdata'])){
				$this->showmessage('thread_nonexistence');
			}
            $data['viewdata']['shortsubject'] = cutstr($data['viewdata']['subject'], 36);
			//处理编辑器中内容
			require_once libfile('function/newdiscuzcode');
			$data['viewdata']['message'] = discuzcode($data['viewdata']['message']);
			if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $data['viewdata']['message'], $matches)) {
				$aids = $matches[1];
				require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				$attachserver = new attachserver;
				$domain  = $attachserver->get_server_domain('all', '*');
				foreach ($aids as $key=>$aid) {
					$attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
					if ($attachment['isimage']) {
						if($attachment['serverid']>0){
							$path = "http://".$domain[$attachment['serverid']]['name']."/forum/".$attachment['attachment'];
							$path .= attachserver::getPreStr($domain[$attachment['serverid']], $attachment['dir'], true,true);
						}elseif($attachment['remote']){
							$path = $_G['setting']['ftp']['attachurl'].'forum/'.$attachment['attachment'];
						}else{
							$path = $_G['setting']['attachurl'].'forum/'.$attachment['attachment'];
						}
						if($attachment['width']>610){
							$data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" width="610px;" />', $data['viewdata']['message']);
						}else{
							$data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" />', $data['viewdata']['message']);
						}
					}
				}
			}

			//meta:title,description,keyword
			$data['pageTitle'] 		 = str_replace(array('[subject]', '{page}'), array($data['viewdata']['subject'], $page>1 ? ' - 第'.$_G['gp_page'].'页' : ''), $data['pageTitle']);
			$data['metakeywords'] 	 = str_replace('[subject]', $data['viewdata']['subject'], $data['metakeywords']);
			$data['metadescription'] = str_replace('[subject]', $data['viewdata']['subject'], $data['metadescription']);

			$data['piclist'] = $this->_getimgbytidpid($tid, $data['viewdata']['pid'], 'plugin', false, 5);

			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";

			$where = $this->mod->alias . '.' . $this->mod->_vars['tid'] . " <> $tid ";

			// 热门的线路列表
			$data['listheats'] = $this->mod->getlist(array(
				'order' => array('heats' => 'DESC'),
				'limit' => $this->mod->otherlimit,
				'where' => $where
			));

			// 同地区的线路列表
			$mdLinecross   = m("linecross");
			$lineCrossList = $mdLinecross->getDataByTid($tid);
			$provinceIds   = array();
			$cityIds       = array();
			foreach ($lineCrossList as $v) {
				$provinceIds[$v["province"]] = $v["province"];
				$cityIds[$v['city']] = $v['city'];
			}
			$provinceIds = implode(",", $provinceIds);

			if (!empty($provinceIds)) {
				$whereCross    = "{$mdLinecross->alias}.{$mdLinecross->_vars["tid"]} <> {$tid} and {$mdLinecross->alias}.{$mdLinecross->_vars['province']} in ({$provinceIds})";
				$linecrossList = $mdLinecross->getData($whereCross);
				$tids 		   = array();
				foreach ($linecrossList as $k=>$v) {
					$tids[$v["tid"]] = $v["tid"];
				}
				$tids = implode(",", $tids);
				if($tids){
					$where .= " and {$this->mod->alias}.{$this->mod->_vars["tid"]} in ({$tids})";
				}
			}
			$data['listprovince'] = $this->mod->getlist(array(
				'order' => array('dateline' => 'DESC'),
				'limit' => $this->mod->otherlimit,
				'where' => $where
			));

			//当前用户回复---我的点评
			$mod_forum_post = m('forum_post');
			$data['my_comment'] = array();
			$data['my_comment'] = $mod_forum_post->get(array('conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}", 'join' => 'has_star'));//若没登录，$_G['uid']为0
			$data['my_comment'] = $this->_makereply($data['my_comment']);

			//评论列表
			$data['page'] = $page;
			$perpage      =  max($this->mod->commentlimit, 1);
			$start 		  = ($page - 1) * $perpage;
			$replyList    = $mod_forum_post->find(array(
				'fields'     => 'f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message,f_p.rate, sl.starid, sl.starnum, sl.ext1, sl.ext2, sl.ext3, sl.ext4, sl.ext5, sl.weakpoint, sl.supports',
				'conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid<>{$_G['uid']}",
				'order'      => 'sl.stickreply DESC, f_p.dateline DESC',
				'limit'      => "{$start}, {$this->mod->commentlimit}",
				'join'       => 'has_star'
			));
			if (is_array($replyList)) {
				foreach ($replyList as $k => $v) {
					$replyList[$k] = $this->_makereply($v);
				}
			}

			if ($_G['uid']) {
				$mod_dianping_support = m('dianpingsupport');
				$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
			}
			$data['replylist'] 	 = $replyList;
			$data['multipage']   = multi($data['viewdata']['replies'], $perpage, $page, $data['url'] . "&act=showview&tid={$tid}");;
			$data['supportlist'] = $supportlist;

			//获取该线路的点评信息
			$mdDianpingshow    = m('dianpingshow');
			$data['star_data'] = $mdDianpingshow->getData($tid);

			//获取穿越的地区
			if (!empty($cityIds)) {
				$data['cityids']	= $cityIds;
				$cityIds 			= implode(",", $cityIds);
				$mdLineRegion		= m("plugin_line_region");
				$wheres 			= " id in ({$cityIds})";
				$lineRegionList     = $mdLineRegion->getListbyId($wheres, true);
				$data['crossregin'] = $lineRegionList;
			}

			//获得gps信息
			$mdGps   		 = m("gpsattachment");
			$gpsShow		 = $mdGps->getData($data['viewdata']["tid"], "tid");
			$data['viewdata']["map"] = !empty($gpsShow) ? $_G['config']['web']['attach'] . $gpsShow["htmlfiledir"] . $gpsShow["htmlfilename"] : "";
			$gpsShow["aidencode"] = !empty($gpsShow) ? aidencode($gpsShow["aid"]) : "";
			$gpsShow["aidencode"] = str_replace("%3D", "", $gpsShow["aidencode"]);
			$data['gpsShow'] = $gpsShow;
			$this->assign($data);
			$this->display($this->mod->template['view']);
		}
	}

	/**
	 * 显示编辑页--参考forum.base.php相应方法
	 */
	function _editpost($data)
	{
		global $_G;
		$tid = intval($_G['gp_tid']);
		$pid = intval($_G['gp_pid']);
		if ($pid <= 0 || $tid <= 0) {
			$this->showmessage('nopidandtid');
		}
		//$data = $this->_getGlobalArgs('post');
		if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['pageTitle']  = str_replace('发布', '编辑', $data['pageTitle']);

			$data['editdata'] 	= $this->mod->getview($tid);
			$data['url'] 		= $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] 	= 'edit';
			$typelist           = $this->mod->_getTypeClass();
			$data['typelist']	= !empty($typelist[0]) ? $typelist[0] : array();
			$data['timelist'] 	= !empty($typelist[1]) ? $typelist[1] : array();

			$mdLinecross   				= m("linecross");
			$data['editdata']["lcross"] = $mdLinecross->getDataByTid($tid);

			//获得gps信息
			$mdGps   		 = m("gpsattachment");
			$data['gpsShow'] = $mdGps->getData($data['editdata']["tid"], "tid");

			//处理编辑器内容/图片
			$data['editdata']['message'] = dhtmlspecialchars($data['editdata']['message']);
			require_once libfile('function/post');
			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				$data['attachlist'] = getattach($pid, 0, 'all');
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

			//获得地区
			$mdRegion = m("regions");
			$data['regionsList'] = $mdRegion->getMyInfo(0, 1);
			$data['regionsList']["999999"] = array("cityname"=>"国外","shengid"=>0,"shiid"=>0,"citycode"=>"999999");

			$mdLineRegion		= m("plugin_line_region");
			$where				= "num > 0";
			$lineRegionList     = $mdLineRegion->getAllList($where);
			$data['regionSort'] = $lineRegionList["num"];
			arsort($data['regionSort']);

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
				$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
				$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));

				$this->mod->dopost($postdata, $tid, $pid);
			}
		}
	}

	/**
	 * ajax 删除gps
	 */
	function ajaxDelGps()
	{
		global $_G;
		$aid 	= intval($_G['gp_aid']);
		$mdGps  = m("gpsattachment");
		if ($mdGps->deleteThis($aid, "aid")) {
			echo json_encode(array("isOk"=>"yes"));
		} else {
			echo json_encode(array("isOk"=>"no"));
		}
		exit();
	}

	/**
	 * 下载gps文件
	 */
	function downloadGps()
	{
		global $_G;

		//获得gps信息
		$mdGps    = m("gpsattachment");
		$mdGps->downloadGps($_G['gp_aid']);

		exit();
	}

	/**
	 * 处理回复点评内容的显示--参考forum.base.php相应方法
	 */
	function _makereply($reply){
		if($reply){
			$reply['ext3'] 		= $this->_set_br($reply['ext3']);
			$reply['weakpoint'] = $this->_set_br($reply['weakpoint']);
			$reply['message']   = $this->_set_br($reply['message']);
			$reply['dateline']  = $this->mod->_timeHandle($reply['dateline']);
			$tempJiange = $reply['ext2'] - $reply['ext1'];
			$reply['ext1']	= $reply['ext1_show'] = $reply['ext1'] ? date("Y-m-d", $reply['ext1']) : "";
			$reply['ext2']	= $reply['ext2_show'] = $reply['ext2'] ? date("Y-m-d", $reply['ext2']) : "";
			$reply['timeTotal']   = "";
			if ($tempJiange >= 86400) {
				$reply['timeTotal'] .= ceil($tempJiange/86400)."天";
				$reply['isTian']     = 1;
			} else {
				$reply['timeTotal'] .= ($reply['ext5'] - $reply['ext4'])."小时";
				$reply['isTian']     = 0;
			}
		}
		return $reply;
	}

	/**
	 * 发/编辑 点评 - ajax--参考forum.base.php相应方法
	 */
	function _replypost($data)
	{
		global $_G;
		$this->check_allow_action('allowreply');
		if (submitcheck('replypostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$postdata = array_merge($_GET, $_POST);
			$postdata = iconv_array($postdata, 'UTF-8', 'GBK'); // jquery ajax提交转码

			// 简单验证
			$star_num = intval($postdata['starnum']);
			if ($star_num > 5 || $star_num <= 0 || !trim($postdata['ext1']) || !trim($postdata['ext2']) || !trim($postdata['weakpoint']) || !trim($postdata['price']) || !trim($postdata['message'])) {
				$this->showmessage("数据错误，请重新提交");
			}

			$postdata['ext1'] = strtotime($postdata['ext1']);
			$postdata['ext2'] = strtotime($postdata['ext2']);
			$postdata['ext3'] = $postdata['price'];

			// 初始化模型
			$mod_forum_post = m('forum_post');
			$mod_star_logs  = m('dianping');
			$starid = $mod_star_logs->_getStarid($_G['tid']);

			if (isset($postdata['ext']) && $postdata['ext'] == 'edit') {
				// 修改评价
				if ($_G['forum']['ismoderator'] == 1 || $mod_star_logs->get(array('conditions' => "uid = {$_G['uid']} AND pid = {$postdata['pid']}", 'index_key' => 'pid'))) {					$mod_forum_post->edit("pid = {$postdata['pid']}", array('message' => trim(dhtmlspecialchars($postdata['message'])), ));
					$mod_star_logs->edit("pid = {$postdata['pid']}", array(
						'starnum' => $postdata['starnum'],
						'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
						'ext1' => $postdata['ext1'],
						'ext2' => $postdata['ext2'],
						'ext3' => trim(dhtmlspecialchars($postdata['ext3'])),
						'ext4' => $postdata['ext4'],
						'ext5' => $postdata['ext5'],
						'lastupdate' => $_G['timestamp']
					));
				}
			} else {
				require_once libfile('function/post');
				// 新增评价
				if (intval($mod_star_logs->getMyRate($_G['uid'], $_G['tid']))) {
					$this->showmessage("你已经点评过了");
				}
				$postdata['pid'] = insertpost(array(
					'fid' => $this->mod->_fid,
					'tid' => $_G['tid'],
					'first' => '0',
					'author' => $_G['username'],
					'authorid' => $_G['uid'],
					'subject' => '',
					'dateline' => $_G['timestamp'],
					'message' => trim(dhtmlspecialchars($postdata['message'])),
					'useip' => $_G['clientip'],
					'attachment' => '0',
				));
				// 新增点评分数
				$mod_star_logs->add(array(
					'starid' => $starid,
					'starnum' => $star_num,
					'dateline' => $_G['timestamp'],
					'uid' => $_G['uid'],
					'username' => $_G['username'],
					'pid' => $postdata['pid'],
					'ip' => $_G['clientip'],
					'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
					'ext1' => $postdata['ext1'],
					'ext2' => $postdata['ext2'],
					'ext3' => trim(dhtmlspecialchars($postdata['ext3'])),	//费用
					'ext4' => $postdata['ext4'],
					'ext5' => $postdata['ext5'],
					'lastupdate' => $_G['timestamp']
				));
				// 相关更新
				$lastpost = "{$_G['tid']}\t\t{$_G['timestamp']}\t{$_G['username']}";
				DB::query("UPDATE " . DB::table('forum_forum') . " SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid='{$this->mod->_fid}'", 'UNBUFFERED');
				require_once libfile('function/stat');
				updatestat('post');
				$typeid = DB::result_first("SELECT typeid FROM " . DB::table('forum_thread') . " WHERE tid='{$_G['tid']}'");
				DB::query("UPDATE " . DB::table('forum_threadclass') . " SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED');
				updatepostcredits('+', $_G['uid'], 'reply', $this->mod->_fid); // 更新积分

				$mod_thread = m('forum_thread');
				$mod_thread->updateHeats($_G['tid']);  // 更新热度
				$mod_thread->edit($_G['tid'], "replies=replies+1, lastpost='{$_G['timestamp']}', lastposter='{$_G['username']}'");
				// 更新点评人数 lxp 20131029
				$this->mod->updateNum($_G['tid'], $starid);
			}
			// 更新评分
			$score = $mod_star_logs->updateStar($starid);
			$this->mod->edit("{$this->mod->_vars[tid]} = {$_G['tid']}", $this->mod->postdataHandle(array('score' => $score, 'lastscore' => $mod_star_logs->t_lastprice)));
			echo json_encode(array("msg"=>"ok","pid"=>$postdata['pid']));
			exit();
		}
	}

	/**
	 * ajax 点评列表
	 *
	 * @author
	 */
	function ajaxreply()
	{
		global $_G;
		$tid = $_G['gp_tid'];
		if (! $tid) {
			die();
		}

		$url     = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$page    = max(intval($_G['gp_page']), 1);
		$perpage = max($this->mod->commentlimit, 1);
		$start   = ($page - 1) * $perpage;
		$mod_forum_post = m('forum_post');
		$replyList    = $mod_forum_post->find(array(
			'fields'     => 'f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message,f_p.rate, sl.starid, sl.starnum, sl.ext1, sl.ext2, sl.ext3, sl.ext4, sl.ext5, sl.weakpoint, sl.supports',
			'conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid<>{$_G['uid']}",
			'order'      => 'sl.stickreply DESC, f_p.dateline DESC',
			'limit'      => "{$start}, {$this->mod->commentlimit}",
			'join'       => 'has_star'
		));
		if (is_array($replyList)) {
			foreach ($replyList as $k => $v) {
				$replyList[$k] = $this->_makereply($v);
			}
		}
		$max = DB::result_first("SELECT replies FROM ".DB::table('forum_thread')." WHERE tid = {$tid}");
		$multipage = multi($max, $perpage, $page, $url . "&act=showview&tid={$tid}");
		if ($_G['uid']) {
			$mod_dianping_support = m('dianpingsupport');
			$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
		}
		$this->assign($data);
		$this->assign('page', $page);
		$this->assign('replylist', $replyList);
		$this->assign('multipage', $multipage);
		$this->assign('supportlist', $supportlist);
		$this->display($this->mod->template['replylist'] ? $this->mod->template['replylist'] : 'forum/dianping/replylist');
	}
}
?>
