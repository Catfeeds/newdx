<?php
/**
 * @author Lgt
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class DivingCtl extends DianpingCtl{
	var $modname = 'diving';

	/**
	 * ��ʾ����ҳ--�ο�forum.base.php��Ӧ����
	 */

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

        //�������������Ƶ�
        checklowerlimit('post', 0, 1, $this->mod->_fid);
        $_G['fid'] =  $this->mod->_fid;

        if (! submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
            //��
            $data['url']		= $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";
            $data['action']		= 'new';
            $typelist = $this->mod->_getTypeClass();

            $data['typelist']	= count($typelist) > 0 ? current($typelist) : array();

            /// ��ʼ���༭���������
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
                unset($data['attaclist']);

                //����������
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

            require_once libfile('dianping/zone','class');
            $foreigndb = new zone();
            //  ����ʡ������Ϣ��ȡ
            $data['regionsList'] = $foreigndb->get_region();

            /* ����Ǳˮ�������,������Ǳˮ��༭���µĹ������ֺ�����һ��(86��)�����ɾ��
            $data['regionsList']["999999"] = array("cityname"=>"����","shengid"=>0,"shiid"=>0,"citycode"=>"999999");*/
            $data['shorttitle'] = '';//���й����ַ�����Ϊ��
            $this->assign($data);
            $this->display($this->mod->template['post']);
        } else {
            //�ύ
            $postdata  = array_merge($_GET, $_POST);
            $foreign_country_mod = m('foreign_country');
            if($postdata['con_province']){
                $postdata['pro'] = $foreign_country_mod->insert_foreign_country($postdata['con_province']) ? $foreign_country_mod->insert_foreign_country($postdata['con_province']) : $postdata['province'];
            }else{
                $postdata['pro'] = $postdata['province'];
            }
            $postdata['addr'] = $postdata['con_address'] ? $postdata['con_province'].$postdata['con_address'] : $postdata['sel_address'].$postdata['addr'];
            $postdata['type']=implode(",",$postdata['type']);
            if (empty($postdata['imgselect']) && $this->mod->getChildStatus('pic')){
                $this->showmessage('model_need_pic');
            }

            //����༭��ͼƬ
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
	 * ��ʾ�б�ҳ--�ο�forum.base.php��Ӧ����
	 */
	function showlist()
	{

        global $_G;
        $data = $this->_getGlobalArgs('list');
        $perpage 	 	= max($this->mod->limit, 1);
        $page 	 	 	= max(intval($_G['gp_page']), 1);
        $start   	 	= ($page - 1) * $perpage;
        $mdRegion 		= m('regions');

        $data['myurl']  = $_G['config']['web']['portal'] . "forum.php?ctl={$this->modname}";

        $data['url'] 	= $data['myurl']."&act=showlist";
        $divtypeList 	= $this->mod->_getTypeClass();
        //��ȡǱˮ����
        $data['divtypeList']   = $divtypeList ? current($divtypeList) : array();
        $data['type']   = !empty($_G['gp_type']) ? intval($_G['gp_type']) : 0;
        $data['city']	 = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
        $data['province']= !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
        $order   = isset($_G['gp_order']) ? $_G['gp_order'] : 'lastpost';
        $data['order']		= $order;
        $data['url']  	.= "&order={$order}";
        //���Ĭ����򵥲�ѯ����
        $where = $this->mod->alias . '.' . $this->mod->_vars['enable'] . ' = 1 ';
        //��ѯdivingǱˮ����д��ڵ�ʡ����.
        $allAllList = $this->mod->find(array(
            'fields' => "{$this->mod->_vars[pro]},{$this->mod->_vars[city]}",
            'conditions' => $where
        ));
        $allcodeList = array();
        foreach($allAllList as $key => $val){
            $allcodeList[$val['provinceid']]=1;
            $allcodeList[$val['cityid']]=1;
        }
        include_once libfile('dianping/zone','class');
        $foreigndb = new zone();
        //  ����ʡ������Ϣ��ȡ
        $data['regionsList'] = $foreigndb->get_region(0,2);
        // �����⣩������Ϣ��ȡ
        /*$foreign_country_mod = m('foreign_country');
        $foreign_countrys = $foreign_country_mod->get_foreign_country('codeid','cityname');*/
        $foreign_countrys = $foreigndb->get_foreign('codeid','cityname');
        //��һ�ξ���ѭ�����˻�ȡ�е������ݵĹ���ʡ���б�
        $countries = $data['regionsList']+$foreign_countrys;
        foreach ($countries as $rk => $rv) {
              if(!$allcodeList[$rk]) {
                   unset($data['regionsList'][$rk]); unset($foreign_countrys[$rk]);
                   continue;
              }
              if($rv['shengid']) {
                  if($allcodeList[$rv['codeid']]){
                      $data['cityList'][$rv['shengid']][$rk] = $rv;
                  }
              }else {
                  $data['proList'][$rk] = $rv;
              }
        }
        $data['proList'] += $foreign_countrys;
        //��ʱ�����б�ҳ����������
        $data['regionsList']["999999"] = array("cityname"=>"����","shengid"=>0,"shiid"=>0,"citycode"=>"999999");
        //������ʱ����
        unset($allcodeList);unset($countries);
        //�Զ���pageTitle @proposed by liGang
        if($data['province'] == 0 && $data['type'] == 0){
            $data['pageTitle']= 'ȫ��Ǳˮ��Ǳˮ���ز�ѯ����,Ǳˮ���س��ݾ��ֲ�,Ǳˮ��ѵѧϰ - ����������';
            $data['metakeywords']= 'Ǳˮ,Ǳˮ��,Ǳ��,Ǳˮ����,Ǳˮ����,Ǳˮ���ֲ�';
            $data['metadescription']= '�ռ�ȫ�������������ϸǱˮ�㳡�س���������Ϣ����ʵ�û����ܵ���,������Ǳ��ˮ��Ǳˮ������Ǳˮ�����߽���Ǳˮѵ����ΪǱˮ�������ṩ���װ���';
        }else{
            //ʡ�б��������ʱ�ַ�����ʡ�м�Ǳˮ���ͱ��������ʱ�ַ���
            $pro_city = $data['proList'][$data['province']]['cityname'].$data['cityList'][$data['province']][$data['city']]['cityname'];
            $pro_city_type = $pro_city .$data['divtypeList'][$data['type']]['name'];
            if(($data['province'] || $data['city']) && $data['type']==0){
                $data['pageTitle']= '2014'.$pro_city.$data['modname'].'���ز�ѯ���� - ����������';
                $data['metakeywords']= $pro_city.'Ǳˮ,'.$pro_city.'Ǳˮ��,'.$pro_city.'Ǳˮ����';
                $data['metadescription']= '����'.$pro_city.'Ǳˮ�㳡�س��ݻ��ؾ��ֲ���ϢȨ����ѯ�Լ���ʵ�û��������ܣ�Ϊ'.$pro_city.'Ǳˮ��Ǳˮ�ṩ���װ���';
            }elseif($data['province'] || $data['city']){
                $data['pageTitle']= '2014'.$pro_city_type.'���ز�ѯ���� - ����������';
                $data['metakeywords']= $pro_city_type.'Ǳˮ,'.$pro_city_type.'Ǳˮ��,'.$pro_city_type.'Ǳˮ����';
                $data['metadescription']= '����'.$pro_city_type.'���س��ݻ��ؾ��ֲ���ϢȨ����ѯ�Լ���ʵ�û��������ܣ�Ϊ'.$pro_city_type.'Ǳˮ�ṩ���װ���';
            }
            unset($pro_city);unset($pro_city_type);
        }
        if($data['type']){
            $where .= " and  FIND_IN_SET('{$data['type']}',type)";
        }
        //Ǳˮ����
        $data['url'] .= '&type=' . $data['type'];
        //����ʡ��
        $data['url'] .= '&provinceid=' . $data['province'];
        $data['url'] .= '&cityid=' . $data['city'];
        if($data['province']){
           $where .= " and {$this->mod->alias}.{$this->mod->_vars['pro']} = {$data['province']}";
        }
        if($data['city']){
           $where .= " and {$this->mod->alias}.{$this->mod->_vars['city']} = {$data['city']}";
        }
        $order = $order == 'latest' ? 'id' : $order;
        if ($order) {
            $orders =  $order == 'lastpost' ? array('displayorder' => 'DESC',$order => 'DESC') : array($order => 'DESC');
        } else {
            $orders = array('displayorder' => 'DESC');
        }
        $max = $this->mod->getMaxCount($where);
        if(! $max) {
            $where = preg_replace('/[\s]+and[\s]+diving\.type[\s]*?=[\s]*?[\d]*[\s]+/', ' ', $where);
            //unset($data['type']);
            $data['no_lists'] = 1;
            $max = $this->mod->getMaxCount($where);
        }
        $data['multipage'] = multi($max, $perpage, $page, $data['url']);
        //����б�
        $divingList = $data['list'] = $this->mod->getlist(array(
            'start' => $start,
            'order' => $orders,
            'where' => $where,
            'limit' => $perpage
        ));

        //$diytypelist = array();

        //ȥ��type��ƥ�����.
        //��Ϊ��Ŀ�Ѿ����ߣ�����type���;��Դ��ڣ�Ϊ�����Ч�ʣ��ͼ�������type����ͬʱ���ڵ������ȡ��type���˴��롣
        /* foreach($divingList as $key => $val){
             $diytypelist[$val['type']]=1;
        }
        foreach($data['divtypeList'] as $key => $val){
            if( !$diytypelist[$key]){
                unset($data['divtypeList'][$key]);
            }
        }
        unset($diytypelist); *///������ʱ����

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

        $divtypeList = $data['divtypeList'][$data['type']]['name'];
        if(! $divtypeList && $data['type'] != 0){
            $_jumpurl = "{$data['myurl']}&act=showlist";
            $data['type'] = 0;
        }

        if( ! empty($_jumpurl) ){
            $_jumpurl .= "&order={$data['order']}&type={$data['type']}&provinceid={$data['province']}&cityid=0&page=1";
            $_jumpurl = $this->_get_myRewrite($_jumpurl);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $_jumpurl");
        }
        $data['shorttitle']='';
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

            $data = array_merge($data, $this->mod->getPlugin('view', array_merge($data['viewdata'], $_GET)));//p($data);
            //title, description, keywords
            $data['pageTitle']= $data['viewdata']['subject'].'�绰��ַ�۸����,'.$data['viewdata']['subject'].'����������'.$data['viewdata']['subject'].'��ô���ò����û����� - ����������';
            $data['metadescription']= '����'.$data['viewdata']['subject'].'����ϸ���ܰ����۸�,��ַ,��ϵ��ʽ,����ˮƽ�����ػ����Լ���ʵ�û��������ܣ�Ϊǰ��'.$data['viewdata']['subject'].'��Ǳˮ�������ṩȨ�����׵���Ϣ�ο�';
            $data['metakeywords']= $data['viewdata']['subject'];
            $this->assign($data);
            $this->display($this->mod->template['view']);
        }
    }

//�༭����������ҳ
    function _editpost($data) {

        global $_G;
        $tid = intval($_G['gp_tid']);
        $pid = intval($_G['gp_pid']);
        if ($pid <= 0 || $tid <= 0)
            $this->showmessage('nopidandtid');
        if (! submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
            $this->mod->initPost($data);
            $data['regionsList']["999999"] = array("cityname"=>"����","shengid"=>0,"shiid"=>0,"citycode"=>"999999");
            $data['action'] = 'edit';
            $data['editdata'] = $this->mod->getview($tid);

            $pro_id = $data['editdata'][$this->mod->_vars['pro']];
            $typelist = $data['editdata']['type'];
            $typelistarr = explode(',',$typelist);
            foreach($typelistarr as $k =>$v){
                $typelists[$v]=1;
            }
            $data['typelists']=$typelists;
            $mdRegion = m('regions');
            $data['cities'] = $mdRegion->getCitiesByProvince($pro_id);
            require_once libfile('dianping/zone','class');
            $foreigndb = new zone();
            $data['foreign_countrys'] = $foreigndb->get_foreign('codeid','cityname');
            $data['editdata']['addr']=$data['foreign_countrys'][$pro_id] ?  str_replace($data['foreign_countrys'][$pro_id]['cityname'],'', $data['editdata']['addr']) : str_replace($data['regionsList'][$pro_id]['cityname'].$data['cities'][$data['editdata']['cityid']]['cityname'],'',$data['editdata']['addr']);
            $this->assign($data);
            $this->display($this->mod->template['post']);
        } else {
            /* about sql injection
            * In PHP, the configuration of 'magic quote' can escape single/double quote automaticly. but the data you submit can be jumbled, it is possible that sql injection exists*/
            $foreign_country_mod = m('foreign_country');
            $postdata = array_merge($_GET, $_POST);
            $postdata['type']=implode(",",$postdata['type']);
            $message = $this->mod->initPost($postdata, true);
            if($postdata['con_province']){
                $postdata['pro'] = $foreign_country_mod->insert_foreign_country($postdata['con_province']) ? $foreign_country_mod->insert_foreign_country($postdata['con_province']) : $postdata['province'];
            }else{
                $postdata['pro'] = $postdata['province'];
            }
            if($message) {
                $this->showmessage($message, '', array(), array());
            }
            $postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
            $postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
            $this->mod->dopost($postdata);
        }
    }
    /**
     * ajax �����б�
     *
     * @author
     */
    //ʡ������
    function ajaxGetRegion() {
        $provinceid = $_REQUEST['provinceid'];
        if($provinceid) {
            $mdRegion = m('regions');
            $params = array(
                'fields' => 'codeid,cityname',
                'conditions' => "shengid={$provinceid} and level <= 2",
                'order' => 'codeid ASC',
            );

            $cities = $mdRegion->find($params);
            if($cities) {
                $return_data = '';
                foreach ($cities as $k => $v) {
                    $return_data .=  sprintf('<a href="javascript:void(0);" rel="%s" myid="cityid">%s</a>',
                        $v['codeid'],
                        $v['cityname']);
                }
                echo $return_data;
            }
            exit;
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
        $mod_diving = m('diving');
        $mod_diving->edit("tid = {$_G['tid']}", array('longitude' => $_G['gp_lng'], 'latitude' => $_G['gp_lat']));
        die('success');
    }


}



?>
