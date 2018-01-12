<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div id="<?php echo $type;?>_<?php echo $page;?>">
<ul class="post-list"><?php if(is_array($commentList)) foreach($commentList as $v) { ?><li class="pl-post">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-avatar"><?php echo avatar($v['authorid'], small); ?></a>							
<div class="pl-post-body">
<div class="pl-post-header">
<a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="pl-user"><?php echo $v['author'];?></a>
<!-- <span class="pl-time"><?php echo $v['dateline'];?></span> -->
<a href="javascript:void(0);" class="pl-btn-reply">回复</a>
</div>
<div class="pl-post-content">
<p><?php echo $v['message'];?></p>
</div>
<!--回复框-->
<form method="post" autocomplete="off" id="replyform_<?php echo $type;?>_<?php echo $v['pid'];?>" name="replyform_<?php echo $type;?>_<?php echo $v['pid'];?>" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $v['pid'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;replysubmit=yes&amp;infloat=yes" onsubmit="return commentPost(this.id, 'return_fastpost')">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="is_readmodel" value="1" />
<input type="hidden" name="handlekey" value="fastpost" />								
<!--<input type="hidden" value="reply" name="handlekey">-->
<input type="hidden" value="q|<?php echo $v['authorid'];?>|<?php echo $v['author'];?>" name="noticeauthor">
<input type="hidden" value="" name="noticetrimstr">
<input type="hidden" value="<?php echo $v['noticeauthormsg'];?>" name="noticeauthormsg">
<input type="hidden" value="<?php echo $v['pid'];?>" name="reppost">
<div class="pl-reply-box">
<div class="pl-reply-box-content textarea">
<textarea name="message"></textarea>
</div>
<div class="pl-reply-box-footer">
<button type="submit" class="pl-btn-submit" id="fastpostsubmit" style="cursor:pointer;">回复</button>		
</div>
</div>
</form>			
<!--回复框 end-->
</div>
<?php if(!empty($blockquote[$v['pid']])) { ?><?php $temp = $blockquote[$v[pid]]; ?><ul class="pl-post-children">
<li class="pl-post">
<div class="pl-post-body">
<div class="pl-post-header">
<?php echo $temp['message_quote_author'];?>
<!-- <span class="pl-time"><?php echo $temp['message_quote_dateline'];?></span> -->
</div>
<div class="pl-post-content">
<p><?php echo $temp['message_quote_content'];?></p>
</div>
</div>
</li>
</ul>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php if($multiComment) { ?><div class="art-page artComment-page"><?php echo $multiComment;?></div><?php } ?>
</div>