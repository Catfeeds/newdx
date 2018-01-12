<?php
/**
 *	滑雪详情页
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
	include template('dianping/skiing_comment');
	exit;
}

//获取滑雪场详细信息
require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('skiing', 'showimg,url,tel,addr,provinceid,lon,lat,serverid,dir,dgurl');

if(empty($detail) || $detail['fid'] != $dp_modules['skiing']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('您要查看的内容不存在或未审核，请返回'); }

//SEO信息处理
$pageTitle = $detail['subject'].'地址|电话|价格|营业时间'.($page>1 ? " - 第{$page}页" : '')." - {$_G['setting']['bbname']}";
$metakeywords = $detail['subject'].'点评口碑 - 户外资料网';
$metadescription = $detail['subject'].'地址电话联系方式,'.$detail['subject'].'用户口碑点评打分,帮你全面了解'.$detail['subject'];

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//面包屑导航
$_G['cache']['dp_skiing_pro'] ? $region = $_G['cache']['dp_skiing_pro'] : updatecache('dp_skiing_pro');
$subnav = make_nav(array(array('url'=>"&order=lastpost&pro={$detail['provinceid']}&page=1",'title'=>$region[$detail['provinceid']]['name'])));

//图片轮播！！滑雪场未用附件存图，以后改进的话再用以下方法
// require_once libfile('dianping/attach','class');
// $attach = new attach();
// $piclist = $attach->get_img($tid,$detail['pid'],'plugin');
// $detail['message'] = $attach->handle_img($detail['message']);
// if(empty($piclist))
// {
	$piclist[0]['attachment'] = $detail['showimg'];
	$piclist[0]['dir'] = $detail['dir'];
	$piclist[0]['serverid'] = $detail['serverid'];
// }

//更新点击量
$detail_obj->updateviews();

//侧栏活动线路广告
$hddata = gethddata('xuechang', 6, 0, 7, $_G['clientip']);

//边栏数据
//热门
$_G['cache']['dp_skiing_sidebar_hot'] ? $sidebar_hot = $_G['cache']['dp_skiing_sidebar_hot'] : updatecache('dp_skiing_sidebar_hot');
//同地区
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

if(!empty($detail['provinceid']))
{
	$sidebar_region = $list_obj->getlist($mod, '', 'ispublish=1 and provinceid='.$detail['provinceid'].' and tid !='.$tid, 0, 6, 'id desc');
}
//通过经纬度来获取地址fid
include DISCUZ_ROOT.'/api/activity/activity_model.php';
$activity = new activity();
$data =$activity->parse_forum($detail['lon'], $detail['lat']);
//数据库调取数据
$activity_list    = array();
$tids    = array();
$aids    = array();
$sql   = "select a.aid, a.tid, a.cost, a.starttimefrom,a.place,a.collectplace, a.starttimeto, a.place, a.expiration, a.nature, a.class, a.timediff, t.subject, t.typeid from ";
$sql  .= DB::table('forum_activity')." a ";
$sql  .= " left join ".DB::table('forum_thread')." t ON t.tid=a.tid";
$sql  .= " WHERE t.displayorder>'-1' and t.fid = {$data['fid']} and a.timediff < 4 and a.class like '%滑雪%' and a.expiration > {$_G[timestamp]} and a.aid >0 order by a.tid desc limit 6";
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
    $result = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=getData&data_type=category&type_id=6&limit=0-{$limit}");
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
include template('dianping/skiing_showview');
?>
