<?php

/**
 * @author JiangHong
 * 用于导出压缩包
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if($_G['groupid']==1){
    $downfile = DISCUZ_ROOT.'../tmpcss/css.zip';
    if(file_exists($downfile)){
        $file = fopen($downfile,"r"); // 打开文件
        // 输入文件标签
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($downfile));
        Header("Content-Disposition: attachment; filename=css.zip");
        // 输出文件内容
        echo fread($file,filesize($downfile));
        fclose($file);
        exit();
    }
}
?>