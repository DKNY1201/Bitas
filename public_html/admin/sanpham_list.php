<?php require_once "checklogin.php";
	if(isset($_GET['idNSP']))
	{
		$idNSP=$_GET['idNSP'];
		$sp=$i->ListSanPhamTheoNSP($idNSP);
	}
	else
		$sp=$i->ListSanPham();
?>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
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
	<a class="addBtn" href="index.php?p=sanpham_them">Thêm sản phẩm</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>idSP</th>
    <th>Tên</th>
    <th>Ngày tạo/<br />cập nhật</th>
    <th>Giá</th>
    <th>Giá chưa giảm</th>
    <th>Size</th>
    <th>Số lần mua</th>
    <th>Nhóm sản phẩm</th>
    <th>Thứ tự/<br />Ẩn hiện</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_sp=mysql_fetch_assoc($sp)){
	ob_start();  
  ?>
  <tr>
    <td>{idSP}</td>
    <td>{Ten}</td>
    <td>{NgayTao}<br />{NgayCapNhat}</td>
    <td>{Gia_vn}</td>
    <td>{GiaChuaGiam_vn}</td>
    <td>{Size}</td>
    <td>{SLM}</td>
    <td><a class="action" href="index.php?p=sanpham_list&idNSP={idNSP}">{NSP}</a></td>
    <td>{ThuTu}<br />{AnHien}</td>
    <td>
    	<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    		<a class="icon icon-edit" title="Chỉnh sửa" href="index.php?p=sanpham_sua&idsp={idSP}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){ ?>
        	<a onclick="return confirm('Bạn muốn xóa sản phẩm {Ten}?')" class="icon icon-del" title="Xóa" href="sanpham_xoa.php?idsp={idSP}"></a>
        <?php } ?>
    </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idSP}",$row_sp['idSP'],$str);
	$str=str_replace("{Ten}",$row_sp['Ten'],$str);
	$str=str_replace("{NgayTao}",date("d/m/Y H:i:s",strtotime($row_sp['NgayTao'])),$str);
	$str=str_replace("{NgayCapNhat}",date("d/m/Y H:i:s",strtotime($row_sp['NgayCapNhat'])),$str);
	$str=str_replace("{Gia_vn}",number_format($row_sp['Gia_vn'],0,".",",")." VND",$str);
	$str=str_replace("{GiaChuaGiam_vn}",number_format($row_sp['GiaChuaGiam_vn'],0,".",",")." VND",$str);
	$str=str_replace("{Size}",$row_sp['Size'],$str);
	$str=str_replace("{SLM}",$row_sp['SoLanMua'],$str);
	$str=str_replace("{idNSP}",$row_sp['idNSP'],$str);
	$str=str_replace("{NSP}",$row_sp['SKU'],$str);
	$str=str_replace("{ThuTu}",$row_sp['ThuTu'],$str);
	$str=str_replace("{AnHien}",($row_sp['AnHien']==1)?"Đang hiện":"Đang ẩn",$str);	
	echo $str;
  }
  ?>
</tbody>
</table>
