<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="gbk">
    <title>��Ա���� - 8264�����˶�ѧУ</title>
    <meta name="viewport" content="minimal-ui,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="MobileOptimized" content="width">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css?20170908">
    <script src="http://static.8264.com/static/js/exam/jquery-1.9.1.min.js" type="text/javascript"></script>
    <style type="text/css">.banner-wrapper{position:relative}.banner__img{display:block;width:100%}.teacher-detail{position:absolute;left:0;bottom:95px;right:0;padding-left:25px}.teacher-detail__name{font-size:24px;color:#fff;font-weight:bold}.teacher-detail__clubName{font-size:13px;color:#ddd;margin-top:6px}.teacher__avatar{position:absolute;right:10%;bottom:40px;z-index:101;background-color:#fff;box-shadow:0 2px 8px rgba(65,69,77,.2);padding:3px;border-radius:2px;width:28%}.teacher__avatar--img{display:block;width:100%}.content-main{margin-top:-75px;background-color:#fff;position:relative;z-index:9;border-radius:10px 10px 0 0;box-shadow:0 -2px 10px rgba(0,0,0,.1);padding-bottom:52px}.content-main__head{padding:20px}.content-main__head h3{font-size:18px;font-weight:bold;color:#4f5560}.content-main__body{padding:0 20px}.content-main__body p{margin-bottom:20px;font-size:15px;color:#666;line-height:24px}</style>

    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?49299785f8cc72bacc96c9a5109227da";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>

<body>
<style>
    body{ background-color: #f8f8f8; }
</style>
<!--ͷ����ʼ-->
<?php if($isWechat == 0) { ?>
<div class="header-content">
    <div class="home-icons" style="display: none;">
        <a href="http://www.8264.com/xuexiao/">��ҳ</a>
    </div>
    <div class="goback-icons">
        <a href="http://www.8264.com/xuexiao/">����</a>
    </div>
    <div class="logo">
        <a href="#">
            <img src="http://static.8264.com/static/images/exam/logo.png" alt="">
        </a>
    </div>
</div>
<?php } else { if($phonetype == 'android') { ?>
<a href="<?php echo $back_url;?>" class="chat-back"></a>
<?php } } ?>
<div class="uercenterbranner">
    <div class="uercentertxbox">
        <img src="<?php echo $headimg;?>" alt="">
        <span <?php if($vip_status == 1) { ?>class="hover"<?php } ?>></span>
    </div>
    <div class="uercentertoprbox">
        <div class="uercentertnamebox"><?php echo $nickname;?><em>��ID:<?php echo $uid;?>��</em></div>
        <div class="uercentertdatebox"><?php echo $vip_zh;?></div>
    </div>
</div>
<div class="quanyititlebox">������Ա��Ȩ</div>
<div class="ucenterqybox">
    <ul>
        <li>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward">
                <img src="http://static.8264.com/static/images/exam/q1.png" alt="">
                <span>����ר���ܼ�</span>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=equipment">
                <img src="http://static.8264.com/static/images/exam/q2.png" alt="">
                <span>���װ������</span>
            </a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/video.html">
                <img src="http://static.8264.com/static/images/exam/q5.png" alt="">
                <span>�����Ƶ�γ�</span>
            </a>
        </li>
        <li>
            <a href="https://www.agoda.com/zh-cn/8264">
                <img src="http://static.8264.com/static/images/exam/q6.png" alt="">
                <span>ȫ��Ƶ��ۿ�</span>
            </a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/wap.php?app=default&amp;storeidn=12012&amp;wechatfrom=">
                <img src="http://static.8264.com/static/images/exam/q7.png" alt="">
                <span>��Ʒ��·�ۿ�</span>
            </a>
        </li>
        <li>
            <a href="https://cps.qixin18.com/qdf1004346?bbsbxnew">
                <img src="http://static.8264.com/static/images/exam/q8.png" alt="">
                <span>���ౣ���Ż�</span>
            </a>
        </li>
    </ul>
</div>
<?php if($vip_status == 0) { ?>
<a href="javascript:///" class="uerlinkbutton vip_pay">��ͨ��Ա</a>
<?php } ?>

<div class="thisadbox">
    <script type='text/javascript' src='http://bbs.8264.com/api.php?mod=ad&adid=custom_480'></script>
</div>

<div class="quanyilisttitle">������Աר��Ȩ��</div>
<div class="qilistbox" style="padding-bottom: 60px">
    <ul>
        <li>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=equipment" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/07/032952xb3kzvtifz2s1hhk.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>1500Ԫ8264����װ�����</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <?php if($vip_status == 1) { ?>
            <?php if($equipment_order == 1) { ?>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=equipment" class="dianjigou">������ȡ</a>
            <?php } else { ?>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=equipment" class="dianjigou">�����ȡ</a>
            <?php } ?>
            <?php } else { ?>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=equipment" class="dianjigou">�����ȡ</a>
            <?php } ?>
        </li>
        <li>
            <a href="https://cps.qixin18.com/qdf1004346?bbsbxnew" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/061204uhxnsh0mfbj8vryf.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>ȫ�����Ᵽ��75�۷���</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=3" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/wap.php?app=default&amp;storeidn=4&amp;wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/091208tpj9fcwy62chytfl.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>200-2000Ԫȫ��������ѡ��·ר���ػ�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/video.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/07/032952fdax5a4y4homajb6.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>����רҵ�γ���Ƶ���</span>
                    <div class="quanyiinfobottombox">
                        <em>������Ϊ��Ա��</em>
                    </div>
                </div>
            </a>

            <a <?php if($vip_status == 1) { ?>href="http://www.8264.com/xuexiao/video.html" class="dianjigou"<?php } else { ?>href="javascript:///" class="dianjigou vip_pay" <?php } ?>>�����ȡ</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-171897?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_171897&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/07401035hhyvq38g51iym0.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>����������Ʒ���λ�Ա����1100Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-169106?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_169106&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/074010wstnmul3a6wd8d9r.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>Բ�����أ�����������Ͽ�������Ա����270Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-54.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/081230lfsgmtr9y6ohox1s.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>88���ζ��ȫ����ջ�׽�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=2" class="dianjigou">�����ȡ</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-172263?app=goods&goods_id=172263&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201710/19/013438bz29j2hgc3mavx1l.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span> 9��AHA Heartsaver �γ̣��㶫վ��</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-172406?app=goods&goods_id=172406&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201710/19/093151ub9kfxku2ykzqv1k.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>�Ͻ�����Խ���������ɳĮ̽��֮�ñ�������250Ԫ��</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="https://www.agoda.com/zh-cn/8264" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/061204nydrhaifeuff43k7.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>93��Agodaȫ��Ƶ��Ż���</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=2" class="dianjigou">�����ȡ</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-154281?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_154281&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/074010jx0fjnoyf1agq8be.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>��������������֡��ຣ����Ա����250Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-151417?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_151417&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/074010cn86dbninz3908w2.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>�������ߡ������Ƕ���ɫ���ѧԺ��Ա����200Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-29.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/0612044cfvqkx8b43tanpc.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>9�۵�һ��Ӧ���ȿγ��Ż�ȯ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=2" class="dianjigou">�����ȡ</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-55.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/31/021341vzbny7l9wyodqqg6.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>9.5��ȫ����ͻ����������������ػ�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-2295?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_2295&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/074010rqrbfcrm1f31fbmk.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>�����ຣ����С���ߡ��迨�κ���Ա����150Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-235?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_235&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/074010hbo1zfmwcfixwtqy.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>318�����ߡ������Ƕ����¶��� ������9���λ�Ա����300Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-28.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/081620l0wm4chk3fq06ke2.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>Ұ������300-500Ԫ���������Ż�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://hd.8264.com/xianlu-171448" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/0816201qirfruem2510ic8.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>ɳĮ����ͽ��498Ԫ���������ػ�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-223?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_223&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/074010xcnyg1kdc37dk005.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>ͽ������ȫ�߻�Ա����190Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://m.hd.8264.com/xianlu-244?back_url=http://m.hd.8264.com/dianpu-4?weizhi_page=1&#indexlist_244&wechatfrom=" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201709/22/074010j5ul27hl0t99bmwj.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>�Ჴ�����8���λ�Ա����200Ԫ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-43.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/0812308bof7z6gdpnjlygh.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>9�ۺ���Ǳˮ���顢��֤�γ�ר���Ż�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-51.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/090138l5qk0a6q8ajhnb94.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>200-500����EBC������˹³��·����ר��</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-62.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201710/30/084957p3nztp7p1ydyad1q.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>�Ϻ���ʿ����Ʊ40Ԫ�Ż��룬��Ա����</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-47.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201710/30/055408cbbqdgp42anprx1b.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>���٤�γ̵���19.9Ԫ����Ա������������ػ�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-61.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201710/26/092410z7ns8nj07lch20si.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>�Ķ���̽����· ��������9���Ż�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-36.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/09013875owys1szg6mgx1d.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>1000-2000Ԫ����ʮ��ͽ����·��7+2ϵ�������Ż�ȯ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://hd.8264.com/xianlu-171054" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/0912083gxgnp6gskbllmwd.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>2880Ԫŷ�޺�����·���������ػ�</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-50.html" class="detail-info">
                <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/081230wzv3ybq5xld9fd9a.jpg!t1w1500h1500" alt=""></div>
                <div class="qiyinfobox">
                    <span>100-300Ԫ������������ѵ�γ��Ż�ȯ</span>
                    <div class="quanyiinfobottombox">
                        <em>�鿴����</em>
                    </div>
                </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://hd.8264.com/xianlu-171823" class="detail-info">
            <div class="imgsquer"><img src="http://image1.8264.com/album/201708/17/090201z8p3x5icf5jg0l43.jpg!t1w1500h1500" alt=""></div>
            <div class="qiyinfobox">
                <span>8��Ƥ��ͧ����γ������ػݣ��㶫վ��</span>
                <div class="quanyiinfobottombox">
                    <em>�鿴����</em>
                </div>
            </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
        <li>
            <a href="http://www.8264.com/xuexiao/shidian-56.html" class="detail-info">
            <div class="imgsquer"><img src="http://image1.8264.com/album/201708/31/021341u3f15jrh72ow9otg.jpg!t1w1500h1500" alt=""></div>
            <div class="qiyinfobox">
                <span>9.5���ʱ��γ������ػ�</span>
                <div class="quanyiinfobottombox">
                    <em>�鿴����</em>
                </div>
            </div>
            </a>
            <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward&amp;type=4" class="dianjigou">��ѯ�ͷ�</a>
        </li>
    </ul>
</div>
<style>
    .goto_fatie_box {
        position: fixed;
        bottom: 25px;
        right: 20px;
        width: 55px;
        z-index: 99999;}
    .goto_fatie_box img {
        width: 100%;
    }
</style>
<div class="goto_fatie_box">
    <a href="http://www.8264.com/xuexiao/"><img src="http://static.8264.com/static/mobile/images/index.png" /></a>
</div>
<div class="bottom_bar" style="padding:0px;">

    <div class="zixunlink">
        <a href="http://www.8264.com/exam.php?ctl=topic&amp;act=steward">
            <i></i>
            ��ѯVIP�ͷ�
        </a>
    </div>
    <div class="buybutton">
        <?php if($vip_status == 0) { ?>
        <a href="javascript:///" class="vip_pay">
            ��������
            <span>������Ա����<?php echo $total_fee_show;?></span>
        </a>
        <?php } else { ?>
        <a href="javascript:///">
            ���Ѿ��ǻ�Ա
        </a>
        <?php } ?>
    </div>
</div>
<div class="login" style=" margin: 0px auto; max-width: 630px; min-width: 320px;background: #f8f8f9;position: fixed;top: 0;left: 0;right: 0;bottom: 0;display:none;z-index: 99999;"></div>

<div class="page" style=" margin: 0px auto; max-width: 630px; min-width: 320px;padding: 12px 20px 0;font-size: 15px;z-index: 999999;position: fixed;top: 10px;left: 0px;display:none;right: 0px;">
    <div class="head">
        <div class="close-x"></div>
    </div>
    <div class="logintitle">
        <span>��д�ֻ���</span>
        <em>Ϊ�������˻���ȫ������֤�ֻ���</em>
    </div>
    <div id="loginForm" class="mlogin">
        <div class="field tel">
            <div class="label password">�ֻ���</div>
            <div class="field-control">
                <input id="phone" class="input-required" name="phone" placeholder="�ֻ���">
            </div>
            <div class="icon-clear"></div>
        </div>

        <div class="field yzm">
            <div class="label yanzhengma">��֤��</div>
            <div class="field-control">
                <input id="yzcode" type="text" class="input-required" placeholder="��֤��">
            </div>
            <div class="icon-clear"></div>
            <div class="yzmbutton">
                <input id="codebutton" type="button" value="��ȡ��֤��" onclick="sendMessage();">
            </div>
        </div>
        <div class="tips" style="display:none;"><i class="icon-mark"></i>�û����Ѵ���</div>

        <div class="submit">
            <button id="submit-btn" class="button" type="submit"  onclick="validate();">�ύ</button>
        </div>

    </div>
</div>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript"></script>
<script>
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage['appId'];?>',
        timestamp: '<?php echo $signPackage['timestamp'];?>',
        nonceStr: '<?php echo $signPackage['nonceStr'];?>',
        signature: '<?php echo $signPackage['signature'];?>',
        jsApiList: [
            'onMenuShareTimeline',
            // ����Ҫ���õ� API ��Ҫ�ӵ�����б���
            'onMenuShareAppMessage'
        ]
    });
    wx.ready(function () {
        // ��������� API
        wx.onMenuShareTimeline({
            title: '���롾8264������Ա��1500Ԫ¶Ӫװ������죡', // �������
            link: '<?php echo $signPackage['url'];?>', // ��������
            imgUrl: 'http://static.8264.com/static/mobile/images/share.jpg', // ����ͼ��
            success: function () {
                // �û�ȷ�Ϸ����ִ�еĻص�����
            },
            cancel: function () {
                // �û�ȡ�������ִ�еĻص�����
            }
        });
        wx.onMenuShareAppMessage({
            title: '���롾8264������Ա��1500Ԫ¶Ӫװ������죡', // �������
            desc: '�����˶�֪ʶѧϰ�Ϳ���ϵͳ - 8264.com', // ��������
            link: '<?php echo $signPackage['url'];?>?wx=1', // ��������
            imgUrl: 'http://static.8264.com/static/mobile/images/share.jpg', // ����ͼ��
            type: '', // ��������,music��video��link������Ĭ��Ϊlink
            dataUrl: '', // ���type��music��video����Ҫ�ṩ�������ӣ�Ĭ��Ϊ��
            success: function () {
                // �û�ȷ�Ϸ����ִ�еĻص�����
            },
            cancel: function () {
                // �û�ȡ�������ִ�еĻص�����
            }
        });
    });

</script>

<script type="text/javascript">

    jQuery(".vip_pay").click(function() {
        $.ajax({
            type: 'POST',
            url: '/exam.php?ctl=topic&act=is_vip',
            async:false,
            dataType: 'json',
            success:function(data){
                if(data.res == 1){
                    jQuery(".login").show();
                    jQuery(".page").show();
                }else if(data.res == 0){
                    //��ת֧��ҳ��
                    window.location.href = 'http://www.8264.com/xuexiao/wechat_pay/pay.html?attach=1';
                }
            }
        });
    });
    jQuery(".close-x").click(function() {
        jQuery(".login").hide();
        jQuery(".page").hide();
    });

    var InterValObj; //timer����������ʱ��
    var count = 60; //���������1��ִ��
    var curCount;//��ǰʣ������

    function sendMessage() {
        if(curCount){
            curCount = curCount;
        }else{
            curCount = count;
        }

        if(checkMobileState()){

            //����buttonЧ������ʼ��ʱ
            $("#codebutton").attr("disabled", "disabled");
            $("#codebutton").val(curCount + "����ط�");
            InterValObj = window.setInterval(SetRemainTime, 1000); //������ʱ����1��ִ��һ��

            //���̨���ʹ�������
            $.ajax({
                type: 'POST',
                url: 'http://www.8264.com/exam.php?ctl=topic&act=ajaxMobilesend',
                async:false,
                data: {phone:$.trim($("#phone").val())},
                dataType: 'json',
                success: function(data){
                    if(data.return_state=='-1'){
                        alert('������֤������̫Ƶ�������Ժ����ԣ�');
                        //window.location.href=SITE_URL+'/wap.php?app=claim';
                        return false;
                    }
                    if(data.return_state=='-2'){
                        alert("���ŷ���ʧ�ܣ�����ϵ�ͷ�!");
                        return false;
                    }
                }
            });
        }

    }

    //timer������
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//ֹͣ��ʱ��

            $("#codebutton").removeAttr("disabled");//���ð�ť

            $("#codebutton").val("������֤��");
        }
        else {
            curCount--;
            $("#codebutton").val(curCount + "����ط�");
        }
    }

    function checkMobileState(){
        var phone = jQuery("#phone").val();
        phone = jQuery.trim(phone);

        if(phone == ''){
            r_error("�������ֻ���", 'tips', 'tel');
            return false;
        }

        if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){
            r_error("��������ȷ�ֻ���", 'tips', 'tel');
            return false;
        }

        rm_error("tips", "tel");
        return true;
    }

    function checkYzCode(){
        var code = jQuery("#yzcode").val();
        code = jQuery.trim(code);
        if(code.length != 4){
            r_error("��֤�����", 'tips', 'yzm');
            return false;
        }

        var phone = jQuery.trim(jQuery("#phone").val());

        //У�� ��֤��
        $.ajax({
            type: 'POST',
            url: '/exam.php?ctl=topic&act=ajaxcheckcode',
            async:false,
            data: {code:$.trim($("#yzcode").val()), phone:phone},
            dataType: 'json',
            success:function(data){
                if(data.return_state == '1'){
                    rm_error("tips", "yzm");
                    up_info(phone, data.vcode);
                }else if(data.return_state == '-1'){
                    r_error("��֤�����,����ϸ�鿴����", 'tips', 'yzm');
                    return false;
                }else if(data.return_state == '-2'){
                    r_error("��֤����ʧЧ�������»�ȡ", 'tips', 'yzm');
                    return false;
                }else{
                    r_error("�Ƿ�����", 'tips', 'yzm');
                    return false;
                }
            }
        });
    }

    function up_info(phone, vcode){
        if(phone == ''){
            alert("�Ƿ�������");
            return false;
        }

        //��¼
        $.ajax({
            type: 'POST',
            url: '/exam.php?ctl=topic&act=up_info',
            async:false,
            data: {phone:phone, vcode:vcode},
            dataType: 'json',
            success:function(data){
                if(data.flag == 1){
                    jQuery(".login").hide();
                    jQuery(".page").hide();
                    window.location.href = 'http://www.8264.com/xuexiao/wechat_pay/pay.html?attach=1';
                }else if(data.flag == -1){
                    alert('�Ƿ���Դ');
                }else{
                    alert('�Ƿ��û�');
                }
            }
        });
    }

    function validate() {

        if(checkMobileState()){
            checkYzCode();
        }

        return false;
    }


    function r_error(msg, tipclass, errorclass){
        jQuery("."+tipclass).html("<i class='icon-mark'></i>"+msg).show();
        jQuery("."+errorclass).addClass("error");
    }
    function rm_error(tipclass, errorclass){
        jQuery("."+tipclass).html("").hide();
        jQuery("."+errorclass).removeClass("error");
    }
</script>
</body>
</html>