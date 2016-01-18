<?php
	require_once "checklogin.php";
	require_once "dbconnect.php";

	$sql = "SELECT idSP, Ten, idNSP FROM sanpham";
	$re = mysql_query($sql) or die(mysql_error());
	while($sp = mysql_fetch_assoc($re)){
		$idSP = $sp['idSP'];
		$tenSP = $sp['Ten'];
		
		$idNSP = $sp['idNSP'];
		$sql = "SELECT SKU, idMau FROM nhomsp WHERE idNSP = $idNSP";
		$re1 = mysql_query($sql) or die(mysql_error());
		$nsp = mysql_fetch_assoc($re1);
		$maNSP = $nsp['SKU'];
		
		$idMau = $nsp['idMau'];
		$sql = "SELECT MaMau FROM mau WHERE idMau = $idMau";
		$re2 = mysql_query($sql) or die(mysql_error());
		$mau = mysql_fetch_assoc($re2);
		$maMau = $mau['MaMau'];

		$size = substr($tenSP, -2);

		$newTenSP = $maNSP.$maMau.$size;
		echo $tenSP . ' = ' . $newTenSP . '<br / >';

		$sql = "UPDATE sanpham SET Ten = '$newTenSP' WHERE idSP = $idSP";
		mysql_query($sql) or die(mysql_error());
	} 
?>