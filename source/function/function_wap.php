<?php

/**
 * @author LiShuaiquan
 * @copyright 2014
 */
if(! defined('IN_DISCUZ')){
	exit('Access Denied');
}


//接口输出，格式化数据
function encodeData($data) {
	$data = strrpos($data, '<') === false ? $data : strip_tags($data);
	echo json_encode(iconv_array($data));
	exit();
}

//对文本中的图片进行降质处理
function dealTextPic($content) {
	/*此处使用正则直接替换，不使用循环多次正则替换，提升效率*/
	$content = preg_replace("/<img.*src=[\"|'](.[^>]*)[\"|'].*>/iseU", "_replace_image('\\1')", $content);
	return $content;
}

/**
 * @todo 新增用于正则替换图片降质的函数
 * @author JiangHong
 * @param String $imgsrc 图片地址
 * @return String
 */
function _replace_image($imgsrc){
	global $_G;
	
	/*过滤图片地址后面的后缀#*/
	if(($pos = stripos($imgsrc, "#")) !== false){
		$imgsrc = substr($imgsrc, 0, $pos);
	}
	$smileClass = "";
	$imgsrc 	= str_replace($_G['config']['web']['attach'], "", $imgsrc);
	
	if (preg_match("#http://.*\.(com|cn|org|net).*#is", $imgsrc) && !preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)) {
	} elseif (strrpos($imgsrc, "static/") === false) {
		$imgsrc = str_replace('image.', 'image1.', $imgsrc);
		if(!preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)){
			$imgsrc = 'http://'.$_G['config']['cdn']['images']['cdnurl'].'/'.$imgsrc;
		}				
		if(($pos2 = strrpos($imgsrc, '!')) !== false){
			$imgsrc = substr($imgsrc, 0, $pos2);
		}
		$imgsrc .= '!wap';		
	} else {
		$imgsrc = $_G["config"]['web']['portal'].$imgsrc;		
		$smileClass = "smile";
	}
	
	//延时加载
	return "<img src='{$_G["config"]['web']['portal']}static/images/loadding.gif' class='lazy {$smileClass}' data-original='{$imgsrc}'/>";
}

//对帖子中的图片进行降质处理
function dealThreadPic($content, $wh = '0') {
	/*此处使用正则直接替换，不使用循环多次正则替换，提升效率*/
	$content = preg_replace("/<img.*file=[\"|'](.[^>]*)[\"|'].*id=[\"|'](.[^>]*)[\"|'].*>/iseU", "_replace_post_image('\\1', '\\2', '$wh')", $content);
	return $content;
}

//用于帖子中正则替换图片降质的函数
function _replace_post_image($imgsrc, $id, $wh){
	global $_G;
	if (preg_match("#http://image\d+\.8264\.com.*#i", $imgsrc)) {
		if(($pos2 = strrpos($imgsrc, '!')) !== false){
			$imgsrc = substr($imgsrc, 0, $pos2);
		}
		$imgsrc .= '!wap';
		return "<img file='{$imgsrc}' id='{$id}' src='{$_G["config"]['web']['portal']}static/images/loadding.gif' class='lazy' data-original='{$imgsrc}'/>";	
	} else {
		//图片尺寸的处理
		if ($wh) {
			list($width, $height) = explode(",", $wh);
			$imgsrc = getimagethumb($width, $height , 2, str_replace($_G['config']['web']['attach'], "", $imgsrc));	
		} else {
			//若是选择原图降低图片质量,第一个参数传质量值,第二个参数为0,第三个参数为5
			$imgsrc = getimagethumb($_G["config"]['mobile']['picQuality'], 0 , 5, str_replace($_G['config']['web']['attach'], "", $imgsrc));		
		}
		
		//延时加载	
		return "<img file='{$imgsrc}' id='{$id}' src='{$_G["config"]['web']['portal']}static/images/loadding.gif' class='lazy' data-original='{$imgsrc}'/>";
	}
}

//获得plugin_forumoption的数据
function getForumoptionList() {
	$result = array();
	$sql 	= 'SELECT fid FROM '.DB::table('plugin_forumoption');
	$query  = DB::query($sql);
	while($v = DB::fetch($query)) {
		$result[$v['fid']] = $v['fid'];
	}
	return $result;
}

//源自source/function/function_core.php的checklowerlimit()
function checklowerlimit_wap( $action, $uid = 0, $coef = 1, $fid = 0, $returnonly = 0 )
{
	global $_G;

	include_once libfile( 'class/credit' );
	$credit = &credit::instance();
	$limit = $credit->lowerlimit( $action, $uid, $coef, $fid );
//	if ( $returnonly )
//		return $limit;
	if ( $limit !== true )
	{
		$GLOBALS['id'] = $limit;
		$lowerlimit = is_array( $action ) && $action['extcredits' . $limit] ? abs( $action['extcredits' . $limit] ) + $_G['setting']['creditspolicy']['lowerlimit'][$limit] : $_G['setting']['creditspolicy']['lowerlimit'][$limit];
		$rulecredit = array();
		if ( ! is_array( $action ) )
		{
			$rule = $credit->getrule( $action, $fid );
			foreach ( $_G['setting']['extcredits'] as $extcreditid => $extcredit )
			{
				if ( $rule['extcredits' . $extcreditid] )
				{
					$rulecredit[] = $extcredit['title'] . ( $rule['extcredits' . $extcreditid] > 0 ? '+' . $rule['extcredits' . $extcreditid] : $rule['extcredits' . $extcreditid] );
				}
			}
		}
		else
		{
			$rule = array();
		}
		$values = array(
			'title' => $_G['setting']['extcredits'][$limit]['title'],
			'lowerlimit' => $lowerlimit,
			'unit' => $_G['setting']['extcredits'][$limit]['unit'],
			'ruletext' => $rule['rulename'],
			'rulecredit' => implode( ', ', $rulecredit ) );
		if ( ! is_array( $action ) )
		{
			if ( ! $fid )
			{
				encodeData(array('error'=>true , 'errorinfo'=>"{$values['ruletext']} {$values['rulecredit']}，本操作后你的{$values['title']}将不足 {$values['lowerlimit']} {$values['unit']}"));
			}
			else
			{
				encodeData(array('error'=>true , 'errorinfo'=>"本版块{$values['ruletext']} {$values['rulecredit']}，本操作后你的{$values['title']}将不足 {$values['lowerlimit']} {$values['unit']}"));
			}
		}
		else
		{
			encodeData(array('error'=>true , 'errorinfo'=>"本操作后你的{$values['title']}将不足 {$values['lowerlimit']} {$values['unit']}"));
		}
	}
}

//源自source/function/function_core.php的cknewuser()
function cknewuser_wap( $return = 0 )
{
	global $_G;

	if ( ! $_G['uid'] ) {return true;}		

	if ( checkperm( 'disablepostctrl' ) ) {
		return $result;
	}
	$ckuser = $_G['member'];

	if ( $_G['setting']['newbiespan'] && $_G['timestamp'] - $ckuser['regdate'] < $_G['setting']['newbiespan'] * 60 ) {
		encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'no_privilege_newbiespan', array( 'newbiespan' => $_G['setting']['newbiespan'] ))));
	}

	if ( $_G['setting']['need_avatar'] && empty( $ckuser['avatarstatus'] ) ) {
		encodeData(array('error'=>true , 'errorinfo'=>'你需要设置自己的头像后才能进行本操作'));
	}

	if ( $_G['setting']['need_email'] && empty( $ckuser['emailstatus'] ) ) {
		encodeData(array('error'=>true , 'errorinfo'=>'你需要验证激活自己的邮箱后才能进行本操作'));
	}

	if ( $_G['setting']['need_friendnum'] )	{
		space_merge( $ckuser, 'count' );
		if ( $ckuser['friends'] < $_G['setting']['need_friendnum'] ) {
			encodeData(array('error'=>true , 'errorinfo'=>"你需要添加 {$_G['setting']['need_friendnum']}个好友之后，才能进行本操作"));
		}
	}
}

//源自source/function/function_core.php的periodscheck()
function periodscheck_wap( $periods, $showmessage = 1 )
{
	global $_G;

	if ( ! $_G['group']['disableperiodctrl'] && $_G['setting'][$periods] ) {
		$now = dgmdate( TIMESTAMP, 'G.i' );
		foreach ( explode( "\r\n", str_replace( ':', '.', $_G['setting'][$periods] ) ) as $period )	{
			list( $periodbegin, $periodend ) = explode( '-', $period );
			if ( ( $periodbegin > $periodend && ( $now >= $periodbegin || $now < $periodend ) ) || ( $periodbegin < $periodend && $now >= $periodbegin && $now < $periodend ) )	{
				$banperiods = str_replace( "\r\n", ', ', $_G['setting'][$periods] );
				if ($showmessage) {
					encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'period_nopermission', array( 'banperiods' => $banperiods ))));
				} else {
					return true;
				}
			}
		}
	}
	return false;
}

//源自source/function/function_core.php的censor()
function censor_wap( $message, $modword = null)
{	
	// 禁止类似 &#x6C88;&#x9633; 的html实体汉字提交
	if(preg_match('/[&amp;|&]#x(\w+);/', $message)) {encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'word_banned')));}
	require_once libfile( 'class/censor' );
	$censor = discuz_censor::instance();
	$censor->check( $message, $modword );
	if ( $censor->modbanned() )
	{
		$wordbanned = implode( ', ', $censor->words_found );
		encodeData(array('error'=>true , 'errorinfo'=>lang('message', 'word_banned', array( 'wordbanned' => $wordbanned ))));
	}
	return $message;
}


/***户外学校  问答专用  ********start*****/
//源自source/function/function_readmodelTravel.php的questionmodelMessage()
function questionmodelMessage_wap($message, $tid= 0, $pid = 0, &$blockquote = array()) {
    global $_G;

    include_once libfile('function/discuzcode');
    $message=preg_replace('/\[img=(\d+),(\d+)\]/', '[img]', $message);
    //过滤微信图片
    //http://mmbiz.qpic.cn/mmbiz/6kkeDPr2oySKH7ibQY1KhKI7skA4LwTeNSPF1Ze8ganjibs8wSaqSLcjjp6cApN68Xy8yWV8HwP82aZTtEMgy4MQ/0
    //http://mmbiz.qpic.cn/mmbiz/TTfzHvFaeQ6czbhVoDOicgwlvB0TbZwWibruDt1tosSm7hmT6Zuc0uDxvq2uJnjCR10d9zvv2FmV6dVuoHA8QKAA/0
    //http://mmbiz.qpic.cn/mmbiz/Sf6nibvavkZqvPFGpVdHx2pE6SNChpKtrDeRffeic3LeeibyUKiak1srtFmUs8jZM12eNxNwiaKZNTcs0MPSLicbAJ0g/0?wxfrom=5
    $message=preg_replace('/\[img\]http:\/\/mmbiz\.qpic\.cn\/mmbiz\/(.*)\[\/img\]/isU', '', $message);
    $message = discuzcode($message);

    if (!empty($tid)) {
        //对message中引用的处理
        preg_match_all("/<blockquote>(.*)<a.*pid=(\d*)&.*>.*<\/a>(.*)<\/blockquote>/isU", $message, $matA);
        if (!empty($matA[2][0])) {

            $blockquote[$tid][$pid]["message_quote_content"] = strip_tags($matA[3][0]);

            $arr = explode(" ", strip_tags($matA[1][0]));
            $blockquote[$tid][$pid]["message_quote_author"]   = $arr[0];
            $blockquote[$tid][$pid]["message_quote_dateline"] = $arr[2]." ".$arr[3];
            $blockquote[$tid][$pid]["message_quote_pid"] 	  = $matA[2][0];

            $message = preg_replace('/<blockquote>(.*)<\/blockquote>/isU', '', $message);//引用
        }
    }

    $message = preg_replace('/<font[^>]*color:#fff[^>]*>.*<\/font>/isU', '', $message);//处理掉不显示的font标签
    $message = preg_replace('/下载地址回复可见.*<\/p>/isU', '</p>', $message);

    $message = strip_tags($message, "<a><p><img><table><tbody><tr><th><td><span><script><br>");

    $message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n个连续<br/>
    $message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
    $message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
    $message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>

    $message = str_replace('target="_blank"', "", $message);
    $message = str_replace('楼主', "题主", $message);
    $message = preg_replace('/\{\:.*\:\}/isU', '', $message);//{:4_111:}
    $message = preg_replace('/本帖最后由.*编辑/isU', '', $message);//本帖最后由...编辑

    //$message = dealTextPic($message);

    preg_match_all('/\[attach\](\d+)\[\/attach\]/isU', $message, $matA);

    if ($matA[1]) {
        $aids  = implode(',', $matA[1]);
        $sql   = "SELECT aid, attachment, dir  FROM ".DB::table('forum_attachment')." WHERE aid in ({$aids}) " . getSlaveID();

        $query = DB::query($sql);
        while ($v = DB::fetch($query)) {
            $imgsrc 		 = "http://{$_G['config']['cdn']['images']['cdnurl']}/{$v['dir']}/{$v['attachment']}!t1w1500h1500";
            $pics[$v['aid']] = "<img src='{$_G["config"]['web']['portal']}static/images/loadding.gif' class='lazy preview zoom' onclick='zoom(this,this.src)' bigpic='{$imgsrc}' data-original='{$imgsrc}'/>";
        }
        foreach ($matA[1] as $k=>$v) {
            if (isset($pics[$v])) {
                $message = str_replace("[attach]{$v}[/attach]", $pics[$v], $message);
            } else {
                $message = str_replace("[attach]{$v}[/attach]", '', $message);
            }
        }
    }

    $message = preg_replace('/(<img.*>)\s*<br[^>]*\/?>/isU', '\1', $message);//<img><br/>

    return $message;

}
function _removingPBR_wap($message){
    $message=str_replace('align="center"', '', $message);
    $message = preg_replace('/回复(.*)<a href="http:\/\/www\.8264\.com\/forum\.php\?mod=redirect&goto=findpost&pid=(\d+)&ptid=(\d+)"(.*)>(.*)的帖子<\/a><br\/>/isU', '', $message);
    $message = preg_replace('/回复(.*)<a href="http:\/\/www\.8264\.com\/forum\.php\?mod=redirect&goto=findpost&pid=(\d+)&ptid=(\d+)"(.*)>(.*)的帖子<\/a>/isU', '', $message);
    $message = preg_replace('/<img(.*)src="http:\/\/static\.(8264|zaiwai)\.com\/static\/image\/smiley\/default\/(.*)\.gif"(.*)>/isU', '', $message);

    $message = preg_replace('/<br[^>]*\/?>(\s*<br[^>]*\/?>)+/is', '<br/>', $message);//n个连续<br/>
    $message = preg_replace('/<p(.[^>]*)>\s*<br[^>]*\/?>\s*<\/p>/isU', '', $message);//<p><br/></p>
    $message = preg_replace('/(<p(.[^>]*)>)\s*<br[^>]*\/?>/isU', '\1', $message);//<p><br/>
    $message = preg_replace('/(<\/p>)\s*<br[^>]*\/?>/isU', '\1', $message);//</p><br/>
    return $message;
}

function xuexiaoStatistics_wap($aid,$catid,$uid){
        //户外知识
        /**$catShow = category_remake(238);
        $catShow["children"][] =  238;
        var_dump(dimplode($catShow["children"]));die;**/

        $zhishi_category = array('242','950','931','915','916','917','918','919','921','920','951','952','953','238');
        if($aid&&$uid&&in_array($catid,$zhishi_category)){
            $jiluOne =DB::fetch_first("SELECT * FROM " . DB::table('portal_article_xuexiao_statistics') . " WHERE aid ='{$aid}' AND catid ='{$catid}' AND uid = '{$uid}'  " . getSlaveID());
            if(!$jiluOne){

                $data['aid'] = $aid;
                $data['catid'] = $catid;
                $data['uid'] = $uid;
                $data['dateline'] = time();
                DB::insert('portal_article_xuexiao_statistics', $data);
            }
        }


}



/***户外学校  问答专用  ********end*****/

?>