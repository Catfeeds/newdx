<?php

/**
 * �񵥹��� ��Ҫ������seo
 * @author gtl 20160301
 */
if (!defined('IN_DISCUZ') || !defined('IN_DISCUZ')) {
	exit('Access Denied');
}
set_time_limit(0);
require DISCUZ_ROOT . './config/config_dianping.php';
include_once libfile('function/home');
include_once libfile('function/cloud');
include_once libfile('function/dianping');
$cateid = 910;
$puid = '40344277'; //�����û�����Ϊ�񵥷�����
$puname = '8264����С��'; //�����û�����Ϊ�񵥷�����
$ranklist_style = "<style>
	.dptitle{display: block; height: 36px; overflow: hidden; padding: 4px 106px 0px 0px; position: relative ;}
	.dptitle i{ font-size:20px; color:#f98361; font-style:normal;}
	.dptitle a{ color:#1e6d9b; font-size:100%; padding:0px 16px; vertical-align:2px}
	.dptitle a.moredp{ padding: 0; position: absolute; right: 0; top: 6px; }
	.dptitle em{color: #585858; font-size: 14px; position: absolute; right: 63px; top: 8px;}
	.newscon p.dpcon{ border-bottom:#eeeeee solid 1px; padding:10px 0px 22px 0px; background:url(http://static.8264.com/static/images/portal/dpicon.jpg) 0 23px no-repeat; text-indent:15px; margin-bottom:6px;}
	.newscon p .namemorelink{ color:#1e6d9b}

	.newscon p .morelink{background: url('http://static.8264.com/static/images/portal/topic-mask.png') no-repeat left top;    bottom: 3px;    color: #1e6d9b;    height: 20px;    position: absolute;    right: 0;
		width: 100px;}

	.newscon p.dpcon span{ display:block; overflow:hidden; position:relative;}
</style>
<script>
jQuery(function (){
	jQuery(\"p.dpcon span\").each(function(i){
		var dph = jQuery(this).height();
		var url = jQuery(this).parent().prev('span').find('a').attr('href');
		if (dph>86){
			jQuery(this).height(86).append(\"<em class='morelink'></em>\");
		}
	});
});
</script>";
$ranklist_style ="";
//$ranklist_html = '<span class="dptitle"><i>NO.%u</i><a href="%s" target="_blank">%s</a><em>%s��</em><a href="%s" class="moredp" target="_blank">����>></a></span><p class="dpcon"><span>%s</span></p>';
$ranklist_html = '<p class="bangdanbox"><b><i>NO.%u</i>%s</b>�÷֣�%s&nbsp;&nbsp;<a target="_blank" href="%s">����&gt;&gt;</a><span>%s</span></p>';
$source_html = '<p style="text-align:right">������Դ�� <a href="%s" style="color:#1e6d9b;">8264����ϵͳ</a></p>';
$mod2url = array(
	'brand' => 'http://www.8264.com/pinpai',
	'equipment' => 'http://www.8264.com/zhuangbei.html',
	'shop' => 'http://www.8264.com/dianpu',
	'climb' => 'http://www.8264.com/panpa/',
	'skiing' => 'http://www.8264.com/xuechang',
	'diving' => 'http://www.8264.com/qianshui/',
	'mountain' => 'http://www.8264.com/shanfeng',
	'line' => 'http://www.8264.com/xianlu',
	'fishing' => 'http://www.8264.com/diaoyu/',
	'club' => 'http://www.8264.com/julebu/',
	'hostel' => 'http://www.8264.com/kezhan/'
);
$rand_start = array(
	'<p>8264�񵥹���Ϊ���ṩ2016���»��������а���û�������ȫ��8264�������а�㼯��������רҵ�Ļ���Ȧ��ҵ�ߺ��û���Ϊ���ṩ��רҵ��дʵ�ĵ�����Ϣ���滧�����8264��</p>',
	'<p>�����а�����8264С�ྫ��ժ¼�����û��ṩ��רҵ�������а���Ȩ����չʾ�˻����ĸ��������Ϣ���������а���Ը����㡢��ֱ�۵İ����û��ҵ��Լ���Ҫ����Ϣ��</p>',
	'<p>��Ϊ������ҵ��ҵ��á�������ߵ�רҵ�Ż���վ��8264Ϊ���ṩ���û��ṩ��С�ྫѡ����רҵ������������а�ϵͳ����������ϸ�˽⻧����ҵ���ҵ�������Ҫ�����ݡ�</p>'
);
$rand_end = array(
	'<p>�����Ǳ��ĵ��������ݣ���֪�Ƿ��������������󣬻�ӭ��������ע8264��</p>',
	'<p>���ˣ��񵥵����ݾ͵���������ϲ�����ǵ����ݣ���Ϊ���ǵ�С���������������ޣ�лл��</p>',
	'<p>�����ݵ��˽�������л���������Ķ���ϣ�����������ջ�</p>'
);

//ajax ����Ҫҳ��չʾ ��ʼ���б�
if ($operation == 'initlist') {
	$ids = trim($_POST['ids']);
	$ids = str_replace('��', ',', $ids);
	$ids = explode(',', $ids);
	foreach ($ids as $key => $id) {
		$ids[$key] = (int) trim($id);
		if ($ids[$key] < 1) {
			unset($ids[$key]);
		}
	}
	$ids = array_unique($ids);
	if (empty($ids)) {
		echo json_encode(array(
			'status' => 0,
			'data' => '',
			'msg' => diconv("��Ч��id", "GBK", "UTF-8")
		));
		exit();
	}

	//��������
	foreach ($ids as $k => $id) {
		$tmp[$id] = array();
	}
	$ids = implode(',', $ids);
	$query = DB::query('SELECT tid,subject FROM ' . DB::table('forum_thread') . ' where tid in (' . $ids . ')');
	while ($row = DB::fetch($query)) {
		$tmp[$row['tid']] = array(
			'tid' => $row['tid'],
			'title' => diconv($row['subject'], "GBK", "UTF-8")
		);
	}
	//��ʽת�� ��������
	foreach ($tmp as $k => $info) {
		!empty($info) && $threads[] = $info;
	}
	if(empty($threads)){
		echo json_encode(array(
			'status' => 0,
			'data' => '',
			'msg' => diconv("��Ч��id", "GBK", "UTF-8")
		));
		exit();
	}

	echo json_encode($threads);
	exit();
}

//ҳ��չʾ
cpheader();
shownav('topic', '�񵥹���');
showsubmenu('�񵥹���', array(
	array('����°�', 'bangdan', !$operation), //���������������Ƿ��ǵ�ǰ�˵�
	array('������Ӱ�', 'bangdan&operation=batadd', $operation == 'batadd'), //���������������Ƿ��ǵ�ǰ�˵�
	array('���б�', "portal-portalcp-ac-category-catid-{$cateid}.html", false, 1, 1),
));
//���ݴ���
if (!$operation) {
	if (submitcheck('addsubmit')) { //�����ύ
		$id = 0;
		$idtype = '';
		$article_status = 0; //Ĭ��Ϊ���� ���ܻ���������仯������
		$allowcomment = 0; //Ĭ�ϲ���������
		$content = getstr($_POST['content'], 0, 1, 1, 0, 1);
		$summary = portalcp_get_summary(stripslashes($_POST['content']));
		$setarr = array(
			'title' => $_POST['title'], //����
			'shorttitle' => '', //�̱��� Ϊ��
			'author' => '', //����ԭ���� Ϊ��
			'from' => '', //������Դ Ϊ��
			'fromurl' => '', //��Դ��ַ Ϊ��
			'dateline' => TIMESTAMP, //����ʱ�� TIMESTAMP
			'url' => '', //��תURL Ϊ��
			'allowcomment' => $allowcomment, //Ĭ����������
			'summary' => $summary, //ժҪ�������н�ȡ addslashes��
			'prename' => '', //ʲô��
			'preurl' => NULL, //ʲô��
			'catid' => $cateid, //��id
			'tag' => 0, //��
			'status' => $article_status, //���������� �����ж��� �������״̬
			'lastuid' => $puid, //�������ֵ� $_G['uid']
			'lastname' => $puname, //�������ֵ� $_G['username']
			'ip' => $_G['clientip'], //������ip $_G['clientip']
			'lasttime' => TIMESTAMP, //�������ֵ� TIMESTAMP
			'uid' => $puid, //�����ֵ�
			'username' => $puname, //�����ֵ�
			'id' => 0, //Ϊ0 ��һ�����������������ݵĹ���
			'pubtime' => TIMESTAMP,
		);

		//todo
		//��ȡ��fid
		//��ȡ��������Ϣ
		//ƴ��html
		//���ӵ��������
		foreach ($dp_modules as $mod => $modinfo) {
			$tables[$modinfo['fid']] = array(
				'mod' => $mod,
				'tablename' => "dianping_{$mod}_info",
			);
		}
		$initlist = $_POST['initlist'];
		foreach ($initlist as $k => $thread) {
			//����
			$query = DB::query("SELECT ff.fid,ff.name,ff.fup FROM " . DB::table('forum_thread') . " as ft LEFT JOIN " . DB::table('forum_forum') . " as ff ON ft.fid=ff.fid where ft.tid = " . $thread['tid']);
			$row = DB::fetch($query);
			$tablename = $tables[$row['fid']]['tablename'];
			while ($row['fup'] > 0 && !$tablename) {
				$query = DB::query("SELECT fid,fup FROM " . DB::table('forum_forum') . " where fid = " . $row['fup']);
				$row = DB::fetch($query);
				$tablename = $tables[$row['fid']]['tablename'];
			}
			if ($tablename) {
				$query = DB::query("SELECT i.tid, i.subject, i.showimg, i.dir, i.serverid, i.score, i.cnum FROM " . DB::table($tablename) . " AS i WHERE i.ispublish=1 and tid=" . $thread['tid']);
				$initlist[$k]['info'] = DB::fetch($query); //����
			}

			//����ģ��
			$initlist[$k]['mod'] = $tables[$row['fid']]['mod'];
			//����
			$initlist[$k]['comment'] = trim($thread['comment']);
			if (empty($initlist[$k]['comment'])) {
				$query = DB::query("SELECT s.starnum,s.uid, s.goodpoint, s.weakpoint, s.extdata, s.ext1, s.ext2, s.ext3, s.ext4, s.ext5, s.supports, p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, p.rate, p.attachment, t.subject
					FROM " . DB::table("dianping_star_logs") . " AS s
					LEFT JOIN " . DB::table("forum_post") . " AS p ON s.pid=p.pid
					LEFT JOIN " . DB::table("forum_thread") . " AS t ON t.tid=p.tid
					WHERE p.first=0 AND p.tid = '{$thread['tid']}' AND p.rate>0
					ORDER BY p.dateline DESC
					LIMIT 1 " . getSlaveID());
				$row = DB::fetch($query);
				if(empty($row)){
					$query = DB::query("SELECT s.starnum,s.uid, s.goodpoint, s.weakpoint, s.extdata, s.ext1, s.ext2, s.ext3, s.ext4, s.ext5, s.supports, p.pid, p.tid, p.author, p.authorid, p.dateline, p.message, p.rate, p.attachment, t.subject
						FROM " . DB::table("dianping_star_logs") . " AS s
						LEFT JOIN " . DB::table("forum_post") . " AS p ON s.pid=p.pid
						LEFT JOIN " . DB::table("forum_thread") . " AS t ON t.tid=p.tid
						WHERE p.first=0 AND p.tid = '{$thread['tid']}' AND p.rate = 0
						ORDER BY p.dateline DESC
						LIMIT 1 " . getSlaveID());
					$row = DB::fetch($query);
				}
				if (!empty($row)) {
					$initlist[$k]['new_comment'] = "������<a href='home.php?mod=space&uid={$row['authorid']}' class='namemorelink'>@{$row['author']}</a>����" . $row['message'];
				}
			}
		}
		$rank_list = $ranklist_style;
		foreach ($initlist as $key => $item) { //��ϳ�html
			$mod = $item['mod'];
			$num = $key+1;
			$rank_list.= sprintf($ranklist_html, $num, $item['subject'], (string)$item['score'], dp_rewrite("http://www.8264.com/dianping.php?mod={$mod}&act=showview&tid={$item['tid']}"), ($item['comment'] ? "�Ƽ����ɣ�{$item['comment']}" : ($item['new_comment'] ? "���µ���{$item['new_comment']}" : '')));
		}
		$content.=addslashes(get_rand($rand_start).$rank_list.get_rand($rand_end).sprintf($source_html, 'http://www.8264.com/zhuangbei.html'));

		//�������
		$aid = DB::insert('portal_article_title', $setarr, 1); #�����
		//ͳ������
		DB::update('common_member_status', array('lastpost' => TIMESTAMP), array('uid' => $puid));
		DB::query('UPDATE ' . DB::table('portal_category') . " SET articles=articles+1 WHERE catid = '{$setarr['catid']}'");
		DB::insert('portal_article_count', array('aid' => $aid, 'catid' => $setarr['catid'], 'dateline' => $setarr['dateline'], 'viewnum' => 1));

		//�������
		$pageorder = DB::result(DB::query("SELECT MAX(pageorder) FROM " . DB::table('portal_article_content') . " WHERE aid='$aid'"), 0);
		$pageorder = $pageorder + 1;
		#����ֻ����һҳ
		DB::query("INSERT INTO " . DB::table('portal_article_content') . "
			(aid, content, pageorder, dateline, id, idtype)
			VALUES ('$aid', '{$content}', '{$pageorder}', '{$setarr['pubtime']}', '$id', '$idtype')");

		$url = preg_replace('/\/admin\.php\?/i', '', $url);
		cpmsg('�����ɹ���', $url, 'succeed');
	}
	//�����
	echo <<<EOT
	<script src="static/js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript">jQuery.noConflict();</script>
	<script src="static/image/editor/editor_function.js"></script>
	<script>
	function validate(obj) {
		edit_save();
		window.onbeforeunload = null;
		//����
		var title = jsTrim(jQuery("input[name=title]").val());
		jQuery("input[name=title]").val(title);
		if(title == ''){
			alert('���ⲻ��Ϊ�գ�');
			return false;
		}
		//���а��б�
		var initlisttb = jQuery("#initlisttb:visible").length;
		if(initlisttb<1){
			alert('��δ�������а��б�');
			return false;
		}
		return true;
	}
	//ȥ�����пո�
	function jsTrimAll(str) {
		return str.replace(/\s+/g, '');
	}
	//ȥ�����˿ո�
	function jsTrim(str) {
		return str.replace(/^\s+|\s+$/g, '');
	}
	function setlist(){
		var ids = jsTrimAll(jQuery("input[name=ids]").val());
		jQuery("input[name=ids]").val(ids);
		if(ids == ''){
			return false;
		}
		jQuery.ajax({
			type : 'POST',
			url : '/admin.php?action=bangdan&operation=initlist',
			data : {ids:ids},
			success:function(html){
				html = eval("("+html+")");
				if(html.data == 0){
					alert(html.msg);
					return false;
				}
				var inithtml = '<table width=550>';
				for(i in html){
					num = Number(i)+1;
					inithtml+="<tr><td>��"+num+"��</td><td>"+html[i].title+"</td></tr>";
					inithtml+="<tr><td>tid</td><td><input type='text' name='initlist["+i+"][tid]' value='"+html[i].tid+"'></td></tr>";
					inithtml+="<tr><td>�Ƽ�����</td><td><textarea name='initlist["+i+"][comment]' style='width:476px;'></textarea></td></tr>";
				}
				inithtml+= '</table>';
				jQuery("#initlisttb").html("<td>"+inithtml+"</td>");
				jQuery("#initlisttb").show();
			}
		});
	}
	</script>
EOT;
	showformheader('bangdan', 'onsubmit="return validate(this);"', 'bdforum');
	showtableheader();
	showsetting('�񵥱���', 'title', '', 'text', '', '', '', 'style="width:547px;"'); #�񵥱���
	showtablerow('', array('class="td27" colspan="2"'), array('�񵥵��<textarea class="userData" name="content" id="uchome-ttHtmlEditor" style="height: 100%; width: 100%; display: none; border: 0px"></textarea>'));
	showtablerow('', array('class="td25" colspan="2"'), array(" <iframe src='home.php?mod=editor&charset={CHARSET}&allowhtml=1&isportal=0' name='uchome-ifrHtmlEditor' id='uchome-ifrHtmlEditor'  scrolling='no' style='width:550px;height:200px;border:1px solid #C5C5C5;position:relative;' border=0 frameborder=0 ></iframe>"));
	showtablerow('', array('class="td27" colspan="2"'), array('����ID��'));
	showtablerow('', array('class="td27" colspan="2"'), array('<input type="text" class="txt" name="ids" style="width:486px;"><a href="javascript:void(0);" onclick="setlist()">�����б�</a>'));
	showtablerow('style="display:none;" id="initlisttb"', array('colspan="2" style="padding: 0px;"'), '');
	showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
	showtablefooter();
	showformfooter();
} elseif ($operation == 'batadd') {
	if (submitcheck('addsubmit')) {
		$redirect = 'action=bangdan&operation=batadd';
		if(empty($_POST['urls'])){
			cpmsg('���������⣡', $redirect, 'error');
		}

		//���ݸ�ʽ��
		$urls = explode("\r\n", $_POST['urls']);
		$urls = array_unique($urls);
		foreach ($urls as $key => $url) {
			$urls[$key] = trim($url);
			if(empty($urls[$key])){
				unset($urls[$key]);
			}
		}
		if(empty($urls)){
			cpmsg('���������⣡', $redirect, 'error');
		}

		//ѭ������http����
		foreach ($urls as $key => $url) {
			//��ȡ���а����ݡ���ʽ������
			$jsondata = file_get_contents($url.'?ajaxfrom=admin');
			$initlist = json_decode($jsondata, true);
			if(empty($initlist['data'])){
				continue;
			}
			//��ÿƪ���а����ݸ�ʽ��
			$initlist['title'] = diconv($initlist['title'], "UTF-8", "GBK");
			foreach($initlist['data'] as $k=>$item){
				foreach($item as $k2=>$v){
					$initlist['data'][$k][$k2] = diconv($v, "UTF-8", "GBK");
				}
			}
			//���������е����а񲿷�
			$rank_list = $ranklist_style;
			$mod = $initlist['mod'];
			foreach ($initlist['data'] as $key => $item) { //��ϳ�html
				$num = $key+1;
				$rank_list.= sprintf($ranklist_html, $num, $item['subject'], (string)$item['score'], dp_rewrite("http://www.8264.com/dianping.php?mod={$mod}&act=showview&tid={$item['tid']}"), ($item['comment'] ? "�Ƽ����ɣ�{$item['comment']}" : ($item['new_comment'] ? "���µ���{$item['new_comment']}" : '')));
			}
			$content = addslashes(get_rand($rand_start).$rank_list.get_rand($rand_end).sprintf($source_html, $mod2url[$mod]?$mod2url[$mod]:'http://www.8264.com/zhuangbei.html')); //���а� ����������
			$id = 0;
			$idtype = '';
			$article_status = 0; //Ĭ��Ϊ���� ���ܻ���������仯������
			$allowcomment = 0; //Ĭ�ϲ���������
			$summary = portalcp_get_summary(stripslashes($initlist['title']));
			$setarr = array(
				'title' => $initlist['title'], //����
				'shorttitle' => '', //�̱��� Ϊ��
				'author' => '', //����ԭ���� Ϊ��
				'from' => '', //������Դ Ϊ��
				'fromurl' => '', //��Դ��ַ Ϊ��
				'dateline' => TIMESTAMP, //����ʱ�� TIMESTAMP
				'url' => '', //��תURL Ϊ��
				'allowcomment' => $allowcomment, //Ĭ����������
				'summary' => $summary, //ժҪ�������н�ȡ addslashes��
				'prename' => '', //ʲô��
				'preurl' => NULL, //ʲô��
				'catid' => $cateid, //��id
				'tag' => 0, //��
				'status' => $article_status, //���������� �����ж��� �������״̬
				'lastuid' => $puid, //�������ֵ� $_G['uid']
				'lastname' => $puname, //�������ֵ� $_G['username']
				'ip' => $_G['clientip'], //������ip $_G['clientip']
				'lasttime' => TIMESTAMP, //�������ֵ� TIMESTAMP
				'uid' => $puid, //�����ֵ�
				'username' => $puname, //�����ֵ�
				'id' => 0, //Ϊ0 ��һ�����������������ݵĹ���
				'pubtime' => TIMESTAMP,
			);

			//�������
			$aid = DB::insert('portal_article_title', $setarr, 1); #�����

			//ͳ������
			DB::update('common_member_status', array('lastpost' => TIMESTAMP), array('uid' => $puid));
			DB::query('UPDATE ' . DB::table('portal_category') . " SET articles=articles+1 WHERE catid = '{$setarr['catid']}'");
			DB::insert('portal_article_count', array('aid' => $aid, 'catid' => $setarr['catid'], 'dateline' => $setarr['dateline'], 'viewnum' => 1));

			//�������
			$pageorder = DB::result(DB::query("SELECT MAX(pageorder) FROM " . DB::table('portal_article_content') . " WHERE aid='$aid'"), 0);
			$pageorder = $pageorder + 1;
			#����ֻ����һҳ
			DB::query("INSERT INTO " . DB::table('portal_article_content') . "
				(aid, content, pageorder, dateline, id, idtype)
				VALUES ('$aid', '{$content}', '{$pageorder}', '{$setarr['pubtime']}', '$id', '$idtype')");
		}
		cpmsg('�����ɹ���', $redirect, 'succeed');
	}
	showformheader('bangdan&operation=batadd', '', 'bataddforum');
	showtableheader();
	showtablerow('', array('class="td27" colspan="2"'), array('����Դ���ӣ�ÿ�������Ի��зָ��֧�ֵ����µĸ��������б�ҳ'));
	showtablerow('', array('class="td27" colspan="2"'), array('<textarea class="userData" name="urls" style="width: 550px;height: 300px;"></textarea>'));
	showtablerow('', array('class="td25" colspan="2"'), array("<input id='submit_addsubmit' class='btn' type='submit' value='�ύ'  name='addsubmit'>"));
	showtablefooter();
	showformfooter();
}

function portalcp_get_summary($message) {
	$message = preg_replace(array("/\[attach\].*?\[\/attach\]/", "/\&[a-z]+\;/i", "/\<script.*?\<\/script\>/"), '', $message);
	$message = preg_replace("/\[.*?\]/", '', $message);
	$message = getstr(strip_tags($message), 200);
	return $message;
}

function get_rand($rsource){
	$max = count($rsource)-1;
	$index = rand(0,$max);
	return $rsource[$index];
}
