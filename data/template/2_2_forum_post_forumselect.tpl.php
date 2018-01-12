<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post_forumselect', 'common/header');?><?php include template('common/header'); ?><div class="popbox w570" style="display:none;">
        <!--新的论坛首页点击发布帖子，弹出对话框，判断是否显示“进入论坛首页的界面”-->
<div class="flb">
<div class="popbox_title clearfix">
<span>选择版块</span>
<a href="<?php echo $_G['config']['web']['forum'];?>" style="<?php if($_G['gp_action'] == 'navnew') { ?>display:none;<?php } ?>">进入论坛首页>></a>
<em onclick="hideWindow('nav')"></em>	
<span style="display:none;" id="selectFid">0</span>	
</div>
</div>
<div class="tagtitle">
<?php if($commonlist) { ?>
<span class="hover">常用版块</span>
<?php } ?><?php $index = 0; if(is_array($grouplist)) foreach($grouplist as $v) { ?><span <?php if(!$commonlist && $index == 0) { ?>class="hover"<?php } ?>><?php echo $v['name'];?></span><?php $index++; } ?>
</div>
<div id="bbsbox">
<?php if($commonlist) { ?>
<div>
<div class="popwarpten pl20 clearfix">
<ul class="popbbslist w165"><?php if(is_array($commonlist)) foreach($commonlist as $v) { ?><li onclick="selectFid('<?php echo $v['fid'];?>')" class="li_<?php echo $v['fid'];?>"><?php $forumfieldlist[$v[fid]][icon] = str_replace('62x62', '34x34', $forumfieldlist[$v[fid]][icon]); ?><a href="javascript:void(0);" class="iconbox"><?php if($v['fup'] == 76) { ?><?php echo $v['extra']['localname'];?><?php } else { ?><img width="34" height="34" src="<?php echo $forumfieldlist[$v['fid']]['icon'];?>"><?php } ?></a>
<p>
<a href="javascript:void(0);" class="titlename"><?php echo $v['name'];?></a>
</p>
</li>
<?php } ?>
</ul>
</div>
<div class="buttonbox">
<button class="button_confirm" onclick="locationPost()">发新帖</button>
<span class="msg_tip">请选择板块</span>
</div>
</div>
<?php } if($forumlist) { if(is_array($forumlist)) foreach($forumlist as $key => $val) { ?>                
<div style="display:none;">
<div class="popwarpten pl20 clearfix">
<ul class="popbbslist <?php if($key != 76) { ?>w165<?php } ?>"><?php if(is_array($val)) foreach($val as $v) { ?>                                        
<li onclick="selectFid('<?php echo $v['fid'];?>')" class="li_<?php echo $v['fid'];?>"><?php $forumfieldlist[$v[fid]][icon] = str_replace('62x62', '34x34', $forumfieldlist[$v[fid]][icon]); ?><a href="javascript:void(0);" class="iconbox"><?php if($v['fup'] == 76) { ?><?php echo $v['extra']['localname'];?><?php } else { ?><img width="34" height="34" src="<?php echo $forumfieldlist[$v['fid']]['icon'];?>"><?php } ?></a>
<p>
<a href="javascript:void(0);" class="titlename"><?php echo $v['name'];?></a>
</p>
</li>	
<?php } ?>				
</ul>
</div>
<div class="buttonbox">
<button class="button_confirm" onclick="locationPost()">发新帖</button>
<span class="msg_tip">请选择板块</span>
</div>
</div>
<?php } } ?>		
</div>
</div>
<script>
jQuery(function(){
//板块大类切换
jQuery(".tagtitle span").mouseover(function(){
jQuery(this).addClass("hover").siblings().removeClass("hover");
var index = jQuery(".tagtitle span").index(this);
jQuery("#bbsbox > div").eq(index).show().siblings().hide();
});

jQuery("#bbsbox > div").eq(0).show().siblings().hide();

//弹出框位置调整
var forumselecthandle = setInterval(function(){																								
if (jQuery('.fwinmask').length > 0) {
var offsetleft = (jQuery('body').width() - jQuery('.fwinmask .popbox').width()) / 2;			
jQuery('.fwinmask').css({'top':'120px', 'left':offsetleft+'px'});
jQuery('.fwinmask .popbox').show();
clearInterval(forumselecthandle);
}
},10);
});

function selectFid(fid) {
jQuery('#selectFid').html(fid);
jQuery('.popbbslist li').removeClass('active');
jQuery('.li_'+fid).addClass('active');
jQuery('.msg_tip').hide();
}

function locationPost() {
var fid = jQuery('#selectFid').html();
fid = parseInt(fid, 10);
if (fid > 0) {
hideWindow('nav');
window.open('<?php echo $_G['config']['web']['forum'];?>forum-post-action-newthread-fid-'+fid+'.html');
} else {
jQuery('.msg_tip').show();
}
}
</script><?php include template('common/footer'); ?>