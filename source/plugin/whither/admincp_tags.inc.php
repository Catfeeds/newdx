<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if ($_GET['op'] && file_exists($filepath=dirname(__file__).'/admincp_tags_'.$_GET['op'].'.inc.php')) {
    include $filepath;
    exit;
}

$query = DB::query("SELECT * FROM ".DB::table('mudidi_tags'));
?>

<?php
echo '<tr><td colspan="2"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_tags&op=edit">新建设置</a></td></tr>';
showtableheader();
echo '<tr class="header"><th>名称</th><th>操作</th></tr>';
while ($value = DB::fetch($query)) {
    echo '<tr><td>'.$value['name'].'</td>'.
         '<td>'.
         '<a href="/'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_tags&op=edit&tagid='.$value['tagid'].'">编辑</a>'.
		 '&nbsp;&nbsp;<a href="/'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_tags&op=del&tagid='.$value['tagid'].'" onclick="return confirmOperate();">删除</a>'.
		 '</td></tr>';
}
showtablefooter();
?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=whither&pmod=admincp_guide");?>
	</div>
</div>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
function confirmOperate() {
    return confirm("您确定要执行此操作吗");
}
</script>
