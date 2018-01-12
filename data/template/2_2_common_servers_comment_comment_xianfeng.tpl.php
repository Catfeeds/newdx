<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="newcomment cid_<?php echo $comment['cid'];?>">
<div class="pinglun1">
<?php if($commentlist) { if(is_array($commentlist)) foreach($commentlist as $cm) { ?><div class="pinglunup">
<div class="touimg"><a href="<?php echo $_G['config']['web']['home'];?>space-uid-<?php echo $cm['authorid'];?>.html" target="_blank"><?php echo $cm['avatar'];?></a></div>
<div class="info"><?php echo $cm['message'];?></div>
</div>
<?php } } ?>
<div class="pinglundown">
<p id="postreturn_<?php echo $comment['tid'];?>"></p>
        <div class="pinglunmore"><a href="http://bbs.8264.com/thread-<?php echo $comment['tid'];?>-1-1.html" target="_blank">更多回复</a></div>
<form id="commentform_<?php echo $comment['tid'];?>" onsubmit="comment_validate(this ,'<?php echo $comment['tid'];?>', '<?php echo $comment['cid'];?>');return false;" name="replyform_<?php echo $comment['tid'];?>" autocomplete="off" action="forum.php?mod=post&amp;infloat=yes&amp;action=reply&amp;fid=<?php echo $commentfid;?>&amp;extra=&amp;tid=<?php echo $comment['tid'];?>&amp;replysubmit=yes&amp;handlekey=fastpost" method="post">
<textarea name="message" cols="" rows="" title="请输入您的评论" class="textarea5_5" id="message_<?php echo $comment['tid'];?>" onkeydown="ctrlEnter(event, 'commentsubmit_btn');"></textarea><input name="commentsubmit_btn" id="postsubmit_<?php echo $comment['tid'];?>" type="submit" value="回复"class="hfbutton" />
<input id="formhash" type="hidden" value="<?php echo $_G['formhash'];?>" name="formhash" fwin="reply"/>
<input type="hidden" value="reply" name="handlekey"/>
<input type="hidden" value="" name="noticeauthor"/>
<input type="hidden" value="" name="subject"/>
<input type="hidden" value="" name="noticetrimstr"/>
<input type="hidden" value="" name="noticeauthormsg"/>
<input type="hidden" value="" name="portal_referer"/>
</form>
</div>
</div>
</div>