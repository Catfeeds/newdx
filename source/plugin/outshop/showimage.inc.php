<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'/source/plugin/forumoption/shop.php';


if(!empty($_GET['img'])){
    $pros = ForumOptionShop::getsPicbytid($_GET['img']);	
}
if($pros['serverid']==0){
    $path = DISCUZ_ROOT."./data/attachment/plugin/".$pros['sPic'];
    $image = "/data/attachment/plugin/".$pros['sPic'];
}else{
    require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
    $attachserver = new attachserver;
    $allserver = $attachserver->get_server_domain($pros['serverid']);
    $path = "http://".$allserver."/plugin/".$pros['sPic'];
    $image = $path;
}

$title= $pros['sName']."+µêÆÌÕÕÆ¬Í¼Æ¬";

include template('outshop:shop_pic');
//function is_exists($file,$num){
//    if(file_exists($file)){
//        return true;
//    }else{
//        $fp = @fopen($file,'rb');
//        $str = '';
//        $len = 0;
//        if($fp){
//            $str = @fread($fp,256);
//            @fclose($fp);
//            if(($len = strlen($str))>=$num) return true;
//        }
//        //echo "³¤¶È".$len;
//        return false;
//    }
//}
?>