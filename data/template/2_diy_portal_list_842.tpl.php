<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./template/8264/portal/list_842.htm', './template/8264/common/float_guide.htm', 1509518031, 'diy', './data/template/2_diy_portal_list_842.tpl.php', 'data/diy', 'portal/list_842')
|| checktplrefresh('./template/8264/portal/list_842.htm', './template/8264/common/ewm_l.htm', 1509518031, 'diy', './data/template/2_diy_portal_list_842.tpl.php', 'data/diy', 'portal/list_842')
|| checktplrefresh('./template/8264/portal/list_842.htm', './template/8264/common/footer_8264_new.htm', 1509518031, 'diy', './data/template/2_diy_portal_list_842.tpl.php', 'data/diy', 'portal/list_842')
;
block_get('4887');?><?php include template('common/header2014'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/portal/style_842.css" />
<style id="diy_style" type="text/css">#framewzhpph {  margin:0px !important;border:none !important;}#portal_block_876 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_876 .content {  margin:0px !important;}#frameIyDsoy {  margin:0px !important;border:#000000 none !important;background-color:transparent !important;background-image:none !important;}#portal_block_877 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_877 .content {  margin:0px !important;}#framei8iPE8 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_878 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_878 .content {  margin:0px !important;}#frameH29Vg2 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#frameOBaEI7 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#framekkTwA1 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#frameCGpC9B {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_880 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_880 .content {  margin:0px !important;}#portal_block_881 {  background-color:transparent !important;background-image:none !important;margin:0px !important;}#portal_block_881 .content {  margin:0px !important;}#portal_block_882 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_882 .content {  margin:0px !important;}#portal_block_879 {  background-color:transparent !important;background-image:none !important;margin:0px !important;border:none !important;}#portal_block_879 .content {  margin:0px !important;}#frameU74dW8 {  margin:0px !important;border:#000000 0px none !important;background-color:transparent !important;background-image:none !important;}#portal_block_4887 {  margin:0px !important;border:#000000 0px none !important;background-color:transparent !important;background-image:none !important;}#portal_block_4887 .content {  margin:0px !important;}</style>


<div class="warpten clearfix">
<div class="sm">
<div class="sm_n clearfix">
<a href="http://www.8264.com/plugin.php?id=dailypicture:public" target="_blank"><img src="http://static.8264.com/static/images/moban/mryt/images/tj.png" class="signUp"></a>
<div>
8264每日一图是由8264主办，旨在传播户外运动精神，展现户外运动文化。户外运动在中国蓬勃发展，每年都有数以千万计的驴友参与到其中，这也是未来人们生活不可缺少的一部分。8264每日一图作为国内户外运动图片栏目的先驱者，在中国驴友的目光和脚步中前行，我们期望在若干年之后，这里的每一幅作品都能成为户外运动发展的记录，不朽的记忆。
</div>
<div style="padding:10px 0px;"> 
<div class="baiduShare">
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare" style="float:left; padding-top:1px;">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<span class="bds_more"></span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://news.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END -->
</div>
<br></div>
</div>
</div><?php $array; ?><?php $pic_array = array(array(), array(), array()); $i = 0; if(count($array) > 3) { ?><?php $pic_array[0][] = $array[0]; unset($array[0]); ?><?php $pic_array[1][] = $array[1]; unset($array[1]); ?><?php $pic_array[2][] = $array[2]; unset($array[2]); ?><?php $pics = array_merge($array, array()); } ?><?php foreach ($pics as $pic): ?><?php $pic_array[$i%3][] = $pic; ?><?php ++$i; ?><?php endforeach; ?><?php include DISCUZ_ROOT.'/template/default/forum/daypicture_from_list.php'; ?><div class="st">
<!--单条开始--><?php if(is_array($pic_array['0'])) foreach($pic_array['0'] as $pic) { ?><div><?php render_pic($pic); ?></div>
<?php } ?>
<!--单条结束-->
</div>
<div class="st">
<!--单条开始--><?php if(is_array($pic_array['1'])) foreach($pic_array['1'] as $pic) { ?><div><?php render_pic($pic); ?></div>
<?php } ?>
<!--单条结束-->
</div>
<div class="st">
<!--单条开始--><?php if(is_array($pic_array['2'])) foreach($pic_array['2'] as $pic) { ?><div><?php render_pic($pic); ?></div>
<?php } ?>
<!--单条结束-->
</div><?php $count = DB::result_first("SELECT COUNT(*) FROM ".DB::table('portal_article_title')." WHERE catid IN (842) AND pic<>'' and idtype<>''"); ?><?php $ppp = 50; ?><?php $multi = multi($count, $ppp, $page, 'portal.php?mod=list&catid=842'); ?></div>
<?php if($multi) { ?>
<div class="listPageBox clearfix" style="width:960px; margin:auto;"><?php echo $multi;?></div>
<?php } ?>
<div class="yl">
<div style="display:none;">
<div class="mmtitle">
<h2>友情链接</h2>
</div>
<div class="ylcon">
<div class="ylcon_nei clearfix">
<!--[diy=fLink]--><div id="fLink" class="area"><div id="frameU74dW8" class=" frame move-span cl frame-1"><div id="frameU74dW8_left" class="column frame-1-c"><div id="frameU74dW8_left_temp" class="move-span temp"></div><?php block_display('4887'); ?></div></div></div><!--[/diy]-->
</div>
</div>
</div>
</div><div class="float-guide" style="display:none;">
<ul>
<li>
<a href="http://www.8264.com/list/842" class="photoDay">每日一图</a>
<?php if($mrytnum>0) { ?>
<span class="new"><?php echo $mrytnum;?></span>
<?php } ?>
</li>
<li>
<a href="http://www.8264.com/pp/" class="steelRose">铿锵玫瑰</a>
<?php if($kqmgnum>0) { ?>
<span class="new"><?php echo $kqmgnum;?></span>
<?php } ?>
</li>
<li style="display:none;">
<a href="http://www.8264.com/list/881" class="lineRec">线路推荐</a>
<?php if($xltjnum>0) { ?>
<span class="new"><?php echo $xltjnum;?></span>
<?php } ?>
</li>
<li>
<a href="http://www.8264.com/list/871" class="bbsRec">论坛精选</a>
<?php if($jctjnum>0) { ?>
<span class="new"><?php echo $jctjnum;?></span>
<?php } ?>
</li>
<li>
<a href="http://hd.8264.com/" class="zwxl" target="_blank">活动平台</a>
</li>
<li>
<a href="http://www.8264.com/list/912/" class="hwsy" target="_blank">户外摄影师</a>
<?php if($hwsysnum>0) { ?>
<span class="new"><?php echo $hwsysnum;?></span>
<?php } ?>
</li>
</ul>
<script type="text/javascript">
;(function($){
var width = $(window).width();
var csswd = (width-980)/2+990;
$('.float-guide').css("right",csswd);
})(jQuery);
</script>
<style type="text/css">
/* 右侧固定导航 */
.float-guide { width: 122px; padding: 5px; float: left; position: fixed; top: 35%; _position: absolute; _bottom: auto; _top:expression(eval(document.documentElement.scrollTop));
_margin-top: 20%; border: 1px solid #e9e9e9; background-color: #fdfdfd; border-radius: 3px; }
.float-guide a { display: block; height: 36px; text-indent: 40px; font: 14px/36px "Microsoft YaHei"; color: #637a94; background-color: #FFF; border-radius: 3px; }
.float-guide a:hover { color: #FFF; background-color: #637a94; text-decoration: none; }
.float-guide .photoDay { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px 9px;}
.float-guide .photoDay:hover { background-position: 11px -181px; }
.float-guide .steelRose { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -31px;}
.float-guide .steelRose:hover { background-position: 11px -222px; }
.float-guide .lineRec { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -67px;}
.float-guide .lineRec:hover { background-position: 11px -258px; }
.float-guide .braveFirst { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -103px;}
.float-guide .braveFirst:hover { background-position: 11px -293px; }
.float-guide .equipRec { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -137px;}
.float-guide .equipRec:hover { background-position: 11px -327px; }
.float-guide .bbsRec { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -405px;}
.float-guide .bbsRec:hover { background-position: 11px -443px; }



.float-guide .zwxl { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 11px -481px;}
.float-guide .zwxl:hover { background-position: 11px -516px; }

.float-guide .hwsy { background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 10px -554px;}
.float-guide .hwsy:hover { background-position: 10px -590px; }

/* Add 气泡 2013-07-01 */
.float-guide ul li { position: relative; }
.float-guide ul li .new { position: absolute; top: -5px; right: -10px; width: 30px; height: 14px; background: url(http://static.8264.com/static/images/moban/glxz/images/ico-guide.png) no-repeat 0 -380px; font-size: 9px; line-height: 11px; color: #FFF; text-align: center; cursor: pointer; }
</style>
</div>
<style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.h13_ewm{ height:13px;}
.ewmbox{ width:160px; position: fixed !important; _position: absolute; z-index: 1; top:370px;  _top:expression(eval(document.documentElement.scrollTop)); float:right; color:#585858;}
.close_ewm{ width:11px; height:11px; background:url(http://static.8264.com/static/images/common/ewmclose.jpg) left top no-repeat; float:right; margin-bottom:2px; display:none;}
.close_ewm:hover{  background:url(http://static.8264.com/static/images/common/ewmclose_hover.jpg) left top no-repeat;}
.ewmwarpten{ width:110px; font-size:12px; background:#efefef; text-align:center; font-family:"Microsoft YaHei",Tahoma,Helvetica,SimSun,sans-serif; padding:4px 0px 10px 0px; display:block; color:#1e6d9b; text-decoration:none;}

</style>
<div class="ewmbox" style="display:none;">
<div class="clear_b h13_ewm"><a href="javascript:void(0)" class="close_ewm"></a></div><?php echo adshow("custom_468"); ?></div>
<script type="text/javascript">

jQuery(function(){	
var isiOS 	  = navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone') || navigator.userAgent.match('iPod');
    var isAndroid = navigator.userAgent.match('Android');
    if (!isiOS && !isAndroid) {
    	jQuery(".ewmbox").show();    	
    	jQuery(".ewmbox").hover(
function () {
jQuery(".close_ewm",this).show();
  },
  function () {
jQuery(".close_ewm",this).hide();
  }
);
jQuery(".close_ewm").click(function(){
jQuery(".ewmbox").hide();
});   	
    }
var ww = jQuery(window).width();   
var r_z = (ww-980)/2 -180;
if(r_z<0){
jQuery(".ewmbox").css("right",'0px');
}else{
jQuery(".ewmbox").css("right",r_z);
};
if(ww>1350){
jQuery(".ewmbox").show();
}else{
jQuery(".ewmbox").hide();
}	
});

</script>
</div>
<!-- 友情链接 -->
<style>
.friendLink{ background: #0f1f2b; padding: 15px 0 18px 0px;}
.friendLink a { color: #807f7f; display: inline; margin-right: 10px; white-space: nowrap; font-size:12px;}
.friendLink a:hover { color: #fff; text-decoration:none;}
</style>
<div class="friendLink">
<div class="layout w980">
<?php if(!empty($_G['setting']['pluginhooks']['global_friendlylink'])) echo $_G['setting']['pluginhooks']['global_friendlylink']; ?>
</div>
</div>
<div class="bottomNav">
<div class="layout" style="position:relative;">
<div class="copyright">
<p><a href="http://www.miitbeian.gov.cn/" target="_blank">津ICP备05004140号-10</a> ICP证 津B2-20110106&nbsp;&nbsp;&nbsp;天津信一科技有限公司版权所有</p>
<p>户外有风险，8264提醒您购买<a href="http://bx.8264.com/?8264com" target="_blank">户外保险</a></p>
</div>
<div class="someLink">
<a target="_blank" href="http://bbs.8264.com/member-clearcookies-formhash-d64f4f90.html" rel="nofollow">清除COOKIE</a>
|
<?php if($_G['group']['allowstatdata']) { ?>
<a target="_blank" href="http://bbs.8264.com/misc-stat.html" rel="nofollow">站点统计</a> |
<?php } ?>
<a target="_blank" href="http://www.8264.com/about-contact.html" rel="nofollow">联系我们</a>
|
<a href="http://www.8264.com/about-contact.html#q4" rel="nofollow">8264招聘</a>
|
<a href="http://bbs.8264.com/misc-faq.html" rel="nofollow">帮助</a>
<span class="app">
<a href="http://bbs.8264.com/thread-2317569-1-1.html" target="_blank" class="appIco_95x27" rel="nofollow"></a>
</span>
</div>


        <?php if($_GET['mod'] =='index') { ?>
        <style>
.qdcionbottom{ position:absolute; left:509px; top:0px;}
.qdcionbottom img{ width:49px; height:44px;}
        </style>
        <a href='http://na3.tjaic.gov.cn/netmonitor/query/ScrNetEntQuery/Display.do?show=1&id=6eb59bd37f0000011ec3c0e5a59f7891-1-v-e-r-&ztLOID=8b4b03e47f0000012b8f0a26c9a87e67' class="qdcionbottom" target="_blank"><img src="http://static.8264.com/static/images/moban/indexnew/images/guohui.png" /></a>
        <?php } ?>



</div>
</div>
<?php if($nobottomad !== false) { ?>
<!-- 页面底部弹出新闻表 -->
<script src="http://static.8264.com/static/js/jquery.cookie.js" type="text/javascript" type="text/javascript"></script>
<style>
  .newswarpten{ position:absolute; position:fixed!important; bottom:0px; display:none; left:50%;z-index: 999}
  .newstopone{ height:46px;  font-size:14px; background: url(http://static.8264.com/static/image/common/kxbg.png) 0px -1px no-repeat #fffff6; border:#e0d3be solid 1px;  float:left; border-right:0 none;}
  .newstopone .linktitle_4587{ float:left; margin:12px 0px 0px 70px; display:inline;}
  .newstopone .linktitle_4587 a{ font-size:16px; color:#064361; text-decoration:none;}
  .newstopone .linktitle_4587 a:hover{ font-size:16px; color:#ff7e00; text-decoration:none;}
  .newstopone .close16_16{ width:16px; height:16px; float:right; cursor:pointer; background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -47px -1px no-repeat; margin:16px 0px 0px 10px; display:inline;}
  .newstopone .close16_16:hover{background:url(http://static.8264.com/static/image/common/kxbgarrowclose.png) -1px -1px no-repeat;}
  .newsarrow{ width:18px; height:48px; background:url(http://static.8264.com/static/image/common/kxbgarrow.png) left top no-repeat; float:right;}
</style>
<body>
<div class="newswarpten">
  <div class="newstopone">
    <div style="display: inline-block;padding-left: 70px;height: 46px;line-height: 46px;"><?php echo adshow("custom_294"); ?></div>
    <span class="close16_16"></span>
  </div>
  <div class="newsarrow"></div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
  var tiao = jQuery(".newswarpten").width();
  jQuery(".newswarpten").css( 'margin-left' , -tiao/2 );
  var t_time = Date.parse(new Date());
  var cookietime = jQuery.cookie('showboxtime');
  if(!cookietime){
    jQuery(".newswarpten").show();
  };
  if(t_time >= cookietime){
     jQuery(".newswarpten").show();
  };
  jQuery('.close16_16,.linktitle_4587 a').click(function(){
    var t_time = Date.parse(new Date());
    jQuery.cookie('showboxtime',t_time+3600*24*1000,{expires:30,domain:'8264.com',path:'/'});
    jQuery(".newswarpten").hide();
  });
});
</script>
<!-- //页面底部弹出新闻表 -->
<?php } if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
    </div>
    <div class="mncr"></div>
    </div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; if(!$_G['setting']['bbclosed']) { ?> <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
<script src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } } if($_GET['diy'] == 'yes' && ($_G['mod'] == 'topic' || $_G['group']['allowdiy']) && (empty($do) || $do != 'index') && !empty($_G['style']['tplfile'])) { ?>
<script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/portal_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } if($_GET['diy'] == 'yes' && $space['self'] && $_G['mod'] == 'space' && $do == 'index') { ?>
    <script src="http://static.8264.com/static/js/common_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
    <script src="http://static.8264.com/static/js/space_diy.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F49299785f8cc72bacc96c9a5109227da' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- 链接自动推送 -->
<script type="text/javascript">
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<!-- //链接自动推送 -->
<?php if(($_G['mod'] == 'viewthread' || $_GET['act'] == 'showview' || $_GET['act'] == 'commentdetail' || $_G['mod'] == 'view' || $_GET['ctl'] == 'topic')) { ?>
<script type="text/javascript">
var _gaq = _gaq || [];
<?php if($_G['mod'] == 'view') { ?>
_gaq.push(['tid', '<?php echo $_GET['aid'];?>']);
_gaq.push(['type', '3']);
<?php } elseif($_GET['ctl'] == 'topic') { ?><?php $_G['tid'] = $topic['topicid'] ? $topic['topicid'] : 1; ?>_gaq.push(['tid', '<?php echo $_G['tid'];?>']);
_gaq.push(['type', '6']);
<?php } else { ?>
_gaq.push(['fid', '<?php echo $_G['fid'];?>']);
_gaq.push(['tid', '<?php echo $_G['tid'];?>']);
<?php } if($_G['mod'] == 'viewthread') { ?>
_gaq.push(['type', '1']);
<?php } elseif($_GET['act'] == 'showview') { ?>
_gaq.push(['type', '2']);
<?php } elseif($_GET['act'] == 'commentdetail') { ?>
_gaq.push(['pid', '<?php echo $pid;?>']);
_gaq.push(['type', '4']);
<?php } ?>

(function(d, t) {
var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
g.type = 'text/javascript'; g.async = true;
g.src = 'http://static.8264.com/static/js/ga.js?<?php echo VERHASH;?>';
s.parentNode.insertBefore(g, s);
})(document, 'script');
</script>
<?php } ?>
</body>
</html><?php output(); ?>