<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

@extract($_G['cache']['plugin'][$identifier]);

$tid=intval($_G['gp_ptid']);
$pid=DB::result_first("select pid FROM ".DB::table("forum_post")." where tid='$tid' and first=1 limit 1");
$attachfile='';
if($isusesortpic&&$picoptionid){
	$value=DB::result_first("SELECT `value` FROM ".DB::table("forum_typeoptionvar")." WHERE `tid` ='$tid' AND `optionid` ='$picoptionid' LIMIT 0 , 1");
	if($value){
		$value=unserialize($value);
		$attachfile=$value['url'];
        $attachserverid = isset($value['serverid']) ? $value['serverid'] : 0;
        $attachfilename = isset($value['filename']) ? $value['filename'] : '';
	}
}
/*读取附件服务器信息*/
require_once DISCUZ_ROOT."./source/plugin/attachment_server/attachment_server.class.php";
$attachment = new attachserver;
$attach_info = $attachment->get_server_domain('all','*');
/*结束*/
if(!$attachfile){
$attach=DB::fetch_first("SELECT a.tid,a.attachment,a.remote,a.serverid 
FROM ".DB::table("forum_attachment")." a
WHERE a.`pid` ='$pid'
AND a.`isimage`<>0
order by a.aid asc
limit 0,1");


if($attach){
    $attachserverid = $attach['serverid'];
	$attachurl=($attachserverid > 0 ? "http://".$attach_info[$attachserverid]['name'] : $_G['setting']['attachurl']);
	$attachfile=$attachurl."/forum/".$attach['attachment'];
}else{
	//$attachfile="./source/plugin/{$identifier}/nopic.jpg";
	exit;
}
}

$thumbfile='';

if($attachfile){
	$md5=md5($tid);
    if($attachserverid > 0 && !empty($attachfilename)){
        $thumbfilename = "threadpic/{$picw}x{$pich}/{$md5[0]}{$md5[1]}/{$md5}.jpg";
        $thumbfile = "http://".$attach_info[$attachserverid]['name']."/".$thumbfilename;
        if(!is_exists($thumbfile,250)){
            $attachment->Thumb($attach_info[$attachserverid]['domain'] , $attach_info[$attachserverid]['api'] , 'forum/'.$attachfilename , $thumbfilename , $picw , $pich , 1);
        }
    }
}

if($thumbfile&& is_exists($thumbfile,250)){
	dheader("location:$thumbfile");
}else{
	//dheader("location:./source/plugin/{$identifier}/nopic.jpg");
}

function dzthumb($srcfile,$dstfile,$dstw,$dsth=0,$mode=0,$data=''){
	//mode=0为固定宽高，画质裁切不变形
	//mode=1为固定宽高，画质会拉伸变形
	//mode=2为可变宽高，宽高不超过指定大小
	//mode=3为固定宽度，高度随比例变化
	$data=$data==''?@GetImageSize($srcfile):$data;
	if(!$data) return false;
	if($data[2]==2) $im=@ImageCreateFromJPEG($srcfile);
	elseif ($data[2]==1) $im=@ImageCreateFromGIF($srcfile);
	elseif($data[2]==3) $im=@ImageCreateFromPNG($srcfile);
	list($img_w, $img_h) = $data;
	if($dsth==0) $mode=3;
	if($mode==0){
		$imgratio = $img_w / $img_h;
		$thumbratio = $dstw / $dsth;
		if($imgratio >= 1 && $imgratio >= $thumbratio || $imgratio < 1 && $imgratio > $thumbratio) {
			$cuty = $img_h;
			$cutx = $cuty * $thumbratio;
		} elseif($imgratio >= 1 && $imgratio <= $thumbratio || $imgratio < 1 && $imgratio < $thumbratio) {
			$cutx = $img_w;
			$cuty = $cutx / $thumbratio;
		}
		$cx = $cutx;
		$cy = $cuty;
	}elseif($mode==1){
		$cx = $img_w;
		$cy = $img_h;
	}elseif ($mode==2){
		$cx = $img_w;
		$cy = $img_h;
		$bit=$img_w/$img_h;
		if($dstw/$dsth>$bit){
			$dstw=($img_w/$img_h)*$dsth;
		}else{
			$dsth=($img_h/$img_w)*$dstw;
		}
	}
	elseif($mode==3){
		$cx = $img_w;
		$cy = $img_h;
		$dsth=$dstw * $img_h / $img_w;
	}
	$ni=imagecreatetruecolor($dstw,$dsth);
	ImageCopyResampled($ni,$im,0,0,0,0,$dstw,$dsth, $cx, $cy);
	clearstatcache();
	if($data[2]==2) ImageJPEG($ni,$dstfile,100);
	elseif($data[2]==1) ImageGif($ni,$dstfile);
	elseif($data[2]==3) ImagePNG($ni,$dstfile);
	return true;
}

function getmessagepic($pid){
	$message=DB::result_first("SELECT `message` FROM ".DB::table("forum_post")." WHERE `pid` ='$pid' LIMIT 0 , 1");
	if(preg_match("/\[img[^\]]*\](.*)\[\/img\]/iU",$message,$reg)){
		return $reg[1];
	}
	return '';
}
function is_exists($file,$num){
    if(file_exists($file)){
        return true;
    }else{
        $fp = @fopen($file,'rb');
        $str = '';
        $len = 0;
        if($fp){
            $str = @fread($fp,256);
            @fclose($fp);
            if(($len = strlen($str))>=$num) return true;
        }
        //echo "长度".$len;
        return false;
    }
}
?>