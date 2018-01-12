<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<li <?php if($value['msgfromid'] == $_G['uid']) { ?>class="mytalk"<?php } else { ?>class="othertalk"<?php } ?>>
<?php if($value['msgfromid']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $value['msgfromid'];?>" <?php if($value['msgfromid'] == $_G['uid']) { ?>class="tx_l"<?php } else { ?>class="tx_r"<?php } ?>><?php echo avatar($value[msgfromid],small); ?></a>
<?php } else { ?>
<a href="javascript:;" class="rwtx"></a>
<?php } ?>
<div class="<?php if($value['msgfromid'] == $_G['uid']) { ?>mytalk_con<?php } else { ?>othertalk_con<?php } ?>">
<p><?php echo $value['message'];?></p>
<span><?php echo dgmdate($value[dateline], 'u'); ?></span>
</div>
</li>