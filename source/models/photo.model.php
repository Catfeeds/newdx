<?php
/**
 * @author JiangHong
 * @copyright 2013
 * 图集类，主要采取绑定帖子来实现
 */
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class PhotoModel extends BaseModel
{
	var $table = 'plugin_servers_photo';
	var $alias = 'spo';
	var $prikey = 'phid';
	var $_fid = 64;
	/**
	 * 通过tid读取图集
	 * @param Int $tid 帖子ID
	 * @param Int $status 图集状态
	 * @return Array
	 */
	function getPhotosByTid($tid, $status = 1)
	{
		$_photo = $this->get(array('conditions' => "tid = {$tid} AND status = {$status}"));
		$_pics = $this->_photoHandle($_photo);
		$_titles = empty($_photo['titles']) ? array() : unserialize($_photo['titles']);
		$_urls = empty($_photo['urls']) ? array() : unserialize($_photo['urls']);
		foreach ($_pics as $_aid => $_v) {
			$_tmparr = array(
				'pic' => $_v['attachment'],
				'title' => $_titles[$_aid],
				'url' => $_urls[$_aid]);
			$return[$_aid] = $_tmparr;
		}
		return $return;
	}
	/**
	 * 通过图集id来读取
	 * @param Int $phid
	 * @param Int $status
	 * @return Array
	 */
	function getPhotosById($phid, $status = 1, $width = 0, $height = 0, $type = 1, $checkauthor = false)
	{
		global $_G;
		$_photo = $this->get($phid);
		if(!$_photo) return false;
		$_photo['templates'] = unserialize($_photo['templates']);
		if ($_photo['status'] != $status && $status <= 1)
			return array();
		if (empty($_photo))
			return array();
		if ($checkauthor && $_photo['authorid'] != $_G['uid'])
			return array();
		$_pics = $this->_photoHandle($_photo);
		$_titles = empty($_photo['titles']) ? array() : unserialize($_photo['titles']);
		$_urls = empty($_photo['urls']) ? array() : unserialize($_photo['urls']);
		if ($width > 0 || $height > 0) {
			$width = $width > 0 ? $width : $height;
			$height = $height > 0 ? $height : $width;
		}
		foreach ($_pics as $_aid => $_v) {
			$_tmparr = array(
				'pic' => ($width > 0 && $height > 0) ? getimagethumb($width, $height, $type, $_v['attachment'], $_v['aid'], $_v['serverid']) : $_v['pic'],
				'title' => $_titles[$_aid],
				'url' => $_urls[$_aid],
				'pid' => $_v['pid'],
				);
			$return['photolist'][$_aid] = $_tmparr;
		}
		$return['photoinfo'] = $_photo;
		return $return;
	}
	/**
	 * 新建一个图集
	 * @param Array $aidarr 附件id的数组
	 * @param Array $urls 链接的数组
	 * @param Array $titles 标题的数组
	 * @return Int
	 */
	function addNewPhoto($aidarr, $urls, $titles, $templates, $name)
	{
		global $_G;
		/*暂使用DB，待thread和post模型建立后，再修改*/
		$subject = empty($name) ? "{$_G[username]} 于 " . date('Y-m-d H:i:s', $_G['timestamp']) . " 建立的图集" : $name;
		/*将图集作为帖子发表，但赋予管理员权限*/
		$_status = setstatus(3, 1, 0);
		$_status = setstatus(1, 1, $_status);
		$_threads = array(
			'fid' => $this->_fid,
			'subject' => $subject,
			'authorid' => $_G['uid'],
			'author' => $_G['username'],
			'readperm' => 240,
			'closed' => 1,
			'lastpost' => $_G['timestamp'],
			'lastposter' => $_G['username'],
			'dateline' => $_G['timestamp'],
			'replies' => (count($aidarr) - 1),
			'status' => $_status,
			);
		DB::insert('forum_thread', $_threads);
		$tid = DB::insert_id();
		$_i = 0;
		$_aids = implode(',', $aidarr);
		$_photo = $this->_photoHandle(array('aids' => $_aids), ',filename');
		require_once libfile('function/post');
		foreach ($aidarr as $_aid) {
			$_i++;
			$_insert_urls[$_aid] = empty($urls[$_aid]) ? $_photo[$_aid]['pic'] : (stripos($urls[$_aid], 'http') !== false ? $urls[$_aid] : 'http://' . $urls[$_aid]);
			$_insert_titles[$_aid] = empty($titles[$_aid]) ? $_photo[$_aid]['filename'] : $titles[$_aid];
			$message = '[url=' . $_insert_urls[$_aid] . ']' . $_insert_titles[$_aid] . "[/url]\n[attach]{$_aid}[/attach]";
			$_post = array(
				'tid' => $tid,
				'fid' => $this->_fid,
				'first' => $_i == 1 ? 1 : 0,
				'author' => $_G['username'],
				'authorid' => $_G['uid'],
				'subject' => $subject,
				'dateline' => $_G['timestamp'],
				'message' => $message,
				'useip' => $_G['clientip'],
				'attachment' => 2,
				);
			$_insert_pids[$_aid] = insertpost($_post);
			DB::update('forum_attachment', array('tid' => $tid, 'pid' => $_insert_pids[$_aid]), array('aid' => $_aid));
			updatepostcredits('+', $_G['uid'], $i == 1 ? 'post' : 'reply', $this->_fid);
			savepostposition($tid, $_insert_pids[$_aid]);
		}
		include_once libfile('function/stat');
		updatestat('thread');
		updatestat('post');
		DB::query("UPDATE " . DB::table('forum_forum') . " SET lastpost='{$_G[timestamp]}', threads=threads+1, posts=posts+{$_i}, todayposts=todayposts+{$_i} WHERE fid='{$this->_fid}'", 'UNBUFFERED');
		$_newphotodata = array(
			'tid' => $tid,
			'aids' => $_aids,
			'name' => $subject,
			'fid' => $this->_fid,
			'numpic' => $_i,
			'dateline' => $_G['timestamp'],
			'titles' => serialize($_insert_titles),
			'urls' => serialize($_insert_urls),
			'pids' => serialize($_insert_pids),
			'templates' => serialize($templates));
		return $this->add($_newphotodata);
	}
	/**
	 * 编辑一个相册
	 * @param Int $phid 图集的id
	 * @param Array $aids 附件的ID数组
	 * @param Array $urls 链接的数组
	 * @param Array $titles 标题的数组
	 * @return Bool
	 */
	function editPhoto($phid, $aids, $urls, $titles, $templates, $name)
	{
		global $_G;
		require_once libfile('function/post');
		$_photoinfo = $this->get($phid);
		if (empty($_photoinfo))
			return false;
		if ($_G['uid'] != $_photoinfo['authorid'] && $_G['groupid'] != 1)
			return false;
		if (empty($aids))
			return false;
		/*待附件模型建立后修改，此处将原先绑定的图片恢复未绑定状态*/
		DB::update('forum_attachment', array('pid' => 0, 'tid' => 0), "aid IN({$_photoinfo[aids]})");
		$_aids = implode(',', $aids);
		$_photo = $this->_photoHandle(array('aids' => $_aids), ',filename');
		$_i = $_j = 0;
		$pids = array_values(unserialize($_photoinfo['pids']));
		$subject = empty($name) ? "{$_G[username]} 于 " . date('Y-m-d H:i:s', $_G['timestamp']) . " 修改的图集" : $name;
		foreach ($aids as $_aid) {
			$_update_urls[$_aid] = empty($urls[$_aid]) ? $_photo[$_aid]['pic'] : (stripos($urls[$_aid], 'http') !== false ? $urls[$_aid] : 'http://' . $urls[$_aid]);
			$_update_titles[$_aid] = empty($titles[$_aid]) ? $_photo[$_aid]['filename'] : $titles[$_aid];
			$message = '[url=' . $_update_urls[$_aid] . ']' . $_update_titles[$_aid] . "[/url]\n[attach]{$_aid}[/attach]";
			if ($_i < $_photoinfo['numpic']) {
				DB::update('forum_post', array(
					'message' => $message,
					'subject' => $subject,
					'useip' => $_G['clientip']), array('pid' => $pids[$_i]));
				$_update_pids[$_aid] = $pids[$_i];
				unset($pids[$_i]);
			} else {
				$post = array(
					'tid' => $_photoinfo['tid'],
					'fid' => $this->_fid,
					'first' => 0,
					'author' => $_G['username'],
					'authorid' => $_G['uid'],
					'subject' => $subject,
					'dateline' => $_G['timestamp'],
					'message' => $message,
					'useip' => $_G['clientip'],
					'attachment' => 2,
					);
				$_update_pids[$_aid] = insertpost($post);
				updatepostcredits('+', $_G['uid'], 'reply', $this->_fid);
				savepostposition($_photoinfo['tid'], $_update_pids[$_aid]);
				$_j++;
			}
			DB::update('forum_attachment', array('tid' => $_photoinfo['tid'], 'pid' => $_update_pids[$_aid]), array('aid' => $_aid));
			$_i++;
		}
		/*修复bug，当减少图片数量时，将删除原先未使用的pid。*/
		if (! empty($pids)) {
			require_once libfile('function/delete');
			foreach ($pids as $_del_pid) {
				deletepost("pid = {$_del_pid}");
			}
		}
		if ($_j > 0) {
			DB::query("UPDATE " . DB::table('forum_forum') . " SET lastpost='{$_G[timestamp]}', posts=posts+{$_j}, todayposts=todayposts+{$_j} WHERE fid='{$this->_fid}'", 'UNBUFFERED');
		}
		DB::update('forum_thread', array(
			'lastpost' => $_G['timestamp'],
			'lastposter' => $_G['username'],
			'replies' => ($_i - 1)), array('tid' => $_photoinfo['tid']));
		include_once libfile('function/stat');
		updatestat('thread');
		updatestat('post');
		$_update_arr = array(
			'aids' => $_aids,
			'name' => $subject,
			'urls' => serialize($_update_urls),
			'titles' => serialize($_update_titles),
			'pids' => serialize($_update_pids),
			'numpic' => $_i,
			'status' => 0,
			'templates' => serialize($templates),
			);
		$this->edit($phid, $_update_arr);
		return true;
	}
	/**
	 * 对图集进行处理
	 * @param Array $phone 待处理的图集数组
	 * @param String 另外查询的拼接sql
	 * @return Array
	 */
	function _photoHandle($phone = array(), $find = '')
	{
		$_phone = array();
		$_tmp = explode(',', $phone['aids']);
		foreach ($_tmp as $_s) {
			$_phone[$_s] = '';
		}
		/*待附件模型建立后更改，暂使用DB*/
		$_q = DB::query("SELECT aid, pid, attachment, serverid {$find} FROM " . DB::table('forum_attachment') . " WHERE aid IN({$phone[aids]}) AND isimage = 1");
		while ($_v = DB::fetch($_q)) {
			$_v['pic'] = $this->_getAttachDomain($_v['attachment']);
			$_phone[$_v['aid']] = $_v;
		}
		return $_phone;
	}
	/**
	 * 读取附件服务器域名(待附件服务器模型建立后修改)
	 * @param String $image 图片的地址
	 * @param String $dir 图片的文件夹
	 * @return 返回处理后的图片地址
	 */
	function _getAttachDomain($image, $dir = 'forum')
	{
		global $_G;
		return $_G['config']['web']['attach'] . $dir . '/' . $image;
	}
}
?>