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
			// һ����¼��Ӧһ��post lxp 20130924
			'has_post' => array(
				'model' => 'forum_post',
				'type'  => HAS_ONE,
				'refer_key' => 'pid',
				'foreign_key' => 'pid'
			)
	);
	/**
	 * ��ȡ�û��Դ���Ʒ�Ĵ�ַ���
	 * @access public
	 * @param Int $uid �û�ID
	 * @param Int $tid ��ƷID
	 * @param String $type ����
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
	
	
	//����û����
	function getRatebypid($uid, $pid){		
		if($pid&&$uid){
			return $this->get(array('index_key' => 'uid', 'conditions' => "{$this->alias}.pid = {$pid} AND {$this->alias}.uid = {$uid} AND {$this->alias}.enable = 1"));
		}else{
		    return 0;
		}		
	}
	/**
	 * �õ���Ʒ��Ӧ������id
	 * @access private
	 * @param Int $typeid ����ID
	 * @param String $type ����
	 * @return Int
	 */
	function _getStarid($typeid, $type = 'forum'){
		$mod_star_statistics = m('dianpingshow');
		$starid = $mod_star_statistics->getData($typeid, 'this.id', $type);
		if($starid){
			return $starid['id'];
		}else{
			//$staridû�У���˵��plugin_star_statistics��ȱ�ٴ������ݣ�����
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
	 * �õ�ĳ��Ʒ����������
	 * @access public
	 * @param Int $typeid ����ID
	 * @param String $type ����
	 * @return Array
	 */
	function getAllRate($tid, $type = 'forum'){
		$starid = $this->_getStarid($tid, $type);
		return $this->findAll(array('index_key' => 'pid', 'conditions' => "{$this->alias}.starid = {$starid}"));
	}
	
	/**
	 * ɾ��һ������(ע��η���ֻ��ɾ��һ����Ʒ�ڵĶ���������������ɾ����ͬ��Ʒ�ڵĲ�ͬ������������Ϊ��Ӧstarid => ���������ɾ�������ͬ��Ʒ�Ĳ�ͬ����������staridȥ������������ȥ��ѯ��Ӧ����Ʒtid��fid����ȥ����Ӧ����Ʒ��ȥ������ֵ)
	 * @param mixed $pid ����pid��pid������
	 * @param boolean $delpost �Ƿ�ȥp��ɾ��p�������
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
				//ɾ���û���̬
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
	 * ��������
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