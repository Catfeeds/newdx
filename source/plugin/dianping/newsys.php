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
	//获得模板
	$temp = $_POST['template'];
	//当前时间
	$time = time();	
	//添加模块返回mid
	$mid = $dianpingmodules->add(array('mname'=>$name,
									   'asktime'=>$time,
									   'templates'=>serialize($temp),
									   'comment'=>$comment,
									   'modules'=>$fd,									   
									   'authorid'=>$uid,
									   'authorname'=>$username,
								));							
	//得到别名(一个数组)	
	$arr = $_POST['fname'];
	foreach($arr as $key=>$val){
		if($val){
			$dianpingmodules->editSetting($mid, $key, $val);
		}
	}
	cpmsg('新建设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=dianping&pmod=system_manager', 'succeed');
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
  if (validate_required(tname,"系统名称不能为空!")==false)
    {tname.focus();return false}
  }  
  var list = document.getElementById('templatesrv_dianping_list').value;
  var post = document.getElementById('templatesrv_dianping_post').value;
  var view = document.getElementById('templatesrv_dianping_view').value;  
  if(list==''||empty(list)){
      alert('列表页模板为选择');
	  return false;
  }
  if(post==''||empty(post)){
      alert('发布页模板为选择');
	  return false;
  }
    if(view==''||empty(view)){
      alert('详细页模板未选择');
	  return false;
  }
  
}
</script>

<form action="" method="post" onsubmit="return validate_form(this);">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">新建系统</th></tr>
<tr><td class="td27" colspan="2">系统名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="tname" class="txt" id="" />
	</td>
	<td class="vtop tips2">		 
	</td>
</tr>

<tr><td class="td27" colspan="2">模板名称:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
	列表页模板：
		<div id="temp1">
		<script type="text/javascript">
		ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=list', 'temp1');
		</script>
		</div>
		发布页模板：
		<div id="temp2">
	<script type="text/javascript">
		ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=post', 'temp2');
		</script>
		</div>
		详细页模板：
		<div id="temp3">
		<script type="text/javascript">
		ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=view', 'temp3');
		</script>
		</div>
		评论框ajax模板：
		<div id="temp4">
			<script type="text/javascript">
			ajaxget('/forum.php?ctl=template&act=gettemplate&model=dianping&typename=replylist', 'temp4');
			</script>
		</div>
	</td>
	<td class="vtop tips2">		 
	</td>
</tr>

<tr><td class="td27" colspan="2">所需字段:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
	
		<div id="dg_id" style="width: 300px;">&nbsp;&nbsp;&nbsp;&nbsp;<label for="name">原始名称</label>&nbsp;&nbsp;<label for="name">别名</label></div>
		<div id="dg_id" style="width: 300px;"><input type="checkbox"  disabled="true" checked value="" name="fild[mc]"/>&nbsp;&nbsp;<label for="name">名称</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fname[mc]" value="名称"/></div>
		<div id="dg_id" style="width: 300px;"><input type="checkbox"  disabled="true" checked value="" name="fild[star]"/>&nbsp;&nbsp;<label for="star">评分</label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fname[star]" value="评分"/></div>		
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
<tr><td class="td27" colspan="2">其他字段:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		如果以上字段中没有你所需要的字段，请在下面填写所需要的字段信息名称，程序员会为你添加
		<div id="dg_id" style="width: 505px;">
			<textarea rows="3" cols="30" name="comment"></textarea>			
		</div>
			
	</td>
	<td class="vtop tips2">	

	</td>
</tr>

<tr><td class="td27" colspan="2">点评框初始值:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<div id="dg_id" style="width: 500px;">
			<textarea rows="8" cols="30" name="fname[initdianping]"></textarea>
		</div>
		
	</td>
	<td class="vtop tips2">		 
	</td>
</tr>
<tr><td class="td27" colspan="2">发帖框初始值:</td></tr>
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
			<input type="submit" value="提交" title="按 Enter 键可随时提交你的修改" name="editsubmit" id="submit_editsubmit" class="btn">
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


