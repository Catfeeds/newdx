<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$query = DB::query("SELECT o.id, o.name, o.fid, o.typeid, t.name as typeName, f.name as forumName FROM ".DB::table('plugin_forumoption').' as o
				   LEFT JOIN '.DB::table('forum_threadtype').' as t
				   ON o.typeid != 0 AND o.typeid = t.typeid
				   LEFT JOIN '.DB::table('forum_forum').' as f
				   ON o.fid != 0 AND o.fid = f.fid
				   ');
showtableheader();
echo '<tr><td colspan="4"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=newop">新建设置</a></td></tr>';
echo '<tr class="header"><th>名称</th><th>所属模块</th><th>所属分类信息</th><th>操作</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['name'].'</td>'.
         '<td>'.($value['forumName']?$value['forumName']:'无').'</td>'.
         '<td>'.($value['typeName']?$value['typeName']:'无').'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=option&opid='.$value['id'].'">设置</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=editop&opid='.$value['id'].'">编辑</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=forumoption&pmod=admincp&op=delop&opid='.$value['id'].'">删除</a></td>';
}
showtablefooter();

