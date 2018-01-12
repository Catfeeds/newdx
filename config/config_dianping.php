<?php
/**
 *	config_dianping.php
 *	点评独立配置
 *
 */

// common config rules
$dp_modules = array(
	'brand' => array(
		'fid' => 408,
		'mname' => 'brand',
		'cname' => '户外品牌',
		'uname' => 'pinpai',
		'enable' => 1,
		'allow_pic' => 1
		),
	'equipment' => array(
		'fid' => 490,
		'mname' => 'equipment',
		'cname' => '户外用品库',
		'uname' => 'zhuangbei',
		'enable' => 1,
		'allow_pic' => 1
		),
	'shop' => array(
		'fid' => 471,
		'mname' => 'shop',
		'cname' => '户外店',
		'uname' => 'dianpu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'climb' => array(
		'fid' => 497,
		'mname' => 'climb',
		'cname' => '攀爬场地',
		'uname' => 'panpa',
		'enable' => 1,
		'allow_pic' => 1
		),
	'skiing' => array(
		'fid' => 477,
		'mname' => 'skiing',
		'cname' => '滑雪场',
		'uname' => 'xuechang',
		'enable' => 1,
		'allow_pic' => 1
		),
	'diving' => array(
		'fid' => 498,
		'mname' => 'diving',
		'cname' => '潜水点',
		'uname' => 'qianshui',
		'enable' => 1,
		'allow_pic' => 1
		),
	'mountain' => array(
		'fid' => 392,
		'mname' => 'mountain',
		'cname' => '山峰',
		'uname' => 'shanfeng',
		'enable' => 1,
		'allow_pic' => 1
		),
	'line' => array(
		'fid' => 494,
		'mname' => 'line',
		'cname' => '线路',
		'uname' => 'xianlu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'fishing' => array(
		'fid' => 499,
		'mname' => 'fishing',
		'cname' => '钓鱼场地',
		'uname' => 'diaoyu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'club' => array(
		'fid' => 501,
		'mname' => 'club',
		'cname' => '户外俱乐部',
		'uname' => 'julebu',
		'enable' => 1,
		'allow_pic' => 1
		),
	'hostel' => array(
		'fid' => 502,
		'mname' => 'hostel',
		'cname' => '旅舍客栈',
		'uname' => 'kezhan',
		'enable' => 1,
		'allow_pic' => 1
		),
	'chain' => array(
		'fid' => 503,
		'mname' => 'chain',
		'cname' => '产品供应链',
		'uname' => 'gongyinglian',
		'enable' => 0,
		'allow_pic' => 1
		),
);

// category rules
// 注意线上线下ID部分不一致

$dp_category = array(
	'brand' => array(
		'letter' => array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',7=>'G',8=>'H',9=>'I',10=>'J',11=>'K',12=>'L',13=>'M',14=>'N',15=>'O',16=>'P',17=>'Q',18=>'R',19=>'S',20=>'T',21=>'U',22=>'V',23=>'W',24=>'X',25=>'Y',26=>'Z'),
		'region' => array(125=>'美国',126=>'德国',127=>'瑞士',128=>'韩国',129=>'日本',130=>'中国',131=>'意大利',132=>'英国',133=>'法国',134=>'瑞典',136=>'加拿大',137=>'奥地利',138=>'挪威',139=>'西班牙',177=>'芬兰',135=>'其它'),
		'ranklist' => array(38=>'十大户外鞋品牌排行榜',
			39=>'十大综合类户外品牌排行榜',
			41=>'十大综合类户外品牌排行榜（国产品牌）',
			43=>'十大户外背包品牌排行榜',
			45=>'十大户外帐篷品牌排行榜',
			47=>'十大冲锋衣品牌排行榜（国际品牌）',
			48=>'十大冲锋衣品牌排行榜（国产品牌）',
			49=>'十大户外羽绒服品牌排行榜（国际品牌）',
			50=>'十大户外羽绒服品牌排行榜（国产品牌）',
			51=>'十大户外睡袋品牌排行榜',
			52=>'十大户外速干衣品牌排行榜（国际品牌）',
			53=>'十大户外速干衣品牌排行榜（国产品牌）',
			54=>'十大户外软壳衣裤品牌排行榜',
			55=>'十大户外登山杖品牌排行榜',
			56=>'十大户外防潮垫品牌排行榜',
			57=>'十大户外滑雪服品牌排行榜',
			58=>'十大户外内衣裤品牌排行榜',
			59=>'十大户外照明灯具品牌排行榜',
			60=>'十大户外攀岩攀冰装备品牌排行榜',
			150=>'十大自行车品牌排行榜',
			151=>'十大户外登山表品牌排行榜',
			152=>'十大户外水具品牌排行榜',
			156=>'十大越野跑鞋品牌排行榜',
			157=>'十大户外高山靴品牌排行榜',
			175=>'十大户外炉具餐具品牌排行榜',
			179=>'十大顶级奢侈户外品牌排行榜',
			180=>'十大户外数码产品品牌排行榜',
			181=>'十大时尚户外品牌排行榜',
			182=>'十大户外面料辅料排行榜',
			183=>'十大户外袜子品牌排行榜',
			184=>'十大户外眼镜品牌排行榜',
		),
	),
	'equipment' => array(
		'category' => array(
			10 => array(
				'name' => '服装',
				'child' => array(71=>'冲锋衣裤',72=>'软壳衣裤',73=>'抓绒衣裤',74=>'羽绒服',75=>'棉服',76=>'速干衣裤',77=>'休闲衣裤',78=>'滑雪/骑行/水上/跑步/攀岩服装',80=>'内衣',154=>'皮肤风衣',202=>'帽子/头巾/手套/腰带/雪套/护膝'),
				),
			11 => array(
				'name' => '鞋袜',
				'child' => array(81=>'高山靴',82=>'登山鞋',83=>'攀岩鞋',84=>'徒步鞋',85=>'越野跑鞋',86=>'溯溪鞋/凉鞋/拖鞋',87=>'休闲鞋/棉鞋',141=>'多功能/接近鞋',178=>'袜子'),
				),
			12 => array(
				'name' => '背包',
				'child' => array(92=>'水袋包/防水袋',93=>'挎包/单肩包',94=>'旅行箱/旅行驮包',95=>'腰包/摄影包',144=>'大型背包（45L以上）',145=>'中型背包（30L--45L）',146=>'小型背包（30L以下）',149=>'洗漱包/钱包/配件包'),
				),
			13 => array(
				'name' => '露营装备',
				'child' => array(96=>'帐篷',97=>'睡袋',98=>'垫子/防潮垫',99=>'头灯',100=>'手电',101=>'营地灯',102=>'炉具',103=>'餐具',104=>'水壶/保温杯/水袋/水杯',158=>'其他露营工具'),
				),
			19 => array(
				'name' => '登山攀岩装备',
				'child' => array(105=>'攀登器材',106=>'冰锥/冰镐/冰爪',107=>'安全带/头盔',108=>'绳索/扁带',109=>'登山/徒步杖'),
				),
			21 => array(
				'name' => '手表/眼镜/仪器/数码',
				'child' => array(110=>'户外手表',111=>'GPS',112=>'对讲机',113=>'电子数码',114=>'眼镜'),
				),
			23 => array(
				'name' => '综合装备',
				'child' => array(143=>'综合装备'),
				),
			70 => array(
				'name' => '骑行装备',
				'child' => array(115=>'自行车',117=>'骑行包/驮包',140=>'骑行灯',155=>'码表'),
				),
			118 => array(
				'name' => '滑雪装备',
				'child' => array(119=>'雪板/固定器',120=>'雪杖',121=>'雪靴',122=>'护具',142=>'雪镜'),
				),
		),
	),
	'mountain' => array(
		'dq' => array("405"=>"四川","406"=>"西藏","407"=>"云南","408"=>"青海","409"=>"新疆","410"=>"尼泊尔","411"=>"巴基斯坦","412"=>"其他"),
		'gd' => array("6"=>"4000米以下","1"=>"4000-5000米","2"=>"5000-6000米","3"=>"6000-7000米","4"=>"7000-8000米","5"=>"8000米以上"),
	),
	'climb' => array(
		'type' => array(184=>'攀岩',185=>'攀冰',186=>'抱石'),
		'placetype' => array(188=>'自然岩壁',189=>'人工岩壁'),
	),
	'club' => array(
		'type' => array(206=>'公司性质',207=>'中登协俱乐部',208=>'其他'),
	),
	'diving' => array(
		'type' => array(191=>'浮潜点',192=>'水肺潜点'),
	),
	'fishing' => array(
		'type' => array(
			194=>'水库池塘',
			197=>'江河湖溪',
			201=>'海洋钓场',
		),
		'catetype'=>array(
			195=>'水库',
			196=>'池塘',
			198=>'江河段',
			199=>'湖泊',
			200=>'溪流',
			201=>'海洋钓场'
		),
		'childtype'=>array(
			194=>'195,196',
			197=>'198,199,200',
			201=>'201',
		),
		'alltypename'=>array(
			194=>'水库池塘',
			195=>'水库池塘',
			196=>'水库池塘',
			197=>'江河湖溪',
			198=>'江河湖溪',
			199=>'江河湖溪',
			200=>'江河湖溪',
			201=>'海洋钓场'
		),
		'isfree' => array(1=>'收费',2=>'免费'),
	),
	'line' => array(
		'type' => array(160=>'徒步穿越',164=>'自驾车游'),
		'timetype'=>array(167 => '1天',168 => '2天',169 => '3天',170 => '4天',171 => '5天',172 => '6天',173 => '7天',174 => '7天以上'),
	),
	'chain' => array(
		'category' => array(
			1 => array(
				'name' => '服装面料加工厂',
				'child' => array(10=>'防水面料',11=>'复合面料',12=>'超轻面料',13=>'速干面料',14=>'抓绒面料',15=>'速干T恤面料'),
				),
			2 => array(
				'name' => '服装辅料加工厂',
				'child' => array(20=>'拉链',21=>'商标',22=>'弹力绳',23=>'橡根',24=>'束扣',25=>'四合扣',26=>'拉头袢'),
				),
			3 => array(
				'name' => '成衣加工厂',
				'child' => array(30=>'滑雪服',31=>'冲锋衣',32=>'冲锋裤（压胶类）',33=>'棉服',34=>'羽绒服',35=>'软壳',36=>'速干裤',37=>'衬衣',38=>'皮肤衣',39=>'抓绒衣',40=>'T恤',41=>'弹力裤'),
				),
			4 => array(
				'name' => '服装配件加工厂',
				'child' => array(42=>'帽子',43=>'手套',44=>'袜子',45=>'头巾'),
				),
			5 => array(
				'name' => '装备加工厂',
				'child' => array(50=>'背包',51=>'睡袋',52=>'帐篷',53=>'地垫',54=>'野餐垫',55=>'登山杖',56=>'手电',57=>'头灯',58=>'露营灯',59=>'炉具'),
				),
		),
	),
);

// rewrite rules
// 注意重写有前后顺序之分，勿乱调，可能出bug

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
	'brand' 	=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'equipment' => array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'shop' 		=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'climb' 	=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'skiing' 	=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'diving' 	=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'mountain'  => array('1'=>'非常简单','2'=>'简单','3'=>'难','4'=>'困难','5'=>'非常困难'),
	'line'    	=> array('1'=>'千万别去','2'=>'最好别去','3'=>'一般推荐','4'=>'重点推荐','5'=>'吐血推荐'),
	'fishing' 	=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'club'      => array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'hostel' 	=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
	'chain' 	=> array('1'=>'很差','2'=>'较差','3'=>'还行','4'=>'推荐','5'=>'力荐'),
);
?>
