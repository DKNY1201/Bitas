<?php
	session_start();
	require_once 'checklogin.php';
	if(isset($_GET['idNSP']))
		$idNSP=$_GET['idNSP'];
	require_once "dbconnect.php";
	$idUser=$_SESSION['id'];
	settype($idSP,"int");
	settype($idUser,"int");

	if(isset($_GET['act']))
		$act=$_GET['act'];
	if($act=='del'){
		$sql="DELETE FROM wishlist WHERE idUser=$idUser AND idNSP=$idNSP";
		mysql_query($sql) or die(mysql_error());
		if(isset($_GET['re'])&&$_GET['re']=='detail')
			header("location:products/detail/$idNSP/");
		else
			header("location:user/wish-list/");
	}
	elseif($act=='add'){
		$sql="SELECT * FROM wishlist WHERE idUser=$idUser AND idNSP=$idNSP";
		$kq=mysql_query($sql) or die(mysql_error());
		$row=mysql_num_rows($kq);
		if($row==0)
		{	
			$sql="INSERT INTO wishlist (idUser,idNSP) VALUES ($idUser,$idNSP)";
			mysql_query($sql) or die(mysql_error());
			header("location:products/detail/$idNSP/");
		}
		elseif($row==1)
		{
			header("location:products/detail/$idNSP/");
			exit();
		}
	}
?>