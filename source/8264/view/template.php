<?php

/**
 * 模版类
 * $Id: template.php 10231 2009-12-08 02:20:25Z huibiaoli $
 */
class TemplateBase {

//	var $template_dir = '';
//	var $cache_dir = '';
//	var $compile_dir = '';
//	// 缓存更新时间, 默认 3600 秒
//	var $cache_lifetime = 3600;
//	var $direct_output = false;
//	var $caching = false;
//	var $template = array();
//	var $force_compile = false;
//	var $appoint_cache_id = false;
//	var $gzip = false;
//
//	var $_echash = '554fcae493e564ee0dc75bdf2ebf94ca';
//	var $_foreach = array();
//	var $_current_file = '';
//	var $_expires = 0;
//	var $_checkfile = true;
//	var $_foreachmark = '';
//	var $_seterror = 0;
//	// 临时存放 foreach 里 key 的数组
//	var $_temp_key = array();
//	// 临时存放 foreach 里 item 的数组
//	var $_temp_val = array();
//	var $options = null;

	var $_errorlevel = 0;
	var $_nowtime = null;
	var $_var = array();

	function __construct() {
		$this->_errorlevel = error_reporting();
		$this->_nowtime = time();
	}

	/**
	 * 注册变量
	 *
	 * @access  public
	 * @param   mix      $tpl_var
	 * @param   mix      $value
	 *
	 * @return  void
	 */
	function assign($tpl_var, $value = '') {
		if (is_array($tpl_var)) {
			foreach ($tpl_var as $key => $val) {
				if ($key != '') {
					$this->_var[$key] = $val;
				}
			}
		} else {
			if ($tpl_var != '') {
				$this->_var[$tpl_var] = $value;
			}
		}
	}

	/**
	 * 显示页面函数
	 *
	 * @access  public
	 * @param   string      $filename
	 * @param   sting      $cache_id
	 *
	 * @return  void
	 */
	function display($file, $templateid = 0, $tpldir = '', $gettplfile = 0, $primaltpl = '') {
		global $_G;
		static $_init_style = false;
		if ($_init_style === false) {
			$discuz = & discuz_core::instance();
			$discuz->_init_style();
			$_init_style = true;
		}
		if (strexists($file, ':')) {
			$clonefile = '';
			list($templateid, $file, $clonefile) = explode(':', $file);
			$oldfile = $file;
			$file = empty($clonefile) || STYLEID != $_G['cache']['style_default']['styleid'] ? $file : $file . '_' . $clonefile;
			if ($templateid == 'diy' && STYLEID == $_G['cache']['style_default']['styleid']) {
				$_G['style']['prefile'] = '';
				$diypath = DISCUZ_ROOT . './data/diy/';
				$preend = '_diy_preview';
				$previewname = $diypath . $file . $preend . '.htm';
				$_G['gp_preview'] = !empty($_G['gp_preview']) ? $_G['gp_preview'] : '';
				$curtplname = $oldfile;

				$dateline = DB::result_first("SELECT dateline FROM " . DB::table('common_diy') . " WHERE diyname = 'data/diy/{$file}.htm'");
				if ($dateline) {
					$tpldir = 'data/diy';
					$curtplname = $file;
					$flag = file_exists($previewname);
					if ($_G['gp_preview'] == 'yes') {
						$file .= $flag ? $preend : '';
					} else {
						$_G['style']['prefile'] = $flag ? 1 : '';
					}
				} else {
					$file = $primaltpl ? $primaltpl : $oldfile;
				}

				if ($_G['uid'] == 1) {
					updatediytemplate($file);
				}
				$tplrefresh = $_G['config']['output']['tplrefresh'];
				if (file_exists(DISCUZ_ROOT . TPLDIR . '/' . ($primaltpl ? $primaltpl : $oldfile) . '.htm')) {
					$tplotime = @filemtime(DISCUZ_ROOT . TPLDIR . '/' . ($primaltpl ? $primaltpl : $oldfile) . '.htm');
				} else {
					$tplotime = @filemtime(DISCUZ_ROOT . './template/default' . '/' . ($primaltpl ? $primaltpl : $oldfile) . '.htm');
				}
				if ($tpldir == 'data/diy' && ($tplrefresh == 1 || ($tplrefresh > 1 && !($_G['timestamp'] % $tplrefresh))) && $dateline && $dateline < $tplotime) {
					if (!updatediytemplate($file)) {
						DB::delete('common_diy', array("diyname" => "data/diy/$file.htm"));
						$tpldir = '';
					}
				}
				if (!$gettplfile && empty($_G['style']['tplfile'])) {
					$_G['style']['tplfile'] = empty($clonefile) ? $curtplname : $oldfile . ':' . $clonefile;
				}
				$_G['style']['prefile'] = !empty($_G['gp_preview']) && $_G['gp_preview'] == 'yes' ? '' : $_G['style']['prefile'];
			} else {
				$tpldir = './source/plugin/' . $templateid . '/template';
			}
		}

		//noteX (IN_MOBILE)
		if (defined('IN_MOBILE') && !defined('TPL_DEFAULT') || $_G['forcemobilemessage']) {
			$file = 'mobile/' . $file;
		}

		$file .=!empty($_G['inajax']) && ($file == 'common/header' || $file == 'common/footer') ? '_ajax' : '';
		$tpldir = $tpldir ? $tpldir : (defined('TPLDIR') ? TPLDIR : '');
		$templateid = $templateid ? $templateid : (defined('TEMPLATEID') ? TEMPLATEID : '');
		$tplfile = ($tpldir ? $tpldir . '/' : './template/') . $file . '.htm';
		$filebak = $file;
		$file == 'common/header' && defined('CURMODULE') && CURMODULE && $file = 'common/header_' . $_G['basescript'] . '_' . CURMODULE;

		//noteX (IN_MOBILE)
		if (defined('IN_MOBILE') && !defined('TPL_DEFAULT')) {
			if (strpos($tpldir, 'plugin')) {
				if (!file_exists(DISCUZ_ROOT . $tpldir . '/' . $file . '.htm')) {
					return;
				} else {
					$mobiletplfile = $tpldir . '/' . $file . '.htm';
				}
			} elseif ($tpldir == 'data/diy') {
				if (preg_match("/_\\d+/i", $file, $matchs)) {
					$tplfile_diy_ext = $matchs[0];
					$file = str_replace($tplfile_diy_ext, '', $file);
				}
			}
			!$mobiletplfile && $mobiletplfile = $file . '.htm';
			if (strpos($tpldir, 'plugin') && file_exists(DISCUZ_ROOT . $mobiletplfile)) {
				$tplfile = $mobiletplfile;
			} elseif (!file_exists(DISCUZ_ROOT . TPLDIR . '/' . $mobiletplfile)) {
				$mobiletplfile = './template/default/' . $mobiletplfile;
				if (!file_exists(DISCUZ_ROOT . $mobiletplfile) && !$_G['forcemobilemessage']) {
					$tplfile = str_replace('mobile/', '', $tplfile);
					$file = str_replace('mobile/', '', $file);
					$cachefile = str_replace('mobile_', '', $cachefile);
					define('TPL_DEFAULT', true);
				} else {
					$tplfile = $mobiletplfile;
				}
			} else {
				$tplfile = TPLDIR . '/' . $mobiletplfile;
			}
		}

		$cachefile = './data/template/' . (defined('STYLEID') ? STYLEID . '_' : '_') . $templateid . '_' . str_replace('/', '_', $file) . '.tpl.php';
		if ($templateid != 1 && !file_exists(DISCUZ_ROOT . $tplfile)) {
			if (file_exists(DISCUZ_ROOT . './template/8264/' . $filebak . '.htm')) {
				$tplfile = './template/8264/' . $filebak . '.htm';
			} else {
				$tplfile = './template/default/' . $filebak . '.htm';
			}
		}
		if ($gettplfile) {
			return $tplfile;
		}
		checktplrefresh($tplfile, $tplfile, @filemtime(DISCUZ_ROOT . $cachefile), $templateid, $cachefile, $tpldir, $file);
		extract($this->_var);
		include DISCUZ_ROOT . $cachefile;
	}
	/**
	 * @todo rewrite url，从display函数中迁出，解决与discuz原生url重写函数冲突的问题
	 * @author JiangHong
	 * @see urlrewrite()
	 * @since rebuild version 4771
	 * @return void
	 * @access public
	 */
	function myoutput(){
		$htmls = ob_get_clean();
		echo $this->urlrewrite($htmls);
	}
	/**
	 * 暂时使用次方法
	 * 在页面输出前从缓冲区读取输出，并通过配置文件的正则规则替换。
	 */
	function urlrewrite($contents)
	{
		global $_G;
		$nowctl = CTL;
		if(!empty($_G['config']['rewrite'][$nowctl]) && is_array($_G['config']['rewrite'][$nowctl]))
		{
			foreach($_G['config']['rewrite'][$nowctl] as $k => $v) {
				$contents = preg_replace('/forum.php\?ctl='.$nowctl.$k.'/i', $v, $contents, 20000, $count);
			}
		}
		if(!empty($_G['config']['rewrite']['global']) && is_array($_G['config']['rewrite']['global']))
		{
			foreach($_G['config']['rewrite']['global'] as $k => $v) {
				$contents = preg_replace('/forum.php\?'.$k.'/i', $v, $contents, 20000, $count);
			}
		}
		return $contents;
	}
	
	/**
	 * @todo 新增 用于重写个别url，比如做跳转。
	 * @author JiangHong
	 * @param String $url
	 * @return String
	 */
	function getUrlRewrite($url){
		global $_G;
		$nowctl = CTL;
		if(!empty($_G['config']['rewrite'][$nowctl]) && is_array($_G['config']['rewrite'][$nowctl]))
		{
			foreach($_G['config']['rewrite'][$nowctl] as $k => $v) {
				$url = preg_replace('/forum.php\?ctl='.$nowctl.$k.'/i', $v, $url, 1, $count);
				if($count > 0) return $url;
			}
		}
		if(!empty($_G['config']['rewrite']['global']) && is_array($_G['config']['rewrite']['global']))
		{
			foreach($_G['config']['rewrite']['global'] as $k => $v) {
				$url = preg_replace('/forum.php\?'.$k.'/i', $v, $url, 1, $count);
				if($count > 0) return $url;
			}
		}
		return $url;
	}
}

?>
