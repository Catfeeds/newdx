<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<a name="comment_anchor_<?php echo $comment['cid'];?>"></a>
<dl id="comment_<?php echo $comment['cid'];?>_li" class="ptm bbda cl" style="padding:0px 0px 0px 0px;">
<dt>
    <div style=" display:none;">
<?php if($comment['allowop']) { ?>
<span class="y xw0 xi2">
<a href="javascript:;" onclick="portal_comment_requote(<?php echo $comment['cid'];?>);">引用</a>
<?php if(($_G['group']['allowmanagearticle'] || $_G['uid'] == $comment['uid']) && $_G['groupid'] != 7) { ?>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=edit&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_edit" onclick="showWindow(this.id, this.href, 'get', 0);">编辑</a>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=delete&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<?php } ?>
</span>
<?php } ?>
    </div>
<?php if(!empty($comment['uid'])) { ?>
    
    	<div style=" width:59px; height:61px; padding:5px 0px 0px 5px; background:url(/template/8264/css/moban/1024news/images/touxiang.png) no-repeat;float:left;">
    	<?php if(!empty($comment['avatar'])) { ?><a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>" class="xi2 xw1" c="1"><?php echo $comment['avatar'];?></a><?php } ?>
        </div>
<div style="float:left; padding-left:10px; line-height:1.6; width:486px;">
        
        <div>
        <span style="float:left">
        
        <a href="home.php?mod=space&amp;uid=<?php echo $comment['uid'];?>" class="xi2 xw1" c="1" ><?php echo $comment['username'];?></a>
<?php } else { ?>
游客
<?php } ?>
<span class="xg1 xw0"><?php echo dgmdate($comment[dateline]); ?></span>
<?php if($comment['status'] == 1) { ?><b>(待审核)</b><?php } ?>
        </span>
        <?php if($comment['allowop']) { ?>
<span class="y xw0 xi2" style="float:right;">
<a href="javascript:;" onclick="portal_comment_requote(<?php echo $comment['cid'];?>);">引用</a>
<?php if(($_G['group']['allowmanagearticle'] || $_G['uid'] == $comment['uid']) && $_G['groupid'] != 7) { ?>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=edit&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_edit" onclick="showWindow(this.id, this.href, 'get', 0);">编辑</a>
<a href="portal.php?mod=portalcp&amp;ac=comment&amp;op=delete&amp;cid=<?php echo $comment['cid'];?>" id="c_<?php echo $comment['cid'];?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<?php } ?>
</span>
<?php } ?>
        <div style="clear:both"></div>
        </div>
        <div>
        <span><?php if($_G['adminid'] == 1 || $comment['uid'] == $_G['uid'] || $comment['status'] == 0) { ?><?php echo $comment['message'];?><?php } else { ?> 审核未通过<?php } ?></span>
        </div>
    	</div>
        <div style="clear:both"></div>
</dt>
<dd style="display:none;"><?php if($_G['adminid'] == 1 || $comment['uid'] == $_G['uid'] || $comment['status'] == 0) { ?><?php echo $comment['message'];?><?php } else { ?> 审核未通过<?php } ?></dd>
</dl>