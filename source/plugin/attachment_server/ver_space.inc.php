<?php

/**
 * @author jianghong
 * @todu 矫正服务器使用的附件空间大小
 */
global $_G;
if(isset($_POST['inajax']) && $_POST['inajax']==1 && $_G['uid']==1){
    if(isset($_POST['domain']) && !empty($_POST['domain']) && isset($_POST['api']) && !empty($_POST['api'])){
        $domain = $_POST['domain'];
        $api = $_POST['api'];
        require_once dirname(__FILE__)."/attachment_server.class.php";
        require_once libfile('class/myredis');
        $myredis = & myredis::instance();
        $attachserver = new attachserver;
        $result = $attachserver->post_method($domain,$api,'ver_space');
        $serverid = $attachserver->cal_serverid($_POST['serverid']);
        $myredis->hashdel("attachment_serverspace","space_".$serverid);
        $myredis->hashdel("attachment_serverspace_doing","space_".$serverid);
        if($result[1]=="ok"){
            $space = $attachserver->cal_type_value($result[2]);
            DB::update('plugin_attachment_server',$space,array('serverid'=>$serverid));
            echo $space['space_value']." <b class='blue'>".$attachserver->cal_space($space['space_type'])."</b>";
            $attachserver->clear_cache('allserver');
            $attachserver->clear_cache('bestserver');
        }else{
            echo "<b class='red'>失败</b>";
        }
    }
}


?>