    <div class="sidebar" style="position:relative;z-index:2;">
			<div class="mudidi_info_nav">
				<?php $navArray = $forumoption_mudidi->getInfoNav($mudidi_data['sn']); ?>
				<?php if ($navArray) { ?>
					<h2 class="mudidi_info_title"><a href="/thread-<?php echo $mudidi_data['tid'];?>-1-1.html">返回<?php echo $mudidi_data['subject'];?></a></h2>
					<dl class="mudidi_info_list" id="mudidi_info_list">
						<?php
							foreach ($navArray as $i => $item) {
						?>
						<dt><a href="/whither-info-<?php echo $item['id'];?>.html"<?php echo $item['id']==$infoid?' class="on"':'';?>><?php echo $item['name'];?></a></dt>
						<?php
							}
						?>
					</dl>
				<?php } ?>
				
				
				<h2 class="mudidi_info_title<?php if ($navArray) {echo ' mudidi_info_margin_top';} ?>"><?php echo $mudidi_data['subject']; ?>旅游导航</h2>
				<dl class="mudidi_info_list mudidi_info_list2">
					<?php
						switch (substr_count($mudidi_data['sn'], '-')) {
							case 0: case 1: case 2: case 3:
								$snType = '3';
								break;
							case 4:
								$snType = '2';
								break;
							case 5:
								$snType = '1';
								break;
							default:
								break;
						}
						if ($snType == 2) {
							$scapeareaTid = $tid;
						} else {
							$scapeareaSn = $forumoption_mudidi->getParentSn($mudidi_data['sn']);
							$scapeareaTid = $forumoption_mudidi->getTidBySn($scapeareaSn);
						}
					?>
					<?php if ($snType == 3) { ?>
						<dt><a href="/whither-scapearealist-<?php echo $tid; ?>-1.html" title="<?php echo $mudidi_data['subject']; ?>旅游景区">景区</a></dt>
					<?php } else { ?>
						<dt><a href="/whither-scapelist-<?php echo $scapeareaTid; ?>-1.html" title="<?php echo $mudidi_data['subject']; ?>旅游景点">景点</a></dt>
					<?php } ?>
					
					<?php if ($snType == 3) { ?>
						<dt class="even"><a href="/whither-guidelist-<?php echo $tid; ?>-1.html" title="<?php echo $mudidi_data['subject']; ?>旅游攻略">攻略</a></dt>
					<?php } else { ?>
						<dt class="even"><a href="/whither-guidelist-<?php echo $scapeareaTid; ?>-1.html" title="<?php echo $mudidi_data['subject']; ?>旅游攻略">攻略</a></dt>
					<?php } ?>
					
					<?php if ($snType == 3) { ?>
						<dt><a href="/whither-photolist-<?php echo $tid; ?>-1.html" title="<?php echo $mudidi_data['subject']; ?>照片图片">相册</a></dt>
					<?php } else { ?>
						<dt><a href="/whither-photolist-<?php echo $scapeareaTid; ?>-1.html" title="<?php echo $mudidi_data['subject']; ?>照片图片">相册</a></dt>
					<?php } ?>
					
					
					<dt class="even"><a href="<?php $_G['config']['web']['home'] ?>home-space-do-activity-view-all-date-week-class--area-0.html" title="<?php echo $mudidi_data['subject']; ?>户外活动">活动</a></dt>
					<dt>
						<?php if ($mudidi_data['hotelUrl']) { ?>
							<a href="<?php echo $mudidi_data['hotelUrl']; ?>" target="_blank" title="<?php echo $mudidi_data['subject']; ?>酒店住宿">旅舍</a>
						<?php } else { ?>
							<a href="javascript:void(0);" title="此景区暂无旅舍推荐">旅舍</a>
						<?php } ?>
					</dt>
					<dt class="even"><a href="http://bx.<?php echo $_G['setting']['domain']['root']['forum']; ?>/" target="_blank" title="<?php echo $mudidi_data['subject']; ?>户外保险">保险</a></dt>
					<?php if ($snType == 3) { ?>
						<dt><a href="/whither-weather-<?php echo $tid; ?>.html" title="<?php echo $mudidi_data['subject']; ?>天气预报">天气</a></dt>
					<?php } else { ?>
						<dt><a href="/whither-weather-<?php echo $scapeareaTid; ?>.html" title="<?php echo $mudidi_data['subject']; ?>天气预报">天气</a></dt>
					<?php } ?>
					
					<?php if ($snType == 3) { ?>
						<dt class="even"><a href="/whither-map-<?php echo $tid; ?>.html" title="<?php echo $mudidi_data['subject']; ?>地图">地图</a></dt>
					<?php } else { ?>
						<dt class="even"><a href="/whither-map-<?php echo $scapeareaTid; ?>.html" title="<?php echo $mudidi_data['subject']; ?>地图">地图</a></dt>
					<?php } ?>
					
				</dl>
			</div>
			
			<?php if ($_GET['id']!='whither:info') { ?>
            <script type="text/javascript">
				jQuery('#mudidi_info_list dt a').click(function(){
					<?php if ($_G['uid'] && $_G['group']['radminid'] > 0) { ?>
					var isAdmin = true;
					<?php } else { ?>
					var isAdmin = false;
					<?php } ?>
					
					var tid = <?php echo $_G['tid']?$_G['tid']:$_GET['tid']; ?>;
					var ddMinHeight = jQuery('#mudidi_info_list dt').size() * 33 + 9;
	
					jQuery(this).blur();
					var dt = jQuery(this).parent('dt');
					if (!dt.is('.ajaxed')) {
						var infoid = /info-(\d+).html$/.exec(jQuery(this).attr('href'))[1];
						jQuery.ajax({
							type: "GET",
							dataType: 'json',
							async: false,
							url: "/plugin.php?id=whither:ajaxgetinfo",
							data: "infoid="+infoid,
							success: function(data) {
								if (!data['message']) {
									data['message'] = '<p style="padding:20px 0;text-align:center;">'+data['subject']+'暂无内容</p>';
								}
								dt.after(jQuery('<dd><div class="mudidi_info_dropdown_info"><h1><a href="javascript:void();" class="close flbc">关闭</a><span class="htitle">'+data['subject']+'&nbsp;&nbsp;'+(isAdmin?'<a href="<?php echo $_G['config']['web']['forum']; ?>plugin.php?id=whither:pubinfo&tid='+tid+'&infoid='+infoid+'" class="opearte">编辑</a><span class="pipe">|</span>':'')+'<a href="/whither-info-'+infoid+'.html" class="opearte">查看详细</a></span></h1><div class="content">'+data['message']+'</div></div></dd>'));
								dt.addClass('ajaxed');
							}
						});
					}
					if (!dt.next().is('dd')) {
						jQuery('.mudidi_info_nav a').removeClass('with_dropdown');
						jQuery('.mudidi_info_nav dd').hide();
						return false;
					}
					jQuery('.mudidi_info_nav a').removeClass('with_dropdown');
					jQuery('.mudidi_info_nav dd').hide();
					jQuery(this).addClass('with_dropdown');
					dt.next('dd').show();
					if (dt.next('dd').children('div').height() < ddMinHeight) {
						dt.next('dd').children('div').height(ddMinHeight)
					}
					
					return false;
				});
				
				jQuery('.mudidi_info_nav dd').live('click', function(){
					jQuery(this).prev('dt').children('a').addClass('with_dropdown');
					jQuery(this).show();
				});
				
				jQuery('.mudidi_info_nav .close').live('click', function(){
					var dd = jQuery(this).parent('h1').parent('div').parent('dd');
					dd.prev('dt').children('a').removeClass('with_dropdown');
					dd.hide();
					return false;
				});
				
				jQuery('body').click(function(){
					jQuery('.mudidi_info_nav a').removeClass('with_dropdown');
					jQuery('.mudidi_info_nav dd').hide();
				});
			</script>
			<?php } ?>
		
			<?php $activityData = $forumoption_mudidi->getRalateActivityByKeyword($mudidi_data['subject'], 5);?>
			<?php if ($activityData) { ?>
			<div class="sidebar_box">
				<div class="sidebar_box_title">
					<a href="<?php echo $_G['config']['web']['forum']; ?>forum-5-1.html" class="more">更多</a>
					<h5><?php echo $mudidi_data['subject'];?>活动</h5>
				</div>
				<div class="sidebar_box_content">
					<ul class="list2">
						<?php foreach ($activityData as $activityeid => $activity) { ?>
						<li>
							<div class="image">
								<a href="/thread-<?php echo $activity['tid'];?>-1-1.html">
									<?php echo avatar($activity['authorid'], 'small');?>
								</a>
							</div>
							<div class="text">
								<h6><a href="/thread-<?php echo $activity['tid'];?>-1-1.html"><?php echo $activity['subject'];?></a></h6>
								<p class="dateline">
									<a href="/thread-<?php echo $activity['tid'];?>-1-1.html" class="hlink">报名</a>
									<a href="<?php echo $_G['config']['web']['home']; ?>home-space-uid-<?php echo $activity['authorid'];?>-do-profile.html" class="color_gray"><?php echo $activity['author'];?></a>
								</p>
							</div>
							
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php } ?>
	</div>
