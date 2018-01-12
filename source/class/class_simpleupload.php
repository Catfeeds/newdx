<?php

/**
 * @author JiangHong
 * @copyright 2014
 * @todo һ���򵥵��ϴ�flash��ֱ��ͨ�������ȡ��Ҫ������ַ���
 */

Class simpleUpload
{
	/**
	 * simpleUpload::getFlashStr()
	 * 
	 * @param mixed $htmlid �����ϴ�FLASH��Ŀ��div��ID
	 * @param int $width �����ϴ�flash�Ŀ�
	 * @param int $height �����ϴ�flash�ĸ�
	 * @param mixed $uploadurl �ϴ�ͼƬ���͵�url(�ϴ�ʱ�����Զ�����POST����op=upload)���˴�Ĭ���������ʹ�õ�����ϴ����ϴ����������idΪ0�������޷��鿴�����������Ժ��������Ӧ���ã�
	 * @param string $callbackfunc �ϴ���ɵ��õ�JS�ص�����
	 * @param string $configurl �����ļ�xml��·�����˴�flash��ʼ�����ͨ����url��ȡ�û�id��hash�룬������ʱ����url���ϲ���op=config
	 * @param string $imgicon �ϴ�icon��Сͼ�ꡣ
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