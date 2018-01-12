<?php
/**
 * @author zhl
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'dianpingmod.model.php';
Class MountainModel extends DianpingmodModel{
	var $table = 'dianping_mountain_info';
	var $prikey = 'id';
	var $alias = 'pm';
	var $_moduleid = 'mountain';
	/*var $_vars = array(
		'pk' => 'id',
		'tid' => 'tid',
		'name' => 'mName',
		'type' => 'mType',
		'pic' => 'showimg',//
		'height' => 'mHeight',
		'region' => 'mRegion',
		'gdqj' => 'mAltitude',
		'lon' => 'mLong',
		'lat' => 'mLat',		
		'season' => 'mSeason',
		'enable' => 'isPublish',
		'orderby' => 'orderby',
		'serverid' => 'serverid',		
		'score' => 'score',
		'num' => 'cnum',
		'lastrate' => 'lastrate',
		'lastscore' => 'lastscore',	
	);*/
    var $_vars = array(
        'pk' => 'id',
        'tid' => 'tid',
        'name' => 'subject',
        'type' => 'type',
        'pic' => 'showimg',
        'height' => 'height',
        'region' => 'region',
        'gdqj' => 'altitude',
        'lon' => 'lon',
        'lat' => 'lat',
        'season' => 'season',
        'enable' => 'ispublish',
        'orderby' => 'displayorder',
        'serverid' => 'serverid',
        'score' => 'score',
        'num' => 'cnum',
        'lastrate' => 'lastrate',
        'lastscore' => 'lastscore',
        'lastpost' => 'lastpost',
        'posttime' => 'dateline',

    );
	
	var $gdqjlist	= array("6"=>"4000米以下","1"=>"4000-5000米","2"=>"5000-6000米","3"=>"6000-7000米","4"=>"7000-8000米","5"=>"8000米以上");
	var $dqlist	= array("405"=>"四川","406"=>"西藏","407"=>"云南","408"=>"青海","409"=>"新疆","410"=>"尼泊尔","411"=>"巴基斯坦","412"=>"其他");
	/*heats: order by the number of people give comments
	*newest: order by the lastest feedback to the mountain
	*score: 
	*/
	var $_order = array('heats' => 'num', 'newest' => 'tid', 'score' => 'score','lastpost'=>'lastpost');
	
	
	public function getRegions($catid = 0)
	{ 	
		
	}
	
	/**
	 * 返回view页面需要的变量
	 * @param Array $args 传入的所有$_GET参数
	 * @return Array
	 * @access private 
	 */
	function _viewPlugin($args){
		$data['listpro'] = !empty($args['type']) ? $this->getlist(array('where' => "{$this->alias}.{$this->_vars['type']} = {$args['type']} AND {$this->alias}.{$this->_vars['tid']} <> {$args[tid]}", 'limit' => $this->otherlimit, 'order' => array('heats' => 'DESC'))) : array();                                                                              
		
		!$args['sidelist_desc'] && $args['sidelist_desc'] = 'heats';
		$whereArgs = array(
				'where' => "{$this->alias}.{$this->_vars[tid]} <> {$args[tid]}",
				'order' => array($args['sidelist_desc'] => 'DESC'),
				'limit' => $this->otherlimit+2
		);
		$args['sidelist_desc'] == 'lastpost' && ($whereArgs = array_merge($whereArgs, array('where'=>"{$this->alias}.{$this->_vars['num']}>0")));
		$data['hotmore'] = $this->getlist($whereArgs);
		if(is_array($data['hotmore']) && count($data['hotmore']) == $this->otherlimit+2){
			foreach ($data['hotmore'] as $k => $v){
				if($v['tid'] == $args['tid']){
					unset($data['hotmore'][$k]);
				}
			}
			if(count($data['hotmore']) == $this->otherlimit+2){
				//array_pop($data['hotmore']);
			}
		}
		return $data;
	}

	public function getData($fields, $where, $order='heats', $desc, $start=0, $limit=30) {
		if(! $this->_order[$order]) return null;

		if(is_array($fields)) {
			$search_fields = array();
			foreach ($fields as $column) {
				$search_fields[] = $this->_vars[$column] ? "{$this->alias}.{$this->_vars[$column]} as $column" : "t.{$column}";
			}
		}
		$limit = $limit > 0 ? $limit : max($this->limit, 1);

		$search_str = implode(',', $search_fields);

		$order_str = '';
		foreach ((array)$order as $v) {
			$order_v = $this->_order[$v];
			if($this->_vars[$order_v]) {
				$order_str .= "{$this->alias}.{$this->_vars[$order_v]} {$desc}, ";
			}
			else {
				$order_str = "t.{$order_v} {$desc}, ";
			}
		}
		$order_str .=  "{$this->alias}.{$this->_vars['tid']} $desc";

		$sql = "SELECT {$search_str} FROM {$this->table} {$this->alias} inner join " . DB::table('forum_thread') .
				" t ON t.tid={$this->alias}.{$this->_vars['tid']} WHERE {$where} ORDER BY $order_str LIMIT {$start}, {$limit}";
		/*switch ($order) {
			case 'heats':
				$table = DB::table('plugin_star_statistics');
				$sql_heats = "SELECT typeid, count FROM {$table} WHERE sfid={$this->_fid} ORDER BY count {$desc}";
				$sql .= " LEFT JOIN ($sql_heats) stat ON stat.typeid={$this->alias}.{$this->_vars['tid']} WHERE {$where} ORDER BY stat.count {$desc} LIMIT {$start}, $limit";
				break;
			case 'newest':
				//$sql .= " WHERE {$where} ORDER BY  t.lastpost {$desc} LIMIT {$start}, {$limit}";
				//$table = DB::table('forum_post');
				$sql_newest = "SELECT tid, MAX(dateline) maxdateline FROM {$table} WHERE fid={$this->_fid} AND  first=0 AND invisible=0 GROUP BY tid";
				$sql .= " LEFT JOIN ($sql_newest) newest ON newest.tid={$this->alias}.{$this->_vars['tid']} WHERE {$where} ORDER BY newest.maxdateline {$desc} LIMIT {$start}, $limit";
				break;
			case 'score':
				$sql .= " WHERE {$where} ORDER BY {$this->alias}.{$this->_vars['score']} {$desc} LIMIT {$start}, {$limit}";
				break;
		}*/

		$query = DB::query($sql);
		$list = array();
		while ($row=DB::fetch($query)) {
			$row['picpath'] =  $this->_getFMDir($row).$row['pic'];
			$list[$row['tid']] = $row;
		}
		return $list;
		
	}
	/**
	 * 读取列表数据
	 * @param Array $params 查询的条件
	 * @param Int $enable 对商品的状态判断条件
	 */
	public function getlist($params = array(), $enable = 1)
	{
		$list = array();
		$rates = array();
		extract($params);
		$limit = $limit > 0 ? $limit : max($this->limit, 1);
		$enable = $this->getEnableCondition($enable);
		$start = max(intval($start), 0);
		/*此处先使用原先的静态DB，待以后帖子表的模型建立完善再修改*/
		$sql = "SELECT t.subject, t.replies, t.views,t.fid,t.displayorder,t.author,t.authorid, t.dateline ".$this->_getSelect().
		" FROM {$this->table} {$this->alias} LEFT JOIN ".DB::table('forum_thread')." t ON t.tid = {$this->alias}.{$this->_vars[tid]} " . getSlaveID();
		
		//线路的经过地域表pre_plugin_line_cross Lishuaiquan
		if (!empty($line["province"]) || !empty($line["city"])) {
			$mdLinecross = m('linecross');
			$sql .= " LEFT JOIN {$mdLinecross->table} {$mdLinecross->alias} ON {$mdLinecross->alias}.{$mdLinecross->_vars[tid]} = {$this->alias}.{$this->_vars[tid]}";			
		}
		
		$sql .= " WHERE t.fid = {$this->_fid} {$enable}";		
		/*$findparams = array(
			'limit' => "{$start},{$limit}",);
		$this->findAll($findparams);*/
		$where = empty($where) ? $enable : " AND ".$where;
		require_once libfile('function/forumlist');
		if(empty($order)){
			$order = " ORDER BY {$this->alias}.{$this->_vars['orderby']} DESC ";
		}elseif(is_array($order)){
			foreach($order as $_k => $_v){
				if(is_numeric($_k)){
					$_tmp .= (in_array($_v, $this->_vars) ? $this->alias : 't').".{$_v} DESC ,";
				}else{
					$_tmp .= (in_array($_k, $this->_vars) ? $this->alias : 't').".{$_k} {$_v} ,";
				}
			}
			$order = ' ORDER BY '.rtrim($_tmp, ',');
		}
		$sql .= $where.$order." LIMIT {$start},{$limit}";
// 		echo $sql;
// 		exit();
		$q = DB::query($sql);
		while ($v = DB::fetch($q))
		{
			$v['picpath'] = $this->_getFMDir($v) . $v['pic'];
			$v['pic'] = $this->_picHandle($v['pic'], $v['serverid']); 
			$v['views'] += get_redis_views($v['tid'], 'viewthread');
			$v['address'] = $this->_addressHandle($v['address'], $v['pro'], 1);
			$v['dateline'] = $this->_timeHandle($v['dateline'], 'Y-m-d');
			$v['proname'] = $this->_getRegionName($v['pro']);
			$v['shortsubject'] = cutstr($v['subject'], 18, '');
			$v['shortsubjectmore'] = cutstr($v['subject'], 18, '');
			$list[$v['tid']] = $v;
			//$tids[] = $v['tid'];
		}			
		return $this->_listDataHandle($list);
	}
	
	
	/**
	 * 读取模块的特别信息
	 * @param String $type 类别
	 * @return Array
	 * @access public
	 */
	function getPlugin($type, $args = array()){
		switch($type){
			case 'list':
				$return = call_user_func_array(array($this, '_listPlugin'), array($args));break;
			case 'view':
				$return = call_user_func_array(array($this, '_viewPlugin'), array($args));break;
			default :
				$return = array();
		}
		return is_array($return) ? $return : array($return);
	}
		
	/**
	 * 读取详细页信息（详细页）
	 * @param $tid      int     帖子ID
	 */
	public function getview($tid)
	{
		global $_G;
		$viewdata = array();
		$cachedata = array();
		$select  = '';
		$enable = " AND {$this->alias}.{$this->_vars[enable]} = 1";
		if($_G['forum']['ismoderator'] == 1){
			$enable = '';
		}elseif(DB::result_first("SELECT count(*) FROM ".DB::table('forum_post')." WHERE tid = {$tid} AND authorid = {$_G[uid]} AND first = 1")){
			$enable = '';
		}		
		/*此处等post表模型建立后将完善修改*/
		$sql = "SELECT p.*".$this->_getSelect()." FROM {$this->table} {$this->alias} LEFT JOIN ".DB::table('forum_post')." p ON {$this->alias}.{$this->_vars[tid]} = p.tid WHERE {$this->alias}.{$this->_vars[tid]} = {$tid} AND p.fid={$this->_fid} AND p.first = 1 {$enable}";
		//echo $sql;exit;
		$viewdata = memory('get', 'cache_dianping_fid_'.$this->_fid.'_tid_' . $tid);
		if (! $viewdata){			
			$viewdata = DB::fetch_first($sql);
			memory('set', 'cache_dianping_fid_'.$this->_fid.'_tid_' . $tid, $viewdata, 30);
		}
		if(!empty($viewdata)){			
			$viewdata = empty($cachedata[$tid]) ? $viewdata : array_merge($viewdata, $cachedata[$tid]);
			/*此处等thread表模型建立后将完善修改*/
			$viewdata = array_merge($viewdata, DB::fetch_first("SELECT views, replies FROM ".DB::table('forum_thread')." WHERE tid = {$tid}"));			
			require_once libfile('function/forumlist');			
			$viewdata['views'] += get_redis_views($tid, 'viewthread');
			/*更新帖子的点击量，放入缓存中，等待定期更新*/
			require_once libfile('class/myredis');
			$myredis = &myredis::instance();
			if ($myredis->connected)
			{
				$myredis->obj->hincrby('viewthread_number', $tid, 1);
			} else
			{
				DB::query("UPDATE LOW_PRIORITY ".DB::table('forum_thread')." SET views=views+1 WHERE tid='{$tid}'", 'UNBUFFERED');
			}			
			$viewdata['subject'] = $viewdata['subject'];			
			$viewdata['showimg'] = $this->_picHandle($viewdata['pic'], $viewdata['serverid']);
			$viewdata['dateline'] = $this->_timeHandle($viewdata['dateline']);			
			$viewdata['shortsubject'] = cutstr($viewdata['subject'], 52);			
			$viewdata['message'] = ($viewdata['message']);			
		}		
		/*读取评论信息*/
		return self::_viewDataHandle($viewdata);
	}
	
	//返回评论列表
	public function getComment($tid, $start = 0, $desc = true)
	{
		/*此处待post表模型建立后再完善*/
		$sql = "SELECT p.* FROM ".DB::table('forum_post')." p WHERE p.tid = {$tid} and p.first = 0 and invisible=0 ORDER BY p.rate desc,p.dateline ".($desc ? 'DESC' : 'ASC')." LIMIT {$start},{$this->commentlimit}";
		$q = DB::query($sql);
		$comments = array();
		$dianping = m('dianping');
		$mod_dianping_support = m('dianpingsupport');
		while ($v = DB::fetch($q))
		{
			$logs = $dianping->getRatebypid($v['authorid'],$v['pid']);
			$v['message'] = str_replace('thumbImg(this)','thumbImg(this,null,757)',$v["message"]);			
			//$v['message'] = $this->_messageHandle($v['message']);
			if($logs){
				$v['starnum'] = $logs['starnum'];
				$v['supports'] = $logs['supports'];
				$v['ext1'] = $logs['ext1'];
				$v['ext2'] = $logs['ext2'];
				$v['ext3'] = $logs['ext3'];
				$v['ext4'] = $logs['ext4'];
			}else{
				$support = memory('get', 'support_pid_' . $v['pid']);
				if (! $support){			
					$support = $mod_dianping_support->get(array('fields' => 'COUNT(*) AS count', 'index_key' => '', 'conditions' => " pid=$v[pid]"));
					memory('set', 'support_pid_' . $v['pid'], $support, 60);
				}				
				$v['supports'] = $support['count'];				
			}			
			$comments[$v['pid']] = $v;
		}
		return $comments;
	}

	//查找每个用户打了多少分
	function getStarByRalateid($type, $typeid, $uid, $ralateid) {
		if($uid&&$ralateid){
			$starid = DB::result_first("SELECT id FROM ".DB::table('dianping_star_statistics')." WHERE type = '$type' AND typeid = '$typeid'");
			return $starid ? DB::fetch_first("SELECT * FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND uid = $uid AND pid = $ralateid") : NULL;
		}else{
			return NULL;
		}
	}
	/**
	 * 对详细页数据进行处理
	 * @param array $data 传入的详细数据
	 * @return array
	 */
	function _viewDataHandle($data){
		if(!empty($data)){
			if($data['enable'] == 0){
				$data['subject'] .= '';
			}
		}
		return $data;
	}
	
	
	
			
	/**
	 * 处理message（过滤等）
	 * @param String $message
	 * @return String
	 * @access private
	 */
	function _messageHandle($message,$pid){
		global $_G;
		require_once libfile('function/newdiscuzcode');
		$message = discuzcode($message,$pid);			
		if(preg_match_all("/\[attach\](\d+)\[\/attach\]/i", $message, $matches)) {
				$aids = $matches[1];
				require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				$attachserver = new attachserver;
				$domain  = $attachserver->get_server_domain("all", '*');
				foreach ($aids as $aid) {
					$attachment = DB::fetch_first("SELECT attachment,isimage,remote,width,serverid FROM ".DB::table('forum_attachment')." WHERE aid='$aid'");
					if ($attachment['isimage']) {
						if($attachment['serverid']>0){							
							$path = "http://".$domain[$attachment['serverid']]['name']."/forum/".$attachment['attachment'];
							$path .= $attachserver->getPreStr($domain[$attachment['serverid']], 'forum', true, true);
						}elseif($attachment['remote']){
							$path = $_G['setting']['ftp']['attachurl'].'forum/'.$attachment['attachment'];
						}else{
							$path = $_G['setting']['attachurl'].'forum/'.$attachment['attachment'];
						}
					}
					if($attachment['width']>610){
						$message = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" width="610px;" />', $message);
					}else{
						$message = preg_replace("/\[attach\]".$aid."\[\/attach\]/i", '<img src="'.$path.'" alt="" />', $message);	
					}
				}					
		}
		return $message;
	}
	
}

?>