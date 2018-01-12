<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?php if($_G['seokeywords']) { echo htmlspecialchars($_G['seokeywords']); } ?> <?php if(!empty($metakeywords)) { echo htmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php echo htmlspecialchars($_G['seodescription']); ?> <?php if(!empty($metadescription)) { echo htmlspecialchars($metadescription); } ?> Discuz! Board" />
<meta name="generator" content="8264" />
<meta name="author" content="8264.com" />
<meta name="copyright" content="2001-2010" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv=refresh content=1;URL="http://www.8264.com/xuexiao/">
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><title>戈尔特斯TM户外先锋营</title>
<link href="http://static.8264.com/oldcms/moban/zt/goretex/style/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script src="http://static.8264.com/oldcms/moban/zt/goretex/js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/goretex/js/DD_belatedPNG_css.js" type="text/javascript"></script>
<![endif]-->

<script src="http://static.8264.com/oldcms/moban/zt/goretex/js/jquery-1.9.1.min.js" type="text/javascript"></script>



<script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>';</script>
<script src="<?php echo $_G['setting']['jspath'];?>common.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>portal.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script src="<?php echo $_G['setting']['jspath'];?>forum.js?<?php echo VERHASH;?>" type="text/javascript"></script>


<script src="http://static.8264.com/oldcms/moban/zt/goretex/js/jq.js" type="text/javascript"></script>



</head>
<body>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="branner">
<div class="brannercon">
    	<a href="http://www.gore-tex.com.cn/" target="_blank" class="logo1"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/goretex.png"/></a>
        <a href="http://www.8264.com/" target="_blank" class="logo2"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/8264.png"/></a>
        <a href="http://www.8264.com/topic/1449.html" target="_blank" class="logo3"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/logo3.png"/></a>
        <div class="dlzcname">
<?php if($_G['uid']) { ?>
<a target="_blank" href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&uid=<?php echo $_G['uid'];?>"><?php echo $_G['username'];?></a>，&nbsp;&nbsp;&nbsp;&nbsp;
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="myQuit">退出</a>
<?php } else { ?>
<a onclick="showWindow('login', this.href);hideWindow('register');" href="member.php?mod=logging&amp;action=login" target="_blank">登录</a>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="showWindow('register', this.href);hideWindow('login');" href="member.php?mod=register" target="_blank">注册</a>
<?php } ?>
</div>
    </div>
</div>
<div class="navbg mb34">
<div class="navbgcon">
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q1">先锋资讯</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q2" >先锋公开课</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q3">导师视点</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q4">先锋特训营</a>
        <a href="javascript:void(0)">先锋足迹</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q3">先锋百科</a>
    </div>
</div>
<div class="mid">
<div class="left353">
    	<div class="title55"><b>活动图集</b></div>
        <div class="lunbo">
        	<ul class="lunboimg">
            	<li><a href="http://bbs.8264.com/thread-2160015-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_1.jpg"/><span></span></a></li>
                <li><a href="http://bbs.8264.com/thread-2157975-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_2.jpg"/><span></span></a></li>
                <li><a href="http://bbs.8264.com/thread-2157177-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_3.jpg"/><span></span></a></li>
                <li><a href="http://bbs.8264.com/thread-2156634-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_4.jpg"/><span></span></a></li>
                <li><a href="http://bbs.8264.com/thread-2158104-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_5.jpg"/><span></span></a></li>
                <li><a href="http://bbs.8264.com/thread-2045652-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_6.jpg"/><span></span></a></li>
            </ul>
            <div class="lunbodian">
            	<span class="zhong"></span>
<span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <div class="right590">
    	<div class="title55"><b>True Guide户外先锋营介绍</b></div>
        <div class="mid1">
        	<p class="left_p">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;户外先锋营是由戈尔公司、8264及巅峰户外运动学校三方联合组织，旨在通过品牌的力量和广大户外精英的积极推动，帮助户外爱好者提高自我户外技术及户外知识，并通过集体的努力让中国的户外运动文化得到更好的传递和分享。<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;户外先锋是指具备一定户外经验的户外爱好者，只要你热爱户外且渴望提升户外知识与技能即可申请加入户外先锋营。成为户外先锋<a href="http://bbs.8264.com/thread-2142882-1-1.html" target="_blank">更多>></a><a href="http://bbs.8264.com/thread-2142882-1-1.html" target="_blank" class="imgbutton"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_8.jpg"/></a>
</p>
<p class="right_p"><b>成为户外先锋意味着：</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;拥有独一无二的荣誉<br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;获得专业的培训<br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;获得由户外先锋营特别订制的礼品<br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;获得与导师携手出行的机会<br>
<b>申请步骤：</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;一）<a href="http://xianlu.8264.com/fillsurvey.php?sid=162" target="_blank">[填写申请表]</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;二）<a href="http://u.8264.com/home-medal.html" target="_blank">[申请先锋勋章]</a>
<a href="http://bbs.8264.com/thread-1917397-1-1.html" target="_blank" class="imgbutton_22"></a>
</p>
        </div>
    </div>
</div>
<div class="mid">
<div class="left353">
    	<div class="title55"><b><a name="q1"></a>先锋资讯</b></div>
        <div class="xfzx">

<h4>蔡石入驻户外先锋营 户外摄影培训招募中</h4>
            <p>户外先锋营重磅推出户外先锋营特邀导师蔡石做为期一天的专业培训，让你与名导同行，接受牛咖的指导。只需上传你的户外摄影作品，说出你最想解决摄影当中遇到的问题，即可获得参与讲座培训的机会，蔡石导师现场为你答疑解惑，与诸位高手PK、切磋摄影技巧。<a href="http://bbs.8264.com/thread-2156776-1-1.html" target="_blank">更多>></a></p>


<h4>户外先锋英雄帖之先锋营特训哈尔滨之约</h4>
            <p>高温起，暑期到，这个夏天驴友们打算怎么过？路过、走过，还是一笑而过？如果你还只有这些选择，那你就out了。玩户外，要的就是刺激和心跳。 当然，前提是你有足够的实力，何谓实力？技能加经验才是王道。现在机会来了，你可别错过。怎么参加？附耳过来，悄悄告诉你：首先，晒出你最心爱装备的靓照；其次，写下你和它的动人故事。然后就没有然后啦。<a href="http://bbs.8264.com/thread-2148816-1-1.html" target="_blank">更多>></a></p>		


<h4>巅峰来袭 首站（北京站）先锋培训盛况收录</h4>
            <p>感谢大家的积极申请与关注，从这次招募能看出大家对先锋营活动的热情，没有申请上的请不要灰心，后期我们还会推出更多覆盖全国各地的具有地方特色的先锋特训活动。希望大家继续关注。祝大家在本次培训活动收获多多..... 培训归来欢迎大家分享自己的培训经历或感受！到时本次参与活动先锋币奖励发放给大家。<a href="http://bbs.8264.com/thread-2143112-1-1.html" target="_blank">更多>></a></p>			
</div>
    </div>
    <div class="right590">
    	<div class="title55">
            <b><a name="q2"></a>先锋公开课</b>
            <a href="http://bbs.8264.com/thread-2141844-1-1.html" target="_blank" class="qione">本期</a>			
            <a href="http://bbs.8264.com/thread-1921944-1-1.html" target="_blank" class="qi">第一期</a>
            <a href="http://bbs.8264.com/thread-1935707-1-1.html" target="_blank" class="qi">第二期</a>
            <a href="http://bbs.8264.com/thread-1940705-1-1.html" target="_blank" class="qi">第三期</a>
            <a href="http://bbs.8264.com/thread-1956918-1-1.html" target="_blank" class="qi">第四期</a>
        </div>
        <div class="mid2">
        	<a href="http://bbs.8264.com/thread-2141844-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/text_14_5.jpg"/></a>
        </div>
        <?php showcomment(29); ?>    </div>
</div>

<div class="mid">
<div class="title55"><a name="q3"></a><b>导师视点</b><span class="moreright"><a href="http://bbs.8264.com/forum-forumdisplay-fid-489-page-1.html" target="_blank" class="more">更多</a></span></div>
    <div class="dssd">
    	<div class="dssd_l">
        	<a href="http://bbs.8264.com/thread-2130221-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_7.jpg"/></a>
            <div class="dslistnews">
            <a href="http://bbs.8264.com/thread-1927295-1-1.html" target="_blank" class="c_c44608">成功的户外活动设计应该具备哪些要素？</a>
            <a href="http://bbs.8264.com/thread-1925849-1-1.html" target="_blank" class="c_008e93">关于户外运动安全的探讨</a>
            <a href="http://bbs.8264.com/thread-1921944-1-1.html" target="_blank" class="c_30b1b9">装备话题之——浅谈冲锋衣的选择</a>
            <a href="http://bbs.8264.com/thread-1944606-1-1.html" target="_blank" class="c_936e00">如何挑选更具性价比的户外装备</a>
            </div>
        </div>
        <div class="dssd_r">
        	<div class="dssd_r_t">
                <h5><span>领队的户外风险意识</span><em>绝情坑坑主</em></h5>
                <p>
"探险不是冒险，作为户外活动爱好者，一定以保障自身安全为前提，在享受郊野健身、探险、刺激、快乐的同时，还要顾及家人的担忧，也要考虑到社会救援力量的艰辛付出。
<a href="http://bbs.8264.com/thread-2158324-1-1.html" target="_blank">更多>></a></p>
</div><?php showcomment(27); ?>        </div>
    </div>
</div>


<div class="mid">
<div class="title55"><a name="q4"></a><b>先锋特训营</b><span class="moreright"><a href="http://bbs.8264.com/forum-forumdisplay-fid-489-typeid-1552-filter-typeid.html" target="_blank" class="more">更多</a></span></div>
<a href="http://bbs.8264.com/thread-2156776-1-1.html" target="_blank" style=" margin-top:30px; display:block;"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_9.jpg"/></a>
  <div class="dssd">
    	<div class="dssd_l">
<div class="img352warpten">
<div class="img352big">
<ul>
<li><a href="http://bbs.8264.com/thread-1974014-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/l1.jpg"></a></li>
<li style="display:none"><a href="http://bbs.8264.com/thread-2143112-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_10.jpg"></a></li>
<li style="display:none"><a href="http://bbs.8264.com/thread-2148816-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_11.jpg"></a></li>
<li style="display:none"><a href="http://bbs.8264.com/thread-2156776-3-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_12.jpg"></a></li>
<li style="display:none"><a href="javascript:void(0)" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_13.jpg"></a></li>
</ul>
</div>
<div class="qidate">
<span class="zhong">第一期</span>
<span>第二期</span>
<span>第三期</span>
<span>第四期</span>
<span class="fr">第五期</span>
</div>
</div>
        </div>
        <div class="dssd_r">
        	<div class="dssd_r_t">
                <h5><span>先锋营英雄帖之先锋（北京站）培训招募</span></h5>
                <p>培训地点：北京怀柔圣水泉度假村&nbsp;&nbsp;培训内容：D1 ：出行装备的选择与应用。D2： 户外技能培训及实操
<a href="http://bbs.8264.com/thread-2143112-1-1.html" target="_blank">更多>></a></p>
</div><?php showcomment(30); ?>        </div>
    </div>
</div>


<div class="mid">
<div class="title55"><b>导师风采</b><span class="moreright"><a href="javascript:void(0)" target="_blank" class="more">更多</a></span></div>
    <div class="mid" style="padding-top:25px;">
<div class="l_arrow_y" id="leftbutton"></div>
<div class="imgrenwulist">
<ul>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi7.jpg">
<span>
<b>老尹</b>
<em>8264超级版主、擅长领域：户外装备</em>
</span>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi1.jpg">
<span>
<b>沈阳-海纳百川</b>
<em>沈阳登山协会首任秘书长、沈阳越玩越野俱乐部总经理、领队</em>
</span>
</li>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi2.jpg">
<span>
<b>挥剑决浮云</b>
<em>8264辽宁版主，拥有丰富的户外经验</em>
</span>
</li>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi3.jpg">
<span>
<b>绝情坑坑主</b>
<em>8264北京版主、山海精户外运动俱乐部创始人</em>
</span>
</li>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi4.jpg">
<span>
<b>野战军</b>
<em>户外网站联盟户外装备版任版主，省级摄影家协会会员</em>
</span>
</li>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi5.jpg">
<span>
<b>老李背包</b>
<em>户外联盟装备版主、户外梦想实现活动导师。擅长领域：户外装备、长线</em>
</span>
</li>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi6.jpg">
<span>
<b>老橡皮</b>
<em>8264黑龙江版主、擅长领域：登山</em>
</span>
</li>
</li>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/8.jpg">
<span>
<b>悬崖</b>
<em>三夫户外俱乐部负责人、擅长领域：徒步、穿越、登山、装备</em>
</span>
</li>
</ul>
</div>
<div class="r_arrow_g" id="rightbutton"></div>
</div>
</div>
<div class="mid">
<div class="title55"><b>特邀导师</b></div>
    <div class=" mid daoshicon" style=" margin-top:25px;">
<div class="daoshibig">
<ul>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/b1.jpg"/></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/b2.jpg"/></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/b3.jpg"/></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/b4.jpg"/></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/b5.jpg"/></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/b6.jpg"/></li>
</ul>
</div>
<div class="daoshismall">
<ul>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/s1.jpg"/><span style="display:none;"></span></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/s2.jpg"/><span></span></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/s3.jpg"/><span></span></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/s4.jpg"/><span></span></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/s5.jpg"/><span></span></li>
<li><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/s6.jpg"/><span></span></li>
</ul>
</div>
</div>
</div>
<div class="mid" style="display:none;">
<div class="title55"><b><a name="q3"></a>先锋百科</b></div>
    <div class="xfbk">
    	<ul>
        	<li><a href="http://bbs.8264.com/thread-1921944-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/40_1.jpg" /><span>浅谈冲锋衣的选择;如何选择冲锋衣？什么样的冲锋衣才是最好的？</span></a></li>
<li><a href="http://bbs.8264.com/thread-1935707-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/41_1.jpg" /><span>冬季户外活动中装备的重要性及选择要点；户外服装穿着方式一直有三层穿着之说</span></a></li>
            <li><a href="http://bbs.8264.com/thread-1940705-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/42_1.jpg" /><span>如何发现和培养身边户外爱好者成为一名合格的户外领队"</span></a></li>
            <li><a href="http://bbs.8264.com/thread-1956918-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/43_1.jpg" /><span>合作性大型户外活动的组织与实施若干问题的分析与探讨 </span></a></li>
            <li><a href="http://bbs.8264.com/thread-1966863-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/44_1.jpg" /><span>户外活动早已被认知并执行中的重要法则：环境最小冲击法则即ＬＮＴ法则</span></a></li>
            <li><a href="http://bbs.8264.com/thread-1997209-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/45_1.jpg" /><span>户外装备知识分享：服装、鞋、帐篷、炉具、登山杖；装备使用原则</span></a></li>
            <li><a href="http://bbs.8264.com/thread-2038425-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/46_1.jpg" /><span>千里之行始于足下，军哥今天的话题就和大家聊聊最基础的户外装备----户外鞋</span></a></li>
            <li><a href="http://bbs.8264.com/thread-2063557-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/47_1.jpg" /><span>春季到了，万物复苏，是大家踏青的好季节，但很多问题也随之而来；比如：蜱虫</span></a></li>
        </ul>
    </div>
</div>
<div class="logomid">
<a href="http://www.gore-tex.com.cn/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/logo1.jpg"/></a>
    <a href="http://www.8264.com/" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/logo2.jpg"/></a>
    <a href="http://www.8264.com/topic/1449.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/logo3.jpg"/></a>
</div>

<div class="footer">
<div class="footercon">
<p class="footer_l">8264 版权所有 津ICP备05004140号-10 ICP证 津B2-20110106<br>
<a href="http://bx.8264.com" target="_blank">户外有风险，8264提醒您购买户外保险</a></p>
<p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264简介</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">联系我们</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">广告服务</a> | <a target="_blank" href="http://www.8264.com/link/">户外网址大全</a> | <a target="_blank" href="http://www.8264.com/sitemap">网站地图</a></p>
<div class="clear"></div>
</div>
</div><?php output(); ?></body>
</html>