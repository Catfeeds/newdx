<?php
/**
 * Created by PhpStorm.
 * User: lgt
 * Date: 14-11-14
 * Time: ����10:11
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
//��������
$myuid = $_G['uid'];
if($myuid){
    $cate_type = $dp_category['hostel']['type'];
    $cityid = !empty($_G['gp_cityid']) ? intval($_G['gp_cityid']) : 0;
    $provinceid = !empty($_G['gp_provinceid']) ? intval($_G['gp_provinceid']) : 0;
    //�����б�����
    $perpage = 20;
    $page = intval($_G['gp_page']) ? intval($_G['gp_page']) : 1;
    $start = ($page - 1) * $perpage;
    //�б�����
    require_once libfile('dianping/modlist', 'class');
    $list_obj = new modlist();
    if($_G['adminid'] ==1){
        $where = "ispublish>=0";
    }else{
        $where = "ispublish>=0 and author_id = {$myuid}";
    }
    
    $orderby = "id desc";
//    if($_G['uid'] == 0){
//        showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); 
//    }
    $modlist_my = $list_obj->getlist($mod, 'ispublish,cityid,provinceid,addr,cnum,tel', $where, $start, $perpage, $orderby, '', 1);
    $modlistall = $list_obj->getlist($mod, 'ispublish,cityid,provinceid,addr,cnum', 'ispublish>=0', $start, '', $orderby, '', 0);
    
    /*start----Ϊʡ�У����ǹ��������У���ȡ����ʡ�н��й���,info����ڲŽ�����ʾ����***************************/
    $allcodeList = array();
    foreach ($modlistall as $key => $val) {
        $allcodeList[$val['provinceid']] = 1;
        $allcodeList[$val['cityid']] = 1;
    }
    $_G['cache']['dp_country_region'] ? $countries = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
    foreach ($countries as $rk => $rv) {
        if (!$allcodeList[$rk]) {
            unset($countries[$rk]);
            continue;
        }
        if ($rv['shengid']) {
            if ($allcodeList[$rv['codeid']]) {
                $cityList[$rv['shengid']][$rk] = $rv;
            }
        } else {
            $proList[$rk] = $rv;
        }
    }
    /*end----Ϊʡ�У����ǹ��������У���ȡ����ʡ�н��й���,info���д��ڲŽ�����ʾ����***************************/

    $recordnum = $list_obj->recordnum; //lgt
    $multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=myshowlist");
    /*start----lang��,����pagetitleͳһ����*/
    $pageTitle ="�ҷ����������ջ-��{$page}ҳ - ����������8264.com";
    $metakeywords ="�����ջ";
    $metadescription = "�ҷ����������ջ";
    unset($pro_city);
    unset($pro_city_ctype);
    /*end----����lang��,����pagetitleͳһ����*/
    //���ʵ���
    $_G['cache']['dp_hostel_comment_rate'] ? $comment_rate = $_G['cache']['dp_hostel_comment_rate'] : updatecache('dp_hostel_comment_rate');
    include template('dianping/hostel_myshowlist');
}else{
    echo "<script>alert('����Ҫ��½����ܲ鿴');window.location.href = 'http://www.8264.com/member.php?mod=logging&action=login';</script>";
}
