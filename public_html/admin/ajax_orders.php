<?php
	session_start();

	require_once "../db/classAdmin.php";
	$i=new admin;
	if($_SESSION['group']==1 || $_SESSION['group']==8  || $_SESSION['group']==9)
		$dh=$i->ListDonHang();
	elseif($_SESSION['group']==10)
	{
		$idKV=$i->LayIdKhuVucTuIdUser($_SESSION['id']);
		$dh=$i->LayDonHangTheoKhuVucVaCap($idKV);
	}
	// storing  request (ie, get/post) global array to a variable  
	$requestData = $_REQUEST;

	$idOrderStt = $requestData['idTT'];

$columns = array( 
// datatable column index  => database column name
	0 =>'idDH',
	1 => 'MaDH',
	2 => 'NgayDH',
	3 => 'isUuTien'
);

if(!empty($idOrderStt)){
	$totalData = $i->CountOrderByStatus($idOrderStt);
	$totalFiltered = $totalData;

	if( !empty($requestData['search']['value']) ) {
		// if there is a search parameter
		$keyword = $requestData['search']['value'];
		$totalFiltered = $i->SearchOrderCountByStatus($keyword,$idOrderStt);
		echo $totalFiltered;
		$query = $i->SearchOrderByStatus($keyword, $columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'],$idOrderStt);

	} else {	
		$query = $i->ListOrderByStatus($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length'],$idOrderStt);
	}
}else{
	// getting total number records without any search
	$totalData = $i->CountOrders();
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	if( !empty($requestData['search']['value']) ) {
		// if there is a search parameter
		$keyword = $requestData['search']['value'];
		$totalFiltered = $i->SearchOrderCount($keyword);
		echo $totalFiltered;
		$query = $i->SearchOrder($keyword, $columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);

	} else {	
		$query = $i->ListOrder($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
	}
}


$data = array();
while( $row=mysql_fetch_array($query) ) { // preparing an array
	$nestedData=array();

	$idDH = $row["idDH"];

	//Order status
	$idTT=$row['idTT'];
	$tt=$i->ChiTietTinhTrang($idTT);
	$row_tt=mysql_fetch_assoc($tt);

	// Quantity
	$quantity = $i->OrderQuantity($idDH);

	// Payment method
	$pttt=$i->ChiTietPTTT($row['idPTTT']);
	$row_pttt=mysql_fetch_assoc($pttt);

	// City
	$tinh=$i->ChiTietTinhThanh($row['idTinh']);
	$row_tinh=mysql_fetch_assoc($tinh);

	// District
	$qh=$i->ChiTietQuanHuyen($row['idQuanHuyen']);
	$row_qh=mysql_fetch_assoc($qh);

	// Total
	
	$orderTotal = $i->TongGiaTriDonHang($row['idDH'],$row['idTinh'],$row['idQuanHuyen'],$row_pttt['idPTTT']);

	// Control
	$isUT = $row["isUuTien"];
	$isGap = $row['isGap'];
	$isGC_Sale = $row['isGhiChu_Sale'];
	$isGC_Kho = $row['isGhiChu_Kho'];
	$classUT = ($isUT==1) ? 'icon-star-h' : 'icon-star';
	$classGap = ($isGap==1) ? 'icon-warning-h' : 'icon-warning';
	$classGC = ($isGC_Sale==1||$isGC_Kho==1) ? 'icon-note-h' : 'icon-note';
	$control = '';
	if($_SESSION['group']==1||$_SESSION['group']==10||$_SESSION['group']==11||$_SESSION['group']==12){
		$control .= ' <a class="icon ' . $classUT . '" title="Æ¯u tiÃªn"></a>';
		$control .= ' <a class="icon ' . $classGap . '" title="Gáº¥p"></a>';
		$control .= ' <a class="icon ' . $classGC . '" title="Ghi chÃº"></a>';
		if($row["DuocNhanQua"]==1){ 
			$control .= '<i class="fa fa-gift highlight"></i>';
		}
	}

	$nestedData[] = $idDH;
	$nestedData[] = date("d-m-Y H:i:s",strtotime($row['NgayDH']));
	$nestedData[] = '<a href="index.php?p=donhang_chitiet&idDH=' . $idDH .'" title="Chi tiáº¿t">' . $row["MaDH"] . '</a>';
	$nestedData[] = $row_tt['Ten'];
	$nestedData[] = $quantity;
	$nestedData[] = $orderTotal;
	$nestedData[] = $row_pttt['Ten'];
	$nestedData[] = $row['NguoiNhan'];
	$nestedData[] = $row_tinh['Ten'];
	$nestedData[] = $row_qh['type']." ".$row_qh['Ten'];
	$nestedData[] = $control;

	$data[] = $nestedData;
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>