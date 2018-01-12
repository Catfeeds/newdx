<?php
//目前活动向APP中同步时，传图用

class UpYunQnw extends UpYun{
    function _do_request($method, $path, $headers = NULL, $body = NULL, $file_handle = NULL) {
        $data = array('http_status' => 200, 'msg' => 'http success!', 'return' => array(), 'status' => 200, 'file_path' => substr($path, 1), 'size' => '');
        try{
            $data['return'] = parent::_do_request($method, $path, $headers, $body, $file_handle);
        }catch(Exception $e) {
            $data['http_status'] = $e->getCode();
            $data['msg'] = $e->getMessage();
            $data['status'] = '';
        }
        return $data;
    }

    function thumb_gd_upyun($res, $dir, $thumb_array, $ext){
        foreach ($thumb_array as $key => $value) {
            $opts = array(
                UpYunQnw::X_GMKERL_TYPE    => 'fix_both', // 缩略图类型
                UpYunQnw::X_GMKERL_VALUE   => "{$value['width']}x{$value['height']}", // 缩略图大小
                UpYunQnw::X_GMKERL_QUALITY => 95, // 缩略图压缩质量
                UpYunQnw::X_GMKERL_UNSHARP => True // 是否进行锐化处理
            );
            $tmp = $this->writeFile('/'.$dir.'/'.$value['name'].'.'.$ext, $res, true, $opts);
            if($tmp['http_status']==200){
                $data[] = $tmp['file_path'];
            }else{
                return '';
            }
        }
        return $data;
    }

    function delete($args, $thumbs) {
        if(isset($args['file_name']['file_path'])){
            parent::delete($path);
        }elseif(is_string($args['file_name'])){
            $thumb_name = preg_replace('/^https?:\/\/([^\/]+)\//i','',$args['file_name']);
            parent::delete('/'.$thumb_name);
        }
    }
}

/**
 * 远程附件处理类
 *
 * @author gtl 20141127
 */
class RemAttaHandle {

	//var $atta = null;
    var $upyun = null;

	function __construct($bucket_name="img-qnw",$username="qunawan",$password="qunawan8264") {
		$this->RemAttaHandle($bucket_name,$username,$password);
	}

	function RemAttaHandle($bucket_name,$username,$password) {
		//$this->atta = new RemAttaHandleWan();
        //$this->upyun = new UpYunQnw('img-qnw','qunawan', 'qunawan8264');
		$this->upyun = new UpYunQnw($bucket_name,$username, $password);
	}

	/**
	 * 附件上传
	 *
	 * @author gtl 20141127
	 * @param string $res 附件资源
	 * @param string $dirname 远程目录名
	 * @param string $filename 文件名
	 * @param string $ext 扩展名
	 * @param int $size 文件大小（备用）
	 * @return array 返回信息(status：失败时为0或''或false、成功时为写入文件字节数)[file_path：写入文件的路径，err_msg：错误时的错误信息]
	 */
	function saveAtta($res, $dirname, $filename, $size = 0, $opt = array()) {
		// 旧版接口
        //$arr_params = array('res' => $res, 'path' => $dirname, 'file_name' => $filename, 'type' => $ext, 'size' => $size, 'p_path' => '');
        //$old = $this->atta->client->saveAtta($arr_params);

        // 新版接口
        $new = $this->upyun->writeFile('/'.$dirname.'/'.$filename,$res,true,$opts);

        return $new;
	}

	/**
	 * 附件删除
	 *
	 * @author rinne 130204
	 * @param string $file_name 附件完整路径
	 * @param array $thumbs 要连带删除的缩略图
	 */
	function delAtta($file_name, $thumbs = null) {
		$args = array('p_path' => '', 'file_name' => $file_name);
		//$this->atta->client->delAtta($args, $thumbs);
        $this->upyun->delete($args, $thumbs);
	}

	/**
	 * 生成缩略图
	 *
	 * @author rinne 130204
	 * @param string $file_path 原图完整路径
	 * @param string $thumbnail 缩略图生成完整路径
	 * @param int $width 缩略图宽度
	 * @param int $height 缩略图高度（高度为0则生成等比缩略图）
	 * @param boolean $fail_del 缩略图生成失败时是否删除原图
	 * @param int $quality 缩略图质量，100之内的正整数
	 * @return boolean $res 缩略图生成是否成功
	 */
	function saveThumb($file_path, $thumbnail, $width, $height, $fail_del = true, $quality = 85) {
        return false;
		$res = $this->atta->client->saveThumb($file_path, $thumbnail, $width, $height, $quality);
		if ($fail_del && !$res) {
			$this->delAtta($file_path);
		}
		return $res;
	}

	/**
	 * 添加水印
	 *
	 * @author rinne 130204
	 * @param type $src 原图完整路径
	 * @param type $mark_img 水印图完整路径
	 * @param string $position 水印位置 lt左上  rt右上  rb右下  lb左下 其余取值为中间
	 * @param int $quality jpg图片质量，仅对jpg有效 默认85 取值 0-100之间整数
	 * @param int $pct 水印图片融合度(透明度)
	 * @return void
	 */
	function addWatermark($src, $mark_img, $position = 'rb', $quality = 85, $pct = 80) {
        return false;
		$this->atta->client->addWatermark($src, $mark_img, $position = 'rb', $quality = 85, $pct = 80);
	}

	/**
	 * 生成缩略图
	 *
	 * @author rinne 130204
	 * @param string $file_path  原图路径
	 * @param string $dir  缩略图路径
	 * @param array $thumb_array  要剪裁的尺寸
	 * 				格式： 一维或二维数组  array( name-文件名  width-宽度  height-高度  type-剪裁类型  )
	 * 				剪裁类型：1-等比例缩放  2-缩放后填充  3-居中裁剪  4-左上角裁剪  5-右下角裁剪  6-固定尺寸缩放
	 * @param string $ext  扩展名
	 */
//	function thumb_gd($file_path, $dir, $thumb_array, $ext) {
//        return $this->atta->client->thumb_gd($file_path, $dir, $thumb_array, $ext);
//	}

    /**
     * 生成缩略图
     *
     * @author gtl 20141127
     * @param type $res 文件资源
     * @param type $dir 缩略图路径
     * @param type $thumb_array 要剪裁的尺寸
	 * 				格式： 一维或二维数组  array( name-文件名  width-宽度  height-高度  type-剪裁类型  )
	 * 				剪裁类型：1-等比例缩放  2-缩放后填充  3-居中裁剪  4-左上角裁剪  5-右下角裁剪  6-固定尺寸缩放
     * @param type $ext 扩展名
     * @return type 剪裁后的缩略图路径
     */
    function thumb_gd_upyun($res, $dir, $thumb_array, $ext){
        return $this->upyun->thumb_gd_upyun($res, $dir, $thumb_array, $ext);
    }

}

?>
