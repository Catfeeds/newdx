<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if (in_array($_GET['op'], array('block', 'unblock')) && $_GET['uid'] != '') {
	$blocked = $_GET['op']=='block' ? 1 : 0;
	DB::query("UPDATE ".DB::table('plugin_produce_publishers')." SET blocked = $blocked WHERE uid = '{$_GET['uid']}'");
	cpmsg('�����ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_publisher', 'succeed');
}
if (in_array($_GET['op'], array('comment', 'forbidcomment')) && $_GET['uid'] != '') {
	$blocked = $_GET['op']=='forbidcomment' ? 1 : 0;
	DB::query("UPDATE ".DB::table('plugin_produce_publishers')." SET forbidcomment = $blocked WHERE uid = '{$_GET['uid']}'");
	cpmsg('�����ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_publisher', 'succeed');
}
if (in_array($_GET['op'], array('share', 'forbidshare')) && $_GET['uid'] != '') {
	$blocked = $_GET['op']=='forbidshare' ? 1 : 0;
	DB::query("UPDATE ".DB::table('plugin_produce_publishers')." SET forbidshare = $blocked WHERE uid = '{$_GET['uid']}'");
	cpmsg('�����ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_publisher', 'succeed');
}
if (in_array($_GET['op'], array('price', 'forbidprice')) && $_GET['uid'] != '') {
	$blocked = $_GET['op']=='forbidprice' ? 1 : 0;
	DB::query("UPDATE ".DB::table('plugin_produce_publishers')." SET forbidprice = $blocked WHERE uid = '{$_GET['uid']}'");
	cpmsg('�����ɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_publisher', 'succeed');
}


@session_start();
$prefix = 'plugin_produce_publisher_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
}
$search = array();
foreach (explode(' ', 'username block forbidcomment forbidshare forbidprice orderBy orderType') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}

$where = ' WHERE 1=1';

if ($search['username']) {
	$vegetables = explode(",",$search['username']);
	$text = implode("','", $vegetables);
	$where .= " AND username in ('{$text}')";
}
if ($search['block'] != '') {
	$where .= " AND blocked='{$search['block']}'";
}
if ($search['forbidcomment'] != '') {
	$where .= " AND forbidcomment='{$search['forbidcomment']}'";
}
if ($search['forbidshare'] != '') {
	$where .= " AND forbidshare='{$search['forbidshare']}'";
}
if ($search['forbidprice'] != '') {
	$where .= " AND forbidprice='{$search['forbidprice']}'";
}

$orderBy = '';
if ($search['orderBy'] != '') {
	$orderBy .= " ORDER BY ";
	switch ($search['orderBy']) {
		case 1: $orderBy .= "rank"; break;
		case 2: $orderBy .= "shareNum"; break;
		case 3: $orderBy .= "digestNum"; break;
		case 4: $orderBy .= "showNum"; break;
		case 5: $orderBy .= "priceNum"; break;
		default: break;
	}
	if ($orderBy && $search['orderType'] != '') {
		$orderBy .= " {$search['orderType']}";
	}
}


$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_publishers').$where);
$query = DB::query("SELECT * FROM ".DB::table('plugin_produce_publishers').$where.$orderBy);
$users = array();
while ($value = DB::fetch($query)) {
	$users[] = $value;
}
?>

<form action="" method="POST">
	<table class="tb tb2">
		<tbody>
			<tr>
				<th class="partition">����</th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="search" value="1" />
					�û���:
					<input type="text" name="username" id="username" size="25" value="<?php echo $search['username']; ?>" />
					<select name="block" id="block">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['block']==='1'?' selected="selected"':''; ?>>�ڲ���Ա</option>
						<option value="0"<?php echo $search['block']==='0'?' selected="selected"':''; ?>>���ڲ���Ա</option>
					</select>
					<select name="forbidcomment" id="forbidcomment">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['forbidcomment']==='1'?' selected="selected"':''; ?>>��ֹ����</option>
						<option value="0"<?php echo $search['forbidcomment']==='0'?' selected="selected"':''; ?>>������</option>
					</select>
					<select name="forbidshare" id="forbidshare">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['forbidshare']==='1'?' selected="selected"':''; ?>>��ֹ����</option>
						<option value="0"<?php echo $search['forbidshare']==='0'?' selected="selected"':''; ?>>�ɷ���</option>
					</select>
					<select name="forbidprice" id="forbidprice">
						<option value="">ȫ��</option>
						<option value="1"<?php echo $search['forbidprice']==='1'?' selected="selected"':''; ?>>��ֹ�ڼ�</option>
						<option value="0"<?php echo $search['forbidprice']==='0'?' selected="selected"':''; ?>>���ڼ�</option>
					</select>
					����:
					<select name="orderBy" id="orderBy">
						<option value="">Ĭ��</option>
						<option value="1"<?php echo $search['orderBy']==='1'?' selected="selected"':''; ?>>���׶�</option>
						<option value="2"<?php echo $search['orderBy']==='2'?' selected="selected"':''; ?>>��������</option>
						<option value="3"<?php echo $search['orderBy']==='3'?' selected="selected"':''; ?>>��������</option>
						<option value="4"<?php echo $search['orderBy']==='4'?' selected="selected"':''; ?>>����������</option>
						<option value="5"<?php echo $search['orderBy']==='5'?' selected="selected"':''; ?>>����۸�����</option>
					</select>
					<select name="orderType" id="orderType">
						<option value="">Ĭ��</option>
						<option value="ASC"<?php echo $search['orderType']==='ASC'?' selected="selected"':''; ?>>����</option>
						<option value="DESC"<?php echo $search['orderType']==='DESC'?' selected="selected"':''; ?>>����</option>
					</select>
					<input type="submit" value="����" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>

<form action="" method="post" id="UserForm">
<?php showtableheader(); ?>
<tr class="header">
	<th>�ǳ�</th>
	<th>���׶�</th>
	<th>��������</th>
	<th>��������</th>
	<th>����������</th>
	<th>����۸�����</th>
	<th>����</th>
</tr>
<?php foreach ($users as $user): ?>
<tr>
	<td>
		<a href="<?php echo $_G['config']['web']['home']; ?>space-uid-<?php echo $user['uid']; ?>.html" target="_blank" title="<?php echo $user['username']; ?>"><?php echo $user['username']; ?></a>
		<?php if ($user['blocked']): ?>
		(<span style="color: red;">�ڲ���Ա</span>)
		<?php else: ?>
		<?php endif; ?>
	</td>
	<td><?php echo $user['rank']; ?></td>
	<td><?php echo $user['shareNum']; ?></td>
	<td><?php echo $user['digestNum']; ?></td>
	<td><?php echo $user['showNum']; ?></td>
	<td><?php echo $user['priceNum']; ?></td>
	<td>
		<?php if ($user['blocked']): ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=unblock&uid=<?php echo $user['uid']; ?>"><span style="color: red;">ȡ���ڲ���Ա</span></a>
		<?php else: ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=block&uid=<?php echo $user['uid']; ?>">�ڲ���Ա</a>
		<?php endif; ?>
		&nbsp;
		<?php if ($user['forbidcomment']): ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=comment&uid=<?php echo $user['uid']; ?>"><span style="color: red;">�ָ�����</span></a>
		<?php else: ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=forbidcomment&uid=<?php echo $user['uid']; ?>">��ֹ����</a>
		<?php endif; ?>
		&nbsp;
		<?php if ($user['forbidshare']): ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=share&uid=<?php echo $user['uid']; ?>"><span style="color: red;">�ָ�����</span></a>
		<?php else: ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=forbidshare&uid=<?php echo $user['uid']; ?>">��ֹ����</a>
		<?php endif; ?>
		&nbsp;
		<?php if ($user['forbidprice']): ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=price&uid=<?php echo $user['uid']; ?>"><span style="color: red;">�ָ���۸�</span></a>
		<?php else: ?>
			<a href="<?php echo ADMINSCRIPT; ?>?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher&op=forbidprice&uid=<?php echo $user['uid']; ?>">��ֹ���۸�</a>
		<?php endif; ?>
	</td>
</tr>
<?php endforeach; ?>

<?php showtablefooter(); ?>
<div style="overflow:hidden;width:99%;clear:both;padding:5px;border-top:1px solid #deeffb;">
	<div style="float:right;">
		<?php echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=produce&pmod=admin_publisher");?>
	</div>
</div>
</form>
