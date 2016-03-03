<?php
	session_start();
	require_once('db/db.php');
	$i = new db;
	$listID=implode(",",$_SESSION['idPro']);

	$tongsl=0;
	$tongtien=0;
	$tongtiengiam=0;
	$sl_giamgia=0;
	$listID=implode(",",$_SESSION['idPro']);
	$sql="SELECT idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham WHERE idSP in ($listID)";
	$sp=mysql_query($sql) or die(mysql_error());
	while($row_sp=mysql_fetch_assoc($sp))
	{
		$idsp=$row_sp['idSP'];
		$soluong=$_SESSION['SoLuong'][$idsp];
		$dongia=$row_sp['Gia_vn'];
		$tien=$soluong*$dongia;
		$tongsl+=$soluong;
		$tongtien+=$tien;
		
		$giachuagiam=$row_sp['GiaChuaGiam_vn'];
		//PROMOTION
		if($dongia<$giachuagiam){
			$tiengiam=$soluong*$dongia;
			$tongtiengiam+=$tiengiam;
			$sl_giamgia+=$soluong;
		}
	}

	$listQuantity = implode(",",$_SESSION['SoLuong']);
	$discount = $i->CalcDiscountFor832016($listID,$listQuantity);
	echo $discount;
	$remain_total = $tongtien - $discount;
	echo number_format($remain_total,0,".",",");
?>