<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<title>2013Vibram香港百公里越野跑</title>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<meta charset="gb2312">
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2013_vibram/css/colorbox.css"/>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2013_vibram/css/paginat.css"/>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/oldcms/moban/zt/2013_vibram/css/vtt.css"/>
<link rel="icon" href="img/favicon.ico" />
<script src="http://static.8264.com/oldcms/moban/zt/2013_vibram/js/jquery.min.js" type="text/javascript" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2013_vibram/js/jquery.colorbox.js" type="text/javascript" type="text/javascript"></script>
<script src="http://static.8264.com/oldcms/moban/zt/2013_vibram/js/jquery.innerfade.js" type="text/javascript" type="text/javascript" charset='utf-8'></script>
<script src="http://static.8264.com/oldcms/moban/zt/2013_vibram/js/jquery.paginate.js" type="text/javascript" type="text/javascript"></script>
<script src="http://v3.jiathis.com/code_mini/jia.js?uid=1348468258232839" type="text/javascript" charset='utf-8'></script>
<script language="javascript" type="text/javascript">
function goToByScroll(id) {
$('html,body').animate({
scrollTop: $("#" + id).offset().top
}, 500);
}
function mostra_archivio() {
if ($("#album_foto").is(":hidden")) {
$("#album_foto").slideDown("fast");
} else {
$("#album_foto").slideUp("fast");
}

}
$(function () {
//apro sempre la prima!
$("#album_foto").hide();
$('.accordionButton').click(function () {
//REMOVE THE ON CLASS FROM ALL BUTTONS
attua = $(this).attr('id')
$('.accordionButton').removeClass('acco_on');
//NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
$('.accordionContent').slideUp('normal');
//IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
if ($(this).next().is(':hidden') == true) {
//ADD THE ON CLASS TO THE BUTTON
$(this).addClass('acco_on');
//OPEN THE SLIDE
$(this).next().slideDown('normal', function () { goToByScroll(attua) });
}
});
//ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
$('.accordionButton').mouseover(function () {
$(this).addClass('acco_over');
//ON MOUSEOUT REMOVE THE OVER CLASS
}).mouseout(function () {
$(this).removeClass('acco_over');
});
$('.accordionContent').hide();
$('#gallery_1').innerfade({ speed: 'slow', timeout: 3500, type: 'sequence', containerheight: '175px' });
$('#gallery_2').innerfade({ speed: 'slow', timeout: 4000, type: 'sequence', containerheight: '175px' });
$('#box1').innerfade({ speed: 'slow', timeout: 4000, type: 'sequence', containerheight: '213px', containerwidth: '214px' });
$('#box2').innerfade({ speed: 'slow', timeout: 4000, type: 'sequence', containerheight: '213px', containerwidth: '214px' });
$('#box3').innerfade({ speed: 'slow', timeout: 4000, type: 'sequence', containerheight: '213px', containerwidth: '214px' });
$("a[rel='galleria']").colorbox();
$("a[rel='gara']").colorbox();
$(".box_colorbox").colorbox({ width: "850", height: "550", iframe: true });
$('#contenitore_di_facts_e_news').pajinate({
num_page_links_to_display: 10,
items_per_page: 10,
nav_label_first: '&lsaquo;&lsaquo;',
nav_label_last: '&rsaquo;&rsaquo;',
nav_label_prev: '&lsaquo;',
nav_label_next: '&rsaquo;',
show_first_last: false
});
$('#contenitore_di_product').pajinate({
num_page_links_to_display: 10,
items_per_page: 10,
nav_label_first: '&lsaquo;&lsaquo;',
nav_label_last: '&rsaquo;&rsaquo;',
nav_label_prev: '&lsaquo;',
nav_label_next: '&rsaquo;',
show_first_last: false
});
});
</script>
<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-4041592-2']);
_gaq.push(['_trackPageview']);

(function () {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>
</head>

<body style="background:url(http://static.8264.com/oldcms/moban/zt/2013_vibram/img/sfondo_trailrunning.jpg) no-repeat #010204;background-size: 1900px 1300px;">
<div id="fb-root"></div>
<div class="alto">
<div class="logo"> <img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logo.png" /> </div>
</div>
<div class="youtube"><a href="http://www.youku.com/playlist_show/id_18353966.html" target="_blank"> 
<script type="text/javascript">
                var lan=1;
                if(lan=="1")
    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/you_tube_channel.png' width='216' height='49' border='0' border='0' />");
                if(lan=="2")
                    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/you_tube_channel-1.png' width='216' height='49' border='0' border='0' />");
                </script> 
</a></div>
<div class="box_alto">
<ul id="box1" class="box_1">
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot-left1.png' rel='gara' title='点击查更多'>
<div><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot1-.png" /></div>
</a></li>
</ul>
<ul id="box2" class="box_2">
<li style='background:url() no-repeat 0px 21px;'><a href='http://v.youku.com/v_show/id_XNTA4Mjk5NDI4.html' style='text-decoration:none' target='_blank'>
<div><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot21.png" /></div>
</a></li>
</ul>
<ul id="box3" class="box_3">
<li style='background:url() no-repeat 0px 21px;'><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot-right.png' rel='gara' title='点击查看2013Vibram HK100精彩图片 20/20'>
<div><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot3-.png" /></div>
</a></li>
</ul>
<div style="clear:both"></div>
</div>
<div class="titolino_giallo"> 
<script type="text/javascript">
                var lan=1;
                if(lan=="1")
    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/fact_news.png' width='131' height='27'/>");
                if(lan=="2")
                    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/fact_news-1.png' width='131' height='27'/>");
</script>
</div>
<div id="contenitore_di_facts_e_news">
<ul style="margin:0px; padding:0px; list-style:none" id="fact_elenco" class="content">
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>VFF首款极简越野跑五指鞋Spyridon首秀香港100
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-1.jpg" /> </p>
<p> Minimalist极简主义是指一种生活方式、着装风格或设计风格，感官上简约整洁，品味和思想上更为优雅。作为一种生活方式或时装风格，极简主义以回归本真和回归自然作为口号。2013年1月19日， Vibram FiveFingers首款极简越野跑五指鞋Spyridon亮相Vibram香港100公里超级越野跑，热爱极简主义跑步方式的跑友再次以他们的脚步践行着善行无辙迹的理念。

<br />
<br />
善行无辙迹出现在畅销跑步书《天生就会跑》的开篇题记，出自老子《道德经》的名言。含义是，善于奔跑的人不会留下很深的痕迹，他们轻快的脚步像羚羊一样轻盈。这也是跑步者的极致追求。

 <br />
<br />
  《天生就会跑》成为人们了解和发现极简主义的一个通道，从这条通道进去，我们发现了人类奔跑的演变和运动鞋的演化历史，更为重要的是人类被遗忘的赤足运动历史。这本书的畅销有意无意之中带动了一个运动鞋的新浪潮的到来--极简/简约式跑鞋的发展，核心主题都是去除繁琐的减震系统，提倡改善跑姿，使用自己身体的力量来轻快的奔跑。这就是极简主义和简约式跑鞋的发展背景。

</p>
                <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-2.jpg" /> </p>
                        <p>2009年可谓极简主义跑鞋的发展元年，当时仅有包括VIBRAM?在内的10个品牌提供很少的产品型号，到2012年已经有32个品牌推出极简主义系列跑鞋产品，涉及的产品型号超过100个以上。特别是极简越野跑鞋领域将是未来巨大的趋势，根据2012北美极简主义系列跑鞋产品的跟踪销售显示：2012年，极简越野跑鞋在户外专业店增长达108％，在体育用品连锁店增长达208％，在跑步专业店增长达50％。

<br/>
                        <br/>
                        2013年1月19日， Vibram FiveFingers首款极简越野跑五指鞋Spyridon亮相Vibram香港100公里超级越野跑，Vibram Fivefingers Spyridon和Spyridon LS是Vibram首款极简越野跑五指鞋，不仅带来极好的平衡&quot;脚感&quot;，还在崎岖路面提供保护。鞋面采用椰壳制成的弹性网布与抗磨损弹性聚酰胺（尼龙）织物，比VFF其它款鞋面更耐磨，强度更大，保护你的双脚免受泥土和岩屑侵蚀。 <br/>
                      </p>
                        Vibram Fivefingers Spyridon和Spyridon LS.

<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-3.jpg" /> </p>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-4.jpg" /> </p>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-5.jpg" /> </p>
<p>
                        Spyridon采用3.5毫米极简Vibram橡胶大底，矩形分段切割设计让双脚更灵活；采用最新的VIBRAM 3D COCOON技术，在模塑尼龙网底增加一个类似&quot;岩石块&quot;，在减轻重量的同时，更能防止在岩石路面上刺穿鞋底，分散鞋底压力。Spyridon提供360度可靠的抓地力，全方位的牢固抓地力保护脚部免受石头和砂砾的冲击。Spyridon在设计研发阶段在Vibram中国技术研发中心进行了长达一年以上的产品性能测试，其中包括实验室和跑道测试，可谓品牌多年研发的成果。Vibram FiveFingers?非凡的技术潜能得到了激发，证明了其在这一鞋靴创新领域的实力，堪称安全、性能与品质的绝对代言。 <br/>
                        <br/>
                        Spyridon弥补了KSO Trek的不足。虽然鞋底厚度同样为3.5毫米，在不牺牲简约性的前提下，它的舒适性和抓地力更强，经过100公里各类复杂路面的考验，赤足跑者可能很难找到Spyridon无法处理的越野路面。自然透气的鞋帮上的钩孔锁紧装置可以随意调节松紧度，使鞋子稳贴舒适。Spyridon穿上会感到就像手套包裹性强而紧凑，虽然比KSO Trek稍重，但与越野跑鞋相比仍轻便很多。

</p>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-6.jpg" /> </p>
                       <p>Vibram FiveFingers Spyridon，为越野跑而生。</p>
  </div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>VIBRAM非凡之队际会香江 彰显越野跑极限探险本色
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang4-1.jpg" /> </p>
<p>Vibram是全球首屈一指的高性能橡胶鞋底制造商，自成立70多年以来，持续为各大国际户外及运动品牌提供专业性能运动鞋底。Vibram推崇户外探险的精神和挑战极限性能的价值观，并于近年来加强积极参与越野跑运动。 <br />
<br />
从2007年开始，Vibram参与和赞助世界规模最大和最具影响力的环博朗峰超级越野跑（UTMB），Vibram测试团队越野跑运动员马可欧默(Marco Olmo) 以58岁高龄连夺2006年/2007年两届UTMB冠军更成为UTMB历史上的经典故事。

 <br />
<br />
  从2010年开始，Vibram组队参加UTMB，并与采用Vibram越野跑鞋鞋底的HI-TEC、SAUCONY、LAFUMA和NEW BALANCE等品牌合作，为Vibram UTMB团队提供高性能的越野跑鞋，并为选手提供强大的后勤保障和支持。Vibram希望通过赞助UTMB，加大对越野跑运动的推动。Vibram UTMB非凡之队成员并非顶级跑步好手，但他们来自不同语言及文化背景，正好体验了本次赛事主题：平凡人物出征非凡赛事，以及Vibram不断突破的精神！

</p>
                <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang4-2.jpg" /> </p>
                        <p>2012年，Vibram UTMB非凡之队在Lavaredo超级越野跑、环博朗峰超级越野跑和TDG巨人之路等重量级赛事中取得优异成绩--Francesca Canepa获得Lavaredo超级越野跑女子冠军、UTMB女子亚军和TDG巨人之路女子冠军，Ronan Moalic获得UTMB组男子第20名。Francesca Canepa是一名翻译，同时也是2位孩子的母亲。她偶然结识越野跑，加入Vibram UTMB非凡之队，迅速热爱上了越野跑运动，并表现出极高的天赋。Francesca Canepa获得UTMB女子亚军也是Vibram持续推广越野跑运动结出丰硕成果的最好证明。

<br/>
                        <br/>
                        2013 Vibram香港100公里超级越野跑是Vibram UTMB非凡之队和Vibram HK100非凡之队两支队伍首次在同一赛事中竞技，专门从意大利前来的Vibram意大利鞋类产品市场总监Jerome Bernard也亲自参赛跑完半程赛事，他对此次的经历印象深刻并深受启发：Vibram支持平凡人突破个人极限，获得非凡成就。没有任何事情比看到参赛跑手们冲过Vibram香港100的终点线更非凡的了。扶轮公园的气氛，我看到的友谊，跑手之间的互相支持和鼓励都令我印象深刻。

<br/>
                        <br/>
                        代表Vibram UTMB非凡之队首次来港出赛的Nicola Bassi对自己的成绩感到满意，全程用时11时40分42秒排在第九名。他表示，这是我第一次来香港比赛，我希望能够以进入前20名，现在获得第9已经超出预期。我一开跑就很用力并希望紧随领先者，香港的比赛和欧洲的比赛，很不同的是有许多的台阶要爬，特别是山路段感到非常吃力，最后能保住第9名我感到非常开心。

<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang4-3.jpg" /><br/>
                    Bassi的队友、来自法国的Sebastien Nain以12时30分43秒跑完全程。 <br/>
                    <br/>
                    Vibram HK100非凡之队香港代表本地跑手曾进杰，以13时12分的出色成绩完成比赛，第31名完成赛事；居住在香港的Joel LaBelle以17小时7分到达终点；来自内地的覃俊平以18时18分冲过终点；Vibram HK100非凡之队派出两名女跑手参加今次比赛。今年再次参赛的曲丽杰跑出23小时32分55秒的成绩。Linds Russell在赛事开始不久因伤退出比赛。

<br/>
                    <br/>
                    2013 Vibram香港100公里超级越野跑赛事，Vibram非凡之队的队员们以他们对超级越野跑运动的热情和经验，与众多越野跑爱好者分享，使更多人开始热爱并加入越野跑运动，收获挑战自我，体验自然的乐趣。<br />
            <br/>
 
                        
 </p>
    </p>
  </div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>第叁届「Vibram 香港100」赛事 中国跑者运艷桥和曾小强称霸
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
  <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-1.jpg" /> </p>
<p> 【2013年1月20日: 香港】中国跑手运艷桥以10小时16分6秒的成绩获得2013年「Vibram香港100」赛事冠军。过去两届受伤患困扰未能参赛的香港本地长跑名将曾小强，今日表现出色，紧随其后夺得亚军。

<br />
<br />
在第二名的争夺中，曾小强在最后时刻赶超尼泊尔跑手Ram Kumar Khatri，并以10小时19分43秒的成绩获得亚军，仅比第叁名的Ram Kumar Khatri快16秒。

 <br />
<br />
  运艷桥对赢得赛事感到兴奋：「我很开心能赢，特别是上一次我发挥得不是很好。今年的赛事有很多优秀的跑者参赛，尼泊尔的选手们一开赛就领先，我不确定自己是否有机会可以获胜。但当我到达检查站5的时候，发现Aite 和Ram也差不多速度，我知道自己还有机会。当我跑过城门水塘的时候感觉非常好，并一直保持到终点。」

</p>
                <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-2.jpg" /> </p>
                        <p>在前半程一直领先的Aite Tamang后半程受到抽痉困扰，在Andrew Tuckey和Jeremy Ritcey之后，最后以第六名完成比赛。代表Vibram非凡之队首次来港出赛的Nicola Bassi是代表冠名赞助商Vibram所有跑手中第一个到达终点的，全程用时11时40分42秒，排在第九名。Bassi在UTMB的队友、来自法国的Sebastien Nain以12时30分43秒跑完全程。

<br/>
                        <br/>
                        由意大利来港参赛的Bassi对自己的成绩感到满意：「这是我第一次来香港比赛，我希望能够以进入前20名，现在获得第9已经超出预期。我一开跑就很用力并希望紧随领先者，到最后，特别是山路段，我感到非常吃力，最后能保住第9名我感到非常开心。」

<br/>
                        <br/>
                        Vibram非凡之队本地代表也以出色的成绩完成比赛，本地跑手曾进杰，别名「鹰」，以13时12分39秒，第31名完成赛事。居住在香港的Joel LaBelle, 又称「 Jogger Joel 」在20日凌晨1时后到达扶轮公园。来自内地的覃俊平, 别名 「King Jump」，以18时18分39秒，在Joel之后75分鐘衝过终点。

<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-3.jpg" /> </p>
<br/>
                        <br/>
                        女子组赛事方面，居於香港的英国籍跑者Claire Price以全程领先的姿态赢得比赛，并以11时58分4秒的成绩打破女子组纪录。在去年以微弱差距屈居亚军的Price对此次获胜特别满意：「我非常开心！我有一点伤在身，直到几天前才确认参赛。我没有太大期待，但一开跑我就感觉良好，山路也不错，最后顺利赢得比赛。」 <br/>
                        <br/>
                        Vibram非凡之队亦派出两名女跑手参加今次比赛。今年再次参赛的曲丽杰跑出23小时32分55秒的成绩。Linds Russell在赛事开始不久因伤退出比赛。

<br/>
                        <br/>
                        当被问及与去年获得第二时的不同之处，Price回应指：「我觉得今年的策略更加好，Vibram香港100的后半程有很多山路，去年我在开始有些太过用力，所以最后比较吃力。今年我整个体能分配很好。」
<br/>
                        <br/>
                        Vibram(意大利)市场及传讯总监Jerome Bernard今次跑完半程赛事，他对此次的经歷印象深刻并深受启发：「Vibram支持平凡人突破个人极限，获得非凡成就。没有任何事情比看到参赛跑手们衝过『Vibram香港100』的终点线更非凡的了。扶轮公园的气氛，我看到的友谊，跑手之间的互相支持和鼓励都令我印象深刻。」

<br/>
                        <br/>
                        2013年「Vibram 香港100」共有来自30个国家和地区的1225名跑手参赛，其中217名為女性。全部跑者中，有666名居住在香港和245名来自中国内地，其他参赛选手来自澳洲、比利时、加拿大、芬兰、法国、德国、斯洛伐克、西班牙、瑞士、瑞典、中东、英国、美国等。 <br/>
                        <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-4.jpg" /> </p>
                        
                        <br/>
                        关於Vibram

<br/>
                        <br/>
                        Vibram是高性能橡胶鞋底的全球领导品牌，业务涵盖户外运动、工作、休閒、时尚、维修和矫形等鞋类市场。70多年来，黄色八角形的标誌已经是质量、性能、安全、创新的代表。每个Vibram的鞋底都在提高安全和保护的期 许下诞生；是持续致力於研发与创新的成果。事实亦证明了在无数的极度探险中，Vibram成為不可或缺的一部份。同时亦将革新的设计注入时尚鞋款中。每款Vibram的新產品都使用最新设计及最好的原料，针对个别用途製作。再由Vibram 测试团队在实验室以及试验场执行各种严格测试后推出市场。确保达至最佳性能，最高质量以及最舒适。

 <br/>
                        <br>
                        
 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>2013 Vibram香港100冠軍誕生
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
      <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang2yun.jpg" /> </p>
      <p>国跑手运艷桥获得2013年Vibram香港100男子组冠军</p>
<p>中国跑手运艷桥以10小时16分6秒的成绩获得2013年Vibram香港100赛事冠军。过去两届受伤患困扰未能参赛的香港本地长跑名将曾小强，今日表现出色，紧随其后夺得亚军。 <br />
<br />
女子组赛事，居於香港的英国籍跑手Claire Price今日一路领跑，最终以破记录的11小时58分4秒夺得第一。</p>
                      
   <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang2-2.jpg" /></p>
               <p>香港本地长跑名将曾小强获得2013年Vibram香港100男子组亚军</p>
               <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang2-3.jpg" /></p>
               <p>2013年Vibram香港100女子组冠军由Claire Price获得</p>
               <p>关於Vibram<br>
               <br>Vibram是高性能橡胶鞋底的全球领导品牌，业务涵盖户外运动、工作、休閒、时尚、维修和矫形等鞋类市场。70多年来，黄色八角形的标誌已经是质量、性能、安全、创新的代表。每个Vibram的鞋底都在提高安全和保护的期 许下诞生；是持续致力於研发与创新的成果。事实亦证明了在无数的极度探险中，Vibram成為不可或缺的一部份。同时亦将革新的设计注入时尚鞋款中。
每款Vibram的新產品都使用最新设计及最好的原料，针对个别用途製作。再由Vibram 测试团队在实验室以及试验场执行各种严格测试后推出市场。确保达至最佳性能，最高质量以及最舒适。
<br>
               
                
                
  </div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>2013年Vibram香港100今早八時開跑
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang3-1.jpg" /> </p>
                    <p>2013年Vibram香港100今早八时开跑</p>
<p> 香港本土个人100公里跑赛事「Vibram 香港100」，已於今日上午8时在北潭涌开跑。今年有来自30个国家和地区的超过1300名长跑选手报名参赛，赛事全程将途经过多个风景区，包括杳无人烟、水清沙幼的海滩、古木树林、自然远足径、水塘和陡险山径等。</p>
                  <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang3-2.jpg" /> </p>
                  <p>30个国家和地区的超过1300名长跑选手参加今届比赛</p>
                  <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang3-3.jpg" /> </p>
                  <p>Vibram UTMB队员-意大行的Nicola Bassi（左）、法国的Sebastien Nain（右）与Vibram(意大利)市场及传讯总监Jerome Bernard一同参加2013年Vibram香港100赛事</p>
                  <p>关於Vibram</p>
                  <p>Vibram是高性能橡胶鞋底的全球领导品牌，业务涵盖户外运动、工作、休閒、时尚、维修和矫形等鞋类市场。70多年来，黄色八角形的标誌已经是质量、性能、安全、创新的代表。每个Vibram的鞋底都在提高安全和保护的期 许下诞生；是持续致力於研发与创新的成果。事实亦证明了在无数的极度探险中，Vibram成為不可或缺的一部份。同时亦将革新的设计注入时尚鞋款中。每款Vibram的新產品都使用最新设计及最好的原料，针对个别用途製作。再由Vibram 测试团队在实验室以及试验场执行各种严格测试后推出市场。确保达至最佳性能，最高质量以及最舒适。</p>
                  
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>追根溯源 关于赤足跑和极简主义跑鞋的种种
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/paoxie.jpg" /> </p>
<p> 畅销跑步书《BORN TO RUN》中，开篇题记引用老子《道德经》的名言——善行无辙迹。善于奔跑的人不会留下很深的痕迹，他们轻快的脚步像羚羊一样轻盈。这也是跑步者的极致追求。

<br />
<br />
2003年，作者为了明星小绯闻被纽约时报杂志派遣出差至美墨边境，注意到墨西哥边境名为Tarahumara原住民的小记事，这一族人没有现代社会的贪污、肥胖、药物中毒、毒品泛滥、家庭暴力、儿童虐待、心脏病高血压等社会、医学问题，当然更没有二氧化碳排出的环境议题。更有趣的是这一族人55岁的人可以跑得比十几岁的快，八十岁的老先生随时可以翻爬一个马拉松距离的山路。族里面的祭典，村对村对抗，就是喝酒到天亮，然后开始赛跑，这个赛跑不是跑2英里，也不是跑2小时，而是跑2个整天 ! 而这一族人所生存的环境，可不是加州平原或非洲大草原，而是高峰连绵，称之为铜峡谷的险恶地形。接下来作者对于Tarahumara一族产生强烈的好奇与兴趣，他们的生活哲学，饮食方式，超人体能，都是人类史上的大谜团。而他们所生存的铜峡谷，不是想进去就可以进入的，除了地型严峻，美墨边境的毒枭横行外，Tarahumara 族人也是很害羞的种族，他们不想让你看到时，你就算经过他们村子，你也不知道你正处于他们之间，他们就是如此神秘。

 <br />
<br />
《BORN TO RUN》成为人们了解和发现赤足运动的一个通道，从这条通道进去，我们发现了人类奔跑的演变和运动鞋的演化历史，更为重要的是人类被遗忘的赤足运动历史。这本书的畅销，有意无意之中带动了一个运动鞋的新浪潮的到来——极简/简约式跑鞋的发展，不论是VFF五趾鞋，还是耐克的FREE系列，抑或是ECCO的BIOM，核心主题都是去除繁琐的减震系统，提倡改善跑姿，使用自己身体的力量来轻快的奔跑。

</p>
                        <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/paoxie2.jpg" /> </p>
                        <p>这就是赤足跑运动和简约式跑鞋的发展背景。

<br/>
                        <br/>
                        MERRELL（迈乐）Run--赤足跑鞋就是在这样的背景下发展起来的，而且成为一个非常受欢迎的赤足运动系列产品。本次测试，我测试的就是其主打型号Merrell Trail Glove。

<br/>
                        <br/>
                        关于赤足跑步Barefoot Run和赤足原理

<br/>
                        <br/>
                        赤足跑步的好处一直都得到科学研究结果的支持。赤足跑提倡更多使用身体来运动，用前脚掌落地，脚触地的位置直接在跑步者重心下方，从而保持更平衡、更稳定、更少冲击和更大的推动力。较薄的鞋底跑步时的感官反馈改善灵活性和平衡性，可以随时调整跑姿。另外，还能刺激和强化脚部和小腿的肌肉。让双脚顺着本能的走、跑、跳、动是赤足运动的设计概念。以超轻量、极简洁的设计让双脚通过更直接地接触地面、更直觉地传导灵敏性和速度感，同时达到强化训练腿部乃至全身肌肉、以改变跑姿来降低运动伤害的可能性。

<br/>
                        <br/>
                        关于简约跑鞋Minimalist有五个特征:

<br/>
                        <br/>
                        1.Zero-drop Sole——足跟和跖骨球部（前脚掌部位) 处在同一水平面，鞋底并不厚，而脚趾部份略为翘起，使跑步时跖骨球部能率先着地。
<br/>
                        <br/>
                        2. Limited Support——有限的支撑。简化的中底或无中底设计。

<br/>
                        <br/>
                        3. Wide Toe Box——加宽的鞋头，能更好感受抓地。相比传统跑鞋的鞋头，简约跑鞋都具有加宽的脚趾部位设计，使脚部能有更好的抓地和脚感。

<br/>
                        <br/>
                        4. Flexible——柔软。可以任意弯曲鞋子。

<br/>
                        <br/>
                        5. Lightweight——轻量。通常单只都不会超过200克。

 <br/>
                        <br>
                        <a href="http://www.8264.com/viewnews-82374-page-1.html" target="_blank">更多>></a>
 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>Vibram&reg 国际顶尖越野跑者汇聚香江 一月中旬上演超级龙虎争霸</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/dingjian1.jpg" /> </p>
<p> 创立仅3年的Vibram&reg 香港100公里超级越野跑赛事在举办第3届之际，迎来了赛事发展的第一个高潮。据统计，来自30个国家和地区的超过1200名越野跑爱好者报名参加2013 Vibram&reg 香港100公里超级越野跑，开放报名仅48小时就宣布报满。Vibram&reg  UTMB非凡之队将与Vibram&reg 香港100非凡之队历史性会师——Vibram&reg UTMB非凡之队队员Nicola Bassi、Sebastien Nain和Vibram意大利市场总监Jerome Bernard将前来参加2013 Vibram&reg 香港100。<br />
<br />
根据2013 Vibram&reg 香港100公里超级越野跑赛事组织方提供的名单显示，2013 Vibram&reg 香港100公里超级越野跑参赛人数超过1200人，香港本地选手比例最高，分别占男女参赛者的37%（男性）和28%（女性）；中国内地男选手190人，女选手30人，分别占男女参赛者的19%（男性）和14%（女性）。 <br />
<br />
虽然香港弹丸之地人口众多，并不是开展越野跑的最佳区域，但是香港人热爱自然，热爱运动，在相对远离城区的郊野建立适合徒步和越野跑的路线。其中以四条徒步路线最为著名——香港小径50公里，大屿山小径70公里,威尔逊小径78公里, 麦里浩小径100公里。每年四条路线上的各种徒步和越野跑比赛活动多达数十个。Vibram虽然香港弹丸之地人口众多，并不是开展越野跑的最佳区域，但是香港人热爱自然，热爱运动，在相对远离城区的郊野建立适合徒步和越野跑的路线。其中以四条徒步路线最为著名——香港小径50公里，大屿山小径70公里,威尔逊小径78公里, 麦里浩小径100公里。每年四条路线上的各种徒步和越野跑比赛活动多达数十个。Vibram?香港100公里超级越野跑是香港首个个人100公里赛事。香港100公里超级越野跑是香港首个个人100公里赛事。<br/>
                        <br/>Vibram&reg UTMB非凡之队队员Nicola Bassi、Sebastien Nain和Vibram意大利鞋底全球市场总监Jerome Bernard将前来参加2013 Vibram&reg 香港100公里超级越野跑，他们将与Vibram&reg 香港100之队的五位队员并肩作战，挑战100公里的征途。<br/>
                        <br/>据了解，2012年香港毅行者的本地精英选手将悉数参赛2013 Vibram&reg 香港100公里超级越野跑。其中包括目前香港最优秀的越野跑者之一Stone Tsang（曾小强）。曾小强是香港消防处体能教练，除了在香港各类越野跑赛事上创造纪录外，他在2010 UTMB（法国环勃朗峰超级越野跑）获得第21名，这也是中国选手在此项赛事中的最好名次；连续第3次参加Vibram&reg 香港100的Jeremy Ritcey保持着较高的竞技水准，在2011年和2012年赛事中分别获得第2和第4名，。他获得2012 日本UTMF（环富士山超级越野跑）的STY组 (85公里) 第4名和2012加拿大Death Race亚军；William Davies 获得2011 Vibram&reg 香港100公里超级越野跑冠军，2012年赛事获得第6名，他也是实力超群的强有力竞争者。
                        
                        </p>
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>Vibram&reg2013 香港100越野跑训练营在京沪穗三地举行</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
                    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/xunlian1.jpg" /> </p>
                    <p>超过100位中国大陆越野跑爱好者报名2013 Vibram&reg香港100公里超级越野跑（Vibram&reg Hong Kong 100km Ultra Trail Race），作为这项赛事的冠名赞助商，Vibram&reg 已是第三年连续赞助这项目前中国最高难度的极限越野跑赛事。更多平凡的参赛者通过这项极致体验，挑战累计4500米的高差和不可预见的疲劳、疼痛和困难，最终实现一个非凡的梦想。<br/>
<br/>云集世界各地顶级跑者的Vibram&reg 香港100公里超级越野跑将于2013年1月19日揭开战幕。考虑到今年中国大陆地区许多新人加入100公里挑战，为此Vibram&reg特别安排在北京、广州和上海三地举办2013 Vibram&reg 香港100公里越野跑训练营。越野跑训练营结合赛事特点，邀请经验丰富的跑者讲解长距离能量补给，野外跑步帮助大家充分进行赛前热身，与各路跑友交流备战心得。<br>
<br>2013 Vibram&reg 香港100公里越野跑训练营的消息一经发布，就受到了越野跑爱好者们的热烈欢迎。在2013年12月12-13日举办的VIBRAM香港100越野跑训练营京沪穗三地讲座中，超过100位越野跑爱好者在现场聆听了以往参赛者的经验分享和训练建议，这将对他们的準备赛事有所帮助；12月15日，2013 VIBRAM香港100越野跑北京训练营的20多位跑友在雪后的香山地区团队拉练，而广州跑友则参加慈善徒步活动作为训练，12月22日，长三角地区的跑友将在杭州西湖跑山赛环山路綫进行VIBRAM香港100越野跑上海训练营的赛前集训。<br/>
<br>2013 Vibram&reg 香港100公里越野跑训练营的活动举行后，在全国各地引起了各地跑友的呼应——在大连举办Vibram&reg 香港100公里越野跑的分享会、在厦门组织了长距离夜间越野跑拉练活动，越野跑爱好者们正在翘首以待赛事的来临。<br/>
<br>为了让更多的越野跑爱好者能有机会体验越野跑的乐趣和采用Vibram&reg越野跑鞋底製造的产品，Vibram&reg联合HI-TEC、LAFUMA、NEW BALANCE，在北京、广州和上海三地组织Vibram鞋底高性能越野跑鞋体验活动，跑友们试穿体验了LAFUMA、HI-TEC、NEW BALANCE和Vibram&reg Fivefingers的高性能越野跑鞋，部分跑友还将参加VIBRAM鞋底高性能越野跑鞋体验测评活动。
</p>
                    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/xunlian2.jpg" /> </p>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/xunlian3.jpg" /> </p>
                    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/xunlian4.jpg" /> </p>
                    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/xunlian5.jpg" /> </p>

</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_20'><span>Vibram&reg运动员参加2012年环勃朗峰极限耐力跑</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>六名Vibram&reg运动员将参加世界重要山地越野跑赛事的10周年庆祝跑。<br />
<br />
自2007年起，Vibram&reg便成为久负盛名的乐斯菲斯（The North Face&reg）环勃朗峰极限耐力跑（Ultra-Trail du Mont-Blanc&reg）的官方合作伙伴。在2011年，Vibram&reg派出自己的队伍参赛，增强在赛事中的曝光率。<br />
<br />
Vibram&reg相信普通人也能成就非凡，完成UTMB 这项环绕勃朗峰山脉进行的在46小时内跨越三个国家（意大利、法国、瑞士）的传奇赛事。<br />
<br />
今年，籍着环勃朗峰极限耐力跑（UTMB&reg）10周年之际，Vibram&reg选出6位愿意面对勃朗峰挑战的运动员组成新团队：从8月27日开始，Nicola Bassi、Francesca Canepa、David Gatti、Giuseppe“Beppe”Marazzi、Ronan Moalic和Sebastien Nain会把Vibram&reg一直所有的价值观：热爱运动、团队精神以及尊重自然，带到这次全长168公里的赛事中。<br />
<br />
为了能够直面The North Face&reg环勃朗峰极限耐力跑（Ultra-Trail du Mont-Blanc&reg）赛事的崎岖征途，Vibram&reg 2012年山地越野跑团队的运动员们将会穿着由Vibram&reg鞋底提供动力的高科技跑鞋参赛，同时还会配备各种顶级装备，确保取得“非凡”的表现。<br />
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_19'><span>The North Face&reg Lavaredo极限耐力跑</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'> <b>The North Face&reg Lavaredo极限耐力跑：Vibram&reg2012年山地越野跑团队的成功处子秀。</b><br />
<br />
在刚过去的周末（6月29日-7月1日），Vibram&reg 2012年山地越野跑6人团队的中的五位运动员出现在Laveredo极限耐力跑的出发线上。这是一场在意大利的白云石山脉中心举办的超过120公里/6.000米的赛事。Vibram&reg作为赛事的主要赞助商，尽最大努力向比赛输送自己竞技状态最好的运动员。Sebastien Nain、Giuseppe Marazzi、Francesca Canepa、Nicola Bassi和Ronan Moalic在Lavaredo极限耐力跑开跑时都暗自希望在终点取得让人开心惊喜的成绩（受伤的David Gatti不得不放弃参赛）。<br />
<br />
最后的结果的确令人惊喜。在赛事开始进行几个小时后，Vibram&reg的“平凡选手们”并没有被领头羊队伍甩开很远。虽然象Iker Karrera和Sébastien Chaigneau等山地越野跑冠军选手的节奏都很快，但Vibram&reg团队依然可以保持自己的耐力和坚毅紧随其后。<br />
<br />
在黎明时分，最后的排名即将尘埃落定。到了上午冲线一刻，Karrera比Chaigneau快一步冲过终点线，赢得冠军。<br />
<br />
令人惊喜的是，Vibram&reg团队随后便接踵而至，仅比冠亚军排名落后几位，整体成绩非常骄人：<br />
<br />
<ul>
<li>Ronan Moalic取得第8名</li>
<li>Giuseppe Marazzi取得第9名</li>
<li>Francesca Canepa取得第10名，而且是首位到达终点的女子选手</li>
<li>Nicola Bassi取得第11名</li>
</ul>
</b><br />
此外，Francesca和Nicola携手通过Cortina终点线，更是锦上添花。<br />
<br />
对于Vibram 山地越野跑团队这个原来以享受跑步乐趣为目标的队伍来说，Francesca Canepa取得女子组第一名的成绩是一件非凡的事情。另外，Francesca赢得的欢呼喝彩证明了运动员们出众的人格和对运动的热爱让他们自己倍受人们欣赏。<br />
<br />
总而言之，考虑到Lavaredo极限耐力跑的艰苦特点以及参赛选手们的高水平，Vibram&reg 2012山地越野跑团队在处子秀中取得的表现成绩是非常优异的。<br />
<br />
Vibram&reg感谢团队的所有技术合作伙伴（包括索康尼（Saucony）、乐飞叶（Lafuma）、Scott、新百伦（New Balance）、Garmin、驼峰（Camelbak）、攀索（Petzl）、Julbo、Compressport、Antaflex和Polartec），没有它们的支持，这次激动人心的经历就不可能会实现。<br />
<br />
Vibram 山地越野跑团队计划参加的下一次赛事是接下来在8月27日至9月2日举行的乐斯菲斯（The North Face&reg）环勃朗峰极限耐力跑（Ultra-Trail du Mont-Blanc&reg）。</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>Vibram&reg山地越野跑团队参加Lavaredo极限耐力跑（LUT）赛事</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014142908_2952.jpg" /> </p>
<p> 在刚过去的五月在瑞士库玛耶接受完技术训练后，全新的Vibram&reg山地越野跑团队现已整装待发，准备参加2012年团队日程上的三项主要赛事之一--乐斯菲斯The North Face&reg的Lavaredo极限耐力跑。<br />
<br />
从6月29日到7月1日，在（意大利波尔查诺）科尔蒂纳丹佩佐（Cortina d’Ampezzo）的迷人景色中，Vibram&reg山地越野跑团队的5名运动员（Nicola Bassi、Francesca Canepa、Ronan Moalic、Giuseppe Marazzi和Sebastien Nain）
会接过去年“非凡故事”的接力棒，做好准备，体验全新的表现与感受。 <br />
<br />
乐斯菲斯The North Face&reg的Lavaredo极限耐力跑是一项艰苦的跑步赛事，当中要完成118公里的赛道和通过总共5,740米绝对海拔高度，但同时也可以欣赏意大利白云石山脉令人屏息的迤逦风光。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_11'><span>Nicola Bassi的访谈</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc4Njcy.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014143912_1087.jpg" />
<p> <b>Nicola，你是做什么的？</b><br />
我在一家运动用品点做了三年，然后辞职去参加大型自行车骑行。我骑车穿越了阿根廷的整条40号国家公路，从La Quiaca到Ushuaia，全程6000公里。现在，我正在找一份新的工作，上班时

间要适合让我去做户外运动。 <br />
<br />
<b>你成家了吗？有什么兴趣爱好吗？</b><br />
我还没有结婚，也没有孩子…所以我可以把我的全部时间投入到运动中。我经常骑自行车，只要有时间，我就会到山里骑车。 <br />
<br />
<b>你是从什么时候开始跑步的呢？为什么要开始跑步呢？</b><br />
我最初爱上的是登山，而我开始跑步只是为了保持体形去登山。当我开始要在周末工作后，我不得不根据新的工作情况去改做另外一项运动，而山地越野跑步使我能够和高山保持接触，同时

又能迎合我的新兴趣—赛跑。 <br />
<br />
<b>对你来说，山地越野跑意味着什么？</b><br />
山地越野跑帮助我更好地了解自己，让我更能认识到自己的极限，而且最重要的是，使我精神上变得更强大。在山地越野跑的时候，你必须得学会接受疲劳和自我牺牲。在跑步过程中，有些

时候你会觉得身体疲惫不堪，此刻你就要运用意志力去推动身体继续前行，而不要让身体松懈下来。在这里，你完成目标所需的包括坚定的意志、自尊心和不屈不挠的精神。
所有这些能让你得到的只是冲过终点线的时候短暂的满足感！然后，在和所有朋友畅饮庆祝之后，你就得寻找新的挑战和新的目标… <br />
<br />
<b>你之前是不是已经参加过环勃朗峰极限耐力跑（UTMB&reg）比赛呢？</b><br />
没有，这将是我参加的第一次环勃朗峰极限耐力跑（UTMB&reg）的比赛。我之前已经跑过差不多距离或者额难度的赛事，但是每一个人都说环勃朗峰极限耐力跑（UTMB&reg）是一项有魔力的赛事，

所以我也想一探究竟。 <br />
<br />
<b>你对环勃朗峰极限耐力跑（UTMB&reg）有什么样的期望呢？</b><br />
我想要跑这项赛事是因为这是一次挑战、一次新的体验，可以让我测试自己的能力，还可以和其他顶级运动员比一下。环勃朗峰极限耐力跑（UTMB&reg）绝对是具有参考价值的山地越野跑比赛，

它也是最著名的赛事，我很想知道它如此出名的个中原因。我真的希望能在赛事拥有一些美好的时光，而最重要的是，我想要跑过终点线，知道自己尽力而为和全力以赴了，这样就不会抱憾

而归了。 <br />
<br />
<b>为什么你选择参加Vibram&reg山地越野跑队伍呢？</b><br />
对个人来说，成为Vibram&reg团队一员让我有机会得到象Vibram&reg这样好的公司的全力支持。由于它们在山地跑步方面有丰富经验，我们肯定会拿到最好的跑鞋参加比赛。我也期待得到团队里面

的其他运动员以及Vibram&reg员工的支持。 <br />
<br />
<b>除了环勃朗峰极限耐力跑（UTMB&reg）以外，你在2012年还有没有安排与Vibram&reg的山地越野跑团队参加任何别的跑步比赛呢？</b><br />
我肯定会参加Lavaredo极限耐力跑，但是不肯定是否会参加Templiers赛跑。无论如何，我还想参加其它一些赛事，我会建议团队考虑参赛。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_10'><span>Francesca Canepa的访谈</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc4MDY0.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014145354_5179.jpg" />&nbsp;
<p><b>Francesca，你平常是做什么的？</b><br />
我是一名母亲，也是一名运动员。我的生活分成两部分：带我的两个孩子，他们分别是4岁和7岁，还有就是参加训练。 <br />
<br />
<b>你希望向你的孩子们灌输怎么样的价值观呢？</b><br />
我向自己的孩子们灌输的价值观是：无论手头上有什么任务，都要努力工作和勤奋用功。我希望他们理解，非凡的行为常常都从处理一般的情况而来。就象赛跑一样，如果每一件事都准备得很好，连最小的细节都不会放过，那么要跑到终点线也就不难了。 <br />
<br />
<b>你是从什么时候开始跑步的呢？为什么呢？</b><br />
我的运动生涯和高山密不可分。在成为人母之前，我是竞赛级水平的滑雪板运动员，但是随着孩子们来到这个世界上，我便停止了这项运动。之后过了几年，我发现自己渴望能以最佳状态去比赛。我在瑞士库玛耶遇到了当地的体能教练Fabio Maragliati。他建议我开始跑步。即便到了今天，也是他在监督我的训练。当我一开始这项新的活动，我立即就知道自己在山地越野跑这方面有潜力，可以达到竞赛级水平。所以，我坚持了下来，而我的成绩也稳步提升。 <br />
<br />
<b>对你来说，山地越野跑意味着什么？</b><br />
在进行终极耐力跑的时候，时间是属于个人的，所以可以让自己的想法自由地流动。最重要的是，在跑的时候有机会去感受到与世隔绝的空灵，想象冲过终点线的一刻，提前品味最后几公里时的感受。 <br />
<br />
<b>为什么你想参加过环勃朗峰极限耐力跑（UTMB&reg）呢？</b><br />
纯粹是为了享受发现全新地方和全新线路的乐趣。 <br />
<br />
<b>为什么要参加Vibram&reg山地越野跑队伍呢？</b><br />
作为Vibram&reg山地越野跑团队的一员，我有机会和一群截然不同的人去分享强大的体验，例如终极耐力山地跑的体验。对我来说，有机会去把自己的体验和感受鲜活地向别人呈现，分享自己的成果，是一种重要的推动力。这就是环勃朗峰极限耐力跑（UTMB&reg）等赛事为什么是真正超越平凡的比赛的原因。此外，得到象Vibram 如此声名显赫的公司的青睐，也是更大的一股推动力，使我努力为队伍做到最好，因为我不仅是在为自己而跑，而且还是为所有在那里支持我的人而跑。 <br />
<br />
<b>除了环勃朗峰极限耐力跑（UTMB&reg）以外，你在2012年还安排与Vibram 的山地越野跑团队参加什么别的跑步比赛呢？</b><br />
我们肯定会参加六月底的Lavaredo终极耐力跑和十月底的Templiers比赛。我们目前正在看2012年还有什么别的赛事可以参加。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_9'><span>David Gatti的访谈</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc5Nzg4.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014150648_3626.jpg" />&nbsp;
<p> <b>David，你平常是做什么的？</b><br />
我是Polartec&reg公司的专业市场（例如军事、警察、消防、工业等）部门经理。 <br />
<br />
<b>你成家了吗？有孩子吗？</b><br />
我有两个儿子，分别是7岁和9岁大。 <br />
<br />
<b>你是从什么时候开始山地越野跑的呢？为什么呢？</b><br />
我在2010年开始山地越野跑。早在2009年，Polartec&reg就已经是环勃朗峰极限耐力跑（UTMB&reg）的合作伙伴，我会邀请顾客看比赛。在周末的比赛结束前，我就已经被赛事的气氛、挑战性和人们的情绪所深深地吸引住。在认真思考了四个月后，我决定参加2010年的CCC赛跑。 <br />
<br />
<b>对你来说，山地越野跑意味着什么？</b><br />
在山地越野跑里面，有高山，有我对表现的渴望，还有我在跑步时的强烈感受。 <br />
<br />
<b>你之前是不是已经参加过UTMB&reg的赛事？</b><br />
没有，2012年将会是我第一次参加UTMB&reg比赛。 <br />
<br />
<b>为什么你决定要参加这次特定的比赛呢？</b><br />
因为从我开始跑步开始，这已经成为了我的目标。因为这是终极耐力山地跑，是最重要的跑步比赛。另外，也因为在高山上跑步已经成为了我的一种生活方式，我想要看看自己能否跑到终点… <br />
<br />
<b>为什么你想要成为Vibram&reg山地越野跑队伍的一员呢？</b><br />
我不太肯定该不该这样说…但是所有这一切都始于在办公室里开的一个玩笑。因为我自己不是最好的跑手之一，所以我可能不会要求成为队伍的一员。我每隔一个星期就要到外国出差一次，我没有足够的时间去参加足够的固定训练。但是，在Polartec&reg 和Vibram&reg之间一种联系，它们都是各自领域的领先品牌。我也感到荣幸能够为这两家公司做出贡献，并且和顶级运动员一起参加这次比赛。我并没有为此做好准备，也没有期望过能够有这样的机会。我希望事事顺利。 <br />
<br />
<b>除了环勃朗峰极限耐力跑（UTMB&reg）以外，你在2012年还有没有安排与Vibram&reg的山地越野跑团队参加任何别的跑步比赛呢？</b><br />
目前，我不太确定有什么样的赛事日程安排，这主要是由于我的工作缘故。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_8'><span>Beppe Marazzi的访谈</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDYwNDUyMDA0.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014151822_3929.jpg" />
<p> Beppe在2011年已经是Vibram&reg山地越野跑队伍的成员之一，他在环勃朗峰极限耐力跑（UTMB&reg）当中取得的优异的成绩。Beppe已经结婚，是两个孩子的父亲。他开始参加山地越野跑一方面是为了保持体形，另一方面是为了向孩子传达他对高山的热爱和尊敬。 <br />
<br />
<b>Beppe，请跟我们说一说在去年你和Vibram&reg山地越野跑团队一起参加的环勃朗峰极限耐力跑（UTMB&reg）的情况。</b><br />
环勃朗峰极限耐力跑（UTMB&reg）是让一次让人印象深刻的体验，不仅因为在比赛中可以保持情绪高涨，偶尔心情交杂，还可以欣赏壮丽的风景，而且最重要的是它也是一次让我发现自己极限的内心之旅。你可以在比赛中发现身体上的极限，因为经过了如此长时间的跑步，身体会疲乏不堪，但更有甚者，你还可以发现精神上的极限。会有这么一个时刻，我们感到自己不再需要戴上假装的面具，在我们和现实之间的无形障碍不复存在，这样的感觉陆续而至。在那一刻，你完全属于你自己，“无需遮掩”，我很想能再得到如此棒的感觉。 <br />
<br />
<b>这就是为什么你决定在2012年再次跟随Vibram&reg山地越野跑团队征战的原因吗？</b><br />
我当然还想再次体验那些美妙的感受，而且我也有任务去参加UTMB 。我的儿子不断地要求和我一起跑到终点，但是去年我没有做到对儿子的承诺。这就是为什么我将会尽一切努力要在半夜之前跑到加穆尼克斯谷（Chamonix）的终点线的原因，这样我就可以和儿子携手冲线。 <br />
<br />
<b>所以，你准备好参加UTMB&reg比赛和再次加入Vibram&reg山地越野跑队伍了吗？</b><br />
能够再次和Vibram&reg团队一起参加UTMB 比赛本身就是一种荣幸。去年我能够顺利完成赛事一部分原因是由于得到团队的支持。在跑了一天一夜的每一个时刻，甚至是在最不可能完成的一些赛段，我也知道在前方有人等待着我，有人信任我，有人准备好投入时间和精力给我全力的支持。如果我只是孤军作战，我肯定会放弃了。但是在那些充满了疑惑的时刻，我感到自己是一个大集体里面的重要一员。每当这样想的时候，我的意志就让我坚持下去！
我不知道今年自己能否顺利做到自己的目标，因为在这样的比赛当中有太多的未知情况，但是我肯定的是，团队的支持会给我所需要的额外动力，让我倾尽全力做到最好地向前跑。 <br />
<br />
<b>除了环勃朗峰极限耐力跑（UTMB&reg）以外，你在2012年还安排了与Vibram&reg的山地越野跑团队参加什么别的跑步比赛呢？</b><br />
目前，我们计划参加6月底的120公里比赛--Lavaredo极限耐力跑，还有10月26、27和28日举行的Templier跑步比赛。我们肯定还会参加其它一些赛事，但也得视情况而定。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_7'><span>Ronan Moalic的访谈</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc5MzUy.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014152628_5032.jpg" />&nbsp;
<p> <b>Ronan你平常是做什么的？</b><br />
我是一名外科医生。这是一个很有吸引力的职业，要求从业者得有相当的专注力。我的工作量很大，工作时间安排并不总能让我得到想要的训练时间，但是我很高兴自己还是能够平衡生活，保持两个最大的兴趣。 <br />
<br />
<b>你成家了吗？有孩子吗？</b><br />
我的太太给我很大的帮助。她总是理解我和鼓励我。她自己也会玩一些山地越野跑，但只跑短途。至于我的儿子，他今年8岁，他的支持也是同样重要。有时候他会来到比赛现场鼓励我，在一些比较困难的时刻，我经常会想到他，然后就会得到动力。 <br />
<br />
<b>你是从什么时候开始终极耐力山地跑的呢？为什么呢？</b><br />
我2004年10月参加了Diagonale des Fous比赛（法属留尼汪岛上的Grand Raid比赛），那是我的第一次极限耐力跑比赛，但是那次我准备得不够充分。我在那之前才跑了几个月，但就大胆地认为自己能够完成赛事。最重要的事情就是要真正地相信自己能够做得到。这次比赛真的让人觉得不可思议，整个岛都把焦点放到比赛和“参赛者”上面。终极耐力山地跑要的就是超越一个人的极限，超越疲倦和困难，还要深入发掘找出自己都难以置信的资源。你可以了解到自己，它就象是启动了人和自然的沟通。但是，还不止这么一些。在参赛之前，我们要做长时间的准备工作，光训练就要花上几个月的时间。而在更早一点的时候，根据多年前的想法而成的参赛项目需要有个缓慢的成熟期。终极耐力山地跑是一个能够带来独特体验的需要组织安排的项目，而并非一时冲动的鲁莽之举。 <br />
<br />
<b>对你来说，山地越野跑意味着什么？</b><br />
我能发现山地越野跑这项运动，多亏了一个朋友，他在2004年带我看了一次赛跑。几个月之后，我在留尼汪岛的Diagonale des Fous赛跑中通过了终点线。渐渐地，我取得了进步，对这项运动的热爱也得到升温。山地越野跑带来的是在高山中跑步的欢乐。当你爬上一个陡坡，尽自己全力抵达山顶，充分利用每一口呼吸，或者当你跑下山时在石头间跳跃，在树与树之间穿行，你就不会觉得自然只是简单的存在，你会深深地感到它也是有生命的，你自己仿佛与那些石头、树木和山坡融为一体。你的内心会有想跑的感觉，就象动物一样。这种超越自己极限的愉悦感还教会了我们如何去处理好这些限制。 <br />
<br />
<b>你之前是不是已经参加过UTMB&reg的赛事？</b><br />
这将是我在UTMB&reg的首次参赛。 <br />
<br />
<b>为什么你想参加UTMB&reg赛跑呢？</b><br />
因为这是在一个令人难忘的环境中进行的一项神话般的比赛，是山地跑选手一生中必须参加的特别赛事。这就是所谓的终极赛跑。 <br />
<br />
<b>为什么要参加Vibram&reg山地越野跑队伍呢？</b><br />
和Vibram&reg这样一个品牌合作是个学习新东西的机会，也是非常令人鼓舞和值得炫耀的。另外，我们可以有机会出行，比如去白云石山脉（Dolomites）参加Lavaredo比赛，还可以认识一些新的人们（特别是意大利人！）。
对我们来说，这种合作肯定能提供一种额外的动力来源，包括装备和后勤方面的补充，对于像UTMB&reg这样的终极耐力山地跑比赛，得到的任何协助都无疑可以让我们占领先机。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_6'><span>Sebastien Nain的访谈</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTgwMzcy.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014153718_7727.jpg" />&nbsp;
<p><b>Sébastien你平常是做什么的？</b><br />
我是核部门的消防队员。 <br />
<br />
<b>你成家了吗？有孩子吗？</b><br />
我已经结婚，妻子名叫Sophie，她也是一名运动员，我们有一个儿子叫Mathys，差不多三岁了。 <br />
<br />
<b>你是从什么时候开始终极耐力山地跑的呢？为什么呢？</b><br />
我在2008年开始参加终极耐力山地赛跑，当时是在留尼汪岛上的Grand Raid比赛。我也参加过铁人三项，但只差五分钟没有取得参加世界冠军赛的资格。所以我决定尝试山地跑一年，并且不

会回头。 <br />
<br />
<b>你之前有没有参加过UTMB&reg比赛呢？还是说，这是你的第一次参赛吗？</b><br />
我已经参加过UTMB&reg赛跑三次了，但是在2008年我生病了，不得不止步于法国的Contamines镇；然后到了2009年，我在圣杰维尔（St-Gervais）下山途中摔倒，扭伤了臀部；最后在2010年，赛

事本身由于恶劣天气中止。2011年，我决定在别的比赛中试试自己的运气，报名参加了Grand Raid des Pyrenées的比赛。这是一次垂直海拔高度落差有10000米的160公里跑步比赛。我最后得

到了第三名。 <br />
<br />
<b>为什么你想要参加UTMB&reg比赛呢？</b><br />
UTMB 是世界上最精彩的比赛之一。我的梦想是在所有这些最迷人的山路赛道上跑步，而且如果可能的话取得好的成绩。这里有一些我已经参加过的跑步比赛，还有一些还在我的待参赛名单中

。 <br />
<br />
留尼汪的Grand Raid比赛（2008年，取得第12名）；维登峡谷挑战赛（2009，赢得冠军）；Ultra Templiers终极跑（2009年，得到第9的位置）；Marathon des sables马拉松跑（2010年，排

名第10，是第一位冲线的法国人）；Aubrac Aventure比赛（2011年，获得亚军）；Grand Raid des Pyrénées比赛（2011年，拿到第3名，也是首位到达终点的法国选手）。 <br />
<br />
我未来准备参加的比赛还包括UTMB&reg比赛、Lavaredo终极耐力跑、Western States西部州比赛、Hardrock滚石赛跑、Leadville越野跑、Spartathlon（斯巴达斯松）超级马拉松赛、香港100公

里马拉松、尼泊尔比赛、冰岛耐力赛等等。 <br />
<br />
<b>为什么参加Vibram&reg山地越野跑队伍呢？</b><br />
Vibram&reg队伍能够帮助我取得好的成绩，感谢他们的赛跑方法，以及最重要的是他们的人员给予人力、物质和财力方面的协助，帮我实现了梦想。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_5'><span>Vibram&reg与2011年环勃朗峰极限耐力跑（UTMB&reg）</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p>“为了突出自己在新的山地运动，特别是在山地跑方面参与的逐渐增多，Vibram&reg已经成为环勃朗峰极限耐力跑（Ultra-Trail du Mont-Blanc&reg）的赞助商许多年”，Vibram&reg的首席执行官Adriano Zuccala这样说。Zuccala先生自己在多个不同的补给站热心地支持Vibram 团队的成员。<br />
<br />
“今年，Vibram&reg队伍的组建提供了机会，让我们可以在赛事中发挥更加重要的角色，当然也代表着我们在赞助重要运动赛事方面的根本性的新尝试，例如成为UTMB&reg的赞助商”。<br />
<br />
特别要感谢Vibram&reg的五名跑手带来的“非凡体验”，正如赛事的Vibram&reg 协调官Annalaura Gatto 所说，2011年版的赛事“开启和激起了新可能”。比赛强有力地展现了三个主要方面的重要性，即测试每位跑手极限的个人挑战，需要每位跑手合理管理自己的个人资源，以及市场上一些最知名品牌（Julbo、Petzl、Camelbak和Montura）提供的技术装备发挥的基本作用。由乐飞叶、索康尼、Hi-Tec和纽巴伦提供的鞋子统统都有最新的Vibram&reg山地跑鞋底，也是一个具有决定性的要素。Marco Zanchi 说：“当在一些由于雨雪而变得湿滑的地形表面上跑步的时候，值得信赖的鞋子就变得真的很重要了。” Rapha l Bodiguel补充道：“在166公里赛跑过程中，Vibram&reg鞋底为我们提供所需要的抓地力和安全性。”<br />
<br />
从Vibram&reg队伍出发和训练全过程都对五名“平凡人成员”进行监控和观察的团队经理Nicola Faccinetto 说：“在环勃朗峰极限耐力跑（UTMB&reg）里面，每一件事都有赖于你的精神状态。这就是为什么在长途耐力赛跑中不可避免地出现身体疲乏的情况时，精神支持加上技术支持是如此的重要。”<br />
<br />
训练由身体测试和心理测试两部分组成，环勃朗峰极限耐力跑（UTMB&reg）的Vibram&reg选手们得到的不只是一次成绩，而更多的是一种生活的体验，因此他们可以真正地坚持团结和尊重自然的价值观，这也正是Vibram&reg和环勃朗峰极限耐力跑（UTMB&reg）的组织机构分享的价值观。<br />
<br />
公众对在加穆尼克斯谷（Chamonix）的终极山地跑展览中的Vibram&reg产品也赞赏有加。Vibram&reg团队使用的特殊山地跑鞋底引起了大家相当大的兴趣和好奇。革命性的“脚套鞋”Vibram&reg fivefingers&reg也是得到公众青睐的另外一件产品。具有多用途的FiveFingers&reg是环勃朗峰极限耐力跑等山地跑比赛前参赛选手们作准备训练的理想鞋具。 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_4'><span>2011年环勃朗峰极限耐力跑（UTMB&reg），Vibram&reg的“非凡”体验</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p>Vibram&reg投入重金到上一届环勃朗峰极限耐力跑（Ultra-Trail du Mont Blanc&reg）赛事，而且不再只是做赞助商之一。投资的效果明显…<br />
<br />
五名运动员中有三名完成了赛事，其中两人甚至跻身总排名前50位的顶级选手之列。完成比赛的第三人排第101名，在距离终点线10公里的地方还处于第70的位置。在环勃朗峰极限耐力跑（UTMB&reg）中，Vibram&reg团队经历了挑战，超越了所有期待，生动地演绎了Vibram&reg的口号：“平凡人成就非凡”。今年，在环勃朗峰极限耐力跑（Ultra-Trail du Mont Blanc&reg）比赛期间，Vibram&reg取得了令人侧目的运动佳绩，它的队员们也体验了令人难忘的时刻。<br />
<br />
Marco Zanchi取得了彪炳的结果，以第32名的成绩完成了比赛。他也是最先冲过终点的意大利人。Vibram&reg的环勃朗峰极限耐力跑（UTMB&reg）团队中的另外一名意大利人成员Giuseppe Marazzi也创造出骄人的成绩，“Beppe“这次终于完成了比赛（去年由于恶劣天气被迫中止），个人在赛事中的总排名是第49位。来自法国的Rapha l Bodiguel也用非常值得尊敬的第101位成绩完成了2011年的环勃朗峰极限耐力跑（UTMB&reg）比赛。不太走运的Johan Sérazin在完成50公里之后不得不放弃比赛，而Candide Gabioud则仍然需要时间从脚踝的伤势中康复。<br />
<br />
今年，环勃朗峰极限耐力跑（UTMB&reg）的姐妹赛事—93公里长、垂直水平落差达5300米的CCC&reg耐力跑—在环勃朗峰极限耐力跑（UTMB&reg）前一天结束，Vibram&reg参赛成员的比赛成绩同样不俗。市场经理Jér me Bernard顺利完成比赛，名次是令人佩服的第292位，要知道，Jér me是最近才开始进行山地耐力跑运动的。</p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_3'><span>穿Vibram&reg鞋底的鞋子</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table class="ke-zeroborder" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top"><img style="padding-right:15px;padding-top:10px;" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121018150924_4609.jpg" width="100" height="146" /></td>
<td class="news_testo" valign="top"><p> 年,来自美国、英国、日本、西班牙和法国等57个不同国家的顶级跑手和运动员参加了赛事，他们来到加穆尼克斯谷时全部都信心满满。<br />
让我们来看看结果吧。这项在欧洲最受欢迎的第八届终极耐力跑赛事最后的成绩是怎么样呢？主场作赛运动员跑最快的前十名当中有四人穿了有Vibram 鞋底的鞋子。那就是为什么要加入我们队伍的原因之一。 </p></td>
</tr>
</tbody>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
</ul>
<div class="page_navigation" style="display:none;"></div>
</div>
<div class="titolino_giallo"> 
<script type="text/javascript">
                var lan=1;
                if(lan=="1")
    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/athlete.png' width='131' height='27'>");
                if(lan=="2")
                    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/partner-1.png' width='131' height='27'>");
</script>
</div>
<div id="contenitore_di_product">
<ul style="margin:0px; padding:0px; list-style:none" id="product_elenco" class="content">
<li>
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>曾进杰 别名「鹰」(Vibram 香港100非凡之队)</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/duiyuan1.png' width='400'></td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>曾进杰 别名「鹰」</b><br/>
<br>
鹰今年将首度参加Vibram香港100赛事，他承认由于是首次参赛，并不确定哪个部分的赛道最令他期待，只希望可以尽量跑完全程。<br/>
                                 <br>
                                香港本地跑手鹰，喜欢穿着Vibram五指鞋跑步，因为该款跑鞋令他在奔跑时感觉更加自然。目前每周他都会跑40公里，备战赛事。鹰没有在世界各地参加越野跑赛事的经验，但最近完成了几项赛事，包括：<br/>
<br>
                                2012&nbsp;&nbsp;&nbsp;&nbsp;2012 Ironman 70.3 Taiwan<br/>
                                <br>
                                2012&nbsp;&nbsp;&nbsp;&nbsp;100公里乐施毅行者<br/>
                                <br>
                                鹰在朋友的推荐之下参加持久跑运动，他喜欢该项运动能够令自己寻求个人突破。在跑步之外，他最喜欢的运动是踩单车，因此他参与很多三项铁人比赛，因为可以将两项最爱的运动结合在一起。
                                
                                <br />
                                
                                </td>
</tr>
<tr>
<td valign="top" class="news_testo">&nbsp;</td>
</tr>

</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>覃俊平, 别名 「King Jump」(Vibram 香港100非凡之队)</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/duiyuan2.png' width='300'></td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>覃俊平, 别名 「King Jump」</b><br />
<br />
King Jump曾于2012年参与Vibram香港100赛事，今年他将穿着拥有Vibram鞋垫的HI-TEC跑鞋再次参赛。在2012年成功完成Vibram香港100赛事的他，由于伤患未能完成2012北京TNF赛事。他立志希望可以在今年以更佳成绩完成Vibram香港100赛事。<br>
<br>
                                他在六个月前开始为Vibram香港100备赛，除了采用高蛋白、高淀粉、低脂肪的饮食计划之外，亦注重在心律及时间控制上进行训练。<br/>
                                <br>
                                King Jump形容马鞍山赛段迷人如画的风景是他个人在Vibram香港100赛事的最爱，因此即便自己有恐高症，但仍决定参加2014年的大屿山100赛事。<br/>
                                <br/>
                                King Jump过去主要参加公路赛跑，之后才参与持久跑赛事，他认为后者可以与朋友共同参与，并能获得身心的完全释放。
                                </td>
</tr>
<tr>
<td valign="top" class="news_testo">&nbsp;</td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A6'><span>Joel LaBelle, 又称「 Jogger Joel 」(Vibram 香港100非凡之队) </span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/duiyuan3.png' width='300'></td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>Joel LaBelle, 又称「 Jogger Joel 」 </b><br />
<br />
Joel曾在世界范围内参加许多越野跑及铁人比赛，通常他会穿着Vibram鞋底或Vibram五指鞋参赛，但此次他表示，由于考虑到地形，今次他很有可能穿着New Balance Minimus 1010参加Vibram香港100。 <br />
                                <br/><br/>
                                Joel将继2011、2012年之后，连续第三届参加Vibram香港100这项他最钟爱的本地赛事。在2012年的赛事中，他创造了个人该项赛事的最好成绩20小时18分54秒。
                                <br/><br/>
                                在完成2013年Vibram香港100赛事后，Joel将会参加以下比赛：
                                <br/><br/>
                                2013年2月&nbsp;&nbsp;香港渣打马拉松
                                <br/><br/>
                                2013年3月&nbsp;&nbsp;墨尔本铁人赛
                                <br/><br/>
                                2013年4月&nbsp;&nbsp;富士山161公里越野跑
                                <br/><br/>
                                他从2009年开始热衷越野跑，从5公里、10公里的短距离赛事开始，之后参加马拉松、100公里赛事及铁人赛。他表示必须不断努力训练，而他全年都保持有规律的训练，在较暖的天气准备铁人赛，在秋冬季专注越野跑。Joel很热爱三项铁人赛，但对游水却是又恨又爱。
                                </td>
</tr>
<tr>
<td valign="top" class="news_testo">&nbsp;</td>
</tr>

</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A6'><span>Linds Russell (Vibram 香港100非凡之队)</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/duiyuan4.png' width='300'></td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>Linds Russell</b><br />
<br />
Linds Russell 今年将首次参加Vibram香港100赛事，这不仅仅是她首次参赛，也是她首次代表Vibram香港100非凡之队比赛。她已经为比赛作好准备，并很期待大帽山段的赛程。<br />
<br />
Linds从12月开始备战, 包括在周末跑两个长距离，平日进行力量和短程跑训练等。她不仅仅对自己的训练要求严格，并很注重赛前饮食，尽量吃无加工的健康食物。<br/>
                                <br/>
                                Linds 将借助以下曾参加的赛事经验，帮助自己参赛Vibram香港100<br/>
                                <br/>
                                2012 &nbsp;&nbsp;100公里Oxfam毅行者<br/>
                                <br/>
                                2012&nbsp;&nbsp;Wilson Raleigh Challenge (48公里夜间赛)<br/>
                                <br/>
                                2011&nbsp;&nbsp;Swiss Alpine 78公里<br/>
                                <br/>
                                Linds来自英国，也很喜爱划龙舟和健身房循环训练。她曾在世界各地参加多个越野跑赛事，最喜爱的赛道是Swiss Alpine Ultra。在大学就读期间，她在短期军队生涯中开始爱上持久跑，更在台风天气下登过富士山。
                                 </td>
</tr>
<tr>
<td valign="top" class="news_testo">&nbsp;</td>
</tr>

</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>曲丽杰(Vibram 香港100非凡之队)</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/duiyuan5.png' width='300'></td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>曲丽杰(Vibram 香港100非凡之队)</b><br />
<br />
在2012年以21小时44分完成赛事的曲丽杰今年将会再次参赛。Vibram香港100是丽杰最喜爱的赛事，她希望可以在今年打破个人最好成绩，跑进16小时。

<br>
<br/>
曲丽杰穿着Vibram五指鞋参赛，非常钟爱和认同Vibram品牌的产品和理念！她从去年8月已经开始为Vibram香港100备战，包括每周两次爬楼梯3小时，每周跑两次30公里跑，每周一次50公里加50公里长跑。<br/>
<br/>在完成了以下几项赛事之后，目前丽杰状态正佳。<br/>
<br/>2012&nbsp;&nbsp;北京TNF100<br/>
<br/>2012&nbsp;&nbsp;100公里乐施毅行者<br/>
<br/>2011&nbsp;&nbsp;北京TNF100<br/>
<br/>2010年无意中在网上看到法国环勃朗峰越野跑比赛中那些震撼人心的照片后，曲丽杰就开始为参赛环勃朗峰越野跑作努力。她希望在今夏再次参赛环勃朗峰越野跑赛事前，保持最佳状态。
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo">&nbsp;</td>
</tr>

</table>
</div>
</div>
<div class='ico_2'></div>
</li>
        		<li>
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>Nicola Bassi (Vibram环勃朗峰越野跑之队)</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/duiyuan6.png' width='300'></td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>Nicola Bassi </b><br />
<br />
年龄&nbsp;&nbsp;25<br>
                                <br>
                                城市&nbsp;&nbsp;代森扎诺德尔加达<br>
                                <br>
                                国际&nbsp;&nbsp;意大利<br>
                                <br>
                                "身体极度疲惫的时候, 心志引导我们继续前进..."<br>
                                <br>
                                出生于1987年的Nicola Bassi，来自意大利代森扎诺德尔加达，是Vibram?越野跑之队最年轻的队员。他曾在一个体育商店任职3年，现在全身心参与户外运动。他热爱各项运动，更单车跋涉神秘的40国家公路6000公里，穿越阿根廷。他的目标是将工作与运动相结合，尽可能被群山环绕。Nicola提到：「一开始，我只是十分专注登山运动，跑步只是为了训练，对于越野跑的喜爱是逐渐生成的。」<br>
                                <br>
                                以下是他过去两年参加过的主要赛事：<br>
                                <br>
                                2011&nbsp;&nbsp;Grand Raid des Pyrénées第20名<br>
                                <br>
                                2011&nbsp;&nbsp;Adamello Supertrail冠军<br>
                                <br>
                                2011&nbsp;&nbsp;Grand Trail 3V第9名<br>
                                2010&nbsp;&nbsp;Toubkal Marathon第24名<br>
                                <br>
                                2010&nbsp;&nbsp;Red Rock Sky Marathon (世界杯赛事) 第11名<br>
                                <br>
                                2010&nbsp;&nbsp;Estremamente Parco (Julian Alps) 第15名<br>
                                <br>
                                对Nicola来说，越野跑是一个内心的征途，一种对自身体能和心理的测验，从而更了解自己。他表示：「当身体极度疲倦的时候，当一切都感到痛苦，是你的内心引领你继续前进。固执、骄傲、不放弃的坚韧，都帮助我们达成目标，在跨越终点的一刻获得极大的满足感。」<br>
                                <br>
                                今年是Nicola Bassi首次作为 Vibram越野跑之队队员参赛，今年他会参加Lavaredo越野跑以及环勃朗峰越野跑。虽然Nicola曾在过去跑过与环勃朗峰越野跑距离相近的赛事，但他对于首次参加该项世界顶级赛事，征服勃朗峰感到紧张。他希望透过亲身体验，验证该项赛事是否如其他参赛者说的那样非凡。我希望其他Vibram越野跑之队的成员能够分享他们的经验，并依靠团队协作克服种种困难。<br>
                                
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo">&nbsp;</td>
</tr>

</table>
</div>
</div>
<div class='ico_2'></div>
</li>
        		<li>
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>Sebastien Nain (Vibram环勃朗峰越野跑之队)</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/duiyuan7.png' width='300' ></td>

</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>Sebastien Nain</b><br />
<br />
年龄&nbsp;&nbsp;40<br>
                                <br>
                                城市&nbsp;&nbsp;弗沃<br>
                                <br>
                                国籍&nbsp;&nbsp;法国<br>
<br>
                                "...环勃朗峰越野跑是世界上最棒的赛事之一..."<br>
                                <br>
                                40岁的Sébastien Nainis来自法国，是核能部门的消防员。他的妻子Sophie也是一名运动员。他们的儿子Mathys，就快3岁了。Sébastien参加很多体育及山地运动，参加过Ironman铁人三项赛 (3.8公里游水, 180公里单车以及42.195公里马拉松) 。由于没能获得世界冠军赛的参赛资格，Sébastien决定将全部精力投入到越野跑，爱上山地跑之后再也未参加三项铁人比赛。<br>
                                <br>
                                他曾取得过很多骄人的成绩，包括:<br>
                                <br>
                                2011&nbsp;&nbsp;Gran Raid Pyrénées第三名，法籍跑手第一<br>
                                2011&nbsp;&nbsp;Aubrac Aventure第二名<br>
                                2010&nbsp;&nbsp;Marathon des Sables第十名，法籍跑手第一<br>
                                <br>
                                2009&nbsp;&nbsp;Ultra Trail des Templiers第九名<br>
                                <br>
                                2009&nbsp;&nbsp;Saint-Maximin冠军<br>
                                <br>
                                2009&nbsp;&nbsp;Verdon Canyon Challenge冠军<br>
                                <br>
                                Sébastien 曾三次参加环勃朗峰越野跑，但在2008年, 他在比赛开始30 公里后于Contamines因伤退赛。2009年，他在前进St-Gervais的途中跌落，并扭伤他的臀部。之后2010年，赛事因恶劣天气而中止。Sébastien认为环勃朗峰越野跑是世界最棒的赛跑比赛之一。2012年，他希望能够以优异的成绩完成赛事。他对能够代表Vibram环勃朗峰越野跑之队参加赛事感到兴奋，他表示：「有了Vibram团队及设备的支持，将能帮助我获得更好的成绩。」 
                                <br>
                                </td>
</tr>


</table>
</div>
</div>
<div class='ico_2'></div>
</li>
        
</ul>
<div class="page_navigation" style="display:none;"></div>
</div>
<div class="titolino_giallo"> 
<script type="text/javascript">
                var lan=1;
                if(lan=="1")
    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/partner.png'width='141' height='27' />");
                if(lan=="2")
                    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/photo_video-1.png'width='141' height='27' />");
</script>
</div>
<div id="contenitore_di_product">
<ul style="margin:0px; padding:0px; list-style:none" id="product_elenco" class="content">
<li>
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>LAFUMA&reg Speed-Trail跑鞋</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/2012101904181.png' width='427' height='80'></td>
<td><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logo_partners.png' width='100' height='100' align='right'></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>LAFUMA&reg Speed-Trail山地跑鞋</b><br />
<br />
高科技性能、舒适、轻盈、透气，这些都是LAFUMA&reg山地越野跑鞋的主要特点，也是赛跑选手们总是喜欢选择LAFUMA&reg作为他们应付最艰难的山地跑时的战略装备的原因。LAFUMA&reg还绝对保证他们公司的产品无论是从外观还是性能上都在每一分细节上做到优雅与优质兼而有之。<br>
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_lafuma.png" width="165" height="160"></td>
<td width="20px"></td>
<td valign="top"><br>
LAFUMA&reg为Vibram&reg队伍供应Speed Trail款跑鞋。这款跑鞋经过最极端赛跑环境下的测试，由于采用了Vibram&reg VITESSE鞋底，所以尽管重量超轻，但依然能支撑整个脚弓，即便在最不平坦的表面上也可以带来最强的抓地力。<br>
<br>
<a href="http://www.vibram.com/index.php/us/SPORTS/TrailrunningMultisport/Powered-by/In-evidenza/TRA-LAFUMA-Speed-Trail" target="_blank">如需了解更多信息，请点击此处&gt;&gt;</a><br>
<br></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff;">Vibram&reg山地越野跑团队<br />
"平凡人成就非凡"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>新百伦（NEW BALANCE）MT 10极简越野跑鞋</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/newbalance.png' width='427' height='80'></td>
<td><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logo_partners.png' width='100' height='100' align='right'></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>新百伦（NEW BALANCE）MT 10极简越野跑鞋</b><br />
<br />
Minimus 10越野跑鞋则是专为喜欢极简鞋款跑者所设计，除更接近裸足穿着感外，同时提供足部完整的支撑性；鞋面使用轻量透气网布，中底则采用具有柔软及耐用性的ACTEVA避震材质，舍弃传统鞋垫，将其鞋垫与鞋面采一体成型设计，更让男鞋9.5号的单脚重量仅约200克。<br>
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_newbalance.png" width="165" height="160"></td>
<td width="20px"></td>
<td valign="top"><br>
Vibram 专为New Balance独家设计的赤足跑鞋大底给予优异抓地力，提供耐磨性及牵引力。一体化设计的外底橡胶覆盖鞋头和侧边的受力区，鞋底纹路运用设计感和功能性幷重的组合图案，后跟部位N-durance耐磨外底橡胶搭配延长跑鞋的寿命。 <br>
<br>
<a href="http://www.vibram.com/index.php/us/SPORTS/TrailrunningMultisport/Powered-by/In-evidenza/TRA-LAFUMA-Speed-Trail" target="_blank">如需了解更多信息，请点击此处&gt;&gt;</a><br>
<br></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff;">Vibram&reg山地越野跑团队<br />
"平凡人成就非凡"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A6'><span>HI-TEC V-Lite Infinity Hpi越野跑鞋 </span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/higtec.png' width='427' height='80'></td>
<td><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logo_partners.png' width='100' height='100' align='right'></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>HI-TEC V-Lite Infinity Hpi越野跑鞋 </b><br />
<br />
使用VIBRAM  O.D.D鞋底的HI-TEC V-Lite Infinity HPi越野跑鞋采用革命性的U.Z.E.(Seamless Upper Zone Engineering)鞋面无缝合线技术，以单片网面设计出理想越野跑鞋，既环保又可减低鞋面重量，同时更符合脚型，减少鞋面爆裂及足部起水泡机会。再配以ion-mask (HPi)拨水技术，100%防水的同时维持鞋面透气度，比一般未经 ion-mask  (HPi)处理的款式有效减低吸水度达87.66%，加强鞋面干净、快干及轻身的特性，使用者长时间行走依然感觉舒适。 <br /></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_higtec.png" width="165" height="140"></td>
<td width="20px"></td>
<td valign="top">Vibram  O.D.D.（Outsole Dual Density，双层密度外底）是为Hi-Tec山地越野跑鞋独家设计的一款轻盈外底。<br/>
底部特有增加摩擦力设计的带状鞋齿，提升上坡时的运动力量传送<br/>
选用Vibram  XS Trek 橡胶合成配方制成的鞋齿，与岩石表面接触时有更好的耐磨性和抓地力<br/>
前掌和后掌中央部分的垫料是用Vibram  MultiTrek制成，在多种特点的地面上使用时都能提供完美表现<br/>
带有ESS的TPU底腰设计为要求最高的山地越野跑手们提供支持和保护，特别在地面不平的状况下更能凸现这一点 <br>
<br>
<a href="http://www.petzl.com" target="_blank">如需了解更多信息，请点击此处&gt;&gt;</a></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff">Vibram&reg山地越野跑团队<br />
"平凡人成就非凡"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A6'><span>PETZL&reg</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/2012101903591.png' width='427' height='80'></td>
<td><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logo_partners.png' width='100' height='100' align='right'></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>PETZL&reg MYO RXP头灯</b><br />
<br />
PETZL&reg无疑是户外活动使用的LED头灯的市场领导者。它是山地运动、登山和攀岩装备的领先品牌，代表着品质和安全。<br />
<br />
我们Vibram&reg山地越野跑团队的六名"普通人选手"，包括Nicola Bassi、Francesca Canepa、David Gatti、Ronan Moalic、Giuseppe Marazzi和Sebastien Nain，都在他们的"非凡"体验中选择使用PETZL&reg MYO RXP
头灯。 </td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_petzl.png" width="165" height="140"></td>
<td width="20px"></td>
<td valign="top">强大的头灯具有长度调节、程序设置、四级亮度、增亮功能（160流明）和广角照明等特点，适用于长距离照明。<br>
<br>
<a href="http://www.petzl.com" target="_blank">如需了解更多信息，请点击此处&gt;&gt;</a></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff">Vibram&reg 山地越野跑团队<br />
"平凡人成就非凡"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>VIBRAM&reg FIVEFINGERS&reg Spyridon鞋</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='position:absolute; margin-top:125px; margin-left:440px'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<tr>
<td valign='middle'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/2012102112371.png' width='427' height='80'></td>
<td><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logo_partners.png' width='100' height='100' align='right'></td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top"><b>VIBRAM&reg FIVEFINGERS&reg Spyridon鞋</b><br />
<br />
Vibram&reg Fivefingers&reg Spyridon（和Vibram&reg Fivefingers&reg Spyridon LS）是我们的首款山地跑步专用鞋，不仅带来极好的平衡"脚感"，还提供崎岖表面上的跑步保护。<br>
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_ff.png" width="165" height="160"></td>
<td width="20px"></td>
<td valign="top"><ul>
<li>极简的Vibram&reg橡胶鞋底和大胆的底部花纹设计，带来全方位的牢固抓地力，同事保护脚部免受石头和砂砾的冲击，让你更好地感受赤足运动。</li>
<li>自然透气的鞋帮上的钩孔锁紧装置可以随意调节松紧度，使鞋子稳贴舒适。</b></li>
</ul>
<a href="http://www.vibramfivefingers.it/product_details.aspx?model=SPYRIDON" target="_blank">如需了解更多信息，请点击此处&gt;&gt;</a><br />
<br /></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff;">Vibram&reg山地越野跑团队 <br />
"平凡人成就非凡"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
</ul>
<div class="page_navigation" style="display:none;"></div>
</div>
<div class="titolino_giallo"> 
<script type="text/javascript">
                var lan=1;
                if(lan=="1")
    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/photo_video.png'width='141' height='27' />");
                if(lan=="2")
                    document.write("<img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/photo_video-1.png'width='141' height='27' />");
</script>
</div>
<div class="photo">
<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#CCC; padding:30px 0px 5px 40px;">2013Vibram HK100现场图</div>
<div class="photo_testo">
<div style="float:left; width:260px; margin-right:40px;">
<ul id="gallery_1">
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_01_big.jpg' rel='gara' title='2013Vibram HK100现场图  -1/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_01.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_02_big.jpg' rel='gara' title='2013Vibram HK100现场图  -2/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_02.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_03_big.jpg' rel='gara' title='2013Vibram HK100现场图  -3/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_03.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_04_big.jpg' rel='gara' title='2013Vibram HK100现场图  -4/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_04.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_05_big.jpg' rel='gara' title='2013Vibram HK100现场图  -5/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_05.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_06_big.jpg' rel='gara' title='2013Vibram HK100现场图  -6/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_06.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_07_big.jpg' rel='gara' title='2013Vibram HK100现场图  -7/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_07.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_08_big.jpg' rel='gara' title='2013Vibram HK100现场图  -8/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_08.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_09_big.jpg' rel='gara' title='2013Vibram HK100现场图  -9/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_09.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_10_big.jpg' rel='gara' title='2013Vibram HK100现场图  -10/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_10.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_11_big.jpg' rel='gara' title='2013Vibram HK100现场图  -11/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_11.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_12_big.jpg' rel='gara' title='2013Vibram HK100现场图  -12/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_12.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_13_big.jpg' rel='gara' title='2013Vibram HK100现场图  -13/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_13.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_14_big.jpg' rel='gara' title='2013Vibram HK100现场图  -14/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_14.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_15_big.jpg' rel='gara' title='2013Vibram HK100现场图  -15/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_15.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_16_big.jpg' rel='gara' title='2013Vibram HK100现场图  -16/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_16.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_17_big.jpg' rel='gara' title='2013Vibram HK100现场图  -17/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_17.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_18_big.jpg' rel='gara' title='2013Vibram HK100现场图  -18/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_18.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_19_big.jpg' rel='gara' title='2013Vibram HK100现场图  -19/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_19.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_20_big.jpg' rel='gara' title='2013Vibram HK100现场图  -20/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_20.jpg' width='260' height='175' border='0' /></a></li>
</ul>
</div>
<div style="float:left; width:260px;">
<ul id="gallery_2">
<li><a href='http://v.youku.com/v_show/id_XMzM5NTg1MTk2.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/shipin.png' width='260' height='175' border='0' /></a></li>
</ul>
</div>
<div style="clear:both"></div>
<div class="link_sx"><a href="javascript:;" onclick="mostra_archivio()"> 
<script type="text/javascript">
                    var lan=1
                    if(lan=="1")
                        document.write("图片中心");
                      if(lan=="2")
                        document.write("圖片中心");
</script>
</a> - <a href="http://www.youku.com/playlist_show/id_18353966.html" target="_blank"> 
<script type="text/javascript">
                    var lan=1
                    if(lan=="1")
                        document.write("视频中心");
                      if(lan=="2")
                        document.write("視頻中心");
</script></a>
</div>
</div>
</div>
<div class="photo_link"><a href="http://www.youku.com/playlist_show/id_18353966.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/link_youtube.jpg" width="104" height="40" border="0" /></a></div>
<div class="menu_sotto">
<div style="padding-top:5px; text-align:center; font-size:11px;">
<script type="text/javascript">
                    var lan=1
                    if(lan=="1")
                        document.write("2013 Vibram  HK100非凡之队技术合作伙伴");
                      if(lan=="2")
                        document.write("2013 Vibram  HK100非凡之队技术合作伙伴");
</script>
</div>
</div>
<div class="loghi_orizzontali">
<br />
<br />
<br />
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<td style="padding-left:8px; padding-right:8px;"><a href="http://www.lafuma.com" target="_blank" class="effetto"><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/shoe_2.png" width="95" height="35" border="0" /></a></td>
<td style="padding-left:8px; padding-right:8px;"><a href="http://www.newbalance.com.cn/" target="_blank" class="effetto"><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/shoe_3.png" width="85" height="42" border="0" /></a></td>
<td style="padding-left:8px; padding-right:8px;"><a href="http://hi-tec.cn/" target="_blank" class="effetto"><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/shoe_11.png" width="85" height="38" border="0" /></a></td>
<td style="padding-left:8px; padding-right:8px;"><a href="http://www.petzl.com/" target="_blank" class="effetto"><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/shoe_51.png" width="100" height="30" border="0" /></a></td>
<td style="padding-left:8px; padding-right:8px;"><a href="http://www.2xuhk.com" target="_blank" class="effetto"><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/shoe_4.png" width="85" height="42" border="0" /></a></td>
            <td style="padding-left:8px; padding-right:8px;"><a href="http://www.vibramfivefingers.cn" target="_blank" class="effetto"><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/shoe_6.png" width="121" height="31" border="0" /></a></td>
</tr>
</table>
</div>
<div class="footer_logo"></div>
</body>
<script type="text/javascript">
        $(function () {
           var oid=;
                //ADD THE ON CLASS TO THE BUTTON
            $("#contenuto_").addClass('acco_on');
                //OPEN THE SLIDE
            $("#contenuto_").next().slideDown('normal', function () { goToByScroll("contenuto_") });
            
        });
//        goToByScroll("contenuto_4");
</script>
</html>
