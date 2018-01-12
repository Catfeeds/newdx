<?php

/**
 * @author JiangHong
 * @copyright 2013
 */

class sockpost{
    /**
     * 发送文件方法
     * @author JiangHong
     * @param $filetmp string 发送的绝对路径
     * @param $host string 接收端的IP地址或域名
     * @param $api string 接受端接口文件名
     * @param $filename string 接收端接收文件后保存的文件名
     * @param $filetype string 文件类型，类似$_FILES中的type
     * @param $args array 发送同时携带的参数{classname : string 调用接收端的class名 ; dir : string 保存的目录 ; replace : bool 如果目标文件存在是否替换，默认为不替换}
     * @param $callback array {class : object 回调类的实例 name : string 回调函数或类的方法名}
     * @param $isfile bool 是否为文件，默认为true ，false时$filetmp参数为字符串。
     * @param $noreturn bool 是否不等待返回信息，默认为否，此处为true时将发送后不读取返回的信息。
     * @return array
     */
    public static function post($filetmp , $host , $api , $filename , $filetype , $args = array() , $callback = array() , $isfile = true, $noreturn = false){
        if(($isfile && !file_exists($filetmp)) || strlen($host) < 5 || strpos($api , '.php') === false || empty($filename) || empty($filetype) || stripos($filename , '.php') === true){
            return false;
        }
        /*建立post模拟中的分割线*/
        $boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
        /*构建post的头信息*/
        $header = "POST {$api} HTTP/1.0\r\n";
        $header .= "Host: {$host}\r\n";
        $header .= "Content-type: multipart/form-data, boundary=$boundary\r\n";
        /*初始化post的提交文件*/
        $data = $getstr = '';
        $data .= "--$boundary\r\n";
        $content_file = $isfile ? file_get_contents($filetmp) : $filetmp;
        $data .="Content-Disposition: form-data; name=\"files\"; filename=\"$filename\"\r\n";
        $data .= "Content-Type: $filetype\r\n\r\n";
        $data .= "".$content_file."\r\n";
        $time = time();
        $args['token'] = sockpost::token($time);
        $args['posttime'] = $time;
        $args['replace'] = isset($args['replace']) ? $args['replace'] : 0;
        foreach($args as $key => $arg){
            $data .="--$boundary\r\n";
            $data .="Content-Disposition: form-data; name=\"info[$key]\"\r\n";
            $data .= "Content-Type: text\r\n\r\n";
            $data .= "".$arg."\r\n";
        }
        /*结束分割线*/
        $data .="--$boundary--\r\n";
        $header .= "Content-length: " . strlen($data) . "\r\n\r\n";
        $fp = fsockopen($host, 8080,$errno,$errinfo,5);
        if(!$fp){
            fclose($fp);
            $error = array('error' => true , 'errorinfo' =>'通讯错误，原因'.$errinfo);
            return $error;
        }
        stream_set_blocking($fp, True);  
        stream_set_timeout($fp, 15); 
        if(fputs($fp, $header.$data) === FALSE) return false;
        if($noreturn) return true;
        while (!feof($fp)) {
            $getstr .= fgets($fp, 200);
            /*if((time()-$time) >= 2){
				$logs->log_str('接收超时');
                return false;
            }*/
        }
        fclose($fp);
        $getmessage = substr($getstr,strpos($getstr,"\r\n\r\n"));
        if(empty($getmessage) || strlen($getmessage)<10){
            $error = array('error' => true , 'errorinfo' => '未返回任何信息，记录全部返回信息'.$getstr);
            return $error;
        }
        $getmessage = json_decode($getmessage , true);
        return sockpost::do_callback($getmessage , $callback);
    }
    /**
     * 发送参数，无文件的方法
     * @author JiangHong
     * @param $host string 接收文件的IP地址或域名
     * @param $api string 接受端接口文件
     * @param $args array 发送同时携带的参数{classname string 调用接收端的class名 ; method string 调用的接收端类方法 ;}
     * @param $callback array {class : object 如果是调用某类方法，此参数传入类的实例化; name : string 函数或方法名}
     * @param $noreturn bool 是否不等待返回信息，默认为否，此处为true时将发送后不读取返回的信息。 
     * @return array
     */
    public static function method($host , $api , $args , $callback = array() , $noreturn = false){
        if(strlen($host) < 5 || strpos($api , '.php') === false || empty($args) || !isset($args['classname']) || !isset($args['method'])) return false;
        $getstr = '';
        $header = "POST {$api} HTTP/1.0\r\n";
        $header .= "Host: {$host}\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $argstring = '';
        foreach($args as $key => $value){
            $argstring .= rawurlencode("info[$key]")."=".rawurlencode("$value")."&";
        }
        $time = time();
        $argstring .= rawurlencode("info[token]")."=".rawurlencode(sockpost::token($time))."&";
        $argstring .= rawurlencode("info[posttime]")."=".rawurlencode($time);
        $data = $argstring."\r\n\r\n";
        $header .= "Content-length: " . strlen($data) . "\r\n";
        $header .= "Connection: close\r\n\r\n";
        $fp = fsockopen($host, 8080, $errno , $errinfo , 10);
        if(!$fp){
            fclose($fp);
            $error = array('error' => true , 'errorinfo' => '通讯错误，原因'.$errinfo);
            return $error;
        }
        stream_set_blocking($fp, True);  
        stream_set_timeout($fp, 15);
        if(fputs($fp, $header.$data) === FALSE) return false;
        if($noreturn) return true;
        while (!feof($fp)) {
            $getstr .= fgets($fp, 200);
            /*if((time()-$time) >= 2){
                $logs->log_str('接收超时');
                return false;
            }*/
        }
        fclose($fp);
        $getmessage = substr($getstr,strpos($getstr,"\r\n\r\n"));
        if(empty($getmessage) || strlen($getmessage)<10){
			$error = array('error' => true , 'errorinfo' => '未返回任何信息，记录全部返回信息'.$getstr);
            return $error;
        }
        $getmessage = json_decode($getmessage , true);
        return sockpost::do_callback($getmessage , $callback);
    }
    /**
     * 计算令牌token
     * @author JiangHong
     */
    public static function token($key = ''){
        $safestring = 'dnbxzfbnveqiaty05u7iwnjgvsldxzvxlzbnniugeqyt7290hgjfnlnxbvfdzghiuadg';
        $time = $key;
        $starlen = dechex(substr($time , -2 , 1) > 5 ? (substr($time , -5 , 2) + 82) * 3 : (strrev(substr($time , -4 , 2)) + 64) * 2);
        $token[] = substr($safestring , 0 , ceil(strlen($safestring) / 2));
        $token[] = strrev($starlen);
        $token[] = substr($safestring , ceil(strlen($safestring) / 3) , ceil(strlen($safestring) / 2));
        $token[] = md5($starlen);
        $token[] = substr($safestring , -ceil(strlen($safestring) / 3));
        return md5(implode('',$token));
    }
    /**
     * 返回信息调用函数
     * @author JiangHong
     * @param $getstr array 返回的信息
     * @param $callback array 调用callback函数的参数{class : object 如果是调用某类方法，此参数传入类的实例化 ; name : string 调用的函数或类的方法名}
     */
    public static function do_callback($getstr , $callback = array()){
        if(empty($getstr)) return false;
        if(isset($callback['class']) && is_object($callback['class'])){
            if(method_exists($callback['class'] , $callback['name'])) return call_user_func_array(array($callback['class'] , $callback['name']) , array('return'=>$getstr));
        }elseif(isset($callback['name']) && function_exists($callback['name'])){
            return call_user_func($callback['name'] , $getstr);
        }
        return $getstr;
    }
    
}

?>