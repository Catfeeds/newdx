<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_task_parter_2014', 'common/header');?>
<?php $_G[home_tpl_titles] = array('����'); include template('common/header'); ?><ul><?php if(is_array($parterlist)) foreach($parterlist as $parter) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $parter['uid'];?>" title="<?php if($parter['status'] == 1) { ?>�����<?php } elseif($parter['status'] == -1) { ?>ʧ�ܵ�����<?php } elseif($parter['status'] == 0) { ?>����� <?php echo $parter['csc'];?>%<?php } ?>" target="_blank" class="tximg48"><?php echo $parter['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $parter['uid'];?>" title="�鿴��ϸ����" target="_blank" class="idname"><?php echo $parter['username'];?></a>
</li>
<?php } ?>
</ul><?php include template('common/footer'); ?>