<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
/*��ȡ������������Ϣ*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachserver = new attachserver;
$domain_all = $attachserver->get_server_domain('all');
/*����*/
if ($_GET['op'] && file_exists($filepath=dirname(__file__).'/admincp_pic_'.$_GET['op'].'.inc.php')) {
    include $filepath;
    exit;
}

$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$start = ($page - 1) * $ppp;
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_daily_picture_pics'));

$pics = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_daily_picture_pics')." ORDER BY createdAt DESC LIMIT {$start},{$ppp}");
while ($pic = DB::fetch($query)) {
    $tags = array();
    $tag_query = DB::query("SELECT t.* FROM ".DB::table('plugin_daily_picture_tags').' t'
                           ." RIGHT JOIN ".DB::table('plugin_daily_picture_pic_tag_mapping')." m ON m.tagId = t.id"
                           ." WHERE m.picId = {$pic['id']}");
    while ($tag = DB::fetch($tag_query)) {
        $tags[] = $tag['name'];
    }
    $pic['tags'] = implode(', ', $tags);
    $pic['picDescription'] = preg_replace('/(\w{31})/', '\1-', $pic['picDescription']);
    $pic['createdAt'] = date('y/m/d H:i', $pic['createdAt']);
    /*��ʱ�޸ģ�����ͼƬ*/
    //$pic['picPath'] = "/data/attachment/plugin/".$pic['picPath'];
    $pic['picThumbPath'] = getimagethumb(140, 140, 1, "plugin/{$pic['picPath']}", 0, $pic['serverid']);
    $pic['picPath'] = $pic['serverid']>0 ? "http://".$domain_all[$pic['serverid']]."/plugin/".$pic['picPath'] : "/data/attachment/plugin/".$pic['picPath'];
    /*����*/
    //$pic['picThumbPath'] = preg_replace('/(?=\.([^.]+)$)/i', '.thumb', $pic['picPath']);
    /*$pic['filestatus'] = "<p>Դ�ļ�:".(file_exists(DISCUZ_ROOT.".".$pic['picPath']) ? "<b class='green'>����</b>" : "<b class='red'>������</b>")."</p>";
    $pic['filestatus'] .= "<p>ԭ����:".(file_exists(DISCUZ_ROOT.".".$pic['picThumbPath']) ? "<b class='green'>����</b>" : "<b class='red'>������</b>")."</p>";
    $pic['filestatus'] .= "<p>�»���:".(file_exists(DISCUZ_ROOT.".".$pic['picPath'].".thumb.jpg") ? "<b class='green'>����</b>" : "<b class='red'>������</b>")."</p>";*/
    $pics[] = $pic;
}
?>
<style>
.red{color:red;}
.green{color:green;}
</style>
<form action="" method="post" id="guideForm">
<?php showtableheader(); ?>
<tr class="header">
    <th width="15%">����ͼ</th>
    <th width="10%">ͼƬ����</th>
    <th width="20%">ͼƬ����</th>
    <th width="6%">����ʱ��</th>
    <th width="8%">������</th>
    <th width="12%">��ϵ��ʽ</th>
    <th width="12%">֧����ID</th>
    <th width="">��ǩ</th>
    <th width="6%">����</th>
</tr>

<?php foreach ($pics as $pic): ?>
<tr>
    <td>
        <a href="<?php echo $pic['picPath']; ?>" target="_blank" title="����鿴��ͼ">
            <img src="<?php echo $pic['picThumbPath']; ?>" alt="" />
        </a>
    </td>
    <td><?php echo $pic['picName']; ?><p><?php echo $pic['filestatus']; ?></p></td>
    <td><?php echo $pic['picDescription']; ?></td>
    <td><?php echo $pic['createdAt']; ?></td>
    <td>
        <?php if ($pic['uid'] && $pic['username']): ?>
            <a href="<?php echo getglobal('config/web/home'); ?>space-uid-<?php echo $pic['uid']; ?>.html" target="_blank" title="<?php echo $pic['username']; ?>">
            <?php echo $pic['username']; ?>
            </a>
        <?php else: ?>
            <?php echo $pic['username'] ? $pic['username'] : '�����û�'; ?>
        <?php endif; ?>
    </td>
    <td>
		<div style="width:100px; overflow: hidden;">
			<?php echo $pic['contact']; ?>
		</div>
    </td>
    <td>
		<div style="width:100px; overflow: hidden;">
            <?php echo $pic['alipayId'] ? $pic['alipayId'] : 'δ��д'; ?>
		</div>
    </td>
    <td>
        <?php echo $pic['tags']; ?>
    </td>
    <td>
        <a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=dailypicture&pmod=admincp_pic&op=edit&picid=<?php echo $pic['id'];?>">�༭</a>
        <a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=<?php echo $pluginid; ?>&identifier=dailypicture&pmod=admincp_pic&op=del&picid=<?php echo $pic['id'];?>" onclick="return confirm('�Ƿ�ȷ��ɾ��');">ɾ��</a>
    </td>
</tr>
<?php endforeach; ?>


<?php showtablefooter(); ?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">

    <div style="float:right;">
        <?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=dailypicture&pmod=admincp_pic");?>
    </div>
</div>
</form>
