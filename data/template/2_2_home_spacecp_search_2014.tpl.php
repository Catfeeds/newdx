<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('spacecp_search_2014', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/spacecp_search_2014.htm', './template/8264/home/fans/leftnav.htm', 1503322036, '2', './data/template/2_2_home_spacecp_search_2014.tpl.php', './template/8264', 'home/spacecp_search_2014')
|| checktplrefresh('./template/8264/home/spacecp_search_2014.htm', './template/8264/home/space_footer_2014.htm', 1503322036, '2', './data/template/2_2_home_spacecp_search_2014.tpl.php', './template/8264', 'home/spacecp_search_2014')
;?><?php include template('common/header_8264_new'); ?><link href="http://static.8264.com/static/css/home/fan.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">

<div class="w980">
<div class="t_980">����</div>
<div class="clear_b"><div class="mt-menu-tree">
<ul class="nav nav-tabs nav-stacked">
<li <?php if($view == 'followee') { ?> class="active"<?php } ?>>
<a href="home.php?mod=space&amp;do=friend&amp;uid=<?php echo $uid;?>">
<s class="menu-nav-icon icon-1">��ע</s>
<span>��ע</span>
</a>
</li>
<li <?php if($view == 'fans') { ?> class="active"<?php } ?>>
<a href="home.php?mod=space&amp;do=friend&amp;view=fans&amp;uid=<?php echo $uid;?>">
<s class="menu-nav-icon icon-2">��˿</s>
<span>��˿</span>
</a>
</li>
<!--���û�� ��ʼ-->
<!--
<li>
<a href="#">
<s class="menu-nav-icon icon-3">�Ƽ���ע</s>
<span>�Ƽ���ע</span>
</a>
</li>
-->
<!--���û�� ����-->
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
<div class="emp">û���ҵ�����û�<a href="home.php?mod=spacecp&amp;ac=search">����������������</a></div>
<?php } else { ?>
<div class="tbmu">�����ǲ��ҵ����û��б�(�����ʾ100��)</div><?php include template('home/space_list'); } } else { ?>

<div class="b_bg pt35">
<form action="home.php" method="get">
<ul class="bdlist">
<li>
<span class="name">�û�����</span>
<span class="r_600"><input name="username" type="text" class="input_g w215" /></span>
</li>
<li>
<span class="name">�û�UID��</span>
<span class="r_600"><input name="uid" type="text" class="input_g w215" /></span>
</li>
<li>
<span class="name">�Ա�</span>
<span class="r_600 pt5">
<select id="gender" name="gender" class="select_g">
<option value="0">����</option>
<option value="1">��</option>
<option value="2">Ů</option>
</select>
</span>
</li>
<li>
<span class="name">����Σ�</span>
<span class="r_600 pt5">
<input name="startage" type="text" class="input_g w90" /> -
<input name="endage" type="text" class="input_g w90" />
</span>
</li>
<li>
<span class="name">�ϴ�ͷ��</span>
<span class="r_600 pt3"><input name="avatarstatus" type="checkbox" value="1" class="fxk"/>�Ѿ��ϴ�ͷ��</span>
</li>
<li>
<span class="name">��ס�أ�</span>
<span class="r_600 pt5" id="residecitybox"><?php echo $residecityhtml;?></span>
</li>
<li>
<span class="name">�����أ�</span>
<span class="r_600 pt5" id="birthcitybox"><?php echo $birthcityhtml;?></span>
</li>
<li>
<span class="name">���գ�</span>
<span class="r_600 pt5">
<select id="birthyear" name="birthyear" onchange="showbirthday();" class="select_g">
<option value="0">��</option>
<?php echo $birthyeayhtml;?>
</select>
<select id="birthmonth" name="birthmonth" onchange="showbirthday();" class="select_g">
<option value="0">��</option>
<?php echo $birthmonthhtml;?>
</select>
<select id="birthday" name="birthday" class="select_g">
<option value="0">��</option>
<?php echo $birthdayhtml;?>
</select>
</span>
</li><?php if(is_array($fields)) foreach($fields as $fkey => $fvalue) { ?><li>
<span class="name"><?php echo $fvalue['title'];?>��</span>
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