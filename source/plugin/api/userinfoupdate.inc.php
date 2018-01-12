<?php

/**
 * @author JiangHong
 * @copyright 2013
 * 清除帖子页面某个用户信息的缓存。ajax使用
 */

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
$tuid = intval($_G['gp_uid']);
include template('common/header_ajax');
if ($tuid > 0 && $_G['uid'] > 0){
    memory('rm' , 'user_info_viewthread_uid_'.$tuid.'_cache');
    // 新版页面提示 lxp 20140126
	if($_G['newtpl']){
		echo '<b>更新完成</b>';
	} else {
		echo '<b style="color:green;">更新完成，请刷新页面查看。</b>';
	}
}else{
	if($_G['newtpl']){
		echo '<b>请先登录</b>';
	} else {
		echo '<b style="color:red;">请登录完成此操作。</b>';
	}
}
include template('common/footer_ajax');
?>