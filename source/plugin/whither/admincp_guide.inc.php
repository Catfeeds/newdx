<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if ($_GET['op'] && file_exists($filepath=dirname(__file__).'/admincp_guide_'.$_GET['op'].'.inc.php')) {
    include $filepath;
    exit;
}

$time = time();
if (!empty($_POST['operateNum'])) {
	$url = $_SERVER['QUERY_STRING'];
	if (count($_POST['guide']) == 0) {
		cpmsg('请至少选择一条信息', $url, 'error');
	}
	$gids = implode(',', array_keys($_POST['guide']));

	switch ($_POST['operateNum']) {
		case '1':
			DB::query("UPDATE ".DB::table('mudidi_guide')." SET state = 1, verifytime = {$time} WHERE id in ({$gids})");
			cpmsg('操作成功', $url, 'succeed');
			break;
		case '2':
			DB::query("UPDATE ".DB::table('mudidi_guide')." SET state = 0, verifytime = {$time} WHERE id in ({$gids})");
			cpmsg('操作成功', $url, 'succeed');
			break;
		case '3':
			DB::query("DELETE FROM ".DB::table('mudidi_guide')." WHERE id in ({$gids})");
			cpmsg('删除成功', $url, 'succeed');
			break;
	}
}

if (isset($_GET['gid']) && $_GET['del'] == 1) {
	DB::query("DELETE FROM ".DB::table('mudidi_guide')." WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?del=\d+/', '', $url);
	cpmsg('删除成功', $url, 'succeed');
}

if (isset($_GET['gid']) && isset($_GET['state'])) {
	DB::query("UPDATE ".DB::table('mudidi_guide')." SET state = {$_GET['state']}, verifytime = {$time} WHERE id = {$_GET['gid']}");
	$url = $_SERVER['QUERY_STRING'];
	$url = preg_replace('/&?gid=\d+/', '', $url);
	$url = preg_replace('/&?state=\d+/', '', $url);
	cpmsg('操作成功', $url, 'succeed');
}

require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';
$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = 0;

@session_start();
$prefix = 'plugin_whither_guide_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
}

$search = array();
foreach (explode(' ', 'filter type typeid subject fname') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = 'WHERE 1=1 ';
if (!empty($search['filter'])) {
	if ($search['filter'] == 1) {
		$where .= ' AND g.state = 1';
	} elseif ($search['filter'] == 2) {
		$where .= ' AND g.state = 0';
	}
}

if (!empty($search['typeid'])) {
	$where .= " AND g.typeid like '%".$search['typeid']."%'";
}

if (!empty($search['subject'])) {
	$where .= " AND p.subject like '%".$search['subject']."%'";
}

if (!empty($search['fname'])) {
	$where .= " AND t.subject like '%".$search['fname']."%'";
}


if (empty($search['type']) || in_array($search['type'], array(0,1))) {
	$sqlArr[] = "SELECT tu.authorid AS ouid, p.subject, p.message, p.pid, g.*, t.tid AS ftid, t.subject AS fsubject FROM ".DB::table('forum_post')." AS p
LEFT JOIN ".DB::table('forum_thread')." AS tu ON tu.tid = p.tid
INNER JOIN ".DB::table('mudidi_guide')." AS g ON p.tid = g.typeid AND p.first = 1 AND g.type = 1
LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = g.sn
LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
$where";
}
if (empty($search['type']) || in_array($search['type'], array(0,2))) {
	$sqlArr[] = "SELECT p.uid AS ouid, p.subject, f.message, NULL AS pid, g.*, t.tid AS ftid, t.subject AS fsubject FROM ".DB::table('home_blog')." AS p
INNER JOIN ".DB::table('mudidi_guide')." AS g ON p.blogid = g.typeid AND g.type = 2
LEFT JOIN ".DB::table('home_blogfield')." AS f ON p.blogid = f.blogid
LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.sn = g.sn
LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid = r.tid
$where";
}


if (count($sqlArr) == 2) {
	$sql = "(".$sqlArr[0].")UNION ALL(".$sqlArr[1].")ORDER BY id DESC LIMIT ".(($page - 1) * $ppp).", $ppp";
	$count = DB::result_first(preg_replace('/SELECT(.*?)FROM/i', 'SELECT COUNT(*) FROM', $sqlArr[0]));
	$count += DB::result_first(preg_replace('/SELECT(.*?)FROM/i', 'SELECT COUNT(*) FROM', $sqlArr[1]));
} else {
	$sql = "(".$sqlArr[0].")ORDER BY id DESC LIMIT ".(($page - 1) * $ppp).", $ppp";
	$count = DB::result_first(preg_replace('/SELECT(.*?)FROM/i', 'SELECT COUNT(*) FROM', $sqlArr[0]));
}

$guideData = array();
$query = DB::query($sql);
while ($value = DB::fetch($query)) {
	require_once DISCUZ_ROOT."/source/function/function_discuzcode.php";
	$value['message'] = preg_replace('/^\[i=s].*?\[\/i]/i', '', $value['message'], 1);
	if (!$value['coverPic']) {
		if ($value['pid']) {
			$value['message'] = discuzcode($value['message']);
			require_once DISCUZ_ROOT.'./source/function/function_post.php';
			$attachs = getattach($value['pid']);
			foreach ($attachs['imgattachs']['used'] as $i => $item) {
				if (in_array($item['ext'], array('jpg', 'jpeg', 'bmp', 'gif', 'png'))) {
					$value['coverPic'] = $item['url']."/".$item['attachment'];
					break;
				}
			}
		}
		if (!$value['coverPic'] && preg_match('/<img[^>]+?src="([^"]+)"/i', $value['message'], $m)) {
			$value['coverPic'] = $m[1];
		}
	} elseif ($value['coverPic'] == '#') {
		$value['coverPic'] = '';
	}

	$guideData[] = $value;
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
					<select name="type" id="type">
						<option value="0">全部</option>
						<option value="1"<?php echo $search['type']==1?' selected="selected"':''; ?>>贴子</option>
						<option value="2"<?php echo $search['type']==2?' selected="selected"':''; ?>>日志</option>
					</select>
					关联id:
					<input type="text" name="typeid" id="typeid" size="6" value="<?php echo $search['typeid']; ?>" />
					所属景区:
					<input type="text" name="fname" id="fname" size="6" value="<?php echo $search['fname']; ?>" />
					标题:
					<input type="text" name="subject" id="subject" size="15" value="<?php echo $search['subject']; ?>" />
					<input type="submit" value="搜索" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
echo '<form action="" method="post" id="guideForm">';
showtableheader();
echo '<tr class="header"><th>名称</th><th>类别</th><th>所属</th><th>状态</th><th>操作</th></tr>';
foreach ($guideData as $value) {
	$link = "/";
	if ($value['type'] == 1)
		$link = "/thread-".$value['typeid']."-1-1.html";
	elseif ($value['type'] == 2)
		$link = $_G['config']['web']['home']."home-space-uid-".$value['ouid']."-do-blog-id-".$value['typeid'].".html";

    echo '<tr><td><input type="checkbox" name="guide['.$value['id'].']" class="guideCheckbox" />'.
			($value['coverPic']?'<img src="'.$value['coverPic'].'" width="120" style="vertical-align:middle;margin:0 5px;" />':'').
			'<a href="'.$link.'" target="_blank">'.$value['subject'].'</a></td>'.
         '<td>'.($value['type']==1?"贴子":"日志").'</td>'.
		 '<td><a href="/forum.php?mod=viewthread&tid='.$value['ftid'].'" target="_blank">'.$value['fsubject'].'</a></td>'.
         '<td>'.($value['state']==0?'<span style="color:#f00;">未审核</span>':'<span style="color:#107300;">己审核</span>').'</td>'.
         '<td>'.
		 '<a href="'.$_SERVER['REQUEST_URI'].'&gid='.$value['id'].'&state='.($value['state']==0?1:0).'">'.($value['state']==0?"审核通过":"审核不通过").'</a>'.
         '&nbsp;&nbsp;<a href="/'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_guide&op=edit&gid='.$value['id'].'">编辑</a>'.
		 '&nbsp;&nbsp;<a href="'.$_SERVER['REQUEST_URI'].'&gid='.$value['id'].'&del=1" onclick="return confirmOperate();">删除</a>'.
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
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_guide");?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	function submitForm(num) {
		if ($('#guideForm .guideCheckbox:checked').size() == 0) {
			return false;
		}
		$('#guideForm input[name="operateNum"]').val(num);
		$('#guideForm').submit();
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
			$('#guideForm .guideCheckbox').attr('checked', true);
		} else {
			$('#guideForm .guideCheckbox').attr('checked', false);
		}
	});
})(jQuery);
function confirmOperate() {
    return confirm("您确定要执行此操作吗");
}
</script>
