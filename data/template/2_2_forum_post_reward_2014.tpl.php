<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="t_a_x clboth<?php if($_G['gp_action'] == 'edit' && !$isorigauthor) { ?> resolved<?php } ?>">
<ul class="xscon">
<li class="clboth">
<?php if($_G['gp_action'] == 'newthread') { ?>
<label for="rewardprice"><span class="name">���ͼ۸�</span></label>
<input type="text" name="rewardprice" id="rewardprice" onkeyup="getrealprice(this.value)" value="<?php echo $_G['group']['minrewardprice'];?>" tabindex="1" />
<span class="note"><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <em>(˰��֧�� <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <span id="realprice">0</span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?> �� ��� <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $_G['group']['minrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
<?php if($_G['group']['maxrewardprice'] > 0) { ?> - <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $_G['group']['maxrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php } ?>)�� ����<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo getuserprofile('extcredits'.$_G['setting']['creditstransextra']['2']);; ?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?></em></span>
<?php } elseif($_G['gp_action'] == 'edit') { if($isorigauthor) { if($thread['price'] > 0) { ?>
<label for="rewardprice"><span class="name">���ͼ۸�</span></label>
<input type="text" name="rewardprice" id="rewardprice" onkeyup="getrealprice(this.value)" value="<?php echo $rewardprice;?>" tabindex="1" />
<span class="note"><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <em>(˰��׷�� <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <span id="realprice">0</span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?> �� ��� <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $_G['group']['minrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
<?php if($_G['group']['maxrewardprice'] > 0) { ?> - <?php echo $_G['group']['maxrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php } ?>)�� ����<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo getuserprofile('extcredits'.$_G['setting']['creditstransextra']['2']);; ?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?></em></span>
<?php } else { ?>
�ѽ��������
<input type="hidden" name="rewardprice" value="<?php echo $rewardprice;?>" tabindex="1" />
<?php } } else { if($thread['price'] > 0) { ?>
���ͼ۸�: <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $rewardprice;?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
<?php } else { ?>
�ѽ��������
<?php } } } ?>
</li>
<?php if($_G['setting']['rewardexpiration'] > 0) { ?>
<li class="clboth"><span class="note_cz"><?php echo $_G['setting']['rewardexpiration'];?> ����������δ������Ѵ𰸣�������Ȩ��Ϊ��ѡ��</span></li>
<?php } ?>
</ul>
</div>
<script type="text/javascript" reload="1">
function getrealprice(price){
if(!price.search(/^\d+$/) ) {
n = Math.ceil(parseInt(price) + price * <?php echo $_G['setting']['creditstax'];?>);
if(price > 32767) {
$('realprice').innerHTML = '<b>�ۼ۲��ܸ��� 32767</b>';
}<?php if($_G['gp_action'] == 'edit') { ?>	else if(price < <?php echo $rewardprice;?>) {
$('realprice').innerHTML = '<b>���ܽ������ͻ���</b>';
}<?php } ?> else if(price < <?php echo $_G['group']['minrewardprice'];?> || (<?php echo $_G['group']['maxrewardprice'];?> > 0 && price > <?php echo $_G['group']['maxrewardprice'];?>)) {
$('realprice').innerHTML = '<b>�ۼ۳�����Χ</b>';
} else {
$('realprice').innerHTML = n;
}
}else{
$('realprice').innerHTML = '<b>��д��Ч</b>';
}
}
if($('rewardprice')) {
getrealprice($('rewardprice').value)
}
function validateextra_reward() {
if($('postform').rewardprice.value == '') {
showDialog('�Բ������������ͼ۸�', 'alert', '', function () { $('postform').rewardprice.focus() });
return false;
}
return true;
}
</script>