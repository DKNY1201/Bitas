<?php
	session_start();
	require_once('db/db.php');
	$i = new db;
	$idDH = 3923;
	$dhct=$i->DonHangChiTiet($idDH);
	$tongtien=0;
	$listID = "";
	$listQuantity = "";
	while($row_dhct=mysql_fetch_assoc($dhct)){
		$idsp=$row_dhct['idSP'];
		$soluong=$row_dhct['SoLuong'];
		$listID .= $idsp . ",";
		$listQuantity .= $soluong . ",";
		$dongia=$row_dhct['Gia'];
		$tien=$soluong*$dongia;
		$tongtien+=$tien;
	}
	$listID = trim($listID,",");
	$listQuantity = trim($listQuantity,",");
	echo $listID . '===' . $listQuantity . '<br />';
	$discount = $i->CalcDiscountFor832016($listID,$listQuantity);
	echo $discount;
	$remain_total = $tongtien - $discount;
	echo number_format($remain_total,0,".",",");
?>