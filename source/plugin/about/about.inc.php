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

$navtitle = '��������';
$metakeywords = '����������,��������,��ϵ����,8264�ܲ��칫��ַ';
$metadescription = '������������8264.com�������˽�ǧ��Ļ����˶������ߣ��ѳ�ΪĿǰ�������Ӱ�����Ļ����˶���ҵ�Ż���վ������һֱ�������ƹ㻧���Ļ���Ϊ������Ļ����˶���ҵ�������˶��������ṩȫ�桢Ȩ����רҵ�Ļ�����Ѷ������';

include template("about:about");
?>
