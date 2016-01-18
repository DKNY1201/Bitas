<?php
	require_once "checklogin.php";
	require_once "dbconnect.php";

	$sql = "SELECT idNSP, SKU FROM nhomsp";
	$re = mysql_query($sql) or die(mysql_error());
	while($nhomsp = mysql_fetch_assoc($re)){
		echo $nhomsp['idNSP'] . ' ==== ' . $nhomsp['SKU'] . ' ==== ';
		$idNSP = $nhomsp['idNSP'];
		$maSP = $nhomsp['SKU'];
		preg_match('/^\D*(?=\d)/', $maSP, $m);
		echo $m[0] . ' ==== ';
		$newMaSP = str_replace($m[0], $m[0] . '.', $maSP);
		echo $newMaSP . '<br />';
		$sql = "UPDATE nhomsp SET SKU = '$newMaSP' WHERE idNSP = $idNSP";
		mysql_query($sql) or die(mysql_error());
	} 
?>