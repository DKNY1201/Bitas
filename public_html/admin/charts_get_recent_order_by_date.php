<?php
	require_once "../db/classAdmin.php";
	$i = new admin;
	$order = array('orderByDate' => array([1,15],[2,15],[3,15],[4,25],[5,5],[6,15],[7,15],[8,15],[9,25],[10,5],[11,15],[12,15],[13,15],[14,25],[15,5],[16,15],[17,15],[18,15],[19,25],[20,55]));
	echo json_encode($order);
?>