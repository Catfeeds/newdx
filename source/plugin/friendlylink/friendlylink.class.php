<?php

/**
 * @author gtl
 * 新版友情链接
 * @filesource friendlylink.class.php
 */
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once DISCUZ_ROOT.'./source/plugin/friendlylink/config.inc.php';

class plugin_friendlylink {

	function __construct() {
		
	}

	/**
	 * @version 1.0 只在列表页显示
	 * @global array $_G
	 * @return string
	 */
	function global_friendlylink() {
		global $_G;
		global $_ENV;

		//读数据库 关键字=>内链 配置
		$default_key = 'plugin_friendlylink_default_config';
		$default = memory('get', $default_key);
		if (!is_array($default)) {
			$sql = "SELECT * FROM " . DB::table('common_friendlink2_inlink');
			$query = DB::query($sql);
			while ($values = DB::fetch($query)) {
				if(!$values['group']){
					$default[$values['id']]['keyword'] = $values['keyword'];
					continue ;
				}
				$default[$values['group']]['child'][$values['id']]['keyword'] = $values['keyword'];
				$default[$values['group']]['child'][$values['id']]['identifie'] = $values['identifie'];
			}
		
			if (!$default) {
				$default = array();
			}
			memory('set', $default_key, $default, 86400);
		}

		/**
		 * 找出列表页标记
		 * @todo 已经找出了标记,可以再考虑下是否严谨
		 */
		if (CURSCRIPT == 'portal' && in_array(CURMODULE, array('index', 'list'))) { // 资讯（门户）列表 pre_portal_category
			$typestr = P_FRIENDLYLINK_PORTAL . '|' . (int) $_G['gp_catid'];
			$outlinkname = $default[P_FRIENDLYLINK_PORTAL]['keyword'];
			$outlink = "http://www.8264.com";
			if($_G['gp_catid']){
				$outlink = "http://www.8264.com/list/".(int) $_G['gp_catid']."/";
			}
			//是否有默认配置
			foreach($default[P_FRIENDLYLINK_PORTAL]['child'] as $item){
				if($item['identifie'] == $typestr){
					$outlinkname = $item['keyword'];
					continue;
				}
			}
		} elseif (CURSCRIPT == 'forum' && in_array(CURMODULE, array('index', 'forumdisplay'))) { //论坛 pre_forum_forum
			$typestr = P_FRIENDLYLINK_FORUM . '|' . (int) $_G['gp_fid'] . '|' . (int) $_G['gp_typeid'];
			$outlinkname = $default[P_FRIENDLYLINK_FORUM]['keyword'];
			$outlink = "http://bbs.8264.com";
			if(CURMODULE == 'forumdisplay'){
				$outlink = "http://bbs.8264.com/forum-".(int) $_G['gp_fid']."-1.html";
				//从域名配置中查询对应的二级域名
				if(is_array($_ENV['domain']['list'])){
					foreach($_ENV['domain']['list'] as $domain=>$finfo){
						if($finfo['id'] == $_G['gp_fid'] && $finfo['typeid'] == 0 ){
							$outlink = "http://".$domain;
						}
					}
				}
			}
			if($_G['gp_typeid']){
				$outlink = "http://bbs.8264.com/forum-forumdisplay-fid-{$_G['gp_fid']}-typeid-{$_G['gp_typeid']}-filter-typeid.html";
			}
			//是否有默认配置
			foreach($default[P_FRIENDLYLINK_FORUM]['child'] as $item){
				if($item['identifie'] == $typestr){
					$outlinkname = $item['keyword'];
					continue;
				}
			}
		} elseif (CURSCRIPT == 'dianping' && array_key_exists(CURMODULE, $_G['config']['fids'])) { //点评系统的某页
			if ($_G['fid'] && $_G['gp_act'] == 'showlist') {
				$typestr = P_FRIENDLYLINK_DIANPING . '|' . $_G['fid'];
				$outlinkname = $default[P_FRIENDLYLINK_DIANPING]['keyword'];
				switch ($_G['fid']) {
					case 408: //户外品牌
						$outlink = 'http://www.8264.com/pinpai';
						if($_G['gp_nat']){
							$typestr.='|nat:'.$_G['gp_nat'];
							$outlink = 'http://www.8264.com/pinpai-'.$_G['gp_nat'].'-0-0-4-1';
						}
						break;
						
					case 490: //户外用品库
						$outlink = 'http://www.8264.com/zhuangbei.html';
						if($_G['gp_pcid']){
							$typestr.='|pcid:'.$_G['gp_pcid'];
							$outlink = 'http://www.8264.com/zhuangbei-'.$_G['gp_pcid'].'-0-0-5-1.html';
						}
						break;
						
					case 471: //户外店
						$outlink = 'http://www.8264.com/dianpu';
						if($_G['gp_pid']){
							$typestr.='|pid:'.$_G['gp_pid'];
							$outlink = 'http://www.8264.com/dianpu-'.$_G['gp_pid'].'-0-0-0-0-4-1';
						}
						break;
						
					case 497: //攀爬场地
						$outlink = 'http://www.8264.com/panpa';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/panpa/list-'.$_G['gp_type'].'-0-0-0-1-1.html';
						}
						break;
						
					case 477: //滑雪场
						$outlink = 'http://www.8264.com/xuechang';
						if($_G['gp_pro']){
							$typestr.='|pro:'.$_G['gp_pro'];
							$outlink = 'http://www.8264.com/xuechang-'.$_G['gp_pro'].'-5-1';
						}
						break;
						
					case 498: //潜水点
						$outlink = 'http://www.8264.com/qianshui/';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/qianshui/list-'.$_G['gp_type'].'-0-0-1-1.html';
						}
						break;
						
					case 392: //山峰
						$outlink = 'http://www.8264.com/shanfeng';
						if($_G['gp_dq']){
							$typestr.='|dq:'.$_G['gp_dq'];
							$outlink = 'http://www.8264.com/shanfeng-4-dq-'.$_G['gp_dq'].'-gd-0-page-1';
						}
						break;
						
					case 494: //线路
						$outlink = 'http://www.8264.com/xianlu';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/xianlu-'.$_G['gp_type'].'-0-0-0-4-1';
						}
						break;
						
					case 499: //钓鱼
						$outlink = 'http://www.8264.com/diaoyu/';
						if($_G['gp_type']){
							$typestr.='|type:'.$_G['gp_type'];
							$outlink = 'http://www.8264.com/diaoyu/list-'.$_G['gp_type'].'-0-0-0-1-1.html';
						}
						break;
						
					case 501: //户外俱乐部
						$outlink = 'http://www.8264.com/dianping-club-act-showlist.html';
						if($_G['gp_provinceid']){
							$typestr.='|provinceid:'.$_G['gp_provinceid'];
							$outlink = 'http://www.8264.com/dianping-club-act-showlist-order-lastpost-gongsitype-0-provinceid-'.$_G['gp_provinceid'].'-cityid-0-page-1.html';
						}
						break;
					default:
						$outlink = 'http://www.8264.com/zhuangbei.html';
						break;
				}
				//是否有默认配置
				foreach($default[P_FRIENDLYLINK_DIANPING]['child'] as $item){
					if($item['identifie'] == $typestr){
						$outlinkname = $item['keyword'];
						continue;
					}
				}
			}
		}

		//是否进行下一步
		if (empty($typestr)) {
			return;
		}

		//通过get存储当前页信息
		$hash = md5($typestr.$outlinkname.$outlink.md5('46ea7e'));

		/**
		 * 从缓存读出数据，模板拼接
		 */
		$key = 'plugin_friendlylink_list_'.$typestr;
		$data = memory('get', $key);
		if (!is_array($data)) {
			$sql = "SELECT * FROM " . DB::table('common_friendlink2') . " where identifie='{$typestr}' and ispass=2 order by displayorder,id";
			$query = DB::query($sql);
			while ($values = DB::fetch($query)) {
				$data[] = $values;
			}
			if (!$data) {
				$data = array();
			}
			memory('set', $key, $data, 86400);
		}
		
		$html = '';
		foreach ($data as $k => $url_item) {
			$html.= '	<a title="' . $url_item['name'] . '" target="_blank" href="' . $url_item['url'] . '">' . $url_item['name'] . '</a>';
		}
		$html .= '		<a title="友链申请" target="_blank" href="plugin.php?id=friendlylink:add&type=' . $typestr . '&n='.urlencode($outlinkname).'&l='.urlencode($outlink).'&h='.$hash.'">友链申请</a>
					';
		
		return $html;
	}

}
?>


