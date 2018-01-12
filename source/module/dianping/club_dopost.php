<?php
/**
 *	俱乐部主题操作管理
 *
 */

$do = in_array($_GET['do'], array('new', 'edit', 'deleteit', 'checkit')) ? $_GET['do'] : '';

if(!$_G['uid'] || $_G['adminid'] != 1 || !$do) { showmessage('非法操作，请返回'); }

$tid = intval($_GET['tid']);
$pid = intval($_GET['pid']);

require_once libfile('dianping/detail', 'class');
$detail_obj =  new detail($tid);

if($do == 'deleteit')
{
	$status = 1;//$detail_obj->deleteit();
	if($status)
	{
		showmessage('删除成功', "http://www.8264.com/dianping.php?mod={$mod}&act=showlist");
	}
}
elseif($do == 'checkit')
{
	if($_GET['type'] == 0 || $_GET['type'] == 1)
	{
		$status = $detail_obj->checkit($mod, $_GET['type']);
		if($status) echo 1;
		exit;
	}
}
?>
