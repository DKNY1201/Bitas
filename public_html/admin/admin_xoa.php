<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idadmin']))
		$idadmin=$_GET['idadmin'];
	$i->XoaUser($idadmin);
	header("location:index.php?p=admin_list");
?>