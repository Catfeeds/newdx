<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//���ڻ�ѩ���Ƿ��Ѿ�����
$sub = $_GET['sub'];
//��֤��ѩ���Ƿ��Ѿ�����
if($sub){	
	$sub =mb_convert_encoding($sub,'GBK', 'UTF-8');
	$sub =trim($sub);
	$sql = "select * from ".DB::table('dianping_skiing_info')." where subject='$sub'";
	$dm = DB::fetch_first($sql);
	if($dm){
		echo "repeat";exit;
	}else{
		echo "norepeat";exit;
	}	
}

