<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="gbk">
<title>视频课程 - 8264户外运动学校</title>
<meta name="viewport" content="minimal-ui,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="MobileOptimized" content="width">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>

<link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css?20170901">
<script src="http://static.8264.com/static/js/exam/jquery-1.9.1.min.js" type="text/javascript"></script>
<style>
    body,html{background:#f8f8f8;}
</style>
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
<div class="video_banner">
    <style>
        .video_banner img {
            width: 100%;
        }
    </style>
    <script src="http://bbs.8264.com/api.php?mod=ad&adid=custom_481" type="text/javascript"></script>
</div>
<div class="titlebox">视频课程</div>
<div class="tongtiaolist">
    <!--单条循环开始-->
    <?php if(is_array($data)) foreach($data as $video) { ?>    <div class="tongtiaolistone">
        <a href="http://www.8264.com/xuexiao/video-<?php echo $video['id'];?>.html">
            <div class="tongtiaolistimg">
                <img src="<?php echo $video['img'];?>" alt="<?php echo $video['name'];?>">
                <div class="peopleicon"><?php echo $video['view'];?>人学习</div>
                <?php if($video['is_free'] == 2) { ?>
                <div class="shipingoumai">
                    <span>会员免费</span>
                    <span>￥9.9</span>
                </div>
                <?php } else { ?>
                <div class="shipingoumai">
                    <span>免费</span>
                </div>
                <?php } ?>
                <div class="palybutton"><img src="/static/images/exam/play.png" alt=""></div>
            </div>
            <div class="titlenamebox"><?php echo $video['name'];?></div>
        </a>
    </div>
    <?php } ?>
    <!--单条循环结束-->
</div><?php include template('exam/topic/footer'); include template('exam/topic/wechat_share'); ?></body>
</html>
