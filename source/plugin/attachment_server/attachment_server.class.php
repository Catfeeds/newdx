<?php
/**
 * @version 2012.09.07
 * @author jianghong
 * @todo ����������������
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
		//echo "���ӳɹ�";
	}
	/**
	 * ��ʾ���з�������Ϣ
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
	 * ��Ӹ���������
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
	 * ��ѯ��ǰ���ٿռ�ĸ���������
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
	 * ���ظ���������������
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
	 * ���ø�������Ϣ
	 * ����$attach
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
			/*����Ҫ��������Ϣ��ȫ�ֱ���$_G����ȡ����*/
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
	 * ��ȡ����ͼ�����ò���
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
	 * ��ȡˮӡ�����ò���
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
	 * �����ļ�����Ϣ
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
		/*�����ص���Ϣ*/
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
			$newlogs->log_str('����host:'.$this->domain.' api:'.$this->api.' attachment:'.$this->attach['attachment'].' type:'.$this->attach['type']);
			$newlogs->log_array($this->sockreturn, 'sockreturn');
			return false;
		}
	}
	/**
	 * ���ϴ�������Ϣ���룬�Ա��¼��־
	 */
	function setlog($attach)
	{
		$this->thislog = $attach;
	}
	/**
	 * �ռ�type�Ļ�����ʾ
	 * type:1ΪKB��2ΪMB��3ΪGB��4ΪTB
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
	 *  serverid ����
	 */
	function cal_serverid($id)
	{
		return intval(preg_replace("/server_/", "", $id));
	}
	/**
	 * �޸ķ�������Ϣ
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
			echo self::change_status($serverid) == 1 ? "<b class='green'>ʹ����</b>" : "<b class='red'>�ر���</b>";
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
				echo "�޸����";
			} else {
				echo "�޸�ʧ��";
			}
			exit;
		}
		DB::update('plugin_attachment_server', array($args['mod'] => $args['value']), array('serverid' => $serverid));
		echo "�޸����";
	}
	/**
	 * ����������״̬��ת��
	 */
	function change_status($serverid)
	{
		DB::query("UPDATE ".DB::table('plugin_attachment_server')." SET status=status XOR 1 WHERE serverid=".$serverid);
		return DB::result_first("SELECT status FROM ".DB::table('plugin_attachment_server')." WHERE serverid=".$serverid);
	}
	/**
	 * ��������������
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
	 * ��ӡ������ַ���
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
	 * ��ȫ�ַ����仯
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
	 * ���������ӿռ�
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
	 * ���������ٿռ�
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
	 * �������ռ���޸�
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
	 * ��λת��
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
	 * ��ʾ�������Ƿ�������Ϣ
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
		$display = $state == 1 ? "������" : "�ر���";
		return "<a href='javascript:;' class='{$color}' >{$display}</a>";
	}
	/**
	 * �õ��ϴ����
	 */
	function get_result()
	{
		return $this->return_info;
	}
	/**
	 * ��id��ѯ���ڸ�������������Ϣ
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
	 * ���ͷ������󵽸���������
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
			echo "����ʧ��";
			$logs->log_str("���͵�[".$domain."/{$api}����Ϊ[$action]����ʧ�ܣ����IP��API�Ƿ���ȷ");
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
	 * ���Ӳ���
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
	 * ʹ��redis���洢��Ҫ����Ϣ
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
	 * ʹ��redis����ȡ��Ҫ����Ϣ
	 */
	function load_cache($key)
	{
		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6378);
		$return = $myredis->hashget('attachment_config', $key);
		return ($return ? unserialize($return) : false);
	}
	/**
	 * ���redis�����еĸ���ʱ��
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
	 * ɾ��redis�е�ָ��key����
	 */
	function clear_cache($key)
	{
		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6378);
		$myredis->hashdel('attachment_config', $key);
	}
	/**
	 * ��������ͼ
	 * @author JiangHong
	 * @param $host : string ���ն�IP
	 * @param $api : string ���ն˽ӿ��ļ���php�ļ�
	 * @param $sourcefile : string ���Ե�Դ�ļ���ַ����Ҫ��������
	 * @param $targetfile : string ���������ͼ��ַ��Ĭ��Ϊ�գ����������� ԭͼ��.thumb.jpg ������ͼ��
	 * @param $width : int ����ͼ�Ŀ�
	 * @param $height : int ����ͼ�ĸ�
	 * @param $type : int �������ͣ�Ĭ��Ϊ1 ��1������ԭͼ����������ͼ��2Ϊ���ɽ���ü�ԭͼȥ��������ͼ
	 *
	 *  @param $thumbsource : int �Ƿ�����ԭͼ��Ĭ��Ϊ0��
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
	 * ����ˮӡ
	 * @author JiangHong
	 * @param $host : string ���ն�IP
	 * @param $api : string ���ն˽ӿ��ļ���php�ļ�
	 * @param $sourcefile : string ˮӡ��Դ�ļ���ַ����Ҫ��������
	 * @param $type : string ���ͣ�forum��home�ȣ���Ĭ��Ϊ��̳forum
	 * @param $targetfile : string Ŀ���ļ���Ĭ��Ϊ�գ��˲��������������ɵ�ˮӡ�ļ�����Ϊ��ʱ����Դ�ļ�����ˮӡ����
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
	 * ɾ��Զ�˵��ļ�
	 * @author JiangHong
	 * @param $host : string ���ն�IP
	 * @param $api : string ���ն˽ӿ��ļ���php�ļ�
	 * @param $sourcefile : string ɾ�����ļ���ַ����Ҫ��������
	 * @param $havethumb : int �Ƿ�������ͼ�ļ���Դ�ļ�.thumb.jpg�� Ĭ��Ϊ0
	 * @param $otherthumb : string �Ƿ����������Ƶ�����ͼ(����ߴ磬��|�ָ�)������ 300|200|100|150 Ĭ��Ϊ��
	 */
	function delete($host, $api, $sourcefile, $havethumb = 0, $otherthumb = '')
	{
		return true;	//����ֱ��ɾ��ԭ�ļ�

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
		//����ͨѶЧ�ʣ�����ȡ������Ϣ 2013-08-09 by JiangHong
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
	 * �õ�sock���ص���Ϣ
	 * @author JiangHong
	 */
	function getsockinfo()
	{
		return $this->sockreturn;
	}
	/**
	 * @author JiangHong
	 * @todo copy�ļ������ļ���ԭ�ȵ��ļ��п��������ļ��У������ṩ���ļ�Ŀ¼�������������ļ����ԭ��ͬ��������Ŀ¼���ļ���
	 * ����forum/201403/28/11.jpg ������plugin ���ļ�Ϊ plugin/201403/28/11.jpg
	 * @param String $host
	 * @param String $api
	 * @param String $sdir ԭ��Ŀ¼
	 * @param String $sattachment Ŀ¼�ļ���attachment���д洢����ʽ������dir��
	 * @param String $tdir Ŀ��Ŀ¼
	 * @param String $tattachment ��Ŀ¼�ļ���������dir������Ϊ�����ԭ�ļ�ͬ��
	 * @param Boolean $deletesource �Ƿ�ɾ��Դ�ļ���Ĭ��Ϊ��
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
	 * @todo			���ڷ����ļ������ķ�����
	 * @author			JiangHong
	 * @copyright		2014
	 *
	 */
	function upYunUpload($source, $type, $watermark = false, $thumb = false, $cdnname = 'images')
	{
		global $_G;
		/*���Ĳ���START*/
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
						$logs->log_str("�ϴ�ʧ�ܣ��ռ�");
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
		/*���Ĳ���END*/
	}
	/**
	 * @todo �������ͷ�����Ҫ�Ĵ�
	 * @param	String		$type		��������
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
	 * ��cdn��server��ʹ��һЩ����
	 * @author JiangHong
	 * @param String		$method		��������
	 * @param String		$sourcefile	ɾ�����ļ���ַ����Ҫ��������
	 * @param Array			$config		����cdn����
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
	 * @todo ��ȡ�Զ������Ų���
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
	 * ˢ��CDN
	 * @param		String			CDN��
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
	 * @todo �������
	 * @param String $class		����
	 * @param String $func		������
	 * @param String $queuename	������
	 * @param Array  $params	����
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
	 * ��ȡ���ӵĲ���
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
