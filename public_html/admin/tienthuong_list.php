<?php require_once "checklogin.php";
	$tienthuong=$i->ListTienThuong();
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
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th><input type="checkbox" name="checkall"></th>
    <th>Thứ Tự</th>
    <th>Họ Tên</th>
    <th>Số tiền</th>
    <th>Email</th>
    <th>Điện thoại</th>
    <th>Thời gian nhận</th>
  </tr>
</thead>
<tbody>
  <?php while($row_tienthuong=mysql_fetch_assoc($tienthuong)){
	ob_start();
  ?>
  <tr>
  	<td><input type="checkbox" name="check"></td>
    <td>{ThuTu}</td>
    <td>{HoTen}</td>
    <td>{SoTien} VND</td>
    <td>{Email}</td>
    <td>{DienThoai}</td>
    <td>{ThoiGian}</td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{ThuTu}",$row_tienthuong['idDQS'],$str);
	$str=str_replace("{HoTen}",$row_tienthuong['Ten'],$str);
	$str=str_replace("{SoTien}",number_format($row_tienthuong['SoTien'],0,".",","),$str);
	$str=str_replace("{Email}",$row_tienthuong['Email'],$str);
	$str=str_replace("{DienThoai}",$row_tienthuong['DienThoai'],$str);
	$str=str_replace("{ThoiGian}",date("d/m/Y H:i:s",strtotime($row_tienthuong['ThoiGianQuay'])),$str);
	echo $str;
  }
  ?>
</tbody>
</table>