<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('comment_more_2014', 'common/header');?><?php include template('common/header'); if($comments) { ?>
<ul class="dplistcon"><?php if(is_array($comments)) foreach($comments as $comment) { ?><li id="comments_<?php echo $comment['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="tximg" c="1"><?php echo $comment['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="name"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $comment['comment'];?></span>
</span>
<?php if($comment['forpid'] <> 0) { ?>
<span class="second" style="display:none;">
                  <a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;postid=<?php echo $comment['pid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $comment['forpid'];?>&amp;cid=<?php echo $comment['id'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=commentreply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
                  <a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $comment['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<?php } ?>
<span class="hfreveiw">
<span class="time"><?php echo $comment['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_comreply('delcomment', <?php echo $comment['id'];?>,'','',<?php echo count($comment['replyComment']) ?>);"></a>
<?php } ?>
</span>
</li>
<?php if(!empty($comment['replyComment'])) { if(is_array($comment['replyComment'])) foreach($comment['replyComment'] as $reply) { ?><li id="comments_<?php echo $reply['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="tximg" c="1"><?php echo $reply['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="name"><?php echo $reply['author'];?></a>
<span class="hf">回复</span>
<a href="#" target="_blank" class="name_second"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $reply['comment'];?></span>
</span>
<span class="second" style="display:none;">
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $reply['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<span class="hfreveiw">
<span class="time"><?php echo $reply['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_delcomreply('delcomment', <?php echo $part['id'];?>,'','',<?php echo $comment['pid'];?>)"></a>
<?php } ?>
</span>
</li>
<?php } } } ?>
</ul>
<div class="dpfy clboth"><?php echo $multi;?></div>
<?php } include template('common/footer'); ?>