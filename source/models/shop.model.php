<?php

/**
 * @author Ghl
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'dianpingmod.model.php';
Class ShopModel extends DianpingmodModel{
	var $table = 'dianping_shop_info';
	var $prikey = 'id';
	var $alias = 'st';
	var $_moduleid = 'shop';
	var $_vars = array(
		'sid' => 'id',
		'tid' => 'tid',
		'name' => 'subject',
		'pic' => 'showimg',
		'pro' => 'provinceid',
		'reg' => 'regionid',
		'address' => 'addr',
		'shop' => 'marketid',
		'sb' => 'sbrandid',
		'cb' => 'cbrandid',
		'link' => 'tel',
		'longi' => 'lon',		
		'lati' => 'lat',
		'score' => 'score',
		'enable' => 'ispublish',		
		'serverid' => 'serverid',
		'num' => 'cnum',	
		'spid' => 'sPid',
		'lastrate' => 'lastrate',
		'lastscore' => 'lastscore',
		'dir' => 'dir',	
		'dateline' => 'dateline',
		'lastpost' => 'lastpost',
		'displayorder' => 'displayorder',
	);
	
	/***
	 *	��ѯ�����еĵ���
	 */
	public function getRegionListbyshop($cb=null,$sb=null){
		$where = '';
		if($cb){
			$where.= ' and cbrandid='.$cb;
		}
		if($sb){
			$where.= ' and sbrandid='.$sb;
		}	
		$arr_pro = $array = array();
		$arr_pro = $this->find(array("fields" => "count(*) as count,provinceid","conditions" => "ispublish=1 $where group by provinceid"));
		if (is_array($arr_pro)) {
			foreach ($arr_pro as $v) {
				if($v['provinceid']){
					$region = m('shopregion');
					$cbs = $region->get(array('fields'=>'*','conditions'=>"catid = $v[provinceid] limit 1"));
					$v['name'] = $cbs['name'];
					$v['catid'] = $cbs['catid'];
					$array[] = $v;			
				}				
			}
		}	
		return $array;		
	}	
	/***
	 * ��ѯ���������ĳ���
	 */
	public function getRegionlist($pro=0,$cb=0,$sb=0){		
		$where = '';
		if($pro){
			$where.= ' and provinceid='.$pro;
		}
		if($cb){
			$where.= ' and cbrandid='.$cb;
		}
		if($sb){
			$where.= ' and sbrandid='.$sb;
		}
		$arr_city = $arr_str = $array = array();
		$arr_city = $this->find(array("fields" => "distinct(regionid)","conditions" => "ispublish=1 $where","order" => "regionid DESC"));	
		if (is_array($arr_city)) {
			foreach ($arr_city as $v) {
				$array[] = $v['regionid'];			
			}
		}	
		$str=implode(',',$array);		
		if($str){		
			$region = m('shopregion');
			$arr_str = $region->find(array('fields'=>'*','conditions'=>"catid in ($str)"));
			return $arr_str;	
		}		
	}
	/**
	 * �ж��Ƿ�ֱߵ�
	 */
	public function isJiebian($pro=null,$reg=null){
		$where = '';
		if($pro){
			$where = ' and provinceid='.$pro;
			if($reg){
				$where.=' and regionid='.$reg;
			}
			$arr_jie = array();
			$arr_jie = $this->find(array("fields" => "distinct(marketid)","conditions" => "ispublish=1 $where","order" => "marketid DESC"));	
			if (is_array($arr_jie)) {
				foreach ($arr_jie as $v) {
					if($v['marketid']==0){
						return true;
					}		
				}
			}					
			return false;			
		}		
	}
	/**
	 * ��ȡ�̳�����
	 */
	public function getMarketList($pro=null,$reg=null){
		if($pro){
			$where = ' and provinceid='.$pro;
			if($reg){
				$where.=' and regionid='.$reg;
			}
			$arr_market = $arr_str = $array = array();
			$arr_market = $this->find(array("fields" => "distinct(marketid)","conditions" => "ispublish=1 $where","order" => "marketid DESC"));	
			if (is_array($arr_market)) {
				foreach ($arr_market as $v) {
					$array[] = $v['marketid'];		
				}
			}			
			$str=implode(',',$array);
			if($str){
				$market = m('shopmarket');
				$arr_str = $market->find(array('fields'=>'*','conditions'=>" id in ($str)"));
				return $arr_str;
			}	
		}		
	}
	/**
	 * �������Ʒ��
	 */
	public function getChainList($pro=null,$reg=null,$sshop=null){
		$where = '';
		if($pro){
			$where = ' and provinceid='.$pro;
			if($reg){
				$where.=' and regionid='.$reg;
			}
			if($sshop){
				$where.=' and marketid>='.$sshop;
			}			
		}
		$arr_chain = $array = array();		
		$arr_chain = $this->find(array("fields" => "count(*) as count,cbrandid","conditions" => "ispublish=1 $where group by cbrandid"));	
		if (is_array($arr_chain)) {
			foreach ($arr_chain as $v) {
				if($v['cbrandid']){
					$cbrand = m('shopcbrand');
					$cb = $cbrand->get(array('fields'=>'*','conditions'=>"id = $v[cbrandid] limit 1"));
					$v['chainbrand'] = $cb['chainbrand'];
					$v['id'] = $cb['id'];
					$array[] = $v;			
				}	
			}
			return $array;
		}			
	}
	/***
	 * ��þ�ӪƷ��
	 */
	public function getBrandList($pro=null,$reg=null,$sshop=null){
		$where = '';
		if($pro){
			$where = ' and provinceid='.$pro;
			if($reg){
				$where.=' and regionid='.$reg;
			}
			if($sshop){
				$where.=' and marketid>='.$sshop;
			}			
		}
		$arr_brand = $array = array();
		$arr_brand = $this->find(array("fields" => "count(*) as count,sbrandid","conditions" => "ispublish=1 $where group by sbrandid"));
		if (is_array($arr_brand)) {
			foreach ($arr_brand as $v) {
				if($v['sbrandid']){
					$brand = m('shopbrand');
					$cb = $brand->get(array('fields'=>'*','conditions'=>"id = $v[sbrandid] limit 1"));
					$v['brand'] = $cb['brand'];
					$v['id'] = $cb['id'];
					$array[] = $v;			
				}	
			}
			return $array;
		}	
	}
	/**
	 * ��ȡ���е���
	 */
	public function getAllMarket() {
		$market = m('shopmarket');
		$arr_market_all = $market->find(array('fields'=>'*'));
		return $arr_market_all;
	}
	/***
	 *  ���ݵ�����Ų��ҵ�������
	 */
	public function getRegionById($id){
		if($id){
			$region = m('shopregion');
			$arr_region = $region->get(array('fields'=>'*','conditions'=>"catid = $id limit 1"));
			return $arr_region;
		}	
	}
	/***
	 * ����רӪƷ�Ʊ�Ų�ѯרӪ����
	 */
	public function getSbrandById($id){
		if($id){
			$sb = m('shopbrand');
			$arr_sb = $sb->get(array('fields'=>'*','conditions'=>"id = $id limit 1"));
			return $arr_sb;
		}	
	}
	/***
	 *  �����̳����Ų�ѯ�̳�������
	 */
	public function getMarketById($id){
		if($id){
			$market = m('shopmarket');
			$arr_market = $market->get(array('fields'=>'*','conditions'=>"id = $id limit 1"));
			return $arr_market;
		}	
	}
	/***
	 * ��������Ʒ�Ʋ�ѯ����Ʒ������
	 */
	public function getChainBrandById($id){
		if($id){
			$cb = m('shopcbrand');
			$arr_cb = $cb->get(array('fields'=>'*','conditions'=>"id = $id limit 1"));
			return $arr_cb;
		}	
	}
	/***
	 * ���ݵ��̵ľ�γ�Ȼ�ȡ��ǰ���̸����ĵ���Ϣ
	 */
	public function getShopNearbyjw($long,$lat,$tid){		
		if($long&&$lat&&$tid){
			$longup = $long + 0.001;
			$longdown = $long -0.01;
			$latup = $lat + 0.01;
			$latdown = $lat - 0.01;		
			$arr=array();
			$sql = "SELECT * FROM ".DB::table('dianping_shop_info')." as i LEFT JOIN ".DB::table('forum_thread')." as t on i.tid = t.tid WHERE i.ispublish=1 and (i.lon BETWEEN '$longdown' and '$longup') and (i.lat between '$latdown' and '$latup') and i.tid not in($tid) order by i.tid asc limit 4 " . getSlaveID();
			$query = DB::query($sql);							
			while ($row = DB::fetch($query)) {			
				$arr[] = $row;			
			}	
			return $arr;				
		}
	}	
	/***
	 * �����̳������Ʋ��Ҹ��̳���������������
	 */
	public function getsShopListbyShop($sregion,$sShop,$tid){
		if($sregion&&$sShop&&$tid){
            $array = array();
			$array = $this->find(array("fields" => "*","conditions" => "ispublish=1 and regionid='$sregion' and marketid='$sShop' and tid<>$tid","order" => "score DESC",'limit'=>'4'));
			return $array;	
		}
	}
	/***
	 *  ���ݵ��̵���������Ʒ�Ʋ��Ҹõ�������������
	 */
	public function getShopcBrandbysBrand($sprovince,$cbrand,$tid){
		if($sprovince&&$cbrand&&$tid){		
            $array = array();
			$array = $this->find(array("fields" => "*","conditions" => "ispublish=1 and provinceid='$sprovince' and cbrandid='$cbrand' and tid<>$tid","order" => "score DESC",'limit'=>'4'));
			return $array;
		}		
	}
	/***
	 * ��õ��̵ľ�ӪƷ����Ϣ
	 */
	public function getBrandAll(){
		$arr_list = $arr_brand = $array = array();
		$arr_brand = $this->find(array("fields" => "count(*) as count,sbrandid","conditions" => "1 group by sbrandid"));
		if (is_array($arr_brand)) {
			foreach ($arr_brand as $v) {
				$array[$v['sbrandid']]= $v['count'];
			}
		}
		$brand = m('shopbrand');
		$sb = $brand->find(array('fields'=>'*'));
		if (is_array($sb)) {
			foreach ($sb as $k) {
				$k['count']=$array[$k['id']]? $array[$k['id']]:0;
				$arr_list[] = $k;
			}
		}
		return $arr_list;
			
	}
	/****
	 *  ��õ��̵�����Ʒ��
	 */
	public function getChainAll (){
		$arr_list = $arr_brand = $array = array();
		$arr_chain = $this->find(array("fields" => "count(*) as count,cbrandid","conditions" => "1 group by cbrandid"));
		if (is_array($arr_chain)) {
			foreach ($arr_chain as $v) {
				$array[$v['cbrandid']]= $v['count'];
			}
		}
		$cbrand = m('shopcbrand');
		$cb = $cbrand->find(array('fields'=>'*'));
		if (is_array($cb)) {
			foreach ($cb as $k) {
				$k['count']=$array[$k['id']]? $array[$k['id']]:0;
				$k['cbrand']=$k['chainbrand'];
				$arr_list[] = $k;
			}
		}
		return $arr_list;
			
	}
	/**
	 * ajax ���ݳ��л�ȡ�̳�
	 */
	public function ajaxGetMarketModel($reg) {	
		$arr_market = $array = array();
		$arr_market = $this->find(array("fields" => "distinct(marketid)","conditions" => "regionid = '$reg' and marketid!=0 and ispublish =1 group by marketid limit 5"));
		if (is_array($arr_market)) {
			foreach ($arr_market as $v) {
				if($v['marketid']){
					$market = m('shopmarket');
					$cbs = $market->get(array('fields'=>'*','conditions'=>"id = $v[marketid] limit 1"));
					$v['id'] = $cbs['id'];
					$v['marketid'] = $cbs['market'];
					$array[] = $v;			
				}				
			}
		}	
		return $array;		
	}
	/**
	 * �ж��̳��Ƿ��Ѿ����ڣ�����ڷ���ID�������������̳��󷵻���ID
	 */
	public function getShopId($market) {
		$m = m('shopmarket');
		$arr_market = $m->get(array('fields'=>'*','conditions'=>"market = '$market' limit 1"));
		if ($arr_market) {
			return $arr_market['id'];
		} else {
			$insert_id = $m->add(array('market' => $market));
			return $insert_id;
		}		
	}
	/**
	 * �ж�Ʒ���Ƿ��Ѿ����ڣ�����ڷ���ID������������Ʒ�ƺ󷵻���ID
	 */
	public function getBrandId($brand) {
		$s = m('shopbrand');
		$arr_brand = $s->get(array('fields'=>'*','conditions'=>"brand = '$brand' limit 1"));
		if ($arr_brand) {
			return $arr_brand['id'];
		} else {
			$insert_id = $s->add(array('brand' => $brand));
			return $insert_id;
		}		
	}
	/**
	 * �ж�����Ʒ���Ƿ��Ѿ����ڣ�����ڷ���ID����������������Ʒ�ƺ󷵻���ID
	 */
	public function getChainId($chain) {
		$c = m('shopcbrand');
		$arr_chain = $c->get(array('fields'=>'*','conditions'=>"chainbrand = '$chain' limit 1"));
		if ($arr_chain) {
			return $arr_chain['id'];
		} else {
			$insert_id = $c->add(array('chainbrand' => $chain));
			return $insert_id;
		}		
	}
	/**
	 * ���ύ�����ݽ��д��������������ݣ��˴��������������������(dianpinmod�еķ����޸�)
	 * @param array() �ύ������
	 * @return Array
	 */
	function postdataHandle($postdata){
		foreach($this->_vars as $_k => $_v){
			if ($postdata[$_k] != '') {
				$return[$_v] = $postdata[$_k];
			}
        }
        return $return;
	}
	/**
	 * �滻����Ʒ�����Ƶ�����ΪƷ������
	 */
	public function parseBrandUrl($content) {
		//shop_brand_parseurlΪ���л�������	array('search'=>array('Ʒ����',...), 'replace'=>array('Ʒ�ƶ�Ӧ��URL',...))
		$brand_parseurl = memory('get', 'shop_brand_parseurl');
		if($brand_parseurl) {
			$brand_parseurl = unserialize($brand_parseurl);
			$content  = str_replace($brand_parseurl['search'], $brand_parseurl['replace'],$content);
		} else {
			//��Ʒ����Ϣ���滻��Ϣ����
			$brand = m('shopbrand');
			$sb = $brand->find(array('fields'=>'*'));
			$brand_parseurl = '';
			foreach ($sb as $v) {
				$brand_parseurl['search'][$v['id']] = $v['brand'];
				$brand_parseurl['replace'][$v['id']] = '<a href="http://www.8264.com/dianpu-0-0-0-0-'.$v['id'].'-3-1" target="_blank" title="�鿴����'.$v['brand'].'����">'.$v['brand'].'</a>';
			}

			memory('set', 'shop_brand_parseurl', serialize($brand_parseurl), 864000);
			$content  = str_replace($brand_parseurl['search'], $brand_parseurl['replace'],$content);
		}
		return $content;
	}

}

?>