<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_trade', 'common/header');
0
|| checktplrefresh('./template/default/home/space_trade.htm', './template/default/common/simplesearchform.htm', 1509432205, 'diy', './data/template/2_diy_home_space_trade.tpl.php', './template/8264', 'home/space_trade')
|| checktplrefresh('./template/default/home/space_trade.htm', './template/default/common/userabout.htm', 1509432205, 'diy', './data/template/2_diy_home_space_trade.tpl.php', './template/8264', 'home/space_trade')
;?><?php include template('common/header'); ?><link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css"><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;do=trade\">商品</a>"; if($_G['gp_view'] == 'eccredit') { ?><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=$do&amp;view=eccredit\">TA的信用评价</a>"; } else { ?><?php $_G['home_tpl_spacemenus'][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=$do&amp;view=onlyuser\">TA的所有商品</a>"; } ?>

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
<?php } } ?><div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<a href="home.php"><?php echo $_G['setting']['navs']['4']['navname'];?></a> <em>&rsaquo;</em> 
<a href="home.php?mod=space&amp;do=trade">商品</a>
<?php if($_GET['view']=='me') { ?>
 <em>&rsaquo;</em> <a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=me"><?php echo $space['username'];?>的商品</a>
<?php } ?>
</div>
</div>

<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<div id="ct" class="ct2_a wp cl">
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<div class="bm bw0">
<?php if((!$_G['uid'] && !$space['uid']) || $space['self']) { ?>
<h1 class="mt"><img alt="trade" src="http://static.8264.com/static/image/common/tradesmall.gif" class="vm" /> 商品</h1>
<?php } if($space['self']) { ?>
<ul class="tb cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=we">好友出售的商品</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=me">我的商品</a></li>
<li<?php echo $actives['tradelog'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=tradelog">交易记录</a></li>
<li<?php echo $actives['eccredit'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=eccredit">信用评价</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=all">随便看看</a></li>
<?php if($_G['group']['allowposttrade']) { ?>
<li class="o">
<?php if($_G['setting']['tradeforumid']) { ?>
<a href="forum.php?mod=post&amp;action=newthread&amp;fid=<?php echo $_G['setting']['tradeforumid'];?>&amp;special=2">发起新交易</a>
<?php } else { ?>
<a href="forum.php?mod=misc&amp;action=nav&amp;special=2" onclick="showWindow('nav', this.href)">发起新交易</a>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php } else { include template('home/space_menu'); ?><p class="tbmu cl">
<span class="y">
<?php if($_G['gp_view']=='me') { ?><?php $actives[onlyuser]=' class="a"'; } if($space['uid'] > 0) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=onlyuser"<?php echo $actives['onlyuser'];?>>出售的商品</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=eccredit"<?php echo $actives['eccredit'];?>>信用评价</a>
<?php } ?>
</span>
</p>
<?php } if($_G['gp_view'] == 'tradelog' && $space['uid'] > 0) { ?>
<p class="tbmu bw0">
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=tradelog&amp;type=sell" <?php echo $orderactives['sell'];?>>卖家交易</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=trade&amp;view=tradelog&amp;type=buy" <?php echo $orderactives['buy'];?>>买家交易</a>
</p>
<?php } elseif($_G['gp_view'] == 'all') { ?>
<p class="tbmu">
<a href="home.php?mod=space&amp;do=trade&amp;view=all"<?php echo $orderactives['new'];?>>最新商品</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=trade&amp;view=all&amp;order=hot"<?php echo $orderactives['hot'];?>>热门商品</a>
</p>
<?php } if($userlist) { ?>
<p class="tbmu">
按好友查看
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><?php if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?php echo $value['fuid'];?>"<?php echo $fuid_actives[$value['fuid']];?>><?php echo $value['fusername'];?></option>
<?php } ?>
</select>
</p>
<?php } if($_G['gp_view'] == 'tradelog') { ?><?php $selltrades = array('all' => '全部交易', 'trading' => '进行中的', 'attention' => '关注的', 'eccredit' => '评价过的', 'success' => '成功的', 'refund' => '退款的', 'closed' => '失败的', 'unstart' => '未生效的'); ?><div class="tl tlog">
<table id="list_trade_selles" cellspacing="0" cellpadding="0">
<tr class="th">
<td width="90">商品名称</td>
<td>&nbsp;</td>
<td class="by"><?php if($viewtype == 'sell') { ?>买家<?php } else { ?>卖家<?php } ?></td>
<td class="by">交易金额</td>
<td>
<select onchange="filterTrade(this.value)"><?php if(is_array($selltrades)) foreach($selltrades as $key => $langstr) { ?><option value="<?php echo $key;?>" <?php if($filter == $key) { ?> selected="selected"<?php } ?>><?php echo $langstr;?></option>
<?php } ?>
</select>
<script type="text/javascript">
function filterTrade(value) {
window.location = 'home.php?mod=space&uid=1&do=trade&view=tradelog&type=<?php echo $viewtype;?>&filter='+value;
}
</script>
</td>
<?php if($filter == 'success' || $filter == 'refund' || $filter == 'eccredit') { ?><td>信用评价</td><?php } ?>
</tr>
<tbody>
<?php if($tradeloglist) { if(is_array($tradeloglist)) foreach($tradeloglist as $tradelog) { ?><tr>
<td>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $tradelog['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $tradelog['pid'];?>"><?php if($tradelog['aid']) { ?><img src="<?php echo getforumimg($tradelog['aid']); ?>" width="90" /><?php } else { ?><img src="http://static.8264.com/static/image/common/nophotosmall.gif" /><?php } ?></a>
</td>
<td>
<a href="forum.php?mod=trade&amp;orderid=<?php echo $tradelog['orderid'];?>"><?php echo $tradelog['subject'];?></a><br />
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $tradelog['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $tradelog['pid'];?>" class="xg1"><?php echo $tradelog['threadsubject'];?></a>
</td>
<td>
<?php if($item == 'selltrades') { if($tradelog['buyerid']) { ?><a target="_blank" href="home.php?mod=space&amp;uid=<?php echo $tradelog['buyerid'];?>"><?php echo $tradelog['buyer'];?></a><?php } else { ?><?php echo $tradelog['buyer'];?><?php } } else { ?>
<a target="_blank" href="home.php?mod=space&amp;uid=<?php echo $tradelog['sellerid'];?>"><?php echo $tradelog['seller'];?></a>
<?php } ?>
</td>
<td>
<?php if($tradelog['price'] > 0) { ?>
<?php echo $tradelog['price'];?> 元<br/>
<?php } if($tradelog['credit'] > 0) { ?>
<?php echo $extcredits[$creditid]['title'];?> <?php echo $tradelog['credit'];?> <?php echo $extcredits[$creditid]['unit'];?>
<?php } ?>
</td>
<td>
<cite><a target="_blank" href="forum.php?mod=trade&amp;orderid=<?php echo $tradelog['orderid'];?>">
<?php if($tradelog['attend']) { ?>
<b><?php echo $tradelog['status'];?></b>
<?php } else { ?>
<?php echo $tradelog['status'];?>
<?php } ?>
</a></cite>
<em><?php echo $tradelog['lastupdate'];?></em>
</td>
<?php if($filter == 'success' || $filter == 'refund' || $filter == 'eccredit') { ?>
<td>
<?php if($tradelog['ratestatus'] == 3) { ?>
双方已评
<?php } elseif(($item == 'buytrades' && $tradelog['ratestatus'] == 1) || ($item == 'selltrades' && $tradelog['ratestatus'] == 2)) { ?>
等待对方评价
<?php } else { if(($item == 'buytrades' && $tradelog['ratestatus'] == 2) || ($item == 'selltrades' && $tradelog['ratestatus'] == 1)) { ?>对方已评<br /><?php } if($item == 'buytrades') { ?>
<a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=rate&amp;orderid=<?php echo $tradelog['orderid'];?>&amp;type=0" target="_blank">评价</a>
<?php } else { ?>
<a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=rate&amp;orderid=<?php echo $tradelog['orderid'];?>&amp;type=1" target="_blank">评价</a>
<?php } } ?>
</td>
<?php } ?>
</tr>
<?php } } else { ?>
<td colspan="<?php if($filter == 'success' || $filter == 'refund' || $filter == 'eccredit') { ?>6<?php } else { ?>5<?php } ?>"><p class="emp">暂无数据</p></td></tr>
<?php } ?>
</tbody>
</table>
</div>
<?php if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } } elseif($_G['gp_view'] == 'eccredit') { ?>
<script src="http://static.8264.com/static/js/forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<p class="mtm mbw">
<?php if($member['alipay']) { ?><a href="https://www.alipay.com/trade/i_credit.do?email=<?php echo $member['alipay'];?>" target="_blank"><img src="http://static.8264.com/static/image/common/alipaysmall.gif" alt="支付宝账户信用信息" class="vm" /></a>&nbsp;&nbsp;<?php } if($member['taobao']) { ?><script type="text/javascript">document.write('<a target="_blank" href="http://amos1.taobao.com/msg.ww?v=2&amp;uid='+encodeURIComponent('<?php echo $member['taobaoas'];?>')+'&amp;s=2"><img src="http://amos1.taobao.com/online.ww?v=2&amp;uid='+encodeURIComponent('<?php echo $member['taobaoas'];?>')+'&amp;s=1" alt="阿里旺旺" class="vm" /></a>&nbsp;');</script>&nbsp;&nbsp;<?php } ?>
卖家好评率: <?php echo $sellerpercent;?>%;&nbsp;&nbsp;
买家好评率: <?php echo $buyerpercent;?>%;&nbsp;&nbsp;
注册时间: <?php echo $member['regdate'];?>
</p>
<table id="sellcredit" summary="eccredit" cellspacing="0" cellpadding="0" class="dt">
<caption><h3 class="pbm">买家信用 <?php echo $member['sellercredit'];?> <img src="http://static.8264.com/static/image/traderank/buyer/<?php echo $member['buyerrank'];?>.gif" alt="buyer rank" class="vm" /></h3></caption>
<tr class="alt">
<td style="width: 45px;">&nbsp;</td>
<td>最近1周</td>
<td>最近1个月</td>
<td>最近6个月</td>
<td>6个月前</td>
<td>总计</td>
</tr>
<tr>
<td><img src="http://static.8264.com/static/image/traderank/good.gif" width="14" height="16" alt="good" class="vm" /> <span style="color:red">好评</span></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thisweek&amp;level=good#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thisweek']['good'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thismonth&amp;level=good#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thismonth']['good'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=halfyear&amp;level=good#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['halfyear']['good'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=before&amp;level=good#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['before']['good'];?></a></td>
<td><?php echo $caches['sellercredit']['all']['good'];?></td>
</tr>
<tr>
<td><img src="http://static.8264.com/static/image/traderank/soso.gif" width="14" height="16" alt="soso" class="vm" /> <span style="color:green">中评</span></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thisweek&amp;level=soso#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thisweek']['soso'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thismonth&amp;level=soso#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thismonth']['soso'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=halfyear&amp;level=soso#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['halfyear']['soso'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=before&amp;level=soso#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['before']['soso'];?></a></td>
<td><?php echo $caches['sellercredit']['all']['soso'];?></td>
</tr>
<tr>
<td><img src="http://static.8264.com/static/image/traderank/bad.gif" width="14" height="16" alt="bad" class="vm" /> 差评</td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thisweek&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thisweek']['bad'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thismonth&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thismonth']['bad'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=halfyear&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['halfyear']['bad'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=before&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['before']['bad'];?></a></td>
<td><?php echo $caches['sellercredit']['all']['bad'];?></td>
</tr>
<tr>
<td>总计</td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thisweek#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thisweek']['total'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=thismonth#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['thismonth']['total'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=halfyear#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['halfyear']['total'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=buyer&amp;filter=before#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['sellercredit']['before']['total'];?></a></td>
<td><?php echo $caches['sellercredit']['all']['total'];?></td>
</tr>
</table>

<table id="buyercredit" summary="eccredit" cellspacing="0" cellpadding="0" class="dt">
<caption><h3 class="ptw pbm">卖家信用 <?php echo $member['buyercredit'];?> <img src="http://static.8264.com/static/image/traderank/seller/<?php echo $member['sellerrank'];?>.gif" alt="seller rank" class="vm" /></h3></caption>
<tr class="alt">
<td style="width: 45px;">&nbsp;</td>
<td>最近1周</td>
<td>最近1个月</td>
<td>最近6个月</td>
<td>6个月前</td>
<td>总计</td>
</tr>
<tr>
<td><img src="http://static.8264.com/static/image/traderank/good.gif" width="14" height="16" alt="good" class="vm" /> <span style="color:red">好评</span></td><td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thisweek&amp;level=good" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thisweek']['good'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thismonth&amp;level=good#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thismonth']['good'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=halfyear&amp;level=good#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['halfyear']['good'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=before&amp;level=good#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['before']['good'];?></a></td>
<td><?php echo $caches['buyercredit']['all']['good'];?></td>
</tr>
<tr>
<td><img src="http://static.8264.com/static/image/traderank/soso.gif" width="14" height="16" alt="soso" class="vm" /> <span style="color:green">中评</span></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thisweek&amp;level=soso#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thisweek']['soso'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thismonth&amp;level=soso#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thismonth']['soso'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=halfyear&amp;level=soso#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['halfyear']['soso'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=before&amp;level=soso" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['before']['soso'];?></a></td>
<td><?php echo $caches['buyercredit']['all']['soso'];?></td>
</tr>
<tr>
<td><img src="http://static.8264.com/static/image/traderank/bad.gif" width="14" height="16" alt="bad" class="vm" /> 差评</td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thisweek&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thisweek']['bad'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thismonth&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thismonth']['bad'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=halfyear&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['halfyear']['bad'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=before&amp;level=bad#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['before']['bad'];?></a></td>
<td><?php echo $caches['buyercredit']['all']['bad'];?></td>
</tr>
<tr>
<td>总计</td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thisweek#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thisweek']['total'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=thismonth#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['thismonth']['total'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=halfyear#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['halfyear']['total'];?></a></td>
<td><a href="home.php?mod=spacecp&amp;ac=eccredit&amp;op=list&amp;uid=<?php echo $uid;?>&amp;from=seller&amp;filter=before#" onclick="ajaxget(this.href, 'ajaxrate', 'specialposts');doane(event);"><?php echo $caches['buyercredit']['before']['total'];?></a></td>
<td><?php echo $caches['buyercredit']['all']['total'];?></td>
</tr>
</table>
<div id="ajaxrate"></div>
<?php if($_G['uid']) { ?>
<script type="text/javascript">ajaxget('home.php?mod=spacecp&ac=eccredit&op=list&uid=<?php echo $uid;?>', 'ajaxrate');var explainmenu='ajax_explain_menu';</script>
<?php } } else { if($list) { ?>
<ul class="ml tradl cl"><?php if(is_array($list)) foreach($list as $key => $value) { ?><li class="bbda">
<p class="u xg1"><a href="home.php?mod=space&amp;uid=<?php echo $value['sellerid'];?>" title="<?php echo $value['seller'];?>" target="_blank"><?php echo $value['seller'];?></a></p>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $value['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $value['pid'];?>" class="tn">
<?php if($value['displayorder'] > 0) { ?><em class="hot">推荐商品</em><?php } ?>
<img src="<?php if($value['aid']) { echo getforumimg($value['aid']); } else { ?>http://static.8264.com/static/image/common/nophoto.gif<?php } ?>" alt="<?php echo $value['subject'];?>" />
</a>
<?php if($value['expiration'] && $value['expiration'] < $_G['timestamp'] || $value['closed']) { ?>
<p class="stat">- 交易结束 -</p>
<?php } else { if($value['price'] > 0) { ?>
<p class="p">&yen; <em class="xi1"><?php echo $value['price'];?></em></p>
<?php } if($_G['setting']['creditstransextra']['5'] != -1 && $value['credit']) { ?>
<p class="<?php if($value['price'] > 0) { ?>xg1<?php } else { ?>p<?php } ?>"><?php if($value['price'] > 0) { ?>附加 <?php } ?><em class="xi1"><?php echo $value['credit'];?></em> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['5']]['title'];?></p>
<?php } } ?>
<h4><a href="forum.php?mod=viewthread&amp;tid=<?php echo $value['tid'];?>&amp;do=tradeinfo&amp;pid=<?php echo $value['pid'];?>" title="<?php echo $value['subject'];?>" class="xi2"><?php echo $value['subject'];?></a></h4>
</li>
<?php } if($emptyli) { if(is_array($emptyli)) foreach($emptyli as $value) { ?><li class="bbda">&nbsp;</li>
<?php } } ?>
</ul>
<?php } else { ?>
<div class="emp">还没有相关的商品。</div>
<?php } } ?>
</div>
<?php if($multi) { ?><div class="pgs cl"><?php echo $multi;?></div><?php } ?>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->
</div>
<div class="appl"><?php if(!empty($_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_top'][$_G['basescript'].'::'.CURMODULE]; ?><?php getuserapp(1); ?><ul><?php if(is_array($_G['setting']['spacenavs'])) foreach($_G['setting']['spacenavs'] as $nav) { if($nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))) { if(in_array($nav['code'], array('userpanelarea1', 'userpanelarea2'))) { if(!empty($_G['my_panelapp']) && $_G['setting']['my_app_status']) { if($nav['code']=='userpanelarea1' && !empty($_G['my_panelapp']['1'])) { if(is_array($_G['my_panelapp']['1'])) foreach($_G['my_panelapp']['1'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?php echo $app['appid'];?>" title="<?php echo $app['appname'];?>"><img <?php if($app['icon']) { ?>src="<?php echo $app['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $app['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $app['appid'];?>"<?php } ?> name="<?php echo $appid;?>" alt="<?php echo $app['appname'];?>" /><?php echo $app['appname'];?></a>
</li>
<?php } } elseif($nav['code']=='userpanelarea2' && !empty($_G['my_panelapp']['2'])) { if(is_array($_G['my_panelapp']['2'])) foreach($_G['my_panelapp']['2'] as $appid => $app) { ?><li>
<a href="userapp.php?mod=app&amp;id=<?php echo $app['appid'];?>" title="<?php echo $app['appname'];?>"><img <?php if($app['icon']) { ?>src="<?php echo $app['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $app['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $app['appid'];?>"<?php } ?> name="<?php echo $appid;?>" alt="<?php echo $app['appname'];?>" /><?php echo $app['appname'];?></a>
</li>
<?php } } } } else { ?>
<?php echo $nav['code'];?>
<?php } } } ?>
</ul>
<?php if($_G['setting']['my_app_status']) { if(!empty($_G['cache']['userapp'])) { ?>
<ul id="my_defaultapp"><?php if(is_array($_G['cache']['userapp'])) foreach($_G['cache']['userapp'] as $value) { ?><li><a href="userapp.php?mod=app&amp;id=<?php echo $value['appid'];?>"><img <?php if($value['icon']) { ?>src="<?php echo $value['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $value['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $value['appid'];?>"<?php } ?> alt="<?php echo $value['appname'];?>" /><?php echo $value['appname'];?></a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_top'])) echo $_G['setting']['pluginhooks']['userapp_menu_top']; ?>
</ul>
<?php } if($_G['my_menu']) { ?>
<ul id="my_userapp"><?php if(is_array($_G['my_menu'])) foreach($_G['my_menu'] as $value) { ?><li id="userapp_li_<?php echo $value['appid'];?>"><a href="userapp.php?mod=app&amp;id=<?php echo $value['appid'];?>" title="<?php echo $value['appname'];?>"><img <?php if($value['icon']) { ?>src="<?php echo $value['icon'];?>" onerror="this.onerror=null;this.src='http://appicon.manyou.com/icons/<?php echo $value['appid'];?>'"<?php } else { ?> src="http://appicon.manyou.com/icons/<?php echo $value['appid'];?>"<?php } ?> alt="<?php echo $value['appname'];?>" /><?php echo $value['appname'];?></a></li>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['userapp_menu_middle'])) echo $_G['setting']['pluginhooks']['userapp_menu_middle']; ?>
</ul>
<?php } if($_G['my_menu_more']) { ?>
<p class="pbm bbda xg1 cl"><a href="javascript:;" class="unfold" id="a_app_more" onclick="userapp_open();">展开</a></p>
<?php } if(checkperm('allowmyop')) { ?>
<ul class="myo mtm">
<li><a href="userapp.php?mod=manage&amp;my_suffix=%2Fapp%2Flist"><img src="<?php echo IMGDIR;?>/app_add.gif" alt="app_add" />添加<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
<li><a href="userapp.php?mod=manage&amp;ac=menu"><img src="<?php echo IMGDIR;?>/app_set.gif" alt="app_set" />管理<?php echo $_G['setting']['navs']['5']['navname'];?></a></li>
</ul>
<?php } } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE])) echo $_G['setting']['pluginhooks']['global_userabout_bottom'][$_G['basescript'].'::'.CURMODULE]; ?>
<script type="text/javascript">inituserabout();</script><div class="drag">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>

</div>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<script type="text/javascript">
function fuidgoto(fuid) {
window.location.href = 'home.php?mod=space&do=trade&view=we&fuid='+fuid;
}
</script><?php include template('common/footer'); ?>