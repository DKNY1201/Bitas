<?php require_once "checklogin.php";
	if(isset($_GET['idNSP']))
	{
		$idNSP=$_GET['idNSP'];
		$sp=$i->ListSanPhamTheoNSP($idNSP);
	}
	else
		$sp=$i->ListSanPham();
?>
<script>
	$(document).ready(function(e) {
		//data table
		$('#table').dataTable(
			{
				"sPaginationType": "full_numbers",
				"iDisplayLength": 25,
			  "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
				"aaSorting" : [[0, 'desc']],
			}
		);
    });
</script>
<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	<a class="btn-action btn-info" href="index2.php?p=sanpham_them"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Tình trạng</th>
    <th>SKU</th>
    <th>Tên</th>
    <th>Màu</th>
    <th>Cỡ số</th>
    <th>Giá bán</th>
    <th>Giá chưa giảm</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_sp=mysql_fetch_assoc($sp)){
	ob_start();  
  ?>
  <tr>
    <td>{idSP}</td>
    <td>{AnHien}</td>
    <td>{SKU}</td>
    <td><a href="index2.php?p=sanpham_sua&idsp={idSP}">{Ten}</a></td>
    <td>{Mau}</td>
    <td>{Size}</td>
    <td>{Gia_vn}</td>
    <td>{GiaChuaGiam_vn}</td>
    <td class="action">
    	<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    		<a class="fa fa-pencil-square-o" title="Chỉnh sửa" href="index.php?p=sanpham_sua&idsp={idSP}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){ ?>
        	<a onclick="return confirm('Bạn muốn xóa sản phẩm {Ten}?')" class="fa fa-trash" title="Xóa" href="sanpham_xoa.php?idsp={idSP}"></a>
        <?php } ?>
    </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idSP}",$row_sp['idSP'],$str);
	$str=str_replace("{Ten}",$row_sp['Ten'],$str);
  $str=str_replace("{Mau}",$row_sp['Mau'],$str);
	$str=str_replace("{Gia_vn}",number_format($row_sp['Gia_vn'],0,".",",")." VND",$str);
	$str=str_replace("{GiaChuaGiam_vn}",number_format($row_sp['GiaChuaGiam_vn'],0,".",",")." VND",$str);
	$str=str_replace("{Size}",$row_sp['Size'],$str);
	$str=str_replace("{SKU}",$row_sp['SKU'],$str);
	$str=str_replace("{AnHien}",($row_sp['AnHien']==1)?"Đang hiện":"Đang ẩn",$str);	
	echo $str;
  }
  ?>
</tbody>
</table>
