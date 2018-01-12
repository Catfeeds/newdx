<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="gbk">
<title><?php echo $catname;?>知识 - 8264户外运动学校</title>
<meta name="viewport" content="minimal-ui,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="MobileOptimized" content="width">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>

<link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css?<?php echo VERHASH;?>">
<script src="http://static.8264.com/static/js/exam/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/exam/swiper.min.js" type="text/javascript"></script>

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
<!--头部开始-->
<?php if($isWechat == 0) { ?>
<div class="header-content">
<div class="home-icons" style="display: none;">
<a href="http://www.8264.com/xuexiao/">首页</a>
</div>
<div class="goback-icons">
<a href="http://www.8264.com/xuexiao/">返回</a>
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
<!--头部结束-->
<div class="listbranner">
<img src="http://static.8264.com/static/images/exam/listbranner.jpg" alt="">
<div class="listbrannercon">
<span class="brannerbigtitle"><?php echo $catname;?></span>
<span class="canjiarenshu"><?php echo $num;?> 人已参加</span>
<a href="http://www.8264.com/xuexiao/type-practice-cat-<?php echo $catid;?>.html" class="xuexilink">
<span>我要学习</span>
</a>
<span class="kaoshi">
<em>我要考试</em>
<i></i>
</span>
</div>
    <?php if($other && $other_url) { ?>
    <style>
        .bbslinkbox{background-color:#fcf1dc; position:relative;}
        .bbslinkbox a{ display: block; padding:4% 0px; }
        .bbslinkbox span{
            background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAjCAYAAACHIWrsAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjg4NUQyQzg3NUQzMzExRTdCNTA1QTIxRjdFMkE5MTY1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjg4NUQyQzg4NUQzMzExRTdCNTA1QTIxRjdFMkE5MTY1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODg1RDJDODU1RDMzMTFFN0I1MDVBMjFGN0UyQTkxNjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6ODg1RDJDODY1RDMzMTFFN0I1MDVBMjFGN0UyQTkxNjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5G18+uAAABSklEQVR42mL8kWzKAAX/GWgLGNnnnGJgYqAj+JliRl8LQYCFDkGJEmUD4kN4pA5LH45aSNNEgzWSKSlZBr0PGUcTzWgqHU2lo6l01MLhZaEIFNPcQlC+LQTi21BcRCAvU2ShOxBfBOI+IBaA4l6omDs1LVQB4nVAvAOItYD4DhB7A7EXlK0FlVsHVUu2hTxA3ALEl4E4EIi/AHEpEGsD8TYg3g5ll0LlQGquQPXwkGIhqAyNBOKbQFwNxOxAvACI1YC4B4h/Ian9BRUDyc0HYjaonltQMxgJWWgIxEeBeBkQSwHxCSC2AuJEIH6OJzRAcklQtSA9klAzjkLNxGrhHCA+A8SWUAOSgdgaagCxAObAZKgZllAz58KDD9gh/Y8WRJOBuBGIP1OYx3mBuB6Ic6FBjeFDUErTAeISKljGADWjBJqwdsAEAQIMANEnQclX0XYrAAAAAElFTkSuQmCC) left center no-repeat;
            background-size:14px auto;
            font-size:17px;
            color:#6b3612;
            padding:0px 0px 0px 20px;
            margin-left:14px;
        }
        .bbslinkbox i{
            background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAgCAYAAADwvkPPAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkY3NjRCQzU3NUQzMzExRTc4NEJFRDExNzg0OTM0RkNEIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkY3NjRCQzU4NUQzMzExRTc4NEJFRDExNzg0OTM0RkNEIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6Rjc2NEJDNTU1RDMzMTFFNzg0QkVEMTE3ODQ5MzRGQ0QiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6Rjc2NEJDNTY1RDMzMTFFNzg0QkVEMTE3ODQ5MzRGQ0QiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz70eufCAAABXUlEQVR42qTWzysEYRzH8e1rSRI5uJO/QA4OUlaIaHNwcPAnuDjJnZt/wFUOUg7kIL9LLkqUEilsJEkiP454P/XdksbuzGemXu3MbL13m3meeSY7OTGeYTNMYw6FjLiZf85iCntoShubx5OHdtVgMXaC3rRB+7WfOmh/jlMFLeKcHLR/zktBK/Fd4qCV+bFEQYtxKWIHLeaNihW0BMOobNASDvKSQROmYFSwRY1FBXfQrMbC9oVv369ElRpr9X/TiDvkcJEVQm3YRANu0I1r5Zq1Y9tDV+gqhpLGOrCBelx6qKCMs06sow7nHrpVZkDOQ7U48+N7ZW6GsbSGGpx66EF5avRj1UPHftcelefZEFZQjSP0+GhP/KQdxnIY0Tj00LOyBoxgyUMH6MOLsjqNYtHn2T4G8Kqsm2NYQIW/b4TQm7Kih/Ez46EtDOJDfdd492sTXl7y+FSfST8CDAD4zF3JvugbcAAAAABJRU5ErkJggg==) right center no-repeat;
            background-size:10px auto;
            position: absolute;
            right: 14px;
            top:50%;
            display: inline-block;
            width:12px;
            height:20px;
            margin: -10px 0px 0px 0px;
        }
    </style>
    <div class="bbslinkbox">
        <a href="<?php echo $other_url;?>" target="_black">
            <span><?php echo $other;?></span>
            <i></i>
        </a>
    </div>
    <?php } ?>
</div>
<div class="kaoshilistcon">
<a href="http://www.8264.com/xuexiao/type-exam-cat-<?php echo $catid;?>.html?base=1"><img src="http://static.8264.com/static/images/exam/chuji.png" alt=""></a>
<a href="http://www.8264.com/xuexiao/type-exam-cat-<?php echo $catid;?>.html?base=2"><img src="http://static.8264.com/static/images/exam/zhongji.png" alt=""></a>
<a href="http://www.8264.com/xuexiao/type-exam-cat-<?php echo $catid;?>.html?base=3"><img src="http://static.8264.com/static/images/exam/gaoji.png" alt=""></a>
</div>

<?php if(!empty($xuexi_result)) { ?>
<div class="studybox">
<div class="studytitle">学习资料</div><?php if(is_array($xuexi_result['first'])) foreach($xuexi_result['first'] as $list_k => $list_v) { ?><div class="study_questions_box">
<div class="study_questions_title">
<?php echo $list_v['name'];?><span><?php echo $list_v['counts'];?>知识点</span><em></em>
</div>
<div class="study_small_con"><?php if(is_array($xuexi_result['second'][$list_k])) foreach($xuexi_result['second'][$list_k] as $second) { ?><div class="study_small_one">
<div class="study_small_title" id="<?php echo $second['aid'];?>">
<?php echo $second['name'];?>
<i></i>
</div>
<div class="study_small_info" id="info_<?php echo $second['aid'];?>">
</div>
</div>
<?php } ?>
</div>
</div>
<?php } ?>
</div>
<?php } ?>

<div class="whitebox">
<div class="teachertitlebox">
<span>师资力量</span>
<em>由多位户外权威人士组成，内容均由审查组审核</em>
</div>
    <ul class="clubFaculty-list">
        <?php if(is_array($shizi_result)) foreach($shizi_result as $shizi) { ?>        <li class="clubFaculty-list__item">
            <a href="http://www.8264.com/xuexiao/shizi-<?php echo $shizi['id'];?>.html">
                <img src="<?php echo $shizi['img'];?>" alt="">
                <div class="clubFaculty-list__item-body">
                    <div class="clubFaculty-list__item-body--title"><?php echo $shizi['name'];?></div>
                    <div class="clubFaculty-list__item-body--detail"><?php echo $shizi['intro'];?></div>
                    <!--<div class="clubFaculty-list__item-body&#45;&#45;subTitle">老蛇户外</div>-->
                </div>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>


<!--加载更多开始-->
<!--<div class="load-more">
<span class="loader"></span>
<em class="loader-text">正在加载更多</em>
</div>-->
<!--加载更多结束--><?php include template('exam/topic/footer'); ?><script type="text/javascript">
    jQuery(function(){
        $(".kaoshi").click(function() {
            if($('i',this).hasClass('shouqi')){
                $('i',this).removeClass('shouqi');
                $(".kaoshilistcon").removeClass("flexShow");
            }else{
                $('i',this).addClass('shouqi');
                $(".kaoshilistcon").addClass('flexShow');
            }
        });


    });

    //学习点击

    $(".study_questions_title").click(function() {
        if($('em',this).hasClass('active')){
            $('em',this).removeClass('active');
            $(this).next(".study_small_con").hide();
        }else{
            $('em',this).addClass('active');
            $(this).next(".study_small_con").show();
        }
    });

    $(".study_small_title").click(function() {
        var aid = $(this).attr("id");



        if($('i',this).hasClass('active')){
            $('i',this).removeClass('active');
            $(this).next(".study_small_info").hide();
        }else{
            //请求文章内容
            $.ajax({
                type: 'POST',
                url: 'http://www.8264.com/exam.php?ctl=topic&act=getarticle',
                async:false,
                data: {'aid':aid},
                dataType: 'json',
                success: function(data){
                    if(data.flag == 1){
                        $("#info_"+data.aid).html(data.content);
                    }else{

                    }
                }
            });

            $('i',this).addClass('active');
            $(this).next(".study_small_info").show();
        }
    });
</script><?php include template('exam/topic/wechat_share'); ?></body>
</html>
