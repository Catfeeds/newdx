<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('misc_ajax', 'common/header');?><?php include template('common/header'); if($op == 'comment') { if(is_array($list)) foreach($list as $value) { include template('home/space_comment_li'); } } elseif($op == 'getfriendgroup') { ?>
<?php echo $group;?>
<?php } elseif($op == 'getfriendname') { ?>
<?php echo $groupname;?>

<?php } elseif($op == 'share') { if(is_array($list)) foreach($list as $value) { include template('home/space_share_li'); } } elseif($op == 'album') { ?>

<table cellspacing="0" cellpadding="0" width="100%">
<tr><?php if(is_array($piclist)) foreach($piclist as $key => $value) { ?><td><img src="<?php echo $value['pic'];?>" alt="" width="60" onclick="insertImage('<?php echo $value['bigpic'];?>');" style="cursor:pointer;" /></td>
<?php if($key%5==4) { ?></tr><tr><?php } } ?>
</tr>
</table>
<?php if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } } elseif($op == 'getreward') { if($rule['credit'] || $rule['experience']) { ?>
<div class="popupmenu_layer">
<p><?php echo $rule['rulename'];?></p>
<p class="btn_line">
<?php if($rule['credit']) { ?>积分 <strong>+<?php echo $rule['credit'];?></strong> <?php } if($rule['experience']) { ?>经验 <strong>+<?php echo $rule['experience'];?></strong> <?php } ?>
</p>
<?php if($rule['cyclenum']) { ?>
<p>
本周期内，你还有 <?php echo $rule['cyclenum'];?> 次机会
</p>
<?php } ?>
</div>
<?php } } elseif($op == 'district') { ?>
<?php echo $html;?>
<?php } include template('common/footer'); ?>