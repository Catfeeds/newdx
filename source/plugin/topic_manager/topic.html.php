<?php
require_once dirname(__file__)."/topic_manager.class.php";
$tid=isset($topic['tid'])?$topic['tid']:$topic_manager->get_tid_with_topicid($topicid);
$t_info=$topic_manager->get_comment_with_tid(array('tid'=>$tid,'num'=>'5'));
$fid=$t_info[0]['fid'];
$replys=$topic_manager->get_reply_with_tid(array('tid'=>$tid));
function show_topic_comment(){
    global $t_info,$topic,$_G,$fid,$tid,$replys;
    if($tid==0){
        return false;
    }
?>
<style>
#topic_replay_comment{background: none repeat scroll 0 0 #FFFFFF;width:960px;font-family: "宋体";word-wrap: normal;border: 1px solid #CDCDCD;margin:0px auto;padding:0px; color:#000;}
#topic_replay_comment .bm_h h3{font-size: 1em;margin:0px;}
#topic_comment{padding:10px;}
.cl:after {
    clear: both;
    content: ".";
    display: block;
    height: 0;
    visibility: hidden;
}
#topic_replay_comment .bm_h {
    background: none repeat scroll 0 0 #F2F2F2;
    border-bottom: 1px solid #C2D5E3;
    border-top: 1px solid #FFFFFF;
    height: 31px;
    line-height: 31px;
    overflow: hidden;
    padding: 0 10px;
    white-space: nowrap;
}
#topic_replay_comment .tedt .pt {
    background: none repeat scroll 0 0 #FFFFFF;
    border: medium none;
    padding: 0 !important;
    width: 100%;
}
#topic_replay_comment .pt {
    overflow-y: auto;
    color: #666666;
    font-size: 14px;
    padding: 2px 4px
}
#topic_replay_comment .tedt {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #999999 #CCCCCC #CCCCCC #999999;
    border-style: solid;
    border-width: 1px;
    width: 98%;
}
#topic_replay_comment .xi2,#topic_replay_comment .xi2 a{
    color: #336699;
}
#topic_replay_comment .y {
    float: right;
}
#topic_replay_comment a {
    font-size: 12px;
    text-decoration: none;
}
#topic_replay_comment .quote{background:url("../../static/image/common/qa.gif") no-repeat scroll 0 0 transparent;color: #666666;margin: 10px 0;overflow: hidden;padding-left: 16px;}
#topic_replay_comment .quote blockquote{background:url("../../static/image/common/qz.gif") no-repeat scroll 100% 100% transparent;display: inline;margin: 0;padding-right: 16px;}
#topic_replay_comment dl{border-bottom: 1px dashed #CDCDCD;}
#topic_replay_comment .xw0 {font-weight: 400;}
#topic_replay_comment .xg1, .xg1 a {color: #999999 !important;}
#topic_replay_comment .pn{-moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: none repeat scroll 0 0 #E5EDF2;
    border-color: #C2D5E3 #336699 #336699 #C2D5E3;
    border-style: solid;
    border-width: 1px;
    color: #336699;
    cursor: pointer;
    font-size: 14px;
    font-weight: 700;
    height: 26px;
    line-height: 26px;
    margin-right: 3px;
    overflow: visible;
    vertical-align: middle;
    z-index: 0;}
</style>
<div id="topic_replay_comment">
<div class="bm_h cl">
<a class="y xi2" href="<?php echo $_G['config']['web']['portal'];?>topic/<?=$topic['name']?>.html#replyform">发表评论</a>
<h3>最新评论<span id="dis_comment" style="padding:1px 4px;margin-left:10px;color: blue;border:1px solid #CCCCCC;cursor:pointer;" title="点击隐藏评论">-</span></h3>
</div>
<div id="topic_comment">
<?php if(!empty($t_info)){ ?>
<div id="topic_comments">
<?php foreach($t_info as $info){ ?>
<dl id="topic_comment_<?=$info['pid']?>">
    <dt>
        <div style=" width:59px; height:61px; padding:5px 0px 0px 5px; background:url(/template/8264/css/moban/1024news/images/touxiang.png) no-repeat;float:left;">
            <a class="xi2 xw1" c="1" href="<?php echo $_G['config']['web']['home']; ?>space-uid-<?=$info['authorid']?>.html">
                <?=$info['avatar']?>
            </a>
        </div>
        <div style="float:left; padding-left:10px; line-height:1.6; width:866px;">
        <div>
            <span style="float:left">
            <a class="xi2 xw1" c="1" href="<?php echo $_G['config']['web']['home']; ?>space-uid-<?=$info['authorid']?>.html"><?=$info['author']?></a>
            <span class="xg1 xw0"><?=date("Y-m-d H:i",$info['dateline'])?></span>
            </span>
            <span class="y xw0 xi2" style="float:right;">
            <a class="quote_topic" href="javascript:;">引用</a>
            <a target="_blank" href="<?php echo $_G['config']['web']['forum']; ?>forum.php?mod=post&action=edit&fid=<?=$fid?>&tid=<?=$tid?>&pid=<?=$info['pid']?>">编辑</a>
            <!--<a id="c_401383_delete" onclick="showWindow(this.id, this.href, 'get', 0);" href="portal.php?mod=portalcp&ac=comment&op=delete&cid=401383">删除</a>-->
            </span>
            <div style="clear:both"></div></div><?=$info['message']?></div>
        <div style="clear:both"></div>
    </dt>
    <dd style="display: none;"><?=$info['yw_message']?></dd>
</dl>
<?php } ?>
</div>
<?php } ?>
<p class="ptm pbm">
<a class="xi2" href="<?php echo $_G['config']['web']['forum']; ?>thread-<?=$tid?>-1-1.html" target="_blank">查看全部评论(<?=$replys?>)</a>
</p>
<div id="topic replay">
<form id="replyform" name="replyform" autocomplete="off" action="../forum.php?mod=post&infloat=yes&action=reply&fid=<?=$fid?>&extra=&tid=<?=$tid?>&replysubmit=yes" method="post">
<div class="tedt">
	<div class="area">
		<textarea name="message" rows="3" title="0" class="pt" id="message" onkeydown="ctrlEnter(event, 'commentsubmit_btn');"></textarea>
	</div>
</div>
<p class="ptn">
	<button type="submit" name="commentsubmit_btn" id="commentsubmit_btn" value="true" class="pn"><strong> 评 论 </strong></button>
</p>
<input id="formhash" type="hidden" value="<?=$_G['formhash']?>" name="formhash" fwin="reply"/>
<input type="hidden" value="reply" name="handlekey"/>
<input type="hidden" value="" name="noticeauthor"/>
<input type="hidden" value="" name="noticetrimstr"/>
<input type="hidden" value="" name="noticeauthormsg"/>
<input type="hidden" value="<?php echo $_G['config']['web']['portal']; ?>topic/<?=$topic['name']?>.html#topic_comment" name="portal_referer"/>
</form>
</div>
</div>
</div>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($) {
    $(".quote_topic").live("click",function(){
        $("#message").val('');
        //$(this).parent().parent().parent().parent().next().css("background","red");
        var authors=$(this).parent().prev().children(":eq(0)").html();
        var post_times=$(this).parent().prev().children(":eq(1)").html();
        //var quote_content=$(this).parent().parent().parent().parent().next().html();
        var quote_content=$(this).parent().parent().parent().children(':last').html();
        var quotes = "[quote][color=#999999]"+authors+" 发表于 "+post_times+"[/color] "+quote_content+"[/quote]\n";
        $("#message").val(quotes);
        var len=$("#message").val().length;
        $("#message").attr("title",len);
    });
    $("#message").live("mouseover",function(){
        $(this).focus();
        if($("#message").val().length<=4){
            $("#message").attr("title","0");
        }
    });
    $("#dis_comment").live("click",function(){
        if($("#topic_comments").css('display')=='none'){
            $("#topic_comments").css("display","block");
            $(this).html('-');
            $(this).attr('title','点击隐藏评论');
        }else{
            $("#topic_comments").css("display","none");
            $(this).html('+');
            $(this).attr('title','点击显示评论');
        }
    });
    $("#commentsubmit_btn").click(function(){
        if($("#message").val().length<=$("#message").attr('title') || $("#message").val().length<=4){
            alert('回复不能少于四个字');
            return false;
        }
    });
    $("#message").live("keydown",function(){
        if($("#message").val().length<=4){
            $("#message").attr("title","0");
        }
    });
})(jQuery);
</script>
<?php } ?>