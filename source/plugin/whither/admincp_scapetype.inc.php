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
echo '<tr><td colspan="2"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_scapetype&op=edit">�½�����</a></td></tr>';
showtableheader();
echo '<tr class="header"><th>����</th><th>Ĭ��������Ϣ</th><th>����</th></tr>';
while ($value = DB::fetch($query)) {
    echo '<tr><td>'.$value['name'].'</td>'.
		 '<td>'.$value['defaultInfo'].'</td>'.
         '<td>'.
         '<a href="/'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=whither&pmod=admincp_scapetype&op=edit&scapetypeid='.$value['id'].'">�༭</a>'.
		 '</td></tr>';
}
showtablefooter();
?>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
function confirmOperate() {
    return confirm("��ȷ��Ҫִ�д˲�����");
}
</script>
