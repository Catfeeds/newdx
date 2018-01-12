<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('seo_xuexiao', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/exam/topic/seo_xuexiao.htm', './template/8264/common/footer_8264_1170_new.htm', 1509518318, '2', './data/template/2_2_exam_topic_seo_xuexiao.tpl.php', './template/8264', 'exam/topic/seo_xuexiao')
;?><?php include template('common/header_8264_new'); ?><link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/reset.css">
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/common/common_head_bottom.css">
<style>
    .layout{ width:980px; margin:0 auto;}
    .timubox{ padding-bottom:30px;}
    .bigtimutitle{ font-size:18px; color:#1a2b38; border-bottom:#d2d2d2 solid 1px; padding:30px 0px 15px 0px; }
    .chooselist{ padding:6px 0px 0px 0px;}
    .chooselist li{ display:block; font-size:16px; color:#333; height:40px; line-height:40px; overflow: hidden;}
    .answerbox{ font-size:14px; color:#333; margin-top:15px;}
    .answerfxbox{ margin-top:10px;}
    .answerfxbox img{ width:290px; display:block; margin:15px 0px 0px 0px;}
    .othertimubox{ padding:60px 0px 0px 0px;}
    .classificationtitle{  position:relative; padding:0px 0px 0px 20px; line-height:1.1;}
    .classificationtitle:after{ content:""; width:5px; height:27px; border-radius:5px; position:absolute; left:0px; top:0px; display:block; background:#508eff;}
    .classificationtitle a{ font-size:22px; color:#333; text-decoration:none;}
    .pre_next_box{ border-top:#d2d2d2 solid 1px; background:#f6f8fb;}
    .pre_next_box a{ font-size:18px; color:#357dff; text-align:center; float:left; width:50%; height:56px; line-height:56px; text-decoration:none; position:relative;}
    .pre_next_box a.right:after{ content:""; height:56px; border-left:#d2d2d2 solid 1px; position:absolute; right:0px; top:0px; display:block;}
    .shipinbox{	margin:15px 0px 0px 0px; width:290px; position: relative; height:145px; display: block;}
    .shipinbox iframe{ position: absolute; left: 0px; right:0px; top:0px; bottom: 0px; width: 100%; height: 100%;}
</style>
<body>
<!--插入头部-->
<div class="header">
    <div class="layout">
        <div class="icoHill">&nbsp;</div>
        <div class="headerL">
            <h1><span class="country">户外学校</span></h1>
            <div class="site"><a href="<?php echo $_G['config']['web']['portal'];?>xuexiao/" title="户外学校">户外学校</a>&gt; <a href="<?php echo $_G['config']['web']['portal'];?>xuexiao/catinfo-<?php echo $main['catid'];?>.html" title="<?php echo $cate;?>"><?php echo $cate;?></a></div>
        </div>
    </div>
</div>
<div class="layout">
    <!--题目开始-->
    <div class="timubox">
        <div class="bigtimutitle"><?php echo $main['title'];?></div>
        <div class="chooselist">
            <ul>
                <?php if(is_array($main['answer_arr'])) foreach($main['answer_arr'] as $k => $v) { ?>                <li><?php echo $v;?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="answerbox">
            <div><b>标准答案：</b><?php echo $main['right_answer'];?></div>
            <div class="answerfxbox">
                <b>本题分析：</b>
                <?php echo $main['analysis'];?>
                <?php if($main['imgurl']) { ?>
                <img src="<?php echo $main['imgurl'];?>" alt="<?php echo $main['title'];?>_问题分析">
                <?php } ?>
                <?php if($main['videourl']) { ?>
                <div class="shipinbox"><iframe src="<?php echo $main['videourl'];?>" frameborder="0" allowfullscreen></iframe></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--题目结束-->
    <div><a href="<?php echo $_G['config']['web']['portal'];?>xuexiao/" target="_blank"><img src="http://static.8264.com/static/images/exam/kaoshilink.jpg" alt="专业户外评级测试"/></a></div>
    <!--其他分类题开始-->
    <div class="othertimubox">
        <div class="classificationtitle"><a href="<?php echo $_G['config']['web']['portal'];?>xuexiao/catinfo-<?php echo $main['catid'];?>.html" target="_blank" title="其他<?php echo $cate;?>试题">其他<?php echo $cate;?>试题</a></div>
        <!--循环其他题目开始-->
        <?php if(is_array($other)) foreach($other as $k => $v) { ?>            <div class="timubox">
            <div class="bigtimutitle"><?php echo $k+1; ?>.<?php echo $v['title'];?></div>
            <div class="chooselist">
                <ul>
                    <?php if(is_array($v['answer_arr'])) foreach($v['answer_arr'] as $key => $val) { ?>                    <li><?php echo $val;?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="answerbox">
                <div><b>标准答案：</b><?php echo $v['right_answer'];?></div>
                <div class="answerfxbox">
                    <b>本题分析：</b>
                    <?php echo $v['analysis'];?>
                    <?php if($v['imgurl']) { ?>
                    <img src="<?php echo $v['imgurl'];?>" alt="<?php echo $main['title'];?>_问题分析">
                    <?php } ?>
                    <?php if($v['videourl']) { ?>
                    <div class="shipinbox"><iframe src="<?php echo $v['videourl'];?>" frameborder="0" allowfullscreen></iframe></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <!--循环其他题目开始-->
    </div>
    <!--其他分类题结束-->
    <div class="pre_next_box clearfix">
        <a href="<?php echo $main['pre_url'];?>" class="right" title="<?php echo $main['pre_title'];?>">上一题</a>
        <a href="<?php echo $main['next_url'];?>" class="" title="<?php echo $main['next_title'];?>">下一题</a>
    </div>
</div>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?49299785f8cc72bacc96c9a5109227da";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script></div>
<div class="bottomNav">
<div class="layout">
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
</div>
</div>
<?php if($upgradecredit !== false) { ?><div id="g_upmine_menu" class="g_up" style="display:none;">
    <div class="crly">
        积分 <?php echo $_G['member']['credits'];?>, 距离下一级还需 <?php echo $upgradecredit;?> 积分
    </div>
    <div class="mncr"></div>
    </div>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_footer'])) echo $_G['setting']['pluginhooks']['global_footer']; ?>
</div>

<?php if(!$_G['setting']['bbclosed']) { ?> <?php if($_G['uid'] && !isset($_G['cookie']['checkpm'])) { ?>
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
<?php if(($_G['mod'] == 'viewthread' || $_GET['act'] == 'showview' || $_GET['act'] == 'commentdetail' || $_G['mod'] == 'view' || $_G['mod'] == 'readmodeltravel')) { if($_G['mod'] == 'readmodeltravel' && !empty($placeid)) { ?><?php $_G['tid'] = substr($placeid, -5, 5); } ?>
<script type="text/javascript">
var _gaq = _gaq || [];
<?php if($_G['mod'] == 'view') { ?>
_gaq.push(['tid', '<?php echo $_GET['aid'];?>']);
_gaq.push(['type', '3']);
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
<?php } elseif($_G['mod'] == 'readmodeltravel') { ?>
_gaq.push(['type', '5']);
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