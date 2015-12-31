<?php
	require_once "db/db.php";
	$i=new db;
	$tongtien=$_GET['tongtien'];
	$pttt=$_GET['pttt'];
	$pdv=$i->PhiDichVu($tongtien,$pttt);
	echo $pdv;
?>