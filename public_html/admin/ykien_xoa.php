<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idyk']))
		$idyk=$_GET['idyk'];
	$i->XoaYKien($idyk);
	header("location:index.php?p=ykien_list_chuaduyet");
?>