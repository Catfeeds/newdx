<?php
/**
 * 此脚本用于在指定条件下返回json数据,服务于[后台->内容->榜单管理->批量添加榜单]功能，如果[批量添加榜单]功能已经弃用，此文件可以注销引用，和此功能相关的还有一个计划任务cron_bangdan.php
 * @author gtl 20160302
 */
if($_G['gp_ajaxfrom'] == 'admin'){ //请求来源于后台的判断;

	//筛选有评分的item
	$foradminlist = array();
	foreach ($modlist as $key => $item) {
		if($item['score']>0) $foradminlist[$key] = $item;
	}
    if($mod == 'line'){
        //截取2个
        $foradminlist = @array_slice($foradminlist, 0, 2);
        if(count($foradminlist)<2){ //不满2个发送空数据
            echo json_encode(array());
            exit();
            
        }
    }else{
        //截取10个
        $foradminlist = @array_slice($foradminlist, 0, 10);
        if(count($foradminlist)<10){ //不满10个发送空数据
            echo json_encode(array());
            exit();
        }
    }
	
	
	//标题的确定按类型设定
	$curryear = date("Y");
    //月份不带0
    $currmonth = date("n");
	switch($mod){
		case 'equipment':
			switch ($order) {
				case 'heats':
					$ordertitle = '最热门的';
					break;
				case 'score':
					$ordertitle = '口碑最好的';
					break;
			}
			if ($max && !$min) {
				$pricetitle = $max . '元以下';
			}elseif ($min && !$max) {
				$pricetitle = $min . '元以上';
			}elseif ($min && $max) {
				$pricetitle = "{$min}~{$max}元";
			}
			if ($bid) $brandtitle = $brandlist[$bid]['subject'];
			if ($pcid && !$cid) $typetitle = $category[$pcid]['name'];
			if ($pcid && $cid) $typetitle = $category[$pcid]['child'][$cid];
			$pageTitle = "{$curryear}年{$ordertitle}{$pricetitle}{$brandtitle}户外{$typetitle}推荐排行榜";
			break;
		case  'line':
			switch ($order) {
				case 'heats':
					$ordertitle = "最热门的";
					break;
				case 'score':
					$ordertitle = "口碑最好的";
					break;
			}
			if($provinceid){
				$provincetitle = $regionList[$provinceid]['cityname'];
			}
            if($cityid){
				$citytitle = $onlycity[$cityid][name];
			}
			if($type){
				$typetitle = $cate_type[$type];
			}
			if($timetype){
				$titmetitle = "（{$cate_timetype[$timetype]}）";	
			}
            
			$pageTitle = "{$curryear}年{$currmonth}月{$provincetitle}{$citytitle}{$ordertitle}{$typetitle}户外旅行线路推荐排行榜{$titmetitle}";
			break;
		case 'brand':
			switch ($order) {
				case 'heats':
					$ordertitle = "最热门的";
					break;
				case 'score':
					$ordertitle = "口碑最好的";
					break;
			}
			if (!empty($nat)) {
				$nattitle = $dp_category['brand']['region'][$nat];
			}
			$pageTitle = "{$curryear}年{$ordertitle}{$nattitle}户外品牌推荐排行榜";
			if (!empty($cp)) {
				$pageTitle = "{$curryear}年{$ordertitle}{$nattitle}{$dp_category['brand']['ranklist'][$cp]}";
			}
			break;
		case  'shop':
			//未规定
			break;
		case  'climb':
			switch ($order) {
				case 'heats':
					$ordertitle = "最热门的";
					break;
				case 'score':
					$ordertitle = "口碑最好的";
					break;
			}
			if($provinceid){
				$provincetitle = $countries[$provinceid]['cityname'];
			}
			if($type){
				$typetitle = $cate_type[$type];
			}
			if($placetype){
				$placetitle = $cate_placetype[$placetype];
			}
			$pageTitle = "{$curryear}年{$provincetitle}{$ordertitle}{$typetitle}场地{$placetitle}推荐排行榜";
			break;
		case  'skiing':
			break;
		case  'diving':
			break;
		case  'mountain':
			break;
		case  'fishing':
			break;
		case  'club':
			break;
		case  'hostel':
			break;
	}

	//补充评论
	foreach ($foradminlist as $key => $item) {
		$query = DB::query("SELECT p.tid, p.author, p.authorid, p.message, t.subject
					FROM " . DB::table("dianping_star_logs") . " AS s
					LEFT JOIN " . DB::table("forum_post") . " AS p ON s.pid=p.pid
					LEFT JOIN " . DB::table("forum_thread") . " AS t ON t.tid=p.tid
					WHERE p.tid = '{$item['tid']}' AND p.first=0 AND p.rate>0
					ORDER BY p.dateline DESC
					LIMIT 1 " . getSlaveID());
		$row = DB::fetch($query);
		if (empty($row)) {
			$query = DB::query("SELECT p.tid, p.author, p.authorid, p.message, t.subject
				FROM " . DB::table("dianping_star_logs") . " AS s
				LEFT JOIN " . DB::table("forum_post") . " AS p ON s.pid=p.pid
				LEFT JOIN " . DB::table("forum_thread") . " AS t ON t.tid=p.tid
				WHERE p.tid = '{$item['tid']}' AND p.first=0 AND p.rate = 0
				ORDER BY p.dateline DESC
				LIMIT 1 " . getSlaveID());
			$row = DB::fetch($query);
		}
		if (!empty($row)) {
			$foradminlist[$key]['new_comment'] = "（来自<a href='home.php?mod=space&uid={$row['authorid']}' class='namemorelink'>@{$row['author']}</a>）：" . $row['message'];
		}
	}
    if($mod == 'line'){
        //通过地点获取活动的数据
        if($provincetitle && $citytitle){
            $api_result = requestRemoteData('http://m.hd.8264.com/wap.php?app=api&act=getTag_list&city='.urlencode(diconv($citytitle, 'gbk', 'utf-8')));
            if($api_result){
                $api_data = json_decode($api_result, true);
                $huodonglist = iconv_array($api_data, 'UTF-8', 'GBK');
            }
        }else{

            $api_result = requestRemoteData('http://m.hd.8264.com/wap.php?app=api&act=getTag_list&province='.urlencode(diconv($provincetitle, 'gbk', 'utf-8')));
            if($api_result){
                $api_data = json_decode($api_result, true);
                $huodonglist = iconv_array($api_data, 'UTF-8', 'GBK');
            }
        }
        //取3条数据
        if(!empty($huodonglist)){
            $huodonglist = @array_slice($huodonglist, 0, 3);
            //活动数据添加到foradminlist数组中
            foreach($huodonglist as $k1=>$v){
                $j = $k1 +2;
                if($v['order_algorithm_max_long'] <= 100){
                    $score_array =array('7.1','7.2','7.3','7.4','7.5','7.6','7.7','7.8','7.9','8.0','8.1','8.2');
                    $score = array_rand($score_array,2);
                }elseif($v['order_algorithm_max_long'] >= 100 && $v['order_algorithm_max_long'] < 200){
                    $score_array =array('8.3','8.4','8.5');
                    $score = array_rand($score_array,2);
                }elseif($v['order_algorithm_max_long'] >= 200 && $v['order_algorithm_max_long'] < 300){
                    $score_array =array('8.6','8.7','8.8');
                    $score = array_rand($score_array,2);
                }elseif($v['order_algorithm_max_long'] >= 300 && $v['order_algorithm_max_long'] < 400){
                    $score_array =array('8.9','9.0','9.1','9.2');
                    $score = array_rand($score_array,2);
                }elseif($v['order_algorithm_max_long'] >= 400 && $v['order_algorithm_max_long'] < 500){
                    $score_array =array('9.3','9.4','9.5','9.6','9.7');
                    $score = array_rand($score_array,2);
                }else{
                    $score_array =array('9.8','9.9','10.0');
                    $score = array_rand($score_array,2);
                }
                $score = $score_array[$score[0]];
                $foradminlist[$j]['score'] = $score;
                
                $foradminlist[$j]['goods_id'] = $v['goods_id'];
                $foradminlist[$j]['new_comment'] = cutstr(strip_tags($v['desc_5']),350);
                $foradminlist[$j]['subject'] = $v['title'];
            }
        }
    }
    
   
	//字符集转换
	foreach ($foradminlist as $k=>$item){
		foreach($item as $k2=>$v){
			$foradminlist[$k][$k2] = diconv($v, "GBK", "UTF-8");
		}
	}
    //数组按照score来排序
    foreach($foradminlist as $k=>$v){
        $arr1[$k] = $v['score'];
    }
    array_multisort($arr1, SORT_DESC,$foradminlist);
    
	$returndata = json_encode(array(
		'title' => diconv(str_replace(array(" - {$_G['setting']['bbname']}"," -  {$_G['setting']['bbname']}"," -{$_G['setting']['bbname']}","- {$_G['setting']['bbname']}","-{$_G['setting']['bbname']}"), array('','','','',''), $pageTitle), "GBK", "UTF-8"),
		'mod' => $mod,
		'data' => $foradminlist
	));
	echo $returndata;exit();
}
