<?php
	session_start();
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(!empty($_POST['idNSP'])){
		$idNSP = $_POST['idNSP'];
	}
	if(!empty($_POST['text'])){
		$text = $_POST['text'];
	}
	$anhien=$i->updateAnHien($idNSP,$text);
	if($anhien==1)
		echo '{"success":1}';
	else
		echo '{"error":1}';
?>