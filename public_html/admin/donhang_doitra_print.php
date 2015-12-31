<?php
	require_once "checklogin.php";
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
	
	$dhct_dt=$i->DonHangChiTiet_Doi($idDH);
	
	$dhct=$i->DonHangChiTiet_DoiTra($idDH);
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
			
			#print{
				border:none;
				border-radius:3px;
				cursor:pointer;
			}
			
			#print:hover{
				background:#d12918;
			}
			
			.td-print{
				font-weight:bold;
				background:#ccc;
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
				text-align:left;
			}
			
			.tt-print th{
				padding-left:10px;
				background:#222;
				color:#fff;
				text-shadow:none;
			}
			
			.wrapper{
				width:1000px;
				margin:0 auto;
				position:relativel
			}
			
			.wrapper header{
				height:140px;
				padding:0 0 30px;
				margin-bottom:10px;
				border-bottom:3px solid #000;
				overflow:hidden;
			}
			
			.wrapper header .website-link{
				float:right;
				margin-top:97px;
				font-style:italic;
				font-size:20px;
				font-weight:bold;
			}
			
			.wrapper header .logo{
				float:left;
			}
			
			.wrapper header .title-print{
				float:left;
				margin:85px 0 0 200px;
			}
			
			.wrapper .content{
				font-size:16px;
			}
			
			.wrapper .content .content-top{
				height:110px;
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
				width:300px;
				margin:30px auto;
				font-size:16px;
				font-style:italic;
				text-align:center;
			}
	</style>
</head>
<body>
	<div class="wrapper">
        <header>
        	<img class="logo" src="../img/logo150.png" alt="Bita's online" />
            <h1 class="title-print">PHIẾU GIAO HÀNG</h1>
        	<div class="website-link">www.bitas.com.vn</div>
        </header>
        <div class="content">
        	<section class="content-top">
            	<section class="info">
                	<h3>CÔNG TY TNHH SẢN XUẤT HÀNG TIÊU DÙNG BÌNH TÂN</h3>
                    <p>1016A Hương Lộ 2, P.Bình Trị Đông A, Q.Bình Tân, TP.HCM, Việt Nam</p>
                    <p>Điện thoại: 08 37540284 - 37507703</p>
                    <p>Fax: 08 37541449</p>
                    <p>Email: ttmd_bt@bitas.com.vn</p>
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
                                <td><?php echo date("d/m/Y",strtotime($row_dh['HoanTat_Ngay']))?></td>
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
                  <?php
                  while($row_dhct=mysql_fetch_assoc($dhct)){
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
                  <tr>
                    <td>{SP}</td>
                    <td>{Mau}</td>
                    <td>{Size}</td>
                    <td>{SL}</td>
                    <td>{Gia} VNĐ</td>
                    <td>{TongCong} VNĐ</td>
                    <td>{KhuyenMai}%</td>
                    <td>{ThanhTien} VNĐ</td>
                  </tr>
                  <?php
                    $str=ob_get_clean();
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
                  $phivanchuyen=($row_dh['DVVC2_BenChiu']==1)?0:$row_dh['DVVC2_ChiPhi'];
                  $thanhtoan=$tongtien+$phivanchuyen;
                  ?>
                  <tr>
                    <td colspan="6"></td>
                    <td class="td-index">Tổng</td>
                    <td><?php echo number_format($tongtien,0,".",",")?> VNĐ</td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                    <td class="td-index">Phí vận chuyển</td>
                    <td><?php echo number_format($phivanchuyen,0,".",",")?> VNĐ</td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                    <td class="td-index">Tổng tiền</td>
                    <td class="td-index"><?php echo number_format($thanhtoan,0,".",",")?> VNĐ</td>
                  </tr>
                </tbody>
            </table>
        </div>
        
        <div class="thanhtoan" style="margin:20px 0; font-size:14px; display:block; padding-bottom:40px">
        	<h1 style="display:block; width:50%; float:left">Đã thanh toán: 
				<?php 
					while($row_dhct_dt=mysql_fetch_assoc($dhct_dt)){
						$dathanhtoan+=$row_dhct_dt['Gia']*$row_dhct_dt['SoLuong'];
					}
					$conlai=$thanhtoan-$dathanhtoan;
					echo number_format($dathanhtoan,0,".",",")." VND";
				?> 
            </h1>
            <h1 style="display:block; width:50%; float:left; text-align:right">Còn lại: 
				<?php 
					echo number_format($conlai,0,".",",")." VND";
				?>  
            </h1>
        </div>
        <div class="print-button-cover">
	        <button id="print" class="button-print" onClick="window.print()">In đơn hàng</button>
        </div>
        <div class="ghichu">
        	<p>Đổi lại hàng trong 7 ngày cùng hóa đơn mua hàng. Hàng giảm giá miễn đổi lại. Không hoàn trả lại tiền mặt.</p>
            <p>Exchange within 7 days with the receipt. No refund No exchange and refund for sale items.</p>
            <p><?php echo date("d/m/Y",strtotime("now"))?></p>
        </div>
    </div>    
</body>
</html>