<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('followee', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/fans/followee.htm', './template/8264/home/fans/leftnav.htm', 1509520140, '2', './data/template/2_2_home_fans_followee.tpl.php', './template/8264', 'home/fans/followee')
|| checktplrefresh('./template/8264/home/fans/followee.htm', './template/8264/home/space_footer_2014.htm', 1509520140, '2', './data/template/2_2_home_fans_followee.tpl.php', './template/8264', 'home/fans/followee')
;?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/home/fan.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css" />
<div class="container main-container">
<div class="module user-setting-wrap"><div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked">
<li <?php if($view == 'followee') { ?> class="active"<?php } ?>>
<a href="home.php?mod=space&amp;do=friend&amp;uid=<?php echo $uid;?>">
<s class="menu-nav-icon icon-1">关注</s>
<span>关注</span>
</a>
</li>
<li <?php if($view == 'fans') { ?> class="active"<?php } ?>>
<a href="home.php?mod=space&amp;do=friend&amp;view=fans&amp;uid=<?php echo $uid;?>">
<s class="menu-nav-icon icon-2">粉丝</s>
<span>粉丝</span>
</a>
</li>
<!--这版没有 开始-->
<!--
<li>
<a href="#">
<s class="menu-nav-icon icon-3">推荐关注</s>
<span>推荐关注</span>
</a>
</li>
-->
<!--这版没有 结束-->
</ul>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
var follow_url = "home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=%uid";
jQuery("a.ajax_follow_me").click(function() {
var uid = jQuery(this).attr("uid");
if(! uid) return false;
var id = "ajax_follow_me_" + uid;
var href = follow_url.replace(/%uid/g, uid).replace(/&amp;/g, "&");
showWindow(id, href, 'get', 0);
});
});
</script><div class="setting-form">
<div class="main-wrap">
<!--开始-->
<div class="form-box profile">
<div class="info-hd">
<span class="caption">我的关注</span>
<em class="caption-info">(<?php echo $following_count;?>人)</em>
<?php if($space['self']) { ?>
<div class="groups" id="groups">关注分组</div>
<div class="searchwarpten">
<input type="text" class="searchtext" placeholder="搜索" value="<?php echo $_G['gp_searchname'];?>">
<input type="button" class="searchbutton">
</div>
<div class="groups-down">
<?php if($groups) { ?>
<ul><?php if(is_array($groups)) foreach($groups as $gid => $gname) { ?><li groupid="<?php echo $gid;?>" <?php if(isset($privacy['filter_gid'][$gid])) { ?>blocked="blocked"<?php } ?>><a href="javascript:void(0);"><?php if(isset($privacy['filter_gid'][$gid])) { ?>[屏蔽]<?php } ?><?php echo $gname;?></a></li>
<?php } ?>
</ul>
<?php } ?>
</div>
<?php } ?>
</div>
<div class="info-bd">
<div class="friend-attention-list">
<ul>
<?php if($myfollowing) { if(is_array($myfollowing)) foreach($myfollowing as $uid => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo avatar($value['fwuid'],small); ?></a>
<div class="friend-attention-info">
<div class="nameinfo"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $value['username'];?></a><span class="nickname"><?php if($value['nickname']) { ?>(<?php echo $value['nickname'];?>)<?php } ?></span>
</div>
<?php if($space['self']) { ?>
<div class="friend-button">
<div class="friend-state">
<?php if($value['mutual'] == 1) { ?>
<em class="friend-mutualed">已关注</em>
<?php } elseif($value['mutual'] == 2) { ?>
<em class="friend-mutual">相互关注</em>
<?php } ?>
</div>
<span fuid="<?php echo $uid;?>"></span>
</div>
<div class="means" id="group_name_<?php echo $uid;?>"><?php echo $groups[$value['gid']];?></div>
<?php } ?>
</div>
</li>
<?php } } ?>
</ul>
</div>
</div>
<?php echo $multi;?>
</div>
<!--结束-->
</div>
</div>
</div>
</div>
<?php if($space['self']) { ?>
<!--头部弹出操作开始-->
<div class="operation" id="operationnav">
<a href="javascript:void(0);" class="editgroupname">编辑</a>
<!--<a href="javascript:void(0);">删除</a>-->
<a href="javascript:void(0);" class="blockgroup"></a>
</div>
<!--头部弹出操作结束-->
<!--内容弹出操作开始-->
<div class="operation" id="operation">
<a href="#" class="editname">备注</a>
<a href="#" class="send_message">发短消息</a>
<!-- <a href="#" class="greet">打招呼</a> -->
<a href="#" class="editgroup">关注分组</a>
<a href="#" class="unfollow">取消关注</a>
</div>
<?php } ?>
<!--内容弹出操作结束-->
<script type="text/javascript">
<?php if($space['self']) { ?>
//list操作jq开始
jQuery(function(){
jQuery(".friend-button span").click( function () {
var li = jQuery(this).parents('li:first');

var groups_x_y = jQuery(this).offset();
var e = eval(groups_x_y.left +5);
var t = eval(groups_x_y.top + 25);
jQuery("#operation").css({
left: e+"px",
top: t+"px",
display: "block",
zIndex: "9999"
}).off("mouseleave").mouseleave(function () {
jQuery(this).hide();
});
var uid = jQuery(this).attr("fuid");
/*send message*/
jQuery("#operation a.send_message").off("click").click(function(e) {
var href = "home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_%uid&amp;touid=%uid&amp;pmid=0&amp;daterange=2";
href = href.replace(/%uid/g, uid).replace(/&amp;/g, "&");
showWindow('showMsgBox', href, 'get', 0);
e.preventDefault();
jQuery(this).parent("div").hide();
});
/*greeting*/
/*jQuery("#operation a.greet").off("click").click(function(e) {
var href = "home.php?mod=spacecp&amp;ac=poke&amp;op=send&amp;uid=%uid";
href = href.replace(/%uid/g, uid).replace(/&amp;/g, "&");
var id = "a_poke_" + uid;

showWindow(id, href, 'get', 0);
e.preventDefault();
jQuery(this).parent("div").hide();
});*/
/*edit nickname*/
jQuery("#operation a.editname").off("click").click(function(e) {
var href = "home.php?mod=spacecp&amp;ac=friend&amp;op=editnickname&amp;uid=%uid";
href = href.replace(/%uid/g, uid).replace(/&amp;/g, "&");
id = "friend_editnote_" + uid;

showWindow(id, href, 'get', 0);
e.preventDefault();
jQuery(this).parent("div").hide();
});
/*change group*/
jQuery("#operation a.editgroup").off("click").click(function(e) {
var href = "home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=%uid";
href = href.replace(/%uid/g, uid).replace(/&amp;/g, "&");
id = "friend_group_" + uid;

showWindow(id, href, 'get', 0);
e.preventDefault();
jQuery(this).parent("div").hide();
});
/*unfollow to somebody*/
jQuery("#operation a.unfollow").off("click").click(function(e) {
var url = "home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=%uid&amp;confirm=1";
url = url.replace(/%uid/g, uid).replace(/&amp;/g, "&");

dconfirm('取消关注', '确认取消关注吗?', function() {
jQuery.post(url, {uid:uid}, function(data) {
if(data == 'success') {
showDialog("<p>取消关注成功</p>", 'notice', '','' , 0, '', '', '', '', 2);
li.remove();
}
});
});

e.preventDefault();
jQuery(this).parent("div").hide();
});
});

jQuery("#groups").click( function () {
if(jQuery(".groups-down").is(":hidden")){
jQuery(".groups-down").show();
}else{
jQuery(".groups-down").hide();
}
});

//导航弹出操作jq开始
jQuery(".groups-down li").click( function () {
var groups_x_y = jQuery(this).offset();
var e = eval(groups_x_y.left + 30);
var t = eval(groups_x_y.top + 28);
jQuery("#operationnav").css({
left: e+"px",
top: t+"px",
display: "block",
zIndex: "9999"
});
var blocked = jQuery(this).attr("blocked");
var block_content = '';
if(blocked == 'blocked') {
jQuery("#operationnav a.blockgroup").text("取消");
block_content = "在首页显示该用户组的好友动态?";
}
else {
jQuery("#operationnav a.blockgroup").text("屏蔽");
block_content = "在首页不显示该用户组的好友动态?";
}
var gid = jQuery(this).attr('groupid');
if(! gid) return;

//edit group name
jQuery("#operationnav a.editgroupname").off("click").click(function(e) {
var href = "home.php?mod=spacecp&amp;ac=friend&amp;op=editgroupname&amp;group=%group_id";
href = href.replace(/%group_id/g, gid).replace(/&amp;/g, "&");
var id = "c_edit_" + gid;
showWindow(id, href, 'get', 0);
e.preventDefault();
jQuery(this).parent("div").hide();

jQuery(".groups-down").hide();
});

//block group
jQuery("#operationnav a.blockgroup").off("click").click(function() {
jQuery("#operationnav").hide();
dconfirm('调整用户组动态', block_content, function() {
var url = "home.php?mod=spacecp&amp;ac=friend&amp;op=blockgroup&amp;group=%groupid&amp;handlekey=ignorehk_%groupid";
url = url.replace(/%groupid/g, gid).replace(/&amp;/g, "&");
jQuery.post(url, {group:gid}, function(data) {
if(data == 'success') {
var text = jQuery("li[groupid=" + gid + "] a").text();
if(text.indexOf('屏蔽') > 0) {
jQuery("li[groupid=" + gid + "] a").text(text.replace("[屏蔽]", ''));
jQuery("li[groupid=" + gid + "]").removeAttr("blocked");
}
else {
jQuery("li[groupid=" + gid + "] a").text("[屏蔽]" + text);
jQuery("li[groupid=" + gid + "]").attr("blocked", "blocked");
}
}
else {
showDialog("<p>服务器正忙, 请您稍后再试!</p>", 'notice', '','' , 0, '', '', '', '', 2);
}
});
});
});

});
//导航弹出操作jq结束

//search by username
jQuery("div.searchwarpten :input.searchbutton").click(function(){
var searchtext = jQuery("div.searchwarpten :input.searchtext").val();
if(! searchtext || searchtext == '搜索') {
showDialog("<p>搜索 名称不能为空!</p>", 'notice', '','' , 0, '', '', '', '', 2);
return;
}
var href = "home.php?mod=space&amp;do=friend&amp;searchname=" + searchtext;
href = href.replace(/&amp;/g, "&");
window.location.href = href;
});
});
//list操作jq结束
<?php } ?>
//点击弹出关闭按钮整体关闭
jQuery(function(){
jQuery(".set-box").click( function () {
jQuery(".fpall").hide();
});
});
jQuery(function(){
jQuery(".set-box").click( function () {
jQuery(".fpall").hide();
});
});
</script><script type="text/javascript">
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
</script><?php include template('common/footer_8264_new'); ?>