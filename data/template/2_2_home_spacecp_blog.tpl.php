<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_blog', 'common/header');?><?php include template('common/header'); if($_GET['op'] == 'delete') { ?>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=blog&amp;op=delete&amp;blogid=<?php echo $blogid;?>">
<div class="popbox w450 textcenter">
<div class="dhinfo">
<span>ȷ��ɾ��ָ������־��?</span>
<em></em>
</div>
<div>
<button type="submit" name="btnsubmit" value="true" class="button_cancel"><strong>ȷ��</strong></button>
<?php if($_G['inajax']) { ?><input class="button_confirm" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" value="ȡ��" type="button"/><?php } ?>
</div>
</div>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
</form>
<?php } elseif($_GET['op'] == 'addoption') { ?>
<div class="popbox" style="width:410px;">
<div class="flb">
<div class="popbox_title clearfix">
<span>��������</span>			
<?php if($_G['inajax']) { ?><em onclick="blogCancelAddOption('<?php echo $_G['gp_oid'];?>');hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div>
<ul class="albumform">
<li>
<label style="width:110px;">���ƣ�</label>
<input type="text" name="newsort" id="newsort" value="" size="10" class="inputtext" style="width:150px;"/>
</li>				
<li>
<label style="width:110px;"></label>
<button type="button" name="btnsubmit" id="btnsubmit" value="true" class="button_confirm" onclick="if(jQuery('#newsort').val()==''){jQuery('.msg_tip').show();return false;}if(blogAddOption('newsort', '<?php echo $_G['gp_oid'];?>')){hideWindow('<?php echo $_G['gp_handlekey'];?>');jQuery('.msg_tip').hide();}"><strong>ȷ��</strong></button>
<span class="msg_tip" style="color:red;margin-left:10px;display:none;">����������Ϊ��</span>
</li>
</ul>
</div>
</div>
<script type="text/javascript">
jQuery(function(){					
jQuery('newsort').focus();
});		
</script>

<?php } elseif($_GET['op'] == 'edithot') { ?>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=blog&amp;op=edithot&amp;blogid=<?php echo $blogid;?>&amp;is_uc=1" onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');" id="edithotform_<?php echo $blogid;?>" name="edithotform_<?php echo $blogid;?>">
<div class="popbox" style="width:410px;">
<div class="flb">
<div class="popbox_title clearfix">
<span>�����ȶ�</span>			
<?php if($_G['inajax']) { ?><em onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');"></em><?php } ?>
</div>
</div>
<div>
<ul class="albumform">
<li>
<label>�µ��ȶȣ�</label>
<input type="text" name="hot" value="<?php echo $blog['hot'];?>" size="10" class="inputtext" style="width:150px;"/>
</li>				
<li>
<label></label>
<button type="submit" name="btnsubmit" value="true" class="button_confirm"><strong>ȷ��</strong></button>
</li>
</ul>
</div>
</div>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="hotsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<div id="return_<?php echo $_G['gp_handlekey'];?>" style="display:none;"></div>
</form>
<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?> (url, message, values) {
location.reload();
}
</script>
<?php } else { } include template('common/footer'); ?>