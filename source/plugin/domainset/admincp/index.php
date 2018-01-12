<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = DB::query("SELECT * FROM ".DB::table('plugin_domainset').' where 1=1');
showtableheader();
echo '<tr><td colspan="4"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=newop">新建设置</a></td></tr>';
echo '<tr class="header"><th>请求地址</th><th>跳转地址</th><th>操作</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['reqaddress'].'</td>'.
         '<td>'.$value['resaddress'].'</td>'.
         '<td>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$value['id'].'">编辑</a>&nbsp;&nbsp;'.
		 '<a onclick="return confirm(\'您确认执行删除操作么？\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=delop&opid='.$value['id'].'">删除</a></td>';
}
showtablefooter();

