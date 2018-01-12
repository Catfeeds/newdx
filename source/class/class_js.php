<?php
/*author: linsheng.wu
* date: 2014.6.13
*/
class JS {

	static function dialog($view, $params, $template='common/showmessage') {
		if($template) 
			include template($template);

		$dialog_path =  $_G['siteurl'] . 'template/8264/js/dialog.js';
		if(! file_exists($dialog_path)) {
		 	echo '<script type="text/javascript">jQuery(document).ready(function() { alert("js is missed!"); });</script>';
		 	return;
		}

		$dialog_content_id = 'dialog_' .uniqid();
		if(is_array($params)) {
			foreach($params as $key => $value) {
				$value = urlencode($value);
				$p .= "{$key}=$value&";
			}
			$params = $p . 'view_id=' . $dialog_content_id;
		}
		else {
			$params = 'view_id=' . $dialog_content_id;
		}

		$dialog = '<script type="text/javascript" src="%url?%params"></script><div id="%dialog_content_id" style="display: none;">%view</div>';

		echo  strtr($dialog, array(
			'%url' => $dialog_path,
			'%params' => $params,
			'%view' => $view,
			'%dialog_content_id' => $dialog_content_id
			));
	}

	static function alert_redirect($alert_msg, $redirect_url, $redirect_time=100) {
		global $_G;
		if(strpos($redirect_url, 'http://') === false) {
			$redirect_url = 'http://' . $redirect_url;
		}
		
		if($_G['inajax'] && $_G['gp_handlekey']) {
			$script = '<script type="text/javascript" reload="1"> succeedhandle_'
				 . $_G['gp_handlekey'] .
			'("%redirect_url", "%alert_msg", %delay);</script>';
			$show_script = strtr($script, array(
				'%alert_msg' => $alert_msg,
				'%redirect_url' => $redirect_url,
				'%delay' => $redirect_time
			));

			//所有 XML 文档中的文本均会被解析器解析。
			//只有 CDATA 区段（CDATA section）中的文本会被解析器忽略。
			ob_end_clean();
			@header("Expires: -1");
			@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
			@header("Pragma: no-cache");
			@header("Content-type: text/xml; charset=".CHARSET);
			ob_start();
			echo '<?xml version="1.0" encoding="'.CHARSET.'"?>'."\r\n";
			echo '<root><![CDATA[' . $show_script;
			$s = output_ajax();
			echo $s  . ']]></root>';
			exit;
		}
		else {
			$script = '<script src=' . "{$_G['siteurl']}static/js/jquery-1.9.1.min.js" . ' type="text/javascript"></script>';
			$script .=  '<script type="text/javascript">jQuery(document).ready(function() { alert("%alert_msg"); 
			setTimeout(function() {
				window.location.href = "%redirect_url";
			}, %delay);});</script>';
		}

		echo strtr($script, array(
				'%alert_msg' => $alert_msg,
				'%redirect_url' => $redirect_url,
				'%delay' => $redirect_time
			));
	}

	static function alert($alert_msg) {
		echo '<script type="text/javascript">alert("' . addslashes($alert_msg) . '");</script>';
	}

	static function redirect($url, $time=200, $params=null) {
		if(! $url) return false;
		if($params) {
			$query_str = implode('&', (array)$params);
		}
		$location_href = $query_str ? $url . "?{$query_str}" : $url;
		echo '<script type="text/javascript">window.location.href="' .$location_href. '"</script>';
	}
	
}