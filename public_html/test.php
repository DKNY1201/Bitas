<?php
	session_start();
	require_once('db/db.php');
	$i = new db;
	$productIDArr = [1404,1403,1401,2418,2407];
	$a = $i->hasFemaleInBasket($productIDArr);
	if($a){
		echo "yes";
	}else{
		echo "no";
	}

	print_r($i->ConvertArrIndexToNonIndex($_SESSION['idPro']));
?>