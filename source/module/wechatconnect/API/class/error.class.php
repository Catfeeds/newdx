<?php
class Error {
	
	public function file_not_exist($file_path) {
		error_log($file_path . ' does not exist! ');
		exit('Related file can NOT be found!');
	}
}