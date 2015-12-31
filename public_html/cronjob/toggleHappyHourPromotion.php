<?php
	require_once "dbconnect.php";
	$sql = "UPDATE promotion SET active = !active WHERE code = 'HAPPYHOUR'";
	mysql_query($sql) or die(mysql_error());
?>