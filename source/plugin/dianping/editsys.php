<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$optionid = $_GET['mid'];


$option = $dianpingmodules->find(array('conditions'=>'mid='.$optionid,'index_key' =>'mid'));

$option = $option[$optionid];
$chk = explode(',',$option[modules]);
$option['templates'] = unserialize($option['templates']);
$option['settings'] = unserialize($option['settings']);
$option['title'] = unserialize($option['title']);
$option['keyword'] = unserialize($option['keyword']);
$option['description'] = unserialize($option['description']);

if (!empty($_POST)) {
	$mid = $_POST['mid'];
	$name = $_POST['mname'];
	$fid = $_POST['fid'];
	$isshow = $_POST['isshow'];
	$comment = $_POST['comment'];
	$listlimit = $_POST['listlimit'];
	$srcid = $_POST['srcid'];
	$commentlimit = $_POST['commentlimit'];
	$otherlimit = $_POST['otherlimit'];
	$title = serialize($_POST['ntitle']);
	$keyword = serialize($_POST['nkeyword']);
	$description = serialize($_POST['ndescription']);
	//ģ��
	$temp = $_POST['template'];
	//�õ�����(һ������)
	$arr = $_POST['fname'];
	foreach($arr as $key=>$val){
		if($val){
			$dianpingmodules->editSetting($mid, $key, $val);
		}
	}	
	$dianpingmodules->edit($mid,array('mname'=>$name,'fid'=>$fid,'status'=>$isshow,'templates'=>serialize($temp),'comment'=>$comment,'srcid'=>$srcid,'listlimit'=>$listlimit,'commentlimit'=>$commentlimit,'otherlimit'=>$otherlimit, 'title' => $title, 'keyword' => $keyword, 'description' => $description));
	cpmsg('�޸����óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dianping&pmod=system_manager', 'succeed');
}
if($_G['uid']==1){
$btn='<input type="submit" value="�ύ" title="�� Enter ������ʱ�ύ����޸�" name="editsubmit" id="submit_editsubmit" class="btn">';
}
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
  if (validate_required(tname,"������Ʋ���Ϊ��!")==false)
    {tname.focus();return false}
  }
}
</script>

<form action="" method="post" onsubmit="return validate_form(this);">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">��������</th></tr>
<tr>
<td class="td27" colspan="2">ϵͳ����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="mname" class="txt" id="" readonly="readonly" value="<?php echo $option[mname]; ?>" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">�����İ��(fid):</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<input type="text" name="fid" class="txt" id="" value="<?php echo $option[fid]; ?>" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>
<tr><td class="td27" colspan="2">ģ������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		�б�ҳģ�壺
		<div id="temp1">
			<script type="text/javascript">
			ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=list&selected=<?php echo $option['templates']['list']; ?>', 'temp1');
			</script>
		</div>
		����ҳģ�壺
		<div id="temp2">
			<script type="text/javascript">
			ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=post&selected=<?php echo $option['templates']['post']; ?>', 'temp2');
			</script>
		</div>
		��ϸҳģ�壺
		<div id="temp3">
			<script type="text/javascript">
			ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=view&selected=<?php echo $option['templates']['view']; ?>', 'temp3');
			</script>
		</div>
		���ۿ�ajaxģ�壺
		<div id="temp4">
			<script type="text/javascript">
			ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=replylist&selected=<?php echo $option['templates']['replylist']; ?>', 'temp4');
			</script>
		</div>
		����ͼƬajaxģ�壺
		<div id="temp5">
			<script type="text/javascript">
			ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=imagelist&selected=<?php echo $option['templates']['imagelist']; ?>', 'temp5');
			</script>
		</div>
	</td>
	<td class="vtop tips2">		 
	</td>
</tr>

<tr><td class="td27" colspan="2">�Ƿ����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<input type="radio" value="1" name="isshow" <?php if($option[status]==1){ ?>checked="checked"<?php } ?>/>�� &nbsp;&nbsp; <input type="radio" value="0" name="isshow"<?php if($option[status]==0||$option[status]==-1){ ?>checked="checked"<?php } ?>/>��
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>


<tr><td class="td27" colspan="2">�����ֶ�:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">	
		<div id="dg_id" style="width: 300px;">&nbsp;&nbsp;&nbsp;&nbsp;<label for="name">ԭʼ����</label>&nbsp;&nbsp;<label for="name">����</label></div>	
		<div id="dg_id" style="width: 300px;"><input type="checkbox"  disabled="true" checked value="" name="fild[mc]"/>&nbsp;&nbsp;<label for="name">����</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fname[mc]" value="����"/></div>
		<div id="dg_id" style="width: 300px;"><input type="checkbox"  disabled="true" checked value="" name="fild[star]"/>&nbsp;&nbsp;<label for="star">����</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fname[star]" value="����"/></div>		
		<?php $zt = DB::query("select * from ".DB::table('plugin_dianping_childmodules')." where 1=1");
		while ($values = DB::fetch($zt)): ?>
		<div id="dg_id" style="width: 300px;">
				<input type="checkbox" class="bg" disabled="disabled" <?php if(in_array($values['mdid'],$chk)){ ?> checked="checked"<?php } ?> value="<?php echo $values['mdid']; ?>" name="fild[<?php echo $values['keyname']; ?>]"/>&nbsp;<?php echo $values['mdname']; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="t<?php echo $values['mdid']; ?>" name="fname[<?php echo $values['keyname']; ?>]" <?php if(!in_array($values['mdid'],$chk)){ ?> disabled="disabled"<?php } ?> value="<?php echo $option['settings'][$values['keyname']]; ?>"/>
		</div>	
		<?php endwhile; ?>	
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">�����ֶ�:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<textarea rows="3" cols="30" name="initpost"><?php echo $option[comment]; ?></textarea>			
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">ģ������(srcid):</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<input type="text" name="srcid" class="txt" id="" value="<?php echo $option[srcid]; ?>" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">ģ���б�ҳ��ҳ����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<input type="text" name="listlimit" class="txt" id="" value="<?php echo $option[listlimit]; ?>" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">������ϸҳ��ҳ����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<input type="text" name="commentlimit" class="txt" value="<?php echo $option[commentlimit]; ?>" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">��ϸҳ������������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<input type="text" name="otherlimit" class="txt" value="<?php echo $option[otherlimit]; ?>" />
	</td>
	<td class="vtop tips2">
		 
	</td>
</tr>

<tr><td class="td27" colspan="2">�������ʼֵ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<div id="dg_id" style="width: 500px;">
			<textarea rows="8" cols="30" name="fname[initdianping]"><?php echo $option['settings']['initdianping']; ?></textarea>
		</div>
		
	</td>
	<td class="vtop tips2">
	</td>
</tr>
<tr><td class="td27" colspan="2">�������ʼֵ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<div id="dg_id" style="width: 500px;">
			<textarea rows="8" cols="30" name="fname[initpost]"><?php echo $option['settings']['initpost']; ?></textarea>
		</div>
		
	</td>
	<td class="vtop tips2">
	<input type="hidden" name="mid" class="txt" value="<?php echo $option[mid]; ?>" />
	</td>
</tr>
<tr class="noborder">
	<td class="vtop">
		<p>
			<h3>�б�ҳ��</h3>
			<ul>
				<li><p>title������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> ������� <b>{page}</b> ����ҳ�룬1ҳ���ϻ���ʾΪ" - ��Xҳ"��</p><br/>
					<textarea rows="2" cols="60" name="ntitle[list]"><?php echo $option['title']['list']; ?></textarea>
				</li>
				<li><p>keyword������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> �����������</p><br/>
					<textarea rows="2" cols="60" name="nkeyword[list]"><?php echo $option['keyword']['list']; ?></textarea>
				</li>
				<li><p>description������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> �����������</p><br/>
					<textarea rows="2" cols="60" name="ndescription[list]"><?php echo $option['description']['list']; ?></textarea>
				</li>
				<div style="clear:both;"></div>
			</ul>
		</p>
		<p>
			<h3>��ϸҳ��</h3>
			<ul>
				<li><p>title������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> ������� <b>{subtitle}</b> ����ǰѩ�������̵ȣ����� <b>{page}</b> ����ҳ�룬1ҳ���ϻ���ʾΪ" - ��Xҳ"��</p><br/>
					<textarea rows="2" cols="60" name="ntitle[view]"><?php echo $option['title']['view']; ?></textarea>
				</li>
				<li><p>keyword������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> ������� <b>{subtitle}</b> ����ǰѩ�������̵ȣ����ƣ�</p><br/>
					<textarea rows="2" cols="60" name="nkeyword[view]"><?php echo $option['keyword']['view']; ?></textarea>
				</li>
				<li><p>description������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> ������� <b>{subtitle}</b> ����ǰѩ�������̵ȣ����ƣ�</p><br/>
					<textarea rows="2" cols="60" name="ndescription[view]"><?php echo $option['description']['view']; ?></textarea>
				</li>
				<div style="clear:both;"></div>
			</ul>
		</p>
		<p>
			<h3>����ҳ��</h3>
			<ul>
				<li><p>title������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> ���������</p><br/>
					<textarea rows="2" cols="60" name="ntitle[post]"><?php echo $option['title']['post']; ?></textarea>
				</li>
				<li><p>keyword������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> ���������</p><br/>
					<textarea rows="2" cols="60" name="nkeyword[post]"><?php echo $option['keyword']['post']; ?></textarea>
				</li>
				<li><p>description������ <b>{name}</b> ����ģ���� <b>{year}</b> ������� <b>{area}</b> ���������</p><br/>
					<textarea rows="2" cols="60" name="ndescription[post]"><?php echo $option['description']['post']; ?></textarea>
				</li>
				<div style="clear:both;"></div>
			</ul>
		</p>
		
	</td>
	<td class="vtop tips2">		 
	<input type="hidden" name="mid" class="txt" value="<?php echo $option[mid]; ?>" />
	</td>
</tr>

<tr>
	<td colspan="15">
		<div class="fixsel">
		<?php echo $btn; ?>
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>

