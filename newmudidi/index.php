<?php require_once BASEMUDIDI . 'mudidiheader.php'; ?>
	<!--约伴广告开始-->
    <div style="margin: 20px auto 10px auto; width:980px; cursor: pointer" id="yueban_">
        <img src="http://static.8264.com/static/images/forum/yunban/ybad.jpg" >
    </div>
    <!--约伴广告结束-->
<div class="warpten980 clear_b ptb30">
	<div class="indextitlebig clear_b">
		<span class="zbicon">户外旅游线路推荐</span>
		<a href="http://www.zaiwai.com?utm_source=s14363562&utm_campaign=p15035694">更多旅行线路>></a>
	</div>
	<div class="clear_b">
	<?php if($lvyoulist): ?>
		<?php if($leftarr): ?>
		<div class="w480 float_left boxborder liststyleone">
			<ul>
			<?php foreach($leftarr as $value): ?>
				<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['title']; ?>"><?php echo cutstr($value['title'], 36); ?><?php if($value['yh']): ?><em class="preferential"></em><?php endif; ?><?php if($value['hot']): ?><em class="hoticon"></em><?php endif; ?></a><span><i><?php echo $value['sales']; ?>人</i>已出游</span></li>
			<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<?php if($rightarr): ?>
		<div class="w480 float_right boxborder liststyleone">
			<ul>
				<?php foreach($rightarr as $value): ?>
				<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['title']; ?>"><?php echo cutstr($value['title'], 36); ?><?php if($value['yh']): ?><em class="preferential"></em><?php endif; ?><?php if($value['hot']): ?><em class="hoticon"></em><?php endif; ?></a><span><i><?php echo $value['sales']; ?>人</i>已出游</span></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<?php else: ?>
	<div class="w480 float_left boxborder liststyleone">
			<ul>
				<li>暂无线路</li>
			</ul>
		</div>
	<?php endif; ?>
	<div class="indextitlebig clear_b">
		<span class="glicon">最新游记攻略</span>
		<a href="http://bbs.8264.com/forum-52-1.html">更多游记攻略 >></a>
	</div>
	<div class="boxborder liststyleone">
		<ul>
			<?php if($travellist): ?>
			<?php $ints = 0; ?>
			<?php foreach($travellist as $values): ?>
			<?php $ints++; ?>
			<?php if($ints == 2): ?>
				<li>
					<a href="<?php echo $leftarr[0]['url']; ?>"><?php echo $leftarr[0]['title']; ?><em class="hoticon"></em></a>
				</li>
			<?php endif; ?>
				<li>
					<a href="<?php echo "{$_G['config']['web']['forum']}thread-{$values['tid']}-1-1.html"; ?>"><?php echo $values['subject']; ?></a>
					<span><img src="<?php echo $values['avatar']; ?>"/><a href="javascript:;"><?php echo $values['author']; ?></a></span>
				</li>
			<?php endforeach; ?>
			<?php else: ?>
				<li>暂无攻略</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
<!--约伴弹层样式开始-->
<style>
    .ybconright dl:after,.clear_b:after{content: ""; display: block; clear: both; visibility: hidden;}
    .ybconright dl,.clear_b{ zoom: 1;}
    .blackbg{ background:#000; opacity: 0.75; filter: alpha(opacity=75); position:fixed; _position:absolute; width:100%; height:100%; left:0px; top:0px; bottom:0px; right:0px;z-index: 88888;display: none;}
    .ybpopbox{ position:fixed; _position:absolute; width:100%; height:100%; z-index: 99999; left:0px; top:0px; right:0px; bottom:0px; overflow-y:auto}
    .ybclose{ background:url(http://static.8264.com/static/images/forum/yunban/ybcolse.jpg) left top no-repeat; width:50px; height:50px; position:absolute; right:-50px; top:0px; cursor:pointer;}
    .w606resultcon{ width:606px; margin:50px auto; position:relative; background:#fff; padding:0px 0px 40px 0px;}
    .resultbranner{ height:136px;}
    .resulttx{ width:114px; height:114px; border:#fff solid 3px; position:absolute; top:75px; left:245px; border-radius:50%;}
    .resulttx img{ width:114px; height:114px; border-radius:50%;}
    .usernameinfo{ padding:76px 0px 15px 0px; font-size:18px; color:#333; text-align:center; background:url(http://static.8264.com/static/images/forum/yunban/nameinfobg.jpg) center bottom no-repeat;}
    .usernameinfo em{ display:inline-block; vertical-align:-2px;}
    .manicon{ width:20px; height:17px; background:#2874e6; font-size:11px; color:#fff; font-weight:bold; display:inline-block; border-radius:3px; margin:0px 0px 0px 5px; }
    .womanicon{ width:20px; height:17px; background:#f26c62; font-size:11px; color:#fff; font-weight:bold; display:inline-block; border-radius:3px; margin:0px 0px 0px 5px;}
    .hyinfocon{ background:#fcfdfe; border:#d7e2eb solid 1px; border-radius:3px; width:419px; font-size:14px; color:#585858; margin:16px auto 0px auto; position:relative;}
    .arrowquote{ width:52px; height:25px; background:url(http://static.8264.com/static/images/forum/yunban/hyinfo.jpg) bottom left no-repeat; position:absolute; left:4px; top:-25px;}
    .blockquotebox{ background:url(http://static.8264.com/static/images/forum/yunban/yhbeforebg.jpg) 20px 10px no-repeat; padding:25px 55px 23px 55px; margin:0; text-align:center;}
    .blockquoteboxafter{ width:20px; height:16px; position:absolute; bottom:10px; right:20px; background:url(http://static.8264.com/static/images/forum/yunban/yhafterbg.jpg) left top no-repeat;}
    .resultewmbox{ width:266px; margin:25px auto 0px auto; background:url(http://static.8264.com/static/images/forum/yunban/arrow.jpg) 1px 134px no-repeat; text-align:center;}
    .resultewmbox img{ width:180px; height:180px; border:#e3e3e3 solid 1px;}
    .resultewmbox span{ display:block; font-size:14px; color:#666; text-align:center; height:50px; background:url(http://static.8264.com/static/images/forum/yunban/appwa.jpg) center bottom no-repeat;}
    .resultewmbox span.waother{ background:url(http://static.8264.com/static/images/forum/yunban/appwa1.jpg) center bottom no-repeat;}
    .hyhbox{ border:#c9e0f6 solid 1px; border-radius:3px; color:#8bb8e3; padding:2px 14px 2px 16px; text-align:center; position:absolute; right:37px; top:156px; cursor:pointer; display:inline-block; _zoom:1; _display:inline; font-size:12px;text-decoration: none;}
    .hyhbox:hover{ text-decoration: none;}

    /*新版本开始*/
    .ybsxbox{ width:980px;  margin:50px auto; position:relative; background:#fff;}
    .ybsxbox_left{ width:248px; float:left;}
    .ybsxbox_right{ width:732px; float:right; background:url(http://static.8264.com/static/images/forum/yunban/yuebanboxbg.jpg) center 46px no-repeat; height:586px;}
    .yubantitle{ color:#5c6369; font-size:32px; text-align:center;}
    .yubantitle b{ display: block; padding-top:35px;}
    .yubantitle span{ font-size:14px; display:block;}
    .yubanlinkbox{ position:relative; height:482px;}
    .yubanlinkbox a{ width:67px; height:67px; position:absolute; line-height:67px; text-align:center; font-size:15px; font-weight:bold;text-decoration: none;}

    .nvsex{ background: url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -88px no-repeat; color:#fff; left:65px; top:154px;}
    .nvsexicon{ width:11px; height:16px; background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -3px no-repeat; display:inline-block; vertical-align:-3px; padding:0px 4px 0px 0px;}
    .nvsex:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px 0px no-repeat; text-decoration:none;}

    .mansex{ background: url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -88px no-repeat; color:#fff; left:77px; top:292px;}
    .mansexicon{ width:15px; height:16px; background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -83px -50px no-repeat; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .mansex:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px 0px no-repeat; text-decoration:none;}

    .xining{ top:58px; left:144px; color:#61cbd1;}
    .xiningicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .xining:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .xining:hover .xiningicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .dali{ top:222px; left:154px; color:#61cbd1;}
    .daliicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .dali:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .dali:hover .daliicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .yunnan{ top:346px; left:211px; color:#61cbd1;}
    .yunnanicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .yunnan:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .yunnan:hover .yunnanicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .beijing{ top:325px; left:305px; color:#61cbd1;}
    .beijingicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .beijing:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .beijing:hover .beijingicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .daocheng{ top:339px; left:500px; color:#61cbd1;}
    .daochengicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .daocheng:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .daocheng:hover .daochengicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .shanghai{ top:196px; left:539px; color:#61cbd1;}
    .shanghaiicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .shanghai:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .shanghai:hover .shanghaiicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .kunming{ top:87px; left:488px; color:#61cbd1;}
    .kunmingicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .kunming:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .kunming:hover .kunmingicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .xian{ top:21px; left:439px; color:#61cbd1;}
    .xianicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .xian:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .xian:hover .xianicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .xizang{ top:21px; left:261px; color:#61cbd1;}
    .xizangicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .xizang:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}
    .xizang:hover .xizangicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .yubanlinkbox a.xianggelila{ top:250px; left:478px; color:#61cbd1; width:100px; height:100px; line-height:100px;}
    .xianggelilaicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -150px no-repeat; width:10px; height:15px; display:inline-block; vertical-align:-2px; padding:0px 4px 0px 0px;}
    .yubanlinkbox a.xianggelila:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -580px no-repeat;; text-decoration:none; color:#fff;}
    .xianggelila:hover .xianggelilaicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -101px no-repeat;}

    .dunhuang{ top:110px; left:212px; color:#fff;  background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -294px no-repeat;}
    .dunhuang:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}

    .lijiang{ top:233px; left:235px; color:#fff;  background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -294px no-repeat;}
    .lijiang:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}

    .lasa{ top:273px; left:378px; color:#fff;  background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -294px no-repeat;}
    .lasa:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}

    .qinghai{ top:173px; left:455px; color:#fff;  background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -294px no-repeat;}
    .qinghai:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}

    .chengdu{ top:87px; left:385px; color:#fff;  background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -294px no-repeat;}
    .chengdu:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -189px no-repeat; text-decoration:none; color:#fff;}

    .monthicon{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -86px -204px no-repeat; width:13px; height:13px; display:inline-block; vertical-align:-1px; padding:0px 4px 0px 0px;}
    .august{ top:21px; left:568px; color:#fff; background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -0px -501px no-repeat;}
    .august:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -398px no-repeat; text-decoration:none; color:#fff;}

    .september{ top:157px; left:629px; color:#fff; background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -0px -501px no-repeat;}
    .september:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -398px no-repeat; text-decoration:none; color:#fff;}

    .october{ top:304px; left:605px; color:#fff; background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) -0px -501px no-repeat;}
    .october:hover{ background:url(http://static.8264.com/static/images/forum/yunban/yuebanbg.png) 0px -398px no-repeat; text-decoration:none; color:#fff;}

    .yubanlinkbox a.lookother{ left:319px; top:409px; color:#6385a0; font-size:14px; background:#fff; border:#6385a0 solid 1px; border-radius:20px; width:110px; height:33px; line-height:33px;}
    .yubanlinkbox a.lookother:hover{ position:absolute; color:#6385a0; font-size:14px; background:#6385a0; color:#fff; text-decoration:none;}
    /*新版本结束*/




</style>
<!--封屏开始-->
<div class="blackbg"></div>
<!--封屏结束-->
<!--新版本开始-->
<div class="ybpopbox" style="display:none;" id="f_pander">
    <div class="ybsxbox clear_b">
        <div class="ybsxbox_left"><img src="http://static.8264.com/static/images/forum/yunban/ybbgnew.jpg" height="586"/></div>
        <div class="ybsxbox_right">
            <div class="yubantitle">
                <b>点一点，找找谁会是你的伙伴</b>
                <span>想约时间？想约地点？想约异性朋友？只需轻轻一点</span>
            </div>
            <div class="yubanlinkbox">
                <a href="javascript:void(0);" class="nvsex" onclick="show_dialog(0);" ><span class="nvsexicon"></span>女性</a>
                <a href="javascript:void(0);" class="mansex" onclick="show_dialog(1);" ><span class="mansexicon"></span>男性</a>
                <a href="javascript:void(0);" class="xining" onclick="show_dialog_d('西宁');" ><span class="xiningicon"></span>西宁</a>
                <a href="javascript:void(0);" class="dali" onclick="show_dialog_d('大理');" ><span class="daliicon"></span>大理</a>
                <a href="javascript:void(0);" class="yunnan" onclick="show_dialog_d('云南');" ><span class="yunnanicon"></span>云南</a>
                <a href="javascript:void(0);" class="beijing" onclick="show_dialog_d('北京');" ><span class="beijingicon"></span>北京</a>
                <a href="javascript:void(0);" class="daocheng" onclick="show_dialog_d('稻城');" ><span class="daochengicon"></span>稻城</a>
                <a href="javascript:void(0);" class="shanghai" onclick="show_dialog_d('上海');" ><span class="shanghaiicon"></span>上海</a>
                <a href="javascript:void(0);" class="kunming" onclick="show_dialog_d('昆明');" ><span class="kunmingicon"></span>昆明</a>
                <a href="javascript:void(0);" class="xian" onclick="show_dialog_d('西安');" ><span class="xianicon"></span>西安</a>
                <a href="javascript:void(0);" class="xizang" onclick="show_dialog_d('西藏');" ><span class="xizangicon"></span>西藏</a>
                <a href="javascript:void(0);" class="xianggelila" onclick="show_dialog_d('香格里拉');" ><span class="xianggelilaicon"></span>香格里拉</a>
                <a href="javascript:void(0);" class="dunhuang" onclick="show_dialog_d('敦煌');" >敦煌</a>
                <a href="javascript:void(0);" class="lijiang" onclick="show_dialog_d('丽江');" >丽江</a>
                <a href="javascript:void(0);" class="lasa" onclick="show_dialog_d('拉萨');" >拉萨</a>
                <a href="javascript:void(0);" class="qinghai" onclick="show_dialog_d('青海');" >青海</a>
                <a href="javascript:void(0);" class="chengdu" onclick="show_dialog_d('成都');" >成都</a>
                <a href="javascript:void(0);" class="august" onclick="show_dialog_m('201508');" ><span class="monthicon"></span>8月</a>
                <a href="javascript:void(0);" class="september" onclick="show_dialog_m('201509');" ><span class="monthicon"></span>9月</a>
                <a href="javascript:void(0);" class="october" onclick="show_dialog_m('201510');" ><span class="monthicon"></span>10月</a>
                <a href="javascript:void(0);" class="lookother" onclick="show_dialog_all();" >随便看看</a>
            </div>
        </div>
        <div class="ybclose"></div>
    </div>
</div>
<!--新版本结束-->
<!--结果开始-->
<div class="ybpopbox" style="display:none;" id="r_pander">
    <div class="w606resultcon">
        <div class="resultbranner"><img src="http://static.8264.com/static/images/forum/yunban/ybresult.jpg"/></div>
        <div id="result_diy">
            <div class="resulttx"><img src="" id="user_img"/></div>
            <div class="usernameinfo">

            </div>
            <div class="hyinfocon">
                <div class="arrowquote"></div>
                <blockquote class="blockquotebox"></blockquote>
                <div class="blockquoteboxafter"></div>
            </div>
        </div>
        <div class="resultewmbox">
            <img src="http://static.8264.com/static/images/forum/yunban/ewmzaiwai.jpg"/>
            <span></span>
        </div>
        <div class="ybclose"></div>
        <a class="hyhbox" id="">换一换</a>
    </div>
</div>
<!--结果结束-->
<!--点击按钮关闭开始-->
<script  type="text/javascript">
    function show_dialog(para){
        jQuery(".hyhbox").attr("myid",para);
        jQuery(".hyhbox").attr("id",'one_type');
        jQuery.post('interface.php',{sex:para,isajax:1},function(data){
            handle_data(data);
        });
        jQuery("#r_pander").show();
        jQuery("#f_pander").hide();
    }

    function show_dialog_d(para){
        jQuery(".hyhbox").attr("myid",para);
        jQuery(".hyhbox").attr("id",'two_type');
        jQuery.post('interface.php',{cityName:para,isajax:1},function(data){
            handle_data(data);
        });
        jQuery("#r_pander").show();
        jQuery("#f_pander").hide();
    }
    function show_dialog_m(para){
        jQuery(".hyhbox").attr("myid",para);
        jQuery(".hyhbox").attr("id",'three_type');
        jQuery.post('interface.php',{begin_Time:para,isajax:1},function(data){
            handle_data(data);
        });
        jQuery("#r_pander").show();
        jQuery("#f_pander").hide();
    }
    function show_dialog_all(){
        jQuery.post('interface.php',{isajax:1},function(data){
            handle_data(data);
        });
        jQuery("#r_pander").show();
        jQuery("#f_pander").hide();
    }
    function handle_data(data){
        if(data != 'error'){
            var res = eval("("+data+")");
            var author = res.author;
            var feed = res.feed;
            //console.log(author.picUrl);
            jQuery("#user_img").attr("src",author.picUrl);
            jQuery(".blockquotebox").html(feed.content);
            if(author.sex == 1){
                //显示为男author
                jQuery(".usernameinfo").html("<em>"+author.name+"</em><span class='manicon'>男</span>");
            }else{
                //显示为女
                jQuery(".usernameinfo").html("<em>"+author.name+"</em><span class='womanicon'>女</span>");
            }
            //jQuery(".resultewmbox span").removeClass("waother");
            jQuery(".hyhbox").show();

        }else{
            //jQuery(".resultewmbox span").addClass("waother");
            jQuery(".hyhbox").hide();
            jQuery("#user_img").attr("src","http://static.8264.com/static/images/forum/yunban/mrtx.jpg");
            jQuery(".blockquotebox").html("木有找到合适的小伙伴？没关系，去在外APP上呼唤一下吧！");
            jQuery(".usernameinfo").html("<em>淡蓝の冰</em><span class='womanicon'>女</span>");
        }
    }
    jQuery(function(){
        jQuery(".ybclose").click(function(){
            jQuery(".blackbg").hide();
            jQuery(".ybpopbox").hide();
			jQuery("body").removeAttr("style");
        });
        jQuery("#yueban_").click(function(){
            jQuery(".blackbg").show();
			jQuery("body").css({
				"padding-right":"16px",
				"overflow":"hidden"
			});
			jQuery("#f_pander").show();

        });
        jQuery(".hyhbox").on('click',function(){
            para = jQuery(".hyhbox").attr("myid");
            type_num = jQuery(".hyhbox").attr("id");
            switch (type_num){
                case  'one_type' :
                    jQuery.post('interface.php',{sex:para,isajax:1},function(data){
                        handle_data(data);
                    });break;
                case  'two_type' :
                    jQuery.post('interface.php',{cityName:para,isajax:1},function(data){
                        handle_data(data);
                    });break;
                case  'three_type' :
                    jQuery.post('interface.php',{begin_Time:para,isajax:1},function(data){
                        handle_data(data);
                    });break;
                default :
                    jQuery.post('interface.php',{isajax:1},function(data){
                        handle_data(data);
                    });
            }

        });
    });
</script>
<!--点击按钮关闭结束-->
<!--约伴弹层样式结束-->
<?php require_once BASEMUDIDI . 'mudidifooter.php'; ?>
