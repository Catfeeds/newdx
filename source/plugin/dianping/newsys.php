<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$modules = $dianpingmodules->findAll();

$uid = $_G['uid'];
$username = $_G['username'];
if (!empty($_POST)) {
	$name = $_POST['tname'];
	$fild = $_POST['fild'];	
	$comment = $_POST['comment'];
	$fd = implode(',',$fild);	
	//���ģ��
	$temp = $_POST['template'];
	//��ǰʱ��
	$time = time();	
	//���ģ�鷵��mid
	$mid = $dianpingmodules->add(array('mname'=>$name,
									   'asktime'=>$time,
									   'templates'=>serialize($temp),
									   'comment'=>$comment,
									   'modules'=>$fd,									   
									   'authorid'=>$uid,
									   'authorname'=>$username,
								));							
	//�õ�����(һ������)	
	$arr = $_POST['fname'];
	foreach($arr as $key=>$val){
		if($val){
			$dianpingmodules->editSetting($mid, $key, $val);
		}
	}
	cpmsg('�½����óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dianping&pmod=system_manager', 'succeed');
}
$zt = DB::query("select * from ".DB::table('plugin_dianping_childmodules')." where 1=1");
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
  if (validate_required(tname,"ϵͳ���Ʋ���Ϊ��!")==false)
    {tname.focus();return false}
  }  
  var list = document.getElementById('templatesrv_dianping_list').value;
  var post = document.getElementById('templatesrv_dianping_post').value;
  var view = document.getElementById('templatesrv_dianping_view').value;  
  if(list==''||empty(list)){
      alert('�б�ҳģ��Ϊѡ��');
	  return false;
  }
  if(post==''||empty(post)){
      alert('����ҳģ��Ϊѡ��');
	  return false;
  }
    if(view==''||empty(view)){
      alert('��ϸҳģ��δѡ��');
	  return false;
  }
  
}
</script>

<form action="" method="post" onsubmit="return validate_form(this);">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">�½�ϵͳ</th></tr>
<tr><td class="td27" colspan="2">ϵͳ����:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="tname" class="txt" id="" />
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
		ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=list', 'temp1');
		</script>
		</div>
		����ҳģ�壺
		<div id="temp2">
	<script type="text/javascript">
		ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=post', 'temp2');
		</script>
		</div>
		��ϸҳģ�壺
		<div id="temp3">
		<script type="text/javascript">
		ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=view', 'temp3');
		</script>
		</div>
		���ۿ�ajaxģ�壺
		<div id="temp4">
			<script type="text/javascript">
			ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=replylist', 'temp4');
			</script>
		</div>
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
		<?php while ($values = DB::fetch($zt)): ?>
		<div id="bq_rq">			
			<div id="dg_id" style="width: 300px;">
			<input type="checkbox" class="bg" id="chk<?php echo $values['mdid']; ?>" value="<?php echo $values['mdid']; ?>" name="fild[<?php echo $values['keyname']; ?>]"/>&nbsp;
			<label for="fild[]"><?php echo $values['mdname']; ?></label>&nbsp;&nbsp;&nbsp;
			<input type="text" id="t<?php echo $values['mdid']; ?>" name="fname[<?php echo $values['keyname']; ?>]" value="<?php echo $values['mdname']; ?>"/>		
			</div>		
		</div>
		<?php endwhile; ?>
		
	</td>
	<td class="vtop tips2">		 
	</td>
</tr>
<tr><td class="td27" colspan="2">�����ֶ�:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		��������ֶ���û��������Ҫ���ֶΣ�����������д����Ҫ���ֶ���Ϣ���ƣ�����Ա��Ϊ�����
		<div id="dg_id" style="width: 505px;">
			<textarea rows="3" cols="30" name="comment"></textarea>			
		</div>
			
	</td>
	<td class="vtop tips2">	

	</td>
</tr>

<tr><td class="td27" colspan="2">�������ʼֵ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<div id="dg_id" style="width: 500px;">
			<textarea rows="8" cols="30" name="fname[initdianping]"></textarea>
		</div>
		
	</td>
	<td class="vtop tips2">		 
	</td>
</tr>
<tr><td class="td27" colspan="2">�������ʼֵ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<div id="dg_id" style="width: 500px;">
			<textarea rows="8" cols="30" name="fname[initpost]"></textarea>
		</div>
		
	</td>
	<td class="vtop tips2">		 
	</td>
</tr>
<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="�ύ" title="�� Enter ������ʱ�ύ����޸�" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter(); ?>
</form>

<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
;(function($){
	$('.bg').click(function(){
		var id = $(this).val();
		var chk = $('#chk'+id).attr("checked");
		if(chk=='checked'){
		$('#t'+id).removeAttr('disabled');	
		}else{
		$('#t'+id).attr('disabled','disabled');
		}				
	});
	
})(jQuery);
</script>


