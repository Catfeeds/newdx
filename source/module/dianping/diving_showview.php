<?php
/**
 *    Ǳˮ����ҳ
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];
if ($tid <= 0) {
    showmessage('��������');
}

//��������ҳ��ajax��ҳ����
$page = max(1, $_G['gp_page']);
$perpage = 10;
$start = ($page - 1) * $perpage;
$where = " ";
if($_G['gp_starnum']){
	$where.=' and starnum='.$_G['gp_starnum'].' ';
	$starnum=$_G['gp_starnum'];
}
require_once libfile('dianping/comment', 'class');
$comment_obj = new comment();
$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
$recordnum = $comment_obj->recordnum;
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");

//��½״̬�ҵĵ���--------------------------------------
if ($_G['uid']) {
    $mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
    //�ҵĵ��� Ϊ��ͳһģ�帳ֵ
    $comment['tid'] = $mycomment['tid'];
    $comment['pid'] = $mycomment['pid'];
    unset($commentlist[$mycomment['pid']]);
}

//AJAX���������б�����
if ($_GET['ajaxreply'] == 1) {
    @header('Content-Type: text/html; charset=gbk');
    include template('dianping/diving_comment');
    exit;
}
//��������
$cate_type = $dp_category['diving']['type'];
//��ȡ��ϸ��Ϣ
require_once libfile('dianping/detail', 'class');
$detail_obj = new detail($tid);
$detail = $detail_obj->getdetail('diving', 'i.lon, i.lat, i.addr, i.provinceid, p.pid,i.type,i.cityid');

if(empty($detail) || $detail['fid'] != $dp_modules['diving']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

//title, description, keywords
$pageTitle= $detail['subject']."����|��ַ|�绰|��ô��-Ǳˮ���ص��� - [page]{$_G['setting']['bbname']}";
if($page>1){
    $pageTitle = strtr($pageTitle,'[page]',' ��'.$page.'ҳ -');
}else{
    $pageTitle = str_replace('[page]','',$pageTitle);
}
$metadescription = '����'.$detail['subject'].'����ϸ���ܰ����۸�,��ַ,��ϵ��ʽ,����ˮƽ�����ػ����Լ���ʵ�û��������ܣ�Ϊǰ��'.$detail['subject'].'��Ǳˮ�������ṩȨ�����׵���Ϣ�ο�';
$metakeywords= $detail['subject'];

//���µ����
$detail_obj->updateviews();

//�������·���
$hddata = gethddata('diving', 16, 0, 7, $_G['clientip']);

//�����б�ͬ�����б�
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
$_G['cache']['dp_diving_list_hot'] ? $sidebar_list_hot = $_G['cache']['dp_diving_list_hot'] : updatecache('dp_diving_list_hot');
if ($detail['provinceid']) {
    $sidebar_list_same = $list_obj->getlist($mod, '', 'ispublish=1 and provinceid=' . $detail['provinceid'], 0, 4, 'id asc');
}


//��ȡ��������
$modlistall = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

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

//��÷���name
if($detail['type']){
	$type_array=explode(',', $detail['type']);
	$typename='';
	foreach ($type_array as $value){
		$typename.="<a href=\"http://www.8264.com/dianping.php?mod={$mod}&act=showlist&order=lastpost&type={$value}&provinceid=0&cityid=0&page=1\" target=\"_brank\">{$cate_type[$value]}</a> ";
	}
}

/*���п�ʼ����������ҳͷͼlogoͼ����ϸ������ͼƬ�Ļ�ȡ**********************/
if ($detail_obj->attach) {
    $piclist = $detail_obj->attach->get_img($tid, $detail['pid'], 'plugin');
} else {
    require_once libfile('dianping/attach', 'class');
    $attach = new attach();
    $piclist = $attach->get_img($tid, $detail['pid'], 'plugin');
}
/*���н�������������ҳͷͼlogoͼ����ϸ������ͼƬ�Ļ�ȡ**********************/

//��֤��
$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

//��ȡ������·�ӿڣ�չʾǱˮ���
/*
$result = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=getData&data_type=category&type_id=16&limit=0-3");
$result_data = json_decode($result, true);
foreach($result_data as $k=>$v){
   $title = diconv($v['title'], "utf-8", "gbk");
   $place = diconv($v['start_place'], "utf-8", "gbk");
   $result_data[$k]['subject'] = $title;
   //ȥ�����ϵ����˶���
   $place = trim($place, ",");
   $result_data[$k]['place'] = $place;
   $str = explode("http://m.wan.8264.com/", $v['url']);
   $url = "www.zaiwai.com/".$str[1];
   $result_data[$k]['url_zaiwai'] = $url;
   $price = explode(".00", $v['price']);
   $result_data[$k]['price'] = $price[0];
}
 * 
 */
//��ȡ����Ļ  hd.8264.com
$result = requestRemoteData("http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=category&type_id=16&limit=0-6");
$result_data = json_decode($result, true);

foreach($result_data as $k=>$v){
       $title = diconv($v['title'], "utf-8", "gbk");
       $place = diconv($v['start_place'], "utf-8", "gbk");
       $result_data[$k]['subject'] = $title;
       //ȥ�����ϵ����˶���
       //$place = trim($place, ",");
       //$place = ltrim($place, ",");
       $result_data[$k]['place'] = $place;
       $url = str_replace('m.', "", $v['url']);
       $result_data[$k]['url_zaiwai'] = $url;  
    }
include template('dianping/diving_showview');
?>
