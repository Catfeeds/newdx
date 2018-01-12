<?php
/**
 * �˽ű�������ָ�������·���json����,������[��̨->����->�񵥹���->������Ӱ�]���ܣ����[������Ӱ�]�����Ѿ����ã����ļ�����ע�����ã��ʹ˹�����صĻ���һ���ƻ�����cron_bangdan.php
 * @author gtl 20160302
 */
if($_G['gp_ajaxfrom'] == 'admin'){ //������Դ�ں�̨���ж�;

	//ɸѡ�����ֵ�item
	$foradminlist = array();
	foreach ($modlist as $key => $item) {
		if($item['score']>0) $foradminlist[$key] = $item;
	}
    if($mod == 'line'){
        //��ȡ2��
        $foradminlist = @array_slice($foradminlist, 0, 2);
        if(count($foradminlist)<2){ //����2�����Ϳ�����
            echo json_encode(array());
            exit();
            
        }
    }else{
        //��ȡ10��
        $foradminlist = @array_slice($foradminlist, 0, 10);
        if(count($foradminlist)<10){ //����10�����Ϳ�����
            echo json_encode(array());
            exit();
        }
    }
	
	
	//�����ȷ���������趨
	$curryear = date("Y");
    //�·ݲ���0
    $currmonth = date("n");
	switch($mod){
		case 'equipment':
			switch ($order) {
				case 'heats':
					$ordertitle = '�����ŵ�';
					break;
				case 'score':
					$ordertitle = '�ڱ���õ�';
					break;
			}
			if ($max && !$min) {
				$pricetitle = $max . 'Ԫ����';
			}elseif ($min && !$max) {
				$pricetitle = $min . 'Ԫ����';
			}elseif ($min && $max) {
				$pricetitle = "{$min}~{$max}Ԫ";
			}
			if ($bid) $brandtitle = $brandlist[$bid]['subject'];
			if ($pcid && !$cid) $typetitle = $category[$pcid]['name'];
			if ($pcid && $cid) $typetitle = $category[$pcid]['child'][$cid];
			$pageTitle = "{$curryear}��{$ordertitle}{$pricetitle}{$brandtitle}����{$typetitle}�Ƽ����а�";
			break;
		case  'line':
			switch ($order) {
				case 'heats':
					$ordertitle = "�����ŵ�";
					break;
				case 'score':
					$ordertitle = "�ڱ���õ�";
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
				$titmetitle = "��{$cate_timetype[$timetype]}��";	
			}
            
			$pageTitle = "{$curryear}��{$currmonth}��{$provincetitle}{$citytitle}{$ordertitle}{$typetitle}����������·�Ƽ����а�{$titmetitle}";
			break;
		case 'brand':
			switch ($order) {
				case 'heats':
					$ordertitle = "�����ŵ�";
					break;
				case 'score':
					$ordertitle = "�ڱ���õ�";
					break;
			}
			if (!empty($nat)) {
				$nattitle = $dp_category['brand']['region'][$nat];
			}
			$pageTitle = "{$curryear}��{$ordertitle}{$nattitle}����Ʒ���Ƽ����а�";
			if (!empty($cp)) {
				$pageTitle = "{$curryear}��{$ordertitle}{$nattitle}{$dp_category['brand']['ranklist'][$cp]}";
			}
			break;
		case  'shop':
			//δ�涨
			break;
		case  'climb':
			switch ($order) {
				case 'heats':
					$ordertitle = "�����ŵ�";
					break;
				case 'score':
					$ordertitle = "�ڱ���õ�";
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
			$pageTitle = "{$curryear}��{$provincetitle}{$ordertitle}{$typetitle}����{$placetitle}�Ƽ����а�";
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

	//��������
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
			$foradminlist[$key]['new_comment'] = "������<a href='home.php?mod=space&uid={$row['authorid']}' class='namemorelink'>@{$row['author']}</a>����" . $row['message'];
		}
	}
    if($mod == 'line'){
        //ͨ���ص��ȡ�������
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
        //ȡ3������
        if(!empty($huodonglist)){
            $huodonglist = @array_slice($huodonglist, 0, 3);
            //�������ӵ�foradminlist������
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
    
   
	//�ַ���ת��
	foreach ($foradminlist as $k=>$item){
		foreach($item as $k2=>$v){
			$foradminlist[$k][$k2] = diconv($v, "GBK", "UTF-8");
		}
	}
    //���鰴��score������
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
