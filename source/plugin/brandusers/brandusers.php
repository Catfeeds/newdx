<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class BrandUsers {
    function getProducts() {
        $products = array();
        $option = DB::fetch_first("SELECT * FROM ".DB::table('forum_typeoption')." WHERE optionid = 105");
        
        $rules = unserialize($option['rules']);
        preg_match_all('/(\d+)=(.+)(?:\s+|$)/', $rules['choices'], $m);
        foreach($m[1] as $i => $item) {
            $products[$item] = $m[2][$i];
        }
        return $products;
    }
    
    function getProductsByTid($tid) {
        $products = array();
        if (!$tid) {
            return $products;
        }        
        $option = DB::fetch_first("SELECT brand_chanpin FROM ".DB::table('forum_optionvalue14')." WHERE tid = $tid");
        $product_ids = $option['brand_chanpin'];
        $product_ids = preg_split('/\s+/', $product_ids);
        
        $all_products = self::getProducts();
        foreach ($product_ids as $id) {
            $products[$id] = $all_products[$id];
        }
        return $products;
    }
	//ÐÂ·½·¨
	function getProductsByTidinNew($tid) {
		$products = array();
        if (!$tid) {
            return $products;
        }
		$brand = DB::fetch_first("SELECT ranklist FROM ".DB::table('dianping_brand_info')." WHERE tid = $tid");		
		$query = DB::query("select * from ".DB::table('plugin_brand_produce')." where id in (".$brand['ranklist'].")");
		while ($value = DB::fetch($query)) {
			$products[$value['id']] = $value['produce'];
		}
		return $products;			
	}   
    
}