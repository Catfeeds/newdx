<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript"></script>
<script>
    var title = Document.title;
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage['appId'];?>',
        timestamp: '<?php echo $signPackage['timestamp'];?>',
        nonceStr: '<?php echo $signPackage['nonceStr'];?>',
        signature: '<?php echo $signPackage['signature'];?>',
        jsApiList: [
            'onMenuShareTimeline',
            // 所有要调用的 API 都要加到这个列表中
            'onMenuShareAppMessage'
        ]
    });
    wx.ready(function () {
        // 在这里调用 API
        wx.onMenuShareTimeline({
            title: title, // 分享标题
            link: '<?php echo $signPackage['url'];?>', // 分享链接
            imgUrl: '<?php echo $wxshareImg;?>', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        wx.onMenuShareAppMessage({
            title: title, // 分享标题
            desc: '户外运动知识学习和考试系统 - 8264.com', // 分享描述
            link: '<?php echo $signPackage['url'];?>?wx=1', // 分享链接
            imgUrl: '<?php echo $wxshareImg;?>', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });

</script>