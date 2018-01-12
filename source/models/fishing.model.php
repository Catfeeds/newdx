<?php
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}
require_once 'dianpingmod.model.php';

class  FishingModel extends DianpingmodModel {
	var $table = 'dianping_fishing_info';
	var $alias = 'fishing';
	var $_moduleid = 'fishing';
	/*字段说明
	* pk: 钓鱼id, 自增字段
	* tid: 帖子id, 与forum_thread表中的值相对应
	* name: 钓鱼名称
	* pic: 钓鱼图片
	* type: 钓鱼的类型
	* pro: 钓鱼所在省
	* city: 钓鱼所在市
	* address: 钓鱼所在的地址
	* longitude: 地图标注的坐标
	* latitude: 地图标注的坐标
	* enable: 是否激活
	* free: 是否免费 1 免费 0 收费
	* tel: 联系电话
	* // 以下字段用于排序用
	* score: 钓鱼的分数
	* num: 钓鱼被评论次数, 不包括未启用评论
	* lastrate: 最后一次点评的推荐指数
	* lastscore: 最后一次点评分数
	* lastpost: 最后一次点评时间
	*/
	var $_vars = array(
		'pk' 		=> 'id',
		'tid' 		=> 'tid',
		'name' 		=> 'subject',
		'pic' 		=> 'showimg',
		'type' 	=> 'type',
		'pro' => 'provinceid',
		'city' => 'cityid',
		'addr' => 'addr',
		'lon' => 'lon',
		'lat' => 'lat',
		'dateline' => 'dateline',
		'enable' 	=> 'ispublish',
		'isfree' => 'isfree',
		'tel' => 'tel',
		'score'    	=> 'score',
		'num'		=> 'cnum',
		'lastrate'	=> 'lastrate',
		'lastscore' => 'lastscore',
		'lastpost' => 'lastpost',
        'serverid' => 'serverid',
	);


	function initPost(&$data, $submit=false) {
		global $_G;
		if($submit) {
			if(! $data['subject'] || strlen($data['subject']) > 80) {
				return 'post_params_exist_error';
			}

			//validate address, fishing type...
			if(! $data['pro'] || ! $data['addr'] || ! $data['lon'] || ! $data['lat'] || ! $data['type'] || ! isset($data['isfree'])) {
				return 'post_params_exist_error';
			}

			//validate city and province
			$mdregions = m('regions');
			if($data['city'] == $data['pro']) {
				$c_province = $mdregions->find(array('fields' => 'codeid',
						'conditions' => "codeid='{$data[city]}' AND shengid=0",
						'limit' => 1

				));
			}
			else {
				$c_province = $mdregions->find(array('fields' => 'codeid',
						'conditions' => "codeid='{$data[city]}' AND shengid='{$data[pro]}'",
						'limit' => 1

				));
			}

			if(! $c_province) {
				return 'post_params_exist_error';
			}

			//validate fishing type
			$cate = m('categorys')->find(array(
					'fields' => 'fatherid',
					'conditions' => "cid='{$data[type]}'",
					'limit' => 1
				));
			if(! $cate) {
				return 'post_params_exist_error';
			}

			//验证是否必须要pic模块
			if (empty($data['imgselect']) && $this->getChildStatus('pic')) {
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
			$typelist = (array)$this->_getTypeClass();
			$typelist = $typelist ? current($typelist) : array();
			$fishingList = array();
			foreach ($typelist as $tv) {
				if ($tv['children']) {
					foreach ($tv['children'] as $cv) {
						$fishingList[$cv['cid']] = $cv['name'];
					}
					continue;
				}
				$fishingList[$tv['cid']] = $tv['name'];
			}
			$data['fishingTypes'] = $fishingList;
			$mdregions = m('regions');
			$data['provinces'] = $mdregions->getAllProvinces('codeid,cityname');

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

			if($_G['group']['allowpostattach'] || $_G['group']['allowpostimage']) {
				$attachlist = getattach(0);
				$data['attachs'] = $attachs = $attachlist['attachs'];
				$data['imgattachs'] = $imgattachs = $attachlist['imgattachs'];
				unset($attachlist);
			}

		}

	}


}
