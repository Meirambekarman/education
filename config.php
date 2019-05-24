<?php
    $user = 'loft';
		$pass = 'salamat12345';
		$data = 'education';
	
		$db = mysql_connect('localhost', $user, $pass, $data);
	
		mysql_select_db($data, $db);
		mysql_set_charset("utf8");
?>