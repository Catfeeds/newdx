<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';


@session_start();
$prefix = 'plugin_produce_zhuanti_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
}
$search = array();
foreach (explode(' ', 'username action orderBy orderType') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}
$where = ' WHERE 1=1';
if (!empty($search['username'])) {
	$where .= " AND o.username LIKE '%{$search['username']}%'";
}
if ($search['action'] != '') {
	$where .= " AND o.action='{$search['action']}'";
}



$orderBy = '';
if ($search['orderBy'] != '') {
	if ($search['orderBy'] == 1) {
		$orderBy .= " ORDER BY o.dateline";
	} elseif ($search['orderBy'] == 2) {
		$orderBy .= " ORDER BY o.score ";
	}
	if ($orderBy && $search['orderType'] != '') {
		$orderBy .= " {$search['orderType']}";
	}
} else {
	$orderBy .= " ORDER BY o.dateline DESC";
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_info')." where type = 2");
$query = DB::query("SELECT t.*,i.* FROM ".DB::table('plugin_produce_info')." as i left join ".DB::table('forum_thread')." as t on t.tid = i.tid  where type = 2 order by t.dateline desc
				   LIMIT ".($page - 1)*$ppp.", $ppp");
echo '<tr><td colspan="5"><a target="_blank" style="float:right;" href="'.$_G['config']['web']['forum'].'forum-post-action-newthread-fid-437-bq-2.html">新建专题</a></td></tr>';
?>


<form action="" method="post" id="guideForm">
<?php showtableheader(); ?>
<tr class="header">
	<th>用户名</th>
	<th>帖子</th>
	<th>发布时间</th>
	<th>操作</th>
</tr>
<style type="text/css">
	.zhen{color:blue;}
	.zhi{color:#0F0;}
	.jing{color:#F0F;}
	.undigest{color: #C00;}
	.unworth{color: #C00;}
	.unxiu{color: #C00;}
	.yishen{color: #00FF00;}
	.weishen{color: #FF0000;}
</style>

<?php while ($value = DB::fetch($query)):
$value['pid'] = DB::result_first("SELECT pid FROM ".DB::table('forum_post')." WHERE fid = 437 and first = 1 and tid = {$value['tid']}");
$value['counts'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_produce_relation')." WHERE parentId = {$value['tid']}");
?>
<tr>
	<td>
		<a href="<?php echo $_G['config']['web']['home']; ?>space-uid-<?php echo $value['authorid']; ?>.html" target="_blank"><?php echo $value['author']; ?></a>
	</td>
    <td><a href="<?php echo $_G['config']['web']['portal']; ?>zb-<?php echo $value['tid']; ?>" target="_blank"><?php echo $value['cpmc']; ?></a>(共<span style="color: red;"><?php echo $value['counts']; ?></span>个分享)</td>
	<td><?php echo date('Y-m-d H:i:s', $value['dateline']); ?></td>
	<td>
	<a href="<?php echo $_G['config']['web']['forum']; ?>forum.php?mod=post&action=edit&fid=437&tid=<?php echo $value['tid']; ?>&pid=<?php echo $value['pid']; ?>&page=1&bq=2" target="_blank">编辑</a>
	</td>
</tr>
<?php endwhile; ?>
<?php showtablefooter(); ?>

</form>

