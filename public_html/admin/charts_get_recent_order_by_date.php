<?php
	require_once "../db/classAdmin.php";
	$i = new admin;
	$query = $i->ListOrderRecentByDay("20");
	$order = array();
	$i = 1;
	while($row = mysql_fetch_assoc($query)){
		array_push($order, [$i, $row['orderQuantity']]);
		$i++;
	}
	$order = array('orderByDate' => $order);
	echo json_encode($order);
?>