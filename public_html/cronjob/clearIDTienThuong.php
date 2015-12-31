<?php
	require_once "dbconnect.php";
	$sql = "UPDATE user SET idTienThuong = 0";
	mysql_query($sql) or die(mysql_error());
?>