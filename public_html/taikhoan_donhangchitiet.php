<?php 
	if(isset($_GET['idDH']))
		$idDH=$_GET['idDH'];
	$dhct=$i->DonHangChiTiet($idDH);
	$dh=$i->ChiTietDonHang($idDH);
	$row_dh=mysql_fetch_assoc($dh);
	$idPTTT=$row_dh['idPTTT'];
	$pttt=$i->ChiTietPTTT($idPTTT);
	$row_pttt=mysql_fetch_assoc($pttt);
	$idTinh=$row_dh['idTinh'];
	$tt=$i->ChiTietTinhThanh($idTinh);
	$row_tt=mysql_fetch_assoc($tt);
	$idQH=$row_dh['idQuanHuyen'];
	$qh=$i->ChiTietQuanHuyen($idQH);
	$row_qh=mysql_fetch_assoc($qh);
	$u=$i->ChiTietUser($_SESSION['email']);
	$row_u=mysql_fetch_assoc($u);
	$idUser=$row_u['idUser'];
	$ktdh=$i->KiemTraDHTheoUser($idUser);
	$arr_dh=array();
	$j=0;
	while($row_ktdh=mysql_fetch_assoc($ktdh)){
		$arr_dh[$j]=$row_ktdh['idDH'];
		$j++;
	}
	if(in_array($idDH,$arr_dh)==false)
		header("location:http://bitas.com.vn/user/tai-khoan/");
?>
<h1 class="title page_title">{Order_Detail}</h1>
<div id="thongtingiaohang">
	<h3>{Info_Delivery}</h3>
    <p><strong>{Fullname}:</strong> <?php echo $row_dh['NguoiNhan']?></p>
    <p><strong>{Tel}:</strong> <?php echo $row_dh['DienThoai']?></p>
    <p><strong>{Address}:</strong> <?php echo $row_dh['DiaChi']?>, <?php echo $row_qh['type']." ".$row_qh['Ten']?>, <?php echo $row_tt['Ten']?></p>
    <p><strong>{Howtopay}:</strong> <?php echo $row_pttt['Ten']?></p>
    <p><strong>Đơn hàng này</strong> <?php echo ($row_dh['isPaid']==1)?" đã thanh toán.":" chưa thanh toán."?></p>
    <p><strong>Ghi chú:</strong> <?php echo $row_dh['GhiChu_KH']?></p>
</div>
<h3>Các sản phẩm đã đặt hàng của đơn hàng <span style="font-size:24px; color:#e74c3c"><?php echo $row_dh['MaDH']?></span></h3>
<div class="table-responsive">
    <table id="donhang" width="100%" cellpadding="4px" cellspacing="0" class="table">
        <tr>
            <th>{Product_Name}</th>
            <th>{Price}</th>
            <th>{Amount}</th>
            <th>{Cash}</th>
        </tr>
        <?php $tongtien=0;
         while($row_dhct=mysql_fetch_assoc($dhct)) {
            $gia=$row_dhct['Gia'];
            $sl=$row_dhct['SoLuong'];
            $thanhtien=$gia*$sl;
            $tongtien+=$thanhtien;
            $idSP=$row_dhct['idSP'];
            $sp=$i->LayNSPTuSP($idSP);
            $row_sp=mysql_fetch_assoc($sp);
        ?>
        <tr>
            <td>
                <img src="<?php echo $row_sp['Hinh']?>" alt="<?php echo $row_sp['TenSP']?>" width="100px" />
                <p><strong>{Product_Name}:</strong> <?php echo $row_sp['TenSP']?></p>
                <p><strong>{Size}:</strong> <?php echo $row_sp['Size']?></p>
            </td>
            <td><?php echo number_format($gia,0,".",",")?> VND</td>
            <td><?php echo $sl?></td>
            <td><?php echo number_format($thanhtien,0,".",",")?> VND</td>
        </tr>
        <?php }
            $tongtien=$i->TongGiaTriDonHang_ChuaChiPhi($idDH);
			if($row_dh['proCode'] != "HAPPYHOUR"){
				$cpvc=$i->ChiPhiVanChuyen($tongtien,$idTinh,$idQH);
			}else{
				$cpvc = 0;
			}
            
            $tongtien+=$cpvc;
            $pdv=$i->PhiDichVu($tongtien,$idPTTT);
            /*===== PROMOTION =====*/
            $tongtien=$i->TongGiaTriDonHang($idDH,$idTinh,$idQH,$idPTTT);
            $saleoff = $i->PromotionSaleoffCalc($idDH);
        ?>
        <tr>
            <td colspan="3"></td>
            <td><strong>Khuyến mãi:</strong> <?php echo number_format($saleoff,0,".",",")?> VND</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td><strong>Chi phí vận chuyển:</strong> <?php echo number_format($cpvc,0,".",",")?> VND</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td><strong>Phí dịch vụ:</strong> <?php echo number_format($pdv,0,".",",")?> VND</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td><strong>Tổng tiền: <span style="color:#e74c3c; font-size:16px;"><?php echo $tongtien?> VND</span></strong></td>
        </tr>
    </table>
</div>