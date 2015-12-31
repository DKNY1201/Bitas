<?php require_once "checklogin.php";
	if($_SESSION['group']==1)
		$dh=$i->ListDonHangDoiTra();
	else
		header("location:index.php");
?>
<script type="text/javascript" src="../js/dataTable.js"></script>
<link rel="stylesheet" type="text/css" href="../css/dataTable.css"/>
<script>
	$(document).ready(function(e) {
		$('#table tfoot th').each( function () {
			var title = $('#table thead th').eq( $(this).index() ).text();
			$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		} );
		// DataTable
		var table = $('#table').DataTable(
			{
				"sPaginationType": "full_numbers",
				"iDisplayLength": 25,
			    "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
				"aaSorting" : [[0, 'desc']],
				initComplete: function ()
				{
				  var r = $('#table tfoot tr');
				  r.find('th').each(function(){
					$(this).css('padding', 8);
				  });
				  $('#table thead').append(r);
				  $('#search_0').css('text-align', 'center');
				},	
			}
		);
	 
		// Apply the search
		table.columns().eq( 0 ).each( function ( colIdx ) {
			$( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
				table
					.column( colIdx )
					.search( this.value )
					.draw();
			});
		});
    });
</script>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
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
    <th>Quản lý</th>
  </tr>
</thead>
<tfoot>
    <tr>
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
        <th>Quản lý</th>
    </tr>
</tfoot>
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
	
	$isUT=$row_dh['isUuTien'];
	$isGap=$row_dh['isGap'];
	$isGC_Sale=$row_dh['isGhiChu_Sale'];
	$isGC_Kho=$row_dh['isGhiChu_Kho'];
	ob_start();  
  ?>
  <tr>
    <td><a class="action" href="index.php?p=donhang_doitra_chitiet&idDH={idDH}">{MaDH}</a></td>
    <td>{HoTen}</td>
    <td>{Email}</td>
    <td>{DienThoai}</td>
    <td>{DiaChi}, {Phuong}, {QuanHuyen}, {TinhThanh}</td>
    <td>{NgayDH}</td>
    <td>{NgayGH}</td>
    <td>{GiaTriDH} VNĐ</td>
    <td>{PTTT}</td>
    <td>{TinhTrang}</td>
    <td>
    	<a class="icon icon-detail" href="index.php?p=donhang_doitra_chitiet&idDH={idDH}" title="Chi tiết đơn hàng Đổi trả"></a>
        <!--
		<?php if($_SESSION['group']==1||$_SESSION['group']==2){?>
        <a class="icon <?php echo ($isUT==1)?'icon-star-h':'icon-star'; ?>" title="Ưu tiên"></a> 
        <a class="icon <?php echo ($isGap==1)?'icon-warning-h':'icon-warning'; ?>" title="Gấp"></a> 
        <a class="icon <?php echo ($isGC_Sale==1||$isGC_Kho==1)?'icon-note-h':'icon-note'; ?>" title="Ghi chú"></a></td>
        <?php }?>
        -->
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
	$str=str_replace("{Email}",$row_e['Email'],$str);
	$str=str_replace("{DienThoai}",$row_dh['DienThoai'],$str);
	$str=str_replace("{DiaChi}",$row_dh['DiaChi'],$str);
	$str=str_replace("{TinhThanh}",$row_tinh['Ten'],$str);
	$str=str_replace("{Phuong}",$row_px['type']." ".$row_px['Ten'],$str);
	$str=str_replace("{QuanHuyen}",$row_qh['type']." ".$row_qh['Ten'],$str);
	$str=str_replace("{NgayDH}",date("d/m/Y H:i:s",strtotime($row_dh['NgayDH'])),$str);
	$str=str_replace("{NgayGH}",($row_dh['HoanTat_Ngay']=="")?"Chưa giao":date("d/m/Y",strtotime($row_dh['HoanTat_Ngay'])),$str);
	$str=str_replace("{GiaTriDH}",number_format($gtdh,0,'.',','),$str);	
	$str=str_replace("{PTTT}",$row_pttt['MaPTTT'],$str);
	$str=str_replace("{TinhTrang}",$row_tt['Ten'],$str);
	echo $str;
  }
  ?>
</tbody>
</table>
