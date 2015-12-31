<?php session_start();
	if (isset($_SESSION['id'])== false){
		$_SESSION['error_admin']='Bạn chưa đăng nhập';
		$_SESSION['back']=$_SERVER['REQUEST_URI'];
		header('location:login.php'); 
		exit();
	}
	else if ($_SESSION['group']!=1 && $_SESSION['group']!=2 && $_SESSION['group']!=4 && $_SESSION['group']!=5 && $_SESSION['group']!=6 && $_SESSION['group']!=7 && $_SESSION['group']!=8 && $_SESSION['group']!=9 && $_SESSION['group']!=10){
		$_SESSION['error_admin']='Bạn không có quyền xem trang này';
		$_SESSION['back']=$_SERVER['REQUEST_URI'];
		header('location:login.php');
		exit();
	}
?>
