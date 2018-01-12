<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('add_follow', 'common/header_8264_new');?><?php include template('common/header_8264_new'); if(!$_G['gp_is_uc']) { ?>
<link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css" />
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">添加关注</em>
<span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span>
</h3>
<form method="post" autocomplete="off" id="addform_<?php echo $tospace['uid'];?>" name="addform_<?php echo $tospace['uid'];?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $tospace['uid'];?>" 
onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="addsubmit" value="true" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<table>
<tr>
<th valign="top" width="60" class="avt"><a href="home.php?mod=space&amp;uid=<?php echo $tospace['uid'];?>"><?php echo avatar($tospace[uid],small); ?></th>
<td valign="top">您将添加对<strong><?php echo $tospace['username'];?></strong>的关注<br />
<p class="mtm">
分组: <select name="gid" class="ps"><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><option value="<?php echo $key;?>" <?php if(empty($space['privacy']['groupname']) && $key==1) { ?> selected="selected"<?php } ?>><?php echo $value;?></option>
<?php } ?>
</select>
</p>
</td>
</tr>
</table>
</div>
<p class="o pns">
<button type="submit" name="addsubmit_btn" id="addsubmit_btn" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
</form>
<script type="text/javascript">
var handlekey = "<?php echo $_G['gp_handlekey'];?>";
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
var mutual = values.mutual;
var uid    = values.uid;
if(typeof callback_follow_successfully == 'function') {
callback_follow_successfully(mutual, uid);
return;
}
//	var uid = handlekey.replace('ajax_follow_me_', '');
if(mutual == 1) {
jQuery("a.ajax_follow_me[uid=" + uid + "]").attr("class", "friend-mutualed").off("click");
}else if(mutual == 2) {
jQuery("a.ajax_follow_me[uid=" + uid + "]").attr("class", "friend-mutual").text("相互关注").off("click");
}

}
</script>
<?php } else { ?>	
<form method="post" autocomplete="off" id="addform_<?php echo $tospace['uid'];?>" name="addform_<?php echo $tospace['uid'];?>" action="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $tospace['uid'];?>&amp;is_uc=1" onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');">
<div class="popbox" style="width:450px;">
<div class="flb">
<div class="popbox_title clearfix">
<span>添加关注</span>
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div class="addfollowform">
<div class="avatar"><a href="home.php?mod=space&amp;uid=<?php echo $tospace['uid'];?>"><?php echo avatar($tospace[uid],middle); ?></a></div>
<ul>
<li>
您将添加对<strong><?php echo $tospace['username'];?></strong>的关注
</li>					
<li>
分组: 
<select name="gid" style="1px solid #DFDFDF;"><?php if(is_array($groups)) foreach($groups as $key => $value) { ?><option value="<?php echo $key;?>" <?php if(empty($space['privacy']['groupname']) && $key==1) { ?> selected="selected"<?php } ?>><?php echo $value;?></option>
<?php } ?>
</select>					
</li>
<li>
<button type="submit" name="addsubmit" value="true" class="button_confirm" id="addsubmit">确定</button>
</li>
</ul>
</div>
<div style="clear:both;"></div>
</div>

<input type="hidden" name="addsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>		
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
location.reload();
}
</script>
<?php } include template('common/footer_8264_new'); ?>