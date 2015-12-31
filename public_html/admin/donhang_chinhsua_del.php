<?php 
	require_once "checklogin.php";
	if(isset($_GET['idDHCT'])){
		require_once "../db/classAdmin.php";
		$i=new admin;
		$idDHCT=$_GET['idDHCT'];
		$dhct = $i->ChiTietDonHangChiTiet($idDHCT);
		$row_dhct = mysql_fetch_assoc($dhct);
		$i->DelDHCT($idDHCT);
		header("location:index.php?p=donhang_chitiet&idDH=".$row_dhct['idDH']);
	}else{
		header("location:index.php");
	}
?>