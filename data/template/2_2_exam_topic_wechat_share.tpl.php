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
            // ����Ҫ���õ� API ��Ҫ�ӵ�����б���
            'onMenuShareAppMessage'
        ]
    });
    wx.ready(function () {
        // ��������� API
        wx.onMenuShareTimeline({
            title: title, // �������
            link: '<?php echo $signPackage['url'];?>', // ��������
            imgUrl: '<?php echo $wxshareImg;?>', // ����ͼ��
            success: function () {
                // �û�ȷ�Ϸ����ִ�еĻص�����
            },
            cancel: function () {
                // �û�ȡ�������ִ�еĻص�����
            }
        });
        wx.onMenuShareAppMessage({
            title: title, // �������
            desc: '�����˶�֪ʶѧϰ�Ϳ���ϵͳ - 8264.com', // ��������
            link: '<?php echo $signPackage['url'];?>?wx=1', // ��������
            imgUrl: '<?php echo $wxshareImg;?>', // ����ͼ��
            type: '', // ��������,music��video��link������Ĭ��Ϊlink
            dataUrl: '', // ���type��music��video����Ҫ�ṩ�������ӣ�Ĭ��Ϊ��
            success: function () {
                // �û�ȷ�Ϸ����ִ�еĻص�����
            },
            cancel: function () {
                // �û�ȡ�������ִ�еĻص�����
            }
        });
    });

</script>