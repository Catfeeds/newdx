<?php
/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class BrandCtl extends DianpingCtl{
	var $modname = 'brand';

	/**
	 * 将默认页转向列表页
	 */
	function index()
	{
		$this->showlist();
	}


	function _getGlobalInit($type = 'list')
	{
		global $_G;
		$dianpingmodules = m('dianpingmodules');
		$data['modname'] = $this->mod->_moduleinfo['mname'];
		$data['modstr'] = $this->modname;
		$data['modsetting'] = $this->mod->_setting;
		$data['dianpingmodules'] = $dianpingmodules->findAll(array('conditions' => 'status = 1', 'fields' => 'mname AS name, srcid AS src', 'order' => 'displayorder asc'));
		$data['fid'] = $this->mod->_fid;
		$data = array_merge($data, $this->mod->getNavTitle($type));
		return $data;
	}

	/**
	 * 显示列表页
	 * @author JiangHong
	 */
	function showlist()
	{
		global $_G;
		$data = $this->_getGlobalInit('list');
		$perpage = max($this->mod->limit, 1);
		$page = max(intval($_G['gp_page']), 1);
		$start = ($page - 1) * $perpage;
		$data['oldurl'] = $data['url'] = $data['sorturl'] = $data['myurl'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$pagestr = $htmlstate == 1 ? 'page-' : 'page=';
		$order = isset($_G['gp_order']) ? $_G['gp_order'] : 'lastpost';
		$data['url'] .= "&order={$order}&page={$page}";
		$data['order'] = '';

		if (! empty($_G['gp_let'])) {
			$let = $_G['gp_let'];
			$condition['letter'] = "={$_G[gp_let]}";
			$maxcondition .= " and {$this->mod->alias}.{$this->mod->_vars[letter]} = {$_G[gp_let]}";
			$data['order'] .= "&let={$let}";
		}else{
			$data['order'] .= "&let=0";
		}
		if (! empty($_G['gp_nat'])) {
			$nat = $_G['gp_nat'];
			$data['nation'] = $this->mod->_getBrandNationAtIndex($nat);
			$condition['nation'] = "={$_G[gp_nat]}";
			$maxcondition .= " and {$this->mod->alias}.{$this->mod->_vars[nation]} = {$_G[gp_nat]}";
			$data['order'] .= "&nat={$nat}";
		}else{
			$data['order'] .= "&nat=0";
		}
		if (! empty($_G['gp_cp'])) {
			$cp = $_G['gp_cp'];
			$data['pro'] = $this->mod->_getProduceAtIndex($cp);
			$condition['cptop'] = " FIND_IN_SET('{$_G[gp_cp]}',{$this->mod->alias}.{$this->mod->_vars[cptop]})";
			$maxcondition .= " and FIND_IN_SET('{$_G[gp_cp]}',{$this->mod->alias}.{$this->mod->_vars[cptop]})";
			$data['order'] .= "&cp={$cp}";
			$content = $data['pro']['produce'];
			$data['metakeywords'] = strtr('[content]，[content]排名', array(
				'[content]' => $content
			));
			$data['metadescription'] = strtr('2014年最权威最新[content]，根据数十万真实用户长期使用后点评打分而出，[content]为用户选择户外品牌提供最真实参考', array(
					'[content]' => $content
				));


		}else{
			$data['order'] .= "&cp=0";
		}
		$data['order'] .= '&order='.$order;
		$desc = $_G['gp_desc'] === 0 ? 'ASC' : 'DESC';
		if (! empty($_G['gp_order'])) {
			if($_G['gp_order'] == 'heats'){
				$orders = " ORDER BY t.displayorder DESC,t.heats $desc ";
			}else if($_G['gp_order'] == 'dateline'){
				$orders = " ORDER BY t.displayorder DESC,t.dateline $desc ";
			}else if($_G['gp_order'] == 'lastpost'){
				$orders = " ORDER BY t.displayorder DESC,t.lastpost $desc ";
			}else{
				$orders = " ORDER BY t.displayorder DESC,bd.score DESC,bd.id DESC ";
				$orderscore='score';
			}
		} else {
			$orders = " ORDER BY t.displayorder DESC,t.lastpost DESC ";
		}
		$where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 and t.displayorder!=-1 ';
		if (! empty($condition)) {
			foreach ($condition as $_k => $_v) {
				if($_k!='cptop'){
					$_k = array_key_exists($_k, $this->mod->_vars) ? $this->mod->alias . '.' . $this->mod->_vars[$_k] : 't.' . $_k;
					$where .= "AND {$_k} {$_v} ";
				}else{
					$where .= "AND {$_v} ";
				}
			}
		}
		//if order by 'score', exclude ones which are commented less than 50
		if($orderscore && ! $let && ! $cp && ! $nat) {
			$where .= ' AND bd.cnum >= 50 ';
			$maxcondition .= ' AND bd.cnum >= 50 ';
		}

		$max = $this->mod->getMaxCount($maxcondition);
		//品牌所用
		$data['letterlist'] = $this->mod->_getLetterbyIndex();
		$data['zs'] = $this->mod->_getZsInfoatIndex();
		$data['nations'] = $this->mod->_getBrandNationAtIndex();
		$data['prolist'] = $this->mod->_getProduceAtIndex();
		$blist = $list = array();

		// 加缓存应对负载 at 20140604 by zhl
		if (array_key_exists('heats', $orders)&& empty($_G['gp_let'])&& empty($_G['gp_nat'])&& empty($_G['gp_cp'])) {
			if($_G['uid']==1){
				memory('rm', 'cache_dianping_brand_list_'.$page);
			}
			$list = memory('get', 'cache_dianping_brand_list_' . $page);
			if (!$list){
				$list = $this->mod->getlist(array('start' => $start,
						'order' => $orders,
						'where' => $where));
				memory('set', 'cache_dianping_brand_list_' . $page, $list, 43200);//12*3600更新一次
			}
		}else{
			$list = $this->mod->getlist(array('start' => $start,
						'order' => $orders,
						'where' => $where));
		}
		//end
		foreach ($list as $value) {
			$name = $value['subject'];
			if(stripos($name,"（")){
				$sp = stripos($name,"（");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['cname'] = $cn;
			}elseif(stripos($name,"(")){
				$sp = stripos($name,"(");
				$en =  mb_substr($name,0,$sp);
				$cn =  mb_substr($name,$sp,strlen($name));
				$value['ename'] = $en;
				$value['cname'] = $cn;
			 }else{
				$value['ename'] = $name;
			 }
			 $blist[] = $value;
		}

		$data['brandlist'] = $blist;
		$data['multipage'] = multi($max,$perpage,$page,$data['myurl'].'&act=showlist'.$data['order']);
		$data['pageTitle'] = str_replace('{page}', $page>1 ? ' - 第'.$_G['gp_page'].'页' : '', $data['pageTitle']);
		$this->assign($data);
		$this->display($this->mod->template['list']);
	}
	//获得品牌列表的xml信息	(外部调用)
	function getXmlbybrand(){
		$this->mod->getXmlbybrand();
	}
	/**
	 * 显示详细页
	 * @author zhl
	 */
	function showview()
	{
		global $_G;
		if ($_G['gp_tid'] <= 0) {
			$this->showlist();
		} else {
			$tid = trim($_GET['tid']);
			$data = $this->_getGlobalInit('view');
			$data['viewdata'] = $this->mod->getview($tid);
			if (empty($data['viewdata'])){
				$this->showmessage('thread_nonexistence');
			}
			$data['modstr'] = $this->modname;
			$data['url'] = $_G['config']['web']['portal']."forum.php?ctl={$this->modname}";
			require_once libfile('function/newdiscuzcode');
			$data['viewdata']['message'] = discuzcode($data['viewdata']['message']);
			if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $data['viewdata']['message'], $matches)) {
				$aids = $matches[1];
				require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				$attachserver = new attachserver;
				$domain  = $attachserver->get_server_domain('all', '*');
				foreach ($aids as $aid) {
					$attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid,dir FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
					if ($attachment['isimage']) {
						if($attachment['serverid']>0){
							$path = "http://".$domain[$attachment['serverid']]['name']."/forum/".$attachment['attachment'];
							$path .= attachserver::getPreStr($domain[$attachment['serverid']], $attachment['dir'], true,true);
						}elseif($attachment['remote']){
							$path = $_G['setting']['ftp']['attachurl'].'forum/'.$attachment['attachment'];
						}else{
							$path = $_G['setting']['attachurl'].'forum/'.$attachment['attachment'];
						}
					}
					if($attachment['width']>610){
						$data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" width="610px;" />', $data['viewdata']['message']);
					}else{
						$data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" />', $data['viewdata']['message']);
					}
				}
			}
			require_once libfile('function/post');
			$data['viewdata']['mini_message'] = messagecutstr($data['viewdata']['message'],1000);
			// 当前用户回复
			$mod_forum_post = m('forum_post');
			$data['my_comment'] = array();
			$dianping = m('dianping');
			$data['myrate'] = max(intval($dianping->getMyRate($_G['uid'], $tid)), 0);

			$dianpingshow = m('dianpingshow');
			$data['star_data'] = $dianpingshow->getData($tid);
			/*增加初始时获得第一页的评论列表*/
			$page = max(1, $_G['gp_page']);
			$data['page'] = $page;
			$perpage =  max($this->mod->commentlimit, 1);
			$start = ($page - 1) * $perpage;
			$replyList = $this->mod->getComment($tid,$start);
			//判断楼层用户是否被点评过
			if ($_G['uid']) {
				// 当前用户回复
				$mod_forum_post = m('forum_post');
				$myreply = array();
				$myreply = $mod_forum_post->find(array('fields'=>"f_p.pid,sl.starnum,sl.supports,sl.goodpoint,sl.weakpoint,f_p.author,f_p.authorid,f_p.message,f_p.dateline,f_p.rate",'conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}", 'join' => 'has_star'));
				//print_r($myreply);exit;
				if (is_array($myreply)) {
					foreach ($myreply as $k => $v) {
							$myreply[$k]['pid'] = $v['pid'];
							$myreply[$k]['starnum'] = $v['starnum'];
							$myreply[$k]['supports'] = $v['supports'];
							$myreply[$k]['goodpoint'] = $this->_set_br($v['goodpoint']);
							$myreply[$k]['weakpoint'] = $this->_set_br($v['weakpoint']);
							$myreply[$k]['author'] = $v['author'];
							$myreply[$k]['authorid'] = $v['authorid'];
							$myreply[$k]['message'] = $this->_set_br($v['message']);
							$myreply[$k]['rate'] = $v['rate'];
							$myreply[$k]['dateline'] = dgmdate($v['dateline'],'u');
					}
				}
				$mod_dianping_support = m('dianpingsupport');
				$data['supportlist'] = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
			}
			if(!$_G['uid']) {
				$guestallowpostreply = ($_G['forum']['allowreply'] != -1) && (($_G['forum_thread']['isgroup'] || (!$_G['forum_thread']['closed'] && !checkautoclose($_G['forum_thread']))) || $_G['forum']['ismoderator']) && ((!$_G['forum']['replyperm'] && $_G['perm']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'], $_G['perm']['groupid'])) || $_G['forum']['allowreply']);
			}
			$allowpostreply = ($_G['forum']['allowreply'] != -1) && (($_G['forum_thread']['isgroup'] || (!$_G['forum_thread']['closed'] && !checkautoclose($_G['forum_thread']))) || $_G['forum']['ismoderator']) && ((!$_G['forum']['replyperm'] && $_G['group']['allowreply']) || ($_G['forum']['replyperm'] && forumperm($_G['forum']['replyperm'])) || $_G['forum']['allowreply']);
			if(!$_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
				$allowpostreply = false;
			}
			if(!$_G['uid']) {
				$data['guestreply'] = $guestallowpostreply && !$allowpostreply;
			}
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
					}
				}
			}
			$multipage = multi($data['viewdata']['replies'], $perpage, $page, $data['url']."&act=showview&tid={$tid}");
			$data['likenum'] = $this->mod->getBrandUsersNum($tid,'likeit');
			$data['wantnum']= $this->mod->getBrandUsersNum($tid,'wantuse');
			$data['usednum'] = $this->mod->getBrandUsersNum($tid,'using');
			$data['likeitUsers'] = $this->mod->getLikeitUsersAtNew($tid);
			//调取装备分享数据
			$data['albumlist'] = $this->mod->getShareBytId($tid);
			$data['bsharenum'] = $this->mod->getShareNumberAtBrand($tid);

			//侧栏数据
			$module_cache = "brand";
			$cacheindex = $this->mod->get_cache_index($tid,$module_cache);
			$dzty_on =0;
			if($cacheindex){
				$data['articles_result'] = $this->mod->get_info_by_index("articles",$cacheindex);
				$data['zb_result'] = $this->mod->get_info_by_index("zb",$cacheindex);
				if($dzty_on==1){$data['dzty_result'] = $this->mod->get_info_by_index("dzty",$cacheindex);}
				$data['topics_result'] = $this->mod->get_info_by_index("topics",$cacheindex);
				$data['blogs_result'] = $this->mod->get_info_by_index("blogs",$cacheindex);
				$data['photos_result'] = $this->mod->get_info_by_index("photos",$cacheindex);
			}
			if($_G[uid]){
				$data['user_attentions'] = $this->mod->getTypeBytIdanduid($tid,$_G['uid']);
			}
			$data['myreply'] = $myreply;
			$data['replylist'] = $replyLists;
			$data['replymulti'] = $multipage;
			/*结束*/
			$data = array_merge($data, $this->mod->getPlugin('view', array_merge($data['viewdata'], $_GET)));
			/* designed to diy,
			$hotbrands = $this->mod->getHotBrand(30, array('name'));
			$data['hotbrands'] = $hotbrands;
			*/

			if (!empty($data['viewdata']['ranklist'])) {
				//获取排名信息
				$data['rank_info']=$this->mod->getBrandRanking($data['viewdata']['ranklist'],$data['viewdata']['tid']);
				//获取同排行榜的品牌，如果品牌属于多个排行榜取与第一个值相同的品牌
				$cptop = explode(',', $data['viewdata']['ranklist']);
				$cp=$cptop['0'];
				$where = " FIND_IN_SET('{$cp}',{$this->mod->alias}.{$this->mod->_vars[cptop]})";
				$data['cplist'] = $this->mod->getlist(array(
						'where' => $where,
						'limit' =>10,
						'order' => " ORDER BY bd.displayorder DESC,t.displayorder DESC,t.heats DESC "
				));
			}
			$data['pageTitle'] = str_replace('{page}', $page>1 ? ' - 第'.$_G['gp_page'].'页' : '', $data['pageTitle']);
			$this->assign($data);
			$this->display($this->mod->template['view']);
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
		$url = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$page = max(intval($_G['gp_page']), 1);
		$perpage = max($this->mod->commentlimit, 1);
		$start = ($page - 1) * $perpage;
		$mod_forum_post = m('forum_post');
		$replyList = $this->mod->getComment($tid,$start);
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
				}
			}
		}
		$max = DB::result_first("SELECT replies FROM ".DB::table('forum_thread')." WHERE tid = {$tid}");
		$multipage = multi($max, $perpage, $page, $url . "&act=showview&tid={$tid}");
		if ($_G['uid']) {
			$mod_dianping_support = m('dianpingsupport');
			$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
			$dianping = m('dianping');
			$data['myrate'] = max(intval($dianping->getMyRate($_G['uid'], $tid)), 0);
		}
		$this->assign($data);
		$this->assign('page', $page);
		$this->assign('list', $replyLists);
		$this->assign('multipage', $multipage);
		$this->assign('supportlist', $supportlist);
		$this->display($this->mod->template['replylist'] ? $this->mod->template['replylist'] : 'forum/dianping/replylist');
	}

	/**
	 * 进行发布或编辑操作，进行统一验证
	 * @author
	 */
	function dopost()
	{
		global $_G;
		cknewuser();
		$method = $_G['gp_do'];
		/*验证方法是否有效*/
		if (! in_array($method, $this->method_array)) {
			$this->showmessage('undefined_action');
		}
		//验证是否绑定手机号
		if(!$_G['member']['telstatus']) {
			showmessage('bindtel_tips', 'http://u.8264.com/home-setting.html#account-security');
		}

		/*编辑或回复操作，需要验证原帖的权限和状态*/
		if (in_array($method, array('edit', 'reply'))) {
			/*此处将在thread模型后再完善*/
			if ($thread = DB::fetch_first("SELECT * FROM " . DB::table('forum_thread') . " WHERE tid='$_G[tid]'" . ($_G['forum_auditstatuson'] ? '' : " AND (displayorder>='0' OR (displayorder IN ('-4', '-2') AND authorid='$_G[uid]'))"))) {
				if ($thread['readperm'] && $thread['readperm'] > $_G['group']['readaccess'] && ! $_G['forum']['ismoderator'] && $thread['authorid'] != $_G['uid']) {
					$this->showmessage('thread_nopermission', null, array('readperm' => $thread['readperm']), array('login' => 1));
				}
				$_G['fid'] = $thread['fid'];
			} else {
				$this->showmessage('thread_nonexistence');
			}
			if ($method == 'reply' && ($thread['closed'] == 1) && ! $_G['forum']['ismoderator']) {
				$this->showmessage('post_thread_closed');
			}
		}
		/*根据论坛权限公式计算用户权限*/
		formulaperm($_G['forum']['formulaperm']);
		/*判断当前时段是否可以发帖*/
		periodscheck('postbanperiods');
		/*论坛post权限检查: 新手实习期限，待member模型建立后会更新此处的查询语句*/
		if (! $_G['adminid'] && $_G['setting']['newbiespan'] && (! getuserprofile('lastpost') || TIMESTAMP - getuserprofile('lastpost') < $_G['setting']['newbiespan'] * 60)) {
			if (TIMESTAMP - (DB::result_first("SELECT regdate FROM " . DB::table('common_member') . " WHERE uid='$_G[uid]'")) < $_G['setting']['newbiespan'] * 60) {
				$this->showmessage('post_newbie_span', '', array('newbiespan' => $_G['setting']['newbiespan']));
			}
		}
		if (in_array($method, array('new', 'edit'))) {
			$this->check_allow_action('allowpost');
			if ($this->mod->getChildStatus('pic')) {
				/*处理图片上传的权限*/
				$_G['forum']['allowpostimage'] = isset($_G['forum']['allowpostimage']) ? $_G['forum']['allowpostimage'] : '';
				$_G['group']['allowpostimage'] = $_G['forum']['allowpostimage'] != -1 && ($_G['forum']['allowpostimage'] == 1 || (! $_G['forum']['postimageperm'] && $_G['group']['allowpostimage']) || ($_G['forum']['postimageperm'] && forumperm($_G['forum']['postimageperm'])));
				$_G['group']['attachextensions'] = $_G['forum']['attachextensions'] ? $_G['forum']['attachextensions'] : $_G['group']['attachextensions'];
				/*处理上传的图片类型*/
				if ($_G['group']['attachextensions']) {
					$imgexts = explode(',', str_replace(' ', '', $_G['group']['attachextensions']));
					$imgexts = array_intersect(array(
						'jpg',
						'jpeg',
						'gif',
						'png',
						'bmp'), $imgexts);
					$imgexts = implode(', ', $imgexts);
				} else {
					$imgexts = 'jpg, jpeg, gif, png, bmp';
				}
				/*此处计算用户是否超过当天的发布图片最大数量，是否超过当天发布图片的大小限制。待attachment的模型建立后，会更新查询语句*/
				if ($_G['group']['allowpostimage']) {
					if ($_G['group']['maxattachnum']) {
						$allowuploadnum = $_G['group']['maxattachnum'] - DB::result_first("SELECT count(*) FROM " . DB::table('forum_attachment') . " WHERE uid='$_G[uid]' AND pid>'0' AND dateline>'$_G[timestamp]'-86400");
						$allowuploadnum = $allowuploadnum < 0 ? 0 : $allowuploadnum;
					}
					if ($_G['group']['maxsizeperday']) {
						$allowuploadsize = $_G['group']['maxsizeperday'] - intval(DB::result_first("SELECT SUM(filesize) FROM " . DB::table('forum_attachment') . " WHERE uid='$_G[uid]' AND dateline>'$_G[timestamp]'-86400"));
						$allowuploadsize = $allowuploadsize < 0 ? 0 : $allowuploadsize;
						$allowuploadsize = $allowuploadsize / 1048576 >= 1 ? round(($allowuploadsize / 1048576), 1) . 'MB' : round(($allowuploadsize / 1024)) . 'KB';
					}
				}

				/*判定是否可以上传图片，如果不能上传图片将不可以发布滑雪场*/
				$allowpostimg = $_G['group']['allowpostimage'] && $imgexts;
				$maxattachsize_mb = $_G['group']['maxattachsize'] / 1048576 >= 1 ? round(($_G['group']['maxattachsize'] / 1048576), 1) . 'MB' : round(($_G['group']['maxattachsize'] / 1024)) . 'KB';
				if (! $allowpostimg)
					$this->showmessage('postattachperm_upgrade_nopermission_not_enter', null, array('action' => ($method == 'new' ? '发布' : '编辑')));
			}
		}
		$data['seccodecheck'] = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
		$data['secqaacheck'] = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
		if (! empty($_POST)) {
			if ($_G['formhash'] != $_POST['formhash']) {
				$this->showmessage('submit_invalid');
			}
		}
		call_user_func_array(array($this, '_'.$method.'post'), array($data));
	}

	/**
	 * 显示编辑页
	 * @author
	 */
	function _editpost($data)
	{
		global $_G;
		$tid = intval($_G['gp_tid']);
		$fid = intval($_G['gp_fid']);
		$pid = intval($_G['gp_pid']);

		if ($pid <= 0 || $tid <= 0)
			$this->showmessage('nopidandtid');
		if (! submitcheck('editsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data = $this->_getGlobalInit('post');
			$data['action'] = 'edit';
			$data['editdata'] = $this->mod->getview($tid);
			$data['editdata']['message'] = dhtmlspecialchars($data['editdata']['message']);
			$data['pid'] = $pid;
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
			$data['modstr'] = $this->modname;
			//note 初始化编辑器相关设置
			$editorid = 'e';
			$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
			$editormode = $_G['setting']['editoroptions']{0};
			$allowswitcheditor = $_G['setting']['editoroptions']{1};
			$editor = array(
				'editormode' => $editormode,
				'allowswitcheditor' => $allowswitcheditor,
				'allowhtml' => $_G['group']['allowhtml'],
				'allowhtml' => $_G['forum']['allowhtml'],
				'allowsmilies' => $_G['forum']['allowsmilies'],
				'allowbbcode' => $_G['forum']['allowbbcode'],
				'allowimgcode' => $_G['forum']['allowimgcode'],
				'allowresize' => 1,
				'textarea' => 'message',
				'simplemode' => !isset($_G['cookie']['editormode_'.$editorid]) ? 1 : $_G['cookie']['editormode_'.$editorid],
			);
			$data['editor']  = $editor;
			$data['editormode']  = $editormode;
			$data['editorid']  = $editorid;
			//编辑器配置结束
			$data['isfirstpost']  = 1;
			$data['allownoticeauthor'] = 1;
			//print_r($data);exit;
			//编辑器配置结束
			$data['letlist'] = $this->mod->_getLetterbyIndex();
			$data['brandlist'] = $this->mod->_getBrandNationAtIndex();

			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$pstatus = DB::fetch_first("SELECT COUNT(*) AS count, first, authorid FROM " . DB::table('forum_post') . " WHERE pid = {$pid}");
			$postdata = array_merge($_GET, $_POST);
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
				if(in_array($k, array('subject','message','ename','cname','city','url','company','address'))){
					$postdata[$k] = trim(dhtmlspecialchars($postdata[$k]));
				}
			}
			$postdata['en'] = $postdata['ename'];
			$postdata['cn'] = $postdata['cname'];
			$postdata['city'] = $postdata['city'];
			$postdata['company'] = $postdata['company'];
			$postdata['phone'] = $postdata['link'];
			$postdata['address'] = $postdata['address'];
			$postdata['nation'] = $postdata['nation'];
			$postdata['letter'] = $postdata['lett'];
			$postdata['url'] = $postdata['url'];
                        $postdata['tel'] = $postdata['link'];
			if ($_G['forum']['ismoderator'] != 1 && $pstatus['authorid'] != $_G['uid'])
				$this->showmessage('model_edit_nopermission');
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
			if ($pstatus['first'] == 1) {
				$this->mod->dopost($postdata, $tid, $pid);
			}
		}
	}

	/**
	 * 显示发布页
	 * @author
	 */
	function _newpost($data)
	{
		global $_G;
		$data = $this->_getGlobalInit('post');
		/*if (! $_G['group']['allowpostpoll'])
			$this->showmessage('group_nopermission', null, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));*/
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
		checklowerlimit('post', 0, 1, $this->mod->_fid);
		if (!submitcheck('topicsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])&&$_G['gp_arg']!='save') {
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'new';
			$data['modstr'] = $this->modname;
			$data['editdata'] = array();
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
			//编辑器配置结束
			$data['isfirstpost']  = 1;
			$data['allownoticeauthor'] = 1;
			$data['tagoffcheck'] = '';
			$data['showthreadsorts'] = !empty($sortid) || $_G['forum']['threadsorts']['required'] && empty($special);

			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				require_once libfile('function/post');
				$data['attachlist'] = getattach(0);
				$data['attachs']  = $data['attachlist']['attachs'];
				$data['imgattachs']  = $data['attachlist']['imgattachs'];
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
			$data['letlist'] = $this->mod->_getLetterbyIndex();
			$data['brandlist'] = $this->mod->_getBrandNationAtIndex();
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$postdata = array_merge($_GET, $_POST);
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
				if(in_array($k, array('subject','message','ename','cname','city','url','company','address'))){
					$postdata[$k] = trim(dhtmlspecialchars($postdata[$k]));
				}
			}

			$postdata['en'] = $postdata['ename'];
			$postdata['cn'] = $postdata['cname'];
			$postdata['company'] = $postdata['company'];
			$postdata['phone'] = $postdata['link'];
			$postdata['nation'] = $postdata['nation'];
			$postdata['letter'] = $postdata['lett'];
			$postdata['city'] = $postdata['city'];
			$postdata['url'] = $postdata['url'];
			$postdata['address'] = $postdata['address'];

			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
			$this->mod->dopost($postdata);
		}
	}

	/**
	 * 发/编辑 点评 - ajax
	 *
	 * @author
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

			if (!$postdata['starnum'] || !$postdata['goodpoint'] || !$postdata['weakpoint'] ) {
				$this->showmessage('点评数据不全');
			}

			// 简单验证
			$star_num = intval($postdata['starnum']);
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
						'goodpoint' => trim(dhtmlspecialchars($postdata['goodpoint'])),
						'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
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
							'goodpoint' => trim(dhtmlspecialchars($postdata['goodpoint'])),
							'weakpoint' => trim(dhtmlspecialchars($postdata['weakpoint'])),
							'lastupdate' => $_G['timestamp']
							));
					}
					$score = $mod_star_logs->updateStar($starid);
					if($score){
						$this->mod->edit("{$this->mod->_vars[tid]} = {$_G['tid']}", $this->mod->postdataHandle(array('score' => $score, 'lastscore' => $mod_star_logs->t_lastprice,'lastpost' => TIMESTAMP)));
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
}
?>
