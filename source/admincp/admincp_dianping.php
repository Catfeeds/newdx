<?php

/**
 *     ������������ͳ��
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

cpheader();
shownav('tools', '��������ͳ��');

if($operation == 'stat') {
	$fid = intval($_G['gp_fid']);	//ȫ��=0
	$threadtype = intval($_G['gp_threadtype']);	//����=1;����=2
	$owner = intval($_G['gp_owner']);	//ȫ��=1;�ڲ���Ա=2
	$threadtype = in_array($threadtype, array(1,2)) ? $threadtype : 1;
	$owner = in_array($owner, array(1,2)) ? $owner : 1;

	$page = max(intval($_GET['page']), 1);
	$perpage  = intval($_GET['perpage']) ? intval($_GET['perpage']) : 15;
	$start = ($page-1)*$perpage;
	$pageurl = ADMINSCRIPT."?action=dianping&operation=stat&fid={$fid}&threadtype={$threadtype}&owner={$owner}";

	require_once DISCUZ_ROOT.'./config/config_dianping.php';

	$sql = "SELECT datetime, nums FROM ".DB::table("dianping_data_stat")." WHERE fid='$fid' AND threadtype='$threadtype' AND owner='$owner'
				ORDER BY id DESC LIMIT $start, $perpage ".getSlaveID();
	$listcount = DB::result_first("SELECT COUNT(*) FROM ".DB::table("dianping_data_stat")." WHERE fid='$fid' AND threadtype='$threadtype' AND owner='$owner' ".getSlaveID());

	$query = DB::query($sql);
	while($row = DB::fetch($query)){
		$date_arr[] = $row['datetime'];
		$data_arr[] = $row['nums'];
	}

	$date_str = json_encode(arr_sort($date_arr));
	$data_str = json_encode(arr_sort($data_arr));

	$multipage = multi($listcount, $perpage, $page, $pageurl);

	$search_table = '<tr><td colspan="3">������飺<select name="fid"><option value="0">ȫ��</option>';
	foreach ($dp_modules as $key => $value) {
		$search_table .= '<option value="'.$value['fid'].'"';
		if ($fid==$value['fid']) {$search_table .= ' selected="selected"';}
		$search_table .= '>'.$value['cname'].'</option>';
	}

	$search_table .= '</select> �������ͣ�<select name="threadtype"><option value="1"';
	if ($threadtype==1) {$search_table .= ' selected="selected"';}
	$search_table .= '>����</option><option value="2"';
	if ($threadtype==2) {$search_table .= ' selected="selected"';}
	$search_table .= '>����</option></select> �����ˣ�<select name="owner"><option value="1"';
	if ($owner==1) {$search_table .= ' selected="selected"';}
	$search_table .= '>ȫ��</option><option value="2"';
	if ($owner==2) {$search_table .= ' selected="selected"';}
	$search_table .= '>�ڲ���Ա</option></select> <input type="submit" class="btn" id="submit_submit" name="submit" title="�� Enter ������ʱ�ύ����޸�" value="�ύ"></td></tr>';

	echo '<script src="static/js/calendar.js" type="text/javascript"></script>';
	showformheader("dianping&operation=stat", '', 'cpform', 'post');
	echo $search_table;
	showformfooter();

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
                data:['������']
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
                    name:'������',
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
		echo '<tr><td><div class="cuspages right">'.$multipage.'</div></td></tr>';
		showtablefooter();
	}
}

//�����鵹���Ų����ü�ֵ
function arr_sort($arr) {
	if(!is_array($arr)) return $arr;

	$arr_count = count($arr)-1;
	for($i=$arr_count; $i>=0; $i--) {
		$arr_new[] = $arr[$i];
	}

	return $arr_new;
}

?>
