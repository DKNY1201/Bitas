<?php require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['idDH']))
		$idDH=$_GET['idDH'];
	$dh=$i->ChiTietDonHang($idDH);
	$row_dh=mysql_fetch_assoc($dh);
	$idPTTT=$row_dh['idPTTT'];
	$pttt=$i->ChiTietPTTT($idPTTT);
	$row_pttt=mysql_fetch_assoc($pttt);
	$idKH=$row_dh['idKH'];
	$user=$i->ChiTietUser($idKH);
	$row_user=mysql_fetch_assoc($user);
	$idTinh=$row_dh['idTinh'];
	$tinh=$i->ChiTietTinhThanh($idTinh);
	$row_tinh=mysql_fetch_assoc($tinh);
	$idQH=$row_dh['idQuanHuyen'];
	$qh=$i->ChiTietQuanHuyen($idQH);
	$row_qh=mysql_fetch_assoc($qh);
	$idPX=$row_dh['idPhuong'];
	$px=$i->ChiTietPhuong($idPX);
	$row_px=mysql_fetch_assoc($px);
	$dhct=$i->DonHangChiTiet($idDH);
?>
<!DOCTYPE html>
<html lang="vn">
<head>
	<meta charset="UTF-8">
	<title>In đơn hàng - <?php echo $row_dh['MaDH']?></title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <style>
		/*=====PRINTER=====*/
			@media print {
				#print {
					display :  none;
				}
			}
			body{
				font-family:Arial, Helvetica, sans-serif;
			}
			#print{
				border:none;
				border-radius:3px;
				cursor:pointer;
			}
			#print:hover{
				background:#d12918;
			}
			table {
				border-width: 2px 2px 2px 0;
				border-style: solid solid solid none;
				border-color: #bdbec0;
				border-image: none;
				border-collapse: separate;
			}
			table th {
				border-left: 2px solid #bdbec0;
				padding: 5px 0;
				font-weight: normal;
				font-weight: bold;
				background: none;
			}
			table td {
				border-left: 2px solid #bdbec0;
				padding: 8px;
				line-height: 18px;
				vertical-align: middle;
				border-top: 2px solid #bdbec0;
				text-align: center;
			}	
			.date table {
				border-width: 2px 2px 2px 0;
				border-style: solid solid solid none;
				border-color: #000;
				border-image: none;
				border-collapse: separate;
			}
			.date table th {
				border-left: 2px solid #000;
				padding: 5px 0;
				font-weight: normal;
				font-weight: bold;
				background: none;
			}
			.date table td {
				border-left: 2px solid #000;
				padding: 8px;
				line-height: 18px;
				vertical-align: middle;
				border-top: 2px solid #000;
				text-align: center;
			}
			.td-print{
				font-weight:bold;
				background:none;
				width:180px;
			}
			.tb-print{
				margin:30px 0;
				border-top:none;
			}
			.tb-print td{
				text-align:left;
			}
			.tt-print th,.tt-print td{
				text-align:center;
			}
			.tt-print th{
				padding-left:10px;
				color:#fff;
				text-shadow:none;
				color:#000;
				text-align:center;
			}
			tr.loop td{
				text-align: center;
			}
			.wrapper{
				width:1000px;
				margin:0 auto;
				position:relativel
			}
			.wrapper header{
				padding: 0 0 3px;
				margin-bottom: 10px;
				overflow: hidden;
				margin-top: 67px;
			}
			.wrapper header .website-link{
				float: right;
				margin-top: 91px;
				font-size: 21px;
				font-weight: bold;
				margin-right: 42px;
			}
			.wrapper header .logo{
				float: left;
				margin-left: 39px;
			}
			.wrapper header .title-print{
				float:left;
				margin:85px 0 0 200px;
			}
			.wrapper .content{
				font-size:16px;
				padding: 0 40px;
			}
			.wrapper .content h3{
				font-size: 21px;
			}
			.wrapper .content p{
				margin: 8px 0 0;
				font-size: 17px;
			}
			.wrapper .content .content-top{
				overflow:hidden;
			}
			.wrapper .content .info{
				float:left;
			}
			.wrapper .content info h3{
				font-size:14px;
			}
			.wrapper .content .content-top .date{
				float:right;
			}
			.wrapper .content .content-top .date th{
				padding:5px 10px;
			}
			.ghichu{
				width:100%;
				margin:100px auto 0;
				text-align:center;
			}
			.title{
				display:block;
				width: 1000px;
				height: 80px;
				margin-top: 6px;
			}
			.td-index{
				text-align: right !important;
			}
	</style>
</head>
<body>
	<div class="wrapper">
        <header>
        	<div class="logo-link">
                <img class="logo" src="../img/admin/logo-giaohang.png" alt="Bita's online" />
                <div class="website-link">www.bitas.com.vn</div>
            </div>
            <div class="clear"></div>
            <img class="title" src="../img/admin/phieu-giao-hang.jpg" title="Phiếu giao hàng" alt="phieu giao hang bitas.com.vn" />
        </header>
		<div class="clear"></div>
        <div class="content">
        	<section class="content-top">
            	<section class="info">
                	<h3>CÔNG TY TNHH SẢN XUẤT HÀNG TIÊU DÙNG BÌNH TÂN</h3>
                    <p>1016A Hương Lộ 2, P.Bình Trị Đông A, Q.Bình Tân, TP.HCM, Việt Nam</p>
                    <p>Điện thoại: 083 754 3954 - 3754 3611</p>
                    <p>Fax: 08 37541449</p>
                    <p>Email: cskh@bitas.com.vn</p>
                </section>
                <section class="date">
                	<table border="0" cellspacing="0" cellpadding="5px">
                    	<thead>
                            <tr>
                                <th>Ngày đặt hàng</th>
                                <th>Ngày giao hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo date("d/m/Y",strtotime($row_dh['NgayDH']))?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
            <table class="tb-print" width="100%" border="0" cellspacing="0" cellpadding="4">
                <tr>
                    <td class="td-print">Mã đơn hàng</td>
                    <td><?php echo $row_dh['MaDH']?></td>
                    <td class="td-print">Phương thức thanh toán</td>
                    <td><?php echo $row_pttt['Ten']?></td>
                </tr>
                <tr>
                    <td class="td-print">Người đặt hàng</td>
                    <td><?php echo $row_user['HoTen']?></td>
                    <td class="td-print">Điện thoại người đặt</td>
                    <td><?php echo $row_user['DienThoai']?></td>
                </tr>
                <tr>
                    <td class="td-print">Người nhận</td>
                    <td><?php echo $row_dh['NguoiNhan']?></td>
                    <td class="td-print">Điện thoại người nhận</td>
                    <td><?php echo $row_dh['DienThoai']?></td>
                </tr>
                <tr>
                    <td class="td-print">Địa chỉ</td>
                    <td colspan="3"><?php echo $row_dh['DiaChi'].', '.$row_px['type'].' '.$row_px['Ten'].', '.$row_qh['type'].' '.$row_qh['Ten'].', '.$row_tinh['Ten']?></td>
                </tr>
                <tr>
                    <td class="td-print">Ghi chú</td>
                    <td colspan="3"><?php echo $row_dh['GhiChu_KH']?></td>
                </tr>
                <tr>
                    <td class="td-print">Kho</td>
                    <td colspan="3"><?php echo substr($row_dh['MaDH'],0,1)?></td>
                </tr>
            </table>
            <table class="tt-print" width="100%" border="0" cellspacing="0" cellpadding="4">
            	<thead>
                  <tr>
                    <th>Sản phẩm</th>
                    <th>Màu</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng cộng</th>
                    <th>Khuyến mãi</th>
                    <th>Thành tiền</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($row_dhct=mysql_fetch_assoc($dhct)){
                      $idSP=$row_dhct['idSP'];
                      $sp=$i->ChiTietSP($idSP);
                      $row_sp=mysql_fetch_assoc($sp);
                      $idNSP=$row_sp['idNSP'];
                      $nsp=$i->ChiTietNhomSP($idNSP);
                      $row_nsp=mysql_fetch_assoc($nsp);
                      $idMau=$row_nsp['idMau'];
                      $mau=$i->ChiTietMau($idMau);
                      $row_mau=mysql_fetch_assoc($mau);
                      ob_start();
                  ?>
                  <tr class="loop">
                    <td>{SP}</td>
                    <td>{Mau}</td>
                    <td>{Size}</td>
                    <td>{SL}</td>
                    <td>{Gia} VNĐ</td>
                    <td>{TongCong} VNĐ</td>
                    <td>{KhuyenMai}%</td>
                    <td>{ThanhTien} VNĐ</td>
                  </tr>
                  <?php $str=ob_get_clean();
                    $soluong=$row_dhct['SoLuong'];
                    if($row_dhct['GiaChuaGiam']>$row_dhct['Gia'])
                        $gia=$row_dhct['GiaChuaGiam'];
                    else $gia=$row_dhct['Gia'];
                    $tongcong=$soluong*$gia;
                    $giachuagiam=$row_dhct['GiaChuaGiam'];
                    $khuyenmai=100-round(($row_dhct['Gia']/$giachuagiam)*100,2);
                    $thanhtien=$tongcong*($row_dhct['Gia']/$giachuagiam);
                    $tongtien+=$thanhtien;
                    $str=str_replace("{SP}",$row_sp['Ten'],$str);
                    $str=str_replace("{SL}",$soluong,$str);
                    $str=str_replace("{Mau}",$row_mau['Ten_vn'],$str);
                    $str=str_replace("{Size}",$row_sp['Size'],$str);
                    $str=str_replace("{Gia}",number_format($gia,0,".",","),$str);
                    $str=str_replace("{TongCong}",number_format($tongcong,0,".",","),$str);
                    $str=str_replace("{KhuyenMai}",$khuyenmai,$str);
                    $str=str_replace("{ThanhTien}",number_format($thanhtien,0,".",","),$str);
                    echo $str;
                  }
				  $tongtien_pro=$i->TongGiaTriDonHang_ChuaChiPhi($idDH);
				  if($row_dh['proCode'] != "HAPPYHOUR"){
						$phivanchuyen=$row_dh['TongCPVC'];
					}else{
						$phivanchuyen = 0;
					}
				  $thanhtoan=$tongtien_pro+$phivanchuyen;
				  $phidichvu=$i->PhiDichVu($thanhtoan,$idPTTT);
				  $thanhtoan+=$phidichvu;
                  $thanhtoan=$tongtien+$phivanchuyen;
				  /*===== PROMOTION =====*/
				  $thanhtoan=$i->TongGiaTriDonHang($idDH,$idTinh,$idQH,$idPTTT);
				  $saleoff = $i->PromotionSaleoffCalc($idDH);
				  ?>
                  <tr>
                    <td>Tổng</td>
                    <td colspan="2"></td>
                    <td>
                        <?php
                            $dhct=$i->DonHangChiTiet($idDH);
                            $tongsoluong = 0;
                            while($row_dhct=mysql_fetch_assoc($dhct)){
                                $soluong = $row_dhct['SoLuong'];
                                $tongsoluong += $soluong;
                            }
                            echo $tongsoluong;
                        ?>
                    </td>
                    <td colspan="3"></td>
                    <td><?php echo number_format($tongtien,0,".",",")?> VND</td>
                  </tr>
                  <tr>
                    <td class="td-index" colspan="7">Khuyến mãi</td>
                    <td><?php echo number_format($saleoff,0,".",",")?> VNĐ</td>
                  </tr>
                  <tr>
                    <td class="td-index" colspan="7">Phí vận chuyển</td>
                    <td><?php echo number_format($phivanchuyen,0,".",",")?> VNĐ</td>
                  </tr>
                  <tr>
                    <td class="td-index" colspan="7">Phí dịch vụ</td>
                    <td><?php echo number_format($phidichvu,0,".",",")?> VNĐ</td>
                  </tr>
                  <tr>
                    <td class="td-index" colspan="7">Tổng tiền</td>
                    <td><strong><?php echo $thanhtoan?> VNĐ</strong></td>
                  </tr>
                </tbody>
            </table>
        </div>
        <div class="thanhtoan" style="margin:20px 0; font-size:14px; display:block; padding: 0 40px 40px">
        	<h1 style="display:block; width:50%; float:left">Đã thanh toán: 
				<?php if($row_dh['idPTTT']!=1){
						if($row_dh['isPaid']==1)
							$dathanhtoan=$thanhtoan;
						else
							$dathanhtoan=0;
					}
					else
						$dathanhtoan=0;
					echo $dathanhtoan." VND";
				?> 
            </h1>
            <h1 style="display:block; width:50%; float:left; text-align:right">Còn lại: 
				<?php if($dathanhtoan==0)
						$conlai=$thanhtoan;
					else
						$conlai=0;
					echo $conlai." VND";
				?>  
            </h1>
        </div>
        <div class="print-button-cover">
	        <button id="print" class="button-print" onClick="window.print()">In đơn hàng</button>
        </div>
        <!--
        <div class="ghichu">
        	<img src="../img/admin/order-bottom-text.jpg" />
        </div>
        -->
    </div>    
</body>
</html>