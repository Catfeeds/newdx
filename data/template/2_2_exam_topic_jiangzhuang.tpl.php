<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="gbk">
<title>��״</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="renderer" content="webkit"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<title>��ҳ</title>

<link rel="stylesheet" href="http://static.8264.com/static/css/exam/style.css?<?php echo VERHASH;?>">
<script src="/static/js/exam/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/static/js/exam/swiper.min.js" type="text/javascript"></script>


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
<!--ͷ����ʼ-->
<?php if($isWechat == 0) { ?>
<div class="header-content">
<div class="home-icons" style="display: none;">
<a href="http://www.8264.com/xuexiao/">��ҳ</a>
</div>
<div class="goback-icons">
<a href="<?php echo $ref;?>">����</a>
</div>
<div class="logo">
<a href="#">
<img src="/static/images/exam/logo.png" alt="">
</a>
</div>
</div>
<?php } ?>
<!--ͷ������-->
<div class="jiangzhuang">
<img src="<?php echo $url;?>" alt="">
</div><?php include template('exam/topic/footer'); ?><!--�ײ�������ʼ-->
<div class="bottompopbox">
<div class="bottompopcon">
<div class="bottominfo"><span>��ͼ�ɱ��浽�ֻ������</span></div>
<i></i>
</div>
</div>
<!--�ײ���������-->


<!--��ɫ������ʼ-->
<div class="bg75black" style="display:none;" ></div>
<!--��ɫ��������-->

<script type="text/javascript">
jQuery(function(){
$(".bottompopbox i").click(function() {
$(".bottompopbox").hide();
});
$(".xuexiao_ad").show();
$(".bg75black").show();
});
</script>
</body>
</html>
