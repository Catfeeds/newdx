<?php
/**
 *	��ѩ����ҳ
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
ob_start();
$tid = $_G['gp_tid'];

if($tid <= 0) { showmessage('��������'); }

//��ȡ�����б�
//�����ҳ
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

//��½״̬�ҵĵ���
if($_G['uid'])
{
	$mycomment = $comment_obj->getdetail('', $tid, $_G['uid']);
	//���������ڹ���
	$comment['tid'] = $mycomment['tid'];
	$comment['pid'] = $mycomment['pid'];

	unset($commentlist[$mycomment['pid']]);
}

//AJAX���������б�����
if($_GET['ajaxreply'] == 1)
{
	@header('Content-Type: text/html; charset=gbk');
	include template('dianping/skiing_comment');
	exit;
}

//��ȡ��ѩ����ϸ��Ϣ
require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('skiing', 'showimg,url,tel,addr,provinceid,lon,lat,serverid,dir,dgurl');

if(empty($detail) || $detail['fid'] != $dp_modules['skiing']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

//SEO��Ϣ����
$pageTitle = $detail['subject'].'��ַ|�绰|�۸�|Ӫҵʱ��'.($page>1 ? " - ��{$page}ҳ" : '')." - {$_G['setting']['bbname']}";
$metakeywords = $detail['subject'].'�����ڱ� - ����������';
$metadescription = $detail['subject'].'��ַ�绰��ϵ��ʽ,'.$detail['subject'].'�û��ڱ��������,����ȫ���˽�'.$detail['subject'];

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//���м����
$_G['cache']['dp_skiing_pro'] ? $region = $_G['cache']['dp_skiing_pro'] : updatecache('dp_skiing_pro');
$subnav = make_nav(array(array('url'=>"&order=lastpost&pro={$detail['provinceid']}&page=1",'title'=>$region[$detail['provinceid']]['name'])));

//ͼƬ�ֲ�������ѩ��δ�ø�����ͼ���Ժ�Ľ��Ļ��������·���
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

//���µ����
$detail_obj->updateviews();

//�������·���
$hddata = gethddata('xuechang', 6, 0, 7, $_G['clientip']);

//��������
//����
$_G['cache']['dp_skiing_sidebar_hot'] ? $sidebar_hot = $_G['cache']['dp_skiing_sidebar_hot'] : updatecache('dp_skiing_sidebar_hot');
//ͬ����
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

if(!empty($detail['provinceid']))
{
	$sidebar_region = $list_obj->getlist($mod, '', 'ispublish=1 and provinceid='.$detail['provinceid'].' and tid !='.$tid, 0, 6, 'id desc');
}
//ͨ����γ������ȡ��ַfid
include DISCUZ_ROOT.'/api/activity/activity_model.php';
$activity = new activity();
$data =$activity->parse_forum($detail['lon'], $detail['lat']);
//���ݿ��ȡ����
$activity_list    = array();
$tids    = array();
$aids    = array();
$sql   = "select a.aid, a.tid, a.cost, a.starttimefrom,a.place,a.collectplace, a.starttimeto, a.place, a.expiration, a.nature, a.class, a.timediff, t.subject, t.typeid from ";
$sql  .= DB::table('forum_activity')." a ";
$sql  .= " left join ".DB::table('forum_thread')." t ON t.tid=a.tid";
$sql  .= " WHERE t.displayorder>'-1' and t.fid = {$data['fid']} and a.timediff < 4 and a.class like '%��ѩ%' and a.expiration > {$_G[timestamp]} and a.aid >0 order by a.tid desc limit 6";
//$sql  .= " and a.starttimeto > '{$_G['timestamp']}' ";
$sql  .= getSlaveID();
$query = DB::query($sql);
while ($v = DB::fetch($query)) {
    $activity_list[] = $v;
    $tids[$v['tid']] = $v['tid'];
    $aids[$v['aid']] = $v['aid'];

}
//��ûͼƬ����Ϣ
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
    //��ȡ������·�ӿڣ�չʾ��·���
    $result = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=getData&data_type=category&type_id=6&limit=0-{$limit}");
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
}
include template('dianping/skiing_showview');
?>
