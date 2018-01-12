<?php


$_config = array();

// ----------------------------  CONFIG DB  ----------------------------- //
$_config['db']['1']['dbhost'] = '59.110.105.38';
$_config['db']['1']['dbuser'] = 'root';
$_config['db']['1']['dbpw'] = 'nAZe8bpdrCkaL5dH';
$_config['db']['1']['dbcharset'] = 'gbk';
$_config['db']['1']['pconnect'] = '0';
$_config['db']['1']['dbname'] = 'newdx';
$_config['db']['1']['tablepre'] = 'pre_';

$_config['db']['slaveopen'] = true;
$_config['db']['slave']['1']['dbhost'] = '59.110.105.38';
$_config['db']['slave']['1']['dbuser'] = 'root';
$_config['db']['slave']['1']['dbpw'] = 'nAZe8bpdrCkaL5dH';
$_config['db']['slave']['1']['dbcharset'] = 'gbk';
$_config['db']['slave']['1']['pconnect'] = '0';
$_config['db']['slave']['1']['dbname'] = 'newdx';
$_config['db']['slave']['1']['tablepre'] = 'pre_';
// --------------------------  CONFIG MEMORY  --------------------------- //
$_config['memory']['prefix'] = 'cEogns_';
$_config['memory']['eaccelerator'] = 0;
$_config['memory']['xcache'] = 0;
$_config['memory']['memcache']['server'] = '10.28.206.72';
$_config['memory']['memcache']['port'] = 11911;
$_config['memory']['memcache']['pconnect'] = 1;
$_config['memory']['memcache']['timeout'] = 1;
$_config['memory']['memcache_clusters'][1] = '10.28.206.72:11711';
$_config['memory']['memcache_clusters'][2] = '10.28.206.72:11811';
$_config['memory']['memcache_clusters'][3] = '10.28.206.72:11911';
// ----------------------------CONFIG VIEWS------------------------------ //
$_config['ignor_redisviews'] = true;
// --------------------------  CONFIG REDIS   --------------------------- //
$_config['memory']['redis']['server'] = '127.0.0.1';
$_config['memory']['redis']['port'] = 6381;
$_config['memory']['redis']['server23'] = '';
$_config['memory']['redis']['port23'] = 6376;
$_config['memory']['redis']['pwd'] = '';

// redis default port
$_config['memory']['redis']['default_port'] = 6381;
// redis 6381
$_config['memory']['redis'][6381]['server'] = '127.0.0.1';
$_config['memory']['redis'][6381]['port'] = 6381;
$_config['memory']['redis'][6381]['pwd'] = '';
$_config['memory']['redis'][6381]['pconnect'] = 1;
$_config['memory']['redis'][6381]['serializer'] = 1;
// redis 6379
$_config['memory']['redis'][6379]['server'] = '127.0.0.1';
$_config['memory']['redis'][6379]['port'] = 6379;
$_config['memory']['redis'][6379]['pwd'] = '';
$_config['memory']['redis'][6379]['pconnect'] = 1;
$_config['memory']['redis'][6379]['serializer'] = 1;
// redis 6378
$_config['memory']['redis'][6378]['server'] = '127.0.0.1';
$_config['memory']['redis'][6378]['port'] = 6378;
$_config['memory']['redis'][6378]['pwd'] = '';
$_config['memory']['redis'][6378]['pconnect'] = 1;
$_config['memory']['redis'][6378]['serializer'] = 1;
// redis 6382
$_config['memory']['redis'][6382]['server'] = '127.0.0.1';
$_config['memory']['redis'][6382]['port'] = 6382;
$_config['memory']['redis'][6382]['pwd'] = '';
$_config['memory']['redis'][6382]['pconnect'] = 1;
$_config['memory']['redis'][6382]['serializer'] = 1;
// redis 6376
$_config['memory']['redis'][6376]['server'] = '127.0.0.1';
$_config['memory']['redis'][6376]['port'] = 6376;
$_config['memory']['redis'][6376]['pwd'] = '';
$_config['memory']['redis'][6376]['pconnect'] = 1;
$_config['memory']['redis'][6376]['serializer'] = 1;

// -------------------------  CONFIG CSSVERSION  ------------------------ //

$_config['cssversion']['opend'] = true;

// -------------------------  CONFIG YOUPAICND -------------------------- //

$_config['cdns']['ids'] = array(88 => 'api', 77 => 'touxiang', 99 => 'images', 98 => 'attachfile' );

$_config['cdns']['config'] = array('image' => array('images'), 'file' => array('attachfile'));
$_config['cdns']['opend'] = true;

$_config['cdn']['touxiang']['serverid'] = 77;
$_config['cdn']['touxiang']['cdnname'] = 'touxiang';
$_config['cdn']['touxiang']['name'] = 'touxiang8264';
$_config['cdn']['touxiang']['user'] = '8264coder';
$_config['cdn']['touxiang']['pwd'] = '8264jianghong';
$_config['cdn']['touxiang']['secure'] = false;
$_config['cdn']['touxiang']['url'] = 'http://purge.upyun.com/purge/';

$_config['cdn']['api']['serverid'] = 88;
$_config['cdn']['api']['cdnname'] = 'api';
$_config['cdn']['api']['name'] = 'cdnatt';
$_config['cdn']['api']['user'] = '8264coder';
$_config['cdn']['api']['pwd'] = '8264jianghong';
$_config['cdn']['api']['secure'] = false;
$_config['cdn']['api']['url'] = 'http://purge.upyun.com/purge/';

$_config['cdn']['images']['serverid'] = 99;
$_config['cdn']['images']['cdnname'] = 'images';
$_config['cdn']['images']['name'] = 'img8264';
$_config['cdn']['images']['user'] = '8264coder';
$_config['cdn']['images']['pwd'] = '8264jianghong';
$_config['cdn']['images']['secure'] = false;
$_config['cdn']['images']['url'] = 'http://purge.upyun.com/purge/';
$_config['cdn']['images']['cdnurl'] = 'image1.8264.com';
$_config['cdn']['images']['id'] = '!';
//配置已经在云端自定义的各种缩图与水印版本，命名规则详见 function_core.php function getUpYun;
//命名规则 t + 缩图方式（1:限宽高不裁剪 2:限宽高裁剪 3:固定宽高自适应 4:固定高宽自适应 5:限定最长边短边自适应 6:限定最短边长边自适应）
// + w + (宽，当使用4时请写0) + h + (高，当使用3时请写0)（当使用5时将会取宽高中最大的，当使用6时将会取宽高中最小的）
// + x + (水印位置，当前只使用1,9，对应九宫格相应位置) + m + (水印种类，当前两种，1或2，1为论坛的那种，2为新闻的)
$_config['cdn']['images']['custom'] = array('t1w1500h1500x9m1', 't1w1500h1500', 't2w112h112', 't1w300h300', 't1w600h600', 't2w100h100', 't2w60h60', 't3w322h0', 't2w231h231', 'x1m3', 'x9m1', 'x9m2', 't1w1200h1200x9m2', 't4w0h455', 't12w600h600', 't1w140h140', 't2w400h300', 't2w450h300', 't3w825h0x9m1', 't3w825h0', 't2w180h120', 't2w360h240', 't2w640h320', 't3w600h300', 't1w231h231');
$_config['cdn']['images']['timeout'] = 30;

$_config['cdn']['attachfile']['serverid'] = 98;
$_config['cdn']['attachfile']['cdnname'] = 'attachfile';
$_config['cdn']['attachfile']['name'] = 'static8264';
$_config['cdn']['attachfile']['user'] = '8264coder';
$_config['cdn']['attachfile']['pwd'] = '8264jianghong';
$_config['cdn']['attachfile']['secure'] = false;
$_config['cdn']['attachfile']['url'] = 'http://purge.upyun.com/purge/';
$_config['cdn']['attachfile']['cdnurl'] = 'static.8264.com';
$_config['cdn']['attachfile']['id'] = '!';
$_config['cdn']['attachfile']['custom'] = array();
$_config['cdn']['attachfile']['timeout'] = 30;

$_config['cdn']['form']['bucket_name'] = 'img8264';
$_config['cdn']['form']['form_api_secret'] = '71/2LedVTG7VXwxFSDqGfOapPZg=';

// --------------------------  CONFIG SERVER  --------------------------- //
$_config['server']['id'] = 1;

// -------------------------  CONFIG DOWNLOAD  -------------------------- //
$_config['download']['readmod'] = 2;
$_config['download']['xsendfile']['type'] = '0';
$_config['download']['xsendfile']['dir'] = '/down/';

// ---------------------------  CONFIG CACHE  --------------------------- //
$_config['cache']['type'] = 'mysql';
//关闭文件缓存file 启用memcache+mysql

// --------------------------  CONFIG OUTPUT  --------------------------- //
$_config['output']['charset'] = 'gbk';
$_config['output']['forceheader'] = 1;
$_config['output']['gzip'] = '0';
$_config['output']['tplrefresh'] = 1;
$_config['output']['language'] = 'zh_cn';
$_config['output']['staticurl'] = 'static/';
$_config['output']['ajaxvalidate'] = '0';

// --------------------------  CONFIG COOKIE  --------------------------- //
$_config['cookie']['cookiepre'] = 'Bz6S_';
$_config['cookie']['cookiedomain'] = '.8264.com';
$_config['cookie']['cookiepath'] = '/';

// -------------------------  CONFIG SECURITY  -------------------------- //
$_config['security']['authkey'] = 'b161e356IVMOmBuw';
$_config['security']['urlxssdefend'] = 1;
$_config['security']['attackevasive'] = "0";
$_config['security']['querysafe']['status'] = 1;
$_config['security']['querysafe']['dfunction']['0'] = 'load_file';
$_config['security']['querysafe']['dfunction']['1'] = 'hex';
$_config['security']['querysafe']['dfunction']['2'] = 'substring';
$_config['security']['querysafe']['dfunction']['3'] = 'if';
$_config['security']['querysafe']['dfunction']['4'] = 'ord';
$_config['security']['querysafe']['dfunction']['5'] = 'char';
$_config['security']['querysafe']['daction']['0'] = 'intooutfile';
$_config['security']['querysafe']['daction']['1'] = 'intodumpfile';
$_config['security']['querysafe']['daction']['2'] = 'unionselect';
$_config['security']['querysafe']['daction']['3'] = '(select';
$_config['security']['querysafe']['daction'][] = 'unionall';
$_config['security']['querysafe']['daction'][] = 'uniondistinct';
$_config['security']['querysafe']['dnote']['0'] = '/*';
$_config['security']['querysafe']['dnote']['1'] = '*/';
$_config['security']['querysafe']['dnote']['2'] = '#';
$_config['security']['querysafe']['dnote']['3'] = '--';
$_config['security']['querysafe']['dnote']['4'] = '"';
$_config['security']['querysafe']['dlikehex'] = 1;
$_config['security']['querysafe']['afullnote'] = 0;

// --------------------------  CONFIG ADMINCP  -------------------------- //
// -------- Founders: $_config['admincp']['founder'] = '1,2,3'; --------- //
$_config['admincp']['founder'] = '1,2';
$_config['admincp']['forcesecques'] = '1';
$_config['admincp']['checkip'] = 0;
$_config['admincp']['runquery'] = '0';
$_config['admincp']['dbimport'] = '0';
$_config['debug'] = 'discuz';

// --------------------------  m_ config add  -------------------------- //
$_config['m_blockc'] = 2831;
$_config['m_img_url'] = 'http://image.8264.com/';

// -------------------  ALL HOST DOMAIN  ------------ //
$_config['host']['forum'] = 'bbs.8264.com';
$_config['host']['portal'] = 'http://newdx';
$_config['host']['home'] = 'u.8264.com';
$_config['host']['attach'] = 'image.8264.com';
$_config['host']['attachauto'] = 'autoimg.8264.com';
$_config['host']['mobile'] = 'wap.8264.com';

$_config['web']['forum'] = 'http://bbs.8264.com/';
$_config['web']['portal'] = 'http://www.8264.com/';
$_config['web']['home'] = 'http://u.8264.com/';
$_config['web']['attach'] = 'http://image.8264.com/';
$_config['web']['avatar'] = 'http://avatar.8264.com/';
// $_config['web']['avatar'] = 'http://image.8264.com/';
$_config['web']['attachauto'] = 'http://autoimg.8264.com/';
$_config['web']['mobile'] = 'http://m.8264.com/';
$_config['web']['static'] = 'http://static.8264.com/';

$_config['alldomain']['forum'] = 'newdx';
$_config['alldomain']['group'] = 'newdx';
$_config['alldomain']['home'] = 'newdx';
$_config['alldomain']['channel'] = 'newdx';

// -------------------  FID CONFIG  ----------------- //
$_config['fids']['zbfx'] = 437;		//装备分享
$_config['fids']['mudidi'] = 433;	//目的地
$_config['fids']['produce'] = 408;	//品牌区
$_config['fids']['dianpu'] = 471;	//店铺
$_config['fids']['mountain'] = 392;	//山峰
$_config['fids']['skiing'] = 477;	//滑雪
$_config['fids']['brand'] = 408;	//新品牌
$_config['fids']['equipment'] = 490;    //装备
$_config['fids']['line'] = 494;    //线路
$_config['fids']['shop'] = 471;	//店铺
$_config['fids']['climb'] = 497; //攀爬
$_config['fids']['diving'] = 498; //潜水
$_config['fids']['fishing'] = 499; //钓鱼
$_config['fids']['club'] = 501; //俱乐部
$_config['fids']['hostel'] = 502; //客栈
$_config['fids']['chain'] = 503; //产品供应链

// -------------------  MOBILE CONFIG  ----------------- //
$_config['mobile']['picQuality'] = 40;	//图片压缩质量

// -------------------  在外APP api接口密钥配置  ----------------- //
$_config['zaiwaiapi'] = array(
    'url' => 'http://api.zaiwai.com/',
    'token' => '4579343206432'
);

// -------------------  在外app 微信公众平台api接口密钥配置  ----------------- //
$_config['wechat'] = array(
    'url' => 'https://api.weixin.qq.com/cgi-bin/',
    'appid' => 'wx168321fa5c62aae2',
    'appsecret' => 'aea84487be5bde08c10318396159928f'
);

// -------------------  8264户外资料网 微信公众平台api接口密钥配置  ----------------- //
$_config['wechat8264'] = array(
    'url' => 'https://api.weixin.qq.com/cgi-bin/',
    'appid' => 'wxed48effe86e38ed2',
    'appsecret' => 'f220ee7d1a9b25ccdb13bca07678b182'
);

// -------------------  8264活动平台 微信公众平台api接口密钥配置  ----------------- //
$_config['wechat8264hd'] = array(
    'url' => 'https://api.weixin.qq.com/cgi-bin/',
    'appid' => 'wx0c5ba58ce68cde0a',
    'appsecret' => 'd10fe5f7b5d0a7ed0e6d17591be47622'
);


// -------------------  8264服务号 微信公众平台api接口密钥配置  ----------------- //
$_config['wechat8264fwh'] = array(
    'url' => 'https://api.weixin.qq.com/cgi-bin/',
    'appid' => 'wxe837fbe00fd72769',
    'appsecret' => '335b4b90e8dc31eec1941bfea84cd2a3'
);

// -------------------  8264小程序密钥配置  ----------------- //
$_config['sapp'] = array(
    'appid' => 'wxbf05707467d24004',
    'appsecret' => '93a46a0f87b0155d938abab9dcb57095'
);

// -------------------  对外api接口密钥配置  ----------------- //
$_config['apikey'] = array(
    // 'appname' => 'secretkey',	// 此行为配置说明，勿去注释
    'zaiwaiapp' => 'VaKeCtYCo1',	// app活动接口
    'zaiwaiadmin' => '7AWQdDCmdY',	// 长篇游记获取帖子
    'wechatapi' => 'dOLfMqji'	// 微信公众号API TOKEN中控服务
);

// ------------------- 8264活动平台 ----------------------//
$_config['hdapikey']['8264com'] = array(
    'appname' => '8264com', //appname
    'appsecret' => '66f53690bd8daf2f59704db465ba8788' //appsecret
);

// ------------------- 云片短信发送平台 ----------------------//
$_config['ypsms'] = array(
    'isopen' => true,
    'apikey' => '5b04478a25728dbce16c89e29c697748'
);

// -------------------  URL REWRITE  -----------------//
$_config['rewrite']['skiing'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)('|\")" => "xuechang-\\1\\2",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1('|\")" => "xuechang-\\1\\2",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "xuechang-\\1-\\2",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)page=1('|\")" => "xuechang\\1",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)page=1(?:&|&amp;)pro=0('|\")" => "xuechang\\1",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)page=(\d+)(?:&|&amp;)pro=(\d+)" => "xuechang-\\2-5-\\1",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)page=(\d+)(?:&|&amp;)pro=(\d+)" => "xuechang-\\2-1-\\1",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)page=(\d+)(?:&|&amp;)pro=(\d+)" => "xuechang-\\2-4-\\1",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "xuechang-public",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "xuechang-edit-tid-\\1-pid-\\2-page-\\3",
);

$_config['rewrite']['equipment'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2.html",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "zhuangbei-\\1-1.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "zhuangbei-public.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "zhuangbei-edit-tid-\\1-pid-\\2-page-\\3.html",
    //"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:(?:&|&amp;)pcid=0)?(?:(?:&|&amp;)cid=0)?(?:(?:&|&amp;)bid=0)?(?:&|&amp;)page=1" => "zhuangbei.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)min=(\d*)(?:&|&amp;)max=(\d*)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-1-\\6-\\4-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)min=(\d*)(?:&|&amp;)max=(\d*)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-4-\\6-\\4-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)min=(\d*)(?:&|&amp;)max=(\d*)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-5-\\6-\\4-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-1-\\4.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-4-\\4.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-5-\\4.html",
);

$_config['rewrite']['brand'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "pinpai-\\1",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)page=1('|\")" => "pinpai\\1",
    "(?:&|&amp;)act=showlist('|\")" => "pinpai\\1",
    //"(?:&|&amp;)act=showlist(?:&|&amp;)let=0(?:&|&amp;)nat=0(?:&|&amp;)cp=0(?:&|&amp;)order=heats(?:&|&amp;)page=1('|\")" => "pinpai\\1\\2",
    "(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=score(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-3-\\4",
    "(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=heats(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-2-\\4",
    "(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=dateline(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-1-\\4",
    "(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=lastpost(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-4-\\4",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new(?:&|&amp;)action=newthread" => "pinpai-public",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)(?:&|&amp;)action=edit" => "pinpai-edit-tid-\\1-pid-\\2-page-\\3",
);

$_config['rewrite']['line'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "xianlu-\\1",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "xianlu-public",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-edit-tid-\\1-pid-\\2-page-\\3",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)lType=(\d+)(?:&|&amp;)lTime=(\d+)(?:&|&amp;)province=(\d+)(?:&|&amp;)city=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-1-\\5",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)lType=(\d+)(?:&|&amp;)lTime=(\d+)(?:&|&amp;)province=(\d+)(?:&|&amp;)city=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-2-\\5",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=latest(?:&|&amp;)lType=(\d+)(?:&|&amp;)lTime=(\d+)(?:&|&amp;)province=(\d+)(?:&|&amp;)city=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-3-\\5",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)lType=(\d+)(?:&|&amp;)lTime=(\d+)(?:&|&amp;)province=(\d+)(?:&|&amp;)city=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-4-\\5",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "xianlu-delete-tid-\\1",
    "(?:&|&amp;)act=downloadGps(?:&|&amp;)aid=(\w+)(?:&|&amp;)iskml=1" => "xianlu-gpsattachment-aid-\\1-iskml-yes.html",
    "(?:&|&amp;)act=downloadGps(?:&|&amp;)aid=(\w+)" => "xianlu-gpsattachment-aid-\\1.html",
);

$_config['rewrite']['mountain'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-\\1-\\2",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "shanfeng-\\1",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "shanfeng-public",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-edit-tid-\\1-pid-\\2-page-\\3",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-1-dq-\\1-gd-\\2-page-\\3",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-2-dq-\\1-gd-\\2-page-\\3",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=newest(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-3-dq-\\1-gd-\\2-page-\\3",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-4-dq-\\1-gd-\\2-page-\\3",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "shanfeng-delete-tid-\\1",
);

$_config['rewrite']['shop'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "dianpu-\\1",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "dianpu-public",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "dianpu-edit-tid-\\1-pid-\\2-page-\\3",
    "(?:&|&amp;)act=showlist(?:&|&amp;)pid=0(?:&|&amp;)rid=0(?:&|&amp;)sid=0(?:&|&amp;)cid=0(?:&|&amp;)bid=0(?:&|&amp;)order=lastpost(?:&|&amp;)page=1('|\")" => "dianpu\\1",
    "(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=heats(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-3-\\6",
    "(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=lastpost(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-4-\\6",
    "(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=score(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-2-\\6",
    "(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=dateline(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-1-\\6",
);

$_config['rewrite']['diving'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "qianshui/\\1.html\"",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/\\1-\\2.html",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "qianshui/\\1.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-1.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-2.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-3.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=latest(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-4.html",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "qianshui/delete-tid-\\1.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "qianshui/public.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "qianshui/edit-tid-\\1-pid-\\2-page-\\3.html",
);

$_config['rewrite']['climb'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "panpa/\\1.html\"",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/\\1-\\2.html",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "panpa/\\1.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-1-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-2-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-3-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=latest(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-4-\\5.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "panpa/public.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/edit-tid-\\1-pid-\\2-page-\\3.html",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "panpa/delete-tid-\\1.html",
);

$_config['rewrite']['fishing'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "diaoyu/\\1.html\"",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "diaoyu/\\1-\\2.html",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "diaoyu/\\1.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)type=(\d+)(?:&|&amp;)isfree=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)order=lastpost(?:&|&amp;)page=(\d+)" => "diaoyu/list-\\1-\\2-\\3-\\4-1-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)type=(\d+)(?:&|&amp;)isfree=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)order=heats(?:&|&amp;)page=(\d+)" => "diaoyu/list-\\1-\\2-\\3-\\4-2-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)type=(\d+)(?:&|&amp;)isfree=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)order=score(?:&|&amp;)page=(\d+)" => "diaoyu/list-\\1-\\2-\\3-\\4-3-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)type=(\d+)(?:&|&amp;)isfree=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)order=dateline(?:&|&amp;)page=(\d+)" => "diaoyu/list-\\1-\\2-\\3-\\4-4-\\5.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "diaoyu/public.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "diaoyu/edit-tid-\\1-pid-\\2-page-\\3.html",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "diaoyu/delete-tid-\\1.html",
);

$_config['rewrite']['club'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "julebu/\\1.html\"",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/\\1-\\2.html",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "julebu/\\1.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-\\4-1-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-\\4-2-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-\\4-3-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=latest(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-\\4-4-\\5.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "julebu/public.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/edit-tid-\\1-pid-\\2-page-\\3.html",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "julebu/delete-tid-\\1.html",
);

$_config['rewrite']['hostel'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "kezhan/\\1.html\"",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "kezhan/\\1-\\2.html",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "kezhan/\\1.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "kezhan/list-\\1-\\2-1-\\3.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "kezhan/list-\\1-\\2-2-\\3.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "kezhan/list-\\1-\\2-3-\\3.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "kezhan/list-\\1-\\2-4-\\3.html",
    "(?:&|&amp;)act=myshowlist(?:&|&amp;)page=(\d+)" => "kezhan/mylist-\\1.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "kezhan/public.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "kezhan/edit-tid-\\1-pid-\\2-page-\\3.html",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "kezhan/delete-tid-\\1.html",
);

$_config['rewrite']['chain'] = array(
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "gongyinglian/\\1.html\"",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/\\1-\\2.html",
    "(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "gongyinglian/\\1.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-1-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-2-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-3-\\5.html",
    "(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-4-\\5.html",
    "(?:&|&amp;)act=myshowlist(?:&|&amp;)page=(\d+)" => "gongyinglian/mylist-\\1.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "gongyinglian/public.html",
    "(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/edit-tid-\\1-pid-\\2-page-\\3.html",
    "(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "gongyinglian/delete-tid-\\1.html",
);

$_config['rewrite']['global'] = array(
    "ctl=skiing(?:&|&amp;)act=showlist('|\")" => "xuechang\\1",
    "ctl=brand(?:&|&amp;)act=showlist('|\")" => "pinpai\\1",
    "ctl=equipment(?:&|&amp;)act=showlist" => "zhuangbei.html\\1",
    "ctl=line(?:&|&amp;)act=showlist('|\")" => "xianlu\\1",
    "ctl=mountain(?:&|&amp;)act=showlist('|\")" => "shanfeng\\1",
    "ctl=shop(?:&|&amp;)act=showlist('|\")" => "dianpu\\1",
    "ctl=climb(?:&|&amp;)act=showlist" => "panpa/",
    "ctl=diving(?:&|&amp;)act=showlist" => "qianshui/",
    "ctl=fishing(?:&|&amp;)act=showlist" => "diaoyu/",
    "ctl=club(?:&|&amp;)act=showlist" => "julebu/",
    "ctl=hostel(?:&|&amp;)act=showlist" => "kezhan/",
    "ctl=chain(?:&|&amp;)act=showlist" => "gongyinglian/",
);
// $_config['plugindeveloper'] = 1;
// -------------------  THE END  -------------------- //
?>
