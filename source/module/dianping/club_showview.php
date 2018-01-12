<?php
/**
 *    山峰详情页
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
$where="";
if($_G['gp_starnum']){
	$where.=' and starnum='.$_G['gp_starnum'].' ';
	$starnum=$_G['gp_starnum'];
}
require_once libfile('dianping/comment', 'class');
$comment_obj = new comment();
$commentlist = $comment_obj->getlist($tid, '', $start, $perpage, 'p.dateline', 1,$where);
$recordnum = $comment_obj->recordnum;
$multipage = multi($recordnum, $perpage, $page, "{$_G['config']['web']['portal']}dianping.php?mod={$mod}&act=showview&tid={$tid}");

//登陆状态我的点评
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
    include template('dianping/club_comment');
    exit;
}

//分类配置
$cate_type = $dp_category['club']['type'];
$cate_placetype = $dp_category['club']['placetype'];
//详细页信息获取
require_once libfile('dianping/detail', 'class');
$detail_obj = new detail($tid);
$detail = $detail_obj->getdetail('club', 'i.author_id,i.ispublish,i.uids,i.contact,i.weixin,i.qq,i.lon, i.lat, i.addr,i.tel,i.provinceid,i.placetype,i.type,i.cityid,i.serverid');
if($detail['ispublish']==0 && $detail['author_id']!=$_G['uid'] && $_G['adminid']!=1){
    showmessage('您要查看的内容不存在或未审核，请返回'); 
}
//if(empty($detail) || $detail['fid'] != $dp_modules['club']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }

//title, description, keywords
$pageTitle= $detail['subject']."俱乐部地址|电话|怎么样-户外俱乐部点评 - 户外资料网8264.com";
if($page>1){
    $pageTitle = strtr($pageTitle,'[page]',' 第'.$page.'页 -');
}else{
    $pageTitle = str_replace('[page]','',$pageTitle);
}
$metadescription = $detail['subject'].'俱乐部详细介绍包括地址，联系方式，服务水平以及真实用户点评感受，为驴友出行提供权威靠谱的信息参考';
$metakeywords= $detail['subject'];

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//更新点击量
$detail_obj->updateviews();

//热门列表及同地区列表
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
$_G['cache']['dp_club_list_hot'] ? $sidebar_list_hot = $_G['cache']['dp_club_list_hot'] : updatecache('dp_club_list_hot');

if ($detail['provinceid']) {
    $sidebar_list_same = $list_obj->getlist($mod, '', 'ispublish=1 and provinceid=' . $detail['provinceid'], 0, 4, 'id asc');
}

$modlistall = $list_obj->getlist($mod, 'type,cityid,provinceid,addr,cnum', 'ispublish>=0', $start, '', $orderby, '', 0);
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
    if (!$rv['shengid']) {
        $proList[$rk] = $rv;
    }
}

//获得分类name
if($detail['type']){
	$type_array=explode(',', $detail['type']);
	$typename='';
	foreach ($type_array as $value){
		$typename.="<a href=\"http://www.8264.com/dianping.php?mod={$mod}&act=showlist&order=lastpost&type={$value}&placetype=0&provinceid=0&cityid=0&page=1\" target=\"_brank\">{$cate_type[$value]}</a> ";
	}
}
/*此行开始，点评详情页头图logo图及详细内容中图片的获取**********************/
if ($detail_obj->attach) {
    $piclist = $detail_obj->attach->get_img($tid, $detail['pid'], 'plugin');
} else {
    require_once libfile('dianping/attach','class');
    $attach = new attach();
    $piclist = $attach->get_img($tid, $detail['pid'], 'plugin');
}
/*此行结束，点评详情页头图logo图及详细内容中图片的获取**********************/
//获取相应用户名的活动列表
//$filemtime = memory('get', 'sendmail_lock');
//if(){
//    
//}
$list = array();
if($detail['uids']){
    $uids = explode(",",$detail['uids']);
    foreach($uids as $k=>$v){
        $sql_name = DB::result_first("SELECT uid FROM ".DB::table('common_member')." where username = '{$v}'".getSlaveID());
        if($sql_name){
            $name_arr[] = $sql_name;
        }
    }
    $name = implode(",",$name_arr);
    if($name){
        $sql   = "select a.*, t.subject, t.dateline from ";
        $sql  .= DB::table('forum_activity')." a ";
        $sql  .= " inner join ".DB::table('forum_thread')." t ON t.tid=a.tid";
        $sql  .= " WHERE t.displayorder>'-1' and a.uid in ({$name}) and t.special=4 ";
        $sql  .= " order by t.dateline desc limit 5" . getSlaveID();
        $query = DB::query($sql);
        while ($v = DB::fetch($query)) {
            $list[] = $v;
            $tids[$v['tid']] = $v['tid'];
            $aids[$v['aid']] = $v['aid'];	
        }
        //获得活动图片的信息
        if ($aids) {
                $aids  = implode(',', $aids);
                $sql   = "select a.aid, a.attachment, a.serverid, a.dir from ".DB::table('forum_attachment')." a where a.aid in ({$aids})";
                $query = DB::query($sql);
                while ($v = DB::fetch($query)) {				
                        if ($v['serverid'] > 50) {
                                $attachList[$v['aid']] = getimagethumb(60 ,60 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                        } else {
                                $attachList[$v['aid']] = getimagethumb(60 ,60 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                        }				
                }
        }
        //memory('set', $m_key, $list,  1296000);
        
    }
    
}
include template('dianping/club_showview');
?>
