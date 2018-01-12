<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewpicture', 'common/header_common');
0
|| checktplrefresh('./template/8264/forum/viewpicture.htm', './template/8264/common/header_common.htm', 1509517876, 'diy', './data/template/2_diy_forum_viewpicture.tpl.php', './template/8264', 'forum/viewpicture')
;?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta name="apple-itunes-app" content="app-id=492167976">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <link rel="dns-prefetch" href="http://stats.8264.com/">
<title>
<?php if(isset($forumOption)) { ?><?php $forumOption->initPageTitle(); } if($pageTitle) { ?><?php echo $pageTitle; } elseif($_G['basescript']=='portal' && $_G['gp_mod']=='list' && $metakeywords && $_G['catid']!=874 ) { if($_G['catid']==878) { ?>
户外美女图片_驴友图片_最健康的户外美女照片
<?php } else { ?>
            <?php echo $metakeywords;?>
            <?php if($_G['setting']['bbname']) { ?> - <?php echo $_G['setting']['bbname'];?><?php } } } else { ?>
            <?php if($_GET['do']=="produce"&&$_G['uid']) { ?>
               <?php echo $navtitle;?><?php echo "的装备分享"; ?>             <?php } elseif($_G['basescript']=='group') { if($_G['uid']) { ?>
<?php echo $navtitle;?>
<?php } else { ?><?php $navtitle ='群组 - 8264'; ?><?php echo $navtitle;?>
<?php } } else { ?><?php $navtitle = preg_replace('/的记录/', '的微博', $navtitle); if(!empty($topic['title'])) { ?><?php echo $topic['title'];?><?php } if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if($_G['setting']['bbname']) { ?><?php echo $_G['setting']['bbname'];?><?php } ?>
            <?php } } ?>
</title>
<?php echo $_G['setting']['seohead'];?>
    <meta name="keywords" content="<?php if(!empty($metakeywords)) { ?> <?php echo htmlspecialchars($metakeywords, ENT_COMPAT | ENT_HTML401, GB2312); ?> <?php } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { ?> <?php echo htmlspecialchars($metadescription, ENT_COMPAT | ENT_HTML401, GB2312); ?>,<?php echo $_G['setting']['bbname'];?> <?php } ?>" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<?php if($_G['basescript']=='portal') { if($_G['gp_mod']=='list') { if($_G['catid'] == '849') { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/topic">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/list/<?php echo $_G['catid'];?>">
<?php } } elseif($_G['gp_aid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/viewnews-<?php echo $_G['gp_aid'];?>-page-1.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/">
<?php } } elseif($_G['basescript']=='forum') { if($_G['gp_mod']=='viewthread' && $_G['tid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/thread-<?php echo $_G['tid'];?>-<?php echo $page;?>.html">
<?php } elseif($_G['fid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/bbs-<?php echo $_G['fid'];?>-1.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/bbs">
<?php } ?>
        <?php } elseif($_G['basescript']=='dianping') { if($_G['url_mod'] && $_G['tid']) { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/<?php echo $_G['url_mod'];?>/<?php echo $_G['tid'];?>.html">
<?php } else { ?>
<meta name="mobile-agent" content="format=html5;url=http://m.8264.com/<?php echo $_G['url_mod'];?>/">
<?php } } if(isset($forumOption)) { ?><?php $flag = $forumOption->getSiteUrlbyUrl($_G['siteurl']); if(($flag==1)) { ?><?php $_G['siteurl'] = "http://bbs.8264.com/"; } else { ?><?php $_G['siteurl'] = $_G['siteurl']; } } ?>
<base href="<?php echo $_G['siteurl'];?>" />
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/common.css?<?php echo VERHASH;?>" />
<script type="text/javascript">
var STYLEID = '<?php echo STYLEID;?>',
STATICURL = '<?php echo STATICURL;?>',
IMGDIR = 'http://static.8264.com/static/image/common',
VERHASH = '<?php echo VERHASH;?>',
charset = '<?php echo CHARSET;?>',
discuz_uid = '<?php echo $_G['uid'];?>',
cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>',
cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>',
cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>',
showusercard = '<?php echo $_G['setting']['showusercard'];?>',
attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>',
disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>',
creditnotice = '<?php if($_G['setting ']['creditnotice ']) { ?><?php echo $_G;?>['setting ']['creditnames ']<?php } ?>',
defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>',
REPORTURL = '<?php echo $_G['currenturl_encode'];?>',
SITEURL = '<?php echo $_G['siteurl'];?>';
</script>
<script src="http://static.8264.com/static/js/common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<style>
/* 头部广告文字 */
.textAdBox { float: left; width: 978px; border: 1px solid #f0f0f0; border-bottom: 0 none; overflow: hidden; }
.textAdBox ul { float: left; width: 100%; margin-left: -1px; }
.textAdBox ul li { float: left; width:20%; padding: 4px 0; border-bottom: 1px solid #f0f0f0; }
.textAdBox a { display: block; font-size:12px; line-height:24px; font-family: "Microsoft Yahei"; height: 24px; color: #585858; text-align: center; border-left: 1px dashed #d6d6d6; overflow: hidden; }
.textAdBox a:hover { color: #162833; }
.textAdBox .cRed,
.textAdBox .cRed:hover { color: #ff0000; }
.layout:after,
.hd:after,
.bd:after,
.ft:after,
.layoutLeft:after,
.layoutRight:after,
.w980:after { content: ""; display: block; clear: both; visibility: hidden; }
.layout,
.hd,
.bd,
.ft,
.layoutLeft,
.layoutRight,
.w980 { zoom: 1; }
/* 论坛首页 Start */
.layout { width: 980px; margin: 0 auto; }
.layoutLeft { float: left; display: inline; width: 660px; }
.layoutRight { float: right; display: inline; width: 260px; }
.w980 { width: 980px; margin: 0 auto; }
.oldad .textAdBox{width: 100%;}
.wp .oldad{width: 98%;}

/* 头部广告文字 */
.a_t #textadbox_old { border: 1px solid #cdcdcd; border-bottom: 0 none; overflow: hidden; width:100%; float:none;}
.a_t #textadbox_old ul {  width: 100%; margin-left: -1px; }
.a_t #textadbox_old ul li { float: left; width: 20%; padding:0px; border-bottom: 1px solid #cdcdcd }
.a_t #textadbox_old a { display: block; font: 14px; font-family: Tahoma,Helvetica,SimSun,sans-serif,Hei; height: 28px; color: #333; text-align: center; border-left: 1px solid #cdcdcd; overflow: hidden; line-height: 28px;}
.a_t #textadbox_old a:hover { color: #162833; }
.a_t #textadbox_old .cRed,
.a_t #textadbox_old .cRed:hover { color: #ff0000; }
</style>
<link href="http://static.8264.com/static/css/forum/photo.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/jquery.nicescroll.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/common/viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/javascript">var fid = parseInt('<?php echo $_G['fid'];?>'), tid = parseInt('<?php echo $_G['tid'];?>');</script>
<?php if($modmenu['thread'] || $modmenu['post']) { ?>
<script src="http://static.8264.com/static/js/forum_moderate.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>

<script src="http://static.8264.com/static/js/forum_viewthread.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>);var imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>';var aimgcount = new Array();</script>

<script>

jQuery(document).ready(function($) {
var tid = <?php echo $_G['tid'];?>;
jQuery("#commentsList .pg").addClass("gallery-reply-pager");
jQuery("#commentsList").on('click',".pg>a",function(e){
e.preventDefault();
var tempArr = this.href.split('-');
if(tempArr[2]){
getpage(tempArr[2]);
}else{
var tempArr2 = this.href.split('&');
var page=tempArr2[2].split('=');
getpage(page[1]);
}

});
jQuery('#fastreplysubmit').click(function(){
var ajaxurl = jQuery('#fastreplyform').attr('action');
var message = jQuery('#f_message').val();
if(message=="这张照片太漂亮啦，快来点评一下！" || message==""){
return false;
}
jQuery.ajax({
            type: "POST",
            url:ajaxurl,
            data:jQuery('#fastreplyform').serialize(),
            async: false,
            contentType : "application/x-www-form-urlencoded; charset=utf-8",
            error: function(request) {
                alert("Connection error");
            },
            success: function(data) {
            	if(data==1){
            		getpage(1);
            	}
            }
        });

});
<?php if(!$_G['uid']) { ?>
$(document).on('keydown', '#f_message', saveUnLoginData);
function saveUnLoginData() {
saveUserdata(this.id + tid, this.value);
}
<?php } ?>
});
function getpage(page){
jQuery.get('<?php echo $geturl;?>',{tid:'<?php echo $_G['tid'];?>',page:page,inajax:1},function(data){
jQuery("#commentsList").nextAll().remove();
jQuery("#commentsList").html(data);
jQuery("#commentsList .pg").addClass("gallery-reply-pager");
});
jQuery("#commentsList>.h2Tit").after('<div style="padding: 0 0 10px 6px;"><img src="http://static.8264.com/static/image/common/loading.gif" style="vertical-align: top;"> 数据读取中...</div>');
jQuery("#f_message").val('');
jQuery(document).scrollTop(jQuery('#commentsList').offset().top-60);
}
function loadUnloginData(name,id){
var ld = loadUserdata(name);
if(ld != '' && ld != null){
$(id).value = ld;
}
}
</script>
</head>

<body>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="container dy-container">
<div class="dy-left">
<div class="dy-head">
<div class="dy-head-right">
<a href="javascript:void(0);" class="link-share"><i>分享</i></a>
<a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=thread&amp;id=<?php echo $_G['tid'];?>" id="m_k_favorite" class="link-fav" onClick="showWindow(<?php if($_G['uid']) { ?>this.id, this.href, 'get', 0<?php } else { ?>'login','member.php?mod=logging&action=login'<?php } ?>); "><i>收藏</i></a>
<b id="favoritenumber" style="display: none;"><?php echo $forum_picture['favtimes'];?></b>
<a href="<?php echo $pic_url;?>" class="link-orimg" target="brank_"><i>查看原图</i></a>
<ul class="share-list share_bd bdsharebuttonbox" data-tag="share_1">
<li>
<a class="wb" href="javascript:void(0);" data-cmd="tsina">新浪微博</a>
</li>
<li>
<a class="qz" href="javascript:void(0);" data-cmd="qzone">QQ空间</a>
</li>
<li>
<a class="qwb" href="javascript:void(0);" data-cmd="tqq">腾讯微博</a>
</li>
<li>
<a class="wx" href="javascript:void(0);" data-cmd="weixin">微信</a>
</li>
</ul>
</div>
</div>
<script>
window._bd_share_config = {
common : {
//此处放置通用设置
},
share : [
//此处放置分享按钮设置
{"tag" : "share_1", "bdSize" : 32}
]
}
with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
(function($){
var ww=$(window).width();
var s_bd_r=Math.max((ww-980)/2-60,0);
//$(".dy-head-right").css("right",s_bd_r);
})(jQuery);
</script>
<script type="text/javascript" id="bdshare_js" data="type=button&amp;mini=1&amp;uid=39357" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<div class="dy-original">
<div class="dy-original-wrapper">
<div class="gallery-image-original">
<img title="<?php echo $forum_picture['subject'];?>"  src="<?php echo $pic_url;?>" data-large="<?php echo $pic_url;?>"/>
</div>
<a href="<?php echo $weburl;?>&paging=prev&tid=<?php echo $_G['tid'];?>" class="image-original-prev"><i class="dy-sprite"></i></a>
<a href="<?php echo $weburl;?>&paging=next&tid=<?php echo $_G['tid'];?>" class="image-original-next"><i class="dy-sprite"></i></a>
</div>
</div>
</div>
<div class="dy-right">
<div class="dy-anchors">
<div class="dy-notification">
<a href="javascript:void(0);" class="logo"><i class="dy-sprite"></i>每日一图</a>
<a href="http://www.8264.com/list/842" class="dy-close-button"><i class="dy-sprite"></i>关闭</a>
</div>
</div>
<div class="dy-info-scroller">
<div class="dy-info-wrapper">
<div class="gallery-title">
<h3><?php echo $forum_picture['subject'];?></h3>
</div>
<div class="gallery-art-info">
<span class="pub-date"><?php echo $forum_post['dateline'];?></span>
<span class="view-desc"><i class="dy-sprite"></i><?php echo $forum_picture['views'];?></span>
<span class="comment-desc"><i class="dy-sprite"></i><?php echo $forum_picture['replies'];?></span>
</div>
<div class="gallery-explain">
<?php echo $forum_post['message'];?>
</div>
</div>
<div class="dy-reply-wrapper">
<div class="gallery-reply-editor">
                        <?php if($forum_post['first']==1) { ?>
                        <form method="post" autocomplete="off" id="fastreplyform"  action="forum.php?mod=post&amp;infloat=yes&amp;action=reply&amp;fid=<?php echo $forum_post['fid'];?>&amp;pid=<?php echo $forum_post['pid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=picturereply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $forum_post['tid'];?>&amp;replysubmit=yes">
                        <input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" fwin="reply">
                        <input type="hidden" name="handlekey" id="handlekey" value="picreply">
                        <input type="hidden" name="noticeauthor" id="noticeauthor" value="q|<?php echo $forum_post['authorid'];?>|<?php echo $forum_post['author'];?>">
                        <input type="hidden" name="noticetrimstr" id="noticetrimstr" value="<?php echo $fastreply_noticetrimstr;?>" />
                        <input type="hidden" name="noticeauthormsg" id="noticeauthormsg" value="<?php echo $fastreply_noticeauthormsg;?>" />
                        <input type="hidden" name="reppost" id="reppost" value="<?php echo $forum_post['pid'];?>">
                        <div class="reply-editor-entry">
                        	<div id="return_fastreply"></div>
                            <textarea name="message" class="t_note" cols="30" rows="10" id="f_message" >这张照片太漂亮啦，快来点评一下！</textarea>
                                    <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
                                    <div style="margin-bottom:15px;">
                                        <script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r=<?php echo time();?>" type="text/javascript"></script>
                                    </div>
                                    <?php } ?>
                                    <button class="btn-comment" value="true" name="replysubmit" id="fastreplysubmit" type="button"  <?php if(!$_G['uid']) { ?>onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes')"<?php } ?>>点评图片</button>
                                   <a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $forum_post['fid'];?>&amp;page=<?php echo $_G['page'];?>&amp;way=reply&amp;extra=<?php echo $_G['gp_extra'];?>&amp;tid=<?php echo $forum_post['tid'];?>&amp;repquote=<?php echo $forum_post['pid'];?>" target="_brand" onClick="switchAdvanceMode(this.href);doane(event);" class="adv-mode">高级模式</a>

                                </div>
                        </form>
                        <script type="text/javascript">
                        jQuery("#f_message").focus(function(){
                            if(jQuery(this).attr('class')=='t_note' && jQuery(this).val()=="这张照片太漂亮啦，快来点评一下！"){
                                jQuery(this).removeClass('t_note');
                                jQuery(this).val('');
                            }
                        });
                        var tta = document.getElementsByTagName('textarea');
                        for(var i=0; i<tta.length; i++){
                        	if(!isUndefined(tta[i].id)){
                        		loadUnloginData(tta[i].id + tid, tta[i].id);
                        	}
                        }
                        </script>
                        <?php } ?>
</div>
<div class="gallery-reply-list-wrapper">
<div class="gallery-reply-head">
<div class="gallery-reply-title">
<span class="gallery-reply-count"><i class="dy-sprite"></i><?php echo $count;?>人 点评</span>
</div>
</div>
<div class="gallery-reply-list" id="commentsList">
<ul >
                                <?php if(is_array($comments[$forum_post['pid']])) foreach($comments[$forum_post['pid']] as $comment) { ?>                                 <li id="comments_<?php echo $comment['id'];?>">
                                    <div class="reply-misc-main">
                                        <a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>" rel="nofollow" class="author-face" c="1">
                                            <?php echo $comment['avatar'];?>
                                            <?php echo $comment['author'];?>
                                        </a>
                                        <span class="reply-cont"><?php echo cutstr($comment['comment'],30,''); ?></span>
                                    </div>
                                 </li>
<?php } ?>
</ul>
           					<?php echo $multipage;?>
</div>
</div>
</div>
<div class="divider-line"></div>
<div class="gallery-conbte-wrapper">
<div class="gallery-conbte-entry">
<a href="http://www.8264.com/plugin.php?id=dailypicture:public" class="btn-conbte"><i class="dy-sprite"></i>我要投稿</a>
<span class="pub-reward">每幅刊登作品奖励10枚8264币</span>
</div>
</div>
<div class="dy-info-scroll-area">
<div class="dy-info-scroll-bar"></div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
var adjustImgSize = function(img, boxWidth, boxHeight) {
console.log("boxWidth:"+boxWidth,"boxHeight:"+boxHeight);
        var tempImg = new Image();
        tempImg.src = img.attr('src');
        var imgWidth=tempImg.width;
        var imgHeight=tempImg.height;

        if((boxWidth/boxHeight)>=(imgWidth/imgHeight))
        {
            img.width((boxHeight*imgWidth)/imgHeight);
            img.height(boxHeight);
            var margin=(boxWidth-img.width())/2;
            img.css("margin-left",margin);
        }
        else if((boxWidth/boxHeight)<(imgWidth/imgHeight))
        {
            img.width(boxWidth);
            img.height((boxWidth*imgHeight)/imgWidth);
            var margin=(boxHeight-img.height())/2;
            img.css("margin-top",margin);
        }
    };
jQuery(window).load(function() {
var wH = jQuery(".dy-container").height();
var nH = wH-56;
jQuery(".dy-info-scroller").height(nH);
});
jQuery(window).resize(function(){
var wH = jQuery(".dy-container").height();
var nH = wH-56;
jQuery(".dy-info-scroller").height(nH);
adjustImgSize(jQuery(".gallery-image-original img"), jQuery(".gallery-image-original img").parent().width(), jQuery(".gallery-image-original img").parent().height());
});
jQuery(".dy-info-scroller").niceScroll({
cursorcolor:"#333",
cursorwidth:"4px",
cursorborderradius:"2px",
cursorborder:"none",
boxzoom:false,
touchbehavior:false
});
jQuery(function(){
jQuery(".link-share").click(function() {
jQuery(".share-list").toggle();
});
jQuery('.gallery-image-original img').load(function() {
adjustImgSize(jQuery(this), jQuery(this).parent().width(), jQuery(this).parent().height());
});
jQuery(".dy-left").hover(function() {
jQuery(".dy-head").show();
}, function() {
jQuery(".dy-head").hide();
});
});
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F49299785f8cc72bacc96c9a5109227da' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html><?php output(); ?>