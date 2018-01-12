<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_search_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/spacecp_search_2014.htm', './template/8264/home/fans/leftnav.htm', 1503322036, '2', './data/template/2_2_home_spacecp_search_2014.tpl.php', './template/8264', 'home/spacecp_search_2014')
|| checktplrefresh('./template/8264/home/spacecp_search_2014.htm', './template/8264/home/space_footer_2014.htm', 1503322036, '2', './data/template/2_2_home_spacecp_search_2014.tpl.php', './template/8264', 'home/spacecp_search_2014')
;?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/home/fan.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">

<div class="w980">
<div class="t_980">好友</div>
<div class="clear_b"><div class="mt-menu-tree">
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
</script><div style="float:right; width:760px;" >

<?php if(!empty($_GET['searchsubmit'])) { if(empty($list)) { ?>
<div class="emp">没有找到相关用户<a href="home.php?mod=spacecp&amp;ac=search">换个搜索条件试试</a></div>
<?php } else { ?>
<div class="tbmu">以下是查找到的用户列表(最多显示100个)</div><?php include template('home/space_list'); } } else { ?>

<div class="b_bg pt35">
<form action="home.php" method="get">
<ul class="bdlist">
<li>
<span class="name">用户名：</span>
<span class="r_600"><input name="username" type="text" class="input_g w215" /></span>
</li>
<li>
<span class="name">用户UID：</span>
<span class="r_600"><input name="uid" type="text" class="input_g w215" /></span>
</li>
<li>
<span class="name">性别：</span>
<span class="r_600 pt5">
<select id="gender" name="gender" class="select_g">
<option value="0">任意</option>
<option value="1">男</option>
<option value="2">女</option>
</select>
</span>
</li>
<li>
<span class="name">年龄段：</span>
<span class="r_600 pt5">
<input name="startage" type="text" class="input_g w90" /> -
<input name="endage" type="text" class="input_g w90" />
</span>
</li>
<li>
<span class="name">上传头像：</span>
<span class="r_600 pt3"><input name="avatarstatus" type="checkbox" value="1" class="fxk"/>已经上传头像</span>
</li>
<li>
<span class="name">居住地：</span>
<span class="r_600 pt5" id="residecitybox"><?php echo $residecityhtml;?></span>
</li>
<li>
<span class="name">出生地：</span>
<span class="r_600 pt5" id="birthcitybox"><?php echo $birthcityhtml;?></span>
</li>
<li>
<span class="name">生日：</span>
<span class="r_600 pt5">
<select id="birthyear" name="birthyear" onchange="showbirthday();" class="select_g">
<option value="0">年</option>
<?php echo $birthyeayhtml;?>
</select>
<select id="birthmonth" name="birthmonth" onchange="showbirthday();" class="select_g">
<option value="0">月</option>
<?php echo $birthmonthhtml;?>
</select>
<select id="birthday" name="birthday" class="select_g">
<option value="0">日</option>
<?php echo $birthdayhtml;?>
</select>
</span>
</li><?php if(is_array($fields)) foreach($fields as $fkey => $fvalue) { ?><li>
<span class="name"><?php echo $fvalue['title'];?>：</span>
<span class="r_600"><?php echo $fvalue['html'];?></span>
</li>
<?php } ?>
<li>
<input type="hidden" name="searchsubmit" value="true" />
<button type="submit" class="czbutton"></button>
</li>
</ul>
<input type="hidden" name="op" value="<?php echo $_G['gp_op'];?>" />
<input type="hidden" name="mod" value="spacecp" />
<input type="hidden" name="ac" value="search" />
<input type="hidden" name="type" value="all" />
</form>
</div>
<?php } ?>
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
</script><?php include template('common/footer_8264_new'); ?>