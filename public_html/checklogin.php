<?php

	session_start();

	if (isset($_SESSION['id'])== false){

		$_SESSION['error_admin']='Bạn chưa đăng nhập';

		$_SESSION['back']=$_SERVER['REQUEST_URI'];

		header('location:http://bitas.com.vn/user/dang-nhap/'); 

		exit();

	}

?>