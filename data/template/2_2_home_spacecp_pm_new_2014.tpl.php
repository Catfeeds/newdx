<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_pm_new_2014', 'home/space_notice_new_header');
0
|| checktplrefresh('./template/8264/home/spacecp_pm_new_2014.htm', './template/8264/common/seditor_new_2014.htm', 1509432681, '2', './data/template/2_2_home_spacecp_pm_new_2014.tpl.php', './template/8264', 'home/spacecp_pm_new_2014')
;?><?php include template('home/space_notice_new_header'); ?><!--发送消息开始-->
<div class="form-box profile" id="pm_n_p">
<div class="info-hd">
<span>发送短消息</span>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=smessage" class="bluefs"><<我的短消息</a>
</div>
<div class="info-bd">
<form id="pmform_<?php echo $pmid;?>" name="pmform_<?php echo $pmid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=pm&amp;op=send&amp;touid=<?php echo $touid;?>&amp;pmid=<?php echo $pmid;?>" onsubmit="parsepmcode(this);<?php if($_G['inajax']) { ?>ajaxpost(this.id,  'return_<?php echo $_G['gp_handlekey'];?>');<?php } ?>">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="pmsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<table class="setting-continfo-table">
<tr>
<th><label for="">收件人：</label></th>
<td><input type="text" id="username" name="username" placeholder="" class="w496" value="<?php echo $msguser;?>"></td>
</tr>
<tr>
<th><label for="">写消息：</label></th>
<td>
<!--写消息框开始-->
<div id="f_pst" class="pingluncon pinglunco_xx">

<div class="pinglun">
<div class="pinglunmid pinglunmid_xx">
<div class="edierbar clboth"><?php $seditor = array('send', array('bold', 'color', 'smilies', 'simpleupload')); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?>>Image</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('simpleupload', $seditor['1'])) { ?>
<div class="bq_fjimg" id="uploadpic">
<a href="javascript:;" class="fjimg"></a>
</div><?php require_once libfile('class/simpleupload'); ?><?php $flashstring = simpleUpload::getFlashStr("uploadpic", 24, 23); ?><?php echo $flashstring;?>
<script>
function flashcallback(type, data){
eval("var objbtn = " + data);
switch(type){
case -1:
//alert(objbtn.text);
break;
case 1:
//alert(objbtn.text);alert(objbtn.picurl);
jQuery("#<?php echo $seditor['0'];?>message").val(jQuery("#<?php echo $seditor['0'];?>message").val() + "[img]" + objbtn.picurl + "[/img]");
break;
}
}
</script>
<?php } ?></div>
<div class="areatext areatext_xx">
<textarea rows="8" cols="40" name="message" class="pt" id="sendmessage" onkeydown="ctrlEnter(event, 'pmsubmit_btn');"></textarea>
</div>
</div>
<button type="submit" name="pmsubmit_btn" id="pmsubmit_btn" value="true" class="kshf">发送</button>
</div>

</div>
<!--写消息框结束-->
</td>
</tr>									
</table>
</form>
</div>
</div>
<!--发送消息结束--><?php include template('home/space_notice_new_footer'); ?>