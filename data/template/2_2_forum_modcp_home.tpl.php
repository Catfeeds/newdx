<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="bm bw0 mdcp">
<h1 class="mt">�ڲ�����</h1>
<form method="post" autocomplete="off" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>" id="list_adminnote">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="op" value="addnote" />
<div class="exfm">
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td rowspan="2" width="75%"><textarea name="newmessage" class="pt" rows="5" style="width: 95%; height: 120px;"></textarea></td>
<td width="25%">
<ul>
<li>���Ը�:</li>
<li><label><input type="checkbox" name="newaccess[1]" class="pc" value="1" checked="checked" disabled="disabled" /> ��̳����Ա</label></li>
<li><label><input type="checkbox" name="newaccess[2]" class="pc" value="1" checked="checked" /> ��������</label></li>
<li><label><input type="checkbox" name="newaccess[3]" class="pc" value="1" checked="checked" /> ����</label></li>
</ul>
</td>
</tr>
<tr>
<td>
<p>��Ч��:
<input type="text" id="newexpiration" name="newexpiration" autocomplete="off" value="30" class="px" tabindex="1" size="2" /> ��
</p>
</td>
</tr>
<tr>
<td colspan="2"><button type="submit" class="pn" name="submit" value="true"><strong>�������</strong></button></td>
</tr>
</table>
</div>
</form>

<h2 class="bbs pbm ptm">�����б�</h2>
<?php if($notelist) { ?>
<form method="post" autocomplete="off" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>" name="notelist" id="notelist">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="op" value="delete" />
<input type="hidden" name="notlistsubmit" value="yes" /><?php if(is_array($notelist)) foreach($notelist as $note) { ?><div class="um">
<p class="pbn"><span class="y">(��Ч��: <?php echo $note['expiration'];?> ��)</span><?php echo $note['checkbox'];?> <span class="xi2"><?php echo $note['admin'];?></span> <span class="xg1"><?php echo $note['dateline'];?></span></p>
<p><?php echo $note['message'];?></p>
</div>
<?php } ?>
<div class="um bw0 cl">
<input type="checkbox" name="ncheck" id="ncheck" class="pc" onclick="checkall($('notelist'), 'delete', 'ncheck')" /> <label for="ncheck">ȫѡ</label>
<button type="submit" name="submit" id="submit" class="pn" value="true"><strong>ɾ��</strong></button>
</div>
</form>
<?php } else { ?>
<p class="emp">��ǰû��������</p>
<?php } ?>
</div>