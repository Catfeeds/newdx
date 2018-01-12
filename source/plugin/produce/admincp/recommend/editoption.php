<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';
$id = $_GET['id'];
if (!empty($_POST)) {
	$name = $_POST['uname'];
	$tids = $_POST['unametid'];
	$des = $_POST['description'];
    $recommend = $_POST['recommendtype'];
	$isshow = $_POST['isshow'];
	$display = $_POST['displayorder'];
	
	DB::query("UPDATE ".DB::table('plugin_produce_recommend')."
			   SET uname = '{$name}',
				   tids = '{$tids}',
				   description = '{$des}',
				   recommendtype='$recommend',
				   isshow='$isshow',
				   displayorder='$display'				   
			   WHERE id = {$_GET['id']}");
	cpmsg('修改设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_commend', 'succeed');
}

$edit = DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_recommend')." where id=$id");
$type_select = '<select name="recommendtype">';
foreach($tjArr as $key=>$values) {
	$type_select .= '<option value="'.$key.'">'.$values.'</option>';
}
$type_select .= '</select>';
$type_select = str_replace('<option value="'.$edit['recommendtype'].'"', '<option value="'.$edit['recommendtype'].'" selected="selected"', $type_select);


?>
<script type="text/javascript">
function validate_required(field,alerttxt)
{
  with (field)
  {
  if (value==null||value=="")
    {alert(alerttxt);return false}
  else {return true}
  }
}

function validate_form(thisform)
{
  with (thisform)
  {
    if (validate_required(uname,"用户id不能为空!")==false)
    {uname.focus();return false}
	if (validate_required(unametid,"相关帖子id不能为空!")==false)
    {unametid.focus();return false}
	if (validate_required(description,"人物简介不能为空!")==false)
    {description.focus();return false}
	if (validate_required(displayorder,"展示顺序不能为空!")==false)
    {displayorder.focus();return false}
  }
}
</script>
<form action="" method="post" onsubmit="return validate_form(this);">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">修改人物推荐信息: <?php echo $brand['subject']; ?></th></tr>
<tr><td class="td27" colspan="2">用户Id:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="uname" class="txt" id="" value="<?php echo $edit['uname']; ?>" />
	</td>
	<td class="vtop tips2">
			填写用户id号(例如：2312)，请严格按要求填写
	</td>
</tr>

<tr><td class="td27" colspan="2">用户相关帖子id:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="unametid" class="txt" id="" value="<?php echo $edit['tids']; ?>"/>
	</td>
	<td class="vtop tips2">
	     例如(1049937,1054131,1054107)，请严格按要求填写
	</td>
</tr>


<tr><td class="td27" colspan="2">人物简介:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<textarea class="tarea" cols="30"  name="description" rows="6"><?php echo $edit['description']; ?></textarea>
	</td>
	<td class="vtop tips2">
		人物简介请保持在25个字以内 
	</td>
</tr>

<tr><td class="td27" colspan="2">推荐类型:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<?php echo $type_select; ?>
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>

<tr><td class="td27" colspan="2">是否展示:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="radio" name="isshow" value="1" <?php if ($edit['isshow']==1) {?> checked="checked"<?php } ?>/>是&nbsp;<input type="radio" name="isshow" value="0" <?php if ($edit['isshow']==0) {?> checked="checked"<?php } ?>/>否	
	</td>
	<td class="vtop tips2">
		
	</td>
</tr>

<tr><td class="td27" colspan="2">展示顺序:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="displayorder" class="txt" id="" value="<?php echo $edit['displayorder']; ?>"/>
	</td>
	<td class="vtop tips2">
		数字越大，优先级越高！
	</td>
</tr>

<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>