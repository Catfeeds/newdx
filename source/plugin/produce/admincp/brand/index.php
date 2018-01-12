<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));

$count = ForumOptionProduce::getBrandCount();
$array = ForumOptionProduce::getBrandData(($page-1)*$ppp.",$ppp");

showtableheader();
echo '<tr class="header"><th>品牌名称</th><th>显示地区</th><th>操作</th></tr>';

foreach ($array as $value) {
	$recommendArr = array();
	if ($value['recommend1']) {
		$recommendArr[] = "品牌区";
	}
	if ($value['recommend2']) {
		$recommendArr[] = "推荐区";
	}
	if ($value['recommend3']) {
		$recommendArr[] = "菜单区";
	}
	
	$recommendString = implode(', ', $recommendArr);
	if (!$recommendString) {
		$recommendString = '暂无推荐';
	}
	
	echo '<tr>';
    echo '<td>'.$value['subject'].'</td>'.
         '<td>'.$recommendString.'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_brand&op=editop&tid='.$value['tid'].'">编辑</a>';
}

showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_brand");

