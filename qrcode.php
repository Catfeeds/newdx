<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 12:26
 */
require './source/class/class_core.php';
//require './source/function/function_forum.php';
$discuz = & discuz_core::instance();
$discuz->init();
//require './source/module/misc/misc_swfupload.php';


    $url  = $_REQUEST['url'];
    include_once 'external/phpqrcode.php';
	if(intval($_REQUEST['output'])){
		$full_path = false;
	}else{
		//本地生成二维码
		$filename = 'qr'.date('YmdHis',time()+8*3600).md5(uniqid()).".png";
		$png_tmp_dir = "data/qr_temp";
		$full_path = $png_tmp_dir . '/' . $filename;
		$img_path = $filename;
		//如果临时目录不存在则创建
		if (!file_exists($png_tmp_dir)) {
			mkdir($png_tmp_dir);
		}
	}
	$level = "L";
	$size = intval($_REQUEST['size'])?intval($_REQUEST['size']):3;
	$margin = intval($_REQUEST['margin'])?intval($_REQUEST['margin']):1;
	
    QRcode::png($url, $full_path, $level, $size, $margin);
    //给二维码的本地生成留下足够的时间
    //sleep(2);

    //上传又拍云附件服务器
    $_FILES['myfile']=array(
        'name'=>$filename,
        'tmp_name'=>DISCUZ_ROOT.$full_path,
        'size'=>204800,

    );
        require_once "source/class/class_upload.php";
        $upload = new discuz_upload();
        $upload->init_wap($_FILES['myfile'], 'forum');
        $flag =$upload->save(0 ,false ,false ,false);
        if($flag){
            @unlink(DISCUZ_ROOT.$full_path);
            echo json_encode($upload->attach['attachment']);exit;
        }


        //$uploadreturn = $attachment->upYunUpload(DISCUZ_ROOT.$full_path,'forum',true,true,'images');

     /*   if($uploadreturn) {
            $result = $attachment->get_result();
            $this->attach['attachment'] = $result['path'];
            $this->attach['serverid'] = $result['serverid'];
            $this->attach['width'] = $result['width'];
            $this->attach['height'] = $result['height'];
            $this->attach['thumb'] = $result['thumb'];
            $this->errorcode = 0;

            return true;

        }*/
