<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');
require_once libfile('function/admincp');

$optionid = $_GET['opid'];
$option = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." WHERE id = {$optionid}");



if (!empty($_POST)) {
	$req = $_POST['req'];
	$res = $_POST['res'];
	$id = $_POST['id'];
	$fs = 1;
	$array=array("1"=>$_G['setting']['domain']['app']['portal'],"2"=>$_G['setting']['domain']['app']['forum'],"3"=>$_G['setting']['domain']['app']['home']);
	if(in_array($req,$array)){		
		cpmsg('请求地址被禁止！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}
	
	if(strpos($req,"http://")!==false||strpos($res,"http://")!==false)
	{
		cpmsg('请填写不含http：//的网址！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}
	
	//判断请求地址和跳转地址是否为空
	if(empty($req) || empty($res)) {
		cpmsg('请求地址与跳转地址不能为空！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}	
	// 判断请求地址与跳转地址相同
	if($req==$res) {
		cpmsg('请求地址与跳转地址不能相同！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}
	//1、当选择域名下所有地址都跳转时判断域名
	if($fs==1){
		if(strpos($req,"/"))
		{
			cpmsg('请填写不带“/”的请求域名！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
		}
			 
	}
	//2、判断跳转地址与已有域名重复
	/*if(strpos($res,"/")!==false) {
		$rs=substr($res, 0, strpos($res,"/"));
	} else {
		$rs= $res;
	} 
	$query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." where reqaddress='{$rs}'");
	if($query){
		cpmsg('跳转地址与已有域名重复！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}*/
    //3、判断跳转地址在请求地址下	
	$query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." where reqaddress='{$res}'");
	if($query){
	      cpmsg('跳转地址已经在请求域名下！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 		   	
	}	
	//5、判断请求地址与跳转地址是否重复	
	$query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." where resaddress='{$req}'");
	if($query){	
		cpmsg('请求地址不能与已有跳转地址重复！', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 			
	}
	memory('rm','domainset_indomain');
	DB::query("UPDATE ".DB::table('plugin_domainset')."
			   SET reqaddress = '{$req}',
				   resaddress = '{$res}',
				   method = '{$fs}'
			   WHERE id = {$id}");
	cpmsg('修改设置成功', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain', 'succeed');
}

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">修改设置</th></tr>
<tr><td class="td27" colspan="2">请求域名:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="req" class="txt" id="" value="<?php echo $option['reqaddress']; ?>" />
	</td>
	<td class="vtop tips2">
		例如：tj.<?php echo $_G['setting']['domain']['root']['forum']; ?>&nbsp;&nbsp;(注意不要添加http://)
	</td>
</tr>
<tr><td class="td27" colspan="2">跳转地址:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="res" class="txt" id="" value="<?php echo $option['resaddress']; ?>" />
	</td>
	<td class="vtop tips2">
    例如：tj.<?php echo $_G['setting']['domain']['root']['forum']; ?>&nbsp;&nbsp;(注意不要添加http://)
		<input type="hidden" name="id" class="txt" id="" value="<?php echo $option['id']; ?>" />
	</td>
</tr>

<tr><td class="td27" colspan="2" style="display:none">跳转方式:</td></tr>
<tr class="noborder">
	<td class="vtop rowform" style="display:none">
		<ul onmouseover="altStyle(this);">        
         <!--   <li <?php if ($option['method']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="fs" class="radio" <?php if ($option['method']==0) {?> checked="checked"<?php } ?>>&nbsp;仅域名跳转（单一）</li> !-->
			<li <?php if ($option['method']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="fs" class="radio" <?php if ($option['method']==1) {?> checked="checked"<?php } ?>>&nbsp;该域名下所有地址跳转</li>			
		</ul>
	</td>
	<td class="vtop tips2">
		注意：<?php echo $_G['setting']['domain']['app']['portal']."、".$_G['setting']['domain']['app']['forum']."、".$_G['setting']['domain']['app']['home']; ?>为系统请求网址的内置地址，请勿添加！
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