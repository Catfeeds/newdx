<?php

/**
 * @author JiangHong
 * @copyright 2013
 */

class sockpost{
    /**
     * �����ļ�����
     * @author JiangHong
     * @param $filetmp string ���͵ľ���·��
     * @param $host string ���ն˵�IP��ַ������
     * @param $api string ���ܶ˽ӿ��ļ���
     * @param $filename string ���ն˽����ļ��󱣴���ļ���
     * @param $filetype string �ļ����ͣ�����$_FILES�е�type
     * @param $args array ����ͬʱЯ���Ĳ���{classname : string ���ý��ն˵�class�� ; dir : string �����Ŀ¼ ; replace : bool ���Ŀ���ļ������Ƿ��滻��Ĭ��Ϊ���滻}
     * @param $callback array {class : object �ص����ʵ�� name : string �ص���������ķ�����}
     * @param $isfile bool �Ƿ�Ϊ�ļ���Ĭ��Ϊtrue ��falseʱ$filetmp����Ϊ�ַ�����
     * @param $noreturn bool �Ƿ񲻵ȴ�������Ϣ��Ĭ��Ϊ�񣬴˴�Ϊtrueʱ�����ͺ󲻶�ȡ���ص���Ϣ��
     * @return array
     */
    public static function post($filetmp , $host , $api , $filename , $filetype , $args = array() , $callback = array() , $isfile = true, $noreturn = false){
        if(($isfile && !file_exists($filetmp)) || strlen($host) < 5 || strpos($api , '.php') === false || empty($filename) || empty($filetype) || stripos($filename , '.php') === true){
            return false;
        }
        /*����postģ���еķָ���*/
        $boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
        /*����post��ͷ��Ϣ*/
        $header = "POST {$api} HTTP/1.0\r\n";
        $header .= "Host: {$host}\r\n";
        $header .= "Content-type: multipart/form-data, boundary=$boundary\r\n";
        /*��ʼ��post���ύ�ļ�*/
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
        /*�����ָ���*/
        $data .="--$boundary--\r\n";
        $header .= "Content-length: " . strlen($data) . "\r\n\r\n";
        $fp = fsockopen($host, 8080,$errno,$errinfo,5);
        if(!$fp){
            fclose($fp);
            $error = array('error' => true , 'errorinfo' =>'ͨѶ����ԭ��'.$errinfo);
            return $error;
        }
        stream_set_blocking($fp, True);  
        stream_set_timeout($fp, 15); 
        if(fputs($fp, $header.$data) === FALSE) return false;
        if($noreturn) return true;
        while (!feof($fp)) {
            $getstr .= fgets($fp, 200);
            /*if((time()-$time) >= 2){
				$logs->log_str('���ճ�ʱ');
                return false;
            }*/
        }
        fclose($fp);
        $getmessage = substr($getstr,strpos($getstr,"\r\n\r\n"));
        if(empty($getmessage) || strlen($getmessage)<10){
            $error = array('error' => true , 'errorinfo' => 'δ�����κ���Ϣ����¼ȫ��������Ϣ'.$getstr);
            return $error;
        }
        $getmessage = json_decode($getmessage , true);
        return sockpost::do_callback($getmessage , $callback);
    }
    /**
     * ���Ͳ��������ļ��ķ���
     * @author JiangHong
     * @param $host string �����ļ���IP��ַ������
     * @param $api string ���ܶ˽ӿ��ļ�
     * @param $args array ����ͬʱЯ���Ĳ���{classname string ���ý��ն˵�class�� ; method string ���õĽ��ն��෽�� ;}
     * @param $callback array {class : object ����ǵ���ĳ�෽�����˲����������ʵ����; name : string �����򷽷���}
     * @param $noreturn bool �Ƿ񲻵ȴ�������Ϣ��Ĭ��Ϊ�񣬴˴�Ϊtrueʱ�����ͺ󲻶�ȡ���ص���Ϣ�� 
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
            $error = array('error' => true , 'errorinfo' => 'ͨѶ����ԭ��'.$errinfo);
            return $error;
        }
        stream_set_blocking($fp, True);  
        stream_set_timeout($fp, 15);
        if(fputs($fp, $header.$data) === FALSE) return false;
        if($noreturn) return true;
        while (!feof($fp)) {
            $getstr .= fgets($fp, 200);
            /*if((time()-$time) >= 2){
                $logs->log_str('���ճ�ʱ');
                return false;
            }*/
        }
        fclose($fp);
        $getmessage = substr($getstr,strpos($getstr,"\r\n\r\n"));
        if(empty($getmessage) || strlen($getmessage)<10){
			$error = array('error' => true , 'errorinfo' => 'δ�����κ���Ϣ����¼ȫ��������Ϣ'.$getstr);
            return $error;
        }
        $getmessage = json_decode($getmessage , true);
        return sockpost::do_callback($getmessage , $callback);
    }
    /**
     * ��������token
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
     * ������Ϣ���ú���
     * @author JiangHong
     * @param $getstr array ���ص���Ϣ
     * @param $callback array ����callback�����Ĳ���{class : object ����ǵ���ĳ�෽�����˲����������ʵ���� ; name : string ���õĺ�������ķ�����}
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