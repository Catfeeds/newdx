<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';


if(!empty($_GET['img'])){
    $pros = ForumOptionProduce::getProduceLxbytid($_GET['img']);	
}
/*
$path = DISCUZ_ROOT."./data/attachment/plugin/".$pros['cptp'];
if(file_exists($path)){
   $title= $pros['cpmc']."+װ����ƬͼƬ";
   $image=$pros['cptp'];
}else{
   echo "������·����";exit;		
}
*/
/**
 * �޸Ķ�ȡ��ʽ����ȡԶ�̵��ļ�
 */
if($pros['serverid']>0){
    require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
    $attachserver = new attachserver;
    $domain = $attachserver->get_server_domain($pros['serverid']);
    $path = "http://".$domain."/plugin/".$pros['cptp'];
    $root_path = $path;
}else{
    $path = "/data/attachment/plugin/".$pros['cptp'];
    $root_path = DISCUZ_ROOT.".".$path;
}
if($fp = fopen($root_path,'rb')){
    fclose($fp);
    $title = $pros['cpmc']."+װ����ƬͼƬ";
    $image=$path;
}else{
    echo $path."<br/>";
    echo "������·����";exit;
}
/*����*/
include template('produce:produce_pic');
?>