<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	$idSli = isset($_GET['idSlider']) ? $_GET['idSlider'] : "";
	if(empty($idSli)){
		header("location:index.php?p=slider_list");
	}
	$i->XoaSlider($idSli);
	header("location:index.php?p=slider_list");
?>