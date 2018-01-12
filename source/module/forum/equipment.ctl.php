<?php
/**
 * 装备点评控制器
 *
 * @author lxp 20131029
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class EquipmentCtl extends DianpingCtl{
	var $modname = 'equipment';

	/**
	 * 列表页
	 *
	 * @author lxp 20131111
	 * !CodeTemplates.overridecomment.nonjd!
	 * @see DianpingCtl::showlist()
	 */
	function showlist(){
		global $_G;
		$data = $this->_getGlobalArgs('list');
		$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$data['current_url'] = $data['url'] . '&act=showlist';

		$whereBase = '1 = 1';
		$where = '';
		// 排序(分数不加入排序规则)
		$data['order'] = in_array($_G['gp_order'], array('heats', 'score', 'lastpost')) ? $_G['gp_order'] : 'lastpost' ;
		$data['current_url'] .= "&order={$data['order']}";
		if($data['order'] == 'lastpost'){
			$orders = " ORDER BY {$this->mod->alias}.displayorder DESC,t.{$data['order']} DESC ";
		}elseif($data['order'] == 'score'){
			$orders = " ORDER BY {$this->mod->alias}.{$data['order']} DESC ";
		}else{
			$orders = " ORDER BY {$this->mod->alias}.displayorder DESC,t.{$data['order']} DESC ";
		}

		$data['typelist'] = $this->mod->_getTypeClass();
		// 一级分类筛选
		$data['pcid'] = 0;
		if(intval($_G['gp_pcid'])){
			$data['pcid'] = intval($_G['gp_pcid']);
			foreach ($data['typelist'] as $v){
				if(is_array($v)){
					foreach ($v as $m){
						if($data['pcid'] == $m['cid']){
							$data['pcname'] = $m['name'];
						}
					}
				}
			}
			$where .= " AND {$this->mod->alias}.{$this->mod->_vars['pcid']} = {$data['pcid']}";
		}
		$data['current_url'] .= "&pcid={$data['pcid']}";
		// 二级分类筛选
		$data['cid'] = 0;
		if(intval($_G['gp_cid'])){
			$data['cid'] = intval($_G['gp_cid']);
			foreach ($data['typelist'] as $v){
				if(is_array($v)){
					foreach ($v as $m){
						if(is_array($m['children'])){
							foreach ($m['children'] as $n){
								if($data['cid'] == $n['cid']){
									$data['cname'] = $n['name'];
								}
							}
						}
					}
				}
			}
			$where .= " AND {$this->mod->alias}.{$this->mod->_vars['cid']} = {$data['cid']}";
		}
		$data['current_url'] .= "&cid={$data['cid']}";
		// 分类标题
		$title_cname = $data['cname'] ? $data['cname'] : ( $data['pcname'] ? $data['pcname'] : '' );
		$title_cname && $data['pageTitle'] = "户外{$title_cname}哪个好，户外{$title_cname}装备用品推荐大全{page} - 户外资料网";
		// 价格筛选
		if((intval($_G['gp_min']) || intval($_G['gp_max'])) ){
			$data['min'] = intval($_G['gp_min']);
			$data['max'] = intval($_G['gp_max']);
			if($data['min'] && $data['max'] && $data['max'] > $data['min']){
				$where .= " AND {$this->mod->alias}.{$this->mod->_vars['price']} BETWEEN '{$data['min']}' AND '{$data['max']}'";
			} else {
				$data['min'] && $where .= " AND {$this->mod->alias}.{$this->mod->_vars['price']} >= '{$data['min']}'";
				$data['max'] && $where .= " AND {$this->mod->alias}.{$this->mod->_vars['price']} < '{$data['max']}'";
			}

			if($data['min'] && $data['max']){
				$title_p = "{$data['min']}-{$data['max']}元";
			} elseif ($data['min']){
				$title_p = "{$data['min']}元以上";
			} elseif ($data['max']){
				$title_p = "{$data['max']}元以下";
			}
			$data['pageTitle'] = "{$title_cname}{$title_p}户外用品哪个好，{$title_cname}{$title_p}户外装备推荐{page} - 户外资料网";
		}
		// 品牌筛选
		$data['brandlist'] = $tempbrand = $this->mod->getListBrandlist($data);
		$data['letterlist'] = explode(',', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z');

		unset($tempbrand[0]);
		unset($tempbrand[-1]);
		$data['brandcount'] = count($data['brandlist']);
		if($data['brandcount'] > 20){
			$data['show_brand'] = array_slice($tempbrand, 0, 5);
		} else {
			$data['show_all_brand'] = $tempbrand;
		}
		$data['bid'] = 0;
		if(intval($_G['gp_bid']) || $_G['gp_bid'] == 'other'){
			$data['bid'] = $_G['gp_bid'];
			$true_bid = $data['bid'] == 'other' ? '-1' : intval($data['bid']);
			$data['has_other'] = false;
			foreach ($data['brandlist'] as $v){
				if($v['id'] == $true_bid){
					$data['bname'] = $v['brandname'];
					$data['btid'] = $v['brandtid'];
				}
				if($v['id'] == '-1'){
					$data['has_other'] = true;
				}
			}
			$where .= " AND {$this->mod->alias}.{$this->mod->_vars['bid']} = $true_bid";
			!$title_cname && $title_cname = '户外装备';
			$data['pageTitle'] = "{$data['bname']}{$title_p}{$title_cname}哪个好，{$data['bname']}{$title_p}{$title_cname}推荐{page} - 户外资料网";
		}
		$data['current_url'] .= "&bid={$data['bid']}";

		$content = $data['bname'] . $title_p . $title_cname;
		if($content) {
			$data['metakeywords'] = strtr('[content]大全,[content]哪个好,十大[content]排行榜', array(
				'[content]' => $content
			));
			$data['metadescription'] = strtr('2014年最新[content]推荐展示介绍,[content]排行榜大全,包括[content]价格、规格参数、照片以及用户真实使用点评使用心得，为驴友购买[content]提供最准确的参考信息。', array(
					'[content]' => $content
				));
		}

		$data['min'] && $data['current_url'] .= "&min={$data['min']}";
		$data['max'] && $data['current_url'] .= "&max={$data['max']}";

		// 处理分页
		if($this->mod->_moduleinfo['maxcount'] > 0 && empty($where)){
			$max = $this->mod->_moduleinfo['maxcount'];
		}else{
			$where = $whereBase . $where;
			$max = current($this->mod->get(array('fields' => 'COUNT(*) AS count', 'conditions' => $where . " AND equ.ispublish = 1")));
		}
		$perpage = max($this->mod->limit, 1);
		$page = max(intval($_G['gp_page']), 1);
		$start = ($page - 1) * $perpage;
		$realpages = @ceil($max / $perpage);
		$data['multipage'] = multi($max, $perpage, $page, $data['current_url']);
		// 加缓存应对负载 at 20140604 by zhl
		if (array_key_exists('lastpost', $orders)&&!intval($_G['gp_pcid'])&&!intval($_G['gp_cid'])&&!intval($_G['gp_min'])&& !intval($_G['gp_max'])&&!intval($_G['gp_bid'])) {
			if($_G['uid']==1){
				memory('rm', 'cache_dianping_equipment_list_'.$page);
			}
			$list = memory('get', 'cache_dianping_equipment_list_' . $page);
			if (!$list){
				$list = $this->mod->getlist(array('start' => $start,
						'order' => $orders,
						'where' => $where));
				memory('set', 'cache_dianping_equipment_list_' . $page, $list, 43200);	//12*3600=43200更新一次
			}
		}else{
			$list = $this->mod->getlist(array('start' => $start,
						'order' => $orders,
						'where' => $where));
		}
		//end
		$data['list'] = $list;
		// 取得数据
		//$data['list'] = $this->mod->getlist(array(
		//		'start' => $start,
		//		'order' => $orders,
		//		'where' => $where
		//));
		// 分类列表
		$data['sidebar_type'] = $this->mod->find(array(
				'fields' => "{$this->mod->_vars['cid']}, {$this->mod->_vars['cname']}, COUNT(*) as count",
				'conditions' => "{$this->mod->_vars['enable']} = 1 GROUP BY {$this->mod->_vars['cid']}",
				'order' => 'count DESC',
		));
		$data['sidebar_tcount'] = 0;
		foreach ($data['sidebar_type'] as $v){
			$data['sidebar_tcount'] += $v['count'];
		}
		$data['pageTitle'] = str_replace('{page}', $page>1 ? ' - 第'.$_G['gp_page'].'页' : '', $data['pageTitle']);
		$this->assign($data);
		$this->display($this->mod->template['list']);
	}

	/**
	 * 详细页
	 *
	 * @author lxp 20131119
	 * !CodeTemplates.overridecomment.nonjd!
	 * @see DianpingCtl::showview()
	 */
	function showview(){
		global $_G;
		$tid = intval($_G['gp_tid']);
		if ($tid <= 0) {
			$this->showlist();
			die();
		}
		$data = $this->_getGlobalArgs('view');
		$data['viewdata'] = $this->mod->getview($tid);

		if (empty($data['viewdata'])){
			$this->showmessage('thread_nonexistence');
		}
		// 处理简介
		require_once libfile('function/newdiscuzcode');
		$data['viewdata']['message'] = discuzcode($data['viewdata']['message']);
		// 处理图片
		if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $data['viewdata']['message'], $matches)) {
			$aids = $matches[1];
			require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
			$attachserver = new attachserver;
			foreach ($aids as $aid) {
				$attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid,dir FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
				if ($attachment['isimage']) {
					if($attachment['serverid']>0){
						$domain  = $attachserver->get_server_domain($attachment['serverid'], '*');
						$path = "http://".$domain['name']."/{$attachment[dir]}/".$attachment['attachment'];
						$path .= attachserver::getPreStr($domain, 'forum', true, true);
					}elseif($attachment['remote']){
						$path = $_G['setting']['ftp']['attachurl'].'forum/'.$attachment['attachment'];
					}else{
						$path = $_G['setting']['attachurl'].'forum/'.$attachment['attachment'];
					}
				}
				if($attachment['width']>650){
					$data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="'.$data['viewdata']['subject'].'" title="'.$data['viewdata']['subject'].'" width="650px;" />', $data['viewdata']['message']);
				}else{
					$data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="'.$data['viewdata']['subject'].'" title="'.$data['viewdata']['subject'].'" />', $data['viewdata']['message']);
				}
			}
		}
		$data['viewdata']['message'] = trim($data['viewdata']['message']);
		$data['pageTitle'] = str_replace('[subject]', $data['viewdata']['name'], $data['pageTitle']);
		$data['metakeywords'] = str_replace('[subject]', $data['viewdata']['name'], $data['metakeywords']);
		$data['metadescription'] = str_replace('[subject]', $data['viewdata']['name'], $data['metadescription']);

		// 取得图片列表
		$data['piclist'] = $this->_getimgbytidpid($tid, $data['viewdata']['pid'], 'plugin', false, 5);
		if (empty($data['piclist'])) {
			$data['piclist'][0]['attachment'] = $data['viewdata']['attachment'];
			$data['piclist'][0]['dir'] = 'plugin';
			$data['piclist'][0]['url'] = $_G['config']['web']['attach'] . 'plugin/';
		}
		$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$data['brandUrl'] = $_G['config']['web']['portal'];// "forum.php?ctl=brand";
		// 取得评分数据
		$dianpingshow = m('dianpingshow');
		$data['star_data'] = $dianpingshow->getData($tid);
		// 当前用户回复
		$mod_forum_post = m('forum_post');
		$data['my_comment'] = array();
		$data['my_comment'] = $mod_forum_post->get(array(
				'fields'     => 'f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate,sl.starid, sl.starnum, sl.goodpoint, sl.weakpoint, sl.extdata, sl.supports',
				'conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}",
				'join'       => 'has_star'
		));
		$data['my_comment'] = $this->_makereply($data['my_comment']);
		/*增加初始时获得第一页的评论列表*/
		$page = max(1, $_G['gp_page']);
		$data['page'] = $page;
		$perpage =  max($this->mod->commentlimit, 1);
		$start = ($page - 1) * $perpage;
		$replyList = $mod_forum_post->find(array(
				'fields'     => 'f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message,f_p.rate, sl.starid, sl.starnum, sl.goodpoint, sl.weakpoint, sl.extdata, sl.supports',
				'conditions' => "f_p.tid={$tid} AND f_p.first=0",
				'order'      => 'sl.stickreply DESC, f_p.dateline DESC',
				'limit'      => "{$start}, {$this->mod->commentlimit}",
				'join'       => 'has_star'
		));
		if (is_array($replyList)) {
			foreach ($replyList as $k => $v) {
				if($v['authorid'] == $_G['uid']){
					unset($replyList[$k]);
					continue;
				}
				$replyList[$k] = $this->_makereply($v);
			}
		}
		$multipage = multi($data['viewdata']['replies'], $perpage, $page, $data['url'] . "&act=showview&tid={$tid}");

		if ($_G['uid']) {
			$mod_dianping_support = m('dianpingsupport');
			$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
		}
		$data['replylist'] = $replyList;
		$data['replymulti'] = $multipage;
		$data['supportlist'] = $supportlist;
		/*结束*/

		// 侧栏帖子
		if($data['viewdata']['tids']!=''){
			// 防失(sha)误(gua)操作处理
			$tids_str = str_replace('，', ',', $data['viewdata']['tids']);
			$tids_array = explode(',', $tids_str);
			foreach ($tids_array as $k => $tid){
				$tids_array[$k] = intval($tid);
				if(!$tids_array[$k]){
					unset($tids_array[$k]);
				}
			}
			$tids = implode(',', $tids_array);

			$mod_thread = m('forum_thread');
			$tids && $data['threadlist'] = $mod_thread->find(array(
					'fields' => 'f_t.authorid, f_t.subject, f_t.views, f_t.replies',
					'conditions' => "f_t.tid IN ($tids)",
			));
		}
		$data['viewdata']['sidelist_desc'] = 'lastpost';

		//同分类装备
		$data['equal_type']=$this->mod->getlist(array(
									'where'=>'id !='.$data['viewdata']['id'].' and cid='.$data['viewdata']['cid'],
									'order'=>array('displayorder'=>'DESC'),
									'limit'=>'5',
									));

		//同品牌装备
		$data['equal_brand']=$this->mod->getlist(array(
									'where'=>'brandid='.$data['viewdata']['bid'],
									'limit'=>'5',
									));
		$data = array_merge($data, $this->mod->getPlugin('view', array_merge($data['viewdata'], $_GET)));
		//call 10 hot brands to display  designed to diy
		//$data['hotbrands'] = m('brand')->getHotBrand(10, array('name', 'score', 'pic'));

		$this->assign($data);
		$this->display($this->mod->template['view']);
	}

	/**
	 * @author lxp 20131120
	 * !CodeTemplates.overridecomment.nonjd!
	 * @see DianpingCtl::_newpost()
	 */
	function _newpost($data) {
		global $_G;
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
		$data = array_merge($data, $this->_getGlobalArgs('post'));
		if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'new';
			if($this->mod->getChildStatus('pro')){
				$data['regions'] = $this->mod->getRegions(0, 2, true, true);
				$data['nowregion'] = $this->mod->getRegionByIp($_G['clientip']);
			}
			// 取得分类列表
			if($this->mod->getChildStatus('typeclass')){
				$data['typelist'] = $this->mod->_getTypeClass();
			}
			// 取得品牌列表
			if($this->mod->getChildStatus('brand')){
				$mod_brand = m('brand');
				$data['brandlist'] = $mod_brand->find(array(
						'fields' => 'id, subject, tid, letter',
						'conditions' => "ispublish = 1",
						'order' => 'subject'
				));
			}
			$data['letterlist'] = explode(',', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z');

			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				require_once libfile('function/post');
				$attachlist = getattach(0);
				$data['attachs'] = $attachs = $attachlist['attachs'];
				$data['imgattachs'] = $imgattachs = $attachlist['imgattachs'];
				unset($attachlist);
			}
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

			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$postdata = array_merge($_GET, $_POST);

			//公司内部人员才能添加导购链接
			if($_G['groupid'] != 1) {
				unset($postdata['dgurl']);
			}

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
			$postdata['dateline'] = TIMESTAMP;
			$postdata['lastpost'] = TIMESTAMP;
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
			$this->mod->dopost($postdata);
		}
	}

	/**
	 * 编辑帖子
	 *
	 * @author lxp 20131119
	 * !CodeTemplates.overridecomment.nonjd!
	 * @see DianpingCtl::_editpost()
	 */
	function _editpost($data) {
		global $_G;
		$data['tid'] = $tid = intval($_G['gp_tid']);
		$data['pid'] = $pid = intval($_G['gp_pid']);
		if ($pid <= 0 || $tid <= 0)
			$this->showmessage('nopidandtid');
		$data = array_merge($data, $this->_getGlobalArgs('post'));
		if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['editdata'] = $this->mod->getview($tid);
			$data['editdata']['message'] = dhtmlspecialchars($data['editdata']['message']);
			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				require_once libfile('function/post');
				$attachlist = getattach($pid, 0, 'all');
				foreach($attachlist['imgattachs']['used'] as $_k => $_v){
					if($_v['aid'] == $data['editdata']['kaid']){
						unset($attachlist['imgattachs']['used'][$_k]);
						break;
					}
				}
				$data['attachs'] = $attachs = $attachlist['attachs'];
				$data['imgattachs'] = $imgattachs = $attachlist['imgattachs'];
				unset($attachlist);
				$attachfind = $attachreplace = array();
				if(!empty($attachs['used'])) {
					foreach($attachs['used'] as $attach) {
						if($attach['isimage']) {
							$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
							$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
						}
					}
				}
				if(!empty($imgattachs['used'])) {
					foreach($imgattachs['used'] as $attach) {
						$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
						$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
					}
				}

				$attachfind && $data['editdata']['message'] = preg_replace($attachfind, $attachreplace, $data['editdata']['message']);
			}

			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'edit';

			if($this->mod->getChildStatus('pro')){
				$data['regions'] = $this->mod->getRegions(0, 2, true, true);
				$data['nowregion'] = array('name' => $data['editdata']['proname'], 'id' => $data['editdata']['pro']);
			}
			// 取得分类列表
			$data['typelist'] = $this->mod->_getTypeClass();
			// 取得品牌列表
			$mod_brand = m('brand');
			$data['brandlist'] = $mod_brand->find(array(
					'fields' => 'id, subject, tid, letter',
					'conditions' => "ispublish = 1",
					'order' => 'subject'
			));
			$data['letterlist'] = explode(',', 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z');

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
			if( $data['editdata']['kaid'] > 0){
				require_once DISCUZ_ROOT . './source/plugin/attachment_server/attachment_server.class.php';
				$attachserver = new attachserver;
				$attachlist = $attachserver->get_server_domain($data['editdata']['serverid'], '*');
				$data['editdata']['fmurl'] = "http://" . $attachlist['name'] . '/';
				if(is_array($attachlist['api'])){
					if( $attachlist['api']['class'] ) {
	            		$_callback = array( $attachlist['api']['class'], $attachlist['api']['function'] );
	            	} else {
	            		$_callback = $attachlist['api']['function'];
	            	}
	            	$data['editdata']['showimg'] .= call_user_func_array( $_callback, array('forum', true, true, true ));
				}
			}else{
				$data['editdata']['fmurl'] = $_G['config']['web']['attach'];
			}
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$pstatus = DB::fetch_first("SELECT COUNT(*) AS count, first, authorid FROM " . DB::table('forum_post') . " WHERE pid = {$pid}");
			$postdata = array_merge($_GET, $_POST);

			//公司内部人员才能添加导购链接
			if($_G['groupid'] != 1) {
				unset($postdata['dgurl']);
			}

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

			if ($_G['forum']['ismoderator'] != 1 && $pstatus['authorid'] != $_G['uid'])
				$this->showmessage('model_edit_nopermission');
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
			if ($pstatus['first'] == 1) {
				$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
				$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
				$this->mod->dopost($postdata, $tid, $pid);
			}
		}
	}


	function getNopiclist(){
		$this->mod->getTidsbyNopic();
	}
}
?>
