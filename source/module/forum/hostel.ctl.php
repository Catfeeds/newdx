<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class HostelCtl extends DianpingCtl {

    var $modname = 'hostel';

    /* ��������ʱ,ִ�и����DianpingCtl��dopost������,��ִ��_newpost */

    function _newpost($data) {
        global $_G;
        //����Ƿ��¼������ܹ�����������
        if (!$_G['uid'] && !((!$_G['forum']['postperm'] && $_G['group']['allowpost']) || ($_G['forum']['postperm'] && forumperm($_G['forum']['postperm'])))) {
            $this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
        } elseif (empty($_G['forum']['allowpost'])) {
            if (!$_G['forum']['postperm'] && !$_G['group']['allowpost']) {
                $this->showmessage('postperm_none_nopermission_dianping', null, array(), array('login' => 1));
            } elseif ($_G['forum']['postperm'] && !forumperm($_G['forum']['postperm'])) {
                showmessagenoperm('postperm', $this->mod->_fid, $_G['forum']['formulaperm']);
            }
        } elseif ($_G['forum']['allowpost'] == -1) {
            $this->showmessage('post_forum_newthread_nopermission');
        }
        if (!$_G['uid'] && ($_G['setting']['need_avatar'] || $_G['setting']['need_email'] || $_G['setting']['need_friendnum'])) {
            $this->showmessage('postperm_login_nopermission', null, array(), array('login' => 1));
        }
        checklowerlimit('post', 0, 1, $this->mod->_fid);

        $_G['fid'] = $this->mod->_fid; //avoid '��֤����д�����뷵���޸ġ�' error
        //����ύ��������,�Ƿ���Ҫ����һ������,��function_core��
        if (!submitcheck('newpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
            $this->mod->initPost($data);
            $data['action'] = 'new';
            $this->assign($data);
            $this->display($this->mod->template['post']);
        } else {

            /* about sql injection
             * In PHP, the configuration of 'magic quote' can escape single/double quote automaticly. but the data you submit can be jumbled, it is possible that sql injection exists */

            $postdata = array_merge($_GET, $_POST);

            $postdata['type'] = implode(",", $postdata['type']);
            $message = $this->mod->initPost($postdata, true);
            if ($message) {
                $this->showmessage($message, '', array(), array());
            }

            $postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
            $postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
            $this->mod->dopost($postdata);
        }
    }

    /* ��������ʱ,ִ�и����DianpingCtl��dopost������,��ִ��_editpost */

    function _editpost($data) {
        global $_G;
        $tid = intval($_G['gp_tid']);
        $pid = intval($_G['gp_pid']);

        if ($pid <= 0 || $tid <= 0)
            $this->showmessage('nopidandtid');
        if (!submitcheck('editpostsubmit', 0, $data['seccodecheck'], $data['secqaacheck'])) {
            $this->mod->initPost($data);

            $data['action'] = 'edit';
            $data['editdata'] = $this->mod->getview($tid);
            $pro_id = $data['editdata'][$this->mod->_vars['pro']];
            $mdRegion = m('regions');
            $data['cities'] = $mdRegion->getCitiesByProvince($pro_id);

            $typelist = $data['editdata']['type'];
            $typelistarr = explode(',', $typelist);
            foreach ($typelistarr as $k => $v) {
                $typelists[$v] = 1;
            }
            $data['typelists'] = $typelists;
            $this->assign($data);
            $this->display($this->mod->template['post']);
        } else {
            /* about sql injection
             * In PHP, the configuration of 'magic quote' can escape single/double quote automaticly. but the data you submit can be jumbled, it is possible that sql injection exists */
            $postdata = array_merge($_GET, $_POST);
            $postdata['type'] = implode(",", $postdata['type']);
            $message = $this->mod->initPost($postdata, true);
            if ($message) {
                $this->showmessage($message, '', array(), array());
            }

            $postdata['subject'] = trim(dhtmlspecialchars($postdata['subject']));
            $postdata['message'] = trim(dhtmlspecialchars($postdata['message']));
            $this->mod->dopost($postdata);
        }
    }

    function editmap() {
        global $_G;
        if (!$_G['tid'] || !$_G['gp_lng'] || !$_G['gp_lat'] || $_G['forum']['ismoderator'] != 1) {
            $this->showmessage('���ݴ���');
        }

        $this->mod->edit("tid = {$_G['tid']}", array('longitude' => $_G['gp_lng'], 'latitude' => $_G['gp_lat']));
        die('success');
    }

}
