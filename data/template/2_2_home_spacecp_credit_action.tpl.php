<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_credit_action', 'common/header');
0
|| checktplrefresh('./template/8264/home/spacecp_credit_action.htm', './template/default/common/simplesearchform.htm', 1493781556, '2', './data/template/2_2_home_spacecp_credit_action.tpl.php', './template/8264', 'home/spacecp_credit_action')
|| checktplrefresh('./template/8264/home/spacecp_credit_action.htm', './template/default/home/spacecp_footer.htm', 1493781556, '2', './data/template/2_2_home_spacecp_credit_action.tpl.php', './template/8264', 'home/spacecp_credit_action')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_spacecp.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<?php if(!$_G['inajax']) { ?>
<div id="pt" class="bm cl"><?php if($_G['setting']['search']) { ?><?php $slist = array(); if($_G['fid'] && $_G['forum']['status'] != 3 && $mod != 'group') { ?><?php
$slist[forumfid] = <<<EOF
<li><input type="radio" id="mod_curform" class="pr" name="mod" value="curforum" checked="checked" /><label for="mod_curform" title="搜索本版">搜索本版</label></li>
EOF;
?><?php } if($_G['setting']['search']['portal']['status'] && ($_G['group']['allowsearch'] & 1 || $_G['adminid'] == 1)) { ?><?php
$slist[portal] = <<<EOF
<li><input type="radio" id="mod_article" class="pr" name="mod" value="portal"
EOF;
 if(CURSCRIPT == 'portal') { 
$slist[portal] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[portal] .= <<<EOF
 /><label for="mod_article" title="搜索文章">文章</label></li>
EOF;
?><?php } if($_G['setting']['search']['forum']['status'] && ($_G['group']['allowsearch'] & 2 || $_G['adminid'] == 1)) { ?><?php
$slist[forum] = <<<EOF
<li><input type="radio" id="mod_thread" class="pr" name="mod" value="forum"
EOF;
 if(CURSCRIPT == 'forum' && !$_G['fid']) { 
$slist[forum] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[forum] .= <<<EOF
 /><label for="mod_thread" title="搜索{$_G['setting']['navs']['2']['navname']}">{$_G['setting']['navs']['2']['navname']}</label></li>
EOF;
?><?php } if($_G['setting']['search']['blog']['status'] && ($_G['group']['allowsearch'] & 4 || $_G['adminid'] == 1)) { ?><?php
$slist[blog] = <<<EOF
<li><input type="radio" id="mod_blog" class="pr" name="mod" value="blog"
EOF;
 if(CURSCRIPT == 'home' && $do != 'album') { 
$slist[blog] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[blog] .= <<<EOF
 /><label for="mod_blog" title="搜索日志">日志</label></li>
EOF;
?><?php } if($_G['setting']['search']['album']['status'] && ($_G['group']['allowsearch'] & 8 || $_G['adminid'] == 1)) { ?><?php
$slist[album] = <<<EOF
<li><input type="radio" id="mod_album" class="pr" name="mod" value="album"
EOF;
 if(CURSCRIPT == 'home' && $do == 'album') { 
$slist[album] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[album] .= <<<EOF
 /><label for="mod_album" title="搜索相册">相册</label></li>
EOF;
?><?php } if($_G['setting']['groupstatus'] && $_G['setting']['search']['group']['status'] && ($_G['group']['allowsearch'] & 16 || $_G['adminid'] == 1)) { ?><?php
$slist[group] = <<<EOF
<li><input type="radio" id="mod_group" class="pr" name="mod" value="group"
EOF;
 if(CURSCRIPT == 'group' || $_G['basescript']=='group') { 
$slist[group] .= <<<EOF
 checked="checked"
EOF;
 } 
$slist[group] .= <<<EOF
 /><label for="mod_group" title="搜索{$_G['setting']['navs']['3']['navname']}">{$_G['setting']['navs']['3']['navname']}</label></li>
EOF;
?><?php } ?><?php
$slist[user] = <<<EOF
<li><input type="radio" id="mod_user" class="pr" name="mod" value="user" /><label for="mod_user" title="搜索用户">用户</label></li>
EOF;
?>
<?php if($slist) { ?>
<div id="sc" class="y">
<form id="scform" method="post" autocomplete="off" onsubmit="searchFocus($('srchtxt'))" action="<?php echo $_G['siteurl'];?>search.php?searchsubmit=yes" target="_blank">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="srchtype" value="title" />
<input type="hidden" name="srhfid" value="<?php echo $_G['fid'];?>" />
<table cellspacing="0" cellpadding="0">
<tr>
<td><a href="search.php" target="_blank" id="sctype" class="showmenu" onclick="showMenu(this.id);return false;">搜索</a></td>
<td><input type="text" name="srchtxt" id="srchtxt" class="px z" value="请输入搜索内容" autocomplete="off" onfocus="searchFocus(this);" onblur="searchBlur(this);" /></td>
<td><button id="search_submit" name="searchsubmit" type="submit" value="true" class="xw1">搜索</button></td>
</tr>
</table>
<div id="sctype_menu" class="p_pop cl" style="display: none">
<ul><?php echo implode('', $slist);; ?></ul>
</div>
</form>
<script type="text/javascript">initSearchmenu();</script>
</div>
<?php } } ?><div class="z"><a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php?mod=spacecp">设置</a> <em>&rsaquo;</em>
<?php if($_G['gp_operation'] == 'transfer') { ?>转账<?php } elseif($_G['gp_operation'] == 'exchange') { ?>兑换<?php } elseif($_G['gp_operation'] == 'addfunds') { ?>充值<?php } ?>
</div>
</div>
<div id="ct" class="ct2_a wp cl">
<div class="mn">
<div class="bm bw0">
<?php } if($_G['gp_operation'] == 'exchange') { ?>

<form id="confirmform" name="confirmform" class="postbox" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=credit&amp;op=base&amp;confirm=yes" <?php if($_G['inajax']) { ?> onsubmit="ajaxpost(this.id, 'return_credit');"<?php } ?>>
<div class="popbox w570">
<div class="flb">
<div class="popbox_title clearfix">
<span>兑换</span>			
<?php if($_G['inajax']) { ?><em onclick="hideWindow('credit');"></em><?php } ?>
</div>
</div>
<div class="dhinfo" style="margin-top:20px;">
<span>
你要兑换 <strong>
<?php if($outexange) { ?>
<?php echo $_CACHE['creditsettings'][$tocredits]['title'];?> <?php echo $exchangeamount;?> <?php echo $_CACHE['creditsettings'][$tocredits]['unit'];?>
<?php } else { ?>
<?php echo $_G['setting']['extcredits'][$tocredits]['title'];?> <?php echo $exchangeamount;?> <?php echo $_G['setting']['extcredits'][$tocredits]['unit'];?>
<?php } ?>
</strong>, 需要付出<strong> <?php echo $_G['setting']['extcredits'][$fromcredits]['title'];?> <?php echo $netamount;?> <?php echo $_G['setting']['extcredits'][$fromcredits]['unit'];?></strong>, 请输入你的登录密码确认
</span>
</div>
<div>
<ul class="albumform">
<li>
<label style="width:69px;"></label>
<input type="password" name="password" class="inputtext" value="" size="20" />
</li>	
<li>
<label style="width:69px;"></label>
<button type="submit" name="confirm" value="true" class="button_confirm"><strong>确定</strong></button>					
<span id="return_credit" style="color:red;margin-left:5px;"></span>	
</li>
</ul>
</div>
</div>	
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="credit" /><?php } ?>
<input type="hidden" name="operation" value="exchange" />
<input type="hidden" name="exchangeamount" value="<?php echo $exchangeamount;?>" />
<input type="hidden" name="fromcredits" value="<?php echo $fromcredits;?>" />
<input type="hidden" name="tocredits" value="<?php echo $tocredits;?>" />
<input type="hidden" name="exchangesubmit" value="yes" />	
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />		
</form>


<?php } else { ?>
<h3 class="flb">
<em id="return_credit"><?php if($_G['gp_operation'] == 'transfer') { ?>转账<?php } elseif($_G['gp_operation'] == 'exchange') { ?>兑换<?php } elseif($_G['gp_operation'] == 'addfunds') { ?>充值<?php } ?></em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('credit');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<form id="confirmform" class="postbox" method="post" autocomplete="off" action="home.php?mod=spacecp&amp;ac=credit&amp;op=base&amp;confirm=yes" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost('confirmform', 'return_credit');"<?php } ?>>
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="credit" /><?php } if($_G['gp_operation'] == 'transfer') { ?>
<div class="c">
<input type="hidden" name="operation" value="transfer" />
<input type="hidden" name="transfersubmit" value="yes" />
<input type="hidden" name="transferamount" value="<?php echo $_G['gp_transferamount'];?>" />
<input type="hidden" name="to" value="<?php echo $to['username'];?>" />
<p>你要转账 <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['9']]['title'];?> <?php echo $_G['gp_transferamount'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['9']]['unit'];?></strong> 给 <strong><?php echo $to['username'];?></strong>, 请输入登录密码</p>
<p class="mtn mbm"><input type="password" name="password" class="px" value="" /></p>
<p>转账留言</p>
<p class="mtn"><input type="text" name="transfermessage" class="px" size="40" /></p>
</div>
<p class="o pns">
<button type="submit" name="confirm" value="true" class="pn pnc"><strong>确定</strong></button>
</p>	
<?php } elseif($_G['gp_operation'] == 'addfunds') { ?>
<div class="c">
<input type="hidden" name="operation" value="addfunds" />
<input type="hidden" name="amount" value="<?php echo $_G['gp_addfundamount'];?>" />
<input type="hidden" name="addfundssubmit" value="yes" />
<p>你将要充值<?php echo $extcredits[$creditstrans]['title'];?> <?php echo $_G['gp_addfundamount'];?> <?php echo $extcredits[$fromcredits]['unit'];?>，所需人民币 <?php echo $price;?> 元<br />请选择支付方式：</p>
<p class="mtn">	
<?php if($_G['setting']['ec_tenpay_bargainor'] || $_G['setting']['ec_tenpay_opentrans_chnid']) { ?>
<label><input name="apitype" type="radio" value="tenpay" id="apitype_tenpay" checked="checked" /> <img title="财付通" alt="财付通" onclick="$('apitype_tenpay').checked=true" src="http://static.8264.com/static/image/common/tenpay_logo.gif" /></label>
<?php } if($_G['setting']['ec_account']) { ?>
<label><input name="apitype" type="radio" value="alipay" id="apitype_alipay" <?php if(!($_G['setting']['ec_tenpay_bargainor'] || $_G['setting']['ec_tenpay_opentrans_chnid'])) { ?>checked="checked"<?php } ?> /> <img title="支付宝" alt="支付宝" onclick="$('apitype_alipay').checked=true" src="http://static.8264.com/static/image/common/alipay_logo.gif" /></label>
<?php } ?>
</p>
</div>
<p class="o pns">
<button type="submit" name="confirm" value="true" class="pn pnc"><strong>确定</strong></button>
</p>
<?php } ?>
</form>
<?php } if($_G['inajax']) { ?>
<script type="text/javascript">
if(BROWSER.ie == 6) {
var popWindow = {
coversel: function (id) {
id = isUndefined(id) ? 'fwin_credit' : id;
var obj = $(id);
if(!obj) return false;
var frm = document.createElement('<iframe frameborder="0" style="position:absolute;z-index:-1;"></iframe>');
frm.style.width = obj.offsetWidth + 'px';
frm.style.height = obj.offsetHeight + 'px';
obj.insertBefore(frm, obj.firstChild);
}
}
popWindow.coversel();
}
</script>
<?php } if(!$_G['inajax']) { ?>
</div>
</div>
<div class="appl"><div class="tbn">
<h2 class="mt bbda">设置</h2>
<ul>
<?php if($_G['setting']['connect']['allow']) { ?>
<li<?php echo $actives['qq'];?>><a href="connect.php?mod=config">QQ绑定</a></li>
<?php } ?>
<li<?php echo $actives['avatar'];?>><a href="home.php?mod=spacecp&amp;ac=avatar">修改头像</a></li>
<li<?php echo $actives['profile'];?>><a href="home.php?mod=spacecp&amp;ac=profile">个人资料</a></li>
<?php if($_G['setting']['verify']['enabled'] || $_G['setting']['my_app_status'] && $_G['setting']['videophoto']) { ?>
<li<?php echo $actives['verify'];?>><a href="<?php if($_G['setting']['verify']['enabled']) { ?>home.php?mod=spacecp&ac=profile&op=verify<?php } else { ?>home.php?mod=spacecp&ac=videophoto<?php } ?>">认证</a></li>
<?php } ?>
<li<?php echo $actives['credit'];?>><a href="home.php?mod=spacecp&amp;ac=credit">积分</a></li>
<li<?php echo $actives['usergroup'];?>><a href="home.php?mod=spacecp&amp;ac=usergroup">用户组</a></li>
<li<?php echo $actives['privacy'];?>><a href="home.php?mod=spacecp&amp;ac=privacy">隐私筛选</a></li>
<?php if($_G['setting']['sendmailday']) { ?><li<?php echo $actives['sendmail'];?>><a href="home.php?mod=spacecp&amp;ac=sendmail">邮件提醒</a></li><?php } ?>
<li<?php echo $actives['password'];?>><a href="home.php?mod=spacecp&amp;ac=profile&amp;op=password">密码安全</a></li>
<?php if(!empty($_G['setting']['plugins']['spacecp'])) { if(is_array($_G['setting']['plugins']['spacecp'])) foreach($_G['setting']['plugins']['spacecp'] as $id => $module) { if(!$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])) { ?><li<?php if($_G['gp_id'] == $id) { ?> class="a"<?php } ?>><a href="home.php?mod=spacecp&amp;ac=plugin&amp;id=<?php echo $id;?>"><?php echo $module['name'];?></a></li><?php } } } ?>
</ul>
</div></div>
</div>
<?php } include template('common/footer'); ?>