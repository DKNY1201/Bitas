<?php
	session_start();
	require_once "../db/classAdmin.php";
	$i=new admin;
	$i->WriteLog($_SESSION['id'],"Đăng xuất");
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	unset($_SESSION['group']);
	unset($_SESSION['hoten']);
	unset($_SESSION['gioitinh']);
	unset($_SESSION['dienthoai']);
	unset($_SESSION['diachi']);
	unset($_SESSION['tinhthanh']);
	unset($_SESSION['quanhuyen']);
	unset($_SESSION['phuong']);
	unset($_SESSION['ngaysinh']);
	header("location:index.php");
?>