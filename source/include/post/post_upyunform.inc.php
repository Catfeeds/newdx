<?php

/* 
 * ��̳��ͨ����ʱͼƬ�ϴ�����upyun form��ʽ
 * ʹ��ʱ���ø��ļ�
 */


//ͼƬ�ϴ���ʽ��Ϊupyun form��ʽ by zhangwenchu 20170118
require_once libfile('class/upyun_form');
$upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);

$opts = array();
// ��ѡ����
$opts['save-key'] = '/forum/{year}{mon}/{day}/{hour}{min}{sec}{random}{.suffix}';   // ����·��
$opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';
// ���²�����Ϊ��ѡ
/*
$opts['allow-file-type'] = '';   // �ļ��������ƣ��磺jpg,gif,png
$opts['content-length-range'] = '';  // �ļ���С���ƣ��磺102400,1024000 ��λ��Bytes
$opts['content-md5'] = '';  // �ļ�У���루�����ϴ��ļ������ݽ��� md5 У���õ�����ֵ�����磺202cb962ac59075b964b07152d234b70
$opts['content-secret'] = '';   //ԭͼ������Կ���磺abc
$opts['content-type'] = ''; // ָ���ļ����ͣ��磺image/jpeg
$opts['image-width-range'] = '';  // ͼƬ������ƣ��磺0,1024 ��λ������
$opts['image-height-range'] = ''; // ͼƬ�߶����ƣ��磺0,1024 ��λ������
$opts['notify-url'] = '';   // �첽�ص� url���磺http://img.helloword.com/notify.php
$opts['return-url'] = 'http://localhost/return.php';    // ͬ����ת url���磺http://localhost/return.php
$opts['ext-param'] = '';    // �������
$opts['apps'] = array(
array(                      // �첽��ͼ���񣬿��Զ������
'name'=>'thumb',        // �첽��������
'x-gmkerl-thumb'=>'',   // ��ͼ�������磺/fw/100/quality/95����������ο���http://docs.upyun.com/cloud/image/#_7
'save_as'=>'',          // ������·�����磺/path/to/fw_100.jpg
// 'notify_url': ''     // �ص���ַ����ѡ�����Ը��Ǳ������е� notify_url
)
);
$opts['apps'] = array(
array(                   // �첽����Ƶ������񣬿��Զ������
'name'=>'naga',      // �첽��������
'type'=>'',          // ���ͣ��磺video hls thumbnail vconcat audio aconcat �� probe�������� video Ϊ����
'avopts'=>'',        // ����������磺/f/flv ��� flv ��ʽ������ο���http://docs.upyun.com/cloud/av/#_9
'return_info'=>'',   // �Ƿ񷵻� JSON ��ʽԪ���ݣ�Ĭ�� false
'save_as'=>''        // �������·�����磺/a/b.flv
)
);
*/

$policy = $upyun->policyCreate($opts);
$sign = $upyun->signCreate($opts);
$action = $upyun->action();
$version = $upyun->version();