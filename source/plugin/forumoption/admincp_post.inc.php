<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if ($_GET['op'] == 'del') {
	include_once libfile('function/delete');
	if (deletepost("pid='{$_GET['pid']}'")) {
		echo json_encode(array('error_code' => 0));
	} else {
		echo json_encode(array('error_code' => 1));
	}
	exit;
}

@session_start();
$prefix = 'plugin_forumoption_post_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
	if (empty($_POST['group'])) {
		unset($_SESSION[$prefix.'group']);
	}
}


$search = array();
foreach (explode(' ', 'fid tid author group') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = ' WHERE 1=1';
if ($search['fid']) {
	$where .= " AND p.fid = '{$search['fid']}'";
}
if ($search['tid']) {
	$where .= " AND p.tid = '{$search['tid']}'";
}
if ($search['author']) {
	$authorid = DB::result_first('SELECT uid FROM '.DB::table('common_member')." WHERE username = '{$search['author']}'");
	if ($authorid) {
		$where .= " AND p.authorid='$authorid'";
	} else {
		$where = ' WHERE 1 = 0';
	}
}
if ($search['group']) {
	$groupid = implode(',', $search['group']);
	if ($groupid) {
		$query = DB::query("SELECT uid FROM ".DB::table('common_member')." WHERE groupid IN ($groupid)");
		$uids = array();
		while ($value = DB::fetch($query)) {
			$uids[] = $value['uid'];
		}
		if ($uids) {
			$where .= " AND p.authorid IN (".implode(", ",$uids).")";
		} else {
			$where = ' WHERE 1 = 0';
		}
	} else {
		$where = ' WHERE 1 = 0';
	}
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_post')." p".$where);

$posts = array();
$query = DB::query("select p.* FROM ".DB::table('forum_post')." p$where".
				   " ORDER BY p.dateline DESC LIMIT ".($page - 1)*$ppp.",$ppp");
while ($value = DB::fetch($query)) {
	$value['subject'] = DB::result_first('SELECT subject FROM '.DB::table('forum_post')." WHERE tid = {$value['tid']} AND first = 1");
	$value['dateline'] = date('Y-m-d H:i:s', $value['dateline']);
	$posts[] = $value;
}

$groups = array();
$query = DB::query("SELECT groupid AS id, grouptitle AS title FROM ".DB::table('common_usergroup'));
while ($value = DB::fetch($query)) {
	$groups[] = $value;
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
					板块fid:
					<input type="text" name="fid" id="fid" size="6" value="<?php echo $search['fid']; ?>" />
					贴子tid:
					<input type="text" name="tid" id="tid" size="6" value="<?php echo $search['tid']; ?>" />
					作者:
					<input type="text" name="author" id="author" size="10" value="<?php echo $search['author']; ?>" />
					(<a href="#" id="group_list_open">选择用户组</a> <span id="group_selected"></span>)
					<input type="submit" value="搜索" class="btn" />
				</td>
			</tr>
			<tr style="display: none;" id="group_list">
				<td>
					<div style="overflow: hidden;">
						<a href="#" style="float:right;" id="group_list_close">收起</a>
						<h6>选择用户组:</h6>
					</div>
					<div style="overflow: hidden;">
						<?php foreach ($groups as $group): ?>
						<label for="group_<?php echo $group['id']; ?>" style="float:left; margin: 0 5px 5px 0;">
							<input type="checkbox" name="group[]" value="<?php echo $group['id']; ?>" id="group_<?php echo $group['id']; ?>" text-data="<?php echo $group['title']; ?>"<?php if (in_array($group['id'], $search['group'])): ?> checked="checked"<?php endif; ?> />
							<?php echo $group['title']; ?>
						</label>
						<?php endforeach; ?>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<form action="" method="post" id="postForm">
	<?php showtableheader(); ?>
	<tr class="header">
		<th>评论</th>
		<th>所属贴子</th>
		<th>发布人</th>
		<th>发布时间</th>
		<th>操作</th>
	</tr>

	<?php foreach ($posts as $post): ?>
	<tr>
		<td width="40%"><?php echo $post['message']; ?></td>
		<td><a href="<?php echo $_G['config']['web']['forum']; ?>thread-<?php echo $post['tid']; ?>-1-1.html" target="_blank"><?php echo $post['subject']; ?></a></td>
		<td><?php echo $post['author']; ?></td>
		<td><?php echo $post['dateline']; ?></td>
		<td>
			<a href="/plugin.php?id=forumoption:admincp_post&op=del&pid=<?php echo $post['pid'];?>" class="del" style="white-space:nowrap;">删除</a>
		</td>
	</tr>
	<?php endforeach; ?>

	<?php showtablefooter(); ?>
	<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
		<div style="float:right;">
			<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=forumoption&pmod=admincp_post");?>
		</div>
	</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	$('#group_list_open').bind('click', function() {
		$('#group_list').toggle();
		return false;
	});
	$('#group_list_close').bind('click', function() {
		$('#group_list').hide();
		return false;
	});

	$('#group_list input').live('click', render_group);
	render_group();

	function render_group() {
		var text = '';
		$('#group_list input').each(function() {
			if ($(this).attr('checked')) {
				text += $(this).attr('text-data')+', ';
			}
		});
		text = text.replace(/(, )$/, '');
		$('#group_selected').text(text);
	}

	$('#postForm .del').live('click', function() {
		var _this = $(this),
		    url = $(this).attr('href');
		url += '&inajax=1';
		$.getJSON(url, function(data) {
			if (data && data.error_code == 0) {
				_this.parents('tr').animate({opacity: 0}, 200, function() {
					var _this = $(this);
					setTimeout(function() {
						_this.remove();
					}, 100);
				});
			} else {
				alert('网络异常, 删除失败');
			}
		});
		return false;
	});
})(jQuery);
</script>
