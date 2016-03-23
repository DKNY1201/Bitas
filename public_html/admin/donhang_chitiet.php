<?php require_once "checklogin.php";
	if(isset($_GET['idDH']))
		$idDH=$_GET['idDH'];
	$dh=$i->ChiTietDonHang($idDH);
	$row_dh=mysql_fetch_assoc($dh);
	$idPTTT=$row_dh['idPTTT'];
	$pttt=$i->ChiTietPTTT($idPTTT);
	$row_pttt=mysql_fetch_assoc($pttt);
	$idDVVC=$row_dh['DVVC_DV'];
	if($idDVVC!=""){
		$dvvc=$i->ChiTietDVVC($idDVVC);
		$row_dvvc=mysql_fetch_assoc($dvvc);
	}
	$idKH=$row_dh['idKH'];
	$user=$i->ChiTietUser($idKH);
	$row_user=mysql_fetch_assoc($user);
	$idTinh_nm=$row_user['idTinh'];
	$tinh_nm=$i->ChiTietTinhThanh($idTinh_nm);
	$row_tinh_nm=mysql_fetch_assoc($tinh_nm);
	$idQH_nm=$row_user['idQuanHuyen'];
	$qh_nm=$i->ChiTietQuanHuyen($idQH_nm);
	$row_qh_nm=mysql_fetch_assoc($qh_nm);
	$idPX_nm=$row_user['idPhuong'];
	$px_nm=$i->ChiTietPhuong($idPX_nm);
	$row_px_nm=mysql_fetch_assoc($px_nm);
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
	$stt=$i->ListTinhTrang();
	//Check kho or sale
	$idTT=$row_dh['idTT'];
	$idGroup=$_SESSION['group'];
	if($idGroup==2){
		if($idTT==3||$idTT==4||$idTT==6){
			header("location:index.php?p=donhang_list");
		}
	}
	else if($idGroup==4){
		if($idTT==1||$idTT==2||$idTT==5||$idTT==7||$idTT==8||$idTT==9||$idTT==16){
			header("location:index.php?p=donhang_list");
		}
	}
	// end check kho or sale
	if(isset($_POST['btn-xacnhan'])){
		if($_POST['tinhtrang']==$idTT){
			header("location:index.php?p=donhang_chitiet&idDH=$idDH");
		}
		else{
			$i->ThayDoiTinhTrang($idDH);
			header("location:index.php?p=donhang_chitiet&idDH=$idDH");
		}
	}
	//Ghi chu Admin
	$isGhiChu_Admin=$row_dh['isGhiChu_Admin'];
	if(isset($_POST['submit-ghichu-admin'])){
		$i->CapNhatGhiChuAdmin($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	//Ghi chu Sale
	$isGhiChu_Sale=$row_dh['isGhiChu_Sale'];
	if(isset($_POST['submit-ghichu-sale'])){
		$i->CapNhatGhiChuSale($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	//Ghi chu Kho
	$isGhiChu_Kho=$row_dh['isGhiChu_Kho'];
	if(isset($_POST['submit-ghichu-kho'])){
		$i->CapNhatGhiChuKho($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	//Uu Tien
	$isUT=$row_dh['isUuTien'];
	if(isset($_POST['submit-uutien'])){
		$i->CapNhatUuTien($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	//Gap
	$isGap=$row_dh['isGap'];
	if(isset($_POST['submit-gap'])){
		$i->CapNhatGap($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	//YCKH
	$isYCKH=$row_dh['isYCKH'];
	if(isset($_POST['submit-yckh'])){
		$i->CapNhatYCKH($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	//CSKH
	if(isset($_POST['submit-cskh'])){
		$i->CapNhatCSKH($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	// HUY DON HANG
	if(isset($_POST['huydonhang'])){
		$i->HuyDonHang_SendEmail($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=$idDH");
	}
	$isPro=$i->checkOrderHasPromotion($idDH,$pro_code);
?>
<script>
	$(document).ready(function(e) {
		//change stt
        $("#stt").change(function(e) {
            var idStt=$(this).val();
			$("#load-by-stt").load("load-by-stt.php?idStt="+idStt, function() {
				$('#change-stt').validationEngine();
				$("#ngaygiaohang").datepicker({
					dateFormat: 'dd/mm/yy'	
				});
			});
        });
		//check ghi chu Admin
		function checkGhiChuAdmin(){
        	if(!$("input[name='ghichu-admin']").is(':checked'))
				$("textarea[name='ghichu-admin-lydo']").attr("disabled","disabled");
		}
		checkGhiChuAdmin();
		$("input[name='ghichu-admin']").click(function(e) {
        	if($(this).is(':checked')){
				$("textarea[name='ghichu-admin-lydo']").removeAttr("disabled");
			}
			else{
				$("textarea[name='ghichu-admin-lydo']").val('');
				$("textarea[name='ghichu-admin-lydo']").attr("disabled","disabled");
			}
        });
		//check ghi chu Sale
		function checkGhiChuSale(){
        	if(!$("input[name='ghichu-sale']").is(':checked'))
				$("textarea[name='ghichu-sale-lydo']").attr("disabled","disabled");
		}
		checkGhiChuSale();
		$("input[name='ghichu-sale']").click(function(e) {
        	if($(this).is(':checked')){
				$("textarea[name='ghichu-sale-lydo']").removeAttr("disabled");
			}
			else{
				$("textarea[name='ghichu-sale-lydo']").val('');
				$("textarea[name='ghichu-sale-lydo']").attr("disabled","disabled");
			}
        });
		//check ghi chu Kho
		function checkGhiChuKho(){
        	if(!$("input[name='ghichu-kho']").is(':checked'))
				$("textarea[name='ghichu-kho-lydo']").attr("disabled","disabled");
		}
		checkGhiChuKho();
		$("input[name='ghichu-kho']").click(function(e) {
        	if($(this).is(':checked')){
				$("textarea[name='ghichu-kho-lydo']").removeAttr("disabled");
			}
			else{
				$("textarea[name='ghichu-kho-lydo']").val('');
				$("textarea[name='ghichu-kho-lydo']").attr("disabled","disabled");
			}
        });
		//check Uu Tien
		function checkUuTien(){
        	if(!$("input[name='uutien']").is(':checked'))
				$("textarea[name='uutien-lydo']").attr("disabled","disabled");
		}
		checkUuTien();
		$("input[name='uutien']").click(function(e) {
        	if($(this).is(':checked')){
				$("textarea[name='uutien-lydo']").removeAttr("disabled");
			}
			else{
				$("textarea[name='uutien-lydo']").val('');
				$("textarea[name='uutien-lydo']").attr("disabled","disabled");
			}
        });
		//Check Gap
		function checkGap(){
        	if(!$("input[name='gap']").is(':checked'))
				$("textarea[name='gap-lydo']").attr("disabled","disabled");
		}
		checkGap();
		$("input[name='gap']").click(function(e) {
        	if($(this).is(':checked')){
				$("textarea[name='gap-lydo']").removeAttr("disabled");
			}
			else{
				$("textarea[name='gap-lydo']").val('');
				$("textarea[name='gap-lydo']").attr("disabled","disabled");
			}
        });
		//Check YCKH
		function checkYCKH(){
        	if(!$("input[name='yckh']").is(':checked'))
				$("textarea[name='yckh-lydo']").attr("disabled","disabled");
		}
		checkYCKH();
		$("input[name='yckh']").click(function(e) {
        	if($(this).is(':checked')){
				$("textarea[name='yckh-lydo']").removeAttr("disabled");
			}
			else{
				$("textarea[name='yckh-lydo']").val('');
				$("textarea[name='yckh-lydo']").attr("disabled","disabled");
			}
        });
		$('#adminForm').validationEngine();
		$(".button-des").click(function(e) {
			e.preventDefault();
            $(".huydonhang").slideToggle("fast");
        });
    });
</script>
<div class="order-detail">
	<div class="row-fluid">
		<div class="span6">
			<table class="tt-l tt" cellspacing="1">
				<thead>
			        <tr>
			            <th colspan="4">Thông tin khách hàng</th>
			        </tr>
			        <tr>
			            <th colspan="2">Người mua</td>
			            <th colspan="2">Người nhận</td>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			            <td class="td-index">Họ tên</td>
			            <td><?php echo $row_user['HoTen']?></td>
			            <td class="td-index">Họ tên</td>
			            <td><?php echo $row_dh['NguoiNhan']?></td>
			        </tr>
			        <tr>
			            <td class="td-index">Điện thoại</td>
			            <td><?php echo $row_user['DienThoai']?></td>
			            <td class="td-index">Điện thoại</td>
			            <td><?php echo $row_dh['DienThoai']?></td>
			        </tr>
			        <tr>
			            <td class="td-index">Email</td>
			            <td colspan="3"><?php echo $row_user['Email']?></td>
			        </tr>
			        <tr>
			            <td class="td-index">Địa chỉ</td>
			            <td><?php echo $row_user['DiaChi'].', '.$row_px_nm['type']." ".$row_px_nm['Ten'].', '.$row_qh_nm['type']." ".$row_qh_nm['Ten'].', '.$row_tinh_nm['Ten']?></td>
			            <td class="td-index">Địa chỉ</td>
			            <td><?php echo $row_dh['DiaChi'].', '.$row_px['type']." ".$row_px['Ten'].', '.$row_qh['type']." ".$row_qh['Ten'].', '.$row_tinh['Ten']?></td>
			        </tr>
			    </tbody>
			</table>
		</div>
		<div class="span6">
			<table class="tt-r tt" style="width: 100%;" cellspacing="1">
				<thead>
			        <tr>
			            <th colspan="4">Thông tin đơn hàng</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<tr>
			        	<td class="td-index">Mã ĐH</td>
			            <td><?php echo $row_dh['MaDH']?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Ngày đặt hàng</td>
			            <td><?php echo date("d/m/Y H:i:s",strtotime($row_dh['NgayDH']))?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Ngày giao hàng</td>
			            <td><?php echo ($row_dh['HoanTat_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['HoanTat_Ngay'])); ?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Thứ tự ĐH</td>
			            <td><?php echo substr($row_dh['MaDH'],-4,4)?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Phương thức thanh toán</td>
			            <td><?php echo $row_pttt['Ten']?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Đã thanh toán</td>
			            <td><?php if($row_dh['isPaid']==0) echo "Chưa thanh toán"; else echo "Đã thanh toán";?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Đơn vị vận chuyển</td>
			            <td><?php echo $row_dvvc['Ten']?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Kho</td>
			            <td><?php echo substr($row_dh['MaDH'],0,1)?></td>
			        </tr>
			        <tr>
			        	<td class="td-index">Ghi chú</td>
			            <td><?php echo $row_dh['GhiChu_KH']?></td>
			        </tr>
			        <?php if($row_dh['idTT']==19){?>
			            <tr>
			            	<td colspan="2"><strong style="text-transform:uppercase; color:#E74C3C;">Đang đợi hủy</strong></td>
			            </tr>
					<?php  } ?>
			    </tbody>
			</table>
		</div>
	</div>

	<div class="row-fluid list-product">
		<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
		<thead>
		  <tr>
		    <th>STT</th>
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
		  <?php $j=1;
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
		    <td><?php echo $j; ?></td>
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
			$j++;
			
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
		  /*===== PROMOTION =====*/
		  $thanhtoan=$i->TongGiaTriDonHang($idDH,$idTinh,$idQH,$idPTTT);
		  $saleoff = $i->PromotionSaleoffCalc($idDH);
		  ?>
		  <tr>
		  	<td>Tổng</td>
		  	<td colspan="3"></td>
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
		  	<td colspan="7"></td>
		    <td>Khuyến mãi</td>
		    <td><?php echo number_format($saleoff,0,".",",")?> VND</td>
		  </tr>
		  <tr>
		  	<td colspan="7"></td>
		    <td>Phí vận chuyển</td>
		    <td><?php echo number_format($phivanchuyen,0,".",",")?> VND</td>
		  </tr>
		   <tr>
		  	<td colspan="7"></td>
		    <td>Phí dịch vụ</td>
		    <td><?php echo number_format($phidichvu,0,".",",")?> VND</td>
		  </tr>
		  <tr>
		  	<td colspan="7"></td>
		    <td>Tổng tiền</td>
		    <td><?php echo $thanhtoan?> VND</td>
		  </tr>
		</tbody>
		</table>
	</div><!-- /.list-product -->
	<?php if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9){?>
	<div class="row-fluid">
		<div class="span12">
			<div class="print-button-cover">
				<a class="btn green" target="_blank" href="donhang_print.php?idDH=<?php echo $row_dh['idDH']?>">In đơn hàng</a>
			    <?php 
					if($row_dh['idTT']!=19&&$row_dh['idTT']!=9){
						if($_SESSION['group']==1 || $_SESSION['group']==8){
				?>
			    	
					<a class="button-des btn red" target="_blank" href="#">Yêu cầu hủy</a>
			    <?php }}?>
			    <?php
					if($_SESSION['group']==1 || $_SESSION['group']==8){
				?>
			    <a class="btn blue" href="index2.php?p=donhang_chinhsua&idDH=<?php echo $row_dh['idDH']?>">Chỉnh sửa đơn hàng</a>
			    <?php }?>
			</div>
			<div class="huydonhang">
				<form action="" method="post" id="adminForm">
			        <table class="them" width="500px" border="0" cellspacing="0" cellpadding="4">
			          <tr>
			            <td>Lý do hủy</td>
			            <td colspan="3">
			                <textarea name="lydo_huy" class="validate[required]" rows="5" cols="50"></textarea>
			            </td>
			          </tr>
			          <tr>
			            <td>&nbsp;</td>
			            <td colspan="3"><input type="submit" name="huydonhang" value="Yêu cầu hủy" class="btn red" /></td>
			          </tr>
			        </table>
			    </form>
			</div>
		</div>
	<?php }?>
	<?php if($_SESSION['group']==1||$_SESSION['group']==8||$_SESSION['group']==10){?>
	<div class="row-fluid">
		<div class="span12">
		<table class="tt" width="100%" cellspacing="0" cellpadding="4">
		    <thead>
		      <tr>
		        <th colspan="8">Công ty quản lý</th>
		      </tr>   
		    </thead>
		    <tbody>
		    	<tr>
			    	<td class="td-index">Kiểm tra tồn kho</td>
		    	    <td><?php echo ($row_dh['KTTK_Ngay']=="")?"Chưa":"Đã kiểm tra"?></td>
		            <td class="td-index">Ngày kiểm tra</td>
		    	    <td><?php echo ($row_dh['KTTK_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['KTTK_Ngay']))?></td>
		            <td class="td-index">MSNV</td>
		    	    <td colspan="3"><?php echo ($row_dh['KTTK_NV']=="")?"":$row_dh['KTTK_NV']?></td>
		        </tr>
		    	<tr>
			    	<td class="td-index">Xác nhận</td>
		    	    <td><?php echo ($row_dh['XacNhan_Ngay']=="")?"Chưa":"Hoàn tất"?></td>
		            <td class="td-index">Ngày xác nhận</td>
		    	    <td><?php echo ($row_dh['XacNhan_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['XacNhan_Ngay']))?></td>
		            <td class="td-index">MSNV</td>
		    	    <td colspan="3"><?php echo ($row_dh['XacNhan_NV']=="")?"":$row_dh['XacNhan_NV']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Chuyển tiếp</td>
		            <td><?php echo ($row_dh['ChuyenTiep_Ngay']=="")?"Chưa":substr($row_dh['MaDH'],0,1)?></td>
		            <td class="td-index">Ngày chuyển tiếp</td>
		    	    <td><?php echo ($row_dh['ChuyenTiep_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['ChuyenTiep_Ngay']))?></td>
		            <td class="td-index">MSNV</td>
		    	    <td colspan="3"><?php echo $row_dh['ChuyenTiep_NV']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Xuất kho</td>
		    	    <td><?php echo ($row_dh['XuatKho_Ngay']=="")?"Chưa":"Hoàn tất"?></td>
		            <td class="td-index">Ngày xuất kho</td>
		    	    <td><?php echo ($row_dh['XuatKho_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['XuatKho_Ngay']))?></td>
		            <td class="td-index">MSNV kho</td>
		    	    <td><?php echo $row_dh['XuatKho_NV']?></td>
		            <td class="td-index">Mã phiếu xuất kho</td>
		    	    <td><?php echo $row_dh['XuatKho_Ma']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Bàn giao ĐVVC 01</td>
		    	    <td><?php echo ($row_dvvc['Ten']=="")?"Chưa":$row_dvvc['Ten'];?></td>
		            <td class="td-index">Ngày bàn giao 01</td>
		    	    <td><?php echo ($row_dh['DVVC_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['DVVC_Ngay']))?></td>
		            <td class="td-index">MSNV kho</td>
		    	    <td><?php echo $row_dh['DVVC_NV']?></td>
		            <td class="td-index">Mã vận đơn</td>
		    	    <td><?php echo $row_dh['DVVC_Ma']?></td> 
		        </tr>
		        <tr>
			    	<td class="td-index">Chuyển hoàn</td>
		    	    <td><?php echo ($row_dh['HoanTra_Ngay']=="")?"Không":"Có"?></td>
		            <td class="td-index">Ngày chuyển hoàn</td>
		    	    <td><?php echo ($row_dh['HoanTra_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['HoanTra_Ngay']))?></td>
		            <td class="td-index">MSNV kho</td>
		    	    <td><?php echo $row_dh['HoanTra_NV']?></td>
		            <td class="td-index">Lý do hoàn trả</td>
		    	    <td><?php echo $row_dh['HoanTra_LyDo']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Nhập kho</td>
		    	    <td><?php echo ($row_dh['NhapKho_Ngay']=="")?"Chưa":"Hoàn tất"?></td>
		            <td class="td-index">Ngày nhập kho</td>
		    	    <td><?php echo ($row_dh['NhapKho_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['NhapKho_Ngay']))?></td>
		            <td class="td-index">MSNV kho</td>
		    	    <td colspan="3"><?php echo $row_dh['NhapKho_NV']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Hủy đơn hàng</td>
		    	    <td><?php echo ($row_dh['Huy_Ngay']=="")?"Không":"Có"?></td>
		            <td class="td-index">Ngày hủy đơn hàng</td>
		    	    <td><?php echo ($row_dh['Huy_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['Huy_Ngay']))?></td>
		            <td class="td-index">MSNV</td>
		    	    <td><?php echo $row_dh['Huy_NV']?></td>
		            <td class="td-index">Lý do hủy</td>
		    	    <td><?php echo $row_dh['Huy_LyDo']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Đơn hàng thành công</td>
		    	    <td><?php echo ($row_dh['HoanTat_Ngay']=="")?"Chưa":"Hoàn tất"?></td>
		            <td class="td-index">Ngày giao hàng</td>
		    	    <td><?php echo ($row_dh['HoanTat_Ngay']=="")?"":date("d/m/Y H:i:s",strtotime($row_dh['HoanTat_Ngay']))?></td>
		            <td class="td-index">MSNV</td>
		    	    <td colspan="4"><?php echo $row_dh['HoanTat_NV']?></td>
		        </tr>
		         <tr>
			    	<td class="td-index">Yêu cầu của khách hàng</td>
		            <td colspan="7"><?php echo $row_dh['YCKH']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Ưu tiên</td>
		            <td colspan="7"><?php echo $row_dh['UuTien']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Gấp</td>
		            <td colspan="7"><?php echo $row_dh['Gap']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Ghi chú của Admin</td>
		            <td colspan="7"><?php echo $row_dh['GhiChu_Admin']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Ghi chú của nhân viên Sale</td>
		            <td colspan="7"><?php echo $row_dh['GhiChu_Sale']?></td>
		        </tr>
		        <tr>
			    	<td class="td-index">Ghi chú của nhân viên Kho</td>
		            <td colspan="7"><?php echo $row_dh['GhiChu_Kho']?></td>
		        </tr>
			</tbody>
		</table>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="change-stt">
				<form method="post" action="" id="change-stt">
			    	<table border="0" align="center">
			            <tr>
			                <td>Thay đổi tình trạng</td>
			                <td>
			                    <select name="tinhtrang" id="stt">
			                    <?php switch($idTT){
										case 1:
											echo "<option value='1'>Chưa xác nhận</option><option value='16'>Kiểm tra tồn kho</option>";
											break;
										case 16:
											echo "<option value='16'>Kiểm tra tồn kho</option><option value='2'>Đã xác nhận</option>";
											break;
										case 2:
											echo "<option value='2'>Đã xác nhận</option><option value='3'>Chuyển tiếp</option>";
											break;
										case 3:
											echo "<option value='3'>Chuyển tiếp</option><option value='4'>Xuất kho</option>";
											break;
										case 4:
											echo "<option value='4'>Xuất kho</option><option value='5'>Bàn giao ĐVVC</option>";
											break;
										case 5:
											echo "<option value='5'>Bàn giao ĐVVC</option><option value='8'>Đã giao</option><option value='6'>Hoàn trả</option>";
											break;
										case 6:
											echo "<option value='6'>Hoàn trả</option><option value='7'>Nhập kho</option>";
											break;
										case 7:
											echo "<option value='7'>Nhập kho</option>";
											break;
										case 8:
											echo "<option value='8'>Đã giao</option>";
											break;
										case 9:
											echo "<option value='9'>Đã hủy</option>";
											break;
									}
								?>
			                    </select>
			                </td>
			                <td> <button class="btn blue" type="submit" tabindex="2" name="btn-xacnhan">OK</button></td>
			            </tr>
			            <tr>
			            	<td></td>
			                <td colspan="2">
			                	<div id="load-by-stt">
			                    </div>
			                </td>
			            </tr>
			        </table>
			    </form>
			</div>
		</div>
	<?php }?>
	<div class="row-fluid">
		<div class="span6">
			<div class="input-text">
			    <form action="" method="post">
			        <table width="100%" border="0" cellspacing="0">
			          <tr>
			            <td class="td-text-input">Yêu cầu KH</td>
			            <td>
			            <input type="checkbox" name="yckh" <?php if($isYCKH==1) echo "checked"; ?> /></td>
			          </tr>
			          <tr>
			            <td class="td-text-input">Yêu cầu</td>
			            <td>
			            	<textarea name="yckh-lydo"><?php echo $row_dh['YCKH']?></textarea>
			            </td>
			          </tr>
			          <tr>
			            <td></td>
			            <td>
			                <input type="submit" name="submit-yckh" value="OK" class="btn blue" />
			            </td>
			          </tr>
			        </table>
			    </form>
			</div>
		</div>
		<div class="span6">
			<div class="input-text">
			    <form action="" method="post">
			        <table width="100%" border="0" cellspacing="0">
			          <tr>
			            <td class="td-text-input">Ghi chú Sale</td>
			            <td>
			            <input type="checkbox" name="ghichu-sale" <?php if($isGhiChu_Sale==1) echo "checked"; ?> /></td>
			          </tr>
			          <tr>
			            <td class="td-text-input">Lý do</td>
			            <td>
			            	<textarea name="ghichu-sale-lydo"><?php echo $row_dh['GhiChu_Sale']?></textarea>
			            </td>
			          </tr>
			          <tr>
			            <td></td>
			            <td>
			                <input type="submit" name="submit-ghichu-sale" value="OK" class="btn blue" />
			            </td>
			          </tr>
			        </table>
			    </form>
			</div>
		</div>
	</div>
	<?php
		if($_SESSION['group']==1){
	?>
	<div class="row-fluid">
		<div class="span6">
			<div class="input-text">
			    <form action="" method="post">
			        <table width="100%" border="0" cellspacing="0">
			          <tr>
			            <td class="td-text-input">Ghi chú Admin</td>
			            <td>
			            <input type="checkbox" name="ghichu-admin" <?php if($isGhiChu_Admin==1) echo "checked"; ?> /></td>
			          </tr>
			          <tr>
			            <td class="td-text-input">Lý do</td>
			            <td>
			            	<textarea name="ghichu-admin-lydo"><?php echo $row_dh['GhiChu_Admin']?></textarea>
			            </td>
			          </tr>
			          <tr>
			            <td></td>
			            <td>
			                <input type="submit" name="submit-ghichu-admin" value="OK" class="btn blue" />
			            </td>
			          </tr>
			        </table>
			    </form>
			</div>
		</div>
	<?php } ?>
		<div class="span6">
			<div class="input-text">
			    <form action="" method="post">
			        <table width="100%" border="0" cellspacing="0">
			          <tr>
			            <td class="td-text-input">Ghi chú Kho</td>
			            <td>
			            <input type="checkbox" name="ghichu-kho" <?php if($isGhiChu_Kho==1) echo "checked"; ?> /></td>
			          </tr>
			          <tr>
			            <td class="td-text-input">Lý do</td>
			            <td>
			            	<textarea name="ghichu-kho-lydo"><?php echo $row_dh['GhiChu_Kho']?></textarea>
			            </td>
			          </tr>
			          <tr>
			            <td></td>
			            <td>
			                <input type="submit" name="submit-ghichu-kho" value="OK" class="btn blue" />
			            </td>
			          </tr>
			        </table>
			    </form>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="input-text">
				<form action="" method="post">
				    <table width="100%" border="0" cellspacing="0">
				      <tr>
				        <td class="td-text-input">Ưu tiên</td>
				        <td><input type="checkbox" name="uutien" <?php if($isUT==1) echo "checked"; ?> /></td>
				      </tr>
				      <tr>
				        <td class="td-text-input">Lý do</td>
				        <td>
				        	<textarea name="uutien-lydo"><?php echo $row_dh['UuTien']?></textarea>
				        </td>
				      </tr>
				      <tr>
				        <td></td>
				        <td>
				        	<input type="submit" name="submit-uutien" value="OK" class="btn blue" />
				        </td>
				      </tr>
				    </table>
				</form>
			</div>
		</div>
		<div class="span6">
			<div class="input-text">
			    <form action="" method="post">
			        <table width="100%" border="0" cellspacing="0">
			          <tr>
			            <td class="td-text-input">Gấp</td>
			            <td><input type="checkbox" name="gap" <?php if($isGap==1) echo "checked"; ?> /></td>
			          </tr>
			          <tr>
			            <td class="td-text-input">Lý do</td>
			            <td>
			            	<textarea name="gap-lydo"><?php echo $row_dh['Gap']?></textarea>
			            </td>
			          </tr>
			          <tr>
			            <td></td>
			            <td>
			                <input type="submit" name="submit-gap" value="OK" class="btn blue" />
			            </td>
			          </tr>
			        </table>
			    </form>
			</div>
		</div>
	</div>
	<div class="input-text">
	    <form action="" method="post">
	        <table width="100%" border="0" cellspacing="0">
	          <tr>
	            <td class="td-text-input">Số lần chăm sóc khách hàng</td>
	            <td><input class="txt" type="text" name="cskh" value="<?php echo $row_dh['CSKH']?>" /></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td>
	                <input type="submit" name="submit-cskh" value="OK" class="btn blue" />
	            </td>
	          </tr>
	        </table>
	    </form>
	</div>
	<div class="input-text">
	    <form action="" method="post">
	        <table width="100%" border="0" cellspacing="0">
	          <tr>
	            <td class="td-text-input">Ghi chú của Admin</td>
	            <td><?php echo $row_dh['GhiChu_Admin']?></td>
	          </tr>
	        </table>
	    </form>
	</div>
	<div class="clear"></div>
</div><!-- /.order-detail -->