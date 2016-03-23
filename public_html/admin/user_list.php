<?php 
  require_once "checklogin.php";
	$us=$i->ListKhachHang();
?>
<script>
	$(document).ready(function(e) {		
		//data table
		$('#table').dataTable({
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
      "aaSorting" : [[0, 'desc']],
		});
  });
</script>
<?php if($_SESSION['group']==1){ ?>
	<a class="btn-action btn-info" href="index2.php?p=user_them"><i class="fa fa-plus"></i> Thêm người dùng</a>
<?php }?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Họ tên</th>
    <th>Giới tính</th>
    <th>Tuổi</th>
    <th>Email</th>    
    <th>Điện thoại</th>
    <th>Địa chỉ</th>
    <th>Tỉnh thành</th>
    <th>Quận huyện</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_us=mysql_fetch_assoc($us)){
	ob_start();  
  ?>
  <tr>
    <td>{idUser}</td>
    <td>{HoTen}</td>
    <td>{GioiTinh}</td>
    <td>{Tuoi}</td>
    <td>{Email}</td>
    <td>{DienThoai}</td>
    <td>{DiaChi}</td>
    <td>{TinhThanh}</td>
    <td>{QuanHuyen}</td>
    <td width="80px">
    	<a class="fa fa-history" title="Lịch sử mua hàng" href="index2.php?p=user_lichsu&idUser={idUser}"></a>
        <?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	        <a class="fa fa-pencil-square-o" title="Chỉnh sửa" href="index2.php?p=user_sua&iduser={idUser}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){ ?>
        <a onclick="return confirm('Bạn muốn xóa người dùng {HoTen}?')" class="fa fa-trash" title="Xóa" href="user_xoa.php?iduser={idUser}"></a>
        <?php } ?>
    </td>
  </tr>
  <?php $str=ob_get_clean();
	$tt=$i->ChiTietTinhThanh($row_us['idTinh']);
	$row_tt=mysql_fetch_assoc($tt);
	
	$qh=$i->ChiTietQuanHuyen($row_us['idQuanHuyen']);
	$row_qh=mysql_fetch_assoc($qh);
	
  $birthdate = strtotime($row_us['NgaySinh']);
  $today = strtotime('Now');
  $diffInSec = abs($today - $birthdate);
  $age = floor($diffInSec / (365*60*60*24));

	$str=str_replace("{idUser}",$row_us['idUser'],$str);
	$str=str_replace("{Email}",$row_us['Email'],$str);
	$str=str_replace("{HoTen}",$row_us['HoTen'],$str);
	$str=str_replace("{DiaChi}",$row_us['DiaChi'],$str);
	$str=str_replace("{TinhThanh}",$row_tt['Ten'],$str);
	$str=str_replace("{QuanHuyen}",$row_qh['type']." ".$row_qh['Ten'],$str);
	$str=str_replace("{DienThoai}",$row_us['DienThoai'],$str);
	$str=str_replace("{Tuoi}",$age,$str);
	$str=str_replace("{GioiTinh}",($row_us['GioiTinh']==1)?"Nam":"Nữ",$str);
	$str=str_replace("{Group}",$row_us['Ten'],$str);	
	echo $str;
  }
  ?>
</tbody>
</table>
