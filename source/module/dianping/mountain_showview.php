<?php
/**
 *	山峰详情页
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];

if($tid <= 0) { showmessage('参数错误'); }

//获取点评列表
//处理分页
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

//登陆状态我的点评
if($_G['uid'])
{
	$mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
	//此两项用于管理处
	$comment['tid'] = $mycomment['tid'];
	$comment['pid'] = $mycomment['pid'];

	unset($commentlist[$mycomment['pid']]);
}

//AJAX返回评论列表数据
if($_GET['ajaxreply'] == 1)
{
	@header('Content-Type: text/html; charset=gbk');
	include template('dianping/mountain_comment');
	exit;
}

require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('mountain', 'i.type, i.height, i.region, i.altitude, i.lon, i.lat, i.season');

if(empty($detail) || $detail['fid'] != $dp_modules['mountain']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }

//SEO信息处理
$pageTitle = $detail['subject'].' - 山峰资料库'.($page>1 ? " - 第{$page}页" : '')." - {$_G['setting']['bbname']}";
$metakeywords = $detail['subject'].' - 山峰资料库 - 户外资料网';
$metadescription = $detail['subject'].'山峰介绍以及用户攀登经历经验分享，帮助登山爱好者更好攀登'.$detail['subject'];

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//图片轮播
require_once libfile('dianping/attach','class');
$attach = new attach();
$piclist = $attach->get_img($tid,$detail['pid'],'plugin');
// $detail['message'] = $attach->handle_img($detail['message']);
// if(empty($piclist))
// {
// 	$piclist[0]['attachment'] = $detail['showimg'];
// 	$piclist[0]['dir'] = $detail['dir'];
// 	$piclist[0]['serverid'] = $detail['serverid'];
// }

//更新点击量
$detail_obj->updateviews();

//侧栏活动线路广告
$hddata = gethddata('mountain', 51, 0, 7);

//分类配置
$cate_dq = $dp_category['mountain']['dq'];
//边栏数据
//热门
$_G['cache']['dp_mountain_sidebar_hot'] ? $sidebar_hot = $_G['cache']['dp_mountain_sidebar_hot'] : updatecache('dp_mountain_sidebar_hot');
//周边
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

if(!empty($detail['type']))
{
	$sidebar_type = $list_obj->getlist($mod, '', 'ispublish=1 and type='.$detail['type'], 0, 4, 'id desc');
}
/*
 * 根据ip调取相应的周末活动
 */
/*
function get_clientip(){
    $ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                    if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                            $ip = $xip;
                            break;
                    }
            }
    }
    return $ip;
}

$ip = get_clientip();
//$ip = "111.160.216.2";
require_once DISCUZ_ROOT.'./source/plugin/components/ipdata/ipdata.php';
function getStateByIp($ip) {
        $data = _convertip($ip);
        $states = '安徽 北京 重庆 福建 甘肃 广东 广西 贵州 海南 河北 河南 湖北 湖南 黑龙江 吉林 江苏 江西 辽宁 内蒙古 宁夏 青海 山东 山西 陕西 上海 四川 天津 西藏 新疆 云南 浙江';
        foreach (explode(' ', $states) as $state) {
                if (strpos($data, $state) !== false) {
                        return $state;
                }
        }
        return NULL;
}
$state = getStateByIp($ip);
$state = !$state ? '天津' : $state;
	$arrZaiwaiarea = array(
	    '北京' => "beijing",
	    '天津' => "tianjin",
	    '重庆' => "chongqing",
	    '上海' => "shanghai",
	    '河北' => "hebei",
	    '陕西' => "shanxi",
	    '辽宁' => "liaoning",
	    '吉林' => "jilin",
	    '黑龙江' => "heilongjiang",
	    '江苏' => "jiangsu",
	    '浙江' => "zhejiang",
	    '安徽' => "anhui",
	    '福建' => "fujian",
	    '江西' => "jiangxi",
	    '山东' => "shandong",
	    '河南' => "henan",
	    '湖北' => "hubei",
	    '湖南' => "hunan",
	    '广东' => "guangdong",
	    '海南' => "hainan",
	    '四川' => "sichuan",
	    '贵州' => "guizhou",
	    '云南' => "yunnan",
	    '山西' => "shan_xi",
	    '甘肃' => "gansu",
	    '青海' => "qinghai",
	    '内蒙古' => "neimenggu",
	    '广西' => "guangxi",
	    '西藏' => "xizang",
	    '宁夏' => "ningxia",
	    '新疆' => "xinjiang"
	);
	$zaiwaiarea = $arrZaiwaiarea[$state];
if (!$state) {
        return NULL;
}
$forum = memory('get' ,'cache_forum_forumlike_'.md5($state));
if($_G['uid']==1){
        memory('rm' ,'cache_forum_forumlike_'.md5($state));
        memory('rm' ,'cache_forumthread_data_fid_'.$forum['fid']);
}
if(!$forum){
        $forum = DB::fetch_first("SELECT * FROM ".DB::table('forum_forum')." WHERE fup = 76 AND name LIKE '%$state'");
        memory('set' ,'cache_forum_forumlike_'.md5($state) ,$forum ,3600);
}
//数据库调取数据
$activity_list    = array();
$tids    = array();
$aids    = array();
$time = TIMESTAMP;
$sql   = "select a.aid, a.tid, a.cost, a.starttimefrom,a.place,a.collectplace, a.starttimeto, a.place, a.expiration, a.nature, a.class, a.timediff, t.subject, t.typeid from ";
$sql  .= DB::table('forum_activity')." a ";
$sql  .= " left join ".DB::table('forum_thread')." t ON t.tid=a.tid";
$sql  .= " WHERE t.displayorder>'-1' and t.fid = {$forum['fid']}  and a.timediff < 4 and a.expiration > {$time} and a.aid >0 order by a.tid desc limit 6";
$sql  .= getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
    $activity_list[] = $v;
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
                        $attachList[$v['aid']] = getimagethumb(640,320 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                } else {
                        $attachList[$v['aid']] = getimagethumb(640 ,320 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                }
        }
}
$count = count($activity_list);
if($count < 6){
    $limit = 6 - $count;
    //调取在外线路接口，展示线路广告
    $result = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=getData&data_type=category&type_id=1&limit=0-{$limit}");
    $result_data = json_decode($result, true);
    foreach($result_data as $k=>$v){
       $title = diconv($v['title'], "utf-8", "gbk");
       $place = diconv($v['start_place'], "utf-8", "gbk");
       $result_data[$k]['subject'] = $title;
       //去掉集合地两端逗号
       $place = trim($place, ",");
       //$place = ltrim($place, ",");
       $result_data[$k]['place'] = $place;
       $str = explode("http://m.wan.8264.com/", $v['url']);
       $url = "www.zaiwai.com/".$str[1];
       $result_data[$k]['url_zaiwai'] = $url;
       $price = explode(".00", $v['price']);
       $result_data[$k]['price'] = $price[0];
    }
}
 *
 */
//调取在外的活动  hd.8264.com
$result = requestRemoteData("http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=category&type_id=51&limit=0-6");
$result_data = json_decode($result, true);

foreach($result_data as $k=>$v){
       $title = diconv($v['title'], "utf-8", "gbk");
       $place = diconv($v['start_place'], "utf-8", "gbk");
       $result_data[$k]['subject'] = $title;
       //去掉集合地两端逗号
       //$place = trim($place, ",");
       //$place = ltrim($place, ",");
       $result_data[$k]['place'] = $place;
       $result_data[$k]['url_zaiwai'] = $v['url_pc'];
    }
include template('dianping/mountain_showview');
?>
