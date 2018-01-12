<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($list) { ?>
<ul>
    <?php if(is_array($list)) foreach($list as $v) { ?>     <li id="comments_<?php echo $v['cid'];?>">
        <div class="reply-misc-main">
            <a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="author-face">		
                <?php echo avatar($v[authorid],small); ?>                <?php echo $v['author'];?>
            </a>
            <span class="reply-cont"><?php echo $v['message'];?></span>
        </div>
     </li>
<?php } ?>
</ul>
<?php echo $multi;?>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function($) {	
//·ÖÒ³
jQuery("#commentsList .pg").addClass("gallery-reply-pager");
});
</script><?php output(); ?>