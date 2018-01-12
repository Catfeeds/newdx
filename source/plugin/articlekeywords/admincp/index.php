<?php

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

// ����
$categorys = array();
$query = DB::query("SELECT * FROM ".DB::table('plugin_articlekeywords_category'));
while ($value = DB::fetch($query)) {
	$categorys[$value['id']] = $value;
}

@session_start();
$prefix = 'plugin_articlekeywords_admincp_index_';
if (!empty($_POST['search'])) {
	unset($_POST['search']);
	$_G['gp_page'] = 1;
	foreach ($_POST as $postid => $post) {
		$_SESSION[$prefix.$postid] = $post;
	}
}
$search = array();
foreach (explode(' ', 'category type keyword') as $key) {
	$search[$key] = $_SESSION[$prefix.$key];
}


$where = " WHERE 1 = 1";
if ($search['category'] != null && ($search['category'] = intval($search['category'])) > 0) {
	$where .= " AND category = {$search['category']}";
}
if ($search['type'] != null && intval($search['type']) > -1) {
	$where .= " AND enabled = {$search['type']}";
}
if ($search['keyword'] != null) {
	$where .= " AND keyword LIKE '%{$search['keyword']}%'";
}


$ppp = 50;
$page = max(1, intval($_G['gp_page']));
$count = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_articlekeywords')."
						  $where");
$query = DB::query("SELECT * FROM ".DB::table('plugin_articlekeywords')."
				    $where
				    LIMIT ".($page - 1)*$ppp.", $ppp");
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
					<select name="category" id="category">
						<option value="0">ȫ��</option>
						<?php foreach ($categorys as $category_id =>$category) { ?>
						<option value="<?php echo $category_id; ?>"<?php echo $search['category']==$category_id?' selected="selected"':''; ?>><?php echo $category['name']; ?></option>
						<?php } ?>
					</select>
					<select name="type" id="type">
						<option value="-1">ȫ��</option>
						<option value="0"<?php echo $search['type']==0?' selected="selected"':''; ?>>��ͨ</option>
						<option value="1"<?php echo $search['type']==1?' selected="selected"':''; ?>>����</option>
					</select>
					�ؼ���:
					<input type="text" name="keyword" id="keyword" size="15" value="<?php echo $search['keyword']; ?>" />
					<input type="submit" value="����" class="btn" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
showtableheader();
echo '<tr><td colspan="5"><a style="float:right;" href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp&op=new">�½��ؼ���</a></td></tr>';
echo '<tr class="header"><th>�ؼ���</th><th>����</th><th>����</th><th>����</th><th>����</th></tr>';
while ($value = DB::fetch($query)) {
	echo '<tr>';
    echo '<td>'.$value['keyword'].'</td>'.
         '<td><a href="'.$value['link'].'" target="_blank">'.$value['link'].'</a></td>'.
		 '<td>'.($value['category']?$categorys[$value['category']]['name']:'��').'</td>'.
		 '<td>'.($value['enabled']==1?'<span style="color:#36a500;">����</span>':'<span style="color:#f50000;">��ͨ</span>').'</td>'.
         '<td><a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp&op=edit&kid='.$value['id'].'">�༭</a>&nbsp;&nbsp;'.
		 '<a href="'.ADMINSCRIPT.'?action=plugins&operation=config&do='.$pluginid.'&identifier=articlekeywords&pmod=admincp&op=del&kid='.$value['id'].'">ɾ��</a></td>';
}
showtablefooter();
echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=articlekeywords&pmod=admincp");
