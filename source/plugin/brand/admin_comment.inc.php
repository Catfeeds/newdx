<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}


require_once DISCUZ_ROOT."/source/plugin/forumoption/include.php";
$url = $_SERVER['QUERY_STRING'];
if ($_POST['operate']) {
    if (count($_POST['comment']) == 0) {
		cpmsg('请至少选择一条信息', $url, 'error');
    }
    $pids = implode(',', array_keys($_POST['comment']));
    require_once libfile("function/delete");
	$pt = DB::query("select * FROM ".DB::table('forum_post')." WHERE pid IN ($pids)");
	if($pt){
		while($vall = DB::fetch($pt)) {
			$post = DB::fetch_first("select * from ".DB::table('forum_post')." where pid='$vall[pid]'");
			if (deletepost('pid='.$vall['pid'])) {
				if($post){
					$replies = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid='$post[tid]' " . getSlaveID());
					DB::update('forum_thread', array('replies' => $replies-1), "tid='$post[tid]'");
				}
				//删除打分信息
				$qy = DB::query("select * FROM ".DB::table('dianping_star_logs')." WHERE pid IN ($vall[pid])");
				while($val = DB::fetch($qy)) {
					DB::query("delete from ".DB::table('dianping_star_logs')." WHERE pid='$val[pid]'");
					$forumOption->calStarInfo($val['starid']);
				}
			}
		}
		cpmsg('删除成功', $url, 'succeed');
	}else{
		cpmsg('删除失败', $url, 'error');
	}
	exit;
    /*if (deletepost('pid IN ('.$pids.')')) {

		while($vall = DB::fetch($pt)) {
			$post = DB::fetch_first("select * from ".DB::table('forum_post')." where pid='$vall[pid]'");
			$replies = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid='$vall[tid]'");
			DB::update('forum_thread', array('replies' => $replies), "tid='$post[tid]'");
		}
		//删除打分信息
		$qy = DB::query("select * FROM ".DB::table('plugin_star_logs')." WHERE ralateid IN ($pids)");
		while($val = DB::fetch($qy)) {
			DB::query("delete from ".DB::table('plugin_star_logs')." WHERE ralateid='$val[ralateid]'");
			$forumOption->calStarInfo($val['starid']);
		}
        cpmsg('删除成功', $url, 'succeed');
    } else {
        cpmsg('删除失败', $url, 'error');
    }
    exit;*/
}

if ($_GET['del'] == 1 && $_GET['pid']) {
    $url = preg_replace('/(&|\?)pid=\d+/i', '', $url);
    $url = preg_replace('/(&|\?)del=1/i', '', $url);
    require_once libfile("function/delete");
	$post = DB::fetch_first("select * from ".DB::table('forum_post')." where pid='$_GET[pid]'");
    if (deletepost('pid='.$_GET['pid'])) {
		if($post){
			$replies = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid='$post[tid]' " . getSlaveID());
			DB::update('forum_thread', array('replies' => $replies-1), "tid='$post[tid]'");
		}
		if($_GET['pid']){
			$log = DB::fetch_first("select * from ".DB::table('dianping_star_logs')." where pid='$_GET[pid]'");
			if($log){
				$qy = DB::query("select * FROM ".DB::table('dianping_star_logs')." WHERE starid = $log[starid]");
				while($val = DB::fetch($qy)) {
					$ps = DB::fetch_first("select * from ".DB::table('forum_post')." where pid='$val[pid]'");
					if(!$ps){
						DB::query("delete from ".DB::table('dianping_star_logs')." WHERE pid='$val[pid]'");
					}
				}
				DB::query("delete from ".DB::table('dianping_star_logs')." WHERE pid='$log[pid]'");
				$forumOption->calStarInfo($log['starid']);
			}
		}
        cpmsg('删除成功', $url, 'succeed');
    } else {
        cpmsg('删除失败', $url, 'error');
    }
    exit;
}

$where = " WHERE p.first=0 AND p.fid=".$_G['config']['fids']['produce'];
$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." AS p
                           $where " . getSlaveID());
$array = array();

$query = DB::query("SELECT p.*, t.subject AS threadName FROM ".DB::table('forum_post')." AS p
                    LEFT JOIN ".DB::table('forum_thread')." AS t ON t.tid=p.tid
				    $where
				    ORDER BY p.pid DESC
					LIMIT ".($page - 1)*$ppp.", $ppp");
while ($value = DB::fetch($query)) {
    $array[] = $value;
}

echo '<form action="" method="post" id="commentForm">';
showtableheader();
echo '<tr class="header"><th width="70%">内容</th><th width="20%">所属</th><th width="10%">操作</th></tr>';
foreach ($array as $i => $value) {
	$rule = "/\[b.*?\](.*)\[\/b\]/";
	$value['message']=preg_replace($rule,'',$value['message']);
    echo '<tr><td><input type="checkbox" name="comment['.$value['pid'].']" class="commentCheckbox" />'.$value['message'].'</td>'.
         '<td><a href="/thread-'.$value['tid'].'-1-1.html" target="_blank">'.$value['threadName'].'</a></td>'.
         '<td>'.
         '&nbsp;&nbsp;'.
		 '<a href="'.$_SERVER['REQUEST_URI'].'&pid='.$value['pid'].'&del=1" onclick="return confirmOperate();">删除</a>'.
		 '</td></tr>';
}
showtablefooter();

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
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=brand&pmod=admin_comment");?>
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
