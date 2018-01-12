<?php

/* 
 * 论坛普通发帖时图片上传启用upyun form方式
 * 使用时引用该文件
 */


//图片上传方式改为upyun form方式 by zhangwenchu 20170118
require_once libfile('class/upyun_form');
$upyun = new UpYun($_G['config']['cdn']['form']['bucket_name'], $_G['config']['cdn']['form']['form_api_secret']);

$opts = array();
// 必选参数
$opts['save-key'] = '/forum/{year}{mon}/{day}/{hour}{min}{sec}{random}{.suffix}';   // 保存路径
$opts['allow-file-type'] = 'gif,jpg,jpeg,bmp,png';
// 以下参数均为可选
/*
$opts['allow-file-type'] = '';   // 文件类型限制，如：jpg,gif,png
$opts['content-length-range'] = '';  // 文件大小限制，如：102400,1024000 单位：Bytes
$opts['content-md5'] = '';  // 文件校验码（根据上传文件的内容进行 md5 校验后得到的数值），如：202cb962ac59075b964b07152d234b70
$opts['content-secret'] = '';   //原图访问密钥，如：abc
$opts['content-type'] = ''; // 指定文件类型，如：image/jpeg
$opts['image-width-range'] = '';  // 图片宽度限制，如：0,1024 单位：像素
$opts['image-height-range'] = ''; // 图片高度限制，如：0,1024 单位：像素
$opts['notify-url'] = '';   // 异步回调 url，如：http://img.helloword.com/notify.php
$opts['return-url'] = 'http://localhost/return.php';    // 同步跳转 url，如：http://localhost/return.php
$opts['ext-param'] = '';    // 额外参数
$opts['apps'] = array(
array(                      // 异步作图服务，可以多个任务
'name'=>'thumb',        // 异步任务名称
'x-gmkerl-thumb'=>'',   // 作图参数，如：/fw/100/quality/95，更多参数参考：http://docs.upyun.com/cloud/image/#_7
'save_as'=>'',          // 结果存放路径，如：/path/to/fw_100.jpg
// 'notify_url': ''     // 回调地址，可选，可以覆盖表单参数中的 notify_url
)
);
$opts['apps'] = array(
array(                   // 异步音视频处理服务，可以多个任务
'name'=>'naga',      // 异步任务名称
'type'=>'',          // 类型，如：video hls thumbnail vconcat audio aconcat 或 probe，这里以 video 为例。
'avopts'=>'',        // 处理参数，如：/f/flv 输出 flv 格式，更多参考：http://docs.upyun.com/cloud/av/#_9
'return_info'=>'',   // 是否返回 JSON 格式元数据，默认 false
'save_as'=>''        // 结果保存路径，如：/a/b.flv
)
);
*/

$policy = $upyun->policyCreate($opts);
$sign = $upyun->signCreate($opts);
$action = $upyun->action();
$version = $upyun->version();