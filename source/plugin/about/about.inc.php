<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$action = $_GET['action'] ? $_GET['action'] : 'contact';

if($action != 'contact')
{
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://www.8264.com/about-contact.html");
	exit;
}

$navtitle = '关于我们';
$metakeywords = '户外资料网,关于我们,联系我们,8264总部办公地址';
$metadescription = '户外资料网（8264.com）吸引了近千万的户外运动爱好者，已成为目前国内最具影响力的户外运动行业门户网站。我们一直致力于推广户外文化、为国内外的户外运动企业及户外运动爱好者提供全面、权威、专业的户外资讯及服务。';

include template("about:about");
?>
