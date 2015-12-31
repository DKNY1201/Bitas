<?php 
	$tt=$i->GetTienThuong($_SESSION['email']);
	$row_tt=mysql_fetch_assoc($tt);
?>
<h1 class="title page_title">Tiền thưởng</h1>
<p>Bạn đang có <b><?php echo number_format($row_tt['GiaTri'],0,'.',',')?> VNĐ</b> tiền thưởng</p>