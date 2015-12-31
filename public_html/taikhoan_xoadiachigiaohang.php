<?php

	if(isset($_GET['idAB'])&&$_GET['idAB']!="")

		$idAB=$_GET['idAB'];

	require_once "db/db.php";

	$i=new db;

	$i->delAddressBook($idAB);

	header("location:http://bitas.com.vn/user/tai-khoan/");

?>