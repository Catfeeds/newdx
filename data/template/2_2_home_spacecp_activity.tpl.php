<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_activity', 'common/header');?><?php include template('common/header'); if($_GET['op'] == 'delete') { ?>
<form method="post" autocomplete="off" action="forum.php?mod=misc&amp;action=activityapplies&amp;tid=<?php echo $tid;?>&amp;is_uc=1" onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');" id="activitynoshowform_<?php echo $tid;?>">
<div class="popbox w450 textcenter">
<div class="dhinfo">
<span>确认删除这个活动？删除后将不再显示！</span>
<em></em>
</div>
<div>
<button type="submit" name="btnsubmit" value="true" class="button_cancel"><strong>确定</strong></button>
<?php if($_G['inajax']) { ?><input class="button_confirm" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" value="取消" type="button"/><?php } ?>
</div>
</div>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="activitynoshow" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<span id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></span>		
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
jQuery('#acitivity_<?php echo $tid;?>').remove();
}
</script>
<?php } include template('common/footer'); ?>