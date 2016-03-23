<?php if(isset($_GET['idUser']))
		$idUser=$_GET['idUser'];
	$user=$i->ChiTietUser($idUser);
	$row_user=mysql_fetch_assoc($user);
	
	$idTinh_nm=$row_user['idTinh'];
	$tinh_nm=$i->ChiTietTinhThanh($idTinh_nm);
	$row_tinh_nm=mysql_fetch_assoc($tinh_nm);
	$idQH_nm=$row_user['idQuanHuyen'];
	$qh_nm=$i->ChiTietQuanHuyen($idQH_nm);
	$row_qh_nm=mysql_fetch_assoc($qh_nm);
	
	$dh=$i->ListDonHangTheoUser($idUser);
?>
<table class="tt-l tt" width="100%" cellspacing="1">
	<thead>
        <tr>
            <th colspan="2">Thông tin khách hàng</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="td-index">Họ tên</td>
            <td><?php echo $row_user['HoTen']?></td>
        </tr>
        <tr>
            <td class="td-index">Email</td>
            <td colspan="3"><?php echo $row_user['Email']?></td>
        </tr>
        <tr>
            <td class="td-index">Địa chỉ</td>
            <td><?php echo $row_user['DiaChi'].', '.$row_qh_nm['type']." ".$row_qh_nm['Ten'].', '.$row_tinh_nm['Ten']?></td>
        </tr>
        <tr>
            <td class="td-index">Điện thoại</td>
            <td><?php echo $row_user['DienThoai']?></td>
        </tr>
        <tr>
            <td class="td-index">Giới tính</td>
            <td><?php echo ($row_user['GioiTinh']==1)?"Nam":"Nữ";?></td>
        </tr>
        <tr>
            <td class="td-index">Tuổi</td>
            <td>
				<?php $now=date(strtotime("now"));
					$ngaysinh=date(strtotime($row_user['NgaySinh']));
					$tuoi_sogiay=$now-$ngaysinh;
					$tuoi_sonam=floor($tuoi_sogiay/31536000);
					echo $tuoi_sonam;
				?>
            </td>
        </tr>
    </tbody>
</table>

<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Mã ĐH</th>
    <th>Ngày ĐH</th>
    <th>Giờ ĐH</th>
    <th>Họ tên</th>
    <th>Điện thoại</th>
    <th>Địa chỉ</th>
    <th>Ngày GH</th>    
    <th>Giá trị ĐH</th>    
    <th>PTTT</th>
    <th>Tình trạng</th>
    <th width="80px">Quản lý</th>
  </tr>
</thead>
<tbody>

  <?php 
  if(mysql_num_rows($dh)){
      while($row_dh=mysql_fetch_assoc($dh)){
    	$idUs=$row_dh['idKH'];
    	$e=$i->LayEmailTheoID($idUs);
    	$row_e=mysql_fetch_assoc($e);
    	
    	$idTT=$row_dh['idTT'];
    	$tt=$i->ChiTietTinhTrang($idTT);
    	$row_tt=mysql_fetch_assoc($tt);
    	
    	$idQH=$row_dh['idQuanHuyen'];
    	$qh=$i->ChiTietQuanHuyen($idQH);
    	$row_qh=mysql_fetch_assoc($qh);
    	
    	$isUT=$row_dh['isUuTien'];
    	$isGap=$row_dh['isGap'];
    	$isGC_Sale=$row_dh['isGhiChu_Sale'];
    	$isGC_Kho=$row_dh['isGhiChu_Kho'];
    	ob_start();  
  ?>
  <tr>
    <td><a class="action" href="index.php?p=donhang_chitiet&idDH={idDH}">{MaDH}</a></td>
    <td>{NgayDH}</td>
    <td>{GioDH}</td>
    <td>{HoTen}</td>
    <td>{DienThoai}</td>
    <td>{DiaChi}, {QuanHuyen}, {TinhThanh}</td>
    <td>{NgayGH}</td>
    <td>{GiaTriDH} VNĐ</td>
    <td>{PTTT}</td>
    <td>{TinhTrang}</td>
    <td>
    	<a class="icon icon-detail" href="index.php?p=donhang_chitiet&idDH={idDH}" title="Chi tiết"></a>
        <?php if($_SESSION['group']==1||$_SESSION['group']==2){?>
        <a class="icon <?php echo ($isUT==1)?'icon-star-h':'icon-star'; ?>" title="Ưu tiên"></a> 
        <a class="icon <?php echo ($isGap==1)?'icon-warning-h':'icon-warning'; ?>" title="Gấp"></a> 
        <a class="icon <?php echo ($isGC_Sale==1||$isGC_Kho==1)?'icon-note-h':'icon-note'; ?>" title="Ghi chú"></a></td>
        <?php }?>
  </tr>
      <?php $str=ob_get_clean();
    	$tinh=$i->ChiTietTinhThanh($row_dh['idTinh']);
    	$row_tinh=mysql_fetch_assoc($tinh);
    	$pttt=$i->ChiTietPTTT($row_dh['idPTTT']);
    	$row_pttt=mysql_fetch_assoc($pttt);
    	
    	$gtdh=$i->TongGiaTriDH($row_dh['idDH']);
    	
    	$str=str_replace("{idDH}",$row_dh['idDH'],$str);
    	$str=str_replace("{MaDH}",$row_dh['MaDH'],$str);
    	$str=str_replace("{HoTen}",$row_dh['NguoiNhan'],$str);
    	$str=str_replace("{DienThoai}",$row_dh['DienThoai'],$str);
    	$str=str_replace("{DiaChi}",$row_dh['DiaChi'],$str);
    	$str=str_replace("{TinhThanh}",$row_tinh['Ten'],$str);
    	$str=str_replace("{QuanHuyen}",$row_qh['type']." ".$row_qh['Ten'],$str);
    	$str=str_replace("{NgayDH}",date("d/m/Y",strtotime($row_dh['NgayDH'])),$str);
    	$str=str_replace("{GioDH}",date("H:i:s",strtotime($row_dh['NgayDH'])),$str);
    	$str=str_replace("{NgayGH}",($row_dh['HoanTat_Ngay']=="")?"Chưa giao":date("d/m/Y",strtotime($row_dh['HoanTat_Ngay'])),$str);
    	$str=str_replace("{GiaTriDH}",number_format($gtdh,0,'.',','),$str);	
    	$str=str_replace("{PTTT}",$row_pttt['MaPTTT'],$str);
    	$str=str_replace("{TinhTrang}",$row_tt['Ten'],$str);
    	echo $str;
      }
    }else{
  ?>
    <tr>
        <td colspan="11">Chưa có đơn hàng nào của khách hàng này!!!</td>
      </tr>
  <?php
    }
   ?>
</tbody>
</table>