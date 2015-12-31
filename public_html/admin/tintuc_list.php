<?php require_once "checklogin.php";
	if(isset($_GET['idLT']))
	{
		$idLT=$_GET['idLT'];
		$tin=$i->ListTinTucTheoLT($idLT);
	}
	else
		$tin=$i->ListTinTuc();
?>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
<script>
	$(document).ready(function(e) {
        $('input[name=checkall]').click(function(e) {
            var stt=this.checked;
			$('input[name=check]').each(function(index, element) {
                this.checked=stt;
            });
        });
		
		//data table
		$('#table').dataTable(
			{"sPaginationType": "full_numbers"}
		);
    });
</script>
<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	<a class="addBtn" href="index.php?p=tintuc_them">Thêm tin tức</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th><input type="checkbox" name="checkall"></th>
    <th>idTin</th>
    <th>Tiêu Đề</th>
    <th>Hình</th>
    <th>Ngày đăng/<br />cập nhật</th>
    <th>Loại tin</th>
    <th>Người tạo</th>
    <th>Ngôn ngữ</th>
    <th>Số Lần Xem/<br />Thứ tự</th>
    <th>Ẩn hiện</th>
    <th width="80px">Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_tin=mysql_fetch_assoc($tin)){
	ob_start();  
  ?>
  <tr>
  	<td><input type="checkbox" name="check"></td>
    <td>{idTin}</td>
    <td>{TieuDe}</td>
    <td>{Hinh}</td>
    <td>{NgayDang}<br />{NgayCapNhat}</td>
    <td><a class="action" href="index.php?p=tintuc_list&idLT={idLT}">{LoaiTin}</a></td>
    <td>{NguoiTao}</td>
    <td>{NgonNgu}</td>
    <td>{SLX}<br />{ThuTu}</td>
    <td>{AnHien}</td>
    <td>
    	<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    		<a class="icon icon-edit" title="Chỉnh sửa" href="index.php?p=tintuc_sua&idtin={idTin}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){?>
        <a onclick="return confirm('Bạn muốn xóa tin tức {TieuDe}?')" class="icon icon-del" title="Xóa" href="tintuc_xoa.php?idtin={idTin}"></a>
     	<?php } ?>   
     </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idTin}",$row_tin['idTin'],$str);
	$str=str_replace("{TieuDe}",$row_tin['TieuDe'],$str);
	$str=str_replace("{Hinh}","<img width='120px' src='$row_tin[Hinh]' alt='Giày Bitas' title='$row_tin[TieuDe]' />",$str);
	$str=str_replace("{NgayDang}",date("d/m/Y H:i:s",strtotime($row_tin['NgayDang'])),$str);
	$str=str_replace("{NgayCapNhat}",date("d/m/Y H:i:s",strtotime($row_tin['NgayCapNhat'])),$str);
	$str=str_replace("{LoaiTin}",$row_tin['Ten'],$str);
	$str=str_replace("{idLT}",$row_tin['idLT'],$str);
	$str=str_replace("{NguoiTao}",$row_tin['HoTen'],$str);
	$str=str_replace("{NgonNgu}",$row_tin['Lang'],$str);
	$str=str_replace("{SLX}",$row_tin['SoLanXem'],$str);
	$str=str_replace("{ThuTu}",$row_tin['ThuTu'],$str);
	$str=str_replace("{AnHien}",($row_tin['AnHien']==1)?"Đang hiện":"Đang ẩn",$str);	
	echo $str;
  }
  ?>
</tbody>
</table>
