<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('PORTAL_HOST', $_G['config']['web']['portal']);
define('FORUM_HOST', $_G['config']['web']['forum']);
define('HOME_HOST', $_G['config']['web']['home']);

require_once DISCUZ_ROOT.'./source/plugin/components/ipdata/ipdata.php';

switch ($_G['fid']) {
	case $_G['config']['fids']['zbfx']:
	    require_once DISCUZ_ROOT.'./source/plugin/forumoption/produce.php';
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/resizeimage.php';
		break;
	case $_G['config']['fids']['mudidi']:
		/*if($_G['gp_action'] != 'newthread')
		{
			header('HTTP/1.1 301 Moved Permanently');
			$url = $_G['tid'] > 0 ? $_G['config']['web']['forum'].'whither-' . $_G['tid']. '.html' : $_G['config']['web']['forum'].'newmudidi.php';
			header('Location: ' . $url);
			exit;
		}
		$ralate = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = '{$_G['tid']}'");
		if (preg_match_all('/\d+/', $ralate['sn'], $m) == 4) {
			header("Location: ".$_G['config']['web']['forum']."forum-".$_G['config']['fids']['mudidi']."-1.html");
			exit;
		}*/
		require_once DISCUZ_ROOT.'./source/plugin/forumoption/mudidi.php';
		require_once DISCUZ_ROOT.'./source/plugin/components/DXCache.php';
		$forumoption_mudidi->recordUser();
		// ��ʼ��������
		$dxCache = new DXDbCache();
		$prefix = 'mudidi_';
		$prefix .= $_G['fid'] ? $_G['fid']."_": "";
		$prefix .= $_G['tid'] ? $_G['tid']."_": "";
		$dxCache->prefix = $prefix;
		$dxCache->cachetime = 86400; // 3600 * 24
		if ($_GET['nocache'] == 1) {
			$dxCache->disabled = true;
		}
		break;
	default:
		break;
}

class ForumOption {
	public $forum_setting;
	function ForumOption() {
		$this->init();
		$this->initHosts();
		$this->initFullScreen();
	}
	/*
	 * ��ʼ������
	 * ��������ָ��������
	 */
	function initHosts() {
		global $_G;
		if($_G['gp_action']=="removeindexheats"||$_G['gp_action']=="forums"){
		  return;
		}
		if (($_GET['fid'] == $_G['config']['fids']['zbfx'] || $_G['fid'] == $_G['config']['fids']['zbfx']) && $_G['config']['fids']['zbfx'] > 0  && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax']) && empty($_POST['ctl'])) {
			$url = $_G['config']['web']['portal'].'zb';
			if ($_GET['mod'] == 'forumdisplay') {
				if ($_GET['type']) {
					$url .= '-type-'.$_GET['type'];
				}
				if ($_GET['brand']) {
					$url .= '-brand-'.$_GET['brand'];
					if ($_GET['id']) {
						$url .= '-id-'.$_GET['id'];
					}
				}
				if ($_GET['filter']) {
					$url .= '-filter-'.$_GET['filter'];
				}
				if ($_GET['orderby']) {
					$url .= '-orderby-'.$_GET['orderby'];
				}
				if (intval($_GET['page']) > 1) {
					$url .= '-page-'.$_GET['page'];
				}
			} elseif ($_GET['mod'] == 'viewthread' && $_GET['tid']) {
				$url .= '-'.$_GET['tid'];
				$_GET['page'];
				if ($_GET['page']) {
					$url .= '-'.$_GET['page'];
				}
			}
			//*�˴�������װ���������������װ����ҳ��*//
			$url = $_G['config']['web']['portal'] . "zhuangbei";
			//*end*//
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		} elseif(($_GET['fid'] == $_G['config']['fids']['dianpu'] || $_G['fid'] == $_G['config']['fids']['dianpu']) && $_G['config']['fids']['dianpu'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])){
			$url = $_G['config']['web']['portal'].'dianpu';
			if ($_GET['mod'] == 'forumdisplay') {
				if ($_GET['key']) {
					$url .= '-key-'.$_GET['key'];
				}
				if ($_GET['tb']) {
					$url .= '-weblist';
					if (intval($_GET['page']) > 1) {
						$url .= '-'.$_GET['page'];
					}
				}
			}elseif ($_GET['mod'] == 'viewthread' && $_GET['tid']) {
				$url .= '-'.$_GET['tid'];
				$_GET['page'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		}elseif(($_GET['fid'] == $_G['config']['fids']['skiing'] || $_G['fid'] == $_G['config']['fids']['skiing']) && $_G['config']['fids']['skiing'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])){
			$url = $_G['config']['web']['portal'].'xuechang';
			if ($_GET['mod'] == 'forumdisplay') {
				if (($_GET['filter']=='heats')&&(intval($_GET['page']) > 1)) {
					$url .= '-1';
				}
				if (intval($_GET['page']) > 1) {
					$url .= '-'.$_GET['page'];
				}

			}elseif ($_GET['mod'] == 'viewthread' && $_GET['tid']) {
				$url .= '-'.$_GET['tid'];
				$_GET['page'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		} elseif (($_GET['fid'] == $_G['config']['fids']['produce'] || $_G['fid'] == $_G['config']['fids']['produce']) && $_G['config']['fids']['produce'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])){
			$url = $_G['config']['web']['portal'].'pinpai';
			if ($_GET['mod'] == 'forumdisplay') {
				if (($_GET['filter']=='heats')&&(intval($_GET['page']) > 1)) {
					$url .= '-1';
				}
				if (intval($_GET['page']) > 1) {
					$url .= '-'.$_GET['page'];
				}

			}elseif ($_GET['mod'] == 'viewthread' && $_GET['tid']) {
				$url .= '-'.$_GET['tid'];
				$_GET['page'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		} elseif (($_GET['fid'] == $_G['config']['fids']['equipment'] || $_G['fid'] == $_G['config']['fids']['equipment']) && $_G['config']['fids']['equipment'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])){
			// lxp 20131128
			$url = $_G['config']['web']['portal'].'zhuangbei';
			if ($_GET['mod'] == 'forumdisplay') {
				if (($_GET['filter']=='heats')&&(intval($_GET['page']) > 1)) {
					$url .= '-1';
				}
				if (intval($_GET['page']) > 1) {
					$url .= '-'.$_GET['page'];
				}
			}elseif ($_GET['mod'] == 'viewthread' && $_GET['tid']) {
				$url .= '-'.$_GET['tid'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		} elseif (($_GET['fid'] == $_G['config']['fids']['line'] || $_G['fid'] == $_G['config']['fids']['line']) && $_G['config']['fids']['line'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])){
			//��·
			$arrMod = array("viewthread"=>1, "redirect"=>1);
			$url = $_G['config']['web']['portal'].'xianlu';
			if ($_GET['mod'] == 'forumdisplay') {
				if (($_GET['filter']=='heats')&&(intval($_GET['page']) > 1)) {
					$url .= '-1-0-0-0-1';
				}
				if (intval($_GET['page']) > 1) {
					$url .= '-'.$_GET['page'];
				}
			}elseif (isset($arrMod[$_GET['mod']]) && $_GET['tid']) {
				$url .= '-'.$_GET['tid'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		} elseif(($_GET['fid'] == $_G['config']['fids']['climb'] || $_G['fid'] == $_G['config']['fids']['climb']) && $_G['config']['fids']['climb'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])) {
			//climb, if customers access like 'http://bbs.8264.com/forum.php?mod=viewthread&tid=2161505&page=1', it should redirected to 'http://www.8264.com/climb-2161505'
			$arrMod = array("viewthread"=>1, "redirect"=>1);
			$url = $_G['config']['web']['portal'].'panpa/';
			if (isset($arrMod[$_GET['mod']]) && $_GET['tid']) {
				$url .= $_GET['tid'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
				$url .= '.html';
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		} elseif(($_GET['fid'] == $_G['config']['fids']['club'] || $_G['fid'] == $_G['config']['fids']['club']) && $_G['config']['fids']['club'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])) {
			//climb, if customers access like 'http://bbs.8264.com/forum.php?mod=viewthread&tid=2161505&page=1', it should redirected to 'http://www.8264.com/climb-2161505'
			$arrMod = array("viewthread"=>1, "redirect"=>1);
			$url = $_G['config']['web']['portal'].'julebu/';
			if (isset($arrMod[$_GET['mod']]) && $_GET['tid']) {
				$url .= $_GET['tid'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
				$url .= '.html';
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		}elseif(($_GET['fid'] == $_G['config']['fids']['hostel'] || $_G['fid'] == $_G['config']['fids']['hostel']) && $_G['config']['fids']['hostel'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])) {
			//climb, if customers access like 'http://bbs.8264.com/forum.php?mod=viewthread&tid=2161505&page=1', it should redirected to 'http://www.8264.com/climb-2161505'
			$arrMod = array("viewthread"=>1, "redirect"=>1);
			$url = $_G['config']['web']['portal'].'kezhan/';
			if (isset($arrMod[$_GET['mod']]) && $_GET['tid']) {
				$url .= $_GET['tid'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
				$url .= '.html';
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		}elseif(($_GET['fid'] == $_G['config']['fids']['diving'] || $_G['fid'] == $_G['config']['fids']['diving']) && $_G['config']['fids']['diving'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])) {
            $arrMod = array("viewthread"=>1, "redirect"=>1);
            $url = $_G['config']['web']['portal'].'qianshui/';
            if (isset($arrMod[$_GET['mod']]) && $_GET['tid']) {
                $url .= $_GET['tid'];
                if ($_GET['page']>1) {
                    $url .= '-'.$_GET['page'];
                }
                $url .= '.html';
            }
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: '.$url);
            exit;
        }elseif(($_GET['fid'] == $_G['config']['fids']['fishing'] || $_G['fid'] == $_G['config']['fids']['fishing']) && $_G['config']['fids']['fishing'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])) {
            $arrMod = array("viewthread"=>1, "redirect"=>1);
            $url = $_G['config']['web']['portal'].'diaoyu/';
            if (isset($arrMod[$_GET['mod']]) && $_GET['tid']) {
                $url .= $_GET['tid'];
                if ($_GET['page']>1) {
                    $url .= '-'.$_GET['page'];
                }
                $url .= '.html';
            }
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: '.$url);
            exit;
        }elseif(($_GET['fid'] == $_G['config']['fids']['chain'] || $_G['fid'] == $_G['config']['fids']['chain']) && $_G['config']['fids']['chain'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])) {
            $arrMod = array("viewthread"=>1, "redirect"=>1);
            $url = $_G['config']['web']['portal'].'gongyinglian/';
            if (isset($arrMod[$_GET['mod']]) && $_GET['tid']) {
                $url .= $_GET['tid'];
                if ($_GET['page']>1) {
                    $url .= '-'.$_GET['page'];
                }
                $url .= '.html';
            }
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: '.$url);
            exit;
        }elseif(($_GET['fid'] == $_G['config']['fids']['mountain'] || $_G['fid'] == $_G['config']['fids']['mountain']) && $_G['config']['fids']['mountain'] > 0 && $_GET['mod'] != 'post' && empty($_GET['newurl']) && empty($_GET['inajax'])){
			$url = $_G['config']['web']['portal'].'shanfeng';
			if ($_GET['mod'] == 'forumdisplay') {
				if (($_GET['filter']=='heats')&&(intval($_GET['page']) > 1)) {
					$url .= '-1';
				}
				if (intval($_GET['page']) > 1) {
					$url .= '-'.$_GET['page'];
				}

			}elseif ($_GET['mod'] == 'viewthread' && $_GET['tid']) {
				$url .= '-'.$_GET['tid'];
				$_GET['page'];
				if ($_GET['page']>1) {
					$url .= '-'.$_GET['page'];
				}
			}
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		}elseif ($_GET['newurl'] && $_G['fid'] != $_G['config']['fids']['zbfx']) {
			if($_G['fid'] == $_G['config']['fids']['dianpu']){
				if($_GET['pro']==0&&$_GET['reg']==0&&$_GET['sshop']==0&&$_GET['cbrand']==0&&$_GET['brand']==0&&$_GET['filter']=="score"&&$_GET['page']==1&&$_GET['sub']==""){
				  if($_GET['key']==NULL){
					$url = $_G['config']['web']['portal'].'dianpu';
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: '.$url);
					exit;
				  }else{

				  }
				}
			}elseif($_G['fid'] == $_G['config']['fids']['skiing']){
				if($_GET['pro']==0&&$_GET['filter']=="heats"&&$_GET['page']==1&&$_GET['sub']==""){
				  if($_GET['key']==NULL){
					$url = $_G['config']['web']['portal'].'xuechang';
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: '.$url);
					exit;
				  }
				}
			}elseif($_G['fid'] == $_G['config']['fids']['produce']){
				if($_GET['filter']=="heats"&&$_GET['page']==1&&$_GET['cp']=="0"&&$_GET['nat']=="0"&&$_GET['let']=="0"){
				  if($_GET['key']==NULL){
					$url = $_G['config']['web']['portal'].'pinpai';
					header('HTTP/1.1 301 Moved Permanently');
					header('Location: '.$url);
					exit;
				  }else{

				  }
				}
			}else{
				header('HTTP/1.1 404 Not Found');
				header('Status: 404');
				echo "<html><head><title>404 Not Found</title></head><body bgcolor='white'><center><h1>404 Not Found</h1></center><hr><center>Microsoft IIS 5.0 Pighead Edit 10006 newurl</center></body></html>";
				exit;
			}
		}
		/*elseif($_G['fid'] == 433){	//�ɰ�Ŀ�ĵ���ת����·
			$url = $_G['config']['web']['portal'].'xianlu';
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$url);
			exit;
		}*/
	}
	/*
	 * �����Ƿ��ʹ������
	 */
	function isUseable($option = NULL) {
		$forum_optionid = $this->getForumOptionid();
		if ($forum_optionid == 0)
			return false;
		return true;
	}

	/**
	 * ������̳ȫ������
	 * @param string $name ��̳���õĲ�����, ��Ӧ��plugin_forumoption_setting���е�name�ֶ�
	 * @return string ���ز�ѯ������������, ���δ��ѯ������ false
	 */
	function getSetting($name) {
		static $settings = array();
		if ($settings && isset($settings[$name])) {
			return $settings[$name];
		}
		$settings = $this->forum_setting;
		if (!isset($settings[$name])) {
			// no setting
			return false;
		}
		return $settings[$name];
	}
	/*
	 * ����forumoption id
	 */
	function getForumOptionid() {
		global $_G;
		static $forum_optionid  = NULL;
		if ($forum_optionid != NULL) {
			return $forum_optionid;
		}
		$forum_optionid = 0;
		$fid = !empty($_G['fid']) ? $_G['fid']: 0;
		$typeid = 0;
		if ($_G['mod'] == 'forumdisplay') {
			$typeid = $_G['gp_sortid']; // ���
		} else {
			if (empty($_G['tid'])) {
				return $forum_optionid;
			}
			$tid = $_G['tid'];
			if(!intval($_G['tid'])) {
				return 0;
			}
			$field = DB::fetch_first("SELECT sortid FROM ".DB::table('forum_thread')." WHERE tid = ".$tid);
			if ($field['sortid']) {
				$typeid = $field['sortid'];
			}
		}
		if ($fid == 0||$typeid==0) {
		    return $forum_optionid;
		}
		$query = DB::query("SELECT * FROM ".DB::table('plugin_forumoption')."
				    where fid = {$fid}");
		$options = array();
		while ($option = DB::fetch($query)) {
				if ($option['typeid']!=0 && $option['typeid']==$typeid) {
					$forum_optionid = $option['id']; //����ƥ��
					break;
				} elseif ($option['typeid']==0 && $option['fid']==$fid) {
					$forum_optionid = $option['id']; //�Ǿ���ƥ��, ����Ѱ�Ҿ���ƥ��
				}
		}
		return $forum_optionid;
	}

	/**
	 * �����Ƿ���Ĭ����ʾ��������
	 */
	function isDigested($fid) {
		$optionid = DB::result_first('SELECT id FROM '.DB::table('plugin_forumoption')." WHERE fid = $fid");
		if (!$optionid) {
			return false;
		}
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_forumoption_field').
			" WHERE optionid = ".$optionid.
			" AND type = 'isDigest' AND value = 1");
	}

	/*
	 * ����ForumOption������
	 *
	 */
	function getForumOptionByType($type) {
		if ($type == NULL) {
			return NULL;
		}
		$field = DB::fetch_first("SELECT * FROM ".DB::table('plugin_forumoption_field')."
                                  WHERE optionid = ".$this->getForumOptionid()." AND type = '{$type}'");
		if ($field) {
			return $field;
		}
		return NULL;
	}

	/*
	 * ����ҳͷ���Ĵ���
	 *
	 */
	function getHeaderAd() {
		if (!$this->isUseable()) {
			return '';
		}
		static $code = '';
		if ($code != '') {
			return $code;
		}
		$forum_optionid = $this->getForumOptionid();
		$field = $this->getForumOptionByType('headerAd');
		if ($field && $field['value']) {
			$advid = $field['value'];
			$ad = DB::fetch_first("SELECT * FROM ".DB::table('common_advertisement')." WHERE advid = {$advid}");
			if ($ad) {
				$code = $ad['code'];
			}
		}
		return $code;
	}

	/*
	 * �ж��Ƿ����js���Ĵ���
	 *
	 */
	function getJsAdinfo() {
		global $_G;
		if (!$this->isUseable()) {
			return '';
		}
		$forum_optionid = $this->getForumOptionid();
		$field = $this->getForumOptionByType('isLoadjs');

		//if ($field['value']) {
		   $flag=$field['value'];
		//}

		return $flag;
	}

	function getSetForumidArr(){
		if(!memory('get', 'oBmjvS_fid')){
			$query = DB::query("SELECT * FROM ".DB::table('plugin_forumoption')." where 1=1");
			$arr = array();
			while ($value = DB::fetch($query)) {
					$arr[] = $value['fid'];
			}
			memory('set', 'oBmjvS_fid', $arr, 3600);
		}
		return memory('get', 'oBmjvS_fid');
	}

	/*
	 * ��ʼ��ȫ����ʾ
	 */
	function initFullScreen(){
		if (!$this->isUseable()) {
			return false;
		}
		static $is_init = false;
		if ($is_init) return;
		$is_init = true;
		global $_G;
		// ��ʼ���Ƿ�ȫ��
		$forumoption_field_type = $_G['mod'] == 'forumdisplay' ? 'isFullScreen' : 'isFullScreen_viewthread';
		$field = $this->getForumOptionByType($forumoption_field_type);
		if ($field) {
			if ($field['value'] == 1) {
				$_G['cookie']['widthauto'] = 1;
				$_G['cookie']['forcewidthauto'] = 1;
			} elseif ($field['value'] == 2) {
				$_G['cookie']['widthauto'] = 2;
				$_G['cookie']['forcewidthauto'] = 1;
			}
			$_G['cookie']['forcewidthauto'] = 0;
		}
	}


	/*
	 * forum_viewthread.php line:520
	 * ���fid==408 ��ÿҳ��ʾ���� �����ظ�˳��ʱ�併������
	 */
	function hookScript1($query, $posttable) {
		global $_G;
		if (in_array($_G['fid'],$_G['config']['fids'])) {
			if (stripos($query, 'ORDER BY p.dateline DESC') === false) {
				$query = str_replace('ORDER BY p.dateline', 'ORDER BY p.dateline DESC', $query);
			}
			$query = "(select p.* FROM ".DB::table($posttable)." p where p.tid='{$_G[gp_tid]}' AND p.invisible='0' AND p.first='1') UNION (".$query.")";
		}
		//echo $query;exit;
		return $query;
	}

	/*
	 * forum_viewthread.php line:732
	 */
	function hookScript2($sufix) {
		global $_G;
		if ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			$ralate = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = {$_G['tid']}");
			if ($ralate['type']) {
				switch ($ralate['type']) {
					case '1':
						$scape = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_scape')." WHERE sn = '{$ralate['sn']}'");
						switch ($scape['type']) {
							case 0:
								return template('diy:forum/viewthreadmudidi_scape'.$sufix.':'.$_G['fid']);
								break;
							case 1:
								return template('diy:forum/viewthreadmudidi_scape_ski'.$sufix.':'.$_G['fid']);
								break;
							default:
								return template('diy:forum/viewthreadmudidi_scape_default'.$sufix.':'.$_G['fid']);
								break;
						}
						break;
					case '2':
						return template('diy:forum/viewthreadmudidi_scapearea'.$sufix.':'.$_G['fid']);
						break;
					case '3':
						return template('diy:forum/viewthreadmudidi_region'.$sufix.':'.$_G['fid']);
						break;
					default:
						break;
				}
			}
		} elseif ($_G['fid'] == $_G['config']['fids']['zbfx']) {
			//echo "��ͣ���ʣ����Ժ����ԣ������������㾴���½⣡";exit;
			return template('diy:forum/viewthreadproduce'.$sufix.':'.$_G['fid']);
		}
		// ����ģ���л� lxp 20140117
		if($_G['newtpl'] && !$sufix){
			return template('diy:forum/viewthread'.$sufix.'_2014:'.$_G['fid']);
		} else {
			return template('diy:forum/viewthread'.$sufix.':'.$_G['fid']);
		}
	}

	/*
	 * forum_viewthread.php line:831
	 */
	function hookScript3() {
		global $_G;
		if ($_G['fid'] == $_G['config']['fids']['mudidi']) {
		    return template('forum/viewthread_nodemudidi');
		}elseif ($_G['fid'] == $_G['config']['fids']['zbfx']) {
		    return template('forum/viewthread_nodeproduce');
		} else {
			return template('forum/viewthread_node');
		}
	}

	/*
	 * forum_forumdisplay.php line:461
	 */
	function hookScript4($threadtable) {
		global $_G;
		$lasted_bbs_ids = array();
		if ($_G['fid'] == $_G['config']['fids']['produce']) {
			$sub_query = DB::query("SELECT tid FROM ".DB::table($threadtable)." WHERE fid='{$_G['fid']}' AND displayorder = 0 ORDER BY dateline DESC LIMIT 3");
			while ($value = DB::fetch($sub_query)) {
				$lasted_bbs_ids[] = $value['tid'];
			}
		}
		return $lasted_bbs_ids;
	}

	/*
	 * forum_forumdisplay.php line:477
	 */
	function hookScript5($sql, $lasted_bbs_ids = array()) {
		global $_G;
		if ($lasted_bbs_ids && ($_G['fid'] == $_G['config']['fids']['produce']||$_G['fid'] == 421)) {
			$sql = str_replace('ORDER BY t.displayorder DESC,', "ORDER BY t.displayorder DESC, CASE WHEN t.tid IN (".implode(',', $lasted_bbs_ids).") THEN 1 ELSE 0 END DESC,", $sql);
			$sql = str_replace('ORDER BY displayorder DESC,', "ORDER BY displayorder DESC, CASE WHEN t.tid IN (".implode(',', $lasted_bbs_ids).") THEN 1 ELSE 0 END DESC,", $sql);
		}
		return $sql;
	}

	/*
	 * forum_forumdisplay.php line:250
	 */
	function hookScript6() {
		global $_G;
		if ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			if ($_G['gp_typeid'] > 1) {
				return loadarchiver('forum/forumdisplaymudidi_default');
			} elseif ($_G['gp_type']=='ski' || $_G['gp_typeid'] == 1) {
				return loadarchiver('forum/forumdisplaymudidi_ski');
			} else {
				return loadarchiver('forum/forumdisplaymudidi');
			}
		} elseif ($_G['fid'] == $_G['config']['fids']['zbfx']) {
			return loadarchiver('forum/forumdisplayproduce');
		}
		return loadarchiver('forum/forumdisplay');
	}

	/*
	 * forum_forumdisplay.php line:350
	 */
	function hookScript7() {
		global $_G;
		if ($_G['fid'] == $_G['config']['fids']['produce']||$_G['fid'] == 421||$_G['fid'] == $_G['config']['fids']['dianpu']||$_G['fid'] == $_G['config']['fids']['zbfx']) {
			$_G['gp_orderby'] = 'heats';
		}
	}

	/*
	 * forum_forumdisplay.php line:728
	 */
	function hookScript8($template) {
		global $_G;
		global $list;
		global $erjilx;
		global $erjipp;
		global $cptylist;
		global $secondlist;
		global $brand;
		global $multipage;
	        if ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			if ($_G['gp_typeid'] > 1) {
				$template = 'diy:forum/forumdisplaymudidi_default:'.$_G['fid'];
			} elseif ($_G['gp_type']=='ski' || $_G['gp_typeid'] == 1) {
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: http://www.8264.com/xuechang");
				exit();
				//$template = 'diy:forum/forumdisplaymudidi_ski:'.$_G['fid'];
			} else {
				$template = 'diy:forum/forumdisplaymudidi:'.$_G['fid'];
			}
		} elseif ($_G['fid'] == $_G['config']['fids']['zbfx']) {
		   	$_G['tpp']=300;
			$typeid = $_GET['type'];
			$brandid = $_GET['brand'];
			if ($typeid&&empty($brandid)) {
				if(in_array($typeid,array(1,2))){
					$_G['tpp']=40;
					$count = ForumOptionProduce::getCountbybqId($typeid);
					$_G['forum_threadcount']=$count;
					$multipage=multi($_G['forum_threadcount'], $_G['tpp'], $_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]&type=$typeid");
				}else{
					$erjicount = ForumOptionProduce::getCountbytId($typeid);
					$_G['forum_threadcount']=$erjicount;
					$multipage=multi($_G['forum_threadcount'], $_G['tpp'], $_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]&type=$typeid");
				}
			    $template = 'forum/forumdisplayproduce_erji';
			}elseif ($brandid&&empty($typeid)) {
			   if($brandid=="all"){
			   	echo "���ܹر�";
			   	exit;
				$id = $_GET['id'];
				$_G['forum_threadcount'] =  ForumOptionProduce::getBrandCount($id);
				$brand = ForumOptionProduce::getallBrandData($id);
				$multipage=multi($_G['forum_threadcount'], 40, $_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]&brand=$brandid&id=$id");
				$template = 'forum/forumdisplayproduce_all';
			   }else{
				$erjicount = ForumOptionProduce::getCountbybId($brandid);
				$_G['forum_threadcount']=$erjicount;
				//�����б�
				$multipage=multi($_G['forum_threadcount'], $_G['tpp'], $_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]&brand=$brandid");
				$template = 'forum/forumdisplayproduce_erji';
			   }
			}elseif ($brandid&&$typeid) {
			   $erjicount = ForumOptionProduce::getCountbytIdandbId($typeid,$brandid);
			   $_G['forum_threadcount']=$erjicount;
			   //��Ʒ�б�
			   $list = ForumOptionProduce::getProduceErjibybIdandtId($typeid,$brandid);
			   $multipage=multi($_G['forum_threadcount'], $_G['tpp'], $_G['gp_page'],"forum.php?mod=forumdisplay&fid=$_G[fid]&brand=$brandid&type=$typeid");
			   $template = 'forum/forumdisplayproduce_erji';
			}else{
			   global $multiadd;
			   global $multipage_archive;
			   if($_GET['filter']=="digest"){
				   $proCount=ForumOptionProduce::getDigestCount();
				   $_G['forum_threadcount']=$proCount['count'];
				   $multipage=multi($_G['forum_threadcount'], $_G['tpp'],$_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]");
			   }elseif($_GET['filter']=="cpxh"){
				   $proCount=ForumOptionProduce::getZhenrenxiuCount();
				   $_G['forum_threadcount']=$proCount['count'];
				   $multipage=multi($_G['forum_threadcount'], $_G['tpp'],$_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]&filter=cpxh&orderby=digest&newurl=1");
			   }elseif($_GET['filter']=="isworth"){
				   $proCount=ForumOptionProduce::getIsworthCount();
				   $_G['forum_threadcount']=$proCount['count'];
				   $multipage=multi($_G['forum_threadcount'], $_G['tpp'],$_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]&filter=isworth&orderby=digest&newurl=1");
			   }else{
				  $proCount=ForumOptionProduce::getProduceCount();
				  $_G['forum_threadcount']=$proCount['count'];
				  //��Ʒ�б�
				  $multipage = multi($_G['forum_threadcount'], $_G['tpp'], $_G['gp_page'], "forum.php?mod=forumdisplay&fid=$_G[fid]".($multiadd ? '&'.implode('&', $multiadd) : '')."$multipage_archive", $_G['setting']['threadmaxpages']);
			   }
			   $template = 'forum/forumdisplayproduce';
			}
		}
		return $template;
	}

	/*
	 * forum_forumdisplay.php line:250
	 */
	function hookScript9() {
		global $_G;
		if ($_G['fid']==$_G['config']['fids']['mudidi']) {
			if ($_G['gp_typeid'] > 1) {
				return template('diy:forum/forumdisplaymudidi_default:'.$_G['fid']);
			} elseif ($_G['gp_type']=='ski' || $_G['gp_typeid'] == 1) {
				return template('diy:forum/forumdisplaymudidi_ski:'.$_G['fid']);
			} else {
				return template('diy:forum/forumdisplaymudidi:'.$_G['fid']);
			}
		} elseif ($_G['fid'] == $_G['config']['fids']['zbfx']){
		   return $template = ('forum/forumdisplayproduce:'.$_G['fid']);
		}
		return template('diy:forum/forumdisplay:'.$_G['fid']);
	}
	/*
	 * forum_forumdisplay.php line:250
	 */
	function hookScript10(&$forum_pagebydesc) {
		global $_G;
		$forum_pagebydesc = false;
		if (in_array($_G['fid'], array($_G['config']['fids']['produce'], $_G['config']['fids']['dianpu'], $_G['config']['fids']['mountain'], $_G['config']['fids']['mudidi']))) {
			$forum_pagebydesc = false;
		}
		if($_G['fid']==437){
			$_G['ppp'] = 10; // �������Ȿ�� һ��20��
		}
	}

	function hookScript11() {
		global $_G;
		if ($this->isDigested($_G['fid'])) {
			if ($_GET['all'] != 1 && !$_GET['filter']) {
				$_GET['filter'] = $_G['gp_filter'] ='digest';
				$_GET['digest'] = $_G['gp_digest'] = 1;
				$_SERVER['QUERY_STRING'] = preg_replace('/&?$/', '&filter=digest&digest=1', $_SERVER['QUERY_STRING'], 1);
			}
		}
	}

	function initPageTitle() {
		static $inited = false;
		if ($inited) return;
		$inited = true;
		global $navtitle;
		global $topic;
		global $_G;
		global $pageTitle;
		global $metakeywords;
		global $metadescription;
		$pageTitle = $pageTitle?$pageTitle:'';
		$forums = array();
		$query = DB::query("SELECT * FROM ".DB::table('forum_forum')." WHERE fup = 76");
		while ($forum = DB::fetch($query)) {
			$forums[] = $forum['fid'];
		}
		if ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			if ($_GET['type'] == 'ski') { //ѩ����ҳ
				$pageTitle = "��ѩ�� - ������ѩ�� - ��ɽ��ѩ�� - �ǲ�����ѩ�� - ȫ����ѩ����ѯ - 8264.com";
			} elseif ($_G['tid']) {
				$ralate = DB::fetch_first("SELECT r.*, t.subject FROM ".DB::table('mudidi_thread_ralation')." AS r
										   LEFT JOIN ".DB::table('forum_thread')." AS t ON r.tid = t.tid
										   WHERE r.tid = '{$_G['tid']}'");
				if ($ralate['type'] == 1) {
					$scape = DB::fetch_first("SELECT s.* FROM ".DB::table('mudidi_scape')." AS s WHERE sn = '{$ralate['sn']}'");
				}
				if ($ralate['type'] == 1 && $scape && $scape['type'] == 1) {
					$pageTitle = "{$ralate['subject']}��ѩ����ҳ - {$ralate['subject']}��ѩ������/�Ź�/��Ʊ/��ַ/�绰/ס�� - 8264.com";
				} else {
					$pageTitle = "2016����{$ralate['subject']}���ι��� - {$ralate['subject']}���������������湥�� - ȥ{$ralate['subject']}����������Ҫ����Ǯ - 8264.com";
				}
			}
		} elseif (in_array($_G['fid'],$forums)&&$_GET['typeid']) {
		    $fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['set_keywords'];
				$des = $this->forum_setting['set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		} elseif ($_G['fid']==69&&$_GET['typeid']) {
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['zcgm_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['zcgm_set_keywords'];
				$des = $this->forum_setting['zcgm_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==179&&$_GET['typeid']) {
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['dy_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['dy_set_keywords'];
				$des = $this->forum_setting['dy_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==146&&$_GET['typeid']) {
		    $fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['hwms_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['hwms_set_keywords'];
				$des = $this->forum_setting['hwms_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==440&&$_GET['typeid']) {
		    $fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['lyzj_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['lyzj_set_keywords'];
				$des = $this->forum_setting['lyzj_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==66&&$_GET['typeid']) {
		    $fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['zjpc_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['zjpc_set_keywords'];
				$des = $this->forum_setting['zjpc_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		} elseif ($_G['fid']==186&&$_GET['typeid']) {
		    $fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['hx_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['hx_set_keywords'];
				$des = $this->forum_setting['hx_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==5&&$_GET['typeid']) {
		    $fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['syhd_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['syhd_set_keywords'];
				$des = $this->forum_setting['syhd_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==53&&$_GET['typeid']) {
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['zbjy_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['zbjy_set_keywords'];
				$des = $this->forum_setting['zbjy_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==88&&$_GET['typeid']) {
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['qxtx_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['qxtx_set_keywords'];
				$des = $this->forum_setting['qxtx_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		} elseif ($_G['fid']==7&&$_GET['typeid']) {
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['zbtx_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['zbtx_set_keywords'];
				$des = $this->forum_setting['zbtx_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==163&&$_GET['typeid']) {
			//���ʱش�
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['ywbd_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['ywbd_set_keywords'];
				$des = $this->forum_setting['ywbd_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==447&&$_GET['typeid']) {
			//ˮ���˶�
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['ssyd_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['ssyd_set_keywords'];
				$des = $this->forum_setting['ssyd_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==185&&$_GET['typeid']) {
			//¿�з���
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['lxfw_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['lxfw_set_keywords'];
				$des = $this->forum_setting['lxfw_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==24&&$_GET['typeid']) {
			//ɽ���Ⱥ
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['swcq_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['swcq_set_keywords'];
				$des = $this->forum_setting['swcq_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==135&&$_GET['typeid']) {
			//�ұڰ���
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['ybbl_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['ybbl_set_keywords'];
				$des = $this->forum_setting['ybbl_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid']==161&&$_GET['typeid']) {
			//AA��Լ
			$fid = $_G['fid'];
			$typeid = $_GET['typeid'];
			$set = $this->forum_setting['aa_set_title'];
			$dffl = DB::fetch_first("SELECT * FROM ".DB::table('forum_threadclass')." where fid=$fid and typeid = $typeid");
			if($set&&$dffl){
				$key = $this->forum_setting['aa_set_keywords'];
				$des = $this->forum_setting['aa_set_desc'];
				$pageTitle = str_replace("*",$dffl['name'],$set);
				$metakeywords = str_replace("*",$dffl['name'],$key);
				$metadescription = str_replace("*",$dffl['name'],$des);
			}
			$pageTitle = $pageTitle." - 8264.com";
		}elseif ($_G['fid'] == $_G['config']['fids']['zbfx']) {
			$typeid = $_GET['type'];
			$brandid = $_GET['brand'];
			$tid = $_G['tid'];
			$filter = $_GET['filter'];
			if($typeid){
				if(in_array($typeid,array(1,2))){
					$pageTitle = "����װ��ר��/��ɫ����װ��-װ������-8264.com";
				}else{
					$ralate = ForumOptionProduce::getTitlebyType($typeid);
					if($ralate['tparent']==0){
					   $ralate = $ralate['tname'];
					   $TypeTitle = $ralate."ʲô���Ӻ�,".$ralate."Ʒ���ĸ���,".$ralate."���� ";
					   $brandid = $_GET['brand'];
					   if($brandid){
						 $brand = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid = '$brandid'");
						 $TypeTitle = $brand['subject']."".$ralate."��ô��/�ò���/�����۸� ";
					   }
					   $pageTitle = $TypeTitle."- ����װ������";
					}else{
					   $ralate = $ralate['tname'];
					   $TypeTitle = $ralate."ʲô���Ӻ�,".$ralate."Ʒ���ĸ���,".$ralate."����,".$ralate."ͼƬ ";
					   $brandid = $_GET['brand'];
					   if($brandid){
						 $brand = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid = '$brandid'");
						 $TypeTitle = $brand['subject']."".$ralate."��ô��/�ò���/�����۸� ";
					   }
					   $pageTitle = $TypeTitle."- ����װ������";
					}
				}
			}elseif($brandid){
				$brand = DB::fetch_first("SELECT * FROM ".DB::table('forum_thread')." WHERE tid = '$brandid'");
				if(empty($brand['subject'])) {
				$pageTitle ="����Ʒ�ƴ�ȫ - װ������ - 8264.com";
				}else{
				$brand['subject'] = $brand['subject']."��ô��,".$brand['subject']."����Ʒ��ͼƬ ";
				//$cpdl = ForumOptionProduce::getTypeInfobybrId($brandid);
				$pageTitle = $brand['subject']."- ����װ������";
				}
			}elseif($brandid==-1){
				$pageTitle = "��������Ʒ��"."- ����װ������";
			}elseif($tid) {
				$cp = ForumOptionProduce::getProduceLxbytid($tid);
				$cpdl = ForumOptionProduce::getLxbyproduce($cp['cpdl']);
				$cpxl = ForumOptionProduce::getLxbyproduce($cp['cplx']);
				$cppp = ForumOptionProduce::getBrandByTid($cp['cppp']);
				if(in_array($cp['type'],array(1,2))){
					$pageTitle = $cp['cpmc']."-װ������-8264.com";
				}else{
					$pageTitle = $cp['cpmc']."-".$cppp['subject']."-".$cpdl['tname']."-".$cpxl['tname'];
				}
				//$pageTitle = $cpdl['tname']."_".$cpxl['tname']."_".$cppp['subject']."_".$cp['cpmc'];
			}else{
				if($filter=='isworth'){
					$pageTitle ="��ֵ�ù����װ���Ƽ� - װ������ - 8264.com";
				}else{
					$bq = $_GET['bq'];
					if($bq){
						$pageTitle = "������ר�� - װ������ - 8264.com";
					}else{
						$pageTitle ="��������װ�� - װ������ - 8264.com";
					}
				}
			}
		} elseif($_G['catid']==874){
			$filter = $_GET['filter'];
			$dateline = $_GET['dateline'];
			if($filter&&$dateline){
				if($filter=='t.heats'||$filter=='heats'){
					$subject = "��̳�ȶ����а�";
					if($dateline==7){
						$tm = "7��������";
					}elseif($dateline==30){
						$tm = "30��������";
					}else{
						$tm = "������";
					}
				}elseif($filter=='views'){
					$subject = "��̳������а�";
					if($dateline==7){
						$tm = "7��������";
					}elseif($dateline==30){
						$tm = "30��������";
					}else{
						$tm = "������";
					}
				}else{
					$subject = "��̳�������а�";
					if($dateline==7){
						$tm = "7��������";
					}elseif($dateline==30){
						$tm = "30��������";
					}else{
						$tm = "������";
					}
				}
				$pageTitle = $subject."(".$tm.") - 8264.com ";
			}else{
				$pageTitle = "��̳�ȶ����а�(7��������) - 8264.com ";
			}
		} elseif (isset($_G['fid']) && empty($_G['tid'])) {
			if($_G['gp_mod']=='list'&& $metakeywords && $_G['catid']!=874){
				return null;
			}
			if ($navtitle) {
				if ($metakeywords) {
					$navtitle = str_replace($_G['forum']['name'], $metakeywords, $navtitle);
				}
				$pageTitle .= $navtitle.' - ';
			}
			if ($_G['setting']['bbname']) {
				$pageTitle .= $_G['setting']['bbname'];
			}
		}
	}

	function isThreadFirst($tid, $pid) {
		return DB::result_first("SELECT COUNT(*) FROM ".DB::table('forum_post')." WHERE tid={$tid} AND pid={$pid} AND `first`=1");
	}

	/***
	*  �жϷ���ģ���Ƿ���Ŀ�ĵأ�������ɽ��ķ���ģ��
	*/
	function hookScriptPost1() {
		global $_G;
		global $mudidi_area;
		global $scapetypes;
		/**
		* 2012-09-05 jianghong ���������ڼ�⣬��Ϊajax��ֱ�ӷ�����һҳ������������ģ�����ɴ������⣩
		*/
		if(getgpc('inajax')){
		  echo "<script>history.back(-1)</script>";exit;
		}
		/**
		* ���Ͻ���
		*/
		if($_G['fid'] == $_G['config']['fids']['zbfx']){
			if($_GET['bq']==1||$_GET['bq']==2){
				if($_G['uid']&&($_G['groupid']==1||$_G['uid']==35169594||$_G['uid']==35259730)){
					return template('forum/post_bq');
				}else{
					echo "��û��Ȩ�޷���ר�⣡";exit;
				}
			 }else{
				$uid = $_G['uid'];
				if($uid) {
					require_once libfile("function/home");
					$space = getspace($uid);
					if(empty($space)) {
						showmessage('space_does_not_exist');
					}
					//print_r($space);exit;
					if($space['friends']<5){
						showmessage('����װ��������Ҫ�ȷ�һƪ��־��һ�����ӣ���ӵ��5�����ϵĺ��ѣ��������������ݲ��ܷ�����');
					}
					if($space['threads']<1&&$space['blogs']<1){
						showmessage('����װ��������Ҫ�ȷ�һƪ��־��һ�����ӣ���ӵ��5�����ϵĺ��ѣ��������������ݲ��ܷ�����');
					}
				}
				return template('forum/post_produce');
			 }
		}elseif ($_G['fid'] == $_G['config']['fids']['mudidi'] && in_array($_GET['type'], array('scape', 'scapearea', 'region'))) {
			global $forumoption_mudidi;
			$forumoption_mudidi->forceRefreshCache = true;
			global $tags;
			if ($_GET['fsn']) {
				$mudidi_area = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_region')." WHERE sn='{$_GET['fsn']}'");
			}
			if ($_GET['type'] == 'scapearea') {
				$tags = $forumoption_mudidi->getTags();
			}
			if ($_GET['type'] == 'scape') {
				$scapetypes = $forumoption_mudidi->getScapetype();
			}
			return template('forum/post_mudidi');
		} else {
			if(!getgpc('infloat')){
			   return template('forum/post_newimage');
			}
			return (getgpc('infloat') ? template('forum/post_infloat') : template('forum/post'));
		}
	}

	function hookScriptPost2($subject, $tid) {
		global $_G;
		if ($_G['fid']==52 && !empty($_POST['scapeareaSelect'])) {
			DB::query("INSERT INTO ".DB::table('mudidi_guide')." (sn, type, typeid, dateline, state, post_direct, uid, posttime) VALUES ('{$_POST['scapeareaSelect']}', 1, $tid, ".time().", 1, 1, '{$_G['uid']}', ".time().")");
		}elseif ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			global $forumoption_mudidi;
			if ( $_POST['pid'] && !self::isThreadFirst($_G['tid'], $_POST['pid'])) {
				return;
			}
			function getSn($fsn, $id) {
				$num = preg_match_all('/\d+/', $fsn, $m);
				$num = 4 - $num;
				while (($num--) > 0) {
					$fsn .= "-0";
				}
				$fsn .= "-$id";
				return $fsn;
			}
			$mudidi_longitude = $_POST['mudidi_longitude'];
			$mudidi_latitude = $_POST['mudidi_latitude'];
			$mudidi_ename = $_POST['mudidi_ename'];
			$mudidi_hotelUrl = $_POST['mudidi_hotelUrl'];
			$mudidi_hotelName = $_POST['mudidi_hotelName'];
			if ($_GET['type'] == 'scape') {
				$mudidi_type = $_POST['mudidi_type'];
				if ($mudidi_type == NULL) {
					$mudidi_type = 0;
				}
				DB::query("INSERT INTO ".DB::table('mudidi_scape')." (name, ename, `long`, lat, type)
					VALUES ('$subject', '$mudidi_ename', '$mudidi_longitude', '$mudidi_latitude', $mudidi_type)");
				$scapeid = DB::insert_id();
				$scapesn = getSn($_POST['scapeareaSelect'], $scapeid);
				DB::query("UPDATE ".DB::table('mudidi_scape')." SET sn='$scapesn'
					WHERE id = $scapeid");
				DB::query("INSERT INTO ".DB::table('mudidi_thread_ralation')." (tid, sn, type)
					VALUES ($tid, '$scapesn', 1)");
				if ($mudidi_type != 0) {
					$defaultInfo = DB::result_first("SELECT defaultInfo FROM ".DB::table('mudidi_scapetype')." WHERE id = {$mudidi_type}");
					foreach (explode(',', $defaultInfo) as $infoname) {
						DB::query("INSERT INTO ".DB::table('mudidi_info')." (sn, name, `default`, `defaultName`) VALUES ('$scapesn', '$subject$infoname', 1, '$infoname')");
					}
				}
			} elseif ($_GET['type'] == 'scapearea') {
				$mudidi_py = ucfirst($_POST['mudidi_py']{0});
				DB::query("INSERT INTO ".DB::table('mudidi_scapearea')." (name, ename, `long`, lat, py, hotelUrl, hotelName)
					VALUES ('$subject', '$mudidi_ename', '$mudidi_longitude', '$mudidi_latitude', '$mudidi_py', '$mudidi_hotelUrl', '$mudidi_hotelName')");
				$scapeareaid = DB::insert_id();
				$scapeareasn = getSn($_POST['areaSelect'], $scapeareaid);
				DB::query("UPDATE ".DB::table('mudidi_scapearea')." SET sn='$scapeareasn'
					WHERE id = $scapeareaid");
				DB::query("INSERT INTO ".DB::table('mudidi_thread_ralation')." (tid, sn, type)
					VALUES ($tid, '$scapeareasn', 2)");
				foreach (array('��ͨ', '�ز�', '��ʷ', '�Ļ�', '����', '�������ʱ��', '��ʳ', '��Ʊ', '����') as $infoname) {
					DB::query("INSERT INTO ".DB::table('mudidi_info')." (sn, name, `default`, `defaultName`) VALUES ('$scapeareasn', '$subject$infoname', 1, '$infoname')");
				}
				$forumoption_mudidi->changeTagsRalate($tid, $_POST['tags']);
			} elseif ($_GET['type'] == 'region') {
				$mudidi_py = ucfirst($_POST['mudidi_py']{0});
				DB::query("INSERT INTO ".DB::table('mudidi_region')." (name, ename, `long`, lat, py, hotelUrl, hotelName)
					VALUES ('$subject', '$mudidi_ename', '$mudidi_longitude', '$mudidi_latitude', '$mudidi_py', '$mudidi_hotelUrl', '$mudidi_hotelName')");
				$regionid = DB::insert_id();
				$regionsn = $_POST['areaSelect'].'-'.$regionid;
				DB::query("UPDATE ".DB::table('mudidi_region')." SET sn='$regionsn'
					WHERE id = $regionid");
				DB::query("INSERT INTO ".DB::table('mudidi_thread_ralation')." (tid, sn, type)
					VALUES ($tid, '$regionsn', 3)");
				foreach (array('��ͨ', '�ز�', '��ʷ', '�Ļ�', '����', '�������ʱ��', '��ʳ', '��Ʊ', '����') as $infoname) {
					DB::query("INSERT INTO ".DB::table('mudidi_info')." (sn, name, `default`, `defaultName`) VALUES ('$regionsn', '$subject$infoname', 1, '$infoname')");
				}
			}
		}

	}
	/****
	*   �ж��ڱ༭״̬��Ŀ�ĵأ�ɽ��ϵͳ�ķ���ģ��
	*/
	function hookScriptPost3() {
		global $_G;
		global $mudidi_editdata;
		global $mudidi_area;
		global $produce_edit;
		global $forumoption_mudidi;
		global $tags;
		global $scapetypes;
		/**
		* 2012-09-05 jianghong ���������ڼ�⣬��Ϊajax��ֱ�ӷ�����һҳ������������ģ�����ɴ������⣩
		*/
		if(getgpc('inajax')){
		  echo "<script>history.back(-1)</script>";exit;
		}
		/**
		* ���Ͻ���
		*/
		if ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			$forumoption_mudidi->forceRefreshCache = true;
		        $mudidi_ralate = $forumoption_mudidi->getRalateByTid($_G['tid']);
			switch ($mudidi_ralate['type']) {
				case 1:
					$_GET['type'] = 'scape';
					$mudidi_editdata = $forumoption_mudidi->getScapeByTid($_G['tid']);
					$scapetypes = $forumoption_mudidi->getScapetype();
					break;
				case 2:
					$_GET['type'] = 'scapearea';
					$mudidi_editdata = $forumoption_mudidi->getScapeareaByTid($_G['tid']);
					$tags = $forumoption_mudidi->getTagsRalateByTid($_G['tid']);
					break;
				case 3:
					$_GET['type'] = 'region';
					$mudidi_editdata = $forumoption_mudidi->getRegionByTid($_G['tid']);
					preg_match('/(.*)-\d+$/', $mudidi_ralate['sn'], $m);
					$mudidi_area = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_region')." WHERE sn='{$m[1]}'");
					break;
				default:
					break;
			}
			if(self::isThreadFirst($_G['tid'], $_GET['pid'])){
				return template('forum/post_mudidi') ;
		        }else{
			   if(!getgpc('infloat')){
			       return template('forum/post_newimage');
			   }else{
			       return template('forum/post');
			   }
		        }
		}elseif ($_G['fid'] == $_G['config']['fids']['zbfx']){
			if($_GET['bq']==1||$_GET['bq']==2){
				$produce_edit = ForumOptionProduce::getRelationTid($_G['tid']);
				return template('forum/post_bq');
			}else{
				$produce_edit = ForumOptionProduce::getProduceInfo($_G['tid']);
				return template('forum/post_produce');
			}
		} else{
			if(!getgpc('infloat')){
			  return template('forum/post_newimage');
			}
		    return template('forum/post');
		}
	}

	function hookScriptPost4($subject) {
		global $_G;
		if ($_G['fid']== $_G['config']['fids']['zbfx']){
			if($_GET['bq']==1||$_GET['bq']==2){
				DB::query("DELETE FROM ".DB::table('plugin_produce_relation')." WHERE parentId={$_G['tid']}");
				$selectpro=$_POST['select_produce'];
				if($selectpro){
					foreach ($selectpro as $value)
					{
						DB::query("Replace INTO ".DB::table('plugin_produce_relation')." (parentId,childId) VALUES ({$_G['tid']}, $value)");
					}
				}
				DB::query("UPDATE ".DB::table('plugin_produce_info')." set cpmc ='$subject' WHERE tid={$_G['tid']}");
			}else{
				$cpdl=$_POST['type'];
				$cpxl=$_POST['xiaji'];
				$pp=$_POST['brand'];
				$kuanshi=$_POST['kuanshi'];
				$cpjg=(float)$_POST['cpjg'];
				$addvalue=$_POST['addvalue'];
				$isused=$_POST['isused'];

				$urls=substr($addvalue,0,4);
				if($urls=="http"&&strpos($addvalue,"://")&&strpos($addvalue,".")){
				   $addvalue=$addvalue;
				}elseif($urls!="http"&&!strpos($addvalue,"://")&&!empty($addvalue)&&strpos($addvalue,".")){
				   $addvalue="http://".$addvalue;
				}else{
				   $addvalue="";
				}
				if($_FILES["upfile"]['name']!=null){
					$uptypes=array('image/jpg',  //�ϴ��ļ������б�
						 'image/jpeg',
						 'image/png',
						 'image/pjpeg',
						 'image/gif',
						 'image/x-png',
						 'image/bmp',
					 );
					ForumOptionProduce::deletImageByEdit($_G['tid']);
					$max_file_size=7000000;   //�ϴ��ļ���С����, ��λBYTE
				/**
				 * �޸����ϴ���ʽ��by jianghong 2012-09-26
				 */
				require_once libfile('function/delete');
				require libfile('class/image');
				$new_image = new image();
				$file = $_FILES["upfile"];
				$file['tmp_name'] = str_replace('\\\\', '\\', $file['tmp_name']);
				if (!is_uploaded_file($file['tmp_name'])){
						    echo "<font color='red'>�ļ������ڣ�</font>";
						    //deletethread(" tid=$tid");
						    exit;
					    }
				$prowidth = getimagesize($file['tmp_name']);
				list($mwidth, $mheight) = $new_image->getSizeByCount($prowidth[0], $prowidth[1], 210, 0);
				$index_img_height = $mheight; // ������ҳͼƬ�߶�
				if($prowidth[0]<=210){
				    echo "<font color='red'>װ��ͼƬ�Ŀ��̫С�ˣ��������ϴ���</font>";
						    //deletethread(" tid=$tid");
						    exit;
					    }
					    if($max_file_size < $file["size"]){
						    echo "<font color='red'>�ļ�̫��</font>";
						    //deletethread(" tid=$tid");
						    exit;
					    }
					    if(!in_array($file["type"], $uptypes)){
						     echo "<font color='red'>�����ϴ��������ļ���</font>";
						     //deletethread(" tid=$tid");
						     exit;
					    }
				require_once libfile('class/upload');
				$upload = new discuz_upload();
				$upload->init($_FILES['upfile'],'plugin');
				if($upload->error()){
				    echo "<font color='red'>δ֪���������ԣ�</font>";
						    //deletethread(" tid=$tid");
						    exit;
				}
				$upload->save();
				if($upload->error()){
				    echo "<font color='red'>�ϴ�ʧ�ܣ�������</font>";
						    //deletethread(" tid=$tid");
						    exit;
				}
				$serverid = (isset($upload->attach['serverid']) && $upload->attach['serverid'] > 0) ? $upload->attach['serverid'] : 0;
				if($prowidth[0]>600){
				    list($width, $height) = $new_image->getSizeByCount($prowidth[0], $prowidth[1], 600, 0);
				}else{
				    $width = $prowidth[0];
				    $height = $prowidth[1];

				}

				if($serverid==0){
				    $new_image->Thumb($upload->attach['target'],"plugin/".$upload->attach['attachment'].'.thumb100.jpg', 100, 100, 1);
				    $new_image->Thumb($upload->attach['target'],"plugin/".$upload->attach['attachment'].'.thumb210.jpg', $mwidth, $mheight, 1);
				    $new_image->Thumb($upload->attach['target'],"plugin/".$upload->attach['attachment'].'.thumb600.jpg', $width, $height, 1);
				}else{
				    require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
				    $attachserver = new attachserver;
				    $serverinfo = $attachserver->get_server_domain($serverid,'*');
				    $attachserver->Thumb($serverinfo['domain'] , $serverinfo['api'] , 'plugin/'.$upload->attach['attachment'] , 'plugin/'.$upload->attach['attachment'].'.thumb100.jpg' , 100 , 100 , 1);
				    $attachserver->Thumb($serverinfo['domain'] , $serverinfo['api'] , 'plugin/'.$upload->attach['attachment'] , 'plugin/'.$upload->attach['attachment'].'.thumb210.jpg' , $mwidth , $mheight , 1);
				    $attachserver->Thumb($serverinfo['domain'] , $serverinfo['api'] , 'plugin/'.$upload->attach['attachment'] , 'plugin/'.$upload->attach['attachment'].'.thumb600.jpg' , $width , $height , 1);
				    $attachserver->delete($serverinfo['domain'] , $serverinfo['api'] , 'plugin/'.$upload->attach['attachment'].'.thumb.jpg');
				}
				$updatearray = array(
						'cpmc' => $subject,
						'cpdl' => $cpdl,
						'cplx' => $cpxl,
						'cppp' => $pp,
						'cpks' => $kuanshi,
						'cpjg' => $cpjg,
						'gmdz' => $addvalue,
						'cptp' => $upload->attach['attachment'],
						'index_height' => $index_img_height,
						'isused' => $isused,
						'serverid' => $serverid
						);
				DB::update('plugin_produce_info',$updatearray,array('tid'=>$_G['tid']));
				}else{
					DB::query("UPDATE ".DB::table('plugin_produce_info')."
						 SET cpmc='$subject',cpdl='$cpdl',cplx='$cpxl', cppp='$pp', cpks='$kuanshi', cpjg='$cpjg',gmdz='$addvalue',isused='$isused'
						 WHERE tid={$_G['tid']}");
				}
			}
		} elseif ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			global $forumoption_mudidi;
			if ($_POST['pid'] && !self::isThreadFirst($_G['tid'], $_POST['pid'])) {
				return;
			}
			$ralation = DB::fetch_first("SELECT * FROM ".DB::table('mudidi_thread_ralation')." WHERE tid = {$_G['tid']}");
			$mudidi_longitude = $_POST['mudidi_longitude'];
			$mudidi_latitude = $_POST['mudidi_latitude'];
			$mudidi_ename = $_POST['mudidi_ename'];
			$mudidi_hotelUrl = $_POST['mudidi_hotelUrl'];
			$mudidi_hotelName = $_POST['mudidi_hotelName'];
			if ($_GET['type'] == 'scape') {
				if (($mudidi_type = $_POST['mudidi_type']) == NULL) {
					$mudidi_type = 0;
				}
				DB::query("UPDATE ".DB::table('mudidi_scape')."
						  SET name='$subject', ename='$mudidi_ename', `long`='$mudidi_longitude', lat='$mudidi_latitude', type=$mudidi_type
						  WHERE sn='{$ralation['sn']}'");
			} elseif ($_GET['type'] == 'scapearea') {
				$mudidi_py = ucfirst($_POST['mudidi_py']{0});
				DB::query("UPDATE ".DB::table('mudidi_scapearea')."
						  SET name='$subject', ename='$mudidi_ename', `long`='$mudidi_longitude', lat='$mudidi_latitude', py='$mudidi_py', hotelUrl='$mudidi_hotelUrl', hotelName='$mudidi_hotelName'
						  WHERE sn='{$ralation['sn']}'");
				$forumoption_mudidi->changeTagsRalate($_G['tid'], $_POST['tags']);

			} elseif ($_GET['type'] == 'region') {
				$mudidi_py = ucfirst($_POST['mudidi_py']{0});
				DB::query("UPDATE ".DB::table('mudidi_region')."
						  SET name='$subject', ename='$mudidi_ename', `long`='$mudidi_longitude', lat='$mudidi_latitude', py='$mudidi_py', hotelUrl='$mudidi_hotelUrl', hotelName='$mudidi_hotelName'
						  WHERE sn='{$ralation['sn']}'");
			}
		}
	}

	/***
	*  ɾ������
	*/
	function hookScriptDelete($condition) {
		global $_G;
		global $forumoption_mudidi;
		//ɾ�������п��ܱ���Ϊ���ԵĹ�ϵ
		$guide_condition = str_replace('tid', 'typeid', $condition);
		if ($_G['fid'] == $_G['config']['fids']['mudidi'] && class_exists('ForumOptionMudidi')) {
			$forumoption_mudidi->deleteRalateData($condition);
		} elseif ($_G['fid'] == $_G['config']['fids']['zbfx'] && class_exists('ForumOptionProduce')) {
			ForumOptionProduce::deletProduceInfo($condition);
		}
	}


	function init() {
		global $_G;
		// ��ʼ�������ҳ
		if ($_G['fid'] == $_G['config']['fids']['mudidi']) {
			$_G['tpp'] = 20;
		}
		$option = memory('get','plugin_forumoption_setting_BvSjK');
		if(!$option){
			$query = DB::query('SELECT * FROM '.DB::table('plugin_forumoption_setting'));
			while($values = DB::fetch($query)){
				$option[$values['name']] = $values['value'];
			}
			memory('set','plugin_forumoption_setting_BvSjK',$option,3600);
		}
		$this->forum_setting = $option;
	}

	function renderMudidiGuiders($type = 1) {
		global $_G;
		$str = '';
		$typeid = $type == 1 ? $_G['tid'] : $_G['gp_id'];
		$guide = DB::fetch_first("SELECT g.*, t.subject, t.tid FROM ".DB::table('mudidi_guide')." AS g
				    LEFT JOIN ".DB::table("mudidi_thread_ralation")." AS r ON r.sn = g.sn
								LEFT JOIN ".DB::table("forum_thread")." AS t ON t.tid = r.tid
				    WHERE g.typeid = {$typeid} AND g.state = 1 AND g.type = {$type}");
		if ($guide) {
			$str = ($type==1?'����':'����־').'�ѱ��Ƶ�<a href="'.$_G['config']['web']['forum'].'thread-'.$guide['tid'].'-1-1.html" style="padding:0;background:none;border:none;">'.$guide['subject'].'</a>';
		}
		return $str;
	}

	function getKeywords($cateid=1) {
		$array = array();
		$query = DB::query("SELECT * FROM ".DB::table('plugin_articlekeywords')." WHERE category = '{$cateid}'");
		while ($value = DB::fetch($query)) {
		      $array[] = $value;
		}
		return $array;
	}

	function getRandSkiKeywords($num=10) {
		$array = array();
		$keywords = self::getKeywords(1);
		$randindexs = array_rand($keywords, $num);
		foreach ($randindexs as $i) {
			$array[] = $keywords[$i];
		}
		return $array;
	}


	function renderPostGearLink($uid) {
		return;
		if (!empty($uid)) {
			$shared = (bool)DB::result_first("SELECT COUNT(*) FROM ".DB::table('plugin_produce_publishers')." WHERE uid=$uid AND shareNum >= 5");
			if ($shared) {
				echo '<div style="text-align:center;margin:5px 0;">'
					.'<a href="'.$_G['config']['web']['home'].'home-space-uid-'.$uid.'-do-produce-view-me-from-space.html" target="_blank"><img src="/source/plugin/produce/images/post-gear-btn.png" alt="" /></a>'
					.'</div>';
			}
		}
	}

	function getStateByIp($ip) {
		$data = _convertip($ip);
		$states = '���� ���� ���� ���� ���� �㶫 ���� ���� ���� �ӱ� ���� ���� ���� ������ ���� ���� ���� ���� ���ɹ� ���� �ຣ ɽ�� ɽ�� ���� �Ϻ� �Ĵ� ��� ���� �½� ���� �㽭';
		foreach (explode(' ', $states) as $state) {
			if (strpos($data, $state) !== false) {
				return $state;
			}
		}
		return NULL;
	}
	/**
	 * ��ip���صط�������, ��෵��5��
	 * �������Ӻ�̨���õ�����
	 * ������5��, ������7���ھ�������, ������ʱ�併��
	 * ������5��, ����7���ھ�������, ������ʱ�併��
	 */
	function getThreadByIp($ip) {
		global $_G;
		$state = self::getStateByIp($ip);
		if (!$state) {
			return NULL;
		}
		$forum = memory('get' ,'cache_forum_forumlike_'.md5($state));
		if($_G['uid']==1){
			memory('rm' ,'cache_forum_forumlike_'.md5($state));
			memory('rm' ,'cache_forumthread_data_fid_'.$forum['fid']);
		}
		if(!$forum){
			$forum = DB::fetch_first("SELECT * FROM ".DB::table('forum_forum')." WHERE fup = 76 AND name LIKE '%$state'");
			memory('set' ,'cache_forum_forumlike_'.md5($state) ,$forum ,3600);
		}
		if ($forum['fid']) {
			$data = memory('get' ,'cache_forumthread_data_fid_'.$forum['fid']);
			if(!$data){
				$data = array(
					'stateName' => $state,
					'forumName' => $forum['name'],
					'threads' => array()
				);
				$data['threads'] = $tids = array();
				$dateline = time() - 604800; // 3600 * 24 * 7 == 604800
				/*��������ѯ��ǰ�ط���ĵ���,2012-09-17 jianghong*/
				$part_local = array();
				$query = DB::query("SELECT * FROM ".DB::table('forum_threadclass')." WHERE fid = {$forum['fid']}");
				while($value = DB::fetch($query)){
				    $part_local[$value['typeid']] = $value['name'];
				}
				$data['localpart'] = $part_local;
				/*����*/
				$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." t".
							   " RIGHT JOIN ".DB::table('plugin_forumoption_town_recommends')." r ON r.tid = t.tid".
							   " WHERE t.fid = {$forum['fid']} LIMIT 5");
				while ($value = DB::fetch($query)) {
					$data['threads'][] = $value;
					$tids[] = $value['tid'];
				}
				$count = 5 - count($data['threads']);
				if ($count > 0) {
					$where_tid = $tids ? " AND t.tid NOT IN (".implode(', ', $tids).")" : '';
					$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." t WHERE t.fid = {$forum['fid']} AND digest = 1 $where_tid AND dateline > $dateline ORDER BY digest DESC, dateline DESC LIMIT $count");
					while ($value = DB::fetch($query)) {
						$data['threads'][] = $value;
						$tids[] = $value['tid'];
					}
				}
				$count = 5 - count($data['threads']);
				if ($count > 0) {
					$where_tid = $tids ? " AND tid NOT IN (".implode(', ', $tids).")" : '';
					$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." t WHERE t.fid = {$forum['fid']} $where_tid AND dateline > $dateline ORDER BY heats DESC LIMIT $count");
					while ($value = DB::fetch($query)) {
						$data['threads'][] = $value;
					}
				}
				if ($data['threads']) {
					//2012-06-13 add by jianghong �������ط���̳ID���룬�������ӱ������ӿ������ӵ�����̳���
					$data['fid'] = $forum['fid'];
					memory('set' ,'cache_forumthread_data_fid_'.$forum['fid'] ,$data ,3600);
				}else{
					$data = null;
				}
			}
			return $data;
		}
		return NULL;
	}

	/*
	 * ������������ȥ������Ӧ�Ƽ���·
	 */
	function getWanXianlu($ip) {
		global $_G;
		//������ƶ�Ӧ��·�����ϵ
		//������·�ӿ�ֻ֧�ֵ���ID��ѯ���Ժ�ӿڷḻ֮���ٽ���ע�͵�Ŀ�ĵؼ���
		$conf_forum_xianlu = array(
				'����' => 260,
				'����' => 35,
				'����' => 225,	//226=����
				'����' => 242,	//241=����
				'����' => 23,	//23=����|36=����|95=����
				'�Ĵ�' => 50,	//3=�ɶ�|8=���ݹ�|9=��ʯ̲|22=��կ��|49=����|125=������
				'���ɹ�' => 101,	//180=���ױ�����ԭ|181=���ױ���
				'����' => 228,	//110=����
				'����' => 46,	//5=�������|60=����|92=����|321=����
				'�½�' => 229,	//45=��³ľ��
				'����' => 4,	//4=����|19=����|140=����˫��
				'������' => 251,	//251=������|256=������
				'����' => 311,	//311=����
				'����' => 280,
				'����' => 98,	//224=����
				'�㶫' => 246,	//246=����|232=�㶫
				'�ӱ�' => 255,	//331=�żҿ�
				'����' => 213,	//213=֣��|230=����
				'����' => 247,	//247=����
				'����' => 257,	//257=�żҽ�|253=����
				'����' => 237,
				'����' => 38,	//38=�Ͼ�|41=����
				'����' => 284,	//284=����
				'����' => 34,	//34=����|243=����|239=����
				'����' =>  244,	//238=����
				'ɽ��' => 329,
				'�Ϻ�' => 39,
				'���' => 37,
				'�㽭' => 40,	//40=����|252=�㽭
				'ɽ��' => 245,	//332=ƽң�ų�
				'�ຣ' => 99,	//42=����|128=�����|173=�ຣ��
			);
		/*
		   data_type:category ���ࣨ�淨���б�
					 tag      Ŀ�ĵأ�ȥ���棩�б�
					 label    ��ǩ�б�
		   type_id: val
		   limit:0-3 3�������λ��
		   return:type json
		   data:utf-8
		 */
		$wan_api = 'http://m.hd.8264.com/wap.php?app=api&act=getData';

		$state = self::getStateByIp($ip);
		if (!$state) {
			$data = memory('get' ,'cache_wan_xianlu_other');
			if(!$data) {
				$api_url = $wan_api.'&data_type=label&type_id=31&limit=0-3';
				$data = file_get_contents($api_url);
				if($data) memory('set' ,'cache_wan_xianlu_other', $data, 3600);
			}
		} else {
			$data = memory('get' ,'cache_wan_xianlu_'.substr(md5($state), 0, 5));
			if(!$data) {
				$api_url = $wan_api.'&data_type=tag&type_id='.$conf_forum_xianlu[$state].'&limit=0-3';
				$data = file_get_contents($api_url);
				if($data == '[]') {
					$api_url = $wan_api.'&data_type=label&type_id=31&limit=0-3';
					$data = file_get_contents($api_url);
				}
				if($data) memory('set' ,'cache_wan_xianlu_'.substr(md5($state), 0, 5), $data, 3600);
			}
		}
		return $data;
	}

	function getStarid($type, $typeid) {
		if (!($starid = DB::result_first("SELECT id FROM ".DB::table('dianping_star_statistics')." WHERE type = '$type' AND typeid = '$typeid'"))) {
			DB::query("INSERT INTO ".DB::table('dianping_star_statistics').
					  "(type, typeid) VALUES ('$type', '$typeid')");
			$starid = DB::insert_id();
		}
		return $starid;
	}


	function calStarInfo($starid) {
		$count1 = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND starnum = 1");
		$count2 = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND starnum = 2");
		$count3 = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND starnum = 3");
		$count4 = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND starnum = 4");
		$count5 = DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND starnum = 5");
		$count = $count1 + $count2 + $count3 + $count4 + $count5;

		$percent1 = self::round($count1 / $count * 100, 1);
		$percent2 = self::round($count2 / $count * 100, 1);
		$percent3 = self::round($count3 / $count * 100, 1);
		$percent4 = self::round($count4 / $count * 100, 1);
		$percent5 = self::round($count5 / $count * 100, 1);

		$price = self::round($percent5 / 100 * 10 + $percent4 / 100 * 8 + $percent3 / 100 * 6 + $percent2 / 100 * 4 + $percent1 / 100 * 2, 1);

		DB::query("UPDATE ".DB::table('dianping_star_statistics').
				  " SET percent1 = '$percent1', percent2 = '$percent2', percent3 = '$percent3', percent4 = $percent4, percent5 = $percent5, count = $count, price = '$price'".
				  " WHERE id = $starid");
		$star = DB::fetch_first("SELECT * FROM ".DB::table('dianping_star_statistics')." WHERE id = '$starid'");
		if($star['typeid']){
			$stard = DB::fetch_first("SELECT * FROM ".DB::table('dianping_shop_info')." WHERE tid = '$star[typeid]'");
			if($stard){
				DB::query("update ".DB::table('dianping_shop_info').
					  " set score = '$price',cnum='$count' where tid = '$stard[tid]'");
			}
			$std = DB::fetch_first("SELECT * FROM ".DB::table('dianping_skiing_info')." WHERE tid = '$star[typeid]'");
			if($std){
				DB::query("update ".DB::table('dianping_skiing_info').
					  " set score = '$price',cnum='$count' where tid = '$std[tid]'");
			}
			$sbr = DB::fetch_first("SELECT * FROM ".DB::table('dianping_brand_info')." WHERE tid = '$star[typeid]'");
			if($sbr){
				DB::query("update ".DB::table('dianping_brand_info').
					  " set score = '$price',cnum='$count' where tid = '$sbr[tid]'");
			}
		}
		return array(
			'starid' => $starid,
			'percent1' => $percent1,
			'percent2' => $percent2,
			'percent3' => $percent3,
			'percent4' => $percent4,
			'percent5' => $percent5,
			'count' => $count,
			'price' => $price
		);
	}

	function getStarInfoByType($type, $typeid) {
		return DB::fetch_first("SELECT * FROM ".DB::table('dianping_star_statistics')." WHERE type = '$type' AND typeid = '$typeid'");
	}

	function round($num, $precision) {
		$num = round($num, $precision);
		if (preg_match('/^\d+$/', $num)) {
			$num = $num.'.'.str_repeat('0', $precision);
		} elseif (preg_match('/^\d+\.(\d+)$/', $num, $m)) {
			$num = $num.str_repeat('0', $precision-$m[1]);
		}
		return $num;
	}
	// �Ƿ����۹�
	function isStared($type, $typeid, $uid) {
		$starid = DB::result_first("SELECT id FROM ".DB::table('dianping_star_statistics')." WHERE type = '$type' AND typeid = '$typeid'");
		if ($starid && DB::result_first("SELECT COUNT(*) FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND uid = $uid") > 0) {
			return true;
		}
		return false;
	}
	function getStarByRalateid($type, $typeid, $uid, $ralateid) {
		if($uid&&$ralateid){
			$starid = DB::result_first("SELECT id FROM ".DB::table('dianping_star_statistics')." WHERE type = '$type' AND typeid = '$typeid'");
			return $starid ? DB::fetch_first("SELECT * FROM ".DB::table('dianping_star_logs')." WHERE starid = $starid AND uid = $uid AND pid = $ralateid") : NULL;
		}else{
			return NULL;
		}
	}
	// ���Ӳ�ѯ�������� 2012-06-05 jianghong
	//mod = 1��ѯ��������  mod = 0��ѯ��ǰ�ط�������
	function groupmanageroption($fid,$typeid=0,$mod=1){
		require_once libfile('class/myredis');
		$myredis = & myredis::instance(6378);
		$return = $myredis->hashget('plugin_master_manager_all','fid:'.$fid.'typeid:'.$typeid.'mod:'.$mod);
		if(!$return){
			$str = ($typeid==0)? " " :" and typeid = ".$typeid;
			$group = array();

			$query =($mod==1)? DB::query("SELECT b_name FROM ".DB::TABLE('plugin_master_manager')." WHERE f_id = '$fid' ".$str." ORDER BY displayorder ASC") : DB::query("SELECT b_name FROM ".DB::TABLE('plugin_master_manager')." WHERE f_id = '$fid' GROUP BY b_name ORDER BY b_name ASC,ifdisplay DESC ");
			while ($value = DB::fetch($query)) {
				$group[] = $value['b_name'];
			}
			//echo "<br/>��ѯ���е�ǰ������õİ������Ƿ�������Ϣ";
			//print_r($group);
			$nodisplaygroup = array();
			$query = ($mod==1)? DB::query("SELECT b_name FROM ".DB::TABLE('plugin_master_manager')." WHERE  ifdisplay = 0 and f_id = '$fid' ".$str) : DB::query("SELECT b_name FROM ".DB::TABLE('plugin_master_manager')." WHERE f_id = '$fid' AND ifdisplay = 0");
			while ($value = DB::fetch($query)) {
				$nodisplaygroup[] = $value['b_name'];
			}
			//echo "<br/>����Ӧ�����صİ���";
			//	print_r($nodisplaygroup);
			if ($mod == 0) {
				$query = DB::result_first("SELECT moderators FROM ".DB::table('forum_forumfield')." WHERE fid = '$fid'");
				//echo "<br/>��ѯ����ǰ�������а������������أ�".$query;
				$maxmanager = explode("	", $query);
				$j = 0;
				$group = array();
				for ($i = 0; $i < count($maxmanager); $i++) {
					if (!in_array($maxmanager[$i], $nodisplaygroup)) {
						$group[$j] = $maxmanager[$i];
						//echo "<br/>".$maxmanager[$i]."����������";
						$j++;
					}
				}
				//echo "<br/>��������������ʾ�İ���";
				//print_r($group);
			}
			$group = array_unique($group);
			$return = implode("	", $group);
			$myredis->hashset('plugin_master_manager_all','fid:'.$fid.'typeid:'.$typeid.'mod:'.$mod,$return);
			$myredis->obj->expire('plugin_master_manager_all',3600);
		}
		return $return;
	}

	//���Ӷ�ȡ���˵��ֶ�
	function get_fiterkey(){
	    $key = $this->forum_setting['fiter_string'];
	    if(empty($key)){
		return false;
	    }
	    else{
		$arr = explode(",",$key);
		for($i=0;$i<count($arr);$i++){
		    $arr[$i]='"'.$arr[$i].'"';
		}

		$key = implode(",",$arr);
		return $key;
	    }
	}
	//��ȡ�Ƿ������˹���
	function get_fiterkey_setting(){
	    $fiter_state = $this->forum_setting['fiter_setting'];
	    $state_arr['on_off'] = $fiter_state;
	    $fiter_level = $this->forum_setting['fiter_level'];
	    $state_arr['fiter_level'] = $fiter_level;
	    return $state_arr;
	}
	//2012-06-27 ��������ȡ����������Ϣ
	function get_cache_index($key,$module){
	    if($module==""){
		return false;
	    }
	    $query=DB::fetch_first("SELECT * FROM ".DB::table('plugin_cache_tableindex')." WHERE type='".$module."'");
	    if(empty($query)){
		return false;
	    }
	    $tablename = $query['table_name'];
	    $tid = (int)$key;
	    $query=DB::query("SELECT * FROM ".DB::TABLE('plugin_cache_brand')." where id=$tid");
	    while($value=DB::fetch($query)){
		$info[$value['type']]=$value;
	    }
	    return $info;
	}
	//2012-06-27 ������ͨ������������Ϣ
	function get_info_by_index($method,$result){
	    $allmethod = array("articles","zb","dzty","topics","blogs","photos");
	    //echo "<p>����$method:";
	    if(!in_array($method, $allmethod)){
	      // echo "���ڷ�����";
	       return false;
	    }
	    if(empty($result[$method])){
		return null;
	    }
	    $dl_id = $result[$method]['id_array'];
	    switch ($method) {
		    case "articles" :
		    $sql = "SELECT aid, title, pic, remote,serverid, dateline FROM ".DB::table('portal_article_title')."	WHERE aid in($dl_id)  GROUP BY aid ORDER BY aid DESC LIMIT ".$result[$method]['limit'];
		    break;
		    case "topics" :
		$sql = "SELECT topicid,title,cover FROM ".DB::table('portal_topic')." WHERE closed = 0 AND topicid in($dl_id)  ORDER BY topicid DESC LIMIT ".$result[$method]['limit'];
		break;
		case "blogs" :
		$sql = "SELECT blogid,uid,subject FROM ".DB::table('home_blog')." WHERE blogid in($dl_id)  ORDER BY blogid DESC LIMIT ".$result[$method]['limit'];
		break;
		case "photos" :
		$sql = "SELECT * FROM ".DB::table('home_album')." WHERE  (friend=0 and albumid in($dl_id))  ORDER BY albumid DESC LIMIT ".$result[$method]['limit'];
		break;
		    default:
		    $sql = "SELECT pid,authorid,tid,subject FROM ".DB::table('forum_post')." WHERE subject != '' AND pid in($dl_id)  ORDER BY tid desc LIMIT ".$result[$method]['limit'];
		break;
	    }
	    $query = DB::query($sql);
	    $return = false;
	    /*���븽��������*/
	    require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
	    $attachserver = new attachserver;
	    $alldomain = $attachserver->get_server_domain('all');
	    /*����*/
	    while($value = DB::fetch($query)){
		if(in_array($method,array("zb","dzty"))){
		    $value['avatar'] = avatar($value['authorid'], 'small');
		}
		$pic_domain = (isset($value['remote']) && $value['remote']>0) ? $_G['setting']['ftp']['attachurl'] : ((isset($value['serverid']) && $value['serverid']>0) ? "http://".$alldomain[$value['serverid']]."/" : "/data/attachment/");
		if($method=='photos'){
		    if($value['friend']!= 4){
					    $value['pic'] =$pic_domain."album/".$value['pic'];
				    }
		}
		if($method=='articles' && !empty($value['pic'])){
		    $value['pic'] =$pic_domain."portal/".$value['pic'];
		}
		$return[] = $value;
	    }
	    return $return;
	}
	//2012-06-28 ���������ڲ�ѯ��ǰ�Ƿ���Ʒ����
	function get_produce_id_arr($search_arr){
	    $search_num = count($search_arr);
	    if($search_num==0){
		//echo "�����ѯ����Ϊ��";
		return false;
	    }
	    $produce_info = array();
	    $keywords = array();
	    $query = DB::query("SELECT f.tid,f.subject FROM ".DB::TABLE("forum_thread")." as f WHERE f.fid = 408 and f.displayorder >=0");
	    while($value = DB::fetch($query)){
		$keywords = self::get_keyword($value['subject']);
		$count_kw = 0; //����һ�������������ڲ�ѯ�������Ƿ��йؼ���
		for($kw=0;$kw<count($keywords);$kw++){
		    for($sea=0;$sea<$search_num;$sea++){
			$count_kw = $count_kw + preg_match("/".$keywords[$kw]."/",$search_arr[$sea]);
		    }
		}
		if($count_kw>0){
		    $produce_info[] = $value['tid'];
		}
	   }
	   return empty($produce_info) ? false : $produce_info;
	}
	//2012-06-28 ���������ڷ��عؼ���
	function get_keyword($str){
	    $keyword = array();
	    if(preg_match("/(\(|��|\)|��)/",$str)==0){
		$keyword[0] = trim($str);//ֻ��Ӣ������
		$keyword[0] = addcslashes($keyword[0],"\\'");
	    }else{//������������
		$keyword[0] = trim(preg_replace("/(\(|��).*(\)|��)/",'',$str));
		$keyword[1] = trim(preg_replace("/.*(\(|��)(.*)(\)|��)/",'\2',$str));
		$keyword[0] = addcslashes($keyword[0],"\\'");
		$keyword[1] = addcslashes($keyword[1],"\\'");
	    }
	    return $keyword;
	}
	//2012-06-28 ���� ���ڸ��»���
	function update_cache_produce($t_tid,$type){
	    $t_tid = (int)$t_tid;
	    if($t_tid==0 || $t_tid==null){
		//echo "�ύ��tid����";
		return false;
	    }
	    $typelist=array("articles","zb","dzty","topics","blogs","photos");
	    $numlist=array('articles'=>10,
			    'zb'=>8,
			    'dzty'=>8,
			    'topics'=>5,
			    'blogs'=>10,
			    'photos'=>4
			);
	    if(!in_array($type,$typelist)){
		//echo "��������ȷ";
		return false;
	    }
	    self::update_dl($t_tid,$type,$numlist[$type]);
	    return true;
	}
	//2012-07-02 �������û����ܻ����и��»������
	function update_dl($tid,$type,$limit){
	    $query=in_array($type,array("zb","dzty")) ? DB::query("SELECT pid from ".DB::table('plugin_cache_brand_index')." WHERE tid=$tid and type='".$type."' and displayorder >=0 order by pid desc limit 0,$limit") : DB::query("SELECT otherid from ".DB::table('plugin_cache_brand_otherindex')." WHERE id=$tid and type='".$type."'  and displayorder >=0 order by otherid desc limit 0,$limit");
	    $list = array();
	    while($value = DB::fetch($query)){
		$list[]=in_array($type,array("zb","dzty")) ? $value['pid'] : $value['otherid'];
	    }
	    if(empty($list)){
		return false;
	    }
	    $arr['id_array'] = implode(",",$list);
	    $arr['limit'] = $limit;
	    $arr['dateline'] = time();
	    if(DB::result_first("SELECT count(*) from ".DB::table('plugin_cache_brand')." WHERE id=$tid and type='".$type."'")==0){
		$arr['id'] = $tid;
		$arr['type'] = $type;
		$sql = DB::insert("plugin_cache_brand",$arr);
	    }else{
		$where = array('id'=>$tid,'type'=>$type);
		DB::update("plugin_cache_brand",$arr,$where);
	    }
	}
	//2012-07-02 �޸ģ����·���������֮�������Ʒ�Ʒ����ܻ�����У����ñ��档
	function produce_update_cache_all($value,$module,$other=1){
	    if(!is_array($value) || empty($value)){
		//echo "���ݲ��������Ϊ��";
		return false;
	    }
	    if(DB::result_first("SELECT count(*) from ".DB::table('plugin_cache_tableindex')." where type='".$module."'")==0){
		//echo "ģ�鲻����";
		return false;
	    }
	    $table = $other==1 ? "plugin_cache_".$module."_otherindex" : "plugin_cache_".$module."_index";
	    DB::insert($table,$value);
	    return true;
	}
	//2012-07-02 ���� ��ѯ��ǰID�Ƿ�Ϊ�ռ�Ʒ�ƣ�����ѯ���Ӧ��Ʒ��ID
	function get_tid_by_uid($uid){
	    $query = DB::query("SELECT tid FROM ".DB::table('forum_thread')." WHERE fid=408 and authorid=$uid and displayorder >=0 ");
	    while($value = DB::fetch($query)){
		$tid[] = $value['tid'];
	    }
	    if(!empty($tid)){
		return $tid;
	    }else{
		return false;
	    }
	}
	//����װ����Ϣ�ĸ���
	function getThreadsbytid($tid){
		if($tid){
			$str = "select * from ".DB::table('plugin_produce_info')." where tid=$tid";
			$info = DB::fetch_first($str);
			if($info['tid']){
				$sql = "select * from ".DB::table('forum_thread')." where tid=$info[tid]";
				$pstr = "select * from ".DB::table('forum_post')." where tid=$info[tid]";
				$prp = DB::fetch_first($sql);
				$post = DB::fetch_first($pstr);
				if($prp['displayorder'] < 0 || $prp['closed']!=0 || empty($post) || $post['invisible'] < 0){
					if($prp['tid']&&$prp['displayorder']==-4){
						$zb = DB::query("update ".DB::table('plugin_produce_info')." set isshow = 0 WHERE tid=$prp[tid]");
						echo "��װ�����ڲݸ������ݣ��ݲ��ܷ��ʣ�";exit;
					}elseif($prp['tid']&&$prp['displayorder']<0){
						$zb = DB::query("update ".DB::table('plugin_produce_info')." set isshow = 0 WHERE tid=$prp[tid]");
						echo "��װ�����Զ�����,�ݲ��ܷ��ʣ�";exit;
					}
				}elseif(empty($prp)&&$info['isshow']!=0){
					$zb = DB::query("update ".DB::table('plugin_produce_info')." set isshow = 0 WHERE tid=$info[tid]");
					echo "��װ���ѱ�����";exit;
				}
			}
		}
	}

	function getSiteUrlbyUrl($url){
		if($url){
			$url = substr($url,7);
			$dmstr = substr($url,0,strpos($url,'.'));
			$query = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domain')." where domain='{$dmstr}'");
			if($query){
				return 1;
			}else{
				return -1;
			}
		}
	}
	//���ݰ���Ų�ѯ����
	function getdomainbyfid($fid='all'){
		if($fid){
			$dm = memory('get','plugin_domain_get_domain_typeid_0_hSdVe');
			if(!$dm){
				// $dm = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domain')." where fid='{$fid}' and typeid=0");
				$query = DB::query("SELECT * FROM ".DB::table('plugin_domain')." where typeid=0");
				while($values = DB::fetch($query)){
					$dm[$values['fid']] = $values['domain'];
				}
				memory('set','plugin_domain_get_domain_typeid_0_hSdVe',$dm,3600);
			}
			if($fid == 'all'){
				return $dm;
			}
			if($dm[$fid]){
				return $dm[$fid];
			}else{
				return null;
			}
		}
	}
	//����fid��typeid��ѯ������Ϣ
	function getdomainbyfidandtypeid($fid='all',$typeid='all'){
		if($fid&&$typeid){
			$dm = memory('get','plugin_domain_get_domain_by_fidtypid_hUkNbv');
			if(!$dm){
				// $dm = DB::fetch_first("SELECT * FROM ".DB::table('plugin_domain')." where fid='{$fid}' and typeid='{$typeid}'");
				$query = DB::query("SELECT * FROM ".DB::table('plugin_domain')." where typeid > 0");
				while($values = DB::fetch($query)){
					$dm[$values['fid']][$values['typeid']] = $values['domain'];
				}
				memory('set','plugin_domain_get_domain_by_fidtypid_hUkNbv',$dm,3600);
			}
			if($fid == 'all' && $typeid == 'all'){
				return $dm;
			}
			if($typeid == 'all'){
				return $dm[$fid];
			}
			if($dm[$fid][$typeid]){
				return $dm[$fid][$typeid];
			}else{
				return null;
			}
		}
	}

}
$forumOption = new ForumOption();
