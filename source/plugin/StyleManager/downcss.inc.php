<?php

/**
 * @author JiangHong
 * ���ڵ���ѹ����
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if($_G['groupid']==1){
    $downfile = DISCUZ_ROOT.'../tmpcss/css.zip';
    if(file_exists($downfile)){
        $file = fopen($downfile,"r"); // ���ļ�
        // �����ļ���ǩ
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($downfile));
        Header("Content-Disposition: attachment; filename=css.zip");
        // ����ļ�����
        echo fread($file,filesize($downfile));
        fclose($file);
        exit();
    }
}
?>