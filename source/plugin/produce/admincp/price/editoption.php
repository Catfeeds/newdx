<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/produce/common.php';
require_once DISCUZ_ROOT.'/source/plugin/forumoption/produce.php';

if (!empty($_POST)) {
	
	if($_POST['id']){
	$optionid = $_POST['id'];	
	$reason=mb_convert_encoding($_POST['reason'],'GBK','UTF-8');
	$issend=$_POST['issendmsg'];
	$price=DB::fetch_first("SELECT * FROM ".DB::table('plugin_produce_price')." WHERE id = {$optionid}");
	if($issend){		
		$thread=ForumOptionProduce::getTheardBytId($price['tid']);		
		$message = '���ļ۸��� <a href="'.$_G['config']['web']['portal'].'zb-'.$thread[tid].'" target="_blank">'.$thread[subject].'</a> �� ����Ա ɾ�� <div class="quote"><blockquote>'.$reason.'</blockquote></div>';		
		 notification_add($price['uid'], 'system', 'system_notice', array('subject' => '�û����ã�', 'message' => $message), 0); 	
	}
	DB::query("update ".DB::table('plugin_produce_price')." set deletereason ='$reason', isdelete = 1 WHERE id = ".$optionid);
	//ɾ���۸���ֲ���
	ForumOptionProduce::calPostRankEvent($price['tid'],6);
	$threads=ForumOptionProduce::getTheardBytId($price['tid']);
	ForumOptionProduce::calPublisherRankEvent($threads['authorid'],$threads['author'],3);
	cpmsg('���óɹ�', 'action=plugins&operation=config&do='.$pluginid.'&identifier=produce&pmod=admin_price', 'succeed');
	}
}

?>
<form action="" method="post">
<?php showtableheader(); ?>

<tr><th class="partition" colspan="15">��ѡ����һ���۸��¼</th></tr>
<tr><td class="td27" colspan="2">��ȷ��ɾ����</td></tr>
<tr><td class="td27" colspan="2">ɾ��ԭ��:</td></tr>
<tr class="noborder">
	<td class="vtop rowform">
			<textarea class="tarea" cols="30"  name="reason" rows="6"></textarea>
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
	</td>
</tr>
<tr class="noborder">
	<td class="vtop rowform">
		<input type="checkbox" name="issendmsg" value="1"/>֪ͨ����
	</td>
</tr>
<tr>
	<td colspan="15">
		<div class="fixsel">
			<input type="submit" value="�ύ" title="�� Enter ������ʱ�ύ����޸�" name="editsubmit" id="submit_editsubmit" class="btn">
		</div>
	</td>
</tr>
<?php showtablefooter();?>
</form>