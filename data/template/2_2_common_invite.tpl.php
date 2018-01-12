<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('invite', 'common/header');
0
|| checktplrefresh('./template/default/common/invite.htm', './template/default/common/simplesearchform.htm', 1506049980, '2', './data/template/2_2_common_invite.tpl.php', './template/8264', 'common/invite')
;?><?php include template('common/header'); if($_G['gp_is_uc']) { ?>
<!--个人中心时的样式-->
<style type="text/css">
.popbox{ border:#d7d7d7 solid 1px; box-shadow: 0px 0px 3px rgba(0, 0, 0, .2); border-radius:3px; margin:10px auto; padding-bottom:50px;}
.popbox.pt0{ padding-bottom:0px}
.popbox a:hover{ text-decoration:none;}
.popbox.w570{ width:570px;}
.popbox.w300{ width:300px;}
.popbox.w450{ width:450px;}
.popbox_title{ height:49px; background:#f4f4f4;}
.popbox_title.whitebg{ background:#fff;}
.popbox_title span{ font-size:16px; color:#949494; float:left; margin:13px 0px 0px 19px; display:inline;}
.popbox_title a{ font-size:14px; color:#43a6df; margin:14px 0px 0px 10px; float:left;}
.popbox_title em{ float:right; width:15px; height:15px; background:url(../../../static/images/icon/usercentericon24.png) -5px -194px no-repeat; cursor:pointer; margin:16px 20px 0px 0px;}
.friendtitle{ font-size:12px; color:#949494; padding:20px 30px 13px 30px; overflow: hidden;}
.friendtitle select.h26{ height:26px; border:#dfdfdf solid 1px; border-radius:2px; font-size:12px; padding:0px 10px 0px 0px; background:#fdfdfd; margin-right:10px;}
.friendtitle select.h26 option{ height:20px; padding:4px 0px 0px 0px; font-size:12px; display:block; text-indent:6px; }
.friendtitle label{  color:#949494; margin-left:3px;}
.friendtitle i{ color:#43a6df; font-style:normal;}
.friendtitle span{ padding-left:10px;}
.friendtitle .searchbox{ float:right;}
.friendtitle .searchbox .searchtext{  border:#dfdfdf solid 1px; border-radius:2px; background:#fdfdfd; height:26px; width:330px; font-size:12px; text-indent:10px; width:158px; }
.friendtitle .searchbox .searchbutton{ background:#72c4f4; width:40px; height:28px; border:0 none; border-radius:2px; margin-left:6px; color:#fff; font-size:12px;}
.friendlistbox{ padding:0px 0px 0px 30px; margin-top:10px;}
.friendlistbox li{ width:48px; padding:6px; float:left; margin-right:16px; display:inline;}
.friendlistbox li:hover, .friendlistbox li.selected{ background-color:#e5e5e5; cursor:pointer; }
.friendlistbox li img{ width:48px; height:48px; border-radius:2px;}
.friendlistbox li span{ height:20px; font-size:12px; color:#585858; text-align:center; padding-top:7px; overflow:hidden; display:block;}
.popbox.textcenter{ text-align:center; padding:30px 0px;}
.popbox .textareabox{ padding:35px 0px 0px 80px;}
.popbox .textareabox span{ display:block; font-size:14px; color:#767676; padding-bottom:15px;}
.popbox .textareabox span i{ color:#43a6df; font-style:normal;}
.popbox .textareabox textarea{ width:400px; height:105px; border:#dfdfdf solid 1px; border-radius:2px; padding:5px 10px; margin-bottom:20px;}
.buttonbox{ padding:24px 0px 0px 30px;}
.button_confirm{ width:119px; height:40px; background:#ff7e00; font-size:16px; color:#fff; line-height:40px; text-align:center; border:0 none; border-radius:2px; cursor:pointer;}
.button_cancel{ width:119px; height:40px; background:#c2c2c2; font-size:16px; color:#fff; line-height:40px; text-align:center; border:0 none; border-radius:2px; cursor:pointer;}
.buttonbox .fn12{ font-size:12px; color:#949494; padding-left:10px;}
.fwinmask { border:#d7d7d7 solid 1px; box-shadow: 0px 0px 3px rgba(0, 0, 0, .2); border-radius:3px; }

.fwinmask input,.fwinmask select,.fwinmask button{ font-family:"Microsoft Yahei",Tahoma,Helvetica,SimSun,sans-serif;}
.popwarpten li:after,.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.popwarpten li,.clear_b{ zoom: 1;}
</style>
<form method="post" autocomplete="off" name="invite" id="inviteform" action="misc.php?mod=invite&amp;action=<?php echo $_G['gp_action'];?>&amp;id=<?php echo $_G['gp_id'];?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" />
<div class="popbox w570" style="margin:0px;">
<div class="flb">
<div class="popbox_title clearfix">
<span>邀请好友</span>
<em onclick="hideWindow('invite');"></em>
</div>
</div>
<div class="friendtitle">
<div class="left-box">				
<select class="ps" onchange="clearlist=1;getUser(this.value)" style="margin-right:5px;">
<option value="-1">全部好友</option><?php if(is_array($groups)) foreach($groups as $groupid => $group) { ?><option value="<?php echo $groupid;?>"><?php echo $group;?></option>
<?php } ?>
</select>				
<input name="" type="checkbox" value="" id="ext_allselectbtn" onclick=" ext_allselect('myfans',1);"><label for="ext_allselectbtn" id="for_ext_allselectbtn">全选</label>
<span>已选<i id="selectNum">0</i>个</span>
</div>
<div class="searchbox" style="position:relative;">
<input name="username" id="username" type="text" class="searchtext searchMain">
<input type="text" class="searchtext searchText" value="搜索" style="position:absolute;top:0;left:0;">
</div>
</div>
<div class="friendlistbox clearfix">
<ul id="myfans" style="max-height:260px;">
</ul>
</div>
<div class="buttonbox">
<button type="submit" class="button_confirm" name="invitesubmit" value="yes">发送邀请</button><span class="fn12">邀请信息将保留15天，过期后将被删除</span>
</div>
</div>
</form>
<script type="text/javascript">
setTimeout(function() {
var fans_num = jQuery("#myfans li").size();
if(fans_num > 21){
jQuery("#myfans").css({ "height":"260px", "overflow-x":"hidden" , "overflow-y":"scroll" , "margin-right":"30px"});
jQuery(".friendlistbox li").css({ "margin-right":"5px"});
}
}, 1000);
jQuery(function(){
jQuery('.searchText').click(function(){
jQuery(this).prev().focus();
jQuery(this).hide();
});
jQuery('.searchMain').blur(function(){
if (jQuery(this).val() == '') {			
jQuery(this).next().show();	
}
});
});
</script>
<?php } else { ?>
<!--活动详细页的样式-->
<link href="http://static.8264.com/static/css/home/misc_invite.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<style type="text/css">
.usl li {overflow:hidden;}
.usl li img {float:left;}
.usl li span {margin-left:5px;width:70px;display:block;float:left;}
.usl li.selected a {background-color:#fff1e1;border:1px solid #ff9900;}
</style>

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
<?php } } ?><div class="z"><a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em> 邀请</div>
</div>
<div id="ct" class="wp cl">
<div class="mn">
<div class="bm bw0">
<h1 class="mt">邀请好友<?php echo $invitename;?></h1>
<div class="usd usd2">
<?php } else { ?>
<div id="main_messaqge">
<h3 class="flb">
<em>邀请好友</em>
<span>
<?php if($_G['inajax']) { ?><a href="javascript:;" class="flbc" onclick="hideWindow('invite')" title="关闭">关闭</a><?php } ?>
</span>
</h3>
<div class="usd">
<?php } ?>
<ul class="cl">
<li>
<p>按好友用户名查找</p>
<p class="mtn"><input type="text" name="username" size="25" id="username" class="px" value="" autocomplete="off" /></p>
</li>
<li>
<p>&nbsp;</p>
<p class="mtn">													
<select class="ps" onchange="clearlist=1;getUser(this.value)" style="margin-right:5px;">
<option value="-1">全部好友</option><?php if(is_array($groups)) foreach($groups as $groupid => $group) { ?><option value="<?php echo $groupid;?>"><?php echo $group;?></option>
<?php } ?>
</select>							
</p>
</li>
</ul>
<div class="tbx">
<input name="" type="checkbox" value="" id="ext_allselectbtn" onclick=" ext_allselect('myfans',1);"><label for="ext_allselectbtn" id="for_ext_allselectbtn" style="margin-left:5px;">全选</label>
<span>已选(<strong id="selectNum">0</strong>)</span>
</div>
</div>
<ul class="usl cl<?php if(empty($_G['inajax'])) { ?> usl2<?php } ?>" id="myfans"></ul>
<form method="post" autocomplete="off" name="invite" id="inviteform" action="misc.php?mod=invite&amp;action=<?php echo $_G['gp_action'];?>&amp;id=<?php echo $_G['gp_id'];?>">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<?php if(!empty($_G['inajax'])) { ?><input type="hidden" name="handlekey" value="<?php echo $_G['gp_handlekey'];?>" /><?php } ?>
<p class="o pns<?php if(empty($_G['inajax'])) { ?> mtw<?php } ?>"><b style="margin-right:20px;color:#F26C4F;cursor:pointer;">邀请信息将保留15天，过期后将被删除</b><button type="submit" class="pn pnc" name="invitesubmit" value="yes"><strong>发送邀请</strong></button></p>
</form>
</div>
<?php if(!$_G['inajax']) { ?>
</div>
</div>
<?php } } ?>

<script type="text/javascript">
var invitefs;
var clearlist = 0;

function ext_allselect(ulid,status){
ext_btn = document.getElementById('ext_allselectbtn');
ext_ul = document.getElementById(ulid);
ext_li = ext_ul.getElementsByTagName("li");
for(var i=0; i<ext_li.length; i++){
//判断不超过100个好友
if(i <= 1000){
ext_a = ext_li[i].getElementsByTagName("a");
invitefs.select(ext_a[0].id);
}						
}
if(status){
jQuery("#for_ext_allselectbtn").text("取消全选");
ext_btn.onclick = function(){
    ext_allselect('myfans',0);	
};
}else{
jQuery("#for_ext_allselectbtn").text("全选");
ext_btn.onclick = function(){
    ext_allselect('myfans',1);
};
}
}		

function getUser(gid) {

//选择的粉丝清零
jQuery("#myfans li").each(function(){
if (jQuery(this).hasClass('selected')) {
invitefs.select(jQuery(this).find('a').attr('id'));
}			
});

var x = new Ajax();
x.get('home.php?mod=spacecp&ac=friend&op=getinviteuser&inajax=1&gid='+ gid + '&' + Math.random(), function(s) {
var data = eval('('+s+')');
var singlenum = parseInt(data['singlenum']);
var maxfriendnum = parseInt(data['maxfriendnum']);
invitefs.addDataSource(data, clearlist);

//选择的粉丝清零
jQuery("#ext_allselectbtn").attr('checked', false);	
jQuery("#for_ext_allselectbtn").html("全选");					
jQuery("#selectNum").html('0');	

console.log(data['sql']);

});
}
function selector() {
var num=<?php echo $count;?>;
var parameter = {'searchId':'username', 'showId':'myfans', 'formId':'inviteform', 'showType':1, 'handleKey':'invitefs', 'maxSelectNumber':'1000',
'allNumber':num, 'selectTabId':'selectNum', 'unSelectTabId':'unSelectTab', 'maxSelectTabId':'remainNum'};

invitefs = new friendSelector(parameter);
<?php if($inviteduids) { ?>
invitefs.addFilterUser([<?php echo $inviteduids;?>]);
<?php } ?>

getUser('-1');
}
var scriptNode = document.createElement("script");
scriptNode.type = "text/javascript";
scriptNode.src = '<?php echo $_G['setting']['jspath'];?>home_friendselector.js?<?php echo VERHASH;?>';
if(BROWSER.ie) {
scriptNode.onreadystatechange = function () {
if(scriptNode.readyState == 'loaded' || scriptNode.readyState == 'complete') {
selector();
}
}
} else {
scriptNode.onload = selector;
}
$('append_parent').appendChild(scriptNode);			
</script><?php include template('common/footer'); ?>