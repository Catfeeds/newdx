<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('topicadmin_getip', 'common/header');?><?php include template('common/header'); ?><b><?php echo $member['useip'];?></b> <?php echo $member['iplocation'];?>
<?php if($_G['group']['allowviewip']) { ?>
<br /><a href="admin.php?action=members&amp;operation=ipban&amp;ip=<?php echo $member['useip'];?>&amp;frames=yes" target="_blank" class="xg2">ฝ๛ึนดห IP</a>
<?php } include template('common/footer'); ?>