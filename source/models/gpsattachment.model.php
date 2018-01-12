<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
Class GpsattachmentModel extends BaseModel{ 
	var $table  = 'dianping_line_gpsattachment';
	var $alias  = 'gps';
	var $prikey = 'aid';
	
	/**
	 * 获取表数据
	 * @access public
	 * @param int $id
	 * @param string $type:aid,tid
	 * @return Array
	 */
	public function getData($id, $type = "aid"){
		$id = intval($id);
		$condition = $type == "aid" ? "{$this->alias}.aid = '{$id}'" : "{$this->alias}.tid = '{$id}'";		
		return $this->get(array('conditions' => $condition));
	}
	
	/**
	 * 删除当前附件
	 * @param int $id
	 * @param string $type:aid,tid
	 */
	function deleteThis($id, $type){
		global $_G;
		$gpsShow = $this->getData($id, $type);
		if ($gpsShow) {				
			//增加是否为附件服务器的判定
	        if($gpsShow['serverid']>0){
	            require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
	            $attachserver = new attachserver;
	            $serverinfo   = $attachserver->get_server_domain($gpsShow['serverid'],"*");
	            $attachserver->delete($serverinfo['domain'] , $serverinfo['api'] , $gpsShow["dir"].'/'.$gpsShow["attachment"]);         
	            $attachserver->delete($serverinfo['domain'] , $serverinfo['api'] , $gpsShow["kmlfile"]);
	            $attachserver->delete($serverinfo['domain'] , $serverinfo['api'] , $gpsShow["htmlfiledir"].$gpsShow["htmlfilename"]);
	        }else{
	            @unlink($_G['setting']['attachdir'].'/'.$gpsShow["dir"].'/'.$gpsShow["attachment"]);
				@unlink($_G['setting']['attachdir'].'/'.$gpsShow["kmlfile"]);
				@unlink($_G['setting']['attachdir'].'/'.$gpsShow["htmlfiledir"].$gpsShow["htmlfilename"]);
	        }		
			$this->drop("aid = {$gpsShow["aid"]}");   	
	        return true;
		}
		return false;
	}
	
	/**
	 * 下载gps文件---源自source/module/forum/forum_attachment.php
	 * @param string $aidencode
	 */
	function downloadGps($aidencode){
		global $_G;
		
		@list($_G['gp_aid'], $_G['gp_k'], $_G['gp_t'], $_G['gp_uid']) = explode('|', base64_decode($aidencode));
	
		if($_G['gp_uid'] != $_G['uid'] && $_G['gp_uid']) {
			$_G['gp_uid'] = intval($_G['gp_uid']);
			$groupid = DB::result_first("SELECT groupid FROM ".DB::table('common_member')." WHERE uid='$_G[gp_uid]'");
			loadcache('usergroup_'.$groupid);
			$_G['group'] = $_G['cache']['usergroup_'.$groupid];
		}
		
		$requestmode = !empty($_G['gp_request']) && empty($_G['gp_uid']);
		
		$aid = $_G['gp_aid'];		
		
		if($_G['setting']['attachexpire']) {
			$k = $_G['gp_k'];
			$t = $_G['gp_t'];
			$authk = !$requestmode ? substr(md5($aid.md5($_G['config']['security']['authkey']).$t.$_G['gp_uid']), 0, 8) : md5($aid.md5($_G['config']['security']['authkey']).$t);
			if(empty($k) || empty($t) || $k != $authk || TIMESTAMP - $t > $_G['setting']['attachexpire'] * 3600) {
				if($attach = $this->getData($aid, "aid")) {
					if(!$requestmode) {
						showmessage('attachment_expired', '', array('aid' => $aidencode, 'pid' => $attach['pid'], 'tid' => $attach['tid']));
					} else {
						exit;
					}
				} else {
					if(!$requestmode) {
						showmessage('attachment_nonexistence');
					} else {
						exit;
					}
				}
			}
		}
		
		$refererhost = parse_url($_SERVER['HTTP_REFERER']);
		$serverhost = $_SERVER['HTTP_HOST'];
		if(($pos = strpos($serverhost, ':')) !== FALSE) {
			$serverhost = substr($serverhost, 0, $pos);
		}
		
		if(!$requestmode && $_G['setting']['attachrefcheck'] && $_SERVER['HTTP_REFERER'] && !($refererhost['host'] == $serverhost)) {
			showmessage('attachment_referer_invalid', NULL);
		}
		
		periodscheck('attachbanperiods');
		
		$threadtable = 'forum_thread';
		
		$attachexists = FALSE;
		if(!empty($aid) && is_numeric($aid)) {
			$attach = $this->getData($aid, "aid");
			$thread = DB::fetch_first("SELECT tid, fid, posttableid, price, special FROM ".DB::table($threadtable)." WHERE tid='$attach[tid]' AND displayorder>='0'");
			if($attach) {
				$posttable = $thread['posttableid'] ? "forum_post_{$thread['posttableid']}" : 'forum_post';
				$attach['invisible'] = DB::result_first("SELECT invisible FROM ".DB::table($posttable)." WHERE pid='$attach[pid]'");
			}
			if($attach && $attach['invisible'] == 0) {
				$thread && $attachexists = TRUE;
			}
		}
		
		if(!$attachexists) {
			if(!$requestmode) {
				showmessage('attachment_nonexistence');
			} else {
				exit;
			}
		}
		
		$fileurl  = empty($_G['gp_iskml']) ? $attach["dir"].'/'.$attach["attachment"] : $attach["kmlfile"];
		$attach['filename']  = empty($_G['gp_iskml']) ? $attach['filename'] : str_replace(".{$attach["filetype"]}", ".kml", $attach['filename']);
//		echo $fileurl;
//		exit();
		if(!$requestmode) {
			if(empty($_G['gp_noupdate'])) {
				if($_G['setting']['delayviewcount'] == 2 || $_G['setting']['delayviewcount'] == 3) {
					/**声明redis**/
					require_once libfile('class/myredis');
					$myredis = & myredis::instance();
					/**结束**/
					if(substr(TIMESTAMP, -1) == '0'){
						require_once libfile('function/misc');


						updateviews_redis('dianping_line_gpsattachment', 'aid', 'downloads', 'gpsattachment');

					}
					/**将帖子点击存入缓存中**/
					if($myredis->connected){
						$myredis->obj->hincrby('gpsattachment_number',$aid,1);
					}else{
						DB::query("UPDATE ".DB::table("dianping_line_gpsattachment")." SET downloads=downloads+'1' WHERE aid='$aid'", 'UNBUFFERED');exit;
					}
				} else {
					DB::query("UPDATE ".DB::table("dianping_line_gpsattachment")." SET downloads=downloads+'1' WHERE aid='$aid'", 'UNBUFFERED');
				}
			}
		}
		$db = DB::object();
		$db->close();
		!$_G['config']['output']['gzip'] && ob_end_clean();					
	
		$filesize = $attach['filesize'];
		$attach['filename'] = '"'.(strtolower(CHARSET) == 'utf-8' && strexists($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? urlencode($attach['filename']) : $attach['filename']).'"';
		dheader('Date: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
		dheader('Last-Modified: '.gmdate('D, d M Y H:i:s', $attach['dateline']).' GMT');
		dheader('Content-Encoding: none');
		dheader('Content-Disposition: attachment; filename='.$attach['filename']);
		dheader('Content-Length: '.$filesize);
		header('Content-Type: application/octet-stream; charset=utf8');
		
		require_once DISCUZ_ROOT."/source/plugin/attachment_server/attachment_server.class.php";
		$attachserver  = new attachserver;
		$server_domain = $attachserver->get_server_domain($attach['serverid']);
		
		$this->getserverfile($fileurl,"http://".$server_domain);
		exit();
	}
	
	function getserverfile($file,$domain){
		@set_time_limit(0);
	    if(!@readfile("http://avatar.8264.com/".$file)){
//	        dheader("location: ".$domain."/".$file);
	        $fp = fopen($domain."/".$file, 'rb');
	        fpassthru($fp);
	        fclose($fp);
	    }
	}	
}
?>