<?php
	session_start();
	if($_COOKIE["keep_me"]){
	    $keep_me = $_COOKIE["keep_me"];
	} elseif($_SESSION["keep_me"]){
	    $keep_me = $_SESSION["keep_me"];
	}
	$time= time()-60*60*24*30;
	setcookie("keep_me", $keep_me, $time, "/", ".".$_SERVER["HTTP_HOST"]);
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
	unset($_SESSION['keep_me']);
	header("location:home.php");
?>