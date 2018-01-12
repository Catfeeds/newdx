<?php

if (!empty($_POST)) {

	if($_POST['islog'] == 1) {
		//��¼ͼƬ�ϴ�ʧ����־
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
        showmessage('��ϵ��ʽ����Ϊ��', $url);
    }
    
    if (!$_POST['picName']) {
        showmessage('��Ʒ���Ʋ���Ϊ��', $url);
    }
    
    if (!$_POST['picDescription']) {
        showmessage('��Ʒ��������Ϊ��', $url);
    }
    
    $captcha = new Captcha(1);
    if (!$captcha->validate($_POST['captcha'])) {
        showmessage('��֤�����', $url);
    }
    $captcha->end();
    
    // ����ͼƬ
//    $pic_num = count($_FILES['picUpload']['name']);
//
//    if(!empty($_FILES['picUpload'])){
//        if ($_FILES['picUpload']['size'] > 10000000) {
//            showmessage('ͼƬ��С����, ����ϵ�ͷ���Ա', $url);
//        }
//        if (!preg_match('/\.(jpe?g|gif|png|bmp)$/i', $_FILES['picUpload']['name'], $match)) {
//            showmessage('ͼƬδ�ϴ����ʽ����', $url);
//        }
//        require_once libfile('class/upload');
//        $upload = new discuz_upload();
//        $upload->init($_FILES['picUpload'],'plugin');
//        if($upload->error()) {
//    		showmessage('δ֪����������', $url);
//    	}
//    	$upload->save();
//    	if($upload->error()) {
//    		showmessage('�ϴ�ʧ��������', $url);
//    	}
//        $serverid = (isset($upload->attach['serverid']) && $upload->attach['serverid'] > 0) ? $upload->attach['serverid'] : 0;
//        if($serverid==0){
//            require_once libfile('class/image');
//            $img = new image();
//            $img->Thumb($upload->attach['target'],'', 150, 150, 1);
//        }else{
//        	/*ȥ������ͼ���ϴ�CDN��ʹ��CDN��ͼ��ʽ��ʾ����������ͼ���Ӹ�����*/
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
//        showmessage('�����ɹ�', getglobal('config/web/portal')."portal-list-catid-842.html");
//    }
    
	if ($_POST['filesize'] > 10000000) {
		showmessage('ͼƬ��С����, ����ϵ�ͷ���Ա', $url);
	}
	if (!preg_match('/\.(jpe?g|gif|png|bmp)$/i', $_POST['filename'], $match)) {
		showmessage('ͼƬδ�ϴ����ʽ����', $url);
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
	showmessage('�����ɹ�', getglobal('config/web/portal')."portal-list-catid-842.html"); 
}

require_once libfile('class/upyun_form');
$upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);

$opts = array();
// ��ѡ����
$opts['save-key'] = '/plugin/{year}{mon}/{day}/{hour}{min}{sec}{random}{.suffix}';   // ����·��
$opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';

$policy = $upyun->policyCreate($opts);
$sign = $upyun->signCreate($opts);
$action = $upyun->action();
$version = $upyun->version();

$pageTitle = '����ÿ��һͼ��Ʒ';
include template('dailypicture:public');