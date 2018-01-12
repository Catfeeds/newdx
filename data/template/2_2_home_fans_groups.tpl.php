<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('groups', 'common/header_8264_new');?><?php include template('common/header_8264_new'); if(!$_G['gp_is_uc']) { ?>
<link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css" />
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">关注分组</em>
<span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span>
</h3>
<form method="post" autocomplete="off" id="changegroupform_<?php echo $uid;?>" name="changegroupform_<?php echo $uid;?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=<?php echo $uid;?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<input type="hidden" name="changegroupsubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<p>关注分组</p>
<table><tr><?php $i=0; if(is_array($groups)) foreach($groups as $key => $value) { ?><td style="padding:8px 8px 0 0;"><label><input type="radio" name="group" value="<?php echo $key;?>" <?php if($key == $selected_group) { ?>checked="checked"<?php } ?>><?php echo $value;?></label></td>
<?php if($i%2==1) { ?></tr><tr><?php } ?><?php $i++; } ?>
</tr></table>
</div>
<p class="o pns">
<button type="submit" name="changegroupsubmit_btn" class="pn pnc" value="true"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
jQuery("#group_name_" + values.uid).html(values.gname);
}
</script>
<?php } else { ?>	
<form method="post" autocomplete="off" id="changegroupform_<?php echo $uid;?>" name="changegroupform_<?php echo $uid;?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=<?php echo $uid;?>&amp;is_uc=1" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<div class="popbox" style="width:380px;">
<div class="flb">
<div class="popbox_title clearfix">
<span>关注分组</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div>
<ul class="followgroupform">
<li><?php $i=0; if(is_array($groups)) foreach($groups as $key => $value) { ?><label><input type="radio" name="group" value="<?php echo $key;?>" <?php if($key == $selected_group) { ?>checked="checked"<?php } ?>>&nbsp;<?php echo $value;?></label><?php $i++; } ?>	
</li>	
<li>					
<button type="submit" name="changegroupsubmit_btn" value="true" class="button_confirm">确定</button>
</li>
</ul>
</div>
<div style="clear:both;"></div>
</div>

<input type="hidden" name="changegroupsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>
</form>
<?php } include template('common/footer_8264_new'); ?>