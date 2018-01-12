<?php

class Helper {
	public static function getArrayBySql($sql) {
		$array = array();
		$query = DB::query($sql);
		while ($value = DB::fetch($query)) {
			$array[] = $value;
		}
		return $array;
	}

	public static function log($str) {
		if (empty($str)) {
			return;
		}
		$log_path = dirname(__file__).'/log.txt';
		if ($handle = fopen($log_path, 'a+')) {
			$str = "\r\n\r\n".date('Y-m-d H:i:s')."\r\n{$str}";
			fwrite($handle, $str);
		}
		fclose($handle);
	}
	
	public static function writeFile($filename, $content) {
		$tmp_dir = dirname(__file__).'/tmp/';
		if (!file_exists($tmp_dir)) {
			mkdir($tmp_dir);
		}
		$filename = preg_replace('/^(.*?)(\.[^.]+)?$/', '${1}_'.date('YmdHis').'${2}', $filename);
		file_put_contents($tmp_dir.$filename, $content);
	}
}