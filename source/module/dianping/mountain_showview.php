<?php
/**
 *	ɽ������ҳ
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
	include template('dianping/mountain_comment');
	exit;
}

require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);
$detail = $detail_obj->getdetail('mountain', 'i.type, i.height, i.region, i.altitude, i.lon, i.lat, i.season');

if(empty($detail) || $detail['fid'] != $dp_modules['mountain']['fid'] || ($detail['ispublish'] == 0 && $_G['adminid'] != 1)) { showmessage('��Ҫ�鿴�����ݲ����ڻ�δ��ˣ��뷵��'); }

//SEO��Ϣ����
$pageTitle = $detail['subject'].' - ɽ�����Ͽ�'.($page>1 ? " - ��{$page}ҳ" : '')." - {$_G['setting']['bbname']}";
$metakeywords = $detail['subject'].' - ɽ�����Ͽ� - ����������';
$metadescription = $detail['subject'].'ɽ������Լ��û��ʵǾ����������������ɽ�����߸����ʵ�'.$detail['subject'];

$seccodecheck = ($_G['setting']['seccodestatus'] & 4) && (! $_G['setting']['seccodedata']['minposts'] || getuserprofile('posts') < $_G['setting']['seccodedata']['minposts']);
$secqaacheck = $_G['setting']['secqaa']['status'] & 2 && (! $_G['setting']['secqaa']['minposts'] || getuserprofile('posts') < $_G['setting']['secqaa']['minposts']);
//ͼƬ�ֲ�
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

//���µ����
$detail_obj->updateviews();

//�������·���
$hddata = gethddata('mountain', 51, 0, 7);

//��������
$cate_dq = $dp_category['mountain']['dq'];
//��������
//����
$_G['cache']['dp_mountain_sidebar_hot'] ? $sidebar_hot = $_G['cache']['dp_mountain_sidebar_hot'] : updatecache('dp_mountain_sidebar_hot');
//�ܱ�
require_once libfile('dianping/modlist', 'class');
$list_obj = new modlist();

if(!empty($detail['type']))
{
	$sidebar_type = $list_obj->getlist($mod, '', 'ispublish=1 and type='.$detail['type'], 0, 4, 'id desc');
}
/*
 * ����ip��ȡ��Ӧ����ĩ�
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
        $states = '���� ���� ���� ���� ���� �㶫 ���� ���� ���� �ӱ� ���� ���� ���� ������ ���� ���� ���� ���� ���ɹ� ���� �ຣ ɽ�� ɽ�� ���� �Ϻ� �Ĵ� ��� ���� �½� ���� �㽭';
        foreach (explode(' ', $states) as $state) {
                if (strpos($data, $state) !== false) {
                        return $state;
                }
        }
        return NULL;
}
$state = getStateByIp($ip);
$state = !$state ? '���' : $state;
	$arrZaiwaiarea = array(
	    '����' => "beijing",
	    '���' => "tianjin",
	    '����' => "chongqing",
	    '�Ϻ�' => "shanghai",
	    '�ӱ�' => "hebei",
	    '����' => "shanxi",
	    '����' => "liaoning",
	    '����' => "jilin",
	    '������' => "heilongjiang",
	    '����' => "jiangsu",
	    '�㽭' => "zhejiang",
	    '����' => "anhui",
	    '����' => "fujian",
	    '����' => "jiangxi",
	    'ɽ��' => "shandong",
	    '����' => "henan",
	    '����' => "hubei",
	    '����' => "hunan",
	    '�㶫' => "guangdong",
	    '����' => "hainan",
	    '�Ĵ�' => "sichuan",
	    '����' => "guizhou",
	    '����' => "yunnan",
	    'ɽ��' => "shan_xi",
	    '����' => "gansu",
	    '�ຣ' => "qinghai",
	    '���ɹ�' => "neimenggu",
	    '����' => "guangxi",
	    '����' => "xizang",
	    '����' => "ningxia",
	    '�½�' => "xinjiang"
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
//���ݿ��ȡ����
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
//��ûͼƬ����Ϣ
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
    //��ȡ������·�ӿڣ�չʾ��·���
    $result = requestRemoteData("http://m.zaiwai.com/index.php?app=api&act=getData&data_type=category&type_id=1&limit=0-{$limit}");
    $result_data = json_decode($result, true);
    foreach($result_data as $k=>$v){
       $title = diconv($v['title'], "utf-8", "gbk");
       $place = diconv($v['start_place'], "utf-8", "gbk");
       $result_data[$k]['subject'] = $title;
       //ȥ�����ϵ����˶���
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
//��ȡ����Ļ  hd.8264.com
$result = requestRemoteData("http://m.hd.8264.com/wap.php?app=api&act=getData&data_type=category&type_id=51&limit=0-6");
$result_data = json_decode($result, true);

foreach($result_data as $k=>$v){
       $title = diconv($v['title'], "utf-8", "gbk");
       $place = diconv($v['start_place'], "utf-8", "gbk");
       $result_data[$k]['subject'] = $title;
       //ȥ�����ϵ����˶���
       //$place = trim($place, ",");
       //$place = ltrim($place, ",");
       $result_data[$k]['place'] = $place;
       $result_data[$k]['url_zaiwai'] = $v['url_pc'];
    }
include template('dianping/mountain_showview');
?>
