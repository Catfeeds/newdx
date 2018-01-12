<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if ($_GET['op'] && file_exists($filepath=dirname(__file__).'/admincp_tag_'.$_GET['op'].'.inc.php')) {
    include $filepath;
    exit;
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = 0;

$tags = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_daily_picture_tags'));
while ($value = DB::fetch($query)) {
    $tags[] = $value;
}
?>

<form action="" method="post" id="guideForm">
<?php showtableheader(); ?>
<tr>
	<th colspan="2">
		<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=dailypicture&pmod=admincp_tag&op=edit" style="float:right;">新建标签</a>
	</th>
</tr>
<tr class="header">
	<th>标签</th>
    <th>操作</th>
</tr>

<?php foreach ($tags as $tag): ?>
<tr>
    <td><?php echo $tag['name']; ?></td>

    <td>
        <a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=dailypicture&pmod=admincp_tag&op=edit&tagid=<?php echo $tag['id'];?>">编辑</a>
        <a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=dailypicture&pmod=admincp_tag&op=del&tagid=<?php echo $tag['id'];?>" onclick="return confirm('是否确定删除');">删除</a>
    </td>
</tr>
<?php endforeach; ?>


<?php showtablefooter(); ?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_produce");?>
	</div>
</div>
</form>
