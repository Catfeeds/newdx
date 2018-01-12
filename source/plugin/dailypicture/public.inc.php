<?php

if (!empty($_POST)) {

	if($_POST['islog'] == 1) {
		//记录图片上传失败日志
		require_once DISCUZ_ROOT . "./source/plugin/logs/logs.class.php";
		$logs = new logs('dailypicture_upyun_fail');
		$reason = (array)json_decode(stripslashes($_G['gp_reason']));

		$reason['upyun_ip'] = $_G['gp_upyun_ip'];
		$reason['user_ip'] = $_G['gp_user_ip'];

		$reason['isp'] = iconv("UTF-8","GBK",$_G['gp_user_location']['isp']);
		$reason['b'] = iconv("UTF-8","GBK",$_G['gp_user_location']['province']);
		$reason['c'] = iconv("UTF-8","GBK",$_G['gp_user_location']['city']);

		$str = "uid: ".$_G['uid']." code:".$reason['code']." message:".$reason['message']."<br> user_ip:".$reason['user_ip']." upyun_ip:".$reason['upyun_ip']."<br> isp:".$reason['isp']."-".$reason['b']."-".$reason['c'];

		$logs->log_str($str);
	}

    require_once DISCUZ_ROOT.'/source/plugin/components/captcha/captcha.php';
    $url = $_SERVER['REQUEST_URI'];
    if (!$_POST['contact']) {
        showmessage('联系方式不能为空', $url);
    }
    
    if (!$_POST['picName']) {
        showmessage('作品名称不能为空', $url);
    }
    
    if (!$_POST['picDescription']) {
        showmessage('作品描述不能为空', $url);
    }
    
    $captcha = new Captcha(1);
    if (!$captcha->validate($_POST['captcha'])) {
        showmessage('验证码错误', $url);
    }
    $captcha->end();
    
    // 处理图片
//    $pic_num = count($_FILES['picUpload']['name']);
//
//    if(!empty($_FILES['picUpload'])){
//        if ($_FILES['picUpload']['size'] > 10000000) {
//            showmessage('图片大小过大, 请联系客服人员', $url);
//        }
//        if (!preg_match('/\.(jpe?g|gif|png|bmp)$/i', $_FILES['picUpload']['name'], $match)) {
//            showmessage('图片未上传或格式错误', $url);
//        }
//        require_once libfile('class/upload');
//        $upload = new discuz_upload();
//        $upload->init($_FILES['picUpload'],'plugin');
//        if($upload->error()) {
//    		showmessage('未知错误，请重试', $url);
//    	}
//    	$upload->save();
//    	if($upload->error()) {
//    		showmessage('上传失败请重试', $url);
//    	}
//        $serverid = (isset($upload->attach['serverid']) && $upload->attach['serverid'] > 0) ? $upload->attach['serverid'] : 0;
//        if($serverid==0){
//            require_once libfile('class/image');
//            $img = new image();
//            $img->Thumb($upload->attach['target'],'', 150, 150, 1);
//        }else{
//        	/*去掉缩略图，上传CDN后，使用CDN缩图方式显示，不再另缩图增加负担。*/
//            /*require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
//            $attachserver = new attachserver;
//            $domain = $attachserver->get_server_domain($serverid,'*');
//            $attachserver->Thumb($domain['domain'],$domain['api'],'plugin/'.$upload->attach['attachment'],'',150,150,1,0);
//            */
//        }
//        $addarr = array('uid' => $_POST['uid'],
//                        'username' => $_POST['username'],
//                        'contact' => $_POST['contact'],
//                        'alipayId' => $_POST['alipayId'],
//                        'createdAt' => time(),
//                        'picName' => $_POST['picName'],
//                        'picDescription' => $_POST['picDescription'],
//                        'picPath' => $upload->attach['attachment'],
//                        'serverid' => $serverid);
//        DB::insert('plugin_daily_picture_pics',$addarr);
//        showmessage('发布成功', getglobal('config/web/portal')."portal-list-catid-842.html");
//    }
    
	if ($_POST['filesize'] > 10000000) {
		showmessage('图片大小过大, 请联系客服人员', $url);
	}
	if (!preg_match('/\.(jpe?g|gif|png|bmp)$/i', $_POST['filename'], $match)) {
		showmessage('图片未上传或格式错误', $url);
	}

	$addarr = array('uid' => $_POST['uid'] ? $_POST['uid'] : 0,
			'username' => $_POST['username'],
			'contact' => $_POST['contact'],
			'alipayId' => $_POST['alipayId'],
			'createdAt' => time(),
			'picName' => $_POST['picName'],
			'picDescription' => $_POST['picDescription'],
			'picPath' => str_replace("/plugin/", "", $_POST['picPath']),
			'serverid' => 99);
	DB::insert('plugin_daily_picture_pics',$addarr);
	showmessage('发布成功', getglobal('config/web/portal')."portal-list-catid-842.html"); 
}

require_once libfile('class/upyun_form');
$upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);

$opts = array();
// 必选参数
$opts['save-key'] = '/plugin/{year}{mon}/{day}/{hour}{min}{sec}{random}{.suffix}';   // 保存路径
$opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';

$policy = $upyun->policyCreate($opts);
$sign = $upyun->signCreate($opts);
$action = $upyun->action();
$version = $upyun->version();

$pageTitle = '发布每日一图作品';
include template('dailypicture:public');