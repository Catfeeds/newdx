<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!--<li class="list-comment-item" id="comment_<?php echo $value['cid'];?>_li">-->
<div class="comment-wrap">
<div class="user-info">
<a href="home.php?mod=space&amp;uid=<?php echo $value['authorid'];?>" class="avatar"><?php echo avatar($value[authorid],small); ?></a>
</div>
<div class="comment-info">
<div class="tit">
<span class="user-name">
<a href="home.php?mod=space&amp;uid=<?php echo $value['authorid'];?>" id="author_<?php echo $value['cid'];?>"><?php echo $value['author'];?></a>
</span>
<span class="comment-time"><?php echo date('Y-m-d H:i:s', $value['dateline']); ?></span>
<div class="comment-op-bar">
<?php if($value['authorid']==$_G['uid']) { ?>							
<a href="home.php?mod=spacecp&amp;ac=comment&amp;op=edit&amp;cid=<?php echo $value['cid'];?>&amp;handlekey=editcommenthk_<?php echo $value['cid'];?>" id="c_<?php echo $value['cid'];?>_edit" onclick="showWindow(this.id, this.href, 'get', 0);" class="delete">±à¼­</a>
<?php } if($value['authorid']==$_G['uid'] || $value['uid']==$_G['uid'] || checkperm('managecomment')) { ?>
<a href="home.php?mod=spacecp&amp;ac=comment&amp;op=delete&amp;cid=<?php echo $value['cid'];?>&amp;handlekey=delcommenthk_<?php echo $value['cid'];?>" id="c_<?php echo $value['cid'];?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);" class="delete">É¾³ý</a>
<?php } if($value['authorid']!=$_G['uid'] && ($value['idtype'] != 'uid' || $space['self'])) { if($_G['uid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=comment&amp;op=reply&amp;cid=<?php echo $value['cid'];?>&amp;feedid=<?php echo $feedid;?>&amp;handlekey=replycommenthk_<?php echo $value['cid'];?>" id="c_<?php echo $value['cid'];?>_reply" onclick="showWindow(this.id, this.href, 'get', 0);"  class="delete">
<?php } else { ?>
<a href="member.php?mod=logging&amp;action=login" class="delete">
<?php } ?>						
»Ø¸´
</a>
<?php } ?>
</div>
</div>
<table style="width:100%;">
<tbody>
<tr>
<td style="font-size:14px;"> 
<?php if($value['status'] == 0 || $value['authorid'] == $_G['uid'] || $_G['adminid'] == 1) { ?><?php echo $value['message'];?><?php } else { ?>ÉóºËÎ´Í¨¹ý<?php } ?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<!--</li>-->