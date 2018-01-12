<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class ClimbCtl extends DianpingCtl {
	var $modname = 'climb';

	/**
	 * ������Ϣ�б�
	 * @see DianpingCtl::showlist()
	 */
	function showlist() { 
		global $_G;
		$data = $this->_getGlobalArgs('list');
		$perpage 	 	= max($this->mod->limit, 1);
		$page 	 	 	= max(intval($_G['gp_page']), 1);
		$start   	 	= ($page - 1) * $perpage;
		$mdRegion 		= m('regions');

		$data['myurl']  = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
		$data['url'] 	= $data['myurl']."&act=showlist";
		$climbTypeList 	= $this->mod->_getTypeClass();
		//��ȡ��������
		$data['climbTypeList']   = $climbTypeList ? current($climbTypeList) : array();

        //����������������
        $ctype_id = array_keys($data['climbTypeList']);
            $ctype_list= array(
                $ctype_id[0].','.$ctype_id[1]=>array(
                    'cid'=>$ctype_id[0].','.$ctype_id[1],
                    'name'=>'�����ʱ�',
                    'children'=>array()
                ),
                $ctype_id[0].','.$ctype_id[2]=>array(
                    'cid'=>$ctype_id[0].','.$ctype_id[2],
                    'name'=>'���ұ�ʯ',
                    'children'=>array()
                ),
                $ctype_id[1].','.$ctype_id[2]=>array(
                'cid'=>$ctype_id[0].','.$ctype_id[1],
                'name'=>'�ʱ���ʯ',
                'children'=>array()
                ),
                $ctype_id[0].','.$ctype_id[1].','.$ctype_id[2]=>array(
                    'cid'=>$ctype_id[0].','.$ctype_id[1].','.$ctype_id[2],
                    'name'=>'�����ʱ�',
                    'children'=>array()
                )
            );
        $data['climbTypeLists'] = $data['climbTypeList'] + $ctype_list;
		//��ȡ��������
		$data['climbCptypeList'] = $climbTypeList ? end($climbTypeList) : array();
		$data['baseurl'] = $_G['siteurl'] . 'forum.php?ctl=' . $this->modname;
		//default type is '����'
		$data['type']   = $_G['gp_type'] ? intval($_G['gp_type']) : 0;

		$data['placetype']  = !empty($_G['gp_placetype']) ? intval($_G['gp_placetype']) : 0;
		$data['show_cPtype'] = true;
		if($data['type'] == 182){
			$data['placetype'] = 0;
			$data['show_cPtype'] = false;
		}
		$data['cityid']	 = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
		$data['provinceid']= !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
		$order   = isset($_G['gp_order']) ? $_G['gp_order'] : 'lastpost';
		$data['url']  	.= "&order={$order}";
		$data['order']		= $order;
		//�������
		$where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 ';
		/*low effection start*/
		$allAllList = $this->mod->find(array(
			'fields' => "{$this->mod->_vars[pro]},{$this->mod->_vars[city]}",
			'conditions' => $where
		));

		$proIdList = array();
		$cityIdList = array();

		$mdRegion = m('regions');
		foreach ($allAllList as $ak => $av) {
			$proIdList[$av['provinceid']] = 1;
			$cityIdList[$av['cityid']] = 1;
		}
		 $proList = $mdRegion->getAllProvinces('codeid, cityname');
		 $cityList = array();
		 foreach ($proList as $pk => $pv) {
		 	if(! $proIdList[$pk]) { unset($proList[$pk]); continue;}
		 	$allCities = $mdRegion->getCitiesByProvince($pk);
		 	foreach ($allCities as $ck => $cv) {
		 		if(! $cityIdList[$ck]) continue;
		 		$cityList[$pk][$ck] = $cv['cityname'];
		 	}
		 }
		 $data['proList'] = $proList;
		 $data['cityList'] = $cityList;
     	/*low effection end */
        if($data['type']){
            $where .= " and  FIND_IN_SET('{$data['type']}',type)";
        }
		$data['url']  	.= '&type=' . $data['type'];

		if($data['placetype']){
			$where .= " and {$this->mod->alias}.{$this->mod->_vars['placetype']}={$data['placetype']}";
		}
		$data['url']  	.= '&placetype=' . $data['placetype'];
		//����
		$data['url']    .= '&provinceid=' . $data['provinceid'];
		if($data['provinceid']){
			$where .= " and {$this->mod->alias}.{$this->mod->_vars['pro']} = {$data['provinceid']}";
		}
		$data['url']    .= '&cityid=' . $data['cityid'];
		if($data['cityid']){
			$where .= " and {$this->mod->alias}.{$this->mod->_vars['city']} = {$data['cityid']}";
		}
		$order = $order == 'latest' ? 'id' : $order;
		if ($order) {
			$orders = array($order => 'DESC');
		} else {
			$orders = array('orderby' => 'DESC');
		}
		$max = $this->mod->getMaxCount($where);
		//when try to search results from database according to the criteria, get rid of some conditions if no results.  
		if(! $max) {
			$where = preg_replace('/[\s]+and[\s]+climb\.placetype[\s]*?=[\s]*?[\d]*[\s]+/', ' ', $where);
			$data['placetype'] = 0;
			$data['no_lists'] = 1;
			$max = $this->mod->getMaxCount($where);
			if(! $max) {
				$where = preg_replace('/[\s]+and[\s]+climb\.type[\s]*?=[\s]*?[\d]*[\s]+/', ' ', $where);
				$max = $this->mod->getMaxCount($where);
			}
		}
		$data['multipage'] = multi($max, $perpage, $page, $data['url']);
		//����б�
		$climbList = $data['list'] = $this->mod->getlist(array(
			'start' => $start,
			'order' => $orders,
			'where' => $where,
			'limit' => $perpage
		));

		$cptypeList = array();
		foreach ($climbList as $k=>$v){
			$cptypeList[$v['placetype']]=1;
		}
		//clean placetype
		foreach ($data['climbCptypeList'] as $k => $v) {
			if(! $cptypeList[$k]) {
				unset($data['climbCptypeList'][$k]);
			}
		}

		unset($cptypeList);
		//���ʵ����б�
		$mdForumPost = m('forum_post');
		$tids 		 = array();
		$data['jcdpList'] = $mdForumPost->find(array(
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

		$climbType = $data['climbTypeList'][$data['type']]['name'];
		if(! $climbType && $data['type'] != 0){
			$_jumpurl = "{$data['myurl']}&act=showlist";
			$data['type'] = 0;
		}
		$data['shorttitle'] = '';
        //�Զ���pageTitle @proposed by liGang
        if($data['provinceid'] == 0 && $data['type'] == 0 && $data['placetype'] == 0){
            $data['pageTitle']= '�����ʱ���ʯ���ز�ѯ�������� - ����������';
            $data['metadescription']= '�ռ���ȫ����������ʱ���ʯ���س���������Ϣ,�˹������ҹ�,��Ȼ�ұڵ�,���ݵ�ַ�绰���û���ʵ��������,Ϊ�����ʱ���ʯ�ṩ���װ���';
        }else{
            //ʡ�б��������ʱ�ַ�����ʡ�м�Ǳˮ���ͱ��������ʱ�ַ���
            $pro_city= $proList[$data['provinceid']]['cityname'].$cityList[$data['provinceid']][$data['cityid']];
            $pro_city_ctype= $pro_city.$data['climbTypeList'][$data['type']]['name'];
            if(($data['provinceid'] || $data['cityid']) && $data['type'] == 0){
                $data['pageTitle']= '2014'.$pro_city.'�������س��ݲ�ѯ���� - ����������';
                $data['metakeywords']= $pro_city.'������,'.$pro_city.'������';
                $data['metadescription']= '����'.$pro_city.'�������س�����ϢȨ����ѯ�Լ���ʵ�û��������ܣ�Ϊ'.$pro_city.'�����������ṩ���װ���';
            }elseif($data['provinceid'] || $data['cityid']){
                $data['pageTitle']= '2014'.$pro_city_ctype.'���س��ݲ�ѯ���� - ����������';
                $data['metakeywords']= $pro_city_ctype.'��,'.$pro_city_ctype.'��';
                $data['metadescription']= '����'.$pro_city_ctype.'���س�����ϢȨ����ѯ�Լ���ʵ�û��������ܣ�Ϊ'.$pro_city_ctype.'�������ṩ���װ���';
            }
            unset($pro_city);unset($pro_city_ctype);
        }
		$this->assign($data);
		$this->display($this->mod->template['list']);
	}

	function showview() {
		global $_G;
		if ($_G['gp_tid'] <= 0) {
			$this->showlist();
		} else {
			$tid = $_G['gp_tid'];
			$data['viewdata'] = $this->mod->getview($tid);
			$pro_id = $data['viewdata'][$this->mod->_vars['pro']];
			$city_id = $data['viewdata'][$this->mod->_vars['city']];

			if (empty($data['viewdata']))
				$this->showmessage('thread_nonexistence');
			$data['modstr'] = $this->modname;
			$data['modname'] = $this->mod->_moduleinfo['mname'];
			if($pro_id || $city_id) {
				$mdRegion = m('regions');
				$regions = $mdRegion->find(array(
						'fields' => 'cityname,shengid',
						'conditions' => "codeid={$pro_id} or codeid={$city_id}",
						'limit' => 2
					));
				foreach ($regions as $region) {
					if($region['shengid']) {
						$data['n_city'] = $region['cityname'];
					}
					else {
						$data['n_pro'] = $region['cityname'];
					}
				}
			}

            //����༭��������
            require_once libfile('function/newdiscuzcode');
            $data['viewdata']['message'] = discuzcode($data['viewdata']['message']);

            if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $data['viewdata']['message'], $matches)) {

                $aids = $matches[1];
                require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
                $attachserver = new attachserver;
                $domain  = $attachserver->get_server_domain('all', '*');
                foreach ($aids as $aid) {
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
                    }

                    if($attachment['width']>610){
                        $data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" width="610px;" />', $data['viewdata']['message']);
                    }else{
                        $data['viewdata']['message'] = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" />', $data['viewdata']['message']);
                    }
                }
            }
			$data['piclist'] = $this->_getimgbytidpid($tid, $data['viewdata']['pid'], 'plugin', false, 5);
			if (empty($data['piclist'])) {
				$data['piclist'][0]['attachment'] = $data['viewdata']['attachment'];
				$data['piclist'][0]['dir'] = 'plugin';
				$data['piclist'][0]['url'] = $_G['config']['web']['attach'] . 'plugin/';
			}

			//�ҵĵ���
			$mod_forum_post = m('forum_post');
			if($_G['uid']) {
				$data['my_comment'] = array();
				$data['my_comment'] = $mod_forum_post->find(array('conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}", 'join' => 'has_star', 'limit' => 1,
						'fields' => "sl.starnum,sl.goodpoint,sl.weakpoint,sl.extdata,{$mod_forum_post->alias}.message,{$mod_forum_post->alias}.rate,{$mod_forum_post->alias}.dateline"));
				
				if ($data['my_comment']) {
					$data['my_comment'] = current($data['my_comment']);
					$data['my_comment']['goodpoint'] = $this->_set_br(htmlspecialchars($data['my_comment']['goodpoint'], ENT_QUOTES, 'GB2312'));
					$data['my_comment']['weakpoint'] = $this->_set_br(htmlspecialchars($data['my_comment']['weakpoint'], ENT_QUOTES, 'GB2312'));
					$data['my_comment']['message'] = $this->_set_br(htmlspecialchars($data['my_comment']['message'], ENT_QUOTES, 'GB2312'));
					$data['my_comment']['rate'] = $data['my_comment']['rate'];
					$data['my_comment']['dateline'] = $this->mod->_timeHandle($data['my_comment']['dateline']);
					$data['my_comment']['extdata'] = unserialize($data['my_comment']['extdata']);

				}
			}
		

			$dianping = m('dianping');
			$data['myrate'] = max(intval($dianping->getMyRate($_G['uid'], $tid)), 0);
			
			$dianpingshow = m('dianpingshow');
			$data['star_data'] = $dianpingshow->getData($tid);
			//�����б�
			$page = max(1, $_G['gp_page']);
			$data['page'] = $page;
			$perpage =  max($this->mod->commentlimit, 1);
			$start = ($page - 1) * $perpage;
			$replyList = $mod_forum_post->find(array(
				'fields' => "f_p.fid,f_p.tid,f_p.first,f_p.author,f_p.authorid,f_p.dateline,f_p.message,f_p.rate,sl.starid,sl.starnum,sl.pid,sl.uid,sl.username,sl.goodpoint,sl.weakpoint,sl.ext1,sl.ext2,sl.ext3,sl.ext4,sl.enable,sl.supports",
				'conditions' => "f_p.tid={$tid} AND f_p.first=0",
				'order' => 'sl.stickreply DESC, f_p.dateline DESC',
				'limit' => "{$start}, {$this->mod->commentlimit}",
				'join' => 'has_star'
			));
		
			if (is_array($replyList)) {
				foreach ($replyList as $k => $v) {
					if($v['authorid'] == $_G['uid']){unset($replyList[$k]);continue;}
					$replyList[$k]['goodpoint'] = $this->_set_br(htmlspecialchars($v['goodpoint'], ENT_QUOTES, 'GB2312'));
					$replyList[$k]['weakpoint'] = $this->_set_br(htmlspecialchars($v['weakpoint'], ENT_QUOTES, 'GB2312'));
					$replyList[$k]['message'] = $this->_set_br(htmlspecialchars($v['message'], ENT_QUOTES, 'GB2312'));
					$replyList[$k]['dateline'] = $this->mod->_timeHandle($v['dateline']);
					$replyList[$k]['extdata'] = unserialize($replyList[$k]['extdata']);
				}
			}
			
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$multipage = multi($data['viewdata']['replies'], $perpage, $page, $data['url'] . "&act=showview&tid={$tid}");
			if ($_G['uid']) {
				$mod_dianping_support = m('dianpingsupport');
				$supportlist = $mod_dianping_support->find(array('conditions' => "tid = {$tid} AND uid = {$_G['uid']}", 'index_key' => 'pid'));
			}
			
			$data['replylist'] = $replyList;
			$data['replymulti'] = $multipage;
			$data['supportlist'] = $supportlist;

			$data = array_merge($data, $this->mod->getPlugin('view', array_merge($data['viewdata'], $_GET)));
			//title, description, keywords
            $data['pageTitle']= $data['viewdata']['subject'].'�绰��ַ�۸����,'.$data['viewdata']['subject'].'���������� '.$data['viewdata']['subject'].'��ô���ò����û����� - ����������';
            $data['metadescription']= '����'.$data['viewdata']['subject'].'����ϸ���ܰ����۸�,��ַ,��ϵ��ʽ,����ˮƽ�����ػ����Լ���ʵ�û��������ܣ�Ϊǰ��'.$data['viewdata']['subject'].'��Ǳˮ�������ṩȨ�����׵���Ϣ�ο�';
            $data['metakeywords']= $data['viewdata']['subject'];
			$this->assign($data);
			$this->display($this->mod->template['view']);
		}
	}

	/*��������ʱ,ִ�и����DianpingCtl��dopost������,��ִ��_newpost*/
	function _newpost($data) {
		global $_G;

		//����Ƿ��¼������ܹ�����������
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

		$_G['fid'] = $this->mod->_fid; //avoid '��֤����д�����뷵���޸ġ�' error
		//����ύ��������,�Ƿ���Ҫ����һ������,��function_core��
		if (! submitcheck('newpostsubmit', 0,  $data['seccodecheck'], $data['secqaacheck'])) {
			$this->mod->initPost($data);
			$data['action'] = 'new';
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			/* about sql injection
			* In PHP, the configuration of 'magic quote' can escape single/double quote automaticly. but the data you submit can be jumbled, it is possible that sql injection exists*/

			$postdata = array_merge($_GET, $_POST);
            $postdata['type']=implode(",",$postdata['type']);
			$message = $this->mod->initPost($postdata, true);
			if($message) {
				$this->showmessage($message, '', array(), array());
			}

			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
			$this->mod->dopost($postdata);
		}
	}

	/*��������ʱ,ִ�и����DianpingCtl��dopost������,��ִ��_editpost*/
	function _editpost($data) {
		global $_G;
		$tid = intval($_G['gp_tid']);
		$pid = intval($_G['gp_pid']);

		if ($pid <= 0 || $tid <= 0)
			$this->showmessage('nopidandtid');
		if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$this->mod->initPost($data);

			$data['action'] = 'edit';
			$data['editdata'] = $this->mod->getview($tid);
			$pro_id = $data['editdata'][$this->mod->_vars['pro']];
			$mdRegion = m('regions');
			$data['cities'] = $mdRegion->getCitiesByProvince($pro_id);
		    
			$typelist = $data['editdata']['type'];
            $typelistarr = explode(',',$typelist);
            foreach($typelistarr as $k =>$v){
                $typelists[$v]=1;
            }
            $data['typelists']=$typelists;
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			/* about sql injection
			* In PHP, the configuration of 'magic quote' can escape single/double quote automaticly. but the data you submit can be jumbled, it is possible that sql injection exists*/
			$postdata = array_merge($_GET, $_POST);
            $postdata['type']=implode(",",$postdata['type']);
			$message = $this->mod->initPost($postdata, true);
			if($message) {
				$this->showmessage($message, '', array(), array());
			}

			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
			$this->mod->dopost($postdata);
		}
	}

	function editmap(){
		global $_G;
		if(! $_G['tid'] || ! $_G['gp_lng'] || ! $_G['gp_lat'] || $_G['forum']['ismoderator'] != 1){
			$this->showmessage('���ݴ���');
		}
		
		$this->mod->edit("tid = {$_G['tid']}", array('longitude' => $_G['gp_lng'], 'latitude' => $_G['gp_lat']));
		die('success');
	}
}

