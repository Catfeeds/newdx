<?php

/**
 * @author JiangHong
 * @copyright 2014
 * @todo 一个简单的上传flash，直接通过此类获取需要输出的字符串
 */

Class simpleUpload
{
	/**
	 * simpleUpload::getFlashStr()
	 * 
	 * @param mixed $htmlid 生成上传FLASH的目标div的ID
	 * @param int $width 生成上传flash的宽
	 * @param int $height 生成上传flash的高
	 * @param mixed $uploadurl 上传图片发送的url(上传时，会自动传入POST参数op=upload)（此处默认情况下是使用的相册上传，上传到的是相册id为0，所以无法查看，若有需求以后会增加相应配置）
	 * @param string $callbackfunc 上传完成调用的JS回调函数
	 * @param string $configurl 配置文件xml的路径，此处flash初始化后会通过此url获取用户id和hash码，读配置时会在url上上参数op=config
	 * @param string $imgicon 上传icon的小图标。
	 * @return
	 */
	public static function getFlashStr($htmlid, $width, $height, $uploadurl, $callbackfunc = '', $configurl = '', $imgicon = ''){
		$htmlid = $htmlid ? $htmlid : 'simpleupload';
		$width = intval($width) > 1 ? $width : 20;
		$height = intval($height) > 1 ? $height : 20;
		$configurl = $configurl ? $configurl : "/misc.php?mod=simpleupload";
		$uploadurl = $uploadurl ? htmlspecialchars_decode($uploadurl) : "/home.php?mod=misc&ac=simpleupload";
		$return = '<script type="text/javascript" src="static/js/swfobject.js"></script>';
		$return .= '<script type="text/javascript">';
		$return .= 'var params = {};';
		$return .= 'params.configurl = "' . urlencode($configurl) . '";';
		$return .= 'params.uploadurl = "' . urlencode($uploadurl) . '";';
		$callbackfunc = $callbackfunc ? $callbackfunc : 'flashcallback';
		$return .= 'params.callback = "' . $callbackfunc . '";';
		if($imgicon){
			$return .= 'params.imgicon = "' . urlencode($imgicon) . '";';
		}
		$return .= 'swfobject.embedSWF("static/flash/uploadsimple.swf", "' . $htmlid . '", "' . $width . '", "' . $height . '", "10.0.0", "playerProductInstall.swf", params, {wmode:"transparent"});</script>';
		return $return;  
	}
}

?>