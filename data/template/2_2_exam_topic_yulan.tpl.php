<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('yulan', 'common/header_8264_new');?><?php include template('common/header_8264_new'); ?><link rel="stylesheet" href="http://static.8264.com/static/css/common/style.css?<?php echo VERHASH;?>">
<link rel="stylesheet" href="http://static.8264.com/static/css/exam/global/1.0.1/css/exam.css?<?php echo VERHASH;?>">
<link rel="stylesheet" href="/static/css/exam/css_style.css?<?php echo VERHASH;?>">
<script src="/static/js/exam/app.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script>
    jQuery("#h_ctj").addClass("s3");
    var ICO_Path="/ICO/101/";
    var PIC_Path="/PIC/";
    var ExamImgPath="http://tp.mnks.cn/";
    var kModel="kmy_sxlx";
    var kTikuID="2013";
    var HotKeyModel="lx";
    var kCx="xc";
    var kKm="kmy";
    var kMk="sjlx";
    var zid="";
    var type = "<?php echo $type;?>";
    var catid = "<?php echo $catid;?>";
    var backUrl="/km1";
    var TitUrl="/km1_fzks";
    jQuery("#h_sjlx").addClass("hot");
</script>

<header class="header_new">
    <a class="icon4" href="http://www.8264.com/kaoshi/"></a>
    <a href="http://www.8264.com/kaoshi/" class="logo"></a>
</header>
<div class="header">
        <div class="layout">
            <div class="icoHill"></div>
            <div class="headerL">
                <h1>
                    <span class="country">考试系统</span>
                </h1>
                <div class="site">
                    <a href="http://www.8264.com/kaoshi/">
                        预览模式
                    </a>
                    <em>></em>
                    <a class="titleoverflow200"><?php echo $catname;?><div class="boxtm"></div></a>
                </div>
            </div>
            <style type="text/css">
            .dsad{position:absolute;right:230px;top:18px}
            </style>
            <div class="dsad"><?php echo adshow("custom_290"); ?></div>
        </div>
</div>
<div id="wp" style="margin-bottom:30px;">
    <!--主体内容开始-->
    <div class="w980">
        <div class="mainBox" id="mainBox">
            <script>
                var ICO_Path="/static/images/exam/icons/";
                var kModel="8264_ep";var kTikuID="2016";
                var kKm="km1";var kCx="xc";var kDrive="C1";
                var zid="";
            </script>
            <style>body {background:#F5F6EF;}</style>
            <div id="ExamArea">
                <h3 id="ExamTit">
                    &nbsp;&nbsp;<?php echo $question['title'];?> <?php if($question['qtype'] == 3) { ?> <font color="#FF2266">[多选题]</font> <?php } ?> (题号：<?php echo $question['qid'];?>)

                </h3>
                <ul id="ExamOpt">
                    <?php if(count($an_arr) > 0) { ?>
                        <li id="ExamOptA" class="kH"><?php echo $an_arr['0'];?></li>
                        <li id="ExamOptB" class="kH"><?php echo $an_arr['1'];?></li>
                            <?php if(count($an_arr) > 2) { ?>
                            <li id="ExamOptC" class="kH"><?php echo $an_arr['2'];?></li>
                            <li id="ExamOptD" class="kH"><?php echo $an_arr['3'];?></li>
                            <?php if(count($an_arr) > 4) { ?>
                                <li id="ExamOptE" class="kH"><?php echo $an_arr['4'];?></li>
                                <?php if(count($an_arr) > 5) { ?>
                                <li id="ExamOptF" class="kH"><?php echo $an_arr['5'];?></li>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>
                    <?php } ?>
                </ul>
                <h5 style="display: none;"></h5>
                <h6></h6>
            </div>
            <div id="ExamNote" style="display: block;">
                <div class="fcc">
                    <b>试题分析</b><i></i>
                </div>
                <p id="ENC"><strong>标准答案</strong>：<?php echo $question['right_answer'];?><br><strong>本题分析</strong>：<?php echo $question['analysis'];?></p>
                <?php if($question['imgurl']) { ?>
                <br><br><img src="<?php echo $question['imgurl'];?>" />
                <?php } ?>
                <?php if($question['videourl']) { ?>
                <br><br><embed src="<?php echo $question['videourl'];?>" />
                <?php } ?>
            </div>
            <br>
            <div id="ExamAnswerPlan"></div>
            <div id="ExamTipArea" style="display: none;"></div>
            <div id="ExamOrderKep" style="display: none; height: 0px;"><p class="fcc"></p></div>
            
            <div class="Content" style="display: none;">
                <p class="RndExam"></p>
            </div>
                        
                    </div>
        <div class="TipMask"></div>
        <div class="MaskTip"></div>
        
    </div>
    <!--主体内容结束-->
</div>
<br/>