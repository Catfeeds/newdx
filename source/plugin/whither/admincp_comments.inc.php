<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

$url = $_SERVER['QUERY_STRING'];
if ($_POST['operate']) {
    if (count($_POST['comment']) == 0) {
		cpmsg('请至少选择一条信息', $url, 'error');
    }
    $pids = implode(',', array_keys($_POST['comment']));

    require_once libfile("function/delete");
    if (deletepost('pid IN ('.$pids.')')) {
        cpmsg('删除成功', $url, 'succeed');
    } else {
        cpmsg('删除失败', $url, 'error');
    }
    exit;
}

if ($_GET['del'] == 1 && $_GET['pid']) {
    $url = preg_replace('/(&|\?)pid=\d+/i', '', $url);
    $url = preg_replace('/(&|\?)del=1/i', '', $url);

    require_once libfile("function/delete");
    if (deletepost('pid='.$_GET['pid'])) {
        cpmsg('删除成功', $url, 'succeed');
    } else {
        cpmsg('删除失败', $url, 'error');
    }
    exit;
}

$where = " WHERE p.first=0 AND p.fid=433";
$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." AS p
                           $where");

$array = array();

$query = DB::query("SELECT p.*, t.subject AS threadName, r.type FROM ".DB::table('forum_post')." AS p
                    LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid=p.tid
                    LEFT JOIN ".DB::table('mudidi_thread_ralation')." AS r ON r.tid=p.tid
				    $where
				    ORDER BY p.pid DESC
					LIMIT ".($page - 1)*$ppp.", $ppp");
while ($value = DB::fetch($query)) {
    switch ($value['type']) {
        case '1':
            $value['typeName'] = '景点';
            break;
        case '2':
            $value['typeName'] = '景区';
            break;
        case '3':
            $value['typeName'] = '地区';
            break;
        default:
            $value['typeName'] = '未知';
            break;
    }
    $array[] = $value;
}

echo '<form action="" method="post" id="commentForm">';
showtableheader();
echo '<tr class="header"><th width="70%">内容</th><th width="20%">所属</th><th width="10%">操作</th></tr>';
foreach ($array as $i => $value) {
    echo '<tr><td><input type="checkbox" name="comment['.$value['pid'].']" class="commentCheckbox" />'.$value['message'].'</td>'.
         '<td><a href="/thread-'.$value['tid'].'-1-1.html" target="_blank">'.$value['threadName'].'</a> ('.$value['typeName'].')</td>'.
         '<td>'.
         '<a href="/forum-post-action-edit-fid-'.$value['fid'].'-tid-'.$value['tid'].'-pid-'.$value['pid'].'-page-1.html" target="_blank">编辑</a>&nbsp;&nbsp;'.
		 '<a href="'.$_SERVER['REQUEST_URI'].'&pid='.$value['pid'].'&del=1" onclick="return confirmOperate();">删除</a>'.
		 '</td></tr>';
}
showtablefooter();

echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_comments");
?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:left;">
		<input type="hidden" name="operate" value="" />
		<label for="selectAll">
			<input type="checkbox" id="selectAll" />
			全选/全不选
		</label>
		&nbsp;&nbsp;
		<a href="#" id="delOperate">删除</a>
	</div>
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_comment");?>
	</div>
</div>
</form>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($){
	function submitForm(operate) {
		if ($('#commentForm .commentCheckbox:checked').size() == 0) {
			return false;
		}
		$('#commentForm input[name="operate"]').val(operate);
		$('#commentForm').submit();
	}
    $('#delOperate').click(function(){
        if (!confirmOperate()) {
            return false;
        }
		submitForm('del');
	});
	$('#passOperate').click(function(){
		submitForm(1);
	});
	$('#unpassOperate').click(function(){
		submitForm(2);
	});

	$('#selectAll').click(function(){
		if ($(this)[0].checked) {
			$('#commentForm .commentCheckbox').attr('checked', true);
		} else {
			$('#commentForm .commentCheckbox').attr('checked', false);
		}
	});
})(jQuery);

function confirmOperate() {
    return confirm("您确定要执行此操作吗");
}
</script>
