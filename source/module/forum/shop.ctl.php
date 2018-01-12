<?php
/**
 * ����ϵͳ���̿��Ʋ�
 * @author Ghl
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class ShopCtl extends DianpingCtl{
	var $modname = 'shop';
	/**
	 * ��Ĭ��ҳת���б�ҳ
	 */
	function index() {
		$this->showlist();
	}
	/**
	 * �б�ҳ��
	 */
	function showlist() {
		global $_G;
		$data = $this->_getGlobalArgs('list');
		$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$data['current_url'] = $data['url'] . '&act=showlist';
		$whereBase = '1 = 1';
		$where = '';
		$data['pid'] = 0;
		if(intval($_G['gp_pid'])){
			$data['pid'] = intval($_G['gp_pid']);
			$where .= " AND {$this->mod->alias}.{$this->mod->_vars['pro']} = {$data['pid']}";	
		}
		$data['current_url'] .= "&pid={$data['pid']}";
		$data['rid'] = 0;
		if(intval($_G['gp_rid'])){
			$data['rid'] = intval($_G['gp_rid']);
			$where .= " AND {$this->mod->alias}.{$this->mod->_vars['reg']} = {$data['rid']}";	
		}
		$data['current_url'] .= "&rid={$data['rid']}";
		$data['sid'] = 0;
		if(intval($_G['gp_sid'])){
			$data['sid'] = intval($_G['gp_sid']);
			if($data['sid']==2){
				$where .= "  AND {$this->mod->alias}.{$this->mod->_vars['shop']} >= 1";	
			}elseif($data['sid']==1){
				$where .= "  AND {$this->mod->alias}.{$this->mod->_vars['shop']} = '0'";
			}elseif($data['sid']!=''){
				$where .= " AND {$this->mod->alias}.{$this->mod->_vars['shop']} = {$data['sid']}";
			}
		}
		$data['current_url'] .= "&sid={$data['sid']}";
		$data['cid'] = 0;
		if(intval($_G['gp_cid'])){
			$data['cid'] = intval($_G['gp_cid']);
			$where .= " AND {$this->mod->alias}.{$this->mod->_vars['cb']} = {$data['cid']}";	
		}
		$data['current_url'] .= "&cid={$data['cid']}";
		$data['bid'] = 0;
		if(intval($_G['gp_bid'])){
			$data['bid'] = intval($_G['gp_bid']);
			$where .= " AND {$this->mod->alias}.{$this->mod->_vars['sb']} = {$data['bid']}";	
		}
		$data['current_url'] .= "&bid={$data['bid']}";
		$data['order'] = in_array($_G['gp_order'], array('dateline', 'score', 'heats','lastpost')) ? $_G['gp_order'] : 'lastpost' ;
		$data['current_url'] .= "&order={$data['order']}";
		if($data['order']!='score'){
			$orders = " ORDER BY t.{$data['order']} DESC ";
		}else{
			$orders = " ORDER BY st.{$data['order']} DESC";
		}
		//��ȡ����
		$arr_region = $this->mod->getRegionListbyshop($data[cid],$data[bid]);
		$arr_region = $this->sortByCol($arr_region, 'count', SORT_DESC);
		if (intval($_G['gp_pid'])) {
			$data['pname'] = $this->getCategoryByKey($_G['gp_pid'],'catid','name',$arr_region);
		}
		//��ȡ����
		$arr_city = $this->mod->getRegionlist($data[pid],$data[cid],$data[bid]);
		if (intval($_G['gp_rid'])) {
			$data['rname'] = $this->getCategoryByKey($_G['gp_rid'],'catid','name',$arr_city);
		}
		//�ж��Ƿ�ֱߵ�
		$is_jiebian = $this->mod->isJiebian($data[pid],$data[rid]);
		//��ȡ�̳�����
		$arr_market = $this->mod->getMarketList($data[pid],$data[rid]);
		if (intval($_G['gp_sid']) > 2) {
			$data['sname'] = $this->getCategoryByKey($_G['gp_sid'],'id','market',$arr_market);
		}
		//��ȡ����Ʒ��
		$arr_chain = $this->mod->getChainList($data[pid],$data[rid],$data[sid]);
		$arr_chain = $this->sortByCol($arr_chain, 'count', SORT_DESC);
		if (intval($_G['gp_cid'])) {
			$data['cname'] = $this->getCategoryByKey($_G['gp_cid'],'id','chainbrand',$arr_chain);
		}
		//��ȡ��ӪƷ��
		$arr_brand = $this->mod->getBrandList($data[pid],$data[rid],$data[sid]);
		$arr_brand = $this->sortByCol($arr_brand, 'count', SORT_DESC);
		if (intval($_G['gp_bid'])) {
			$data['bname'] = $this->getCategoryByKey($_G['gp_bid'],'id','brand',$arr_brand);
		}
				
		// �����ҳ
		if($this->mod->_moduleinfo['maxcount'] > 0 && empty($where)){
			$max = $this->mod->_moduleinfo['maxcount'];
		}else{
			$where = $whereBase . $where;
			$max = current($this->mod->get(array('fields' => 'COUNT(*) AS count', 'conditions' => $where)));
		}
		
		$perpage = max($this->mod->limit, 1);
		$page = max(intval($_G['gp_page']), 1);
		$start = ($page - 1) * $perpage;
		$realpages = @ceil($max / $perpage);
		$data['multipage'] = multi($max, $perpage, $page, $data['current_url']);
		$data['count_shop'] = $max;
		// ȡ������
		
		//echo $where;exit;
		$arr_list = $this->mod->getlist(array(
				'start' => $start,
				'order' => $orders,
				'where' => $where
		));	
		$arr_market_all = $this->mod->getAllMarket();
		if (is_array($arr_list)) {
			foreach ($arr_list as $k=>$v) {
				$arr_list[$k]['p_name'] = $this->getCategoryByKey($v['provinceid'],'catid','name',$arr_region);
				$arr_list[$k]['r_name'] = $this->getCategoryByKey($v['regionid'],'catid','name',$arr_city);
				$arr_list[$k]['s_name'] = $this->getCategoryByKey($v['marketid'],'id','market',$arr_market_all);
			}
		}
		$data['list'] = $arr_list;			
		//��ȡ���µ���
		$arr_new = $this->mod->getlist(array(
				'limit' => '8',
				'order' => array('id' => 'DESC')
		));	
		//��ȡ���۴�����Ϣ
		$thread = m('forum_thread');
		$arr_dzcx = $thread->find(array("fields" => "tid,subject","conditions" => "fid=174 and displayorder=0","order" => "dateline DESC",'limit'=>'10'));
		
		$title = $data['pname'].$data['rname'].$data['sname'].$data['bname'].$data['cname'];
		if ($title) {
			$data['pageTitle'] = $data['metakeywords'] = "{$title}����������Ʒ��|ר���� ����װ��ר���� - ����������";
			$data['metadescription'] = strtr('2014��[province][city][bname]��Ʒ���ѯ���ڱ���������Ϣ��ʵ�ɿ�����¿�ѹ���װ������Ҫ�ο� ,���������� ,����������', array(
							'[province]' => $data['pname'],
							'[city]' => $data['rname'],
							'[bname]' => $data['bname'] ? $data['bname'] : '����',
							'[shop]' => $data['sid'] ? ($data['sid'] == 1 ? '�ֱߵ�' : 'ר����') : ''

				));
		}
		$this->assign($data);
		$this->assign('arrRegion',$arr_region);
		$this->assign('arrCity',$arr_city);
		$this->assign('isJiebian',$is_jiebian);
		$this->assign('arrMarket',$arr_market);
		$this->assign('arrChain',$arr_chain);
		$this->assign('arrBrand',$arr_brand);
		$this->assign('arrShop',$arr_shop);
		$this->assign('arrNew',$arr_new);
		$this->assign('arrDzcx',$arr_dzcx);
		$this->display($this->mod->template['list']);
	}
	/**
	 * ���̵�����ʾҳ��
	 *
	 */
	function showview() {
		global $_G;
		$tid = intval($_G['gp_tid']);
		if ($tid <= 0) {
			$this->showlist();
		} else {
			$data = $this->_getGlobalArgs('view');
			$data['viewdata'] = $this->mod->getview($tid);
			if (empty($data['viewdata'])){
				$this->showmessage('thread_nonexistence');
			}
			// ������
			require_once libfile('function/newdiscuzcode');
			$data['viewdata']['message'] = discuzcode($data['viewdata']['message']);
			// ����ͼƬ
			if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $data['viewdata']['message'], $matches)) {
				$aids = $matches[1];
				require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				$attachserver = new attachserver;
				foreach ($aids as $aid) {
					$attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
					if ($attachment['isimage']) {
						if($attachment['serverid']>0){
							$domain  = $attachserver->get_server_domain($attachment['serverid']);
							$path = "http://".$domain['name']."/forum/".$attachment['attachment'];
							$path .= attachserver::getPreStr($domain, 'forum', true, true);
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
			$data['viewdata']['message'] = trim($data['viewdata']['message']);
			$data['viewdata']['message'] = $this->mod->parseBrandUrl($data['viewdata']['message']);	//����������Ʒ������
			$data['pageTitle'] = str_replace('[subject]', $data['viewdata']['name'], $data['pageTitle']);
			$data['metakeywords'] = str_replace('[subject]', $data['viewdata']['name'], $data['metakeywords']);
			$data['metadescription'] = str_replace('[subject]', $data['viewdata']['name'], $data['metadescription']);
			// ȡ��ͼƬ�б�
			$data['piclist'] = $this->_getimgbytidpid($tid, $data['viewdata']['pid'], 'plugin', false, 5);
			if (empty($data['piclist'])) {
				$data['piclist'][0]['attachment'] = $data['viewdata']['attachment'];
				$data['piclist'][0]['url'] = $_G['config']['web']['attach'] . 'plugin/';
			}
//			$data['piclist'] = array_reverse($data['piclist']);	
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['img_url'] = $_G['config']['web']['attach'] . 'plugin/';
			// ȡ����������
			$dianpingshow = m('dianpingshow');
			$data['star_data'] = $dianpingshow->getData($tid);
			// ��ǰ�û��ظ�
			$mod_forum_post = m('forum_post');
			$data['my_comment'] = array();
			$data['my_comment'] = $mod_forum_post->get(array(
					'fields'     => 'f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate,sl.starid, sl.starnum, sl.goodpoint, sl.weakpoint, sl.extdata, sl.supports',
					'conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}",
					'join'       => 'has_star'
			));
			$data['my_comment'] = $this->_makereply($data['my_comment']);

			/*���ӳ�ʼʱ��õ�һҳ�������б�*/
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

			$multipage = multi($data['viewdata']['replies'], $perpage, $page, $data['url'] . "&act=showview&tid=$tid");

			if ($_G['uid']) {
				$mod_dianping_support = m('dianpingsupport');
				$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
			}
			$data['replylist'] = $replyList;
			$data['replymulti'] = $multipage;
			$data['supportlist'] = $supportlist;
			//��ȡͬ�����µ���
			$arr_city_new = $this->mod->getlist(array(
					'where'=>'regionid ='.$data['viewdata']['regionid'],
					'limit' => '5',
					'order' => array('id' => 'DESC')
			));
			//��ȡͬ�����ŵ���
			$arr_city_hot = $this->mod->getlist(array(
					'where'=>'regionid ='.$data['viewdata']['regionid'],
					'limit' => '5',
					'order' => array('score' => 'DESC')
			));

			//��ȡ����
			$data['arrCityHot']=$arr_city_hot;
			$data['arrCityNew']=$arr_city_new;
			$data['province'] = $this->mod->getRegionById($data['viewdata']['provinceid']);
			$data['region'] = $this->mod->getRegionById($data['viewdata']['regionid']);
			$data['sbrand'] = $this->mod->getSbrandById($data['viewdata']['sbrandid']);
			$data['market'] = $this->mod->getMarketById($data['viewdata']['marketid']);
			$data['cbrand'] = $this->mod->getChainBrandById($data['viewdata']['cbrandid']);
			$data['spfj'] = $this->mod->getShopNearbyjw($data['viewdata']['lon'],$data['viewdata']['lat'],$data['viewdata']['tid']);
			$data['qt'] = $this->mod->getsShopListbyShop($data['viewdata']['regionid'],$data['viewdata']['marketid'],$data['viewdata']['tid']);
			$data['dqls'] = $this->mod->getShopcBrandbysBrand($data['viewdata']['provinceid'],$data['viewdata']['cbrandid'],$data['viewdata']['tid']);
			//call 10 hot brands to display  designed to diy
			//$data['hotbrands'] = m('brand')->getHotBrand(10, array('name', 'score', 'pic'));
			$this->assign($data);
			error_log($this->mod->template['view']);
			$this->display($this->mod->template['view']);
		}

	}
	/**
	 * ��/�༭ ���� - ajax
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
			$postdata = iconv_array($postdata, 'UTF-8', 'GBK'); // jquery ajax�ύת��
			// ����֤
			$star_num = intval($postdata['starnum']);
			// ��ʼ��ģ��
			$mod_forum_post = m('forum_post');
			$mod_star_logs = m('dianping');
			if (isset($postdata['ext']) && $postdata['ext'] == 'edit') {
				// �޸�����
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

						//$this->mod->edit("{$this->mod->_vars[tid]} = {$_G['tid']}", $this->mod->postdataHandle(array('score' => $score)));

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
				// ������������
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
						$this->mod->edit("{$this->mod->_vars[tid]} = {$_G['tid']}", $this->mod->postdataHandle(array('score' => $score, 'lastscore' => $mod_star_logs->t_lastprice)));		
					}					
				}
				//�����ȶ�
				$thread = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid='$_G[tid]'");
				$heat = $thread['heats'];	
				if($thread['lastposter'] != $_G['member']['username']) {
					$posttable = getposttablebytid($_G['tid']);
					$userreplies = DB::result_first("SELECT COUNT(*) FROM ".DB::table($posttable)." WHERE tid='$_G[tid]' AND first='0' AND authorid='$_G[uid]'");
					$thread['heats'] += round($_G['setting']['heatthread']['reply'] * pow(0.8, $userreplies));		
					DB::query("UPDATE ".DB::table('forum_thread')." SET heats='$thread[heats]' WHERE tid='$_G[tid]'", 'UNBUFFERED');		
				}
				// ��ظ���
				$lastpost = "{$_G['tid']}\t\t{$_G['timestamp']}\t{$_G['username']}";
				DB::query("UPDATE " . DB::table('forum_forum') . " SET lastpost='$lastpost', posts=posts+1, todayposts=todayposts+1 WHERE fid='{$this->mod->_fid}'", 'UNBUFFERED');
				require_once libfile('function/stat');
				updatestat('post');
				$typeid = DB::result_first("SELECT typeid FROM " . DB::table('forum_thread') . " WHERE tid='{$_G['tid']}'");
				DB::query("UPDATE " . DB::table('forum_threadclass') . " SET todayposts=todayposts+1 WHERE typeid='$typeid'", 'UNBUFFERED');
				updatepostcredits('+', $_G['uid'], 'reply', $this->mod->_fid); // ���»���
				$mod_thread = m('forum_thread');
				$mod_thread->edit($_G['tid'], "replies=replies+1, lastpost='{$_G['timestamp']}', lastposter='{$_G['username']}'");
				// ���µ�������
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
	/**
	 * ��������
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
		$_G['fid'] =  $this->mod->_fid;
		checklowerlimit('post', 0, 1, $this->mod->_fid);
		$data = array_merge($data, $this->_getGlobalArgs('post'));
		if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'new';
			if($this->mod->getChildStatus('pro')){
				$data['regions'] = $this->mod->getRegions(0, 2, true, true);
				$data['nowregion'] = $this->mod->getRegionByIp($_G['clientip']);
			}
			$arr_brand = $this->mod->getBrandAll();
			$data['brand'] = $this->sortByCol($arr_brand, 'count', SORT_DESC);
			
			$arr_chain = $this->mod->getChainAll();
			$data['chain'] = $this->sortByCol($arr_chain, 'count', SORT_DESC);


			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				require_once libfile('function/post');
				$attachlist = getattach(0);
				$data['attachs'] = $attachs = $attachlist['attachs'];
				$data['imgattachs'] = $imgattachs = $attachlist['imgattachs'];
				unset($attachlist);
			}
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$postdata = array_merge($_GET, $_POST);
			$postdata['pro'] = $postdata['province'];
			$postdata['reg'] = $postdata['region'];
			$postdata['longi'] = $postdata['lon'];
			$postdata['lati'] = $postdata['lat'];
			if (trim($postdata['market']) && $postdata['shoptype'] == '1') {
				$postdata['shop'] = $this->mod->getShopId(trim($postdata['market']));
			} else {
				$postdata['shop'] = '0';
			}
			if (trim($postdata['brand']) && $postdata['types'] == '1') {
				$postdata['sb'] = $this->mod->getBrandId(trim($postdata['brand']));
			} else {
				$postdata['sb'] = '0';
			}	
			if (trim($postdata['chainbrand']) && $postdata['chain'] == '1') {
				$postdata['cb'] = $this->mod->getChainId(trim($postdata['chainbrand']));	
			} else {
				$postdata['cb'] = '0';
			}		
				
			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
			$postdata['dateline'] = TIMESTAMP;
			
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
				$postdata['spid'] = $postdata['imgselect'][0];
			$this->mod->dopost($postdata);
		}
	}
	/**
	 * ��ʾ�༭ҳ
	 */
	function _editpost($data)
	{
		global $_G;
		$tid = intval($_G['gp_tid']);
		$pid = intval($_G['gp_pid']);
		if ($pid <= 0 || $tid <= 0)
			$this->showmessage('nopidandtid');
		if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['editdata'] = $this->mod->getview($tid);
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'edit';
			$data['shop'] = $this->mod->getMarketById($data['editdata']['shop']);
			$data['sb'] = $this->mod->getSbrandById($data['editdata']['sb']);
			$data['cb'] = $this->mod->getChainBrandById($data['editdata']['cb']);

			if($this->mod->getChildStatus('pro')){
				$data['regions'] = $this->mod->getRegions(0, 2, true, true);
				$data['nowregion'] = array('name' => $data['editdata']['proname'], 'id' => $data['editdata']['pro']);
			}
			$arr_brand = $this->mod->getBrandAll();
			$data['brand'] = $this->sortByCol($arr_brand, 'count', SORT_DESC);
			
			$arr_chain = $this->mod->getChainAll();
			$data['chain'] = $this->sortByCol($arr_chain, 'count', SORT_DESC);
			//�����ݴ���(��ǰ��ͼƬ���att��)
			if ($data['editdata']['sPid'] == '0') {
				$image=getimagesize($data['editdata']['pic']);
				$attachment = $data['editdata']['attachment'];
				$name = explode('.',$attachment);
				$img = array();
				$img['width'] = $image[0];
				$img['type'] = $image['mime'];
				$img['name'] = $data['editdata']['tid'].'.'.$name[1];
				$img['time'] = $_G['timestamp'];
				$arr_info = DB::fetch_first("SELECT attachment AS pic FROM ".DB::table('forum_attachment')." WHERE tid = '".$data['editdata']['tid']."' and attachment = '$attachment'");
				if (empty($arr_info['pic'])) {
		            DB::query("INSERT INTO ".DB::table('forum_attachment')." (tid, pid, dateline, readperm, price, filename, filetype, filesize, attachment, downloads, isimage, uid, thumb, remote, width, serverid, dir)
					VALUES ('".$data['editdata']['tid']."', '".$data['editdata']['pid']."', '$_G[timestamp]', '0', '0', '".$img['name']."', '".$img['type']."', '1024', '".$attachment."', '0', '1', '".$_G['uid']."', '0', '0', '".$img['width']."', '1', 'plugin')");
		            $aid = DB::insert_id();
		            if ($aid > 0) {
						$edit_pid   = m("shop");
						$edit_pid->edit("id = ".$data['editdata']['sid'], array("sPid"=>$aid));
		            }					
				}	
			}
			$data['pageTitle'] = $data['metakeywords'] = "{$data['editdata']['subject']}������,��ô��,�ò��� - ����������";
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$pstatus = DB::fetch_first("SELECT COUNT(*) AS count, first, authorid FROM " . DB::table('forum_post') . " WHERE pid = {$pid}");
			$postdata = array_merge($_GET, $_POST);
			$postdata['pro'] = $postdata['province'];
			$postdata['reg'] = $postdata['region'];
			$postdata['longi'] = $postdata['lon'];
			$postdata['lati'] = $postdata['lat'];
			if (trim($postdata['market']) && $postdata['shoptype'] == '1') {
				$postdata['shop'] = $this->mod->getShopId(trim($postdata['market']));
			} else {
				$postdata['shop'] = '0';
			}
			if (trim($postdata['brand']) && $postdata['types'] == '1') {
				$postdata['sb'] = $this->mod->getBrandId(trim($postdata['brand']));
			} else {
				$postdata['sb'] = '0';
			}
			if (trim($postdata['chainbrand']) && $postdata['chain'] == '1') {
				$postdata['cb'] = $this->mod->getChainId(trim($postdata['chainbrand']));
			} else {
				$postdata['cb'] = '0';
			}

			if ($_G['forum']['ismoderator'] != 1 && $pstatus['authorid'] != $_G['uid'])
				$this->showmessage('model_edit_nopermission');
			if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic'))
				$this->showmessage('model_need_pic');
				$postdata['spid'] = $postdata['imgselect'][0];
			if ($pstatus['first'] == 1) {
				$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
				$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
				$this->mod->dopost($postdata, $tid, $pid);
			}
		}
	}
	/**
	 * ajax����pro��ȡregion
	 *
	 */
	function ajaxGetRegion() {
		$parentId = $_POST['catid'];
		if($parentId){
			$arr = $this->mod->getRegions($parentId, 2, true, true);	
			if ($arr) {
				foreach ($arr as $k=>$v) {
					$html .= "<a href='javascript:void(0);' rel='$v[pro]'>{$v[name]}</a>";
				}
			}
			
			echo $html;
			exit();
		}		
	}
	/**
	 * ajax ���ݳ��л�ȡ�̳�
	 */
	function ajaxGetMarket() {
		$reg = $_GET['reg'];
		if($reg){
			$arr = $this->mod->ajaxGetMarketModel($reg);
			if (is_array($arr)) {
				foreach ($arr as $k=>$v) {
					$arr[$k] = array('id'=>mb_convert_encoding($v['id'],'UTF-8', 'GBK'),'marketid'=>mb_convert_encoding($v['marketid'],'UTF-8', 'GBK')); 				
				}
			}	
			echo json_encode($arr);exit;
		}		
	}
	/**
	 * ajax ��ȡ��������
	 */
	function ajaxGetArea() {
		$sreg = $_GET['sreg'];
		if($sreg){
			$region = m('shopregion');
			$arr_region = $region->get(array('fields'=>'*','conditions'=>"catid=$sreg limit 1"));
			echo json_encode($arr_region['areacode']);exit;
		}
	}
	/**
	 * ajax ��ȡ�Ƿ���������ظ�
	 */
	function ajaxGetTitle() {
		$sub = $_GET['sub'];
		if($sub){	
			$sub =mb_convert_encoding($sub,'GBK', 'UTF-8');
			$sub =trim($sub);
			$shop = m('shop');
			$arr_region = $shop->get(array('fields'=>'*','conditions'=>"subject='$sub' limit 1"));
			if($arr_region){
				echo "repeat";exit;
			}else{
				echo "norepeat";exit;
			}	
		}
	}
	/**
	 * �޸�����
	 * 
	 */
	public function editmap(){
		global $_G;
		if(!$_G['tid'] || !$_G['gp_lng'] || !$_G['gp_lat'] || $_G['forum']['ismoderator'] != 1){
			$this->showmessage('���ݴ���');
		}
		
		$mod_shop = m('shop');
		$mod_shop->edit("tid = {$_G['tid']}", array('lon' => $_G['gp_lng'], 'latitude' => $_G['gp_lat']));
		die('success');
	}
	
	/**
	 * �����㷨
	 */
	 public function sortByCol($array, $keyname, $dir = SORT_ASC) {
		return $this->sortByMultiCols($array, array($keyname => $dir));
	}
	 public function sortByMultiCols($rowset, $args) {
		$sortArray = array();
		$sortRule = '';
		foreach ($args as $sortField => $sortDir) {
			foreach ($rowset as $offset => $row){
				$sortArray[$sortField][$offset] = $row[$sortField];
			}
			$sortRule .= '$sortArray[\'' . $sortField . '\'], ' . $sortDir . ', ';
		}
		if (empty($sortArray) || empty($sortRule)) { 
			return $rowset; 
		}
		eval('array_multisort(' . $sortRule . '$rowset);');
		return $rowset;
	}	
	/**
	 * ƥ�䷵������ֵ
	 *
	 */
	public function getCategoryByKey($id,$key,$value,$array) {
		if (is_array($array)) {
			foreach ($array as $v) {
				if ($v[$key] == $id) {
					$name = $v[$value];
				}
			}
		}
		return $name;
	}
}