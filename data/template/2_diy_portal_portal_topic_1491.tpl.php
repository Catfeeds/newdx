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
<base href="<?php echo $_G['siteurl'];?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_common.css?<?php echo VERHASH;?>" /><link rel="stylesheet" type="text/css" href="data/cache/style_<?php echo STYLEID;?>_portal_topic.css?<?php echo VERHASH;?>" /><?php if($_G['uid'] && isset($_G['cookie']['extstyle'])) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['cookie']['extstyle'];?>/style.css" /><?php } elseif($_G['style']['defaultextstyle']) { ?><link rel="stylesheet" id="css_extstyle" type="text/css" href="<?php echo $_G['style']['defaultextstyle'];?>/style.css" /><?php } ?><title>�����˹TM�����ȷ�Ӫ</title>
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
<a target="_blank" href="<?php echo $_G['config']['web']['home'];?>home.php?mod=space&uid=<?php echo $_G['uid'];?>"><?php echo $_G['username'];?></a>��&nbsp;&nbsp;&nbsp;&nbsp;
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="myQuit">�˳�</a>
<?php } else { ?>
<a onclick="showWindow('login', this.href);hideWindow('register');" href="member.php?mod=logging&amp;action=login" target="_blank">��¼</a>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="showWindow('register', this.href);hideWindow('login');" href="member.php?mod=register" target="_blank">ע��</a>
<?php } ?>
</div>
    </div>
</div>
<div class="navbg mb34">
<div class="navbgcon">
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q1">�ȷ���Ѷ</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q2" >�ȷ湫����</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q3">��ʦ�ӵ�</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q4">�ȷ���ѵӪ</a>
        <a href="javascript:void(0)">�ȷ��㼣</a>
        <a href="http://www.8264.com/portal-topic-topicid-1491.html#q3">�ȷ�ٿ�</a>
    </div>
</div>
<div class="mid">
<div class="left353">
    	<div class="title55"><b>�ͼ��</b></div>
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
    	<div class="title55"><b>True Guide�����ȷ�Ӫ����</b></div>
        <div class="mid1">
        	<p class="left_p">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����ȷ�Ӫ���ɸ����˾��8264���۷廧���˶�ѧУ����������֯��ּ��ͨ��Ʒ�Ƶ������͹���⾫Ӣ�Ļ����ƶ����������Ⱞ����������һ��⼼��������֪ʶ����ͨ�������Ŭ�����й��Ļ����˶��Ļ��õ����õĴ��ݺͷ���<br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����ȷ���ָ�߱�һ�����⾭��Ļ��Ⱞ���ߣ�ֻҪ���Ȱ������ҿ�����������֪ʶ�뼼�ܼ���������뻧���ȷ�Ӫ����Ϊ�����ȷ�<a href="http://bbs.8264.com/thread-2142882-1-1.html" target="_blank">����>></a><a href="http://bbs.8264.com/thread-2142882-1-1.html" target="_blank" class="imgbutton"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_8.jpg"/></a>
</p>
<p class="right_p"><b>��Ϊ�����ȷ���ζ�ţ�</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;ӵ�ж�һ�޶�������<br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;���רҵ����ѵ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;����ɻ����ȷ�Ӫ�ر��Ƶ���Ʒ<br>
&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;����뵼ʦЯ�ֳ��еĻ���<br>
<b>���벽�裺</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;һ��<a href="http://xianlu.8264.com/fillsurvey.php?sid=162" target="_blank">[��д�����]</a><br>
&nbsp;&nbsp;&nbsp;&nbsp;����<a href="http://u.8264.com/home-medal.html" target="_blank">[�����ȷ�ѫ��]</a>
<a href="http://bbs.8264.com/thread-1917397-1-1.html" target="_blank" class="imgbutton_22"></a>
</p>
        </div>
    </div>
</div>
<div class="mid">
<div class="left353">
    	<div class="title55"><b><a name="q1"></a>�ȷ���Ѷ</b></div>
        <div class="xfzx">

<h4>��ʯ��פ�����ȷ�Ӫ ������Ӱ��ѵ��ļ��</h4>
            <p>�����ȷ�Ӫ�ذ��Ƴ������ȷ�Ӫ������ʦ��ʯ��Ϊ��һ���רҵ��ѵ������������ͬ�У�����ţ����ָ����ֻ���ϴ���Ļ�����Ӱ��Ʒ��˵������������Ӱ�������������⣬���ɻ�ò��뽲����ѵ�Ļ��ᣬ��ʯ��ʦ�ֳ�Ϊ����ɽ������λ����PK���д���Ӱ���ɡ�<a href="http://bbs.8264.com/thread-2156776-1-1.html" target="_blank">����>></a></p>


<h4>�����ȷ�Ӣ����֮�ȷ�Ӫ��ѵ������֮Լ</h4>
            <p>���������ڵ����������¿���Ǵ�����ô����·�����߹�������һЦ����������㻹ֻ����Щѡ�������out�ˡ��滧�⣬Ҫ�ľ��Ǵ̼��������� ��Ȼ��ǰ���������㹻��ʵ������νʵ�������ܼӾ���������������ڻ������ˣ���ɱ�������ô�μӣ��������������ĸ����㣺���ȣ�ɹ�������İ�װ�������գ���Σ�д��������Ķ��˹��¡�Ȼ���û��Ȼ������<a href="http://bbs.8264.com/thread-2148816-1-1.html" target="_blank">����>></a></p>		


<h4>�۷���Ϯ ��վ������վ���ȷ���ѵʢ����¼</h4>
            <p>��л��ҵĻ����������ע���������ļ�ܿ�����Ҷ��ȷ�Ӫ������飬û�������ϵ��벻Ҫ���ģ��������ǻ����Ƴ����า��ȫ�����صľ��еط���ɫ���ȷ���ѵ���ϣ����Ҽ�����ע��ף����ڱ�����ѵ��ջ���..... ��ѵ������ӭ��ҷ����Լ�����ѵ��������ܣ���ʱ���β����ȷ�ҽ������Ÿ���ҡ�<a href="http://bbs.8264.com/thread-2143112-1-1.html" target="_blank">����>></a></p>			
</div>
    </div>
    <div class="right590">
    	<div class="title55">
            <b><a name="q2"></a>�ȷ湫����</b>
            <a href="http://bbs.8264.com/thread-2141844-1-1.html" target="_blank" class="qione">����</a>			
            <a href="http://bbs.8264.com/thread-1921944-1-1.html" target="_blank" class="qi">��һ��</a>
            <a href="http://bbs.8264.com/thread-1935707-1-1.html" target="_blank" class="qi">�ڶ���</a>
            <a href="http://bbs.8264.com/thread-1940705-1-1.html" target="_blank" class="qi">������</a>
            <a href="http://bbs.8264.com/thread-1956918-1-1.html" target="_blank" class="qi">������</a>
        </div>
        <div class="mid2">
        	<a href="http://bbs.8264.com/thread-2141844-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/text_14_5.jpg"/></a>
        </div>
        <?php showcomment(29); ?>    </div>
</div>

<div class="mid">
<div class="title55"><a name="q3"></a><b>��ʦ�ӵ�</b><span class="moreright"><a href="http://bbs.8264.com/forum-forumdisplay-fid-489-page-1.html" target="_blank" class="more">����</a></span></div>
    <div class="dssd">
    	<div class="dssd_l">
        	<a href="http://bbs.8264.com/thread-2130221-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/6_7.jpg"/></a>
            <div class="dslistnews">
            <a href="http://bbs.8264.com/thread-1927295-1-1.html" target="_blank" class="c_c44608">�ɹ��Ļ������Ӧ�þ߱���ЩҪ�أ�</a>
            <a href="http://bbs.8264.com/thread-1925849-1-1.html" target="_blank" class="c_008e93">���ڻ����˶���ȫ��̽��</a>
            <a href="http://bbs.8264.com/thread-1921944-1-1.html" target="_blank" class="c_30b1b9">װ������֮����ǳ̸����µ�ѡ��</a>
            <a href="http://bbs.8264.com/thread-1944606-1-1.html" target="_blank" class="c_936e00">�����ѡ�����Լ۱ȵĻ���װ��</a>
            </div>
        </div>
        <div class="dssd_r">
        	<div class="dssd_r_t">
                <h5><span>��ӵĻ��������ʶ</span><em>����ӿ���</em></h5>
                <p>
"̽�ղ���ð�գ���Ϊ���������ߣ�һ���Ա�������ȫΪǰ�ᣬ�����ܽ�Ұ����̽�ա��̼������ֵ�ͬʱ����Ҫ�˼����˵ĵ��ǣ�ҲҪ���ǵ�����Ԯ�����ļ���������
<a href="http://bbs.8264.com/thread-2158324-1-1.html" target="_blank">����>></a></p>
</div><?php showcomment(27); ?>        </div>
    </div>
</div>


<div class="mid">
<div class="title55"><a name="q4"></a><b>�ȷ���ѵӪ</b><span class="moreright"><a href="http://bbs.8264.com/forum-forumdisplay-fid-489-typeid-1552-filter-typeid.html" target="_blank" class="more">����</a></span></div>
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
<span class="zhong">��һ��</span>
<span>�ڶ���</span>
<span>������</span>
<span>������</span>
<span class="fr">������</span>
</div>
</div>
        </div>
        <div class="dssd_r">
        	<div class="dssd_r_t">
                <h5><span>�ȷ�ӪӢ����֮�ȷ棨����վ����ѵ��ļ</span></h5>
                <p>��ѵ�ص㣺��������ʥˮȪ�ȼٴ�&nbsp;&nbsp;��ѵ���ݣ�D1 ������װ����ѡ����Ӧ�á�D2�� ���⼼����ѵ��ʵ��
<a href="http://bbs.8264.com/thread-2143112-1-1.html" target="_blank">����>></a></p>
</div><?php showcomment(30); ?>        </div>
    </div>
</div>


<div class="mid">
<div class="title55"><b>��ʦ���</b><span class="moreright"><a href="javascript:void(0)" target="_blank" class="more">����</a></span></div>
    <div class="mid" style="padding-top:25px;">
<div class="l_arrow_y" id="leftbutton"></div>
<div class="imgrenwulist">
<ul>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi7.jpg">
<span>
<b>����</b>
<em>8264�����������ó����򣺻���װ��</em>
</span>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi1.jpg">
<span>
<b>����-���ɰٴ�</b>
<em>������ɽЭ���������鳤������Խ��ԽҰ���ֲ��ܾ������</em>
</span>
</li>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi2.jpg">
<span>
<b>�ӽ�������</b>
<em>8264����������ӵ�зḻ�Ļ��⾭��</em>
</span>
</li>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi3.jpg">
<span>
<b>����ӿ���</b>
<em>8264����������ɽ���������˶����ֲ���ʼ��</em>
</span>
</li>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi4.jpg">
<span>
<b>Ұս��</b>
<em>������վ���˻���װ�����ΰ�����ʡ����Ӱ��Э���Ա</em>
</span>
</li>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi5.jpg">
<span>
<b>�����</b>
<em>��������װ����������������ʵ�ֻ��ʦ���ó����򣺻���װ��������</em>
</span>
</li>
            <li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/daoshi6.jpg">
<span>
<b>����Ƥ</b>
<em>8264�������������ó����򣺵�ɽ</em>
</span>
</li>
</li>
<li>
<img src="http://static.8264.com/oldcms/moban/zt/goretex/images/8.jpg">
<span>
<b>����</b>
<em>��������ֲ������ˡ��ó�����ͽ������Խ����ɽ��װ��</em>
</span>
</li>
</ul>
</div>
<div class="r_arrow_g" id="rightbutton"></div>
</div>
</div>
<div class="mid">
<div class="title55"><b>������ʦ</b></div>
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
<div class="title55"><b><a name="q3"></a>�ȷ�ٿ�</b></div>
    <div class="xfbk">
    	<ul>
        	<li><a href="http://bbs.8264.com/thread-1921944-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/40_1.jpg" /><span>ǳ̸����µ�ѡ��;���ѡ�����£�ʲô���ĳ���²�����õģ�</span></a></li>
<li><a href="http://bbs.8264.com/thread-1935707-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/41_1.jpg" /><span>����������װ������Ҫ�Լ�ѡ��Ҫ�㣻�����װ���ŷ�ʽһֱ�����㴩��֮˵</span></a></li>
            <li><a href="http://bbs.8264.com/thread-1940705-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/42_1.jpg" /><span>��η��ֺ�������߻��Ⱞ���߳�Ϊһ���ϸ�Ļ������"</span></a></li>
            <li><a href="http://bbs.8264.com/thread-1956918-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/43_1.jpg" /><span>�����Դ��ͻ�������֯��ʵʩ��������ķ�����̽�� </span></a></li>
            <li><a href="http://bbs.8264.com/thread-1966863-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/44_1.jpg" /><span>�������ѱ���֪��ִ���е���Ҫ���򣺻�����С������򼴣̣ΣԷ���</span></a></li>
            <li><a href="http://bbs.8264.com/thread-1997209-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/45_1.jpg" /><span>����װ��֪ʶ������װ��Ь������¯�ߡ���ɽ�ȣ�װ��ʹ��ԭ��</span></a></li>
            <li><a href="http://bbs.8264.com/thread-2038425-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/46_1.jpg" /><span>ǧ��֮��ʼ�����£��������Ļ���ͺʹ������������Ļ���װ��----����Ь</span></a></li>
            <li><a href="http://bbs.8264.com/thread-2063557-1-1.html" target="_blank"><img src="http://static.8264.com/oldcms/moban/zt/goretex/images/47_1.jpg" /><span>�������ˣ����︴�գ��Ǵ��̤��ĺü��ڣ����ܶ�����Ҳ��֮���������磺���</span></a></li>
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
<p class="footer_l">8264 ��Ȩ���� ��ICP��05004140��-10 ICP֤ ��B2-20110106<br>
<a href="http://bx.8264.com" target="_blank">�����з��գ�8264�����������Ᵽ��</a></p>
<p class="footer_r"><a target="_blank" href="http://www.8264.com/about-index.html">8264���</a> | <a target="_blank" href="http://www.8264.com/about-contact.html">��ϵ����</a> | <a target="_blank" href="http://www.8264.com/about-adservice.html">������</a> | <a target="_blank" href="http://www.8264.com/link/">������ַ��ȫ</a> | <a target="_blank" href="http://www.8264.com/sitemap">��վ��ͼ</a></p>
<div class="clear"></div>
</div>
</div><?php output(); ?></body>
</html>