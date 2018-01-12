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
    <link href="/static/css/exam/video-js.css" rel="stylesheet">
    <script src="http://static.8264.com/static/js/exam/jquery-1.9.1.min.js" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="/static/js/exam/html5media.min.js" type="text/javascript"></script>
    <![endif]-->
    <style type="text/css">
        /*html5*/
        article,aside,dialog,footer,header,section,footer,nav,figure,menu{
            display:block;
        }
        .videos_container{
            width:640px;
        }
        html{ background-color: #f8f8f8; height: 100%;}
        body{ background-color: #fff; height: 100%;}
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
<div class="tongtiaolistimg">
    <section class="videos_container">
        <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" src="<?php echo $url;?>" controls preload="auto" poster="<?php echo $img;?>" data-setup="{}">
            <source src='<?php echo $url;?>' type='video/mp4'>
        </video>
    </section>
</div>
<div class="shipintitlebox">
    <span><?php echo $name;?></span>
    <i><?php echo $view;?>人学习</i>
</div>

<div class="miaoshubox">
    <?php echo $intro;?>
</div><?php include template('exam/topic/footer'); include template('exam/topic/wechat_share'); ?><script src="/static/js/exam/video.js" type="text/javascript"></script>
<script type="text/javascript">
    videojs.options.flash.swf = "/static/js/exam/video-js.swf";
    $(function(){
        videojs('my-video', '', function onPlayerReady() {
            this.width($('.tongtiaolistimg').width());
            this.height($('.tongtiaolistimg').height());
            this.on('ended', function() {
                $.ajax({
                    type: 'POST',
                    url: '/exam.php?ctl=topic&act=video_view',
                    async:false,
                    data: {'id':'<?php echo $id;?>'},
                    dataType: 'json',
                    success: function(data){}
                });
            });
        });
    });
</script>
</body>
</html>