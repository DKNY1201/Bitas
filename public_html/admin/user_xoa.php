<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['iduser']))
		$iduser=$_GET['iduser'];
	$i->XoaUser($iduser);
	header("location:index2.php?p=user_list");
?>