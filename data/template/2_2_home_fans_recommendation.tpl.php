<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('recommendation', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/home/fans/recommendation.htm', './template/8264/home/fans/leftnav.htm', 1509517868, '2', './data/template/2_2_home_fans_recommendation.tpl.php', './template/8264', 'home/fans/recommendation')
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
<div class="form-box profile">
<div class="info-hd">
<em class="caption-info"><?php if($space['self']) { ?>你<?php } else { ?>他<?php } ?>还没有<?php if($view== 'fans') { ?>任何粉丝<?php } else { ?>关注任何人<?php } ?>，以下用户你可能感兴趣：</em>
</div>
<div class="info-bd">
<div class="friend-attention-list friend-attention-list">
<ul><?php if(is_array($recommended_users)) foreach($recommended_users as $uid => $value) { ?><li>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo avatar($value['uid'],small); ?></a>
<div class="friend-attention-info">
<div class="nameinfo"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank"><?php echo $value['username'];?></a></div>
<div class="friend-button mt-10">
<div class="friend-state">
<a href="javascript:void(0);" class="friend-nonmutualing ajax_follow_me" uid="<?php echo $value['uid'];?>">关注</a>
</div>
</div>
</div>
<div class="tagging">惊喜！他就在你附近！</div>
</li>
<?php } ?>
</ul>
</div>
</div>
</div>				
</div>
</div>
</div>
</div><?php include template('common/footer_8264_new'); ?>