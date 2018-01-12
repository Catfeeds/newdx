<?php

/**
 * @author jianghong
 * @todo 用于记录日志
 * @version 2012.09.14
 * @example $logs = new logs;
 * @example $logs->log_str("test str");
 * @example $logs->log_array($array,'_GET');
 * @example echo $logs;
 */

Class logs{
    private $log;
    private $save_path;
    private $file_name;
    function logs($filename=''){
        $this->save_path = dirname(__file__)."/logs".(empty($filename)?"/":"/{$filename}/").date("Ym",time())."/";
        $this->create_folders($this->save_path);
        $this->file_name = date("d",time()).".log";
        
    }
    
    function log_str($str){
        self::read_logs();
        $this->log .= "time:".date("H:i:s",time())."  ---  ".$str."<br/>\n";
        self::write_logs();
    }
    
    function log_array($array,$array_name){
        if(is_array($array)){
            self::read_logs();
            $this->log .= "===========Array : \${$array_name}=====START====【".date("H:i:s",time())."】========\n";
            foreach($array as $key => $value){
                if(!is_array($value)) $this->log .= "\$".$array_name."['".$key."']";
                self::foreach_array($value,"\$".$array_name."['".$key."']");
            }
            $this->log .= "===========Array : \${$array_name}=====E N D====【".date("H:i:s",time())."】========\n";
            self::write_logs();
        }else{
            self::log_str($array);
        }
    }
    
    function read_logs(){
        if(file_exists($this->save_path.$this->file_name)){
            $this->log = file_get_contents($this->save_path.$this->file_name);
        }
    }
    
    private function write_logs(){
        //file_put_contents($this->save_path.$this->file_name,$this->log);
    }
    
    private function foreach_array($array,$upkey){
        if(is_array($array)){
            foreach($array as $key => $value){
                $this->log .= $upkey."['".$key."']";
                self::foreach_array($value,"['".$key."']");
            }
        }else{
            $this->log .= " = ".$array."\n";
        }
    }
    
    
    
    function __toString(){
        $hand = fopen($this->save_path.$this->file_name,'r');
        $html_log = "";
        while(!feof($hand)){
            $html_log .= fgets($hand)."<br/>";
        }
        fclose($hand);
        return $html_log;
    }
	
	function create_folders($dir){
		return is_dir($dir) or ($this->create_folders(dirname($dir)) and mkdir($dir, 0777));
	}
}
?>