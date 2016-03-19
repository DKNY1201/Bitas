<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idnsp']))
		$idnsp=$_GET['idnsp'];
	$i->XoaNhomSP($idnsp);
	header("location:index2.php?p=nhomsp_list");
?>