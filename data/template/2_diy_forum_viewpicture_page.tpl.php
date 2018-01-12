<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($comments) { ?>
<ul><?php if(is_array($comments[$forum_post['pid']])) foreach($comments[$forum_post['pid']] as $comment) { ?><li id="comments_<?php echo $comment['id'];?>">
                  <div class="reply-misc-main">
                      <a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="author-face" c="1">		
                          <?php echo $comment['avatar'];?>
                          <?php echo $comment['author'];?>
                      </a>
                      <span class="reply-cont"><?php echo cutstr($comment['comment'],30,''); ?></span>
                  </div>
              
</li>				
  <?php if(!empty($comment['replyComment'])) { ?>
      <?php if(is_array($comment['replyComment'])) foreach($comment['replyComment'] as $reply) { ?>       <li id="comments_<?php echo $reply['id'];?>">
                  <div class="reply-misc-main">
                      <a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="author-face" c="1">		
                          <?php echo $reply['avatar'];?>
                          <?php echo $reply['author'];?>
                      </a>
                      <span class="reply-cont"></span>
                      <span class="reply-date"><?php echo $reply['dateline'];?></span>
                  </div>
              
        </li>
      <?php } ?>
  <?php } } ?>
</ul>
<?php echo $multipage;?>
<?php } ?><?php output(); ?>