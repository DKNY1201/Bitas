<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idNSP']))
		$idnsp=$_GET['idNSP'];
	$i->XoaHinhZoom($idnsp);
	header("location:index.php?p=nhomsp_list");
?>