<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class FishingCtl extends DianpingCtl {
	var $modname = 'fishing';

	function showlist() {

		global $_G;
		$data = $this->_getGlobalArgs('list');
		$fishingTypes = $this->mod->_getTypeClass();

		$type = $_G['gp_type'] ?  intval($_G['gp_type']) : 0;
        $data['isfree'] = $_G['gp_isfree'] ?  intval($_G['gp_isfree']) : 0;
		$whereTypes = array();
		if($fishingTypes) {
			$children = array();
			foreach (current($fishingTypes) as $fv) {
				if($fv['children']) {
					$children[$fv['cid']] = $fv['name'];

					if($fv['cid'] == $type) {
						foreach ($fv['children'] as $cv) {
							$children[$cv['cid']] = $cv['name'];
							$whereTypes[] = $cv['cid'];
						}
					}
					else {
						foreach ($fv['children'] as $cv) {
							$children[$cv['cid']] = $cv['name'];
						}

					}
				}
				else {
					if($fv['cid'] == $type) $whereTypes[] = $type;
					$children[$fv['cid']] = $fv['name'];
				}
			}

		}

		$data['childrenType'] = $children;

		$data['fishingTypes'] = $fishingTypes ? current($fishingTypes) : array();
		$data['provinceid'] = $_G['gp_provinceid'] ?  intval($_G['gp_provinceid']) : 0;
		$data['cityid'] = $_G['gp_cityid'] ?  intval($_G['gp_cityid']) : 0;
		//default: lastpost, dateline, score, heats
		$order = $_G['gp_order'] ? $_G['gp_order'] : 'lastpost';
		$data['order'] = $order;
		$data['type'] =  $type;

		//�������
		$where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 ';
		//extract province and city from pre_plugin_fishing_info, and display them on the webpage, the code is not very efficient or effective
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
		 //end extract

		 if($data['type']) {
		 	$where .=  ' AND ' . $this->mod->_vars['type'] . ' IN (' . implode(',', $whereTypes) . ')';

		 }
		 if($data['provinceid']) {
		 	$where .=  ' AND ' . $this->mod->_vars['pro'] . '=' . $data['provinceid'];
		 }
		 if($data['cityid']) {
		 	$where .=  ' AND ' . $this->mod->_vars['city'] . '=' . $data['cityid'];
		 }
        if($data['isfree']) {
            $where .=  ' AND ' . $this->mod->_vars['isfree'] . '=' . $data['isfree'];
        }
		$max = $this->mod->getMaxCount($where);
		$data['count_finishing'] = $max ? $max : 0;

		$perpage 	 	= max($this->mod->limit, 1);
		$page 	 	 	= max(intval($_G['gp_page']), 1);
		$start   	 	= ($page - 1) * $perpage;
		$data['base_url']  = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
        $data['url'] 	= $data['base_url']."&act=showlist".'&type=' . $data['type'].'&isfree='.$data['isfree'];
        $data['url'] .= '&provinceid=' . $data['provinceid'];
        $data['url'] .= '&cityid=' . $data['cityid'].'&order='.$data['order'];
        $data['multipage'] = multi($max, $perpage, $page, $data['url']);
		//����б�
		$data['list'] = $this->mod->getlist(array(
			'start' => $start,
			'order' => array($order => 'DESC'),
			'where' => $where,
			'limit' => $perpage
		));
		//���ʵ����б�
		$mdForumPost = m('forum_post');
		$tids 		 = array();
		$data['jcdpList'] = $mdForumPost->find(array(
			'fields'     => 'f_p.pid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate',
			'conditions' => "f_p.fid={$this->mod->_fid} and f_p.first=0 and f_p.rate>0",
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
		//�Զ���pageTitle
        if($data['provinceid'] == 0 && $data['type'] == 0){
            $data['pageTitle']= 'ȫ���������㳡�ز�ѯ���� - ����������';
            $data['metakeywords']= '����,�����,���㳡��';
            $data['metadescription']= '�ռ�ȫ������������ȫ����㳡��������Ϣ����ʵ�û����ܵ������������㰮���ߵ�������';
        }else{

            //ʡ�б��������ʱ�ַ�����ʡ�м�Ǳˮ���ͱ��������ʱ�ַ���
            $pro_city= $data['proList'][$data['provinceid']]['cityname'].$data['cityList'][$data['provinceid']][$data['cityid']];
            $pro_city_type= $data['proList'][$data['provinceid']]['cityname'];
            if(($data['provinceid'] || $data['cityid'])){
                $data['pageTitle'] = '2014'.$pro_city.'���㳡�ز�ѯ���� - ����������';
                $data['metakeywords'] = $pro_city.'����,'.$pro_city.'�����,'.$pro_city.'���㳡��';
                $data['metadescription'] = '����'.$pro_city.'����㳡����ϢȨ����ѯ�Լ���ʵ�û��������ܣ�Ϊ'.$pro_city.'���㰮�����ṩ��ݲ�ѯ';
            }
            unset($pro_city);unset($pro_city_type);
        }
        $data['shorttitle']='';
		$this->assign($data);
		$this->display($this->mod->template['list']);
	}

	function _newpost($data) {
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
		checklowerlimit('post', 0, 1, $this->mod->_fid);

		if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['action'] = 'new';

			$this->mod->initPost($data, false);
            $data['shorttitle']='';
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$postdata = array_merge($_GET, $_POST);

			$message = $this->mod->initPost($postdata, true);
			if($message) $this->showmessage($message);

			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));

			$this->mod->dopost($postdata);
		}
	}

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
            $data['shorttitle']='';
			$this->assign($data);
			$this->display($this->mod->template['post']);
		} else {
			$postdata = array_merge($_GET, $_POST);

			$message = $this->mod->initPost($postdata, true);
			if($message) {
				$this->showmessage($message, '', array(), array());
			}

			$postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
			$postdata['message'] = trim(dhtmlspecialchars($postdata['message']));

			$this->mod->dopost($postdata);
		}
	}

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

            //��attach���д���ҳ����ϸҳ�е�ͼƬ
            require_once libfile('dianping/attach','class');
            $attach_obj = new attach();

            //����༭��������
            require_once libfile('function/newdiscuzcode');
            $data['viewdata']['message'] = discuzcode($data['viewdata']['message']);

            $data['viewdata']['message'] = $attach_obj->handle_img($data['viewdata']['message']);
            $data['piclist'] = $attach_obj->get_img($tid,$data['viewdata']['pid'],'plugin');
            
			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
			$data['img_url'] = $_G['config']['web']['attach'] . 'plugin/';
			// ȡ����������
			$dianpingshow = m('dianpingshow');
			$data['star_data'] = $dianpingshow->getData($tid);
			// ��ǰ�û��ظ�
			$mod_forum_post = m('forum_post');
			if($_G['uid']) {
				$data['my_comment'] = $mod_forum_post->get(array(
						'fields'     => 'f_p.pid, f_p.fid, f_p.tid, f_p.dateline, f_p.authorid, f_p.author, f_p.message, f_p.rate,sl.starid, sl.starnum, sl.goodpoint, sl.weakpoint, sl.extdata, sl.supports',
						'conditions' => "f_p.tid={$tid} AND f_p.first=0 AND f_p.authorid={$_G['uid']}",
						'join'       => 'has_star'
				));
			}
			$data['my_comment'] = $this->_makereply($data['my_comment']);
			$data['myrate'] = $data['my_comment'] ? 1 : 0;

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

			$data = array_merge($data, $this->mod->getPlugin('view', array_merge($data['viewdata'], $_GET)));

			$data['shorttitle'] = '';
			$data['pageTitle'] = $data['viewdata']['subject'].'����������'.$data['viewdata']['subject'].'·�߲�ѯ��'.$data['viewdata']['subject'].'��ô������ʵ�û����� - ����������';
            $data['metadescription'] = '����'.$data['viewdata']['subject'].'��������ϸ·�߽����Լ���ʵ�û��������ܣ�Ϊǰ��'.$data['viewdata']['subject'].'�ĵ��㰮�����ṩȨ�����׵���Ϣ�ο�';
            $data['metakeywords'] = $data['viewdata']['subject'];
			$this->assign($data);
			$this->display($this->mod->template['view']);
		}
	}
}
