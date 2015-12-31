<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idkm']))
		$idkm=$_GET['idkm'];
	$i->XoaKhuyenMai($idkm);
	header("location:index.php?p=khuyenmai_list");
?>