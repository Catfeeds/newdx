<?php
/**
 *  在外App推荐帖子输出接口
 *  输出该帖子发帖人在本帖中的全部内容，包括主帖+回帖
 */

// define('APPTYPEID', 10);
// define('CURSCRIPT', 'threadsync');
set_time_limit(0);
require '../source/class/class_core.php';
require '../source/function/function_core.php';

$discuz = & discuz_core::instance();

$discuz->init();

$tid = intval($_G['gp_tid']);
if(!$tid) exit('{"msg":{"code":422, "info":"Param error."}}');

require '../source/function/function_discuzcode.php';
require '../source/function/function_post.php';

$travelShow = DB::fetch_first("SELECT * FROM ".DB::table('forum_travelread')." where tid = {$tid} " . getSlaveID());
if(empty($travelShow)) exit('{"msg":{"code":422, "info":"travel is null."}}');

//文章
$message = '';
$travelShow['apids'] = $travelShow['apids'] ? explode(',', $travelShow['apids']) : array();
$arrPids = array_chunk($travelShow['apids'], 100);
foreach ($arrPids as $val) {
	$pids = $val ? implode(',', $val) : '';
	if($pids) {
		$queryP   = "SELECT message, pid, first, tid, author, authorid, subject, dateline FROM ".DB::table('forum_post')." WHERE pid in ({$pids}) order by pid asc " . getSlaveID();
		$queryP = DB::query($queryP);
		while ($v = DB::fetch($queryP)) {
			$message = $v['message'];
			$message = discuzcode($message);

			$message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//引用
			$message = preg_replace('/<media[^>]*>.*<\/media>/isU', '', $message);//[/media]
			$message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//处理掉不显示的font标签
			$message = preg_replace('/下载地址回复可见.*<\/p>/isU', '</p>', $message);

			$message = strip_tags($message, "<a><p><img><table><tbody><tr><th><td><span><script><br>");

			$message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n个连续<br/>
			$message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
			$message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
			$message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>

			$message = str_replace('target="_blank"', "", $message);
			$message = str_replace('&nbsp;', "", $message);
			$message = preg_replace('/本帖最后由.*编辑/isU', '', $message);//本帖最后由...编辑

			$message = dealTextPic($message);

			preg_match_all('/\[attach\](\d+)\[\/attach\]/isU', $message, $matA);

			$sql   = "SELECT aid, attachment, dir  FROM ".DB::table('forum_attachment')." WHERE pid = {$v['pid']} LIMIT 3 " . getSlaveID();
			$query = DB::query($sql);
			while ($v1 = DB::fetch($query)) {
				$imgsrc 		 = "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v1['dir']}/{$v1['attachment']}!wap";
				$pics[$v1['aid']] = "<img src=\"{$imgsrc}\"/>";
			}
			foreach ($matA[1] as $k=>$v1) {
				if (isset($pics[$v1])) {
					$message = str_replace("[attach]{$v1}[/attach]", $pics[$v1], $message);
				} else {
					$message = str_replace("[attach]{$v1}[/attach]", '', $message);
				}
				unset($pics[$v1]);
			}
			foreach ($pics as $v1) {
				$message .= $v1;
			}

			$message = preg_replace('/(<img.*>)\s*<br[^>]*\/?>/isU', '\1', $message);//<img><br/>

			$data[$v['pid']]['pid']      = $v['pid'];
			$data[$v['pid']]['tid']      = $v['tid'];
			$data[$v['pid']]['first']      = $v['first'];
			$data[$v['pid']]['author']   = $travelShow['author'];
			$data[$v['pid']]['authorid'] = $travelShow['authorid'];
			$data[$v['pid']]['subject']  = $v['first'] == 1 ? $travelShow['subject'] : '';
			$data[$v['pid']]['dateline'] = $v['dateline'];

			$data[$v['pid']]['message'] = $message;

		}
	}
}

//对文本中的图片进行降质处理
function dealTextPic($content) {
	/*此处使用正则直接替换，不使用循环多次正则替换，提升效率*/
	$content = preg_replace("/<img.*src=[\"|'](.[^>]*)[\"|'].*>/iseU", "_replace_image('\\1')", $content);
	return $content;
}

function _replace_image($imgsrc){
	global $_G;

	/*过滤图片地址后面的后缀#*/
	if(($pos = stripos($imgsrc, "#")) !== false){
		$imgsrc = substr($imgsrc, 0, $pos);
	}
	$imgsrc 	= str_replace($_G['config']['web']['attach'], "", $imgsrc);

	if (preg_match("#http://.*\.(com|cn|org|net).*#is", $imgsrc) && !preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)) {
	} elseif (strrpos($imgsrc, "static/") === false) {
		if (strrpos($imgsrc, "file:") !== false) {return false;}

		$imgsrc = str_replace('image.', 'image1.', $imgsrc);
		if(!preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)){
			$imgsrc = 'http://'.$_G['config']['cdn']['images']['cdnurl'].'/'.$imgsrc;
		}
		if(($pos2 = strrpos($imgsrc, '!')) !== false){
			$imgsrc = substr($imgsrc, 0, $pos2);
		}
		$imgsrc .= '!wap';
	} else {
		$imgsrc     = $_G["config"]['web']['portal'].$imgsrc;
	}

	//延时加载
	return "<img src=\"{$imgsrc}\"/>";
}

$rdata = array();
$rdata['msg'] = array("code" => 200, "info" => "Return data success.");
$rdata['data'] = iconv_array($data);
if(empty($rdata['data'])) { $rdata['msg'] = array("code" => 421, "info" => "Return data empty."); }
if($_GET['debug'] == 1) { echo '<pre>'; print_r($rdata); exit;}
echo json_encode($rdata);
