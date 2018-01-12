<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('fans', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/fans/fans.htm', './template/8264/home/fans/leftnav.htm', 1509517873, '2', './data/template/2_2_home_fans_fans.tpl.php', './template/8264', 'home/fans/fans')
|| checktplrefresh('./template/8264/home/fans/fans.htm', './template/8264/home/space_footer_2014.htm', 1509517873, '2', './data/template/2_2_home_fans_fans.tpl.php', './template/8264', 'home/fans/fans')
;?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/home/fan.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css" /><?php $opname = $isfollow ? '关注' : '粉丝'; ?><div class="container main-container">
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
<?php if($space['self']) { ?>
<span class="caption">我</span>
<?php } else { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>" class="caption" style="color:#1f6d9b;"><?php echo $space['username'];?></a>
<?php } ?>
<span class="caption">的<?php echo $opname;?></span>
<em class="caption-info">(<?php echo $fans_count;?>人)</em>
<div class="searchwarpten">
<input type="text" class="searchtext" placeholder="搜索" value="<?php echo $_G['gp_searchname'];?>">
<input type="button" class="searchbutton">
</div>
</div>
<div class="info-bd">
<div class="friend-fans-list">
<ul>
<?php if($fans ) { if(is_array($fans)) foreach($fans as $uid => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" class="tx60" target="_blank"><?php if($isfollow) { ?><?php echo avatar($value['fwuid'],small); } else { ?><?php echo avatar($value['fanuid'],small); } ?></a>
<div class="fans-info-warpten">
<div class="name-geographic">
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $value['username'];?></a>
<?php if($residences[$uid]) { ?><span><?php echo $residences[$uid];?></span><?php } ?>
</div>
<div class="attention-fans">
<span>关注<b><?php echo $fans_statitic[$uid]['followee'];?></b></span>
<span>|</span>
<span>粉丝<b><?php echo $fans_statitic[$uid]['fans'];?></b></span>
</div>
<?php if($slogons[$uid]) { ?>
<div class="new-publish">最新动态: <?php echo $slogons[$uid];?> !</div>
<?php } ?>
</div>
<?php if($space['self']) { ?>
<div class="fans-operate">
<?php if($value['mutual'] == 1) { ?>
<em class="friend-mutualed">已关注</em>
<?php } elseif($value['mutual'] == 2) { ?>
<em class="friend-mutual">相互关注</em>
<?php } else { ?>
<a href="javascript:void(0);" class="friend-nonmutualing ajax_follow_me" uid="<?php echo $uid;?>">关注</a>
<?php } ?>
<a href="javascript:void(0);" class="fans-operate-link send_message" uid="<?php echo $uid;?>">发私信</a>
</div>
<?php } ?>
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
<script type="text/javascript">
jQuery(document).ready(function() {
//search by username
jQuery("div.searchwarpten :input.searchbutton").click(function(){
var searchtext = jQuery("div.searchwarpten :input.searchtext").val();
if(! searchtext || searchtext == '搜索') {
showDialog("<p>搜索 名称不能为空!</p>", 'notice', '','' , 0, '', '', '', '', 2);
return;
}

var isfollow = '<?php echo $isfollow;?>';

var href = "home.php?mod=space&amp;do=friend";
href    += !isfollow ? "&view=fans" : '';
href    += "&uid=<?php echo $_GET['uid'];?>&searchname=" + searchtext;
href = href.replace(/&amp;/g, "&");
window.location.href = href;
});

/*send message*/
jQuery("a.send_message").off("click").click(function(e) {
var uid = jQuery(this).attr('uid');
if (! uid) return;
var href = "home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_%uid&amp;touid=%uid&amp;pmid=0&amp;daterange=2";
href = href.replace(/%uid/g, uid).replace(/&amp;/g, "&");
showWindow('showMsgBox', href, 'get', 0);
e.preventDefault();
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