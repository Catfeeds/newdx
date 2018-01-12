<?php
	if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
		exit('Access Denied');
	}
	$count_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record'));
	$select_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='SELECT'");
	$replace_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='REPLACE'");
	$insert_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='INSERT'");
	$delete_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='DELETE'");
	$update_history = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." where type='UPDATE'");

	if($_POST['search']){
        unset($_POST['search']);
        $_G['gp_page'] = 1;
        foreach ($_POST as $postid => $post) {
            dsetcookie($postid, $post, 999999);
        }
    }

	$search=array();
	foreach (explode(' ', 'time1 time2 type pagesize tablename') as $item) {
		$search[$item] = getcookie($item);
	}

	$where='';
	if($search['time1']!=NULL){
		$time1=changetime($search['time1']);
		if($search['time2']!=NULL){
			$time2=changetime($search['time2']);
			$where.=" AND time>{$time1} and time<{$time2}";
		}else{
			$where.=" AND time>{$time1}";
		}
	}else{
		if($search['time2']!=NULL){
			$time2=changetime($search['time2']);
			$where.=" AND time<{$time2}";
		}
	}

	if($search['type']!=NULL){
		$where.=" AND type='{$search['type']}'";
	}

	if($search['tablename']!=NULL){
		$where.=" AND tablename='{$search['tablename']}'";
	}

	if ($search['pagesize'] == NULL) {
        $search['pagesize'] = 50;
    }

	$count = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." WHERE 1 {$where}");
	$ppp = $search['pagesize'];
	$page = max(1, intval($_G['gp_page']));
	$start=($page-1)*$ppp;
	$limit=" limit {$start},{$ppp}";

	$result = DB::query("SELECT time,type,tablename,othertable,content FROM ".DB::table(plugin_record)." WHERE 1 {$where} ORDER BY time desc {$limit}");

?>
<div>
	<br/>
	<table>
		<form action='' method='post'>
			<td><input type="hidden" name="search" value="1" /></td>
			<td>时间:从<input type='text' name='time1' value='<?php echo $search['time1']; ?>' id="time1" onclick="MyCalendar.SetDate(this)" size='12' />
				到<input type='text' name='time2' value='<?php echo $search['time2']; ?>' id="time1" onclick="MyCalendar.SetDate(this)" size='12' />
			</td>
			<td>&nbsp;</td>
			<td>SQL类型:<select name='type'>
				<option value="" <?php echo $search['type']=='0'?"selected='selected'":''; ?>>--全部--</option>
				<option value="SELECT" <?php echo $search['type']=='SELECT'?"selected='selected'":''; ?>>SELECT</option>
				<option value="REPLACE" <?php echo $search['type']=='REPLACE'?"selected='selected'":''; ?>>REPLACE</option>
				<option value="INSERT" <?php echo $search['type']=='INSERT'?"selected='selected'":''; ?>>INSERT</option>
				<option value="DELETE" <?php echo $search['type']=='DELETE'?"selected='selected'":''; ?>>DELETE</option>
				<option value="UPDATE" <?php echo $search['type']=='UPDATE'?"selected='selected'":''; ?>>UPDATE</option>
				</select>
			</td>
			<td>&nbsp;</td>
			<td>
				每页显示:<select name='pagesize'>
				<option value="50" <?php echo $search['pagesize']=='50'?"selected='selected'":''; ?>>50</option>
				<option value="100" <?php echo $search['pagesize']=='100'?"selected='selected'":''; ?>>100</option>
				<option value="200" <?php echo $search['pagesize']=='200'?"selected='selected'":''; ?>>200</option>
				<option value="500" <?php echo $search['pagesize']=='500'?"selected='selected'":''; ?>>500</option>
				</select>
			</td>
			<td>&nbsp;</td>
			<td>表名:<input type='text' name='tablename' value='<?php echo $search['tablename']; ?>' size='30' /></td>
			<td>&nbsp;</td>
			<td><input type='submit' value='查询' /></td>
		</form>
	</table>
	<table border='1' width='800' >
		<caption size='18'>历史统计</caption>
		<tr align='center'>
			<td>截至时间</td>
			<td>SQL次数</td>
			<td>SELECT</td>
			<td>REPLACE</td>
			<td>INSERT</td>
			<td>DELETE</td>
			<td>UPDATE</td>
		</tr>
		<tr align='center'>
			<td><?php echo date('Y-m-d',time()-24*3600); ?></td>
			<td><?php echo $count_history; ?></td>
			<td><?php echo $select_history;echo '('.round($select_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $replace_history;echo '('.round($replace_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $insert_history;echo '('.round($insert_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $delete_history;echo '('.round($delete_history/$count_history*100,1).'%)'; ?></td>
			<td><?php echo $update_history;echo '('.round($update_history/$count_history*100,1).'%)'; ?></td>
		</tr>
	</table>
	<br/>
	<?php
		echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=record_history");
	?>
	<table border='1' width='1300' >
		<tr align='center'><td>序号</td><td>时间</td><td>SQL类型</td><td>SQL操作表</td><td>SQL其他表</td><td>SQL语句</td></tr>
		<?php
			$i=1;
			while($row = DB::fetch($result)){
				echo "<tr align='center'><td>{$i}</td><td>".date('Y-m-d H:i:s',$row['time'])."</td><td>{$row['type']}</td><td>{$row['tablename']}</td><td>{$row['othertable']}</td><td align='left' width='800'>";
				$content = base64_decode($row['content']);
				if(strlen($content)>120){
					$short_content = substr($content,0,120).'...';
				}else{
					$short_content = $content;
				}

				echo "<div onclick=show(this); style='display:block'>{$short_content}</div>";
				echo "<div onclick=hide(this); style='background:#cccccc;display:none'><br>{$content}</div>";

				echo "</td></tr>";
				++$i;
			}
		?>
	</table>

	<?php
		echo multi($count, $ppp, $page, ADMINSCRIPT."?action=plugins&operation=config&do=$pluginid&identifier=record&pmod=record_history");
	?>
</div>
<?php
	function changetime($time){
		$time=explode('-',$time);
		$time=mktime(0,0,0,$time[1],$time[2],$time[0]);
		return $time;
	}
?>
<script>

	function show(obj){
		if(obj.nextSibling.style.display=="none"){
			obj.nextSibling.style.display="block";
		}else if(obj.nextSibling.style.display=="block"){
			obj.nextSibling.style.display="none";
		}
	}
	function hide(obj){
		obj.style.display="none";
	}

	function L_calendar(){}
	L_calendar.prototype={
		_VersionInfo:"Version:1.0&#13;作者: lingye",
		Moveable:true,
		NewName:"",
		insertId:"",
		ClickObject:null,
		InputObject:null,
		InputDate:null,
		IsOpen:false,
		MouseX:0,
		MouseY:0,
		GetDateLayer:function(){
			return window.L_DateLayer;
			},
		L_TheYear:new Date().getFullYear(), //定义年的变量的初始值
		L_TheMonth:new Date().getMonth()+1,//定义月的变量的初始值
		L_WDay:new Array(39),//定义写日期的数组
		MonHead:new Array(31,28,31,30,31,30,31,31,30,31,30,31),//定义阳历中每个月的最大天数
		GetY:function(){
			var obj;
			if (arguments.length > 0){
				obj==arguments[0];
				}
			else{
				obj=this.ClickObject;
				}
			if(obj!=null){
				var y = obj.offsetTop;
				while (obj = obj.offsetParent) y += obj.offsetTop;
				return y;}
			else{return 0;}
			},
		GetX:function(){
			var obj;
			if (arguments.length > 0){
				obj==arguments[0];

				}
			else{
				obj=this.ClickObject;
				}
			if(obj!=null){
				var y = obj.offsetLeft;
				while (obj = obj.offsetParent) y += obj.offsetLeft;
				return y;}
			else{return 0;}
			},
		CreateHTML:function(){
			var htmlstr="";
			htmlstr+="<div id=\"L_calendar\">\r\n";
			htmlstr+="<span id=\"SelectYearLayer\" style=\"z-index: 9999;position: absolute;top: 3; left: 19;display: none\"></span>\r\n";
			htmlstr+="<span id=\"SelectMonthLayer\" style=\"z-index: 9999;position: absolute;top: 3; left: 78;display: none\"></span>\r\n";
			htmlstr+="<div id=\"L_calendar-year-month\"><div id=\"L_calendar-PrevM\" onclick=\"parent."+this.NewName+".PrevM()\" title=\"前一月\"><b>&lt;</b></div><div id=\"L_calendar-year\" onmouseover=\"style.backgroundColor='#FFD700'\" onmouseout=\"style.backgroundColor='white'\" onclick=\"parent."+this.NewName+".SelectYearInnerHTML('"+this.L_TheYear+"')\"></div><div id=\"L_calendar-month\"  onmouseover=\"style.backgroundColor='#FFD700'\" onmouseout=\"style.backgroundColor='white'\" onclick=\"parent."+this.NewName+".SelectMonthInnerHTML('"+this.L_TheMonth+"')\"></div><div id=\"L_calendar-NextM\" onclick=\"parent."+this.NewName+".NextM()\" title=\"后一月\"><b>&gt;</b></div></div>\r\n";
			htmlstr+="<div id=\"L_calendar-week\"><ul  onmouseup=\"StopMove()\"><li>日</li><li>一</li><li>二</li><li>三</li><li>四</li><li>五</li><li>六</li></ul></div>\r\n";
			htmlstr+="<div id=\"L_calendar-day\">\r\n";
			htmlstr+="<ul>\r\n";
			for(var i=0;i<this.L_WDay.length;i++){
				htmlstr+="<li id=\"L_calendar-day_"+i+"\" style=\"background:#e0e0e0\" onmouseover=\"this.style.background='#FFD700'\"  onmouseout=\"this.style.background='#e0e0e0'\"></li>\r\n";
				}
			htmlstr+="</ul>\r\n";
			htmlstr+="<span id=\"L_calendar-today\" onclick=\"parent."+this.NewName+".Today()\"><b>Today</b></span>\r\n";
			htmlstr+="</div>\r\n";
			//htmlstr+="<div id=\"L_calendar-control\"></div>\r\n";
			htmlstr+="</div>\r\n";
			htmlstr+="<scr" + "ipt type=\"text/javas" + "cript\">\r\n";
			htmlstr+="var MouseX,MouseY;";
			htmlstr+="var Moveable="+this.Moveable+";\r\n";
			htmlstr+="var MoveaStart=false;\r\n";
			htmlstr+="document.onmousemove=function(e)\r\n";
			htmlstr+="{\r\n";
			htmlstr+="var DateLayer=parent.document.getElementById(\"L_DateLayer\");\r\n";
			htmlstr+="	e = window.event || e;\r\n";
			htmlstr+="var DateLayerLeft=DateLayer.style.posLeft || parseInt(DateLayer.style.left.replace(\"px\",\"\"));\r\n";
			htmlstr+="var DateLayerTop=DateLayer.style.posTop || parseInt(DateLayer.style.top.replace(\"px\",\"\"));\r\n";
			htmlstr+="if(MoveaStart){DateLayer.style.left=(DateLayerLeft+e.clientX-MouseX)+\"px\";DateLayer.style.top=(DateLayerTop+e.clientY-MouseY)+\"px\"}\r\n";
			htmlstr+=";\r\n";
			htmlstr+="}\r\n";

			htmlstr+="document.getElementById(\"L_calendar-week\").onmousedown=function(e){\r\n";
			htmlstr+="if(Moveable){MoveaStart=true;}\r\n";
			htmlstr+="	e = window.event || e;\r\n";
			htmlstr+="  MouseX = e.clientX;\r\n";
			htmlstr+="  MouseY = e.clientY;\r\n";
			htmlstr+="	}\r\n";

			htmlstr+="function StopMove(){\r\n";
			htmlstr+="MoveaStart=false;\r\n";
			htmlstr+="	}\r\n";
			htmlstr+="</scr"+"ipt>\r\n";
			var stylestr="";
			stylestr+="<style type=\"text/css\">";
			stylestr+="body{background:#fff;font-size:12px;margin:0px;padding:0px;text-align:left}\r\n";
			stylestr+="#L_calendar{border:1px solid blue;width:158px;padding:1px;height:180px;z-index:9998;text-align:center}\r\n";
			stylestr+="#L_calendar-year-month{height:23px;line-height:23px;z-index:9998;}\r\n";
			stylestr+="#L_calendar-year{line-height:23px;width:60px;float:left;z-index:9998;position: absolute;top: 3; left: 19;cursor:default}\r\n";
			stylestr+="#L_calendar-month{line-height:23px;width:48px;float:left;z-index:9998;position: absolute;top: 3; left: 78;cursor:default}\r\n";
			stylestr+="#L_calendar-PrevM{position: absolute;top: 3; left: 5;cursor:pointer}"
			stylestr+="#L_calendar-NextM{position: absolute;top: 3; left: 145;cursor:pointer}"
			stylestr+="#L_calendar-week{height:23px;line-height:23px;z-index:9998;}\r\n";
			stylestr+="#L_calendar-day{height:136px;z-index:9998;}\r\n";
			stylestr+="#L_calendar-week ul{cursor:move;list-style:none;margin:0px;padding:0px;}\r\n";
			stylestr+="#L_calendar-week li{width:20px;height:20px;float:left;;margin:1px;padding:0px;text-align:center;}\r\n";
			stylestr+="#L_calendar-day ul{list-style:none;margin:0px;padding:0px;}\r\n";
			stylestr+="#L_calendar-day li{cursor:pointer;width:20px;height:20px;float:left;;margin:1px;padding:0px;}\r\n";
			stylestr+="#L_calendar-control{height:25px;z-index:9998;}\r\n";
			stylestr+="#L_calendar-today{cursor:pointer;float:left;width:63px;height:20px;line-height:20px;margin:1px;text-align:center;background:red}"
			stylestr+="</style>";
			var TempLateContent="<html>\r\n";
			TempLateContent+="<head>\r\n";
			TempLateContent+="<title></title>\r\n";
			TempLateContent+=stylestr;
			TempLateContent+="</head>\r\n";
			TempLateContent+="<body>\r\n";
			TempLateContent+=htmlstr;
			TempLateContent+="</body>\r\n";
			TempLateContent+="</html>\r\n";
			this.GetDateLayer().document.writeln(TempLateContent);
			this.GetDateLayer().document.close();
			},
		InsertHTML:function(id,htmlstr){
			var L_DateLayer=this.GetDateLayer();
			if(L_DateLayer){L_DateLayer.document.getElementById(id).innerHTML=htmlstr;}
			},
		WriteHead:function (yy,mm)  //往 head 中写入当前的年与月
		{
			this.InsertHTML("L_calendar-year",yy + " 年");
			this.InsertHTML("L_calendar-month",mm + " 月");
		},
		IsPinYear:function(year)            //判断是否闰平年
		{
			if (0==year%4&&((year%100!=0)||(year%400==0))) return true;else return false;
		},
		GetMonthCount:function(year,month)  //闰年二月为29天
		{
			var c=this.MonHead[month-1];if((month==2)&&this.IsPinYear(year)) c++;return c;
		},
		GetDOW:function(day,month,year)     //求某天的星期几
		{
			var dt=new Date(year,month-1,day).getDay()/7; return dt;
		},
		GetText:function(obj){
			if(obj.innerText){return obj.innerText}
			else{return obj.textContent}
			},
		PrevM:function()  //往前翻月份
		{
			if(this.L_TheMonth>1){this.L_TheMonth--}else{this.L_TheYear--;this.L_TheMonth=12;}
			this.SetDay(this.L_TheYear,this.L_TheMonth);
		},
		NextM:function()  //往后翻月份
		{
			if(this.L_TheMonth==12){this.L_TheYear++;this.L_TheMonth=1}else{this.L_TheMonth++}
			this.SetDay(this.L_TheYear,this.L_TheMonth);
		},
		Today:function()  //Today Button
		{
			var today;
			this.L_TheYear = new Date().getFullYear();
			this.L_TheMonth = new Date().getMonth()+1;
			today=new Date().getDate();
			if(this.InputObject){
			this.InputObject.value=this.L_TheYear + "-" + this.L_TheMonth + "-" + today;
			}
			this.CloseLayer();
		},
		SetDay:function (yy,mm)   //主要的写程序**********
		{
			this.WriteHead(yy,mm);
			//设置当前年月的公共变量为传入值
			this.L_TheYear=yy;
			this.L_TheMonth=mm;
			//当页面本身位于框架中时 IE会返回错误的parent
			if(window.top.location.href!=window.location.href){
				for(var i_f=0;i_f<window.top.frames.length;i_f++){
					if(window.top.frames[i_f].location.href==window.location.href){L_DateLayer_Parent=window.top.frames[i_f];}
				}
			}
			else{
				L_DateLayer_Parent=window.parent;
				}
			for (var i = 0; i < 39; i++){this.L_WDay[i]=""};  //将显示框的内容全部清空
			var day1 = 1,day2=1,firstday = new Date(yy,mm-1,1).getDay();  //某月第一天的星期几
			for (i=0;i<firstday;i++)this.L_WDay[i]=this.GetMonthCount(mm==1?yy-1:yy,mm==1?12:mm-1)-firstday+i+1	//上个月的最后几天
			for (i = firstday; day1 < this.GetMonthCount(yy,mm)+1; i++){this.L_WDay[i]=day1;day1++;}
			for (i=firstday+this.GetMonthCount(yy,mm);i<39;i++){this.L_WDay[i]=day2;day2++}
			for (i = 0; i < 39; i++)
			{
				var da=this.GetDateLayer().document.getElementById("L_calendar-day_"+i+"");
				var month,day;
				if (this.L_WDay[i]!="")
				{
					if(i<firstday){
						da.innerHTML="<b style=\"color:gray\">" + this.L_WDay[i] + "</b>";
						month=(mm==1?12:mm-1);
						day=this.L_WDay[i];
					}
					else if(i>=firstday+this.GetMonthCount(yy,mm)){
						da.innerHTML="<b style=\"color:gray\">" + this.L_WDay[i] + "</b>";
						month=(mm==1?12:mm+1);
						day=this.L_WDay[i];
					}
					else{
						da.innerHTML="<b style=\"color:#000\">" + this.L_WDay[i] + "</b>";
						month=(mm==1?12:mm);
						day=this.L_WDay[i];
						if(document.all){
							da.onclick=Function("L_DateLayer_Parent."+this.NewName+".DayClick("+month+","+day+")");
						}
						else{
							da.setAttribute("onclick","parent."+this.NewName+".DayClick("+month+","+day+")");
						}
					}
					da.title=month+" 月"+day+" 日";
					da.style.background=(yy == new Date().getFullYear()&&month==new Date().getMonth()+1&&day==new Date().getDate())? "#FFD700":"#e0e0e0";
					if(this.InputDate!=null){
						if(yy==this.InputDate.getFullYear() && month== this.InputDate.getMonth() + 1 && day==this.InputDate.getDate()){
							da.style.background="#0650D2";
							}
						}
				}
			}
		},
		SelectYearInnerHTML:function (strYear) //年份的下拉框
		{
			if (strYear.match(/\D/)!=null){alert("年份输入参数不是数字！");return;}
			var m = (strYear) ? strYear : new Date().getFullYear();
			if (m < 1000 || m > 9999) {alert("年份值不在 1000 到 9999 之间！");return;}
			var n = m - 10;
			if (n < 1000) n = 1000;
			if (n + 26 > 9999) n = 9974;
			var s = "<select name=\"L_SelectYear\" id=\"L_SelectYear\" style='font-size: 12px' "
				s += "onblur='document.getElementById(\"SelectYearLayer\").style.display=\"none\"' "
				s += "onchange='document.getElementById(\"SelectYearLayer\").style.display=\"none\";"
				s += "parent."+this.NewName+".L_TheYear = this.value; parent."+this.NewName+".SetDay(parent."+this.NewName+".L_TheYear,parent."+this.NewName+".L_TheMonth)'>\r\n";
			var selectInnerHTML = s;
			for (var i = n; i < n + 26; i++)
			{
				if (i == m)
				{selectInnerHTML += "<option value='" + i + "' selected>" + i + "年" + "</option>\r\n";}
				else {selectInnerHTML += "<option value='" + i + "'>" + i + "年" + "</option>\r\n";}
			}
			selectInnerHTML += "</select>";
			var DateLayer=this.GetDateLayer();
			DateLayer.document.getElementById("SelectYearLayer").style.display="";
			DateLayer.document.getElementById("SelectYearLayer").innerHTML = selectInnerHTML;
			DateLayer.document.getElementById("L_SelectYear").focus();
			},
		SelectMonthInnerHTML:function (strMonth) //月份的下拉框
		{
			if (strMonth.match(/\D/)!=null){alert("月份输入参数不是数字！");return;}
			var m = (strMonth) ? strMonth : new Date().getMonth() + 1;
			var s = "<select name=\"L_SelectYear\" id=\"L_SelectMonth\" style='font-size: 12px' "
				s += "onblur='document.getElementById(\"SelectMonthLayer\").style.display=\"none\"' "
				s += "onchange='document.getElementById(\"SelectMonthLayer\").style.display=\"none\";"
				s += "parent."+this.NewName+".L_TheMonth = this.value; parent."+this.NewName+".SetDay(parent."+this.NewName+".L_TheYear,parent."+this.NewName+".L_TheMonth)'>\r\n";
			var selectInnerHTML = s;
			for (var i = 1; i < 13; i++)
			{
				if (i == m)
				{selectInnerHTML += "<option value='"+i+"' selected>"+i+"月"+"</option>\r\n";}
				else {selectInnerHTML += "<option value='"+i+"'>"+i+"月"+"</option>\r\n";}
			}
			selectInnerHTML += "</select>";
			var DateLayer=this.GetDateLayer();
			DateLayer.document.getElementById("SelectMonthLayer").style.display="";
			DateLayer.document.getElementById("SelectMonthLayer").innerHTML = selectInnerHTML;
			DateLayer.document.getElementById("L_SelectMonth").focus();
		},
		DayClick:function(mm,dd)  //点击显示框选取日期，主输入函数*************
		{
			var yy=this.L_TheYear;
			//判断月份，并进行对应的处理
			if(mm<1){yy--;mm=12+mm;}
			else if(mm>12){yy++;mm=mm-12;}
			if (mm < 10){mm = "0" + mm;}
			if (this.ClickObject)
			{if (!dd) {return;}
			if ( dd < 10){dd = "0" + dd;}
			this.InputObject.value= yy + "-" + mm + "-" + dd ; //注：在这里你可以输出改成你想要的格式
			this.CloseLayer();
			}
			else {this.CloseLayer(); alert("您所要输出的控件对象并不存在！");}
		},
		SetDate:function(){
			if (arguments.length <  1){alert("对不起！传入参数太少！");return;}
			else if (arguments.length >  2){alert("对不起！传入参数太多！");return;}
			this.InputObject=(arguments.length==1) ? arguments[0] : arguments[1];
			this.ClickObject=arguments[0];
			var reg = /^(\d+)-(\d{1,2})-(\d{1,2})$/;
			var r = this.InputObject.value.match(reg);
			if(r!=null){
				r[2]=r[2]-1;
				var d= new Date(r[1], r[2],r[3]);
				if(d.getFullYear()==r[1] && d.getMonth()==r[2] && d.getDate()==r[3]){
					this.InputDate=d;		//保存外部传入的日期
				}
				else this.InputDate="";
				this.L_TheYear=r[1];
				this.L_TheMonth=r[2]+1;
				}
			else{
				this.L_TheYear=new Date().getFullYear();
				this.L_TheMonth=new Date().getMonth() + 1
				}
			this.CreateHTML();
			var top=this.GetY();
			var left=this.GetX();
			var DateLayer=document.getElementById("L_DateLayer");
			DateLayer.style.top=top+this.ClickObject.clientHeight+5+"px";
			DateLayer.style.left=left+"px";
			DateLayer.style.display="block";
			if(document.all){
				this.GetDateLayer().document.getElementById("L_calendar").style.width="160px";
				this.GetDateLayer().document.getElementById("L_calendar").style.height="180px"
				}
			else{
				this.GetDateLayer().document.getElementById("L_calendar").style.width="154px";
				this.GetDateLayer().document.getElementById("L_calendar").style.height="180px"
				DateLayer.style.width="158px";
				DateLayer.style.height="250px";
				}
			//alert(DateLayer.style.display)
			this.SetDay(this.L_TheYear,this.L_TheMonth);
			},
		CloseLayer:function(){
			try{
				var DateLayer=document.getElementById("L_DateLayer");
				if((DateLayer.style.display=="" || DateLayer.style.display=="block") && arguments[0]!=this.ClickObject && arguments[0]!=this.InputObject){
					DateLayer.style.display="none";
				}
			}
			catch(e){}
			}
		}

	document.writeln('<iframe id="L_DateLayer" name="L_DateLayer" frameborder="0" style="position:absolute;width:160px; height:200px;z-index:9998;display:none;"></iframe>');
	var L_DateLayer_Parent=null;
	var MyCalendar=new L_calendar();
	MyCalendar.NewName="MyCalendar";
	document.onclick=function(e)
	{
		e = window.event || e;
		var srcElement = e.srcElement || e.target;
		MyCalendar.CloseLayer(srcElement);
	}
</script>
