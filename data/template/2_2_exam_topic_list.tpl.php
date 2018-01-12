<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="gbk">
<title>户外运动知识学习和考试系统 - 8264户外运动学校 - 8264.com</title>
<meta name="viewport" content="minimal-ui,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="MobileOptimized" content="width">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>

<link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css?20170908">
    <link rel="stylesheet" href="http://static.8264.com/static/css/exam/swiper.min.css">

    <script src="http://static.8264.com/static/js/exam/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/exam/swiper.min.js" type="text/javascript"></script>
<style>
body{ background:#ebf0f2;}
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

<body style="background: #f9f9f9;">

<?php if($isWechat == 0) { ?>
<div class="header-content">
<div class="home-icons" style="display: none;">
<a href="javascript:void(0);">首页</a>
</div>
<div class="goback-icons">
<a href="javascript:void(0);">返回</a>
</div>
<div class="logo">
<a href="#">
<img src="http://static.8264.com/static/images/exam/logo.png" alt="">
</a>
</div>
</div>
<?php } ?>

<div class="barnnerbox">
    <!--轮播开始-->
    <style>
        .swiper-slide img {
            width: 100%;
        }
    </style>
    <script type='text/javascript' src='http://bbs.8264.com/api.php?mod=ad&adid=custom_479'></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            paginationClickable: true
        });
    </script>
    <!--轮播结束-->
</div>
<div class="">
<div class="titlebox">
所有课程
</div>
<div class="allkechengbox"><?php if(is_array($list_arr)) foreach($list_arr as $list_one) { ?><div class="kechengone">
        	<a href="catinfo-<?php echo $list_one['id'];?>.html" class="kechengcon">
<div style="position: relative; overflow:hidden; font-size: 0px;">
<img src="http://image1.8264.com/<?php echo $list_one['img'];?>" alt="">
<span><i><?php echo $list_one['join_nums'];?></i></span>
</div>
<b><?php echo $list_one['catname'];?></b>

<em></em>
</a>
</div>
<?php } ?>
</div>
    <div class="titlebox whitebox">
        合作伙伴
        <a class="titlemorelink" href="http://www.8264.com/xuexiao/shidian.html">更多</a>
    </div>
        <div class="whitebox" style="margin-top: 2px;">
            <div class="actmorelist">
                <ul>
                    <?php if(is_array($peixun_result)) foreach($peixun_result as $peixun) { ?>                    <li>
                        <a href="/xuexiao/shidian-<?php echo $peixun['id'];?>.html">
                            <img src="<?php echo $peixun['img'];?>" alt="">
                            <div class="">
<span><?php echo $peixun['name'];?></span>
                                <em>
                                    <i class="didian"><?php echo $peixun['address'];?></i>
                                </em>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div><?php include template('exam/topic/footer'); include template('exam/topic/wechat_share'); ?></body>
</html>
