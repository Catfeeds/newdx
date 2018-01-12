<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: class_upload.php 17215 2010-09-26 10:04:38Z monkey $
 */


Class discuz_upload{

	var $attach = array();
	var $type = '';
	var $extid = 0;
	var $errorcode = 0;
	var $forcename = '';
    var $dirinfo = '';
	function discuz_upload() {

	}

	function init($attach, $type = 'temp', $extid = 0, $forcename = '') {

		if(!is_array($attach) || empty($attach) || !$this->is_upload_file($attach['tmp_name']) || trim($attach['name']) == '' || $attach['size'] == 0) {
			$this->attach = array();
			$this->errorcode = -1;
			return false;
		} else {
			$this->type = $this->check_dir_type($type);
			$this->extid = intval($extid);
			$this->forcename = $forcename;

			$attach['size'] = intval($attach['size']);
			$attach['name'] =  trim($attach['name']);
			$attach['thumb'] = '';
			$attach['ext'] = $this->fileext($attach['name']);

			$attach['name'] =  htmlspecialchars($attach['name'], ENT_QUOTES);
			if(strlen($attach['name']) > 90) {
				$attach['name'] = cutstr($attach['name'], 80, '').'.'.$attach['ext'];
			}

			$attach['isimage'] = $this->is_image_ext($attach['ext']);
			$attach['extension'] = $this->get_target_extension($attach['ext']);
			$attach['attachdir'] = $this->get_target_dir($this->type, $extid);
			$attach['attachment'] = $attach['attachdir'].$this->get_target_filename($this->type, $this->extid, $this->forcename).'.'.$attach['extension'];
			$attach['target'] = getglobal('setting/attachdir').'./'.$this->type.'/'.$attach['attachment'];
			$this->attach = & $attach;
			$this->errorcode = 0;
			return true;
		}
	}
	
	function init_wap($attach, $type = 'temp', $extid = 0, $forcename = '') {

		if(!is_array($attach) || empty($attach) || trim($attach['name']) == '' || $attach['size'] == 0) {
			$this->attach = array();
			$this->errorcode = -1;
			return false;
		} else {
			$this->type = $this->check_dir_type($type);
			$this->extid = intval($extid);
			$this->forcename = $forcename;

			$attach['size'] = intval($attach['size']);
			$attach['name'] =  trim($attach['name']);
			$attach['thumb'] = '';
			$attach['ext'] = $this->fileext($attach['name']);

			$attach['name'] =  htmlspecialchars($attach['name'], ENT_QUOTES);
			if(strlen($attach['name']) > 90) {
				$attach['name'] = cutstr($attach['name'], 80, '').'.'.$attach['ext'];
			}

			$attach['isimage'] = $this->is_image_ext($attach['ext']);
			$attach['extension'] = $this->get_target_extension($attach['ext']);
			$attach['attachdir'] = $this->get_target_dir($this->type, $extid);
			$attach['attachment'] = $attach['attachdir'].$this->get_target_filename($this->type, $this->extid, $this->forcename).'.'.$attach['extension'];
			$attach['target'] = getglobal('setting/attachdir').'./'.$this->type.'/'.$attach['attachment'];
			$this->attach = & $attach;
			$this->errorcode = 0;
			return true;
		}
	}

	function save($ignore = 0 , $replace = true ,$thumb=true ,$water=true) {
		if($ignore) {
            /*暂时修改，为测试将同时上传附件服务器和本机*/
			/*$this->save_to_attachment($replace);
            if($this->save_to_local($this->attach['tmp_name'], $this->attach['target'])){
                $this->errorcode = 0;
				return true;
            }else{
                $this->errorcode = -103;
                return false;
            }*/
            if(!$this->save_to_attachment($replace ,$thumb ,$water)){
    				$this->errorcode = -103;
    				return false;
            }else{
                $this->errorcode = 0;
                return true;
            }
		}

		if(empty($this->attach) || empty($this->attach['tmp_name']) || empty($this->attach['target'])) {
			$this->errorcode = -101;
		} elseif(in_array($this->type, array('group', 'album', 'category')) && !$this->attach['isimage']) {
			$this->errorcode = -102;
		} elseif(in_array($this->type, array('common')) && (!$this->attach['isimage'] && $this->attach['ext'] != 'ext')) {
			$this->errorcode = -102;
		} else{
            /*临时修改，为测试同时上传附件服务器和本机*/
            /*if($this->save_to_attachment($replace)){
                dsetcookie("upload_attach_8264_domain", '');
            }
            if($this->save_to_local($this->attach['tmp_name'], $this->attach['target'])){
                $this->errorcode = 0;
                return true;
            }else{
                $this->errorcode = -103;
            }*/
			dsetcookie("upload_attach_8264_attachmentname", '');
			dsetcookie("upload_attach_8264_attachmentserverid", '');
            if(!$this->save_to_attachment($replace ,$thumb ,$water)){
                    $this->errorcode = -103;
            }else{
                $this->errorcode = 0;
                return true;
            }
        }
        if(($this->attach['isimage'] || $this->attach['ext'] == 'swf') && (!$this->attach['imageinfo'] = $this->get_image_info($this->attach['target'], true))) {
			$this->errorcode = -104;
			@unlink($this->attach['target']);
		} else {
			$this->errorcode = 0;
			return true;
		}

		return false;
	}
	
	function save_wap() {

		if(empty($this->attach) || empty($this->attach['tmp_name']) || empty($this->attach['target'])) {
			$this->errorcode = -101;
		} elseif(in_array($this->type, array('group', 'album', 'category')) && !$this->attach['isimage']) {
			$this->errorcode = -102;
		} elseif(in_array($this->type, array('common')) && (!$this->attach['isimage'] && $this->attach['ext'] != 'ext')) {
			$this->errorcode = -102;
		} else{            
			dsetcookie("upload_attach_8264_attachmentname", '');
			dsetcookie("upload_attach_8264_attachmentserverid", '');
            $this->errorcode = 0;
            return true;
        }
        if(($this->attach['isimage'] || $this->attach['ext'] == 'swf') && (!$this->attach['imageinfo'] = $this->get_image_info($this->attach['target'], true))) {
			$this->errorcode = -104;
			@unlink($this->attach['target']);
		} else {
			$this->errorcode = 0;			
			return true;
		}

		return false;
	}

	function error() {
		return $this->errorcode;
	}

	function errormessage() {
		return lang('error', 'file_upload_error_'.$this->errorcode);
	}

	function fileext($filename) {
		return addslashes(strtolower(substr(strrchr($filename, '.'), 1, 10)));
	}

	function is_image_ext($ext) {
		static $imgext  = array('jpg', 'jpeg', 'gif', 'png', 'bmp');
		return in_array($ext, $imgext) ? 1 : 0;
	}

	function get_image_info($target, $allowswf = false) {
		$ext = discuz_upload::fileext($target);
		$isimage = discuz_upload::is_image_ext($ext);
		if(!$isimage && ($ext != 'swf' || !$allowswf)) {
			return false;
		} elseif(!is_readable($target)) {
			return false;
		} elseif($imageinfo = @getimagesize($target)) {
			list($this->attach['img_width'], $this->attach['img_height'], $type) = !empty($imageinfo) ? $imageinfo : array('', '', '');
			$size = $this->attach['img_width'] * $this->attach['img_height'];
			if($size > 16777216 || $size < 16 ) {
				return false;
			} elseif($ext == 'swf' && $type != 4 && $type != 13) {
				return false;
			} elseif($isimage && !in_array($type, array(1,2,3,6,13))) {
				return false;
			}
			return $imageinfo;
		} else {
			return false;
		}
	}

	function is_upload_file($source) {
		return $source && ($source != 'none') && (is_uploaded_file($source) || is_uploaded_file(str_replace('\\\\', '\\', $source)));
	}

	function get_target_filename($type, $extid = 0, $forcename = '') {
		if($type == 'group' || ($type == 'common' && $forcename != '')) {
			$filename = $type.'_'.intval($extid).($forcename != '' ? "_$forcename" : '');
		}else{
			$filename = date('His').strtolower(random(16));
		}
		return $filename;
	}

	function get_target_extension($ext) {
		static $safeext  = array('attach', 'jpg', 'jpeg', 'gif', 'png', 'swf', 'bmp', 'txt', 'zip', 'rar', 'mp3');
		return strtolower(!in_array(strtolower($ext), $safeext) ? 'attach' : $ext);
	}
/*去掉初始化时自动建立目录*/
	function get_target_dir($type, $extid = '', $check_exists = false) {
		$subdir = $subdir1 = $subdir2 = '';
		if($type == 'album' || $type == 'forum' || $type == 'portal' || $type == 'category' || $type == 'profile' || $type == 'plugin') {
			$subdir1 = date('Ym');
			$subdir2 = date('d');
			$subdir = $subdir1.'/'.$subdir2.'/';
		} elseif($type == 'group' || $type == 'common') {
			$subdir = $subdir1 = substr(md5($extid), 0, 2).'/';
		}
        $this->dirinfo['type'] = $type;
        $this->dirinfo['subdir1'] = $subdir1;
        $this->dirinfo['subdir2'] = $subdir2;
		$check_exists && discuz_upload::check_dir_exists($type, $subdir1, $subdir2);

		return $subdir;
	}

	function check_dir_type($type) {
		return !in_array($type, array('forum', 'group', 'album', 'portal', 'common', 'temp', 'category', 'profile', 'plugin')) ? 'temp' : $type;
	}

	function check_dir_exists($type = '', $sub1 = '', $sub2 = '') {

		$type = discuz_upload::check_dir_type($type);

		$basedir = !getglobal('setting/attachdir') ? (DISCUZ_ROOT.'./data/attachment') : getglobal('setting/attachdir');

		$typedir = $type ? ($basedir.'/'.$type) : '';
		$subdir1  = $type && $sub1 !== '' ?  ($typedir.'/'.$sub1) : '';
		$subdir2  = $sub1 && $sub2 !== '' ?  ($subdir1.'/'.$sub2) : '';

		$res = $subdir2 ? is_dir($subdir2) : ($subdir1 ? is_dir($subdir1) : is_dir($typedir));
		if(!$res) {
			$res = $typedir && discuz_upload::make_dir($typedir);
			$res && $subdir1 && ($res = discuz_upload::make_dir($subdir1));
			$res && $subdir1 && $subdir2 && ($res = discuz_upload::make_dir($subdir2));
		}

		return $res;
	}

	function save_to_local($source, $target) {
        discuz_upload::check_dir_exists($this->dirinfo['type'], $this->dirinfo['subdir1'], $this->dirinfo['subdir2']);
		if(!discuz_upload::is_upload_file($source)) {
			$succeed = false;
		}elseif(@copy($source, $target)) {
			$succeed = true;
		}elseif(function_exists('move_uploaded_file') && @move_uploaded_file($source, $target)) {
			$succeed = true;
		}elseif (@is_readable($source) && (@$fp_s = fopen($source, 'rb')) && (@$fp_t = fopen($target, 'wb'))) {
			while (!feof($fp_s)) {
				$s = @fread($fp_s, 1024 * 512);
				@fwrite($fp_t, $s);
			}
			fclose($fp_s); fclose($fp_t);
			$succeed = true;
		}

		if($succeed)  {
			$this->errorcode = 0;
			@chmod($target, 0644); //@unlink($source);
		} else {
			$this->errorcode = 0;
		}

		return $succeed;
	}

	function make_dir($dir, $index = true) {
		$res = true;
		if(!is_dir($dir)) {
			$res = @mkdir($dir, 0777);
			$index && @touch($dir.'/index.html');
		}
		return $res;
	}
    
	/**
	 * @todo 上传附件服务器方法
	 * @author jianghong
	 */
	function save_to_attachment($replace=false ,$thumb=true ,$water=true){
		global $_G;
		$plugin_name = DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
		if(file_exists($plugin_name)){
			require_once $plugin_name;
			$attachment = new attachserver;
			if($attachment->open_close('status')!='1'){
				return false;
			}
			if($attachment->set_attachment_info($this->attach)){
				$attachment->setlog($this->attach);
				/*如果为每日一图版块则会不增加水印*/
				$watermark = ($_G['gp_fid']==443 || !$water) ? false : true;
				/*采用新的cdn存储方式后，不再缩图，仅保留原图*/
				if($_G['config']['cdns']['opend'] === true){
					switch($this->type){
						case 'portal':
							//$watermark = true;
							$thumb = false;break;
						default:
							//$thumb = true;
							$watermark = false;break;
							
					}
					$imagecdnarr = $_G['config']['cdns']['config']['image'] ? $_G['config']['cdns']['config']['image'] : 'images';
					$filecdnarr = $_G['config']['cdns']['config']['file'] ? $_G['config']['cdns']['config']['file'] : 'attachfile';
					$cdnname = $this->attach['isimage'] == 1 ? ( is_array( $imagecdnarr ) ? $imagecdnarr[array_rand( $imagecdnarr )] : $imagecdnarr ) : ( is_array( $filecdnarr ) ? $filecdnarr[array_rand( $filecdnarr )] : $filecdnarr );
					$uploadreturn = $attachment->upYunUpload($this->attach['tmp_name'], $this->type, $watermark, $thumb, $cdnname);
				}else{
					$uploadreturn = $attachment->post_attachment($this->attach['tmp_name'],$this->type,$replace,$watermark,$thumb);
				}
				if($uploadreturn){
					$result = $attachment->get_result();
					$this->attach['attachment'] = $result['path'];
					$this->attach['serverid'] = $result['serverid'];
					$this->attach['width'] = $result['width'];
					$this->attach['height'] = $result['height'];
					$this->attach['thumb'] = $result['thumb'];
					$this->errorcode = 0;
					dsetcookie("upload_attach_8264_attachmentname", $attachment->name,10);
					dsetcookie("upload_attach_8264_attachmentserverid", $attachment->serverid,10);
					return true;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}

?>