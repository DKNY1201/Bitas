<?php
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idtin']))
		$idtin=$_GET['idtin'];
	$i->XoaTin($idtin);
	header("location:index.php?p=tintuc_list");
?>