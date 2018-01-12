<?php

/**
 *     搜索引擎统计数据分析
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

cpheader();
shownav('tools', 'SEO数据统计');

$operation = in_array($operation, array('index', 'thread', 'forum', 'dianping', 'keyword', 'searchengine')) ? $operation : 'index';

if($operation == 'index') {
	$title = $_G['gp_title'];
	$tid = intval($_G['gp_tid']);
	$fid = intval($_G['gp_fid']);
	$type = intval($_G['gp_type']);
	$date_start = $_G['gp_date_start'];
	$date_end = $_G['gp_date_end'];
	$orderby_pubtime = intval($_G['gp_orderby_pubtime']);
	$orderby_nums = intval($_G['gp_orderby_nums']);

	$page = max(intval($_GET['page']), 1);
	$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 100;
	$start = ($page-1)*$perpage;
	$list = $condition = '';
	$orderby = " nums DESC ";
	$pageurl = ADMINSCRIPT."?action=analytic&operation=index";

	$sql = "SELECT fid, name FROM ".DB::table("forum_forum")." WHERE type='forum' OR type='sub' AND status!=3 ".getSlaveID();
	$query = DB::query($sql);
	while($row = DB::fetch($query)){
		$forum[$row['fid']] = $row['name'];
	}

	asort($forum);

	if($title) {
		$condition .= " AND title LIKE '%$title%'";
		$pageurl .= "&title={$title}";
	}
	if($tid) {
		$condition .= " AND tid='$tid'";
	}
	if($fid) {
		$condition .= " AND fid='$fid'";
		$pageurl .= "&fid={$fid}";
	}
	if($type) {
		$condition .= " AND type='$type'";
		$pageurl .= "&type={$type}";
	}
	if($date_start) {
		$time_start = strtotime($date_start);
		$condition .= " AND pubtime>'$time_start'";
		$pageurl .= "&date_start={$date_start}";
	}
	if($date_end) {
		$time_end = strtotime($date_end)+86400;
		$condition .= " AND pubtime<'$time_end'";
		$pageurl .= "&date_end={$date_end}";
	}
	$orderurl = $pageurl;
	if($orderby_pubtime == 1) {
		$orderby = " pubtime DESC ";
		$pageurl .= "&orderby_pubtime=1";
	}elseif($orderby_pubtime == 2){
		$orderby = " pubtime ASC ";
		$pageurl .= "&orderby_pubtime=2";
	}
	if($orderby_nums == 1) {
		$orderby = " nums DESC ";
		$pageurl .= "&orderby_nums=1";
	}elseif($orderby_nums == 2){
		$orderby = " nums ASC ";
		$pageurl .= "&orderby_nums=2";
	}

	$sql = "SELECT url, title, fid, tid, type, pubtime, nums FROM ".DB::table("plugin_seo_analytic")." WHERE 1=1 $condition
				ORDER BY $orderby LIMIT $start, $perpage ".getSlaveID();
	$listcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table("plugin_seo_analytic")." WHERE 1=1 $condition ".getSlaveID());

	$query = DB::query($sql);
	while($row = DB::fetch($query)){
		if($row['type'] == 1) {
			$row['typename'] = '论坛';
		}elseif ($row['type'] == 2) {
			$row['typename'] = '点评';
		}elseif ($row['type'] == 3) {
			$row['typename'] = '资讯';
		}elseif ($row['type'] == 4) {
			$row['typename'] = '点评评论页';
		}elseif ($row['type'] == 5) {
			$row['typename'] = '游记攻略';
		}elseif ($row['type'] == 6) {
			$row['typename'] = '问答系统';
		}else{
			$row['typename'] = '未知';
		}

		$list .= '<tr class="hover"><td style="width:500px; word-break: break-all;"><a href="'.$row['url'].'" title="'.$row['title'].'" target="_blank">'.cutstr($row['title'], 80).'</a></td><td class="td24"><a href="admin.php?action=analytic&operation=forum&fid='.$row['fid'].'" target="_blank">'.$forum[$row['fid']].'</a></td><td class="td25">'.$row['typename'].'</td><td class="td31">'.date("Y-m-d H:i:s", $row['pubtime']).'</td><td class="td24">'.$row['nums'].'</td><td class="td24"><a href="admin.php?action=analytic&operation=thread&tid='.$row['tid'].'" target="_blank">查看明细</a></td></tr>';
	}

	if(empty($list)) { $list = '<tr class="hover"><td colspan="6">查无结果</td></tr>'; }

	$search_table = '<tr><td colspan="3">标题：<input type="text" class="txt" name="title" value="'.$title.'" style="width: 150px;"> 帖子或文章id：<input type="text" class="txt" name="tid" value="'.$tid.'" style="width: 80px;"> 版块：<select name="fid"><option value="0">不限</option>';
	foreach ($forum as $key => $value) {
		$search_table .= '<option value="'.$key.'"';
		if ($fid==$key) {$search_table .= ' selected="selected"';}
		$search_table .= '>'.$value.'</option>';
	}

	$multipage = multi($listcount, $perpage, $page, $pageurl);

	$search_table .= '</select> 平台：<select name="type"><option value="0">不限</option><option value="1"';
	if ($type==1) {$search_table .= ' selected="selected"';}
	$search_table .= '>论坛</option><option value="2"';
	if ($type==2) {$search_table .= ' selected="selected"';}
	$search_table .= '>点评</option><option value="3"';
	if ($type==3) {$search_table .= ' selected="selected"';}
	$search_table .= '>资讯</option><option value="4"';
	if ($type==4) {$search_table .= ' selected="selected"';}
	$search_table .= '>点评评论页</option><option value="5"';
	if ($type==5) {$search_table .= ' selected="selected"';}
	$search_table .= '>游记攻略</option><option value="6"';
	if ($type==6) {$search_table .= ' selected="selected"';}
	$search_table .= '>问答系统</option></select> 发布时间：<input type="text" class="txt" name="date_start" value="'.$date_start.'" style="width: 80px;" onclick="showcalendar(event, this)"> - <input type="text" class="txt" name="date_end" value="'.$date_end.'" style="width: 80px;" onclick="showcalendar(event, this)">
<input type="submit" class="btn" id="submit_submit" name="submit" title="按 Enter 键可随时提交你的修改" value="提交"> [<a href="admin.php?action=analytic&operation=keyword" target="_blank">每日关键字</a>] [<a href="admin.php?action=analytic&operation=dianping" target="_blank">点评搜索趋势</a>]</td></tr>';

	echo '<script src="static/js/calendar.js" type="text/javascript"></script>';
	showformheader("analytic&operation=index", '', 'cpform', 'post');
	echo $search_table;
	showformfooter();

	showtableheader();
	echo '<tr class="header"><th>标题</th><th>版块</th><th>平台</th><th>发布时间[<a href="'.$orderurl.'&orderby_pubtime=1">倒序</a>][<a href="'.$orderurl.'&orderby_pubtime=2">正序</a>]</th><th>搜索次数[<a href="'.$orderurl.'&orderby_nums=1">倒序</a>][<a href="'.$orderurl.'&orderby_nums=2">正序</a>]</th><th>搜索详情</th></tr>';
	echo $list;
	if($multipage) {
		echo '<tr><td colspan="6"><div class="cuspages right">'.$multipage.'</div></td></tr>';
	}
	showtablefooter();

} elseif($operation == 'thread') {
	$tid = intval($_G['gp_tid']);
	$type = intval($_G['gp_type']);
	$condition = $type ? " AND type='$type'" : '';

	$select = '平台：<select name="type"><option value="0">不限</option><option value="1"';
	if ($type==1) {$select .= ' selected="selected"';}
	$select .= '>论坛</option><option value="2"';
	if ($type==2) {$select .= ' selected="selected"';}
	$select .= '>点评</option><option value="3"';
	if ($type==3) {$select .= ' selected="selected"';}
	$select .= '>资讯</option><option value="4"';
	if ($type==4) {$select .= ' selected="selected"';}
	$select .= '>点评评论页</option><option value="5"';
	if ($type==5) {$select .= ' selected="selected"';}
	$select .= '>游记攻略</option><option value="6"';
	if ($type==6) {$select .= ' selected="selected"';}
	$select .= '>问答系统</option></select>';

	showformheader("analytic&operation=thread", '', 'cpform', 'post');
	echo '<tr><td colspan="3">输入帖子tid：<input type="text" class="txt" name="tid" value="'.$tid.'" style="width: 100px;"> '.$select.' <input type="submit" class="btn" id="submit_submit" name="submit" title="按 Enter 键可随时提交你的修改" value="提交"></td></tr>';
	showformfooter();

	if(!$tid) { cpmsg('请输入要查询的tid', '', 'error'); }

	$page = max(intval($_GET['page']), 1);
	$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 100;
	$start = ($page-1)*$perpage;
	$list = '';

	$sql = "SELECT url, title, referrer, keywords, dateline FROM ".dbTable($tid)." WHERE tid = '$tid' $condition
				ORDER BY dateline DESC LIMIT $start, $perpage ".getSlaveID();
	$query = DB::query($sql);
	while($row = DB::fetch($query)){
		$list .= '<tr class="hover"><td class="td24" style="width:400px;"><a href="'.$row['url'].'" title="'.$row['title'].'" target="_blank">'.cutstr($row['title'], 60).'</a></td><td style="word-break: break-all;"><a href="'.$row['referrer'].'" target="_blank" title="'.$row['referrer'].'">'.cutstr($row['referrer'], 80).'</a></td><td class="td31">'.$row['keywords'].'</td><td class="td24">'.date("Y-m-d H:i:s", $row['dateline']).'</td></tr>';
	}

	if(empty($list)) { $list = '<tr class="hover"><td colspan="4">查无结果</td></tr>'; }

	showtableheader();
	echo '<tr class="header"><th>标题</th><th>搜索来源</th><th>关键字</th><th>搜索时间</th></tr>';
	echo $list;
	showtablefooter();

} elseif($operation == 'forum') {
	$fid = intval($_G['gp_fid']);

	showformheader("analytic&operation=forum", '', 'cpform', 'post');
	echo '<tr><td colspan="3">输入版块fid：<input type="text" class="txt" name="fid" value="'.$fid.'" style="width: 100px;"> <input type="submit" class="btn" id="submit_submit" name="submit" title="按 Enter 键可随时提交你的修改" value="提交"></td></tr>';
	showformfooter();

	if(!$fid) { cpmsg('请输入要查询的fid', '', 'error'); }

	$page = max(intval($_GET['page']), 1);
	$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 15;
	$start = ($page-1)*$perpage;
	$list = '';
	$pageurl = ADMINSCRIPT."?action=analytic&operation=forum&fid={$fid}";

	$listcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table("plugin_seo_analytic_fids")." WHERE fid='$fid' ".getSlaveID());
	$multipage = multi($listcount, $perpage, $page, $pageurl);

	$sql = "SELECT datetime, fid, name, nums FROM ".DB::table("plugin_seo_analytic_fids")." WHERE fid = '$fid'
				ORDER BY id DESC LIMIT $start, $perpage ".getSlaveID();
	$query = DB::query($sql);
	while($row = DB::fetch($query)){
		// $list .= '<tr class="hover"><td class="td24"><a href="'.$row['fid'].'" target="_blank">'.$row['name'].'</a></td><td class="td31">'.$row['nums'].'</td><td class="td31">'.$row['datetime'].'</td></tr>';
		$list = $row['name'];
		$date_arr[] = $row['datetime'];
		$data_arr[] = $row['nums'];
	}

	$date_str = json_encode(arr_sort($date_arr));
	$data_str = json_encode(arr_sort($data_arr));

	if(empty($list)) { $list = '<tr class="hover"><td colspan="3">查无结果</td></tr>'; } else { $list = '<tr class="hover"><td colspan="3">['.$list.']版块搜索量趋势如下</td></tr>'; }

	showtableheader();
	echo $list;
	showtablefooter();
	echo <<<EOT
<div id="graphic">
                <div id="main" style="height:400px;width:100%"></div>
            </div>
            <script src="/static/js/echarts/esl.js"></script>
<script type="text/javascript">
        require.config({
            packages: [
                {
                    name: 'echarts',
                    location: '/static/js/echarts',
                    main: 'echarts'
                },
                {
                    name: 'zrender',
                    location: 'http://ecomfe.github.io/zrender/src',
                    //location: '../../../zrender/src',
                    main: 'zrender'
                }
            ]
        });

        var option = {
            tooltip : {
                trigger: 'axis'
            },
            legend: {
                data:['搜索量']
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: false},
                    dataView : {show: false, readOnly: true},
                    magicType : {show: true, type: ['line', 'bar']},
                    restore : {show: false},
                    saveAsImage : {show: true}
                }
            },
            calculable : false,
            xAxis : [
                {
                    type : 'category',
                    data : {$date_str}
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    splitArea : {show : true}
                }
            ],
            series : [
                {
                    name:'搜索量',
                    type:'bar',
                    data:{$data_str}
                }
            ]
        };

        require(
            [
                'echarts',
                'echarts/chart/line',
                'echarts/chart/bar'
            ],
            function (ec) {
                var myChart = ec.init(document.getElementById('main'));
                myChart.setOption(option);
            }
        )
    </script>
EOT;
	if($multipage) {
		showtableheader();
		echo '<tr><td colspan="3"><div class="cuspages right">'.$multipage.'</div></td></tr>';
		showtablefooter();
	}
} elseif($operation == 'dianping') {

	$page = max(intval($_GET['page']), 1);
	$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 15;
	$start = ($page-1)*$perpage;
	$list = '';
	$pageurl = ADMINSCRIPT."?action=analytic&operation=dianping";

	require_once DISCUZ_ROOT.'./config/config_dianping.php';

	$data = array();

	foreach ($dp_modules as $fname => $fvalue) {

		// $listcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table("plugin_seo_analytic_fids")." WHERE fid='$fvalue[fid]' ".getSlaveID());
		// $multipage = multi($listcount, $perpage, $page, $pageurl);

		$sql = "SELECT datetime, fid, name, nums FROM ".DB::table("plugin_seo_analytic_fids")." WHERE fid = '$fvalue[fid]'
					ORDER BY id DESC LIMIT $start, $perpage ".getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			$data[$row['datetime']] += $row['nums'];
		}
	}

	foreach ($data as $key => $value) {
		$date_arr[] = $key;
		$data_arr[] = $value;
	}

	$date_str = json_encode(arr_sort($date_arr));
	$data_str = json_encode(arr_sort($data_arr));

	showtableheader();
	echo '<tr class="hover"><td colspan="3">点评整体搜索量趋势如下</td></tr>';
	showtablefooter();
	echo <<<EOT
<div id="graphic">
                <div id="main" style="height:400px;width:100%"></div>
            </div>
            <script src="/static/js/echarts/esl.js"></script>
<script type="text/javascript">
        require.config({
            packages: [
                {
                    name: 'echarts',
                    location: '/static/js/echarts',
                    main: 'echarts'
                },
                {
                    name: 'zrender',
                    location: 'http://ecomfe.github.io/zrender/src',
                    //location: '../../../zrender/src',
                    main: 'zrender'
                }
            ]
        });

        var option = {
            tooltip : {
                trigger: 'axis'
            },
            legend: {
                data:['搜索量']
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: false},
                    dataView : {show: false, readOnly: true},
                    magicType : {show: true, type: ['line', 'bar']},
                    restore : {show: false},
                    saveAsImage : {show: true}
                }
            },
            calculable : false,
            xAxis : [
                {
                    type : 'category',
                    data : {$date_str}
                }
            ],
            yAxis : [
                {
                    type : 'value',
                    splitArea : {show : true}
                }
            ],
            series : [
                {
                    name:'搜索量',
                    type:'bar',
                    data:{$data_str}
                }
            ]
        };

        require(
            [
                'echarts',
                'echarts/chart/line',
                'echarts/chart/bar'
            ],
            function (ec) {
                var myChart = ec.init(document.getElementById('main'));
                myChart.setOption(option);
            }
        )
    </script>
EOT;
	if($multipage) {
		showtableheader();
		echo '<tr><td colspan="3"><div class="cuspages right">'.$multipage.'</div></td></tr>';
		showtablefooter();
	}
} elseif($operation == 'searchengine') {

} elseif($operation == 'keyword') {
	$datetime = $_G['gp_datetime'] ? str_replace('-', '', $_G['gp_datetime']) : '';
	// if(!$datetime) { cpmsg('请输入要查询的日期', '', 'error'); }

	$page = max(intval($_GET['page']), 1);
	$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 100;
	$start = ($page-1)*$perpage;
	$list = '';
	$today = date("Ymd", time());
	$istoday = ($today == $datetime || !$datetime) ? 1 : 0;

	if(!$istoday) {
		$sql = "SELECT datetime, keywords, nums FROM ".dbTable($datetime, 2)." WHERE datetime='$datetime'
					ORDER BY nums DESC LIMIT $start, $perpage ".getSlaveID();
		$query = DB::query($sql);
		while($row = DB::fetch($query)){
			$list .= '<tr class="hover"><td class="td24">'.$row['keywords'].'</td><td class="td31">'.$row['nums'].'</td><td class="td31">'.$row['datetime'].'</td></tr>';
		}
		$listcount = DB::result_first("SELECT COUNT(*) FROM ".dbTable($datetime, 2)." WHERE datetime='$datetime' ".getSlaveID());
		$multipage = multi($listcount, $perpage, $page, ADMINSCRIPT."?action=analytic&operation=keyword&datetime=$datetime");
	} else {
		require_once libfile('class/myredis');
		$redis = & myredis::instance(6381);
		$keywords = $redis->obj->hgetall('seo_analytic_kwnums_'.$today);
		arsort($keywords);
		$listcount = count($keywords);
		$keywords = array_slice($keywords, $start, $perpage, true);
		foreach ($keywords as $key => $value) {
			$list .= '<tr class="hover"><td class="td24">'.$key.'</td><td class="td31">'.$value.'</td><td class="td31">'.$today.'</td></tr>';
		}
		$multipage = multi($listcount, $perpage, $page, ADMINSCRIPT."?action=analytic&operation=keyword&datetime=$datetime");
	}

	if(empty($list)) { $list = '<tr class="hover"><td colspan="3">查无结果</td></tr>'; }

	echo '<script src="static/js/calendar.js" type="text/javascript"></script>';
	showformheader("analytic&operation=keyword", '', 'cpform', 'post');
	echo '<tr><td colspan="3">选择日期：<input type="text" class="txt" name="datetime" value="" style="width: 108px;" onclick="showcalendar(event, this)"> <input type="submit" class="btn" id="submit_submit" name="submit" title="按 Enter 键可随时提交你的修改" value="提交"></td></tr>';
	showformfooter();

	showtableheader();
	echo '<tr class="header"><th class="td24">关键字</th><th class="td31">搜索数量</th><th class="td31">日期</th></tr>';
	echo $list;
	if($multipage) {
		echo '<tr><td colspan="3"><div class="cuspages right">'.$multipage.'</div></td></tr>';
	}
	showtablefooter();
}

function dbTable($data, $type = 1)
{
	$table_name = $type == 1 ? 'plugin_seo_analytic_' : 'plugin_seo_analytic_keywords_';
	$table_name .= $data ? substr($data, -1) : 0;
	$table_name = DB::table($table_name);
	return $table_name;
}

//将数组倒序排并重置键值
function arr_sort($arr) {
	if(!is_array($arr)) return $arr;

	$arr_count = count($arr)-1;
	for($i=$arr_count; $i>=0; $i--) {
		$arr_new[] = $arr[$i];
	}

	return $arr_new;
}

?>
