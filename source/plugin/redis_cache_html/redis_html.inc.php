<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
	require_once libfile('class/myredis');
	$myredis = & myredis::instance(6378);
	if($myredis->connected){
		$cacheredis = array();
		$cacheredis['pp']['name'] = "图库";
		$cacheredis['pp']['cache'] = $myredis->obj->hLen('pp_html');
		$cacheredis['pp']['type'] = "1";
		$cacheredis['pp']['db'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_html_pp')." WHERE type = ".$cacheredis['pp']['type']);
		$cacheredis['ditu']['name'] = "地图";
		$cacheredis['ditu']['cache'] = $myredis->obj->hLen('map_html');
		$cacheredis['ditu']['type'] = "0";
		$cacheredis['ditu']['db'] = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_html_pp')." WHERE type = ".$cacheredis['ditu']['type']);
		showtableheader();
		echo '<tr class="header"><th>模块</th><th>页面总数（数据库中）</th><th>缓存中页面数</th><th>操作</th></tr>';
		foreach($cacheredis as $value){
?>
		<tr class="<?=$value['type']?>"><td><?=$value['name']?></td><td><?=$value['db']?></td><td><?=$value['cache']?></td><td><a href="javascript:;" class='details'>查看</a> | <a href="javascript:;" class='clearcache'>清空缓存</a> | <a href="javascript:;" class='docache'>全部生成</a></td></tr>
<?php
		}
		showtablefooter();
	}else{
		echo "redis is not connected";
	}
?>
<style>
#tips{width: 600px;height: 400px;position:absolute;left:80px;top:50px;display: none;background: white;}
#showbody{border:1px solid #CCC;}
.topborder{border-top: 5px solid #CCC;}
.leftborder{border-left:5px solid #CCC;}
.rightborder{border-right:5px solid #CCC;}
.bottomborder{border-bottom:5px solid #CCC;}
.green{color:green;}
.red{color:red;}
</style>
<div id="tips">
	<table>
		<tr><td width="2%" class="leftborder topborder"></td><td class="topborder"><p style="text-align: center;font-size: 15px;color:#6FCCDC;font-weight: bold;">详细信息</span><span style="font-size:12px;color:black;float: right;cursor: pointer;" id="closetips">关闭</span></p></td><td width="2%" class="topborder rightborder"></td></tr>
		<tr><td class="leftborder"></td><td><div id="showbody"></div></td><td class="rightborder"></td></tr>
		<tr><td class="leftborder bottomborder"></td><td class="bottomborder"></td><td class="bottomborder rightborder"></td></tr>
	</table>
</div>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
;(function($) {
	$('.details,.clearcache,.docache').click(function(){
		var $obj = $(this);
		var $mod = $obj.attr('class');
		var $type = $obj.parent().parent().attr('class');
		$.post('plugin.php?id=redis_cache_html:operation',{
			inajax:1,
			mod:$mod,
			type:$type,
			nowpage:1
		},function(data,textStatus){
			if(data !='error'){
				if($mod == 'details'){
					$('#tips').css('display','block')
					$('#showbody').html(data);
				}else{
					$.post('plugin.php?id=redis_cache_html:operation',{
					inajax:1,
					mod:'getlen',
					type:$type
					},function(data,textStatus){
						$("."+$type+" td:eq(2)").html(data+"<b class='green' style='margin-left:5px;'>完成</b>");
					});
				}
			}
		});
	});
	$('#closetips').click(function(){
		$('#tips').css('display','none');
	});
	$('.clear_one,.create_one').live('click',function(){
		var $obj = $(this);
		var $method = $obj.attr('class');
		var $key = $obj.parent().parent().attr('id');
		var $mtype = $obj.parent().attr('class');
		$.post('plugin.php?id=redis_cache_html:operation',{
			inajax:1,
			mod:$method,
			type:$key,
			nowpage:$mtype
		},function(data,textStatus){
			if(data != 'error'){
				$obj.parent().html(data);
				$.post('plugin.php?id=redis_cache_html:operation',{
					inajax:1,
					mod:'getlen',
					type:$mtype
				},function(data,textStatus){
					$("."+$mtype+" td:eq(2)").html(data);
				});
			}
		});
	});
	$(".changepage").live('click',function(){
		var $obj = $(this);
		var $method = 'details';
		var $type = $obj.parent().attr('title');
		var $nextpage = $obj.attr('title');
		$.post('plugin.php?id=redis_cache_html:operation',{
			inajax:1,
			mod:$method,
			type:$type,
			nowpage:$nextpage
		},function(data,textStatus){
			if(data !='error'){
				$('#showbody').html(data);
			}
		});
	});
})(jQuery);
</script>
