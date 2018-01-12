<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

@session_start();
$prefix = 'plugin_whither_stat_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
}

$search = array();
foreach (explode(' ', 'type subject sn order') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = " WHERE 1=1 ";
if ($search['type']) {
	switch ($search['type']) {
		case 1:
			$where .= " AND s.sn REGEXP '^[[:digit:]]+-[[:digit:]]+$'";
			break;
		case 2:
			$where .= " AND s.sn REGEXP '^1-3-[[:digit:]]+$'";
			break;
		case 3:
			$where .= " AND s.sn REGEXP '^1-3-[[:digit:]]+-[[:digit:]]+$'";
			break;
		case 4:
			$where .= " AND s.sn REGEXP '^([[:digit:]]+-){4}[[:digit:]]+$'";
			break;
		default:
			break;
	}
}

if ($search['subject']) {
	$where .= " AND s.name LIKE '%{$search['subject']}%'";
}

if ($search['sn']) {
	$where .= " AND s.sn LIKE '%{$search['sn']}%'";
}

$order = " ORDER BY threadSubjectCount DESC, activitySubjectCount DESC, blogSubjectCount DESC";
if ($search['order']) {
	switch ($search['order']) {
		case 1:
			$order = " ORDER BY threadSubjectCount DESC";
			break;
		case 2:
			$order = " ORDER BY activitySubjectCount DESC";
			break;
		case 3:
			$order = " ORDER BY blogSubjectCount DESC";
			break;
		default:
			break;
	}
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT count(*) FROM ".DB::table('mudidi_stat')." AS s $where");
$query = DB::query("SELECT s.*, r.tid FROM ".DB::table('mudidi_stat')." AS s
				   LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = s.sn
				   $where
				   $order
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
					<select name="type" id="type">
						<option value="0">全部</option>
						<option value="1"<?php echo $search['type']==1?' selected="selected"':''; ?>>国</option>
						<option value="2"<?php echo $search['type']==2?' selected="selected"':''; ?>>省</option>
						<option value="3"<?php echo $search['type']==3?' selected="selected"':''; ?>>市</option>
						<option value="4"<?php echo $search['type']==4?' selected="selected"':''; ?>>景区</option>
					</select>
					名称:
					<input type="text" name="subject" id="subject" size="15" value="<?php echo $search['subject']; ?>" />
					sn:
					<input type="text" name="sn" id="sn" size="15" value="<?php echo $search['sn']; ?>" />
					排序:
					<select name="order" id="order">
						<option value="0">全部</option>
						<option value="1"<?php echo $search['order']==1?' selected="selected"':''; ?>>贴子标题</option>
						<option value="2"<?php echo $search['order']==2?' selected="selected"':''; ?>>活动标题</option>
						<option value="3"<?php echo $search['order']==3?' selected="selected"':''; ?>>博客标题</option>
					</select>
					<input type="submit" value="搜索" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
showtableheader();
echo '<tr class="header"><th>名称</th><th>sn</th><th>贴子标题</th><th>活动标题</th><th>博客标题</th></tr>';
while ($value = DB::fetch($query)) {
    echo '<td><a href="'.$_G['config']['web']['forum'].'thread-'.$value['tid'].'-1-1.html">'.$value['name'].'</a></td>'.
		 '<td>'.$value['sn'].'</td>'.
		 '<td>'.$value['threadSubjectCount'].'</td>'.
		 '<td>'.$value['activitySubjectCount'].'</td>'.
		 '<td>'.$value['blogSubjectCount'].'</td>'.
		 '</tr>';
}
showtablefooter();

echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_stat");
