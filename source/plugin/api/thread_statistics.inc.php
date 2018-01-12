<?php 
	//http://bbs.8264.com/plugin.php?id=api:thread_statistics
	if(!defined('IN_DISCUZ')){
		exit('Access Denied');
	}
	
	$fidarrdata = memory('get','fidarrdata');
	if(!$fidarrdata){
		$query = DB::query("SELECT fid,name,todayposts,threads FROM ".DB::table('forum_forum')." WHERE TYPE='forum' AND STATUS != 0 ORDER BY name");
		$fidarr = array();
		while($row = DB::fetch($query)){
			$fidarr[$row['fid']]['name'] = $row['name'];
			$fidarr[$row['fid']]['todayposts'] = $row['todayposts'];
			$fidarr[$row['fid']]['threads'] = $row['threads'];
		}
		$fidarrdata = $fidarr;
		memory('set','fidarrdata',$fidarrdata,600);
	}

	$i=1;
	echo '<table style="line-height:30px;border-bottom:1px solid;clear: both;width:800px;" border="1">';
	echo '<caption>帖子统计</caption>';
	echo '<tr><td width=\'10%\'>序号</td><td width=\'40%\'>板块名字</td><td width=\'30%\'>发帖统计</td><td width=\'20%\'>板块详情</td></tr>';
	foreach($fidarrdata as $key => $value){
		echo " <tr>
				<td>$i</td>
				<td>{$value['name']}</td>
				<td>主题:{$value['threads']},今日:{$value['todayposts']}</td>
				<td><div onclick=\"askForMoreInformation(this);\" fid=\"{$key}\" ><a href='javascript:void(0);'>请点击</a></div></td></tr>";
		echo "<tr bgcolor=\"#ccc\" ><td colspan='4'><div id=\"addmessage{$key}\" onclick=\"doHidden(this)\"></div></td></tr>";
		++$i;
	}
	echo '</table>';
?>
<script type=text/javascript src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>!window.jQuery && document.write('<SCRIPT src="./static/js/jquery-1.6.1.min.js"><\\/SCRIPT>');</script>
<script type="text/javascript">
	function doHidden(obj){
		obj.innerHTML = '';
	}
	
	function askForMoreInformation(obj){
		var fid = $(obj).attr('fid');
		obj.innerHTML = '数据处理中,请稍等！';
		$(obj).attr("onclick","return false;");
		$.get("/plugin.php?id=api:getmorethreadinformation", {fid:fid},
			function(data){
				if(data.length == 0){
					return;
				}
				var dataobj=eval('('+data+')');
				var objlength = dataobj.length;	
				var childelement = $("#addmessage"+fid).text();
				if(childelement){
					$("#addmessage"+fid).empty();
				}
				for(var i=0;i<objlength;i++){
					var childthreadname=dataobj[i]['name'];
					var childthreadtypecount=dataobj[i]['typecount'];
					var childthreadtodaycount=dataobj[i]['todaycount'];
					$("#addmessage"+fid).append("<li>子板名称:"+childthreadname+",主题数:"+childthreadtypecount+",今日:"+childthreadtodaycount+",</li>");
				}
			obj.innerHTML = "<a href='javascript:void(0);'>更新数据</a>";
			$(obj).attr("onclick","askForMoreInformation(this);");
		});
	}
</script>