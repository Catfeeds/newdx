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
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend&op=newop">����Ƽ�����</a></td></tr>';
echo '<tr class="header"><th>�Ƽ�����Id</th><th>�������</th><th>������</th><th>�Ƽ�����</th><th>���ʱ��</th><th>�Ƿ���ʾ</th><th>����</th></tr>';

while ($value = DB::fetch($query)) {
	$recommendArr=NULL;
	if ($value['recommendtype']==0) {
		$recommendArr = "װ������";
	}elseif ($value['recommendtype']==1) {
		$recommendArr = "�����Ƽ�";
	}	
	echo '<tr>';
    echo '<td>'.$value['uname'].'</td>'.
         '<td>'.$value['tids'].'</td>'.
		 '<td>'.$value['description'].'</td>'.
		 '<td>'.$recommendArr.'</td>'.
		 '<td>'.date('Y-m-d',$value['dateline']).'</td>'.
		 '<td>'.($value['isshow']?'<font color="red">��</font>':'��').'</td>'.		 
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend&op=editop&id='.$value['id'].'">�༭</a>&nbsp;&nbsp;<a onclick="return confirm(\'��ȷ��ɾ��?\');" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend&op=delop&id='.$value['id'].'">ɾ��</a>';
}

showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_commend");

