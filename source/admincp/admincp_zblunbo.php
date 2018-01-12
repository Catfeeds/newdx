<?php

/**
 *      装备首页轮播
 *      by shuaiquan
 */

if(!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
$operation = in_array($operation, array('add', 'edit')) ? $operation : 'list';
cpheader();
showsubmenu('装备首页轮播',  array(
	array('列表', "zblunbo&operation=list", $operation == 'list'),
	array('发布', "zblunbo&operation=add", $operation == 'add' || $operation == 'edit')
));

if($operation == 'list') {
	
	if(submitcheck('zblunbosubmit')) {

		$perpage = intval($_G['gp_hiddenperpage']);
		$page    = intval($_G['gp_hiddenpage']);

		$aids = !empty($_G['gp_ids']) && is_array($_G['gp_ids']) ? implode(',', $_G['gp_ids']) : "";		
		$url  = "action=zblunbo&operation=list&&perpage={$perpage}&page={$page}";
		
		if ($_G['gp_optype'] == 'trash' && $aids) {	
			$attachids = array();
			$sql = "SELECT attachid FROM ".DB::table('portal_article_zblunbo')." where aid in ({$aids}) " . getSlaveID();
			$query = DB::query($sql);
			while ($v = DB::fetch($query)) {
				$attachids[$v['attachid']] = $v['attachid'];
			}
			DB::delete('portal_article_zblunbo', "aid in ({$aids})");
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

		$mpurl   = ADMINSCRIPT.'?action=zblunbo&operation='.$operation;
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$perpage = empty($_G['gp_perpage']) ? 0 : intval($_G['gp_perpage']);
		$page    = max($_G['gp_page'], 1);
		if(!in_array($perpage, array(10,20,50,100))) $perpage = 50;
		
		$start  = ($page-1) * $perpage;
		$mpurl .= '&perpage='.$perpage;		
		
		showformheader('zblunbo&operation=list');
		showtableheader('装备首页轮播');
		showsubtitle(array('', '文章标题', '图片', '链接', '顺序', '发布时间', '操作'));

		$multipage = '';
		$count = DB::result_first("SELECT COUNT(*) as count FROM ".DB::table('portal_article_zblunbo')." " . getSlaveID());
		if($count) {
			$sql = "SELECT z.*,t.title FROM ".DB::table('portal_article_zblunbo')." z LEFT JOIN ".DB::table('portal_article_title')." t ON z.aid=t.aid order by z.`order` desc,z.dateline desc LIMIT {$start},{$perpage} " . getSlaveID();
			$query = DB::query($sql);
			while ($value = DB::fetch($query)) {
				$value['pic'] = $value['pic'] ? getimagethumb(60,60,2,'plugin/'.$value['pic'], 0, 99) : '';
				showtablerow('', array('class="td25"', 'width="480"', 'class="td28"'), array(
						"<input type=\"checkbox\" class=\"checkbox\" name=\"ids[]\" value=\"$value[aid]\">",
						"<a href=\"portal.php?mod=view&aid=$value[aid]\" target=\"_blank\">$value[title]</a>",
						$value['pic'] ? "<img src=\"{$value['pic']}\" />" : '',				
						"http://www.8264.com/viewnews-{$value[aid]}-page-1.html",
						$value['order'],
						date("Y-m-d H:i:s", $value['dateline']),
						"<a href=\"admin.php?&action=zblunbo&operation=edit&aid=$value[aid]\">修改</a>"
					));
			}
			$multipage = multi($count, $perpage, $page, $mpurl);
		}

		$optypehtml = ''
			.'<input type="hidden" name="hiddenpage" id="hiddenpage" value="'.$page.'"/><input type="hidden" name="hiddenperpage" id="hiddenperpage" value="'.$perpage.'"/><input type="radio" name="optype" id="optype_trash" value="trash" class="radio" /><label for="optype_trash">彻底删除</label>&nbsp;&nbsp;';
		showsubmit('', '', '', '<input type="checkbox" name="chkall" id="chkall" class="checkbox" onclick="checkAll(\'prefix\', this.form, \'ids\')" /><label for="chkall">'.cplang('select_all').'</label>&nbsp;&nbsp;'.$optypehtml.'<input type="submit" class="btn" name="zblunbosubmit" value="'.cplang('submit').'" />', $multipage);
		showtablefooter();
		showformfooter();
	}
} elseif($operation == 'add' || $operation == 'edit') {
	
	if(submitcheck('zblunbosubmit')) {
		$aid 		= !empty($_G['gp_aid']) ? intval($_G['gp_aid']) : 0;
		$attachid   = !empty($_G['gp_imgselect'][0]) ? intval($_G['gp_imgselect'][0]) : 0;
		if ($aid && $attachid) {
			
			$zblunboShow = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_zblunbo')." where aid={$aid}" . getSlaveID());
			
			$data = array();
			$data['order'] 		= !empty($_G['gp_order']) ? intval($_G['gp_order']) : 0;
			$data['dateline'] 	= $_G['timestamp'];			
			if ($zblunboShow) {						
				if ($zblunboShow['attachid'] !=  $attachid) {
					$data['pic']        = DB::result_first("select attachment from ".DB::table('forum_attachment')." where aid={$attachid} " . getSlaveID());
					$data['attachid'] 	= $attachid;
					DB::delete('forum_attachment', "aid in ({$zblunboShow['attachid']})");
				}
				DB::update('portal_article_zblunbo', $data, "aid={$aid}");
			} else {								
				$data['pic']        = DB::result_first("select attachment from ".DB::table('forum_attachment')." where aid={$attachid} " . getSlaveID());
				$data['attachid'] 	= $attachid;				
				
				$data['aid'] = $aid;
				DB::insert('portal_article_zblunbo', $data);
			}				
			cpmsg('发布成功', 'action=zblunbo&operation=list', 'succeed');	
		}			
	} else {
		$adminscript = ADMINSCRIPT;
		$random      = random(4);
		$formhash    = FORMHASH;
		$aid 		 = !empty($_G['gp_aid']) ? intval($_G['gp_aid']) : 0;
		$zblunboShow = array();
		$picstr		 = '';
		$picnum  	 = 0;
		if ($aid) {
			$zblunboShow = DB::fetch_first("SELECT * FROM ".DB::table('portal_article_zblunbo')." where aid={$aid}" . getSlaveID());			
		}
		if ($zblunboShow['pic']) {			
			$zblunboShow['pic'] = getimagethumb(60,60,2,'plugin/'.$zblunboShow['pic'], 0, 99);
			$picstr .= '<span id="imagelist_id_'.$zblunboShow['attachid'].'">';
			$picstr .= '<img src="'.$zblunboShow['pic'].'" />';
			$picstr .= '<b class="deleteimg">删除</b>';
			$picstr .= '<input type="hidden" value="'.$zblunboShow['attachid'].'" name="imgselect[]">';
			$picstr .= '</span>';
			$picnum  = 1;
		}		
		
		showformheader("zblunbo&operation={$operation}");		
		echo <<<ZBLUNBO
<link rel="stylesheet" type="text/css" href="http://static.8264.com/static/css/dianping/equipmentstyle.css?admin" />
<style>
.pubDt50 th {vertical-align:middle;width:100px;text-align:center;}
#imglist .overlimit {display:none;}
</style>		
<script src="http://static.8264.com/static/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<div style="margin-top:8px;">
	<table cellspacing="3" cellpadding="3">
		<tr class="pubDt50">
			<th>文章ID</th><td><input type="text" name="aid" class="inputText" value="{$zblunboShow['aid']}"/></td>
		</tr>
		<tr class="pubDt50">
			<th>顺序</th><td><input type="text" name="order" class="inputText" value="{$zblunboShow['order']}"/></td>
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
				<input type="hidden" name="zblunbosubmit" value="true" />
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
		
}
?>
