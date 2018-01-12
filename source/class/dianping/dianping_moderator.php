<?php
/**
 * 管理操作
 */

class moderator
{
	function __construct($pid)
	{
		global $_G;
		// 验证权限
		if(!$_G['uid']) { echo '-1'; exit; }	//需要登陆后才能操作
		if($_G['adminid'] != 1) { echo '-2'; exit; }	//非法操作
		if(intval($pid) <= 0) { echo '-3'; exit; }	//缺少参数


	}

	function stickreply()
}
?>
