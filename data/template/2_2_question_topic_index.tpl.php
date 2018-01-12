<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index', 'common/header_8264_new');
0
|| checktplrefresh('./template/8264/question/topic/index.htm', './template/8264/common/zhidemai.htm', 1509517903, '2', './data/template/2_2_question_topic_index.tpl.php', './template/8264', 'question/topic/index')
|| checktplrefresh('./template/8264/question/topic/index.htm', './template/8264/question/seditor_new_2016.htm', 1509517903, '2', './data/template/2_2_question_topic_index.tpl.php', './template/8264', 'question/topic/index')
|| checktplrefresh('./template/8264/question/topic/index.htm', './template/8264/dianping/showview_credit_narrow.htm', 1509517903, '2', './data/template/2_2_question_topic_index.tpl.php', './template/8264', 'question/topic/index')
|| checktplrefresh('./template/8264/question/topic/index.htm', './template/8264/common/footer_8264_new.htm', 1509517903, '2', './data/template/2_2_question_topic_index.tpl.php', './template/8264', 'question/topic/index')
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
.wenticontentp img{ max-width:600px; max-heiht:600px;margin:5px 0px;display: block;}
.editable_content img{max-width:540px;max-heiht:600px;margin:0 0 22px;display: block;}
 .gxblist img {
border-radius: 50%;
    float: left;
    height: 48px;
    width: 48px;
}
 .site .titleoverflow200 {
    height: 20px;
    overflow: hidden;
    position: relative;
    text-overflow: clip;
    white-space: nowrap;
    width: 270px;
}
.boxtm {
    background: rgba(0, 0, 0, 0) url("http://static.8264.com/static/images/common/topic-mask_g.png") no-repeat scroll left top;
    bottom: 0;
    height: 20px;
    position: absolute;
    right: 0;
    width: 80px;
}
  .site a, .site em {
    float: left;
    margin-right: 3px;
}
</style>
<header class="header_new">
    <a class="icon4" href="http://www.8264.com/wenda/"></a>
    <a href="http://www.8264.com/wenda/" class="logo"></a>
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
                    <?php if($topic['topshowlable']) { ?>
<em>></em><?php echo $topic['topshowlable'];?>
<?php } ?>
<em>></em>
                    <a class="titleoverflow200"><?php echo $topic['title'];?><div class="boxtm"></div></a>
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
            <div class="l_660">
                <!--提问部分开始-->
                <div class="askbox">
                    <h2 class="askbigtitle"><?php echo $topic['title'];?></h2>
<div class="tagbox clear_b">
                        <div class="ques-labels">
                        <?php echo $topic['showlable'];?>
                        </div>
                        <div class="extra-item">
                        <span class="hdicon"><?php echo $topic['replynum'];?> 回答</span>
                        <span class="liulanicon"><?php echo $topic['viewnum'];?> 浏览</span>
                        </div>
                    </div>

                    <p class="wenticontentp">
<?php echo $topic['content'];?>
<?php if($topic['pic1']) { ?><img class="lazy" src="<?php echo $topic['pic1'];?>" onclick="zoom(this,this.src)"><?php } if($topic['pic2']) { ?><img class="lazy" src="<?php echo $topic['pic2'];?>" onclick="zoom(this,this.src)"><?php } if($topic['pic3']) { ?><img class="lazy" src="<?php echo $topic['pic3'];?>" onclick="zoom(this,this.src)"><?php } if($topic['pic4']) { ?><img class="lazy" src="<?php echo $topic['pic4'];?>" onclick="zoom(this,this.src)"><?php } ?>
</p>
                    <div class="czbox clear_b" style="display:none;">
                        <!--<div class="name_time">
                            <span><?php echo $topic['author'];?></span>
                            <span><?php echo dgmdate($topic[dateline], 'Y-m-d H:i'); ?></span>
                        </div>-->
<?php if(!in_array($_G['uid'],$replyuserlist)||empty($replyuserlist)) { ?>
<a href="wenda/<?php echo $topic['topicid'];?>.html#areply" class="ianswer">我来回答</a>
<?php } else { ?>
<a href="wenda/<?php echo $topic['topicid'];?>.html#answerone<?php echo $_G['uid'];?>" class="ianswer">我来回答</a>
<?php } ?>
                        <div class="sharebox">
<a href="javascript:(function(){window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent(document.title)+'&url='+encodeURIComponent(location.href)+'&source=bookmark','_blank','width=450,height=400');})()" title="新浪微博分享" class="sinaicon"></a>
                            <a  href="javascript:void(0);" onclick="window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href));return false;" title="分享到QQ空间" class="qqwbicon"></a>
                            <a href="javascript:void(0)" onclick="postToWb();" class="weixinicon"></a>
                        </div>
                    </div>
                </div>
                <!--提问部分结束-->
<div style=" padding:10px 0px 0px 0px;"><?php echo adshow("custom_341"); ?>                </div>
<!--回答开始列表开始-->
                <div class="answerlistbox">
                    <!--单条情况开始-->
<?php if(!$is_editreply) { if(is_array($replylist)) foreach($replylist as $reply) { ?>                    <div class="answerone clear_b" id="answerone<?php echo $reply['authorid'];?>" name ="answerone<?php echo $reply['authorid'];?>">
                        <a href="http://u.8264.com/home-space-uid-<?php echo $reply['authorid'];?>-do-profile.html" class="tx48" target="_blank"><?php echo discuz_uc_avatar($reply['authorid']); ?>                        </a>
                        <div class="answer_r_box">
                            <div class="answer_author_info clear_b">
                                <span><?php echo $reply['author'];?></span>

                                <em><!--<?php echo dgmdate($reply[dateline], 'Y-m-d H:i'); ?>--></em>
                            </div>
                            <div class="editable_content smallyw" style="display:none">
<?php if(mb_strlen($reply['textrcontent'], 'GBK') > 300 ||$reply['imgcount'] >1) { ?>
                                <p class="rcontentp"><?php echo cutstr($reply['textrcontent'],300,'...'); ?> <a href="javascript:void(0)" class="ckyw">[查看全文]</a>
<?php echo $reply['imgfirst'];?>
</p>
<?php } else { ?>
<p class="rcontentp"><?php echo $reply['newrcontent'];?></p>
<?php } ?>
                            </div>
<div class="editable_content bigyw">
                                <p class="rcontentp"><?php echo $reply['rcontent'];?></p>
                            </div>


<div class="zm-item-meta clear_b">
                                <div class="hficon" ptopicid='<?php echo $reply['ref_topicid'];?>' preplyid="<?php echo $reply['replyid'];?>">
                                    回复<span id='hfspan<?php echo $reply['replyid'];?>'><?php if($reply['replynum'] > 0) { ?>(<?php echo $reply['replynum'];?>)<?php } ?></span>
                                </div>
                                <div class="jbdzbox">
<?php if($_G['uid'] ) { if($reply['tid'] > 0 && $_G['groupid'] == 1) { ?>
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $reply['tid'];?>&amp;extra=#pid<?php echo $reply['tiddata']['0'];?>" target="_blank" >编辑</a>
<?php } if($reply['tid'] == 0 && ($_G['uid']==$reply['authorid'] || $_G['groupid'] == 1) ) { ?>
<a href="javascript:void(0)" onclick="reply_edit(<?php echo $reply['ref_topicid'];?>, <?php echo $reply['replyid'];?>, <?php echo $reply['authorid'];?>)" >编辑</a>
<?php } if($_G['groupid'] == 1) { ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="reply_delete(<?php echo $reply['ref_topicid'];?>, <?php echo $reply['replyid'];?>, <?php echo $reply['authorid'];?>)" >删除</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a class="goup" <?php if($reply['isup']) { ?>style="display:none"<?php } else { ?>style=""<?php } ?> href="javascript:void(0)" onclick="updown(<?php echo $reply['replyid'];?>, <?php echo $reply['authorid'];?>, 1)" >置顶</a>
<a class="godown" <?php if($reply['isup']) { ?>style=""<?php } else { ?>style="display:none"<?php } ?> href="javascript:void(0)" onclick="updown(<?php echo $reply['replyid'];?>, <?php echo $reply['authorid'];?>, 0)" >取消置顶</a>
<?php } } ?>

                                    <a <?php if($_G['uid']) { ?> href="javascript:void(0)" onclick="ajaxpostGood(<?php echo $reply['replyid'];?>)" <?php } elseif(empty($_G['uid'])) { ?> onclick="showWindow('login', this.href);hideWindow('register');" href="member.php?mod=logging&amp;action=login" target="_blank" <?php } ?> class="zticon">
<span id='ztspan<?php echo $reply['replyid'];?>'><?php if(in_array($_G['uid'],$reply['gooddata'])) { ?> 已赞<?php } else { ?> 赞同<?php } ?> <?php if($reply['goodnum'] > 0) { ?>(<?php echo $reply['goodnum'];?>)<?php } ?>
</a>

                                   <!-- <?php if(mb_strlen($reply['textrcontent'], 'GBK') > 300 ||$reply['imgcount'] >1) { ?><a href="javascript:void(0)" class="sqlink">收起</a><?php } ?>-->
                                </div>
                            </div>
<div class="hfboxlist" style="display:none">
                                <span class="uparrow"></span>

<div id="hfone<?php echo $reply['replyid'];?>" class="hfonediv" style="max-height:200px; overflow-x: hidden;"></div>
                                <div class="hfformtextarea">
<form action='' onsubmit="ajaxpostComment('<?php echo $reply['ref_topicid'];?>', '<?php echo $reply['replyid'];?>');return false;">
                                    <textarea placeholder="写下你的评论..." id="textarea<?php echo $reply['replyid'];?>"></textarea>
<div class="tjsubmitbox">
<?php if($_G['uid']) { ?>
<input type="submit" value="回复" class="tjsubmit" id="tjsubmit<?php echo $reply['replyid'];?>">
<?php } elseif(empty($_G['uid'])) { ?>
您需要登录后才可以回复，
<a  class="xi2"onclick="showWindow('login', this.href);hideWindow('register');" href="member.php?mod=logging&amp;action=login" target="_blank">登录</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="xi2" onclick="showWindow('register', this.href);hideWindow('login');" href="member.php?mod=register" target="_blank">注册</a>

<?php } ?>
</div>
</form>
                                </div>
                            </div>

                        </div>
                    </div>
<?php } } ?>
                    <!--单条情况结束-->
                </div>
                <!--回答开始列表结束-->

<!--回复框开始-->
<?php if(!in_array($_G['uid'],$replyuserlist)||empty($replyuserlist)) { ?>
                <div class="ltitle">我来回答<a name='areply'id='areply'>&nbsp;</a></div>
                <div class="activate_mask_tip_answer">
<form id="replyform_<?php echo $topic['topicid'];?>" name="replyform_<?php echo $topic['topicid'];?>" method="post" autocomplete="off" action="question.php?ctl=topic&amp;act=doreply&amp;topicid=<?php echo $topic['topicid'];?>" onsubmit="parsepmcode(this);">

<!--<input type="hidden" name="editreplyid" value="<?php echo $replylist['0']['replyid'];?>" />	-->
<input type="hidden" name="taskid" value="<?php echo $taskid;?>" />
<input type="hidden" name="channel" value="<?php echo $channel;?>" />
<input type="hidden" name="referer" value="<?php echo $_G['referer'];?>" />
<input type="hidden" name="replysubmit" value="true" />
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />

                    <div class="pinglunmid pinglunmid_xx answercz clear_b" style="width:630px;">
<div class="edierbar clboth answercz"><?php $seditor = array('reply', array('', '')); if(in_array('bold', $seditor['1'])) { ?>
<a href="javascript:;" title="文字加粗" class="bold"<?php if(empty($seditor['2'])) { ?> onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[b]', '[/b]')"<?php } ?>></a>
<?php } if(in_array('color', $seditor['1'])) { ?>
<div class="colorbox">
<a href="javascript:;" class="gray" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=#585858]', '[/color]')" title="深灰色"></a>
<a href="javascript:;" class="bule" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Blue]', '[/color]')" title="蓝色"></a>
<a href="javascript:;" class="red" onclick="seditor_insertunit('<?php echo $seditor['0'];?>', '[color=Red]', '[/color]')" title="红色"></a>
</div>
<?php } if(in_array('img', $seditor['1'])) { ?>
<a id="<?php echo $seditor['0'];?>img" href="javascript:;" title="图片" class="fmg"<?php if(empty($seditor['2'])) { ?> onclick="seditor_menu('<?php echo $seditor['0'];?>', 'img')"<?php } ?>>Image</a>
<?php } if(in_array('smilies', $seditor['1'])) { ?>
<a href="javascript:;" class="fsml" id="<?php echo $seditor['0'];?>sml"<?php if(empty($seditor['2'])) { ?> onclick="showMenu({'ctrlid':this.id,'evt':'click','layer':2});return false;"<?php } ?>>Smilies</a>
<?php if(empty($seditor['2'])) { ?>
<script src="data/cache/common_smilies_var.js?<?php echo VERHASH;?>" type="text/javascript" reload="1"></script>
<script type="text/javascript" reload="1">smilies_show('<?php echo $seditor['0'];?>smiliesdiv', <?php echo $_G['setting']['smcols'];?>, '<?php echo $seditor['0'];?>');</script>
<?php } } if(in_array('simpleupload', $seditor['1'])) { ?>
<div class="bq_fjimg" id="uploadpic">
<a href="javascript:;" class="fjimg"></a>
</div><?php require_once libfile('class/simpleupload'); ?><?php $flashstring = simpleUpload::getFlashStr("uploadpic", 24, 23); ?><?php echo $flashstring;?>
<script>
function flashcallback(type, data){
eval("var objbtn = " + data);
switch(type){
case -1:
//alert(objbtn.text);
break;
case 1:
//alert(objbtn.text);alert(objbtn.picurl);
//alert(1111);
//jQuery("#<?php echo $seditor['0'];?>message").val(jQuery("#<?php echo $seditor['0'];?>message").val() + "[img]" + objbtn.picurl + "[/img]");
seditor_insertunit('<?php echo $seditor['0'];?>', '[img]'+ objbtn.picurl, '[/img]');
break;
}
}
</script>
<?php } ?><!--<a class="gjms" href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?><?php if($_G['gp_from']) { ?>&amp;from=<?php echo $_G['gp_from'];?><?php } ?>" onclick="return switchAdvanceMode(this.href)">高级模式</a>-->
</div>
<div class="areatext areatext_xx">
<textarea rows="9" cols="45" name="message" class="pt" id="replymessage" onkeydown="ctrlEnter(event, 'replysubmit_btn');" style="width:610px; height:121px;" placeholder="分享你的答案..."><?php if($is_editreply) { ?><?php echo $replylist['0']['rcontent'];?> <?php } ?></textarea>
</div>
</div>
  <div class="tjsubmitbox">
  <?php if($_G['uid']) { ?>
  <button type="submit" name="replysubmit_btn" id="replysubmit_btn" value="true" class="kshf tjsubmit">回答</button>
  <?php } elseif(empty($_G['uid'])) { ?>
  您需要登录后才可以回答，
  <a  class="xi2"onclick="showWindow('login', this.href);hideWindow('register');" href="member.php?mod=logging&amp;action=login" target="_blank">登录</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="xi2" onclick="showWindow('register', this.href);hideWindow('login');" href="member.php?mod=register" target="_blank">注册</a>

  <?php } ?>
 </div>
</form>
                </div>
<?php } ?>
                <!--回复框结束-->

            </div>
            <!--左侧结束-->
            <!--右侧开始-->
            <div class="r_260">

<!--新添加模块开始-->
                <div class="wyfbbox">
                    <a href="http://bbs.8264.com/forum-post-action-newthread-fid-12.html" class="wytw">我要提问</a>
                    <?php if(!in_array($_G['uid'],$replyuserlist)||empty($replyuserlist)) { ?>
                    <a href="wenda/<?php echo $topic['topicid'];?>.html#areply" class="wyhd">我来回答</a>
                    <?php } else { ?>
                    <a href="wenda/<?php echo $topic['topicid'];?>.html#answerone<?php echo $_G['uid'];?>" class="wyhd">我来回答</a>
                    <?php } ?>
                </div>
                <div class="fxbox_r">
                    <div class="fxnumbox"><b><?php echo $topic['sharenum'];?></b>分享</div>
                    <div class="fxtxbox" id="fxtx"><?php if(is_array($topic['shareuids'])) foreach($topic['shareuids'] as $v) { ?><a><?php echo avatar($v, middle); ?></a>
<?php } ?>

                    </div>
                    <div class="fxtxbox" style="display:none;" id="fxbutton">
                        <a href="javascript:(function(){window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent(document.title)+'&url='+encodeURIComponent(location.href)+'&source=bookmark','_blank','width=450,height=400');})()"  class="fxtxa_fh"><img src="http://static.8264.com/static/css/ask/tps/i1/shareicon1.jpg" alt=""></a>
                        <a href="javascript:void(0)" onclick="postToWb();" class="fxtxa_fh"><img src="http://static.8264.com/static/css/ask/tps/i1/shareicon2.jpg" alt=""></a>
<script type="text/javascript">
function postToWb(){
var _t = encodeURI(document.title);
var _url = encodeURI(document.location);
var _appkey = encodeURI("appkey");//你从腾讯获得的appkey
var _pic = encodeURI('');//（列如：var _pic='图片url1|图片url2|图片url3....）
var _site = 'http://www.8264.com';//你的网站地址
var _u = 'http://v.t.qq.com/share/share.php?title='+_t+'&url='+_url+'&appkey='+_appkey+'&site='+_site+'&pic='+_pic;
window.open( _u,'转播到腾讯微博', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
}
</script>
                        <a href="javascript:void(0);" onclick="window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href));return false;" class="fxtxa_fh"><img src="http://static.8264.com/static/css/ask/tps/i1/shareicon3.jpg" alt=""></a>
                        <a href="javascript:void(0);"  class="share-link" ><img src="http://static.8264.com/static/css/ask/tps/i1/shareicon4.jpg" alt=""></a>
<div id="qrcodediv" style="width: 0%; height: 200px; position: absolute; top: 60px; left: 29px; overflow: hidden; border: 0px none;">
<img style="width:200px!important;height:200px!important; border-radius:0;margin:0;" src="http://www.8264.com/qrcode.php?output=1&amp;url=<?php echo $_G['siteurl'];?>wenda/share-<?php echo $topic['topicid'];?>-iswei-1-shareuid-<?php echo $_G['uid'];?>.html&amp;size=9">
</div>
                    </div>
                    <a href="javascript:void(0)" class="wyfxlink">我要分享</a>
                </div>
                <!--新添加模块结束-->

<div class="mt45">
                    <div class="rtitle">相关分类</div>
                    <div class="taglistfl clear_b">
                        <?php echo $topic['xgshowlable'];?>
                    </div>
                </div>

                <!--户外学校广告-->
                <div style="height: 229px;width:263px;overflow: hidden;">
                <div class="review-adv-box" style="display: none;">
<div class="ui-block ui-block-content">
<div class="review-adv-bd" style="padding:10px 22px;">
<div class="review-adv-info">
<p style="padding:15px 0 12px 0px">参与点评得8264币，精美奖品等你来兑换</p>
<div class="adv-info-link">
<a class="btn-write" href="http://www.8264.com/dianping.php?mod=<?php echo $mod;?>&amp;act=showview&amp;tid=<?php echo $tid;?>#write">去写点评</a>
<a target="_blank" href="http://bbs.8264.com/forum-483-1.html">奖品列表</a>
<a target="_blank" href="http://bbs.8264.com/thread-1641700-1-1.html">详细规则</a>
</div>
</div>
<div style="float:right">
<img src="http://static.8264.com/static/css/dianping/images/dpad.png" alt="">
</div>
</div>
</div>
</div>
<!-- 户外学校广告 -->
<style>
.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
.clear_b{ zoom: 1;}
.hotmudidibox{border:#e0e7eb solid 1px; border-bottom:0px; border-right:0px; margin-top:15px; width:262px;}
.hotmudidibox li{ width:130px; border-bottom:#e0e7eb solid 1px; border-right:#e0e7eb solid 1px; height:70px; float:left;}
.hotmudidibox li a{ display:block; height:72px; width:133px; text-align:center; overflow:hidden;}
.hotmudidibox li a:hover{text-decoration:none;}
.hotmudidibox li:hover,.hotmudidibox li.hover{ background:#508eff;}
.hotmudidibox li:hover span,.hotmudidibox li.hover span{ color:#fff;}
.hotmudidibox li:hover em,.hotmudidibox li.hover em{ color:#fff;}
.hotmudidibox li span{ font-size:16px; color:#31424e; display: block; width:100%; padding:13px 0px 0px 0px;}
.hotmudidibox li em{ font-size:12px; color:#93a4b0; display:block; width:100%;}
.hotmudidibox li i{ font-size:16px; color:#31424e; display: block; width:100%; line-height:70px; height:72px; font-style:normal;}
.hotmudidibox li:hover i,.hotmudidibox li.hover i{ color:#fff;}
</style>
<div class="hotmudidibox clear_b">
<ul>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-2.html" target="_blank">
        <span>安全急救考试</span>
        <em>268题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-1.html" target="_blank">
        <span>户外基础考试</span>
        <em>187题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-18.html" target="_blank">
        <span>野外生存考试</span>
        <em>91题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-15.html" target="_blank">
        <span>徒步知识考试</span>
        <em>77题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-5.html" target="_blank">
        <span>登山知识考试</span>
        <em>49题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-3.html" target="_blank">
        <span>攀岩知识考试</span>
        <em>43题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-8.html" target="_blank">
        <span>跑步知识考试</span>
        <em>71题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-16.html" target="_blank">
        <span>露营知识考试</span>
        <em>56题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-21.html" target="_blank">
        <span>户外装备考试</span>
        <em>72题</em>
    </a>
</li>
<li>
    <a href="http://www.8264.com/xuexiao/catinfo-24.html" target="_blank">
        <span>户外摄影考试</span>
        <em>84题</em>
    </a>
</li>
</ul>
</div>
<!-- //户外学校广告 -->
                </div>

<div class="mt45">
                    <div class="rtitle">相关问题</div>
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
</div>
<br/>
<script src="http://static.8264.com/static/js/jquery.nicescroll.min.js" type="text/javascript" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/jquery.lazyload.min.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
//图片延时加载
jQuery(".lazy").lazyload({
effect: "fadeIn",
appear: function() {
}
});
});

  //回复收齐开始
    jQuery(document).ready(function($) {
       $(".hficon").click( function () {
            if ($(this).hasClass('you')) {
                $(this).parents(".zm-item-meta").next(".hfboxlist").hide();
                $(this).removeClass('you');
            }else{
var ref_topicid= $(this).attr("ptopicid");
var replyid= $(this).attr("preplyid");
jQuery.getJSON("<?php echo $_G['siteurl'];?>question.php?ctl=topic&act=ajaxCommentlist&ref_topicid=" + ref_topicid + "&replyid=" + replyid, function(data) {
if(data){
var html = '';
$.each(data, function (i, item) {
html +='<div class="hfone">';
html +='<div class="hfname_time_cz clear_b">';
html +='<span>' + item.author + '</span>';
                            html +='<em>'+item.dateline+'</em>';
                            html +='</div>';
html +='<div class="hfinfocon">' + item.rcontent + '</div>';
                            html +='</div>';
});
$('#hfone'+replyid).html(html);
jQuery('#hfone'+replyid).niceScroll({
cursorcolor: "#ccc",
cursorwidth:"4px",
cursorborderradius:"2px",
cursorborder:"none",
boxzoom:false,
touchbehavior:false
});
}
});

                $(this).parents(".zm-item-meta").next(".hfboxlist").show();
                $(this).addClass("you");

            }
        });
    });
    //显示全文收齐js
    jQuery(document).ready(function($) {
       $(".ckyw").click( function () {
           $(this).parents(".answer_r_box").children('.bigyw').show();
   $(this).parents(".answer_r_box").find('.sqlink').show();
           $(this).parents(".smallyw").hide();
        });

       $(".sqlink").click( function () {
           $(this).parents(".answer_r_box").children('.bigyw').hide();
           $(this).parents(".answer_r_box").children('.smallyw').show();
   $(this).hide();
        });

    });

function ajaxpostComment(topicid,replyid){
var rcontent = jQuery('#textarea'+replyid).val();
rcontent = jQuery.trim(rcontent);
jQuery('#tjsubmit'+replyid).attr('disabled',true);
if(rcontent){
jQuery.post("<?php echo $_G['siteurl'];?>question.php?ctl=topic&act=ajaxpostComment&topicid=" + topicid + "&replyid=" + replyid,{rcontent:rcontent}, function(data) {
var item = jQuery.parseJSON(data);
if(item.nologin ==1){
window.location.href="<?php echo $_G['siteurl'];?>member.php?mod=logging&action=login";
}else if(item.nocomment == 1){
                    alert("抱歉，您无权限回复内容!");
                    return false;
                }else{
if(item.rcontent){
var html ='';
html +='<div class="hfone">';
html +='<div class="hfname_time_cz clear_b">';
html +='<span>' + item.author + '</span>';
html +='<em>'+item.dateline+'</em>';
html +='</div>';
html +='<div class="hfinfocon">' + item.rcontent + '</div>';
html +='</div>';

jQuery('#hfone'+replyid).prepend(html);
jQuery('#hfone'+replyid).animate({ scrollTop: 0 });
jQuery('#textarea'+replyid).val('');
jQuery('#hfspan'+replyid).html("("+item.replynum+")");
}
}
});
}else{
alert('请填写回复内容！');

}
jQuery('#tjsubmit'+replyid).attr('disabled',false);
return false;
}

function ajaxpostGood(replyid){
if(replyid){
jQuery.post("<?php echo $_G['siteurl'];?>question.php?ctl=topic&act=ajaxpostGood",{replyid:replyid}, function(data) {
var item = jQuery.parseJSON(data);
if(item.nologin ==1){
window.location.href="<?php echo $_G['siteurl'];?>member.php?mod=logging&action=login";
}else{
if(item.dogood==1){
if(item.goodnum > 0){
jQuery('#ztspan'+replyid).html("已赞("+item.goodnum+")");
}else{
jQuery('#ztspan'+replyid).html("赞同");
}
}else if(item.dogood== -1){
if(item.goodnum > 0){
jQuery('#ztspan'+replyid).html("赞同("+item.goodnum+")");
}else{
jQuery('#ztspan'+replyid).html("赞同");
}
}
}
});
}else{
alert('REPLY ID ERROR！');
}
}

jQuery(document).ready(function($) {
        $(".wyfxlink").click( function () {
            $("#fxtx").hide();
            $("#fxbutton").show();
        });
        $("#fxbutton a.fxtxa_fh").click( function () {
            jQuery.get("<?php echo $_G['siteurl'];?>question.php?ctl=topic&topicid=<?php echo $topic['topicid'];?>&is_wei=2&shareuid=<?php echo $_G['uid'];?>", function(data) {});
        });

$(document).click(function(i){
            if($(i.target).is("#fxbutton a,.wyfxlink")){
                return false;
            }
            $("#fxbutton").hide();
            $("#fxtx").show();
        });

jQuery('.share-link').on("mouseover mouseout",function(event){
var btnObj = jQuery('.share-link');
var actObj = jQuery('#qrcodediv');
if(event.type == "mouseover"){
actObj.css({'border':'1px solid #999'});
actObj.animate({
width: "200px"
},300,function(){
btnObj.addClass('show');
});
} else {
actObj.css({'border':'0'});
actObj.animate({
width: "0%"
},300,function(){
btnObj.removeClass('show');
});
}
});
});
</script>

<!--弹出层-->
<script src="http://static.8264.com/static/js/layer/layer.js" type="text/javascript" type="text/javascript" type="text/javascript"></script>
<style type="text/css">
.qcss textarea {
height:130px;
width:600px;
border: 1px solid #ccc;
box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1) inset;
color: #333;
display: block;
line-height: 20px;
margin: 0 auto;
padding: 0 5px;
}
</style>

<script>
function reply_edit(topicid, replyid, authorid){
var topicid = topicid;
var replyid = replyid;
var authorid = authorid;
jQuery.ajax({
type: 'get',
async: false,
dataType: 'json',
url: '/question.php?ctl=topic&act=editreply&topicid='+topicid+'&replyid='+replyid,
success: function(data){
if(data.flag == 1){
var content = data.content;
layer.prompt({
title: '编辑回复',
value: content,
formType: 2,
skin: 'qcss',
area: '660px',
maxlength: 1000
}, function(value){
jQuery.ajax({
type: 'post',
data: {'editreplyid':replyid, 'message':value},
dataType: 'json',
url: '/question.php?ctl=topic&act=ajaxdoreply&topicid='+topicid,
success: function(data2){
if(data2.flag == 1){
value = value.replace(/\n/g, "<br>");
jQuery("#answerone"+authorid+" .rcontentp").html(value);
layer.msg("修改成功！");
}else{
layer.msg(data2.content);
}
}
});
});
}else{
layer.msg(data.content);
}
}
});
}
</script>

<?php if($_G['groupid'] == 1) { ?>
<script>
function reply_delete(topicid, replyid, authorid){
var topicid = topicid;
var replyid = replyid;
var authorid = authorid;
layer.confirm('确定删除此条回复？', {
btn: ['确认','取消']
  }, function(){
jQuery.ajax({
type: 'post',
data: {'topicid':topicid, 'replyid':replyid,'authorid':authorid},
dataType: 'json',
url: '/question.php?ctl=topic&act=ajaxdodelete',
success: function(data){
if(data.flag == 1){
jQuery("#answerone"+authorid).hide();
layer.msg('删除成功');
}else{
layer.msg(data.content);
}
}
});
  }, function(){

  });
}

function updown(replyid, authorid, isup){
jQuery.ajax({
type: 'post',
data: {'replyid':replyid, 'isup':isup},
dataType: 'json',
url: '/question.php?ctl=topic&act=ajaxdoupdown',
success: function(data){
if(data.flag == 1){
if(data.content == 1){
jQuery("#answerone"+authorid+" .godown").show();
jQuery("#answerone"+authorid+" .goup").hide();
layer.msg("置顶成功");
}else{
jQuery("#answerone"+authorid+" .godown").hide();
jQuery("#answerone"+authorid+" .goup").show();
layer.msg("置顶取消");
}
}else{
layer.msg(data.content);
}
}
});
}
</script>
<?php } ?>

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