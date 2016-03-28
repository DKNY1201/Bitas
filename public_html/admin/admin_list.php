<?php 
  require_once "checklogin.php";
	$us=$i->ListAdmin();
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
	<a class="btn-action btn-info" href="index2.php?p=user_them"><i class="fa fa-plus"></i> Thêm tai khoan Admin</a>
<?php }?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Ngay Tao</th>
    <th>Email dang nhap</th>
    <th>Ho Ten</th>
    <th>Nhom nguoi dung</th>
    <th>Dang nhap gan nhat</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_us=mysql_fetch_assoc($us)){
	ob_start();  
  ?>
  <tr>
    <td>{idUser}</td>
    <td>{NgayDangKi}</td>
    <td>{Email}</td>
    <td>{HoTen}</td>
    <td>{Role}</td>
    <td>{LastLoginDate}</td>
    <td width="80px">
        <?php if($_SESSION['group']==1){ ?>
	        <a class="fa fa-pencil-square-o" title="Chỉnh sửa" href="index2.php?p=user_sua&iduser={idUser}"></a>
          <a onclick="return confirm('Bạn muốn xóa người dùng {HoTen}?')" class="fa fa-trash" title="Xóa" href="user_xoa.php?iduser={idUser}"></a>
        <?php } ?>
    </td>
  </tr>
  <?php 
    $str=ob_get_clean();
    $ngaydangki = date("d-m-Y H:i:s",strtotime($row_us['NgayDangKi']));
    $lastlogindate = $row_us['LastLoginDate']!='0000-00-00 00:00:00' ? date("d-m-Y H:i:s",strtotime($row_us['LastLoginDate'])) : "Chua dang nhap";
  	$str=str_replace("{idUser}",$row_us['idUser'],$str);
  	$str=str_replace("{Email}",$row_us['Email'],$str);
  	$str=str_replace("{HoTen}",$row_us['HoTen'],$str);
  	$str=str_replace("{NgayDangKi}",$ngaydangki,$str);
  	$str=str_replace("{Role}",$row_us['Ten'],$str);
    $str=str_replace("{LastLoginDate}",$lastlogindate,$str);
  	echo $str;
    }
  ?>
</tbody>
</table>
