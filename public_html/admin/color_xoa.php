<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idcl']))
		$idCL=$_GET['idcl'];
	$i->XoaColor($idCL);
	header("location:index.php?p=color_list");
?>