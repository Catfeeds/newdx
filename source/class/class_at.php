<?php
/**
* @通知功能
*/

class at
{
	public $atlist;
	public $thread;

	public function parse($message, $num = 10){
		global $_G;
		// if(empty($message)) return '';

		$this->atlist = $matches = array();
		preg_match_all("/@([^@][\S]+)[\s|:]{1,}/", $message.' ', $matches); //加空格为了匹配到最后一个@却没留空格的
		$matches = array_slice(array_unique($matches[1]), 0, $num);

		if(!empty($matches)){
			foreach ($matches as $key => $value) {
				$matches[$key] = addslashes($value);
			}
			$condition = dimplode($matches);
			$query = DB::query("SELECT uid, username FROM ".DB::table('common_member')." WHERE username IN ($condition) ".getSlaveID());
			while ($row = DB::fetch($query)) {
				$this->atlist[$row['uid']] = $row['username'];
			}

			if($this->atlist){
				foreach($this->atlist as $atuid => $atusername) {
					$atsearch[] = "/@".str_replace('/', '\/', preg_quote($atusername))." /i";
					$atreplace[] = "[url=home.php?mod=space&uid=$atuid]@{$atusername}[/url] ";
				}
				$message = preg_replace($atsearch, $atreplace, $message.' ', 1);
				$message = substr($message, 0, strlen($message) - 1);

				//记录最近@过的
				$fwusername = dimplode($this->atlist);
				$tablename = 'home_follow_'.substr($_G['uid'], -1);
				DB::query("UPDATE ".DB::table($tablename)." SET attime='$_G[timestamp]' WHERE uid='$_G[uid]' AND fwusername IN ($fwusername)");
			}

		}

		return $message;
	}

	public function notice(){
		global $_G;

		if($this->atlist) {
			foreach($this->atlist as $atuid => $atusername) {
				notification_add($atuid, 'at', 'at_message', array('from_id' => $this->tid, 'from_idtype' => 'at', 'src_uid' => $_G['uid'], 'src_username' => $_G['username'], 'tid' => $this->thread['tid'], 'subject' => $this->thread['subject'], 'pid' => $this->thread['pid']));
			}
		}
	}
}

?>
