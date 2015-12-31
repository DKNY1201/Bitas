<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idsp']))
		$idsp=$_GET['idsp'];
	$i->XoaSanPham($idsp);
	header("location:index.php?p=sanpham_list");
?>