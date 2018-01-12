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
    include template('dianping/line_comment');
    exit;
}

//线路详细内容读取
require_once libfile('dianping/detail', 'class');
$detail_obj = new detail($tid);
$detail = $detail_obj->getdetail('line', 'i.type,i.timetype');

if(empty($detail) || $detail['fid'] != $dp_modules['line']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }
//title, description, keywords
$pageTitle= $detail['subject']." - [page]{$_G['setting']['bbname']}";
if($page>1){
    $pageTitle = strtr($pageTitle,'[page]',' 第'.$page.'页 - ');
}else{
    $pageTitle = str_replace('[page]','',$pageTitle);
}
$metadescription = $detail['subject'].'的真实点评打分以及经验介绍，帮助驴友更好了解'.$detail['subject'].'';
$metakeywords= $detail['subject'];

//更新点击量
$detail_obj->updateviews();

//侧栏活动线路广告
$hddata = gethddata('line', 4, 0, 7);

/*start--------热门列表及同地区列表******************************/
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist;
$_G['cache']['dp_line_list_hot'] ? $sidebar_list_hot = $_G['cache']['dp_line_list_hot'] : updatecache('dp_line_list_hot');
require libfile('dianping/zone', 'class');
$zone = new zone();
$linecross = $zone->getlinecross($tid);
foreach ($linecross as $k => $v) {
    if ($k == 0) {
        $proid = $v['province'];
    }
    $cityids_tmp[] = $v['city'];
}
if (!empty($proid)) {
    $tids = $zone->getsamecross($tid, $proid, $limit = 4);
}
if (!empty($tids)) {
    $sidebar_list_same = $list_obj->getlist($mod, '', 'ispublish=1 and tid in ( ' . $tids . ' )', 0, 0, 'id asc');
};
/*end--------热门列表及同地区列表****************************/

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);


//获取线路line_region表的信息，与line_cross表的cityid对应匹配城市名称，此处为取详细页顶部线路经过城市
$lineregion = $zone->getlineregion();
$onlycity = $lineregion['onlycity'];
$proList = ($lineregion['allpro']);
arsort($proList);
$_G['cache']['dp_country_region'] ? $regionList = $_G['cache']['dp_country_region'] : updatecache('dp_country_region');
$regionList["999999"] = array("cityname" => "国外", "shengid" => 0, "shiid" => 0, "citycode" => "999999");

$plug_content_top = '<div class="">经过地域：';
foreach ($cityids_tmp as $k => $v) {
    if ($k > 0) {
        $plug_content_top .= " -- ";
    }
    $plug_content_top .= "<a href= \"http://www.8264.com/dianping.php?mod=line&act=showlist&order=lastpost&type={$detail['type']}&timetype={$detail['timetype']}&provinceid={$onlycity[$v]['provinceid']}&cityid=$v&page=1\">" . $onlycity[$v]['name'] . "</a>";
}
$plug_content_top .= "</div>";

/*gps获取****************************************************/
if($detail_obj->attach){
    $gpsshow = is_numeric($tid) ? $detail_obj->attach->getGps($tid) : null;
}else{
    require_once libfile('dianping/attach','class');
    $attach = new attach();
    $gpsshow = is_numeric($tid) ? $attach->getGps($tid) : null;
}
$gps_map = !empty($gpsshow) ? $_G['config']['web']['attach'] . $gpsshow[0]["htmlfiledir"] . $gpsshow[0]["htmlfilename"] : "";
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
//$ip="58.83.155.255";
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
if (!$state) {
        $state = "北京";
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

//通过经纬度来获取地址fid
//数据库调取数据
$activity_list    = array();
$tids    = array();
$aids    = array();
$time = TIMESTAMP;
$sql   = "select a.aid, a.tid, a.cost, a.starttimefrom,a.place,a.collectplace, a.starttimeto, a.place, a.expiration, a.nature, a.class, a.timediff, t.subject, t.typeid from ";
$sql  .= DB::table('forum_activity')." a ";
$sql  .= " left join ".DB::table('forum_thread')." t ON t.tid=a.tid";
$sql  .= " WHERE t.displayorder>'-1' and t.fid = {$forum['fid']} and a.timediff < 4 and a.expiration > {$time} and a.aid >0 order by a.tid desc limit 6";
//$sql  .= " and a.starttimeto > '{$_G['timestamp']}' ";
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
                        $attachList[$v['aid']] = getimagethumb(640 ,320 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                } else {
                        $attachList[$v['aid']] = getimagethumb(640 ,320 ,2 ,"{$v['dir']}/{$v['attachment']}", 0, $v['serverid']);
                }
        }
}
$count = count($activity_list);
if($count < 6){
    $limit = 6 - $count;

    //调取在外线路接口，展示线路广告
    $result = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=getData&data_type=category&type_id=4&limit=0-{$limit}");
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
}
include template('dianping/line_showview');
?>
