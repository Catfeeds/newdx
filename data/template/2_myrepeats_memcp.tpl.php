<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=plugin&amp;id=myrepeats:memcp&amp;pluginop=add">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<p class="tbmu">�������˺�</p>
<table cellspacing="0" cellpadding="0" class="tfm" style="table-layout:fixed;margin-top:10px;">
<tbody>
<tr><td class="mtm pns">
<p>
<?php if(!$singleprem) { ?>
�û��� <input name="usernamenew" type="text" class="px" value="<?php echo $username;?>" style="width:100px" tabindex="1" />&nbsp;
<?php } else { ?>
�û��� <select name="usernamenew"><?php if(is_array($permusers)) foreach($permusers as $user) { ?><option value="<?php echo $user;?>"<?php if($user == $username) { ?> selected<?php } ?>><?php echo $user;?></option>
<?php } ?>
</select>
<?php } ?>
���� <input name="passwordnew" type="password" class="px" style="width:100px" tabindex="2" />
<select name="questionidnew" tabindex="3" onchange="if(this.value > 0) {$('answernew').style.display='';} else {$('answernew').style.display='none';}">
<option value="0">��ȫ����</option>
<option value="1">ĸ�׵�����</option>
<option value="2">үү������</option>
<option value="3">���׳����ĳ���</option>
<option value="4">������һλ��ʦ������</option>
<option value="5">�����˼�������ͺ�</option>
<option value="6">����ϲ���Ĳ͹�����</option>
<option value="7">��ʻִ�յ������λ����</option>
</select>
<span id="answernew" style="display:none">�ش� <input type="text" name="answernew" class="px" style="width:100px" class="txt" tabindex="4" /></span>
<br /><br />
<p>
����ע <input name="commentnew" class="px" type="text" size="40" tabindex="5" />&nbsp;
<button type="submit" class="pn" name="adduser" value="yes" ><span>���</span></button>
</p>
</td></tr>
</tbody>
</table>
</form>
<form method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=plugin&amp;id=myrepeats:memcp&amp;pluginop=update">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<table cellspacing="0" cellpadding="0" class="tfm" style="table-layout:fixed;margin-top:10px;">
<thead class="alt">
<tr><td width="40"></td><td>�û���</td><td width="300">��ע</td><td>����л�ʱ��</td></tr>
</thead>
<?php if($repeatusers) { if(is_array($repeatusers)) foreach($repeatusers as $user) { ?><tr>
<td><input name="delete[]" type="checkbox" class="checkbox" value="<?php echo $user['username'];?>" /></td>
<td><b><?php if(!$user['locked']) { ?><a href="plugin.php?id=myrepeats:switch&amp;username=<?php echo $user['usernameenc'];?>&amp;formhash=<?php echo FORMHASH;?>"><?php echo $user['username'];?></a></b><?php } else { ?><?php echo $user['username'];?> (������Ա����)<?php } ?></td>
<td><input name="comment[<?php echo $user['username'];?>]" class="px" value="<?php echo $user['comment'];?>" size="40" /></td>
<td><?php if($user['lastswitch']) { ?><?php echo $user['lastswitch'];?><?php } else { ?>��δʹ��<?php } ?></td>
</tr>
<?php } ?>
<tr><td><input class="checkbox" type="checkbox" id="chkall" name="chkall" onclick="checkall(this.form);" /> <label for="chkall">ɾ?</label></td>
<td class="mtm pns"><button type="submit" class="pn" name="updateuser" value="yes" ><span>�ύ</span></button></td></tr>
<?php } ?>
</table>
</form>