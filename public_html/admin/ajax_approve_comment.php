<?php
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(!empty($_POST['idYK'])){
		$idYK = $_POST['idYK'];
	}
	$yk=$i->ApproveComment($idYK);
	if($yk==1)
		echo '{"success":1}';
	else
		echo '{"error":1}';
?>