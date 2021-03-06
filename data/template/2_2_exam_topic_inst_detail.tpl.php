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
    <script src="/static/js/exam/swiper.min.js" type="text/javascript"></script>
    <style>
        body{ background-color: #f8f8f8; }
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

<style type="text/css">#content{background:#ebf0f3;padding-bottom:52px}.swiper-container{position:relative;overflow:hidden;z-index:1}.swiper-wrapper{position:relative;width:100%;height:100%;z-index:1;display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-transition-property:-webkit-transform;-moz-transition-property:-moz-transform;-o-transition-property:-o-transform;-ms-transition-property:-ms-transform;transition-property:transform;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}.swiper-container{width:100%;height:100%}.swiper-slide{-webkit-flex-shrink:0;-ms-flex:0 0 auto;flex-shrink:0;width:100%;height:100%;position:relative}.swiper-slide{text-align:center;font-size:18px;background:#fff;display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center}.swiper-slide img{width:100%}.swiper-pagination{position:absolute;text-align:right;-webkit-transition:.3s;-moz-transition:.3s;-o-transition:.3s;transition:.3s;-webkit-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0);-o-transform:translate3d(0,0,0);transform:translate3d(0,0,0);z-index:10;bottom:10px;left:0;right:0;padding-right:15px}.swiper-pagination-bullet{width:8px;height:8px;display:inline-block;border-radius:4px;background:#f1effd;opacity:.5;cursor:pointer;margin:0 3px}.swiper-pagination-bullet-active{width:20px;opacity:1;background:#fff}.bbsLink__wrapper{background-color:#fcf1dc;position:relative}.bbsLink__wrapper a{display:block;padding:4% 0px}.bbsLink__wrapper span{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAjCAYAAACHIWrsAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjg4NUQyQzg3NUQzMzExRTdCNTA1QTIxRjdFMkE5MTY1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjg4NUQyQzg4NUQzMzExRTdCNTA1QTIxRjdFMkE5MTY1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODg1RDJDODU1RDMzMTFFN0I1MDVBMjFGN0UyQTkxNjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6ODg1RDJDODY1RDMzMTFFN0I1MDVBMjFGN0UyQTkxNjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5G18+uAAABSklEQVR42mL8kWzKAAX/GWgLGNnnnGJgYqAj+JliRl8LQYCFDkGJEmUD4kN4pA5LH45aSNNEgzWSKSlZBr0PGUcTzWgqHU2lo6l01MLhZaEIFNPcQlC+LQTi21BcRCAvU2ShOxBfBOI+IBaA4l6omDs1LVQB4nVAvAOItYD4DhB7A7EXlK0FlVsHVUu2hTxA3ALEl4E4EIi/AHEpEGsD8TYg3g5ll0LlQGquQPXwkGIhqAyNBOKbQFwNxOxAvACI1YC4B4h/Ian9BRUDyc0HYjaonltQMxgJWWgIxEeBeBkQSwHxCSC2AuJEIH6OJzRAcklQtSA9klAzjkLNxGrhHCA+A8SWUAOSgdgaagCxAObAZKgZllAz58KDD9gh/Y8WRJOBuBGIP1OYx3mBuB6Ic6FBjeFDUErTAeISKljGADWjBJqwdsAEAQIMANEnQclX0XYrAAAAAElFTkSuQmCC) left center no-repeat;background-size:14px auto;font-size:17px;color:#6b3612;padding:0px 0px 0px 20px;margin-left:14px}.bbsLink__wrapper i{background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAgCAYAAADwvkPPAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkY3NjRCQzU3NUQzMzExRTc4NEJFRDExNzg0OTM0RkNEIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkY3NjRCQzU4NUQzMzExRTc4NEJFRDExNzg0OTM0RkNEIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6Rjc2NEJDNTU1RDMzMTFFNzg0QkVEMTE3ODQ5MzRGQ0QiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6Rjc2NEJDNTY1RDMzMTFFNzg0QkVEMTE3ODQ5MzRGQ0QiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz70eufCAAABXUlEQVR42qTWzysEYRzH8e1rSRI5uJO/QA4OUlaIaHNwcPAnuDjJnZt/wFUOUg7kIL9LLkqUEilsJEkiP454P/XdksbuzGemXu3MbL13m3meeSY7OTGeYTNMYw6FjLiZf85iCntoShubx5OHdtVgMXaC3rRB+7WfOmh/jlMFLeKcHLR/zktBK/Fd4qCV+bFEQYtxKWIHLeaNihW0BMOobNASDvKSQROmYFSwRY1FBXfQrMbC9oVv369ElRpr9X/TiDvkcJEVQm3YRANu0I1r5Zq1Y9tDV+gqhpLGOrCBelx6qKCMs06sow7nHrpVZkDOQ7U48+N7ZW6GsbSGGpx66EF5avRj1UPHftcelefZEFZQjSP0+GhP/KQdxnIY0Tj00LOyBoxgyUMH6MOLsjqNYtHn2T4G8Kqsm2NYQIW/b4TQm7Kih/Ez46EtDOJDfdd492sTXl7y+FSfST8CDAD4zF3JvugbcAAAAABJRU5ErkJggg==) right center no-repeat;background-size:10px auto;position:absolute;right:14px;top:50%;display:inline-block;width:12px;height:20px;margin:-10px 0px 0px 0px}.club__wrapper{background:#fff}.club__head{padding:20px 15px;border-bottom:2px solid #eff4f6}.club__name{margin-bottom:8px}.club__name h3{font-size:22px;font-weight:normal}.club__address{color:#bbb;font-size:14px}.club__describe{padding:20px 15px;font-size:15px;line-height:24px;color:#666}.clubFaculty__wrapper{background:#fff}.clubFaculty__head{border-bottom:2px solid #eff4f6;padding:16px 10px;font-size:18px;color:#4f5560}.clubFaculty-list__item{border-bottom:#eee solid 1px;margin-left:10px;overflow:hidden;padding:3% 0}.clubFaculty-list__item img{float:left;width:26%;margin:0 3% 0 0;border-radius:3px}.clubFaculty-list__item:last-child{border-bottom:0 none}.clubFaculty-list__item p{overflow:hidden;padding-top:2%}.clubFaculty-list__item b{font-size:18px;color:#31424e;display:block}.clubFaculty-list__item span{margin:8% 0;font-size:15px;color:#555;display:block;overflow:hidden}.clubFaculty-list__item em{font-size:13px;color:#bccbd5;display:block}.clubActivity__wrapper{background:#fcfcfc;margin-top:10px}.clubActivity__head{padding:16px 10px;font-size:18px;color:#4f5560}.clubActivity-list{padding:0 10px}.clubActivity-list__item{background:#fff;padding:2px;position:relative;margin-bottom:10px;box-shadow:0 4px 20px rgba(0,0,0,.1)}.clubActivity-list__img{position:relative}.clubActivity-list__img img{width:100%;border-radius:2px;display:block;padding:2px}.clubActivity-list__title{color:#666;font-size:16px;padding:10px 0 15px 10px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}</style>
<div id="content">
    <?php if($banner) { ?>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php if(is_array($banner)) foreach($banner as $val) { ?>            <div class="swiper-slide">
                <a href="<?php echo $val['url'];?>">
                    <img src="<?php echo $val['img'];?>" alt="<?php echo $val['name'];?>">
                </a>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <?php } ?>
    <div class="club__wrapper">
        <div class="club__head">
            <div class="club__name">
                <h3><?php echo $name;?></h3>
            </div>
            <p class="club__address"><?php echo $address;?></p>
        </div>
        <div class="club__describe"><?php echo $intro;?></div>
    </div>
    <?php if($other && $other_url) { ?>
    <div class="bbsLink__wrapper">
        <a href="<?php echo $other_url;?>" target="_black">
            <span><?php echo $other;?></span>
            <i></i>
        </a>
    </div>
    <?php } ?>
    <?php if($shizi) { ?>
    <div class="clubFaculty__wrapper">
        <div class="clubFaculty__head">
            <span>师资力量</span>
        </div>
        <ul class="clubFaculty-list">
            <?php if(is_array($shizi)) foreach($shizi as $val) { ?>            <li class="clubFaculty-list__item">
                <a href="http://www.8264.com/xuexiao/shizi-<?php echo $val['id'];?>.html">
                    <img src="<?php echo $val['img'];?>" alt="<?php echo $val['name'];?>">
                    <div class="clubFaculty-list__item-body">
                        <div class="clubFaculty-list__item-body--title"><?php echo $val['name'];?></div>
                        <div class="clubFaculty-list__item-body--detail"><?php echo $val['intro'];?></div>
                        <!--<div class="clubFaculty-list__item-body&#45;&#45;subTitle">老蛇户外</div>-->
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
    <?php if($activity) { ?>
    <div class="clubActivity__wrapper">
        <div class="clubActivity__head">
            <span>学校活动</span>
        </div>
        <div class="clubActivity-list">
            <?php if(is_array($activity)) foreach($activity as $val) { ?>            <div class="clubActivity-list__item">
                <a href="<?php echo $val['url'];?>">
                    <div class="clubActivity-list__img">
                        <img src="<?php echo $val['img'];?>" alt="<?php echo $val['name'];?>">
                    </div>
                    <div class="clubActivity-list__title"><?php echo $val['name'];?></div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>
<script type="text/javascript">
    jQuery(function(){
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay : 5000,
        });
    });
</script><?php include template('exam/topic/footer'); include template('exam/topic/wechat_share'); ?></body>
</html>