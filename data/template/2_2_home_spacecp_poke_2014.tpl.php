<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_poke_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/spacecp_poke_2014.htm', './template/default/home/spacecp_poke_type.htm', 1506411027, '2', './data/template/2_2_home_spacecp_poke_2014.tpl.php', './template/8264', 'home/spacecp_poke_2014')
|| checktplrefresh('./template/8264/home/spacecp_poke_2014.htm', './template/8264/home/space_left_2014.htm', 1506411027, '2', './data/template/2_2_home_spacecp_poke_2014.tpl.php', './template/8264', 'home/spacecp_poke_2014')
|| checktplrefresh('./template/8264/home/spacecp_poke_2014.htm', './template/8264/home/space_footer_2014.htm', 1506411027, '2', './data/template/2_2_home_spacecp_poke_2014.tpl.php', './template/8264', 'home/spacecp_poke_2014')
;?><?php include template('common/header_8264_new'); ?><?php $icons = array(
0 => '不用动作',
1 => '<img alt="cyx" src="'.STATICURL.'image/poke/cyx.gif" class="vm" /> 踩一下',
2 => '<img alt="wgs" src="'.STATICURL.'image/poke/wgs.gif" class="vm" /> 握个手',
3 => '<img alt="wx" src="'.STATICURL.'image/poke/wx.gif" class="vm" /> 微笑',
4 => '<img alt="jy" src="'.STATICURL.'image/poke/jy.gif" class="vm" /> 加油',
5 => '<img alt="pmy" src="'.STATICURL.'image/poke/pmy.gif" class="vm" /> 抛媚眼',
6 => '<img alt="yb" src="'.STATICURL.'image/poke/yb.gif" class="vm" /> 拥抱',
7 => '<img alt="fw" src="'.STATICURL.'image/poke/fw.gif" class="vm" /> 飞吻',
8 => '<img alt="nyy" src="'.STATICURL.'image/poke/nyy.gif" class="vm" /> 挠痒痒',
9 => '<img alt="gyq" src="'.STATICURL.'image/poke/gyq.gif" class="vm" /> 给一拳',
10 => '<img alt="dyx" src="'.STATICURL.'image/poke/dyx.gif" class="vm" /> 电一下',
11 => '<img alt="yw" src="'.STATICURL.'image/poke/yw.gif" class="vm" /> 依偎',
12 => '<img alt="ppjb" src="'.STATICURL.'image/poke/ppjb.gif" class="vm" /> 拍拍肩膀',
13 => '<img alt="yyk" src="'.STATICURL.'image/poke/yyk.gif" class="vm" /> 咬一口'
); ?><link href="http://static.8264.com/static/css/home/notice.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">

<?php if(!$_G['inajax']) { ?>
<div class="w980">
<div class="t_980">招呼</div>
<div class="clear_b">	<div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked navigate_notification">
<li <?php if($notify_type == 'notification') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=notification"><s class="menu-nav-icon icon-1">提醒</s><span showclass="li_tz">通知
</span><?php if(isset($space['notifications']) && $space['notifications']) { ?><em class="number"><?php echo $space['notifications'];?></em><?php } ?></a>
</li>
<li <?php if($notify_type == 'invitation') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=invitation"><s class="menu-nav-icon icon-2">邀请</s><span showclass="li_yq">邀请
</span><?php if(isset($space['newinvite']) && $space['newinvite']) { ?><em class="number"><?php echo $space['newinvite'];?></em><?php } ?></a>
</li>
<!--
<li <?php if($notify_type == 'greeting') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=greeting"><s class="menu-nav-icon icon-5">招呼</s><span showclass="li_dzh">招呼
</span><?php if(isset($space['pokes']) && $space['pokes']) { ?><em class="number"><?php echo $space['pokes'];?></em><?php } ?></a>
</li>
-->
<li <?php if($notify_type == 'smessage' || $_G['gp_ac'] == 'pm' || $_G['gp_do'] == 'pm') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&do=notice&type=smessage"><s class="menu-nav-icon icon-7">短消息</s><span showclass="li_dxx">短消息
</span><?php if(isset($space['newpm']) && $space['newpm']) { ?><em class="number smessage_number"><?php echo $space['newpm'];?></em><?php } ?></a>
</li>

<li <?php if($_G['gp_mod'] == 'task') { ?>class="active"<?php } ?>>
<a href="<?php echo $_G['config']['web']['home'];?>home.php?mod=task&item=new"><s class="menu-nav-icon icon-8">任务</s><span showclass="li_dxx">任务
</span><?php if($taskcount) { ?><em class="number smessage_number"><?php echo $taskcount;?></em><?php } ?></a>
</li>
</ul>
        <div style="margin:10px 0px 0px 0px;"><?php echo adshow("custom_435"); ?></div>
</div>
    
<div class="r_760">
<div class="top_q_d clear_b">
<a href="home.php?mod=spacecp&amp;ac=poke"<?php if($actives['poke']) { ?> class="zhong"<?php } ?>>收到的招呼</a>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=send"<?php if($actives['send']) { ?> class="zhong"<?php } ?>>打个招呼</a>

<?php if($op == '') { ?>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=ignore" id="a_poke" onclick="showWindow('allignore', this.href, 'get', 0);" class="ckqb">全部忽略</a>
<?php } ?>
</div>			
<?php } if($op == 'send' || $op == 'reply') { if($_G['inajax']) { ?>
<h3 class="flb">
<em id="return_<?php echo $_G['gp_handlekey'];?>">打个招呼</em>
<span><a href="javascript:;" onclick="hideWindow('<?php echo $_G['gp_handlekey'];?>');" class="flbc" title="关闭">关闭</a></span>
</h3>
<?php } ?>

<form method="post" autocomplete="off" id="pokeform_<?php echo $tospace['uid'];?>" name="pokeform_<?php echo $tospace['uid'];?>" action="home.php?mod=spacecp&amp;ac=poke&amp;op=<?php echo $op;?>&amp;uid=<?php echo $tospace['uid'];?>" <?php if($_G['inajax']) { ?>onsubmit="ajaxpost(this.id, 'return_<?php echo $_G['gp_handlekey'];?>');"<?php } ?>>
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>">
<input type="hidden" name="pokesubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="from" value="<?php echo $_G['gp_from'];?>" />
<?php if($_G['inajax']) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>

<div class="<?php if($_G['inajax']) { ?>tc<?php } else { ?>b_bg pt35<?php } ?>">
<?php if($tospace['uid']) { ?>
<div class="rmwarpten clear_b" >
<a href="home.php?mod=space&amp;uid=<?php echo $tospace['uid'];?>" class="tx"><?php echo avatar($tospace[uid],small); ?></a>
<span class="info">向 <strong><?php echo $tospace['username'];?></strong> 打个招呼：</span>
</div>
<?php } else { ?>
<div class="yhmwarpten clear_b">
<span class="name">用户名：</span>
<span class="r_600"><input name="username" type="text" class="input_g w215" /></span>
</div>
<?php } ?>
<div class="zhbox clear_b">
<ul><?php if(is_array($icons)) foreach($icons as $k => $v) { ?><li><input type="radio" name="iconid" id="poke_<?php echo $k;?>" value="<?php echo $k;?>" /> <label for="poke_<?php echo $k;?>"><?php echo $v;?></label></li>
<?php } ?>
</ul>							
</div>
<div class="sdsm">
<input type="text" name="note" id="note" value="" size="30" onkeydown="ctrlEnter(event, 'pokesubmit_btn', 1);" class="input_g w215" />
<p class="mbm xg1">内容为可选，并且会覆盖之前的招呼，最多150个字符</p>
</div>
<div class="fsbuttonwarpten"><button type="submit" name="pokesubmit_btn" id="pokesubmit_btn" value="true" class="fsbutton"></button></div>
</div>
</form>

<script type="text/javascript">
function succeedhandle_<?php echo $_G['gp_handlekey'];?>(url, msg, values) {
if(values['from'] == 'notice') {
getNewPokeQuery(values['uid']);
}
<?php if($_G['gp_handlekey'] == 'pokereply') { ?>
var totalPage = 1;
var curPage = 1;
if(jQuery('span.mulitpage').length == 1) {
if(jQuery('span.mulitpage strong').length == 1) {
curPage = parseInt(jQuery('span.mulitpage strong').text());
}
if(jQuery('span.mulitpage *:last').prop("tagName") != 'STRONG') {
totalPage = parseInt(jQuery('span.mulitpage a[class!=nxt]:last').text().replace(/[^0-9]/gi, ''));
}
else {
totalPage = curPage;
}
}
var ul = jQuery('#poke_body_' + values['uid']).parent('ul');
$('poke_body_' + values['uid']).remove();
var pageCount =  ul.children('li').length;
if(pageCount == 0) {
if(totalPage == 1) {
ul.html('<li id="more_tips_new" style="text-align:center;"><div style="font-size:14px; text-align:center; padding:10px 0px;"><img src="http://static.8264.com/static/images/no_new_notice.png"/><span style="padding-top:10px; display:block;"><p>您当前没有 <em>招呼</em> 可以显示</p></span></div></li>');
}
else {
var page = curPage < totalPage ? curPage : (totalPage - 1);
var redirect = "home.php?mod=space-do=notice-type=greeting-action=show-page=" + page + "-refresh=" + new Date().getTime();
window.location.href = redirect.replace(/-/g, '&');
}
}
<?php } ?>
showCreditPrompt();
}
</script>
<?php } elseif($op == 'getpoke') { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $pokequery['fromuid'];?>" class="tx"><?php echo avatar($pokequery[fromuid],small); ?></a>
<div class="listcon" id="pokeQuery_<?php echo $pokequery['fromuid'];?>">
<div class="con615">
<div class="upcon">
<a href="home.php?mod=space&amp;uid=<?php echo $pokequery['fromuid'];?>" class="name"><?php echo $pokequery['fromusername'];?></a>
<span style="padding-right:8px;"><?php if($pokequery['iconid']) { ?><?php echo $icons[$pokequery['iconid']];?><?php } else { ?>打个招呼<?php } ?></span>
<span class="wz58"><?php if($pokequery['note']) { ?><?php echo $pokequery['note'];?><?php } ?></span>
<span class="time"><?php echo dgmdate($pokequery[dateline],'Y-m-d H:i'); ?></span>
</div>
<div class="downcon">
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=reply&amp;uid=<?php echo $pokequery['fromuid'];?>&amp;from=notice" id="a_p_r_<?php echo $pokequery['fromuid'];?>" class="hdzh" onclick="showWindow(this.id, this.href, 'get', 0);"></a>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=ignore&amp;uid=<?php echo $pokequery['fromuid'];?>&amp;from=notice" id="a_p_i_<?php echo $pokequery['fromuid'];?>" class="hlsq" onclick="showWindow('pokeignore', this.href, 'get', 0);">忽略</a>
</div>
</div>
</div>
<?php } elseif($op == 'view') { ?><?php $i=1; if(is_array($list)) foreach($list as $key => $subvalue) { ?><div class="upcon<?php if($i>1) { ?> b_top<?php } ?>">
<?php if($subvalue['fromuid']==$space['uid']) { ?>
我
<?php } else { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $subvalue['fromuid'];?>" class="name"><?php echo $value['fromusername'];?></a>
<?php } if($subvalue['iconid']) { ?><?php echo $icons[$subvalue['iconid']];?><?php } else { ?>打个招呼<?php } if($subvalue['note']) { ?>, 说: <?php echo $subvalue['note'];?><?php } ?>
&nbsp;&nbsp;
<span class="time"><?php echo dgmdate($subvalue[dateline],'Y-m-d H:i'); ?></span>
</div><?php $i++; } ?>
<div class="downcon">
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=reply&amp;uid=<?php echo $value['uid'];?>&amp;handlekey=pokehk_<?php echo $value['uid'];?>" id="a_p_r_<?php echo $value['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="hdzh"></a>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=ignore&amp;uid=<?php echo $value['uid'];?>" id="a_p_i_<?php echo $value['uid'];?>" onclick="showWindow('pokeignore', this.href, 'get', 0);" class="hlsq">忽略</a>
<?php if(!$value['isfriend']) { ?><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $value['uid'];?>&amp;handlekey=addfriendhk_<?php echo $value['uid'];?>" id="a_friend_<?php echo $value['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="jghy">加好友</a><?php } ?>
</div>
<?php } else { if($list) { ?>
<div class="list760">
<ul id="poke_ul"><?php if(is_array($list)) foreach($list as $key => $value) { ?><li id="poke_<?php echo $value['uid'];?>">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" class="tx"><?php echo avatar($value[uid],small); ?></a>
<div class="listcon w680">
<div class="con615 w680" id="poke_td_<?php echo $value['uid'];?>">
<div class="upcon">
<a href="home.php?mod=space&amp;uid=<?php echo $value['fromuid'];?>" class="name"><?php echo $value['fromusername'];?></a>
<?php if($value['iconid']) { ?><?php echo $icons[$value['iconid']];?><?php } else { ?>打个招呼<?php } if($value['note']) { ?>, 说: <?php echo $value['note'];?><?php } ?>
&nbsp;&nbsp;
<span class="time"><?php echo dgmdate($value[dateline], 'Y-m-d H:i'); ?></span>
</div>
<div class="downcon">
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=reply&amp;uid=<?php echo $value['uid'];?>&amp;handlekey=pokereply" id="a_p_r_<?php echo $value['uid'];?>" onclick="showWindow('pokereply', this.href, 'get', 0);" class="hdzh"></a>
<?php if(!$value['isfriend']) { ?><a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $value['uid'];?>&amp;handlekey=addfriendhk_<?php echo $value['uid'];?>" id="a_friend_<?php echo $value['uid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);" class="jghy">加好友</a><?php } ?>
<a href="home.php?mod=spacecp&amp;ac=poke&amp;op=ignore&amp;uid=<?php echo $value['uid'];?>&amp;handlekey=pokeignore" id="a_p_i_<?php echo $value['uid'];?>" onclick="showWindow('pokeignore', this.href, 'get', 0);" class="hlsq">忽略</a>
</div>
</div>
</div>
</li>
<?php } ?>
</ul>
</div>
<?php if($multi) { ?>
<div class="fenyewarpten clear_b"><?php echo $multi;?></div>
<?php } else { ?>
<div class="fheight"></div>
<?php } ?>
<script type="text/javascript">
jQuery("#poke_ul>li").eq(0).css('border-top','0 none');
function view_poke(uid) {
ajaxget('home.php?mod=spacecp&ac=poke&op=view&uid='+uid, 'poke_td_'+uid);
}
</script>
<?php } else { ?>
<div class="emp">还没有新招呼</div>
<?php } ?>
<script type="text/javascript">
function errorhandle_pokeignore(msg, values) {
if(parseInt(values['uid'])) {
$('poke_'+values['uid']).style.display = "none";
}
}
function errorhandle_allignore(msg, values) {
if($('poke_ul')) {
$('poke_ul').innerHTML = '<p class="emp">忽略了全部的招呼</p>';
}
}				
</script>
<?php } if(!$_G['inajax']) { ?>
</div>
</div>
</div><script type="text/javascript">
var ie6=false;
if(/msie/.test(navigator.userAgent.toLowerCase()) && 'undefined' == typeof(document.body.style.maxHeight)){
ie6=true;
}
if(ie6){
jQuery(".w980").css('height',jQuery(window).height()-130);
} else {
jQuery(".w980").css('min-height',jQuery(window).height()-130);
}

jQuery(".list760 li").hover(function(){
jQuery(this).addClass("z");
},function(){
jQuery(this).removeClass("z");
})
</script><?php } include template('common/footer_8264_new'); ?>