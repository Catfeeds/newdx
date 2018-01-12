<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('fenxiang', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/exam/topic/fenxiang.htm', './template/8264/common/footer_8264_new.htm', 1489208816, '2', './data/template/2_2_exam_topic_fenxiang.tpl.php', './template/8264', 'exam/topic/fenxiang')
;?><?php include template('common/header_8264_new'); ?><link rel="stylesheet" href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>">
<link rel="stylesheet" href="http://static.8264.com/static/css/exam/global/1.0.1/css/exam.css?<?php echo VERHASH;?>">
<link rel="stylesheet" href="http://static.8264.com/static/css/exam/bootstrap.min.css?<?php echo VERHASH;?>">
<link rel="stylesheet" href="http://static.8264.com/static/css/exam/kaoshistyle.css?<?php echo VERHASH;?>">

<style>
    @media (max-width:767px){
html,body{
background:#0b0b0b;
}
}
</style>
<header class="header_new">
    <!-- <a class="icon4" href="javascript:window.history.go(-1);"></a> -->
    <a href="javascript:void(0);" class="logo"></a>
</header>
<div class="header">
        <div class="layout">
            <div class="icoHill"></div>
            <div class="headerL">
                <h1>
                    <span class="country">考试系统</span>
                </h1>
                <div class="site">
                    <a href="http://www.8264.com/kaoshi/">考试系统</a>
                    <em>></em>
                    <a class="titleoverflow200">分享页面<div class="boxtm"></div></a>
                </div>
            </div>
            <style type="text/css">
.dsad{position:absolute;right:230px;top:18px}
</style>
<div class="dsad"><?php echo adshow("custom_290"); ?></div>
        </div>
    </div>
    <!--主体内容开始-->
    <div class="w980">
        <?php echo $str;?>
        <div class="prbox">
            <div class="warpten clear_b">
                <div class="brannerbox">
                        <img src="http://static.8264.com/static/images/exam/tan/brannertop.png" alt="">
                </div>
                <div class="contentbox">
                        <div class="fenshu">
                                <?php echo $scores;?><i>分</i>
                        </div>
                    <div class="pingyubox">
                        <div class="pingyucon">
                            <b>评语：</b><?php echo $pingyu;?></div>
                    </div>
                    <div class="wyksbox">
                        <div class="wykscon">
                            <a href="/kaoshi" class="">我要考试</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottomimg">
                <img src="http://static.8264.com/static/images/exam/tan/endbg.png" alt="">
            </div>
        </div>
    </div>
    <!--主体内容结束-->
<br/></div>
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
<p>津ICP备05004140号-10 ICP证 津B2-20110106&nbsp;&nbsp;&nbsp;天津信一科技有限公司版权所有</p>
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
        <a href='http://na3.tjaic.gov.cn/netmonitor/query/ScrNetEntQuery/Display.do?show=1&id=6eb59bd37f0000011ec3c0e5a59f7891-1-v-e-r-&ztLOID=8b4b03e47f0000012b8f0a26c9a87e67' class="qdcionbottom" target="_blank"><img src="http://na3.tjaic.gov.cn/netmonitor/images/guohui.png" /></a>
        <?php } ?>
        
        
        
</div>
</div>
<?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
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
</html><?php output(); ?><footer class="footer_ask"> 
    <div class="fbc">
        <a href="http://m.8264.com/bbs">8264论坛</a>
        <a href="http://um0.cn/1mEo9u" class="toApp">在外APP</a>
        <p class="copyRight">Copyright 2013 - 2014  8264.com. All Rights Reserved</p>
    </div>
</footer>