<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('list', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/question/topic/list.htm', './template/8264/common/zhidemai.htm', 1509518043, '2', './data/template/2_2_question_topic_list.tpl.php', './template/8264', 'question/topic/list')
|| checktplrefresh('./template/8264/question/topic/list.htm', './template/8264/common/footer_8264_new.htm', 1509518043, '2', './data/template/2_2_question_topic_list.tpl.php', './template/8264', 'question/topic/list')
;?><?php include template('common/header_8264_new'); ?><link rel="stylesheet" href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>">
<link rel="stylesheet" href="http://static.8264.com/static/css/ask/global/1.0.1/css/ask.css?<?php echo VERHASH;?>">
<style>
.rcontentp img{max-height:600px; width:expression(document.body.clientHeight>600?"600px":"auto"); overflow:hidden;}
.edierbar {
    background: #f2f3f6 none repeat scroll 0 0;
    border-bottom: 0px solid #e3e3e3;
}
.pinglunmid {
    border: 0px solid #e3e3e3;
}
.activate_mask_tip_answer {
    padding: 16px 20px 20px;
}
 .gxblist img {
border-radius: 50%;
    float: left;
    height: 48px;
    width: 48px;
}

.answergoodonespan img {
    border-radius: 2px;
    float: left;
    height: 24px;
    margin-right: 8px;
    width: 24px;
}
.editable_content a{display:inline;}
</style>
<header class="header_new">
    <?php if(!empty($_G['cookie']['fromm8264xuexiao'])) { ?>
        <!--<a class="icon4" href="javascript:window.history.go(-1);"></a>-->
        <a class="icon4" href="http://m.8264.com/xuexiao"></a>
    <?php } ?>
    <a href="javascript:void(0);" class="logo"></a>
</header>
<div class="header">
        <div class="layout">
            <div class="icoHill"></div>
            <div class="headerL">
                <h1>
                    <span class="country">问答</span>
                </h1>
                <div class="site">
                    <a href="http://www.8264.com/wenda/">问答</a>
                    <?php if($lable) { ?>
<em>></em><a href="http://www.8264.com/wenda/list-0-<?php echo $lable;?>-1.html"><?php echo $outputlables[$lable]['name'];?></a>
<?php } else { ?>
<em>></em><a href="http://www.8264.com/wenda/">户外</a>
<?php } ?>

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
        <div style="margin-top: 20px;" class="tjhd-wrap">
        <div style="display:none;"><?php $bottom_ads = array('416', '409', '417'); $bottom_ad = rand(0, 2); $bottom_ad_id = $bottom_ads[$bottom_ad]; ?><?php echo adshow("custom_$bottom_ad_id"); ?></div>
<!-- 值得买 -->
        <?php include(DISCUZ_ROOT.'./source/plugin/skiing/hd_zw.php'); ?>        <?php $zhidemai_list = ForumOptionHuoDong::pianyi_sidebar(6, 'top', 'jiu', '10027'); ?>        <?php if($zhidemai_list) { ?>
        <div>
        <style>
            .zhidemaiwidth{ width:980px;}
            .zhidemaibox .zhidemailist_new li{width:144px; overflow:hidden;}
            .zhidemaibox .zhidemailist_new li img{ width:144px;}
        </style>
        <style>
/*
.zhidemaibox{ width:1100px;}

.zhidemaibox{width:980px;}
.zhidemaibox .zhidemailist_new li{width:144px; overflow:hidden;}
.zhidemaibox .zhidemailist_new li img{ width:144px;}
*/
.zhidemaibox{margin:0 auto; overflow: hidden;}
.zhidemailist_new a:hover{ text-decoration:none;}
i{ font-style:normal;}
img{ border:0;}
.zhidemailist_new:after{content: ""; display: block; clear: both; visibility: hidden;}
.zhidemailist_new{ zoom: 1;}
.zhidemailist_new{ width:1100px; overflow:hidden; margin:0 auto;}
.zhidemailist_new ul{ width:1200px;height: 268px;overflow: hidden;}
.zhidemailist_new li{ float:left; width:164px; border:#e5e5e5 solid 1px; padding:6px; margin:0px 6px 0px 0px; display:inline; position:relative;}
.zhidemailist_new li img{ width:164px;}
.zhidemailist_new li .zbname_b{ display:block; text-align:center; font-size:12px; color:#585858; margin-top:8px; height:22px; overflow:hidden; line-height:1.6;}
.zhidemailist_new li .zbname_b i{ color:#e14150;}
.zhidemailist_new li .zbinfo_c{ font-size:14px; color:#e14150; display:block; height:30px; overflow:hidden; text-align:center; font-weight:bold;}
.count_down{ font-size:14px; text-align:center; position: absolute;  color:#fff; position:absolute; top:0px; left:0px; right:0px; bottom:0px; width:100%; background:rgba(0,0,0,.7);}
.count_down_con{ z-index: 1; position:absolute; left:0px; right:0px; top:25%; }
.count_down_con b{ display:block; font-weight:normal; padding:0px 0px 5px 0px;}
.count_down em{ background:#232323; border-radius:3px; display:inline-block; font-size:14px; color:#fadf00; text-align:center; margin:0px 5px; padding:0px 3px; font-weight:bold; font-style:normal;}
.twolink a{ width:49%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#f42f02;}
.twolink a.rightlink{ width:49%; float:right;}
.onelink a{ width:100%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#f42f02;}
.onelink b{ width:100%; float:left; height:30px; line-height:30px; color:#fff; text-align:center; font-size:12px; background:#aaa; font-weight:normal;}
.onelink em{ font-style:normal;}
.zhidemaititlebox{ background: url(http://static.8264.com/static/images/common/zdmtitletongtiao.jpg) top center no-repeat; height: 46px;  width: 100%; padding: 0px 0px 10px 0px;}
.zhidemaititlebox a{ height:46px; display:block;}
</style>

<div class="zhidemaibox zhidemaiwidth">
    <div class="zhidemaititlebox" style="display:none;"><a href="https://8264.tmall.com/search.htm?spm=a220o.1000855.w11360013-15189811505.5.4732a2bdxZPV2E&amp;search=y&amp;orderType=defaultSort" target="_blank"></a></div>
    <div class="zhidemailist_new">
        <ul>

        <?php if(is_array($zhidemai_list)) foreach($zhidemai_list as $k => $item) { ?>            <?php if(!$item['union_url'] && !$item['lq_url'] && !$item['price_jian']) $item['url'] = $item['tg_url']; ?>            <?php if($k <= 5) { ?>
            <li>
                <a href="<?php echo $item['url'];?>" target="_blank">
                    <img src="<?php echo $item['img'];?>">
                    <span class="zbname_b"><?php echo $item['title'];?></span>
                    <span class="zbinfo_c">到手价&yen;<?php echo number_format(($item['discount_price']-$item['price_jian']), 1);; ?></span>
                </a>
                <?php if($item['lq_url']) { ?>
                    <?php if($item['union_url']) { ?>
                    <div class="twolink"><a href="<?php echo $item['union_url'];?>" target="_blank" rel="nofollow" style="width:100%;">领劵<?php echo number_format($item['price_jian']);; ?>元并购买</a></div>
                    <?php } else { ?>
                    <div class="twolink"><a href="<?php echo $item['lq_url'];?>" target="_blank" rel="nofollow">领劵&yen;<?php echo number_format($item['price_jian']);; ?></a><a href="<?php echo $item['tg_url'];?>" class="rightlink" target="_blank" rel="nofollow">去购买</a></div>
                    <?php } ?>
                <?php } else { ?>
                <div class="onelink"><a href="<?php echo $item['tg_url'];?>" target="_blank" rel="nofollow">立即购买</a></div>
                <?php } ?>
                <?php if($item['starttime'] > $_G['timestamp']) { ?>
                <div class="count_down">
                    <div class="count_down_con">
                    <b>距离抢购开始还有</b>
                    <span class="countdown" starttime="<?php echo $_G['timestamp'];?>" endtime="<?php echo $item['starttime'];?>"></span>
                    <div><a href="<?php echo $item['tg_url'];?>" target="_blank" style="padding: 12px 0 0; display: inline-block; color: #f96015; text-align: center; text-shadow: 1px 2px 2px rgba(8, 8, 8, 0.85);letter-spacing: 1px;font-size: 13px;border-bottom: 1px solid #f96015;line-height: 1.3">直接购买</a></div>
                    </div>
                </div>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
        </ul>
    </div>
</div>
<script src="http://static.8264.com/static/js/jquery.countdown.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
//dom加载完执行
jQuery(function($){
    $('.countdown').each(function(i, v) {
        if (!$(this).attr('endtime')){
            return;
        }
        var _this = this;
        var str = '';
        new N.countDown({
            startTime : $(this).attr('starttime') * 1000,
            endTime : $(this).attr('endtime') * 1000,
            callback : function(day, hour, minute, second) {
                str = '<span>' + (day != 0 ? '<em>' + day + '</em>' + "天" : '') + '<em>' + formatNum(hour) + '</em>' + ":" + '<em>' + formatNum(minute) + '</em>' + ":" + '<em>' + formatNum(second) + '</em></span>';

                $(_this).html(str);

                if (day == 0 && hour == 0 && minute == 0 && second == 0) {
                    window.location.reload();
                }
            }
        });
        function formatNum(n) {
            return n < 10 ? '0' + n : n;
        }
    });
});
</script>
        </div>
        <?php } ?>
        <!-- //值得买 -->

        </div>


        <div class="clear_b pt40">
            <!--左侧开始-->
            <div class="l_660" style="overflow: hidden;">
                <!--搜索开始-->
                <div class="searchboxall">
                    <div class="searchcon">
                    <form id="scform" autocomplete="off" action="http://so.8264.com/cse/search" target="_blank">
                        <input type="hidden" name="s" value="9963133823733045431" />
                        <input type="hidden" name="nsid" value="4" />
                        <input type="search" class="searchinput" name="q" placeholder="搜搜你想问的问题">
                        <input type="submit" class="searchbutton" value="搜索">
                    </form>
                    </div>
                </div>
                <!--搜索结束-->
                <div class="category clear_b">
                    <!--
                    <img src="http://image1.8264.com/forum/201601/04/1544204ttyy64d55v3rqv2.jpg">
                    <p>
                        <b>户外运动</b>
                        <span>户外运动有益身心健康，就像运动前的准备活动一样，运动后我们也要注意一些细节，这样才能最大限度的保护我们的身体。</span>
                    </p>
                    -->
                    <div class="bigtitleassortment clear_b" style="display:none;"><h1>
<?php if($lable) { ?>
<?php echo $outputlables[$lable]['name'];?>
<?php } else { ?>
户外
<?php } ?>

</h1><span><?php echo $guanzhuNum;?></span><em>人关注</em></div>
                    <div class="txiconboxlist clear_b"><?php if(is_array($guanzhuImg)) foreach($guanzhuImg as $v) { ?><span class="favtar-img"><?php echo avatar($v, small); ?></span>
<?php } ?>
                        <span class="tps-dott"></span>
                    </div>

                    <div class="assortmentbox clear_b">
                        <div class="assortmentbox-inner line">
                        <div class="assortmentcon">
                            <a href="wenda/" <?php if($lable==0) { ?> class="hover" <?php } ?>>全部</a><?php if(is_array($outputlables)) foreach($outputlables as $k => $v) { ?>  <?php if($v['num'] > 0) { ?>
<a href="wenda/list-0-<?php echo $k;?>-1.html" <?php if($lable==$k) { ?> class="hover"<?php } ?>><?php echo $v['name'];?></a>
  <?php } } ?>
                        </div>
                        </div>
                        <div class="assortmentmore">
                            <span>更多</span>
                        </div>
                        <div class="u-c-more">
                            <span class="more-channel"></span>
                        </div>
                    </div>
                </div>

                <div class="listtitlebig clear_b">
                    <span>所有问题</span>
                    <div class="czright">
                        <a href="wenda/list-0-<?php echo $lable;?>-1.html" <?php if($hot ==0) { ?> class="hover" <?php } ?> >热门</a>
                        <a href="wenda/list-1-<?php echo $lable;?>-1.html" <?php if($hot ==1) { ?> class="hover" <?php } ?> >时间</a>
                    </div>
                </div>

                <!--回答开始列表开始-->
                <div class="answerlistbox">
                    <!--单条情况开始--><?php if(is_array($list)) foreach($list as $key => $listone) { ?>                    <div class="asklist">
                        <div class="al-hd">
                            <a href="wenda/<?php echo $listone['topicid'];?>.html" target='_blank'><?php echo $listone['title'];?></a>
                            <i><?php echo $listone['replynum'];?>回答</i>
                        </div>
<?php if($listone['upreplyid']) { ?>
<div class="answergoodone clear_b">
<span class='answergoodonespan'><?php echo discuz_uc_avatar($listone['textauthorid']); ?></span>
                            <div class="answergoodcon">
                                <div class="answer_author_info clear_b">
                                    <span><?php echo $listone['textauthor'];?></span>
                                </div>
                                <div class="editable_content wap-wordp">
                                    <p><?php echo $listone['textrcontent'];?><a href="wenda/<?php echo $listone['topicid'];?>.html" target='_blank' style="display:inline;">[查看全文]</a></p>
                                </div>
                            </div>
                        </div>
<?php } ?>
                    </div>
<?php } ?>
                    <!--单条情况结束-->
                </div>
                <!--回答开始列表结束-->
                <!--分页开始-->
                <div class="list_pager">
<!--分页开始-->
<?php if($multi) { ?><div class="pg clear_b"><?php echo $multi;?></div><?php } ?>
<!--分页结束-->
                </div>
                <!--分页结束-->
            </div>
            <!--左侧结束-->
            <!--右侧开始-->
            <div class="r_260">
                <!--贡献经验人数-->
                <div class="wyfbbox">
                    <!--<a href="javascript:;" onclick="showtiwen();" class="wytw">提问</a>-->
                    <a href="http://bbs.8264.com/forum-post-action-newthread-fid-12.html" class="wytw">我要提问</a>
                </div>
                <!--贡献经验人数-->
                <div class="wyfbbox">
                    <div class="smallfonttitle">
                        贡献经验人数
                    </div>
                    <div class="numbox peoplenum">
                    </div>
                    <div class="smallfonttitle">
                        关注数
                    </div>
                    <div class="numbox gzsnum">
                    </div>
                </div>
                <!--//贡献经验人数-->
<div class="">
                    <div class="rtitle">贡献排行榜</div>
                    <div class="gxblist">
                        <ul><?php if(is_array($gxuserlist)) foreach($gxuserlist as $gxuser) { ?>                            <li>
                                <a class="tx48">
                                    <!--<img src="http://static.8264.com/common/ico_82x82/huwaidating.jpg" alt="" class="tximg">--><?php echo discuz_uc_avatar($gxuser['authorid']); ?>                                    <span><?php echo $gxuser['author'];?></span>
                                </a>
                            </li>
<?php } ?>
                        </ul>
                    </div>
                </div>

<div class="mt45">
                    <div class="rtitle">等你回答</div>
                    <div class="xgwtbox">
                        <ul>
                            <?php if(is_array($xgtopiclist)) foreach($xgtopiclist as $xgtopic) { ?><li>
                                <a href="wenda/<?php echo $xgtopic['topicid'];?>.html" target='_blank'>
                                    <div class="wds">
                                        <b><?php echo $xgtopic['replynum'];?></b>
                                        问答
                                    </div>
                                    <span><?php echo $xgtopic['title'];?></span>
                                </a>
                            </li>
<?php } ?>
                        </ul>
                    </div>
                </div>

<!--JD广告开始-->
                <!-- common/adv_jd_250 -->                <!--JD广告结束-->
            </div>
            <!--右侧结束-->
        </div>
    </div>
    <!--主体内容结束-->
<br/>

<script src="http://static.8264.com/static/js/jquery.lazyload.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {

//图片延时加载
jQuery(".lazy").lazyload({
effect: "fadeIn",
appear: function() {
}
});

$(".assortmentmore").click( function () {
            if( $(this).hasClass('sqpointer') ){
                $(".assortmentcon").height(80);
                $('span',this).text("更多")
                $(this).removeClass('sqpointer');
            }else{
                $(".assortmentcon").css({ height: "auto" });
                $('span',this).text("收起")
                $(this).addClass('sqpointer');
            }
        });
        $(".u-c-more").click(function() {
            if($(this).hasClass("drop-up")){
                $(this).removeClass("drop-up");
                $(".assortmentbox-inner").removeClass("box").addClass("line");
                $(".assortmentbox").removeClass("open");
            }else{
                $(this).addClass("drop-up");
                $(".assortmentbox-inner").removeClass("line").addClass("box");
                $(".assortmentbox").addClass("open");
            }
        });
        var d = $(".assortmentcon"),
            u = d.find("a.hover");
            d.parent()[0].scrollLeft=u[0].offsetLeft-u.width()/2;

        //贡献经验人数
        var peoplenum = '7932';
        var arr = peoplenum.split("");
        for(var i in arr){
            $(".peoplenum").append("<span>" + arr[i] + "</span>");
        }
        //关注数
        var gzs = '<?php echo $guanzhuNum;?>';
        var arr2 = gzs.split("");
        for(var i in arr2){
            $(".gzsnum").append("<span>" + arr2[i] + "</span>");
        }
});
</script>

<footer class="footer_ask">
    <div class="fbc">
        <a href="http://m.8264.com/bbs">8264论坛</a>
        <a href="http://um0.cn/1mEo9u" class="toApp">在外APP</a>
        <p class="copyRight">Copyright 2013 - 2016  8264.com. All Rights Reserved</p>
    </div>
</footer><?php echo adshow("custom_484"); ?></div>
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