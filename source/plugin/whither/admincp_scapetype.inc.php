<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if ($_GET['op'] && file_exists($filepath=dirname(__file__).'/admincp_scapetype_'.$_GET['op'].'.inc.php')) {
    include $filepath;
    exit;
}

$query = DB::query("SELECT * FROM ".DB::table('mudidi_scapetype'));
?>

<?php
echo '<tr><td colspan="2"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_scapetype&op=edit">新建设置</a></td></tr>';
showtableheader();
echo '<tr class="header"><th>名称</th><th>默认旅游信息</th><th>操作</th></tr>';
while ($value = DB::fetch($query)) {
    echo '<tr><td>'.$value['name'].'</td>'.
		 '<td>'.$value['defaultInfo'].'</td>'.
         '<td>'.
         '<a href="/'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_scapetype&op=edit&scapetypeid='.$value['id'].'">编辑</a>'.
		 '</td></tr>';
}
showtablefooter();
?>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
function confirmOperate() {
    return confirm("您确定要执行此操作吗");
}
</script>
