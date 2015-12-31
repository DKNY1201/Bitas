<?php require_once "checklogin.php";
	$km=$i->ListKhuyenMai();
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
<a class="addBtn" href="index.php?p=khuyenmai_them">Thêm khuyến mãi</a>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th><input type="checkbox" name="checkall"></th>
    <th>idKM</th>
    <th>Tên</th>
    <th>Tóm tắt</th>
    <th>Ngày bắt đầu/<br />kết thúc</th>    
    <th>Nội dung</th>
    <th>Hình</th>
    <th>Thứ tự</th>
    <th>Ẩn hiện</th>
    <th width="80px">Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_km=mysql_fetch_assoc($km)){
	ob_start();  
  ?>
  <tr>
  	<td><input type="checkbox" name="check"></td>
    <td>{idKM}</td>
    <td>{Ten}</td>
    <td>{TomTat}</td>
    <td>{NgayBatDau}<br />{NgayKetThuc}</td>
    <td>{NoiDung}</td>
    <td>{Hinh}</td>
    <td>{ThuTu}</td>
    <td>{AnHien}</td>
    <td><a class="icon icon-edit" title="Chỉnh sửa" href="index.php?p=khuyenmai_sua&idkm={idKM}"></a> <a onclick="return confirm('Bạn muốn xóa chương trình khuyến mãi {Ten}?')" class="icon icon-del" title="Xóa" href="khuyenmai_xoa.php?idkm={idKM}"></a></td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idKM}",$row_km['idKM'],$str);
	$str=str_replace("{Ten}",$row_km['Ten'],$str);
	$str=str_replace("{TomTat}",$i->rutgonchuoi($row_km['TomTat'],10),$str);
	$str=str_replace("{NgayBatDau}",date("d/m/Y H:i:s",strtotime($row_km['NgayBatDau'])),$str);
	$str=str_replace("{NgayKetThuc}",date("d/m/Y H:i:s",strtotime($row_km['NgayKetThuc'])),$str);
	$str=str_replace("{NoiDung}",$i->rutgonchuoi($row_km['NoiDung'],10),$str);
	$str=str_replace("{Hinh}","<img width='120px' src='$row_km[Hinh]' alt='Giày Bitas' title='$row_km[Ten]' />",$str);
	$str=str_replace("{ThuTu}",$row_km['ThuTu'],$str);
	$str=str_replace("{AnHien}",($row_km['AnHien']==1)?"Đang hiện":"Đang ẩn",$str);	
	echo $str;
  }
  ?>
</tbody>
</table>
