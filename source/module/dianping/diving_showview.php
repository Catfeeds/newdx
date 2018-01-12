<?php
/**
 *    潜水详情页
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];
if ($tid <= 0) {
    showmessage('参数错误');
}

//点评评论页面ajax分页处理
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

//登陆状态我的点评--------------------------------------
if ($_G['uid']) {
    $mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
    //我的点评 为了统一模板赋值
    $comment['tid'] = $mycomment['tid'];
    $comment['pid'] = $mycomment['pid'];
    unset($commentlist[$mycomment['pid']]);
}

//AJAX返回评论列表数据
if ($_GET['ajaxreply'] == 1) {
    @header('Content-Type: text/html; charset=gbk');
    include template('dianping/diving_comment');
    exit;
}
//分类配置
$cate_type = $dp_category['diving']['type'];
//获取详细信息
require_once libfile('dianping/detail', 'class');
$detail_obj = new detail($tid);
$detail = $detail_obj->getdetail('diving', 'i.lon, i.lat, i.addr, i.provinceid, p.pid,i.type,i.cityid');

if(empty($detail) || $detail['fid'] != $dp_modules['diving']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }

//title, description, keywords
$pageTitle= $detail['subject']."官网|地址|电话|怎么样-潜水场地点评 - [page]{$_G['setting']['bbname']}";
if($page>1){
    $pageTitle = strtr($pageTitle,'[page]',' 第'.$page.'页 -');
}else{
    $pageTitle = str_replace('[page]','',$pageTitle);
}
$metadescription = '关于'.$detail['subject'].'的详细介绍包括价格,地址,联系方式,服务水平，场地环境以及真实用户点评感受，为前往'.$detail['subject'].'的潜水爱好者提供权威靠谱的信息参考';
$metakeywords= $detail['subject'];

//更新点击量
$detail_obj->updateviews();

//侧栏活动线路广告
$hddata = gethddata('diving', 16, 0, 7, $_G['clientip']);

//热门列表及同地区列表
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
$_G['cache']['dp_diving_list_hot'] ? $sidebar_list_hot = $_G['cache']['dp_diving_list_hot'] : updatecache('dp_diving_list_hot');
if ($detail['provinceid']) {
    $sidebar_list_same = $list_obj->getlist($mod, '', 'ispublish=1 and provinceid=' . $detail['provinceid'], 0, 4, 'id asc');
}


//获取地区缓存
$modlistall = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum', 'ispublish=1', $start, '', $orderby, '', 0);

/*start----为省市（涵盖国内外所有）获取及对省市进行过滤,info表存在才将其显示出来***************************/
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

//获得分类name
if($detail['type']){
	$type_array=explode(',', $detail['type']);
	$typename='';
	foreach ($type_array as $value){
		$typename.="<a href=\"http://www.8264.com/dianping.php?mod={$mod}&act=showlist&order=lastpost&type={$value}&provinceid=0&cityid=0&page=1\" target=\"_brank\">{$cate_type[$value]}</a> ";
	}
}

/*此行开始，点评详情页头图logo图及详细内容中图片的获取**********************/
if ($detail_obj->attach) {
    $piclist = $detail_obj->attach->get_img($tid, $detail['pid'], 'plugin');
} else {
    require_once libfile('dianping/attach', 'class');
    $attach = new attach();
    $piclist = $attach->get_img($tid, $detail['pid'], 'plugin');
}
/*此行结束，点评详情页头图logo图及详细内容中图片的获取**********************/

//验证码
$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);

//调取在外线路接口，展示潜水广告
/*
$result = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=getData&data_type=category&type_id=16&limit=0-3");
$result_data = json_decode($result, true);
foreach($result_data as $k=>$v){
   $title = diconv($v['title'], "utf-8", "gbk");
   $place = diconv($v['start_place'], "utf-8", "gbk");
   $result_data[$k]['subject'] = $title;
   //去掉集合地两端逗号
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
//调取在外的活动  hd.8264.com
$result = requestRemoteData("http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=category&type_id=16&limit=0-6");
$result_data = json_decode($result, true);

foreach($result_data as $k=>$v){
       $title = diconv($v['title'], "utf-8", "gbk");
       $place = diconv($v['start_place'], "utf-8", "gbk");
       $result_data[$k]['subject'] = $title;
       //去掉集合地两端逗号
       //$place = trim($place, ",");
       //$place = ltrim($place, ",");
       $result_data[$k]['place'] = $place;
       $url = str_replace('m.', "", $v['url']);
       $result_data[$k]['url_zaiwai'] = $url;  
    }
include template('dianping/diving_showview');
?>
