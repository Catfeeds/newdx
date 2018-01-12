<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if ($_GET['op'] && file_exists($filepath=dirname(__file__).'/admincp_album_'.$_GET['op'].'.inc.php')) {
    include $filepath;
    exit;
}

$time = time();
if (!empty($_POST['operateNum'])) {
	$url = $_SERVER['QUERY_STRING'];
	if (count($_POST['album']) == 0) {
		cpmsg('请至少选择一条信息', $url, 'error');
	}
	$albumids = implode(',', array_keys($_POST['album']));

	switch ($_POST['operateNum']) {
		case '1':
			DB::query("UPDATE ".DB::table('mudidi_album')." SET state = 1, verifytime = {$time} WHERE id in ({$albumids})");
			cpmsg('操作成功', $url, 'succeed');
			break;
		case '2':
			DB::query("UPDATE ".DB::table('mudidi_album')." SET state = 0, verifytime = {$time} WHERE id in ({$albumids})");
			cpmsg('操作成功', $url, 'succeed');
			break;
		case '3':
			DB::query("DELETE FROM ".DB::table('mudidi_album')." WHERE id in ({$albumids})");
			cpmsg('删除成功', $url, 'succeed');
			break;
	}
}

if (isset($_GET['albumid']) && $_GET['del'] == 1) {
	DB::query("DELETE FROM ".DB::table('mudidi_album')." WHERE id = {$_GET['albumid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?albumid=\d+/', '', $url);
	$url = preg_replace('/&?del=\d+/', '', $url);
	cpmsg('删除成功', $url, 'succeed');
}

if (isset($_GET['albumid']) && isset($_GET['state'])) {
	DB::query("UPDATE ".DB::table('mudidi_album')." SET state = {$_GET['state']}, verifytime = {$time} WHERE id = {$_GET['albumid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?albumid=\d+/', '', $url);
	$url = preg_replace('/&?state=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';
$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = 0;

@session_start();
$prefix = 'plugin_whither_album_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
}

$search = array();
foreach (explode(' ', 'filter albumid subject albumname') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = 'WHERE 1=1 ';
if (!empty($search['filter'])) {
	if ($search['filter'] == 1) {
		$where .= ' AND a.state = 1';
	} elseif ($search['filter'] == 2) {
		$where .= ' AND a.state = 0';
	}
}

if (!empty($search['albumid'])) {
	$where .= " AND a.albumid = {$search['albumid']}";
}

if (!empty($search['subject'])) {
	$where .= " AND t.subject LIKE '%{$search['subject']}%'";
}

if (!empty($search['albumname'])) {
	$where .= " AND ha.albumname LIKE '%{$search['albumname']}%'";
}


$sql = "SELECT a.*, ha.albumname, ha.uid AS authorid, t.subject, t.tid FROM ".DB::table('mudidi_album')." AS a
		LEFT JOIN ".DB::table('home_album')." AS ha ON ha.albumid = a.albumid
		LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = a.sn
		LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
		$where";
$count = DB::result_first(preg_replace('/SELECT(.*?)FROM/i', 'SELECT COUNT(*) FROM', $sql));
$albumData = array();
$query = DB::query($sql);
while ($value = DB::fetch($query)) {
	$albumData[] = $value;
}
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
					<select name="filter" id="filter">
						<option value="0">全部</option>
						<option value="1"<?php echo $search['filter']==1?' selected="selected"':''; ?>>己审核</option>
						<option value="2"<?php echo $search['filter']==2?' selected="selected"':''; ?>>未审核</option>
					</select>
					相册id:
					<input type="text" name="albumid" id="albumid" size="6" value="<?php echo $search['albumid']; ?>" />
					所属景区:
					<input type="text" name="subject" id="subject" size="6" value="<?php echo $search['subject']; ?>" />
					标题:
					<input type="text" name="albumname" id="albumname" size="15" value="<?php echo $search['albumname']; ?>" />
					<input type="submit" value="搜索" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
echo '<form action="" method="post" id="albumForm">';
showtableheader();
echo '<tr class="header"><th>名称</th><th>所属</th><th>状态</th><th>排序</th><th>操作</th></tr>';
foreach ($albumData as $value) {
    echo '<tr><td><input type="checkbox" name="album['.$value['id'].']" class="albumCheckbox" /><a href="'.$_G['config']['web']['home'].'home-space-uid-'.$value['authorid'].'-do-album-id-'.$value['albumid'].'.html" target="_blank">'.$value['albumname'].'</a></td>'.
		 '<td><a href="'.$_G['config']['web']['forum'].'thread-'.$value['tid'].'-1-1.html" target="_blank">'.$value['subject'].'</a></td>'.
         '<td>'.($value['state']==0?'<span style="color:#f00;">未审核</span>':'<span style="color:#107300;">己审核</span>').'</td>'.
		 '<td>'.$value['ordernum'].'</td>'.
         '<td>'.
		 '<a href="'.$_SERVER['REQUEST_URI'].'&albumid='.$value['id'].'&state='.($value['state']==0?1:0).'">'.($value['state']==0?"审核通过":"审核不通过").'</a>'.
		 '&nbsp;&nbsp;<a href="/'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_album&op=edit&albumid='.$value['id'].'">编辑</a>'.
		 '&nbsp;&nbsp;<a href="'.$_SERVER['REQUEST_URI'].'&albumid='.$value['id'].'&del=1" onclick="return confirmOperate();">删除</a>'.
		 '</td></tr>';
}
showtablefooter();
?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:left;">
		<input type="hidden" name="operateNum" value="0" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />
			全选/全不选
		</label>
		&nbsp;&nbsp;
		<a href="#" id="passOperate">审核通过</a> |
		<a href="#" id="unpassOperate">审核不通过</a> |
		<a href="#" id="delOperate">删除</a>
	</div>
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_album");?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	function submitForm(num) {
		if ($('#albumForm .albumCheckbox:checked').size() == 0) {
			return false;
		}
		$('#albumForm input[name="operateNum"]').val(num);
		$('#albumForm').submit();
	}
    $('#delOperate').click(function(){
        if (!confirmOperate()) {
            return false;
        }
		submitForm(3);
	});
	$('#passOperate').click(function(){
		submitForm(1);
	});
	$('#unpassOperate').click(function(){
		submitForm(2);
	});

	$('#selectAll').click(function(){
		if ($(this)[0].checked) {
			$('#albumForm .albumCheckbox').attr('checked', true);
		} else {
			$('#albumForm .albumCheckbox').attr('checked', false);
		}
	});
})(jQuery);
function confirmOperate() {
    return confirm("您确定要执行此操作吗");
}
</script>
