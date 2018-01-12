<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="gbk">
    <title><?php echo $name;?> - 8264户外运动学校</title>
    <meta name="viewport" content="minimal-ui,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="MobileOptimized" content="width">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css?<?php echo VERHASH;?>">
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
<div id="content">
    <div class="banner-wrapper">
        <img src="/static/images/exam/bannerbg.jpg" alt="" class="banner__img">
        <div class="teacher-detail">
            <div class="teacher-detail__name"><?php echo $name;?></div>
            <div class="teacher-detail__clubName"><?php echo $club;?></div>
        </div>
        <div class="teacher__avatar">
            <img src="<?php echo $img;?>" alt="" class="teacher__avatar--img">
        </div>
    </div>
    <div class="content-main">
        <div class="content-main__head">
            <h3>INTRODUCTION</h3>
        </div>
        <div class="content-main__body">
            <?php echo $intro;?>
        </div>
    </div>
</div><?php include template('exam/topic/footer'); include template('exam/topic/wechat_share'); ?></body>
</html>