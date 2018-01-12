<?php

/**
 * @author shuaiquan
 * ͼƬ��¥
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$param['wechatshare']   = "{$_G['config']['web']['mobile']}thread-{$_G['gp_tid']}-1.html?hasfid={$_G['gp_fid']}";
$url_forward = "{$_G['config']['web']['forum']}forum.php?mod=viewthread&tid={$_G['gp_tid']}&extra=";

$cookieKey = "fenlou_erweima_{$_G['uid']}";
dsetcookie($cookieKey, '1', -1);

include template('picupload:erweima');

?>