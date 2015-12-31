<?php
	ob_start();
	session_start();
	require_once('db/db.php');
	$z=new db;
	
	if(!isset($_SESSION['idPro'])) $_SESSION['idPro']=array();
	if(!isset($_SESSION['SoLuong'])) $_SESSION['SoLuong']=array();
	
	if(isset($_GET['idSP'])) {$idSP=$_GET['idSP']; $_SESSION['idTTMS']=$_GET['idSP'];}
	$action=$_GET['action'];
	$soluong=(isset($_GET['soluong'])==true)?$_GET['soluong']:1;
	
	if(isset($_GET['list_idSP'])) $list_idSP=$_GET['list_idSP'];
	if(isset($_GET['list_soluong'])) $list_sl=$_GET['list_soluong'];
	
	$format = ($_GET['format']) ? $_GET['format'] : '';
	
	settype($idSP,"int");
	settype($soluong,"int");
	if($soluong<=0)	$soluong=1;
	
	$act=array("add","remove","removeAll","update");
	if(in_array($action,$act)==false) exit();
	
	if($action=="removeAll"){
		unset($_SESSION['idPro']);
		unset($_SESSION['SoLuong']);
		header("location:home.bitas");
	}
	
	if($action=="remove"){
		if($idSP<=0) die("Không lấy được idSP");
		unset($_SESSION['idPro'][$idSP]);
		unset($_SESSION['SoLuong'][$idSP]);
		header("location:gio-hang/tong-quan/");
	}
	
	if($action=="add"){
		if($idSP<=0) die("Không lấy được idSP");
		$_SESSION['idPro'][$idSP]=$idSP;
		$_SESSION['SoLuong'][$idSP]+=$soluong;
		
		require_once "minicart.php";
		if(!$format){
			header("location:gio-hang/tong-quan/");
		}
	}
	
	if($action=="update"){
		$_SESSION['SoLuong'][$idSP]=$soluong;
		
		/*
		$id_array=explode(",",$list_idSP);
		$sl_array=explode(",",$list_sl);
		for($i=0;$i<count($id_array);$i++)
		{
			$idSP=$id_array[$i];	
			if($sl_array[$i]<1)
				$sl_array[$i]=1;
			$_SESSION['SoLuong'][$id_array[$i]]=$sl_array[$i];
		}
		*/
		header("location:gio-hang/tong-quan/");
	}
?>