<?php
	if (phpversion() < 5) {
		require_once ('firephp/fb.php4');
	} else {
		require_once ('firephp/fb.php');
	}
	ob_start();
?>