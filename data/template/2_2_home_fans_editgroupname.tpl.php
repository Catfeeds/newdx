<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('editgroupname', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css" />
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">关注组</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<div id="__groupnameform_<?php echo $group;?>">
<form method="post" autocomplete="off" id="groupnameform_<?php echo $group;?>" name="groupnameform_<?php echo $group;?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=editgroupname&amp;group=<?php echo $group;?>" 
onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<input type="hidden" name="groupnamesubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<p>设置新关注分组名</p>
<p class="mtm">新名称:<input type="text" name="groupname" value="<?php echo $groups[$group];?>" size="15" class="px" /></p>
</div>
<p class="o pns">
<button type="submit" name="groupnamesubmit_btn" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
jQuery("li[groupid=" + values.gid + "] a").text(values.gname);
 //have not changed the group name in the 'following list', it should refresh
}
</script>
</div><?php include template('common/footer_8264_new'); ?>