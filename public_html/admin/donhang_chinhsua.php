<?php require_once "checklogin.php";
	if(isset($_GET['idDH']))
		$idDH=$_GET['idDH'];
	$dh=$i->ChiTietDonHang($idDH);
	$row_dh=mysql_fetch_assoc($dh);
	$dhct=$i->DonHangChiTiet($idDH);
?>
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
    <th>Hành động</th>
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
    <td>
    	<a class="icon icon-edit" title="Chỉnh sửa" href="index.php?p=donhang_chinhsua_edit&idDHCT={idDHCT}"></a>
        <a onclick="return confirm('Bạn muốn xóa màu {SP}?')" class="icon icon-del" title="Xóa" href="donhang_chinhsua_del.php?idDHCT={idDHCT}"></a>
    </td>
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
	$str=str_replace("{idDHCT}",$row_dhct['idDHCT'],$str);
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
  ?>
</tbody>
</table>
<a href="index.php?p=donhang_chinhsua_add&idDH=<?php echo $idDH; ?>" class="addBtn">Thêm sản phẩm</a>
