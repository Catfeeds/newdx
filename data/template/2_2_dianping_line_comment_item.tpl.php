<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
	<div class="avatar-box">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="user-avatar" target="_blank" rel="nofollow"><?php echo avatar($comment['authorid'], small); ?><span class="user-name"><?php echo $comment['author'];?></span>
</a>
</div>
<div class="comment-word">
<?php if($comment['starnum']) { ?>
        <div class="rows-content row-color-1">
            <div class="commAttr">
                <i class="attrs-icon comm"></i>�Ƽ�
            </div>
            <div class="attrValues">
                <div class="rating-level big-rating">
<span class="score-value score-value-<?php echo $comment['starnum']*2; ?>">
<em></em>
</span>
                    <span>(<?php if($comment['starnum']==1) { ?>ǧ���ȥ<?php } elseif($comment['starnum']==2) { ?>��ñ�ȥ<?php } elseif($comment['starnum']==3) { ?>һ���Ƽ�<?php } elseif($comment['starnum']==4) { ?>�ص��Ƽ�<?php } elseif($comment['starnum']==5) { ?>��Ѫ�Ƽ�<?php } ?>)</span>
                </div>
            </div>
        </div>
<?php } ?>

        <div class="rows-content row-color-2">
            <div class="commAttr">
                <i class="attrs-icon date"></i>ʱ��
            </div>
            <div class="attrValues">
                <?php if(floor(($comment['ext2']-$comment['ext1'])/86400)==0) { ?>
                <p><?php echo dgmdate($comment['ext1'], 'Y-m-d '); ?><?php echo $comment['ext4'];?>ʱ - <?php echo $comment['ext5'];?>ʱ  ����<?php echo $comment['ext5']-$comment['ext4'];?>Сʱ</p>
                <?php } else { ?>
                <p><?php echo dgmdate($comment['ext1'], 'Y-m-d '); ?> �� <?php echo dgmdate($comment['ext2'], 'Y-m-d'); ?> ��<?php echo floor(($comment['ext2']-$comment['ext1'])/86400); ?>��</p>
                <?php } ?>

            </div>
        </div>
        <div class="rows-content row-color-3">
            <div class="commAttr">
                <i class="attrs-icon price"></i>����
            </div>
            <div class="attrValues">
                <p><?php echo $comment['ext3'];?></p>
            </div>
        </div>
        <div class="rows-content row-color-4">
            <div class="commAttr">
                <i class="attrs-icon note"></i>ע��
            </div>
            <div class="attrValues">
                <p><?php echo $comment['weakpoint'];?></p>
            </div>
        </div>
        <div class="rows-content row-color-5">
            <div class="commAttr">
                <i class="attrs-icon complex"></i>�ۺ�
            </div>
            <div class="attrValues">
                <p><?php echo $comment['message'];?></p>
            </div>
        </div>
        <?php if($comment['attachlist']) { ?>
        <div class="rows-content row-color-6">
            <div class="commAttr">
                <i class="attrs-icon picture"></i>ͼƬ
            </div>
            <div class="attrValues">
                <ul class="attrPic-list">
                    <?php if(is_array($comment['attachlist'])) foreach($comment['attachlist'] as $item) { ?>                    <li>
                        <a href="http://<?php if($item['serverid']==1) { ?>image<?php } elseif($item['serverid']==99) { ?>image1<?php } ?>.8264.com/<?php echo $item['dir'];?>/<?php echo $item['attachment'];?>" target="_blank" title="����鿴��ͼ"><img src="<?php echo getimagethumb(80,80,2, $item['dir'].'/'.$item['attachment'], '', $item['serverid']); ?>" alt="<?php echo $mycomment['subject'];?>"></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
<div class="rows-content row-color-6">
<div class="attrValues rows-detail">
<span class="rows-time"><?php echo dgmdate($comment['dateline']); ?></span>
<span class="rows-title"><a href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $comment['tid'];?>" target="_blank"><?php echo $comment['subject'];?></a></span>
<?php if($_G['uid']!=$comment['authorid']) { ?>
<div class="rows-praise">
<a href="javascript:void(0);" id="support_<?php echo $comment['pid'];?>" onclick="support(<?php echo $comment['pid'];?>);"><i class="rows-icon<?php if($comment['supports']) { ?> icon-praise<?php } ?>"></i>����<em><?php if($comment['supports']) { ?>(<?php echo $comment['supports'];?>)<?php } ?></em></a>
</div>
<?php } ?>
</div>
</div>
<?php if($act=='showview' && ($_G['adminid'] == 1 || $_G['uid']==$comment['authorid'])) { include template('dianping/cplist_comment'); } ?>
</div>
<?php if($comment['rate']) { ?><span class="b8264icon"></span><?php } ?>

