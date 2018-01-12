<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

@session_start();
$prefix = 'plugin_whither_scapes_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
}

$search = array();
foreach (explode(' ', 'subject sn') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = " WHERE r.type = 1 ";
if ($search['subject']) {
	$where .= " AND s.name LIKE '%{$search['subject']}%'";
}
if ($search['sn']) {
	$where .= " AND r.sn LIKE '%{$search['sn']}%'";
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT count(*) FROM ".DB::table('mudidi_thread_ralation')." AS r
						  LEFT JOIN ".DB::table('mudidi_scape')." AS s ON r.sn = s.sn
						  $where");
$query = DB::query("SELECT s.*, r.tid, p.fid, p.tid, p.pid FROM ".DB::table('mudidi_thread_ralation')." AS r
				   LEFT JOIN ".DB::table('mudidi_scape')." AS s ON r.sn = s.sn
				   LEFT JOIN ".DB::table('forum_post')." AS p ON r.tid = p.tid AND p.first = 1
				   $where
				   LIMIT ".($page - 1)*$ppp.", $ppp");
?>
<form action="" method="POST">
	<table class="tb tb2">
		<tbody>
			<tr>
				<th class="partition">搜索</th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="search" value="1" />
					名称:
					<input type="text" name="subject" id="subject" size="15" value="<?php echo $search['subject']; ?>" />
					sn:
					<input type="text" name="sn" id="sn" size="15" value="<?php echo $search['sn']; ?>" />
					<input type="submit" value="搜索" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
showtableheader();
echo '<tr><td colspan="4"><a style="float:right;" href="/forum.php?mod=post&action=newthread&fid=433&type=scape" target="_blank">发布景点</a></td></tr>';
echo '<tr class="header"><th>名称</th><th>编号</th><th>攻略数</th><th>操作</th></tr>';
while ($value = DB::fetch($query)) {
	$guideNum = DB::result_first("SELECT COUNT(*) FROM ".DB::table('mudidi_guide')." WHERE sn LIKE '{$value['sn']}%'");
    echo '<tr><td><a href="/forum.php?mod=viewthread&tid='.$value['tid'].'" target="_blank">'.$value['name'].'</a></td>'.
         '<td>'.$value['sn'].'</td>'.
		 '<td>'.$guideNum.'</td>'.
         '<td>'.
		 '<a href="/forum.php?mod=post&action=edit&fid='.$value['fid'].'&tid='.$value['tid'].'&pid='.$value['pid'].'&page=1" target="_blank">编辑</a>'.
		 '&nbsp;&nbsp;<a href="plugin.php?id=whither:pubinfo&tid='.$value['tid'].'" target="_blank">发布新信息</a>'.
		 '</td></tr>';
}
showtablefooter();

echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_scape");
