<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_album_pic', 'common/header_common');
0
|| checktplrefresh('./template/8264/home/space_album_pic.htm', './template/8264/common/header_common.htm', 1509517866, '2', './data/template/2_2_home_space_album_pic.tpl.php', './template/8264', 'home/space_album_pic')
|| checktplrefresh('./template/8264/home/space_album_pic.htm', './template/8264/common/seccheck_2014.htm', 1509517866, '2', './data/template/2_2_home_space_album_pic.tpl.php', './template/8264', 'home/space_album_pic')
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
<link href="<?php echo $_G['siteurl'];?><?php echo STATICURL;?>css/forum/photo.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo $_G['siteurl'];?><?php echo STATICURL;?>css/home/uc_tanchukuang.css?<?php echo VERHASH;?>" />
<style type="text/css">
.vt32 {top:32px!important;}
.vt64 {top:66px!important;}
</style>
<script src="<?php echo $_G['setting']['jspath'];?>jquery-1.9.1.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>jquery.nicescroll.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/javascript">zoomstatus = parseInt(<?php echo $_G['setting']['zoomstatus'];?>);var imagemaxwidth = '<?php echo IMAGEMAXWIDTH;?>';var aimgcount = new Array();</script>
<link href="http://static.8264.com/static/css/home/home_space.css?<?php echo VERHASH;?>" rel="stylesheet" type="text/css">
<script>
jQuery(document).ready(function($) {
var picid = <?php echo $picid;?>;

//分页
jQuery("#commentsList .pg").addClass("gallery-reply-pager");
jQuery("#commentsList").on('click',".pg>a",function(e){
e.preventDefault();
getpage(this.href);
});
});

//分页
function getpage(url){
jQuery.post(url,{inajax:1},function(data){
jQuery("#commentsList").nextAll().remove();
jQuery("#commentsList").html(data);
jQuery("#commentsList .pg").addClass("gallery-reply-pager");
});
jQuery("#commentsList>.h2Tit").after('<div style="padding: 0 0 10px 6px;"><img src="<?php echo $_G['siteurl'];?><?php echo STATICURL;?>image/common/loading.gif" style="vertical-align: top;"> 数据读取中...</div>');
jQuery("#f_message").val('');
jQuery(document).scrollTop(jQuery('#commentsList').offset().top-60);
}
</script>
</head>

<body><?php $_G[gp_listpage] = max($_G[gp_listpage], 1); ?><div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="container dy-container">
<!--dy-left-->
<div class="dy-left">
<div class="dy-head">
<div class="dy-head-right">
<a href="javascript:void(0);" class="link-share"><i>分享</i></a>	
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
<?php if($prevpicid) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>&amp;do=album&amp;picid=<?php echo $prevpicid;?>" class="image-original-prev"><i class="dy-sprite"></i></a>
<?php } if($nextpicid) { ?>
<a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>&amp;do=album&amp;picid=<?php echo $nextpicid;?>" class="image-original-next"><i class="dy-sprite"></i></a>
<?php } ?>
</div>
</div>
</div>
<!--dy-left end-->
<!--dy-right-->
<div class="dy-right">
<div class="dy-anchors">
<div class="dy-notification no-bor">
<a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>&amp;do=album&amp;id=<?php echo $album['albumid'];?><?php if($_G['gp_listpage']>1) { ?>&amp;page=<?php echo $_G['gp_listpage'];?><?php } ?>" class="dy-close-button"><i class="dy-sprite"></i>关闭</a>
</div>
</div>
<div class="dy-info-scroller">
<!--相册及照片信息-->
<div class="dy-info-wrapper photoitem-wrapper">
<style type="text/css">
.photoitem-info{
position: relative;
padding-left: 65px;
min-height: 48px;
}
.photoitem-info .avatar{
position: absolute;
left: 0;
top: 3px;
}
.photoitem-info .avatar img{
width: 48px;
height: 48px;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
}
.photoitem-other{
}
.photoitem-other span{
display: block;
font-size: 12px;
margin-bottom: 2px;
color: #4f4f4f;
}
.photoitem-other .user-name{
font-size: 14px;
margin-bottom: 5px;
}
.photoitem-other .user-name a{
color: #428bca
}
.photoitem-other .album-name{
color: #4f4f4f;
margin-left: 8px;
}
.photoitem-title-wrap{
margin-top: 10px;
}
.photoitem-title-wrap .photoitem-title{
color: #949494;
}
.photoitem-title-wrap .photoitem-edit,.photoitem-title-wrap .photoitem-save{
font-size: 12px;
color: #428bca;
}
.photoitem-title-wrap .photoitem-save{
float: right;
}
.photoitem-title-wrap .mod-input{
overflow: hidden;
/*display: none;*/
}
.photoitem-title-wrap .mod-input input{
width: 278px;
padding: 3px 5px 3px 0;
border: 0 none;
background-color: transparent;
color: #949494;
}
.dy-original > .dy-original-wrapper > .gallery-image-original{
text-align: center;
}
</style>
<div class="photoitem-info">
<a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>" class="avatar"><?php echo avatar($album[uid],small); ?></a>
<div class="photoitem-other">
<span class="user-name"><a href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>" title=""><?php echo $album['username'];?></a></span>
<span class="">上传于<?php echo date('Y-m-d H:i', $pic[dateline]) ?></span>
<span>来自<a class="album-name" href="home.php?mod=space&amp;uid=<?php echo $album['uid'];?>&amp;do=album&amp;id=<?php echo $album['albumid'];?>" title="<?php echo $album['albumname'];?>"><?php echo $album['albumname'];?></a></span>
</div>
</div>
<div class="photoitem-title-wrap">
<form method="post" autocomplete="off" id="editform_<?php echo $album['albumid'];?>" action="home.php?mod=spacecp&amp;ac=album&amp;op=editpic&amp;albumid=<?php echo $album['albumid'];?>&amp;subop=update&amp;is_uc=1" onsubmit="ajaxpost('editform_<?php echo $album['albumid'];?>', 'return_editpictitle');">
<div class="photoitem-title">
<span id="pictitleshow"><?php echo $pic[title] = $pic[title] ? $pic[title] : $pic[filename]; ?></span>
<?php if($space['self']) { ?><a href="javascript:void(0);" class="photoitem-edit">编辑</a><?php } ?>
</div>
<?php if($space['self']) { ?>
<div class="mod-input photoitemform" style="display:none;">
<input type="text" value="" name="title[<?php echo $pic['picid'];?>]" id="pictitleedit">
<button type="submit" class="photoitem-save" style="border: 0 none;background-color: transparent;" />保存</button>
</div>
<?php } ?>
<input type="hidden" name="editpicsubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />					
<input type="hidden" name="referer" value="<?php echo $theurl;?>" />
<input type="hidden" name="handlekey" value="editpictitle" />
<div id="return_editpictitle" style="display:none;"></div>
<input type="hidden" name="quickcomment" value="true" />
</form>
</div>
</div>		
<script type="text/javascript">
jQuery(function(){				
//图片描述相关
jQuery('.photoitem-edit').click(function(){
jQuery(this).parent().hide();
jQuery('.photoitemform').show();
jQuery('#pictitleedit').focus().val(jQuery('#pictitleshow').html());
});

jQuery('.photoitem-save').click(function(){
jQuery('#pictitleshow').html(jQuery('#pictitleedit').val());
jQuery('#pictitleedit').html('');
jQuery('.photoitem-title').show();
jQuery('.photoitemform').hide();
});
});						
</script>
<!--相册及照片信息 end-->
<div class="dy-reply-wrapper">
<div class="gallery-reply-editor">
                    <form id="quickcommentform_<?php echo $picid;?>" name="quickcommentform_<?php echo $picid;?>" action="home.php?mod=spacecp&amp;ac=comment&amp;handlekey=qcpic_<?php echo $picid;?>&amp;is_uc=1" method="post" autocomplete="off" onsubmit="ajaxpost('quickcommentform_<?php echo $picid;?>', 'return_qcpic_<?php echo $picid;?>');">		
                		<input type="hidden" name="refer" value="<?php echo $theurl;?>" />
<input type="hidden" name="id" value="<?php echo $picid;?>" />
<input type="hidden" name="idtype" value="picid" />
<input type="hidden" name="commentsubmit" value="true" />
<input type="hidden" name="quickcomment" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="reply-editor-entry">
                        	<div id="return_fastreply"></div>
                            <textarea name="message" class="t_note" cols="30" rows="10" id="f_message"></textarea>
                            <?php if(checkperm('seccode') && ($secqaacheck || $seccodecheck)) { ?>
                            <style type="text/css">
                            	.valid-box{position: relative;}
                            	.valid-form{display: block;margin-bottom: 10px;}
                            	.valid-form em{float: left;width: 60px;line-height: 26px;color: #949494;margin-right: 8px;}
                            	.valid-form input{border: 1px solid #d6d6d6;height: 18px;padding: 3px 5px;}
                            </style>
<div class="valid-box"><?php
$sectpl = <<<EOF
<sec> <span id="sec<hash>" class="valid-form" onclick="showMenu(this.id);"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt yzm" style="display:none;"><sec></div>
EOF;
?>
<div class="mtm mbm sec"><?php $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');
$sectpldefault = $sectpl;
$sectplqaa = str_replace('<hash>', 'qaa'.$sechash, $sectpldefault);
$sectplqaa = str_replace('<classname>', 'tw', $sectplqaa);
$sectplcode = str_replace('<hash>', 'code'.$sechash, $sectpldefault);
$sectplcode = str_replace('<classname>', 'yzm', $sectplcode);
$secshow = !isset($secshow) ? 1 : $secshow;
$sectabindex = !isset($sectabindex) ? 1 : $sectabindex; ?><?php
$seccheckhtml = <<<EOF

<input name="sechash" type="hidden" value="{$sechash}" />

EOF;
 if($sectpl) { if($secqaacheck) { 
$seccheckhtml .= <<<EOF

<script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318&r={$sechash}" type="text/javascript"></script>

EOF;
 } if($seccodecheck) { 
$seccheckhtml .= <<<EOF

{$sectplcode['0']}{$sectplcode['1']}<em>验证码</em><input name="seccodeverify" id="seccodeverify_{$sechash}" type="text" autocomplete="off" style="width:100px" onblur="checksec('code', '{$sechash}')" tabindex="{$sectabindex}" />
<a href="javascript:;" onclick="updateseccode('{$sechash}');doane(event);" class="xi2">换一个</a>
<span id="checkseccodeverify_{$sechash}"><img src="http://static.8264.com/static/image/common/none.gif" width="16" height="16" class="vm" /></span>
{$sectplcode['2']}<span id="seccode_{$sechash}"></span>

EOF;
 if($secshow) { 
$seccheckhtml .= <<<EOF
<script type="text/javascript" reload="1">updateseccode('{$sechash}', undefined, '点击换一个，更换验证码');</script>
EOF;
 } 
$seccheckhtml .= <<<EOF

{$sectplcode['3']}

EOF;
 } } 
$seccheckhtml .= <<<EOF


EOF;
?><?php unset($secshow); if(empty($secreturn)) { ?><?php echo $seccheckhtml;?><?php } ?>
</div>
</div>							
<?php } ?>
                           	<button class="btn-comment" type="submit" <?php if(!$_G['uid']) { ?>onclick="showWindow('login', 'member.php?mod=logging&action=login&guestmessage=yes');return false;"<?php } ?>>评论图片</button>                           	
<span id="return_qcpic_<?php echo $picid;?>" style="display:none;"></span>
                    </div>
</form>
</div>
<script type="text/javascript">
function succeedhandle_qcpic_<?php echo $picid;?> (url, message, values) {
jQuery("#f_message").val('');
getpage('http://u.8264.com/home.php?mod=space&uid=<?php echo $album['uid'];?>&do=album&picid=<?php echo $picid;?>&page=1');
var commentcount = parseInt(jQuery('#commentcount').html(), 10) + 1;
jQuery('#commentcount').html(commentcount);
showDialog(message,"notice");
}
</script>
<!--评论列表-->
<div class="gallery-reply-list-wrapper">
<div class="gallery-reply-head">
<div class="gallery-reply-title">
<span class="gallery-reply-count"><i class="dy-sprite"></i><span id="commentcount"><?php echo $count;?></span>条 评论</span>
</div>
</div>
<div class="gallery-reply-list" id="commentsList">
<?php if($list) { ?>					
<ul>
                            <?php if(is_array($list)) foreach($list as $v) { ?>                             <li id="comments_<?php echo $v['cid'];?>">
                                <div class="reply-misc-main">
                                    <a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" class="author-face">		
                                        <?php echo avatar($v[authorid],small); ?>                                        <?php echo $v['author'];?>
                                    </a>
                                    <span class="reply-cont"><?php echo $v['message'];?></span>
                                </div>
                             </li>
<?php } ?>
</ul>
       					<?php echo $multi;?>					
<?php } ?>
</div>
</div>
<!--评论列表 end-->
</div>				
</div>
</div>
<!--dy-right end-->
</div>

<script type="text/javascript">
// var adjustImgSize = function(img, boxWidth, boxHeight) {
 //        var tempImg = new Image();
 //        tempImg.src = img.attr('src');
 //        var imgWidth=tempImg.width;
 //        var imgHeight=tempImg.height;
  
 //        if((boxWidth/boxHeight)>=(imgWidth/imgHeight))
 //        {
 //            img.width((boxHeight*imgWidth)/imgHeight);
 //            img.height(boxHeight);
 //            var margin=(boxWidth-img.width())/2;
 //            img.css("margin-left",margin);
 //        }
 //        else if((boxWidth/boxHeight)<(imgWidth/imgHeight))
 //        {
 //            img.width(boxWidth);
 //            img.height((boxWidth*imgHeight)/imgWidth);
 //            var margin=(boxHeight-img.height())/2;
 //            img.css("margin-top",margin);
 //        }
 //    };
jQuery(".dy-info-scroller").niceScroll({
cursorcolor:"#333",
cursorwidth:"4px",
cursorborderradius:"2px",
cursorborder:"none",
boxzoom:false,
touchbehavior:false
});
jQuery(function(){
var _w = parseInt(jQuery(".gallery-image-original").width());
var _h = parseInt(jQuery(".gallery-image-original").height());
jQuery(".gallery-image-original img").each(function(i){
var img = jQuery(this);
var realWidth;
var realHeight;
jQuery("<img/>").attr("src", jQuery(img).attr("src")).load(function() {
realWidth = this.width;
realHeight = this.height;
var _mt = (_h - img.height()) / 2;
if(realWidth >= _w && realHeight < _h) {
// console.log(1);
// console.log("Width:" + realWidth + "Height:" + realHeight);
jQuery(img).css({
"width": "100%",
"height": "auto",
"margin-top": _mt
});
} else if(realHeight >= _h) {
// console.log(2);
// console.log("Width:" + realWidth + "Height:" + realHeight);
jQuery(img).css({
"width": "auto",
"height": "100%"
});
} else {
// console.log(3);
// console.log("Width:" + realWidth + "Height:" + realHeight);
jQuery(img).css({
"width": realWidth+'px',
"height": realHeight+'px',
"margin-top": _mt
});
}
});
});
//调整图片位置
// var wH = jQuery(".dy-container").height();
// var nH = wH-56;
// jQuery(".dy-info-scroller").height(nH);
// adjustImgSize(jQuery(".gallery-image-original img"), jQuery(".gallery-image-original img").parent().width(), jQuery(".gallery-image-original img").parent().height());

jQuery(".link-share").click(function() {
jQuery(".share-list").toggle();
});
// jQuery('.gallery-image-original img').load(function() {
// 	adjustImgSize(jQuery(this), jQuery(this).parent().width(), jQuery(this).parent().height());
// });
jQuery(".dy-left").hover(function() {
jQuery(".dy-head").show();
}, function() {
jQuery(".dy-head").hide();
});

if (jQuery('.yzm').length > 0) {
setInterval(function(){
jQuery('.yzm').eq(0).css({'left':'0px'}).addClass('vt32');
jQuery('.yzm').eq(1).css({'left':'0px'}).addClass('vt64');
},10);	
}	
});
</script>
</body>
</html><?php output(); ?>