<?php

/**
 * @author JiangHong
 * @copyright 2013
 */

if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

Class DianpingModel extends BaseModel{
	var $table = 'dianping_star_logs';
	var $alias = 'sl';
	var $prikey = 'starid, uid';
	var $t_lastprice = 0;
	var $_relation = array(
			// 一条记录对应一条post lxp 20130924
			'has_post' => array(
				'model' => 'forum_post',
				'type'  => HAS_ONE,
				'refer_key' => 'pid',
				'foreign_key' => 'pid'
			)
	);
	/**
	 * 读取用户对此商品的打分分数
	 * @access public
	 * @param Int $uid 用户ID
	 * @param Int $tid 商品ID
	 * @param String $type 类型
	 * @return Array
	 */
	function getMyRate($uid, $tid, $type = 'forum'){
		$starid = $this->_getStarid($tid, $type);
		if($starid&&$uid){
			return $this->get(array('index_key' => 'uid', 'conditions' => "{$this->alias}.starid = {$starid} AND {$this->alias}.uid = {$uid}"));
		}else{
		    return 0;
		}		
	}
	
	
	//获得用户打分
	function getRatebypid($uid, $pid){		
		if($pid&&$uid){
			return $this->get(array('index_key' => 'uid', 'conditions' => "{$this->alias}.pid = {$pid} AND {$this->alias}.uid = {$uid} AND {$this->alias}.enable = 1"));
		}else{
		    return 0;
		}		
	}
	/**
	 * 得到商品对应的主键id
	 * @access private
	 * @param Int $typeid 类型ID
	 * @param String $type 类型
	 * @return Int
	 */
	function _getStarid($typeid, $type = 'forum'){
		$mod_star_statistics = m('dianpingshow');
		$starid = $mod_star_statistics->getData($typeid, 'this.id', $type);
		if($starid){
			return $starid['id'];
		}else{
			//$starid没有，则说明plugin_star_statistics里缺少此条数据，加上
			if ($type == "forum") {
				$mdForumPost = m("forum_post");				
				$forumPostList = $mdForumPost->find(array("fields"=>"pid,fid", "conditions"=>"tid={$typeid}", "order"=>"dateline desc"));
				$pids = array_keys($forumPostList);
				$fid  = $forumPostList[$pids[0]]["fid"];
				$pids = implode(",", $pids);		
				$starid = $mod_star_statistics->add(array('type' => 'forum', 'typeid' => $typeid, 'fid' => $fid));
				$this->edit("pid in ($pids)", array('starid' => $starid));
				
				return $starid;
			}
			return null;
		}
		
	}
	/**
	 * 得到某商品的所有评分
	 * @access public
	 * @param Int $typeid 类型ID
	 * @param String $type 类型
	 * @return Array
	 */
	function getAllRate($tid, $type = 'forum'){
		$starid = $this->_getStarid($tid, $type);
		return $this->findAll(array('index_key' => 'pid', 'conditions' => "{$this->alias}.starid = {$starid}"));
	}
	
	/**
	 * 删除一条点评(注意次方法只能删除一个商品内的多条点评，不可以删除不同商品内的不同个点评。返回为对应starid => 分数，如果删除多个不同商品的不同点评，请用starid去点评分数表内去查询对应的商品tid，fid，再去查相应的商品表去更新数值)
	 * @param mixed $pid 传入pid或pid的数组
	 * @param boolean $delpost 是否去p表删除p表的数据
	 * @return void
	 */
	function delStar($pid, $delpost = true){
		$condition = '';
		$starid_arr = array();
		if(is_array($pid)){
			$condition = ' IN ('.implode(',', $pid).')';
		}else{
			$pid = intval($pid);
			if($pid > 0){$condition = ' = '.$pid;}
		}
		if($condition){
			$_tmp = $this->find(array('fields' => 'starid', 'conditions' => "pid {$condition}"),false);
			if($_tmp){
				foreach($_tmp as $v){
					! in_array($starid_arr) && $starid_arr[] = $v['starid'];
				}
				$this->drop("pid {$condition}");
				$supportmod = m('dianpingsupport');
				$supportmod->drop("pid {$condition}");
				if($delpost){
					require_once libfile('function/delete');
					deletepost("pid {$condition}");
				//删除用户动态
					require_once libfile('function/feed');
					if(is_array($pid)){
						foreach ($pid as $value) {
							deletefeed('', 'dianping', $value);
						}
					}else{
						deletefeed('', 'dianping', $pid);
					}
				}
				foreach($starid_arr as $sid){
					$score = $this->updateStar($sid);
					$score && $scores[$sid] = $score;
				}
				return count($scores) > 1 ? $scores : $score;
			}else{
				return NULL;				
			}			
		}
		return NULL;
	}

	/**
	 * 更新评分
	 * 
	 * @author lxp 20130910
	 * @param int $starid
	 */
	function updateStar($starid){
		
		$countArray = $this->find(array(
				'fields' => 'starnum, COUNT(starnum) AS c',
				'conditions' => "starid = {$starid} GROUP BY starnum",
				'index_key' => 'starnum'
		));
		if(is_array($countArray)){
			$count = intval($countArray[1]['c'])+intval($countArray[2]['c'])+intval($countArray[3]['c'])+intval($countArray[4]['c'])+intval($countArray[5]['c']);
			
			$p1 = $this->_round(intval($countArray[1]['c']) / $count * 100, 1);
			$p2 = $this->_round(intval($countArray[2]['c']) / $count * 100, 1);
			$p3 = $this->_round(intval($countArray[3]['c']) / $count * 100, 1);
			$p4 = $this->_round(intval($countArray[4]['c']) / $count * 100, 1);
			$p5 = $this->_round(intval($countArray[5]['c']) / $count * 100, 1);
			$price = $this->_round($p5 / 100 * 10 + $p4 / 100 * 8 + $p3 / 100 * 6 + $p2 / 100 * 4 + $p1 / 100 * 2, 1);

			$mod_star_statistics = m('dianpingshow');
			$nowdata = $mod_star_statistics->get($starid);
			$editarr = array(
					'percent1' => $p1,
					'percent2' => $p2,
					'percent3' => $p3,
					'percent4' => $p4,
					'percent5' => $p5,
					'count' => $count,
					'price' => $price
			);
			if((time() - $nowdata['lasttime']) >= 7*24*3600){
				$editarr['lasttime'] = time();
				$editarr['lastprice'] = $price;
			}
			if($nowdata['lastprice'] != $price){
				$editarr['lastchange'] = $nowdata['lastprice'] > $price ? -1 : 1;
			}else{
				$editarr['lastchange'] = 0;
			}
			if($nowdata['fid'] == 0){
				$editarr['fid'] = DB::result_first("SELECT fid FROM " . DB::table('forum_thread') . " WHERE tid = {$nowdata['typeid']}");
			}
			$this->t_lastprice = $editarr['lastprice'];
			$mod_star_statistics->edit("id = {$starid}", $editarr);
			return $price;
		}
		return 0;
	}
	private function _round($num, $precision) {
		$num = round($num, $precision);
		if (preg_match('/^\d+$/', $num)) {
			$num = $num.'.'.str_repeat('0', $precision);
		} elseif (preg_match('/^\d+\.(\d+)$/', $num, $m)) {
			$num = $num.str_repeat('0', $precision-$m[1]);
		}
		return $num;
	}
}
?>