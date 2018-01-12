<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));

$count = ForumOptionProduce::getBrandCount();
$array = ForumOptionProduce::getBrandData(($page-1)*$ppp.",$ppp");

showtableheader();
echo '<tr class="header"><th>Ʒ������</th><th>��ʾ����</th><th>����</th></tr>';

foreach ($array as $value) {
	$recommendArr = array();
	if ($value['recommend1']) {
		$recommendArr[] = "Ʒ����";
	}
	if ($value['recommend2']) {
		$recommendArr[] = "�Ƽ���";
	}
	if ($value['recommend3']) {
		$recommendArr[] = "�˵���";
	}
	
	$recommendString = implode(', ', $recommendArr);
	if (!$recommendString) {
		$recommendString = '�����Ƽ�';
	}
	
	echo '<tr>';
    echo '<td>'.$value['subject'].'</td>'.
         '<td>'.$recommendString.'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_brand&op=editop&tid='.$value['tid'].'">�༭</a>';
}

showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_brand");

