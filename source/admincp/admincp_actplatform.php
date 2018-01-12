<?php

/**
 *      活动平台管理
 *      by lvshuo
 */

if(!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$operation = in_array($operation, array('addbanner', 'editbanner', 'hotact','actlist' , 'addact', 'editact')) ? $operation : 'bannerlist';
cpheader();
showsubmenu('活动平台管理',  array(
	array('banner列表', "actplatform&operation=bannerlist", $operation == 'bannerlist'),
	array('新建banner', "actplatform&operation=addbanner", $operation == 'addbanner' || $operation == 'editbanner'),
	array('热门活动管理', "actplatform&operation=hotact", $operation == 'hotact'),
	array('活动列表管理', "actplatform&operation=actlist", $operation == 'actlist'),
	array('新建活动', "actplatform&operation=addact", $operation == 'addact')
));

if($operation == 'bannerlist') {
	
	if(submitcheck('actplatformsubmit')) {

		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);

		$aids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";		
		$url  = "action=actplatform&operation=bannerlist&&perpage={$perpage}&page={$page}";
		
		if ($_G['gp_optype'] == 'trash' && $aids) {	
			$attachids = array();
			$sql = "SELECT attachid FROM ".DB::table('portal_article_actplatform')." where aid in ({$aids}) " . getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				$attachids[$v['attachid']] = $v['attachid'];
			}
			DB::delete('portal_article_actplatform', "aid in ({$aids})");
			if ($attachids) {
				$attachids = implode(',', $attachids);
				DB::delete('forum_attachment', "aid in ({$attachids})");
			}
			cpmsg('删除成功', $url, 'succeed');
		} else {
			cpmsg('article_choose_at_least_one_operation', $url, 'error');
		}

	} else {

		include_once libfile('function/portalcp');

		$mpurl   = ADMINSCRIPT.'?action=actplatform&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;		
		
		showformheader('actplatform&operation=bannerlist');
		showtableheader('活动平台管理');
		showsubtitle(array('', '图片', '链接', '顺序', '发布时间', '操作'));

		$multipage = '';
		$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('portal_article_actplatform')." " . getSlaveID());
		if($count) {
			$sql = "SELECT z.*,t.title FROM ".DB::table('portal_article_actplatform')." z LEFT JOIN ".DB::table('portal_article_title')." t ON z.aid=t.aid order by z.`order` desc,z.dateline desc LIMIT {$start},{$perpage} " . getSlaveID();
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['pic'] = $value['pic'] ? getimagethumb(60,60,2,'plugin/'.$value['pic'], 0, 99) : '';
				showtablerow('', array('class="td25"', 'width="180"', 'class="td28"'), array(
						"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[aid]\">",
						$value['pic'] ? "<img src=\"{$value['pic']}\" />" : '',				
						"http://www.8264.com/viewnews-{$value[aid]}-page-1.html",
						$value['order'],
						date("Y-m-d H:i:s", $value['dateline']),
						"<a href=\"admin.php?&action=actplatform&operation=editbanner&aid=$value[aid]\">修改</a>"
					));
			}
			$multipage = multi($count, $perpage, $page, $mpurl);
		}

		$optypehtml = ''
			.'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$perpage.'"/><input type="radio" name="optype" id="optype_trash" value="trash" class="radio" /><label for="optype_trash">彻底删除</label>&nbsp;&nbsp;';
		showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="actplatformsubmit" value="'.cplang('submit').'" />', $multipage);
		showtablefooter();
		showformfooter();
	}
} elseif($operation == 'addbanner' || $operation == 'editbanner') {
	
	if(submitcheck('actplatformsubmit')) {
		$aid 		= !empty($_G['gp_aid']) ? intval($_G['gp_aid']) : 0;
		$attachid   = !empty($_G['gp_imgselect'][0]) ? intval($_G['gp_imgselect'][0]) : 0;
		if ($attachid) {
			if($aid){
			$actplatformShow = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_actplatform')." where aid={$aid}" . getSlaveID());
			}
			
			$data = array();
			$data['bannerurl'] 		= $_G['gp_bannerurl'];

			$data['order'] 		= !empty($_G['gp_order']) ? intval($_G['gp_order']) : 0;
			$data['dateline'] 	= $_G['timestamp'];
			$data['pic'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$attachid} " . getSlaveID());
			$data['attachid'] 	= $attachid;
			if ($actplatformShow) {				
				if ($actplatformShow['attachid'] != $attachid) {
					DB::delete('forum_attachment', "aid in ({$actplatformShow['attachid']})");
				}				
				DB::update('portal_article_actplatform', $data, "aid={$aid}");
			} else {
				//$data['aid'] = $aid;
				DB::insert('portal_article_actplatform', $data);
			}				
			cpmsg('发布成功', 'action=actplatform&operation=bannerlist', 'succeed');	
		}			
	} else {
		$adminscript = ADMINSCRIPT;
		$random      = random(4);
		$formhash    = FORMHASH;
		$aid 		 = !empty($_G['gp_aid']) ? intval($_G['gp_aid']) : 0;
		$actplatformShow = array();
		$picstr		 = '';
		$picnum  	 = 0;
		if ($aid) {
			$actplatformShow = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_actplatform')." where aid={$aid}" . getSlaveID());			
		}
		if ($actplatformShow['pic']) {			
			$actplatformShow['pic'] = getimagethumb(60,60,2,'plugin/'.$actplatformShow['pic'], 0, 99);
			$picstr .= '<span id="imagelist_id_'.$actplatformShow['attachid'].'">';
			$picstr .= '<img src="'.$actplatformShow['pic'].'" />';
			$picstr .= '<b class="deleteimg">删除</b>';
			$picstr .= '<input type="hidden" value="'.$actplatformShow['attachid'].'" name="imgselect[]">';
			$picstr .= '</span>';
			$picnum  = 1;
		}		
		
		showformheader("actplatform&operation={$operation}");		
		echo <<<ZBLUNBO
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}
#imglist .overlimit {display:none;}
</style>		
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">
		<input type="hidden" name="aid" class="inputText" value="{$actplatformShow['aid']}"/>
		<tr class="pubDt50">
			<th>链接</th><td><input type="text" name="bannerurl" class="inputText" value="{$actplatformShow['bannerurl']}"/>请以http://开头</td>
		</tr>
		<tr class="pubDt50">
			<th>顺序</th><td><input type="text" name="order" class="inputText" value="{$actplatformShow['order']}"/></td>
		</tr>
		<tr class="pubDt50">
			<th>图片</th>
			<td>
				<input id="numimage" type="hidden" name="uploadfile" value="{$picnum}"/>
				<div id="pic_upload_multiimg">
					此内容需要 Adobe Flash Player 11.1.0 或更高版本
					<script type="text/javascript">
						var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
						document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
					</script>
				</div>				
			</td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td>	
				图片尺寸大于660px*350px，图片张数不多于1张
				<div id="imglist" class="readyPic">{$picstr}</div>
			</td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td>
				<input type="hidden" name="actplatformsubmit" value="true" />
				<input type="hidden" name="formhash" id="formhash" value="{$formhash}" />
				<input type="submit" value=" " class="publish182x43_1" />
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript" src="static/js/newswfobject.js"></script>
<script type="text/javascript">
	var params = {site:"{$_G[siteroot]}misc.php%3fmod=swfupload%26type=image%26fid=0%26mtype=plugin%26twidth=60%26theight=60%26back=uploadsuccess_back%26random={$random}",buttonimg:"{$_G[siteroot]}static/image/common/uploadnew.png"};
	swfobject.embedSWF("static/flash/uploadforum.swf", "pic_upload_multiimg", "208", "50", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
	swfobject.createCSS("#pic_upload_multiimg", "text-align:left;");
</script>
<script>
var maxpic = 1;
function uploadsuccess_back(type, returndata) {
	eval("var nattach = " + returndata + ";");
	jQuery.noConflict();
	;(function($){
		switch(type){
			case 1:
			case 2:
				var html = '';
				html 	+= '<span id="imagelist_id_'+nattach.aid+'">';
				html 	+= '<img src="' + nattach.thumbpic + '" />';
				html 	+= '<b class="deleteimg">删除</b>';
				html 	+= '<input type="hidden" value="'+nattach.aid+'" name="imgselect[]">';
				html 	+= '</span>';

				$("#imglist").append(html);
				var attachobj = $('#imagelist_id_' + nattach.aid);
				attachobj.find('input').removeAttr('disabled').end().show();

				attachobj.find('img').one('error', function(){
					$(this).attr('src', ' ');
					$(this).attr('src', nattach.thumbpic);
				}).show();
				break;
			case 3:
				break;
		}
		$('#imglist').find('span:gt(' + (maxpic - 1) + ')').addClass("overlimit").find('input').attr('disabled', true);
		//算下上传图片数
		$("#numimage").attr("value", $('#imglist').find("span:not('.overlimit')").length);
	})(jQuery);
}
jQuery(function(){
	jQuery(document).on("click", "#imglist .deleteimg", function() {
		jQuery(this).parent().remove();
		if(jQuery("#imglist .overlimit").length > 0){
			jQuery("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
		}else{
			jQuery("#numimage").val(jQuery("#numimage").val() - 1);
		}
	});
});
</script>
ZBLUNBO;
showformfooter();
	}
		
} elseif($operation == 'hotact') {
	if(submitcheck('hotactsubmit')) {

		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);		
		$url  = "action=actplatform&operation=hotact&&perpage={$perpage}&page={$page}";
			
		for($i=1;$i<=5;$i++){
			$data = array();
			$data['url'] = $_G['gp_url'.$i];
			$data['title'] = $_G['gp_title'.$i];
			$aid =$_G['gp_aid'.$i];
			DB::update('portal_article_hotact', $data, "aid={$aid}");
		}
		
		cpmsg('更新成功', $url, 'succeed');


	} else {

		include_once libfile('function/portalcp');

		$mpurl   = ADMINSCRIPT.'?action=actplatform&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;		
		
		showformheader('actplatform&operation=hotact');
		showtableheader('热门活动管理');
		showsubtitle(array('顺序', '标题', '链接'));

		$multipage = '';
		$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('portal_article_hotact')." " . getSlaveID());
		if($count) {
			$sql = "SELECT * FROM ".DB::table('portal_article_hotact')." " . getSlaveID();
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['pic'] = $value['pic'] ? getimagethumb(60,60,2,'plugin/'.$value['pic'], 0, 99) : '';
				showtablerow('', array('class="td25"', 'width="400"', 'class="400"'), array(
						$value['aid']."<input type=\"hidden\"   name=\"aid{$value[aid]}\" value=\"$value[aid]\">",
						"<input type=\"input\" class=\"txt\" style=\"width:360px;\"  name=\"title{$value[aid]}\" value=\"$value[title]\">",
						"<input type=\"input\" class=\"txt\" style=\"width:360px;\"  name=\"url{$value[aid]}\" value=\"$value[url]\">"
					));
			}
			$multipage = multi($count, $perpage, $page, $mpurl);
		}

		showsubmit('', '', '', '<input type="submit" class="btn" name="hotactsubmit" value="'.cplang('submit').'" />', $multipage);
		showtablefooter();
		showformfooter();
	}
} elseif($operation == 'actlist') {
	
	if(submitcheck('actawardssubmit')) {

		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);

		$aids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";		
		$url  = "action=actplatform&operation=actlist&&perpage={$perpage}&page={$page}";
		
		if ($_G['gp_optype'] == 'trash' && $aids) {	
			
			DB::delete('portal_article_actawards', "aid in ({$aids})");
			cpmsg('删除成功', $url, 'succeed');
		} else {
			cpmsg('article_choose_at_least_one_operation', $url, 'error');
		}

	} else {

		include_once libfile('function/portalcp');

		$mpurl   = ADMINSCRIPT.'?action=actplatform&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;		
		
		showformheader('actplatform&operation=actlist');
		showtableheader('活动列表管理');
		showsubtitle(array('', '标题', '开始时间', '结束时间', '公布结果时间', '操作'));

		$multipage = '';
		$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('portal_article_actawards')." " . getSlaveID());
		if($count) {
			$sql = "SELECT z.*,t.subject FROM ".DB::table('portal_article_actawards')." z LEFT JOIN ".DB::table('forum_thread')." t ON z.aid=t.tid order by z.`order` desc,z.dateline desc LIMIT {$start},{$perpage} " . getSlaveID();
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
						"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[aid]\">",
						"<a href=\"http://bbs.8264.com/thread-$value[aid]-1-1.html\" target=\"_blank\">$value[subject]</a>",
						$value['starttime'],
						$value['endtime'],
						$value['publictime'],
						"<a href=\"admin.php?&action=actplatform&operation=editact&aid=$value[aid]\">修改</a>"
					));
			}
			$multipage = multi($count, $perpage, $page, $mpurl);
		}

		$optypehtml = ''
			.'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$perpage.'"/><input type="radio" name="optype" id="optype_trash" value="trash" class="radio" /><label for="optype_trash">彻底删除</label>&nbsp;&nbsp;';
		showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="actawardssubmit" value="'.cplang('submit').'" />', $multipage);
		showtablefooter();
		showformfooter();
	}
} elseif($operation == 'addact' || $operation == 'editact') {
	
	if(submitcheck('actsubmit')) {
		$aid 		= !empty($_G['gp_aid']) ? intval($_G['gp_aid']) : 0;
		$aidold 		= !empty($_G['gp_aidold']) ? intval($_G['gp_aidold']) : 0;
		if ($aid) {
			
			$actawardsShowOld = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_actawards')." where aid={$aidold}" . getSlaveID());
			
			$pic1_attachid   = !empty($_G['gp_imgselect'][0]) ? intval($_G['gp_imgselect'][0]) : 0;
			$pic2_attachid   = !empty($_G['gp_imgselect'][1]) ? intval($_G['gp_imgselect'][1]) : 0;
			$pic3_attachid   = !empty($_G['gp_imgselect'][2]) ? intval($_G['gp_imgselect'][2]) : 0;
			$pic4_attachid   = !empty($_G['gp_imgselect'][3]) ? intval($_G['gp_imgselect'][3]) : 0;
			
			$data = array();
			$data['pic1'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic1_attachid} " . getSlaveID());
			$data['pic2'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic2_attachid} " . getSlaveID());
			$data['pic3'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic3_attachid} " . getSlaveID());
			$data['pic4'] 		= DB::result_first("SELECT attachment FROM ".DB::table('forum_attachment')." where aid={$pic4_attachid} " . getSlaveID());
			$data['pic1_attachid'] = $pic1_attachid;
			$data['pic2_attachid'] = $pic2_attachid;
			$data['pic3_attachid'] = $pic3_attachid;
			$data['pic4_attachid'] = $pic4_attachid;
			
			$data['starttime'] 	= !empty($_G['gp_starttime']) ? $_G['gp_starttime'] :date('Y-m-d');
			$data['endtime'] 	= !empty($_G['gp_endtime']) ? $_G['gp_endtime'] :date('Y-m-d');
			$data['publictime'] 	= !empty($_G['gp_publictime']) ? $_G['gp_publictime'] :date('Y-m-d');
			$data['order'] 		= !empty($_G['gp_order']) ? intval($_G['gp_order']) : 0;
			//$data['dateline'] 	= $_G['timestamp'];
			
			if ($actawardsShowOld) {	
				if($aidold == $aid){
					DB::update('portal_article_actawards', $data, "aid={$aid}");
				}else{
					$actawardsShow = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_actawards')." where aid={$aid}" . getSlaveID());
					if($actawardsShow){
						cpmsg('发布失败,活动ID已存在', 'action=actplatform&operation=actlist', 'succeed');	
						die;
					}
					
					$data['dateline'] 	= $actawardsShowOld['dateline'];
					$data['aid'] = $aid;
					$res_edit_del = DB::insert('portal_article_actawards', $data);
					if($res_edit_del){
						DB::delete('portal_article_actawards', "aid = '{$aidold}'");
					}else{
						cpmsg('发布失败', 'action=actplatform&operation=actlist', 'succeed');	
						die;
					}
				}
			} else {
				$actawardsShow = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_actawards')." where aid={$aid}" . getSlaveID());
				if($actawardsShow){
					cpmsg('发布失败,活动ID已存在', 'action=actplatform&operation=actlist', 'succeed');	
					die;
				}
				$data['dateline'] 	= $_G['timestamp'];
				$data['aid'] = $aid;
				DB::insert('portal_article_actawards', $data);
			}				
			cpmsg('发布成功', 'action=actplatform&operation=actlist', 'succeed');	
		}			
	} else {
		$adminscript = ADMINSCRIPT;
		$random      = random(4);
		$formhash    = FORMHASH;
		$aid 		 = !empty($_G['gp_aid']) ? intval($_G['gp_aid']) : 0;
		$actawardsShow = array();
		$picstr		 = '';
		$picnum  	 = 0;
		if ($aid) {
			$actawardsShow = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_actawards')." where aid={$aid}" . getSlaveID());	
			if ($actawardsShow) {	
				for($i=1;$i<=4;$i++){
					if ($actawardsShow['pic'.$i]) {			
						$actawardsShow['pic'.$i] = getimagethumb(60,60,2,'plugin/'.$actawardsShow['pic'.$i], 0, 99);
						$picstr .= '<span id="imagelist_id_'.$actawardsShow['pic'.$i.'_attachid'].'">';
						$picstr .= '<img src="'.$actawardsShow['pic'.$i].'" />';
						$picstr .= '<b class="deleteimg">删除</b>';
						$picstr .= '<input type="hidden" value="'.$actawardsShow['pic'.$i.'_attachid'].'" name="imgselect[]">';
						$picstr .= '</span>';
						$picnum++;
					}
				}
			}
		}
		
		
		showformheader("actplatform&operation={$operation}");		
		echo <<<ZBLUNBO
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}

</style>


<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">
		<tr class="pubDt50">
			<th>帖子ID</th><td><input type="text" name="aid" class="inputText" value="{$actawardsShow['aid']}" /><input type="hidden" name="aidold" value="{$actawardsShow['aid']}" /></td>
		</tr>
		<tr class="pubDt50">
			<th>图片</th>
			<td>
				<input id="numimage" type="hidden" name="uploadfile" value="{$picnum}"/>
				<div id="pic_upload_multiimg">
					此内容需要 Adobe Flash Player 11.1.0 或更高版本
					<script type="text/javascript">
						var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
						document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
					</script>
				</div>				
			</td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td>	
				图片尺寸大于660px*350px，建议上传3张，只保存前4张
				<div id="imglist" class="readyPic">{$picstr}</div>
			</td>
		</tr>
		<tr class="pubDt50">
			<th>开始时间</th><td>
				<input type="text" name="starttime" id="starttime" class="inputText" value="{$actawardsShow['starttime']}" onclick="showcalendar(event, this)" /></td>
		</tr>
		<tr class="pubDt50">
			<th>结束时间</th><td>
				<input type="text" name="endtime" id="endtime" class="inputText" value="{$actawardsShow['endtime']}" onclick="showcalendar(event, this)" /></td>
		</tr>		
		<tr class="pubDt50">
			<th>公布时间</th><td>
				<input type="text" name="publictime" id="publictime" class="inputText" value="{$actawardsShow['publictime']}" onclick="showcalendar(event, this)" /></td>
		</tr>
		<tr class="pubDt50">
			<th>&nbsp;</th>
			<td>
				<input type="hidden" name="actsubmit" value="true" />
				<input type="hidden" name="formhash" id="formhash" value="{$formhash}" />
				<input type="submit" value=" " class="publish182x43_1" />
			</td>
		</tr>
	</table>
</div>
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://static.8264.com/static/js/jquery-ui-1.9.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/jquery-ui/jquery-ui-1.8.17.custom.css" />
<script>
            $(function () {
                $("#starttime").datepicker({dateFormat: "yy-mm-dd"});
            });
            $(function () {
                $("#endtime").datepicker({dateFormat: "yy-mm-dd"});
            });
			$(function () {
                $("#publictime").datepicker({dateFormat: "yy-mm-dd"});
            });
        </script>
<script type="text/javascript" src="static/js/newswfobject.js"></script>
<script type="text/javascript">
	var params = {site:"{$_G[siteroot]}misc.php%3fmod=swfupload%26type=image%26fid=0%26mtype=plugin%26twidth=60%26theight=60%26back=uploadsuccess_back%26random={$random}",buttonimg:"{$_G[siteroot]}static/image/common/uploadnew.png"};
	swfobject.embedSWF("static/flash/uploadforum.swf", "pic_upload_multiimg", "208", "50", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});
	swfobject.createCSS("#pic_upload_multiimg", "text-align:left;");
</script>
<script>
var maxpic = 4;
function uploadsuccess_back(type, returndata) {
	eval("var nattach = " + returndata + ";");
	jQuery.noConflict();
	;(function(jQuery){
		switch(type){
			case 1:
			case 2:
				var html = '';
				html 	+= '<span id="imagelist_id_'+nattach.aid+'">';
				html 	+= '<img src="' + nattach.thumbpic + '" />';
				html 	+= '<b class="deleteimg">删除</b>';
				html 	+= '<input type="hidden" value="'+nattach.aid+'" name="imgselect[]">';
				html 	+= '</span>';

				jQuery("#imglist").append(html);
				var attachobj = jQuery('#imagelist_id_' + nattach.aid);
				attachobj.find('input').removeAttr('disabled').end().show();

				attachobj.find('img').one('error', function(){
					jQuery(this).attr('src', ' ');
					jQuery(this).attr('src', nattach.thumbpic);
				}).show();
				break;
			case 3:
				break;
		}
		jQuery('#imglist').find('span:gt(' + (maxpic - 1) + ')').addClass("overlimit").find('input').attr('disabled', true);
		//算下上传图片数
		jQuery("#numimage").attr("value", jQuery('#imglist').find("span:not('.overlimit')").length);
	})(jQuery);
}
jQuery(function(){
	jQuery(document).on("click", "#imglist .deleteimg", function() {
		jQuery(this).parent().remove();
		if(jQuery("#imglist .overlimit").length > 0){
			jQuery("#imglist .overlimit:first").removeClass('overlimit').find('input:hidden').removeAttr('disabled');
		}else{
			jQuery("#numimage").val(jQuery("#numimage").val() - 1);
		}
	});
});
</script>
ZBLUNBO;
showformfooter();
	}
		
}
?>
