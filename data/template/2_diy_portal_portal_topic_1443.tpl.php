<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<title>2013Vibram��۰ٹ���ԽҰ��</title>
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
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot-left1.png' rel='gara' title='��������'>
<div><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot1-.png" /></div>
</a></li>
</ul>
<ul id="box2" class="box_2">
<li style='background:url() no-repeat 0px 21px;'><a href='http://v.youku.com/v_show/id_XNTA4Mjk5NDI4.html' style='text-decoration:none' target='_blank'>
<div><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot21.png" /></div>
</a></li>
</ul>
<ul id="box3" class="box_3">
<li style='background:url() no-repeat 0px 21px;'><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/logot-right.png' rel='gara' title='����鿴2013Vibram HK100����ͼƬ 20/20'>
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
<div class='accordionButton acco_dispari' id='contenuto_18'><span>VFF�׿��ԽҰ����ָЬSpyridon�������100
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-1.jpg" /> </p>
<p> Minimalist����������ָһ�����ʽ����װ������Ʒ�񣬸й��ϼ�Լ���࣬Ʒζ��˼���ϸ�Ϊ���š���Ϊһ�����ʽ��ʱװ��񣬼��������Իع鱾��ͻع���Ȼ��Ϊ�ںš�2013��1��19�գ� Vibram FiveFingers�׿��ԽҰ����ָЬSpyridon����Vibram���100���ﳬ��ԽҰ�ܣ��Ȱ����������ܲ���ʽ�������ٴ������ǵĽŲ��������������޼������

<br />
<br />
�������޼������ڳ����ܲ��顶�����ͻ��ܡ��Ŀ�ƪ��ǣ��������ӡ����¾��������ԡ������ǣ����ڱ��ܵ��˲������º���ĺۼ����������ĽŲ�������һ����ӯ����Ҳ���ܲ��ߵļ���׷��

 <br />
<br />
  �������ͻ��ܡ���Ϊ�����˽�ͷ��ּ��������һ��ͨ����������ͨ����ȥ�����Ƿ��������౼�ܵ��ݱ���˶�Ь���ݻ���ʷ����Ϊ��Ҫ�������౻�����ĳ����˶���ʷ���Ȿ��ĳ�����������֮�д�����һ���˶�Ь�����˳��ĵ���--����/��Լʽ��Ь�ķ�չ���������ⶼ��ȥ�������ļ���ϵͳ���ᳫ�������ˣ�ʹ���Լ���������������ı��ܡ�����Ǽ�������ͼ�Լʽ��Ь�ķ�չ������

</p>
                <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-2.jpg" /> </p>
                        <p>2009���ν����������Ь�ķ�չԪ�꣬��ʱ���а���VIBRAM?���ڵ�10��Ʒ���ṩ���ٵĲ�Ʒ�ͺţ���2012���Ѿ���32��Ʒ���Ƴ���������ϵ����Ь��Ʒ���漰�Ĳ�Ʒ�ͺų���100�����ϡ��ر��Ǽ���ԽҰ��Ь������δ���޴�����ƣ�����2012������������ϵ����Ь��Ʒ�ĸ���������ʾ��2012�꣬����ԽҰ��Ь�ڻ���רҵ��������108������������Ʒ������������208�������ܲ�רҵ��������50����

<br/>
                        <br/>
                        2013��1��19�գ� Vibram FiveFingers�׿��ԽҰ����ָЬSpyridon����Vibram���100���ﳬ��ԽҰ�ܣ�Vibram Fivefingers Spyridon��Spyridon LS��Vibram�׿��ԽҰ����ָЬ�������������õ�ƽ��&quot;�Ÿ�&quot;���������·���ṩ������Ь�����Ҭ���Ƴɵĵ��������뿹ĥ���Ծ�������������֯���VFF������Ь�����ĥ��ǿ�ȸ��󣬱������˫��������������м��ʴ�� <br/>
                      </p>
                        Vibram Fivefingers Spyridon��Spyridon LS.

<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-3.jpg" /> </p>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-4.jpg" /> </p>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-5.jpg" /> </p>
<p>
                        Spyridon����3.5���׼���Vibram�𽺴�ף����ηֶ��и������˫�Ÿ����������µ�VIBRAM 3D COCOON��������ģ��������������һ������&quot;��ʯ��&quot;���ڼ���������ͬʱ�����ܷ�ֹ����ʯ·���ϴ̴�Ь�ף���ɢЬ��ѹ����Spyridon�ṩ360�ȿɿ���ץ������ȫ��λ���ι�ץ���������Ų�����ʯͷ��ɰ���ĳ����Spyridon������з��׶���Vibram�й������з����Ľ����˳���һ�����ϵĲ�Ʒ���ܲ��ԣ����а���ʵ���Һ��ܵ����ԣ���νƷ�ƶ����з��ĳɹ���Vibram FiveFingers?�Ƿ��ļ���Ǳ�ܵõ��˼�����֤����������һЬѥ���������ʵ�������ư�ȫ��������Ʒ�ʵľ��Դ��ԡ� <br/>
                        <br/>
                        Spyridon�ֲ���KSO Trek�Ĳ��㡣��ȻЬ�׺��ͬ��Ϊ3.5���ף��ڲ�������Լ�Ե�ǰ���£����������Ժ�ץ������ǿ������100������ิ��·��Ŀ��飬�������߿��ܺ����ҵ�Spyridon�޷������ԽҰ·�档��Ȼ͸����Ь���ϵĹ�������װ�ÿ�����������ɽ��ȣ�ʹЬ���������ʡ�Spyridon���ϻ�е��������װ�����ǿ�����գ���Ȼ��KSO Trek���أ�����ԽҰ��Ь��������ܶࡣ

</p>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang5-6.jpg" /> </p>
                       <p>Vibram FiveFingers Spyridon��ΪԽҰ�ܶ�����</p>
  </div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>VIBRAM�Ƿ�֮�Ӽʻ��㽭 ����ԽҰ�ܼ���̽�ձ�ɫ
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang4-1.jpg" /> </p>
<p>Vibram��ȫ������һָ�ĸ�������Ь�������̣��Գ���70��������������Ϊ������ʻ��⼰�˶�Ʒ���ṩרҵ�����˶�Ь�ס�Vibram�Ƴ继��̽�յľ������ս�������ܵļ�ֵ�ۣ����ڽ�������ǿ��������ԽҰ���˶��� <br />
<br />
��2007�꿪ʼ��Vibram��������������ģ�������Ӱ�����Ļ����ʷ峬��ԽҰ�ܣ�UTMB����Vibram�����Ŷ�ԽҰ���˶�Ա���ŷĬ(Marco Olmo) ��58���������2006��/2007������UTMB�ھ�����ΪUTMB��ʷ�ϵľ�����¡�

 <br />
<br />
  ��2010�꿪ʼ��Vibram��Ӳμ�UTMB���������VibramԽҰ��ЬЬ�׵�HI-TEC��SAUCONY��LAFUMA��NEW BALANCE��Ʒ�ƺ�����ΪVibram UTMB�Ŷ��ṩ�����ܵ�ԽҰ��Ь����Ϊѡ���ṩǿ��ĺ��ڱ��Ϻ�֧�֡�Vibramϣ��ͨ������UTMB���Ӵ��ԽҰ���˶����ƶ���Vibram UTMB�Ƿ�֮�ӳ�Ա���Ƕ����ܲ����֣����������Բ�ͬ���Լ��Ļ����������������˱����������⣺ƽ����������Ƿ����£��Լ�Vibram����ͻ�Ƶľ���

</p>
                <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang4-2.jpg" /> </p>
                        <p>2012�꣬Vibram UTMB�Ƿ�֮����Lavaredo����ԽҰ�ܡ������ʷ峬��ԽҰ�ܺ�TDG����֮·��������������ȡ������ɼ�--Francesca Canepa���Lavaredo����ԽҰ��Ů�ӹھ���UTMBŮ���Ǿ���TDG����֮·Ů�ӹھ���Ronan Moalic���UTMB�����ӵ�20����Francesca Canepa��һ�����룬ͬʱҲ��2λ���ӵ�ĸ�ס���żȻ��ʶԽҰ�ܣ�����Vibram UTMB�Ƿ�֮�ӣ�Ѹ���Ȱ�����ԽҰ���˶��������ֳ����ߵ��츳��Francesca Canepa���UTMBŮ���Ǿ�Ҳ��Vibram�����ƹ�ԽҰ���˶������˶�ɹ������֤����

<br/>
                        <br/>
                        2013 Vibram���100���ﳬ��ԽҰ����Vibram UTMB�Ƿ�֮�Ӻ�Vibram HK100�Ƿ�֮����֧�����״���ͬһ�����о�����ר�Ŵ������ǰ����Vibram�����Ь���Ʒ�г��ܼ�Jerome BernardҲ���Բ������������£����Դ˴εľ���ӡ����̲�����������Vibram֧��ƽ����ͻ�Ƹ��˼��ޣ���÷Ƿ��ɾ͡�û���κ�����ȿ������������ǳ��Vibram���100���յ��߸��Ƿ����ˡ����ֹ�԰�����գ��ҿ��������꣬����֮��Ļ���֧�ֺ͹���������ӡ����̡�

<br/>
                        <br/>
                        ����Vibram UTMB�Ƿ�֮���״����۳�����Nicola Bassi���Լ��ĳɼ��е����⣬ȫ����ʱ11ʱ40��42�����ڵھ���������ʾ�������ҵ�һ������۱�������ϣ���ܹ��Խ���ǰ20�������ڻ�õ�9�Ѿ�����Ԥ�ڡ���һ���ܾͺ�������ϣ�����������ߣ���۵ı�����ŷ�޵ı������ܲ�ͬ����������̨��Ҫ�����ر���ɽ·�θе��ǳ�����������ܱ�ס��9���Ҹе��ǳ����ġ�

<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang4-3.jpg" /><br/>
                    Bassi�Ķ��ѡ����Է�����Sebastien Nain��12ʱ30��43������ȫ�̡� <br/>
                    <br/>
                    Vibram HK100�Ƿ�֮����۴��������������ܣ���13ʱ12�ֵĳ�ɫ�ɼ���ɱ�������31��������£���ס����۵�Joel LaBelle��17Сʱ7�ֵ����յ㣻�����ڵص�����ƽ��18ʱ18�ֳ���յ㣻Vibram HK100�Ƿ�֮���ɳ�����Ů���ֲμӽ�α����������ٴβ������������ܳ�23Сʱ32��55��ĳɼ���Linds Russell�����¿�ʼ���������˳�������

<br/>
                    <br/>
                    2013 Vibram���100���ﳬ��ԽҰ�����£�Vibram�Ƿ�֮�ӵĶ�Ա�������ǶԳ���ԽҰ���˶�������;��飬���ڶ�ԽҰ�ܰ����߷���ʹ�����˿�ʼ�Ȱ�������ԽҰ���˶����ջ���ս���ң�������Ȼ����Ȥ��<br />
            <br/>
 
                        
 </p>
    </p>
  </div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>�����졸Vibram ���100������ �й��������G�ź���Сǿ�ư�
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
  <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-1.jpg" /> </p>
<p> ��2013��1��20��: ��ۡ��й��������G����10Сʱ16��6��ĳɼ����2013�꡸Vibram���100�����¹ھ�����ȥ�������˻�����δ�ܲ�������۱��س���������Сǿ�����ձ��ֳ�ɫ������������Ǿ���

<br />
<br />
�ڵڶ����������У���Сǿ�����ʱ�̸ϳ��Ჴ������Ram Kumar Khatri������10Сʱ19��43��ĳɼ�����Ǿ������ȵ�������Ram Kumar Khatri��16�롣

 <br />
<br />
  ���G�Ŷ�Ӯ�����¸е��˷ܣ����Һܿ�����Ӯ���ر�����һ���ҷ��ӵò��Ǻܺá�����������кܶ���������߲������Ჴ����ѡ����һ���������ȣ��Ҳ�ȷ���Լ��Ƿ��л�����Ի�ʤ�������ҵ�����վ5��ʱ�򣬷���Aite ��RamҲ����ٶȣ���֪���Լ����л��ᡣ�����ܹ�����ˮ����ʱ��о��ǳ��ã���һֱ���ֵ��յ㡣��

</p>
                <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-2.jpg" /> </p>
                        <p>��ǰ���һֱ���ȵ�Aite Tamang�����ܵ��龷���ţ���Andrew Tuckey��Jeremy Ritcey֮������Ե�������ɱ���������Vibram�Ƿ�֮���״����۳�����Nicola Bassi�Ǵ������������Vibram���������е�һ�������յ�ģ�ȫ����ʱ11ʱ40��42�룬���ڵھ�����Bassi��UTMB�Ķ��ѡ����Է�����Sebastien Nain��12ʱ30��43������ȫ�̡�

<br/>
                        <br/>
                        ����������۲�����Bassi���Լ��ĳɼ��е����⣺�������ҵ�һ������۱�������ϣ���ܹ��Խ���ǰ20�������ڻ�õ�9�Ѿ�����Ԥ�ڡ���һ���ܾͺ�������ϣ�����������ߣ�������ر���ɽ·�Σ��Ҹе��ǳ�����������ܱ�ס��9���Ҹе��ǳ����ġ���

<br/>
                        <br/>
                        Vibram�Ƿ�֮�ӱ��ش���Ҳ�Գ�ɫ�ĳɼ���ɱ������������������ܣ�������ӥ������13ʱ12��39�룬��31��������¡���ס����۵�Joel LaBelle, �ֳơ� Jogger Joel ����20���賿1ʱ�󵽴���ֹ�԰�������ڵص�����ƽ, ���� ��King Jump������18ʱ18��39�룬��Joel֮��75����n���յ㡣

<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-3.jpg" /> </p>
<br/>
                        <br/>
                        Ů�������·��棬�����۵�Ӣ��������Claire Price��ȫ�����ȵ���̬Ӯ�ñ���������11ʱ58��4��ĳɼ�����Ů�����¼����ȥ����΢����������Ǿ���Price�Դ˴λ�ʤ�ر����⣺���ҷǳ����ģ�����һ��������ֱ������ǰ��ȷ�ϲ�������û��̫���ڴ�����һ�����Ҿ͸о����ã�ɽ·Ҳ�������˳��Ӯ�ñ������� <br/>
                        <br/>
                        Vibram�Ƿ�֮�����ɳ�����Ů���ֲμӽ�α����������ٴβ������������ܳ�23Сʱ32��55��ĳɼ���Linds Russell�����¿�ʼ���������˳�������

<br/>
                        <br/>
                        �����ʼ���ȥ���õڶ�ʱ�Ĳ�֮ͬ����Price��Ӧָ�����Ҿ��ý���Ĳ��Ը��Ӻã�Vibram���100�ĺ����кܶ�ɽ·��ȥ�����ڿ�ʼ��Щ̫���������������Ƚϳ������������������ܷ���ܺá���
<br/>
                        <br/>
                        Vibram(�����)�г�����Ѷ�ܼ�Jerome Bernard������������£����Դ˴εľ��vӡ����̲�������������Vibram֧��ƽ����ͻ�Ƹ��˼��ޣ���÷Ƿ��ɾ͡�û���κ�����ȿ��������������n����Vibram���100�����յ��߸��Ƿ����ˡ����ֹ�԰�����գ��ҿ��������꣬����֮��Ļ���֧�ֺ͹���������ӡ����̡���

<br/>
                        <br/>
                        2013�꡸Vibram ���100����������30�����Һ͵�����1225�����ֲ���������217����Ů�ԡ�ȫ�������У���666����ס����ۺ�245�������й��ڵأ���������ѡ�����԰��ޡ�����ʱ�����ô󡢷������������¹���˹�工�ˡ�����������ʿ����䡢�ж���Ӣ���������ȡ� <br/>
                        <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang1-4.jpg" /> </p>
                        
                        <br/>
                        ���Vibram

<br/>
                        <br/>
                        Vibram�Ǹ�������Ь�׵�ȫ���쵼Ʒ�ƣ�ҵ�񺭸ǻ����˶������������f��ʱ�С�ά�޺ͽ��ε�Ь���г���70����������ɫ�˽��εı��I�Ѿ������������ܡ���ȫ�����µĴ���ÿ��Vibram��Ь�׶�����߰�ȫ�ͱ������� ���µ������ǳ���������з��봴�µĳɹ�����ʵ��֤�����������ļ���̽���У�Vibram�ɞ鲻�ɻ�ȱ��һ���ݡ�ͬʱ�ཫ���µ����ע��ʱ��Ь���С�ÿ��Vibram���®aƷ��ʹ��������Ƽ���õ�ԭ�ϣ���Ը�����;�u��������Vibram �����Ŷ���ʵ�����Լ����鳡ִ�и����ϸ���Ժ��Ƴ��г���ȷ������������ܣ���������Լ������ʡ�

 <br/>
                        <br>
                        
 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>2013 Vibram���100��܊�Q��
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
  <div class='acco_contenuti'>
      <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang2yun.jpg" /> </p>
      <p>���������G�Ż��2013��Vibram���100������ھ�</p>
<p>�й��������G����10Сʱ16��6��ĳɼ����2013��Vibram���100���¹ھ�����ȥ�������˻�����δ�ܲ�������۱��س���������Сǿ�����ձ��ֳ�ɫ������������Ǿ��� <br />
<br />
Ů�������£������۵�Ӣ��������Claire Price����һ·���ܣ��������Ƽ�¼��11Сʱ58��4���õ�һ��</p>
                      
   <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang2-2.jpg" /></p>
               <p>��۱��س���������Сǿ���2013��Vibram���100�������Ǿ�</p>
               <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang2-3.jpg" /></p>
               <p>2013��Vibram���100Ů����ھ���Claire Price���</p>
               <p>���Vibram<br>
               <br>Vibram�Ǹ�������Ь�׵�ȫ���쵼Ʒ�ƣ�ҵ�񺭸ǻ����˶������������f��ʱ�С�ά�޺ͽ��ε�Ь���г���70����������ɫ�˽��εı��I�Ѿ������������ܡ���ȫ�����µĴ���ÿ��Vibram��Ь�׶�����߰�ȫ�ͱ������� ���µ������ǳ���������з��봴�µĳɹ�����ʵ��֤�����������ļ���̽���У�Vibram�ɞ鲻�ɻ�ȱ��һ���ݡ�ͬʱ�ཫ���µ����ע��ʱ��Ь���С�
ÿ��Vibram���®aƷ��ʹ��������Ƽ���õ�ԭ�ϣ���Ը�����;�u��������Vibram �����Ŷ���ʵ�����Լ����鳡ִ�и����ϸ���Ժ��Ƴ��г���ȷ������������ܣ���������Լ������ʡ�
<br>
               
                
                
  </div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>2013��Vibram���100����˕r�_��
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang3-1.jpg" /> </p>
                    <p>2013��Vibram���100�����ʱ����</p>
<p> ��۱�������100���������¡�Vibram ���100������춽�������8ʱ�ڱ�̶ӿ���ܡ�����������30�����Һ͵����ĳ���1300������ѡ�ֱ�������������ȫ�̽�;��������羰���������������̡�ˮ��ɳ�׵ĺ�̲����ľ���֡���ȻԶ�㾶��ˮ���Ͷ���ɽ���ȡ�</p>
                  <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang3-2.jpg" /> </p>
                  <p>30�����Һ͵����ĳ���1300������ѡ�ֲμӽ�����</p>
                  <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/wenzhang3-3.jpg" /> </p>
                  <p>Vibram UTMB��Ա-����е�Nicola Bassi���󣩡�������Sebastien Nain���ң���Vibram(�����)�г�����Ѷ�ܼ�Jerome Bernardһͬ�μ�2013��Vibram���100����</p>
                  <p>���Vibram</p>
                  <p>Vibram�Ǹ�������Ь�׵�ȫ���쵼Ʒ�ƣ�ҵ�񺭸ǻ����˶������������f��ʱ�С�ά�޺ͽ��ε�Ь���г���70����������ɫ�˽��εı��I�Ѿ������������ܡ���ȫ�����µĴ���ÿ��Vibram��Ь�׶�����߰�ȫ�ͱ������� ���µ������ǳ���������з��봴�µĳɹ�����ʵ��֤�����������ļ���̽���У�Vibram�ɞ鲻�ɻ�ȱ��һ���ݡ�ͬʱ�ཫ���µ����ע��ʱ��Ь���С�ÿ��Vibram���®aƷ��ʹ��������Ƽ���õ�ԭ�ϣ���Ը�����;�u��������Vibram �����Ŷ���ʵ�����Լ����鳡ִ�и����ϸ���Ժ��Ƴ��г���ȷ������������ܣ���������Լ������ʡ�</p>
                  
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>׷����Դ ���ڳ����ܺͼ���������Ь������
</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/paoxie.jpg" /> </p>
<p> �����ܲ��顶BORN TO RUN���У���ƪ����������ӡ����¾��������ԡ����������޼������ڱ��ܵ��˲������º���ĺۼ����������ĽŲ�������һ����ӯ����Ҳ���ܲ��ߵļ���׷��

<br />
<br />
2003�꣬����Ϊ������С��ű�ŦԼʱ����־��ǲ��������ī�߾���ע�⵽ī����߾���ΪTarahumaraԭס���С���£���һ����û���ִ�����̰�ۡ����֡�ҩ���ж�����Ʒ���ġ���ͥ��������ͯŰ�������ಡ��Ѫѹ����ᡢҽѧ���⣬��Ȼ��û�ж�����̼�ų��Ļ������⡣����Ȥ������һ����55����˿����ܵñ�ʮ����Ŀ죬��ʮ�����������ʱ���Է���һ�������ɾ����ɽ·��������ļ��䣬��Դ�Կ������ǺȾƵ�������Ȼ��ʼ���ܣ�������ܲ�����2Ӣ�Ҳ������2Сʱ��������2������ ! ����һ����������Ļ������ɲ��Ǽ���ƽԭ����޴��ԭ�����Ǹ߷����࣬��֮ΪͭϿ�ȵ��ն���Ρ����������߶���Tarahumaraһ�����ǿ�ҵĺ�������Ȥ�����ǵ�������ѧ����ʳ��ʽ���������ܣ���������ʷ�ϵĴ����š��������������ͭϿ�ȣ��������ȥ�Ϳ��Խ���ģ����˵����Ͼ�����ī�߾��Ķ��ɺ����⣬Tarahumara ����Ҳ�Ǻܺ��ߵ����壬���ǲ������㿴��ʱ������㾭�����Ǵ��ӣ���Ҳ��֪��������������֮�䣬���Ǿ���������ء�

 <br />
<br />
��BORN TO RUN����Ϊ�����˽�ͷ��ֳ����˶���һ��ͨ����������ͨ����ȥ�����Ƿ��������౼�ܵ��ݱ���˶�Ь���ݻ���ʷ����Ϊ��Ҫ�������౻�����ĳ����˶���ʷ���Ȿ��ĳ�������������֮�д�����һ���˶�Ь�����˳��ĵ�����������/��Լʽ��Ь�ķ�չ��������VFF��ֺЬ�������Ϳ˵�FREEϵ�У��ֻ���ECCO��BIOM���������ⶼ��ȥ�������ļ���ϵͳ���ᳫ�������ˣ�ʹ���Լ���������������ı��ܡ�

</p>
                        <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/paoxie2.jpg" /> </p>
                        <p>����ǳ������˶��ͼ�Լʽ��Ь�ķ�չ������

<br/>
                        <br/>
                        MERRELL�����֣�Run--������Ь�����������ı����·�չ�����ģ����ҳ�Ϊһ���ǳ��ܻ�ӭ�ĳ����˶�ϵ�в�Ʒ�����β��ԣ��Ҳ��Եľ����������ͺ�Merrell Trail Glove��

<br/>
                        <br/>
                        ���ڳ����ܲ�Barefoot Run�ͳ���ԭ��

<br/>
                        <br/>
                        �����ܲ��ĺô�һֱ���õ���ѧ�о������֧�֡��������ᳫ����ʹ���������˶�����ǰ������أ��Ŵ��ص�λ��ֱ�����ܲ��������·����Ӷ����ָ�ƽ�⡢���ȶ������ٳ���͸�����ƶ������ϱ���Ь���ܲ�ʱ�ĸйٷ�����������Ժ�ƽ���ԣ�������ʱ�������ˡ����⣬���ܴ̼���ǿ���Ų���С�ȵļ��⡣��˫��˳�ű��ܵ��ߡ��ܡ��������ǳ����˶�����Ƹ���Գ������������������˫��ͨ����ֱ�ӵؽӴ����桢��ֱ���ش��������Ժ��ٶȸУ�ͬʱ�ﵽǿ��ѵ���Ȳ�����ȫ���⡢�Ըı������������˶��˺��Ŀ����ԡ�

<br/>
                        <br/>
                        ���ڼ�Լ��ЬMinimalist���������:

<br/>
                        <br/>
                        1.Zero-drop Sole����������Ź��򲿣�ǰ���Ʋ�λ) ����ͬһˮƽ�棬Ь�ײ����񣬶���ֺ������Ϊ����ʹ�ܲ�ʱ�Ź����������ŵء�
<br/>
                        <br/>
                        2. Limited Support�������޵�֧�š��򻯵��е׻����е���ơ�

<br/>
                        <br/>
                        3. Wide Toe Box�����ӿ��Ьͷ���ܸ��ø���ץ�ء���ȴ�ͳ��Ь��Ьͷ����Լ��Ь�����мӿ�Ľ�ֺ��λ��ƣ�ʹ�Ų����и��õ�ץ�غͽŸС�

<br/>
                        <br/>
                        4. Flexible��������������������Ь�ӡ�

<br/>
                        <br/>
                        5. Lightweight����������ͨ����ֻ�����ᳬ��200�ˡ�

 <br/>
                        <br>
                        <a href="http://www.8264.com/viewnews-82374-page-1.html" target="_blank">����>></a>
 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>Vibram&reg ���ʶ���ԽҰ���߻���㽭 һ����Ѯ���ݳ�����������</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/dingjian1.jpg" /> </p>
<p> ������3���Vibram&reg ���100���ﳬ��ԽҰ�������ھٰ��3��֮�ʣ�ӭ�������·�չ�ĵ�һ���߳�����ͳ�ƣ�����30�����Һ͵����ĳ���1200��ԽҰ�ܰ����߱����μ�2013 Vibram&reg ���100���ﳬ��ԽҰ�ܣ����ű�����48Сʱ������������Vibram&reg  UTMB�Ƿ�֮�ӽ���Vibram&reg ���100�Ƿ�֮����ʷ�Ի�ʦ����Vibram&reg UTMB�Ƿ�֮�Ӷ�ԱNicola Bassi��Sebastien Nain��Vibram������г��ܼ�Jerome Bernard��ǰ���μ�2013 Vibram&reg ���100��<br />
<br />
����2013 Vibram&reg ���100���ﳬ��ԽҰ��������֯���ṩ��������ʾ��2013 Vibram&reg ���100���ﳬ��ԽҰ�ܲ�����������1200�ˣ���۱���ѡ�ֱ�����ߣ��ֱ�ռ��Ů�����ߵ�37%�����ԣ���28%��Ů�ԣ����й��ڵ���ѡ��190�ˣ�Ůѡ��30�ˣ��ֱ�ռ��Ů�����ߵ�19%�����ԣ���14%��Ů�ԣ��� <br />
<br />
��Ȼ��۵���֮���˿��ڶ࣬�����ǿ�չԽҰ�ܵ�������򣬵���������Ȱ���Ȼ���Ȱ��˶��������Զ������Ľ�Ұ�����ʺ�ͽ����ԽҰ�ܵ�·�ߡ�����������ͽ��·����Ϊ�����������С��50�������ɽС��70����,����ѷС��78����, �����С��100���ÿ������·���ϵĸ���ͽ����ԽҰ�ܱ���������ʮ����Vibram��Ȼ��۵���֮���˿��ڶ࣬�����ǿ�չԽҰ�ܵ�������򣬵���������Ȱ���Ȼ���Ȱ��˶��������Զ������Ľ�Ұ�����ʺ�ͽ����ԽҰ�ܵ�·�ߡ�����������ͽ��·����Ϊ�����������С��50�������ɽС��70����,����ѷС��78����, �����С��100���ÿ������·���ϵĸ���ͽ����ԽҰ�ܱ���������ʮ����Vibram?���100���ﳬ��ԽҰ��������׸�����100�������¡����100���ﳬ��ԽҰ��������׸�����100�������¡�<br/>
                        <br/>Vibram&reg UTMB�Ƿ�֮�Ӷ�ԱNicola Bassi��Sebastien Nain��Vibram�����Ь��ȫ���г��ܼ�Jerome Bernard��ǰ���μ�2013 Vibram&reg ���100���ﳬ��ԽҰ�ܣ����ǽ���Vibram&reg ���100֮�ӵ���λ��Ա������ս����ս100�������;��<br/>
                        <br/>���˽⣬2012����������ߵı��ؾ�Ӣѡ�ֽ�Ϥ������2013 Vibram&reg ���100���ﳬ��ԽҰ�ܡ����а���Ŀǰ����������ԽҰ����֮һStone Tsang����Сǿ������Сǿ��������������ܽ�������������۸���ԽҰ�������ϴ����¼�⣬����2010 UTMB�����������ʷ峬��ԽҰ�ܣ���õ�21������Ҳ���й�ѡ���ڴ��������е�������Σ�������3�βμ�Vibram&reg ���100��Jeremy Ritcey�����Žϸߵľ���ˮ׼����2011���2012�������зֱ��õ�2�͵�4�����������2012 �ձ�UTMF������ʿɽ����ԽҰ�ܣ���STY�� (85����) ��4����2012���ô�Death Race�Ǿ���William Davies ���2011 Vibram&reg ���100���ﳬ��ԽҰ�ܹھ���2012�����»�õ�6������Ҳ��ʵ����Ⱥ��ǿ���������ߡ�
                        
                        </p>
</div>
</div>
<div class='ico_2'></div>
</li>
        <li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>Vibram&reg2013 ���100ԽҰ��ѵ��Ӫ�ھ��������ؾ���</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
                    <p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/xunlian1.jpg" /> </p>
                    <p>����100λ�й���½ԽҰ�ܰ����߱���2013 Vibram&reg���100���ﳬ��ԽҰ�ܣ�Vibram&reg Hong Kong 100km Ultra Trail Race������Ϊ�������µĹ��������̣�Vibram&reg ���ǵ�����������������Ŀǰ�й�����Ѷȵļ���ԽҰ�����¡�����ƽ���Ĳ�����ͨ����������飬��ս�ۼ�4500�׵ĸ߲�Ͳ���Ԥ����ƣ�͡���ʹ�����ѣ�����ʵ��һ���Ƿ������롣<br/>
<br/>�Ƽ�������ض������ߵ�Vibram&reg ���100���ﳬ��ԽҰ�ܽ���2013��1��19�սҿ�սĻ�����ǵ������й���½����������˼���100������ս��Ϊ��Vibram&reg�ر����ڱ��������ݺ��Ϻ����ؾٰ�2013 Vibram&reg ���100����ԽҰ��ѵ��Ӫ��ԽҰ��ѵ��Ӫ��������ص㣬���뾭��ḻ�����߽��ⳤ��������������Ұ���ܲ�������ҳ�ֽ�����ǰ�������·���ѽ�����ս�ĵá�<br>
<br>2013 Vibram&reg ���100����ԽҰ��ѵ��Ӫ����Ϣһ�����������ܵ���ԽҰ�ܰ������ǵ����һ�ӭ����2013��12��12-13�վٰ��VIBRAM���100ԽҰ��ѵ��Ӫ���������ؽ����У�����100λԽҰ�ܰ��������ֳ����������������ߵľ�������ѵ�����飬�⽫�����ǵĜʱ���������������12��15�գ�2013 VIBRAM���100ԽҰ�ܱ���ѵ��Ӫ��20��λ������ѩ�����ɽ�����Ŷ�������������������μӴ���ͽ�����Ϊѵ����12��22�գ������ǵ��������ѽ��ں���������ɽ����ɽ·�Q����VIBRAM���100ԽҰ���Ϻ�ѵ��Ӫ����ǰ��ѵ��<br/>
<br>2013 Vibram&reg ���100����ԽҰ��ѵ��Ӫ�Ļ���к���ȫ�����������˸������ѵĺ�Ӧ�����ڴ����ٰ�Vibram&reg ���100����ԽҰ�ܵķ���ᡢ��������֯�˳�����ҹ��ԽҰ���������ԽҰ�ܰ����������������Դ����µ����١�<br/>
<br>Ϊ���ø����ԽҰ�ܰ��������л�������ԽҰ�ܵ���Ȥ�Ͳ���Vibram&regԽҰ��Ь���u��Ĳ�Ʒ��Vibram&reg����HI-TEC��LAFUMA��NEW BALANCE���ڱ��������ݺ��Ϻ�������֯VibramЬ�׸�����ԽҰ��Ь�������������Դ�������LAFUMA��HI-TEC��NEW BALANCE��Vibram&reg Fivefingers�ĸ�����ԽҰ��Ь���������ѻ����μ�VIBRAMЬ�׸�����ԽҰ��Ь����������
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
<div class='accordionButton acco_dispari' id='contenuto_20'><span>Vibram&reg�˶�Ա�μ�2012�껷���ʷ弫��������</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>����Vibram&reg�˶�Ա���μ�������Ҫɽ��ԽҰ�����µ�10������ף�ܡ�<br />
<br />
��2007����Vibram&reg���Ϊ�ø�ʢ������˹��˹��The North Face&reg�������ʷ弫�������ܣ�Ultra-Trail du Mont-Blanc&reg���Ĺٷ�������顣��2011�꣬Vibram&reg�ɳ��Լ��Ķ����������ǿ�������е��ع��ʡ�<br />
<br />
Vibram&reg������ͨ��Ҳ�ܳɾͷǷ������UTMB ����Ʋ��ʷ�ɽ�����е���46Сʱ�ڿ�Խ�������ң����������������ʿ���Ĵ������¡�<br />
<br />
���꣬���Ż����ʷ弫�������ܣ�UTMB&reg��10����֮�ʣ�Vibram&regѡ��6λԸ����Բ��ʷ���ս���˶�Ա������Ŷӣ���8��27�տ�ʼ��Nicola Bassi��Francesca Canepa��David Gatti��Giuseppe��Beppe��Marazzi��Ronan Moalic��Sebastien Nain���Vibram&regһֱ���еļ�ֵ�ۣ��Ȱ��˶����ŶӾ����Լ�������Ȼ���������ȫ��168����������С�<br />
<br />
Ϊ���ܹ�ֱ��The North Face&reg�����ʷ弫�������ܣ�Ultra-Trail du Mont-Blanc&reg�����µ������;��Vibram&reg 2012��ɽ��ԽҰ���Ŷӵ��˶�Ա�ǽ��ᴩ����Vibram&regЬ���ṩ�����ĸ߿Ƽ���Ь������ͬʱ�����䱸���ֶ���װ����ȷ��ȡ�á��Ƿ����ı��֡�<br />
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_19'><span>The North Face&reg Lavaredo����������</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'> <b>The North Face&reg Lavaredo���������ܣ�Vibram&reg2012��ɽ��ԽҰ���Ŷӵĳɹ������㡣</b><br />
<br />
�ڸչ�ȥ����ĩ��6��29��-7��1�գ���Vibram&reg 2012��ɽ��ԽҰ��6���Ŷӵ��е���λ�˶�Ա������Laveredo���������ܵĳ������ϡ�����һ����������İ���ʯɽ�����ľٰ�ĳ���120����/6.000�׵����¡�Vibram&reg��Ϊ���µ���Ҫ�����̣������Ŭ������������Լ�����״̬��õ��˶�Ա��Sebastien Nain��Giuseppe Marazzi��Francesca Canepa��Nicola Bassi��Ronan Moalic��Lavaredo���������ܿ���ʱ������ϣ�����յ�ȡ�����˿��ľ�ϲ�ĳɼ������˵�David Gatti���ò�������������<br />
<br />
���Ľ����ȷ���˾�ϲ�������¿�ʼ���м���Сʱ��Vibram&reg�ġ�ƽ��ѡ���ǡ���û�б���ͷ�����˦����Զ����Ȼ��Iker Karrera��S��bastien Chaigneau��ɽ��ԽҰ�ܹھ�ѡ�ֵĽ��඼�ܿ죬��Vibram&reg�Ŷ���Ȼ���Ա����Լ��������ͼ���������<br />
<br />
������ʱ�֣������������������䶨�������������һ�̣�Karrera��Chaigneau��һ������յ��ߣ�Ӯ�ùھ���<br />
<br />
���˾�ϲ���ǣ�Vibram&reg�Ŷ����������������ȹ��Ǿ��������λ������ɼ��ǳ����ˣ�<br />
<br />
<ul>
<li>Ronan Moalicȡ�õ�8��</li>
<li>Giuseppe Marazziȡ�õ�9��</li>
<li>Francesca Canepaȡ�õ�10������������λ�����յ��Ů��ѡ��</li>
<li>Nicola Bassiȡ�õ�11��</li>
</ul>
</b><br />
���⣬Francesca��NicolaЯ��ͨ��Cortina�յ��ߣ����ǽ�������<br />
<br />
����Vibram ɽ��ԽҰ���Ŷ����ԭ���������ܲ���ȤΪĿ��Ķ�����˵��Francesca Canepaȡ��Ů�����һ���ĳɼ���һ���Ƿ������顣���⣬FrancescaӮ�õĻ����Ȳ�֤�����˶�Ա�ǳ��ڵ��˸�Ͷ��˶����Ȱ��������Լ������������͡�<br />
<br />
�ܶ���֮�����ǵ�Lavaredo���������ܵļ���ص��Լ�����ѡ���ǵĸ�ˮƽ��Vibram&reg 2012ɽ��ԽҰ���Ŷ��ڴ�������ȡ�õı��ֳɼ��Ƿǳ�����ġ�<br />
<br />
Vibram&reg��л�Ŷӵ����м���������飨���������ᣨSaucony�����ַ�Ҷ��Lafuma����Scott���°��ף�New Balance����Garmin���շ壨Camelbak����������Petzl����Julbo��Compressport��Antaflex��Polartec����û�����ǵ�֧�֣���μ������ĵľ����Ͳ����ܻ�ʵ�֡�<br />
<br />
Vibram ɽ��ԽҰ���ŶӼƻ��μӵ���һ�������ǽ�������8��27����9��2�վ��е���˹��˹��The North Face&reg�������ʷ弫�������ܣ�Ultra-Trail du Mont-Blanc&reg����</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_18'><span>Vibram&regɽ��ԽҰ���ŶӲμ�Lavaredo���������ܣ�LUT������</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p> <img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014142908_2952.jpg" /> </p>
<p> �ڸչ�ȥ����������ʿ����Ү�����꼼��ѵ����ȫ�µ�Vibram&regɽ��ԽҰ���Ŷ�������װ������׼���μ�2012���Ŷ��ճ��ϵ�������Ҫ����֮һ--��˹��˹The North Face&reg��Lavaredo���������ܡ�<br />
<br />
��6��29�յ�7��1�գ��ڣ������������ŵ���ƶ����ɵ�������Cortina d��Ampezzo�������˾�ɫ�У�Vibram&regɽ��ԽҰ���Ŷӵ�5���˶�Ա��Nicola Bassi��Francesca Canepa��Ronan Moalic��Giuseppe Marazzi��Sebastien Nain��
��ӹ�ȥ�ꡰ�Ƿ����¡��Ľ�����������׼��������ȫ�µı�������ܡ� <br />
<br />
��˹��˹The North Face&reg��Lavaredo������������һ������ܲ����£�����Ҫ���118�����������ͨ���ܹ�5,740�׾��Ժ��θ߶ȣ���ͬʱҲ�����������������ʯɽ��������Ϣ�����η�⡣ </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_11'><span>Nicola Bassi�ķ�̸</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc4Njcy.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014143912_1087.jpg" />
<p> <b>Nicola��������ʲô�ģ�</b><br />
����һ���˶���Ʒ���������꣬Ȼ���ְȥ�μӴ������г����С����ﳵ��Խ�˰���͢������40�Ź��ҹ�·����La Quiaca��Ushuaia��ȫ��6000������ڣ���������һ���µĹ������ϰ�ʱ

��Ҫ�ʺ�����ȥ�������˶��� <br />
<br />
<b>��ɼ�������ʲô��Ȥ������</b><br />
�һ�û�н�飬Ҳû�к��ӡ������ҿ��԰��ҵ�ȫ��ʱ��Ͷ�뵽�˶��С��Ҿ��������г���ֻҪ��ʱ�䣬�Ҿͻᵽɽ���ﳵ�� <br />
<br />
<b>���Ǵ�ʲôʱ��ʼ�ܲ����أ�ΪʲôҪ��ʼ�ܲ��أ�</b><br />
��������ϵ��ǵ�ɽ�����ҿ�ʼ�ܲ�ֻ��Ϊ�˱�������ȥ��ɽ�����ҿ�ʼҪ����ĩ�������Ҳ��ò������µĹ������ȥ��������һ���˶�����ɽ��ԽҰ�ܲ�ʹ���ܹ��͸�ɽ���ֽӴ���ͬʱ

����ӭ���ҵ�����Ȥ�����ܡ� <br />
<br />
<b>������˵��ɽ��ԽҰ����ζ��ʲô��</b><br />
ɽ��ԽҰ�ܰ����Ҹ��õ��˽��Լ������Ҹ�����ʶ���Լ��ļ��ޣ���������Ҫ���ǣ�ʹ�Ҿ����ϱ�ø�ǿ����ɽ��ԽҰ�ܵ�ʱ��������ѧ�����ƣ�ͺ��������������ܲ������У���Щ

ʱ������������ƣ���������˿����Ҫ������־��ȥ�ƶ��������ǰ�У�����Ҫ��������и����������������Ŀ������İ����ᶨ����־�������ĺͲ������ӵľ���
������Щ������õ���ֻ�ǳ���յ��ߵ�ʱ����ݵ�����У�Ȼ���ں��������ѳ�����ף֮����͵�Ѱ���µ���ս���µ�Ŀ�ꡭ <br />
<br />
<b>��֮ǰ�ǲ����Ѿ��μӹ������ʷ弫�������ܣ�UTMB&reg�������أ�</b><br />
û�У��⽫���Ҳμӵĵ�һ�λ����ʷ弫�������ܣ�UTMB&reg���ı�������֮ǰ�Ѿ��ܹ���������߶��Ѷȵ����£�����ÿһ���˶�˵�����ʷ弫�������ܣ�UTMB&reg����һ����ħ�������£�

������Ҳ��һ̽������ <br />
<br />
<b>��Ի����ʷ弫�������ܣ�UTMB&reg����ʲô���������أ�</b><br />
����Ҫ��������������Ϊ����һ����ս��һ���µ����飬�������Ҳ����Լ��������������Ժ����������˶�Ա��һ�¡������ʷ弫�������ܣ�UTMB&reg�������Ǿ��вο���ֵ��ɽ��ԽҰ�ܱ�����

��Ҳ�������������£��Һ���֪������˳����ĸ���ԭ�������ϣ����������ӵ��һЩ���õ�ʱ�⣬������Ҫ���ǣ�����Ҫ�ܹ��յ��ߣ�֪���Լ�������Ϊ��ȫ���Ը��ˣ������Ͳ��ᱧ��

�����ˡ� <br />
<br />
<b>Ϊʲô��ѡ��μ�Vibram&regɽ��ԽҰ�ܶ����أ�</b><br />
�Ը�����˵����ΪVibram&reg�Ŷ�һԱ�����л���õ���Vibram&reg�����õĹ�˾��ȫ��֧�֡�����������ɽ���ܲ������зḻ���飬���ǿ϶����õ���õ���Ь�μӱ�������Ҳ�ڴ��õ��Ŷ�����

�������˶�Ա�Լ�Vibram&regԱ����֧�֡� <br />
<br />
<b>���˻����ʷ弫�������ܣ�UTMB&reg�����⣬����2012�껹��û�а�����Vibram&reg��ɽ��ԽҰ���ŶӲμ��κα���ܲ������أ�</b><br />
�ҿ϶���μ�Lavaredo���������ܣ����ǲ��϶��Ƿ��μ�Templiers���ܡ�������Σ��һ���μ�����һЩ���£��һὨ���Ŷӿ��ǲ����� </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_10'><span>Francesca Canepa�ķ�̸</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc4MDY0.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014145354_5179.jpg" />&nbsp;
<p><b>Francesca����ƽ������ʲô�ģ�</b><br />
����һ��ĸ�ף�Ҳ��һ���˶�Ա���ҵ�����ֳ������֣����ҵ��������ӣ����Ƿֱ���4���7�꣬���о��ǲμ�ѵ���� <br />
<br />
<b>��ϣ������ĺ����ǹ�����ô���ļ�ֵ���أ�</b><br />
�����Լ��ĺ����ǹ���ļ�ֵ���ǣ�������ͷ����ʲô���񣬶�ҪŬ���������ڷ��ù�����ϣ��������⣬�Ƿ�����Ϊ�������Ӵ���һ��������������������һ�������ÿһ���¶�׼���úܺã�����С��ϸ�ڶ�����Ź�����ôҪ�ܵ��յ���Ҳ�Ͳ����ˡ� <br />
<br />
<b>���Ǵ�ʲôʱ��ʼ�ܲ����أ�Ϊʲô�أ�</b><br />
�ҵ��˶����ĺ͸�ɽ�ܲ��ɷ֡��ڳ�Ϊ��ĸ֮ǰ�����Ǿ�����ˮƽ�Ļ�ѩ���˶�Ա���������ź�����������������ϣ��ұ�ֹͣ�������˶���֮����˼��꣬�ҷ����Լ������������״̬ȥ������������ʿ����Ү�����˵��ص����ܽ���Fabio Maragliati���������ҿ�ʼ�ܲ������㵽�˽��죬Ҳ�����ڼල�ҵ�ѵ��������һ��ʼ�����µĻ����������֪���Լ���ɽ��ԽҰ���ⷽ����Ǳ�������Դﵽ������ˮƽ�����ԣ��Ҽ�������������ҵĳɼ�Ҳ�Ȳ������� <br />
<br />
<b>������˵��ɽ��ԽҰ����ζ��ʲô��</b><br />
�ڽ����ռ������ܵ�ʱ��ʱ�������ڸ��˵ģ����Կ������Լ����뷨���ɵ�����������Ҫ���ǣ����ܵ�ʱ���л���ȥ���ܵ����������Ŀ��飬�������յ��ߵ�һ�̣���ǰƷζ��󼸹���ʱ�ĸ��ܡ� <br />
<br />
<b>Ϊʲô����μӹ������ʷ弫�������ܣ�UTMB&reg���أ�</b><br />
������Ϊ�����ܷ���ȫ�µط���ȫ����·����Ȥ�� <br />
<br />
<b>ΪʲôҪ�μ�Vibram&regɽ��ԽҰ�ܶ����أ�</b><br />
��ΪVibram&regɽ��ԽҰ���Ŷӵ�һԱ�����л����һȺ��Ȼ��ͬ����ȥ����ǿ������飬�����ռ�����ɽ���ܵ����顣������˵���л���ȥ���Լ�������͸����ʻ������˳��֣������Լ��ĳɹ�����һ����Ҫ���ƶ���������ǻ����ʷ弫�������ܣ�UTMB&reg��������Ϊʲô��������Խƽ���ı�����ԭ�򡣴��⣬�õ���Vibram ��������ԺյĹ�˾��������Ҳ�Ǹ����һ���ƶ�����ʹ��Ŭ��Ϊ����������ã���Ϊ�Ҳ�������Ϊ�Լ����ܣ����һ���Ϊ����������֧���ҵ��˶��ܡ� <br />
<br />
<b>���˻����ʷ弫�������ܣ�UTMB&reg�����⣬����2012�껹������Vibram ��ɽ��ԽҰ���ŶӲμ�ʲô����ܲ������أ�</b><br />
���ǿ϶���μ����µ׵�Lavaredo�ռ������ܺ�ʮ�µ׵�Templiers����������Ŀǰ���ڿ�2012�껹��ʲô������¿��Բμӡ� </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_9'><span>David Gatti�ķ�̸</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc5Nzg4.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014150648_3626.jpg" />&nbsp;
<p> <b>David����ƽ������ʲô�ģ�</b><br />
����Polartec&reg��˾��רҵ�г���������¡����졢��������ҵ�ȣ����ž��� <br />
<br />
<b>��ɼ������к�����</b><br />
�����������ӣ��ֱ���7���9��� <br />
<br />
<b>���Ǵ�ʲôʱ��ʼɽ��ԽҰ�ܵ��أ�Ϊʲô�أ�</b><br />
����2010�꿪ʼɽ��ԽҰ�ܡ�����2009�꣬Polartec&reg���Ѿ��ǻ����ʷ弫�������ܣ�UTMB&reg���ĺ�����飬�һ�����˿Ϳ�����������ĩ�ı�������ǰ���Ҿ��Ѿ������µ����ա���ս�Ժ����ǵ����������������ס��������˼�����ĸ��º��Ҿ����μ�2010���CCC���ܡ� <br />
<br />
<b>������˵��ɽ��ԽҰ����ζ��ʲô��</b><br />
��ɽ��ԽҰ�����棬�и�ɽ�����ҶԱ��ֵĿ��������������ܲ�ʱ��ǿ�Ҹ��ܡ� <br />
<br />
<b>��֮ǰ�ǲ����Ѿ��μӹ�UTMB&reg�����£�</b><br />
û�У�2012�꽫�����ҵ�һ�βμ�UTMB&reg������ <br />
<br />
<b>Ϊʲô�����Ҫ�μ�����ض��ı����أ�</b><br />
��Ϊ���ҿ�ʼ�ܲ���ʼ�����Ѿ���Ϊ���ҵ�Ŀ�ꡣ��Ϊ�����ռ�����ɽ���ܣ�������Ҫ���ܲ����������⣬Ҳ��Ϊ�ڸ�ɽ���ܲ��Ѿ���Ϊ���ҵ�һ�����ʽ������Ҫ�����Լ��ܷ��ܵ��յ㡭 <br />
<br />
<b>Ϊʲô����Ҫ��ΪVibram&regɽ��ԽҰ�ܶ����һԱ�أ�</b><br />
�Ҳ�̫�϶��ò�������˵������������һ�ж�ʼ���ڰ칫���￪��һ����Ц����Ϊ���Լ�������õ�����֮һ�������ҿ��ܲ���Ҫ���Ϊ�����һԱ����ÿ��һ�����ھ�Ҫ���������һ�Σ���û���㹻��ʱ��ȥ�μ��㹻�Ĺ̶�ѵ�������ǣ���Polartec&reg ��Vibram&reg֮��һ����ϵ�����Ƕ��Ǹ������������Ʒ�ơ���Ҳ�е������ܹ�Ϊ�����ҹ�˾�������ף����ҺͶ����˶�Աһ��μ���α������Ҳ�û��Ϊ������׼����Ҳû���������ܹ��������Ļ��ᡣ��ϣ������˳���� <br />
<br />
<b>���˻����ʷ弫�������ܣ�UTMB&reg�����⣬����2012�껹��û�а�����Vibram&reg��ɽ��ԽҰ���ŶӲμ��κα���ܲ������أ�</b><br />
Ŀǰ���Ҳ�̫ȷ����ʲô���������ճ̰��ţ�����Ҫ�������ҵĹ���Ե�ʡ� </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_8'><span>Beppe Marazzi�ķ�̸</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDYwNDUyMDA0.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014151822_3929.jpg" />
<p> Beppe��2011���Ѿ���Vibram&regɽ��ԽҰ�ܶ���ĳ�Ա֮һ�����ڻ����ʷ弫�������ܣ�UTMB&reg������ȡ�õ�����ĳɼ���Beppe�Ѿ���飬���������ӵĸ��ס�����ʼ�μ�ɽ��ԽҰ��һ������Ϊ�˱������Σ���һ������Ϊ�����Ӵ������Ը�ɽ���Ȱ����𾴡� <br />
<br />
<b>Beppe���������˵һ˵��ȥ�����Vibram&regɽ��ԽҰ���Ŷ�һ��μӵĻ����ʷ弫�������ܣ�UTMB&reg���������</b><br />
�����ʷ弫�������ܣ�UTMB&reg������һ������ӡ����̵����飬������Ϊ�ڱ����п��Ա����������ǣ�ż�����齻�ӣ�����������׳���ķ羰����������Ҫ������Ҳ��һ�����ҷ����Լ����޵�����֮�á�������ڱ����з��������ϵļ��ޣ���Ϊ��������˳�ʱ����ܲ��������ƣ�����������������ߣ��㻹���Է��־����ϵļ��ޡ�������ôһ��ʱ�̣����Ǹе��Լ�������Ҫ���ϼ�װ����ߣ������Ǻ���ʵ֮��������ϰ��������ڣ������ĸо�½������������һ�̣�����ȫ�������Լ������������ڡ����Һ������ٵõ���˰��ĸо��� <br />
<br />
<b>�����Ϊʲô�������2012���ٴθ���Vibram&regɽ��ԽҰ���Ŷ���ս��ԭ����</b><br />
�ҵ�Ȼ�����ٴ�������Щ����ĸ��ܣ�������Ҳ������ȥ�μ�UTMB ���ҵĶ��Ӳ��ϵ�Ҫ�����һ���ܵ��յ㣬����ȥ����û�������Զ��ӵĳ�ŵ�������Ϊʲô�ҽ��ᾡһ��Ŭ��Ҫ�ڰ�ҹ֮ǰ�ܵ��������˹�ȣ�Chamonix�����յ��ߵ�ԭ�������ҾͿ��ԺͶ���Я�ֳ��ߡ� <br />
<br />
<b>���ԣ���׼���òμ�UTMB&reg�������ٴμ���Vibram&regɽ��ԽҰ�ܶ�������</b><br />
�ܹ��ٴκ�Vibram&reg�Ŷ�һ��μ�UTMB �����������һ�����ҡ�ȥ�����ܹ�˳���������һ����ԭ�������ڵõ��Ŷӵ�֧�֡�������һ��һҹ��ÿһ��ʱ�̣����������������ɵ�һЩ���Σ���Ҳ֪����ǰ�����˵ȴ����ң����������ң�����׼����Ͷ��ʱ��;�������ȫ����֧�֡������ֻ�ǹ¾���ս���ҿ϶�������ˡ���������Щ�������ɻ��ʱ�̣��Ҹе��Լ���һ�������������ҪһԱ��ÿ���������ʱ���ҵ���־�����Ҽ����ȥ��
�Ҳ�֪�������Լ��ܷ�˳�������Լ���Ŀ�꣬��Ϊ�������ı���������̫���δ֪����������ҿ϶����ǣ��Ŷӵ�֧�ֻ��������Ҫ�Ķ��⶯���������㾡ȫ��������õ���ǰ�ܡ� <br />
<br />
<b>���˻����ʷ弫�������ܣ�UTMB&reg�����⣬����2012�껹��������Vibram&reg��ɽ��ԽҰ���ŶӲμ�ʲô����ܲ������أ�</b><br />
Ŀǰ�����Ǽƻ��μ�6�µ׵�120�������--Lavaredo���������ܣ�����10��26��27��28�վ��е�Templier�ܲ����������ǿ϶�����μ�����һЩ���£���Ҳ������������� </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_7'><span>Ronan Moalic�ķ�̸</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTc5MzUy.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014152628_5032.jpg" />&nbsp;
<p> <b>Ronan��ƽ������ʲô�ģ�</b><br />
����һ�����ҽ��������һ��������������ְҵ��Ҫ���ҵ�ߵ����൱��רע�����ҵĹ������ܴ󣬹���ʱ�䰲�Ų����������ҵõ���Ҫ��ѵ��ʱ�䣬�����Һܸ����Լ������ܹ�ƽ�������������������Ȥ�� <br />
<br />
<b>��ɼ������к�����</b><br />
�ҵ�̫̫���Һܴ�İ���������������Һ͹����ҡ����Լ�Ҳ����һЩɽ��ԽҰ�ܣ���ֻ�ܶ�;�������ҵĶ��ӣ�������8�꣬����֧��Ҳ��ͬ����Ҫ����ʱ���������������ֳ������ң���һЩ�Ƚ����ѵ�ʱ�̣��Ҿ������뵽����Ȼ��ͻ�õ������� <br />
<br />
<b>���Ǵ�ʲôʱ��ʼ�ռ�����ɽ���ܵ��أ�Ϊʲô�أ�</b><br />
��2004��10�²μ���Diagonale des Fous�������������������ϵ�Grand Raid�������������ҵĵ�һ�μ��������ܱ����������Ǵ���׼���ò�����֡�������֮ǰ�����˼����£����ʹ󵨵���Ϊ�Լ��ܹ�������¡�����Ҫ���������Ҫ�����������Լ��ܹ����õ�����α���������˾��ò���˼�飬���������ѽ���ŵ������͡������ߡ����档�ռ�����ɽ����Ҫ�ľ��ǳ�Խһ���˵ļ��ޣ���Խƣ������ѣ���Ҫ���뷢���ҳ��Լ����������ŵ���Դ��������˽⵽�Լ������������������˺���Ȼ�Ĺ�ͨ�����ǣ�����ֹ��ôһЩ���ڲ���֮ǰ������Ҫ����ʱ���׼����������ѵ����Ҫ���ϼ����µ�ʱ�䡣���ڸ���һ���ʱ�򣬸��ݶ���ǰ���뷨���ɵĲ�����Ŀ��Ҫ�и������ĳ����ڡ��ռ�����ɽ������һ���ܹ����������������Ҫ��֯���ŵ���Ŀ��������һʱ�嶯��³ç֮�١� <br />
<br />
<b>������˵��ɽ��ԽҰ����ζ��ʲô��</b><br />
���ܷ���ɽ��ԽҰ�������˶��������һ�����ѣ�����2004����ҿ���һ�����ܡ�������֮����������������Diagonale des Fous������ͨ�����յ��ߡ������أ���ȡ���˽������������˶����Ȱ�Ҳ�õ����¡�ɽ��ԽҰ�ܴ��������ڸ�ɽ���ܲ��Ļ��֡���������һ�����£����Լ�ȫ���ִ�ɽ�����������ÿһ�ں��������ߵ�������ɽʱ��ʯͷ����Ծ����������֮�䴩�У���Ͳ��������Ȼֻ�Ǽ򵥵Ĵ��ڣ��������ظе���Ҳ���������ģ����Լ��·�����Щʯͷ����ľ��ɽ����Ϊһ�塣������Ļ������ܵĸо���������һ�������ֳ�Խ�Լ����޵����øл��̻����������ȥ�������Щ���ơ� <br />
<br />
<b>��֮ǰ�ǲ����Ѿ��μӹ�UTMB&reg�����£�</b><br />
�⽫������UTMB&reg���״β����� <br />
<br />
<b>Ϊʲô����μ�UTMB&reg�����أ�</b><br />
��Ϊ������һ�����������Ļ����н��е�һ���񻰰�ı�������ɽ����ѡ��һ���б���μӵ��ر����¡��������ν���ռ����ܡ� <br />
<br />
<b>ΪʲôҪ�μ�Vibram&regɽ��ԽҰ�ܶ����أ�</b><br />
��Vibram&reg����һ��Ʒ�ƺ����Ǹ�ѧϰ�¶����Ļ��ᣬҲ�Ƿǳ����˹����ֵ����ҫ�ġ����⣬���ǿ����л�����У�����ȥ����ʯɽ����Dolomites���μ�Lavaredo��������������ʶһЩ�µ����ǣ��ر���������ˣ�����
��������˵�����ֺ����϶����ṩһ�ֶ���Ķ�����Դ������װ���ͺ��ڷ���Ĳ��䣬������UTMB&reg�������ռ�����ɽ���ܱ������õ����κ�Э�������ɿ���������ռ���Ȼ��� </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_6'><span>Sebastien Nain�ķ�̸</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<div class='play_intervista'><a href='http://v.youku.com/v_show/id_XNDQxOTgwMzcy.html' target='_blank'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/play.png' width='84' height='83' border='0' /></a></div>
<img alt="" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121014153718_7727.jpg" />&nbsp;
<p><b>S��bastien��ƽ������ʲô�ģ�</b><br />
���Ǻ˲��ŵ�������Ա�� <br />
<br />
<b>��ɼ������к�����</b><br />
���Ѿ���飬��������Sophie����Ҳ��һ���˶�Ա��������һ�����ӽ�Mathys����������ˡ� <br />
<br />
<b>���Ǵ�ʲôʱ��ʼ�ռ�����ɽ���ܵ��أ�Ϊʲô�أ�</b><br />
����2008�꿪ʼ�μ��ռ�����ɽ�����ܣ���ʱ�������������ϵ�Grand Raid��������Ҳ�μӹ����������ֻ�������û��ȡ�òμ�����ھ������ʸ������Ҿ�������ɽ����һ�꣬���Ҳ�

���ͷ�� <br />
<br />
<b>��֮ǰ��û�вμӹ�UTMB&reg�����أ�����˵��������ĵ�һ�β�����</b><br />
���Ѿ��μӹ�UTMB&reg���������ˣ�������2008���������ˣ����ò�ֹ���ڷ�����Contamines��Ȼ����2009�꣬����ʥ��ά����St-Gervais����ɽ;��ˤ����Ť�����β��������2010�꣬��

�±������ڶ���������ֹ��2011�꣬�Ҿ����ڱ�ı����������Լ��������������μ���Grand Raid des Pyren��es�ı���������һ�δ�ֱ���θ߶������10000�׵�160�����ܲ�������������

���˵������� <br />
<br />
<b>Ϊʲô����Ҫ�μ�UTMB&reg�����أ�</b><br />
UTMB ����������ʵı���֮һ���ҵ���������������Щ�����˵�ɽ·�������ܲ�������������ܵĻ�ȡ�úõĳɼ���������һЩ���Ѿ��μӹ����ܲ�����������һЩ�����ҵĴ�����������

�� <br />
<br />
��������Grand Raid������2008�꣬ȡ�õ�12������ά��Ͽ����ս����2009��Ӯ�ùھ�����Ultra Templiers�ռ��ܣ�2009�꣬�õ���9��λ�ã���Marathon des sables�������ܣ�2010�꣬��

����10���ǵ�һλ���ߵķ����ˣ���Aubrac Aventure������2011�꣬����Ǿ�����Grand Raid des Pyr��n��es������2011�꣬�õ���3����Ҳ����λ�����յ�ķ���ѡ�֣��� <br />
<br />
��δ��׼���μӵı���������UTMB&reg������Lavaredo�ռ������ܡ�Western States�����ݱ�����Hardrock��ʯ���ܡ�LeadvilleԽҰ�ܡ�Spartathlon��˹�ʹ�˹�ɣ������������������100��

�������ɡ��Ჴ�������������������ȵȡ� <br />
<br />
<b>Ϊʲô�μ�Vibram&regɽ��ԽҰ�ܶ����أ�</b><br />
Vibram&reg�����ܹ�������ȡ�úõĳɼ�����л���ǵ����ܷ������Լ�����Ҫ�������ǵ���Ա�������������ʺͲ��������Э��������ʵ�������롣 </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_5'><span>Vibram&reg��2011�껷���ʷ弫�������ܣ�UTMB&reg��</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p>��Ϊ��ͻ���Լ����µ�ɽ���˶����ر�����ɽ���ܷ������������࣬Vibram&reg�Ѿ���Ϊ�����ʷ弫�������ܣ�Ultra-Trail du Mont-Blanc&reg��������������ꡱ��Vibram&reg����ϯִ�й�Adriano Zuccala����˵��Zuccala�����Լ��ڶ����ͬ�Ĳ���վ���ĵ�֧��Vibram �Ŷӵĳ�Ա��<br />
<br />
�����꣬Vibram&reg������齨�ṩ�˻��ᣬ�����ǿ����������з��Ӹ�����Ҫ�Ľ�ɫ����ȻҲ������������������Ҫ�˶����·���ĸ����Ե��³��ԣ������ΪUTMB&reg�������̡���<br />
<br />
�ر�Ҫ��лVibram&reg���������ִ����ġ��Ƿ����顱���������µ�Vibram&reg Э����Annalaura Gatto ��˵��2011�������¡������ͼ������¿��ܡ�������ǿ������չ����������Ҫ�������Ҫ�ԣ�������ÿλ���ּ��޵ĸ�����ս����Ҫÿλ���ֺ�������Լ��ĸ�����Դ���Լ��г���һЩ��֪��Ʒ�ƣ�Julbo��Petzl��Camelbak��Montura���ṩ�ļ���װ�����ӵĻ������á����ַ�Ҷ�������ᡢHi-Tec��Ŧ�����ṩ��Ь��ͳͳ�������µ�Vibram&regɽ����Ь�ף�Ҳ��һ�����о����Ե�Ҫ�ء�Marco Zanchi ˵��������һЩ������ѩ�����ʪ���ĵ��α������ܲ���ʱ��ֵ��������Ь�Ӿͱ����ĺ���Ҫ�ˡ��� Rapha l Bodiguel�����������166�������ܹ����У�Vibram&regЬ��Ϊ�����ṩ����Ҫ��ץ�����Ͱ�ȫ�ԡ���<br />
<br />
��Vibram&reg���������ѵ��ȫ���̶���������ƽ���˳�Ա�����м�غ͹۲���ŶӾ���Nicola Faccinetto ˵�����ڻ����ʷ弫�������ܣ�UTMB&reg�����棬ÿһ���¶���������ľ���״̬�������Ϊʲô�ڳ�;���������в��ɱ���س�������ƣ�������ʱ������֧�ּ��ϼ���֧������˵���Ҫ����<br />
<br />
ѵ����������Ժ����������������ɣ������ʷ弫�������ܣ�UTMB&reg����Vibram&regѡ���ǵõ��Ĳ�ֻ��һ�γɼ������������һ����������飬������ǿ��������ؼ���Ž��������Ȼ�ļ�ֵ�ۣ���Ҳ����Vibram&reg�ͻ����ʷ弫�������ܣ�UTMB&reg������֯��������ļ�ֵ�ۡ�<br />
<br />
���ڶ��ڼ������˹�ȣ�Chamonix�����ռ�ɽ����չ���е�Vibram&reg��ƷҲ�����мӡ�Vibram&reg�Ŷ�ʹ�õ�����ɽ����Ь�������˴���൱�����Ȥ�ͺ��档�����Եġ�����Ь��Vibram&reg fivefingers&regҲ�ǵõ���������������һ����Ʒ�����ж���;��FiveFingers&reg�ǻ����ʷ弫�������ܵ�ɽ���ܱ���ǰ����ѡ������׼��ѵ��������Ь�ߡ� </p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_4'><span>2011�껷���ʷ弫�������ܣ�UTMB&reg����Vibram&reg�ġ��Ƿ�������</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<p>Vibram&regͶ���ؽ���һ�컷���ʷ弫�������ܣ�Ultra-Trail du Mont Blanc&reg�����£����Ҳ���ֻ����������֮һ��Ͷ�ʵ�Ч�����ԡ�<br />
<br />
�����˶�Ա����������������£�����������������������ǰ50λ�Ķ���ѡ��֮�С���ɱ����ĵ������ŵ�101�����ھ����յ���10����ĵط������ڵ�70��λ�á��ڻ����ʷ弫�������ܣ�UTMB&reg���У�Vibram&reg�ŶӾ�������ս����Խ�������ڴ���������������Vibram&reg�Ŀںţ���ƽ���˳ɾͷǷ��������꣬�ڻ����ʷ弫�������ܣ�Ultra-Trail du Mont Blanc&reg�������ڼ䣬Vibram&regȡ�������˲�Ŀ���˶��Ѽ������Ķ�Ա��Ҳ����������������ʱ�̡�<br />
<br />
Marco Zanchiȡ���˱���Ľ�����Ե�32���ĳɼ�����˱�������Ҳ�����ȳ���յ��������ˡ�Vibram&reg�Ļ����ʷ弫�������ܣ�UTMB&reg���Ŷ��е�����һ��������˳�ԱGiuseppe MarazziҲ��������˵ĳɼ�����Beppe�������������˱�����ȥ�����ڶ�������������ֹ���������������е��������ǵ�49λ�����Է�����Rapha l BodiguelҲ�÷ǳ�ֵ���𾴵ĵ�101λ�ɼ������2011��Ļ����ʷ弫�������ܣ�UTMB&reg����������̫���˵�Johan S��razin�����50����֮�󲻵ò�������������Candide Gabioud����Ȼ��Ҫʱ��ӽ��׵������п�����<br />
<br />
���꣬�����ʷ弫�������ܣ�UTMB&reg���Ľ������¡�93���ﳤ����ֱˮƽ����5300�׵�CCC&reg�����ܡ��ڻ����ʷ弫�������ܣ�UTMB&reg��ǰһ�������Vibram&reg������Ա�ı����ɼ�ͬ�����ס��г�����J��r me Bernard˳����ɱ�������������������ĵ�292λ��Ҫ֪����J��r me������ſ�ʼ����ɽ���������˶��ġ�</p>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_3'><span>��Vibram&regЬ�׵�Ь��</span></div>
<div class='accordionContent acco_cont_dispari'>
<div style='float:right; margin-top:5px;'>
<div class='jiathis_style'><a href="http://www.jiathis.com/share" class='jiathis jiathis_txt' target='_blank'><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border='0' /></a><a class='jiathis_counter_style_margin:3px 0 0 2px'></a></div>
</div>
<div class='acco_contenuti'>
<table class="ke-zeroborder" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top"><img style="padding-right:15px;padding-top:10px;" src="http://static.8264.com/oldcms/moban/zt/2013_vibram/upload/20121018150924_4609.jpg" width="100" height="146" /></td>
<td class="news_testo" valign="top"><p> ��,����������Ӣ�����ձ����������ͷ�����57����ͬ���ҵĶ������ֺ��˶�Ա�μ������£����������������˹��ʱȫ��������������<br />
����������������ɡ�������ŷ�����ܻ�ӭ�ĵڰ˽��ռ��������������ĳɼ�����ô���أ����������˶�Ա������ǰʮ�����������˴�����Vibram Ь�׵�Ь�ӡ��Ǿ���ΪʲôҪ�������Ƕ����ԭ��֮һ�� </p></td>
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
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>������ ������ӥ��(Vibram ���100�Ƿ�֮��)</span></div>
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
<td valign="top"><b>������ ������ӥ��</b><br/>
<br>
ӥ���꽫�׶Ȳμ�Vibram���100���£��������������״β���������ȷ���ĸ����ֵ������������ڴ���ֻϣ�����Ծ�������ȫ�̡�<br/>
                                 <br>
                                ��۱�������ӥ��ϲ������Vibram��ָЬ�ܲ�����Ϊ�ÿ���Ь�����ڱ���ʱ�о�������Ȼ��Ŀǰÿ����������40�����ս���¡�ӥû����������زμ�ԽҰ�����µľ��飬���������˼������£�������<br/>
<br>
                                2012&nbsp;&nbsp;&nbsp;&nbsp;2012 Ironman 70.3 Taiwan<br/>
                                <br>
                                2012&nbsp;&nbsp;&nbsp;&nbsp;100������ʩ������<br/>
                                <br>
                                ӥ�����ѵ��Ƽ�֮�²μӳ־����˶�����ϲ�������˶��ܹ����Լ�Ѱ�����ͻ�ơ����ܲ�֮�⣬����ϲ�����˶��ǲȵ��������������ܶ��������˱�������Ϊ���Խ���������˶������һ��
                                
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
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>����ƽ, ���� ��King Jump��(Vibram ���100�Ƿ�֮��)</span></div>
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
<td valign="top"><b>����ƽ, ���� ��King Jump��</b><br />
<br />
King Jump����2012�����Vibram���100���£�������������ӵ��VibramЬ���HI-TEC��Ь�ٴβ�������2012��ɹ����Vibram���100���µ����������˻�δ�����2012����TNF���¡�����־ϣ�������ڽ����Ը��ѳɼ����Vibram���100���¡�<br>
<br>
                                ����������ǰ��ʼΪVibram���100���������˲��øߵ��ס��ߵ�ۡ���֬������ʳ�ƻ�֮�⣬��ע�������ɼ�ʱ������Ͻ���ѵ����<br/>
                                <br>
                                King Jump������ɽ���������续�ķ羰����������Vibram���100���µ������˼����Լ��пָ�֢�����Ծ����μ�2014��Ĵ���ɽ100���¡�<br/>
                                <br/>
                                King Jump��ȥ��Ҫ�μӹ�·���ܣ�֮��Ų���־������£�����Ϊ���߿��������ѹ�ͬ���룬���ܻ�����ĵ���ȫ�ͷš�
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
<div class='accordionButton acco_dispari' id='contenuto_A6'><span>Joel LaBelle, �ֳơ� Jogger Joel ��(Vibram ���100�Ƿ�֮��) </span></div>
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
<td valign="top"><b>Joel LaBelle, �ֳơ� Jogger Joel �� </b><br />
<br />
Joel�������緶Χ�ڲμ����ԽҰ�ܼ����˱�����ͨ�����ᴩ��VibramЬ�׻�Vibram��ָЬ���������˴�����ʾ�����ڿ��ǵ����Σ���������п��ܴ���New Balance Minimus 1010�μ�Vibram���100�� <br />
                                <br/><br/>
                                Joel����2011��2012��֮������������μ�Vibram���100���������Ӱ��ı������¡���2012��������У��������˸��˸������µ���óɼ�20Сʱ18��54�롣
                                <br/><br/>
                                �����2013��Vibram���100���º�Joel����μ����±�����
                                <br/><br/>
                                2013��2��&nbsp;&nbsp;�������������
                                <br/><br/>
                                2013��3��&nbsp;&nbsp;ī����������
                                <br/><br/>
                                2013��4��&nbsp;&nbsp;��ʿɽ161����ԽҰ��
                                <br/><br/>
                                ����2009�꿪ʼ����ԽҰ�ܣ���5���10����Ķ̾������¿�ʼ��֮��μ������ɡ�100�������¼�������������ʾ���벻��Ŭ��ѵ��������ȫ�궼�����й��ɵ�ѵ�����ڽ�ů������׼�������������ﶬ��רעԽҰ�ܡ�Joel���Ȱ�������������������ˮȴ���ֺ��ְ���
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
<div class='accordionButton acco_dispari' id='contenuto_A6'><span>Linds Russell (Vibram ���100�Ƿ�֮��)</span></div>
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
Linds Russell ���꽫�״βμ�Vibram���100���£��ⲻ���������״β�����Ҳ�����״δ���Vibram���100�Ƿ�֮�ӱ��������Ѿ�Ϊ��������׼���������ڴ���ñɽ�ε����̡�<br />
<br />
Linds��12�¿�ʼ��ս, ��������ĩ�����������룬ƽ�ս��������Ͷ̳���ѵ���ȡ������������Լ���ѵ��Ҫ���ϸ񣬲���ע����ǰ��ʳ���������޼ӹ��Ľ���ʳ�<br/>
                                <br/>
                                Linds �������������μӵ����¾��飬�����Լ�����Vibram���100<br/>
                                <br/>
                                2012 &nbsp;&nbsp;100����Oxfam������<br/>
                                <br/>
                                2012&nbsp;&nbsp;Wilson Raleigh Challenge (48����ҹ����)<br/>
                                <br/>
                                2011&nbsp;&nbsp;Swiss Alpine 78����<br/>
                                <br/>
                                Linds����Ӣ����Ҳ��ϲ�������ۺͽ���ѭ��ѵ����������������زμӶ��ԽҰ�����£���ϲ����������Swiss Alpine Ultra���ڴ�ѧ�Ͷ��ڼ䣬���ڶ��ھ��������п�ʼ���ϳ־��ܣ�����̨�������µǹ���ʿɽ��
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
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>������(Vibram ���100�Ƿ�֮��)</span></div>
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
<td valign="top"><b>������(Vibram ���100�Ƿ�֮��)</b><br />
<br />
��2012����21Сʱ44��������µ������ܽ��꽫���ٴβ�����Vibram���100��������ϲ�������£���ϣ�������ڽ�����Ƹ�����óɼ����ܽ�16Сʱ��

<br>
<br/>
�����ܴ���Vibram��ָЬ�������ǳ��Ӱ�����ͬVibramƷ�ƵĲ�Ʒ���������ȥ��8���Ѿ���ʼΪVibram���100��ս������ÿ��������¥��3Сʱ��ÿ��������30�����ܣ�ÿ��һ��50�����50���ﳤ�ܡ�<br/>
<br/>����������¼�������֮��Ŀǰ����״̬���ѡ�<br/>
<br/>2012&nbsp;&nbsp;����TNF100<br/>
<br/>2012&nbsp;&nbsp;100������ʩ������<br/>
<br/>2011&nbsp;&nbsp;����TNF100<br/>
<br/>2010�������������Ͽ������������ʷ�ԽҰ�ܱ�������Щ�����ĵ���Ƭ�������ܾͿ�ʼΪ���������ʷ�ԽҰ����Ŭ������ϣ���ڽ����ٴβ��������ʷ�ԽҰ������ǰ���������״̬��
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
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>Nicola Bassi (Vibram�����ʷ�ԽҰ��֮��)</span></div>
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
����&nbsp;&nbsp;25<br>
                                <br>
                                ����&nbsp;&nbsp;��ɭ��ŵ�¶��Ӵ�<br>
                                <br>
                                ����&nbsp;&nbsp;�����<br>
                                <br>
                                "���弫��ƣ����ʱ��, ��־�������Ǽ���ǰ��..."<br>
                                <br>
                                ������1987���Nicola Bassi�������������ɭ��ŵ�¶��Ӵ��Vibram?ԽҰ��֮��������Ķ�Ա��������һ�������̵���ְ3�꣬����ȫ���Ĳ��뻧���˶������Ȱ������˶����������������ص�40���ҹ�·6000�����Խ����͢������Ŀ���ǽ��������˶����ϣ������ܱ�Ⱥɽ���ơ�Nicola�ᵽ����һ��ʼ����ֻ��ʮ��רע��ɽ�˶����ܲ�ֻ��Ϊ��ѵ��������ԽҰ�ܵ�ϲ���������ɵġ���<br>
                                <br>
                                ����������ȥ����μӹ�����Ҫ���£�<br>
                                <br>
                                2011&nbsp;&nbsp;Grand Raid des Pyr��n��es��20��<br>
                                <br>
                                2011&nbsp;&nbsp;Adamello Supertrail�ھ�<br>
                                <br>
                                2011&nbsp;&nbsp;Grand Trail 3V��9��<br>
                                2010&nbsp;&nbsp;Toubkal Marathon��24��<br>
                                <br>
                                2010&nbsp;&nbsp;Red Rock Sky Marathon (���籭����) ��11��<br>
                                <br>
                                2010&nbsp;&nbsp;Estremamente Parco (Julian Alps) ��15��<br>
                                <br>
                                ��Nicola��˵��ԽҰ����һ�����ĵ���;��һ�ֶ��������ܺ�����Ĳ��飬�Ӷ����˽��Լ�������ʾ���������弫��ƣ���ʱ�򣬵�һ�ж��е�ʹ�࣬������������������ǰ������ִ���������������ļ��ͣ����������Ǵ��Ŀ�꣬�ڿ�Խ�յ��һ�̻�ü��������С���<br>
                                <br>
                                ������Nicola Bassi�״���Ϊ VibramԽҰ��֮�Ӷ�Ա��������������μ�LavaredoԽҰ���Լ������ʷ�ԽҰ�ܡ���ȻNicola���ڹ�ȥ�ܹ��뻷���ʷ�ԽҰ�ܾ�����������£����������״βμӸ������綥�����£��������ʷ�е����š���ϣ��͸���������飬��֤���������Ƿ�������������˵�������Ƿ�����ϣ������VibramԽҰ��֮�ӵĳ�Ա�ܹ��������ǵľ��飬�������Ŷ�Э���˷��������ѡ�<br>
                                
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
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>Sebastien Nain (Vibram�����ʷ�ԽҰ��֮��)</span></div>
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
����&nbsp;&nbsp;40<br>
                                <br>
                                ����&nbsp;&nbsp;����<br>
                                <br>
                                ����&nbsp;&nbsp;����<br>
<br>
                                "...�����ʷ�ԽҰ�������������������֮һ..."<br>
                                <br>
                                40���S��bastien Nainis���Է������Ǻ��ܲ��ŵ�����Ա����������SophieҲ��һ���˶�Ա�����ǵĶ���Mathys���Ϳ�3���ˡ�S��bastien�μӺܶ�������ɽ���˶����μӹ�Ironman���������� (3.8������ˮ, 180���ﵥ���Լ�42.195����������) ������û�ܻ������ھ����Ĳ����ʸ�S��bastien������ȫ������Ͷ�뵽ԽҰ�ܣ�����ɽ����֮����Ҳδ�μ��������˱�����<br>
                                <br>
                                ����ȡ�ù��ܶཾ�˵ĳɼ�������:<br>
                                <br>
                                2011&nbsp;&nbsp;Gran Raid Pyr��n��es���������������ֵ�һ<br>
                                2011&nbsp;&nbsp;Aubrac Aventure�ڶ���<br>
                                2010&nbsp;&nbsp;Marathon des Sables��ʮ�����������ֵ�һ<br>
                                <br>
                                2009&nbsp;&nbsp;Ultra Trail des Templiers�ھ���<br>
                                <br>
                                2009&nbsp;&nbsp;Saint-Maximin�ھ�<br>
                                <br>
                                2009&nbsp;&nbsp;Verdon Canyon Challenge�ھ�<br>
                                <br>
                                S��bastien �����βμӻ����ʷ�ԽҰ�ܣ�����2008��, ���ڱ�����ʼ30 �������Contamines����������2009�꣬����ǰ��St-Gervais��;�е��䣬��Ť�������β���֮��2010�꣬�����������������ֹ��S��bastien��Ϊ�����ʷ�ԽҰ����������������ܱ���֮һ��2012�꣬��ϣ���ܹ�������ĳɼ�������¡������ܹ�����Vibram�����ʷ�ԽҰ��֮�Ӳμ����¸е��˷ܣ�����ʾ��������Vibram�ŶӼ��豸��֧�֣����ܰ����һ�ø��õĳɼ����� 
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
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>LAFUMA&reg Speed-Trail��Ь</span></div>
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
<td valign="top"><b>LAFUMA&reg Speed-Trailɽ����Ь</b><br />
<br />
�߿Ƽ����ܡ����ʡ���ӯ��͸������Щ����LAFUMA&regɽ��ԽҰ��Ь����Ҫ�ص㣬Ҳ������ѡ��������ϲ��ѡ��LAFUMA&reg��Ϊ����Ӧ������ѵ�ɽ����ʱ��ս��װ����ԭ��LAFUMA&reg�����Ա�֤���ǹ�˾�Ĳ�Ʒ�����Ǵ���ۻ��������϶���ÿһ��ϸ�����������������ʼ����֮��<br>
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_lafuma.png" width="165" height="160"></td>
<td width="20px"></td>
<td valign="top"><br>
LAFUMA&regΪVibram&reg���鹩ӦSpeed Trail����Ь�������Ь����������ܻ����µĲ��ԣ����ڲ�����Vibram&reg VITESSEЬ�ף����Ծ����������ᣬ����Ȼ��֧�������Ź����������ƽ̹�ı�����Ҳ���Դ�����ǿ��ץ������<br>
<br>
<a href="http://www.vibram.com/index.php/us/SPORTS/TrailrunningMultisport/Powered-by/In-evidenza/TRA-LAFUMA-Speed-Trail" target="_blank">�����˽������Ϣ�������˴�&gt;&gt;</a><br>
<br></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff;">Vibram&regɽ��ԽҰ���Ŷ�<br />
"ƽ���˳ɾͷǷ�"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A4'><span>�°��ף�NEW BALANCE��MT 10����ԽҰ��Ь</span></div>
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
<td valign="top"><b>�°��ף�NEW BALANCE��MT 10����ԽҰ��Ь</b><br />
<br />
Minimus 10ԽҰ��Ь����רΪϲ������Ь����������ƣ������ӽ����㴩�Ÿ��⣬ͬʱ�ṩ�㲿������֧���ԣ�Ь��ʹ������͸���������е�����þ������������Ե�ACTEVA������ʣ�������ͳЬ�棬����Ь����Ь���һ�������ƣ�������Ь9.5�ŵĵ���������Լ200�ˡ�<br>
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_newbalance.png" width="165" height="160"></td>
<td width="20px"></td>
<td valign="top"><br>
Vibram רΪNew Balance������Ƶĳ�����Ь��׸�������ץ�������ṩ��ĥ�Լ�ǣ������һ�廯��Ƶ�����𽺸���Ьͷ�Ͳ�ߵ���������Ь����·������Ƹк͹����Ԏ��ص����ͼ���������λN-durance��ĥ����𽺴����ӳ���Ь�������� <br>
<br>
<a href="http://www.vibram.com/index.php/us/SPORTS/TrailrunningMultisport/Powered-by/In-evidenza/TRA-LAFUMA-Speed-Trail" target="_blank">�����˽������Ϣ�������˴�&gt;&gt;</a><br>
<br></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff;">Vibram&regɽ��ԽҰ���Ŷ�<br />
"ƽ���˳ɾͷǷ�"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A6'><span>HI-TEC V-Lite Infinity HpiԽҰ��Ь </span></div>
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
<td valign="top"><b>HI-TEC V-Lite Infinity HpiԽҰ��Ь </b><br />
<br />
ʹ��VIBRAM  O.D.DЬ�׵�HI-TEC V-Lite Infinity HPiԽҰ��Ь���ø����Ե�U.Z.E.(Seamless Upper Zone Engineering)Ь���޷���߼������Ե�Ƭ������Ƴ�����ԽҰ��Ь���Ȼ����ֿɼ���Ь��������ͬʱ�����Ͻ��ͣ�����Ь�汬�Ѽ��㲿��ˮ�ݻ��ᡣ������ion-mask (HPi)��ˮ������100%��ˮ��ͬʱά��Ь��͸���ȣ���һ��δ�� ion-mask  (HPi)����Ŀ�ʽ��Ч������ˮ�ȴ�87.66%����ǿЬ��ɾ�����ɼ���������ԣ�ʹ���߳�ʱ��������Ȼ�о����ʡ� <br /></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_higtec.png" width="165" height="140"></td>
<td width="20px"></td>
<td valign="top">Vibram  O.D.D.��Outsole Dual Density��˫���ܶ���ף���ΪHi-Tecɽ��ԽҰ��Ь������Ƶ�һ����ӯ��ס�<br/>
�ײ���������Ħ������ƵĴ�״Ь�ݣ���������ʱ���˶���������<br/>
ѡ��Vibram  XS Trek �𽺺ϳ��䷽�Ƴɵ�Ь�ݣ�����ʯ����Ӵ�ʱ�и��õ���ĥ�Ժ�ץ����<br/>
ǰ�ƺͺ������벿�ֵĵ�������Vibram  MultiTrek�Ƴɣ��ڶ����ص�ĵ�����ʹ��ʱ�����ṩ��������<br/>
����ESS��TPU�������ΪҪ����ߵ�ɽ��ԽҰ�������ṩ֧�ֺͱ������ر��ڵ��治ƽ��״���¸���͹����һ�� <br>
<br>
<a href="http://www.petzl.com" target="_blank">�����˽������Ϣ�������˴�&gt;&gt;</a></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff">Vibram&regɽ��ԽҰ���Ŷ�<br />
"ƽ���˳ɾͷǷ�"</b></td>
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
<td valign="top"><b>PETZL&reg MYO RXPͷ��</b><br />
<br />
PETZL&reg�����ǻ���ʹ�õ�LEDͷ�Ƶ��г��쵼�ߡ�����ɽ���˶�����ɽ������װ��������Ʒ�ƣ�������Ʒ�ʺͰ�ȫ��<br />
<br />
����Vibram&regɽ��ԽҰ���Ŷӵ�����"��ͨ��ѡ��"������Nicola Bassi��Francesca Canepa��David Gatti��Ronan Moalic��Giuseppe Marazzi��Sebastien Nain���������ǵ�"�Ƿ�"������ѡ��ʹ��PETZL&reg MYO RXP
ͷ�ơ� </td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_petzl.png" width="165" height="140"></td>
<td width="20px"></td>
<td valign="top">ǿ���ͷ�ƾ��г��ȵ��ڡ��������á��ļ����ȡ��������ܣ�160�������͹���������ص㣬�����ڳ�����������<br>
<br>
<a href="http://www.petzl.com" target="_blank">�����˽������Ϣ�������˴�&gt;&gt;</a></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff">Vibram&reg ɽ��ԽҰ���Ŷ�<br />
"ƽ���˳ɾͷǷ�"</b></td>
</tr>
</table>
</div>
</div>
<div class='ico_2'></div>
</li>
<li>
<div class='accordionButton acco_dispari' id='contenuto_A0'><span>VIBRAM&reg FIVEFINGERS&reg SpyridonЬ</span></div>
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
<td valign="top"><b>VIBRAM&reg FIVEFINGERS&reg SpyridonЬ</b><br />
<br />
Vibram&reg Fivefingers&reg Spyridon����Vibram&reg Fivefingers&reg Spyridon LS�������ǵ��׿�ɽ���ܲ�ר��Ь�������������õ�ƽ��"�Ÿ�"�����ṩ��᫱����ϵ��ܲ�������<br>
<br></td>
</tr>
<tr>
<td valign="top" class="news_testo"><table>
<tr>
<td><img src="http://static.8264.com/oldcms/moban/zt/2013_vibram/img/img_ff.png" width="165" height="160"></td>
<td width="20px"></td>
<td valign="top"><ul>
<li>�����Vibram&reg��Ь�׺ʹ󵨵ĵײ�������ƣ�����ȫ��λ���ι�ץ������ͬ�±����Ų�����ʯͷ��ɰ���ĳ����������õظ��ܳ����˶���</li>
<li>��Ȼ͸����Ь���ϵĹ�������װ�ÿ�����������ɽ��ȣ�ʹЬ���������ʡ�</b></li>
</ul>
<a href="http://www.vibramfivefingers.it/product_details.aspx?model=SPYRIDON" target="_blank">�����˽������Ϣ�������˴�&gt;&gt;</a><br />
<br /></td>
</tr>
</table></td>
</tr>
<tr>
<td valign="top" colspan="2"><br>
<b style="font-size: 17px; color:#ffffff;">Vibram&regɽ��ԽҰ���Ŷ� <br />
"ƽ���˳ɾͷǷ�"</b></td>
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
<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#CCC; padding:30px 0px 5px 40px;">2013Vibram HK100�ֳ�ͼ</div>
<div class="photo_testo">
<div style="float:left; width:260px; margin-right:40px;">
<ul id="gallery_1">
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_01_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -1/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_01.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_02_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -2/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_02.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_03_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -3/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_03.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_04_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -4/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_04.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_05_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -5/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_05.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_06_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -6/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_06.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_07_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -7/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_07.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_08_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -8/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_08.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_09_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -9/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_09.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_10_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -10/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_10.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_11_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -11/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_11.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_12_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -12/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_12.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_13_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -13/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_13.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_14_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -14/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_14.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_15_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -15/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_15.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_16_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -16/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_16.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_17_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -17/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_17.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_18_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -18/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_18.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_19_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -19/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_19.jpg' width='260' height='175' border='0' /></a></li>
<li><a href='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_20_big.jpg' rel='gara' title='2013Vibram HK100�ֳ�ͼ  -20/20'><img src='http://static.8264.com/oldcms/moban/zt/2013_vibram/img/utmb2012_20.jpg' width='260' height='175' border='0' /></a></li>
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
                        document.write("ͼƬ����");
                      if(lan=="2")
                        document.write("�DƬ����");
</script>
</a> - <a href="http://www.youku.com/playlist_show/id_18353966.html" target="_blank"> 
<script type="text/javascript">
                    var lan=1
                    if(lan=="1")
                        document.write("��Ƶ����");
                      if(lan=="2")
                        document.write("ҕ�l����");
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
                        document.write("2013 Vibram  HK100�Ƿ�֮�Ӽ����������");
                      if(lan=="2")
                        document.write("2013 Vibram  HK100�Ƿ�֮�Ӽ����������");
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
