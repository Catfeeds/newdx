<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$postdata = array_merge($_GET, $_POST);
$postdata = iconv_array($postdata, 'UTF-8', 'GBK');
extract($postdata);

//�������˵������ Get����des_typeΪ�������õļ� ע����Ϊ�˹�浯��λ��
$des_type = in_array($postdata['des_type'],array(39,135,146,495,88,24)) ? $postdata['des_type'] : 0;
$des_css="<span style='display:inline-block;color:red;'>";
$des_text = array(
	0=> '�������ù���'.$des_css.'����װ��</span>������������ܻ��'.$des_css.'1ö</span>8264�ң��ظ���������Ϯ����һ����ЧŶ��',
	39=> '�������ù���'.$des_css.'���</span>��'.$des_css.'��ͷ</span>������������ܻ��'.$des_css.'1ö</span>8264�ң��ظ���������Ϯ����һ����ЧŶ��',	
	135=> '�������ù���'.$des_css.'����װ��</span>��������������Ϥ��װ��������������ܻ��'.$des_css.'1ö</span>8264�ң��ظ���������Ϯ����һ����ЧŶ��',
	146=> '�������ù���'.$des_css.'¯ͷ���;�</span>�ȣ�������������Ϥ��װ��������������ܻ��'.$des_css.'1ö</span>8264�ң��ظ���������Ϯ����һ����ЧŶ��',
	495=> '�������ù���'.$des_css.'�ܲ�ԽҰ</span>װ����������������Ϥ��װ��������������ܻ��'.$des_css.'1ö</span>8264�ң��ظ���������Ϯ����һ����ЧŶ��',	
	88=> '�������ù���'.$des_css.'����װ��</span>��������������Ϥ��װ��������������ܻ��'.$des_css.'1ö</span>8264�ң��ظ���������Ϯ����һ����ЧŶ��',
	24=> '�������ù���'.$des_css.'ͽ���ʵ�װ��</span>��������������Ϥ��װ��������������ܻ��'.$des_css.'1ö</span>8264�ң��ظ���������Ϯ����һ����ЧŶ��',
	);

//�����ύ����
if($publishsubmit == 'yes' && $formhash == formhash() && in_array($mod, array("equipment"))) {
	if (!$_G['uid']) {
		exit("��½����ܽ��д˲���");
	}
	$starnum = intval($postdata['starnum']);
	$subject = cutstr($postdata['eqname'], 50, '');
	$extdata = dhtmlspecialchars(daddslashes($postdata['extdata']));
	$weakpoint = dhtmlspecialchars(daddslashes($postdata['weakpoint']));
	$goodpoint = dhtmlspecialchars(daddslashes($postdata['goodpoint']));
	$message = dhtmlspecialchars(daddslashes($postdata['message']));
	$reply_origin=intval($postdata['reply_origin']);
	if(empty($starnum) || empty($subject) || empty($extdata) || empty($weakpoint) || empty($goodpoint) || empty($message)) {
		exit("�������ݲ�ȫ");
	}

	//data1=�۸���Դ, data2=����, data3=�ŵ�, data4=�ۺ�
	DB::query("INSERT INTO ".DB::table("plugin_dianping_quick_reply")." (subject, authorid, authorname, starnum, data1, data2, data3, data4, useip, dateline, reply_origin) VALUES('$subject', '$_G[uid]', '$_G[username]', '$starnum', '$extdata', '$weakpoint', '$goodpoint', '$message', '$_G[clientip]', '$_G[timestamp]', '$reply_origin')");
	$result = DB::insert_id() ? '1' : '-2';
	exit($result);
}

//ģ������
if(!in_array($tpl, array("equipment"))) {
	exit("ģ�����");
}

include template('forumoption:quick_reply_'.$tpl);
?>
