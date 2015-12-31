<?php
	session_start();
	require_once "db/db.php";
	$i=new db;
	$gtdh=$_GET['gtdh'];
	$idTT=$_GET['idTT'];
	$idQH=$_GET['idQH'];
	$cpvc=$i->ChiPhiVanChuyen($gtdh,$idTT,$idQH);
	
	$checkPA=$i->checkPromotionActive();
	if($checkPA){
		$activePromotion=$i->getPromotionActiveCode();
		$row_AP=mysql_fetch_assoc($activePromotion);
		$pro_code=$row_AP['code'];
		$promotion=$i->detailPromotion($pro_code);
		$row_promotion=mysql_fetch_assoc($promotion);
		$promotion_price=$row_promotion['conditionMoney'];
	}
	
	$tien=0;
	$tongtien=0;
	$listID=implode(",",$_SESSION['idPro']);
	$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size as Mau FROM sanpham,nhomsp WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP";
	$sp=mysql_query($sql) or die(mysql_error());
	while($row_sp=mysql_fetch_assoc($sp))
	{
		$idsp=$row_sp['idSP'];
		$soluong=$_SESSION['SoLuong'][$idsp];
		$dongia=$row_sp['Gia_vn'];
		$tien=$soluong*$dongia;
		$tongtien+=$tien;
		$giachuagiam=$row_sp['GiaChuaGiam_vn'];
	}
	
	
	if($pro_code == 'HAPPYHOUR' && (int)$tongtien > (int)$promotion_price){
		echo '0';
	}else{
		echo $cpvc;
	}
?>