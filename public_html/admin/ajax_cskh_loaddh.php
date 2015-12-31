<?php
	if(isset($_GET['info'])&&$_GET['info']!="")
		$info=$_GET['info'];
	if(isset($_GET['by'])&&$_GET['by']!="")
		$by=$_GET['by'];
	require_once "../db/classAdmin.php";
	$i=new admin;
	$dh=$i->CSKH_TimKiemDonHang($info,$by);
?>
<table id="table" class="display" width="100%" cellspacing="0">
<thead>
  <tr>
  	<!--<th>Thứ tự</th>-->
    <th>Mã ĐH</th>
    <th>Họ tên</th>
    <th>Email</th>
    <th>Điện thoại</th>
    <th>Địa chỉ</th>
    <th>Ngày ĐH</th>
    <th>Ngày GH</th>    
    <th>Giá trị ĐH</th>    
    <th>PTTT</th>
    <th>Tình trạng</th>
  </tr>
</thead>
<tbody>
  <?php while($row_dh=mysql_fetch_assoc($dh)){
	$idUs=$row_dh['idKH'];
	$e=$i->LayEmailTheoID($idUs);
	$row_e=mysql_fetch_assoc($e);
	
	$idTT=$row_dh['idTT'];
	$tt=$i->ChiTietTinhTrang($idTT);
	$row_tt=mysql_fetch_assoc($tt);
	
	$idQH=$row_dh['idQuanHuyen'];
	$qh=$i->ChiTietQuanHuyen($idQH);
	$row_qh=mysql_fetch_assoc($qh);
	
	$idPX=$row_dh['idPhuong'];
	$px=$i->ChiTietPhuong($idPX);
	$row_px=mysql_fetch_assoc($px);
	ob_start();  
  ?>
  <tr>
  	<!--<td>{idDH}</td>-->
    <td><a href="index.php?p=donhang_chitiet&idDH={idDH}">{MaDH}</a></td>
    <td>{HoTen}</td>
    <td>{Email}</td>
    <td>{DienThoai}</td>
    <td>{DiaChi}, {Phuong}, {QuanHuyen}, {TinhThanh}</td>
    <td>{NgayDH}</td>
    <td>{NgayGH}</td>
    <td>{GiaTriDH} VNĐ</td>
    <td>{PTTT}</td>
    <td>{TinhTrang}</td>
  </tr>
  <?php
  	$str=ob_get_clean();
	$tinh=$i->ChiTietTinhThanh($row_dh['idTinh']);
	$row_tinh=mysql_fetch_assoc($tinh);
	$pttt=$i->ChiTietPTTT($row_dh['idPTTT']);
	$row_pttt=mysql_fetch_assoc($pttt);
	
	$gtdh=$i->TongGiaTriDH($row_dh['idDH']);
	
	$str=str_replace("{idDH}",$row_dh['idDH'],$str);
	$str=str_replace("{MaDH}",$row_dh['MaDH'],$str);
	$str=str_replace("{HoTen}",$row_dh['NguoiNhan'],$str);
	$str=str_replace("{Email}",$row_e['Email'],$str);
	$str=str_replace("{DienThoai}",$row_dh['DienThoai'],$str);
	$str=str_replace("{DiaChi}",$row_dh['DiaChi'],$str);
	$str=str_replace("{TinhThanh}",$row_tinh['Ten'],$str);
	$str=str_replace("{QuanHuyen}",$row_qh['type']." ".$row_qh['Ten'],$str);
	$str=str_replace("{Phuong}",$row_px['type']." ".$row_px['Ten'],$str);
	$str=str_replace("{NgayDH}",date("d/m/Y H:i:s",strtotime($row_dh['NgayDH'])),$str);
	$str=str_replace("{NgayGH}",($row_dh['HoanTat_Ngay']=="")?"Chưa giao":date("d/m/Y",strtotime($row_dh['HoanTat_Ngay'])),$str);
	$str=str_replace("{GiaTriDH}",number_format($gtdh,0,'.',','),$str);	
	$str=str_replace("{PTTT}",$row_pttt['Ten'],$str);
	$str=str_replace("{TinhTrang}",$row_tt['Ten'],$str);
	echo $str;
  }
  ?>
</tbody>
</table>