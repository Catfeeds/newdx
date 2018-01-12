<?php

//@require_once DISCUZ_ROOT . '/external/log.ext.php';
//@$obj_log = new Logext(DISCUZ_ROOT . '/logs', 'postreply_' . date('Y-m-d', time()), 'postreply_Log', 'oneFile', 'postreply.counter');
//@$_G['uid']==1&&$obj_log->logThis('-----------------------------------start--------' . date('Y-m-d H:i:s', time()) . '------------------------');

//$log = new Logext(ROOT_PATH . '/data/dlogs', 'app_log', 'App_Log', 'oneFile', 'App.counter');
//$log->logThis('username = ### act = ### spec1=sadfas p2= ### ku=3 time', 'line');
//$log->logThis('f:part');



class Logext {

	var $logDir = "";
	var $logFile = "";
	var $countFile = "";
	var $headerTitle = "";
	var $logMode = "";
	var $logNumber = "";

	function Logext($logDir = 'log', $logFile = 'log_', $headerTitle = 'LOG', $logMode = 'oneFile', $countFile = "counter") {
		$this->logDir = $logDir;
		$this->logFile = $logFile;
		if ($countFile) {
			$this->countFile = $this->logDir . "/$countFile";
		}
		$this->headerTitle = $headerTitle;
		$this->logMode = $logMode;

		$countFile = $this->countFile;
		$logDir = $this->logDir;

		if (!is_dir($logDir)) {
			if (mkdir($logDir) === false) {
				echo "Could not create log dir";
			}
		}

		if (file_exists($countFile) === false) {
			touch($countFile);

			$initNumber = 0;
			$fp = fopen($countFile, "a");
			if (fwrite($fp, $initNumber) === false) {
				echo "Could not write Counter file";
			}
			fclose($fp);
		}
		$logNumber = trim(file_get_contents($countFile));
		$logNumber++;
		$this->logNumber = $logNumber;

		$fp = fopen($countFile, "w+");
		if (fwrite($fp, $logNumber) === false) {
			echo "Could not write Counter file";
		}
		fclose($fp);
	}
	function writeLog($logString) {
		global $logNumber;

		if ($this->logMode == 'oneFilePerLog') {
			$logFile = $this->logDir . "/" . $this->logFile . $logNumber . '.log';
		} else {
			$logFile = $this->logDir . "/" . $this->logFile . '.log';
		}

		if (file_exists($logFile) === false) {
			touch($logFile);
			$logHeader = $this->headerTitle . "\n";
			$logHeader .= '--------------------------------------------------------------------' . "\n";
			$logHeader .= '--------------------------------------------------------------------' . "\n\n\n";

			$fp = fopen($logFile, "w+");
			if (fwrite($fp, $logHeader) === false) {
				echo "Could not write LOG Header";
			}
			fclose($fp);
		}
		$fp = fopen($logFile, "a");
		if (fwrite($fp, $logString) === false) {
			echo "Could not write to LOG file";
		}
		fclose($fp);
	}

	function logThis($string, $modifier = "empty") {
		global $logThisCounter;

		if (!isset($logThisCounter)) {
			$logThisCounter = 0;
		}

		$line = "\n" . '--------------------------------------------------------------------' . "\n";
		$part = "\n" . '********************************************************************' . "\n";

		if (substr($string, 0, 2) != 'f:') {
			$this->writeLog('+ LOG START: ' . $this->get_formatted_date() . "\n");
			$this->writeLog("\n");

			switch ($modifier) {
				case 'empty':
					$this->writeLog($string . "\n");
					break;
				case 'n':
					$this->writeLog($string . "\n");
					break;
				case '2n':
					$this->writeLog($string . "\n\n");
					break;
				case 'line':
					$this->writeLog($string . $line);
					break;
				case '2line':
					$this->writeLog($string . $line . $line);
					break;
				case 'nLine':
					$this->writeLog($string . "\n" . $line);
					break;
				case '2nLine':
					$this->writeLog($string . "\n\n" . $line);
					break;
				case 'n2Line':
					$this->writeLog($string . "\n" . $line . $line);
					break;
			}
		} else {
			switch ($string) {
				case 'f:line':
					$this->writeLog($line);
					break;
				case 'f:2line':
					$this->writeLog($line . $line);
					break;
				case 'f:part':
					$this->writeLog($part);
					break;
				case 'f:nl':
					$this->writeLog("\n");
					break;
				case 'f:2nl':
					$this->writeLog("\n\n");
					break;
				case 'f:logNumber':
					$this->writeLog('+ LOG Number: ' . $this->logNumber . "\n");
					break;
				case 'f:counter':
					switch ($modifier) {
						case 'empty':
							$logThisCounter++;
							$this->writeLog($logThisCounter);
							break;
						default:
							$logThisCounter++;
							$this->writeLog($modifier . $logThisCounter);
							break;
					}
					break;
				case 'f:counter.nl':
					switch ($modifier) {
						case 'empty':
							$logThisCounter++;
							$this->writeLog($logThisCounter . "\n");
							break;
						default:
							$logThisCounter++;
							$this->writeLog($modifier . $logThisCounter . "\n");
							break;
					}
					break;
				case 'f:nl.counter':
					switch ($modifier) {
						case 'empty':
							$logThisCounter++;
							$this->writeLog("\n" . $logThisCounter);
							break;
						default:
							$logThisCounter++;
							$this->writeLog("\n" . $modifier . $logThisCounter);
							break;
					}
					break;
				case 'f:nl.counter.nl':
					switch ($modifier) {
						case 'empty':
							$logThisCounter++;
							$this->writeLog("\n" . $logThisCounter . "\n");
							break;
						default:
							$logThisCounter++;
							$this->writeLog("\n" . $modifier . $logThisCounter . "\n");
							break;
					}
					break;
			}
		}
	}

	function get_formatted_date() {
		$fecha = date("Y-m-d H:i:s"). " " . floor(microtime() * 1000);;
		return $fecha;
	}

	function rmdirr($dirname) {
		if (!file_exists($dirname)) {
			return false;
		}
		if (is_file($dirname)) {
			return unlink($dirname);
		}
		if (is_dir($dirname)) {
			$dir = dir($dirname);
			while (false !== $entry = $dir->read()) {
				if ($entry == '.' || $entry == '..') {
					continue;
				}
				$this->rmdirr("$dirname/$entry");
			}
			$dir->close();
			return rmdir($dirname);
		}
	}
	function clean() {
		$this->rmdirr($this->logDir);
	}
}

?>