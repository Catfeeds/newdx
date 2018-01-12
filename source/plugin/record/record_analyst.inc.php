<?php
	if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
		exit('Access Denied');
	}

	$sql_type_arr=array('1'=>array(),	//where  --
						'2'=>array(),	//order by  --
						'3'=>array(),	//limit  --
						'4'=>array(),	//where order by
						'5'=>array(),	//where limit
						'6'=>array(),	//order by limit
						'7'=>array(),	//where order by limit
						'8'=>array()	//select AA from BB
						);
	// $sql_type_arr=array();

	if($_POST['search']){
        unset($_POST['search']);
        $_G['gp_page'] = 1;
        foreach ($_POST as $postid => $post) {
            dsetcookie($postid, $post, 3600);
        }
    }

	$search=array();
	foreach (explode(' ','ppp tablename second') as $item) {
		$search[$item] = getcookie($item);
	}

	$where='';
	if($search['tablename']!=NULL){
		$where.=" AND tablename='{$search['tablename']}'";
	}else{
		$where.=" AND tablename=''";
	}

	$count = DB::result_first("SELECT count(*) FROM ".DB::table('plugin_record')." WHERE type='select' {$where}");

	//默认每次条数
	$defaultPpp=100;
	//默认间隔时间
	//$defaultSecond=5;

	$ppp = $search['ppp']?$search['ppp']:$defaultPpp;
	//$second = $search['second']?$search['second']:$defaultSecond;
	memory('set','ppp',$ppp,3600*4);
	memory('set','count',$count,3600*4);

	if($search['tablename']!=NULL){
		$mem_tablename=$search['tablename'];
		memory('set','mem_tablename',$mem_tablename,3600*4);
		if($_POST['clearmemcache']){
			memory('rm',$mem_tablename);
			memory('rm','analyst_page');
			$url = "admin.php?action=plugins&operation=config&do={$pluginid}&identifier=record&pmod=record_analyst";
			echo "<div style='position:absolute;left:20%;top:30%'>";
			echo "<h1 style='font-size:18px;'>缓存清除完成</h1>";
			echo "<fieldset style='padding:20px;'><legend><b>分析信息</b></legend>";
			echo "<p>3秒跳转后重新分析</p>";
			echo "<p>表名：<b style='color:red'>".$mem_tablename."</b>条。</p></fieldset></div>";
			echo "<meta http-equiv='refresh'content=3;URL='$url'>";
			exit();
		}
	}

	if($search['tablename']!=NULL && $_POST['tablename']){
		$mem_tablename=$search['tablename'];
		memory('set','mem_tablename',$mem_tablename,3600*4);

		$data_arr=array();
		$data_arr=unserialize(memory('get',$mem_tablename));

		$mem_mark=true;
		foreach($data_arr as $v){
			if(!empty($v)){
				$mem_mark=false;
				break;
			}
		}
		//-----------memcache  储存  start----------
		if($mem_mark){
			include "record_analyst_page.inc.php";
		}
		//-----------memcache  储存  end----------
	}



	// /*-----------memcache  储存  start----------*/
	// if(empty($data_arr)){
		// for($page=1;$page<=$totalpage;++$page){
			// $start=($page-1)*$ppp;
			// $limit=" limit {$start},{$ppp}";
			// $result = DB::query("SELECT time,type,tablename,othertable,content FROM ".DB::table(plugin_record)." WHERE type='select' {$where} ORDER BY time desc {$limit}");
			// while($row=DB::fetch($result)){
				// $sql=base64_decode($row['content']);
				// workedsql($sql);
			// }
			// sleep($second);
		// }
		// $data=serialize($sql_type_arr);
		// memory('set',$mem_tablename,$data,3600*4);
		// $data_arr=$sql_type_arr;
	// }
	// /*-----------memcache  储存  end----------*/


	/*//-----------直接每次处理  start----------
	for($page=1;$page<=$totalpage;++$page){
		$start=($page-1)*$ppp;
		$limit=" limit {$start},{$ppp}";
		$result = DB::query("SELECT time,type,tablename,othertable,content FROM ".DB::table(plugin_record)." WHERE type='select' {$where} ORDER BY time desc {$limit}");
		while($row=DB::fetch($result)){
			$sql=base64_decode($row['content']);
			workedsql($sql);
		}
		sleep($second);
	}
	$data_arr=$sql_type_arr;
	//-----------直接每次处理  end----------
	*/

	$sort_arr=array();
	$final_arr=array();
	foreach($data_arr as $sql_arr){
		foreach($sql_arr as $sqltype => $date){
			$sort_arr[$sqltype] = $date[0];
			$final_arr[$sqltype][] = $date;
		}
	}
	arsort($sort_arr);
?>

<div>
	<table>
		<tr>
			<form action='' method='post'>

				<input type='hidden' name='search' value='1'>
				<td>表名:<input type='text' name='tablename' value='<?php echo $search['tablename']?$search['tablename']:''; ?>' size='40' /></td>
				<td>
					每次分析（条）:<input type='text' name='ppp' value='<?php echo $search['ppp']?$search['ppp']:$defaultPpp; ?>' size='10' />
				</td>
				<!--<td>
					分析间隔（秒）:<input type='text' name='second' value='<?php echo $search['second']?$search['second']:$defaultSecond; ?>' size='10' />
				</td>-->
				<td><input type='submit' value='查询'></td>

			</form>
			<form action='' method='post'>
				<input type='hidden' name='clearmemcache' value='1'>
				<td><input type='submit' value='清除缓存数据'></td>
			</form>
		</tr>
	<table>
</div>
<br />
<div>
	<center>表名:<b><?php echo $search['tablename']; ?></b> 共有SQL:<b><?php echo $count; ?></b>条</center>
</div>
<div>
<table border='1' width='1200'>
	<tr>
		<td width='30'>序号</td>
		<td>SQL类型</td>
		<td>次数</td>
	</tr>
	<?php
		$i=1;
		foreach($sort_arr as $sqltype => $temp){
			foreach($final_arr[$sqltype] as $date)
			echo "<tr bgcolor='#B9D1EA'><td>".$i."</td>";
			$sqltype1=$sqltype;
			$sqltype1=str_replace('\s*',' ',$sqltype1);
			$sqltype1=str_replace('[=|<>|in|like]','=',$sqltype1);
			$sqltype1=str_replace('(.*)','*',$sqltype1);
			$sqltype1=str_replace('\\','',$sqltype1);
			echo '<td>'.$sqltype1.'</td>';
			echo '<td>'.$date[0].'</td></tr>';
			echo "<tr><td colspan='3'><div onclick='show(this)'>展开SQL语句</div><div onclick=hide(this); style='background:#cccccc;display:none'>";
			foreach($date[1] as $list){
				echo "<ol>{$list}</ol>";
			}
			echo "</div></td></tr>";

			++$i;
		}
	?>
</table>
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
</script>
</div>

<?php
	/*
	// function workedsql($sql){
		// global $sql_type_arr;

		// $startleftjoin=strpos($sql,' join ');
		// $startwhere=strpos($sql,'where ');
		// $startorder=strpos($sql,'order by');
		// $startlimit=strpos($sql,'limit');

		// if($startleftjoin){
			// $str_leftjoin=substr($sql,$startleftjoin,$startwhere-$startleftjoin);
			// $str_join = sqlhaveleftjoin($str_leftjoin);
		// }

		每种类型存储sql的条数
		// $sql_count=50;

		// if($startwhere){//有where
			// if($startorder){//有 order by
				// if($startlimit){//有 limit
					where  order by  limit
					// $str_where=substr($sql,$startwhere,$startorder-$startwhere);
					// $str_order=substr($sql,$startorder,$startlimit-$startorder);
					// $str_limit=substr($sql,$startlimit);
					// $preg_whereorderlimit_arr=array_keys($sql_type_arr['7']);
					// $mark=false;
					// foreach($preg_whereorderlimit_arr as $value){
						// if(preg_match($value,$sql)){
							// $mark=true;
							// $key=$value;
							// break;
						// }else{
							// $mark=false;
						// }
					// }

					// if($mark){
						// $sql_type_arr['7'][$key][0]+=1;
						// if($sql_type_arr['7'][$key][0]<=$sql_count){
							// $sql_type_arr['7'][$key][1][]=$sql;
						// }
					// }else{
						// $preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).sqlhaveorder($str_order).'limit (.*)/ius';
						// $preg_str = str_replace(' ','\s*',$preg_str);
						// if(in_array($preg_str,$preg_whereorderlimit_arr)){
							// $sql_type_arr['7'][$preg_str][0]+=1;
						// }else{
							// $sql_type_arr['7'][$preg_str][0]=1;
						// }
						// if($sql_type_arr['7'][$preg_str][0]<=$sql_count){
							// $sql_type_arr['7'][$preg_str][1][]=$sql;
						// }
					// }

				// }else{//没有 limit
					where  order by
					// $str_where=substr($sql,$startwhere,$startorder-$startwhere);
					// $str_order=substr($sql,$startorder);

					// $preg_whereorder_arr=array_keys($sql_type_arr['4']);
					// $mark=false;
					// foreach($preg_whereorder_arr as $v){
						// if(preg_match($v,$sql)){
							// $mark=true;
							// $key=$v;
							// break;
						// }else{
							// $mark=false;
						// }
					// }
					// if($mark){
						// $sql_type_arr['4'][$key][0]+=1;
						// if($sql_type_arr['4'][$key][0]<=$sql_count){
							// $sql_type_arr['4'][$key][1][]=$sql;
						// }
					// }else{
						// $preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).sqlhaveorder($str_order).'/ius';
						// $preg_str = str_replace(' ','\s*',$preg_str);
						// if(in_array($preg_str,$preg_whereorder_arr)){
							// $sql_type_arr['4'][$preg_str][0]+=1;
						// }else{
							// $sql_type_arr['4'][$preg_str][0]=1;
						// }
						// if($sql_type_arr['4'][$preg_str][0]<=$sql_count){
							// $sql_type_arr['4'][$preg_str][1][]=$sql;
						// }

					// }
				// }
			// }else{//没有 order by
				// if($startlimit){//有 limit
					where limit
					// $str_where=substr($sql,$startwhere,$startlimit-$startwhere);
					// $str_limit=substr($sql,$startlimit);

					// $preg_wherelimit_arr=array_keys($sql_type_arr['5']);
					// $mark=false;
					// foreach($preg_wherelimit_arr as $v){
						// if(preg_match($v,$sql)){
							// $mark=true;
							// $key=$v;
							// break;
						// }else{
							// $mark=false;
						// }
					// }
					// if($mark){
						// $sql_type_arr['5'][$key][0]+=1;
						// if($sql_type_arr['5'][$key][0]<=$sql_count){
							// $sql_type_arr['5'][$key][1][]=$sql;
						// }
					// }else{
						// $preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).'limit (.*)/ius';
						// $preg_str = str_replace(' ','\s*',$preg_str);
						// if(in_array($preg_str,$preg_wherelimit_arr)){
							// $sql_type_arr['5'][$preg_str][0]+=1;
						// }else{
							// $sql_type_arr['5'][$preg_str][0]=1;
						// }
						// if($sql_type_arr['5'][$preg_str][0]<=$sql_count){
							// $sql_type_arr['5'][$preg_str][1][]=$sql;
						// }
					// }

				// }else{//没有 limit
					where
					// $str_where=substr($sql,$startwhere);

					// $preg_where_arr=array_keys($sql_type_arr['1']);
					// $mark=false;
					// foreach($preg_where_arr as $v){
						// if(preg_match($v,$str_where)){
							// $mark=true;
							// $key=$v;
							// break;
						// }else{
							// $mark=false;
						// }
					// }
					// if($mark){
						// $sql_type_arr['1'][$key][0]+=1;
						// if($sql_type_arr['1'][$key][0]<=$sql_count){
							// $sql_type_arr['1'][$key][1][]=$sql;
						// }
					// }else{
						// $preg_str='/select(.*)from(.*)'.$str_join.sqlhavewhere($str_where).'/ius';
						// $preg_str = str_replace(' ','\s*',$preg_str);
						// if(in_array($preg_str,$preg_where_arr)){
							// $sql_type_arr['1'][$preg_str][0]+=1;
						// }else{
							// $sql_type_arr['1'][$preg_str][0]=1;
						// }
						// if($sql_type_arr['1'][$preg_str][0]<=$sql_count){
							// $sql_type_arr['1'][$preg_str][1][]=$sql;
						// }
					// }
				// }
			// }
		// }else{//没有where条件

			// if($startorder){//有 order by
				// if($startlimit){//有 limit
					order by  limit

					// $str_order=substr($sql,$startorder,$startlimit-$startorder);
					// $str_limit=substr($sql,$startlimit);

					// $preg_orderlimit_arr=array_keys($sql_type_arr['6']);
					// $mark=false;
					// foreach($preg_orderlimit_arr as $v){
						// if(preg_match($v,$sql)){
							// $mark=true;
							// $key=$v;
							// break;
						// }else{
							// $mark=false;
						// }
					// }
					// if($mark){
						// $sql_type_arr['6'][$key][0]+=1;
						// if($sql_type_arr['6'][$key][0]<=$sql_count){
							// $sql_type_arr['6'][$key][1][]=$sql;
						// }
					// }else{
						// $preg_str='/select(.*)from(.*)'.$str_join.sqlhaveorder($str_order).'limit (.*)/ius';
						// $preg_str = str_replace(' ','\s*',$preg_str);
						// if(in_array($preg_str,$preg_orderlimit_arr)){
							// $sql_type_arr['6'][$preg_str][0]+=1;
						// }else{
							// $sql_type_arr['6'][$preg_str][0]=1;
						// }
						// if($sql_type_arr['6'][$preg_str][0]<=$sql_count){
							// $sql_type_arr['6'][$preg_str][1][]=$sql;
						// }
					// }
				// }else{//没有 limit
					order by

					// $str_order=substr($sql,$startorder);
					// $preg_order_arr=array_keys($sql_type_arr['2']);
					// $mark=false;
					// foreach($preg_order_arr as $v){
						// if(preg_match($v,$str_order)){
							// $mark=true;
							// $key=$v;
							// break;
						// }else{
							// $mark=false;
						// }
					// }
					// if($mark){
						// $sql_type_arr['2'][$key][0]+=1;
						// if($sql_type_arr['2'][$key][0]<=$sql_count){
							// $sql_type_arr['2'][$key][1][]=$sql;
						// }
					// }else{
						// $preg_str='/select(.*)from(.*)'.$str_join.sqlhaveorder($str_order).'/ius';
						// $preg_str = str_replace(' ','\s*',$preg_str);
						// if(in_array($preg_str,$preg_order_arr)){
							// $sql_type_arr['2'][$preg_str][0]+=1;
						// }else{
							// $sql_type_arr['2'][$preg_str][0]=1;
						// }
						// if($sql_type_arr['2'][$preg_str][0]<=$sql_count){
							// $sql_type_arr['2'][$preg_str][1][]=$sql;
						// }
					// }
				// }
			// }else{//没有 order by
				// if($startlimit){//有 limit
					limit

					// $str_limit=substr($sql,$startlimit);
					// $preg_str='/select(.*)from(.*)'.$str_join.'limit (.*)/ius';

					// if(preg_match($preg_str,$str_limit)){
						// $sql_type_arr['3'][$preg_str][0]+=1;
						// if($sql_type_arr['3'][$preg_str][0]<=$sql_count){
							// $sql_type_arr['3'][$preg_str][1][]=$sql;
						// }
					// }

				// }else{//没有 limit
					select * from AAA
					// $sql_type_arr['8']['select A from B'][0]+=1;
					// if($sql_type_arr['8']['select A from B'][0]<=$sql_count){
						// $sql_type_arr['8']['select A from B'][1][]=$sql;
					// }
				// }
			// }
		// }
	// }

	// function sqlhaveleftjoin($sql){
		// $num=substr_count($sql,' join ');
		// $str_join='';
		// for($i=0;$i<$num;$i++){
			// $str_join.='[(left join)|(right join)]+(.*)';
		// }
		// $preg_join="/".$str_join."/ius";
		// if(preg_match($preg_join,$sql)){
			// return $str_join;
		// }else{
			// return '';
		// }
	// }

	// function sqlhavewhere($sql){

		// $num=substr_count($sql,' and ');
		// $str_where='';
		// for($i=0;$i<$num;$i++){
			// $str_where.=' and (.*)[=|<>|in|like](.*)';
		// }
		// $arr=array();
		// $str='/where (.*)[=|<>|in|like](.*)'.$str_where.'/ius';
		// preg_match($str,$sql,$arr);
		// $j=count($arr);
		// $string='';
		// $arr_temp=array();
		// for($i=1;$i<$j;$i+=2){
			// $arr[$i]=addcslashes($arr[$i],'.');
			// $arr[$i]=addcslashes($arr[$i],'*');
			// $or_num=substr_count($arr[$i],' or ');
			// if($or_num){
				// $arr[$i]=substr($arr[$i],1);
				// $or_str='';
				// if($or_num==1){
					// $or_str.=" or (.*)";
				// }else{
					// for($k=0;$k<$or_num;++$k){
						// $or_str.=" or (.*)[=|<>|in|like]\s*\w*";
					// }
				// }
				// $or_str="/(.*)[=|<>|in|like]\s*\w*".$or_str."/ius";
				// $or_arr=array();
				// $or_temp=array();
				// $or_sql=$arr[$i];
				// preg_match($or_str,$or_sql,$or_arr);
				// $n=count($or_arr);
				// for($m=1;$m<$n;++$m){
					// $or_temp[]="{$or_arr[$m]}=\s*\w*";
				// }
				// $arr_temp[]="\(".implode(' or ',$or_temp)."\)";
			// }else{
				// $arr_temp[]="{$arr[$i]}[=|<>|in|like](.*)";
			// }
		// }
		// $string=implode(' and ',$arr_temp);
		// $str='where '.$string;
		// return $str;

	// }

	// function sqlhaveorder($sql){
		// $str='/order by (.*)[ desc| asc]?/ius';
		// preg_match($str,$sql,$arr);
		// $arr[1]=addcslashes($arr[1],'.');
		// $str='order by '.$arr[1];
		// return $str;
	// }
	*/
?>


