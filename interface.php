<?php
/**
 *	接口请求处理
 */

if(isset($_POST['isajax']) && $_POST['isajax'] == 1){
    require './source/class/class_core.php';
    $discuz = & discuz_core::instance();
    $discuz->init();
    $cityName = $_POST['cityName'] ? $_POST['cityName'] : '';
    $sex = $_POST['sex'];
    $beginTime = $_POST['begin_Time'] ? $_POST['begin_Time'] : '';
    $list_result = array();
    $url = "{$_G['config']['zaiwaiapi']['url']}feedService/findInviteCustomerFeedListBySpecialConditions?sToken={$_G['config']['zaiwaiapi']['token']}&cityName=".urlencode($cityName)."&beginTime=".urlencode($beginTime)."&sex=".$sex;
    $res = (requestRemoteData($url,'GET'));
    header("Content-Type:text/html;charset=utf-8");
    $list = json_decode($res, true);
    $list_result[] = $list;
    if($list_result){
        echo json_encode($list_result[0]['customerFeedList'][0],true);
    }else{
        echo 'error';exit;
    }
}else{
    exit("error");
}

?>
