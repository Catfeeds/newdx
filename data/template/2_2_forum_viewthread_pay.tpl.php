<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($thread['freemessage']) { ?>
<div id="postmessage_<?php echo $pid;?>"><?php echo $thread['freemessage'];?></div>
<?php } if(empty($_G['gp_archiver'])) { ?>
<div class="locked">
<a href="javascript:;" class="y viewpay" title="��������" onclick="showWindow('pay', 'forum.php?mod=misc&action=pay&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_from'])) { ?>&from=<?php echo $_G['gp_from'];?><?php } ?>')">��������</a>
<em class="right">
<?php if($thread['payers']) { ?>���� <?php echo $thread['payers'];?> �˹���&nbsp; <?php } ?>
</em>
<?php if($_G['forum_thread']['price'] > 0) { ?>��������������֧�� <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $thread['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?></strong> �������<?php } if($thread['endtime']) { ?><br />�����⹺���ֹ����Ϊ <?php echo $thread['endtime'];?>�����ں����<?php } ?>
</div>
</div>
<?php } else { if($thread['payers']) { ?>���� <?php echo $thread['payers'];?> �˹���&nbsp; <?php } if($_G['forum_thread']['price'] > 0) { ?>��������������֧�� <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $thread['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?></strong> �������<?php } if($thread['endtime']) { ?><br />�����⹺���ֹ����Ϊ <?php echo $thread['endtime'];?>�����ں����<?php } } ?>