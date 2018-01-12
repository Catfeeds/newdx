<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="gbk">
<title>活动培训 - 8264户外运动学校</title>
<meta name="viewport" content="minimal-ui,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="MobileOptimized" content="width">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>

<link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css?<?php echo VERHASH;?>">
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
<div class="titlebox">活动报名</div>

<div class="tongtiaolist">
    <?php if(is_array($new)) foreach($new as $val) { ?>    <div class="tongtiaolistone">
        <a href="<?php echo $val['link'];?>" title="<?php echo $val['title'];?>">
            <div class="tongtiaolistimg">
                <img src="<?php echo $val['img'];?>" alt="<?php echo $val['title'];?>">
                <div class="didianicon"><?php echo $val['address'];?></div>
            </div>
            <div class="titlenamebox"><?php echo $val['title'];?></div>
            <div class="datebox_new">
                <span><?php echo $val['d'];?></span>
                <em><?php echo $val['m'];?>月</em>
            </div>
        </a>
    </div>
    <?php } ?>
</div>
<div class="titlebox">往期活动</div>
<div class="tongtiaolist">
    <?php if(is_array($old)) foreach($old as $val) { ?>    <div class="tongtiaolistone">
        <a href="<?php echo $val['link'];?>" title="<?php echo $val['title'];?>">
            <div class="tongtiaolistimg">
                <img src="<?php echo $val['img'];?>" alt="<?php echo $val['title'];?>">
                <div class="didianicon"><?php echo $val['address'];?></div>
            </div>
            <div class="titlenamebox"><?php echo $val['title'];?></div>
            <div class="datebox_new">
                <span><?php echo $val['d'];?></span>
                <em><?php echo $val['m'];?>月</em>
            </div>
        </a>
    </div>
    <?php } ?>
</div><?php include template('exam/topic/footer'); include template('exam/topic/wechat_share'); ?></body>
</html>
