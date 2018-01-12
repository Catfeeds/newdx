<?php
/**
* @author JiangHong
*/
//将老版跳到新版//
header('HTTP/1.1 301 Moved Permanently');
header('Location: http://www.8264.com/pp/');
exit;
header("Content-type:text/html;charset=gbk");
if(isset($_GET['listid']) && !empty($_GET['listid'])){
	require_once "../config/config_global.php";
	$listid = $_GET['listid'];
	$r_res = new redis;
	$r_con = $r_res->pconnect($_config['memory']['redis'][6378]['server'],$_config['memory']['redis'][6378]['port']);
    $_config['memory']['redis'][6378]['pwd'] && $r_res->auth($_config['memory']['redis'][6378]['pwd']);
    $file = 'images_list/'.$listid.'.html';
    if(!$r_res->hExists('pp_html',$file)){
        $con = mysql_connect($_config['db']['1']['dbhost'],$_config['db']['1']['dbuser'],$_config['db']['1']['dbpw']);
        mysql_select_db($_config['db']['1']['dbname'],$con);
        $sql = "select html from pre_plugin_html_pp where filename = '{$file}'";
        $res = mysql_query($sql);
        $rs = mysql_fetch_assoc($res);
        $rs = $rs['html'];
        if(!empty($rs)){
            $r_res->hSet('pp_html',$file,$rs);
        }
    }
    $html = $r_res->hGet('pp_html',$file);
    if(isset($html) && !empty($html)){
        echo base64_decode($html);
	}else{
		//echo '不存在页面'.$groupid;
		header("location: http://www.8264.com");
	}
}else{
	//echo "未提交参数";
    header("location: http://www.8264.com/pp/");
}
?>
