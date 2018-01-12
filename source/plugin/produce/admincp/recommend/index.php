<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));

require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';

$count= DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_recommend')." where 1");
$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_recommend').' where 1 order by dateline desc LIMIT '.($page - 1)*$ppp.",$ppp");

showtableheader();
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend&op=newop">添加推荐人物</a></td></tr>';
echo '<tr class="header"><th>推荐人物Id</th><th>相关帖子</th><th>人物简介</th><th>推荐类型</th><th>添加时间</th><th>是否显示</th><th>操作</th></tr>';

while ($value = DB::fetch($query)) {
	$recommendArr=NULL;
	if ($value['recommendtype']==0) {
		$recommendArr = "装备达人";
	}elseif ($value['recommendtype']==1) {
		$recommendArr = "新人推荐";
	}	
	echo '<tr>';
    echo '<td>'.$value['uname'].'</td>'.
         '<td>'.$value['tids'].'</td>'.
		 '<td>'.$value['description'].'</td>'.
		 '<td>'.$recommendArr.'</td>'.
		 '<td>'.date('Y-m-d',$value['dateline']).'</td>'.
		 '<td>'.($value['isshow']?'<font color="red">是</font>':'否').'</td>'.		 
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend&op=editop&id='.$value['id'].'">编辑</a>&nbsp;&nbsp;<a onclick="return confirm(\'您确定删除?\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend&op=delop&id='.$value['id'].'">删除</a>';
}

showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_commend");

