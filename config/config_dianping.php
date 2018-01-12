<?php
/**
 *	config_dianping.php
 *	������������
 *
 */

// common config rules
$dp_modules = array(
	'brand' => array(
		'fid' => 408,
		'mname' => 'brand',
		'cname' => '����Ʒ��',
		'uname' => 'pinpai',
		'enable' => 1,
		'allow_pic' => 1
		),
	'equipment' => array(
		'fid' => 490,
		'mname' => 'equipment',
		'cname' => '������Ʒ��',
		'uname' => 'zhuangbei',
		'enable' => 1,
		'allow_pic' => 1
		),
	'shop' => array(
		'fid' => 471,
		'mname' => 'shop',
		'cname' => '�����',
		'uname' => 'dianpu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'climb' => array(
		'fid' => 497,
		'mname' => 'climb',
		'cname' => '��������',
		'uname' => 'panpa',
		'enable' => 1,
		'allow_pic' => 1
		),
	'skiing' => array(
		'fid' => 477,
		'mname' => 'skiing',
		'cname' => '��ѩ��',
		'uname' => 'xuechang',
		'enable' => 1,
		'allow_pic' => 1
		),
	'diving' => array(
		'fid' => 498,
		'mname' => 'diving',
		'cname' => 'Ǳˮ��',
		'uname' => 'qianshui',
		'enable' => 1,
		'allow_pic' => 1
		),
	'mountain' => array(
		'fid' => 392,
		'mname' => 'mountain',
		'cname' => 'ɽ��',
		'uname' => 'shanfeng',
		'enable' => 1,
		'allow_pic' => 1
		),
	'line' => array(
		'fid' => 494,
		'mname' => 'line',
		'cname' => '��·',
		'uname' => 'xianlu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'fishing' => array(
		'fid' => 499,
		'mname' => 'fishing',
		'cname' => '���㳡��',
		'uname' => 'diaoyu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'club' => array(
		'fid' => 501,
		'mname' => 'club',
		'cname' => '������ֲ�',
		'uname' => 'julebu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'hostel' => array(
		'fid' => 502,
		'mname' => 'hostel',
		'cname' => '�����ջ',
		'uname' => 'kezhan',
		'enable' => 1,
		'allow_pic' => 1
		),
	'chain' => array(
		'fid' => 503,
		'mname' => 'chain',
		'cname' => '��Ʒ��Ӧ��',
		'uname' => 'gongyinglian',
		'enable' => 0,
		'allow_pic' => 1
		),
);

// category rules
// ע����������ID���ֲ�һ��

$dp_category = array(
	'brand' => array(
		'letter' => array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z'),
		'region' => array(125=>'����',126=>'�¹�',127=>'��ʿ',128=>'����',129=>'�ձ�',130=>'�й�',131=>'�����',132=>'Ӣ��',133=>'����',134=>'���',136=>'���ô�',137=>'�µ���',138=>'Ų��',139=>'������',177=>'����',135=>'����'),
		'ranklist' => array(38=>'ʮ����ЬƷ�����а�',
			39=>'ʮ���ۺ��໧��Ʒ�����а�',
			41=>'ʮ���ۺ��໧��Ʒ�����а񣨹���Ʒ�ƣ�',
			43=>'ʮ���ⱳ��Ʒ�����а�',
			45=>'ʮ��������Ʒ�����а�',
			47=>'ʮ������Ʒ�����а񣨹���Ʒ�ƣ�',
			48=>'ʮ������Ʒ�����а񣨹���Ʒ�ƣ�',
			49=>'ʮ�������޷�Ʒ�����а񣨹���Ʒ�ƣ�',
			50=>'ʮ�������޷�Ʒ�����а񣨹���Ʒ�ƣ�',
			51=>'ʮ����˯��Ʒ�����а�',
			52=>'ʮ�����ٸ���Ʒ�����а񣨹���Ʒ�ƣ�',
			53=>'ʮ�����ٸ���Ʒ�����а񣨹���Ʒ�ƣ�',
			54=>'ʮ��������¿�Ʒ�����а�',
			55=>'ʮ�����ɽ��Ʒ�����а�',
			56=>'ʮ���������Ʒ�����а�',
			57=>'ʮ���⻬ѩ��Ʒ�����а�',
			58=>'ʮ�������¿�Ʒ�����а�',
			59=>'ʮ���������ƾ�Ʒ�����а�',
			60=>'ʮ���������ʱ�װ��Ʒ�����а�',
			150=>'ʮ�����г�Ʒ�����а�',
			151=>'ʮ�����ɽ��Ʒ�����а�',
			152=>'ʮ����ˮ��Ʒ�����а�',
			156=>'ʮ��ԽҰ��ЬƷ�����а�',
			157=>'ʮ�����ɽѥƷ�����а�',
			175=>'ʮ����¯�߲;�Ʒ�����а�',
			179=>'ʮ�󶥼��ݳ޻���Ʒ�����а�',
			180=>'ʮ���������ƷƷ�����а�',
			181=>'ʮ��ʱ�л���Ʒ�����а�',
			182=>'ʮ�������ϸ������а�',
			183=>'ʮ��������Ʒ�����а�',
			184=>'ʮ�����۾�Ʒ�����а�',
		),
	),
	'equipment' => array(
		'category' => array(
			10 => array(
				'name' => '��װ',
				'child' => array(71=>'����¿�',72=>'����¿�',73=>'ץ���¿�',74=>'���޷�',75=>'�޷�',76=>'�ٸ��¿�',77=>'�����¿�',78=>'��ѩ/����/ˮ��/�ܲ�/���ҷ�װ',80=>'����',154=>'Ƥ������',202=>'ñ��/ͷ��/����/����/ѩ��/��ϥ'),
				),
			11 => array(
				'name' => 'Ь��',
				'child' => array(81=>'��ɽѥ',82=>'��ɽЬ',83=>'����Ь',84=>'ͽ��Ь',85=>'ԽҰ��Ь',86=>'��ϪЬ/��Ь/��Ь',87=>'����Ь/��Ь',141=>'�๦��/�ӽ�Ь',178=>'����'),
				),
			12 => array(
				'name' => '����',
				'child' => array(92=>'ˮ����/��ˮ��',93=>'���/�����',94=>'������/�����԰�',95=>'����/��Ӱ��',144=>'���ͱ�����45L���ϣ�',145=>'���ͱ�����30L--45L��',146=>'С�ͱ�����30L���£�',149=>'ϴ����/Ǯ��/�����'),
				),
			13 => array(
				'name' => '¶Ӫװ��',
				'child' => array(96=>'����',97=>'˯��',98=>'����/������',99=>'ͷ��',100=>'�ֵ�',101=>'Ӫ�ص�',102=>'¯��',103=>'�;�',104=>'ˮ��/���±�/ˮ��/ˮ��',158=>'����¶Ӫ����'),
				),
			19 => array(
				'name' => '��ɽ����װ��',
				'child' => array(105=>'�ʵ�����',106=>'��׶/����/��צ',107=>'��ȫ��/ͷ��',108=>'����/���',109=>'��ɽ/ͽ����'),
				),
			21 => array(
				'name' => '�ֱ�/�۾�/����/����',
				'child' => array(110=>'�����ֱ�',111=>'GPS',112=>'�Խ���',113=>'��������',114=>'�۾�'),
				),
			23 => array(
				'name' => '�ۺ�װ��',
				'child' => array(143=>'�ۺ�װ��'),
				),
			70 => array(
				'name' => '����װ��',
				'child' => array(115=>'���г�',117=>'���а�/�԰�',140=>'���е�',155=>'���'),
				),
			118 => array(
				'name' => '��ѩװ��',
				'child' => array(119=>'ѩ��/�̶���',120=>'ѩ��',121=>'ѩѥ',122=>'����',142=>'ѩ��'),
				),
		),
	),
	'mountain' => array(
		'dq' => array("405"=>"�Ĵ�","406"=>"����","407"=>"����","408"=>"�ຣ","409"=>"�½�","410"=>"�Ჴ��","411"=>"�ͻ�˹̹","412"=>"����"),
		'gd' => array("6"=>"4000������","1"=>"4000-5000��","2"=>"5000-6000��","3"=>"6000-7000��","4"=>"7000-8000��","5"=>"8000������"),
	),
	'climb' => array(
		'type' => array(184=>'����',185=>'�ʱ�',186=>'��ʯ'),
		'placetype' => array(188=>'��Ȼ�ұ�',189=>'�˹��ұ�'),
	),
	'club' => array(
		'type' => array(206=>'��˾����',207=>'�е�Э���ֲ�',208=>'����'),
	),
	'diving' => array(
		'type' => array(191=>'��Ǳ��',192=>'ˮ��Ǳ��'),
	),
	'fishing' => array(
		'type' => array(
			194=>'ˮ�����',
			197=>'���Ӻ�Ϫ',
			201=>'�������',
		),
		'catetype'=>array(
			195=>'ˮ��',
			196=>'����',
			198=>'���Ӷ�',
			199=>'����',
			200=>'Ϫ��',
			201=>'�������'
		),
		'childtype'=>array(
			194=>'195,196',
			197=>'198,199,200',
			201=>'201',
		),
		'alltypename'=>array(
			194=>'ˮ�����',
			195=>'ˮ�����',
			196=>'ˮ�����',
			197=>'���Ӻ�Ϫ',
			198=>'���Ӻ�Ϫ',
			199=>'���Ӻ�Ϫ',
			200=>'���Ӻ�Ϫ',
			201=>'�������'
		),
		'isfree' => array(1=>'�շ�',2=>'���'),
	),
	'line' => array(
		'type' => array(160=>'ͽ����Խ',164=>'�Լݳ���'),
		'timetype'=>array(167 => '1��',168 => '2��',169 => '3��',170 => '4��',171 => '5��',172 => '6��',173 => '7��',174 => '7������'),
	),
	'chain' => array(
		'category' => array(
			1 => array(
				'name' => '��װ���ϼӹ���',
				'child' => array(10=>'��ˮ����',11=>'��������',12=>'��������',13=>'�ٸ�����',14=>'ץ������',15=>'�ٸ�T������'),
				),
			2 => array(
				'name' => '��װ���ϼӹ���',
				'child' => array(20=>'����',21=>'�̱�',22=>'������',23=>'���',24=>'����',25=>'�ĺϿ�',26=>'��ͷ��'),
				),
			3 => array(
				'name' => '���¼ӹ���',
				'child' => array(30=>'��ѩ��',31=>'�����',32=>'���㣨ѹ���ࣩ',33=>'�޷�',34=>'���޷�',35=>'���',36=>'�ٸɿ�',37=>'����',38=>'Ƥ����',39=>'ץ����',40=>'T��',41=>'������'),
				),
			4 => array(
				'name' => '��װ����ӹ���',
				'child' => array(42=>'ñ��',43=>'����',44=>'����',45=>'ͷ��'),
				),
			5 => array(
				'name' => 'װ���ӹ���',
				'child' => array(50=>'����',51=>'˯��',52=>'����',53=>'�ص�',54=>'Ұ�͵�',55=>'��ɽ��',56=>'�ֵ�',57=>'ͷ��',58=>'¶Ӫ��',59=>'¯��'),
				),
		),
	),
);

// rewrite rules
// ע����д��ǰ��˳��֮�֣����ҵ������ܳ�bug

$dp_rewrite['skiing'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1('|\")" => "xuechang-\\1\\2",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "xuechang-\\1-\\2",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "xuechang-\\1",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)page=1('|\")" => "xuechang\\1",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pro=0(?:&|&amp;)page=1('|\")" => "xuechang\\1",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pro=(\d+)(?:&|&amp;)page=(\d+)" => "xuechang-\\1-5-\\2",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)pro=(\d+)(?:&|&amp;)page=(\d+)" => "xuechang-\\1-1-\\2",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)pro=(\d+)(?:&|&amp;)page=(\d+)" => "xuechang-\\1-4-\\2",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "xuechang-public",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "xuechang-edit-tid-\\1-pid-\\2-page-\\3",
);

$dp_rewrite['equipment'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2.html",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "zhuangbei-\\1-1.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "zhuangbei-public.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "zhuangbei-edit-tid-\\1-pid-\\2-page-\\3.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:(?:&|&amp;)pcid=0)?(?:(?:&|&amp;)cid=0)?(?:(?:&|&amp;)bid=0)?(?:&|&amp;)page=1" => "zhuangbei.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)min=(\d*)(?:&|&amp;)max=(\d*)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-1-\\6-\\4-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)min=(\d*)(?:&|&amp;)max=(\d*)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-4-\\6-\\4-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)min=(\d*)(?:&|&amp;)max=(\d*)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-5-\\6-\\4-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-1-\\4.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-4-\\4.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\w+)(?:&|&amp;)page=(\d+)" => "zhuangbei-\\1-\\2-\\3-5-\\4.html",
);

$dp_rewrite['brand'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "pinpai-\\1",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)page=1('|\")" => "pinpai\\1",
	"(?:&|&amp;)act=showlist('|\")" => "pinpai\\1",
	// "(?:&|&amp;)act=showlist(?:&|&amp;)let=0(?:&|&amp;)nat=0(?:&|&amp;)cp=0(?:&|&amp;)order=heats(?:&|&amp;)page=1('|\")" => "pinpai\\1\\2",
	"(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=lastpost(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-4-\\4",
	"(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=score(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-3-\\4",
	"(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=heats(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-2-\\4",
	"(?:&|&amp;)act=showlist(?:&|&amp;)let=(\d+)(?:&|&amp;)nat=(\d+)(?:&|&amp;)cp=(\d+)(?:&|&amp;)order=dateline(?:&|&amp;)page=(\d+)" => "pinpai-\\1-\\2-\\3-1-\\4",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new(?:&|&amp;)action=newthread" => "pinpai-public",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)(?:&|&amp;)action=edit" => "pinpai-edit-tid-\\1-pid-\\2-page-\\3",
);

$dp_rewrite['line'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "xianlu-\\1",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "xianlu-public",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-edit-tid-\\1-pid-\\2-page-\\3",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)type=(\d+)(?:&|&amp;)timetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-1-\\5",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)type=(\d+)(?:&|&amp;)timetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-2-\\5",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)type=(\d+)(?:&|&amp;)timetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-3-\\5",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)type=(\d+)(?:&|&amp;)timetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "xianlu-\\1-\\2-\\3-\\4-4-\\5",
	"(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "xianlu-delete-tid-\\1",
	"(?:&|&amp;)act=downloadGps(?:&|&amp;)aid=(\w+)(?:&|&amp;)iskml=1" => "xianlu-gpsattachment-aid-\\1-iskml-yes.html",
	"(?:&|&amp;)act=downloadGps(?:&|&amp;)aid=(\w+)" => "xianlu-gpsattachment-aid-\\1.html",
);

$dp_rewrite['mountain'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-\\1-\\2",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "shanfeng-\\1",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "shanfeng-public",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-edit-tid-\\1-pid-\\2-page-\\3",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-1-dq-\\1-gd-\\2-page-\\3",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-2-dq-\\1-gd-\\2-page-\\3",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-3-dq-\\1-gd-\\2-page-\\3",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)dq=(\d+)(?:&|&amp;)gd=(\d+)(?:&|&amp;)page=(\d+)" => "shanfeng-4-dq-\\1-gd-\\2-page-\\3",
	"(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "shanfeng-delete-tid-\\1",
);

$dp_rewrite['shop'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "dianpu-\\1",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "dianpu-public",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "dianpu-edit-tid-\\1-pid-\\2-page-\\3",
	"(?:&|&amp;)act=showlist(?:&|&amp;)pid=0(?:&|&amp;)rid=0(?:&|&amp;)sid=0(?:&|&amp;)cid=0(?:&|&amp;)bid=0(?:&|&amp;)order=lastpost(?:&|&amp;)page=1('|\")" => "dianpu\\1",
	"(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=lastpost(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-4-\\6",
	"(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=heats(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-3-\\6",
	"(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=score(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-2-\\6",
	"(?:&|&amp;)act=showlist(?:&|&amp;)pid=(\d+)(?:&|&amp;)rid=(\d+)(?:&|&amp;)sid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)bid=(\d+)(?:&|&amp;)order=dateline(?:&|&amp;)page=(\d+)" => "dianpu-\\1-\\2-\\3-\\4-\\5-1-\\6",
);

$dp_rewrite['climb'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "panpa/\\1.html\"",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/\\1-\\2.html",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "panpa/\\1.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-1-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-2-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-3-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)type=(\d+)(?:&|&amp;)placetype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/list-\\1-\\2-\\3-\\4-4-\\5.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "panpa/public.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "panpa/edit-tid-\\1-pid-\\2-page-\\3.html",
	"(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "panpa/delete-tid-\\1.html",
);

$dp_rewrite['club'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "julebu/\\1.html\"",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/\\1-\\2.html",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "julebu/\\1.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)gongsitype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-1-\\4.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)gongsitype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-2-\\4.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)gongsitype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-3-\\4.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)gongsitype=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/list-\\1-\\2-\\3-4-\\4.html",
	"(?:&|&amp;)act=myshowlist(?:&|&amp;)page=(\d+)" => "julebu/mylist-\\1.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "julebu/public.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "julebu/edit-tid-\\1-pid-\\2-page-\\3.html",
	"(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "julebu/delete-tid-\\1.html",
);
$dp_rewrite['diving'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "qianshui/\\1.html\"",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/\\1-\\2.html",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "qianshui/\\1.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-1.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-2.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-3.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)type=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "qianshui/list-\\1-\\2-\\3-\\4-4.html",
	"(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "qianshui/delete-tid-\\1.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "qianshui/public.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)&page=(\d+)" => "qianshui/edit-tid-\\1-pid-\\2-page-\\3.html",
);

$dp_rewrite['fishing'] = array(
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
$dp_rewrite['hostel'] = array(
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

$dp_rewrite['chain'] = array(
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=1\"" => "gongyinglian/\\1.html\"",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/\\1-\\2.html",
	"(?:&|&amp;)act=showview(?:&|&amp;)tid=(\d+)" => "gongyinglian/\\1.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=lastpost(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-1-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=heats(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-2-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=score(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-3-\\5.html",
	"(?:&|&amp;)act=showlist(?:&|&amp;)order=dateline(?:&|&amp;)pcid=(\d+)(?:&|&amp;)cid=(\d+)(?:&|&amp;)provinceid=(\d+)(?:&|&amp;)cityid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/list-\\1-\\2-\\3-\\4-4-\\5.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=new" => "gongyinglian/public.html",
	"(?:&|&amp;)act=dopost(?:&|&amp;)do=edit(?:&|&amp;)tid=(\d+)(?:&|&amp;)pid=(\d+)(?:&|&amp;)page=(\d+)" => "gongyinglian/edit-tid-\\1-pid-\\2-page-\\3.html",
	"(?:&|&amp;)act=deleteit(?:&|&amp;)tid=(\d+)" => "gongyinglian/delete-tid-\\1.html",
);

$dp_rewrite['global'] = array(
	"mod=skiing(?:&|&amp;)act=showlist('|\")" => "xuechang\\1",
	"mod=brand(?:&|&amp;)act=showlist('|\")" => "pinpai\\1",
	"mod=equipment(?:&|&amp;)act=showlist" => "zhuangbei.html",
	"mod=line(?:&|&amp;)act=showlist('|\")" => "xianlu\\1",
	"mod=mountain(?:&|&amp;)act=showlist('|\")" => "shanfeng\\1",
	"mod=shop(?:&|&amp;)act=showlist('|\")" => "dianpu\\1",
	"mod=climb(?:&|&amp;)act=showlist" => "panpa/",
	"mod=diving(?:&|&amp;)act=showlist" => "qianshui/",
	"mod=fishing(?:&|&amp;)act=showlist" => "diaoyu/",
	"mod=club(?:&|&amp;)act=showlist" => "julebu/",
	"mod=hostel(?:&|&amp;)act=showlist" => "kezhan/",
	"mod=chain(?:&|&amp;)act=showlist" => "gongyinglian/",
);

$dp_star = array(
	'brand' 	=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'equipment' => array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'shop' 		=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'climb' 	=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'skiing' 	=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'diving' 	=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'mountain'  => array('1'=>'�ǳ���','2'=>'��','3'=>'��','4'=>'����','5'=>'�ǳ�����'),
	'line'    	=> array('1'=>'ǧ���ȥ','2'=>'��ñ�ȥ','3'=>'һ���Ƽ�','4'=>'�ص��Ƽ�','5'=>'��Ѫ�Ƽ�'),
	'fishing' 	=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'club'      => array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'hostel' 	=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
	'chain' 	=> array('1'=>'�ܲ�','2'=>'�ϲ�','3'=>'����','4'=>'�Ƽ�','5'=>'����'),
);
?>
