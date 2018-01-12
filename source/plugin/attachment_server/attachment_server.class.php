<?php
/**
 * @version 2012.09.07
 * @author jianghong
 * @todo 附件服务器管理类
 */
class attachserver
{
	var $name;
	var $domain;
	protected $api;
	var $serverid;
	protected $attach = array();
	protected $safe_string = "";
	public $return_info;
	protected $sockreturn;
	var $time_update = 18000;
	var $error;
	var $thislog;
	function attachserver()
	{
		//echo "连接成功";
	}
	/**
	 * 显示所有服务器信息
	 */
	function show_server()
	{
		$servers = array();
		if (($return = self::load_cache('allserver')) && self::check_cache('allserver')) {
			return $return;
		} else {
			$query = DB::query("SELECT * FROM ".DB::table('plugin_attachment_server')." ORDER BY space_type,space_value DESC");
			while ($value = DB::fetch($query)) {
				$servers[] = $value;
			}
			self::save_cache('allserver', $servers);
			return $servers;
		}
	}
	/**
	 * 添加附件服务器
	 */
	function add_server($info)
	{
		$array = array(
			'name' => $info['name'],
			'domain' => $info['domain'],
			'api' => $info['api']);
		DB::insert('plugin_attachment_server', $array);
		self::clear_cache('allserver');
	}
	/**
	 * 查询当前最少空间的附件服务器
	 */
	protected function select_best_server()
	{
		$best = self::load_cache('bestserver');
		if (! $best || ! self::check_cache('bestserver', 3600)) {
			$best = DB::fetch_first("SELECT * FROM ".DB::table('plugin_attachment_server')." WHERE `status`=1 ORDER BY space_type ASC,space_value ASC LIMIT 1");
			self::save_cache('bestserver', $best);
		}
		if (empty($best)) {
			$this->error = false;
		} else {
			$this->error = true;
			$this->name = $best['name'];
			$this->domain = $best['domain'];
			$this->api = $best['api'];
			$this->serverid = $best['serverid'];
		}
	}
	/**
	 * 返回附件服务器的配置
	 */
	function get_server()
	{
		self::select_best_server();
		if ($this->error) {
			$server = array(
				'name' => $this->name,
				'domain' => $this->domain,
				'api' => $this->api,
				'serverid' => $this->serverid);
		} else {
			$server = false;
		}
		return $server;
	}
	/**
	 * 设置附件的信息
	 * 传入$attach
	 */
	function set_attachment_info($argment)
	{
		global $_G;
		$config = array(
			'imagelib',
			'imageimpath',
			'thumbquality',
			'watermarkstatus',
			'watermarkminwidth',
			'watermarkminheight',
			'watermarktype',
			'watermarktext',
			'watermarktrans',
			'watermarkquality',
			'thumbstatus',
			'thumbwidth',
			'thumbheight',
			'thumbsource');
		$setting = &$_G['setting'];
		if (! empty($argment)) {
			$this->attach = $argment;
			/*将需要的设置信息从全局变量$_G中提取出来*/
			$who_is_array = array();
			foreach ($setting as $key => $value) {
				if (! in_array($key, $config)) {
					continue;
				}
				if (is_array($value)) {
					$value = serialize($value);
					$who_is_array[] = $key;
				}
				$this->attach[$key] = $value;
			}
			if (! empty($who_is_array)) {
				$this->attach['who_is_array'] = serialize($who_is_array);
			}
			$this->attach['safestr'] = base64_encode(self::print_safestring());
			return true;
		}
		return false;
	}
	/**
	 * 读取缩略图的配置参数
	 * @author JiangHong
	 */
	function get_thumb_args($key = null, $type = 'forum')
	{
		global $_G;
		$thumbargs = array();
		$setting = &$_G['setting'];
		$thumbstatus = $type == 'album' ? ( $setting['maxthumbwidth'] > 0 || $setting['maxthumbheight'] > 0 ? 1 : 0 ) : $setting['thumbstatus'];
		if ($thumbstatus) {
			switch( $thumbstatus ) {
				case 'fixnone':
					$thumbstatus = 1;break;
				case 'fixwr':
					$thumbstatus = 2;break;
			}
			$thumbargs = array(
				'thumbimagelib' => $setting['imagelib'],
				'thumbheight' => $type == 'album' ? $setting['maxthumbheight'] : $setting['thumbheight'],
				'thumbwidth' => $type == 'album' ? $setting['maxthumbwidth'] : $setting['thumbwidth'],
				'thumbquality' => $setting['thumbquality'],
				'thumbstatus' => $thumbstatus,
				'thumbimageimpath' => $setting['imageimpath'],
				'thumbsource' => $setting['thumbsource'],
				);
		}
		return empty($key) ? $thumbargs : $thumbargs[$key];
	}
	/**
	 * 读取水印的配置参数
	 * @author JiangHong
	 */
	function get_watermark_args($type, $key = null)
	{
		global $_G;
		$watermarkargs = array();
		$setting = &$_G['setting'];
		$watermarkstatus = unserialize($setting['watermarkstatus']);
		$watermarkstatus = $watermarkstatus[$type];
		if ($watermarkstatus) {
			$watermarkminwidth = unserialize($setting['watermarkminwidth']);
			$watermarkminheight = unserialize($setting['watermarkminheight']);
			$watermarkquality = unserialize($setting['watermarkquality']);
			$watermarktrans = unserialize($setting['watermarktrans']);
			$watermarkargs = array(
				'watermarkstatus' => $watermarkstatus,
				'watermarkminwidth' => $watermarkminwidth[$type],
				'watermarkminheight' => $watermarkminheight[$type],
				'watermarktype' => $setting['watermarktype'][$type],
				'watermarkquality' => $watermarkquality[$type],
				'watermarktrans' => $watermarktrans[$type],
				'watermarkcdntype' => $type == 'portal' ? 2 : 1,
				);
		}
		return empty($key) ? $watermarkargs : $watermarkargs[$key];
	}
	/**
	 * 发送文件和信息
	 */
	function post_attachment($source, $type, $replace = false, $watermark = true, $thumb = true)
	{
		global $_G;
		$server = self::get_server();
		$noautothumb = array(
			'album',
			'plugin',
			);
		$noautowater = array();
		if (! $this->error)
			return false;
		$this->attach['dir_type'] = $type;
		require_once libfile('class/sockpost');
		$args = array(
			'classname' => 'discuz',
			'dir' => $type.'/'.$this->attach['attachdir'],
			'method' => 'ver_file',
			'attachment' => $this->attach['attachment'],
			'replace' => $replace,
			);
		$rotate = max(0, intval($_G['gp_rotate']));
		if($rotate > 0)
		{
			$args['rotate'] = $rotate;
		}
		$thumbargs = (in_array($type, $noautothumb) || ! $thumb) ? array() : self::get_thumb_args();
		$waterargs = (in_array($type, $noautowater) || ! $watermark) ? array() : self::get_watermark_args($type);
		$args = array_merge($args, $thumbargs, $waterargs);
		$callback = array();
		$this->sockreturn = sockpost::post($source, $this->domain, $this->api, $this->attach['attachment'], $this->attach['type'], $args, $callback);
		if ($this->sockreturn['error'] === true) {
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('sockpost');
			$newlogs->log_str($this->sockreturn['errorinfo']);
			return false;
		}
		/*处理返回的信息*/
		$this->return_info['width'] = $this->sockreturn['classreturn']['imageinfo']['width'];
		$this->return_info['height'] = $this->sockreturn['classreturn']['imageinfo']['height'];
		$this->return_info['success'] = $this->sockreturn['save'] ? 'ok' : 'false';
		$this->return_info['serverid'] = $this->serverid;
		$this->return_info['num'] = $this->sockreturn['classreturn']['filesize'];
		$this->return_info['path'] = $this->sockreturn['classreturn']['path'];
		$this->return_info['thumb'] = $this->sockreturn['classreturn']['thumb']['status'] === true ? ($this->sockreturn['classreturn']['thumb']['thumbsource'] == 1 ? 0 : 1) : 0;
		self::space_up();
		if ($this->return_info['success'] == 'ok') {
			return true;
		} else {
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('newattach');
			$newlogs->log_str('发送host:'.$this->domain.' api:'.$this->api.' attachment:'.$this->attach['attachment'].' type:'.$this->attach['type']);
			$newlogs->log_array($this->sockreturn, 'sockreturn');
			return false;
		}
	}
	/**
	 * 将上传所有信息读入，以便记录日志
	 */
	function setlog($attach)
	{
		$this->thislog = $attach;
	}
	/**
	 * 空间type的换算显示
	 * type:1为KB，2为MB，3为GB，4为TB
	 */
	function cal_space($type)
	{
		switch ($type) {
			case '0':
				return 'BY';
				break;
			case '1':
				return 'KB';
				break;
			case '2':
				return 'MB';
				break;
			case '3':
				return 'GB';
				break;
			case '4':
				return 'TB';
				break;
			default:
				return 'no';
				break;
		}
	}
	/**
	 *  serverid 运算
	 */
	function cal_serverid($id)
	{
		return intval(preg_replace("/server_/", "", $id));
	}
	/**
	 * 修改服务器信息
	 */
	function edit_server($args)
	{
		if ($args['mod'] == 'ref_safe') {
			echo self::print_safestring();
			exit;
		}
		self::clear_cache('allserver');
		self::clear_cache('bestserver');
		$args['value'] = iconv("UTF-8", "GBK", $args['value']);
		$serverid = self::cal_serverid($args['serverid']);
		if ($args['mod'] == 'sataus') {
			echo self::change_status($serverid) == 1 ? "<b class='green'>使用中</b>" : "<b class='red'>关闭中</b>";
			exit;
		}
		if ($args['mod'] == 'config') {
			if ($args['method'] == 'change') {
				echo self::open_close($args['method']);
				exit;
			}
			self::config_manage(array('name' => $args['name'], 'value' => $args['value']), $args['method']);
			$return = self::config_manage(array('name' => $args['name']), 'show');
			if ($return[$args['name']] == $args['value']) {
				if ($args['name'] == 'safe_string') {
					$this->safe_string = self::e_safestring($return[$args['name']]);
				}
				echo "修改完成";
			} else {
				echo "修改失败";
			}
			exit;
		}
		DB::update('plugin_attachment_server', array($args['mod'] => $args['value']), array('serverid' => $serverid));
		echo "修改完成";
	}
	/**
	 * 附件服务器状态的转换
	 */
	function change_status($serverid)
	{
		DB::query("UPDATE ".DB::table('plugin_attachment_server')." SET status=status XOR 1 WHERE serverid=".$serverid);
		return DB::result_first("SELECT status FROM ".DB::table('plugin_attachment_server')." WHERE serverid=".$serverid);
	}
	/**
	 * 附件服务器设置
	 */
	function config_manage($args, $mod)
	{
		$return = array();
		switch ($mod) {
			case 'add':
				DB::insert('plugin_attachment_setting', $args);
				break;
			case 'edit':
				if ($args['name'] == 'safe_string') {
					$args['value'] = intval($args['value']);
				}
				DB::update('plugin_attachment_setting', array('value' => $args['value']), array('name' => $args['name']));
				break;
			case 'show':
				$where = empty($args) ? "" : " where name='".$args['name']."'";
				$query = DB::query("SELECT * FROM ".DB::table('plugin_attachment_setting').$where);
				while ($value = DB::fetch($query)) {
					$return[$value['name']] = $value['value'];
				}
		}
		return $return;
	}
	/**
	 * 打印出间隔字符串
	 */
	function print_safestring()
	{
		if (empty($this->safe_string)) {
			$this->safe_string = self::config_manage(array('name' => 'safe_string'), 'show');
			$this->safe_string = $this->safe_string['safe_string'];
			$this->safe_string = self::e_safestring($this->safe_string);
		}
		return $this->safe_string;
	}
	/**
	 * 安全字符串变化
	 */
	function e_safestring($string)
	{
		$return = "||||-";
		for ($i = 0; $i < strlen($string); $i++) {
			$return .= "|".$string[$i]."|-";
		}
		$return .= "||||";
		return $return;
	}
	/**
	 * 服务器增加空间
	 */
	function space_up()
	{
	return;
		$num = $this->return_info['num'];
		if ($this->return_info['success'] == 'ok') {
			require_once libfile('class/myredis');
			$redis = &myredis::instance();
			if ($redis->connected) {
				$redis->obj->hIncrBy('attachment_serverspace', 'space_'.$this->serverid, $num);
				if (substr(time(), -2) == '00' && $redis->hashget('attachment_serverspace', 'space_'.$this->serverid) > 50000000) {
					if ($redis->obj->renamenx('attachment_serverspace', 'attachment_serverspace_doing')) {
						$redis->obj->expire('attachment_serverspace_doing', 30);
						self::space_change_to_db('cache');
					} else {
						if ($redis->obj->ttl('attachment_serverspace_doing') == -1) {
							self::space_change_to_db('cache');
						}
					}
				}
			} else {
				self::space_change_to_db('db', $num);
			}
		}
	}
	/**
	 * 服务器减少空间
	 */
	function space_down($return, $serverid)
	{
	return;
		if ($return[1] == 'ok' && $return[2] == 'del_ok' && $serverid > 0) {
			$num = $return[3];
			require_once libfile('class/myredis');
			$redis = &myredis::instance();
			if ($redis->connected) {
				$redis->obj->hIncrBy('attachment_serverspace', 'space_'.$serverid, -$num);
				if (substr(time(), -2) == '00' && $redis->hashget('attachment_serverspace', 'space_'.$this->serverid) > 50000000 && $redis->obj->renamenx('attachment_serverspace', 'attachment_serverspace_doing')) {
					$redis->obj->expire('attachment_serverspace_doing', 30);
					self::space_change_to_db('cache');
				}
			} else {
				self::space_change_to_db('db', -$num, $serverid);
			}
		}
	}
	/**
	 * 服务器空间的修改
	 */
	private function space_change_to_db($type, $num = 0, $serverid = 0)
	{
		if ($type == 'cache') {
			require_once libfile('class/myredis');
			$redis = &myredis::instance();
			if ($redis->connected) {
				$allspace = $redis->obj->hgetall('attachment_serverspace_doing');
				foreach ($allspace as $key => $value) {
					//$redis->hashdel('attachment_serverspace_doing',$key);
					$change[substr($key, 6)] = $value;
				}
			} else {
				return false;
			}
		}
		if (! isset($change) || ! is_array($change)) {
			$serverid = $serverid == 0 ? $this->serverid : $serverid;
			$change[$serverid] = $num;
		}
		$serverinfo = self::get_server_domain('all', '*');
		foreach ($change as $id => $value) {
			$oldspace = $serverinfo[$id]['space_value'] * pow(1024, $serverinfo[$id]['space_type']);
			$newspace = $oldspace + $value;
			$newspace = self::cal_type_value($newspace);
			DB::update('plugin_attachment_server', $newspace, array('serverid' => $id));
		}
		if ($type == 'cache') {
			$redis->obj->expire('attachment_serverspace_doing', 5);
			self::clear_cache('allserver');
			self::clear_cache('bestserver');
		}
	}
	/**
	 * 单位转换
	 */
	function cal_type_value($num)
	{
		$return['space_value'] = $num;
		$return['space_type'] = 0;
		while ($return['space_value'] > 1024) {
			$return['space_type']++;
			$return['space_value'] = $return['space_value'] / 1024;
		}
		$return['space_value'] = round($return['space_value'], 4);
		return $return;
	}
	/**
	 * 显示服务器是否开启的信息
	 */
	function open_close($method = '')
	{
		if ($method == 'change') {
			DB::query("UPDATE ".DB::table('plugin_attachment_setting')." SET value = value XOR 1 WHERE name = 'server_open'");
		}
		$state = self::config_manage(array('name' => 'server_open'), 'show');
		$state = $state['server_open'];
		if ($method == 'status') {
			return $state;
		}
		$color = $state == 1 ? "green" : "red";
		$display = $state == 1 ? "开启中" : "关闭中";
		return "<a href='javascript:;' class='{$color}' >{$display}</a>";
	}
	/**
	 * 得到上传结果
	 */
	function get_result()
	{
		return $this->return_info;
	}
	/**
	 * 按id查询所在附件服务器的信息
	 */
	function get_server_domain($id, $find = 'name')
	{
		global $_G;
		if (! in_array($find, array(
			'domain',
			'api',
			'*',
			'name')))
			exit;
		$all_server = self::show_server();
		foreach ($all_server as $server_arr) {
			$servers[$server_arr['serverid']] = $server_arr;
			$servers_find[$server_arr['serverid']] = ($find == '*') ? $server_arr : $server_arr[$find];
		}
		foreach( $_G['config']['cdn'] as $_k => $_v ) {
			$_config = $_v;
			$_config['cdnurl'] = $_config['cdnurl'] ? $_config['cdnurl'] : "{$_config['name']}.b0.upaiyun.com";
			$_tmpconfig = array(
				'name' => $_config['cdnurl'],
				'domain' => $_config,
				'serverid' => $_v['serverid'],
				'api' => array( 'class' => $this, 'function' => 'getshowString'),
				'cdnname' => $_k );
			$servers_find[$_v['serverid']] = ($find == '*') ? $_tmpconfig : $_tmpconfig[$find];
		}
		return $id == 'all' ? $servers_find : $servers_find[$id];
	}
	/**
	 * 发送方法请求到附件服务器
	 * $attach_server->post_method($domain,$api,"pic_thumb&pic_attachment=forum/".$attach['attachment']."&pic_name=".$thumbfile."&width=".$w."&height=".$h."&thumbtype=".$type;
	 */
	function post_method($domain, $api, $action)
	{
		if (empty($action))
			exit;
		$addargs = self::add_args();
		//$action .= $addargs;
		$header = "POST {$api}?action=$action HTTP/1.0\r\n";
		$header .= "Host: {$domain}\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$data = "inajax=1&safestr=".base64_encode(self::print_safestring())."&sjnum=".time().$addargs."\r\n\r\n";
		$header .= "Content-length: ".strlen($data)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$fp = fsockopen($domain, 80, $errno, $errinfo, 10);
		if (! $fp) {
			require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$logs = new logs('postmethod');
			$logs->set_filename('post_method');
			echo "连接失败";
			$logs->log_str("发送到[".$domain."/{$api}的行为[$action]连接失败，检查IP或API是否正确");
			return false;
		}
		fputs($fp, $header.$data);
		$getstr = "";
		while (! feof($fp)) {
			$getstr .= fgets($fp, 256);
		}
		fclose($fp);
		$getstr = explode(self::print_safestring(), $getstr);
		return $getstr;
	}
	/**
	 * 增加参数
	 */
	function add_args()
	{
		global $_G;
		$config = array(
			'imagelib',
			'imageimpath',
			'thumbquality',
			'watermarkstatus',
			'watermarkminwidth',
			'watermarkminheight',
			'watermarktype',
			'watermarktext',
			'watermarktrans',
			'watermarkquality');
		$setting = &$_G['setting'];
		$return = "";
		foreach ($config as $arg) {
			$return .= "&".$arg."=".(is_array($setting[$arg]) ? base64_encode(serialize($setting[$arg])) : base64_encode($setting[$arg]));
		}
		return $return;
	}
	/**
	 * 使用redis来存储需要的信息
	 */
	function save_cache($key, $value)
	{
		$updatetime = time();
		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6378);
		$myredis->hashset('attachment_config', $key, serialize($value));
		$myredis->hashset('attachment_updatetime', $key, $updatetime);
	}
	/**
	 * 使用redis来读取需要的信息
	 */
	function load_cache($key)
	{
		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6378);
		$return = $myredis->hashget('attachment_config', $key);
		return ($return ? unserialize($return) : false);
	}
	/**
	 * 检查redis缓存中的更新时间
	 */
	function check_cache($key, $time = 0)
	{
		$nowtime = time();
		$timeupdate = $time == 0 ? $this->time_update : $time;
		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6378);
		$return = $myredis->hashget('attachment_updatetime', $key);
		if (! $return)
			return false;
		return ((($nowtime - $return) < $timeupdate) ? true : false);
	}
	/**
	 * 删除redis中的指定key缓存
	 */
	function clear_cache($key)
	{
		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6378);
		$myredis->hashdel('attachment_config', $key);
	}
	/**
	 * 生成缩略图
	 * @author JiangHong
	 * @param $host : string 接收端IP
	 * @param $api : string 接收端接口文件，php文件
	 * @param $sourcefile : string 缩略的源文件地址（不要带域名）
	 * @param $targetfile : string 保存的缩略图地址（默认为空，将会在生成 原图名.thumb.jpg 的缩略图）
	 * @param $width : int 缩略图的宽
	 * @param $height : int 缩略图的高
	 * @param $type : int 缩略类型，默认为1 ，1将生成原图比例的缩略图，2为生成将会裁剪原图去生成缩略图
	 *
	 *  @param $thumbsource : int 是否缩略原图，默认为0。
	 */
	function Thumb($host, $api, $sourcefile, $targetfile = '', $width, $height, $type = 1, $thumbsource = 0, $thumbdelay = false)
	{
		if( is_array($host) ) {
			return $this->doMethodUpYun( 'thumb', $sourcefile, $host, empty($targetfile) ? ($thumbsource ? $sourcefile : $sourcefile . '.thumb.jpg') : $targetfile, array('width' => $width, 'height' => $height, 'type' => $type, 'delay' => $thumbdelay));
		}
		require_once libfile('class/sockpost');
		$args = array(
			'thumbstatus' => $type,
			'classname' => 'discuz',
			'method' => 'thumb',
			'filesource' => $sourcefile,
			'thumbtarget' => empty($targetfile) ? '' : $targetfile,
			'thumbwidth' => $width,
			'thumbheight' => $height,
			'thumbquality' => self::get_thumb_args('thumbquality'),
			'thumbimageimpath' => self::get_thumb_args('thumbimageimpath'),
			'thumbimagelib' => self::get_thumb_args('thumbimagelib'),
			'thumbsource' => intval($thumbsource),
			);
		$returninfo = sockpost::method($host, $api, $args);
		if ($returninfo['error'] === true) {
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('sockpost');
			$newlogs->log_str($returninfo['errorinfo']);
			return false;
		}
		if ($returninfo['status'] == 'ok' && $returninfo['classreturn']['status']) {
			$this->return_info = $returninfo['classreturn'];
			return true;
		} else {
			$this->sockreturn = $returninfo;
			require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('attach_thumb');
			$newlogs->log_str('attach_thumb:['.$host.']['.$api.']');
			$newlogs->log_array($args, 'args');
			$newlogs->log_array($returninfo, 'returninfo');
			return false;
		}
	}
	/**
	 * 生成水印
	 * @author JiangHong
	 * @param $host : string 接收端IP
	 * @param $api : string 接收端接口文件，php文件
	 * @param $sourcefile : string 水印的源文件地址（不要带域名）
	 * @param $type : string 类型（forum，home等），默认为论坛forum
	 * @param $targetfile : string 目标文件，默认为空，此参数可以设置生成的水印文件名，为空时将对源文件进行水印操作
	 */
	function Watermark($host, $api, $sourcefile, $type = 'forum', $targetfile = '', $setting = array())
	{
		if( is_array($host) ) {
			return $this->doMethodUpYun( 'watermark', $sourcefile, $host);
		}
		require_once libfile('class/sockpost');
		$args = array(
			'classname' => 'discuz',
			'method' => 'watermark',
			'watermarktype' => self::get_watermark_args($type, 'watermarktype'),
			'thumbimagelib' => self::get_thumb_args('thumbimagelib'),
			'watermarkquality' => self::get_watermark_args($type, 'watermarkquality'),
			'watermarkstatus' => self::get_watermark_args($type, 'watermarkstatus'),
			'watermarktrans' => self::get_watermark_args($type, 'watermarktrans'),
			'thumbimageimpath' => self::get_thumb_args('thumbimageimpath'),
			'filesource' => $sourcefile,
			'watermarkminwidth' => self::get_watermark_args($type, 'watermarkminwidth'),
			'watermarkminheight' => self::get_watermark_args($type, 'watermarkminheight'),
			'watertarget' => $targetfile,
			);
		$args = array_merge($args, $setting);
		$returninfo = sockpost::method($host, $api, $args);
		if ($returninfo['error'] === true) {
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('sockpost');
			$newlogs->log_str($returninfo['errorinfo']);
			return false;
		}
		if ($returninfo['status'] == 'ok' && $returninfo['classreturn']['status']) {
			$this->return_info = $returninfo['classreturn'];
			return true;
		} else {
			$this->sockreturn = $returninfo;
			require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('attach_watermark');
			$newlogs->log_str('attach_watermark:['.$host.']['.$api.']');
			$newlogs->log_array($args, 'args');
			$newlogs->log_array($returninfo, 'returninfo');
			return false;
		}
	}
	/**
	 * 删除远端的文件
	 * @author JiangHong
	 * @param $host : string 接收端IP
	 * @param $api : string 接收端接口文件。php文件
	 * @param $sourcefile : string 删除的文件地址（不要带域名）
	 * @param $havethumb : int 是否有缩略图文件（源文件.thumb.jpg） 默认为0
	 * @param $otherthumb : string 是否有其他名称的缩略图(传入尺寸，用|分割)，例如 300|200|100|150 默认为空
	 */
	function delete($host, $api, $sourcefile, $havethumb = 0, $otherthumb = '')
	{
		return true;	//跳过直接删除原文件

		/*
		if( is_array($host) ) {
			$this->doMethodUpYun( 'delete', $sourcefile, $host);
			if($havethumb){
				$this->doMethodUpYun( 'delete', $sourcefile . '.thumb.jpg', $host);
			}
		}
		require_once libfile('class/sockpost');
		$args = array(
			'classname' => 'discuz',
			'method' => 'delete',
			'delfile' => $sourcefile,
			'havethumb' => $havethumb,
			'otherthumb' => $otherthumb,
			);
		//$returninfo = sockpost::method($host , $api , $args);
		//提升通讯效率，不读取返回信息 2013-08-09 by JiangHong
		return sockpost::method($host, $api, $args, true);
		if ($returninfo['error'] === true) {
			require DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('sockpost');
			$newlogs->log_str($returninfo['errorinfo']);
			return false;
		}
		if ($returninfo['status'] == 'ok' && $returninfo['classreturn']['status']) {
			$this->return_info = $returninfo['classreturn'];
			return true;
		} else {
			$this->sockreturn = $returninfo;
			require_once DISCUZ_ROOT.'./source/plugin/logs/logs.class.php';
			$newlogs = new logs('attach_delete');
			$newlogs->log_str('deletefile:['.$host.']['.$api.']');
			$newlogs->log_array($args, 'args');
			$newlogs->log_array($returninfo, 'returninfo');
			return false;
		}
		*/
	}
	/**
	 * 得到sock返回的信息
	 * @author JiangHong
	 */
	function getsockinfo()
	{
		return $this->sockreturn;
	}
	/**
	 * @author JiangHong
	 * @todo copy文件，将文件从原先的文件夹拷贝到新文件夹，若不提供新文件目录名，拷贝的新文件会和原先同样的日期目录和文件名
	 * 例如forum/201403/28/11.jpg 拷贝到plugin 新文件为 plugin/201403/28/11.jpg
	 * @param String $host
	 * @param String $api
	 * @param String $sdir 原先目录
	 * @param String $sattachment 目录文件（attachment表中存储的形式，不带dir）
	 * @param String $tdir 目标目录
	 * @param String $tattachment 新目录文件名（不带dir），若为空则和原文件同样
	 * @param Boolean $deletesource 是否删除源文件，默认为否
	 * @return Boolean
	 * @example copyfile('27.112.8.19', '/newapi.php' 'forum', '201403/28/source.jpg', 'plugin')
	 */
	function copyfile( $host, $api, $sdir, $sattachment, $tdir, $tattachment = '', $deletesource = false )
	{
		if( is_array($host) ) {
			return $this->doMethodUpYun( 'copyfile', $sourcefile, $host);
		}
		global $domain, $_G;
		if ( ! empty( $sdir ) && ! empty( $tdir ) && $sdir != $tdir && ! empty( $sattachment ) )
		{
			require_once libfile('class/sockpost');
			$tattachment = empty($tattachment) ? $sattachment : $tattachment;
			$methodargs = array(
				'classname' => 'discuz',
				'method' => 'copyfile',
				'sfile' => $sdir . '/' . $sattachment,
				'tfile' => $tdir . '/' . $tattachment,
				'move' => $deletesource );
			$return = sockpost::method( $host, $api, $methodargs );
			if ( $return['classreturn']['save'] )
			{
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
	/**
	 * @todo			用于发送文件到又拍服务器
	 * @author			JiangHong
	 * @copyright		2014
	 *
	 */
	function upYunUpload($source, $type, $watermark = false, $thumb = false, $cdnname = 'images')
	{
		global $_G;
		/*又拍测试START*/
		$type = trim($type);
		$config = $_G['config']['cdn'][$cdnname];
		require_once libfile('class/upyun');
		require_once DISCUZ_ROOT . "./source/plugin/logs/logs.class.php";
		$logs = new logs('upyun');
		//$logs->log_str('cdnname : ' . $cdnname);
		if ( class_exists( 'UpYun' ) ) {
			$this->name = !empty($config['cdnurl']) ? $config['cdnurl'] : "http://{$config[name]}.b0.upaiyun.com/";
			$this->serverid = $config['serverid'];
			$upyun = new UpYun( $config['name'], $config['user'], $config['pwd'] );
			try {
				$fp = fopen( $source, 'rb' );
				if ( $fp ) {
					$opts = array();
					if( $this->attach['isimage'] && ( $thumb || $watermark ) ) {
						$opts = $this->getshowString($type, $thumb, $watermark, false, $cdnname);
						//$logs->log_array($opts, 'opts');
					}
					if( $config['secure'] && in_array( $type, array( 'forum', 'album' ) ) ) {
						//$logs->log_str( $_G['uid'] . '|' . $this->attach['attachment'] . '|' . $type );
						$secure = getSecureStr( $_G['uid'], $this->attach['attachment'], $type );
						//$logs->log_str( "secure : " . $secure );
						if( ! empty( $secure ) ) {
							$opts[UpYun::CONTENT_SECRET] = $secure;
						}
					}
					$rotate = max(0, intval($_G['gp_rotate']));
					if($rotate > 0)
					{
						$opts['x-gmkerl-rotate'] = $rotate;
					}
					//$logs->log_array( $opts, 'opts' );
					//$logs->log_str("savepath: <a href='http://{$config[name]}.b0.upaiyun.com/" . $type . "/" . $this->attach['attachment'] . ( $secure ? $config['id'] . $secure : '' ) . "' target='_blank'>{$type}/{$this->attach[attachment]}</a>");
					$rsp = $upyun->writeFile( "/" . $type . "/" . $this->attach['attachment'], $fp, True, $opts );
					//$logs->log_array( $rsp, 'rsp' );
					fclose($fp);
					if ( $rsp ){
						$this->return_info['width'] = $rsp['x-upyun-width'];
						$this->return_info['height'] = $rsp['x-upyun-height'];
						$this->return_info['thumb'] = $this->attach['img_width'] > $this->attach['width'] || $this->attach['img_height'] > $this->attach['height'] ? 1 : 0;
						$this->return_info['serverid'] = $config['serverid'];
						$this->return_info['success'] = 'ok';
						$this->return_info['num'] = $this->attach['size'];
						$this->return_info['path'] = $this->attach['attachment'];
						$this->errorcode = 0;
						$listpush = $this->InsertQueue( 'UpYunCdn', 'downloadattachment', 'UpYunQueue', array( 'attachment' => $this->attach['attachment'], 'dir' => $type, 'cdnname' => $config['name'] ) );
						return $listpush;
					}else{
						$logs->log_str('cdnname : ' . $cdnname);
						$logs->log_str( $_G['uid'] . '|' . $this->attach['attachment'] . '|' . $type );
						$logs->log_str("上传失败，空间");
						$logs->log_array($opts, 'opts');
						$logs->log_array( $rsp, 'rsp' );
					}
				} else {
					$logs->log_str('cdnname : ' . $cdnname);
					$logs->log_str( $_G['uid'] . '|' . $this->attach['attachment'] . '|' . $type );
					$logs->log_str( "file can't open...[{$source}]" );
				}
			}
			catch ( Exception $e ) {
				$logs->log_str('cdnname : ' . $cdnname);
				$logs->log_str( $_G['uid'] . '|' . $this->attach['attachment'] . '|' . $type );
				$logs->log_array($opts, 'opts');
				$upyun_host = gethostbyname("v0.api.upyun.com");
				$logs->log_str( "code:" . $e->getCode() . " | msg:" . $e->getMessage() ." | ".$_SERVER["SERVER_ADDR"]." | UpYun ip:".$upyun_host);
				return false;
			}
		} else {
			$logs->log_str( "no class upyun" );
			return false;
		}
		/*又拍测试END*/
	}
	/**
	 * @todo 根据类型返回需要的串
	 * @param	String		$type		传入类型
	 * @return	String
	 */
	function getshowString($type, $thumb, $watermark, $returnurl = true, $cdnname = 'images'){
		$return = '';
		if( $thumb ) {
			if($type == 'thumbforum'){
				$thumbargs['thumbstatus'] = 3;
				$_ar_width = 825;
				$_ar_height = 0;
				$type = 'forum';
			}else{
				$thumbargs = $this->get_thumb_args( null, $type );
				if( $thumbargs['thumbstatus'] ) {
					$_ar_width = $thumbargs['thumbwidth'];
					$_ar_height = $thumbargs['thumbheight'];
				}
			}
		}
		if( $watermark ) {
			$waterargs = $this->get_watermark_args($type);
			if( $waterargs['watermarkstatus'] > 0 ) {
				$_ar_watertype = $waterargs['watermarkcdntype'];
			}
		}
		// require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
		// $logs = new logs('upyun');
		// $logs->log_str($thumbargs['thumbstatus'] . '|' . $_ar_width . '|' . $_ar_height . '||' . $waterargs['watermarkstatus'] . ' | ' . $_ar_watertype);
		$return = getUpYun( $thumbargs['thumbstatus'] > 0, $_ar_width, $_ar_height, $thumbargs['thumbstatus'], $waterargs['watermarkstatus'], $_ar_watertype, $returnurl, $cdnname );
		// $logs->log_array($return, 'firstreturn');
		if( ! $return && $watermark && $waterargs['watermarkstatus'] > 0 ) {
			$return = getUpYun(false, 0, 0, 1, $waterargs['watermarkstatus'], $_ar_watertype, $returnurl, $cdnname);
		}
		// $logs->log_array($return, 'secondreturn');
		return $return;
	}
	/**
	 * 对cdn的server，使用一些操作
	 * @author JiangHong
	 * @param String		$method		操作类型
	 * @param String		$sourcefile	删除的文件地址（不要带域名）
	 * @param Array			$config		传入cdn配置
	 */
	function doMethodUpYun( $method, $sourcefile, $config ) {
		if( $config['name'] && $config['user'] && $config['pwd'] ) {
			require_once libfile('class/upyun');
			$upyun = new UpYun($config['name'], $config['user'], $config['pwd']);
			switch( $method ) {
				case "delete":
					try{
						$deletereturn = $upyun->delete('/' . $sourcefile);
					}catch(Exception $err){
						require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
						$logs = new logs('upyun_delete');
						$logs->log_str("[$sourcefile] -- " . $err->getMessage());
						return false;
					}
					if($deletereturn){
						$this->InsertQueue( 'UpYunCdn', 'deletefile', 'UpYunQueue', array( 'filepath' => $sourcefile ) );
					}
					return $deletereturn;
					break;
				case "thumb":
					$args = func_get_args();
					if( isset( $args[3] ) && ! empty( $args[3] ) && ! empty( $args[4] )) {
						require_once libfile('class/sockpost');
						$this->get_server();
						if($args[4]['delay'] && $sourcefile != $args[3]){
							$return = $this->InsertQueue( 'UpYunCdn', 'thumbtofile', 'UpYunQueue', array( 'source' => $sourcefile, 'targetpath' => $args[3], 'targetcdnname' => $config['name'], 'targetargs' => implode( '|', attachserver::getUpYunThumbArgs( $args[4]['width'], $args[4]['height'], $args[4]['type'] ) ), 'thumbcustom' => ltrim(getUpYun(true, $args[4]['width'], $args[4]['height'], $args[4]['type'], 0, 1, true, $config['cdnname']), $config['id'] ? $config['id'] : '!'), 'shuaxincdn' => true));
							return $return;
						}else{
							$methodargs = array(
								'classname' => 'UpYunCdn',
								'method' => 'thumbtofile',
								'source' => $sourcefile,
								'targetpath' => $args[3],
								'targetcdnname' => $config['name'],
								'targetargs' => implode( '|', attachserver::getUpYunThumbArgs( $args[4]['width'], $args[4]['height'], $args[4]['type'] ) ),
								'thumbcustom' => ltrim(getUpYun(true, $args[4]['width'], $args[4]['height'], $args[4]['type'], 0, 1, true, $config['cdnname']), $config['id'] ? $config['id'] : '!'));
							$return = sockpost::method($this->domain, $this->api, $methodargs);
							if( $return['classreturn']['save'] ){
								$listpush = $this->InsertQueue( 'UpYunCdn', 'downloadattachment', 'UpYunQueue', array( 'filepath' => $args[3], 'cdnname' => $config['name'] ));
								$shuaxinreturn = attachserver::shuaxinCdn( $config['cdnname'], 'http://' . $config['cdnurl'] . '/' . $args['targetpath'] );
								return $listpush;
							}else{
								require_once DISCUZ_ROOT . './source/plugin/logs/logs.class.php';
								$logs = new logs('upyun_thumb');
								$logs->log_array(array('return' => $return, 'send' => $methodargs), 'errorreturn');
							}
						}
					}
				default:
					return false;
					break;
			}
		}
		return false;
	}
	/**
	 * @todo 读取自定义缩放参数
	 * @param		Int		$width
	 * @param		Int		$height
	 * @param		Int		$type
	 * @return array;
	 */
	public static function getUpYunThumbArgs($width, $height, $type, $quality = 95, $unsharp = true, $returnkey = false){
		if( ( $width > 10 || $height > 10 ) && $type > 0 ){
			require_once libfile('class/upyun');
			switch($type){
				case 2:
					$stype = 'fix_both';$svalue = "{$width}x{$height}";break;
				case 3:
					$stype = 'fix_width';$svalue = $width;break;
				case 4:
					$stype = 'fix_height';$svalue = $height;break;
				case 5:
					$stype = 'fix_max';$svalue = max( $width, $height );break;
				case 6:
					$stype = 'fix_min';$svalue = min( $width, $height );break;
				default:
					$stype = 'fix_width_or_height';$svalue = "{$width}x{$height}";break;
			}
			return $returnkey ? array(
					UpYun::X_GMKERL_TYPE => $stype,
					UpYun::X_GMKERL_VALUE => $svalue,
					UpYun::X_GMKERL_QUALITY => $quality,
					UpYun::X_GMKERL_UNSHARP => $unsharp) : array(
					UpYun::X_GMKERL_TYPE . "=" . $stype,
					UpYun::X_GMKERL_VALUE . "=" . $svalue,
					UpYun::X_GMKERL_QUALITY . "=" . $quality,
					UpYun::X_GMKERL_UNSHARP . "=" . $unsharp);
		}
		return array();
	}
	/**
	 * 刷新CDN
	 * @param		String			CDN名
	 * @param		String Array	$urls
	 * @return		Array
	 */
	public static function shuaxinCdn($cdnname, $urls){
		$urldata = '';
		global $_G;
		$config = $_G['config']['cdn'][$cdnname];
		$return = array('status' => false);
		if( $config ) {
			$urls = is_array( $urls ) ? $urls : array( $urls );
			foreach ( $urls as $_value )
			{
				if ( preg_match( "/^http(s)?:\/\/\S*/i", $_value ) )
				{
					$urldata .= trim( $_value ) . "\n";
					$_allurl[] = $_value;
				}
			}
			$return['errorurl'] = $_allurl;
			$urldata = trim( $urldata );
			if ( strlen( $urldata ) > 1 )
			{
				require_once libfile( 'function/filesock' );
				$datetime = gmdate( 'D, d M Y H:i:s \G\M\T' );
				$sign = md5( $urldata . "&" . $config['name'] . "&" . $datetime . "&" . md5( $config['pwd'] ) ); //
				$postheader = "Expect:\r\n";
				$postheader .= "Authorization: UpYun {$config['name']}:{$config['user']}:{$sign}\r\n";
				$postheader .= "DATE: {$datetime}";
				$postdata = "purge=" . urlencode( $urldata );
				$returns = _dfsockopen( $config['url'], 0, $postdata, '', false, '', 15, true, $postheader );
				$returnjson = json_decode( $returns );
				if ( ! is_null( $returnjson ) )
				{
					if(! empty($returnjson->invalid_domain_of_url)){
						$return['errorurl'] = $returnjson->invalid_domain_of_url;
						$_allurl = array_diff($_allurl, $returnjson->invalid_domain_of_url);
					}else{
						$return['errorurl'] = '';
					}
					if( count( $_allurl ) ) {
						$return['status'] = true;
						$return['successurl'] = $_allurl;
					}
				}
			}else{
				$return['message'] = 'urldata empty';
			}
		}
		return $return;
	}
	/**
	 * @todo 加入队列
	 * @param String $class		类名
	 * @param String $func		方法名
	 * @param String $queuename	队列名
	 * @param Array  $params	参数
	 * @return Boolean
	 */
	public static function InsertQueue($class, $func, $queuename, $params = array()){
		require_once libfile( 'class/myredis' );
		$redis = myredis::instance(6382);
		$redis->SELECTDB(0);
		$thumblist = array(
				'class' => $class,
				'function' => $func,
				'argument' => $params,
			);
		$listpush = $redis->RPUSH($queuename, serialize( $thumblist ));
		return $listpush > 0 ? true : false;
	}
	/**
	 * 读取增加的参数
	 */
	public static function getPreStr( $domaininfo, $type = 'forum', $thumb = true, $water = true ){
		if( is_array( $domaininfo['api'] ) ){
			if( $domaininfo['api']['class'] ) {
        		$_callback = array( $domaininfo['api']['class'], $domaininfo['api']['function'] );
        	} else {
        		$_callback = $domaininfo['api']['function'];
        	}
        	return call_user_func_array( $_callback, array( $type, $thumb, $water, true ) );
		}
		return '';
	}
}
?>
