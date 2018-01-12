<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
		<div class="avatar-box">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="user-avatar" target="_blank" rel="nofollow"><?php echo avatar($comment['authorid'], small); ?><span class="user-name"><?php echo $comment['author'];?></span>
</a>
</div>
<div class="comment-word">
<?php if($comment['starnum']) { ?>
<div class="rows-content row-color-1">
<div class="commAttr">
<i class="attrs-icon comm"></i>推荐
</div>
<div class="attrValues">
<div class="rating-level big-rating clist-rating">
<span class="score-value score-value-<?php echo $comment['starnum']*2; ?>">
<em></em>
</span>
<span>(<?php if($comment['starnum']==1) { ?>很差<?php } elseif($comment['starnum']==2) { ?>较差<?php } elseif($comment['starnum']==3) { ?>还行<?php } elseif($comment['starnum']==4) { ?>推荐<?php } elseif($comment['starnum']==5) { ?>力荐<?php } ?>)</span>
</div>
</div>
</div>
<?php } if($comment['extdata']) { ?>
<div class="rows-content row-color-2">
<div class="commAttr" style="padding:3px 4px">价格来源</div>
<div class="attrValues">
<p><?php $extdata = unserialize($comment['extdata']); echo $extdata['price'] ?></p>
</div>
</div>
<?php } if($comment['weakpoint']) { ?>
<div class="rows-content row-color-3">
<div class="commAttr">
<i class="attrs-icon note"></i>不足
</div>
<div class="attrValues">
<p><?php echo $comment['weakpoint'];?></p>
</div>
</div>
<?php } if($comment['goodpoint']) { ?>
<div class="rows-content row-color-4">
<div class="commAttr">
<i class="attrs-icon date"></i>优点
</div>
<div class="attrValues">
<p><?php echo $comment['goodpoint'];?></p>
</div>
</div>
<?php } ?>
<div class="rows-content row-color-5">
<div class="commAttr">
<i class="attrs-icon complex"></i>综合
</div>
<div class="attrValues">
<p><?php echo $comment['message'];?></p>
</div>
</div>
<?php if($comment['attachlist']) { ?>
<div class="rows-content row-color-6">
<div class="commAttr">
<i class="attrs-icon picture"></i>图片
</div>
<div class="attrValues">
<ul class="attrPic-list"><?php if(is_array($comment['attachlist'])) foreach($comment['attachlist'] as $item) { ?><li>
<a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="点击查看大图"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $comment['subject'];?>"></a>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
<div class="rows-content">
<div class="attrValues rows-detail">
<span class="rows-time"><?php echo dgmdate($comment['dateline']); ?></span>
<span class="rows-title"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $comment['tid'];?>" title="<?php echo $comment['subject'];?>" target="_blank"><?php echo cutstr($comment['subject'], 40); ?></a></span>
<div class="rows-praise">
<a href="javascript:void(0);" id="support_<?php echo $comment['pid'];?>" onclick="support(<?php echo $comment['pid'];?>);"><i class="rows-icon<?php if($comment['supports']) { ?> icon-praise<?php } ?>"></i>有用<em><?php if($comment['supports']) { ?>(<?php echo $comment['supports'];?>)<?php } ?></em></a>
</div>
</div>
</div>
<?php if($act=='showview' && $_G['adminid'] == 1) { include template('dianping/cplist_comment'); } ?>
</div>
<?php if($comment['rate']) { ?><span class="b8264icon"></span><?php } ?>
