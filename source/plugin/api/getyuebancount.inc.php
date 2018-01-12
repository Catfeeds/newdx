<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
	$count = 0;
	$m_count = memory('get','yuebancount');
	if($m_count>0){
		$count = $m_count;
	}else{
		$fp = fopen("http://yueban.com/yuebancount" , "r");
		if($fp){
			$content = fread($fp , 1024);
			fclose($fp);
			if(strpos($content , 'count')!==false){
				$yuebancountstr = json_decode($content , true);
				$count = intval($yuebancountstr['count']);
				if($count > 0) memory('set','yuebancount',$count,300);
			}
		}else{
			fclose($fp);
		}
	}
include template('common/header_ajax');
echo '&nbsp;('.$count.')';
include template('common/footer_ajax');
?>