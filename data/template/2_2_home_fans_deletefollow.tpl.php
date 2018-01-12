<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('deletefollow', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><form id="deletefollowform_<?php echo $uid;?>" name="deletefollowform_<?php echo $uid;?>" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=friend&amp;op=ucignore&amp;uid=<?php echo $uid;?>&amp;is_uc=1" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>		
<div class="popbox w450 textcenter">			
<div class="dhinfo">
<span>确认取消关注<?php echo $tospace['username'];?>吗?</span>
<em></em>
</div>
<div>
<button type="submit" name="deletefollowsubmit" value="true" class="button_cancel"><strong>确定</strong></button>
<?php if($_G['inajax']) { ?><input class="button_confirm" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" value="取消" type="button"/><?php } ?>
</div>			
</div>	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="deletefollowsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>		
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
location.reload();
}
</script><?php include template('common/footer_8264_new'); ?>