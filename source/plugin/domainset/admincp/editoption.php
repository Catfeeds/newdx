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
		cpmsg('�����ַ����ֹ��', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}
	
	if(strpos($req,"http://")!==false||strpos($res,"http://")!==false)
	{
		cpmsg('����д����http��//����ַ��', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}
	
	//�ж������ַ����ת��ַ�Ƿ�Ϊ��
	if(empty($req) || empty($res)) {
		cpmsg('�����ַ����ת��ַ����Ϊ�գ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}	
	// �ж������ַ����ת��ַ��ͬ
	if($req==$res) {
		cpmsg('�����ַ����ת��ַ������ͬ��', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}
	//1����ѡ�����������е�ַ����תʱ�ж�����
	if($fs==1){
		if(strpos($req,"/"))
		{
			cpmsg('����д������/��������������', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
		}
			 
	}
	//2���ж���ת��ַ�����������ظ�
	/*if(strpos($res,"/")!==false) {
		$rs=substr($res, 0, strpos($res,"/"));
	} else {
		$rs= $res;
	} 
	$query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." where reqaddress='{$rs}'");
	if($query){
		cpmsg('��ת��ַ�����������ظ���', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 	 
	}*/
    //3���ж���ת��ַ�������ַ��	
	$query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." where reqaddress='{$res}'");
	if($query){
	      cpmsg('��ת��ַ�Ѿ������������£�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 		   	
	}	
	//5���ж������ַ����ת��ַ�Ƿ��ظ�	
	$query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domainset')." where resaddress='{$req}'");
	if($query){	
		cpmsg('�����ַ������������ת��ַ�ظ���', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain&op=editop&opid='.$id, 'error'); 			
	}
	memory('rm','domainset_indomain');
	DB::query("UPDATE ".DB::table('plugin_domainset')."
			   SET reqaddress = '{$req}',
				   resaddress = '{$res}',
				   method = '{$fs}'
			   WHERE id = {$id}");
	cpmsg('�޸����óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=domainset&pmod=domain', 'succeed');
}

?>

<form action="" method="post">
<?php showtableheader(); ?>
<tr><th class="partition" colspan="15">�޸�����</th></tr>
<tr><td class="td27" colspan="2">��������:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="req" class="txt" id="" value="<?php echo $option['reqaddress']; ?>" />
	</td>
	<td class="vtop tips2">
		���磺tj.<?php echo $_G['setting']['domain']['root']['forum']; ?>&nbsp;&nbsp;(ע�ⲻҪ���http://)
	</td>
</tr>
<tr><td class="td27" colspan="2">��ת��ַ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="text" name="res" class="txt" id="" value="<?php echo $option['resaddress']; ?>" />
	</td>
	<td class="vtop tips2">
    ���磺tj.<?php echo $_G['setting']['domain']['root']['forum']; ?>&nbsp;&nbsp;(ע�ⲻҪ���http://)
		<input type="hidden" name="id" class="txt" id="" value="<?php echo $option['id']; ?>" />
	</td>
</tr>

<tr><td class="td27" colspan="2" style="display:none">��ת��ʽ:</td></tr>
<tr class="noborder">
	<td class="vtop rowform" style="display:none">
		<ul onmouseover="altStyle(this);">        
         <!--   <li <?php if ($option['method']==0) {?> class="checked"<?php } ?>><input type="radio" value="0" name="fs" class="radio" <?php if ($option['method']==0) {?> checked="checked"<?php } ?>>&nbsp;��������ת����һ��</li> !-->
			<li <?php if ($option['method']==1) {?> class="checked"<?php } ?>><input type="radio" value="1" name="fs" class="radio" <?php if ($option['method']==1) {?> checked="checked"<?php } ?>>&nbsp;�����������е�ַ��ת</li>			
		</ul>
	</td>
	<td class="vtop tips2">
		ע�⣺<?php echo $_G['setting']['domain']['app']['portal']."��".$_G['setting']['domain']['app']['forum']."��".$_G['setting']['domain']['app']['home']; ?>Ϊϵͳ������ַ�����õ�ַ��������ӣ�
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