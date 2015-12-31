<?php
	require_once "db/db.php";
	$i = new db;
	$idTienThuong = (isset($_POST['idTienThuong']))?$_POST['idTienThuong']:0;
	$email = (isset($_POST['email']))?$_POST['email']:"quytran288@gmail.com";
	$i->UpdateTienThuong($idTienThuong,$email);
	$i->LuuQuaySo($idTienThuong,$email);
?>