<?php
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}

require_once 'dianpingmod.model.php';
class  ChainModel extends DianpingmodModel {
	var $table = 'dianping_chain_info';
	var $alias = 'chain';
	var $_moduleid = 'chain';

	var $_vars = array(
		'pk' 		=> 'id',
		'tid' 		=> 'tid',
		'name' 		=> 'subject',
		'pic' 		=> 'showimg',
		'pcid'   => 'pcid',
		'pcname'   => 'pcname',
		'cid'   => 'cid',
		'cname' 	=> 'cname',
		'enable' 	=> 'ispublish',
		'province' => 'provinceid',
		'city' => 'cityid',
		'addr' => 'addr',
		'contact' => 'contact',
		'weixin' => 'weixin',
		'qq' => 'qq',
		'tel' => 'tel',
		'posttime' => 'dateline',
		'orderby' => 'displayorder',
		'score'    	=> 'score',
		'num'		=> 'cnum',
		'lastrate'	=> 'lastrate',
		'lastscore' => 'lastscore',
		'serverid' => 'serverid',
		'dir' => 'dir',
	);

	/**
	 * 获取表数据
	 * @access public
	 * @param int $tid
	 * @return Array
	 */
	public function getData($where, $fields='*',$order="id asc"){
		$arrParam = array();
		if ($where) {
			$arrParam['conditions'] = $where;
		}
		$arrParam['order'] = $order;
		$arrParam['fields'] = $fields;
		return $this->find($arrParam, false);
	}

	function initPost(&$data, $submit=false) {
		global $_G;

		if($submit) {
			if(! $data['subject'] || strlen($data['subject']) > 80) {
				return 'post_params_exist_error';
			}

			if(!$data['pcid'] || !$data['cid']) {
				return 'post_params_exist_error';
			}


			if(! $data['province'] ||  !$data['city'] ) {
				return '省市没有选择';
			}

			//验证是否必须要pic模块
			if (empty($data['imgselect']) && $this->getChildStatus('pic')){
				return 'model_need_pic';
			}
			$new_img_edit = $_G['gp_attachnew'];
			if(preg_match('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data['message'])){
				preg_match_all('/\[(attachimg|attach)\](\d+)\[\/(attachimg|attach)\]/i', $data['message'], $matches);
				$send_img=$matches[2];
				foreach($new_img_edit as $key=>$descon){
					if(!in_array($key, $send_img)){
						unset($new_img_edit[$key]);
					}
				}
			}else{
				unset($new_img_edit);
			}
			$data['new_img_edit'] = $new_img_edit;
			$data['message'] = preg_replace('/\[attachimg\](\d+)\[\/attachimg\]/is', '[attach]\1[/attach]', $data['message']);
			$data['message'] = trim($data['message']);

		}
		else {

			$data['url'] = $_G['config']['web']['portal'] . "forum.php?ctl={$this->_moduleid}";

			// 初始化编辑器相关设置
			$data['editorid'] = 'e';
			$_G['setting']['editoroptions'] = str_pad(decbin($_G['setting']['editoroptions']), 2, 0, STR_PAD_LEFT);
			$data['editor'] = array(
				'editormode' => $_G['setting']['editoroptions']{0},
				'allowswitcheditor' => $_G['setting']['editoroptions']{1},
				'allowhtml' => 1,
				'allowsmilies' => 0,
				'allowbbcode' => 1,
				'allowimgcode' => 1,
				'allowresize' => 1,
				'textarea' => 'message',
				'simplemode' => !isset($_G['cookie']['editormode_'.$data['editorid']]) ? 1 : $_G['cookie']['editormode_'.$data['editorid']],
			);

			$mdregions = m('regions');
			$data['regionsList'] = $mdregions->getAllProvinces('codeid,cityname');
			require_once libfile('function/post');
			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				$data['attachlist'] = getattach($pid, 0, 'all');
				$data['attachs'] = $data['attachlist']['attachs'];
				$data['imgattachs'] = $data['attachlist']['imgattachs'];
				unset($data['attachlist']);
				$attachfind = $attachreplace = array();
				if(!empty($data['attachs']['used'])) {
					foreach($data['attachs']['used'] as $attach) {
						if($attach['isimage']) {
							$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
							$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
						}
					}
				}
				if(!empty($data['imgattachs']['used'])) {
					foreach($data['imgattachs']['used'] as $attach) {
						$attachfind[] = "/\[attach\]$attach[aid]\[\/attach\]/i";
						$attachreplace[] = '[attachimg]'.$attach['aid'].'[/attachimg]';
					}
				}
				$attachfind && $data['editdata']['message'] = preg_replace($attachfind, $attachreplace, $data['editdata']['message']);
			}
			$data['imgattachs']['unused'] = !$sortid ? $data['imgattachs']['unused'] : '';

			//个人相册加载
			if($_G['uid']) {
				$albumlist = array();
				$query = DB::query("SELECT albumid, albumname, picnum FROM ".DB::table('home_album')." WHERE uid='$_G[uid]' ORDER BY updatetime DESC");
				while($value = DB::fetch($query)) {
					if($value['picnum']) {
						$albumlist[] = $value;
					}
				}
				$data['albumlist'] = $albumlist;
			}
		}

	}

	//使用编辑器提交后, html标签发生了变化, 需处理编辑器中内容. 该方法是简化后的方法,少执行了很多代码, 暂时没有发现bug.
	function bbcode2htmlcode($message) {
		require_once libfile('function/newdiscuzcode');
		return discuzcode($message);
	}

}
