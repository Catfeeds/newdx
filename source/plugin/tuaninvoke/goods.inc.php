<?php

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class TuanInvokeGoods {
	function arrayToString($value) {
		$str = 'array(';
		foreach ($value as $i => $item) {
			if (!is_numeric($i)) {
				$_i = "'$i'";
			} else {
				$_i = $i;
			}
			if (is_array($item)) {
				$str .= "$_i=>".self::arrayToString($item).',';
			} elseif (is_numeric($item)) {
				$str .= "$_i=>$item,";
			} else {
				$instr = addcslashes($item, "\\'");
				$str .= "$_i=>'".$instr."',";
			}
		}
		$str .= ')';
		
		return $str;
	}
	
	function add_data(&$goods_data, $ival, $value, $index) {
		$goods_num = count($index[$ival]);
		
		for ($i = 0; $i < $goods_num; ++$i) {
			$goods_data[$i][$ival] = iconv("UTF-8", "gb2312", $value[$index[$ival][$i]]['value']);
		}
	}
	
	function reload_goods_data() {
		$url = "http://www.lvyoumall.com/api/uc.php?app=groups";
		$xml_string = file_get_contents($url);		
		$result = json_decode($xml_string,true);			
		if($result['status']=='success'){			
			$goods_data = array();
			$goods_num = count($result['groups_info']);
			foreach ($result['groups_info'] as $key=>$item) {
				$goods_data[$key]['group_id'] = $item['group_id'];
				$goods_data[$key]['group_title'] = iconv("UTF-8", "gb2312",$item['group_title']);
				$goods_data[$key]['market_price'] = $item['market_price'];
				$goods_data[$key]['image_url'] = $item['image_url'];
				$goods_data[$key]['price'] = $item['price'];
			}
			return $goods_data;			
		}		
		return $goods_data;
	}
	
	static function load_goods_data() {
		global $_G;
		static $isfilecache, $allowmem;
        $cache_path = DISCUZ_ROOT."/data/cache/plugin_tuaninvoke_goods.php";
		$cur_time = time();
		$goods_data = array();
		//增加memcache缓存判断 modify by wangqi 20121011
		if($isfilecache === null) {
			$isfilecache = getglobal('config/cache/type') == 'file';
			$allowmem = memory('check');
		}
		if ($allowmem){
			$goods_data = memory('get', 'cache_tuaninvoke');
			if(!empty($goods_data)) return $goods_data;
		}
		if ($isfilecache && empty($goods_data)){
			if (file_exists($cache_path)) {
				$goods_data = include($cache_path);
				if ($cur_time - 10800 < $goods_data['timeline']) {
					unset($goods_data['timeline']);
					return $goods_data;
				}
			}
		}

		$goods_data = self::reload_goods_data();
		if (!$goods_data) {
			return null;
		}
		$allowmem && (memory('set', 'cache_tuaninvoke', $goods_data, 10800));
		if ($isfilecache){
			$goods_data['timeline'] = $cur_time;
			$goods_data_string = "<?php\nreturn ".self::arrayToString($goods_data).";";
			if($fp = @fopen($cache_path, 'wb')) {
				fwrite($fp, $goods_data_string);
				fclose($fp);
			}
			unset($goods_data['timeline']);
		}
		//end
		return $goods_data;
	}
	
	static function reload_data() {
		global $_G;
		static $isfilecache, $allowmem;
        $cache_path = DISCUZ_ROOT."/data/cache/plugin_tuaninvoke_goods.php";
		$cur_time = time();
		$goods_data = array();
		//增加memcache缓存判断 modify by wangqi 20121011
		if($isfilecache === null) {
			$isfilecache = getglobal('config/cache/type') == 'file';
			$allowmem = memory('check');
		}

		$goods_data = self::reload_goods_data();
		if (!$goods_data) {
			return null;
		}
		$allowmem && (memory('set', 'cache_tuaninvoke', $goods_data, 10800));
		if ($isfilecache){
			$goods_data['timeline'] = $cur_time;
			$goods_data_string = "<?php\nreturn ".self::arrayToString($goods_data).";";
			if($fp = @fopen($cache_path, 'wb')) {
				fwrite($fp, $goods_data_string);
				fclose($fp);
			}
			unset($goods_data['timeline']);
		}
		//end
		return $goods_data;
	}
}

if ($_GET['reload'] == 1){
	TuanInvokeGoods::reload_data();
}
$goods_data = TuanInvokeGoods::load_goods_data();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>今日团购</title>
<link href="/source/plugin/tuaninvoke/statics/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
</script>
</head>
<body>
<div class="tuan">
	<div class="tuantitle"><h1>今日团购</h1><a href="http://www.lvyoumall.com/tuan/" target="_blank">更多&gt;&gt;</a><div class="clear"></div></div>
    <div class="tuanmid">
    	<?php foreach ($goods_data as $item) { ?>
        <div class="tuanone">
        	<div class="tuanimg"><a href="http://www.lvyoumall.com/tuan/goods-<?php echo $item['group_id']; ?>" target="_blank"><img src="http://www.lvyoumall.com/<?php echo $item['image_url']; ?>"/></a></div>
            <div class="tuanname"><a href="http://www.lvyoumall.com/tuan/goods-<?php echo $item['group_id']; ?>" target="_blank"><?php echo $item['group_title']; ?></a></div>
            <div class="tuanwen"><span>原价：￥<?php echo $item['market_price']; ?></span>&nbsp;&nbsp;<b>现价：￥<?php echo $item['price']; ?></b></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript">
;(function($){	
    function tuanresize_style() {
        var width = 177;
        var max_width = $('body').width() - 2;
        var item_num = parseInt(max_width / width);
        var item_margin = parseInt((max_width % width) / (item_num + 1) / 2);
        var padding_left = item_margin;
        $('.tuanmid').css({'padding-left': padding_left+'px'});
        $('.tuanmid > div').css({'margin-left':item_margin+'px', 'margin-right':item_margin+'px'});
    }
    $(window).resize(tuanresize_style);
    tuanresize_style();
})(jQuery);
</script>
</body>
</html>