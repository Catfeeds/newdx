<?php
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}
if($_G['gp_tid'] > 0){
    $method =  'getProduceInfo';
    $arg1 = $_G['gp_tid'];
    $arg2 = max($_G['gp_pic'] ,0);
}elseif($_G['gp_random'] > 0){
    $method = 'getAllproduceRandbyNum';
    $arg1 = $_G['gp_random'] > 0 ? $_G['gp_random'] : 6;
}
$return = array();
if(isset($method) && isset($arg1)){
    require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';
    $produce = new ForumOptionProduce;
    $return = call_user_method($method ,$produce ,$arg1 ,$arg2);
}
echo json_encode($return);
