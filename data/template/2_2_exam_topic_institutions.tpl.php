<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="gbk">
<title>分校&试点&合作机构 - 8264户外运动学校</title>
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
<div class="video_banner">
    <style>
        .video_banner img {
            width: 100%;
        }
    </style>
    <script src="http://bbs.8264.com/api.php?mod=ad&adid=custom_482" type="text/javascript"></script>
</div>
<div class="titlebox" style="background-color:#FFF">分校·试点·合作机构</div>

<div style="background-color: #fff;">
    <div class="teacherlistbox shidianshool">
        <ul>
            <?php if(is_array($data)) foreach($data as $video) { ?>            <li>
                <a href="http://www.8264.com/xuexiao/shidian-<?php echo $video['id'];?>.html">
                    <img src="<?php echo $video['img'];?>" alt="">
                    <div class="clubFaculty-list__item-body">
                        <div class="clubFaculty-list__item-body--title"><?php echo $video['name'];?></div>
                        <strong class="shidianbox">
                            <?php if($video['type_fx'] == '1') { ?><i class="red">分校</i><?php } ?>
                            <?php if($video['type_hzjg'] == '1') { ?><i class="yellow">合作机构</i><?php } ?>
                            <?php if($video['type_sd'] == '1') { ?><i class="blue">试点</i><?php } ?>
                        </strong>
                        <div class="clubFaculty-list__item-body--detail"><?php echo $video['intro'];?></div>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div><?php include template('exam/topic/footer'); include template('exam/topic/wechat_share'); ?></body>
</html>
