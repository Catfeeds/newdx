<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('modcp_moderate_float', 'common/header');?><?php include template('common/header'); ?><div class="f_c">
<h3 class="flb">
<em id="return_mods">
<?php if($modact == 'delete') { ?>ɾ��<?php } elseif($modact == 'ignore') { ?>����<?php } elseif($modact == 'invalidate') { ?>���<?php } else { ?>ͨ��<?php } if($op == 'members') { ?>����û�<?php } elseif($op == 'threads') { ?>�������<?php } elseif($op == 'replies') { ?>��˻ظ�<?php } ?>
(<?php echo count($list); ?>)</em>
<span>
<?php if(!empty($_G['gp_infloat'])) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('mods')" title="�ر�">�ر�</a><?php } ?>
</span>
</h3>

<form id="moderateform" method="post" autocomplete="off" action="<?php echo $_G['config']['web']['forum'];?><?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&op=<?php echo $op;?>&modsubmit=yes&infloat=yes" onsubmit="ajaxpost('moderateform', 'return_mods', 'return_mods', 'onerror');return false;">
<div class="c">
<?php if($list) { ?>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="filter" value="<?php echo $filter;?>" />
<input type="hidden" name="modact" value="<?php echo $modact;?>" />
<?php if(!empty($_G['gp_infloat'])) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } if(is_array($list)) foreach($list as $id) { ?><input type="hidden" name="moderate[]" value="<?php echo $id;?>" />
<?php } ?>
<p>��������[��ѡ]: </p>
<p><textarea name="reason" cols="50" rows="3" class="pt mtn"></textarea></p>
<?php } else { ?>
��û��ѡ���κ����ݣ��뷵��
<?php } ?>
</div>
<p class="o">
<button type="submit" name="modsubmit" id="modsubmit" class="pn pnc" value="true" tabindex="2"><strong>�ύ</strong></button>
<?php if($op=='members') { ?> <input type="checkbox" name="sendemail" id="sendemail" class="pc" value="1" /> <label for="sendemail">�� Email ֪ͨ������û�</label><?php } ?>
</p>
</form>
</div>

<script type="text/javascript" reload="1">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(locationhref) {<?php if(is_array($list)) foreach($list as $id) { ?>$('pidcheck_<?php echo $id;?>').parentNode.removeChild($('pidcheck_<?php echo $id;?>'));
$('pid_<?php echo $id;?>').style.display = 'none';
<?php } ?>
recountobj();
hideWindow('mods');
}
</script><?php include template('common/footer'); ?>