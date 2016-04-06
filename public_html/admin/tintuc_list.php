<?php require_once "checklogin.php";
	if(isset($_GET['idLT']))
	{
		$idLT=$_GET['idLT'];
		$tin=$i->ListTinTucTheoLT($idLT);
	}
	else
		$tin=$i->ListTinTuc();
?>

<script>
$(document).ready(function(e) {
  $('#table').dataTable(
    {
      "sPaginationType": "full_numbers",
      "aaSorting" : [[0, 'desc']],
    }
  );
});
</script>
<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	<a class="btn-action btn-info" href="index.php?p=tintuc_them"><i class="fa fa-plus"></i> Thêm tin tức</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>STT</th>
    <th>Ngày đăng</th>
    <th>Ngày cập nhật</th>
    <th>Tiêu Đề</th>
    <th>Người tạo</th>
    <th width="80px">Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_tin=mysql_fetch_assoc($tin)){
	ob_start();  
  ?>
  <tr>
    <td>{idTin}</td>
    <td>{NgayDang}</td>
    <td>{NgayCapNhat}</td>
    <td><a href="index.php?p=tintuc_sua&idtin={idTin}">{TieuDe}</a></td>
    <td>{NguoiTao}</td>
    <td class="action">
    	<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    		<a class="fa fa-pencil-square-o" title="Chỉnh sửa" href="index.php?p=tintuc_sua&idtin={idTin}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){?>
        <a onclick="return confirm('Bạn muốn xóa tin tức {TieuDe}?')" class="fa fa-trash" title="Xóa" href="tintuc_xoa.php?idtin={idTin}"></a>
     	<?php } ?>   
     </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idTin}",$row_tin['idTin'],$str);
	$str=str_replace("{TieuDe}",$row_tin['TieuDe'],$str);
	$str=str_replace("{NgayDang}",date("d/m/Y H:i:s",strtotime($row_tin['NgayDang'])),$str);
	$str=str_replace("{NgayCapNhat}",date("d/m/Y H:i:s",strtotime($row_tin['NgayCapNhat'])),$str);
	$str=str_replace("{NguoiTao}",$row_tin['HoTen'],$str);
	echo $str;
  }
  ?>
</tbody>
</table>
