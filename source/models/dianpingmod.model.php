<?php

/**
 * @author JiangHong
 * @copyright 2013
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class DianpingmodModel extends BaseModel{
	var $table = 'plugin_dianping_mains';
	var $prikey = 'id';
	var $alias = 'dpm';
	var $_moduleid = '';
	var $limit = 10;
	var $commentlimit = 10;
	var $otherlimit = 4;	
	var $_fid = 0;
	var $_extendmodule = array();
	var $_modulesopen = array();
	var $_moduleinfo = array();
	var $_setting = array();
	var $_relation = array(
		'orderbylastpost' => array(
				'model' => 'forum_thread',
				'type'  => HAS_ONE,
				'refer_key' => 'tid',
				'foreign_key' => 'tid'));
	/*以下定义模块中键在当前表中的名称*/
	var $_vars = array(
		'pk' => 'id',
		'mid' => 'mid',
		'tid' => 'tid',
		'name' => 'Name',
		'pic' => 'pic',
		'pro' => 'pro',
		'enable' => 'enable',
		'serverid' => 'serverid',
		'score' => 'score',
		'orderby' => 'orderby',
		'num' => 'num',
		'url' => 'url',
		'phone' => 'phone',
		'mapx' => 'mapx',
		'mapy' => 'mapy',
		'address' => 'address',
		'typeclass' => 'typeclass',
		'lastrate' => 'lastrate',
		'lastscore' => 'lastscore',
		);
	var $template = array(
		'list' => 'forum/dianping/list',
		'post' => 'forum/dianping/post',
		'view' => 'forum/dianping/view',
		'replylist' => 'forum/dianping/replylist',
		'imagelist' => 'forum/dianping/imglist',
	);
	var $typeclass = array();
	function __construct($param, $db){
		global $_G;
		parent::__construct($param, $db);
		if(!empty($this->_moduleid)){
			$dianingmodules = m('dianpingmodules');
			$_tmp = $dianingmodules->getConfig(0, $this->_moduleid);
			if(! empty($_tmp)){
				$childmod = m('dianpingchildmod');
				$modstrname = $childmod->getKeyName();
				if(!empty($_tmp['settings'])) $this->_setting = unserialize($_tmp['settings']);
				$this->_moduleinfo = $_tmp;
				if($_tmp['listlimit'] > 0) $this->limit = $_tmp['listlimit'];
				if($_tmp['commentlimit'] > 0) $this->commentlimit = $_tmp['commentlimit'];
				if($_tmp['otherlimit'] > 0) $this->otherlimit = $_tmp['otherlimit'];
				if(!empty($_tmp['templates'])) $this->template = array_merge($this->template, unserialize($_tmp['templates']));
				if(!empty($_tmp['typeclassid'])) $this->typeclass = explode(',', $_tmp['typeclassid']);
				foreach(explode(',', $_tmp['modules']) as $_v){
					$this->_modulesopen[] = $modstrname[$_v];
				}
				$this->_extendmodule = array_values($modstrname);
			}
			$this->_fid = $_G['config']['fids'][$this->_moduleid];
		}
	}
	/**
	 * 返回状态的追加sql语句
	 * @param Int $enable
	 * @return String
	 */
	public function getEnableCondition($enable){
		$return = '';
		$enable = intval($enable);
		switch($enable){
			case -1:
				$return = "";break;
			default:
				$return = " AND {$this->alias}.{$this->_vars[enable]} = {$enable}";break;
		}
		return $return;
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
		$sql = "SELECT t.subject, t.replies, t.views,t.fid,t.displayorder,t.author,t.authorid, t.dateline ".$this->_getSelect()." FROM {$this->table} {$this->alias} LEFT JOIN ".DB::table('forum_thread')." t ON t.tid = {$this->alias}.{$this->_vars[tid]}";
		
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
					//$_tmp .= (in_array($_k, $this->_vars) ? $this->alias : 't').".{$_k} {$_v} ,";
                    if($_k == 'orderby' && $this->_moduleid == 'skiing'){
                        //$_k = 'displayorder';
                        $_tmp .=  $this->alias.".displayorder {$_v} ,";
                    }else{
                        $_tmp .= (in_array($_k, $this->_vars) ? $this->alias : 't').".{$_k} {$_v} ,";
                    }
				}
			}
			$order = ' ORDER BY '.rtrim($_tmp, ',');
		}
		$sql .= $where.$order." LIMIT {$start},{$limit}";
//		echo $sql.'<br>';
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
	 * 返回封面目录（因装备添加封面，故将次独立用于装备里重载）
	 */
	function _getFMDir($data){
		return 'plugin/';
	}
	/**
	 * 配置模块查询语句，将所有表自定义的键值映射为规定名称，方便模板的调用
	 * @access private
	 * @return String
	 */
	function _getSelect(){
		$_find = ", {$this->alias}.*";
		foreach($this->_vars as $_k => $_v){
			if(in_array($_k, $this->_extendmodule) && !self::getChildStatus($_k)) continue;
			$_find .= ", {$this->alias}.{$_v} AS {$_k} ";
		}
		return $_find;
	}
	/**
	 * 读取模块的页面title
	 * @param String $type 类型（list,view,post）
	 * @return Array
	 */
	function getNavTitle($type = 'list', $value){
		$_title = unserialize($this->_moduleinfo['title']);
		$_keyword = unserialize($this->_moduleinfo['keyword']);
		$_description = unserialize($this->_moduleinfo['description']);
		return array(
			'pageTitle' => $this->_navTitleHandel($_title[$type], $value),
			'metakeywords' => $this->_navTitleHandel($_keyword[$type], $value),
			'metadescription' => $this->_navTitleHandel($_description[$type], $value));
	}
	/**
	 * 处理自定义的字段，替换成现有变量
	 */
	function _navTitleHandel($string, $value = array())
	{
		global $_G;
		extract($value);
		$return = str_replace(array('{name}', '{year}', '{area}', '{subtitle}', '{page}'), array($this->_moduleinfo['mname'], date('Y', time()), $area ? $area : '[area]', $subject ? $subject : '[subject]', $_G['gp_page']>1 ? ' - 第'.$_G['gp_page'].'页' : ''), $string);
		return $return;
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
		}elseif($this->getIfAuthorId($tid, $_G['uid'])){
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
			$viewdata = array_merge($viewdata, DB::fetch_first("SELECT views, replies FROM ".DB::table('forum_thread')." WHERE tid = {$tid} " . getSlaveID()));
			require_once libfile('function/forumlist');
			
			$viewdata['views'] = get_redis_views($tid, 'viewthread');
			/*更新帖子的点击量，放入缓存中，等待定期更新*/
			require_once libfile('class/myredis');
			$myredis = &myredis::instance(6381);
			if ($myredis->connected)
			{
				$myredis->obj->hincrby('viewthread_number', $tid, 1);
			} else
			{
				DB::query("UPDATE LOW_PRIORITY ".DB::table('forum_thread')." SET views=views+1 WHERE tid='{$tid}'", 'UNBUFFERED');
			}
			$viewdata['picpath'] = 'plugin/'.$viewdata['pic'];
			$viewdata['attachment'] = $viewdata['pic'];
			$viewdata['pic'] = $this->_picHandle($viewdata['pic'], $viewdata['serverid']);
			$viewdata['newaddress'] = $this->_addressHandle($viewdata['address'], $viewdata['pro']);
			$viewdata['dateline'] = $this->_timeHandle($viewdata['dateline']);
			$viewdata['proname'] = $this->_getRegionName($viewdata['pro']);
			$viewdata['shortsubject'] = cutstr($viewdata['subject'], 52);
			$viewdata['message'] = $this->_messageHandle($viewdata['message']);
		}
		/*读取评论信息*/
		return $this->_viewDataHandle($viewdata);
	}
	/**
	 * 发布和修改数据
	 * @param Array $postdata 提交的数据
	 * @param Int $tid 提交的帖子TID，默认为空，当为空时是发帖
	 * @param Int $pid 提交的帖子的PID，默认为空，当tid不为空，而pid为空时说明是回帖，当pid和tid都不为空时说明是编辑贴
	 * @return bool
	 */
	public function dopost($postdata, $tid = 0, $pid = 0)
	{
		global $_G;
		if(empty($postdata)) showmessage('post_sm_isnull', NULL);
		extract($postdata);
		$tid = intval($tid);
		$pid = intval($pid);
		if(trim($postdata['subject']) == '' && $pid == 0) {
			showmessage('post_sm_isnull');
		}
		if($pid == 0) $postdata['subject'] = dhtmlspecialchars(censor(trim($postdata['subject'])));
		$postdata['message'] = censor($postdata['message']);
		$attachment = self::getChildStatus('pic') ? 2 : 0;
		/*pid为0时是发新贴操作。*/
		if(empty($pid)){
			require_once libfile('function/post');
			if(checkflood()) {
				showmessage('post_flood_ctrl', '', array('floodctrl' => $_G['setting']['floodctrl']));
			} elseif(checkmaxpostsperhour()) {
				showmessage('post_flood_ctrl_posts_per_hour', '', array('posts_per_hour' => $_G['group']['maxpostsperhour']));
			}
			$posttableid = getposttableid('p');
			DB::query("INSERT INTO " . DB::table('forum_thread')." (fid, posttableid, author, authorid, subject, dateline, lastpost, lastposter, displayorder, digest, special, attachment, moderated, status, isgroup, closed) VALUES ('$this->_fid', '$posttableid', '$_G[username]', '$_G[uid]', '$subject', '$_G[timestamp]', '$_G[timestamp]', '$_G[username]', '', '', '', '{$attachment}', '', '0', '', '1')");
			$tid = DB::insert_id();
			$pid = insertpost(array(
					'fid' => $this->_fid,
					'tid' => $tid,
					'first' => 1,
					'author' => $_G['username'],
					'authorid' => $_G['uid'],
					'subject' => $postdata['subject'],
					'dateline' => $_G['timestamp'],
					'message' => $postdata['message'],
					'useip' => $_G['clientip'],
					'invisible' => '',
					'anonymous' => '',
					'usesig' => 0,
					'htmlon' => '',
					'bbcodeoff' => '',
					'smileyoff' => '',
					'parseurloff' => '',
					'attachment' => $attachment,
					'tags' => '',
					));
			if($pid && getstatus(0, 1)){
			  savepostposition($tid, $pid);
			 }
			 updatepostcredits('+', $_G['uid'], 'post', $this->_fid);
			require_once libfile('function/stat');
			DB::update('common_member_field_home', array('recentnote'=>$postdata['subject']), array('uid'=>$_G['uid']));
			$postdata['subject'] = str_replace("\t", ' ', $postdata['subject']);
			$lastpost = "$tid\t{$postdata[subject]}\t$_G[timestamp]\t$_G[username]";
			DB::query("UPDATE ".DB::table('forum_forum')." SET lastpost='$lastpost', threads=threads+1, posts=posts+1, todayposts=todayposts+1 WHERE fid='{$this->_fid}'", 'UNBUFFERED');
			updatestat('thread');
			// 更新图片附件
			require_once libfile('function/post');
			$new_img_edit && updateattach('', $tid, $pid, $new_img_edit, $_G['gp_attachdel'], $_G['gp_attachupdate'], $_G['uid']);

			$postdata['tid'] = $tid;
			$postdata['pid'] = $pid;
			$postdata['name'] = $postdata['subject'];
			$postdata['enable'] = 0;
			$postdata = array_merge($postdata, $this->picThreadHandle($imgselect, $tid, $pid, $_G['uid']));
			$argsment = $this->postdataHandle($postdata);
			$argsment['dateline'] = TIMESTAMP;//发布时间
                        $argsment['lastpost'] = TIMESTAMP;//最后评论时间
			$this->add($argsment);
			$dianpingshow = m('dianpingshow');			
			$dianpingshow->add(array('type' => 'forum', 'typeid' => $tid, 'fid' => $this->_fid));
			
			//点评线路模块之经过地域,gps文件 Lishuaiquan
			if ($postdata['ctl'] == "line") {
				$mdLineRegion = m('plugin_line_region');
				$mdLineRegion->doData($postdata, $tid);
				
				$mdGps   = m("gpsattachment");
				$gpsShow = $mdGps->getData($postdata['lMap'], "aid");
				if ($gpsShow) {
					$mdGps->edit("aid = {$gpsShow["aid"]}", array("tid"=>$tid,"pid"=>$pid));
				}				
			}
			if($justreturn){return true;}
			showmessage("model_new_success", $_G['config']['web']['portal']."dianping.php?mod={$this->_moduleid}", array('name' => $this->_moduleinfo['mname']));
		}else{
			DB::update('forum_thread', array('subject' => $postdata['subject']), array('tid' => $tid));
			$updates = array(
					'subject' => $postdata['subject'],
					'message' => $postdata['message'],
					'useip' => $_G['clientip']
			);
			DB::update('forum_post', $updates, array('pid' => $pid));
			if($_G['forum']['ismoderator'] == 1){
				DB::update('forum_thread', array('moderated' => 1), array('tid' => $tid));
			}
			// 更新图片附件
			require_once libfile('function/post');
                        
			$new_img_edit && updateattach('', $tid, $pid, $new_img_edit, $_G['gp_attachdel'], $_G['gp_attachupdate'], $_G['uid']);
			$postdata['tid'] = $tid;
			$postdata['pid'] = $pid;
			$postdata['name'] = $postdata['subject'];
			$postdata['enable'] = 0;
			$postdata = array_merge($postdata, $this->picThreadHandle($imgselect, $tid, $pid, $_G['uid']));
			$argsment = $this->postdataHandle($postdata);
			$this->edit("{$this->_vars[tid]} = {$tid}", $argsment);
			
			//点评线路模块之经过地域,gps文件 Lishuaiquan
			if ($postdata['ctl'] == 'line') {
				$mdLineRegion = m('plugin_line_region');
				$mdLineRegion->doData($postdata, $tid);
							
				$mdGps   = m('gpsattachment');
				$gpsShow = $mdGps->getData($postdata['lMap'], "aid");
				if ($gpsShow) {
					$mdGps->edit("aid = {$gpsShow["aid"]}", array("tid"=>$tid,"pid"=>$pid));
				}
			}		
			showmessage("model_edit_success", $_G['config']['web']['portal']."dianping.php?mod={$this->_moduleid}&act=showview&tid={$tid}", array('name' => $this->_moduleinfo['mname']));
			// lxp 20131009
			//header('Location:'.$_G['config']['web']['portal']."forum.php?ctl={$this->_moduleid}&act=showview&tid={$tid}&pid={$pid}");
			//die();
		}
		//showmessage("model_{$do}_success", $_G['config']['web']['portal']."forum.php?ctl={$this->_moduleid}", array('name' => $this->_moduleinfo['mname']));
	}

	/**
	 * @author lxp 20131119
	 * @param $tid      int     帖子ID
	 * @param $start    int     开始位置，默认为0
	 * @param $desc     bool    是否使用倒序排序。默认是true
	 * @return array 返回评论的数组
	 */
	public function getComment($tid, $start = 0, $desc = true){
		/*此处待post表模型建立后再完善*/
// 		$sql = "SELECT p.* FROM ".DB::table('forum_post')." p WHERE p.tid = {$tid} and p.first = 0 ORDER BY p.dateline ".($desc ? 'DESC' : 'ASC')." LIMIT {$start},{$this->commentlimit}";
// 		$q = DB::query($sql);
// 		$comments = array();
// 		while ($v = DB::fetch($q))
// 		{
// 			$v['dateline'] = $this->_timeHandle($v['dateline']);
// 			$v['message'] = str_replace('thumbImg(this)','thumbImg(this,null,757)',$v["message"]);
// 			$comments[$v['pid']] = $v;
// 		}
// 		return $comments;
	}
	/**
	 * 取得一条点评
	 * 
	 * @author lxp 20130917
	 * @param int $pid
	 * @return array
	 */
	public function getOneComment($pid){
		$sql = "SELECT p.*, psl.starnum, psl.goodpoint, psl.weakpoint FROM ".DB::table('forum_post')." p LEFT JOIN ".DB::table('dianping_star_logs')." psl ON p.pid=psl.pid WHERE p.pid = {$pid} and p.first = 0";
		$r = DB::query($sql);
		$v = DB::fetch($r);
		$v['dateline'] = $this->_timeHandle($v['dateline']);
		return $v;
	}

	/**
	 * 读取地区信息
	 * @param int		$catid     地区id
	 * @param int		$sorttype	0：      不是用排序
	 * 								1：      使用地区内子地区的数量排序
	 * 								2：      使用模块内自定义排序
	 * @param bool		$desc				是否从大到小排序
	 * @param bool		$showcount			是否返回每个地区的数量
	 * @param bool		$displaynone		是否显示没有信息的地区
	 */
	public function getRegions($catid = 0, $sorttype = 0, $desc = true, $displaynone = true)
	{ 	
		$regions = array();
		if(self::getChildStatus('pro')){
			require_once libfile('class/region');
			$region = region::instance();
			$regions = $sorttype == 1 ? $region->getChild($catid, true, true) : $region->getChild($catid);
			if ($sorttype == 2)
			{
				$tmp = array();
				//$sorts = self::getDataByPro(array_keys($regions), true);
				$sorts = $this->findAll(array('fields' => "{$this->_vars[pro]} AS pro, COUNT(*) AS count", 'conditions' => "{$this->_vars[pro]} IN(".implode(',', array_keys($regions)).") AND {$this->_vars[enable]} = 1 GROUP BY {$this->_vars[pro]}", 'index_key' => 'pro', 'order' => 'count DESC'));
				foreach ($sorts as $v)
				{
					$tmp[] = array_merge($regions[$v['pro']], $v);
					unset($regions[$v['pro']]);
				}
				if ($displaynone)
				{
					foreach ($regions as $k => $v)
					{
						$v['pro'] = $k;
						$tmp[] = $v;
					}
				}
				$regions = $tmp;
			}
			if (! $desc)
				$regions = array_reverse($regions, true);
		}
		return $regions;
	}
	/**
	 * 处理地址
	 * @param String $address 地址
	 * @param Int $proid 地区的id
	 * @return String
	 * @access private
	 */
	function _addressHandle($address, $proid){
		if(self::getChildStatus('address') && $proid > 0){
			$address = $this->_getRegionName($proid, 1).$address;
		}
		return $address;
	}
	/**
	 * 处理图片
	 * @param String $picurl 图片地址
	 * @param Int $serverid 附件服务器ID
	 * @param String $f 存储的文件夹名
	 * @return String
	 * @access private
	 */
	function _picHandle($picurl, $serverid = 0, $f = 'plugin'){
		if(self::getChildStatus('pic') && $serverid > 0){
			/*开启了图片模块，才引入附件服务器类*/
			if(empty($this->alldomain)){
				require_once DISCUZ_ROOT.'./source/plugin/attachment_server/attachment_server.class.php';
				$attachserver = new attachserver;
				$this->alldomain = $attachserver->get_server_domain('all');
			}
			$picurl = 'http://'.$this->alldomain[$serverid].'/'.$f.'/'.$picurl;
		}
		return $picurl;
	}
	/**
	 * 处理网址
	 * @param String $url 地址
	 * @return String
	 * @access private
	 */
	function _urlHandle($url){
		if(self::getChildStatus('url')){
			/*此处处理网址*/
		}
		return $url;
	}
	/**
	 * 处理电话
	 * @param String $phone
	 * @return String
	 * @access private
	 */
	function _phoneHandle($phone){
		if(self::getChildStatus('phone')){
			/*此处处理电话*/
		}
		return $phone;
	}
	/**
	 * 处理message（过滤等）
	 * @param String $message
	 * @return String
	 * @access private
	 */
	function _messageHandle($message){
		$message = strip_tags($message,'<br>');
		return $message;
	}
	/**
	 * 处理时间格式
	 * @param Int 时间戳
	 * @return String
	 * @access private
	 */
	function _timeHandle($timestamp, $format = 'Y-m-d H:i'){
		return date($format, $timestamp);
	} 
	/**
	 * 读取地区名称
	 * @param Int $proid 地区的id
	 * @param Int $level 向上显示几级地区名称（0为只显示当前地区名称）
	 * @param String $f 每个地区之间的分隔符
	 * @return String
	 * @access private
	 */
	function _getRegionName($proid, $level = 0, $f = ''){
		$level = max(intval($level), 0);
		require_once libfile('class/region');
		$region = region::instance();
		$return = $region->getNameById($proid);
		if($level > 0){
			$parentid = $proid;
			for($i = 0; $i < $level; $i++){
				$parentid = $region->getParent($parentid);
				if($parentid > 0){
					$parentname = $region->getNameById($parentid);
					$return = $parentname.$f.$return;
				}
			}
		}
		return $return;
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
	 * 返回list页面需要的变量
	 * @param Array $args 传入的所有$_GET参数
	 * @return Array
	 * @access private
	 */
	function _listPlugin($args){
		// lxp 20130922
		$data = array();
		// 评论最多的雪场列表
		$data['listreply'] = $this->getlist(array(
				'order' => array('replies' => 'DESC'),
				'limit' => $this->otherlimit
		));
		// 最新发布的雪场列表
		$data['listnew'] = $this->getlist(array(
				'order' => array('dateline' => 'DESC'),
				'limit' => $this->otherlimit
		));
		return $data;
	}
	/**
	 * 返回view页面需要的变量
	 * @param Array $args 传入的所有$_GET参数
	 * @return Array
	 * @access private 
	 */
	function _viewPlugin($args){
		$data['listpro'] = !empty($args['pro']) ? $this->getlist(array('where' => "{$this->alias}.{$this->_vars['pro']} = {$args['pro']} AND {$this->alias}.{$this->_vars['tid']} <> {$args[tid]}", 'limit' => $this->otherlimit, 'order' => array('heats' => 'DESC'))) : array();                                                                              
		
		!$args['sidelist_desc'] && $args['sidelist_desc'] = 'heats';
		$whereArgs = array(
				'order' => array($args['sidelist_desc'] => 'DESC'),
				'limit' => $this->otherlimit+1
		);
		$args['sidelist_desc'] == 'lastpost' && ($whereArgs = array_merge($whereArgs, array('where'=>"{$this->alias}.{$this->_vars['num']}>9")));
		$data['hotmore'] = $this->getlist($whereArgs);
		if(is_array($data['hotmore']) && count($data['hotmore']) == $this->otherlimit+1){
			foreach ($data['hotmore'] as $k => $v){
				if($v['tid'] == $args['tid']){
					unset($data['hotmore'][$k]);
				}
			}
			if(count($data['hotmore']) == $this->otherlimit+1){
				array_pop($data['hotmore']);
			}
		}
		
		
		return $data;
	}
	/**
	 * 返回模块内商品的最大数量
	 * @access public
	 * @param String $condition 过滤条件
	 * @return Int
	 */
	function getMaxCount($condition = ''){
		if($this->_moduleinfo['maxcount'] > 0 && empty($condition)){
			return $this->_moduleinfo['maxcount'];
		}else{
			$condition = empty($condition) ? '' : ' AND '.$condition;			
			$count = $this->get(array('fields' => 'COUNT(*) AS count', 'index_key' => '', 'conditions' => "{$this->_vars[enable]} = 1{$condition}"));
			return $count['count'];
		}
	}
	/**
	 * 根据用户ip读取用户地区ID
	 * @param String $ip
	 * @return int;
	 */
	function getRegionByIp($ip = ''){
		if(self::getChildStatus('pro') && !empty($ip)){
			require_once libfile('class/region');
			$region = region::instance();
			return $region->getRegionByIp($ip);
		}
		return array();
	}
	/**
	 * 查看子模块是否开启
	 * @param String $childmod
	 * @return bool
	 */
	function getChildStatus($childmod){
		return in_array($childmod, $this->_modulesopen);
	}
	/**
	 * 对提交的数据进行处理，制作入库的数据，此处根据情况在子类中重载
	 * @param array() 提交的数据
	 * @return Array
	 */
	function postdataHandle($postdata){
		foreach($this->_vars as $_k => $_v){
        	isset($postdata[$_k]) && $return[$_v] = $postdata[$_k];
                    
        }
        
        return $return;
	}
	/**
	 * 处理商品绑定的图片
	 * @param Array $imgselect 选择的图片的aid数组
	 * @param Int $tid 帖子的tid
	 * @param Int $pid 帖子的pid
	 * @param Int $uid 用户id
	 * @param String 图片的描述信息
	 * @return Array
	 */
	function picThreadHandle($imgselect, $tid, $pid, $uid, $description = ''){
		if(self::getChildStatus('pic') && !empty($imgselect) && $tid > 0 && $pid > 0 && $uid > 0){
            $update = array(
                'readperm' => 0,
                'price' => 0,
                'tid' => $tid,
                'pid' => $pid,
                'uid' => $uid);
            $firstaid = $imgselect[0];
            foreach($imgselect as $_k => $_v){
            	if(intval($_v) > 0){
            		DB::query("REPLACE INTO " . DB::table('forum_attachmentfield')." (aid, tid, pid, uid, description) VALUES ('{$_v}', '$tid', '$pid', '$uid', '$description')");
            	}
            }            
            /*将原先选择的图片，解除和帖子的绑定状态，变为未使用状态*/
            
            DB::update('forum_attachment', array('tid' => 0, 'pid' => 0), array('tid' => $tid, 'pid' => $pid, 'dir' => 'plugin'));
            /*将新选择的图片与帖子绑定*/
			DB::update('forum_attachment', $update, "aid IN(".dimplode($imgselect).")");
			/*将头图作为模块商品的首页*/
			$return = DB::fetch_first("SELECT attachment AS pic, serverid FROM ".DB::table('forum_attachment')." WHERE aid = {$firstaid}");		
		}
		return $return ? $return : array();
	}
	/**
	 * 对列表数据进行处理
	 * @param array $data 传入的列表数据
	 * @return array
	 */
	function _listDataHandle($data){
		if(!empty($data)){
			foreach($data as $_k => $_v){
				if($_v['enable'] == 0) $data[$_k]['name'] .= '(未审核)';
			}
		}
		return $data;
	}
	/**
	 * 对详细页数据进行处理
	 * @param array $data 传入的详细数据
	 * @return array
	 */
	function _viewDataHandle($data){
		if(!empty($data)){
			if($data['enable'] == 0){
				$data['name'] .= '(未审核)';
			}
		}
		return $data;
	}
	/**
	 * 用于审核商品，审核时会将T表的closed修改为0，将商品所在的表的enable修改为1
	 * @param Int $tid
	 * @return Bool
	 */
	function checkThis($tid, $status = 1){
		$status = $status == 1 ? 1 : 0;
		if($tid > 0){
			$this->edit("{$this->_vars[tid]} = {$tid}", array($this->_vars['enable'] => $status));
			DB::update('forum_thread', array('closed' => ($status ^ 1)), array('tid' => $tid));
			$this->_updateCount();
			return true;
		}
		return false;
	}

	/**
	 * 更新商品数量
	 * 
	 * @author lxp 20131112
	 */
	function _updateCount(){
		$count = current($this->get(array('fields' => 'COUNT(*) AS count', 'conditions' => "{$this->_vars['enable']} = 1")));
		$dianingmodules = m('dianpingmodules');
		$dianingmodules->setConfig("srcid = '{$this->_moduleid}'", array('maxcount' => $count));
	}

	/**
	 * 删除当前商品
	 */
	function deleteThis($tid){
		$tid = intval($tid);
		if($tid > 0){
			if($this->drop("{$this->_vars[tid]} = {$tid}") > 0){
				/*删除相关的商品评分*/
				$dianpingshow = m('dianpingshow');
				$dianpingshow->deleteScore($tid);
				/*删除相关商品的评论的赞*/
				$dianpingsupport = m('dianpingsupport');
				$dianpingsupport->drop("tid = {$tid}");
				/*临时使用DB完成帖子相关操作*/
				DB::delete('forum_thread', array('tid' => $tid));
				DB::delete('forum_post', array('tid' => $tid));
				DB::delete('forum_postposition', array('tid' => $tid));
				DB::delete('forum_poststick', array('tid' => $tid));
				DB::delete('forum_postcomment', array('tid' => $tid));
				/*删除相关的图片*/
				require_once libfile('function/delete');
				deleteattach("tid = {$tid}", true, 'plugin');
				/*线路--删除相关gps文件*/
				$mdGps = m('gpsattachment');
				$mdGps->deleteThis($tid, "tid");			
			}
		}   
		return false;
	}

	/**
	 * 更新点评人数
	 * 
	 * @author lxp 20131029
	 * @param int $tid
	 */
	function updateNum($tid, $starid = 0){
		if(!$tid){
			return false;
		}
		$mod_star_logs = m('dianping');
		if(!$starid){
			$starid = $mod_star_logs->_getStarid($tid);
		}
		$res = $mod_star_logs->get(array(
				'fields' => 'COUNT(starid) AS count',
				'conditions' => "starid = {$starid}"
		));
		$this->edit("{$this->_vars['tid']} = {$tid}", "{$this->_vars['num']} = {$res['count']}");
	}
	
	/**
	 * 读取模块的分类
	 * 
	 * @author lxp 20131030
	 */
	function _getTypeClass(){
		$typelist = array();
		if(is_array($this->typeclass)){
			$mod_categorys = m('categorys');
			foreach ($this->typeclass as $v){
				$typelist[$v] = $mod_categorys->find(array(
						'fields' => 'cid, name',
						'conditions' => "fatherid = {$v} AND enable = 1"
				));
				// 取得二级分类 20140213
				if(count($typelist[$v]) > 0 && is_array($typelist[$v])){
					foreach ($typelist[$v] as $n){
						$typelist[$v][$n['cid']]['children'] = $mod_categorys->find(array(
								'fields' => 'cid, name',
								'conditions' => "fatherid = {$n['cid']} AND enable = 1"
						));
					}
				}
			}
		}
		return $typelist;
	}
	/**
	 * 查找当前用户是否为帖子作者
	 * @param Int tid
	 * @param Int uid
	 * @return boolean
	 * 若当前模块不允许作者编辑自己的帖子，直接返回false就行，减少无用sql查询
	 */
	function getIfAuthorId($tid, $uid){
		if ($tid > 0 && $uid > 0) {
			$author = memory('get', 'cache_forum_thread_author_tid_' . $tid);
			if (! $author) {
				$author = DB::result_first("SELECT authorid FROM " . DB::table('forum_thread') . " WHERE tid = {$tid} " . getSlaveID());
				memory('set', 'cache_forum_thread_author_tid_' . $tid, $author, 3600 * 24);
			}
			return $author == $uid;
		}
		return false;
	}
	/**
	 * 更新最后加8264币时间
	 */
	function updateLastRate($tid, $pid){
		global $_G;
		$ratelast = DB::result_first("SELECT dateline FROM " . DB::table('forum_post') . " WHERE pid = {$pid}");
		$ratelast > 0 && $this->edit("{$this->_vars['tid']} = {$tid}", "{$this->_vars['lastrate']} = {$ratelast}");
	}
	/**
	 * 查询最新排行榜数据
	 * 此处查询规则为加了币的最新点评时间（t表的最后回复时间）排行
	 * @param int $limit
	 * @return array;
	 */
	function getRank($limit){
		global $_G;
		$keyname = "cache_dianping_" .rtrim(strtolower(get_class($this)), 'model') . "_rank_limit_" . $limit;
		$nologkey = $keyname . "_nologin";
		$return = memory('get', $keyname);
		if($return && !($_G['gp_nocache'] == 1 && $_G['groupid'] == 1)){
		//	echo "<font color='red'>history</font>";
			return $return;
		}
		if(! $_G['uid']){
			$return = memory('get', $nologkey);
			return $return ? $return : array();
		}else{
			$data = $this->find(array(
				'conditions' => "{$this->_vars['lastrate']} > 0 " . $this->getEnableCondition(1),
				'order' => 'lastrate DESC',
				'fields' => "*" . $this->_getSelect(),
				'limit' => $limit > 0 ? $limit : 10,
				//'join' => 'orderbylastpost',
				'index_key' => false,
			));
			$return = array();
			foreach($data as $_k => $_v){
				$_v['price'] = $_v['score'];
				$_v['lastchange'] = $_v['lastscore'] == $_v['score'] ? 0 : ($_v['lastscore'] > $_v['score'] ? -1 : 1);
				$_v['name'] = $_v[$this->_vars['name']];
				$return[] = $_v;
			}
			memory('set', $keyname, $return, 60 * 1 * 5);
			memory('set', $nologkey, $return, 60 * 60 * 24 * 7);
		}
		return $return;
	}
	/**
	 * 查询最新的优秀点评信息
	 * @param int $limit
	 * @return array;
	 */
	function getNewDianping($limit, $needpic = false){
		global $_G;
		$keyname = "cache_dianping_" .rtrim(strtolower(get_class($this)), 'model') . "_dianping_limit_" . $limit;
		$nologkey = $keyname . "_nologin";
		$data = memory('get', $keyname);
		if($data && !($_G['gp_nocache'] == 1 && $_G['groupid'] == 1)){
		//	echo "<font color='red'>history</font>";
			return $data;
		}
		if(! $_G['uid']){
			$data = memory('get', $nologkey);
			return $data ? $data : array();
		}else{
			$q = DB::query("SELECT r.pid,r.tid FROM " . DB::table('forum_ratelog') . " r INNER JOIN " . DB::table('forum_post') . " p ON p.pid = r.pid AND r.fid = {$this->_fid} GROUP BY p.dateline ORDER BY p.dateline DESC limit {$limit} " . getSlaveID());
			while($v = DB::fetch($q)){
				$_pids[] = $v['pid'];
				$_tids[] = $v['tid'];
			}
			$return = array();
			$postmod = m('forum_post');
			if($needpic){
				$the_mydata = $this->find(array(
					'conditions' => "tid IN(" . dimplode($_tids) . ")",
					'fields' => "{$this->_vars[tid]} AS tid, {$this->_vars[pic]} AS pic, {$this->_vars[serverid]} AS serverid" . (empty($this->_vars['dir']) ? "" : ", {$this->_vars[dir]} AS dir") . (empty($this->_vars['kaid']) ? "" : ", {$this->_vars[kaid]} AS kaid"),
					'index_key' => $this->_vars['tid']));
			}
			$data = $postmod->find(array(
				'conditions' => "closed = 0 AND pid IN(" . dimplode($_pids) . ")",
				'order' => "f_p.dateline DESC",
				'join' => "has_thread",
				'fields' => "f_p.message,f_p.authorid,f_p.author,f_p.pid,f_p.tid,f_t.subject AS name ",
				), false);
			foreach ($data as $key => $value) {
				$data[$key]['message'] = cutstr($value['message'], 120, '');
			}
			if($needpic){
				foreach($data as $_k => $_v){
					$data[$_k]['pic'] = (empty($the_mydata[$_v['tid']]['dir']) ? 'plugin' : $the_mydata[$_v['tid']]['dir']) . '/' . $the_mydata[$_v['tid']]['pic'];
					$data[$_k]['serverid'] = $the_mydata[$_v['tid']]['serverid'];
					$data[$_k]['aid'] = $the_mydata[$_v['tid']]['kaid'] > 0 ? $the_mydata[$_v['tid']]['kaid'] : 0;
				}
			}
		}
		memory('set', $keyname, $data, 60 * 60 * 1);
		memory('set', $nologkey, $data, 60 * 60 * 24 * 7);
		return $data;
	}
}
?>