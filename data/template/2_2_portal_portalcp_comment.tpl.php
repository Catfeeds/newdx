<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_comment', 'common/header');?><?php include template('common/header'); if($_GET['op'] != 'requote') { ?>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/portal_portalcp.css?<?php echo VERHASH;?>" />
<?php } if($_GET['op'] == 'requote') { ?>
[quote]<?php echo $comment['username'];?>: <?php echo $comment['message'];?>[/quote]

<?php } elseif($_GET['op'] == 'edit') { ?>

<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">�༭</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form id="editcommentform_<?php echo $cid;?>" name="editcommentform_<?php echo $cid;?>" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=comment&amp;op=edit&amp;cid=<?php echo $cid;?><?php if($_G['gp_modarticlecommentkey']) { ?>&amp;modarticlecommentkey=<?php echo $_G['gp_modarticlecommentkey'];?><?php } ?>">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="editsubmit" value="true" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="c">
<p>
<label for="message">�༭����: </label>
</p>
<textarea id="message_<?php echo $cid;?>" name="message" cols="70" onkeydown="ctrlEnter(event, 'editsubmit_btn');" rows="8" class="pt"><?php echo $comment['message'];?></textarea>
</div>
<p class="o pns">
<button type="submit" name="editsubmit_btn" id="editsubmit_btn" value="true" class="pn pnc"><strong>�ύ</strong></button>
</p>
</form>

<?php } elseif($_GET['op'] == 'delete') { ?>

<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">ɾ���ظ�</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="�ر�">�ر�</a></span><?php } ?>
</h3>
<form id="deletecommentform_<?php echo $cid;?>" name="deletecommentform_<?php echo $cid;?>" method="post" autocomplete="off" action="portal.php?mod=portalcp&amp;ac=comment&amp;op=delete&amp;cid=<?php echo $cid;?>">
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="deletesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<div class="c">ȷ��ɾ��ָ���Ļظ���</div>
<p class="o pns">
<button type="submit" name="deletesubmitbtn" value="true" class="pn pnc"><strong>ȷ��</strong></button>
</p>
</form>

<?php } include template('common/footer'); ?>