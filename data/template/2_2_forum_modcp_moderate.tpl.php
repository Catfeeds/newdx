<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script type="text/javascript">
modclickcount = 0;
function recountobj() {
modclickcount = 0;
var objform = $('moderate');
for(var i = 0; i < objform.elements.length; i++) {
if(objform.elements[i].name.match('moderate') && objform.elements[i].checked) {
modclickcount++;
}
}
$('modlayercount').innerHTML = modclickcount;
}
function modcheckall() {
var count = 0;
count = checkall($('moderate'), 'moderate', 'chkall');
$('modlayercount').innerHTML = count;
}
function toggle_post(id) {
var obj = $('list_note_' + id); 
obj.style.display='block'; 
obj.style.height = obj.style.height == '55px' ? 'auto' : '55px' ;
}
 function modthreads(operation) {
var checked = 0;
var operation = !operation ? '' : operation;
var objform = $('moderate');
for(var i = 0; i < objform.elements.length; i++) {
if(objform.elements[i].name.match('moderate') && objform.elements[i].checked) {
checked = 1;
break;
}
}
if(!checked) {
alert('����ѡ���������');
} else {
$('moderate').modact.value = operation;
$('moderate').infloat.value = 'yes';
showWindow('mods', 'moderate', 'post');
}
}
</script>

<div class="bm bw0 mdcp">
<h1 class="mt">���</h1>
<ul class="tb cl">
<?php if($_G['group']['allowmodpost']) { ?>
<li<?php if($op == 'threads') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=moderate&op=threads<?php echo $forcefid;?>" hidefocus="true">����</a></li>
<li<?php if($op == 'replies') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=moderate&op=replies<?php echo $forcefid;?>" hidefocus="true">�ظ�</a></li>
<?php } if($_G['group']['allowmoduser']) { ?>
<li<?php if($op == 'members') { ?> class="a"<?php } ?>><a href="<?php echo $cpscript;?>?mod=modcp&action=moderate&op=members" hidefocus="true">�û�</a></li>
<?php } ?>
</ul>

<?php if($op == 'threads' || $op == 'replies') { ?>
<div class="exfm">
<form method="post" autocomplete="off" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&op=<?php echo $op;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
<?php if($modforums['fids']) { ?>
<table cellspacing="0" cellpadding="0">
<tr>
<th width="10%">���ѡ��: </th>
<th width="40%">
<span class="ftid">
<select name="fid" id="fid" width="124" class="ps">
<option value="0">ȫ��</option><?php if(is_array($modforums['list'])) foreach($modforums['list'] as $id => $name) { ?><option value="<?php echo $id;?>" <?php if($id == $_G['fid']) { ?>selected<?php } ?>><?php echo $name;?></option>
<?php } ?>
</select>
</span>
</td>
<th width="10%">���ӷ�Χ: </th>
<td width="40%">
<span class="ftid">
<select name="filter" id="filter" width="124" class="ps">
<option value="0" <?php echo $filtercheck['0'];?>><?php if($op == 'replies') { ?>δ��˻ظ�<?php } else { ?>δ�������<?php } ?></option>
<option value="-3" <?php echo $filtercheck['-3'];?>><?php if($op == 'replies') { ?>�Ѻ��Իظ�<?php } else { ?>�Ѻ�������<?php } ?></option>
</select>
</span>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td colspan="3"><button type="submit" name="submit" id="searchsubmit" class="pn" value="true"><strong>�ύ</strong></button></td>
</tr>
</table>
<?php } else { ?>
<p class="emp">��û�й����κΰ���Ȩ�ޣ��޷�ִ�д˲���</p>
<?php } ?>
</form>
</div>

<?php if($updatestat) { ?><div class="ptm pbm">��˽��: <?php echo $modpost['validate'];?> ƪ�������ͨ����<?php echo $modpost['delete'];?> ƪ����ɾ����<?php echo $modpost['ignore'];?> ƪ���ӽ�������б�ȴ����</div><?php } if($postlist) { ?>
<form method="post" autocomplete="off" name="moderate" id="moderate" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&op=<?php echo $op;?>" class="s_clear">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="modact" value="" />
<input type="hidden" name="infloat" value="" />
<input type="hidden" name="dosubmit" value="yes" />
<input type="hidden" name="filter" value="<?php echo $filter;?>" /><?php if(is_array($postlist)) foreach($postlist as $post) { ?><div class="um <?php echo swapclass('alt');; ?>" id="pid_<?php echo $post['id'];?>">
<p class="pbn">
<span class="y">
<a href="forum.php?mod=modcp&amp;action=<?php echo $_G['gp_action'];?>&amp;op=<?php echo $op;?>&amp;moderate[]=<?php echo $post['id'];?>&amp;modact=validate&amp;filter=<?php echo $filter;?>&amp;dosubmit=1" onclick="showWindow('mods', this.href)" class="xi2">ͨ��</a><span class="pipe">|</span>
<a href="forum.php?mod=modcp&amp;action=<?php echo $_G['gp_action'];?>&amp;op=<?php echo $op;?>&amp;moderate[]=<?php echo $post['id'];?>&amp;modact=delete&amp;filter=<?php echo $filter;?>&amp;dosubmit=1" onclick="showWindow('mods', this.href)" class="xi2">ɾ��</a><span class="pipe">|</span>
<a href="forum.php?mod=modcp&amp;action=<?php echo $_G['gp_action'];?>&amp;op=<?php echo $op;?>&amp;moderate[]=<?php echo $post['id'];?>&amp;modact=ignore&amp;filter=<?php echo $filter;?>&amp;dosubmit=1" onclick="showWindow('mods', this.href)" class="xi2">����</a><span class="pipe">|</span>
<a href="javascript:;" onclick="toggle_post(<?php echo $post['id'];?>);" class="xi2">չ��</a>
</span>
<input type="checkbox" name="moderate[]" id="pidcheck_<?php echo $post['id'];?>" class="pc" value="<?php echo $post['id'];?>" onclick="recountobj()"/>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $post['fid'];?>" target="_blank" class="xi2 xw1"><?php echo $modforums['list'][$post['fid']];?></a> &rsaquo; <span class="xw1"><?php echo $post['tsubject'];?></span><?php if($post['subject']) { ?>&rsaquo; <span class="xw1"><?php echo $post['subject'];?></span><?php } ?>
</p>
<p class="pbn">
<span class="xi2"><?php echo $post['author'];?></span> 
<span class="xg1">������ <?php echo $post['dateline'];?></span>
<div id="list_note_<?php echo $post['id'];?>" style="overflow: auto; overflow-x: hidden; height:55px; word-break: break-all;">
<?php echo $post['message'];?> <?php echo $post['attach'];?> <?php echo $post['sortinfo'];?>
</div>
</p>
</div>
<?php } if(!empty($multipage)) { ?><div class="pgs cl mtm"><?php echo $multipage;?></div><?php } ?>
<div class="um bw0 cl">
<input type="checkbox" class="pc" name="chkall" id="chkall" onclick="modcheckall()" /> <label for="chkall">ȫѡ</label>
<button onclick="modthreads('validate'); return false;" class="pn"><strong>ͨ��</strong></button>
<button onclick="modthreads('delete'); return false;" class="pn"><strong>ɾ��</strong></button>
<button onclick="modthreads('ignore'); return false;" class="pn"><strong>����</strong></button>
<label> ��ǰ��ѡ�� <span id="modlayercount">0</span> ��</label>
</div>
</form>
<?php } elseif($_G['fid']) { ?>
<p class="emp">�Բ���û���ҵ�ƥ������</p>
<?php } } if($op == 'members') { ?>
<form method="post" autocomplete="off" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&op=<?php echo $op;?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>">
<div class="filterform exfm">
<table cellspacing="0" cellpadding="0">
<tr>
<th width="10%">�û���Χ:</th>
<td width="90%">
<span class="ftid">
<select name="filter" id="filter" width="150" class="ps">
<option value="0" <?php echo $filtercheck['0'];?>>����˵��û� ( <?php echo $count['0'];?> )</option>
<option value="1" <?php echo $filtercheck['1'];?>>�ѷ�����û� ( <?php echo $count['1'];?> )</option>
</select>
</span>
</td>
</tr>
<tr>
<th></th>
<td><button type="submit" class="pn" name="submit" id="searchsubmit" value="true"><strong>�ύ</strong></button></td>
</tr>
</table>
</div>
</form>
<?php if($memberlist) { ?>
<form method="post" autocomplete="off" name="moderate" id="moderate" action="<?php echo $cpscript;?>?mod=modcp&action=<?php echo $_G['gp_action'];?>&op=<?php echo $op;?>">
<input type="hidden" name="mod" value="" />
<input type="hidden" name="infloat" value="" />
<input type="hidden" name="modact" value="" />
<input type="hidden" name="dosubmit" value="yes" />
<input type="hidden" name="filter" value="<?php echo $filter;?>" />
<table cellspacing="0" cellpadding="0" class="dt">
<thead>
<tr>
<th class="c">&nbsp;</th>
<th>��������</th>
<th>ע��ԭ��</th>
<th>�����Ϣ</th>
</tr>
</thead><?php if(is_array($memberlist)) foreach($memberlist as $member) { ?><tr id="pid_<?php echo $member['uid'];?>" class="<?php echo swapclass('alt'); ?>">
<td><input type="checkbox" name="moderate[]" id="pidcheck_<?php echo $member['uid'];?>" class="pc" value="<?php echo $member['uid'];?>" onclick="recountobj()" /></td>
<td valign="top">
<h5><?php echo $member['username'];?></h5>
<p>ע��ʱ��: <?php echo $member['regdate'];?></p>
<p>ע�� IP: <?php echo $member['regip'];?></p>
<p>Email: <?php echo $member['email'];?></p>
<p class="mtn">
<a href="forum.php?mod=modcp&amp;action=<?php echo $_G['gp_action'];?>&amp;op=<?php echo $op;?>&amp;moderate[]=<?php echo $member['uid'];?>&amp;modact=validate&amp;filter=<?php echo $filter;?>&amp;dosubmit=1" onclick="showWindow('mods', this.href)">ͨ��</a><span class="pipe">|</span>
<a href="forum.php?mod=modcp&amp;action=<?php echo $_G['gp_action'];?>&amp;op=<?php echo $op;?>&amp;moderate[]=<?php echo $member['uid'];?>&amp;modact=delete&amp;filter=<?php echo $filter;?>&amp;dosubmit=1" onclick="showWindow('mods', this.href)">ɾ��</a><span class="pipe">|</span>
<a href="forum.php?mod=modcp&amp;action=<?php echo $_G['gp_action'];?>&amp;op=<?php echo $op;?>&amp;moderate[]=<?php echo $member['uid'];?>&amp;modact=ignore&amp;filter=<?php echo $filter;?>&amp;dosubmit=1" onclick="showWindow('mods', this.href)">���</a>
</p>
</td>
<td valign="top"><?php echo $member['message'];?></td>
<td valign="top">
<p>�ύ����: <?php echo $member['submittimes'];?></p>
<p>�ϴ��ύ: <?php echo $member['submitdate'];?></p>
<p>�ϴ������: <?php echo $member['admin'];?></p>
<p>�ϴ����ʱ��: <?php echo $member['moddate'];?></p>
</td>
</tr>
<?php } ?>
</table>
<?php if(!empty($multipage)) { ?><div class="pgs cl mtm"><?php echo $multipage;?></div><?php } ?>
<div class="um bw0 cl">
<input type="checkbox" class="pc" name="chkall" id="chkall" onclick="modcheckall()"/> <label for="chkall">ȫѡ</label>
<button onclick="modthreads('validate'); return false;" class="pn"><strong>ͨ��</strong></button>
<button onclick="modthreads('delete'); return false;" class="pn"><strong>ɾ��</strong></button>
<button onclick="modthreads('ignore'); return false;" class="pn"><strong>���</strong></button>
��ǰ��ѡ�� <span id="modlayercount">0</span> ��
</div>
</form>
<?php } else { ?>
<p class="emp">�Բ���û���ҵ�ƥ������</p>
<?php } } ?>
</div>

<script type="text/javascript" reload="1">
if($('filter')) {
simulateSelect('filter');
}
if($('fid')) {
simulateSelect('fid');
}
</script>