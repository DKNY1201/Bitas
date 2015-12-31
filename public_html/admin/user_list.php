<?php require_once "checklogin.php";
	$us=$i->ListKhachHang();
?>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
<script>
	$(document).ready(function(e) {		
		//data table
		$('#table').dataTable({
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]]
		});
    });
</script>
<?php if($_SESSION['group']==1){ ?>
	<a class="addBtn" href="index.php?p=user_them">Thêm người dùng</a>
<?php }?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>idUser</th>
    <th>Email</th>
    <th>Họ tên</th>
    <th>Địa chỉ</th>
    <th>Điện thoại</th>
    <th>Ngày sinh</th>
    <th>Giới tính</th>
    <th>Phân quyền</th>
    <th>Quản lý</th>
  </tr>
</thead>
<tbody>
  <?php while($row_us=mysql_fetch_assoc($us)){
	ob_start();  
  ?>
  <tr>
    <td>{idUser}</td>
    <td>{Email}</td>
    <td>{HoTen}</td>
    <td>{DiaChi}, {QuanHuyen}, {TinhThanh}</td>
    <td>{DienThoai}</td>
    <td>{NgaySinh}</td>
    <td>{GioiTinh}</td>
    <td>{Group}</td>
    <td width="80px">
    	<a class="icon icon-note" title="Lịch sử mua hàng" href="index.php?p=user_lichsu&idUser={idUser}"></a>
        <?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	        <a class="icon icon-edit" title="Chỉnh sửa" href="index.php?p=user_sua&iduser={idUser}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){ ?>
        <a onclick="return confirm('Bạn muốn xóa người dùng {HoTen}?')" class="icon icon-del" title="Xóa" href="user_xoa.php?iduser={idUser}"></a>
        <?php } ?>
    </td>
  </tr>
  <?php $str=ob_get_clean();
	$tt=$i->ChiTietTinhThanh($row_us['idTinh']);
	$row_tt=mysql_fetch_assoc($tt);
	
	$qh=$i->ChiTietQuanHuyen($row_us['idQuanHuyen']);
	$row_qh=mysql_fetch_assoc($qh);
	
	$str=str_replace("{idUser}",$row_us['idUser'],$str);
	$str=str_replace("{Email}",$row_us['Email'],$str);
	$str=str_replace("{HoTen}",$row_us['HoTen'],$str);
	$str=str_replace("{DiaChi}",$row_us['DiaChi'],$str);
	$str=str_replace("{TinhThanh}",$row_tt['Ten'],$str);
	$str=str_replace("{QuanHuyen}",$row_qh['type']." ".$row_qh['Ten'],$str);
	$str=str_replace("{DienThoai}",$row_us['DienThoai'],$str);
	$str=str_replace("{NgaySinh}",date("d/m/Y",strtotime($row_us['NgaySinh'])),$str);
	$str=str_replace("{GioiTinh}",($row_us['GioiTinh']==1)?"Nam":"Nữ",$str);
	$str=str_replace("{Group}",$row_us['Ten'],$str);	
	echo $str;
  }
  ?>
</tbody>
</table>
