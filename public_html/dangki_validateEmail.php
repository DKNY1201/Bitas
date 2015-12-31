<?php
	require_once "db/db.php";
	$v=new db;
	$email=$_POST['email'];
	$e=$v->KTEmail($email);
	if($e==true)
		echo "1";
	else 
		echo "0";
?>