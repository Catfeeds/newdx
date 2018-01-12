<?php require_once BASEMUDIDI . 'mudidiheader.php'; ?>
<style>
.scapelist{list-style: none;}
.maplistli{float:left;margin: 5px;width:145px;height:150px;list-style: none;}
.maplistli span{margin-top:5px;}
</style>
<div class="warpten980 clear_b ptb30">
	<div class="w680 float_left">
		<div class="indextitlebig clear_b">
			<span class="zbicon"><?php echo $mudidiname; ?>��·�г��Ƽ�</span>
			<a href="<?php echo $urls['tag']; ?>" class="float_left">����������·>></a>
			<a href="<?php echo $urls['tag']; ?>" class="orangebox"><?php echo $mudidiname; ?>���������������ž��� >></a>
		</div>
		<div class="clear_b">
			<?php if(!empty($lvyoulist)): ?>
			<?php if(!empty($leftlist)): ?>
			<div class="w330 boxborder float_left">
				<ul class="imgwenlist">
				<?php foreach($leftlist as $v): ?>
					<li>
						<a href="<?php echo $v['url']; ?>"><img src="<?php echo $v['default_image']; ?>"/></a>
						<p>
							<a href="<?php echo $v['url']; ?>" title="<?php echo $v['title']; ?>"><?php echo cutstr($v['title'], 45); ?></a>
							<span><?php echo $v['sales']; ?>���ѳ���</span>
						</p>
						<?php if($v['hot']): ?><i></i><?php endif; ?>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php if(!empty($rightlist)): ?>
			<div class="w330 boxborder float_right">
				<ul class="imgwenlist">
				<?php foreach($rightlist as $v): ?>
					<li>
						<a href="<?php echo $v['url']; ?>"><img src="<?php echo $v['default_image']; ?>"/></a>
						<p>
							<a href="<?php echo $v['url']; ?>" title="<?php echo $v['title']; ?>"><?php echo cutstr($v['title'], 45); ?></a>
							<span><?php echo $v['sales']; ?>���ѳ���</span>
						</p>
						<?php if($v['hot']): ?><i></i><?php endif; ?>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php else: ?>
			<div class="w330 boxborder float_left">
				<ul class="imgwenlist">
					<li>
						������·
					</li>
				</ul>
			</div>
			<?php endif;?>
		</div>
		<div class="indextitlebig clear_b">
			<span class="glicon"><?php echo $mudidiname; ?>�μǹ���</span>
		</div>
		<div class="glcitylist boxborder">
			<ul>
			<?php if($travellist): ?>
			<?php $intsi = 0; ?>
			<?php foreach($travellist as $values): ?>
			<?php $intsi++; ?>
			<?php switch($intsi){ 
					case 2:
						?>
				<li>
					<a href="<?php echo $leftlist[0]['url']; ?>"><img src="http://static.8264.com/static/image/mudidi/hoticon.jpg"/></a>
					<p>
						<a href="<?php echo $leftlist[0]['url'] ?>" class="orange"><?php echo $leftlist[0]['title'] ?></a>
						<span>����������<?php echo $leftlist[0]['sales'] ?>��</span>
					</p>
				</li>
			<?php 		break; 
					case 8:
						?>
				<li>
					<a href="<?php echo $rightlist[0]['url'] ?>"><img src="http://static.8264.com/static/image/mudidi/hoticon.jpg"/></a>
					<p>
						<a href="<?php echo $rightlist[0]['url'] ?>" class="orange"><?php echo $rightlist[0]['title'] ?></a>
						<span>����������<?php echo $rightlist[0]['sales'] ?>��</span>
					</p>
				</li>
			<?php 		break;
					} ?>
				<li>
					<a target="_blank" href="<?php echo "{$_G['config']['web']['forum']}thread-{$values['tid']}-1-1.html"; ?>"><img src="<?php echo $values['avatar']; ?>"/></a>
					<p>
						<a target="_blank" href="<?php echo "{$_G['config']['web']['forum']}thread-{$values['tid']}-1-1.html"; ?>"><?php echo $values['subject']; ?></a>
						<span>���ߣ�<?php echo $values['author']; ?></span>
					</p>
					<div><p><?php echo $values['message']; ?></p></div>
				</li>
			<?php endforeach; ?>
			<?php else: ?>
				<li>���޹���</li>
			<?php endif; ?>
			</ul>
		</div>
		<?php if($showtext): ?>
		<div class="indextitlebig clear_b">
			<span class="whicon"><?php echo $showtext; ?></span>
			<a href="<?php echo $urls['tag']; ?>" class="orangebox"><?php echo $mudidiname; ?>���������ξ���>></a>
		</div>
		<div class="boxborder city_introduction">
			<?php if($searchtype == 'weather'): ?>
			<?php if($weatherarr): ?>
			<?php 
				$jttq = $mttq = 0;
				$today = ltrim(date('d', time()) . '��', 0); 
			?>
			<?php foreach($weatherarr as $k => $v): ?>
			<?php 
			if($jttq == 0 && $today == $v['day']):
				$jttq++;
			?>
			<span>��������<em><?php echo $v['day']; ?></em><em><?php echo $v['weekday']; ?></em></span>
			<?php 
			elseif($today != $v['day'] && $mttq == 0):
				$mttq++; 
			?>
			<span>��������<em><?php echo $v['day']; ?></em><em><?php echo $v['weekday']; ?></em></span>
			<?php endif; ?>
			<p>
				<em><?php echo $v['ampm']; ?>��</em><span><?php echo $v['weather']; ?></span><span><?php echo $v['temp']; ?></span><span><?php echo $v['wind']; ?></span><span><?php echo $v['sun']; ?></span>
			</p>
			<?php endforeach; ?>
			<?php else: ?>
			<p>����������Ϣ</p>
			<?php endif; ?>
			<?php elseif(!empty($sclist)): ?>
			<?php foreach($sclist as $vas): ?>
			<li class="scapelist">
				<p>
					<a target="_blank" href="<?php echo "{$_G['config']['web']['forum']}whither-{$vas['tid']}.html"; ?>"><?php echo $vas['subject']; ?></a>
				</p>
				<div><p><?php echo $vas['message']; ?></p></div>
			</li>
			<?php endforeach; ?>
			<?php elseif(!empty($mplist)): ?>
			<?php foreach($mplist as $vas): ?>
			<li class="maplistli">
				<a target="_blank" href="<?php echo $_G['config']['web']['forum']; ?>whither-mapview-<?php echo $vas['id']; ?>.html"><img src="<?php echo $vas['pic']; ?>" /></a>
				<span><a target="_blank" href="<?php echo $_G['config']['web']['forum']; ?>whither-mapview-<?php echo $vas['id']; ?>.html"><?php echo $vas['subject']; ?></a></span>
			</li>
			<?php endforeach; ?>
			<span style="clear: both;"></span>
			<?php elseif($mapinfo): ?>
			<a href="<?php echo $mapinfo['pic'] ?>" target="_blank" title="����鿴<?php echo $showtext; ?>��ͼ"><img src="<?php echo $mapinfo['thumbpic']; ?>" /></a>
			<?php else: ?>
			<?php if($editurl): ?>&nbsp;&nbsp;<a href="" id="editspan" style="float:right;" target="_blank">�༭</a><?php endif; ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $wenhua; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<div class="w280 float_right">
		<div class="citynavlist boxborder">
			<ul>
				<li><a href="<?php echo $urlstop['tag']; ?>" class="glcion1"><?php echo $topmudidiname; ?>������·��ȫ</a></li>
				<li><a href="<?php echo $urlstop['source']; ?>" class="glcion2"><?php echo $topmudidiname; ?>�˶�ȥ����</a></li>
				<li><a href="<?php echo $urlstop['tag']; ?>" class="glcion3"><?php echo $topmudidiname; ?>���ξ���</a></li>
				<li><a href="<?php echo $urlstop['source']; ?>" class="glcion4"><?php echo $topmudidiname; ?>�Ƽ��г�</a></li>
			</ul>
		</div>
		<!--�ֲ���ʼ-->
		<div class="lunboconad boxborder mt30">
			<ul class="lunboimgad">
				<li><a href="http://www.zaiwai.com/xianlu-489?utm_source=s14363562&utm_campaign=p15035203" target="_blank"><img src="http://static.8264.com/static/image/mudidi/ad1.jpg"/></a></li>
				<li><a href="http://www.zaiwai.com/xianlu-380?utm_source=s14363562&utm_campaign=p15035203" target="_blank"><img src="http://static.8264.com/static/image/mudidi/ad2.jpg"/></a></li>
				<li><a href="http://www.zaiwai.com/xianlu-561?utm_source=s14363562&utm_campaign=p15035203" target="_blank"><img src="http://static.8264.com/static/image/mudidi/ad3.jpg"/></a></li>
				<li><a href="http://www.zaiwai.com/xianlu-378?utm_source=s14363562&utm_campaign=p15035203" target="_blank"><img src="http://static.8264.com/static/image/mudidi/ad4.jpg"/></a></li>
			</ul>	
			<div class="adtitlename">
				<ul>
					<li><a href="http://www.zaiwai.com/xianlu-489?utm_source=s14363562&utm_campaign=p15035203">Ԫ������ ��ƽ�Ͳ˻��� ����������Ӱ��8���г̣�</a></li>
					<li><a href="http://www.zaiwai.com/xianlu-380?utm_source=s14363562&utm_campaign=p15035203">��������������Ӱ �Ĺ���ɽ ���ݹ� �¶��� ţ��ɽ��Ȫ֮�ã�8���г̣�</a></li>
					<li><a href="http://www.zaiwai.com/xianlu-561?utm_source=s14363562&utm_campaign=p15035203">��ֵ ÷��ѩɽ��4���г̣�</a></li>
					<li><a href="http://www.zaiwai.com/xianlu-378?utm_source=s14363562&utm_campaign=p15035203">��ѩ�紩Խ ����ɽ ��ﻬѩ�����ȼ٣�8���г̣�</a></li>
				</ul>
			</div>
		</div>
		<!--�ֲ�����-->
	</div>
</div>
<script>
// �ֲ���ʼ
$(function(){
	 var shuliang = $(".lunboimgad li").size();
	 var lunbotime;
	 var index = 0;
	 	$(".lunboconad").append("<ul class='shuziad'></ul>"); 
		for ( i=0 ; i< shuliang ;i){
		i++	
		$(".shuziad").append("<span></span>"); 	
		};
		$(".shuziad span").eq(0).addClass("tsshuzi");
	$(".shuziad span").mouseenter(function(){	
		var index = $(this).index();
		$(this).addClass("tsshuzi").siblings().removeClass("tsshuzi");
		$(".lunboimgad li").eq(index).fadeIn().siblings().hide(0);
		$(".adtitlename li").eq(index).fadeIn().siblings().hide(0);
	});	
	$(".lunboconad").hover(
		function(){
			clearInterval(lunbotime);		
		},function(){
			lunbotime = setInterval(function(){	
				$(".shuziad span").eq(index).addClass("tsshuzi").siblings().removeClass("tsshuzi");
				$(".lunboimgad li").eq(index).fadeIn().siblings().hide(0);	
				$(".adtitlename li").eq(index).fadeIn().siblings().hide(0);
				index++;
				if(index == shuliang ){
					index=0;
				};		
			},8000);					
		}).trigger("mouseleave");
});
// �ֲ�����
</script>
<?php require_once BASEMUDIDI . 'mudidifooter.php'; ?>