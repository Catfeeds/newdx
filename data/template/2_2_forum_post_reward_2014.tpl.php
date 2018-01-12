<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="t_a_x clboth<?php if($_G['gp_action'] == 'edit' && !$isorigauthor) { ?> resolved<?php } ?>">
<ul class="xscon">
<li class="clboth">
<?php if($_G['gp_action'] == 'newthread') { ?>
<label for="rewardprice"><span class="name">悬赏价格：</span></label>
<input type="text" name="rewardprice" id="rewardprice" onkeyup="getrealprice(this.value)" value="<?php echo $_G['group']['minrewardprice'];?>" tabindex="1" />
<span class="note"><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <em>(税后支付 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <span id="realprice">0</span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?> ， 最低 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $_G['group']['minrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
<?php if($_G['group']['maxrewardprice'] > 0) { ?> - <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $_G['group']['maxrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php } ?>)， 你有<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo getuserprofile('extcredits'.$_G['setting']['creditstransextra']['2']);; ?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?></em></span>
<?php } elseif($_G['gp_action'] == 'edit') { if($isorigauthor) { if($thread['price'] > 0) { ?>
<label for="rewardprice"><span class="name">悬赏价格：</span></label>
<input type="text" name="rewardprice" id="rewardprice" onkeyup="getrealprice(this.value)" value="<?php echo $rewardprice;?>" tabindex="1" />
<span class="note"><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <em>(税后追加 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <span id="realprice">0</span> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?> ， 最低 <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $_G['group']['minrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
<?php if($_G['group']['maxrewardprice'] > 0) { ?> - <?php echo $_G['group']['maxrewardprice'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?><?php } ?>)， 你有<?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo getuserprofile('extcredits'.$_G['setting']['creditstransextra']['2']);; ?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?></em></span>
<?php } else { ?>
已解决的悬赏
<input type="hidden" name="rewardprice" value="<?php echo $rewardprice;?>" tabindex="1" />
<?php } } else { if($thread['price'] > 0) { ?>
悬赏价格: <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['title'];?> <?php echo $rewardprice;?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['2']]['unit'];?>
<?php } else { ?>
已解决的悬赏
<?php } } } ?>
</li>
<?php if($_G['setting']['rewardexpiration'] > 0) { ?>
<li class="clboth"><span class="note_cz"><?php echo $_G['setting']['rewardexpiration'];?> 天后如果您仍未设置最佳答案，版主有权代为您选择</span></li>
<?php } ?>
</ul>
</div>
<script type="text/javascript" reload="1">
function getrealprice(price){
if(!price.search(/^\d+$/) ) {
n = Math.ceil(parseInt(price) + price * <?php echo $_G['setting']['creditstax'];?>);
if(price > 32767) {
$('realprice').innerHTML = '<b>售价不能高于 32767</b>';
}<?php if($_G['gp_action'] == 'edit') { ?>	else if(price < <?php echo $rewardprice;?>) {
$('realprice').innerHTML = '<b>不能降低悬赏积分</b>';
}<?php } ?> else if(price < <?php echo $_G['group']['minrewardprice'];?> || (<?php echo $_G['group']['maxrewardprice'];?> > 0 && price > <?php echo $_G['group']['maxrewardprice'];?>)) {
$('realprice').innerHTML = '<b>售价超出范围</b>';
} else {
$('realprice').innerHTML = n;
}
}else{
$('realprice').innerHTML = '<b>填写无效</b>';
}
}
if($('rewardprice')) {
getrealprice($('rewardprice').value)
}
function validateextra_reward() {
if($('postform').rewardprice.value == '') {
showDialog('对不起，请输入悬赏价格', 'alert', '', function () { $('postform').rewardprice.focus() });
return false;
}
return true;
}
</script>