<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/8264/forum/viewthread_node_2014.htm', './template/8264/forum/viewthread_node_body_2014.htm', 1509517908, '2', './data/template/2_2_forum_viewthread_node_2014.tpl.php', './template/8264', 'forum/viewthread_node_2014')
;?>
<div class="lxch_new clboth" id="post_<?php echo $post['pid'];?>">
<div id="pid<?php echo $post['pid'];?>"><?php $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']); ?><?php
$authorverifys = <<<EOF


EOF;
 if($_G['setting']['verify']['enabled']) { if(is_array($_G['setting']['verify'])) foreach($_G['setting']['verify'] as $vid => $verify) { if($verify['available'] && $post['verify'.$vid] == 1) { 
$authorverifys .= <<<EOF

<a href="home.php?mod=spacecp&amp;ac=profile&amp;op=verify&amp;vid={$vid}" target="_blank">
EOF;
 if($verify['icon']) { 
$authorverifys .= <<<EOF
<img src="{$verify['icon']}" class="vm" alt="{$verify['title']}" title="{$verify['title']}" />
EOF;
 } else { 
$authorverifys .= <<<EOF
{$verify['title']}
EOF;
 } 
$authorverifys .= <<<EOF
</a>&nbsp;

EOF;
 } } } 
$authorverifys .= <<<EOF


EOF;
?>

<div class="lxch_l">
<?php echo $post['newpostanchor'];?> <?php echo $post['lastpostanchor'];?>
<?php if($post['authorid'] && $post['username'] && !$post['anonymous']) { if($_G['setting']['authoronleft']) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="name_id_new" rel="nofollow"><?php echo $post['author'];?></a><?php echo $authorverifys;?>
<?php } } ?>

<div class="t_img_new" id="uboxbtn_<?php echo $post['pid'];?>" style="z-index:2;">
<?php if($_G['setting']['bannedmessages'] & 2 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || ($post['status'] & 1))) { ?>
<!--<span>头像被屏蔽</span>--><?php echo avatar(0); } elseif($post['avatar'] && $showavatars) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank"  rel="nofollow"><?php echo avatar($post['authorid']); ?></a>
<div class="lctx_t" id="ubox_<?php echo $post['pid'];?>">
<div class="lctx_tcon">
<div class="lctx_tcon_n">
<div class="cltx_head clboth">
<div class="cltxbox"><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" rel="nofollow"><?php echo avatar($post['authorid'], small); ?></a></div>
<div class="clnameinfo">
<a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="name" rel="nofollow"><?php echo $post['author'];?></a>
<a href="home.php?mod=spacecp&amp;ac=usergroup&amp;gid=<?php echo $post['groupid'];?>" target="_blank" rel="nofollow"><?php echo $post['authortitle'];?></a>
<?php if($post['medals']) { ?>
<span class="riicon"><?php if(is_array($post['medals'])) foreach($post['medals'] as $medal) { ?><img src="http://static.8264.com/static/image/common/<?php echo $medal['image'];?>" alt="<?php echo $medal['name'];?>" title="<?php echo $medal['name'];?>" />
<?php } ?>
</span>
<?php } ?>
</div>
</div>
<div class="ueser_forum_info">
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=thread&amp;view=me&amp;from=space" rel="nofollow">主题<span><?php echo $post['threads'];?></span></a>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=reply&amp;view=me&amp;from=space" rel="nofollow">回帖<span><?php echo $post['posts'];?></span></a>
<!--						<a href="forum.php?mod=viewthread&amp;tid=1641700">8264币<span><?php echo $post['extcredits5'];?></span></a>-->
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=friend" class="withoutb_r" rel="nofollow">关注<span><?php echo $post['friends'];?></span></a>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=friend&amp;view=fans" class="withoutb_r" rel="nofollow">粉丝<span><?php echo $post['fans'];?></span></a>
</div>
<div class="send_friend clboth">
<a href="home.php?mod=spacecp&amp;ac=pm&amp;op=showmsg&amp;handlekey=showmsg_<?php echo $post['authorid'];?>&amp;touid=<?php echo $post['authorid'];?>&amp;pmid=0&amp;daterange=2&amp;pid=<?php echo $post['pid'];?>" onclick="hideMenu('userinfo<?php echo $post['pid'];?>');showWindow(<?php if(!$_G['uid']) { ?>'login','member.php?mod=logging&action=login'<?php } else { ?>'sendpm', this.href<?php } ?>)" title="发短消息" class="send">发短信</a>
<div class="update_ucache" id="updateuserinfo_<?php echo $post['pid'];?>"><a href="javascript:;" onclick="ajaxget('plugin.php?id=api:userinfoupdate&uid=<?php echo $post['authorid'];?>' ,'updateuserinfo_<?php echo $post['pid'];?>');">刷新缓存</a></div>
<?php if($post['authorid'] != $_G['uid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>&amp;handlekey=addfriendhk_<?php echo $post['authorid'];?>" id="a_friend_li_<?php echo $post['pid'];?>" onclick="showWindow(<?php if(!$_G['uid']) { ?>'login','member.php?mod=logging&action=login'<?php } else { ?>this.id, this.href, 'get', 1, {'ctrlid':this.id,'pos':'00'}<?php } ?>);" class="friend">关注</a>
<?php } ?>
</div>
</div>
</div>
</div>
<?php } ?>
</div>

<?php if($post['medals']) { ?>
<span class="hzicon_1"><?php if(is_array($post['medals'])) foreach($post['medals'] as $medal) { ?><img src="http://static.8264.com/static/image/common/<?php echo $medal['image'];?>" alt="<?php echo $medal['name'];?>" title="<?php echo $medal['name'];?>" /><?php } ?>
</span>
<?php } if($post['extcredits5']) { ?><a href="forum.php?mod=viewthread&amp;tid=1641700" class="info_new orangelink">8264币 <i class="orange"><?php echo $post['extcredits5'];?></i> <?php echo $_G['setting']['extcredits']['5']['unit'];?></a><?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $post['uid'];?>&amp;do=thread&amp;type=reply&amp;view=me&amp;from=space" target="_blank" class="info_new alink" rel="nofollow">发帖：<?php echo $post['threads']+$post['posts']; ?> 帖</a>
<span class="info_new">在线：<?php echo $post['oltime'];?> 小时</span>
<span class="info_new">注册：<?php echo $post['regdate'];?></span>

<?php if($_G['group']['allowedituser'] || $_G['group']['allowbanuser'] || ($_G['forum']['ismoderator'] && $_G['group']['allowviewip'] && !$post['first'])) { ?>
<span class="info_new">
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowviewip']) { ?>
<a href="forum.php?mod=topicadmin&amp;action=getip&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="ajaxmenu(this, 0, 0, 2);doane(event)">IP</a>&nbsp;
<?php } if($_G['group']['allowedituser']) { ?>
<a href="<?php if($_G['adminid'] == 1) { ?>admin.php?frames=yes&action=members&operation=search&uid=<?php echo $post['authorid'];?>&submit=yes<?php } else { ?>forum.php?mod=modcp&action=member&op=edit&uid=<?php echo $post['authorid'];?><?php } ?>" target="_blank">编辑</a>&nbsp;
<?php } if($_G['group']['allowbanuser']) { if($_G['adminid'] == 1) { ?>
<a href="admin.php?action=members&amp;operation=ban&amp;username=<?php echo $post['usernameenc'];?>&amp;frames=yes" target="_blank">禁止</a>&nbsp;
<?php } else { ?>
<a href="forum.php?mod=modcp&amp;action=member&amp;op=ban&amp;uid=<?php echo $post['authorid'];?>" target="_blank">禁止</a>&nbsp;
<?php } } ?>
<a href="forum.php?mod=modcp&amp;action=thread&amp;op=post&amp;do=search&amp;searchsubmit=1&amp;users=<?php echo $post['usernameenc'];?>" target="_blank">帖子</a>
</span>
<?php } ?>
</div>

<div class="lxch_r">
<div class="lc_bs_new clboth">
<?php if($post['authorid'] && !$post['anonymous']) { if(!$_G['setting']['authoronleft']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank" class="xi2" rel="nofollow"><?php echo $post['author'];?></a><?php echo $authorverifys;?><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
匿名
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } elseif(!$post['authorid'] && !$post['username']) { ?>
游客
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postheader'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postheader'][$postcount]; } ?>
<span class="fby" id="authorposton<?php echo $post['pid'];?>">
<style type="text/css">
.lc_bs_new span.fby div{display:inline;}
.fby a{ color:#949494;}
</style>
<?php if($postcount==0) { ?>
发表于
<?php } else { ?>
发表于
<?php } ?>
<?php echo $post['dateline'];?>


</span>

<!--关注关系-->
<?php if($post['first'] == 1 && $_G['uid'] != $post['authorid']) { ?>
<style type="text/css">
.first-follow .btn-28 {
    border-radius: 2px;
    float: left;
    font-size: 12px;
    height: 28px;
    line-height: 28px;
    margin-left: 8px;
    padding: 0 12px;
    text-align: center;
    margin-top:3px;
}
.first-follow .p-btn-d {
    background-color: #fff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.first-follow .p-btn-c {
    background-color: #ff7e00;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    color: #fff;
}
.first-follow .icon-f {
    background: rgba(0, 0, 0, 0) url("http://static.8264.com/static/images/icon/attent_15x59.png") no-repeat scroll 0 0;
    display: inline-block;
    height: 13px;
    margin: -2px 5px 0 0;
    vertical-align: middle;
    width: 13px;
}
.first-follow .icon-add-f {
    background-position: -1px -48px;
}
.first-follow .icon-focus-f {
    background-position: -1px -24px;
}
.first-follow .layer-list {
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.17);
    position: absolute;
    text-align: center;
    width: 100px;
    z-index: 101;
}
.first-follow .layer-list a {
    display: block;
    font-size: 14px;
    height: 28px;
    line-height: 28px;
}
.first-follow .layer-list a:hover {
    background-color:#f3f3f3;
    color:#ff7e00;
}
</style>
<div style="float:left;position:relative;z-index:1;" class="first-follow">
<?php if(empty($post['mutual'])) { if($_G['uid']) { ?>
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>">
<?php } else { ?>
<a href="member.php?mod=logging&amp;action=login" class="p-btn-c btn-28">
<?php } ?>
<i class="icon-f icon-add-f"></i>关注
</a>

<?php } elseif($post['mutual'] == 1) { ?>
<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" onmouseover="showMenu_uc(this.id,'35','1');" id="followselect">
<i class="icon-f icon-focus-f"></i>已关注
</a>
<?php } elseif($post['mutual'] == 2) { ?>
<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" onmouseover="showMenu_uc(this.id,'35','1');" id="followselect">
<i class="icon-f icon-addtwo-f"></i>互相关注
</a>
<?php } if($post['mutual']) { ?>
<div class="layer-list" id="followselect_menu" style="display:none;">
<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=<?php echo $post['authorid'];?>" id="friend_group_<?php echo $post['authorid'];?>" class="setgroup">
<span class="t">设置分组</span>
</a>
<a href="javascript:void(0);" rel="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid=<?php echo $post['authorid'];?>&amp;confirm=1"  class="unfollow">
<span class="t">取消关注</span>
</a>
</div>
<?php } ?>
</div>
<script type="text/javascript">
jQuery(function(){
//添加关注
jQuery(".first-follow").delegate(".addfollow","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});

//取消关注
jQuery(".layer-list").delegate(".unfollow","click",function(){
var url = jQuery(this).attr('rel');
dconfirm('取消关注', '确认取消关注吗?', function() {
jQuery.post(url, '', function(data) {
if(data == 'success') {
var html = '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>"><i class="icon-f icon-add-f"></i>关注</a>';
jQuery('.first-follow').html('').html(html);
showDialog("<p>取消关注成功</p>", 'notice', '','' , 0, '', '', '', '', 2);
}
});
});
});

//设置分组
jQuery(".layer-list").delegate(".setgroup","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});
});
function showMenu_uc(id,top,left) {
showMenu(id);
jQuery('#'+id+'_menu').css({'top':top+'px'});
if (left) {
jQuery('#'+id+'_menu').css({'left':left+'px'});
}
}
function callback_follow_successfully(mutual, uid) {
if (mutual == 1) {
var html = '<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" id="followselect"><i class="icon-f icon-focus-f"></i>已关注</a>';
} else if (mutual == 2) {
var html = '<a href="javascript:void(0);" class="p-btn-d btn-28 button_hover" id="followselect"><i class="icon-f icon-addtwo-f"></i>互相关注</a>';
}
html += '<div class="layer-list" id="followselect_menu" style="display:none;">';
html += '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=changegroup&amp;uid=';
//			html += uid;
html += uid;
html += '" id="friend_group_'+uid+'" class="setgroup"><span class="t">设置分组</span></a>';
html += '<a href="javascript:void(0);" rel="home.php?mod=spacecp&amp;ac=friend&amp;op=ignore&amp;uid='+uid+'&amp;confirm=1"  class="unfollow"><span class="t">取消关注</span></a>';
html += '</div>';
jQuery('.first-follow').html('').html(html);
jQuery('.first-follow .button_hover').mouseover(function(){
showMenu_uc(jQuery(this).attr('id'),'35','1');
});
//取消关注
jQuery(".layer-list").delegate(".unfollow","click",function(){
var url = jQuery(this).attr('rel');
dconfirm('取消关注', '确认取消关注吗?', function() {
jQuery.post(url, '', function(data) {
if(data == 'success') {
var html = '<a href="home.php?mod=spacecp&amp;ac=friend&amp;op=add&amp;uid=<?php echo $post['authorid'];?>" class="p-btn-c btn-28 addfollow" id="ajax_follow_me_<?php echo $post['authorid'];?>"><i class="icon-f icon-add-f"></i>关注</a>';
jQuery('.first-follow').html('').html(html);
showDialog("<p>取消关注成功</p>", 'notice', '','' , 0, '', '', '', '', 2);
}
});
});
});
//设置分组
jQuery(".layer-list").delegate(".setgroup","click",function(){
showWindow(jQuery(this).attr('id'), jQuery(this).attr('href'), 'get', 0);
});
}
</script>
<?php } ?>
<!--关注关系 end-->

<?php if(!IS_ROBOT) { ?>
<a href="<?php echo $_G['siteurl'];?><?php if($post['first']) { ?>forum.php?mod=viewthread&tid=<?php echo $_G['tid'];?><?php echo $fromuid;?><?php } else { ?>forum.php?mod=redirect&goto=findpost&ptid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?><?php echo $fromuid;?><?php } ?>" class="lc_bs_no" title="复制本帖链接" id="postnum<?php echo $post['pid'];?>" onclick="setCopy(this.href, '帖子地址已经复制到剪贴板');return false;">
<?php if(!empty($postno[$post['number']])) { ?><?php echo $postno[$post['number']];?><?php } else { ?><em><?php echo $post['number'];?></em><?php echo $postno['0'];?><?php } ?>
</a>
<?php } ?>

<span class="tzgn">
<?php if($post['authorid'] && !$post['anonymous']) { if($post['invisible'] == 0) { if(!IS_ROBOT && !$_G['gp_authorid'] && !$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>&amp;authorid=<?php echo $post['authorid'];?>" rel="nofollow">只看该作者</a>
<?php } elseif(!$_G['forum_thread']['archiveid']) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $post['tid'];?>&amp;page=<?php echo $page;?>" rel="nofollow">显示全部帖子</a>
<?php } } } if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if($ordertype != 1) { ?>
| <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;ordertype=1" rel="nofollow">倒序浏览</a>
<?php } else { ?>
| <a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;ordertype=2" rel="nofollow">正序浏览</a>
<?php } if($post['invisible'] == 0) { } if($_G['forum_thread']['readperm']) { ?>| <em class="xg2">阅读权限 <?php echo $_G['forum_thread']['readperm'];?></em><?php } } if($_G['forum_scan_way_button'] == 1 && $post['first'] ) { ?>
| <a href="tupian-<?php echo $_G['tid'];?>.html#pic" target="_blank">只看本帖大图</a>
<?php } ?>
</span>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidetop'][$postcount]; ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_sidebottom'][$postcount]; if($post['first']) { if($_G['forum_threadstamp']) { ?><div id="threadstamp"><img src="http://static.8264.com/static/image/stamp/<?php echo $_G['forum_threadstamp']['url'];?>" title="<?php echo $_G['forum_threadstamp']['text'];?>" /></div><?php } } if(!$post['first'] && $_G['forum_thread']['special'] == 5) { ?>
<label class="pdbts pdbts_<?php echo intval($post['stand']); ?>">
<?php if($post['stand'] == 1) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=1" title="只看正方">正方</a>
<?php } elseif($post['stand'] == 2) { ?><a class="v" href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=2" title="只看反方">反方</a>
<?php } else { ?><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;filter=debate&amp;stand=0" title="只看中立">中立</a><?php } if($post['stand']) { ?>
<a class="b" href="forum.php?mod=misc&amp;action=debatevote&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" id="voterdebate_<?php echo $post['pid'];?>" onclick="ajaxmenu(this);doane(event);">支持 <?php echo $post['voters'];?></a>
<?php } ?>
</label>
<?php } ?>

<div class="clboth">
<div class="ad_info">
<?php if($post['number']<6) { ?><?php echo adshow("thread/a_pt/2/$postcount"); } if($_G['forum_thread']['readmodel'] ==1&&$post['first']) { ?>
    <div style="text-align:center; padding:30px 0px 10px 0px;">
<a target="_blank" href="http://www.8264.com/youji/<?php echo $_G['tid'];?>.html?from=8264bbs">
<img  src="http://static.8264.com/static/image/common/ydbicon.png">
</a>
</div>
<?php } if($_G['forum_thread']['readmodel'] ==2&&$post['first']) { ?>
    <div style="text-align:center; padding:30px 0px 10px 0px;">
<a target="_blank" href="http://www.8264.com/wenzhang/<?php echo $_G['tid'];?>.html?from=8264bbs">
<img  src="http://static.8264.com/static/image/common/wzbicon.png">
</a>
</div>
<?php } if($post['first']) { if($post['tags'] || $relatedkeywords) { ?>
<div class="ptg">
<?php if($post['tags']) { ?><?php echo $post['tags'];?><?php } if($relatedkeywords) { ?><span><?php echo $relatedkeywords;?></span><?php } ?>
</div>
<?php } } ?>
</div>
</div><div class="bjcon_new">
<?php if($post['warned']) { ?>
<span class="y"><a href="forum.php?mod=misc&amp;action=viewwarning&amp;tid=<?php echo $_G['tid'];?>&amp;uid=<?php echo $post['authorid'];?>" title="受到警告" onclick="showWindow('viewwarning', this.href)"><img src="http://static.8264.com/static/image/common/warning.gif" alt="受到警告" /></a></span>
<?php } if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
<?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽</em></div>
<?php } elseif($needhiddenreply) { ?>
<div class="locked">此帖仅作者可见</div>
<?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop'][$postcount]; if($_G['setting']['bannedmessages'] & 1 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
<div class="locked">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员可见</em></div>
<?php } elseif($post['status'] & 1) { ?>
<div class="locked">提示: <em>该帖被管理员或版主屏蔽，只有管理员可见</em></div>
<?php } if($post['first']) { if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
<div class="locked">
<em class="y"><a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" onclick="showWindow('pay', this.href)">记录</a></em>
付费主题, 价格: <strong><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> <?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?> </strong>
</div>
<?php } if($threadsort && $threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?php echo $threadsortshow['typetemplate'];?>
<?php } elseif($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
<div class="typeoption">
<?php if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<?php } else { ?>
<table summary="分类信息" cellpadding="0" cellspacing="0" class="cgtl mbm">
<caption><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></caption>
<tbody><?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] != 'info') { ?>
<tr>
<th><?php echo $option['title'];?>:</th>
<td><?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?>-<?php } ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
<?php } ?>
</div>
<?php } } } ?>

<div class="t_fsz_new <?php if(!$_G['forum_thread']['special']) { } else { } ?>">
<?php if($post['first']) { if(!$_G['forum_thread']['special']) { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } elseif($_G['forum_thread']['special'] == 1) { include template('forum/viewthread_poll'); } elseif($_G['forum_thread']['special'] == 2) { include template('forum/viewthread_trade'); } elseif($_G['forum_thread']['special'] == 3) { include template('forum/viewthread_reward'); } elseif($_G['forum_thread']['special'] == 4) { include template('forum/viewthread_activity'); } elseif($_G['forum_thread']['special'] == 5) { include template('forum/viewthread_debate'); } elseif($threadplughtml) { ?>
<?php echo $threadplughtml;?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } } else { ?>
<table cellspacing="0" cellpadding="0"><tr><td class="t_f" id="postmessage_<?php echo $post['pid'];?>"><?php $post['message']=str_replace('thumbImg(this)','thumbImg(this,null,825)',$post["message"]); ?><?php echo $post['message'];?></td></tr></table>
<?php } if($post['attachment']) { ?>
<div class="locked">附件: <em><?php if($_G['uid']) { ?>你所在的用户组无法下载或查看附件<?php } else { ?>你需要<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href);return false;">登录</a>才可以下载或查看附件。没有账号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" onclick="hideWindow('login');showWindow('register', this.href);return false;" title="注册账号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em></div>
<?php } elseif(($post['imagelist'] || $post['attachlist'])) { if(!($post['first'] && $_G['forum_thread']['special'] == 4)) { ?>
<div class="pattl">
zxZX
<?php if($post['imagelist']) { ?>
<?php echo $post['imagelist'];?>
<?php } if($post['attachlist']) { ?>
<?php echo $post['attachlist'];?>
<?php } ?>
</div>
<?php } } ?>
</div>

<?php if($post['first'] && $sticklist) { ?>
<div>
<h3 class="psth xs1">回帖推荐</h3><?php if(is_array($sticklist)) foreach($sticklist as $rpost) { ?><div class="pstl xs1">
<div class="psta" style='z-index:1;position:absolute'><a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" c="1" rel="nofollow"><?php echo $rpost['avatar'];?></a></div>
<div class="psti">
<p>
<a href="home.php?mod=space&amp;uid=<?php echo $rpost['authorid'];?>" class="xi2 xw1" rel="nofollow"><?php echo $rpost['author'];?></a>
                        发表于<?php echo $rpost['position'];?>楼
<span class="xi2">
&nbsp;<a href="javascript:;" onclick="window.open('forum.php?mod=redirect&goto=findpost&ptid=<?php echo $rpost['tid'];?>&pid=<?php echo $rpost['pid'];?>')" class="xi2">查看完整内容</a>
<?php if($_G['group']['allowstickreply']) { ?>&nbsp;<a href="javascript:;" onclick="modaction('stickreply', <?php echo $rpost['pid'];?>, '&undo=yes')" class="xi2">解除置顶</a><?php } ?>
</span>
</p>
<div class="mtn"><?php echo $rpost['message'];?></div>
</div>
</div>
<?php } ?>
</div>
<?php } if($post['number']==1 && $_G['uid'] && 1!=1) { ?>
<!-- 波总要求取消1楼快速回复，如后面需要再恢复，去掉上面条件 && 1!=1 -->
<form method="post" autocomplete="off" id="fastreplyform" onsubmit="$('fastreplysubmit').disabled=true;jQuery('#fastreplymessage').focus();ajaxpost('fastreplyform', 'return_fastreply', 'return_fastreply', 'onerror', 'fastreplysubmit', fastreply_refun);return false;" action="forum.php?mod=post&amp;infloat=yes&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;replysubmit=yes">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" fwin="reply">
<input type="hidden" name="handlekey" value="reply">
<input type="hidden" name="noticeauthor" value="q|<?php echo $post['authorid'];?>|<?php echo $post['author'];?>">
<input type="hidden" name="noticetrimstr" value="<?php echo $fastreply_noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $fastreply_noticeauthormsg;?>" />
<input type="hidden" name="reppost" value="<?php echo $post['pid'];?>">

<div class="lchf">
<div id="return_fastreply"></div>
<div style="overflow: hidden; height: 100px;">
<textarea name="message" class="t_note" id="fastreplymessage">楼主说的太精彩了，快来点评一下！</textarea>
<div class="areatext" id="fastreply-message-hidden" contenteditable="true"></div>
<div id="fastreply-atlist"></div>
</div>
<div class="lcksfu clboth">
<span class="lcksfu_l" id="fastreply_btnbox">
<button class="lcksfubotton" value="true" name="replysubmit" id="fastreplysubmit" type="submit"></button>
<!-- 手机绑定提示 -->
<?php if(!$_G['member']['telstatus']) { ?>
<style type="text/css">.tips-binding__inside{float:left;background:url(http://static.8264.com/static/images/tip.png) no-repeat 0 50%;padding-left:20px;margin:4px 0 0 10px;font-size:14px;color:#585858}.tips-binding__inside a{color:#ff7038;font-size:14px}.tips-binding__inside a:hover{color:#ff7038;font-size:14px}</style>
<span class="tips-binding__inside">注：回帖操作需绑定手机，<a href="http://u.8264.com/home-setting.html#account-security" target="_blank">去绑定>></a></span>
<?php } ?>
<!-- //手机绑定提示 -->
<?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="<classname>"><sec><i id="sec<hash>_menu" class="yzmimg" style="display:none"><sec></i></span>
EOF;
?>
<div class="twyzm clboth fastreplysec"><?php include template('common/seccheck'); ?></div>
<?php } ?>
</span>
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $post['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $post['tid'];?>&amp;repquote=<?php echo $post['pid'];?>" onclick="switchAdvanceMode(this.href);doane(event);" class="lcksfu_r">高级模式</a>
</div>
</div>
</form>
<script type="text/javascript">
jQuery("#fastreplymessage").focus(function(){
if(jQuery(this).attr('class')=='t_note'){
jQuery(this).removeClass('t_note');
jQuery(this).val('');
}
});
function fastreply_refun(){
jQuery('#fastreplymessage').val('');
$('fastreplysubmit').disabled=false;
var body=(window.opera) ? (document.compatMode == "CSS1Compat" ? jQuery('html') : jQuery('body')) : jQuery('html,body');
if(jQuery('#return_fastreply').html().indexOf('succeed')>-1){
body.animate({scrollTop:jQuery('#comment_<?php echo $post['pid'];?>').position().top-100},0);
}
}
</script>
<?php } if(!empty($post['ratelog'])) { ?>
<div class="clboth mt16" id="ratelog_<?php echo $post['pid'];?>">
<?php if(!$_G['setting']['ratelogon']) { ?>
<div class="pftitle clboth">
<span class="pficon16_16"></span>
<span class="pfnum"><?php echo count($postlist[$post['pid']]['totalrate']);; ?>人</span>
<span class="pfzi">评分</span>
<span class="pficon6_11"></span>
<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)">查看全部评分</a>
</div>
<?php } ?>
<div id="post_rate_<?php echo $post['pid'];?>"></div>
<?php if($_G['setting']['ratelogon']) { ?>
<table class="ratl">
<tr>
<th class="xw1" width="120"><a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分">已有 <span class="xi1"><?php echo count($postlist[$post['pid']]['totalrate']);; ?></span> 人评分</a></th><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { ?><th width="50"><i><?php echo $_G['setting']['extcredits'][$id]['title'];?></i></th>
<?php } ?>
<th>
<a href="javascript:;" onclick="toggleRatelogCollapse('ratelog_<?php echo $post['pid'];?>', this);" class="y xi2 op"><?php if(!empty($_G['cookie']['ratecollapse'])) { ?>展开<?php } else { ?>收起<?php } ?></a>
<i>理由</i>
</th>
</tr>
<tbody class="ratl_l"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><tr id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>">
<td>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a> <a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" rel="nofollow"><?php echo $ratelog['username'];?></a>
</td><?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($ratelog['score'][$id] > 0) { ?>
<td class="xi1"> + <?php echo $ratelog['score'][$id];?></td>
<?php } else { ?>
<td class="xg1"><?php echo $ratelog['score'][$id];?></td>
<?php } } ?>
<td class="xg1"><?php echo $ratelog['reason'];?></td>
</tr>
<?php } ?>
</tbody>
</table>
<p class="ratc">
总评分:&nbsp;<?php if(is_array($post['ratelogextcredits'])) foreach($post['ratelogextcredits'] as $id => $score) { if($score > 0) { ?>
<span class="xi1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?></span>&nbsp;
<?php } else { ?>
<span class="xg1"><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?></span>&nbsp;
<?php } } ?>
&nbsp;<a href="forum.php?mod=misc&amp;action=viewratings&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>" onclick="showWindow('viewratings', this.href)" title="查看全部评分" class="xi2">查看全部评分</a>
</p>
<?php } else { ?>
<div class="clboth">
<ul class="pftoulist clboth"><?php if(is_array($post['ratelog'])) foreach($post['ratelog'] as $uid => $ratelog) { ?><li>
<div id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>_menu" class="attp" style="display: none;">
<p class="crly"><?php echo $ratelog['reason'];?> &nbsp;&nbsp;<?php if(is_array($ratelog['score'])) foreach($ratelog['score'] as $id => $score) { if($score > 0) { ?>
<em><?php echo $_G['setting']['extcredits'][$id]['title'];?> + <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></em>
<?php } else { ?>
<span><?php echo $_G['setting']['extcredits'][$id]['title'];?> <?php echo $score;?> <?php echo $_G['setting']['extcredits'][$id]['unit'];?></span>
<?php } } ?>
</p>
<p class="mncr"></p>
</div>
<p id="rate_<?php echo $post['pid'];?>_<?php echo $uid;?>" onmouseover="showMenu({'ctrlid':this.id,'pos':'12'})" class="tx"><a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" c="1" rel="nofollow"><?php echo avatar($uid, 'small');; ?></a></p>
<a href="home.php?mod=space&amp;uid=<?php echo $uid;?>" target="_blank" class="name" rel="nofollow"><?php echo $ratelog['username'];?></a>
</li>
<?php } ?>
<div style="clear:both;"></div>
</ul>
</div>
<?php } ?>
</div>
<?php } else { ?>
<div id="post_rate_div_<?php echo $post['pid'];?>"></div>
<?php } ?>

<div class="clboth mt16">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<div class="dptitle clboth">
<span class="dpicon16_16"></span>
<?php if($commentcount[$post['pid']]) { ?><span class="dpnum"><?php echo $commentcount[$post['pid']];?>人</span><?php } ?>
<span class="dpzi">点评</span>
<span class="dpicon6_11"></span>
<a href="javascript:;" class="shouqi" id="clist_btn_<?php echo $post['pid'];?>">收起</a>
</div>
<?php } ?>
<div class="clboth" id="comment_<?php echo $post['pid'];?>">
<?php if($_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
<ul class="dplistcon"><?php if(is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?><li id="comments_<?php echo $comment['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $comment['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" class="name" rel="nofollow"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $comment['comment'];?></span>
</span>
<?php if($comment['forpid'] <> 0) { ?>
<span class="second" style="display:none;">
<a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;postid=<?php echo $comment['pid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $comment['forpid'];?>&amp;cid=<?php echo $comment['id'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=commentreply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $comment['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<?php } ?>
<span class="hfreveiw">
<span class="time"><?php echo $comment['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_comreply('delcomment', <?php echo $comment['id'];?>,'','',<?php echo count($comment['replyComment']) ?>);"></a>
<?php } ?>
</span>
</li>
<?php if(!empty($comment['replyComment'])) { if(is_array($comment['replyComment'])) foreach($comment['replyComment'] as $reply) { ?><li id="comments_<?php echo $reply['id'];?>">
<span class="first">
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="tximg" c="1" rel="nofollow"><?php echo $reply['avatar'];?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $reply['authorid'];?>" class="name" rel="nofollow"><?php echo $reply['author'];?></a>
<span class="hf">回复</span>
<a href="#" target="_blank" class="name_second"><?php echo $comment['author'];?></a>
<span class="hfcon"><?php echo $reply['comment'];?></span>
</span>
<span class="second" style="display:none;">
<a href="forum.php?mod=redirect&amp;goto=findpost&amp;pid=<?php echo $reply['forpid'];?>&amp;ptid=<?php echo $_G['tid'];?>" target='_blank'>查看全文</a>
</span>
<span class="hfreveiw">
<span class="time"><?php echo $reply['dateline'];?></span>
<?php if($_G['forum']['ismoderator'] && $_G['group']['allowdelpost']) { ?>
<a href="javascript:;" class="del" onclick="modaction_delcomreply('delcomment', <?php echo $part['id'];?>,'','',<?php echo $comment['pid'];?>)"></a>
<?php } ?>
</span>
</li>
<?php } } } ?>
</ul>
<?php if($commentcount[$post['pid']] > $_G['setting']['commentnumber']) { ?>
<div class="dpfy clboth">
<div class="pg"><a href="javascript:;" onclick="ajaxget('forum.php?mod=misc&action=commentmore&tid=<?php echo $post['tid'];?>&pid=<?php echo $post['pid'];?>&page=2', 'comment_<?php echo $post['pid'];?>')">下一页</a></div>
</div>
<?php } } ?>
</div>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom'][$postcount]; } ?>
</div>
<?php if(!IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']) { if(!empty($lastmod['modaction']) && $_G['groupid'] == 1) { ?>
<div class="gldivfst clboth" ><a href="forum.php?mod=misc&amp;action=viewthreadmod&amp;tid=<?php echo $_G['tid'];?>" title="帖子模式" onclick="showWindow('viewthreadmod', this.href)">本主题由 <?php echo $lastmod['modusername'];?> 于 <?php echo $lastmod['moddateline'];?> <?php echo $lastmod['modaction'];?></a></div>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_useraction'])) echo $_G['setting']['pluginhooks']['viewthread_useraction']; } } ?>

<div class="lcbottom clboth">
<?php if(!$_G['forum_thread']['archiveid']) { ?>
<div class="gldiv_l">
<?php if($post['invisible'] == 0) { if($allowpostreply) { ?>
<a class="hficon" href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;way=reply&amp;page=<?php echo $page;?>" onclick="showWindow(<?php if($_G['uid']) { ?>'reply', this.href<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>)">回复</a>
<?php } } if($_G['group']['raterange'] && $post['authorid'] && !$post['first'] && $post['invisible'] == 0) { ?>
<a id="p_rate_btn" class="pficon" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;">评分</a>
<?php } if($_G['group']['raterange'] && $post['authorid'] && $post['first']) { ?>
<a id="p_rate_btn" class="pficon" href="javascript:;" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=<?php echo $_G['tid'];?>&pid=<?php echo $post['pid'];?>', 'get', -1);return false;" title="<?php echo count($postlist[$post['pid']]['totalrate']);; ?> 人评分">评分</a>
<?php } if((($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && $post['authorid'] == $_G['uid']))) { ?>
<a id="p_edit_btn" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_G['gp_modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_G['gp_modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>"><?php if($_G['forum_thread']['special'] == 2 && !$post['message']) { ?>添加柜台介绍<?php } else { ?>编辑<?php } ?></a>
<?php } ?>
</div>
<div class="gldiv_r">
<?php if($post['invisible'] == -2 && !$post['first']) { ?>
<span class="xg1">(待审核)</span>
<?php } if($post['first'] && $post['invisible'] == -3) { ?>
<a href="forum.php?mod=misc&amp;action=pubsave&amp;tid=<?php echo $_G['tid'];?>">发表</a>
<?php } if(!(($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'])) && $_G['uid'] && $post['authorid'] == $_G['uid']) { ?>
<a href="forum.php?mod=misc&amp;action=postappend&amp;tid=<?php echo $post['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;page=<?php echo $page;?>" onClick="showPostWin('postappend', this.href)">补充</a>
<?php } if(!$post['first'] && $modmenu['post']) { ?>
<span>
<label for="manage<?php echo $post['pid'];?>">
<input type="checkbox" id="manage<?php echo $post['pid'];?>" <?php if(!empty($modclick)) { ?>checked="checked" <?php } ?>onclick="pidchecked(this);modclick(this, <?php echo $post['pid'];?>)" value="<?php echo $post['pid'];?>" autocomplete="off" />管理
</label>
</span>
<?php } if($post['invisible'] == 0) { if($post['first'] && $_G['uid'] && $_G['uid'] == $post['authorid'] && !in_array($_G['fid'], array(7,378))) { ?>
<a href="misc.php?mod=invite&amp;action=thread&amp;id=<?php echo $_G['tid'];?>" onclick="showWindow('invite', this.href, 'get', 0);">邀请</a>
<?php } if($_G['forum_thread']['special'] == 3 && ($_G['forum']['ismoderator'] && (!$_G['setting']['rewardexpiration'] || $_G['setting']['rewardexpiration'] > 0 && ($_G['timestamp'] - $_G['forum_thread']['dateline']) / 86400 > $_G['setting']['rewardexpiration']) || $_G['forum_thread']['authorid'] == $_G['uid']) && $post['authorid'] != $_G['forum_thread']['authorid'] && $post['first'] == 0 && $_G['uid'] != $post['authorid'] && $_G['forum_thread']['price'] > 0) { ?>
<a href="javascript:;" onclick="setanswer(<?php echo $post['pid'];?>, '<?php echo $_G['gp_from'];?>')">最佳答案</a>
<?php } if($post['rate'] && $_G['forum']['ismoderator']) { ?>
<a href="forum.php?mod=misc&amp;action=removerate&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;page=<?php echo $page;?>" onclick="showWindow('rate', this.href, 'get', -1)">撤销评分</a>
<?php } if($post['authorid'] != $_G['uid'] && $_G['uid']) { ?>
<a href="javascript:;" onclick="showWindow('miscreport<?php echo $post['pid'];?>', 'misc.php?mod=report&rtype=post&rid=<?php echo $post['pid'];?>', 'get', -1);return false;" id="report_btn" style="display: none;">举报</a>
<?php } } if($post['first']) { ?>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="m_k_favorite" onclick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>);" title="<?php echo $_G['forum_thread']['favtimes'];?>人收藏" style="display: none;">收藏(<b id="favoritenumber"><?php echo $_G['forum_thread']['favtimes'];?></b>)</a>
<?php } ?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postfooter'][$postcount]; ?>
</div>
<div style="clear:both;"></div>
<?php } ?>
</div>

<?php if($post['first'] && $_G['forum_thread']['special'] == 5 && $_G['forum_thread']['displayorder'] >= 0) { ?>
<ul class="ttp cl">
<li style="display:inline;margin-left:12px"><strong class="bw0">按立场筛选: </strong></li>
<li<?php if(!isset($_G['gp_stand'])) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>" hidefocus="true">全部</a></li>
<li<?php if($_G['gp_stand'] == 1) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=1" hidefocus="true">正方</a></li>
<li<?php if($_G['gp_stand'] == 2) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=2" hidefocus="true">反方</a></li>
<li<?php if(isset($_G['gp_stand']) && $_G['gp_stand'] == 0) { ?> class="xw1 a"<?php } ?>><a href="forum.php?mod=viewthread&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_G['gp_extra'];?>&amp;stand=0" hidefocus="true">中立</a></li>
</ul>
<?php } ?>
</div>

<?php if(!empty($aimgs[$post['pid']])) { ?>
<script type="text/javascript" reload="1">aimgcount[<?php echo $post['pid'];?>] = [<?php echo implode(',', $aimgs[$post['pid']]);; ?>];attachimgshow(<?php echo $post['pid'];?>);</script>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['viewthread_endline'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_endline'][$postcount]; ?>

</div>
</div>
