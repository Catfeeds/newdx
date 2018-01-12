<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT count(*) FROM ".DB::table('mudidi_info'));

$array = $snArr = $ralate = array();

$query = DB::query("SELECT * FROM ".DB::table('mudidi_info')."
				    ORDER BY id ASC
					LIMIT ".($page - 1)*$ppp.", $ppp");
while ($value = DB::fetch($query)) {
	$snArr[$value['sn']] = $value['sn'];
	$array[] = $value;
}

$query = DB::query("SELECT r.tid, t.subject, r.sn FROM ".DB::table('mudidi_thread_ralation')." AS r
				    LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
				    WHERE r.sn IN ('".implode("','", $snArr)."')");
while ($value = DB::fetch($query)) {
	$ralate[$value['sn']] = $value;
}

foreach ($array as $i => $item) {
	foreach ($ralate as $j => $jItem) {
		if ($array[$i]['sn'] == $j) {
			$array[$i]['tid'] = $ralate[$j]['tid'];
			$array[$i]['subject'] = $ralate[$j]['subject'];
			break;
		}
	}
}

showtableheader();
echo '<tr class="header"><th width="10%">名称</th><th width="10%">所属</th><th width="70%">内容</th><th width="10%">操作</th></tr>';
foreach ($array as $i => $value) {
    echo '<tr><td>'.$value['name'].'</td>'.
         '<td>'.$value['subject'].'</td>'.
		 '<td>'.$value['message'].'</td>'.
         '<td>'.
		 '<a href="/plugin.php?id=whither:pubinfo&tid='.$value['tid'].'&infoid='.$value['id'].'" target="_blank">编辑</a>'.
		 '</td></tr>';
}
showtablefooter();

echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_info");
