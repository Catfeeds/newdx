<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once 'dianpingmod.model.php';
require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
class ClubModel extends DianpingmodModel {

    var $table = 'dianping_club_info';
    //var $prikey = 'id';
    var $alias = 'club';
    var $_moduleid = 'club';
    var $_vars = array(
        'pk' => 'id',
        'uids'=>'uids',
        'tid' => 'tid',
        'name' => 'subject',
        'pic' => 'showimg',
        'type' => 'type',
        'placetype' => 'placetype',
        'contact' => 'contact',
        'weixin' => 'weixin',
        'qq' => 'qq',
        'tel' => 'tel',
        'enable' => 'ispublish',
        'pro' => 'provinceid',
        'city' => 'cityid',
        'address' => 'addr',
        'longitude' => 'lon',
        'latitude' => 'lat',
        'posttime' => 'dateline',
        'score' => 'score',
        'num' => 'cnum',
        'lastrate' => 'lastrate',
        'lastscore' => 'lastscore',
        'lastpost' => 'lastpost',
        'serverid' => 'serverid',
        'chenglishijian'=>'chenglishijian',
        'lingduinum'=>'lingduinum',
        'gongsitype'=>'gongsitype',
        'clubid'=>'clubid',
        'clubname'=>'clubname',
        'subject_jiancheng'=>'subject_jiancheng',
        'author_id'=>'author_id'
    );

    /**
     * 获取表数据
     * @access public
     * @param int $tid
     * @return Array
     */
    public function getData($where, $fields = '*', $order = "id asc") {
        $arrParam = array();
        if ($where) {
            $arrParam['conditions'] = $where;
        }
        $arrParam['order'] = $order;
        $arrParam['fields'] = $fields;
        return $this->find($arrParam, false);
    }

    //新增和编辑的时候公共代码
    function initPost(&$data, $submit = false) {
        global $_G;
        $data['pro'] = $data['pro'] ? $data['pro'] : $data['provinceid'];
        if ($submit) {
            //处理其它垃圾数据, 若用户恶意破坏js的前台验证, 需将该数据删除, 用户可能通过调试工具,修改默认提供的值,此处需要进行验证
            $typelist = (array) $this->_getTypeClass();
            //该处与pre_pluugin_dianping_modules表有关,不能改变typeclassid中的顺序
            $typecount = count($typelist);
            $clubTypeList = $typecount >= 1 ? current($typelist) : array();
            //$placeTypelist = $typecount >= 2 ? next($typelist) : array();
            //validate subject
            if (!$data['subject'] || strlen($data['subject']) > 80) {
                return 'post_params_exist_error';
            }
            if (!$data['message'] || mb_strlen($data['message'], 'gbk') < 50) {
                return '您的俱乐部简介没有填写或者少于50个字';
            }
            if (!$data['subject_jiancheng'] || mb_strlen($data['subject_jiancheng'], 'gbk') > 6) {
                return '您的俱乐部简称没有填写或者大于6个字';
            }
            if (!$data['provinceid']) {
                return 'post_params_exist_error';
            }

            $mdregions = m('regions');
            if ($data['city'] == $data['provinceid']) {
                $c_province = $mdregions->find(array('fields' => 'codeid',
                    'conditions' => "codeid='{$data[city]}' AND shengid=0",
                    'limit' => 1
                ));
            } else {
                $c_province = $mdregions->find(array('fields' => 'codeid',
                    'conditions' => "codeid='{$data[city]}' AND shengid='{$data[provinceid]}'",
                    'limit' => 1
                ));
            }
            if (!$c_province) {
                return 'post_params_exist_error';
            }
            //验证是否必须要pic模块
            if (empty($data['imgselect']) && $this->getChildStatus('pic')) {
                return 'model_need_pic';
            }
            
            $new_img_edit = $_G['gp_attachnew'];
            if (preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data['message'])) {
                preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data['message'], $matches);
                $send_img = $matches[2];
                foreach ($new_img_edit as $key => $descon) {
                    if (!in_array($key, $send_img)) {
                        unset($new_img_edit[$key]);
                    }
                }
            } else {
                unset($new_img_edit);
            }
            $data['new_img_edit'] = $new_img_edit;
            $data['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $data['message']);
            $data['message'] = trim($data['message']);
            $newlogs = new logs('clubRegion');
            $newlogs->log_array($data, 'data');
        } else {
            $data['shorttitle'] = '';
            $year = date("Y");
            $staryear = "1990";
            $year_arr = array();
            for ($i = $staryear; $i <= $year; $i++) {
                $year_arr[$i] = $i . "年";
            }
            $typelist = (array) $this->_getTypeClass();
            //该处与pre_pluugin_dianping_modules表有关,不能改变typeclassid中的顺序
            $typecount = count($typelist);
            $data['clubTypeList'] = $typecount >= 1 ? current($typelist) : array();
            $data['year_arr'] = $year_arr;
            $data['placeTypelist'] = $typecount >= 2 ? next($typelist) : array();
            $data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->_moduleid}";

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
                'simplemode' => !isset($_G['cookie']['editormode_' . $data['editorid']]) ? 1 : $_G['cookie']['editormode_' . $data['editorid']],
            );

            $mdregions = m('regions');
            $data['provinces'] = $mdregions->getAllProvinces('codeid,cityname');

            require_once libfile('function/post');
            if ($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
                $data['attachlist'] = getattach($pid, 0, 'all');
                $data['attachs'] = $data['attachlist']['attachs'];
                $data['imgattachs'] = $data['attachlist']['imgattachs'];
                unset($data['attachlist']);
                $attachfind = $attachreplace = array();
                if (!empty($data['attachs']['used'])) {
                    foreach ($data['attachs']['used'] as $attach) {
                        if ($attach['isimage']) {
                            $attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
                            $attachreplace[] = '[attachimg]' . $attach['aid'] . '[/attachimg]';
                        }
                    }
                }
                if (!empty($data['imgattachs']['used'])) {
                    foreach ($data['imgattachs']['used'] as $attach) {
                        $attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
                        $attachreplace[] = '[attachimg]' . $attach['aid'] . '[/attachimg]';
                    }
                }
                $attachfind && $data['editdata']['message'] = preg_replace($attachfind, $attachreplace, $data['editdata']['message']);
            }
            $data['imgattachs']['unused'] = !$sortid ? $data['imgattachs']['unused'] : '';

            //个人相册加载
            if ($_G['uid']) {
                $albumlist = array();
                $query = DB::query("SELECT albumid, albumname, picnum FROM " . DB::table('home_album') . " WHERE uid='$_G[uid]' ORDER BY updatetime DESC");
                while ($value = DB::fetch($query)) {
                    if ($value['picnum']) {
                        $albumlist[] = $value;
                    }
                }
                $data['albumlist'] = $albumlist;
            }
        }
    }

    //使用编辑器提交后, html标签发生了变化, 需处理编辑器中内容. 该方法是简化后的方法,少执行了很多代码, 暂时没有发现bug.
    function bbcode2htmlcode($message) {
        require_once libfile('function/newdiscuzcode');
        return discuzcode($message);
    }

}
